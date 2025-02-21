<div class="card-body">
    <div class="row">
        <div class="col-md-5">
            <div class="row">
                <div class="form-group col-md-12">
                    <h5 class="border-style">Information Storage</h5>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_1">
                    <span><b>Property For</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_1">
                    <div>:
                        {{ $property_master->propertyFor ? $property_master->propertyFor->name : '' }}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_2">
                    <span><b>Type</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_2">
                    <div>:
                        {{ $property_master->propertyConstructionType ? $property_master->propertyConstructionType->name : '' }}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_3">
                    <span><b>Category</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_3">
                    <div>:
                        {{ $property_master->propertyCategory ? $property_master->propertyCategory->name : '' }}
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_3">
                    <span><b>Sub Category</b></span>
                </div>

                <div class="form-group col-8 m-b-10 data_conent_3">
                    <div>:
                        {{ $property_master->propertySubCategory ? $property_master->propertySubCategory->name : '' }}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_4">
                    <span><b>Project</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_4">
                    <div>:
                        <a href="https://updates.mrweb.co.in/bromi/public/admin/Projects?id=152" data-bs-original-title="" title="">
                            {{ $property_master->project ? $property_master->project->project_name : '' }}
                        </a>
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_6">
                    <span><b>District</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_6">
                    <div>:
                        {{ $property_master->district ? $property_master->district->name : '' }}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_6">
                    <span><b>Taluka</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_6">
                    <div>:
                        {{ $property_master->taluka ? $property_master->taluka->name : '' }}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_6">
                    <span><b>Village</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_6">
                    <div>:
                        {{ $property_master->village ? $property_master->village->name : '' }}
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_5">
                    <span><b>Projects Address</b></span>
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
                    <span><b>Length of plot</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_54">:
                    {{ $property_master->areaSizes[0]['length_of_plot_value'] ?? '' }} - {{ $property_master->areaSizes[0]['length_of_plot_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['length_of_plot_measurement_id'])['unit_name'] : '' }}
                </div>

                <div class="form-group col-4 m-b-10 data_conent_54">
                    <span><b>Width of plot</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_54">:
                    {{ $property_master->areaSizes[0]['width_of_plot_value'] ?? '' }} - {{ $property_master->areaSizes[0]['width_of_plot_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['width_of_plot_measurement_id'])['unit_name'] : '' }}
                </div>

                <div class="form-group col-4 m-b-10 data_conent_54">
                    <span><b>Number of floors allowed</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_54">:
                    {{ $property_master->no_of_floors_allowed ?? '' }}
                </div>

                <div class="form-group col-4 m-b-10 data_conent_54">
                    <span><b>Road width of front side</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_54">:
                    {{ $property_master->areaSizes[0]['road_width_of_front_side_value'] ?? '' }} - {{ $property_master->areaSizes[0]['road_width_of_front_side_measurement_id'] ? findMapById($land_units, $property_master->areaSizes[0]['road_width_of_front_side_measurement_id'])['unit_name'] : '' }}
                </div>

                @php
                    $constru_type = [
                        1 => 'Residential',
                        2 => 'Commercial',
                        3 => 'Industrial',
                    ];
                @endphp

                <div class="form-group col-4 m-b-10 data_conent_54">
                    <span><b>Construction Allowed for</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_54">:
                    {{ $property_master->construction_allowed_for ? $constru_type[$property_master->construction_allowed_for] : '' }}
                </div>
               
                <div class="form-group col-4 m-b-10 data_conent_33">
                    <span><b>Remarks</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_33">
                    <div>:
                        {{$property_master->remark ?? ''}}
                    </div>
                </div>

                @php
                    $age_of_property = [1 => '0-1 Years', 2 => '1-5 Years', 3 => '5-10 Years', 4 => '10+ Years'];
                @endphp

                @if($property_master->availability_status == 1)
                <div class="form-group col-4 m-b-10 data_conent_32">
                    <span><b>Age of property</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_32">
                    <div>:
                        {{ $property_master->property_age ? $age_of_property[$property_master->property_age] : '' }}
                    </div>
                </div>
                @endif

                @if($property_master->availability_status == 2)
                <div class="form-group col-4 m-b-10 data_conent_32">
                    <span><b>Available from</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_32">
                    <div>:
                        {{ $property_master->available_from ?? '' }}
                    </div>
                </div>
                @endif

                <div class="form-group col-4 m-b-10 data_conent_63">
                    <span><b>Hot Property</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_63">
                    <div>: {{ $property_master->hot_property == 1 ? 'Yes' : 'No' }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="form-group col-md-12">
                    <h5 class="border-style">Owner Information</h5>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_65">
                    <span for="Client Name"><b>Owner</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_65">
                    <div>:
                        {{ $property_master->owner_info['type'] ?? ''}}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_66">
                    <span><b>Name</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_66">
                    <div>:
                        {{ $property_master->owner_info['name'] ?? ''}}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_67">
                    <span><b>Mobile</b></span>
                </div>
                <div class="form-group col-8 m-b-10 cursor-pointer color-code-popover data_conent_67" data-bs-trigger="hover focus">
                    <div class="highlightable">:
                        {{ $property_master->owner_info['contact'] ?? ''}}
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_69">
                    <span><b>Email</b></span>
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
                <div class="form-group col-4 m-b-10 data_conent_75">
                    <span><b>Source </b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_75">
                    <div>:
                        {{ $property_master->source ? findSource($sources, $property_master->source)['name'] : '' }}
                    </div>
                </div>
                <div class="form-group col-4 m-b-10 data_conent_76">
                    <span><b>Priority</b></span>
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

                <div class="form-group col-4 m-b-10 data_conent_75">
                    <span><b>FSI / FAR </b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_79">
                    <div>:
                        {{ $property_master->fsi_far ?? ''}}
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_79">
                    <span><b>Location Link</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_79">
                    <div>:
                        <a href="{{ $property_master->location_link ?? '' }}" target="_blank" data-bs-original-title="" title="">check on map
                        </a>
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_79">
                    <span><b>Key Available At</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_79">
                    <div>:
                        {{ $property_master->key_available_at ?? '' }}
                    </div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_16">
                    <span><b>Created Date</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_16">
                    <div>: {{ $property_master->created_at }}</div>
                </div>

                <div class="form-group col-4 m-b-10 data_conent_16">
                    <span><b>Last Modified Date</b></span>
                </div>
                <div class="form-group col-8 m-b-10 data_conent_16">
                    <div>: {{ $property_master->updated_at }}</div>
                </div>
            </div>
                    
            <div class="row mt-4">
                <div class="form-group col-md-12">
                    <h5 class="border-style">Survey Details</h5>
                </div>
                <div class="col-md-12">
                    <table class="table custom-table-design">
                        <thead>
                            <tr>
                                <th scope="col">Survey Number</th>
                                <th scope="col">Plot Size</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $property_master->survey_number ?? '' }}</td>
                                <td>{{ $property_master->survey_plot_size ?? '' }} - {{ $property_master->survey_plot_size_unit ? findMapById($land_units, $property_master->survey_plot_size_unit)['unit_name'] : '' }}</td>
                                <td>{{ $property_master->survey_price ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="form-group col-md-12">
                    <h5 class="border-style">TP Details</h5>
                </div>
                <div class="col-md-12">
                    <table class="table custom-table-design">
                        <thead>
                            <tr>
                                <th scope="col">TP Number</th>
                                <th scope="col">FP Number</th>
                                <th scope="col">Plot Size</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $property_master->tp_number ?? '' }}</td>
                                <td>{{ $property_master->fp_number ?? '' }}</td>
                                <td>{{ $property_master->tp_plot_size ?? '' }} - {{ $property_master->tp_plot_size_unit ? findMapById($land_units, $property_master->tp_plot_size_unit)['unit_name'] : '' }}</td>
                                <td>{{ $property_master->tp_price ?? '' }}</td>
                            </tr>
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
