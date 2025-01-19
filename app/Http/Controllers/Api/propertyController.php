<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Api\Properties;
use Illuminate\Support\Facades\Hash;
// use Auth;
// use Validator;
use App\Http\Requests\ProjectFormRequest;
use App\Models\DropdownSettings;
use App\Models\LandImages;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class propertyController extends Controller
{
   

	



public function index(Request $request)
	{
				

		$perPage = $request->input('per_page', 10);
		
		// // Fetch your property data here, or use your existing query
		$property=Properties::where('user_id',Auth::user()->id)->get();
		$propertyData=[];
		if(!empty($property)){
			foreach ($property as $key => $value) {
				$project=Projects::where('id',$value->project_id)->first();
				if(isset($project->project_name)){
					$project=$project->project_name;
				}else{
					$project='';
				}
		
				$propertyData[] = [
					// You should replace these sample data with your actual property data
					
						'id' => $value->id,
						'Project_name' => $project,
						'locality' => $value->locality,
						'property_info' =>[
							//$value->property_for
						],// $value->property_info,
						'price' =>  $value->price,
						'is_liked' => true,
					
					
				];
			}
			
		
			$response = [
				'message' => 'Property list has been fetched successfully.',
				'current_page' => 0, // Set the current page number here
				'total_records' => $property->count(), // Set the total number of records here
				'limit' => $perPage, // Set the limit per page here
				'data' => $propertyData,
			];
		}else {
			$response = [
				'message' => 'This user have no property',
				'current_page' => 0, // Set the current page number here
				'total_records' => 0, // Set the total number of records here
				'limit' => $perPage, // Set the limit per page here
				'data' => $propertyData,
			];
		}
		

		return response()->json($response, 200);
	}   
public function IsFavorites(Request $request)
	{
			

		$perPage = $request->input('per_page', 10);
		
		// // Fetch your property data here, or use your existing query
		 $property=Properties::where([['is_favourite',1],['user_id',Auth::user()->id]])->get();
		$propertyData=[];
		if(!empty($property)){
			foreach ($property as $key => $value) {
				$project=Projects::where('id',$value->project_id)->first();
				if(isset($project->project_name)){
					$project=$project->project_name;
				}else{
					$project='';
				}
		  
				$propertyData[] = [
					// You should replace these sample data with your actual property data
					
						'id' => $value->id,
						'Project_name' => $project,
						'locality' => $value->locality,
						'property_info' =>[
							$value->id
						],// $value->property_info,
						'price' =>  $value->price,
						'is_liked' => true,
					
					
				];
			}
			
		
			$response = [
				'message' => 'Favorite Property list has been fetched successfully.',
				'current_page' => 0, // Set the current page number here
				'total_records' => 100, // Set the total number of records here
				'limit' => $perPage, // Set the limit per page here
				'data' => $propertyData,
			];
		}else {
			$response = [
				'message' => 'This user have no Favorite Property',
				'current_page' => 0, // Set the current page number here
				'total_records' => 100, // Set the total number of records here
				'limit' => $perPage, // Set the limit per page here
				'data' => $propertyData,
			];
		}
		
	
		return response()->json($response, 200);
	}
	public function show($id)
    {
		$show=Properties::find($id);
		$show->amenities = json_decode($show->amenities);
		$show->unit_details = json_decode($show->unit_details);
		$show->other_industrial_fields = json_decode($show->other_industrial_fields);
		$show->other_contact_details = json_decode($show->other_contact_details);
		return response()->json(['status' => '200', 'data' => $show]);

	}
	public function destory($id)
    {
		$show=Properties::destory($id);
		return response()->json(['status' => '200','message' => 'Property Deleted Successfully']);

	}
   
    public function saveProperty(Request $request)
	{
		try {
			if (!empty($request->id) && $request->id != '') {
				$property = Properties::find($request->id);
				$message='property Updated Successfully';
				if (empty($data)) {				
					$message='property Added Successfully';
					$property = new Properties();
				}
			} else {
				$message='property Added Successfully';
				$property = new Properties();
			}
			// Set the property data directly from the request
			$property->user_id=Auth::user()->id;
			$property->property_for = $request->input('property_for');
			$property->property_type = $request->input('property_type');
			$property->property_category = $request->input('property_category');
			$property->configuration = $request->input('configuration');
			$property->project_id = $request->input('project_id');
			$property->locality_id = $request->input('locality_id');
			$property->address = $request->input('address');
			$property->location_link = $request->input('property_link');
			$property->district_id = $request->input('district_id');
			$property->taluka_id = $request->input('taluka_id');
			$property->village_id = $request->input('village_id');
			$property->zone_id = $request->input('zone_id');
			$property->constructed_carpet_area = $request->input('constructed_carpet_area').$request->input('constructed_carpet_area_id');
			$property->constructed_salable_area = $request->input('constructed_salable_area').$request->input('constructed_salable_area_id');
			$property->constructed_builtup_area = $request->input('constructed_builtup_area').$request->input('constructed_builtup_area_id');
			$property->salable_plot_area = $request->input('salable_plot_area').$request->input('salable_plot_area_id');
			$property->carpet_plot_area = $request->input('carpet_plot_area').$request->input('carpet_plot_area_id');
			$property->salable_area = $request->input('salable_area').$request->input('salable_area_mes_id');
			$property->carpet_area = $request->input('carpet_area').$request->input('carpet_area_mes_id');
			$property->storage_centre_height = $request->input('storage_centre_height').$request->input('storage_centre_height_mes');
			$property->length_of_plot = $request->input('length_of_plot').$request->input('length_of_plot_mes');
			$property->width_of_plot = $request->input('width_of_plot').$request->input('width_of_plot_mes');
			$property->entrance_width = $request->input('entrance_width').$request->input('entrance_width_mes');
			$property->ceiling_height = $request->input('ceiling_height').$request->input('ceiling_height_mes');
			$property->builtup_area = $request->input('builtup_area').$request->input('builtup_area_mes_id');
			$property->plot_area = $request->input('plot_area').$request->input('plot_area_mes_id');
			$property->terrace = $request->input('terrace').$request->input('terrace_mes_id');
			$property->construction_area = $request->input('construction_area').$request->input('construction_area_mess_id');
			$property->terrace_carpet_area = $request->input('terrace_carpet_area').$request->input('terrace_carpet_area_mes_id');
			$property->terrace_salable_area = $request->input('terrace_salable_area').$request->input('terrace_salable_area_mes_id');
			$property->total_units_in_project = $request->input('total_units_in_project');
			$property->total_no_of_floor = $request->input('total_no_of_floor');
			$property->total_units_in_tower = $request->input('total_units_in_tower');
			$property->property_on_floors = $request->input('property_on_floors');
			$property->no_of_elavators = $request->input('no_of_elavators');
			$property->no_of_balcony = $request->input('no_of_balcony');
			$property->total_no_of_units = $request->input('total_no_of_units');
			$property->no_of_room = $request->input('no_of_room');
			$property->no_of_bathrooms = $request->input('no_of_bathrooms');
			$property->no_of_floors_allowed = $request->input('no_of_floors_allowed');
			$property->no_of_side_open = $request->input('no_of_side_open');
			$property->service_elavator = $request->input('service_elavator');
			$property->owner_is         = $request->owner_is;
			$property->owner_name       = $request->owner_name;
			$property->owner_contact        = $request->owner_contact;
			$property->owner_email              = $request->owner_email;
			$property->owner_nri        = $request->owner_nri;
			$property->servant_room = $request->input('servant_room');
			$property->hot_property = $request->input('hot_property');
			$property->is_favourite = $request->input('is_favourite');
			$property->is_terrace = $request->input('is_terrace');
			$property->is_pre_leased = $request->input('is_pre_leased');
			$property->front_road_width = $request->input('front_road_width').$request->input('front_road_width_mes');
			$property->construction_allowed_for = $request->input('construction_allowed_for');
			$property->fsi = $request->input('fsi');
			$property->no_of_borewell = $request->input('no_of_borewell');
			$property->fourwheller_parking = $request->input('fourwheller_parking');
			$property->twowheeler_parking = $request->input('twowheeler_parking');
			$property->pre_leased_remarks = $request->input('pre_leased_remarks');
			$property->Property_priority = $request->input('Property_priority');
			$property->source_of_property = $request->input('property_source');
			$property->property_source_refrence = $request->input('refrence');
			$property->availability_status = $request->input('availablity_status');
			$property->available_from = $request->input('available_from');
	
			// Handle the 'amenities' array
			if ($request->has('amenities') && is_array($request->amenities)) {
				$property->amenities = json_encode($request->amenities);
			}
	
			// Handle the 'unit_details' array
			// if ($request->has('unit_details') && is_array($request->unit_details)) {
			// 	$unitDetails = [];
			// 	foreach ($request->unit_details as $unitData) {
			// 		$unitDetails[] = [
			// 			'wing' => $unitData['wing'] ?? null,
			// 			'unit_no' => $unitData['unit_no'] ?? null,
			// 			'unit_status' => $unitData['unit_status'] ?? null,
			// 			'construction_price' => $unitData['construction_price'] ?? null,
			// 			'plot_price' => $unitData['plot_price'] ?? null,
			// 			'price' => $unitData['price'] ?? null,
			// 		];
			// 	}
			// 	$property->unit_details = json_encode($unitDetails);
			// }

			if ($request->has('unit_details') && is_array($request->unit_details)) {
				$unitDetails = [];
				foreach ($request->unit_details as $unitData) {
					$unitDetails[] = [
						$unitData['wing'] ?? '',
						$unitData['unit_no'] ?? '',
						$unitData['unit_status'] ?? '',
						$unitData['construction_price'] ?? '',
						$unitData['plot_price'] ?? '',
						$unitData['price'] ?? '',
					];
				}
				$property->unit_details = json_encode($unitDetails);
			}
	
			// Handle the 'other_industrial_fields' array
	   
		
				$array=["pollution_control_board","ec_noc","bail","discharge","gujrat_gas","power","water","machinery","etl_necpt"];
				$other_industrial_fields=[$request->pollution_control_board,
					$request->ec_noc,
					$request->bail,
					$request->discharge,
					$request->gujrat_gas,
					$request->power,
					$request->water,
					$request->machinery,
					$request->etl_necpt];
					$dataArray=[$other_industrial_fields,$array];
					$property->other_industrial_fields = $dataArray;
			// dd(json_encode($dataArray));
			// Handle the 'other_contact_details' array
				if ($request->has('other_contact_details') && is_array($request->other_contact_details)) {
					$otherContactDetails = [];
					
					foreach ($request->other_contact_details as $contactData) {
						$otherContactDetails[] = [
							'name' => $contactData['name'] ?? null,
							'contact' => $contactData['contact'] ?? null,
							'position' => $contactData['position'] ?? null,
						];
					}
						$property->other_contact_details = json_encode($otherContactDetails);
				}
				
				$property->key_available_at         = $request->key_available_at;
			// Save the property to the database
			dd($property);
			$property->save();
		  //$property->id=52;
		  if ($request->hasFile('images')) {
			foreach ($request->file('images') as $value) {
				$ext = $value->getClientOriginalExtension();
				$fileName = str_replace('.' . $ext, '', $value->getClientOriginalName()) . "-" . time() . '.' . $ext;
				$fileName = str_replace('#', '', $fileName);
				$path = public_path() . config('constant.land_images_url');
				File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
				$moved = $value->move($path, $fileName); // Adjust storage path as needed
				$imagePaths[] = $fileName;
				$land_images = new LandImages();
					$land_images->land_id = $request->land_id;
					$land_images->image = $fileName;
					$land_images->user_id = Auth::User()->id;
					$land_images->pro_id = $property->id;
					$land_images->save();
			}			
		}
		if ($request->hasFile('land_document')) {
			foreach ($request->file('land_document') as $value) {
				$ext = $value->getClientOriginalExtension();
				$fileName = str_replace('.' . $ext, '', $value->getClientOriginalName()) . "-" . time() . '.' . $ext;
				$fileName = str_replace('#', '', $fileName);
				$path = public_path() . config('constant.land_images_url');
				File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
				$moved = $value->move($path, $fileName); // Adjust storage path as needed
				$imagePaths[] = $fileName;
				$land_images = new LandImages();
					$land_images->land_id = $request->land_id;
					$land_images->image = $fileName;
					$land_images->user_id = Auth::User()->id;
					$land_images->pro_id = $property->id;
					$land_images->save();
			}			
		}
		   $getProperty=Properties::find($property->id);
		   $getProperty->image=$imagePaths;
		   $getProperty->amenities = json_decode($getProperty->amenities);
		   $getProperty->unit_details = json_decode($getProperty->unit_details);
		  // $getProperty->other_industrial_fields = json_decode($getProperty->other_industrial_fields);
		   $getProperty->other_contact_details = json_decode($getProperty->other_contact_details);
			return response()->json(['status'=>200, 'property' => $getProperty]);
		} catch (\Exception $e) {
			logger(['save property error ',$e]);
			return response()->json(['status'=>500,'message' => 'Error', 'property' => $e]);

		}
    }

	//Export
	public function exportProperty(Request $request)
	{
		$dropdowns = DropdownSettings::get()->toArray();
		$dropdownsarr = [];
		foreach ($dropdowns as $key => $value) {
			$dropdownsarr[$value['id']] = $value;
		}
		$dropdowns = $dropdownsarr;

		$enqs = [];
		$data = Properties::with('Projects.Area')->get()->toArray();
		foreach ($data as $key => $value) {
			$arr = [];
			$configuration = '';
			$furnished = '';
			$measurement = '';
			$property_source = '';
			if (!empty($value['configuration'])) {
				$configuration = $dropdowns[$value['configuration']]['name'];
			}


			if (!empty($value['source_of_property'])) {
				$property_source = $dropdowns[$value['source_of_property']]['name'];
			}

			if (!empty($value['carpet_measurement'])) {
				$measurement = $dropdowns[$value['carpet_measurement']]['name'];
			}

			if (!empty($value['furnished_status'])) {
				$furnished = $dropdowns[$value['furnished_status']]['name'];
			}
			$project = '';
			$area = '';
			if (!empty($value['Projects']['project_name'])) {
				$project = $value['Projects']['project_name'];
			}

			if (!empty($value['Projects']['area']['name'])) {
				$area = $value['Projects']['area']['name'];
			}
			$contact_name = '';
			$contact_no = '';

			if (!empty($value['owner_details'])) {
				$contacts = json_decode($value['owner_details']);
				foreach ($contacts as $key => $value1) {
					if (!empty($value1[0]) && !empty($value1[1] && !empty($value1[2])) && strtolower($value1[2]) == 'contactable') {
						$contact_name = $value1[0];
						$contact_no = $value1[1];
						break;
					}
				}
			};


			$arr['Project Name'] = $project;
			$arr['Area'] = $area;
			$arr['Configuration'] = $configuration;
			$arr['Measurement'] = $value['carpet_area'] . ' ' . $measurement;
			$arr['Available For'] = $value['property_for'];
			$arr['Wing/Unit No'] = $value['property_wing'] . '/' . $value['property_unit_no'];
			$arr['Furnished'] = $furnished;
			$arr['Price'] = $value['price'];
			$arr['Status'] = $value['property_status'];
			$arr['Contact Name'] = $contact_name;
			$arr['Contact Number'] = $contact_no;
			$arr['Property Source'] = $property_source;
			$arr['Created On'] = Carbon::parse($value['created_at'])->format('d-m-Y');
			$arr['Remarks'] = $value['property_remarks'];

			array_push($enqs, $arr);
		}
		$time = time() . Auth::user()->id;
		File::isDirectory(public_path('excel')) or File::makeDirectory(public_path('excel'), 0777, true, true);
		(new FastExcel(collect($enqs)))->export(public_path('excel/' . $time . '_file.xlsx'));

		echo asset('excel/' . $time . '_file.xlsx');
	}


	public function profile()
    {
        return response()->json(["status"=> 200,
                        "message"=>"Profile Details",
                        "data"=> auth()->user()]);
    	//    return auth()->user();
    }




	// {
	// 	dd($request->get('unit_details'));
	// 	$message="Property Added Successfully";
	// 	if (!empty($request->id) && $request->id != '') {
	// 		$data = Properties::find($request->id);
	// 		$message='Property Updated Successfully';
	// 		if (empty($data)) {
	// 			$data =  new Properties();
	// 			$message="Property Added Successfully";
	// 		}
	// 	} else {
	// 		$data =  new Properties();
	// 	}
	// 	$data->user_id = Auth::user()->id;
	// 	$data->added_by = Auth::user()->id;
	// 	$data->project_id = $request->project_id;
	// 	$data->property_for             = $request->property_for;
	// 	$data->property_type            = $request->property_type;
	// 	$data->property_category        = $request->property_category;
	// 	$data->configuration            = $request->configuration;
	// 	$data->city_id                  = $request->city_id;
	// 	$data->locality_id              = $request->locality_id;
	// 	$data->address                  = $request->address;
	// 	$data->location_link            = $request->property_link;
	// 	$data->district_id              = $request->district_id;
	// 	$data->taluka_id                = $request->taluka_id;
	// 	$data->village_id               = $request->village_id;
	// 	$data->zone_id                  = $request->zone_id;
	// 	$data->constructed_carpet_area  = $request->constructed_carpet_area;
	// 	$data->constructed_salable_area = $request->constructed_salable_area;
	// 	$data->constructed_builtup_area = $request->constructed_builtup_area;
	// 	$data->salable_plot_area        = $request->salable_plot_area;
	// 	$data->carpet_plot_area         = $request->carpet_plot_area;
	// 	$data->salable_area             = $request->salable_area;
	// 	$data->carpet_area              = $request->carpet_area;
	// 	$data->storage_centre_height    = $request->storage_centre_height;
	// 	$data->length_of_plot           = $request->length_of_plot;
	// 	$data->width_of_plot            = $request->width_of_plot;
	// 	$data->entrance_width           = $request->entrance_width;
	// 	$data->ceiling_height           = $request->ceiling_height;
	// 	$data->builtup_area             = $request->builtup_area;
	// 	$data->plot_area                = $request->plot_area;
	// 	$data->terrace                  = $request->terrace;
	// 	$data->construction_area        = $request->construction_area;
	// 	$data->terrace_carpet_area      = $request->terrace_carpet_area;
	// 	$data->terrace_salable_area     = $request->terrace_salable_area;
	// 	$data->total_units_in_project   = $request->total_units_in_project;
	// 	$data->total_no_of_floor        = $request->total_no_of_floor;
	// 	$data->total_units_in_tower     = $request->total_units_in_tower;
	// 	$data->property_on_floors       = $request->property_on_floors;
	// 	$data->no_of_elavators          = $request->no_of_elavators;
	// 	$data->no_of_balcony            = $request->no_of_balcony;
	// 	$data->total_no_of_units        = $request->total_no_of_units;
	// 	$data->no_of_room               = $request->no_of_room;
	// 	$data->no_of_bathrooms          = $request->no_of_bathrooms;
	// 	$data->no_of_floors_allowed     = $request->no_of_floors_allowed;
	// 	$data->washrooms2_type          = $request->washrooms2_type;
	// 	$data->no_of_side_open          = $request->no_of_side_open;
	// 	$data->service_elavator         = $request->service_elavator;
	// 	$data->servant_room             = $request->servant_room;
	// 	$data->hot_property             = $request->hot_property;
	// 	$data->is_favourite             = $request->is_favourite;
	// 	$data->front_road_width         = $request->front_road_width;
	// 	$data->construction_allowed_for = $request->construction_allowed_for;
	// 	$data->fsi                      = $request->fsi;
	// 	$data->no_of_borewell           = $request->no_of_borewell;
	// 	$data->fourwheller_parking      = $request->fourwheller_parking;
	// 	$data->twowheeler_parking       = $request->twowheeler_parking;
	// 	$data->is_pre_leased            = $request->is_pre_leased;
	// 	$data->is_terrace               = $request->is_terrace;
	// 	$data->pre_leased_remarks       = $request->pre_leased_remarks;
	// 	$data->Property_priority        = $request->Property_priority;
	// 	$data->source_of_property       = $request->property_source;
	// 	$data->property_source_refrence = $request->refrence;
	// 	$data->availability_status              = $request->availability_status;
	// 	$data->propertyage              = $request->propertyage;
	// 	$data->available_from       = $request->available_from;
	// 	$data->amenities        = $request->amenities;
	// 	$data->other_industrial_fields              = $request->other_industrial_fields;
	// 	$data->two_road_corner              = $request->two_road_corner;
	// 	$data->unit_details         = $request->unit_details;
	// 	$data->survey_number        = $request->survey_number;
	// 	$data->survey_plot_size         = $request->survey_plot_size;
	// 	$data->survey_price         = $request->survey_price;
	// 	$data->tp_number        = $request->tp_number;
	// 	$data->fp_number        = $request->fp_number;
	// 	$data->fp_plot_size         = $request->fp_plot_size;
	// 	$data->fp_plot_price        = $request->fp_plot_price;
	// 	$data->owner_is         = $request->owner_is;
	// 	$data->owner_name       = $request->owner_name;
	// 	$data->owner_contact        = $request->owner_contact;
	// 	$data->owner_email              = $request->owner_email;
	// 	$data->owner_nri        = $request->owner_nri;
	// 	$data->contact_details              = $request->contact_details;
	// 	$data->care_taker_name              = $request->care_taker_name;
	// 	$data->care_taker_contact       = $request->care_taker_contact;
	// 	$data->key_available_at         = $request->key_available_at;
	// 	$data->conference_room              = $request->conference_room;
	// 	$data->reception_area       = $request->reception_area;
	// 	$data->pantry_type              = $request->pantry_type;
	// 	$data->remarks              = $request->remarks;
	// 	$data->state_id         = $request->state_id;
	// 	$data->other_contact_details        = $request->other_contact_details;
	// 	$data->other_name = is_array($request->other_name) ? implode(",", $request->other_name) : $request->other_name;
	// 	$data->other_contact = is_array($request->other_contact) ? implode(",", $request->other_contact) : $request->other_contact;
	// 	$data->position = is_array($request->position) ? implode(",", $request->position) : $request->position;

	// 	$saveProperty= $data->save();
	// 	//dd($saveProperty);
	// 	if (!empty($request->carpet_measurement)) {
	// 		Helper::add_default_measuerement($request->carpet_measurement);
	// 	}
	// 	if (!empty($request->super_builtup_measurement)) {
	// 		Helper::add_default_measuerement($request->super_builtup_measurement);
	// 	}
	// 	if (!empty($request->plot_measurement)) {
	// 		Helper::add_default_measuerement($request->plot_measurement);
	// 	}
	// 	if (!empty($request->terrace_measuremnt)) {
	// 		Helper::add_default_measuerement($request->terrace_measuremnt);
	// 	}
	// 	return response()->json(['status' => '200','message' => $message, 'data' => $data]);
	// }
    // method for user logout and delete token
    

	
}
