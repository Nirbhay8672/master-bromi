<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFormRequest;
use App\Models\Areas;
use App\Models\Builders;
use App\Models\BuildingImages;
use App\Models\City;
use App\Models\DropdownSettings;
use App\Models\Projects;
use App\Models\Api\Properties;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Rap2hpoutre\FastExcel\FastExcel;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

// use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
	
	public function index(Request $request)
	{
		$perPage = $request->input('per_page', 10);
        $Projects = Projects::where('user_id',Auth::user()->id)->get();
		// dd($Projects->count());
		$ProjectsData=[];
		foreach ($Projects as $key => $value) {
			if(!empty($value->builder_id)){

				$buildersData=Builders::find($value->builder_id);
				$buildername=$buildersData->name;
			}else{
				$buildername=null;
			}
			
			$ProjectsData[]=[
				"id"=>$value->id ,
				"project_name"=>$value->project_name,
				"address"=>$value->address ,
				"property_type"=>$value->property_type ,
				"builder_name"=>$buildername,
				"created_at"=>$value->created_at,
				"updated_at"=>$value->updated_at

			];
			
		}
		
  
		$response = [
			'message' => 'Projects list has been fetched successfully.',
			'current_page' => 0, // Set the current page number here
			'total_records' => $Projects->count(), // Set the total number of records here
			'limit' => $perPage, // Set the limit per page here
			'data' => $ProjectsData,
		];
		return response()->json($response, 200);
	}

	public function show($id)
	{
		
        $Projects = Projects::find($id);
		    $Projects->contact_details = json_decode($Projects->contact_details);
			$Projects->tower_details = json_decode($Projects->tower_details);
			$Projects->unit_details = json_decode($Projects->unit_details);
			$Projects->wing_details = json_decode($Projects->wing_details);
			$Projects->land_plot_details = json_decode($Projects->land_plot_details);
			$Projects->storage_industrial_details = json_decode($Projects->storage_industrial_details);
			$Projects->storage_industrial_facilities = json_decode($Projects->storage_industrial_facilities);
			$Projects->parking_details = json_decode($Projects->parking_details);
			$Projects->amenities = json_decode($Projects->amenities);
			return response()->json(['status' => '200','message' => 'Project show by Id', 'data' => $Projects]);

	}
	

	

	// public function saveBuildingImages(Request $request)
	// {
	// 	if (!empty($request->building_id) && !empty($request->images)) {

	// 		foreach ($request->file('images') as $key => $value) {

	// 			$ext = $value->getClientOriginalExtension();
	// 			$fileName = str_replace('.' . $ext, '', $value->getClientOriginalName()) . "-" . time() . '.' . $ext;
	// 			$fileName = str_replace('#', '', $fileName);
	// 			$path = public_path() . config('constant.building_images_url');
	// 			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
	// 			$moved = $value->move($path, $fileName);
	// 			if ($moved) {
	// 				if (empty($request->category)) {
	// 					$request->category = 6;
	// 				}
	// 				$building_images = new BuildingImages();
	// 				$building_images->building_id = $request->building_id;
	// 				$building_images->image = $fileName;
	// 				$building_images->category = $request->category;
	// 				$building_images->user_id = Auth::User()->id;
	// 				$building_images->save();
	// 			}
	// 		}
	// 		$all =  BuildingImages::where('building_id',$request->building_id)->get()->toArray();
	// 		if (!empty($all)) {
	// 			return json_encode($all);
	// 		}
	// 	}
	// }

	// public function storeFile(UploadedFile $file)
    // {
    //     $path = "file_".time().(string) random_int(0,5).'.'.$file->getClientOriginalExtension();
    //     $file->storeAs("public/file_image/", $path);
    //     return $path;
    // }
	
	// public function saveProject1(Request $request)
	// {
	// 	$data = null;

	// 	if($request->id == '' || $request->id == null) {
	// 		$data = new Projects();
	// 	} else {
	// 		Projects::where('id', (int) $request->id)
	// 			->update([
	// 				'property_type' => null,
	// 				'property_category' => null,
	// 				'sub_categories' => null,
	// 				'sub_category_single' => null,

	// 				'tower_details' => null,
	// 				'wing_details' => null,
	// 				'unit_details' => null,
	// 				'land_plot_details' => null,
	// 				'storage_industrial_details' => null,
	// 				'storage_industrial_facilities' => null,
	// 			]
	// 		);

	// 		$data = Projects::find((int) $request->id);
	// 	}

	// 	if($request->id == '' || $request->id == null) {
	// 		// $data->user_id = Session::get('parent_id');
	// 		$data->user_id = Auth::user()->id;
	// 		$data->added_by = Auth::user()->id;
	// 	}

	// 	//  first section data
	// 	$data->builder_id = $request->builder_id;
	// 	$data->website = $request->website;

	// 	$data->contact_details = $request->other_contact_details;

	// 	$data->project_name = $request->project_name;
	// 	$data->address = $request->address;
	// 	$data->area_id = $request->locality;
	// 	$data->state_id = $request->state;
	// 	$data->city_id = $request->city;
	// 	$data->pincode = $request->pincode;
	// 	$data->location_link= $request->location_link;
		
	// 	$data->land_area = $request->land_area;
	// 	$data->land_size_unit = $request->land_size_unit;
	// 	$data->rera_number = $request->rera_number;

	// 	$data->project_status = $request->project_status;
	// 	$data->project_status_question = $request->project_status_question;
	// 	$data->restrictions = $request->restricted_user;

	// 	// second section data
	// 	$data->property_type = $request->propery_type;
	// 	$data->property_category = $request->property_category;
	// 	$data->sub_categories = $request->sub_categories;
	// 	$data->sub_category_single = $request->sub_category_single;

	// 	$tower_details = [
	// 		'if_flat_or_penthouse' => $request->is_flat_or_penthouse,
	// 		'if_office_or_retail' => $request->if_office_or_retail,
	// 		'if_office_tower_details' => $request->if_office_tower_details,
	// 		'if_retail_tower_details' => $request->if_retail_tower_details,

	// 		'if_office_tower_details_with_specification' => $request->if_office_tower_details_with_specification,
	// 	];
	// 	$data->tower_details = json_encode($tower_details);

	// 	$data->storage_industrial_details = $request->if_ware_cold_ind_plot;
	// 	$data->storage_industrial_facilities = $request->storage_industrial_details;
	// 	$data->extra_facilities = $request->extra_facilities;

	// 	$data->unit_details = $request->if_residential_only_units;
	// 	$data->wing_details = $request->if_residential_only_wings;
	// 	$data->land_plot_details = $request->if_farm_plot_land;

	// 	if($request->propery_type == 87 || $request->property_category == 259 || $request->property_category == 260) {
	// 		if($request->propery_type == 87) {
	// 			$array = '[';
	// 			foreach(json_decode($data->unit_details) as $unit) {
	// 				// if($unit->wing) {
	// 				// 	$array .= '[';
	// 				// 	$array .= $unit->wing;
	// 				// 	$array .= ','.$unit->saleable;
	// 				// 	$array .= ','.$unit->built_up;
	// 				// 	$array .= ','.$unit->carpet_area;
	// 				// 	$array .= ','.$unit->balcony;
	// 				// 	$array .= ','.$unit->wash_area;
	// 				// 	$array .= '],';
	// 				// }
	// 			}

	// 			$data->unit = $array;
	// 			$data->tower = '';
	// 		} else {
	// 			$data->unit = '';
	// 			$new_data = json_encode($tower_details);
	// 			$decode_obj = json_decode($new_data);

	// 			$array = '[';
	// 			foreach(json_decode($decode_obj->if_office_tower_details) as $tower) {
	// 				if($tower->tower_name != '') {
	// 					$array .= '[';
	// 					$array .= $tower->tower_name;
	// 					$array .= ','.$tower->total_floor;
	// 					$array .= ','.$tower->total_unit;
	// 					$array .= ','.$tower->carpet;
	// 					$array .= ','.$tower->saleable;
	// 					$array .= '],';
	// 				}
	// 			}
	// 			$array .= ']';

	// 			if($array == "[]") {
	// 				$array = '['; 
	// 				foreach(json_decode($decode_obj->if_retail_tower_details) as $tower) {
	// 					if($tower->tower_name != '') {
	// 						$array .= '[';
	// 						$array .= $tower->tower_name;
	// 						$array .= ','.$tower->size_from;
	// 						$array .= ','.$tower->size_to;
	// 						$array .= ','.$tower->front_opening;
	// 						$array .= ','.$tower->number_of_each_floor;
	// 						$array .= '],';
	// 					}
	// 				}
	// 				$array .= ']';
	// 			}

	// 			$data->tower = $array;
	// 		}
	// 	}

	// 	// third section data
	// 	$parking_details = [
	// 		'free_alloted_for_two_wheeler' => $request->free_alloted_for_two_wheeler,
	// 		'free_alloted_for_four_wheeler' => $request->free_alloted_for_four_wheeler,
	// 		'available_for_purchase' => $request->available_for_purchase,
	// 		'total_number_of_parking' => $request->total_number_of_parking,

	// 		'total_floor_for_parking' => $request->total_floor_for_parking,
	// 		'parking_details' => $request->parking_details
	// 	];
	// 	$data->parking_details = json_encode($parking_details);

	// 	$data->amenities = $request->amenities;

	// 	if($request->document_image) {
	// 		$data->document_category = $request->document_category;
	// 		$document_image = $request->document_image;
	// 		$data->document_image = $this->storeFile($document_image);
	// 	}

	// 	if($request->catlog_file) {
	// 		$catlot_file = $request->catlog_file;
	// 		$data->catlog_file = $this->storeFile($catlot_file);
	// 	}

	// 	$data->save();

	// 	if($request->id == '' || $request->id == null) {
	// 		Session::flash('message',  'Project has been created successfully.');
	// 	} else {
	// 		Session::flash('message',  'Project has been updated successfully.');
	// 	}
		
	// 	return response()->json(["status"=> 200,
    //                     "message"=>"Project added successfully ",
    //                     "data"=> $data]);
	// }
	public function saveProject(Request $request)
	{
		try{
		

			if (!empty($request->id) && $request->id != '') {
				$project = Projects::find($request->id);
				$message='project Updated Successfully';
				if (empty($project)) {	
					$message='project Added Successfully';
					$project = new Projects();
				}
			} else {
				$message='project Added Successfully';
				$project = new Projects();
			}
			//unit details
			if ($request->has('other_contact_details') && is_array($request->other_contact_details)) {
				$other_contact_details = [];
				foreach ($request->other_contact_details as $contactDetailData) {
					$other_contact_details[]=[
						'name' => $contactDetailData['name'],
						'mobile' => $contactDetailData['mobile'],
						'position' => $contactDetailData['position'],
						'email' => $contactDetailData['email'],  // Or leave it empty if not applicable
						'designation' => $contactDetailData['designation'],
					];
					
				}
				$project->contact_details= json_encode($other_contact_details);
			}
			//if_residential_only_wings
			if ($request->has('if_residential_only_wings') && is_array($request->if_residential_only_wings)) {
				$residentialWing =[];
				foreach ($request->if_residential_only_wings as $wingData) {
					
					$residentialWing[]= [
						'wing_name' => $wingData['wing_name']?? null,
						'total_floors' => $wingData['total_floors']?? null,
						'total_total_units' => $wingData['total_total_units']?? null,
						'sub_categories' => $wingData['sub_categories']?? null,
					];
					
				}
				$project->wing_details = json_encode($residentialWing);
			}
			//if_residential_only_units
			if ($request->has('if_residential_only_units') && is_array($request->if_residential_only_units)) {
				$residentialUnits = [];
				foreach ($request->if_residential_only_units as $unitData) {
					$residentialUnits[] = [
						'wing' => $unitData['wing']?? null,
						'saleable' => $unitData['saleable']?? null,
						'saleable_to' => $unitData['saleable_to']?? null,
						'built_up' => $unitData['built_up']?? null,
						'built_up_to' => $unitData['built_up_to']?? null,
						'carpet_area' => $unitData['carpet_area']?? null,
						'carpet_area_to' => $unitData['carpet_area_to']?? null,
						'balcony' => $unitData['balcony']?? null,
						'balcony_to' => $unitData['balcony_to']?? null,
						'wash_area' => $unitData['wash_area']?? null,
						'wash_area_to' => $unitData['wash_area_to']?? null,
						'terrace_carpet_area' => $unitData['terrace_carpet_area']?? null,
						'terrace_carpet_area_to' => $unitData['terrace_carpet_area_to']?? null,
						'terrace_saleable_area_to' => $unitData['terrace_saleable_area_to']?? null,
						'floor_height' => $unitData['floor_height']?? null,
						'servant_room' => $unitData['servant_room']?? null,
						'service_lift' => $unitData['service_lift']?? null,
						'has_terrace_and_carpet' => $unitData['has_terrace_and_carpet']?? null,
						'has_built_up' => $unitData['has_built_up']?? null,
						'has_carpet' => $unitData['has_carpet']?? null,
						'saleable_map_unit' => $unitData['saleable_map_unit']?? null,
						'built_up_map_unit' => $unitData['built_up_map_unit']?? null,
						'carpet_area_map_unit' => $unitData['carpet_area_map_unit']?? null,
						'balcony_area_map_unit' => $unitData['balcony_area_map_unit']?? null,
						'wash_area_map_unit' => $unitData['wash_area_map_unit']?? null,
						'terrace_carpet_area_map_unit' => $unitData['terrace_carpet_area_map_unit']?? null,
						'terrace_saleable_area_map_unit' => $unitData['terrace_saleable_area_map_unit']?? null,
						'floor_height_map_unit' => $unitData['floor_height_map_unit']?? null,
					];
				}
				$project->unit_details  = json_encode($residentialUnits);
			}
			//store if_office_tower_details
			if ($request->has('if_office_tower_details') && is_array($request->if_office_tower_details)) {
				$officeTowers = [];
				foreach ($request->if_office_tower_details as $towerData) {
					$officeTowers[] = [
						'tower_name' => $towerData['tower_name']?? null,
						'total_floor' => $towerData['total_floor']?? null,
						'total_unit' => $towerData['total_unit']?? null,
						'carpet' => $towerData['carpet']?? null,
						'built_up' => $towerData['built_up']?? null,
						'built_up_to' => $towerData['built_up_to']?? null,
						'saleable' => $towerData['saleable']?? null,
						'saleable_to' => $towerData['saleable_to']?? null,
						'is_carpet' => $towerData['is_carpet']?? null,
						'is_built_up' => $towerData['is_built_up']?? null,
						// ... Add other attributes ...
		
						// ...
					];
				}
				//$project->if_office_tower_details = json_encode($officeTowers);
			}
		
			// Store if_retail_tower_details
			if ($request->has('if_retail_tower_details') && is_array($request->if_retail_tower_details)) {
				$retailTowers = [];
				foreach ($request->if_retail_tower_details as $towerData) {
					$retailTowers[] = [
						'tower_name' => $towerData['tower_name']?? null,
						'sub_category' => $towerData['sub_category']?? null,
						'size_from' => $towerData['size_from']?? null,
						'size_to' => $towerData['size_to']?? null,
						'front_opening' => $towerData['front_opening']?? null,
						'number_of_each_floor' => $towerData['number_of_each_floor']?? null,
						'ceiling_height' => $towerData['ceiling_height']?? null,
						'size_from_map_unit' => $towerData['size_from_map_unit']?? null,
						'size_to_map_unit' => $towerData['size_to_map_unit']?? null,
						'tower_ceiling_map_unit' => $towerData['tower_ceiling_map_unit']?? null,
						'tower_front_opening_map_unit' => $towerData['tower_front_opening_map_unit']?? null,
						// ... Add other attributes ...
		
						// ...
					];
				}
				//$project->if_retail_tower_details = json_encode($retailTowers);
			}
	
			//land_plot_details
			if ($request->has('if_farm_plot_land_total_land_area')) {
				$ifFarmPlotLand = [
					'total_land_area' => $request->if_farm_plot_land_total_land_area,
					'total_land_area_to' => $request->if_farm_plot_land_total_land_area_to,
					'total_open_area' => $request->if_farm_plot_land_total_open_area,
					'total_open_area_to' => $request->if_farm_plot_land_total_open_area_to,
					'total_number_of_plot' => $request->if_farm_plot_land_total_number_of_plot,
					'common_area' => $request->if_farm_plot_land_common_area,
					'common_area_to' => $request->if_farm_plot_land_common_area_to,
					'multiple_theme_phase' => $request->if_farm_plot_land_multiple_theme_phase,
					'land_area_map_unit' => $request->if_farm_plot_land_land_area_map_unit,
					'open_area_map_unit' => $request->if_farm_plot_land_open_area_map_unit,
					'common_area_map_unit' => $request->if_farm_plot_land_common_area_map_unit,
					'phase_name' => $request->if_farm_plot_land_phase_name,
					'plot_size_from' => $request->if_farm_plot_land_plot_size_from,
					'plot_size_to' => $request->if_farm_plot_land_plot_size_to,
					'add_carpet_plot_size' => $request->if_farm_plot_land_add_carpet_plot_size,
					'add_constructed_carpet_area' => $request->if_farm_plot_land_add_constructed_carpet_area,
					'add_constructed_built_up_area' => $request->if_farm_plot_land_add_constructed_built_up_area,
					'carpet_plot_size' => $request->if_farm_plot_land_carpet_plot_size,
					'carpet_plot_size_to' => $request->if_farm_plot_land_carpet_plot_size_to,
					'carpet_plot_size_map_unit' => $request->if_farm_plot_land_carpet_plot_size_map_unit,
					'plot_with_construction' => $request->if_farm_plot_land_plot_with_construcation,
					'constructed_saleable_area' => $request->if_farm_plot_land_constructed_saleable_area,
					'constructed_saleable_area_to' => $request->if_farm_plot_land_constructed_saleable_area_to,
					'constructed_saleable_area_map_unit' => $request->if_farm_plot_land_constructed_saleable_area_map_unit,
					'constructed_carpet_area' => $request->if_farm_plot_land_constructed_carpet_area,
					'constructed_carpet_area_to' => $request->if_farm_plot_land_constructed_carpet_area_to,
					'constructed_carpet_area_map_unit' => $request->if_farm_plot_land_constructed_carpet_area_map_unit,
					'constructed_built_up_area_from' => $request->if_farm_plot_land_constructed_built_up_area_from,
					'constructed_built_up_area_to' => $request->if_farm_plot_land_constructed_built_up_area_to,
					'number_of_room' => $request->if_farm_plot_land_number_of_room,
					'number_of_bathroom' => $request->if_farm_plot_land_number_of_bathroom,
					'number_of_balcony' => $request->if_farm_plot_land_number_of_balcony,
					'number_of_open_side' => $request->if_farm_plot_land_number_of_open_side,
					'servant_room' => $request->if_farm_plot_land_servant_room,
					'number_of_parking' => $request->if_farm_plot_land_number_of_parking,
					'plot_size_from_map_unit' => $request->if_farm_plot_land_plot_size_from_map_unit,
					'plot_size_to_map_unit' => $request->if_farm_plot_land_plot_size_to_map_unit,
					'constructed_built_up_from_map_unit' => $request->if_farm_plot_land_constructed_built_up_from_map_unit,
					'constructed_built_up_to_map_unit' => $request->if_farm_plot_land_constructed_built_up_to_map_unit,
					// ... Add other attributes ...
		
					// ...
				];
				$project->land_plot_details = json_encode($ifFarmPlotLand);
			}
			//storage_industrial_details
			if ($request->has('if_ware_cold_ind_plot_plot_area_from')) {
				$ifWareColdIndPlot = [];
				$ifWareColdIndPlot[] = [
					'plot_area_from' => $request->if_ware_cold_ind_plot_plot_area_from,
					'plot_area_to' => $request->if_ware_cold_ind_plot_plot_area_to,
					'construced_area_from' => $request->if_ware_cold_ind_plot_construced_area_from,
					'construced_area_to' => $request->if_ware_cold_ind_plot_construced_area_to,
					'road_width_of_front_side_area_from' => $request->if_ware_cold_ind_plot_road_width_of_front_side_area_from,
					'road_width_of_front_side_area_to' => $request->if_ware_cold_ind_plot_road_width_of_front_side_area_to,
					'ceiling_height' => $request->if_ware_cold_ind_plot_ceiling_height,
					'carpet_from_to_unit_map' => $request->if_ware_cold_ind_plot_carpet_from_to_unit_map,
					'constructed_from_to_unit_map' => $request->if_ware_cold_ind_plot_constructed_from_to_unit_map,
					'road_width_of_front_side_area_from_to_unit_map' => $request->if_ware_cold_ind_plot_road_width_of_front_side_area_from_to_unit_map,
					'ceiling_height_unit_map' => $request->if_ware_cold_ind_plot_ceiling_height_unit_map,
					
				];
				$project->storage_industrial_details = json_encode($ifWareColdIndPlot);
			}
	
			 // Store storage_industrial_facilities
			 if ($request->has('storage_industrial_details_pcb')) {
				$storageIndustrialDetails = [
					'pcb' => $request->storage_industrial_details_pcb,
					'pcb_detail' => $request->storage_industrial_details_pcb_detail,
					'ec' => $request->storage_industrial_details_ec,
					'ec_detail' => $request->storage_industrial_details_ec_detail,
					'gas' => $request->storage_industrial_details_gas,
					'gas_detail' => $request->storage_industrial_details_gas_detail,
					'power' => $request->storage_industrial_details_power,
					'power_detail' => $request->storage_industrial_details_power_detail,
					'water' => $request->storage_industrial_details_water,
					'water_detail' => $request->storage_industrial_details_water_detail,
				
				];
				$project->storage_industrial_facilities = json_encode($storageIndustrialDetails);
			}
			//store Parking details
			if ($request->has('parking_details')) {
				$parkingDetails = [];
				foreach ($request->parking_details as $parkingData) {
					$parkingDetails[] = [
						'floor_number' => $parkingData['floor_number']?? null,
						'ev_charging_point' => $parkingData['ev_charging_point']?? null,
						'hydraulic_parking' => $parkingData['hydraulic_parking']?? null,
						'height_of_basement' => $parkingData['height_of_basement']?? null,
						'height_of_basement_map_unit' => $parkingData['height_of_basement_map_unit']?? null,
					];
				}
				$project->parking_details = json_encode($parkingDetails);
			}
			
			//store amenities
			
			$amenities = [
				$request->amenities_swimming_pool,
				$request->amenity_club_house,
				$request->amenity_passenger_lift,
				$request->amenity_garden,
				$request->amenity_service_lift,
				$request->amenity_streature_lift,
				$request->amenity_ac,
				$request->amenity_gym,
			];
			//$project->amenities = $amenities;
	
			$project->document_image = $request->document_image;
			$project->document_category = $request->document_category;
			$project->catlog_file = $request->catlog_file;
			$project->extra_facilities = json_encode($request->extra_facilities ?: []);
			$project->user_id=Auth::user()->id;
			$project->project_name = $request->project_name;
			$project->address = $request->address;
			$project->area_id = $request->locality;
			$project->state_id = $request->state;
			$project->city_id = $request->city;
			$project->pincode = $request->pincode;
			$project->location_link = $request->location_link;
			$project->land_area = $request->land_area;
			// $project->land_size_unit = $request->land_size_unit;
			// $project->number_of_units_in_project = $request->number_of_unit_in_project;
			$project->rera_number = $request->rera_number;
			$project->project_status = $request->project_status;
			$project->project_status_question = $request->project_status_question;
			$project->restrictions = json_encode($request->restricted_user ?: []);
			$project->property_type = $request->propery_type;
			$project->property_category = $request->property_category;
			$project->sub_categories = json_encode($request->sub_categories ?: []);
			$project->sub_category_single = $request->sub_category_single;
			$project->builder_id = $request->builder_id;
			$project->website = $request->website;
			//tower_details
			$isFlatOrPenthouse = [
				'number_of_towers' => $request->is_flat_or_penthouse_number_of_towers,
				'number_of_floors' => $request->is_flat_or_penthouse_number_of_floors,
				'total_units' => $request->is_flat_or_penthouse_total_units,
				'number_of_elevator' => $request->is_flat_or_penthouse_number_of_elevator,
				'service_elevator' => $request->is_flat_or_penthouse_service_elevator ?: null,
			];
			$project->tower_details = json_encode($isFlatOrPenthouse);


			
			if($request->document_image) {
				$project->document_category = $request->document_category;
				$document_image = $request->document_image;
				$project->document_image = $this->storeFile($document_image);
			}
	
			if($request->catlog_file) {
				$catlot_file = $request->catlog_file;
				$project->catlog_file = $this->storeFile($catlot_file);
			}
			 
			$dd=$project->save();
			// dd($dd);
			if(!empty($request->id)){
				$getProperty=Projects::find($request->id);
				// dd($getProperty);
			}else{

				$getProperty=Projects::find($project->id);
			}
			$getProperty->contact_details = json_decode($getProperty->contact_details);
			$getProperty->tower_details = json_decode($getProperty->tower_details);
			$getProperty->unit_details = json_decode($getProperty->unit_details);
			$getProperty->wing_details = json_decode($getProperty->wing_details);
			$getProperty->land_plot_details = json_decode($getProperty->land_plot_details);
			$getProperty->storage_industrial_details = json_decode($getProperty->storage_industrial_details);
			$getProperty->storage_industrial_facilities = json_decode($getProperty->storage_industrial_facilities);
			$getProperty->parking_details = json_decode($getProperty->parking_details);
			$getProperty->amenities = json_decode($getProperty->amenities);
				return response()->json(['status'=>200,'message' => $message, 'Project' => $getProperty]);
		} catch (\Exception $e) {
			dd($e);
			return response()->json(['status'=>500,'message' =>"error", 'Project' => $e]);
		}
	}
	public function storeFile(UploadedFile $file)
    {
        $path = "file_".time().(string) random_int(0,5).'.'.$file->getClientOriginalExtension();
        $file->storeAs("public/file_image/", $path);
        return $path;
    }
	public function addproject(Request $request){
		$cities = City::orderBy('name')->get();
		$states = State::orderBy('name')->get();
		$areas = Areas::orderBy('name')->get();
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

		return view('admin.projects.add_project_new', compact('cities', 'states', 'areas', 'builders','project_configuration_settings'), $data);
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
}
