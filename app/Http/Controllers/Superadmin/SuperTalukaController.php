<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\SuperTaluka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SuperTalukaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {

			$data = SuperTaluka::join('district', 'district.id', 'super_talukas.district_id')
				->select([
					'super_talukas.id',
					'super_talukas.name',
					'district.name AS district_name',
				])->orderBy('super_talukas.id', 'desc')->where('district.user_id', Auth::user()->id);

			if ($request->district_id > 0) {
				$data->where('district.id', $request->district_id);
			}

			return DataTables::of($data->get())
				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
				<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
				<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  </div>';
					return $abc;
				})
				->editColumn('district_id', function ($row) {
					if (!empty($row->district_name)) {
						return $row->district_name;
					}
					return '';
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" title="Edit" onclick=getCity(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
					$buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" title="Delete" onclick=deleteTaluka(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions', 'select_checkbox'])
				->make(true);
		}

		$districts = District::orderBy('name')->where("user_id",Auth::user()->id)->get();

		return view('superadmin.supersettings.super_taluka_index', compact('districts'));
	}

	public function details(Request $request)
	{
		if (!empty($request->id)) {
			$data = SuperTaluka::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function talukas_destroy(Request $request)
	{
		if (!empty($request->id)) {
			SuperTaluka::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
			SuperTaluka::whereIn('id', json_decode($request->allids))->delete();
		}
	}

	public function store(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = SuperTaluka::where('name' ,$request->name)->where('district_id',$request->district_id)->where('id','!=',$request->id)->first();
			if(!$data) {
				$obj = SuperTaluka::find($request->id);

				$obj->fill([
					'name' => ucfirst($request->name),
					'district_id' => $request->district_id,
				])->save();
			}
		} else {
			$data = SuperTaluka::where('name' ,$request->name)->where('district_id',$request->district_id)->first();

			if($data) {
				$data->fill([
					'name' => ucfirst($request->name),
					'district_id' => $request->district_id,
				])->save();
			} else {
				$new = new SuperTaluka();
	
				$new->fill([
					'name' => ucfirst($request->name),
					'district_id' => $request->district_id,
				])->save();
			}
		}
	}
}
