<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\City;
use App\Models\State;
use App\Models\SuperAreas;
use App\Models\SuperCity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Rap2hpoutre\FastExcel\FastExcel;

class AreaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function index(Request $request)
	{	
		if (Auth::check()) {
            $status = Auth::user()->status;
			if($status == 0) {
				Auth::logout();
				Session::flush();
				Session::flash('inactive_user', 'Oops .. Your account is inactive.');
				return redirect('admin/login');
			}
        }
		
		if ($request->ajax()) {
			// $data = DB::table('areas')
			// 	->select([
			// 		'areas.*',
			// 		'city.name as city_name',
			// 		'state.name as state_name',
			// 	])
			// 	->join('city','areas.city_id','city.id')
			// 	->join('state','areas.state_id','state.id')
			// 	->where('areas.user_id',Auth::user()->id)->get();

			$data = Helper::applyOnlyTeamRecordQuery(Areas::query())->with(['City:id,name','State:id,name'])->get();
			

			return DataTables::of($data)
			->editColumn('select_checkbox', function ($row) {
				$abc = '<div class="form-check checkbox checkbox-primary mb-0">
				<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
				<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  </div>';
				return $abc;
			})
				->editColumn('city', function ($row) {
					if (isset($row->City)) {
						return $row->city->name;
					}
					return '';
				})
				->editColumn('state', function ($row) {
					if (isset($row->State->name)) {
						return $row->State->name;
					}
					return '';
				})
				->editColumn('status', function ($row) {
					if ($row->status) {
						return 'active';
					} else {
						return 'not active';
					}
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';

					$user = User::with(['roles', 'roles.permissions'])->where('id',Auth::user()->id)->first();

					$edit_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'area-edit');
					});

					$delete_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'area-delete');
					});

					if($row->user_id == Auth::user()->id || Auth::user()->parent_id == null) {
						if(count($edit_permission) > 0) {
							$buttons =  $buttons . '<i role="button" title="Edit" data-id="' . $row->id . '" onclick=getArea(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
						}
	
						if(count($delete_permission) > 0) {
							$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteArea(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
						}
					}

					return $buttons;
				})
				->rawColumns(['Actions','select_checkbox'])
				->make(true);
		}

		$cities = Helper::applyOnlyTeamRecordQuery(City::query())->get()->toArray();
		$states = Helper::applyOnlyTeamRecordQuery(State::query())->get()->toArray();
		$supercities = SuperCity::query()->get()->toArray();

		return view('admin.areas.index', compact('cities', 'states','supercities'));
	}

	public function saveArea(Request $request)
	{

		$request->validate([
			'name' => ['required', 'max:255', Rule::unique('areas')->where(function($query) use ($request) {
				return $query->where('state_id', $request->state_id)
					->where('city_id', $request->city_id)
					->where('id', '!=', $request->id ?? 0);
			})],
			'state_id' => 'required|exists:state,id',
			'city_id' => 'required|exists:city,id',
		]);

		$area = Areas::find($request->id) ?? new Areas();

		$area->fill([
			'user_id' => $area->user_id ?? Auth::user()->id,
			'name' => $request->name,
			'city_id' => $request->city_id,
			'pincode' => $request->pincode,
			'state_id' => $request->state_id,
			'status' => $request->status,
		])->save();
	}

	public function importArea(Request $request)
	{
		if(!empty($request->state_id) && !empty($request->city_id) && count($request->area_array) > 0)
		{
			$allarea = SuperAreas::whereIn('id',$request->area_array)->get();

			foreach ($allarea as $value)
			{
				$state_obj = State::find($request->state_id);
				$user_state = State::where('name',$state_obj->name)->where('user_id',Auth::user()->id)->first();

				$state_id = 0;
				if($user_state)
				{
					$state_id = $user_state->id;
				}
				else
				{
					$new_state = new State();
					$new_state->fill([
						'name' => $state_obj->name,
						'user_id' => Auth::user()->id,
						'gst_type' => $state_obj->gst_type,
					])->save();

					$state_id = $new_state->id;
				}

				$super_city = SuperCity::find($request->city_id);

				$city = City::where('name',$super_city->name)
					->where('user_id', Auth::user()->id)
					->first();

				$city_id = 0;

				if(empty($city))
				{
					$city = City::create([
						'name'=>$super_city->name,
						'state_id'=>$state_id,
						'user_id'=> Auth::User()->id
					]);

					$city_id = $city->id;
				} else {
					$city_id = $city->id;
				}

				$exist = Areas::where('name',$value->name)
					->where('city_id',$city->id)
					->where('user_id', Auth::user()->id)
					->first();

				if (empty($exist->id)){
					$areas = new Areas();
					$areas->user_id = Auth::user()->id;
					$areas->name = $value->name;
					$areas->city_id = $city_id;
					$areas->pincode = $value->pincode;
					$areas->state_id =$state_id;
					$areas->save();
				}
			}
		}
	}

	public function getSpecificArea(Request $request)
	{
		if (!empty($request->id)) {
			$data = DB::table('areas')->where('id',$request->id)->first();
			return json_encode($data);
		}
	}


	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Areas::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0]) ) {
			$data = Areas::whereIn('id', json_decode($request->allids))->delete();
		}
	}
}
