<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\SuperTaluka;
use App\Models\SuperVillages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SuperVillageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function village_index(Request $request)
	{
		if ($request->ajax()) {

			$data = SuperVillages::join('super_talukas', 'super_talukas.id', 'super_villages.super_taluka_id')
				->select([
					'super_villages.id',
					'super_villages.name',
					'super_talukas.name AS taluka_name',
					'district.name AS district_name',
				])
				->join('district', 'district.id', 'super_talukas.district_id')
				->where('district.user_id', Auth::user()->id)
				->orderBy('super_villages.id', 'desc');

			if ($request->district_id > 0) {
				$data->where('district.id', $request->district_id);
			}

			if ($request->taluka_id > 0) {
				$data->where('super_talukas.id', $request->taluka_id);
			}

			return DataTables::of($data->get())
				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
				<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
				<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  </div>';
					return $abc;
				})
				->editColumn('taluka', function ($row) {
					if (isset($row->taluka_name)) {
						return $row->taluka_name;
					}
					return '';
				})
				->editColumn('district', function ($row) {
					if (isset($row->district_name)) {
						return $row->district_name;
					}
					return '';
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i role="button" title="Edit" data-id="' . $row->id . '" onclick=getVillage(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';

					$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteVillage(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions', 'select_checkbox'])
				->make(true);
		}

		$talukas = SuperTaluka::select([
			'super_talukas.*',
			'district.user_id',
		])->join('district','super_talukas.district_id','district.id')->where('district.user_id',Auth::user()->id)->orderBy('super_talukas.name')->get()->toArray();

		$districts = District::with(['talukas'])->where('user_id',Auth::user()->id)->orderBy('name')->get()->toArray();

		return view('superadmin.supersettings.super_village_index', compact('talukas', 'districts'));
	}

	public function village_store(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = SuperVillages::where('name' ,$request->name)->where('district_id', $request->district_id)->where('super_taluka_id', $request->super_taluka_id)->where('id','!=',$request->id)->first();
			if(!$data) {
				$obj = SuperVillages::find($request->id);

				$obj->fill([		
					'name' => ucfirst($request->name),
					'super_taluka_id' => $request->super_taluka_id,
					'district_id' => $request->district_id,
				])->save();
			}
		} else {
			$data = SuperVillages::where('name' ,$request->name)->where('district_id', $request->district_id)->where('super_taluka_id', $request->super_taluka_id)->first();

			if($data) {
				$data->fill([
					'name' => ucfirst($request->name),
					'super_taluka_id' => $request->super_taluka_id,
					'district_id' => $request->district_id,
				])->save();
			} else {
				$new = new SuperVillages();
	
				$new->fill([
					'name' => ucfirst($request->name),
					'super_taluka_id' => $request->super_taluka_id,
					'district_id' => $request->district_id,
				])->save();
			}
		}
	}

	public function get_village(Request $request)
	{
		if (!empty($request->id)) {
			$data = SuperVillages::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function village_delete(Request $request)
	{
		if (!empty($request->id)) {
			SuperVillages::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
			SuperVillages::whereIn('id', json_decode($request->allids))->delete();
		}
	}
}
