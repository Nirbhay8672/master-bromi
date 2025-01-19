<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFormRequest;
use App\Models\Areas;
use App\Models\Builders;
use App\Models\BuildingImages;
use App\Models\City;
use App\Models\DropdownSettings;
use App\Models\LandUnit;
use App\Models\Projects;
use App\Models\Properties;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class ProjectsController extends Controller
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

			if(Auth::user()->parent_id) {

				$project_ids_array = [];
	
				if(Auth::user()->buildings) {
					$project_is_string = str_replace("'", '"', Auth::user()->buildings);
					$project_ids_array = json_decode($project_is_string, true);
				}
	
				$data = Projects::with('Area', 'Builder', 'City', 'State')->where('user_id',Auth::user()->id);
	
				if(count($project_ids_array) > 0) {
					$data->orWhereIn('id', $project_ids_array);
				} else {
					$data->orWhere('user_id',Auth::user()->parent_id);
				}
	
			} else {
				$data = Projects::with('Area', 'Builder', 'City', 'State')->where('user_id',Auth::user()->id);
			}

			$data->orderBy('id','desc');

			$parts = explode('?', $request->location);

			if (count($parts) > 1) {
				$value = $parts[1];
				$value = trim($value);

				if (strpos($value, 'data_id') !== false) {
					$value_part = explode('=', $value);
					if($value_part[1] > 0) {
						$data->where('id', $value_part[1]);
					}
				}
			}

			$data->get();

			return DataTables::of($data)
				->editColumn('area', function ($row) {
					if (isset($row->Area->name)) {
						return $row->Area->name;
					}
					return '';
				})
				->editColumn('address', function ($row) {
					if ($row->address != 'null') {
						return $row->address;
					}
					return '-';
				})
				->editColumn('builder_id', function ($row) {
					if (isset($row->Builder->name)) {
						return $row->Builder->name;
					}
					return '';
				})
				->editColumn('select_checkbox', function ($row) {

					$abc = '';

					if($row->user_id == Auth::user()->id) {
						$abc = '<div class="form-check checkbox checkbox-primary mb-0">
						<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
						<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
						</div>';
					}
					
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

					$user = User::with(['roles', 'roles.permissions'])->where('id',Auth::user()->id)->first();

					$edit_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'project-edit');
					});

					$delete_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'project-delete');
					});

					if(count($edit_permission) > 0 && $row->user_id == Auth::user()->id) {
						$buttons =  $buttons . '<a href="'.route('admin.project.edit',$row->id).'"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
					}

					if(count($delete_permission) > 0 && $row->user_id == Auth::user()->id) {
						$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteProject(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					}

					return $buttons;
				})
				->rawColumns(['Actions','status_change'])
				->rawColumns(['Actions','select_checkbox'])
				->make(true);
		}

		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$areas = Areas::orderBy('name')->where('user_id',Auth::user()->id)->get();

		$builders = Builders::orderBy('name')->get();
		$project_configuration_settings = DropdownSettings::get()->toArray();

		return view('admin.projects.index', compact('cities', 'states', 'areas', 'builders','project_configuration_settings'));
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
			])->join('builders','projects.builder_id','builders.id')
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

		$map_units = LandUnit::all();
		$mapRecordsByKey = $map_units->keyBy('id');

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
	
		$new_array = [];

		foreach ($mapRecordsByKey as $key => $value) {
			$new_array[$key] = $value['unit_name'];
		}

		return view('admin.projects.view_project')->with(['project' => $project, 'mapunits' => $new_array]);
	}

	public function changeProjectStatus(Request $request){
		if ($request->ajax()) {
			if(isset($request->id)){
				$vv = Projects::find($request->id);
				$vv->status = $request->status;
				$vv->save();
			}
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

	public function storeFile(UploadedFile $file , $name = null)
    {
        $path = "file_".time().(string) random_int(0,5).$name.'.'.$file->getClientOriginalExtension();
		$file->storeAs("public/file_image/", $path);
        return $path;
    }
	
	public function saveProject(ProjectFormRequest $request)
	{
		$data = null;

		if($request->id == '' || $request->id == null) {
			$data = new Projects();
		} else {

			foreach (json_decode($request->removed_files) ?? [] as $file_name) {
				$filePath = storage_path("app/public/file_image/{$file_name}");
				unlink($filePath);
			}

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

			if($data->catlog_file != '') {
				if(in_array($data->catlog_file , json_decode($request->removed_files)) ) {
					$data->catlog_file = null;
				}
			}

			if($data->document_image != '') {
				if(in_array($data->document_image , json_decode($request->removed_files)) ) {
					$data->document_image = null;
				}
			}

			$data->other_documents = $request->other_document_array;
		}

		if($request->id == '' || $request->id == null) {
			$data->user_id = Auth::user()->id;
			$data->added_by = Auth::user()->id;
		}

		//  first section data
		$data->builder_id = $request->builder_id;
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
			$data->document_image = $this->storeFile($document_image , '1');
		}

		if($request->catlog_file) {
			$catlot_file = $request->catlog_file;
			$data->catlog_file = $this->storeFile($catlot_file , '2');
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
			Session::flash('success_msg',  'Project has been created successfully.');
		} else {
			Session::flash('success_msg',  'Project has been updated successfully.');
		}
		
		return response()->json([
			'Project added or update successfully.'
		]);
	}

    // Create by #B do not change this function
    public function projectByUnit(Request $request)
	{
		if ($request->ajax()) {
			$data = Properties::with('Projects')->whereHas('Projects')->when(!empty($request->project_id), function ($query) use ($request) {
				return $query->where('project_id', $request->project_id);
			})->get();
			// dd("data",$data);
			$totalRecords = $data->count();
            $dataa = [];
			foreach ($data as $key => $value2) {
				//bhrt furnished
				if (!empty($value2->unit_details)) {
					$arr = json_decode($value2->unit_details);
					foreach ($arr as $key => $value) {
						if (!empty($value[0]) || !empty($value[1]) && isset($value[2])) {
							$arrr['id'] = $value2->id;
							$arrr['wing'] = $value[0];
							$arrr['project'] = $value2->projects->project_name;
							$arrr['property_for'] = $value2->property_for;
							$arrr['unit'] = $value[1];
							$arrr['status'] = $value[2];
							$arrr['price'] = $value2->price;

							$fstatus = '-';
							if ($value2->property_category == '256') {
								$fstatus  = '';
							} else {
								$fstatus  = 'Unfurnished';
								if ($value[8] == "106" || $value[8] == "34") {
									$fstatus = 'Furnished';
								} elseif ($value[8] == "107" || $value[8] == "35") {
									$fstatus = 'Semi Furnished';
								} elseif ($value[8] == "108" || $value[8] == "36") {
									$fstatus = 'Unfurnished';
								} else {
									$fstatus = 'Can Furnished';
								}
							}
							$arrr['fstatus'] = $fstatus;
							$arrr['contact_name'] = $value2->owner_name;
							$arrr['contact_no'] = $value2->owner_contact;
							// Calculate and set the 'price' based on conditions
							$price = '';
							if ($value2->property_for === 'Both') {
								if (!empty($value[7]) && !empty($value[4])) {
									$price = 'R : ' . $value[4] . ' / ' . 'S : ' . $value[7];
								} elseif (!empty($value[3]) && !empty($value[4])) {
									$price = 'R : ' . $value[4] . ' / ' . 'S : ' . $value[3];
								}else{
								    $price = "-";
								}
							} else {
								if (!empty($value[7])) {
									$price = $value[7];
								} elseif (!empty($value[4])) {
									$price = $value[4];
								} elseif (!empty($value[3])) {
									$price = $value[3];
								}else{
								    $price = "-";
								}
							}
							$arrr['price'] = $price;

							array_push($dataa, $arrr);
						}else{
						    dd("no");
						}
					}
				}
			}
			return DataTables::of($dataa)
				->editColumn('project', function ($row) {
				    // dd("rowww",$row);
					if (isset($row['project'])) {
						return '<a href="' . route('admin.project.view', encrypt($row['id'])) . ' ">' . $row['project'] . '</a>';
					} else {
						return ''; // Handle the case where project is not set
					}
				})

				->editColumn('property_for', function ($row) {
					return   $row['property_for'];
				})
				->editColumn('wing', function ($row) {
					return   $row['wing'];
				})
				->editColumn('unit', function ($row) {
					$row['Sold Out'] = "sold ";
					$row['Rent Out'] = "Rent";
					if ($row['status'] == 'Sold Out') {
						return  ' ';
					} elseif ($row['status'] == 'Rent Out') {
						return  ' ';
					} elseif($row['status'] == "Available") {
						return '<a href="' . route('admin.project.view', encrypt($row['id'])) . ' ">' . $row['unit'] . '</a>';
					}
				})
				->editColumn('contact', function ($row) {
					$contact = !empty($row['contact_name']) ? $row['contact_name']: '-';
					$contact_number = !empty($row['contact_no']) ? $row['contact_no'] : '-';
					$telLink = !empty($contact_number) ? '<a href="tel:' . $contact_number . '">' . $contact_number . '</a>' : '-';
					return '<a href="' . route('admin.project.view', encrypt($row['id'])) . ' ">' . $contact . ' - ' . $telLink . '</a>';
				})

				->editColumn('price', function ($row) {
					return $row['price'];
				})
				->rawColumns(['wing','contact', 'project', 'unit', 'property_for'])
				->make(true);
		}
		$projects = Projects::whereNotNull('project_name')->get();
		return view('admin.properties.project_by_unit', compact('projects'));
	}


	public function importProject(Request $request)
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
		$projects = Projects::with('City', 'State', 'Area', 'Builder')->get()->all();
		$cities = City::all()->pluck('name')->all();
		$cities = array_map('strtolower', $cities);
		$states = State::all()->pluck('name')->all();
		$states = array_map('strtolower', $states);
		$builders = Builders::all()->pluck('name')->all();
		$builders = array_map('strtolower', $builders);
		$areas = Areas::all()->pluck('name')->all();
		$areas = array_map('strtolower', $areas);
		foreach ($collection as $key => $value) {
			if (Helper::check_if_area_exists($projects, $value['name']) == 'false') {
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
					$data =  new Projects();
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

	public function addproject(Request $request){
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$areas = Areas::orderBy('name')
			->where('user_id',Auth::user()->id)
			->where('status',1)
			->get();

		$builders = Builders::orderBy('name')->where('user_id' , Auth::user()->id)->get();
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

		$role = 'admin';

		return view('admin.projects.add_project_new', compact('cities', 'states', 'areas', 'builders','project_configuration_settings','first_state','first_city','land_units', 'role'), $data);
	}


	public function editproject(Projects $id){
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$areas = Areas::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$builders = Builders::orderBy('name')->where('user_id' , Auth::user()->id)->get();
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

		$role = 'admin';

		return view('admin.projects.add_project_new', compact('cities', 'states', 'areas', 'builders','project_configuration_settings', 'id','first_state','first_city','land_units', 'role'), $data);
	}


	public function getSpecificProject(Request $request)
	{
		if (!empty($request->id)) {
			$data =  Projects::with('Images')->where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
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

	public function allprojectList(Request $request)
	{
		if ($request->ajax()) {

			$auth = Auth::user();
			$city = City::find($auth->city_id);

			$projects = DB::table('projects')
			->select([
				'projects.id',
				'projects.property_type',
				'projects.remark',
				'projects.project_name',
				'projects.address',
				'areas.name as area_name',
				'builders.name as builder_name',
				'city.name as city_name',
			])
			->leftJoin('areas','projects.area_id','areas.id')
			->leftJoin('builders','projects.builder_id','builders.id')
			->leftJoin('city','projects.city_id','city.id')
			->where('city.name', '=', $city->name);

			if($request->filter_area) {
				$area = Areas::find($request->filter_area);
				if($area) {
					$projects->where('areas.name',$area['name']);
				}
			}

			return DataTables::of($projects->get())
				->editColumn('address', function ($row) {
					if (isset($row->address)) {
						return $row->address;
					}
					return '';
				})
				->editColumn('city_name', function ($row) {
					if (isset($row->city_name)) {
						return $row->city_name;
					}
					return '';
				})
				->editColumn('builder_name', function ($row) {
					if (isset($row->builder_name)) {
						return $row->builder_name;
					}
					return '';
				})
				->editColumn('property_type', function ($row) {
					if (!empty($row->property_type)) {
						$drops = DropdownSettings::where('id', $row->property_type)->pluck('name')->toArray();
						return implode(',', $drops);
					}
					return '';
				})
				->make(true);
		}

		$all_areas = Areas::where('user_id',Auth::user()->id)->get();

		return view('admin.projects.all_project_list')->with([
			'all_areas' => $all_areas
		]);
	}
}
