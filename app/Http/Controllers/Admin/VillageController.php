<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\SuperTaluka;
use App\Models\SuperVillages;
use App\Models\Taluka;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class VillageController extends Controller
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
			$data = Village::with('Taluka', 'District')->when($request->go_data_id, function ($query) use ($request) {
				return $query->where('id', $request->go_data_id);
			})->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

			return DataTables::of($data)
			->editColumn('select_checkbox', function ($row) {
				$abc = '<div class="form-check checkbox checkbox-primary mb-0">
				<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
				<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  </div>';
				return $abc;
			})
				->editColumn('taluka', function ($row) {
					if (isset($row->Taluka->name)) {
						return $row->Taluka->name;
					}
					return '';
				})
				->editColumn('district', function ($row) {
					if (isset($row->District->name)) {
						return $row->District->name;
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
						$buttons =  $buttons . '<i role="button" title="Edit" data-id="' . $row->id . '" onclick=getArea(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
				
						$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteArea(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					
					return $buttons;
				})
				->rawColumns(['Actions','select_checkbox'])
				->make(true);
		}
		$districts = District::orderBy('name')->where('user_id',Auth::user()->id)->get()->toArray();
		$talukas = Taluka::orderBy('name')->where('user_id',Auth::user()->id)->get()->toArray();

		$district_array = [];
		foreach ($districts as $dist) {
			array_push($district_array , $dist['name']);
		}

		$superDistrict = District::orderBy('name')->whereIn('name', $district_array)->where('user_id',6)->get();

		$superTaluka = SuperTaluka::orderBy('name')->get()->toArray();

		return view('admin.settings.village_index',compact('districts','talukas','superDistrict', 'superTaluka'));
	}

	public function saveVillage(Request $request)
	{
		if (!empty($request->id) && $request->id != '')
		{
			$data = Village::find($request->id);
			if (empty($data)) {
				$exist = Village::where('name',$request->name)->where('taluka_id',$request->taluka_id)->first();
				if (!empty($exist)) {
					return;
				}
				$data =  new Village();
			}
		}
		else
		{
			$exist = Village::where('name',$request->name)->where('taluka_id',$request->taluka_id)->first();
			if (!empty($exist)) {
				return;
			}
			$data =  new Village();
		}
		$data->user_id = Auth::user()->id;
		$data->name = $request->name;
		$data->taluka_id = $request->taluka_id;
		$data->district_id = $request->district_id;
		$data->status = $request->status;
		$data->save();
	}

	public function getVillage(Request $request)
	{
		if (!empty($request->id)) {
			$data = Village::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Village::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0]) ) {
			$data = Village::whereIn('id', json_decode($request->allids))->delete();
		}
	}

	public function getVillageForImport(Request $request)
	{
		return response()->json([
			'message' => 'Detail fetch',
			'data' => [
				'village_data' => SuperVillages::where('super_taluka_id',$request->taluka_id)->get()	
			]
		]);
	}

	public function importVillage(Request $request)
	{
		if(!empty($request->district_id) && !empty($request->taluka_id) && count($request->village_array) > 0)
		{
			$allvillage = SuperVillages::whereIn('id',$request->village_array)->get();

			foreach ($allvillage as $value)
			{
				$district_obj = District::find($request->district_id);
				$user_district = District::where('name',$district_obj->name)->where('user_id',Auth::user()->id)->first();

				$district_id = 0;
				if($user_district)
				{
					$district_id = $user_district->id;
				}
				else
				{
					$new_district = new District();
					$new_district->fill([
						'name' => $district_obj->name,
						'user_id' => Auth::user()->id,
						'state_id' => $district_obj->state_id,
					])->save();

					$district_id = $new_district->id;
				}

				$super_taluka = SuperTaluka::find($request->taluka_id);

				$taluka = Taluka::where('name',$super_taluka->name)
					->where('user_id', Auth::user()->id)
					->first();

				$taluka_id = 0;

				if(empty($taluka))
				{
					$taluka = Taluka::create([
						'name'=>$super_taluka->name,
						'district_id'=>$district_id,
						'user_id'=> Auth::User()->id
					]);

					$taluka_id = $taluka->id;
				} else {
					$taluka_id = $taluka->id;
				}

				$exist = Village::where('name',$value->name)
					->where('taluka_id',$taluka->id)
					->where('user_id', Auth::user()->id)
					->first();

				if (empty($exist->id)){
					$village = new Village();
					$village->user_id = Auth::user()->id;
					$village->name = $value->name;
					$village->taluka_id = $taluka_id;
					$village->district_id =$district_id;
					$village->status = 1;
					$village->save();
				}
			}
		}
	}
}
