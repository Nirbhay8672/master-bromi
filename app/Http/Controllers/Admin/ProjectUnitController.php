<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DropdownSettings;
use App\Models\Projects;
use App\Models\ProjectUnit;
use App\Models\Properties;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProjectUnitController extends Controller
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
			$data = ProjectUnit::with('Project')
				->when($request->filter_project_id, function ($query) use ($request) {
					return $query->where('project_id', $request->filter_project_id);
				})
				->when($request->filter_tower_id, function ($query) use ($request) {
					return $query->where('tower_id', $request->filter_tower_id);
				})
				->when($request->filter_units_id, function ($query) use ($request) {
					return $query->where('units_id', $request->filter_units_id);
				})
				->when($request->filter_village_id, function ($query) use ($request) {
					return $query->where('village_id', $request->filter_village_id);
				})
				->orderBy('id','desc')->get();

			if (!empty($request->filter_status)) {
				foreach ($data as $key => $value) {
					if (!str_contains($value->floor_details,$request->filter_status)) {
						unset($data[$key]);
					}
				}
			}

			return DataTables::of($data)
				->editColumn('project', function ($row) {
					if (isset($row->Project->project_name)) {
						return $row->Project->project_name;
					}
					return '';
				})
				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
					<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
					<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
					  </div>';
					return $abc;
				})
				->editColumn('floor_details', function ($row) use ($request) {
					$available_floors = '';
					if (!empty($row->floor_details)) {
						$floors = json_decode($row->floor_details);
						foreach ($floors as $key => $value) {
							if (!empty($request->filter_status)) {
								if ( $value[2] == $request->filter_status) {
									$available_floors .= '|' . $value[0] . ' - ' . $value[1];
								}
							}else{
								$available_floors .= '|' . $value[0] . ' - ' . $value[1];
							}
						}
					}
					return $available_floors;
				})
				->editColumn('actions', function ($row) {
					$buttons = '';

					$user = User::with(['roles', 'roles.permissions'])->where('id',Auth::user()->id)->first();

					$edit_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'unit-edit');
					});

					$delete_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'unit-delete');
					});

					if(count($edit_permission) > 0) {
						$buttons =  $buttons . '<a href="'.route('admin.unit.edit',$row->id).'"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
					}

					if(count($delete_permission) > 0) {
						$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteUnit(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					}

					return $buttons;
				})
				->rawColumns(['actions','select_checkbox'])
				->make(true);
		}
		$project_configuration_settings = DropdownSettings::get()->toArray();
		$towers = [];
		$unit_types = [];
		$projects = Projects::all();
		foreach ($projects as $key => $value) {
			$tower_details = json_decode($value->tower);
			$unit_details = json_decode($value->unit);
			if (!empty($tower_details)) {
				foreach ($tower_details as $key2 => $value2) {
					$arr = [];
					if (!empty($value2[0])) {
						$arr['parent_id'] = $value->id;
						$arr['id'] = $key2;
						$arr['name'] = $value2[0];
						$towers[] = $arr;
					}
				}
			}
			if (!empty($unit_details)) {
				foreach ($unit_details as $key3 => $value3) {
					$arr = [];
					if (!empty($value3[0])) {
						$arr['id'] = $key3;
						$arr['parent_id'] = $value->id;
						$arr['name'] = $value3[0];
						$arr['property_type'] = Helper::searchForId($value3[1], $project_configuration_settings);
						$arr['size'] = $value3[3];
						$arr['measurement'] = Helper::searchForId($value3[4], $project_configuration_settings);
						$unit_types[] = $arr;
					}
				}
			}
		}
		return view('admin.projects.unit_index', compact('projects', 'towers', 'unit_types', 'project_configuration_settings'));
	}

	public function saveUnit(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = ProjectUnit::find($request->id);
			if (empty($data)) {
				$data =  new ProjectUnit();
			}
		} else {
			$data =  new ProjectUnit();
		}
		$data->user_id = Session::get('parent_id');
		$data->added_by = Auth::user()->id;
		$data->project_id = $request->project_id;
		$data->tower_id = $request->tower_id;
		$data->units_id = $request->units_id;
		$data->floor_details = $request->floor_details;
		$data->save();
	}

	public function storeProperty(Request $request)
	{
		$props  = new Properties();
		$props->user_id = Session::get('parent_id');
		$props->project_id = $request->project_id;
		$props->owner_contact = $request->contact_no;
		$props->save();
	}

	public function addUnit(Request $request){
		$project_configuration_settings = DropdownSettings::get()->toArray();
		$towers = [];
		$projects = Projects::all();
		$unit_types = [];
		foreach ($projects as $key => $value) {
			$tower_details = json_decode($value->tower);
			$unit_details = json_decode($value->unit);
			if (!empty($tower_details)) {
				foreach ($tower_details as $key2 => $value2) {
					$arr = [];
					if (!empty($value2[0])) {
						$arr['parent_id'] = $value->id;
						$arr['id'] = $key2;
						$arr['name'] = $value2[0];
						$towers[] = $arr;
					}
				}
			}
			if (!empty($unit_details)) {
				foreach ($unit_details as $key3 => $value3) {
					$arr = [];
					if (!empty($value3[0])) {
						$arr['id'] = $key3;
						$arr['parent_id'] = $value->id;
						$arr['name'] = $value3[0];
						$arr['property_type'] = Helper::searchForId($value3[1], $project_configuration_settings);
						$arr['size'] = $value3[3];
						$arr['measurement'] = Helper::searchForId($value3[4], $project_configuration_settings);
						$unit_types[] = $arr;
					}
				}
			}
		}
		return view('admin.projects.add_project_unit', compact('projects', 'towers', 'unit_types', 'project_configuration_settings'));
	}


	public function editUnit(Request $request){
		$project_configuration_settings = DropdownSettings::get()->toArray();
		$towers = [];
		$projects = Projects::all();
		$unit_types = [];
		foreach ($projects as $key => $value) {
			$tower_details = json_decode($value->tower);
			$unit_details = json_decode($value->unit);
			if (!empty($tower_details)) {
				foreach ($tower_details as $key2 => $value2) {
					$arr = [];
					if (!empty($value2[0])) {
						$arr['parent_id'] = $value->id;
						$arr['id'] = $key2;
						$arr['name'] = $value2[0];
						$towers[] = $arr;
					}
				}
			}
			if (!empty($unit_details)) {
				foreach ($unit_details as $key3 => $value3) {
					$arr = [];
					if (!empty($value3[0])) {
						$arr['id'] = $key3;
						$arr['parent_id'] = $value->id;
						$arr['name'] = $value3[0];
						$arr['property_type'] = Helper::searchForId($value3[1], $project_configuration_settings);
						$arr['size'] = $value3[3];
						$arr['measurement'] = Helper::searchForId($value3[4], $project_configuration_settings);
						$unit_types[] = $arr;
					}
				}
			}
		}
		$current_id = $request->id;

		return view('admin.projects.add_project_unit', compact('projects', 'towers', 'unit_types', 'project_configuration_settings','current_id'));
	}


	public function getSpecificUnit(Request $request)
	{
		if (!empty($request->id)) {
			$data =  ProjectUnit::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = ProjectUnit::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0]) ) {
			$data = ProjectUnit::whereIn('id', json_decode($request->allids))->delete();
		}
	}
}
