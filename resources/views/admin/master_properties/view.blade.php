@extends('admin.layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="mb-3">Details of Property <a class="btn custom-icon-theme-button tooltip-btn" href="{{ route('admin.master_properties.index') }}" data-tooltip="Back" style="float: inline-end;">
                            <i class="fa fa-backward"></i>
                        </a></h5>
                    </div>
                    <div class="card-body">
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
                                            {{ $property_master->propertyFor ? $property_master->propertyFor->name : '' }}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_2">
                                        <h6><b>Type</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_2">
                                        <div>:
                                        {{ $property_master->propertyConstructionType ? $property_master->propertyConstructionType->name : '' }}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_3">
                                        <h6><b>Category</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_3">
                                        <div>:
                                        {{ $property_master->propertyCategory ? $property_master->propertyCategory->name : '' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_3">
                                        <h6><b>Sub Category</b></h6>
                                    </div>

                                    <div class="form-group col-8 m-b-10 data_conent_3">
                                        <div>:
                                        {{ $property_master->propertySubCategory ? $property_master->propertySubCategory->name : '' }}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_4">
                                        <h6><b>Project</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_4">
                                        <div>:
                                            <a href="https://updates.mrweb.co.in/bromi/public/admin/Projects?id=152" data-bs-original-title="" title="">
                                                {{ $property_master->project ? $property_master->project->project_name : '' }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_6">
                                        <h6><b>City</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_6">
                                        <div>:
                                            {{ $property_master->city ? $property_master->city->name : '' }}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_6">
                                        <h6><b>Locality</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_6">
                                        <div>:
                                        {{ $property_master->locality ? $property_master->locality->name : '' }}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_5">
                                        <h6><b>Projects Address</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_5">
                                        <div>:
                                        {{ $property_master->address ?? '' }}
                                        </div>
                                    </div>

                                    @php
                                        function findMapById($land_units , $measurment_id) {
                                            return $land_units->collect()->firstWhere('id', $measurment_id);
                                        }

                                        function findSource($sources , $source_id) {
                                            return $sources->collect()->firstWhere('id', $source_id);
                                        }

                                    @endphp
                                    

                                    <div class="form-group col-4 m-b-10 data_conent_54">
                                        <h6><b>Salable Area</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_54">:
                                        {{ $property_master->areaSizes[0]['salable_area_value'] ?? '' }} - {{ $property_master->areaSizes[0]['salable_area_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['salable_area_measurement_id'])['unit_name'] : '' }}
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_14">
                                        <h6><b>Ceilling Height</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_14">
                                        <div>:
                                            {{ $property_master->areaSizes[0]['ceiling_height_value'] ?? '' }} - {{ $property_master->areaSizes[0]['ceiling_height_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['ceiling_height_measurement_id'])['unit_name'] : '' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_14">
                                        <h6><b>Carpet Area</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_14">
                                        <div>:
                                            {{ $property_master->areaSizes[0]['carpet_area_value'] ?? '' }} - {{ $property_master->areaSizes[0]['carpet_area_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['carpet_area_measurement_id'])['unit_name'] : '' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_14">
                                        <h6><b>Terrace Saleable Area</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_14">
                                        <div>:
                                            {{ $property_master->areaSizes[0]['terrace_salable_area_value'] ?? '' }} - {{ $property_master->areaSizes[0]['terrace_salable_area_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['terrace_salable_area_measurement_id'])['unit_name'] : '' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_14">
                                        <h6><b>Terrace Carpet Area</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_14">
                                        <div>:
                                            {{ $property_master->areaSizes[0]['terrace_carpet_area_value'] ?? '' }} - {{ $property_master->areaSizes[0]['terrace_carpet_area_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['terrace_carpet_area_measurement_id'])['unit_name'] : '' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_15">
                                        <h6><b>Total Units in project</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_15">
                                        <div>:
                                            {{$property_master->units_in_project ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_16">
                                        <h6><b>Total no. of floor</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_16">
                                        <div>:
                                            {{$property_master->no_of_floors ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_17">
                                        <h6><b>Total Units in tower</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_17">
                                        <div>:
                                        {{$property_master->units_in_tower ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_18">
                                        <h6><b>Units on Floor</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_18">
                                        <div>:
                                        {{$property_master->units_in_floor ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_19">
                                        <h6><b>No Of Elavators</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_19">
                                        <div>:
                                        {{$property_master->no_of_elevators ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_33">
                                        <h6><b>Remarks</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_33">
                                        <div>:
                                            {{$property_master->remark ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_26">
                                        <h6><b>Washroom Type</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_26">
                                        @php
                                            $washroom = [
                                                1 => 'Private Washrooms',
                                                2 => 'Public Washrooms',
                                                3 => 'Not Available',
                                            ];

                                            $age_of_property = [1 => '0-1 Years', 2 => '1-5 Years', 3 => '5-10 Years', 4 => '10+ Years'];
                                        @endphp
                                        <div>:
                                            {{ $washroom[$property_master->washroom_type] }}
                                        </div>
                                    </div>

                                    @if($property_master->availability_status == 1)
                                        <div class="form-group col-4 m-b-10 data_conent_32">
                                            <h6><b>Age of property</b></h6>
                                        </div>
                                        <div class="form-group col-8 m-b-10 data_conent_32">
                                            <div>:
                                                {{ $property_master->property_age ? $age_of_property[$property_master->property_age] : '' }}
                                            </div>
                                        </div>
                                    @endif

                                    @if($property_master->availability_status == 2)
                                        <div class="form-group col-4 m-b-10 data_conent_32">
                                            <h6><b>Available from</b></h6>
                                        </div>
                                        <div class="form-group col-8 m-b-10 data_conent_32">
                                            <div>:
                                                {{ $property_master->available_from ?? '' }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group col-4 m-b-10 data_conent_51">
                                        <h6><b>Service Elavator</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_51">
                                        <div>: {{ $property_master->service_elevator == 1 ? 'Yes' : 'No' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_63">
                                        <h6><b>Hot Property</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_63">
                                        <div>: {{ $property_master->hot_property == 1 ? 'Yes' : 'No' }}</div>
                                    </div>
                                </div>
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
                                            {{ $property_master->owner_info['type'] ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_66">
                                        <h6><b>Name</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_66">
                                        <div>:
                                        {{ $property_master->owner_info['name'] ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_67">
                                        <h6><b>Mobile</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 cursor-pointer color-code-popover data_conent_67" data-bs-trigger="hover focus">
                                        <div class="highlightable">:
                                            {{ $property_master->owner_info['contact'] ?? ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_69">
                                        <h6><b>Email</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_69 text-reset" style="text-transform: none !important">
                                        <div>:
                                            {{ $property_master->owner_info['email'] ?? ''}}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5 class="border-style">Other Details</h5>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_73">
                                        <h6><b>FourWheeler Parking</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_73">
                                        <div>:
                                        {{ $property_master->fourwheller_parking ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_74">
                                        <h6><b>TwoWheeler Parking </b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_74">
                                        <div>:
                                            {{ $property_master->twowheller_parking ?? ''}}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_75">
                                        <h6><b>Source </b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_75">
                                        <div>:
                                            {{ $property_master->source ? findSource($sources, $property_master->source)['name'] : '' }}
                                        </div>
                                    </div>
                                    <div class="form-group col-4 m-b-10 data_conent_76">
                                        <h6><b>Priority</b></h6>
                                    </div>

                                    <div class="form-group col-8 m-b-10 data_conent_76">
                                        @php
                                            $priority_type = [
                                                1 => 'High',
                                                2 => 'Medium',
                                                3 => 'Low',
                                            ];
                                        @endphp
                                        <div>:
                                            {{ $property_master->priority_type ? $priority_type[$property_master->priority_type] : '' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_79">
                                        <h6><b>Location Link</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_79">
                                        <div>:
                                            <a href="{{ $property_master->location_link ?? '' }}" target="_blank" data-bs-original-title="" title="">check on map
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-4 m-b-10 data_conent_16">
                                        <h6><b>Created Date</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_16">
                                        <div>: {{ $property_master->created_at }}</div>
                                    </div>

                                    <div class="form-group col-4 m-b-10 data_conent_16">
                                        <h6><b>Last Modified Date</b></h6>
                                    </div>
                                    <div class="form-group col-8 m-b-10 data_conent_16">
                                        <div>: {{ $property_master->updated_at }}</div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="form-group col-md-12">
                                        <h5 class="border-style">Unit Details</h5>
                                    </div>
                                    @php
                                        $furni = [
                                            1 => 'Furnished',
                                            2 => 'Semi Furnished',
                                            3 => 'Unfurnished',
                                            4 => 'Can Furnished',
                                        ];
                                    @endphp
                                    <div class="col-md-12">
                                        <table class="table custom-table-design">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Wing</th>
                                                    <th scope="col">Unit</th>

                                                    <th scope="col">Price</th>
                                                    <th scope="col">Rent Price</th>
                                                    <th scope="col">Furnished Status</th>

                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tbody>
                                                @foreach ($property_master->unitDetails as $unit_details)
                                                    <tr>
                                                        <td>{{ $unit_details['wing'] ?? '' }}</td>
                                                        <td>{{ $unit_details['unit_no'] ?? '' }}</td>
                                                        <td>{{ $unit_details['price'] ?? '' }}</td>
                                                        <td>{{ $unit_details['price_rent'] ?? '' }}</td>
                                                        <td>{{ $unit_details['furniture_status'] ? $furni[$unit_details['furniture_status']] : '' }}</td>
                                                        <td>{{ $unit_details['availability_status'] == 1 ? 'Rent Out' : '' }} {{ $unit_details['availability_status'] == 2 ? 'Sold Out' : '' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mt-3">
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

                                            </tbody>
                                            <tbody>
                                                @foreach ($property_master->contactDetails as $other_contact)
                                                    <tr>
                                                        <td>{{ $other_contact['name'] }}</td>
                                                        <td>{{ $other_contact['contact_no'] }}</td>
                                                        <td>{{ $other_contact['position'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
