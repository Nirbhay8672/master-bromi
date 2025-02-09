<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\City;
use App\Models\District;
use App\Models\MasterProperty\MasterProperty;
use App\Models\MasterProperty\PropertyAreaSize;
use App\Models\MasterProperty\PropertyConstructionType;
use App\Models\MasterProperty\PropertyContactDetail;
use App\Models\MasterProperty\PropertyForType;
use App\Models\MasterProperty\PropertyLandUnit;
use App\Models\MasterProperty\PropertySource;
use App\Models\MasterProperty\PropertyUnitDetail;
use App\Models\MasterProperty\PropertyZone;
use App\Models\Projects;
use App\Models\PropertyConstructionDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MasterPropertyController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.master_properties.index');
    }

    public function dataTable(Request $request)
    {
        $query = MasterProperty::query();

        $query->with([
            'project',
            'city',
            'propertyFor',
            'propertyConstructionType',
            'propertyCategory',
            'propertySubCategory',
            'district',
            'village',
        ]);
        
        $user = Auth::user();

        // check admin or sub user
        if($user->parent_id) {
            $query->where('user_id', $user->id);
        } else {
            $sub_users_ids = User::where('parent_id', $user->parent_id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
        }

        // return datatable
        return DataTables::of($query->get())
            ->editColumn('project_name', function ($row) {
                return $row->category_id != 4 ? $row->project?->project_name : ($row->village?->name ?? '');
            })
            ->editColumn('information', function ($row) {
                return $row->propertyFor->name . " > " . $row->propertyConstructionType->name . " > " . $row->propertyCategory?->name .($row->propertySubCategory ? " > " . $row->propertySubCategory->name : '');
            })
            ->editColumn('city_name', function ($row) {
                return $row->category_id == 4 ? ($row->district?->name ?? '') :  $row->city?->name;
            })
            ->make(true);
    }

    public function addForm()
    {
        $user = Auth::user();
        $is_admin = $user->parent_id ? false : true;
        $user_ids = [];

        if($is_admin) {
            $sub_users_ids = User::where('parent_id', $user->id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
            $user_ids = $sub_users_ids;
        } else {
            $sub_users_ids = User::where('parent_id', $user->parent_id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
            $user_ids = $sub_users_ids;
        }

        $property_for_type = PropertyForType::all();
        $property_construction_type = PropertyConstructionType::with(['category.subCategory'])->get();

        $cities = City::with(['localities'])->whereIn('user_id', $user_ids)->get();
        $projects = Projects::whereIn('user_id', $user_ids)->get();
        $land_units = PropertyLandUnit::all();
        $property_source = PropertySource::all();
        $country_codes = DB::table('countries')->get();

        $districts = District::with(['talukas.villages'])->whereIn('user_id' , $user_ids)->get();
        $property_zone = PropertyZone::all();
        $amenities = Amenity::all(); 

        return view('admin.master_properties.add_form')->with([
            'property_for_type' => $property_for_type,
            'property_construction_type' => $property_construction_type,
            'cities' => $cities,
            'projects' => $projects,
            'land_units' => $land_units,
            'property_source' => $property_source,
            'country_codes' => $country_codes,
            'districts' => $districts,
            'property_zones' => $property_zone,
            'amenities' => $amenities,
        ]);
    }
    
    public function store(Request $request)
    {
        /**
         * @var \Illuminate\Http\Request $transformedRequest
         */
        $transformedRequest = $this->transformRequest($request);

        try {
            DB::beginTransaction();
            $masterProperty = MasterProperty::create($transformedRequest->basic_detail);

            PropertyAreaSize::create(['property_id' => $masterProperty->id,...$transformedRequest->size_area]);

            if(in_array($transformedRequest->basic_detail['category_id'], [1,2,3,5,6,7])){
                foreach ($transformedRequest->unit_details ?? [] as $unit_detail) {
                    $propertyUnitDetail = new PropertyUnitDetail();
                    $propertyUnitDetail->fill(['property_id' => $masterProperty->id,...$unit_detail])->save();
                }
            }

            foreach ($transformedRequest->contact_details ?? [] as $contact_detail) {
                $propertyContactDetail =  new PropertyContactDetail();
                $propertyContactDetail->fill(['property_id' => $masterProperty->id,...$contact_detail])->save();
            }
            if($transformedRequest->has('images')) {
                foreach ($transformedRequest->images as $image) {
                    $masterProperty->addMedia($image)->toMediaCollection('images');
                }
            }

            if($transformedRequest->has('documents')) {
                foreach ($transformedRequest->documents as $document) {
                    $masterProperty->addMedia($document)->toMediaCollection('document');
                }
            }

            if($transformedRequest->has('construction_docs') && count($transformedRequest->construction_docs) > 0) {
                foreach ($transformedRequest->construction_docs as $constructionDocs) {
                    if($constructionDocs['category']){
                        $propertyContactDocument = PropertyConstructionDocument::firstOrCreate([
                            'property_id' => $masterProperty->id,
                            'document_type' => $constructionDocs['category'],
                        ]);

                        $propertyContactDocument->addMedia($constructionDocs['file'])->toMediaCollection('construction-documents');
                    }
                }
            }

            DB::commit();
            return response()->json(['message' => 'Property added successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            throw $th;
        }
    }

    public function transformRequest(Request $request) :Request
    {
        
        $washrooms = [
            'Private Washrooms' => 1,
            'Public Washrooms' => 2,
            'Not Available' => 3,    
        ];

        $priorityType = [
            'High' => 1,
            'Medium' => 2,
            'Low' => 3,
        ];

        $availabilityStatus = [
            'Under Construction' => 0,
            'Available' => 1,
        ];

        $propertyAge = [
            '0-1 Years' => 1,
            '1-5 Years' => 2,
            '5-10 Years' => 3,
            '10+ Years' => 4,
        ];

        $unitavailabilityStatus = [
            'Rent Out' => 1,
            'Sold Out' => 2,
        ];

        $furnishedStatus = [
            'Furnished' => 1,
            'Semi Furnished' => 2,
            'Unfurnished' => 3,
            'Can Furnished' => 4,
        ];

        // project condition start
        $requested_project = $request->basic_detail['selected_project'];

        $project = Projects::where(function ($query) use ($requested_project) {
            $query->where('id', $requested_project)
                    ->orWhere('project_name', $requested_project);
        })
        ->where('user_id', Auth::user()->id)
        ->first();

        $project_id = null;

        if($project == null) {
            $new_project = new Projects();

            $city = City::find($request->basic_detail['selected_city']);
            
            $new_project->fill([
                'project_name' => $requested_project,
                'address' => $request->basic_detail['selected_project'],
                'user_id' => Auth::user()->id,
                'state_id' => $city ? $city->state_id : null,
                'city_id' => $request->basic_detail['selected_city'] ?? null,
                'area_id' => $request->basic_detail['selected_locality'] ?? null,
                'location_link' => $request->basic_detail['location_link'],
                'is_indirectly_store' => 1,
            ])->save();

            $project_id = $new_project->id;
        } else {
            $project_id = $project->id;
        }

        if (in_array($request->basic_detail['property_category'], [1,2])) {
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'city_id' => $request->basic_detail['selected_city'],
                    'area_id' => $request->basic_detail['selected_locality'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    'units_in_project' => $request->other_details['units_in_project'],
                    'no_of_floors' => $request->other_details['number_of_floor'],
                    'units_in_tower' => $request->other_details['units_in_towers'],
                    'units_in_floor' => $request->other_details['units_on_floor'],
                    'no_of_elevators' => $request->other_details['number_of_elevators'],
                    'service_elevator' => $request->other_details['service_elevator'] ? 1 : 0,
                    'hot_property' => $request->other_details['is_hot'] ? 1 : 0,
                    'washroom_type' => $washrooms[$request->other_details['washrooms']] ?? null,
                    'fourwheller_parking' => $request->other_details['four_wheeler_parking'],
                    'twowheller_parking' => $request->other_details['two_wheeler_parking'],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details['source'],
                    'availability_status' => $request->other_details['availability_status'] ? $availabilityStatus[$request->other_details['availability_status']] : null,
                    'property_age' => $propertyAge[$request->other_details['age_of_property']] ?? null,
                    'available_from' => $request->other_details['available_from'],
                    'remark' => $request->other_details['remark'],
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'carpet_area_value' => $request->other_details['saleable_area'],
                    'carpet_area_measurement_id' => $request->other_details['saleable_area_unit'],
                    'ceiling_height_value' => $request->other_details['ceiling_height'],
                    'ceiling_height_measurement_id' => '4' ?? $request->other_details['ceiling_height_unit'],
                    'salable_area_value' => $request->other_details['carpet_area'],
                    'salable_area_measurement_id' => $request->other_details['carpet_area_unit'],
                    'terrace_carpet_area_value' => $request->other_details['terrace_saleable_area'],
                    'terrace_carpet_area_measurement_id' => $request->other_details['terrace_saleable_area_unit'],
                    'terrace_salable_area_value' => $request->other_details['terrace_carpet_area'],
                    'terrace_salable_area_measurement_id' => $request->other_details['terrace_carpet_area_unit'],  
                ], 
                'unit_details' => [],
                'contact_details' => [],
            ];
        }

        if (in_array($request->basic_detail['property_category'], [3])) {
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'city_id' => $request->basic_detail['selected_city'],
                    'area_id' => $request->basic_detail['selected_locality'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    'units_in_project' => $request->other_details['units_in_project'],
                    'hot_property' => $request->other_details['is_hot'] ? 1 : 0,
                    'fourwheller_parking' => $request->other_details['four_wheeler_parking'],
                    'twowheller_parking' => $request->other_details['two_wheeler_parking'],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details['source'],
                    'availability_status' => $request->other_details['availability_status'] ? $availabilityStatus[$request->other_details['availability_status']] : null,
                    'property_age' => $propertyAge[$request->other_details['age_of_property']] ?? null,
                    'available_from' => $request->other_details['available_from'],
                    'other_storage_industrial_detail' => json_encode($request->other_details['other_storage_industrial_detail']),
                    'remark' => $request->other_details['remark'],
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'salable_plot_area_value' => $request->other_details['saleable_plot_area'],
                    'salable_plot_area_measurement_id' => $request->other_details['saleable_plot_area_unit'],
                    'carpet_plot_area_value' => $request->other_details['carpet_plot_area'],
                    'carpet_plot_area_measurement_id' => $request->other_details['carpet_plot_area_unit'],
                    'road_width_of_front_side_value' => $request->other_details['road_width_of_front_side'],
                    'road_width_of_front_side_measurement_id' => $request->other_details['road_width_of_front_side_unit'],
                ], 
                'unit_details' => [],
                'contact_details' => [],
            ];
        }

        if(in_array($request->basic_detail['property_category'], [4])){
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'district_id' => $request->basic_detail['selected_district'],
                    'taluka_id' => $request->basic_detail['selected_taluka'],
                    'village_id' => $request->basic_detail['selected_village'],
                    'zone_id' => $request->basic_detail['selected_zone'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    "no_of_floors_allowed" => $request->other_details['number_of_floors_allowed'],
                    "construction_allowed_for" => $request->other_details['construction_allowed_for'],
                    "fsi_far" => $request->other_details['fsi_far'],
                    'survey_number' => $request->other_details["survey_number"],
                    'survey_plot_size' => $request->other_details["survey_plot_size"],
                    'survey_plot_size_unit' => $request->other_details["survey_plot_size_unit"],
                    'survey_price' => $request->other_details["survey_price"],
                    'tp_number' => $request->other_details["tp_number"],
                    'fp_number' => $request->other_details["fp_number"],
                    'tp_plot_size' => $request->other_details["tp_plot_size"],
                    'tp_plot_size_unit' => $request->other_details["tp_plot_size_unit"],
                    'tp_price' => $request->other_details["tp_price"],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details["source"],
                    'remark' => $request->other_details["remark"],
                    'hot_property' => $request->other_details["is_hot"] ? 1 : 0,
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'road_width_of_front_side_value' => $request->other_details["road_width_of_front_side"],
                    'road_width_of_front_side_measurement_id' => $request->other_details['road_width_of_front_side_unit'],
                    'length_of_plot_value' => $request->other_details["length_of_plot"],
                    'length_of_plot_measurement_id' => $request->other_details["length_of_plot_unit"],
                    'width_of_plot_value' => $request->other_details["width_of_plot"],
                    'width_of_plot_measurement_id' => $request->other_details["width_of_plot_unit"],
                ], 
                'contact_details' => [],
            ];
        }

        if(in_array($request->basic_detail['property_category'], [5])){
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'city_id' => $request->basic_detail['selected_city'],
                    'area_id' => $request->basic_detail['selected_locality'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    'units_in_project' => $request->other_details['units_in_project'],
                    'no_of_floors' => $request->other_details['number_of_floor'],
                    'units_in_tower' => $request->other_details['units_in_towers'],
                    'units_in_floor' => $request->other_details['units_on_floor'],
                    'no_of_elevators' => $request->other_details['number_of_elevators'],
                    'service_elevator' => $request->other_details['service_elevator'] ? 1 : 0,
                    'hot_property' => $request->other_details['is_hot'] ? 1 : 0,   
                    'servent_room' => $request->other_details['servent_room'] ? 1 : 0,
                    'fourwheller_parking' => $request->other_details['four_wheeler_parking'],
                    'twowheller_parking' => $request->other_details['two_wheeler_parking'],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details['source'],
                    'availability_status' => $request->other_details['availability_status'] ? $availabilityStatus[$request->other_details['availability_status']] : null,
                    'property_age' => $propertyAge[$request->other_details['age_of_property']] ?? null,
                    'available_from' => $request->other_details['available_from'],
                    'remark' => $request->other_details['remark'],
                    'is_have_amenities' => $request->other_details['is_have_amenities'] ? ($request->other_details['is_have_amenities'] == 'true' ? true : false) : false,

                    'amenities' => $request->other_details['amenities'],
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'carpet_area_value' => $request->other_details['saleable_area'],
                    'carpet_area_measurement_id' => $request->other_details['saleable_area_unit'],
                    'builtup_height_value' => $request->other_details['builtup_area'],
                    'builtup_height_measurement_id' => $request->other_details['builtup_area_unit'],
                    'salable_area_value' => $request->other_details['carpet_area'],
                    'salable_area_measurement_id' => $request->other_details['carpet_area_unit'],
                    'terrace_carpet_area_value' => $request->other_details['terrace_saleable_area'],
                    'terrace_carpet_area_measurement_id' => $request->other_details['terrace_saleable_area_unit'],
                    'terrace_salable_area_value' => $request->other_details['terrace_carpet_area'],
                    'terrace_salable_area_measurement_id' => $request->other_details['terrace_carpet_area_unit'],  
                ], 
                'unit_details' => [],
                'contact_details' => [],
            ];
        }

        if(in_array($request->basic_detail['property_category'], [6])){
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'city_id' => $request->basic_detail['selected_city'],
                    'area_id' => $request->basic_detail['selected_locality'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    'no_of_balcony' => $request->other_details['number_of_balcony'],
                    'no_of_units' => $request->other_details['number_of_units'],
                    'no_of_bathroom' => $request->other_details['number_of_bathrooms'],
                    'no_of_open_side' => $request->other_details['number_of_open_side'],
                    'weekend' => $request->other_details['weekend'] ? 1 : 0,
                    'hot_property' => $request->other_details['is_hot'] ? 1 : 0,   
                    'servent_room' => $request->other_details['servent_room'] ? 1 : 0,
                    'fourwheller_parking' => $request->other_details['four_wheeler_parking'],
                    'twowheller_parking' => $request->other_details['two_wheeler_parking'],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details['source'],
                    'availability_status' => $request->other_details['availability_status'] ? $availabilityStatus[$request->other_details['availability_status']] : null,
                    'property_age' => $propertyAge[$request->other_details['age_of_property']] ?? null,
                    'available_from' => $request->other_details['available_from'],
                    'remark' => $request->other_details['remark'],
                    'is_have_amenities' => $request->other_details['is_have_amenities'] ? ($request->other_details['is_have_amenities'] == 'true' ? true : false) : false,
                    'amenities' => $request->other_details['amenities'],
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'salable_plot_area_value' => $request->other_details['saleable_plot_area'],
                    'salable_plot_area_measurement_id' => $request->other_details['saleable_plot_area_unit'],
                    'salable_constructed_area_value' => $request->other_details['saleable_constructed_area'],
                    'salable_constructed_area_measurement_id' => $request->other_details['saleable_constructed_area_unit'],
                    'carpet_plot_area_value' => $request->other_details['carpet_plot_area'],
                    'carpet_plot_area_measurement_id' => $request->other_details['carpet_plot_area_unit'],
                    'constructed_carpet_area_value' => $request->other_details['constructed_carpet_area'],
                    'constructed_carpet_area_measurement_id' => $request->other_details['constructed_carpet_area_unit'],
                    'constructed_builtup_area_value' => $request->other_details['constructed_builtup_area'],
                    'constructed_builtup_area_measurement_id' => $request->other_details['constructed_builtup_area_unit'],
                ], 
                'unit_details' => [],
                'contact_details' => [],
            ];
        }

        if(in_array($request->basic_detail['property_category'], [7])){
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'city_id' => $request->basic_detail['selected_city'],
                    'area_id' => $request->basic_detail['selected_locality'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    
                    'units_in_project' => $request->other_details['units_in_project'],
                    'no_of_floors' => $request->other_details['number_of_floor'],
                    'units_in_tower' => $request->other_details['units_in_towers'],
                    'units_in_floor' => $request->other_details['units_on_floor'],
                    'no_of_elevators' => $request->other_details['number_of_elevators'],
                    'no_of_balcony' => $request->other_details['number_of_balcony'],
                    'no_of_bathroom' => $request->other_details['number_of_bathrooms'],

                    'service_elevator' => $request->other_details['service_elevator'] ? 1 : 0,
                    'servent_room' => $request->other_details['servent_room'] ? 1 : 0,
                    'hot_property' => $request->other_details['is_hot'] ? 1 : 0,

                    'fourwheller_parking' => $request->other_details['four_wheeler_parking'],
                    'twowheller_parking' => $request->other_details['two_wheeler_parking'],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details['source'],
                    'availability_status' => $request->other_details['availability_status'] ? $availabilityStatus[$request->other_details['availability_status']] : null,
                    'property_age' => $propertyAge[$request->other_details['age_of_property']] ?? null,
                    'available_from' => $request->other_details['available_from'],
                    'remark' => $request->other_details['remark'],
                    'is_have_amenities' => $request->other_details['is_have_amenities'] ? ($request->other_details['is_have_amenities'] == 'true' ? true : false) : false,

                    'amenities' => $request->other_details['amenities'],
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'built_area_value' => $request->other_details['built_area'],
                    'built_area_measurement_id' => $request->other_details['built_area_unit'],
                    'carpet_area_value' => $request->other_details['carpet_area'] ,
                    'carpet_area_measurement_id' => $request->other_details['carpet_area_unit'],
                    'salable_area_value' => $request->other_details['saleable_area'],
                    'salable_area_measurement_id' => $request->other_details['saleable_area_unit'] ,
                    'terrace_carpet_area_value' => $request->other_details['terrace_saleable_area'],
                    'terrace_carpet_area_measurement_id' => $request->other_details['terrace_saleable_area_unit'],
                    'terrace_salable_area_value' => $request->other_details['terrace_carpet_area'],
                    'terrace_salable_area_measurement_id' => $request->other_details['terrace_carpet_area_unit'],  
                ], 
                'unit_details' => [],
                'contact_details' => [],
            ];
        }

        if(in_array($request->basic_detail['property_category'], [8])){
            $transformed_request_array = [
                'basic_detail' => [
                    'project_id' => $project_id,
                    'property_for' => $request->basic_detail['property_for'],
                    'property_contruction_type_id' => $request->basic_detail['property_construction_type'],
                    'category_id' => $request->basic_detail['property_category'],
                    'sub_category_id' => $request->basic_detail['property_sub_category'],
                    'city_id' => $request->basic_detail['selected_city'],
                    'taluka_id' => $request->basic_detail['selected_taluka'],
                    'area_id' => $request->basic_detail['selected_locality'],
                    'zone_id' => $request->basic_detail['selected_zone'],
                    'address' => $request->basic_detail['address'],
                    'location_link' => $request->basic_detail['location_link'],
                    'no_of_units' => $request->other_details['number_of_units'],
                    "no_of_floors_allowed" => $request->other_details['number_of_floors_allowed'],
                    'no_of_open_side' => $request->other_details['number_of_open_side'],
                    'priority_type' => $priorityType[$request->other_details['priority']] ?? null,
                    'source' => $request->other_details["source"],
                    'remark' => $request->other_details["remark"],
                    'hot_property' => $request->other_details["is_hot"] ? 1 : 0,
                    'user_id' => auth()->user()->id,
                    'parent_id' => auth()->user()->parent_id,
                ],
                'size_area' => [
                    'salable_area_value' => $request->other_details['saleable_area'],
                    'salable_area_measurement_id' => $request->other_details['saleable_area_unit'],
                    'length_of_plot_value' => $request->other_details["length_of_plot"],
                    'length_of_plot_measurement_id' => $request->other_details["length_of_plot_unit"],
                    'width_of_plot_value' => $request->other_details["width_of_plot"],
                    'width_of_plot_measurement_id' => $request->other_details["width_of_plot_unit"],
                    'carpet_plot_area_value' => $request->other_details['carpet_plot_area'],
                    'carpet_plot_area_measurement_id' => $request->other_details['carpet_plot_area_unit'],
                ], 
                'contact_details' => [],
            ];
        }

        if(in_array($request->basic_detail['property_category'], [1,2,3,5,6,7])){
            foreach ($request->unit_details ?? [] as $key => $value) {
                $transformed_request_array['unit_details'][] = [
                    'wing' => $value['wing'] ?? null,
                    'unit_no' => $value['unit_number'] ?? 0, 
                    'availability_status' => $unitavailabilityStatus[$value['available']] ?? 0,
                    'price_rent' => $value['price_rent'] ?? null,
                    'furniture_status' => $value['furnished_status'] ?? null,
                    'price' => $value['price'] ?? null,
                    'plot_price' => $value['plot_price'] ?? null,
                    'construction_price' => $value['construction_price'] ?? null,
                    'terrace_price' => $value['terrace_price'] ?? null,
                    'flat_price' => $value['flat_price'] ?? null,
                    "no_of_seats" => $value['no_of_seats'] ?? null,
                    "no_of_cabins" => $value['no_of_cabins'] ?? null,
                    "no_of_conference_room" => $value['no_of_conference_room'] ?? null,
                    'furniture_total' => $value['furniture_total'] ?? null,
                    'facilities' => $value['facilities'] ?? null,
                    'remark' => $value['remark'] ?? null,
                ];
            }
        }

        foreach ($request->other_contact_details ?? [] as $contact_detail) {
            $transformed_request_array['contact_details'][] = [
                'name' =>  $contact_detail["name"],
                'contact_no' => $contact_detail["contact"],
                'country_code' => $contact_detail["contact_code"] ?? '+91',
                "position" => $contact_detail["position"],
            ];
        }

        $transformedRequest = new Request($transformed_request_array);

        $transformedRequest->merge(['images' => $request->file('images') ?? []]);
        $transformedRequest->merge(['documents' => $request->file('documents') ?? []]);

        if(in_array($request->basic_detail['property_category'], [4])){
            $transformedRequest->merge(['construction_docs' => $request->other_details['construction_docs'] ?? []]);
        }

        return $transformedRequest; 
    }

    public function updateForm(MasterProperty $masterProperty)
    {
        $user = Auth::user();
        $is_admin = $user->parent_id ? false : true;
        $user_ids = [];

        if($is_admin) {
            $sub_users_ids = User::where('parent_id', $user->id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
            $user_ids = $sub_users_ids;
        } else {
            $sub_users_ids = User::where('parent_id', $user->parent_id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
            $user_ids = $sub_users_ids;
        }

        $property_for_type = PropertyForType::all();
        $property_construction_type = PropertyConstructionType::with(['category.subCategory'])->get();

        $cities = City::with(['localities'])->whereIn('user_id', $user_ids)->get();
        $projects = Projects::whereIn('user_id', $user_ids)->get();
        $land_units = PropertyLandUnit::all();
        $property_source = PropertySource::all();
        $country_codes = DB::table('countries')->get();

        $districts = District::with(['talukas.villages'])->whereIn('user_id' , $user_ids)->get();
        $property_zone = PropertyZone::all();
        $amenities = Amenity::all(); 

        return view('admin.master_properties.edit_form')->with([
            'property_for_type' => $property_for_type,
            'property_construction_type' => $property_construction_type,
            'cities' => $cities,
            'projects' => $projects,
            'land_units' => $land_units,
            'property_source' => $property_source,
            'country_codes' => $country_codes,
            'districts' => $districts,
            'property_zones' => $property_zone,
            'amenities' => $amenities,
            'property_master' => $masterProperty,
        ]);
    }
}
