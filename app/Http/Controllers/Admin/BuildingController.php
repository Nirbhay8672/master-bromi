<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Builders;
use App\Models\BuildingImages;
use App\Models\Buildings;
use App\Models\City;
use App\Models\DropdownSettings;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class BuildingController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Buildings::with('Area', 'Builder', 'City', 'State')->where('user_id',Auth::user()->id)->when($request->go_data_id, function ($query) use ($request) {
				return $query->where('id', $request->go_data_id);
			})->orderBy('id','desc')->get();
			return DataTables::of($data)
				->editColumn('name', function ($row) {
					return '<font size="3" style="font-weight:bold"> ' . $row->name . '</font> <br> <font size="2" style="font-style:italic"> ' . ((!empty($row->Area->name)) ? $row->Area->name : '') . '</font>';
				})
				->editColumn('builder', function ($row) {
					if (isset($row->Builder->name)) {
						return $row->Builder->name;
					}
					return '';
				})
				->editColumn('property_type', function ($row) {
					if (!empty($row->property_type)) {
						$drops = DropdownSettings::whereIn('id', json_decode($row->property_type))->pluck('name')->toArray();
						return implode(',', $drops);
					}
					return '';
				})
				->editColumn('is_prime', function ($row) {
					if ($row->is_prime) {
						return '<img src="'.asset('assets/images/primeProperty.png').'" alt="">';
					} else {
						return '';
					}
				})
				->editColumn('status', function ($row) {
					if ($row->status) {
						return 1;
					} else {
						return 0;
					}
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					if (Auth::user()->can('building-list')) {
						$buttons =  $buttons . '<i role="button" title="Edit" data-id="' . $row->id . '" onclick=getBuilding(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
					}
					if (Auth::user()->can('building-delete')) {
						$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteBuilding(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					}
					return $buttons;
				})
				->rawColumns(['Actions', 'name', 'status','is_prime'])
				->make(true);
		}
		$cities = City::orderBy('name')->get();
		$states = State::orderBy('name')->get();
		$areas = Areas::orderBy('name')->get();
		$builders = Builders::orderBy('name')->get();
		$type = 'building_';
		$building_configuration_settings = DropdownSettings::where('dropdown_for', 'like', '%' . $type . '%')->get()->toArray();
		return view('admin.buildings.index', compact('cities', 'states', 'areas', 'builders', 'building_configuration_settings'));
	}

	public function saveBuilding(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			if (!Auth::user()->can('building-edit')) {
				return 0;
			}
			$data = Buildings::find($request->id);
			if (empty($data)) {
				$data =  new Buildings();
			}
		} else {
			$data =  new Buildings();
		}
		$data->user_id = Session::get('parent_id');
		$data->added_by = Auth::user()->id;
		$data->name = $request->name;
		$data->builder_id = $request->builder_id;
		$searched  = Builders::find($request->builder_id);
		if (empty($searched->id)) {
			$idd = Builders::firstOrCreate([
				'name' => $request->builder_id,
				'user_id' => $data->user_id
			], [
				'name' => $request->builder_id,
				'user_id' => $data->user_id
			]);
			$data->builder_id = $idd->id;
		}
		$data->area_id = $request->area_id;
		$data->address = $request->address;
		$data->city_id = $request->city_id;
		$data->state_id = $request->state_id;
		$data->pincode = $request->pincode;
		$data->contact_details = $request->contact_details;
		$data->security_details = $request->security_details;
		$data->building_amenities = $request->amenities;
		$data->unit_no = $request->unit_no;
		$data->landmark = $request->landmark;
		$data->is_prime = $request->prime_building;
		$data->posession_year = $request->building_posession;
		$data->floor_count = $request->floor_count;
		$data->lift_count = $request->lift_count;
		$data->property_type = $request->property_type;
		$data->restrictions = $request->restrictions;
		$data->building_status = $request->building_status;
		$data->building_quality = $request->building_quality;
		$data->building_descriptions = $request->Bulding_description;
		$data->status = $request->status;
		$data->save();
	}

	public function importBuilding(Request $request)
	{
		$file = $request->file('csv_file');
		$name = Str::random(10) . '.csv';
		$file->move(storage_path('app'), $name);
		try {
			$collection = (new FastExcel)->import(storage_path('app/' . $name));
		} catch (\Throwable $th) {
			$collection = [];
		}
		unlink(storage_path('app/' . $name));
		$Buildings = Buildings::with('City', 'State', 'Area', 'Builder')->get()->all();
		$cities = City::all()->pluck('name')->all();
		$cities = array_map('strtolower', $cities);
		$states = State::all()->pluck('name')->all();
		$states = array_map('strtolower', $states);
		$builders = Builders::all()->pluck('name')->all();
		$builders = array_map('strtolower', $builders);
		$areas = Areas::all()->pluck('name')->all();
		$areas = array_map('strtolower', $areas);
		foreach ($collection as $key => $value) {
			if (Helper::check_if_area_exists($Buildings, $value['name']) == 'false') {
				if (!in_array(strtolower($value['city']), $cities)) {
					$city_id = Helper::add_city($value['city']);
				} else {
					$city_id = City::where('name', 'like', '%' . $value['city'] . '%')->first();
					if (!empty($city_id->id)) {
						$city_id = $city_id->id;
					}
				}
				if (!in_array(strtolower($value['state']), $states)) {
					$state_id = Helper::add_state($value['state']);
				} else {
					$state_id = State::where('name', 'like', '%' . $value['state'] . '%')->first();
					if (!empty($state_id->id)) {
						$state_id = $state_id->id;
					}
				}
				if (!in_array(strtolower($value['builder']), $builders)) {
					$builder_id = Helper::add_builder($value['builder']);
				} else {
					$builder_id = Builders::where('name', 'like', '%' . $value['builder'] . '%')->first();
					if (!empty($builder_id->id)) {
						$builder_id = $builder_id->id;
					}
				}
				if (!in_array(strtolower($value['area']), $areas)) {
					$area_id = Helper::add_area($value['area'], $city_id, $state_id);
				} else {
					$area_id = Areas::where('name', 'like', '%' . $value['area'] . '%')->first();
					if (!empty($area_id->id)) {
						$area_id = $area_id->id;
					}
				}
				if (!empty($state_id) && !empty($city_id) && !empty($builder_id) && !empty($area_id)) {
					$data =  new Buildings();
					$data->user_id = Session::get('parent_id');
					$data->added_by = Auth::user()->id;
					$data->name = $value['name'];
					$data->builder_id = $builder_id;
					$data->area_id = $area_id;
					$data->address = $value['address'];
					$data->city_id = $city_id;
					$data->state_id = $state_id;
					$data->pincode =  $value['pincode'];
					$data->status = 1;
					$data->save();
				}
			}
		}
	}

	public function getSpecificBuilding(Request $request)
	{
		if (!empty($request->id)) {
			$data =  Buildings::with('Images')->where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function saveBuildingImages(Request $request)
	{
		if (!empty($request->building_id) && !empty($request->images)) {

			foreach ($request->file('images') as $key => $value) {

				$ext = $value->getClientOriginalExtension();
				$fileName = str_replace('.' . $ext, '', $value->getClientOriginalName()) . "-" . time() . '.' . $ext;
				$fileName = str_replace('#', '', $fileName);
				$path = public_path() . config('constant.building_images_url');
				File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
				$moved = $value->move($path, $fileName);
				if ($moved) {
					if (empty($request->category)) {
						$request->category = 6;
					}
					$building_images = new BuildingImages();
					$building_images->building_id = $request->building_id;
					$building_images->image = $fileName;
					$building_images->category = $request->category;
					$building_images->user_id = Auth::User()->id;
					$building_images->save();
				}
			}
			$all =  BuildingImages::where('building_id',$request->building_id)->get()->toArray();
			if (!empty($all)) {
				return json_encode($all);
			}
		}
	}

	// public function getBuildingImages(Request $request)
	// {
	// 	if (!empty($request->building_id)) {
	// 		$all =  BuildingImages::where('building_id',$request->building_id)->pluck('image')->toArray();
	// 		if (!empty($all)) {
	// 			return json_encode($all);
	// 		}
	// 	}
	// }

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Buildings::where('id', $request->id)->delete();
		}
	}
}
