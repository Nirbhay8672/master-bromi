<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\InstaProperties;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\DropdownSettings;
use App\Models\Enquiries;
use App\Models\Projects;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InstaPropertiesController extends Controller
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
			$dropdowns = DropdownSettings::get()->toArray();
			$dropdownsarr = [];
			foreach ($dropdowns as $key => $value) {
				$dropdownsarr[$value['id']] = $value;
			}
			$dropdowns = $dropdownsarr;
			$data = InstaProperties::with('Project.Area')->orderBy('id','desc')->get();

			return DataTables::of($data)
				->editColumn('building_id', function ($row) {
					if (isset($row->Project->project_name)) {
						return $row->Project->project_name;
					}
				})
				->editColumn('created_at', function ($row) {
					return  Carbon::parse($row->created_at)->format('d-m-Y');
				})
				->editColumn('property_for', function ($row) use ($dropdowns) {
					try {
						return $row->property_for;
					} catch (\Throwable $th) {
						//throw $th;
					}
				})
				->editColumn('property_wing', function ($row) {
					return $row->property_wing . ' | ' . $row->property_unit_no;
				})
				->editColumn('furnished_status', function ($row) use ($dropdowns) {
					try {
						return ((!empty($dropdowns[$row->furnished_status]['name'])) ? $dropdowns[$row->furnished_status]['name'] : '');
					} catch (\Throwable $th) {
						//throw $th;
					}
				})
				->addColumn('Actions', function ($row) {
					$buttons = '';
						$buttons =  $buttons . '<i role="button" title="Edit" data-id="' . $row->id . '" onclick=getProperty(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
					
				
						$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteProperty(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					
					return $buttons;
				})
				->rawColumns(['Actions'])
				->make(true);
		}
		$projects = Projects::orderBy('project_name')->get();
		$areas = Areas::orderBy('name')->get();
		$property_configuration_settings = DropdownSettings::get()->toArray();
		return view('admin.properties.insta_index', compact('projects', 'property_configuration_settings', 'areas'));
	}

	public function saveProperty(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
		
			$data = InstaProperties::find($request->id);
			if (empty($data)) {
				$data =  new InstaProperties();
			}
		} else {
			$data =  new InstaProperties();
		}
		$data->user_id = Session::get('parent_id');
		$data->added_by = Auth::user()->id;
		$data->property_for = $request->property_for;
		$data->property_type = $request->property_type;
		$data->specific_type = $request->specific_type;
		$data->building_id = $request->building_id;
		$data->property_wing = $request->property_wing;
		$data->property_unit_no = $request->property_unit_no;
		$data->configuration = $request->configuration;
		$data->super_builtup_area = $request->super_builtup_area;
		$data->super_builtup_measurement = $request->super_builtup_measurement;
		$data->plot_area = $request->plot_area;
		$data->plot_measurement = $request->plot_measurement;
		$data->terrace = $request->terrace;
		$data->terrace_measuremnt = $request->terrace_measuremnt;
		$data->hot_property = $request->hot_property;
		$data->furnished_status = $request->furnished_status;
		$data->commision = $request->commision;
		$data->source_of_property = $request->source_of_property;
		$data->price = $request->price;
		$data->property_remarks = $request->property_remarks;
		$data->is_specific_number = $request->is_specific_number;
		$data->owner_contact_specific_no = $request->owner_contact_specific_no;
		$data->owner_name = $request->owner_name;
		$data->owner_number = $request->owner_number;
		$data->save();
		if (!empty($request->super_builtup_measurement)) {
			Helper::add_default_measuerement($request->super_builtup_measurement);
		}
		if (!empty($request->plot_measurement)) {
			Helper::add_default_measuerement($request->plot_measurement);
		}
		if (!empty($request->terrace_measuremnt)) {
			Helper::add_default_measuerement($request->terrace_measuremnt);
		}
	}



	public function getSpecificProperty(Request $request)
	{
		if (!empty($request->id)) {
			$data = InstaProperties::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = InstaProperties::where('id', $request->id)->delete();
			return json_encode($data);
		}
	}
}
