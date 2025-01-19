@extends('admin.layouts.app')
@section('content')
    <div class="page-body" x-data="view_project_details">
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
                            <h5 class="mb-3">Project Details</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row px-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <ul class="nav nav-pills sticky-nav-menu-tab mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link mx-1"
                                                        :class="active_tab == '' ? 'active' : ''"                                          
                                                        type="button"
                                                        @click="tabShow()"
                                                    >Summary</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link mx-1"
                                                        :class="active_tab == 'project_address' ? 'active' : ''"                                       
                                                        type="button"
                                                        @click="tabShow('project_address')"
                                                    >Project Information</button>
                                                </li>

                                                @if ($project->property_category == 259 || $project->property_category == 260)
                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link mx-1"
                                                        :class="active_tab == 'tower_details' ? 'active' : ''"                                       
                                                        type="button"
                                                        @click="tabShow('tower_details')"
                                                    >Basic Info</button>
                                                </li>
                                                @endif

                                                @if ($project->property_type  == 87 && ($project->property_category == '254' || $project->property_category == '257' || $project->property_category == '255'))
                                                    <li class="nav-item" role="presentation">
                                                        <button
                                                            class="nav-link mx-1"
                                                            :class="active_tab == 'wing_details' ? 'active' : ''"                                          
                                                            type="button"
                                                            @click="tabShow('wing_details')"
                                                        >Basic Info</button>
                                                    </li>
                                                @endif

                                                @if ($project->property_category == 261)
                                                    <li class="nav-item" role="presentation">
                                                        <button
                                                            class="nav-link mx-1"
                                                            :class="active_tab == 'stor_indu' ? 'active' : ''"                                        
                                                            type="button"
                                                            @click="tabShow('stor_indu')"
                                                        >Basic Info</button>
                                                    </li>
                                                @endif

                                                @if ($project->property_category == 262 || $project->property_category == 256)
                                                    <li class="nav-item" role="presentation">
                                                        <button
                                                            class="nav-link mx-1"
                                                            :class="active_tab == 'land_plot_details' ? 'active' : ''"                                        
                                                            type="button"
                                                            @click="tabShow('land_plot_details')"
                                                        >Basic Info</button>
                                                    </li>
                                                @endif

                                                @if ($project->property_type  == 88)
                                                    <li class="nav-item" role="presentation">
                                                        <button
                                                            class="nav-link mx-1"
                                                            :class="active_tab == 'office_and_retail' ? 'active' : ''"                                          
                                                            type="button"
                                                            @click="tabShow('office_and_retail')"
                                                        >Basic Info</button>
                                                    </li>
                                                @endif

                                                @if ($project->property_type  == 89)
                                                    <li class="nav-item" role="presentation">
                                                        <button
                                                            class="nav-link mx-1"
                                                            :class="active_tab == 'residential_and_commercial' ? 'active' : ''"                                          
                                                            type="button"
                                                            @click="tabShow('residential_and_commercial')"
                                                        >Basic Info</button>
                                                    </li>
                                                @endif

                                                <li class="nav-item" role="presentation">
                                                    <button
                                                        class="nav-link mx-1"
                                                        :class="active_tab == 'parking_details_and_amenities' ? 'active' : ''"                                          
                                                        type="button"
                                                        @click="tabShow('parking_details_and_amenities')"
                                                    >Parking / Amenities</button>
                                                </li>

                                                <div class="row pull-right" style="display: contents;">
                                                    <div class="col-md-1">
                                                        <a href={{ URL::to("admin/Projects") }}>
                                                            <button class="nav-link mx-1 active" id="v-view-summary-tab">Back</button>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="{{ URL::to('admin/project/edit/'.$project->id)}} ">
                                                            <button class="nav-link mx-1 active" id="v-view-summary-tab">Edit</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>

                                    @php
                                        $map_unit = $mapunits;

                                        $sub_category_key = [
                                            1 => 'Office Space',
                                            2 => 'Co-Working, ',
                                            3 => 'Ground Floor, ',
                                            4 => '1st Floor, ',
                                            5 => '2nd Floor, ',
                                            6 => '3rd Floor, ',
                                            7 => 'Warehouse, ',
                                            8 => 'Cold Storage, ',
                                            9 => 'IND. Shed, ',
                                            10 => 'Plotting, ',
                                            11 => 'Agricultural / Farm Land, ',
                                            12 => 'Industrial Land, ',
                                            13 => '1 RK, ',
                                            14 => '1 BHK, ',
                                            15 => '2 BHK, ',
                                            16 => '3 BHK, ',
                                            17 => '4 BHK, ',
                                            18 => '4+ BHK, ',
                                            21 => '1 BED, ',
                                            22 => '2 BED, ',
                                            23 => '3 BED, ',
                                            24 => '4 BED, ',
                                            25 => '4+ BED, ',

                                            35 => 'Office Space',
                                            36 => 'Co-Working, ',
                                            37 => 'Ground Floor, ',
                                            38 => '1st Floor, ',
                                            39 => '2nd Floor, ',
                                            40 => '3rd Floor, ',
                                        ];
                                    @endphp
                                    
                                    <div id="project_summary" class="mt-3">
                                        
                                    </div>

                                    <div id="project_address" class="mt-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Project Information</h5>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_1">
                                                        <h6 for="Client Name"><b>Project Name</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_1">
                                                        <div>: {{ $project->project_name }}</div>
                                                    </div>

                                                    @if($project->website)
                                                    <div class="form-group col-4 m-b-20 data_conent_3">
                                                        <h6><b>Website</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_3">
                                                        <div style="text-transform: lowercase !important;">: {{ $project->website }}</div>
                                                    </div>
                                                    @endif
                                                    
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Project Status</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div>: {{ $project->project_status == 142 ? 'Ready Possession' : 'Under Construction' }}</div>
                                                    </div>

                                                    @if ($project->project_status == 142)
                                                        <div class="form-group col-4 m-b-20 data_conent_4">
                                                            <h6><b>Age of property</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_4">
                                                            <div>: {{ $project->project_status_question }}</div>
                                                        </div>
                                                    @endif
                                                    @if ($project->project_status == 143)
                                                        <div class="form-group col-4 m-b-20 data_conent_4">
                                                            <h6><b>Possession month & year</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_4">
                                                            <div>: {{ $project->project_status_question }}</div>
                                                        </div>
                                                    @endif

                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Builder Name</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div>: {{ $project->builder_name }}</div>
                                                    </div>

                                                    @if($project->rera_number)
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Rera Number</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div style="text-transform: none !important;">: {{ $project->rera_number }}</div>
                                                    </div>
                                                    @endif
                                                    
                                                    @if($project->land_area)
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Total Land Area</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div style="text-transform: none !important;">: {{ $project->land_area }} {{ $map_unit[$project->land_size_unit] ?? '-' }}</div>
                                                    </div>
                                                    @endif

                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Remark</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div>: {{ $project->remark ?? '-' }}</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Address Details</h5>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_1">
                                                        <h6 for="Client Name"><b>State</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_1">
                                                        <div>: {{ $project->state_name }}</div>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_2">
                                                        <h6><b>City</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2">
                                                        <div>: {{ $project->city_name }}</div>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_2">
                                                        <h6><b>Locality</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2">
                                                        <div>: {{ $project->area_name }}</div>
                                                    </div>
                                                    
                                                    @if($project->pincode)
                                                    <div class="form-group col-4 m-b-20 data_conent_2">
                                                        <h6><b>Pincode</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2">
                                                        <div>: {{ $project->pincode }}</div>
                                                    </div>
                                                    @endif

                                                    @if($project->location_link)
                                                    <div class="form-group col-4 m-b-20 data_conent_2">
                                                        <h6><b>Location Link</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2" style="text-transform: lowercase !important;">
                                                        <div>: {{ $project->location_link }}</div>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Other Information</h5>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Property Type</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        @if ($project->property_type == 85)
                                                            <div>: Commercial</div>
                                                        @endif
                                                        @if ($project->property_type == 87)
                                                            <div>: Residential</div>
                                                        @endif
                                                        @if ($project->property_type == 88)
                                                            <div>: Office & Retail</div>
                                                        @endif
                                                        @if ($project->property_type == 89)
                                                            <div>: Residential & Commercial</div>
                                                        @endif
                                                    </div>

                                                    @if ($project->property_type != 88 || $project->property_type != 89)
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Category</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div>: {{ $project->category_name }}</div>
                                                    </div>

                                                    
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <h6><b>Sub Category</b></h6>
                                                    </div>

                                                    <div class="form-group col-8 m-b-20 data_conent_4">
                                                        <div>:
                                                            @if (count(json_decode($project->sub_categories)) > 0)
                                                                @foreach (json_decode($project->sub_categories) as $index => $category)
                                                                    <span>{{ $sub_category_key[$category] ?? '-' }}</span>                  
                                                                @endforeach
                                                            @else
                                                                <span>{{ $sub_category_key[$project->sub_category_single] ?? '-' }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Contact Details</h5>
                                            </div>
                                            <div class="col-md-12 mb-2 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sr No.</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Mobile</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Designation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->contacts as $index => $contact)
                                                            <tr>
                                                                <td>{{$index + 1}}</td>
                                                                <td>{{$contact['name']}}</td>
                                                                <td>{{$contact['mobile']}}</td>
                                                                <td style="text-transform: none !important;">{{ $contact['email'] != '' ? $contact['email'] : '-' }}</td>
                                                                <td>{{ $contact['designation'] != '' ? $contact['designation'] : '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tower_details" class="mt-3">
                                        @if ($project->property_category == 259 || $project->property_category == 260)
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Tower Details</h5>
                                            </div>
                                            <div class="col-md-12 mb-3 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Number Of Tower</th>
                                                            <th scope="col">Number Of Floor</th>
                                                            <th scope="col">Number Of Unit</th>
                                                            <th scope="col">Number of units in each tower</th>
                                                            <th scope="col">Number of lift</th>
                                                            <th scope="col">Road Width</th>
                                                            <th scope="col">Washroom</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$project->if_office_retail['number_of_tower']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_floor']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_unit']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_unit_each_block']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_lift']}}</td>
                                                            <td>
                                                                @if($project->if_office_retail['front_road_width'] != '')
                                                                    {{$project->if_office_retail['front_road_width']}}
                                                                    <span>{{ $map_unit[$project->if_office_retail['front_road_width_map_unit']] }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$project->if_office_retail['washroom']}}</td>
                                                        </tr>
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif

                                        @if ($project->property_category == 259)
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Unit Details</h5>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sr No.</th>
                                                            <th scope="col">Tower Name</th>
                                                            <th scope="col">Saleable</th>
                                                            <th scope="col">Ceilling Height</th>
                                                            <th scope="col">Carpet</th>
                                                            <th scope="col">Built Up</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->if_office as $index => $office_tower)
                                                        <tr>
                                                            <td>{{$index + 1}}</td>
                                                            <td>{{$office_tower['tower_name']}}</td>
                                                            <td>
                                                                @if($office_tower['saleable'])
                                                                    {{$office_tower['saleable']}} - {{ $office_tower['saleable_to'] }} {{ $office_tower['saleable_from_to_map_unit'] > 0 ? $map_unit[$office_tower['saleable_from_to_map_unit']] : '' }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($office_tower['ceiling_height'])
                                                                    {{$office_tower['ceiling_height']}} {{ $office_tower['ceiling_height_map_unit'] > 0 ? $map_unit[$office_tower['ceiling_height_map_unit']] : '' }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($office_tower['carpet'])
                                                                    {{$office_tower['carpet']}} - {{ $office_tower['carpet_to'] }} {{ $office_tower['carpet_from_to_map_unit'] > 0 ? $map_unit[$office_tower['carpet_from_to_map_unit']] : '' }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($office_tower['built_up'])
                                                                    {{$office_tower['built_up']}} - {{ $office_tower['built_up_to'] }} {{ $office_tower['built_from_to_map_unit'] > 0 ? $map_unit[$office_tower['built_from_to_map_unit']] : '' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif

                                        @if ($project->property_category == 260)
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Unit Details</h5>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tower Name</th>
                                                            <th scope="col">Floor</th>
                                                            <th scope="col">Size</th>
                                                            <th scope="col">Front Opening</th>
                                                            <th scope="col">Number of each floor</th>
                                                            <th scope="col">Ceiling Height</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->if_retail as $retail_tower)
                                                        <tr>
                                                            <td>{{$retail_tower['tower_name']}}</td>
                                                            <td>{{$retail_tower['sub_category']}}</td>
                                                            <td>
                                                                @if($retail_tower['size_from'] != '' && $retail_tower['size_to'] !='')
                                                                    {{$retail_tower['size_from']}} - {{$retail_tower['size_to']}}
                                                                    <span>
                                                                        {{ $map_unit[$retail_tower['size_from_map_unit']] }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($retail_tower['front_opening'] != '')
                                                                {{$retail_tower['front_opening']}} {{ $map_unit[$retail_tower['tower_front_opening_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            <td>{{$retail_tower['number_of_each_floor']}}</td>
                                                            <td>
                                                                @if($retail_tower['ceiling_height'] != '')
                                                                {{$retail_tower['ceiling_height']}}
                                                                <span>
                                                                    {{ $map_unit[$retail_tower['tower_ceiling_map_unit']] }}
                                                                </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div id="wing_details" class="mt-3">
                                        @if ($project->property_type == 87 && ($project->property_category == '254' || $project->property_category == '257' || $project->property_category == '255'))
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style mb-1">Basic Details</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <table class="table custom-table-design" style="border:1px solid blue">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Number Of Tower</th>
                                                                <th scope="col">Number Of Floor</th>
                                                                <th scope="col">Total Unit</th>
                                                                <th scope="col">Number Of Elevator In Each Tower</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $new_data = json_decode($project->tower_details, true)['if_flat_or_penthouse'];
                                                                $if_flat = json_decode($new_data);
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $if_flat->number_of_towers }}</td>
                                                                <td>{{ $if_flat->number_of_floors }}</td>
                                                                <td>{{ $if_flat->total_units }}</td>
                                                                <td>{{ $if_flat->number_of_elevator }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group col-md-12 mt-3">
                                                    <h5 class="border-style mb-1">Tower Details</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <table class="table custom-table-design" style="border:1px solid blue">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tower Name</th>
                                                                <th scope="col">Number Of Floor</th>
                                                                <th scope="col">Number Of Unit</th>
                                                                <th scope="col">Sub Category</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($project->if_recidential_wing as $wing_detail)
                                                            <tr>
                                                                <td>{{$wing_detail['wing_name']}}</td>
                                                                <td>{{$wing_detail['total_floors']}}</td>
                                                                <td>{{$wing_detail['total_total_units']}}</td>
                                                                <td>
                                                                    @foreach($wing_detail['sub_categories'] as $index => $sub_category)
                                                                        @if ($index != 0)
                                                                            <span>, </span>
                                                                        @endif
                                                                        <span>{{ $sub_category }}</span>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        <tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12 mt-3">
                                                <h5 class="border-style mb-1">Unit Details</h5>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tower Name</th>
                                                            <th scope="col">Saleable</th>
                                                            <th scope="col">Built Up</th>
                                                            <th scope="col">Carpet Area</th>
                                                            <th scope="col">Balcony</th>
                                                            <th scope="col">Wash Area</th>
                                                            <th scope="col">Floor Height</th>
                                                            <th scope="col">Terrace Carpet Area</th>
                                                            <th scope="col">Terrace Saleable Area</th>
                                                            <th scope="col">Servent Room</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->units_details as $unit_detail)
                                                        <tr>
                                                            <td>{{$unit_detail['wing']}}</td>
                                                            
                                                            <td>
                                                                @if($unit_detail['saleable'] != '' && $unit_detail['saleable_to'] != '')
                                                                    {{$unit_detail['saleable']}} - {{$unit_detail['saleable_to']}} {{ $map_unit[$unit_detail['saleable_map_unit']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($unit_detail['built_up'] !='' && $unit_detail['built_up_to'] !='' && $unit_detail['has_built_up'])
                                                                    {{$unit_detail['built_up']}} - {{$unit_detail['built_up_to']}} {{ $map_unit[$unit_detail['built_up_map_unit']] }}
                                                                    @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['carpet_area'] !='' && $unit_detail['carpet_area_to'] !='' && $unit_detail['has_carpet'])
                                                                    {{$unit_detail['carpet_area']}} - {{$unit_detail['carpet_area_to']}} {{ $map_unit[$unit_detail['carpet_area_map_unit']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($unit_detail['balcony'] != '')
                                                                {{$unit_detail['balcony']}} {{ $map_unit[$unit_detail['balcony_area_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['wash_area'] != '')
                                                                    {{$unit_detail['wash_area']}} {{ $map_unit[$unit_detail['wash_area_map_unit']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($unit_detail['floor_height'] != '')
                                                                    {{$unit_detail['floor_height']}} {{ $map_unit[$unit_detail['floor_height_map_unit']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($unit_detail['terrace_carpet_area'] != '' && $unit_detail['has_terrace_and_carpet'])
                                                                    {{$unit_detail['terrace_carpet_area']}} {{ $map_unit[$unit_detail['terrace_carpet_area_map_unit']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($unit_detail['terrace_saleable_area'] != '' && $unit_detail['has_terrace_and_carpet'])
                                                                    {{$unit_detail['terrace_saleable_area']}} {{ $map_unit[$unit_detail['terrace_saleable_area_map_unit']] }}
                                                                @endif
                                                            </td>

                                                            <td>{{$unit_detail['servant_room'] != false ? 'Yes' : 'No'}}</td>
                                                        </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        @endif   
                                    </div>

                                    <div id="unit_details" class="mt-3"></div>

                                    <div id="stor_indu" class="mt-3">
                                        @if ($project->property_category == 261)
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Storage Industrial Details</h5>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border: 1px solid blue;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Plot Area</th>
                                                            <th scope="col">Constructed Area</th>
                                                            <th scope="col">Road width Area</th>
                                                            <th scope="col">Ceiling Height</th>
                                                            <th scope="col">Number Of Units</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->stor_indu as $index => $st)
                                                        <tr>

                                                            <td>
                                                                @if($st['plot_area_from'] !== '' && $st['plot_area_to'] != '')
                                                                    {{$st['plot_area_from']}} - {{$st['plot_area_to']}} {{ $map_unit[$st['carpet_from_to_unit_map']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($st['construced_area_from'] !='' && $st['construced_area_to'] !='')
                                                                    {{$st['construced_area_from']}} - {{$st['construced_area_to']}} {{ $map_unit[$st['constructed_from_to_unit_map']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($st['road_width_of_front_side_area_from'] != '' && $st['road_width_of_front_side_area_to'] != '')
                                                                    {{$st['road_width_of_front_side_area_from']}} - {{$st['road_width_of_front_side_area_to']}} {{ $map_unit[$st['road_width_of_front_side_area_from_to_unit_map']] }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($st['ceiling_height'])
                                                                    {{$st['ceiling_height']}} {{ $map_unit[$st['ceiling_height_unit_map']] }}
                                                                @endif
                                                            </td>

                                                            <td>{{ $st['number_of_units'] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Facilities</h5>
                                            </div>

                                            @if ($project->stor_indu_facility['pcb_detail'] != '')
                                                <div class="form-group col-4 m-b-20 data_conent_4 mt-3">
                                                    <h6><b>Pollution Control Board</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_4 mt-3">
                                                    <div>: {{$project->stor_indu_facility['pcb_detail']}}</div>
                                                </div>
                                            @endif

                                            @if ($project->stor_indu_facility['ec_detail'] != '')

                                                <div class="form-group col-4 m-b-20 data_conent_4">
                                                    <h6><b>EC</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_4">
                                                    <div>: {{$project->stor_indu_facility['ec_detail']}}</div>
                                                </div>

                                            @endif

                                            @if ($project->stor_indu_facility['gas_detail'] != '')
                                                <div class="form-group col-4 m-b-20 data_conent_4">
                                                    <h6><b>Gas</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_4">
                                                    <div>: {{$project->stor_indu_facility['gas_detail']}}</div>
                                                </div>
                                            @endif

                                            @if ($project->stor_indu_facility['power_detail'] != '')

                                                <div class="form-group col-4 m-b-20 data_conent_4">
                                                    <h6><b>Power</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_4">
                                                    <div>: {{$project->stor_indu_facility['power_detail']}}</div>
                                                </div>

                                            @endif

                                            @if ($project->stor_indu_facility['water_detail'] != '')

                                                <div class="form-group col-4 m-b-20 data_conent_4">
                                                    <h6><b>Water</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_4">
                                                    <div>: {{$project->stor_indu_facility['water_detail']}}</div>
                                                </div>

                                            @endif

                                            @foreach ($project->extra_facility as $facility)
                                                <div class="form-group col-4 m-b-20 data_conent_4">
                                                    <h6><b>{{ $facility['name'] }}</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_4">
                                                    <div>: {{ $facility['detail'] }}</div>
                                                </div>
                                            @endforeach
                                        
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div id="land_plot_details" class="mt-3">
                                        @if ($project->property_category == 262 || $project->property_category == 256 || $project->property_category == 258 )
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Basic Detail</h5>
                                                    </div>

                                                    @if($project->land_plot['total_open_area'] !='')
                                                    <div class="form-group col-4 m-b-20 data_conent_1">
                                                        <h6 for="Client Name"><b>Total Open Area</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2">
                                                        <div>: {{ $project->land_plot['total_open_area'] }} {{ $map_unit[$project->land_plot['open_area_map_unit']] }}</div>
                                                    </div>
                                                    @endif

                                                    @if($project->land_plot['phase_name'] != '')
                                                    <div class="form-group col-4 m-b-20 data_conent_1">
                                                        <h6 for="Client Name"><b>Phase Name</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2">
                                                        <div>: {{ $project->land_plot['phase_name'] }}</div>
                                                    </div>
                                                    @endif

                                                    @if($project->land_plot['plot_size_from'] !='' && $project->land_plot['plot_size_to'] !='')
                                                    <div class="form-group col-4 m-b-20 data_conent_1">
                                                        <h6 for="Client Name"><b>Saleable Plot Size From</b></h6>
                                                    </div>
                                                    <div class="form-group col-8 m-b-20 data_conent_2">
                                                        <div>: {{ $project->land_plot['plot_size_from'] }} - {{ $project->land_plot['plot_size_to'] }} {{ $project->land_plot['plot_size_from_map_unit'] ? $map_unit[$project->land_plot['plot_size_from_map_unit']] : '' }}</div>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h5 class="border-style">Other Size Details</h5>
                                                    </div>

                                                    @if($project->land_plot['constructed_saleable_area'] !='' )
                                                    <div class="form-group col-6 m-b-20 data_conent_4">
                                                        <h6><b>Constructed Saleable Area</b></h6>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <div>: {{ $project->land_plot['constructed_saleable_area'] }} {{ $project->land_plot['constructed_saleable_area_map_unit'] ? $map_unit[$project->land_plot['constructed_saleable_area_map_unit']] : '' }}</div>
                                                    </div>
                                                    @endif

                                                    <div class="form-group col-6 m-b-20 data_conent_4">
                                                        <h6><b>Servant Room</b></h6>
                                                    </div>
                                                    <div class="form-group col-4 m-b-20 data_conent_4">
                                                        <div>: {{ $project->land_plot['servant_room'] != false ? 'Yes' : 'No' }} </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div id="parking_details_and_amenities" class="mt-3">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Parking Details</h5>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="form-group col-4 m-b-20 data_conent_1">
                                                    <h6 for="Client Name"><b>Free Alloted Parking For Four Wheeler</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_1">
                                                    <div>: {{ $project->parkings_decode['free_alloted_for_four_wheeler'] != "false" ? 'Yes' : 'No' }}</div>
                                                </div>
                                                <div class="form-group col-4 m-b-20 data_conent_1">
                                                    <h6 for="Client Name"><b>Free Alloted Parking For Two Wheeler</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_1">
                                                    <div>: {{ $project->parkings_decode['free_alloted_for_two_wheeler'] != "false" ? 'Yes' : 'No' }}</div>
                                                </div>
                                                <div class="form-group col-4 m-b-20 data_conent_1">
                                                    <h6 for="Client Name"><b>Available For Purchase</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_1">
                                                    <div>: {{ $project->parkings_decode['available_for_purchase'] != "false" ? 'Yes' : 'No' }}</div>
                                                </div>
                                                <div class="form-group col-4 m-b-20 data_conent_1">
                                                    <h6 for="Client Name"><b>Total Number Of Parking</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_1">
                                                    <div>: {{ $project->parkings_decode['total_number_of_parking'] != '' ? $project->parkings_decode['total_number_of_parking'] : '-' }}</div>
                                                </div>
                                                <div class="form-group col-4 m-b-20 data_conent_1">
                                                    <h6 for="Client Name"><b>Total Floor For Parking</b></h6>
                                                </div>
                                                <div class="form-group col-8 m-b-20 data_conent_1">
                                                    <div>: {{ $project->parkings_decode['total_floor_for_parking'] != '' ? $project->parkings_decode['total_floor_for_parking'] : '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Floor Number</th>
                                                            <th scope="col">EV Charging</th>
                                                            <th scope="col">Hydraulic Charger</th>
                                                            <th scope="col">Height</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->parkings as $parking)
                                                            <tr>
                                                                <td>{{$parking['floor_number']}}</td>
                                                                <td>{{$parking['ev_charging_point']}}</td>
                                                                <td>{{$parking['hydraulic_parking']}}</td>
                                                                <td>
                                                                    @if($parking['height_of_basement'] != '')
                                                                        {{$parking['height_of_basement']}} {{ $parking['height_of_basement'] ? $map_unit[$parking['height_of_basement_map_unit']] : '' }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Amenities</h5>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->amenity_array ?? [] as $index => $amenity)
                                                            <tr>
                                                                <td>{{ Str::title(str_replace('_', ' ', $amenity)) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Documents</h5>
                                            </div>

                                            <?php
                                                $docu_types = [
                                                    1 => 'Building Elevation',
                                                    2 => 'Common Amenities Photos',
                                                    3 => 'Master Layout Of Building',
                                                    4 => 'Brochure',
                                                    5 => 'Cost Sheet',
                                                    6 => 'Other',
                                                ];
                                            ?>

                                            <div class="col-md-12 mt-3">
                                                <b class="text-center">Other Documents</b>
                                                <table class="table custom-table-design mt-2" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $docu_types[$project->document_category] ?? '' }}</td>
                                                            <td><span class="text-primary" style="cursor: pointer;" onclick="openDocument(`{{ $project->document_image }}`)">{{ $project->document_image }}</span></td>
                                                        </tr>

                                                        @foreach($project->other_documents as $other_doc)
                                                            <tr>
                                                                <td>{{ $docu_types[$other_doc['document_type']] }}</td>
                                                                <td><span class="text-primary" style="cursor: pointer;" onclick="openDocument(`{{ $other_doc['file'] }}`)">{{ $other_doc['file'] }}</span></td>
                                                            </tr>
                                                        @endforeach

                                                    <tbody>
                                                </table>
                                            </div>

                                            <div class="row gy-2">
                                                <div class="col mt-2">
                                                    Catlog File : <span class="text-primary" style="cursor: pointer;" onclick="openDocument('{{ $project->catlog_file }}')">{{ $project->catlog_file }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="office_and_retail" class="mt-4">
                                        @if ($project->property_type  == 88)
                                        <div class="row">
                                            <h4 class="text-center">Office Detail</h4>
                                            <div class="form-group col-md-12">
                                                <h5 class="border-style mb-1">Tower Details</h5>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Number Of Tower</th>
                                                            <th scope="col">Number Of Floor</th>
                                                            <th scope="col">Number Of Unit</th>
                                                            <th scope="col">Number of units in each tower</th>
                                                            <th scope="col">Number of lift</th>
                                                            <th scope="col">Road Width</th>
                                                            <th scope="col">Washroom</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$project->if_office_retail['number_of_tower']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_floor']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_unit']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_unit_each_block']}}</td>
                                                            <td>{{$project->if_office_retail['number_of_lift']}}</td>
                                                            <td>
                                                                @if($project->if_office_retail['front_road_width'] != '')
                                                                    {{$project->if_office_retail['front_road_width']}}
                                                                    <span>{{ $map_unit[$project->if_office_retail['front_road_width_map_unit']] }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$project->if_office_retail['washroom']}}</td>
                                                        </tr>
                                                    <tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style mb-1">Unit Details</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <table class="table custom-table-design" style="border:1px solid blue">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tower Name</th>
                                                                <th scope="col">Total Unit</th>
                                                                <th scope="col">Saleable</th>
                                                                <th scope="col">Carpet</th>
                                                                <th scope="col">Built Up</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($project->if_office as $office_tower)
                                                            <tr>
                                                                <td>{{$office_tower['tower_name']}}</td>
                                                                <td>{{$office_tower['total_unit']}}</td>
                                                                <td>
                                                                    {{$office_tower['saleable']}} - {{ $office_tower['saleable_to'] }}
                                                                    <span>{{ $map_unit[$office_tower['saleable_from_to_map_unit']] }}</span>
                                                                </td>
                                                                <td>
                                                                    {{$office_tower['carpet'] ?? '-'}} - {{ $office_tower['carpet_to'] ?? '-' }}
                                                                    <span>{{ $map_unit[$office_tower['carpet_from_to_map_unit']] ?? '-' }}</span>
                                                                </td>
                                                                <td>
                                                                    {{$office_tower['built_up']}} - {{ $office_tower['built_up_to'] }}
                                                                    <span>{{ $map_unit[$office_tower['built_from_to_map_unit']] }}</span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        <tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <h4 class="text-center mt-4">Retail Detail</h4>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style mb-1">Unit Details</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <table class="table custom-table-design" style="border:1px solid blue">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tower Name</th>
                                                                <th scope="col">Size</th>
                                                                <th scope="col">Front Opening</th>
                                                                <th scope="col">Number of each floor</th>
                                                                <th scope="col">Ceiling Height</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($project->if_retail as $retail_tower)
                                                            <tr>
                                                                <td>{{$retail_tower['tower_name']}}</td>
                                                                <td>
                                                                    {{$retail_tower['size_from']}} - {{$retail_tower['size_to']}}
                                                                    <span>
                                                                        {{ $map_unit[$retail_tower['size_from_map_unit']] }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{$retail_tower['front_opening']}} {{ $map_unit[$retail_tower['tower_front_opening_map_unit']] }}
                                                                </td>
                                                                <td>{{$retail_tower['number_of_each_floor']}}</td>
                                                                <td>{{$retail_tower['ceiling_height']}} <span>
                                                                    {{ $map_unit[$retail_tower['tower_ceiling_map_unit']] }}
                                                                </span></td>
                                                            </tr>
                                                            @endforeach
                                                        <tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div id="residential_and_commercial" class="mt-4">
                                        @if ($project->property_type  == 89)
                                        <div class="row">
                                            <h4 class="text-center mt-4">Retail Detail</h4>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style mb-1">Unit Details</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <table class="table custom-table-design" style="border:1px solid blue">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tower Name</th>
                                                                <th scope="col">Size</th>
                                                                <th scope="col">Front Opening</th>
                                                                <th scope="col">Number of each floor</th>
                                                                <th scope="col">Ceiling Height</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($project->if_retail as $retail_tower)
                                                            <tr>
                                                                <td>{{$retail_tower['tower_name']}}</td>
                                                                
                                                                <td>
                                                                    @if($retail_tower['size_from'] !='' && $retail_tower['size_to'] !='')
                                                                    {{$retail_tower['size_from']}} - {{$retail_tower['size_to']}}
                                                                    <span>
                                                                        {{ $map_unit[$retail_tower['size_from_map_unit']] }}
                                                                    </span>
                                                                    @endif
                                                                </td>
                                                                
                                                                <td>
                                                                    @if($retail_tower['front_opening'] !='')
                                                                        {{$retail_tower['front_opening']}} {{ $map_unit[$retail_tower['tower_front_opening_map_unit']] }}
                                                                    @endif
                                                                </td>

                                                                <td>{{$retail_tower['number_of_each_floor']}}</td>

                                                                <td>
                                                                    @if($retail_tower['ceiling_height'])
                                                                        {{$retail_tower['ceiling_height']}} <span>
                                                                        {{ $map_unit[$retail_tower['tower_ceiling_map_unit']] }}
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        <tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <h4 class="text-center mt-4">Flat And Penthouse Detail</h4>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style mb-1">Tower Details</h5>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <table class="table custom-table-design" style="border:1px solid blue">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tower Name</th>
                                                                <th scope="col">Number Of Floor</th>
                                                                <th scope="col">Number Of Unit</th>
                                                                <th scope="col">Sub Category</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($project->if_recidential_wing as $wing_detail)
                                                            <tr>
                                                                <td>{{$wing_detail['wing_name']}}</td>
                                                                <td>{{$wing_detail['total_floors']}}</td>
                                                                <td>{{$wing_detail['total_total_units']}}</td>
                                                                <td>
                                                                    @foreach($wing_detail['sub_categories'] as $index => $sub_category)
                                                                        @if ($index != 0)
                                                                            <span>, </span>
                                                                        @endif
                                                                        <span>{{ $sub_category }}</span>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        <tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12 mt-3">
                                                <h5 class="border-style mb-1">Unit Details</h5>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <table class="table custom-table-design" style="border:1px solid blue">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tower Name</th>
                                                            <th scope="col">Saleable</th>
                                                            <th scope="col">Built Up</th>
                                                            <th scope="col">Carpet Area</th>
                                                            <th scope="col">Balcony</th>
                                                            <th scope="col">Wash Area</th>
                                                            <th scope="col">Terrace Carpet Area</th>
                                                            <th scope="col">Terrace Saleable Area</th>
                                                            <th scope="col">Floor Height</th>
                                                            <th scope="col">Servent Room</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->units_details as $unit_detail)
                                                        <tr>
                                                            <td>{{$unit_detail['wing']}}</td>
                                                            
                                                            <td>
                                                                @if($unit_detail['saleable'] != '' && $unit_detail['saleable_to'] !='')
                                                                    {{$unit_detail['saleable']}} - {{$unit_detail['saleable_to']}} {{ $map_unit[$unit_detail['saleable_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['built_up'] !='' && $unit_detail['built_up_to'] !='')
                                                                    {{$unit_detail['built_up']}} - {{$unit_detail['built_up_to']}} {{ $map_unit[$unit_detail['built_up_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['carpet_area'] !='' && $unit_detail['carpet_area_to'] !='')
                                                                {{$unit_detail['carpet_area']}} - {{$unit_detail['carpet_area_to']}} {{ $map_unit[$unit_detail['carpet_area_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['balcony'] != '')
                                                                {{$unit_detail['balcony']}} {{ $map_unit[$unit_detail['balcony_area_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['wash_area'] !='')
                                                                    {{$unit_detail['wash_area']}} {{ $map_unit[$unit_detail['wash_area_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['terrace_carpet_area'] !='')
                                                                    {{$unit_detail['terrace_carpet_area']}} {{ $map_unit[$unit_detail['terrace_carpet_area_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['terrace_saleable_area_to'] !='')
                                                                    {{$unit_detail['terrace_saleable_area_to']}} {{ $map_unit[$unit_detail['terrace_saleable_area_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if($unit_detail['floor_height'] !='')
                                                                    {{$unit_detail['floor_height']}} {{ $map_unit[$unit_detail['floor_height_map_unit']] }}
                                                                @endif
                                                            </td>
                                                            
                                                            <td>{{$unit_detail['servant_room'] != false ? 'Yes' : 'No'}}</td>
                                                        </tr>
                                                        @endforeach
                                                    <tbody>
                                                </table>
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
    </div>
    @endsection

    @push('scripts')
    
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="text/javascript">

        function openDocument(file_name) {
            let filename = file_name;
            let url = '{{ route("admin.project.document", ["filename" => ":filename"]) }}';
            url = url.replace(':filename', filename);

            // Open the document in a new window
            window.open(url, '_blank');
        }

        document.addEventListener('alpine:init', () => {

            Alpine.data('view_project_details', () => ({

                active_tab : '',

                tab_ids : [
                    'project_summary',
                    'project_address',
                    'tower_details',
                    'wing_details',
                    'unit_details',
                    'office_and_retail',
                    'residential_and_commercial',
                    'stor_indu',
                    'land_plot_details',
                    'parking_details_and_amenities',
                ],

                tabShow(tab_id = '') {

                    if(tab_id != '')
                    {
                        this.tab_ids.forEach(div_id => {
                            if(tab_id == div_id) {
                                document.getElementById(div_id).classList.remove('d-none');     
                            } else {
                                document.getElementById(div_id).classList.add('d-none');
                            }
                        });
                    } else {
                        this.tab_ids.forEach(div_id => {
                            document.getElementById(div_id).classList.remove('d-none');
                        });
                    }

                    this.active_tab = tab_id;
                }
                
            }));
        });

    </script>

    @endpush
