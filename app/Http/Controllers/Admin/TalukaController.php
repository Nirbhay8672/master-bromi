<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\District;
use App\Models\SuperTaluka;
use App\Models\Taluka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TalukaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Taluka::with('District')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
			return DataTables::of($data)
				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
				<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
				<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  </div>';
					return $abc;
				})
				->editColumn('district_id', function ($row) {
					if (!empty($row->District->name)) {
						return $row->District->name;
					}
					return '';
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" title="Edit" onclick=getCity(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
					$buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" title="Delete" onclick=deleteCity(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions', 'select_checkbox'])
				->make(true);
		}

		$districts = District::orderBy('name')->where('user_id',Auth::user()->id)->get();

		$district_array = [];
		foreach ($districts as $dist) {
			array_push($district_array , $dist->name);
		}

		$super_admin_districts = District::orderBy('name')->whereIn('name', $district_array)->where('user_id',6)->get();

		return view('admin.settings.taluka_index',compact('districts', 'super_admin_districts'));
	}

	public function saveTaluka(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = Taluka::find($request->id);

			$exist_taluka = Taluka::where('name',$request->name)
				->where('id','!=',$request->id)
				->where('user_id',Auth::user()->id)
				->where('district_id',$request->district_id)
				->first();

			if($exist_taluka) {

			} else {
				$data->fill([
					'name' => $request->name,
					'district_id' => $request->district_id,
				])->save();
			}

		} else {
			$taluka = Taluka::where('name',$request->name)
				->where('user_id',Auth::user()->id)
				->where('district_id',$request->district_id)
				->first();

			if(!$taluka) {
				$data =  new Taluka();
				$data->user_id = Auth::user()->id;
				$data->name = $request->name;
				$data->district_id = $request->district_id;
				$data->save();
			}
		}
	}

	public function getTaluka(Request $request)
	{
		if (!empty($request->id)) {
			$data = Taluka::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Taluka::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
			$data = Taluka::whereIn('id', json_decode($request->allids))->delete();
		}
	}

	public function getTalukaForImport(Request $request)
	{
		return response()->json([
			'message' => 'Detail fetch',
			'data' => [
				'taluka_data' => SuperTaluka::where('district_id',$request->district_id)->get()	
			]
		]);
	}

	public function importTaluka(Request $request)
	{
		if(!empty($request->district_id)){

			$alltaluka = SuperTaluka::whereIn('id',$request->taluka_array)->get();
			
			foreach ($alltaluka as $key => $value) {
				
				$exist = Taluka::where('name',$value->name)->where('district_id',$value->district_id)->first();

				if (empty($exist->id)) {
					$district = District::find($value->district_id);

					$current_user_district = District::where('user_id',Auth::user()->id)->where('name', $district->name)->first();

					$new_district_id = $district->id;
					    
					if(!$current_user_district) {
						$new_dist = new District();
						$new_dist->fill([
							'name' => $district->name,
							'state_id' => $district->state_id,
							'user_id' => Auth::user()->id,
						])->save();
						
						$new_district_id = $new_dist->id;
					} else {
						$new_district_id = $current_user_district->id;
					}

					$current_user_taluka = Taluka::where('user_id',Auth::user()->id)->where('name', $value->name)->first();

					if(!$current_user_taluka) {
						$taluka = new Taluka();
						$taluka->user_id = Auth::user()->id;
						$taluka->name = $value->name;
						$taluka->district_id = $new_district_id;
						$taluka->save();
					}
				}
			}
		}
	}

}
