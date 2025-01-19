@php
    $type = isset($dropdowns[$property->property_category]['name']) ? $dropdowns[$property->property_category]['name'] : '';
@endphp
<?php
    use App\Traits\HelperFn;
use Illuminate\Support\Facades\DB;
    $units=DB::table('land_units')->get();
    
    $salableArray=explode("_-||-_",$property->salable_area);
    $land_units=$units->where('id',$salableArray[1])->first();
    
    $surveyUnitArray=explode("_-||-_",$property->survey_plot_size);
    $survey_units=$units->where('id',$surveyUnitArray[1])->first();
    
    $fpUnitArray=explode("_-||-_",$property->fp_plot_size);
    $fp_units=$units->where('id',$fpUnitArray[1])->first();
    
    $carpetArray=explode("_-||-_",$property->carpet_area);
    $carpet_units=$units->where('id',$carpetArray[1])->first();
    
    $carpet_plotArray=explode("_-||-_",$property->carpet_plot_area);
    $carpet_plot_units=$units->where('id',$carpet_plotArray[1])->first();
 
    $salable_plotArray=explode("_-||-_",$property->salable_plot_area);
    $salable_plot_units=$units->where('id',$salable_plotArray[1])->first();
    
    $constructed_salableArray=explode("_-||-_",$property->constructed_salable_area);
    $constructed_salable_units=$units->where('id',$constructed_salableArray[1])->first();
    
    $constructed_carpetArray=explode("_-||-_",$property->constructed_carpet_area);
    $constructed_carpet_units=$units->where('id',$constructed_carpetArray[1])->first();
    
    $constructed_builtupArray=explode("_-||-_",$property->constructed_builtup_area);
    $constructed_builtup_units=$units->where('id',$constructed_builtupArray[1])->first();
    
    $builtupArray=explode("_-||-_",$property->builtup_area);
    $builtup_units=$units->where('id',$builtupArray[1])->first();
    
    $terrace_carpetArray=explode("_-||-_",$property->terrace_carpet_area);
    $terrace_carpet_units=$units->where('id',$terrace_carpetArray[1])->first();
    
    $terrace_salableArray=explode("_-||-_",$property->terrace_salable_area);
    $terrace_salable_units=$units->where('id',$terrace_salableArray[1])->first();

    if($shared != null){
            $shareProperty=[];
        foreach ($shared as $key => $value) {
            $user=App\Models\User::find($value->partner_id);
            
            $shareProperty[]=[
                'name'=>$user->first_name." ".$user->middle_name." ".$user->last_name,
                'contact'=>$user->mobile_number,
                'position'=>$user->position,
        ];
        }
    }

