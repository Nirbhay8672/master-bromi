<?php

namespace App\Http\Controllers\Builder;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFormRequest;
use App\Models\Areas;
use App\Models\Builders;
use App\Models\City;
use App\Models\DropdownSettings;
use App\Models\LandUnit;
use App\Models\Projects;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		return view('builder.home');
	}

	public function projects(Request $request)
	{
		if ($request->ajax()) {

			$data = Projects::with('Area', 'Builder', 'City', 'State')
				->where('added_by',Auth::user()->id)
				->orderBy('id','desc')
				->get();

			return DataTables::of($data)
				->editColumn('area', function ($row) {
					if (isset($row->Area->name)) {
						return $row->Area->name;
					}
					return '';
				})
				->editColumn('builder_id', function ($row) {
					if (isset($row->Builder->name)) {
						return $row->Builder->name;
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
				->editColumn('property_type', function ($row) {
					if (!empty($row->property_type)) {
						$drops = DropdownSettings::where('id', $row->property_type)->pluck('name')->toArray();
						return implode(',', $drops);
					}
					return '';
				})
				->editColumn('modified_at', function ($row) {
					return Carbon::parse($row->updated_at)->format('d/m/Y');
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<a href="'.route('builder.project.edit',$row->id).'"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
					$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteProject(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';

					return $buttons;
				})
				->rawColumns(['Actions','status_change'])
				->rawColumns(['Actions','select_checkbox'])
				->make(true);
		}

		$cities = City::orderBy('name')->get();
		$states = State::orderBy('name')->get();
		$areas = Areas::orderBy('name')->get();
		$builders = Builders::orderBy('name')->get();
		$project_configuration_settings = DropdownSettings::get()->toArray();

		return view('builder.projects.index', compact('cities', 'states', 'areas', 'builders','project_configuration_settings'));
	}

	public function viewProject($project_id)
	{
		$project = DB::table('projects')
			->select([
				'projects.*',
				DB::raw("builders.name AS builder_name"),
				DB::raw("state.name AS state_name"),
				DB::raw("city.name AS city_name"),
				DB::raw("areas.name AS area_name"),
			])->leftJoin('builders','projects.builder_id','builders.id')
			->join('city','projects.city_id','city.id')
			->join('state','projects.state_id','state.id')
			->join('areas','projects.area_id','areas.id')
			->where('projects.id', $project_id)->first();

		$project->contacts = json_decode($project->contact_details, true);

		$categories = [
			259 => 'Office',
			260 => 'Retail',
			261 => 'Storage / Industrial',
			262 => 'Plot / Land',
			254 => 'Flat',
			255 => 'Vila / Banglow',
			256 => 'Land / Plot',
			257 => 'Penthouse',
			258 => 'Farmhouse'
		];

		$project->category_name = $categories[$project->property_category] ?? '';

		$project->towers_details = json_decode($project->tower_details, true);

		$project->if_office_retail = json_decode($project->towers_details['if_office_or_retail'], true);
		$project->if_office = json_decode($project->towers_details['if_office_tower_details'], true);
		$project->if_retail = json_decode($project->towers_details['if_retail_tower_details'], true);

		$project->if_recidential_wing = json_decode($project->wing_details, true);
		$project->units_details = json_decode($project->unit_details, true);

		$project->stor_indu = json_decode($project->storage_industrial_details, true);
		$project->stor_indu_facility = json_decode($project->storage_industrial_facilities, true);
		$project->extra_facility = json_decode($project->extra_facilities, true);
		
		$project->land_plot = json_decode($project->land_plot_details, true);

		$project->parkings_decode = json_decode($project->parking_details, true);
		$project->parkings = json_decode($project->parkings_decode['parking_details'], true);

		$project->amenity_array = json_decode($project->amenities, true);
		$project->other_documents = json_decode($project->other_documents, true) ?? [];

		$map_units = LandUnit::all();
		$mapRecordsByKey = $map_units->keyBy('id');

		$new_array = [];

		foreach ($mapRecordsByKey as $key => $value) {
			$new_array[$key] = $value['unit_name'];
		}

		return view('builder.projects.view_project')->with(['project' => $project, 'mapunits' => $new_array]);
	}

	public function addproject(Request $request){
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$areas = Areas::orderBy('name')
			->where('user_id',Auth::user()->id)
			->where('status',1)
			->get();

		$builders = Builders::orderBy('name')->get();
		$project_configuration_settings = DropdownSettings::get()->toArray();

		$data['property_configuration_settings'] = DropdownSettings::get()->toArray();
		$prop_type = [];
		foreach ($data['property_configuration_settings'] as $key => $value) {
			if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'],'property_')) {
				array_push($prop_type,$value['id']);
			}
		}
		$data['prop_type'] = $prop_type;

		$first_state = State::where('user_id',Auth::user()->id)->first();
		$first_city = City::where('user_id',Auth::user()->id)->first();

		$land_units = DB::table('land_units')->get();

		$role = 'builder';

		return view('admin.projects.add_project_new', compact('cities', 'land_units', 'states', 'areas', 'builders','project_configuration_settings','first_state','first_city' , 'role'), $data);
	}

	public function editproject(Projects $id){
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$areas = Areas::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$builders = Builders::orderBy('name')->get();
		$project_configuration_settings = DropdownSettings::get()->toArray();

		$data['property_configuration_settings'] = DropdownSettings::get()->toArray();
		$prop_type = [];
		foreach ($data['property_configuration_settings'] as $key => $value) {
			if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'],'property_')) {
				array_push($prop_type,$value['id']);
			}
		}
		$data['prop_type'] = $prop_type;
		
		$id->other_documents = json_decode($id->other_documents, true) ?? [];

		$first_state = State::where('user_id',Auth::user()->id)->first();
		$first_city = City::where('user_id',Auth::user()->id)->first();

		$land_units = DB::table('land_units')->get();

		$role = 'builder';

		return view('builder.projects.add_project_new', compact('cities', 'land_units', 'states', 'areas', 'builders','project_configuration_settings', 'id','first_state','first_city', 'role'), $data);
	}

	public function storeFile(UploadedFile $file)
    {
        $path = "file_".time().(string) random_int(0,5).'.'.$file->getClientOriginalExtension();
        $file->storeAs("public/file_image/", $path);
        return $path;
    }

	public function saveProject(ProjectFormRequest $request)
	{
		$data = null;

		if($request->id == '' || $request->id == null) {
			$data = new Projects();
		} else {
			Projects::where('id', (int) $request->id)
				->update([
					'property_type' => null,
					'property_category' => null,
					'sub_categories' => null,
					'sub_category_single' => null,

					'tower_details' => null,
					'wing_details' => null,
					'unit_details' => null,
					'land_plot_details' => null,
					'storage_industrial_details' => null,
					'storage_industrial_facilities' => null,
				]
			);

			$data = Projects::find((int) $request->id);
		}

		if($request->id == '' || $request->id == null) {
			$data->user_id = Auth::user()->id;
			$data->added_by = Auth::user()->id;
		}

		//  first section data
		$data->builder_id = Auth::user()->id;
		$data->website = $request->website;

		$data->contact_details = $request->other_contact_details;

		$data->project_name = $request->project_name;
		$data->address = $request->address;
		$data->area_id = $request->locality;
		$data->state_id = $request->state;
		$data->city_id = $request->city;
		$data->pincode = $request->pincode;
		$data->location_link= $request->location_link;
		
		$data->land_area = $request->land_area;
		$data->land_size_unit = $request->land_size_unit;
		$data->rera_number = $request->rera_number;

		$data->project_status = $request->project_status;
		$data->project_status_question = $request->project_status_question;
		$data->restrictions = $request->restricted_user;

		// second section data
		$data->property_type = $request->propery_type;
		$data->property_category = $request->property_category;
		$data->sub_categories = $request->sub_categories;
		$data->sub_category_single = $request->sub_category_single;

		$tower_details = [
			'if_flat_or_penthouse' => $request->is_flat_or_penthouse,
			'if_office_or_retail' => $request->if_office_or_retail,
			'if_office_tower_details' => $request->if_office_tower_details,
			'if_retail_tower_details' => $request->if_retail_tower_details,

			'if_office_tower_details_with_specification' => $request->if_office_tower_details_with_specification,
		];
		$data->tower_details = json_encode($tower_details);

		$data->storage_industrial_details = $request->if_ware_cold_ind_plot;
		$data->storage_industrial_facilities = $request->storage_industrial_details;
		$data->extra_facilities = $request->extra_facilities;

		$data->unit_details = $request->if_residential_only_units;
		$data->wing_details = $request->if_residential_only_wings;
		$data->land_plot_details = $request->if_farm_plot_land;

		if($request->propery_type == 87 || $request->property_category == 259 || $request->property_category == 260) {
			if($request->propery_type == 87) {
				$array = '[';
				foreach(json_decode($data->unit_details) as $unit) {
					if(isset($unit->wing)) {
						$array .= '[';
						$array .= $unit->wing;
						$array .= ','.$unit->saleable;
						$array .= ','.$unit->built_up;
						$array .= ','.$unit->carpet_area;
						$array .= ','.$unit->balcony;
						$array .= ','.$unit->wash_area;
						$array .= '],';
					}
				}

				$data->unit = $array;
				$data->tower = '';
			} else {
				$data->unit = '';
				$new_data = json_encode($tower_details);
				$decode_obj = json_decode($new_data);

				$array = '[';
				foreach(json_decode($decode_obj->if_office_tower_details) as $tower) {
					if($tower->tower_name != '') {
						$array .= '[';
						$array .= $tower->tower_name;
						$array .= ','.$tower->carpet ?? '';
						$array .= ','.$tower->saleable ?? '';
						$array .= '],';
					}
				}
				$array .= ']';

				if($array == "[]") {
					$array = '['; 
					foreach(json_decode($decode_obj->if_retail_tower_details) as $tower) {
						if($tower->tower_name != '') {
							$array .= '[';
							$array .= $tower->tower_name;
							$array .= ','.$tower->size_from;
							$array .= ','.$tower->size_to;
							$array .= ','.$tower->front_opening;
							$array .= ','.$tower->number_of_each_floor;
							$array .= '],';
						}
					}
					$array .= ']';
				}

				$data->tower = $array;
			}
		}

		// third section data
		$parking_details = [
			'free_alloted_for_two_wheeler' => $request->free_alloted_for_two_wheeler,
			'free_alloted_for_four_wheeler' => $request->free_alloted_for_four_wheeler,
			'available_for_purchase' => $request->available_for_purchase,
			'total_number_of_parking' => $request->total_number_of_parking,

			'total_floor_for_parking' => $request->total_floor_for_parking,
			'parking_details' => $request->parking_details
		];
		$data->parking_details = json_encode($parking_details);

		$data->amenities = $request->amenities;

		if($request->document_image) {
			$data->document_category = $request->document_category;
			$document_image = $request->document_image;
			$data->document_image = $this->storeFile($document_image);
		}

		if($request->catlog_file) {
			$catlot_file = $request->catlog_file;
			$data->catlog_file = $this->storeFile($catlot_file);
		}

		$other_documents = json_decode($request->other_documents);

		if(count($other_documents) > 0) {
			foreach($other_documents as $index => $document) {
				if($request['other_doc_'.$index]) {
					$other_documents[$index]->file = $this->storeFile($request['other_doc_'.$index]);
				}
			}
			$data->other_documents = json_encode($other_documents);
 		}
		
		$data->is_indirectly_store = 0;
		$data->remark = $request->remark;

		$data->save();

		if($request->id == '' || $request->id == null) {
			Session::flash('message',  'Project has been created successfully.');
		} else {
			Session::flash('message',  'Project has been updated successfully.');
		}
		
		return response()->json([
			'Project added or update successfully.'
		]);
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Projects::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0]) ) {
			$data = Projects::whereIn('id', json_decode($request->allids))->delete();
		}
	}

	public function viewProjectDocument($filename)
    {
        $filePath = storage_path("app/public/file_image/{$filename}");
        if (!file_exists($filePath)) {
            abort(404);
        }
        $mimeType = mime_content_type($filePath);
        return response()->file($filePath, ['Content-Type' => $mimeType]);
    }

	public function logout() {
		Session::flush();
        Auth::logout();

		return redirect()->route('admin.login');
	}
}