?>
@extends('admin.layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Details of Property</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row px-3">
                                <div class="col-sm-12">
                                    <ul class="nav nav-pills sticky-nav-menu-tab mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1 active" id="v-view-summary-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-view-summary" type="button"
                                                role="tab" aria-controls="v-view-summary"
                                                aria-selected="true">Summary</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1" id="v-property-information-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-property-information"
                                                type="button" role="tab" aria-controls="v-property-information"
                                                aria-selected="true">Information</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1" id="v-property-price-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-property-price" type="button" role="tab"
                                                aria-controls="v-property-price" aria-selected="true">Unit And
                                                Price</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1" id="v-property-owner-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-property-owner" type="button" role="tab"
                                                aria-controls="v-property-owner" aria-selected="true">Contact
                                                Details</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1" id="v-enquiry-matching-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-enquiry-matching" type="button" role="tab"
                                                aria-controls="v-enquiry-matching" aria-selected="false">Matching
                                                Enquiry</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1" id="v-property-viewer-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-property-viewer" type="button" role="tab"
                                                aria-controls="v-property-viewer" aria-selected="false">Enquiry Visits
                                                Logs</button>
                                        </li>
                                        @if (count($shareProperty) != 0)  
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link mx-1" id="v-property-share-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-property-share" type="button" role="tab"
                                                aria-controls="v-property-share" aria-selected="false">Shared property </button>
                                        </li>
                                        @endif
                                        <div class="row" style="display: contents;">
                                            <div class="col-md-1">
                                                <a href={{ URL::to('admin/Properties') }}>
                                                    <button class="nav-link mx-1 active"
                                                        id="v-view-summary-tab">Back</button>
                                                </a>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="{{ URL::to('admin/property/edit/' . $property['id']) }}">
                                                    <button class="nav-link mx-1 active"
                                                        id="v-view-summary-tab">Edit</button>
                                                </a>
                                            </div>
                                        </div>
                                    </ul>
									<form action="{{route('admin.updatePropertyStatus')}}" class="row row-cols g-1" method="get">
                                        @csrf
                                        @method('post')
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <input type="text" hidden value="{{$property['id']}}" name="id">
                                            <select class="form-select" id="enquiry_progress_status" name="status">
                                                <option value="">Property Progress</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12" style="margin-left: 10px;">
                                            <button class="btn btn-primary" style="border-radius:5px;" type="submit">Update</button>
                                        </div>
                                    </form>

                                    <div class="tab-content mt-3" id="top-tabContent">
                                        <div class="tab-pane fade show active" id="v-view-summary" role="tabpanel"
                                            aria-labelledby="v-view-summary-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Information</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_1">
                                                            <h6><b>Property For</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_1">
                                                            <div>:
                                                                {{ $property->property_for ? ucfirst(strtolower($property->property_for)) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_2">
                                                            <h6><b>Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_2">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->property_type]['name']) ? ucfirst(strtolower($dropdowns[$property->property_type]['name'])) : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_3">
                                                            <h6><b>Category</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_3">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->property_category]['name']) ? $dropdowns[$property->property_category]['name'] : '' }}
                                                            </div>
                                                        </div>
														@if (!empty($configuration_name))

														<div class="form-group col-4 m-b-10 data_conent_3">
															<h6><b>Sub Category</b></h6>
														</div>

														<div class="form-group col-8 m-b-10 data_conent_3">
															<div>:
																{{ $configuration_name != null ? $configuration_name : '' }}
															</div>
														</div>
														@endif
                                                        <div class="form-group col-4 m-b-10 data_conent_4">
                                                            <h6><b>Project</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_4">
                                                            <div>:
                                                                @if ($property->Projects != null)
                                                                    <a href="{{ route('admin.projects', ['id' => $property->Projects->id]) }}">
                                                                        {{ ucfirst(strtolower($property->Projects->project_name)) }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- <div class="form-group col-4 m-b-10 data_conent_4">
                                                            <h6><b>Project</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_4">
                                                            <div>:
                                                                {{ $property->Projects != null ? ucfirst(strtolower($property->Projects->project_name)) : '' }}
                                                            </div>
                                                        </div> --}}
														{{-- <div class="form-group col-4 m-b-10 data_conent_5">
                                                            <h6><b>Property Address</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_5">
                                                            <div>:
                                                                {{ isset($property->address) ? ucfirst(strtolower($property->address)) : '-' }}
                                                            </div>
                                                        </div> --}}
                                                        @if (!empty($property->projects->area->city->name))
                                                        <div class="form-group col-4 m-b-10 data_conent_6">
                                                            <h6><b>City</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_6">
                                                            <div>:
                                                                {{ isset($property->projects->area->city->name) ? ucfirst(strtolower($property->projects->area->city->name)) : '-' }}
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if (!empty($property->projects->area->name))
                                                            <div class="form-group col-4 m-b-10 data_conent_6">
                                                                <h6><b>Locality</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_6">
                                                                <div>:
                                                                    {{ isset($property->projects->area->name) ? ucfirst(strtolower($property->projects->area->name)) : '-' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if (!empty($property->Projects->address))
                                                            <div class="form-group col-4 m-b-10 data_conent_5">
                                                                <h6><b>Projects Address</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_5">
                                                                <div>:
                                                                    {{ isset($property->Projects->address) ? ucfirst(strtolower($property->Projects->address)) : '-' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($type == 'Office' || $type == 'Retail' || $type == 'Flat' || $type == 'Penthouse')
                                                            @if($carpetArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_53">
                                                                    <h6><b>Carpet Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_53">
                                                                    <div>:{{$carpetArray[0]}} {{ $carpet_units->unit_name}}</div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if ($type == 'Office' || $type == 'Retail' || $type == 'Flat' || $type == 'Plot' || $type == 'Penthouse')
                                                            @if($salableArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_54">
                                                                    <h6><b>Salable Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_54">:
                                                                {{$salableArray[0]}} {{ $land_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Plot' || $type == 'Farmhouse')
                                                            @if($carpet_plotArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_55">
                                                                    <h6><b>Carpet Plot Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_55">:
                                                                    {{$carpet_plotArray[0]}} {{ $carpet_plot_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($salable_plotArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_56">
                                                                    <h6><b>Salable Plot Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_56">:
                                                                    {{$salable_plotArray[0]}} {{ $salable_plot_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($constructed_salableArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_57">
                                                                    <h6><b>Constructed Salable Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_57">:
                                                                    {{$constructed_salableArray[0]}} {{ $constructed_salable_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($constructed_carpetArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_58">
                                                                    <h6><b>Constructed Carpet Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_58">:
                                                                    {{$constructed_carpetArray[0]}} {{ $constructed_carpet_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($builtupArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_59">
                                                                    <h6><b>Constructed Builtup Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_59">:
                                                                    {{$constructed_builtupArray[0]}} {{ $constructed_builtup_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Penthouse' || $type == 'Flat')
                                                            @if($builtupArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_60">
                                                                    <h6><b>Builtup Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_60">:
                                                                    {{$builtupArray[0]}}   {{$builtup_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if ($type == 'Penthouse' || ($type == 'Flat' && $property->is_terrace != 0))
                                                            @if($terrace_carpetArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_61">
                                                                    <h6><b>Terrace Carpet Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_61">:
                                                                    {{$terrace_carpetArray[0]}} {{ $terrace_carpet_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Penthouse' || ($type == 'Flat' && $property->is_terrace != 0))
                                                            @if($terrace_salableArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_62">
                                                                    <h6><b>Terrace Salable Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_62">:
                                                                    {{$terrace_salableArray[0]}} {{ $terrace_salable_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Farmhouse' || $type == 'Land')
                                                            <div class="form-group col-4 m-b-10 data_conent_6">
                                                                <h6><b>District</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_6">
                                                                <div>:
                                                                    {{ isset($property->District->name) ? ucfirst(strtolower($property->District->name)) : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_7">
                                                                <h6><b>Taluka</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_7">
                                                                <div>:
                                                                    {{ isset($property->Taluka->name) ? ucfirst(strtolower($property->Taluka->name)) : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_8">
                                                                <h6><b>Village</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_8">
                                                                <div>:
                                                                    {{ isset($property->Village->name) ? ucfirst(strtolower($property->Village->name)) : '-' }}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_9">
                                                                <h6><b>Zone</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_9">
                                                                <div>:
                                                                    {{ isset($dropdowns[$property->zone_id]['name']) ? ucfirst(strtolower($dropdowns[$property->zone_id]['name'])) : '' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                       
                                                       
                                                        @if ($type == 'Storage/industrial')
                                                            <div class="form-group col-4 m-b-10 data_conent_10">
                                                                <h6><b>Centre Height</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_10">

                                                                <div>:
                                                                    @if (
                                                                        !empty(explode('_-||-_', $property->storage_centre_height)[0]) &&
                                                                            !empty(explode('_-||-_', $property->storage_centre_height)[1]))
                                                                        {{ explode('_-||-_', $property->storage_centre_height)[0] . ' ' . explode('_-||-_', $property->storage_centre_height)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Plot' || $type == 'Land')
                                                            <div class="form-group col-4 m-b-10 data_conent_11">
                                                                <h6><b>Length of Plot</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_11">
                                                                {{-- @dd((explode('_-||-_',$property->length_of_plot)[1])); --}}
                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->length_of_plot)[0]) && !empty(explode('_-||-_', $property->length_of_plot)[1]))
                                                                        {{ explode('_-||-_', $property->length_of_plot)[0] . ' ' . explode('_-||-_', $property->length_of_plot)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_12">
                                                                <h6><b>Width of Plot</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_12">

                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->width_of_plot)[0]) && !empty(explode('_-||-_', $property->width_of_plot)[1]))
                                                                        {{ explode('_-||-_', $property->width_of_plot)[0] . ' ' . explode('_-||-_', $property->width_of_plot)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Retail' || $type == 'Penthouse' || $type == 'Office' || $type == 'Flat')
                                                            <div class="form-group col-4 m-b-10 data_conent_13">
                                                                <h6><b>Entrance Width</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_13">
                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->entrance_width)[0]) && !empty(explode('_-||-_', $property->entrance_width)[1]))
                                                                        {{ explode('_-||-_', $property->entrance_width)[0] . ' ' . explode('_-||-_', $property->entrance_width)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_14">
                                                                <h6><b>Ceilling Height</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_14">

                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->ceiling_height)[0]) && !empty(explode('_-||-_', $property->ceiling_height)[1]))
                                                                        {{ explode('_-||-_', $property->ceiling_height)[0] . ' ' . explode('_-||-_', $property->ceiling_height)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if (
                                                            $type == 'Flat' ||
                                                                $type == 'Vila/Bunglow' ||
                                                                $type == 'Plot' ||
                                                                $type == 'Penthouse' ||
                                                                $type == 'Farmhouse' ||
                                                                $type == 'Office' ||
                                                                $type == 'Retail' ||
                                                                $type == 'Storage/industrial' ||
                                                                $type == 'Land')
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_15">
                                                                    <h6><b>Total Units in project</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_15">
                                                                    <div>:
                                                                        {{ $property->total_units_in_project ? $property->total_units_in_project : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_16">
                                                                    <h6><b>Total no. of floor</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_16">
                                                                    <div>:
                                                                        {{ $property->total_no_of_floor ? $property->total_no_of_floor : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_17">
                                                                    <h6><b>Total Units in tower</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_17">
                                                                    <div>:
                                                                        {{ $property->total_units_in_tower ? $property->total_units_in_tower : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office')
                                                                <div class="form-group col-4 m-b-10 data_conent_18">
                                                                    <h6><b>Property On Floor</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_18">
                                                                    <div>:
                                                                        {{ $property->property_on_floors ? $property->property_on_floors : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_19">
                                                                    <h6><b>No Of Elavators</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_19">
                                                                    <div>:
                                                                        {{ $property->no_of_elavators ? $property->no_of_elavators : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Vila/Bunglow' || $type == 'PenthHouse' || $type == 'Farmhouse')
                                                                <div class="form-group col-4 m-b-10 data_conent_20">
                                                                    <h6><b>No Of Balcony</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_20">
                                                                    <div>:
                                                                        {{ $property->no_of_balcony ? $property->no_of_balcony : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Vila/Bunglow' || $type == 'Plot' || $type == 'Farmhouse')
                                                                <div class="form-group col-4 m-b-10 data_conent_21">
                                                                    <h6><b>Total No. of units</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_21">
                                                                    <div>:
                                                                        {{ $property->total_no_of_units ? $property->total_no_of_units : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
															@if (!empty($property->remarks))
                                                            <div class="form-group col-4 m-b-10 data_conent_33">
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_33">
                                                                <div>:
                                                                    {{ $property->remarks ? ucfirst(strtolower($property->remarks)) : $property->remarks }}
                                                                </div>
                                                            </div>
                                                        	@endif
                                                            @if ($type == 'Farmhouse' || $type == 'Vila/Bunglow')
                                                                <div class="form-group col-4 m-b-10 data_conent_22">
                                                                    <h6><b>No. of room</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_22">
                                                                    <div>:
                                                                        {{ $property->no_of_room ? $property->no_of_room : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'PenthHouse' || $type == 'Farmhouse')
                                                                <div class="form-group col-4 m-b-10 data_conent_23">
                                                                    <h6><b>No Of Bathrooms</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_23">
                                                                    <div>:
                                                                        {{ $property->no_of_bathrooms ? ucfirst(strtolower($property->no_of_bathrooms)) : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Plot' || $type == 'Land')
                                                                <div class="form-group col-4 m-b-10 data_conent_24">
                                                                    <h6><b>No Of Floors Allowed</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_24">
                                                                    <div>:
                                                                        {{ $property->no_of_floors_allowed ? $property->no_of_floors_allowed : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Farmhouse' || $type == 'Plot' || $type == 'Vila/Bunglow')
                                                                <div class="form-group col-4 m-b-10 data_conent_25">
                                                                    <h6><b>No Of Side Open</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_25">
                                                                    <div>:
                                                                        {{ $property->no_of_side_open ? $property->no_of_side_open : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Retail' || $type == 'Office')
                                                            <div class="form-group col-4 m-b-10 data_conent_26">
                                                                <h6><b>Washroom Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_26">
                                                                <div>:
                                                                    @if ($property->washrooms2_type == '1')
                                                                        {{ 'Private Washroom' }}
                                                                    @elseif($property->washrooms2_type == '2')
                                                                        {{ 'Public Washroom' }}
                                                                    @elseif($property->washrooms2_type == '3')
                                                                        {{ 'Not Available' }}
                                                                    @else
                                                                        {{ '-' }}
                                                                    @endif
                                                                    {{-- {{ $property->washrooms2_type ? $property->washrooms2_type : '-' }} --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Land' || $type == 'Storage/industrial')
                                                            <div class="form-group col-4 m-b-10 data_conent_27">
                                                                <h6><b>Road width of front side</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_27">

                                                                <div>:
                                                                    @if (
                                                                        !empty(explode('_-||-_', $property->front_road_width)[0]) &&
                                                                            !empty(explode('_-||-_', $property->front_road_width)[1]))
                                                                        {{ explode('_-||-_', $property->front_road_width)[0] . ' ' . explode('_-||-_', $property->front_road_width)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Land')
                                                            @if (!empty($property->construction_allowed_for))
                                                                <div class="form-group col-4 m-b-10 data_conent_106">
                                                                    <h6><b>Construction Allowed For</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_106">
                                                                    <div>:
                                                                        {{ $property->construction_allowed_for ? $property->construction_allowed_for : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (!empty($property->construction_documents))
                                                                <div class="form-group col-4 m-b-10 data_conent_106">
                                                                    <h6><b>Construction Documents</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_106">
                                                                    <div>:
                                                                        {{ $property->construction_documents ? $property->construction_documents : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (!empty($property->fsi))
                                                                <div class="form-group col-4 m-b-10 data_conent_107">
                                                                    <h6><b>FSI</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_107">
                                                                    <div>:
                                                                        {{ $property->fsi ? $property->fsi : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (!empty($property->no_of_borewell))
                                                                <div class="form-group col-4 m-b-10 data_conent_108">
                                                                    <h6><b>No. of borewell</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_108">
                                                                    <div>:
                                                                        {{ $property->no_of_borewell ? $property->no_of_borewell : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse')
                                                            <div class="form-group col-4 m-b-10 data_conent_31">
                                                                <h6><b>Availability Status</b></h6>

                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_31">
                                                                <div>:
                                                                    {{-- {{ $property->availability_status ? $property->availability_status : '-' }} --}}
                                                                    @if ($property->availability_status == '1')
                                                                        {{ 'Available' }}
                                                                    @elseif ($property->availability_status == '0')
                                                                        {{ 'Under Construction' }}
                                                                    @else
                                                                        {{ '-' }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="form-group col-4 m-b-10 data_conent_32">
                                                            <h6><b>Age of property</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_32">
                                                            <div>:
                                                                @if ($property->propertyage == '1')
                                                                    {{ '0-1 Years' }}
                                                                @elseif ($property->propertyage == '2')
                                                                    {{ '1-5 Years' }}
                                                                @elseif ($property->propertyage == '3')
                                                                    {{ '5-10 Years' }}
                                                                @elseif ($property->propertyage == '4')
                                                                    {{ '10+ Years' }}
                                                                @else
                                                                    {{ '-' }}
                                                                @endif
                                                                {{-- {{ $property->propertyage ? $property->propertyage : '-' }} --}}
                                                            </div>
                                                        </div>
                                                        @if (!empty($property->available_from))
                                                            <div class="form-group col-4 m-b-10 data_conent_33">
                                                                <h6><b>Available From</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_33">
                                                                <div>:
                                                                    {{ $property->available_from ? ucfirst(strtolower($property->available_from)) : '-' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        {{-- @if ($type == 'Storage/industrial' && !empty($property->other_industrial_fields) && !empty(json_decode($property->other_industrial_fields)[3]) && !empty(json_decode($property->other_industrial_fields)[0]))
                                                            @foreach (json_decode($property->other_industrial_fields)[3] as $key => $value)
                                                                <div class="form-group col-4 m-b-10 ">
                                                                    <h6><b>{{ $value }}</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 ">
                                                                    <div>:
                                                                        {{ json_decode($property->other_industrial_fields)[0][$key]  ? 'Yes' : 'No' }}
																		@if (!empty(json_decode($property->other_industrial_fields)[1][$key]))
																			({{ json_decode($property->other_industrial_fields)[1][$key] }})
																		@endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif --}}

                                                        @if ($type == 'Storage/industrial' && !empty($property->other_industrial_fields) && !empty(json_decode($property->other_industrial_fields)[3]) && !empty(json_decode($property->other_industrial_fields)[0]))
                                                            @foreach (json_decode($property->other_industrial_fields)[3] as $key => $value)
                                                                @if (!empty($value) && !empty(json_decode($property->other_industrial_fields)[0][$key]))
                                                                    <div class="form-group col-4 m-b-10">
                                                                        <h6><b>{{ $value }}</b></h6>
                                                                    </div>
                                                                    <div class="form-group col-8 m-b-10">
                                                                        <div>:
                                                                            {{ json_decode($property->other_industrial_fields)[0][$key] ? 'Yes' : 'No' }}
                                                                            @if (!empty(json_decode($property->other_industrial_fields)[1][$key]))
                                                                                ({{ json_decode($property->other_industrial_fields)[1][$key] }})
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        @if ($type == 'Retail')
                                                            <div class="form-group col-4 m-b-10 data_conent_43">
                                                                <h6><b>Two Road Corner</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_43">
                                                                <div>: {{ $property->two_road_corner ? 'Yes' : 'No' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($type == 'Land')
                                                            {{-- <div class="form-group col-4 m-b-10 data_conent_44">
                                                                <h6><b>Survey Number</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_44">
                                                                <div>:
                                                                    {{ $property->survey_number ? $property->survey_number : '-' }}
                                                                </div>
                                                            </div> --}}

                                                            <div class="form-group col-4 m-b-10 data_conent_45">
                                                                <h6><b>Survey Plot size</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_45">
                                                                <div>: {{$surveyUnitArray[0]}} {{ $survey_units->unit_name}}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_49">
                                                                <h6><b>Fp Plot size</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_49">
                                                                <div>: {{$fpUnitArray[0]}} {{ $fp_units->unit_name}}</div>
                                                            </div>

                                                            {{-- <div class="form-group col-4 m-b-10 data_conent_50">
                                                                <h6><b>Price</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_50">
                                                                <div>:
                                                                    {{ $property->fp_plot_price ? $property->fp_plot_price : '-' }}
                                                                </div>
                                                            </div> --}}
                                                        @endif

                                                        @if ($type == 'Flat' || $type == 'Penthouse' || $type == 'Office' || $type == 'Retail')
                                                            <div class="form-group col-4 m-b-10 data_conent_51">
                                                                <h6><b>Service Elavator</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_51">
                                                                <div>: {{ $property->service_elavator ? 'Yes' : 'No' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse')
                                                            <div class="form-group col-4 m-b-10 data_conent_52">
                                                                <h6><b>Servant Room</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_52">
                                                                <div>: {{ $property->servant_room ? 'Yes' : 'No' }}</div>
                                                            </div>
                                                        @endif


                                                        <div class="form-group col-4 m-b-10 data_conent_63">
                                                            <h6><b>Hot Property</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_63">
                                                            <div>: {{ $property->hot_property ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                        {{-- <div class="form-group col-4 m-b-10 data_conent_64">
                                                            <h6><b>Favourite</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_64">
                                                            <div>: {{ $property->is_favourite ? 'Yes' : 'No' }}</div>
                                                        </div> --}}
                                                    </div>

                                                    {{-- @if ($type !== 'Plot' && $type !== 'Land' && $type !== 'Storage/industrial')
                                                        <div class="row mt-1">
                                                            <div class="form-group col-md-12">
                                                                <h5 class="border-style">Care Taker Information</h5>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_70">
                                                                <h6><b>Care Taker Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_70">
                                                                <div>
                                                                    {{ $property->care_taker_name ? $property->care_taker_name : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_71">
                                                                <h6><b>Care Taker Number</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_71">
                                                                <div>
                                                                    {{ $property->care_taker_contact ? $property->care_taker_contact : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_72">
                                                                <h6><b>Key Available At</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_72">
                                                                <div>
                                                                    {{ $property->key_available_at ? $property->key_available_at : '-' }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif --}}
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Owner Information</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_65">
                                                            <h6 for="Client Name"><b>Owner</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_65">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->owner_is]['name']) ? ucfirst(strtolower($dropdowns[$property->owner_is]['name'])) : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_66">
                                                            <h6><b>Name</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_66">
                                                            <div>:
                                                                {{ $property->owner_name ? ucfirst(strtolower($property->owner_name)) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_67">
                                                            <h6><b>Mobile</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 cursor-pointer color-code-popover data_conent_67" data-bs-trigger="hover focus">
                                                            <div class="highlightable">:
                                                                <a href="{{ $property->owner_contact ? $property->owner_contact : '#' }}">
                                                                    {{ $property->owner_contact ? $property->owner_contact : '-' }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-4 m-b-10 data_conent_68">
                                                            <h6><b>NRI</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_68">
                                                            <div>:{{ $property->is_nri ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_69">
                                                            <h6><b>Email</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_69 text-reset" style="text-transform: none !important">
                                                            <div>:
                                                                {{ $property->owner_email ? strtolower($property->owner_email) : '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Other Details</h5>
                                                        </div>
                                                        @if ($type != 'Plot' && $type != 'Land')
                                                            <div class="form-group col-4 m-b-10 data_conent_73">
                                                                <h6><b>FourWheeler Parking</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_73">
                                                                <div>:
                                                                    {{ $property->fourwheller_parking ? $property->fourwheller_parking : '-' }}
                                                                </div>
                                                            </div>
                                                            @if ($type != 'Vila/Bunglow')
                                                                <div class="form-group col-4 m-b-10 data_conent_74">
                                                                    <h6><b>TwoWheeler Parking </b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_74">
                                                                    <div>:
                                                                        {{ $property->twowheeler_parking ? $property->twowheeler_parking : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <div class="form-group col-4 m-b-10 data_conent_75">
                                                            <h6><b>Refrence </b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_75">
                                                            <div>:
                                                                {{ $property->property_source_refrence ? $property->property_source_refrence : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_76">
                                                            <h6><b>Priority</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_76">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->Property_priority]['name']) ? $dropdowns[$property->Property_priority]['name'] : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_77">
                                                            <h6><b>Source</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_77">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->source_of_property]['name']) ? $dropdowns[$property->source_of_property]['name'] : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_78">
                                                            <h6><b>Pre-Leased</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_78">
                                                            <div>:{{ $property->is_pre_leased ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_158">
                                                            <h6><b>Pre-Leased Remarks</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_158">
                                                            <div>:
                                                                {{ $property->pre_leased_remarks ? $property->pre_leased_remarks : '-' }}
                                                            </div>
                                                        </div>

                                                        @if (!empty($property->location_link))
                                                            <div class="form-group col-4 m-b-10 data_conent_79">
                                                                <h6><b>Location Link</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_79">
                                                                <div>:
                                                                    <a href="{{ $property->location_link ? $property->location_link : '#' }}" target="_blank">check on map
                                                                        <!-- <i class="cursor-pointer color-code-popover" data-bs-trigger="hover focus" style="color: #7fb927">  check on map  </i> -->
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif

														@if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse')
															<?php
															$amenitiesArray = json_decode($property->amenities);
															$valueAtIndex0 = $amenitiesArray[2];
															?>
															{{-- @dd($amenitiesArray); --}}
															<div class="form-group col-4 m-b-10 data_conent_34">
																<h6><b>Amenities</b></h6>
															</div>
															<div class="form-group col-8 m-b-10 data_conent_34">
																<div>:
																	{{ !empty($amenitiesArray) && $amenitiesArray[0] === 1 ? 'Swimming Pool,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[1] === 1 ? 'Club house,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[2] === 1 ? 'Garden,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[3] === 1 ? 'Children Play Area,' : '' }}
																	{{-- {{ !empty($amenitiesArray) && $amenitiesArray[4] === 1 ? 'Service Lift,' : '' }} --}}
																	{{ !empty($amenitiesArray) && $amenitiesArray[5] === 1 ? 'Central AC,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[6] === 1 ? 'Gym,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[4] === 1 ? 'Streature Lift' : '' }}
																</div>
															</div>
														@endif

														@if ($property->is_terrace === '1')
															<div class="form-group col-4 m-b-10 data_conent_159">
																<h6><b> Terrace</b></h6>
															</div>
															<div class="form-group col-8 m-b-10 data_conent_159">
																<div>:
																	{{ $property->is_terrace === '1' ? 'Yes' : '' }}
																</div>
															</div>
														@endif
														 <div class="form-group col-4 m-b-10 data_conent_16">
                                                            <h6><b>Created Date</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_16">
                                                            <div>: {{ date('d-m-Y h:i A', strtotime($property->created_at)) }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-10 data_conent_16">
                                                            <h6><b>Last Modified Date</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_16">
                                                            <div>: {{ date('d-m-Y h:i A', strtotime($property->updated_at)) }}</div>
                                                        </div>
                                                    </div>

													@if ($type === "Land")
														<div class="row mt-4">
															<div class="form-group col-md-12">
																<h5 class="border-style">Unit Details</h5>
															</div>
															<div class="col-md-12">
																<table class="table custom-table-design">
																	<thead>
																		<tr>
																			<th scope="col">Survey No.</th>
																			<th scope="col">FP No.</th>
																			<th scope="col">TP No.</th>
																			<th scope="col">Survey Price</th>
																			<th scope="col">FP Price</th>
																		</tr>
																	</thead>
																	<tbody>
                                                                        <?php
                                                                        $surveyPrice = App\Traits\HelperFn::formatIndianCurrency($property->survey_price);
                                                                        ?>
																		<td>{{ isset($property->survey_number) ? $property->survey_number : '-' }}</td>
																		<td>{{ isset($property->fp_number) ? $property->fp_number : '-' }}</td>
																		<td>{{ isset($property->tp_number) ? $property->tp_number : '-' }}</td>
																		<td>{{ ($surveyPrice) ? $surveyPrice : '-' }}</td>
																		<td>{{ isset($property->fp_plot_price) ? $property->fp_plot_price : '-' }}</td>
																	</tbody>
																</table>
															</div>
														</div>
													@endif

													@if ($type === "Vila/Bunglow" || $type === "Farmhouse" || $type === 'Penthouse' || $type === "Storage/industrial" ||
														$type === "Retail" || $type === "Flat" || $type === "Farmhouse" || $type === "Office" || $type === "Plot")
														<div class="row mt-4">
															<div class="form-group col-md-12">
																<h5 class="border-style">Unit Details</h5>
															</div>
															<div class="col-md-12">
																<table class="table custom-table-design">
																	<thead>
																		<tr>
																			{{-- @if ($type !== 'Vila/Bunglow' && $type !== 'Plot' && $type !== 'Farmhouse') --}}
                                                                            @if ($type === 'Penthouse' || $type === "Retail" || $type === "Flat" || $type === "Office")
																				<th scope="col">Wing</th>
																			@endif
																			<th scope="col">Unit</th>
																			{{-- @if (($type === 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse' || $type == 'Storage/industrial') && ($property->property_for == 'Sell' || $property->property_for == 'Both')) --}}
																			<th scope="col">Price</th>
																			<th scope="col">Rent Price</th>
                                                                            @if ($type === "Vila/Bunglow" || $type === "Farmhouse" || $type === 'Penthouse' || 
														                        $type === "Retail" || $type === "Flat" || $type === "Farmhouse" || $type === "Office")
																			<th scope="col">Furnished Status</th>
																			@endif
																			{{-- @endif --}}
																			<th scope="col">Status</th>
																		</tr>
																	</thead>
																	<tbody>

																	<tbody>


																		@if (isset(json_decode($property->unit_details)[0]))
																			@forelse (json_decode($property->unit_details) as $value)
																				<tr>
                                                                                    @if ($type === 'Penthouse' || $type === "Retail" || $type === "Flat" || $type === "Office")
                                                                                    <td>{{ isset($value[0]) ? ucfirst(strtolower($value[0])) : '-' }}</td>
																					@endif
																					<td>{{ isset($value[1]) ? $value[1] : '-' }}</td>
																					@if (($type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse' || $type == 'Storage/industrial') && ($property->property_for == 'Sell' || $property->property_for == 'Both'))
																						<td>{{ !empty($value[7]) ? '₹ '. $value[7] : '-' }}</td>
																					@else
                                                                                    <td>{{ !empty($value[3]) ? '₹ '. $value[3] : '-' }}</td>
																					@endif
																					<td>{{ !empty(($value[4])) ? '₹ '. $value[4] : '-' }}</td>
                                                                                    @if ($type === 'Vila/Bunglow' ||
                                                                                        $type === 'Farmhouse' ||
                                                                                        $type === 'Penthouse' ||
                                                                                        $type === 'Retail' ||
                                                                                        $type === 'Flat' ||
                                                                                        $type === 'Farmhouse' ||
                                                                                        $type === 'Office')
                                                                                        <td>
                                                                                            {{-- @dd("off 0",$type) --}}
                                                                                            <div class="d-flex">
                                                                                                <div class="me-2">
                                                                                                    {{ isset($value[8]) ? (isset($dropdowns[$value[8]]['name']) ? $dropdowns[$value[8]]['name'] : '-') : '-' }}
                                                                                                </div>
                                                                                                 <!--new code-->
                                                                                            @if (!empty($dropdowns[$value[8]]['name']) &&( $dropdowns[$value[8]]['name'] !== 'Unfurnished'))
                                                                                            @isset($value[9])
                                                                                            @if ($type == 'Office')
                                                                                                <div class="dropdown-basic">
                                                                                                    <div class="dropdown">
                                                                                                        <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                                                                        <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[9][0]) && $value[9][0] != '0' && $value[9][0] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Seats:</b> {{ $value[9][0] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][1]) && $value[9][1] != '0' && $value[9][1] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Cabins:</b> {{ $value[9][1] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][2]) && $value[9][2] != '0' && $value[9][2] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Conference Room:</b> {{ $value[9][2] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <hr>
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[10][0]) && $value[10][0] != '0' && $value[10][0] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Pantry:</b> <span>{{ $value[10][0] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][1]) && $value[10][1] != '0' && $value[10][1] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Reception:</b> <span>{{ $value[10][1] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @elseif ($type !== 'Retail' && $type !== 'Land' && $type !== 'Storage/industrial' && $type !== 'Plot')
                                                                                                <div class="dropdown-basic">
                                                                                                    <div class="dropdown">
                                                                                                        <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                                                                        <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[9][0]) && $value[9][0] != '0' && $value[9][0] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Light:</b> {{ $value[9][0] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][1]) && $value[9][1] != '0' && $value[9][1] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Fans:</b> {{ $value[9][1] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][2]) && $value[9][2] != '0' && $value[9][2] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>AC:</b> {{ $value[9][2] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[9][3]) && $value[9][3] != '0' && $value[9][3] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>TV:</b> {{ $value[9][3] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][4]) && $value[9][4] != '0' && $value[9][4] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Beds:</b> {{ $value[9][4] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][5]) && $value[9][5] != '0' && $value[9][5] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Wardrobe:</b> {{ $value[9][5] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[9][6]) && $value[9][6] != '0' && $value[9][6] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Geyser:</b> {{ $value[9][6] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[9][7]) && $value[9][7] != '0' && $value[9][7] != '')
                                                                                                                <div class="col-4 d-flex justify-content-between">
                                                                                                                    <b>Sofa:</b> {{ $value[9][7] }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <hr>
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[10][0]) && $value[10][0] != '0' && $value[10][0] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Washing Machine:</b> <span>{{ $value[10][0] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][1]) && $value[10][1] != '0' && $value[10][1] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Stove:</b> <span>{{ $value[10][1] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][2]) && $value[10][2] != '0' && $value[10][2] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Fridge:</b> {{ $value[10][2] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][3]) && $value[10][3] != '0' && $value[10][3] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Water Purifier:</b> {{ $value[10][3] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][4]) && $value[10][4] != '0' && $value[10][4] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Microwave:</b> {{ $value[10][4] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][5]) && $value[10][5] != '0' && $value[10][5] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Modular Kitchen:</b> {{ $value[10][5] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][6]) && $value[10][6] != '0' && $value[10][6] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Chimney:</b> {{ $value[10][6] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][7]) && $value[10][7] != '0' && $value[10][7] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Dining Table:</b> {{ $value[10][7] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][8]) && $value[10][8] != '0' && $value[10][8] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Curtains:</b> {{ $value[10][8] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                            
                                                                                                                @if(isset($value[10][9]) && $value[10][9] != '0' && $value[10][9] != '')
                                                                                                                <div class="col-6 d-flex justify-content-between">
                                                                                                                    <b>Exhaust Fan:</b> {{ $value[10][9] == 1 ? 'Yes' : 'No' }}
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                @elseif ($type == 'Retail')
                                                                                                <div class="dropdown-basic">
                                                                                                    <div class="dropdown">
                                                                                                        <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                                                                        <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                                                                            <div class="row">
                                                                                                                @if(isset($value[9][0]) && $value[9][0] != '0' && $value[9][0] != '')
                                                                                                                <div class="col-12">
                                                                                                                    <b>Remarks :</b>
                                                                                                                    <span class="short-text">{{ Str::limit($value[9][0], 100) }}...</span>
                                                                                                                    <span class="full-text d-none">{{ $value[9][0] }}</span>
                                                                                                                    <a href="#" class="read-more-link">Read More</a>
                                                                                                                </div>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                @endif
                                                                                                @endisset
                                                                                            @endif
                                                                                            </div>
                                                                                        </td>
                                                                                    @endif
																					<td>{{ !empty(isset($value[2])) ? $value[2] : '-' }}</td>
																				</tr>
																			@empty
																			@endforelse
																		@endif

																	</tbody>
																	</tbody>
																</table>
															</div>
														</div>
                                                    @endif

                                                @if (count(json_decode($property->other_contact_details)) != 0)
                                                    
                                                    <div class="row">
                                                        <div class="form-group col-md-12 mt-1">
                                                            <h5 class="border-style">Other Conatct Details</h5>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table custom-table-design">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Contact</th>
                                                                        <th scope="col">Position</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                    
                                                                <tbody>
                                                                    @if (isset(json_decode($property->other_contact_details)[0]))
                                                                        @forelse (json_decode($property->other_contact_details) as $value)
                                                                                <tr>
                                                                                <td>{{ isset($value[0]) ? ucfirst(strtolower($value[0])) : '-' }}</td>
                                                                                <td>{{ isset($value[1]) ? $value[1] : '-' }}</td>
                                                                                <td>{{ isset($value[3]) ? ucfirst(strtolower($value[3])) : '-' }}</td>
                                                    
                                                                            </tr>
                                                                        @empty
                                                                        @endforelse
                                                                    @endif
                                                    
                                                                </tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endif 
                                               

                                                @if (count($shareProperty) != 0)                                                   
                                                    <div class="row">
                                                        <div class="form-group col-md-12 mt-1">
                                                            <h5 class="border-style">Share Property Details</h5>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table custom-table-design">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Contact</th>
                                                                        <th scope="col">Position</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                <tbody>
                                                                    
                                                                        @forelse ($shareProperty as $value)
                                                                                <tr>
                                                                                <td>{{ isset($value['name']) ? $value['name'] : '-' }}</td>
                                                                                <td>{{ isset($value['contact']) ? $value['contact'] : '-' }}</td>
                                                                                <td>{{ isset($value['position']) ? $value['position'] : '-' }}</td>

                                                                            </tr>
                                                                        @empty
                                                                        @endforelse
                                                                

                                                                </tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endif 
                                                </div>
                                                <div class="col-md-6 d-flex" style="height: 185px;">
                                                    <!-- First Image Section -->
                                                    @if(count($multiple_image) > 0)
                                                        <div class="flex-fill text-center">
                                                            <h5 class="border-style">Property Image</h5>
                                                            <img src="{{ asset('assets/prop_images/property-image.png') }}" alt="" onclick="image()" style="height: 90px;">
                                                        </div>
                                                    @endif
                                                    <!-- Second Image Section -->
                                                    @if ($type === 'Land' && count($construction_docs_list) > 0)  
                                                    <div class="flex-fill text-center" style="margin-left: 20px;">
                                                        <h5 class="border-style">Constrution Image</h5>
                                                        <img src="{{ asset('imgIcon.png') }}" alt="" onclick="image1()" style="height: 90px;">
                                                    </div>
                                                    @endif   
                                                    <!-- Third Image Section -->
                                                    @if (count($multiple_image) > 0)
                                                        <div class="flex-fill text-center" style="margin-left: 20px;">
                                                            <h5 class="border-style">Property Documents</h5>
                                                            <img src="{{ asset('docIcon.png') }}" alt="" onclick="image2()" style="height: 90px;">
                                                        </div>
                                                    @endif
                                                </div>
                                                @if (count($visits))
                                                    
                                                <div class="col-md-6">
                                                    <h5 class="border-style">Enquiry Visit Logs</h5>
                                                    <br>
                                                    <div class="form-group">
                                                        <table class="table table-responsive custom-table-design mb-3">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Client Name</th>
                                                                    <th scope="col">Activity</th>
                                                                    <th scope="col">Date</th>
        
                                                                </tr>
                                                            </thead>
        
                                                            <tbody>
        
                                                                @forelse ($visits as $value)
                                                                    <tr>
                                                                        @if ($value->visit_status == "Completed")
                                                                        <td>
                                                                            <a href="{{ route('admin.view.enquiry',encrypt($value->Enquiry->id)) }}">{{ $value->Enquiry->client_name }}</a>
                                                                        </td>
                                                                            <td>{{ 'Visit ' . $value->visit_status ? 'Visit ' . $value->visit_status : '-' }}
                                                                            </td>
                                                                            <td>{{ \Carbon\Carbon::parse($value->visit_date)->format('d-m-Y g:i A') }}
                                                                        @endif
                                                                    </tr>
                                                                @empty
                                                                @endforelse
        
        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @endif
                                                {{-- @dd("sub_cat"$sub_cat); --}}

                                                @if (count($enquiries))
                                                {{-- <div class="col-md-12">
                                                    <h5 class="border-style">Matching Enquiry :</h5>
                                                    <br>
                                                    <div class="form-group">
                                                        <table class="table table-responsive custom-table-design mb-3">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Client Name</th>
                                                                    <th scope="col">For</th>
                                                                    <th scope="col">Category</th>
                                                                    <th scope="col">Sub Category</th>
                                                                    <th scope="col">Area From</th>
                                                                    <th scope="col">Area To</th>
                                                                    <th scope="col">Budget From</th>
                                                                    <th scope="col">Budget To</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="matching_container">
                                                                @forelse ($enquiries as $value)
                                                                <?php
                                                                $unit_name = "";
                                                                $area_measure = DB::table('land_units')->where('id',$value->area_from_measurement)->get();
                                                                if ($area_measure->isNotEmpty()) {
                                                                    $unit_name = $area_measure[0]->unit_name;
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><a href="{{ route('admin.view.enquiry', encrypt($value->id)) }}">{{ $value->client_name }}</a></td>
                                                                    <td>{{ $value->enquiry_for }}</td>
                                                                    <td>{{ $value->requirement_type == "87" ? "Resedential" : "Commercial" }}</td>
                                                                    <td>{{ $value->area_from .' '. $unit_name}}</td>
                                                                    <td>{{ $value->area_to .' '. $unit_name}}</td>
                                                                    <td>{{ $value->budget_from }}</td>
                                                                    <td>{{ $value->budget_to }}</td>
                                                                </tr>
                                                                @empty
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="col-md-12">
                                                    <h5 class="border-style">Matching Enquiry :</h5>
                                                    <br>
                                                    <div class="form-group">
                                                        <table class="table table-responsive custom-table-design mb-3">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Client Name</th>
                                                                    <th scope="col">For</th>
                                                                    <th scope="col">Category</th>
                                                                    <th scope="col">Sub Category</th>
                                                                    <th scope="col">Area From</th>
                                                                    <th scope="col">Area To</th>
                                                                    <th scope="col">Budget From</th>
                                                                    <th scope="col">Budget To</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="matching_container">
                                                                @forelse ($enquiries as $value)
                                                                <?php
                                                                $unit_name = "";
                                                                $area_measure = DB::table('land_units')->where('id', $value->area_from_measurement)->get();
                                                                if ($area_measure->isNotEmpty()) {
                                                                    $unit_name = $area_measure[0]->unit_name;
                                                                }
                                                                $budget_from_formatted = App\Traits\HelperFn::formatIndianCurrency($value->budget_from);
                                                                $budget_to_formatted = App\Traits\HelperFn::formatIndianCurrency($value->budget_to);
                                                                ?>
                                                                <tr>
                                                                    <td><a href="{{ route('admin.view.enquiry', encrypt($value->id)) }}">{{ $value->client_name }}</a></td>
                                                                    <td>{{ $value->enquiry_for }}</td>
                                                                    <td>{{ $value->requirement_type == "87" ? "Residential" : "Commercial" }}</td>
                                                                    <td>{{ $configuration_name }}</td> 
                                                                    <td>{{ $value->area_from .' '. $unit_name}}</td>
                                                                    <td>{{ $value->area_to .' '. $unit_name}}</td>
                                                                    <td>₹ {{ $budget_from_formatted }}</td>
                                                                    <td>₹ {{ $budget_to_formatted }}</td>
                                                                </tr>
                                                                @empty
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-property-information" role="tabpanel"
                                            aria-labelledby="v-property-information-tab">
											<div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Information</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_1">
                                                            <h6><b>Property For</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_1">
                                                            <div>:
                                                                {{ $property->property_for ? ucfirst(strtolower($property->property_for)) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_2">
                                                            <h6><b>Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_2">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->property_type]['name']) ? ucfirst(strtolower($dropdowns[$property->property_type]['name'])) : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_3">
                                                            <h6><b>Category</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_3">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->property_category]['name']) ? $dropdowns[$property->property_category]['name'] : '' }}
                                                            </div>
                                                        </div>
														@if (!empty($configuration_name))
														<div class="form-group col-4 m-b-10 data_conent_3">
															<h6><b>Sub Category</b></h6>
														</div>
														<div class="form-group col-8 m-b-10 data_conent_3">
															<div>:
																{{ $configuration_name != null ? $configuration_name : '' }}
															</div>
														</div>
														@endif
                                                        <div class="form-group col-4 m-b-10 data_conent_4">
                                                            <h6><b>Project</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_4">
                                                            <div>:
                                                                @if ($property->Projects != null)
                                                                    <a href="{{ route('admin.projects', ['id' => $property->Projects->id]) }}">
                                                                        {{ ucfirst(strtolower($property->Projects->project_name)) }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
														{{-- <div class="form-group col-4 m-b-10 data_conent_5">
                                                            <h6><b>Property Address</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_5">
                                                            <div>:
                                                                {{ isset($property->address) ? ucfirst(strtolower($property->address)) : '-' }}
                                                            </div>
                                                        </div> --}}
                                                        @if (!empty($property->projects->area->city->name))
                                                        <div class="form-group col-4 m-b-10 data_conent_6">
                                                            <h6><b>City</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_6">
                                                            <div>:
                                                                {{ isset($property->projects->area->city->name) ? ucfirst(strtolower($property->projects->area->city->name)) : '-' }}
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if (!empty($property->projects->area->name))
                                                            <div class="form-group col-4 m-b-10 data_conent_6">
                                                                <h6><b>Locality</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_6">
                                                                <div>:
                                                                    {{ isset($property->projects->area->name) ? ucfirst(strtolower($property->projects->area->name)) : '-' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if (!empty($property->Projects->address))
                                                            <div class="form-group col-4 m-b-10 data_conent_5">
                                                                <h6><b>Projects Address</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_5">
                                                                <div>:
                                                                    {{ isset($property->Projects->address) ? ucfirst(strtolower($property->Projects->address)) : '-' }}
                                                                </div>
                                                            </div>
                                                        @endif
														@if ($type == 'Office' || $type == 'Retail' || $type == 'Flat' || $type == 'Penthouse')
                                                            @if($carpetArray[0] !== "")
                                                                <div class="form-group col-4 m-b-10 data_conent_53">
                                                                    <h6><b>Carpet Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_53">

                                                                    <div>:{{$carpetArray[0]}} {{ $carpet_units->unit_name}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Office' || $type == 'Retail' || $type == 'Flat' || $type == 'Plot' || $type == 'Penthouse')
                                                            @if($salableArray[0] !== "")                                                                
                                                            <div class="form-group col-4 m-b-10 data_conent_54">
                                                                <h6><b>Salable Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_54">:
                                                                {{$salableArray[0]}} {{ $land_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Plot' || $type == 'Farmhouse')
                                                            @if($carpet_plotArray[0] !== "")                                                                
                                                            <div class="form-group col-4 m-b-10 data_conent_55">
                                                                <h6><b>Carpet Plot Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_55">:
                                                                {{$carpet_plotArray[0]}} {{ $carpet_plot_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($salable_plotArray[0] !== "")                                                                
                                                            <div class="form-group col-4 m-b-10 data_conent_56">
                                                                <h6><b>Salable Plot Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_56">:
                                                                {{$salable_plotArray[0]}} {{ $salable_plot_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($constructed_salableArray[0] !== "")
                                                            <div class="form-group col-4 m-b-10 data_conent_57">
                                                                <h6><b>Constructed Salable Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_57">:
                                                                {{$constructed_salableArray[0]}} {{ $constructed_salable_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Storage/industrial' || $type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($constructed_carpetArray[0] !== "")  
                                                            <div class="form-group col-4 m-b-10 data_conent_58">
                                                                <h6><b>Constructed Carpet Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_58">:
                                                                {{$constructed_carpetArray[0]}} {{ $constructed_carpet_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Vila/Bunglow' || $type == 'Farmhouse')
                                                            @if($constructed_builtupArray[0] !== "")  
                                                            <div class="form-group col-4 m-b-10 data_conent_59">
                                                                <h6><b>Constructed Builtup Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_59">:
                                                                {{$constructed_builtupArray[0]}} {{ $constructed_builtup_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Penthouse' || $type == 'Flat')
                                                            @if($builtupArray[0] !== "")  
                                                            <div class="form-group col-4 m-b-10 data_conent_60">
                                                                <h6><b>Builtup Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_60">:
                                                                 {{$builtupArray[0]}}   {{$builtup_units->unit_name}}
                                                            </div>
                                                            @endif
                                                        @endif

                                                        @if ($type == 'Penthouse' || ($type == 'Flat' && $property->is_terrace != 0))
                                                            @if($terrace_carpetArray[0] !== "")  
                                                                <div class="form-group col-4 m-b-10 data_conent_61">
                                                                    <h6><b>Terrace Carpet Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_61">:
                                                                    {{$terrace_carpetArray[0]}} {{ $terrace_carpet_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Penthouse' || ($type == 'Flat' && $property->is_terrace != 0))
                                                            @if($terrace_salableArray[0] !== "")     
                                                                <div class="form-group col-4 m-b-10 data_conent_62">
                                                                    <h6><b>Terrace Salable Area</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_62">:
                                                                    {{$terrace_salableArray[0]}} {{ $terrace_salable_units->unit_name}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Farmhouse' || $type == 'Land')
                                                            <div class="form-group col-4 m-b-10 data_conent_6">
                                                                <h6><b>District</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_6">
                                                                <div>:
                                                                    {{ isset($property->District->name) ? ucfirst(strtolower($property->District->name)) : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_7">
                                                                <h6><b>Taluka</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_7">
                                                                <div>:
                                                                    {{ isset($property->Taluka->name) ? ucfirst(strtolower($property->Taluka->name)) : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_8">
                                                                <h6><b>Village</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_8">
                                                                <div>:
                                                                    {{ isset($property->Village->name) ? ucfirst(strtolower($property->Village->name)) : '-' }}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_9">
                                                                <h6><b>Zone</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_9">
                                                                <div>:
                                                                    {{ isset($dropdowns[$property->zone_id]['name']) ? ucfirst(strtolower($dropdowns[$property->zone_id]['name'])) : '' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Storage/industrial')
                                                            <div class="form-group col-4 m-b-10 data_conent_10">
                                                                <h6><b>Centre Height</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_10">

                                                                <div>:
                                                                    @if (
                                                                        !empty(explode('_-||-_', $property->storage_centre_height)[0]) &&
                                                                            !empty(explode('_-||-_', $property->storage_centre_height)[1]))
                                                                        {{ explode('_-||-_', $property->storage_centre_height)[0] . ' ' . explode('_-||-_', $property->storage_centre_height)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Plot' || $type == 'Land')
                                                            <div class="form-group col-4 m-b-10 data_conent_11">
                                                                <h6><b>Length of Plot</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_11">
                                                                {{-- @dd((explode('_-||-_',$property->length_of_plot)[1])); --}}
                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->length_of_plot)[0]) && !empty(explode('_-||-_', $property->length_of_plot)[1]))
                                                                        {{ explode('_-||-_', $property->length_of_plot)[0] . ' ' . explode('_-||-_', $property->length_of_plot)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_12">
                                                                <h6><b>Width of Plot</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_12">

                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->width_of_plot)[0]) && !empty(explode('_-||-_', $property->width_of_plot)[1]))
                                                                        {{ explode('_-||-_', $property->width_of_plot)[0] . ' ' . explode('_-||-_', $property->width_of_plot)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Retail' || $type == 'Penthouse' || $type == 'Office' || $type == 'Flat')
                                                            <div class="form-group col-4 m-b-10 data_conent_13">
                                                                <h6><b>Entrance Width</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_13">
                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->entrance_width)[0]) && !empty(explode('_-||-_', $property->entrance_width)[1]))
                                                                        {{ explode('_-||-_', $property->entrance_width)[0] . ' ' . explode('_-||-_', $property->entrance_width)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_14">
                                                                <h6><b>Ceilling Height</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_14">

                                                                <div>:
                                                                    @if (!empty(explode('_-||-_', $property->ceiling_height)[0]) && !empty(explode('_-||-_', $property->ceiling_height)[1]))
                                                                        {{ explode('_-||-_', $property->ceiling_height)[0] . ' ' . explode('_-||-_', $property->ceiling_height)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if (
                                                            $type == 'Flat' ||
                                                                $type == 'Vila/Bunglow' ||
                                                                $type == 'Plot' ||
                                                                $type == 'Penthouse' ||
                                                                $type == 'Farmhouse' ||
                                                                $type == 'Office' ||
                                                                $type == 'Retail' ||
                                                                $type == 'Storage/industrial' ||
                                                                $type == 'Land')
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_15">
                                                                    <h6><b>Total Units in project</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_15">
                                                                    <div>:
                                                                        {{ $property->total_units_in_project ? $property->total_units_in_project : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_16">
                                                                    <h6><b>Total no. of floor</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_16">
                                                                    <div>:
                                                                        {{ $property->total_no_of_floor ? $property->total_no_of_floor : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_17">
                                                                    <h6><b>Total Units in tower</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_17">
                                                                    <div>:
                                                                        {{ $property->total_units_in_tower ? $property->total_units_in_tower : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office')
                                                                <div class="form-group col-4 m-b-10 data_conent_18">
                                                                    <h6><b>Property On Floor</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_18">
                                                                    <div>:
                                                                        {{ $property->property_on_floors ? $property->property_on_floors : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'PenthHouse' || $type == 'Office' || $type == 'Retail')
                                                                <div class="form-group col-4 m-b-10 data_conent_19">
                                                                    <h6><b>No Of Elavators</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_19">
                                                                    <div>:
                                                                        {{ $property->no_of_elavators ? $property->no_of_elavators : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Vila/Bunglow' || $type == 'PenthHouse' || $type == 'Farmhouse')
                                                                <div class="form-group col-4 m-b-10 data_conent_20">
                                                                    <h6><b>No Of Balcony</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_20">
                                                                    <div>:
                                                                        {{ $property->no_of_balcony ? $property->no_of_balcony : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Vila/Bunglow' || $type == 'Plot' || $type == 'Farmhouse')
                                                                <div class="form-group col-4 m-b-10 data_conent_21">
                                                                    <h6><b>Total No. of units</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_21">
                                                                    <div>:
                                                                        {{ $property->total_no_of_units ? $property->total_no_of_units : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
															@if (!empty($property->remarks))
                                                            <div class="form-group col-4 m-b-10 data_conent_33">
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_33">
                                                                <div>:
                                                                    {{ $property->remarks ? ucfirst(strtolower($property->remarks)) : $property->remarks }}
                                                                </div>
                                                            </div>
                                                        	@endif
                                                            @if ($type == 'Farmhouse' || $type == 'Vila/Bunglow')
                                                                <div class="form-group col-4 m-b-10 data_conent_22">
                                                                    <h6><b>No. of room</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_22">
                                                                    <div>:
                                                                        {{ $property->no_of_room ? $property->no_of_room : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'PenthHouse' || $type == 'Farmhouse')
                                                                <div class="form-group col-4 m-b-10 data_conent_23">
                                                                    <h6><b>No Of Bathrooms</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_23">
                                                                    <div>:
                                                                        {{ $property->no_of_bathrooms ? ucfirst(strtolower($property->no_of_bathrooms)) : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Plot' || $type == 'Land')
                                                                <div class="form-group col-4 m-b-10 data_conent_24">
                                                                    <h6><b>No Of Floors Allowed</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_24">
                                                                    <div>:
                                                                        {{ $property->no_of_floors_allowed ? $property->no_of_floors_allowed : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($type == 'Farmhouse' || $type == 'Plot' || $type == 'Vila/Bunglow')
                                                                <div class="form-group col-4 m-b-10 data_conent_25">
                                                                    <h6><b>No Of Side Open</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_25">
                                                                    <div>:
                                                                        {{ $property->no_of_side_open ? $property->no_of_side_open : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if ($type == 'Retail' || $type == 'Office')
                                                            <div class="form-group col-4 m-b-10 data_conent_26">
                                                                <h6><b>Washroom Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_26">
                                                                <div>:
                                                                    @if ($property->washrooms2_type == '1')
                                                                        {{ 'Private Washroom' }}
                                                                    @elseif($property->washrooms2_type == '2')
                                                                        {{ 'Public Washroom' }}
                                                                    @elseif($property->washrooms2_type == '3')
                                                                        {{ 'Not Available' }}
                                                                    @else
                                                                        {{ '-' }}
                                                                    @endif
                                                                    {{-- {{ $property->washrooms2_type ? $property->washrooms2_type : '-' }} --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Land' || $type == 'Storage/industrial')
                                                            <div class="form-group col-4 m-b-10 data_conent_27">
                                                                <h6><b>Road width of front side</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_27">

                                                                <div>:
                                                                    @if (
                                                                        !empty(explode('_-||-_', $property->front_road_width)[0]) &&
                                                                            !empty(explode('_-||-_', $property->front_road_width)[1]))
                                                                        {{ explode('_-||-_', $property->front_road_width)[0] . ' ' . explode('_-||-_', $property->front_road_width)[1] }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($type == 'Land')
                                                            @if (!empty($property->construction_allowed_for))
                                                                <div class="form-group col-4 m-b-10 data_conent_106">
                                                                    <h6><b>Construction Allowed For</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_106">
                                                                    <div>:
                                                                        {{ $property->construction_allowed_for ? $property->construction_allowed_for : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (!empty($property->construction_documents))
                                                                <div class="form-group col-4 m-b-10 data_conent_106">
                                                                    <h6><b>Construction Documents</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_106">
                                                                    <div>:
                                                                        {{ $property->construction_documents ? $property->construction_documents : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (!empty($property->fsi))
                                                                <div class="form-group col-4 m-b-10 data_conent_107">
                                                                    <h6><b>FSI</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_107">
                                                                    <div>:
                                                                        {{ $property->fsi ? $property->fsi : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (!empty($property->no_of_borewell))
                                                                <div class="form-group col-4 m-b-10 data_conent_108">
                                                                    <h6><b>No. of borewell</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_108">
                                                                    <div>:
                                                                        {{ $property->no_of_borewell ? $property->no_of_borewell : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse')
                                                            <div class="form-group col-4 m-b-10 data_conent_31">
                                                                <h6><b>Availability Status</b></h6>

                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_31">
                                                                <div>:
                                                                    {{-- {{ $property->availability_status ? $property->availability_status : '-' }} --}}
                                                                    @if ($property->availability_status == '1')
                                                                        {{ 'Available' }}
                                                                    @elseif ($property->availability_status == '0')
                                                                        {{ 'Under Construction' }}
                                                                    @else
                                                                        {{ '-' }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="form-group col-4 m-b-10 data_conent_32">
                                                            <h6><b>Age of property</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_32">
                                                            <div>:
                                                                @if ($property->propertyage == '1')
                                                                    {{ '0-1 Years' }}
                                                                @elseif ($property->propertyage == '2')
                                                                    {{ '1-5 Years' }}
                                                                @elseif ($property->propertyage == '3')
                                                                    {{ '5-10 Years' }}
                                                                @elseif ($property->propertyage == '4')
                                                                    {{ '10+ Years' }}
                                                                @else
                                                                    {{ '-' }}
                                                                @endif
                                                                {{-- {{ $property->propertyage ? $property->propertyage : '-' }} --}}
                                                            </div>
                                                        </div>
                                                        @if (!empty($property->available_from))
                                                            <div class="form-group col-4 m-b-10 data_conent_33">
                                                                <h6><b>Available From</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_33">
                                                                <div>:
                                                                    {{ $property->available_from ? ucfirst(strtolower($property->available_from)) : '-' }}
                                                                </div>
                                                            </div>
                                                        @endif
													

                                                        @if ($type == 'Storage/industrial' && empty($property->other_industrial_fields) && !empty(json_decode($property->other_industrial_fields)[3]))
                                                            @foreach (json_decode($property->other_industrial_fields)[3] as $key => $value)
                                                                <div class="form-group col-4 m-b-10 ">
                                                                    <h6><b>{{ $value }}</b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 ">
                                                                    <div>:
                                                                        {{ json_decode($property->other_industrial_fields)[0][$key]  ? 'Yes' : 'No' }}
																		@if (!empty(json_decode($property->other_industrial_fields)[1][$key]))
																			({{ json_decode($property->other_industrial_fields)[1][$key] }})
																		@endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if ($type == 'Retail')
                                                            <div class="form-group col-4 m-b-10 data_conent_43">
                                                                <h6><b>Two Road Corner</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_43">
                                                                <div>: {{ $property->two_road_corner ? 'Yes' : 'No' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($type == 'Land')
                                                            {{-- <div class="form-group col-4 m-b-10 data_conent_44">
                                                                <h6><b>Survey Number</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_44">
                                                                <div>:
                                                                    {{ $property->survey_number ? $property->survey_number : '-' }}
                                                                </div>
                                                            </div> --}}

                                                            <div class="form-group col-4 m-b-10 data_conent_45">
                                                                <h6><b>Survey Plot size</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_45">
                                                                <div>: {{$surveyUnitArray[0]}} {{ $survey_units->unit_name}}
                                                                </div>
                                                            </div>


                                                            {{-- <div class="form-group col-4 m-b-10 data_conent_46">
                                                                <h6><b>Price</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_46">
                                                                <div>:
                                                                    {{ $property->survey_price ? $property->survey_price : '-' }}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_47">
                                                                <h6><b>Tp Number</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_47">
                                                                <div>:
                                                                    {{ $property->tp_number ? $property->tp_number : '-' }}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_48">
                                                                <h6><b>Fp Number</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_48">
                                                                <div>:
                                                                    {{ $property->fp_number ? $property->fp_number : '-' }}
                                                                </div>
                                                            </div> --}}

                                                            <div class="form-group col-4 m-b-10 data_conent_49">
                                                                <h6><b>Fp Plot size</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_49">
                                                                <div>: {{$fpUnitArray[0]}} {{ $fp_units->unit_name}}</div>
                                                            </div>

                                                            {{-- <div class="form-group col-4 m-b-10 data_conent_50">
                                                                <h6><b>Price</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_50">
                                                                <div>:
                                                                    {{ $property->fp_plot_price ? $property->fp_plot_price : '-' }}
                                                                </div>
                                                            </div> --}}
                                                        @endif

                                                        @if ($type == 'Flat' || $type == 'Penthouse' || $type == 'Office' || $type == 'Retail')
                                                            <div class="form-group col-4 m-b-10 data_conent_51">
                                                                <h6><b>Service Elavator</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_51">
                                                                <div>: {{ $property->service_elavator ? 'Yes' : 'No' }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse')
                                                            <div class="form-group col-4 m-b-10 data_conent_52">
                                                                <h6><b>Servant Room</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_52">
                                                                <div>: {{ $property->servant_room ? 'Yes' : 'No' }}</div>
                                                            </div>
                                                        @endif


                                                        <div class="form-group col-4 m-b-10 data_conent_63">
                                                            <h6><b>Hot Property</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_63">
                                                            <div>: {{ $property->hot_property ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                        {{-- <div class="form-group col-4 m-b-10 data_conent_64">
                                                            <h6><b>Favourite</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_64">
                                                            <div>: {{ $property->is_favourite ? 'Yes' : 'No' }}</div>
                                                        </div> --}}
                                                    </div>

                                                    {{-- @if ($type !== 'Plot' && $type !== 'Land' && $type !== 'Storage/industrial')
                                                        <div class="row mt-1">
                                                            <div class="form-group col-md-12">
                                                                <h5 class="border-style">Care Taker Information</h5>
                                                            </div>

                                                            <div class="form-group col-4 m-b-10 data_conent_70">
                                                                <h6><b>Care Taker Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_70">
                                                                <div>
                                                                    {{ $property->care_taker_name ? $property->care_taker_name : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_71">
                                                                <h6><b>Care Taker Number</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_71">
                                                                <div>
                                                                    {{ $property->care_taker_contact ? $property->care_taker_contact : '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-b-10 data_conent_72">
                                                                <h6><b>Key Available At</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_72">
                                                                <div>
                                                                    {{ $property->key_available_at ? $property->key_available_at : '-' }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif --}}
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Other Details</h5>
                                                        </div>
                                                        @if ($type != 'Plot' && $type != 'Land')
                                                            <div class="form-group col-4 m-b-10 data_conent_73">
                                                                <h6><b>FourWheeler Parking</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_73">
                                                                <div>:
                                                                    {{ $property->fourwheller_parking ? $property->fourwheller_parking : '-' }}
                                                                </div>
                                                            </div>
                                                            @if ($type != 'Vila/Bunglow')
                                                                <div class="form-group col-4 m-b-10 data_conent_74">
                                                                    <h6><b>TwoWheeler Parking </b></h6>
                                                                </div>
                                                                <div class="form-group col-8 m-b-10 data_conent_74">
                                                                    <div>:
                                                                        {{ $property->twowheeler_parking ? $property->twowheeler_parking : '-' }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <div class="form-group col-4 m-b-10 data_conent_75">
                                                            <h6><b>Refrence </b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_75">
                                                            <div>:
                                                                {{ $property->property_source_refrence ? $property->property_source_refrence : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_76">
                                                            <h6><b>Priority</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_76">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->Property_priority]['name']) ? $dropdowns[$property->Property_priority]['name'] : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_77">
                                                            <h6><b>Source</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_77">
                                                            <div>:
                                                                {{ isset($dropdowns[$property->source_of_property]['name']) ? $dropdowns[$property->source_of_property]['name'] : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_78">
                                                            <h6><b>Pre-Leased</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_78">
                                                            <div>:{{ $property->is_pre_leased ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-10 data_conent_158">
                                                            <h6><b>Pre-Leased Remarks</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_158">
                                                            <div>:
                                                                {{ $property->pre_leased_remarks ? $property->pre_leased_remarks : '-' }}
                                                            </div>
                                                        </div>

                                                        @if (!empty($property->location_link))
                                                            <div class="form-group col-4 m-b-10 data_conent_79">
                                                                <h6><b>Location Link</b></h6>
                                                            </div>
                                                            <div class="form-group col-8 m-b-10 data_conent_79">
                                                                <div>:
                                                                    <a href="{{ $property->location_link ? $property->location_link : '#' }}" target="_blank">check on map
                                                                        <!-- <i class="cursor-pointer color-code-popover" data-bs-trigger="hover focus" style="color: #7fb927">  check on map  </i> -->
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif

														@if ($type == 'Flat' || $type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse')
															<?php
															$amenitiesArray = json_decode($property->amenities);
															$valueAtIndex0 = $amenitiesArray[2];
															?>
															{{-- @dd($amenitiesArray); --}}
															<div class="form-group col-4 m-b-10 data_conent_34">
																<h6><b>Amenities</b></h6>
															</div>
															<div class="form-group col-8 m-b-10 data_conent_34">
																<div>:
																	{{ !empty($amenitiesArray) && $amenitiesArray[0] === 1 ? 'Swimming Pool,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[1] === 1 ? 'Club house,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[2] === 1 ? 'Garden,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[3] === 1 ? 'Children Play Area,' : '' }}
																	{{-- {{ !empty($amenitiesArray) && $amenitiesArray[4] === 1 ? 'Service Lift,' : '' }} --}}
																	{{ !empty($amenitiesArray) && $amenitiesArray[5] === 1 ? 'Central AC,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[6] === 1 ? 'Gym,' : '' }}
																	{{ !empty($amenitiesArray) && $amenitiesArray[4] === 1 ? 'Streature Lift' : '' }}
																</div>
															</div>
														@endif

														@if ($property->is_terrace === '1')
															<div class="form-group col-4 m-b-10 data_conent_159">
																<h6><b> Terrace</b></h6>
															</div>
															<div class="form-group col-8 m-b-10 data_conent_159">
																<div>:
																	{{ $property->is_terrace === '1' ? 'Yes' : '' }}
																</div>
															</div>
														@endif
														 <div class="form-group col-4 m-b-10 data_conent_16">
                                                            <h6><b>Created Date</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_16">
                                                            <div>: {{ date('d-m-Y h:i A', strtotime($property->created_at)) }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-10 data_conent_16">
                                                            <h6><b>Last Modified Date</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-10 data_conent_16">
                                                            <div>: {{ date('d-m-Y h:i A', strtotime($property->updated_at)) }}</div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
                                        </div>

                                        <div class="tab-pane fade " id="v-property-price" role="tabpanel"
                                            aria-labelledby="v-property-price-tab">.
											@if ($type === "Land")
												<div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Unit Details</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <table class="table custom-table-design">
															<thead>
																<tr>
																	<th scope="col">Survey No.</th>
																	<th scope="col">FP No.</th>
																	<th scope="col">TP No.</th>
																	<th scope="col">Survey Price</th>
																	<th scope="col">FP Price</th>
																</tr>
															</thead>
															<tbody>
                                                                <?php
                                                                $surveyPrice = App\Traits\HelperFn::formatIndianCurrency($property->survey_price);
                                                                ?>
																<td>{{ isset($property->survey_number) ? $property->survey_number : '-' }}</td>
																<td>{{ isset($property->fp_number) ? $property->fp_number : '-' }}</td>
																<td>{{ isset($property->tp_number) ? $property->tp_number : '-' }}</td>
																<td>{{ $surveyPrice ? $surveyPrice : '-' }}</td>
																<td>{{ isset($property->fp_plot_price) ? $property->fp_plot_price : '-' }}</td>
															</tbody>
														</table>
                                                    </div>
                                                </div>
                                            @elseif (($type === "Vila/Bunglow" || $type === "Farmhouse" || $type === 'Penthouse' || $type === "Storage/industrial" ||
											$type === "Retail" || $type === "Flat" || $type === "Farmhouse" || $type === "Plot" || $type === "Office"))
												<div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Unit Details</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <table class="table custom-table-design">
															<thead>
																<tr>
                                                                    @if ($type === 'Penthouse' || $type === "Retail" || $type === "Flat" || $type === "Office")
                                                                    <th scope="col">Wing</th>
																	@endif
																	<th scope="col">Unit</th>
																	{{-- @if (($type === 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse' || $type == 'Storage/industrial') && ($property->property_for == 'Sell' || $property->property_for == 'Both')) --}}
																	<th scope="col">Price</th>
																	<th scope="col">Rent Price</th>
																	{{-- @endif --}}
                                                                    @if ($type === "Vila/Bunglow" || $type === "Farmhouse" || $type === 'Penthouse' || 
														                        $type === "Retail" || $type === "Flat" || $type === "Farmhouse" || $type === "Office")
																	<th scope="col">Furnished Status</th>
																	@endif
																	<th scope="col">Status</th>
																</tr>
															</thead>
															<tbody>

															<tbody>
																@if (isset(json_decode($property->unit_details)[0]))
																	@forelse (json_decode($property->unit_details) as $value)
																		<tr>
                                                                            @if ($type === 'Penthouse' || $type === "Retail" || $type === "Flat" || $type === "Office")
																			<td>{{ isset($value[0]) ? ucfirst(strtolower($value[0])) : '-' }}
																				</td>
																			@endif
																			<td> {{ isset($value[1]) ? $value[1] : '-' }}
																			</td>
																			@if (($type == 'Vila/Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse' || $type == 'Storage/industrial') && ($property->property_for == 'Sell' || $property->property_for == 'Both'))
                                                                                <td>{{ !empty($value[7]) ? '₹ '. $value[7] : '-' }}</td>
                                                                            @else
                                                                            <td>{{ !empty($value[3]) ? '₹ '. $value[3] : '-' }}</td>
                                                                            @endif
                                                                            <td>{{ !empty(($value[4])) ? '₹ '. $value[4] : '-' }}</td>
																			</td>
                                                                            @if ($type === "Vila/Bunglow" || $type === "Farmhouse" || $type === 'Penthouse' || 
                                                                            $type === "Retail" || $type === "Flat" || $type === "Farmhouse" || $type === "Office")
                                                                            <td>
																				<div class="d-flex">
																					<div class="me-2">
																						{{ isset($value[8]) ? (isset($dropdowns[$value[8]]['name']) ? $dropdowns[$value[8]]['name'] : '-') : '-' }}
																					</div>
																				@if (!empty($dropdowns[$value[8]]['name']) &&( $dropdowns[$value[8]]['name'] !== 'Unfurnished'))
                                                                                @isset($value[9])
                                                                                @if ($type == 'Office')
                                                                                    <div class="dropdown-basic">
                                                                                        <div class="dropdown">
                                                                                            <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                                                            <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                                                                <div class="row">
                                                                                                    @if(isset($value[9][0]) && $value[9][0] != '0' && $value[9][0] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Seats:</b> {{ $value[9][0] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][1]) && $value[9][1] != '0' && $value[9][1] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Cabins:</b> {{ $value[9][1] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][2]) && $value[9][2] != '0' && $value[9][2] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Conference Room:</b> {{ $value[9][2] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <hr>
                                                                                                <div class="row">
                                                                                                    @if(isset($value[10][0]) && $value[10][0] != '0' && $value[10][0] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Pantry:</b> <span>{{ $value[10][0] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][1]) && $value[10][1] != '0' && $value[10][1] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Reception:</b> <span>{{ $value[10][1] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @elseif ($type !== 'Retail' && $type !== 'Land' && $type !== 'Storage/industrial' && $type !== 'Plot')
                                                                                    <div class="dropdown-basic">
                                                                                        <div class="dropdown">
                                                                                            <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                                                            <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                                                                <div class="row">
                                                                                                    @if(isset($value[9][0]) && $value[9][0] != '0' && $value[9][0] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Light:</b> {{ $value[9][0] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][1]) && $value[9][1] != '0' && $value[9][1] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Fans:</b> {{ $value[9][1] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][2]) && $value[9][2] != '0' && $value[9][2] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>AC:</b> {{ $value[9][2] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    @if(isset($value[9][3]) && $value[9][3] != '0' && $value[9][3] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>TV:</b> {{ $value[9][3] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][4]) && $value[9][4] != '0' && $value[9][4] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Beds:</b> {{ $value[9][4] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][5]) && $value[9][5] != '0' && $value[9][5] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Wardrobe:</b> {{ $value[9][5] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    @if(isset($value[9][6]) && $value[9][6] != '0' && $value[9][6] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Geyser:</b> {{ $value[9][6] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[9][7]) && $value[9][7] != '0' && $value[9][7] != '')
                                                                                                    <div class="col-4 d-flex justify-content-between">
                                                                                                        <b>Sofa:</b> {{ $value[9][7] }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <hr>
                                                                                                <div class="row">
                                                                                                    @if(isset($value[10][0]) && $value[10][0] != '0' && $value[10][0] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Washing Machine:</b> <span>{{ $value[10][0] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][1]) && $value[10][1] != '0' && $value[10][1] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Stove:</b> <span>{{ $value[10][1] == 1 ? 'Yes' : 'No' }}</span>
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][2]) && $value[10][2] != '0' && $value[10][2] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Fridge:</b> {{ $value[10][2] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][3]) && $value[10][3] != '0' && $value[10][3] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Water Purifier:</b> {{ $value[10][3] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][4]) && $value[10][4] != '0' && $value[10][4] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Microwave:</b> {{ $value[10][4] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][5]) && $value[10][5] != '0' && $value[10][5] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Modular Kitchen:</b> {{ $value[10][5] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][6]) && $value[10][6] != '0' && $value[10][6] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Chimney:</b> {{ $value[10][6] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][7]) && $value[10][7] != '0' && $value[10][7] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Dining Table:</b> {{ $value[10][7] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][8]) && $value[10][8] != '0' && $value[10][8] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Curtains:</b> {{ $value[10][8] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                
                                                                                                    @if(isset($value[10][9]) && $value[10][9] != '0' && $value[10][9] != '')
                                                                                                    <div class="col-6 d-flex justify-content-between">
                                                                                                        <b>Exhaust Fan:</b> {{ $value[10][9] == 1 ? 'Yes' : 'No' }}
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @elseif ($type == 'Retail')
                                                                                    <div class="dropdown-basic">
                                                                                        <div class="dropdown">
                                                                                            <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                                                            <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                                                                <div class="row">
                                                                                                    @if(isset($value[9][0]) && $value[9][0] != '0' && $value[9][0] != '')
                                                                                                    <div class="col-12">
                                                                                                        <b>Remarks :</b>
                                                                                                        <span class="short-text">{{ Str::limit($value[9][0], 100) }}...</span>
                                                                                                        <span class="full-text d-none">{{ $value[9][0] }}</span>
                                                                                                        <a href="#" class="read-more-link">Read More</a>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                    @endisset
                                                                                    

																				@endif
																				</div>
																			</td>
																			@endif
																			<td>{{ !empty(isset($value[2])) ? $value[2] : '-' }}
																			</td>
																		</tr>
																	@empty
																	@endforelse
																@endif

															</tbody>
															</tbody>
														</table>
                                                    </div>
                                                </div>
											@endif
                                        </div>
                                        <div class="tab-pane fade " id="v-property-owner" role="tabpanel"
                                            aria-labelledby="v-property-owner-tab">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style">Owner Information</h5>
                                                </div>
                                                <div class="form-group col-4 m-b-10 data_conent_150">
                                                    <h6 for="Client Name"><b>Owner</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-10 data_conent_150">
                                                    <div>:
                                                        {{ isset($dropdowns[$property->owner_is]['name']) ? ucfirst(strtolower($dropdowns[$property->owner_is]['name'])) : '' }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-4 m-b-10 data_conent_151">
                                                    <h6><b>Name</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-10 data_conent_151">
                                                    <div>:
                                                       {{ $property->owner_name ? ucfirst(strtolower($property->owner_name)) : '-' }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-4 m-b-10 data_conent_152">
                                                    <h6><b>Mobile </b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-10 cursor-pointer color-code-popover data_conent_67" data-bs-trigger="hover focus">
                                                    <div class="highlightable">:
                                                        <a href="{{ $property->owner_contact ? $property->owner_contact : '#' }}">
                                                            {{ $property->owner_contact ? $property->owner_contact : '-' }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4 m-b-10 data_conent_153">
                                                    <h6><b>NRI</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-10 data_conent_153">
                                                    <div>:
														{{ $property->is_nri ? 'Yes' : 'No' }}</div>
                                                </div>
                                                <div class="form-group col-4 m-b-10 data_conent_154">
                                                    <h6><b>Email</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-10 data_conent_154" style="text-transform: none !important">
                                                    <div>:
                                                        {{ $property->owner_email ? $property->owner_email : '-' }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style">Other Conatct Details</h5>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <table class="table custom-table-design">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Contact</th>
																<th scope="col">Position</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tbody>
                                                            @if (isset(json_decode($property->other_contact_details)[0]))
                                                                @forelse (json_decode($property->other_contact_details) as $value)
                                                                    <tr>
																		<td>{{ isset($value[0]) ? ucfirst(strtolower($value[0])) : '-' }}</td>
																		<td>{{ isset($value[1]) ? $value[1] : '-' }}</td>
                                                                        <td>{{ isset($value[3]) ? ucfirst(strtolower($value[3])) : '-' }}</td>

																	</tr>
                                                                @empty
                                                                @endforelse
                                                            @endif

                                                        </tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if(count($multiple_image) > 0)
                                            <div class="modal fade" id="imageModel" tabindex="-1" aria-labelledby="imageLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-fullscreen" style="position: relative;text-align: -webkit-center;">
                                                    <div class="modal-content" style="max-height: 80%; height: auto; width: 40%;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="imageLabel">Property Images</h5>
                                                            <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="imageSlider" class="image-slider">
                                                                @php
                                                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'];
                                                                    $hasImage = false;
                                                                @endphp
                                                                @foreach ($multiple_image as $image)
                                                                    @php
                                                                        $path = pathinfo($image->image, PATHINFO_EXTENSION);
                                                                    @endphp
                                                                    @if (in_array($path, $imageExtensions))
                                                                        <div class="slide" style="position: relative;">
                                                                            <img src="{{ asset('/upload/land_images/' . $image->image) }}" alt="" class="img-fluid" data-bs-toggle="modal" data-bs-target="#fullScreenImage" style="width: 500px;height: 348px">
                                                                            <span class="remove-icon" data-image-id="{{ $image->id }}" onclick="removeImage(this)" style="position: absolute; top: 0; right: 0; cursor: pointer;">
                                                                                <i class="fa fa-trash"></i>
                                                                            </span>                                                                        
                                                                        </div>
                                                                        @php
                                                                            $hasImage = true; 
                                                                        @endphp
                                                                    @endif

                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @if ($hasImage)
                                                            <div class="modal-footer">
                                                                <a class="btn btn-primary" href="{{ route('download.zip', ['type' => 'images', 'prop' => $property->id]) }}">Download Zip</a>
                                                            </div>
                                                        @else
                                                            <center><h4>No Images Found</h4></center>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Full-screen image modal -->
                                        <div class="modal fade" id="fullScreenImage" tabindex="-1" aria-labelledby="fullScreenImageLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="" alt="" id="fullScreenImageView" class="" height="100%" width="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="modal fade" id="imageModel" tabindex="-1" aria-labelledby="imageLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageLabel">Property Images</h5>
                                                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="imageSlider" class="image-slider">
                                                            @php
                                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'];
                                                                $hasImage = false;
                                                            @endphp
                                                            @foreach ($multiple_image as $image)
                                                                @php
                                                                    $path = pathinfo($image->image, PATHINFO_EXTENSION);
                                                                @endphp
                                                                @if (in_array($path, $imageExtensions))
                                                                    <div class="slide">
                                                                        <img src="{{ asset('/upload/land_images/' . $image->image) }}" alt="" class="img-fluid" data-bs-toggle="modal" data-bs-target="#fullScreenImage">
                                                                    </div>
                                                                    @php
                                                                        $hasImage = true; 
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @if ($hasImage)
                                                        <div class="modal-footer">
                                                            <a class="btn btn-primary" href="{{ route('download.zip', ['type' => 'images', 'prop' => $property->id]) }}">Download Zip</a>
                                                        </div>
                                                    @else
                                                        <center><h4>No Images Found</h4></center>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> --}}
                                        
                                        <!-- Full-screen image modal -->
                                        {{-- <div class="modal fade" id="fullScreenImage" tabindex="-1" aria-labelledby="fullScreenImageLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="" alt="" id="fullScreenImageView" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        @if ($type === 'Land' && count($construction_docs_list) > 0)  
                                        <div class="modal fade" id="imageModel2" role="dialog" aria-labelledby="imageLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <!-- Construction Docs Section -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="documentLabel">Property Construction Documents</h5>
                                                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal"
                                aria-label="Close"> </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="documentBanner" class="image-slider">
                                                            @php
                                                                $documentExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff','docs', 'doc', 'docx', 'pdf', 'zip', 'xls', 'xlsx', 'ppt', 'pptx'];
                                                                $hasConstDocuments = false;
                                                            @endphp

                                                            @foreach ($construction_docs_list as $index => $const_image)
                                                                @php
                                                                    $path = pathinfo($const_image->construction_documents, PATHINFO_EXTENSION);
                                                                @endphp
                                                                @if (in_array($path, $documentExtensions))
                                                                    <div class="slide">
                                                                        <img src="{{ asset('/upload/construction_images/' . $const_image->construction_documents) }}" class="d-block"  alt="Image">
                                                                        <span class="remove-icon" data-image-id="{{ $image->id }}" onclick="removeImage(this)" style="position: absolute; top: 0; right: 0; cursor: pointer;">
                                                                            <i class="fa fa-trash"></i>
                                                                        </span>        
                                                                    </div>
                                                                    @php
                                                                        $hasConstDocuments = true;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @if ($hasConstDocuments)
                                                        <div class="modal-footer">
                                                            <a class="btn btn-primary" href="{{ route('download.zip', ['type' => 'construction_land_images', 'prop' => $property->id]) }}">Download Zip</a>
                                                        
                                                        </div>
                                                    @else
                                                        <center><h4>No Construction Documents Found</h4></center>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                       @endif
                                       @if (count($multiple_image) > 0)
                                        <div class="modal fade" id="imageModel3" role="dialog" aria-labelledby="imageLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <!-- Document Section -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="documentLabel">Property Documents</h5>
                                                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal"
                                aria-label="Close"> </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="documentBanner">
                                                            @php
                                                                $documentExtensions = ['docs', 'doc', 'docx', 'pdf', 'zip', 'xls', 'xlsx', 'ppt', 'pptx'];
                                                                $hasDocuments = false;
                                                            @endphp
                                        
                                                            @foreach ($multiple_image as $image)
                                                                @php
                                                                    $path = pathinfo($image->image, PATHINFO_EXTENSION);
                                                                @endphp
                                                                @if (in_array($path, $documentExtensions))
                                                                    <div class="zoom">
                                                                        <a href="{{ asset('/upload/land_images/' . $image->image) }}" target="_blank">{{ $image->image }}</a>
                                                                        <span class="remove-icon" data-image-id="{{ $image->id }}" onclick="removeDocs(this)" style="position: absolute; top: 16px; right: 45px; cursor: pointer;">
                                                                            <i class="fa fa-trash"></i>
                                                                        </span>
                                                                    </div>
                                                                    @php $hasDocuments = true; @endphp
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @if ($hasDocuments)
                                                        <div class="modal-footer">
                                                            <a class="btn btn-primary" href="{{ route('download.zip', ['type' => 'documents', 'prop' => $property->id]) }}">Download Zip</a>
                                                        </div>
                                                    @else
                                                        <center><h4>No Documents Found</h4></center>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                       
                                        <style>
                                        .image-slider {
                                        display: flex;
                                        overflow-x: auto; /* Enable horizontal scrolling */
                                        }

                                        .slide {
                                        flex: 0 0 auto; /* Prevent shrinking and growing of the slides */
                                        margin-right: 10px; /* Adjust margin as needed */
                                        }

                                        .image-slider img {
                                        width: 300px; /* Set a fixed width for the images */
                                        height: 200px; /* Set a fixed height for the images */
                                        }
                                        </style>
                                        <div class="tab-pane fade" id="v-enquiry-matching" role="tabpanel"
                                            aria-labelledby="v-enquiry-matching-tab">
                                            <h5 class="border-style">Matching Enquiry</h5>
                                            <br>
                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Client Name</th>
                                                            <th scope="col">For</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Sub Category</th>
                                                            <th scope="col">Area From</th>
                                                            <th scope="col">Area To</th>
                                                            <th scope="col">Budget From</th>
                                                            <th scope="col">Budget To</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="matching_container">
                                                        @forelse ($enquiries as $value)
                                                        <?php
                                                        $unit_name = "";
                                                        $area_measure = DB::table('land_units')->where('id', $value->area_from_measurement)->get();
                                                        if ($area_measure->isNotEmpty()) {
                                                            $unit_name = $area_measure[0]->unit_name;
                                                        }
                                                        $budget_from_formatted = App\Traits\HelperFn::formatIndianCurrency($value->budget_from);
                                                        $budget_to_formatted = App\Traits\HelperFn::formatIndianCurrency($value->budget_to);
                                                        ?>
                                                        <tr>
                                                            <td><a href="{{ route('admin.view.enquiry', encrypt($value->id)) }}">{{ $value->client_name }}</a></td>
                                                            <td>{{ $value->enquiry_for }}</td>
                                                            <td>{{ $value->requirement_type == "87" ? "Residential" : "Commercial" }}</td>
                                                            <td>{{ $configuration_name }}</td> 
                                                            <td>{{ $value->area_from .' '. $unit_name}}</td>
                                                            <td>{{ $value->area_to .' '. $unit_name}}</td>
                                                            <td>₹ {{ $budget_from_formatted }}</td>
                                                            <td>₹ {{ $budget_to_formatted }}</td>
                                                        </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-property-viewer" role="tabpanel"
                                            aria-labelledby="v-property-viewer-tab">
                                            <h5 class="border-style">Enquiry Visit Logs</h5>
                                            <br>
                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Enquiry For</th>
                                                            <th scope="col">Client Name</th>
                                                            <th scope="col">Client Mobile</th>
                                                            <th scope="col">Client Email</th>
                                                            <th scope="col">Activity</th>
                                                            <th scope="col">Date</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @forelse ($visits as $value)
                                                            <tr>
                                                                @if ($value->visit_status == "Completed")
                                                                <td>{{$value->Enquiry->enquiry_for}}</td>
                                                                     {{-- <td>{{ $value->Enquiry ? $value->Enquiry->client_name : '' }}
                                                                    </td> --}}
                                                                    <td>
                                                                        <a href="{{ route('admin.view.enquiry', $value->Enquiry->id) }}">{{ $value->Enquiry->client_name }}</a>
                                                                    </td>
                                                                    <td>{{$value->Enquiry->client_mobile}}</td>
                                                                    <td>{{$value->Enquiry->client_email}}</td>
                                                                    <td>{{ 'Visit ' . $value->visit_status ? 'Visit ' . $value->visit_status : '-' }}
                                                                    </td>
                                                                    <td>{{ \Carbon\Carbon::parse($value->visit_date)->format('d-m-Y g:i A') }}
                                                                @endif
                                                            </tr>
                                                        @empty
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @if (count($shareProperty) != 0)                                                   
                                        <div class="tab-pane fade" id="v-property-share" role="tabpanel"
                                            aria-labelledby="v-property-share-tab">
                                                <div class="row">
                                                    <div class="form-group col-md-12 mt-1">
                                                        <h5 class="border-style">Share Property logs</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <table class="table custom-table-design">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Contact</th>
                                                                    <th scope="col">Position</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($shareProperty as $value)
                                                                    <tr>
                                                                        <td>{{ isset($value['name']) ? $value['name'] : '-' }}</td>
                                                                        <td>{{ isset($value['contact']) ? $value['contact'] : '-' }}</td>
                                                                        <td>{{ isset($value['position']) ? $value['position'] : '-' }}</td>
                                                                    </tr>
                                                                @empty
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="modal fade" id="propertyModal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Property</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div>
                                <div class="row">
                                    <h5 class="border-style">Information</h5>
                                    <div class="form-group col-md-1 m-b-4 mb-3">
                                        <select class="form-select" name="property_for" id="property_for">
                                            <option value="">For</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Sell">Sell</option>
                                            <option value="Both">Both</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" name="property_type" id="property_type">
                                            <option value="">Property Type</option>
                                            @forelse ($dropdowns as $props)
                                                @if ($props['dropdown_for'] == 'property_construction_type' && in_array($props['id'], $prop_type))
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" name="specific_type" id="specific_type">
                                            <option value="">Category</option>
                                            @forelse ($dropdowns as $props)
                                                @if ($props['dropdown_for'] == 'property_specific_type' && in_array($props['parent_id'], $prop_type))
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1 m-b-10">
                                        <label for="Wing">Wing</label>
                                        <input class="form-control" name="property_wing" id="property_wing"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-1 m-b-10">
                                        <label for="Unit No">Unit No</label>
                                        <input class="form-control" name="property_unit_no" id="property_unit_no"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-4">
                                        <select class="form-select" name="building_id" id="building_id">
                                            <option value="">Project</option>
                                            @foreach ($projects as $building)
                                                <option data-addr="{{ $building->address }}"
                                                    value="{{ $building->id }}">
                                                    {{ $building->project_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <label for="Building Addresss">Building Address</label>
                                        <input class="form-control" type="text" value=""
                                            name="show_building_address" id="show_building_address" disabled>
                                    </div>
                                    <div class="form-group col-md-2 m-b-10">
                                        <select class="form-select" id="configuration">
                                            <option value="">Configuration</option>
                                            @forelse (config('constant.property_configuration') as $key=>$props)
                                                <option value="{{ $key }}">{{ $props }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-10">
                                        <select class="form-select" id="property_status">
                                            <option value=""> Status</option>
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-10">
                                                <label for="Carpet Area">Carpet Area</label>
                                                <input class="form-control" name="carpet_area" id="carpet_area"
                                                    type="text" autocomplete="off">
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-10">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select measure_select" id="carpet_measurement">
                                                        @forelse ($dropdowns as $props)
                                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                <option @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                    data-parent_id="{{ $props['parent_id'] }}"
                                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                                </option>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-10">
                                                <label for="Super Builtup Area">Salable Area</label>
                                                <input class="form-control" name="super_builtup_area"
                                                    id="super_builtup_area" type="text" autocomplete="off">
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-10">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select measure_select"
                                                        id="super_builtup_measurement">
                                                        @forelse ($dropdowns as $props)
                                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                <option @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                    data-parent_id="{{ $props['parent_id'] }}"
                                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                                </option>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-10">
                                                <label for="Plot Area">Plot Area</label>
                                                <input class="form-control" name="plot_area" id="plot_area"
                                                    type="text" autocomplete="off">
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-10">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select measure_select" id="plot_measurement">
                                                        @forelse ($dropdowns as $props)
                                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                <option @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                    data-parent_id="{{ $props['parent_id'] }}"
                                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                                </option>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-10">
                                                <label for="Terrace">Terrace</label>
                                                <input class="form-control" name="terrace" id="terrace" type="text"
                                                    autocomplete="off">
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-10">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select measure_select" id="terrace_measuremnt">
                                                        @forelse ($dropdowns as $props)
                                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                <option @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                    data-parent_id="{{ $props['parent_id'] }}"
                                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                                </option>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2">
                                        <input class="form-check-input" id="hot_property" type="checkbox">
                                        <label class="form-check-label" for="hot_property">Hot </label>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                        <input class="form-check-input" id="share_to_others" type="checkbox">
                                        <label class="form-check-label" for="share_to_others">Share To Others</label>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                        <input class="form-check-input" id="is_favourite" type="checkbox">
                                        <label class="form-check-label" for="is_favourite">Favourite</label>
                                    </div>

                                    <h5 class="border-style">Other Details</h5>
                                    <div class="form-group col-md-2 m-b-4">
                                        <select class="form-select" id="furnished_status">
                                            <option value="">Furnished Status</option>
                                            @forelse ($dropdowns as $props)
                                                @if ($props['dropdown_for'] == 'property_furniture_type')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-10">
                                        <label for="Four Wheeler Parking">Four Wheeler Parking</label>
                                        <input class="form-control" name="fourwheller_parking" id="fourwheller_parking"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2 m-b-10">
                                        <label for="Two Wheeler Parking">Two Wheeler Parking</label>
                                        <input class="form-control" name="twowheeler_parking" id="twowheeler_parking"
                                            type="text" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-2 m-b-10">
                                        <label for="Refrence">Refrence</label>
                                        <input class="form-control" name="if_any_refrence" id="if_any_refrence"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2 m-b-4">
                                        <select class="form-select" id="Property_priority">
                                            <option value="">Priority</option>
                                            @forelse ($dropdowns as $props)
                                                @if ($props['dropdown_for'] == 'property_priority_type')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-4">
                                        <select class="form-select" id="source_of_property">
                                            <option value="">Source</option>
                                            @forelse ($dropdowns as $props)
                                                @if ($props['dropdown_for'] == 'property_source')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success col-md-2 m-b-10">
                                        <input class="form-check-input" id="is_pre_leased" type="checkbox">
                                        <label class="form-check-label" for="is_pre_leased">Pre-leased</label>
                                    </div>
                                    <div class="form-group col-md-8 m-b-10">
                                        <label for="Pre Leased Remarks">Pre-Leased Remarks</label>
                                        <input class="form-control" name="pre_leased_remarks" id="pre_leased_remarks"
                                            type="text" autocomplete="off">
                                    </div>

                                    <h5 class="border-style">Price And Remark</h5>
                                    <div class="form-group col-md-4 m-b-10">
                                        <label for="Price">Price</label>
                                        <input class="form-control" name="price" id="price" type="text"
                                            autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-6 m-b-10">
                                        <label for="Remarks">Remarks</label>
                                        <input class="form-control" name="property_remarks" id="property_remarks"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-6 m-b-10">
                                        <label for="Link">Location Link</label>
                                        <input class="form-control" name="property_link" id="property_link"
                                            type="text" autocomplete="off">
                                    </div>

                                    <h5 class="border-style"> Owner Information</h5>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" id="owner_is">
                                            <option value="">Owner is</option>
                                            @forelse ($dropdowns as $props)
                                                @if ($props['dropdown_for'] == 'property_owner_type')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-10">
                                        <label for="Owner Name">Name</label>
                                        <input class="form-control" name="owner_info_name" id="owner_info_name"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2 m-b-10">
                                        <label for="Owner Contact Specific No">Contact</label>
                                        <input class="form-control" name="owner_contact_specific_no"
                                            id="owner_contact_specific_no" type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3 m-b-10">
                                        <label for="Email">Email</label>
                                        <input class="form-control" name="property_email" id="property_email"
                                            type="text" autocomplete="off">
                                    </div>

                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-1 m-b-10">
                                        <input class="form-check-input" id="is_nri" type="checkbox">
                                        <label class="form-check-label" for="is_nri">NRI</label>
                                    </div>


                                    <h5 class="border-style">Other Contact Details</h5>
                                    <div><button type="button" class="btn mb-3 btn-primary btn-air-primary"
                                            id="add_owner_contacts">Add Contact</button></div>
                                    <div class="row" id="all_owner_contacts">

                                    </div>

                                    <h5 class="border-style">Unit Detail(s)</h5>
                                    <div><button class="btn mb-3 btn-primary btn-air-primary" type="button"
                                            id="add_units">Add Units</button></div>
                                    <div class="row" id="all_units">

                                    </div>

                                    {{-- <h5 class="border-style"> Care Taker Information</h5>
                                    <div class="form-group col-md-4 m-b-10">
                                        <label for="Care Take Name">Care Taker Name</label>
                                        <input class="form-control" name="care_take_name" id="care_take_name"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4 m-b-10">
                                        <label for="Care Take Contact No">Care Taker Contact No</label>
                                        <input class="form-control" name="care_take_contact_no" id="care_take_contact_no"
                                            type="text" autocomplete="off">
                                    </div> --}}
                                    <div class="form-group col-md-3 m-b-4 mt-1">
                                        <select class="form-select" id="key_arrangement">
                                            <option value=""> Key Available At</option>
                                            <option value="Office">Office</option>
                                            <option value="Owner">Owner</option>
                                            <option value="Caretaker">Care Taker</option>
                                        </select>
                                    </div>

                                    <div style="display: none" class="form-group col-md-3 m-b-10">
                                        <label for="nfd" class="label-center">Reminder Date:</label>
                                    </div>
                                    <div style="display: none" class="form-group col-md-4 m-b-10">
                                        <input class="form-control " id="reminder" name="reminder"
                                            type="datetime-local" placeholder="Reminder Date">
                                    </div>

                                </div>
                            </div>

                            @if (Auth::user()->can('property-edit') || Auth::user()->can('property-create'))
                                <button class="btn btn-secondary" id="saveProperty">Save</button>
                            @endif
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    @push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
    $(document).ready(function() {
        $(document).on('click', '.read-more-link', function(e) {
            e.preventDefault();
            
            var $this = $(this);
            var $shortText = $this.siblings('.short-text');
            var $fullText = $this.siblings('.full-text');
console.log("read click");

            if ($shortText.is(':visible')) {
                $shortText.addClass('d-none');
                $fullText.removeClass('d-none');
                $this.text('Read Less');
            } else {
                $shortText.removeClass('d-none');
                $fullText.addClass('d-none');
                $this.text('Read More');
            }
        });
    });

         function removeImage(element) {
            var imageId = element.getAttribute('data-image-id');
            var slideElement = element.closest('.slide');
            slideElement.remove();
        }

        function removeDocs(element) {
            var imageId = element.getAttribute('data-image-id');
            var zoomContainer = element.closest('.zoom');
            zoomContainer.remove();
        }
        
        $('#fullScreenImage').on('show.bs.modal', function (event) {
            var imgSrc = $(event.relatedTarget).attr('src');
            $('#fullScreenImageView').attr('src', imgSrc);
        });
        
        for (let i = 1; i < 159; i++) {
            if ($('.data_conent_' + i).length > 1) {
                var strr = $($('.data_conent_' + i)[1]).html()
                strr = strr.replaceAll("<div>", "");
                strr = strr.replaceAll("</div>", "");
                strr = strr.replaceAll("-", "");
                strr = strr.replaceAll(":", "");
                strr = strr.replaceAll("No", "");
                strr = strr.trim();
                if (strr == '') {
                    $('.data_conent_' + i).hide()
                }
            }
        }

        function getProperty() {
            $('#modal_form').trigger("reset");
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getProperty') }}",
                data: {
                    id: '{{ $property->id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    $('#property_for').val(data.property_for).trigger('change');
                    $('#property_type').val(data.property_type).trigger('change');
                    $('#specific_type').val(data.specific_type).trigger('change');
                    $('#building_id').val(data.building_id).trigger('change');
                    $('#is_favourite').prop('checked', Number(data.is_favourite));
                    $('#property_wing').val(data.property_wing);
                    $('#property_unit_no').val(data.property_unit_no);
                    $('#configuration').val(data.configuration).trigger('change');;
                    $('#property_status').val(data.property_status).trigger('change');;
                    $('#carpet_area').val(data.carpet_area);
                    $('#carpet_measurement').val(data.carpet_measurement).trigger('change');;
                    $('#super_builtup_area').val(data.super_builtup_area);
                    $('#super_builtup_measurement').val(data.super_builtup_measurement).trigger('change');;
                    $('#plot_area').val(data.plot_area);
                    $('#plot_measurement').val(data.plot_measurement).trigger('change');;
                    $('#terrace').val(data.terrace);
                    $('#terrace_measuremnt').val(data.terrace_measuremnt).trigger('change');;
                    $('#hot_property').prop('checked', Number(data.hot_property));
                    $('#share_to_others').prop('checked', Number(data.share_to_others));
                    $('#furnished_status').val(data.furnished_status).trigger('change');;
                    $('#fourwheller_parking').val(data.fourwheller_parking);
                    $('#property_link').val(data.property_link);
                    $('#twowheeler_parking').val(data.twowheeler_parking);
                    $('#source_of_property').val(data.source_of_property).trigger('change');;
                    $('#if_any_refrence').val(data.if_any_refrence);
                    $('#is_pre_leased').prop('checked', Number(data.is_pre_leased));
                    $('#pre_leased_remarks').val(data.pre_leased_remarks);
                    $('#price').val(data.price);
                    $('#property_remarks').val(data.property_remarks);
                    $('#owner_is').val(data.owner_is).trigger('change');;
                    $('#property_email').val(data.property_email);
                    $('#owner_info_name').val(data.owner_info_name);
                    $('#owner_contact_specific_no').val(data.owner_contact_specific_no);
                    $('#is_nri').prop('checked', Number(data.is_nri));
                    $('#care_take_name').val(data.care_take_name);
                    $('#care_take_contact_no').val(data.care_take_contact_no);
                    $('#key_arrangement').val(data.key_arrangement).trigger('change');
                    $('#Property_priority').val(data.Property_priority).trigger('change');
                    $('#reminder').val(data.reminder)
                    $('#propertyModal').modal('show');
                    $('#all_owner_contacts').html('')
                    $('#all_units').html('')
                    if (data.owner_details != '') {
                        details = JSON.parse(data.owner_details);
                        if ((details != null) && (details.length > 0)) {
                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                $('#all_owner_contacts').append(generate_contact_detail(id))
                                $("[data-contact_id=" + id + "] select[name=owner_status]").select2()
                                $("[data-contact_id=" + id + "] input[name=owner_name]").val(details[i][0]);
                                $("[data-contact_id=" + id + "] input[name=owner_contact_no]").val(details[i][
                                    1
                                ]);
                                $("[data-contact_id=" + id + "] select[name=owner_status]").val(details[i][2])
                                    .trigger('change');
                            }
                        }
                    }
                    if (data.unit_details != '') {
                        details = JSON.parse(data.unit_details);
                        if ((details != null) && (details.length > 0)) {

                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                $('#all_units').append(generate_unit_detail(id))
                                $("[data-unit_id=" + id + "] select[name=unit_status]").select2()
                                $("[data-unit_id=" + id + "] select[name=furnished_status]").select2()
                                $("[data-unit_id=" + id + "] input[name=wing]").val(details[i][0]);
                                $("[data-unit_id=" + id + "] input[name=unit_unit_no]").val(details[i][1]);
                                $("[data-unit_id=" + id + "] select[name=unit_status]").val(details[i][2])
                                    .trigger('change');
                                $("[data-unit_id=" + id + "] input[name=price]").val(details[i][3]);
                                $("[data-unit_id=" + id + "] select[name=furnished_status]").val(details[i][4])
                                    .trigger('change');
                            }
                        }
                    }
                    $('#show_building_address').val($('#building_id').find(":selected").attr('data-addr'));
                    triggerChangeinput()
                }
            });
        }

        function image() {
            $('#imageModel').modal('show');
        }
        function image1(){
            $('#imageModel2').modal('show');
        }
            function image2(){
                $('#imageModel3').modal('show');

            }

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        function generate_contact_detail(id) {
            var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-3 m-b-10">' +
                '       <input class="form-control" name="owner_name" type="text"' +
                '            autocomplete="off" placeholder="Name">' +
                '     </div>' +
                '     <div data-contact_id= ' + id +
                ' class="form-group col-md-3 m-b-10">' +
                '       <input class="form-control" name="owner_contact_no"' +
                '           type="text"  autocomplete="off"' +
                '           placeholder="Contact No.">' +
                '   </div>' +
                '       <div data-contact_id= ' + id +
                ' class="form-group col-md-3 m-b-4 mb-3">' +
                '    <select class="form-select" name="owner_status">' +
                '     <option value="">Contact Status</option>' +
                '    <option value="Contactable">Contactable</option>' +
                '     <option value="Not Contactable">Not Contactable</option>' +
                '  </select>  </div>' +
                '<div data-contact_id= ' + id +
                ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
                ' class="remove_owner_contacts btn btn-danger btn-air-danger" type="button">-</button>  </div>';
            return myvar;
        }

        function generate_unit_detail(id) {
            var myvar = '<div class="row"><div  data-unit_id= ' + id + ' class="form-group col-md-1 m-b-10">' +
                '            <input class="form-control" name="wing" ' +
                '                type="text"  autocomplete="off" placeholder="Wing">' +
                '        </div>' +
                '<div  data-unit_id= ' + id + ' class="form-group col-md-1 m-b-10">' +
                '            <input class="form-control" name="unit_unit_no" ' +
                '                type="text"  autocomplete="off" placeholder="Unit No.">' +
                '        </div>' +
                '        <div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-4 mb-3">' +
                '            <select class="form-select" name="unit_status">' +
                '                <option value="">Unit Status</option>' +
                '                <option value="Contactable">Available</option>' +
                '                <option value="Rent Out">Rent Out</option>' +
                '                <option value="Sold Out">Sold Out</option>' +
                '            </select>' +
                '        </div>' +
                '<div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-10">' +
                '            <input class="form-control" name="price indian_currency_amount " ' +
                '                type="text"  autocomplete="off" placeholder="price">' +
                '        </div>' +
                '        <div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-4 mb-3">' +
                '            <select class="form-select" name="furnished_status">' +
                '                <option value="">Furnished Status</option>' +
                '            </select>' +
                '        </div>' +
                '<div data-unit_id= ' + id +
                ' class="form-group col-md-1 m-b-4 mb-3"><button data-unit_id=' + id +
                ' class="remove_units btn btn-danger btn-air-danger" type="button">-</button>  </div></div>';
            return myvar;
        }

        $(document).on('click', '#add_owner_contacts', function(e) {
            id = makeid(10);
            $('#all_owner_contacts').append(generate_contact_detail(id));
            $("#all_owner_contacts select").each(function(index) {
                $(this).select2();
            })
        })
        $(document).on('click', '.remove_owner_contacts', function(e) {
            id = $(this).attr('data-contact_id');
            $("[data-contact_id=" + id + "]").each(function(index) {
                $(this).remove();
            });
        })

        $(document).on('click', '#add_units', function(e) {
            id = makeid(10);
            $('#all_units').append(generate_unit_detail(id));
            $("#all_units select").each(function(index) {
                $(this).select2();
            })
        })
        $(document).on('click', '.remove_units', function(e) {
            id = $(this).attr('data-unit_id');
            $("[data-unit_id=" + id + "]").each(function(index) {
                $(this).remove();
            });
        })
    </script>
    @endpush
