<form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
    <input type="hidden" name="this_data_id" id="this_data_id">
    <div>
        <div class="row">
            <h5 class="border-style">INFORMATION</h5>
            <div class="form-group col-md-2 m-b-4 ">
                <select class="form-select" name="property_for" id="property_for">
                    <option value=""> For</option>
                    <option value="Rent">Rent</option>
                    <option value="Sell">Sell</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="form-group col-md-3 m-b-4">
                <select class="form-select" name="building_id" id="building_id">
                    <option value=""> Building</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-7 m-b-20">
                <label for="Address">Address</label>
                <input class="form-control" name="address" id="address" type="text"
                    autocomplete="off" >
            </div>

            <div class="form-group col-md-3 m-b-4 mb-3">
                <label for="Areas" class="mb-0">Areas</label>
                <select class="form-select" id="area_id">
                    <option value=""> Areas</option>
                    @foreach ($areas as $area)
                        <option data-city_id="{{$area->city_id}}" data-state_id="{{$area->state_id}}" value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3 m-b-4 mb-3">
                <label for="State" class="mb-0">State</label>
                <select class="form-select" id="state_id">
                    <option value=""> State</option>
                    @foreach ($states as $state)
                        <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3 m-b-4 mb-3">
                <label for="City" class="mb-0">City</label>
                <select class="form-select" id="city_id">
                    <option value=""> City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                    @endforeach
                </select>
            </div>



            <div class="form-group col-md-3 m-b-4 mb-3">
                <label for="Category" class="mb-0">Category</label>
                <select class="form-select" id="specific_type">
                    <option value="">Category</option>
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_specific_type'  && in_array($props['parent_id'],$prop_type))
                            <option data-parent_id="{{ $props['parent_id'] }}"
                                value="{{ $props['id'] }}">{{ $props['name'] }}
                            </option>
                            </option>
                        @endif
                    @empty
                    @endforelse
                </select>
            </div>
            <div class="form-group col-md-3 m-b-4">
                <select class="form-select" id="configuration">
                    <option value="">Configuration</option>
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_plan_type'  && in_array($props['parent_id'],$prop_type))
                            <option data-parent_id="{{ $props['parent_id'] }}"
                                value="{{ $props['id'] }}">{{ $props['name'] }}
                            </option>
                            </option>
                        @endif
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="form-group col-md-3 m-b-4 mb-3">
                <select class="form-select" id="zone">
                    <option value="">Zone</option>
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_zone')
                            <option data-parent_id="{{ $props['parent_id'] }}"
                                value="{{ $props['id'] }}">{{ $props['name'] }}
                            </option>
                            </option>
                        @endif
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="form-group col-md-2 m-b-20">
                <label for="Wing">Wing</label>
                <input class="form-control" name="property_wing" id="property_wing"
                    type="text" autocomplete="off" >
            </div>
            <div class="form-group col-md-2 m-b-20">
                <label for="Unit">Unit</label>
                <input class="form-control" name="property_unit_no" id="property_unit_no"
                    type="text" autocomplete="off" >
            </div>

            <div class="form-group col-md-2 m-b-4">
                <select class="form-select" id="property_status">
                    <option value=""> Status</option>
                    <option value="Available">Available</option>
                    <option value="SoldOut">Sold Out</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="form-group col-md-7 m-b-20">
                        <label for="Plot Area">Plot Area</label>
                        <input class="form-control" name="plot_area" id="plot_area"
                            type="text" autocomplete="off" >
                    </div>
                    <div class="input-group-append col-md-5 m-b-20">
                        <div class="form-group form_measurement">
                            <select class="form-select measure_select" id="plot_measurement">
                                @forelse ($property_configuration_settings as $props)
                                    @if ($props['dropdown_for'] == 'property_measurement_type')
                                        <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
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
            <div class="col-md-4 m-b-4">
                <div class="input-group">
                    <div class="form-group col-md-8 m-b-20">
                        <label for="Contruction Area">Contruction Area</label>
                        <input class="form-control" name="construction_area"
                            id="construction_area" type="text" autocomplete="off"
                            >
                    </div>
                    <div class="input-group-append col-md-4 m-b-20 ">
                        <div class="form-group form_measurement">
                            <select class="form-select  measure_select" id="construction_measurement">
                                @forelse ($property_configuration_settings as $props)
                                    @if ($props['dropdown_for'] == 'property_measurement_type')
                                        <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
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


            <div class="col-md-4 row m-b-20">
                <div class="form-check checkbox  checkbox-solid-success col-md-6">
                    <input class="form-check-input" id="hot_property" type="checkbox">
                    <label class="form-check-label" for="hot_property">Hot </label>
                </div>
                <div class="form-check checkbox  checkbox-solid-success col-md-6">
                    <input class="form-check-input" id="is_pre_leased" type="checkbox">
                    <label class="form-check-label" for="is_pre_leased">Pre-leased</label>
                </div>
            </div>
            <div class="form-group col-md-12 m-b-20">
                <label for="Property Description"> Description</label>
                <input class="form-control" name="property_description" id="property_description"
                    type="text" autocomplete="off" >
            </div>

            <div class="form-group col-md-3 m-b-20">
                <label for="Commission">Commission</label>
                <input class="form-control" name="commision" id="commision" type="text"
                    autocomplete="off" >
            </div>


            <div class="form-group col-md-4 m-b-20">
                <select class="form-select" id="source_of_property">
                    <option value="">Source </option>
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_source')
                            <option data-parent_id="{{ $props['parent_id'] }}"
                                value="{{ $props['id'] }}">{{ $props['name'] }}
                            </option>
                            </option>
                        @endif
                    @empty
                    @endforelse
                </select>
            </div>

            <h5 class="border-style">Price And Remark</h5>
            <div class="form-group col-md-3 m-b-20">
                <label for="Price">Price</label>
                <input class="form-control indian_currency_amount" name="price" id="price" type="text"
                    autocomplete="off" >
            </div>
            <div class="form-group col-md-9 m-b-20">
                <label for="Price Remarks">Price Remarks</label>
                <input class="form-control" name="price_remarks" id="price_remarks"
                    type="text" autocomplete="off" >
            </div>
            <div class="form-group col-md-12 m-b-20">
                <label for="Property Remarks"> Remarks</label>
                <input class="form-control" name="property_remarks" id="property_remarks"
                    type="text" autocomplete="off" >
            </div>



            <h5 class="border-style">Owner Contact Details</h5>
            <div><button type="button" class="btn mb-3 btn-primary btn-air-primary"
                    id="add_owner_contacts2">Add Contact</button></div>
            <div class="row" id="all_owner_contacts">

            </div>

            <h5 class="border-style"> Other Details</h5>
            <div class="col-md-6 row">
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                    <input class="form-check-input" id="gpcb" type="checkbox">
                    <label class="form-check-label" for="gpcb">GPCB</label>
                </div>

                <div class="form-group col-md-9 m-b-20">
                    <input class="form-control" name="gpcb_remarks" id="gpcb_remarks" type="text"
                        autocomplete="off" >
                </div>
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                    <input class="form-check-input" id="ec_noc" type="checkbox">
                    <label class="form-check-label" for="ec_noc">EC/NOC</label>
                </div>

                <div class="form-group col-md-9 m-b-20">
                    <input class="form-control" name="ec_noc_remark" id="ec_noc_remark"
                        type="text" autocomplete="off" >
                </div>
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                    <input class="form-check-input" id="bail" type="checkbox">
                    <label class="form-check-label" for="bail">Bail Membership</label>
                </div>

                <div class="form-group col-md-9 m-b-20">
                    <input class="form-control" name="bail_remark" id="bail_remark" type="text"
                        autocomplete="off" >
                </div>
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                    <input class="form-check-input" id="discharge" type="checkbox">
                    <label class="form-check-label" for="discharge">Discharge</label>
                </div>

                <div class="form-group col-md-9 m-b-20">
                    <input class="form-control" name="discharge_remark" id="discharge_remark"
                        type="text" autocomplete="off" >
                </div>

                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                    <input class="form-check-input" id="gujrat_gas" type="checkbox">
                    <label class="form-check-label" for="gujrat_gas">Gujrat Gas</label>
                </div>
                <div class="form-group col-md-9 m-b-20">
                    <input class="form-control" name="gujrat_gas_remark" id="gujrat_gas_remark"
                        type="text" autocomplete="off" >
                </div>
            </div>
            <div class="col-md-6 row">
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0">
                    <input class="form-check-input" id="power" type="checkbox">
                    <label class="form-check-label" for="power">Power</label>
                </div>

                <div class="form-group col-md-9">
                    <input class="form-control" name="power_remark" id="power_remark" type="text"
                        autocomplete="off" >
                </div>
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0">
                    <input class="form-check-input" id="water" type="checkbox">
                    <label class="form-check-label" for="water">Water</label>
                </div>
                <div class="form-group col-md-9">
                    <input class="form-control" name="water_remark" id="water_remark" type="text"
                        autocomplete="off" >
                </div>
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0">
                    <input class="form-check-input" id="machinery" type="checkbox">
                    <label class="form-check-label" for="machinery">Machinery</label>
                </div>
                <div class="form-group col-md-9">
                    <input class="form-control" name="machinery_remark" id="machinery_remark"
                        type="text" autocomplete="off" >
                </div>
                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0">
                    <input class="form-check-input" id="etl_necpt" type="checkbox">
                    <label class="form-check-label" for="etl_necpt">ETL/CEPT/NLTL</label>
                </div>
                <div class="form-group col-md-9 m-b-20">
                    <input class="form-control" name="etl_necpt_remark" id="etl_necpt_remark"
                        type="text" autocomplete="off" >
                </div>
            </div>

        </div>
    </div>
    @if (Auth::user()->can('industrial-property-edit') || Auth::user()->can('industrial-property-create'))
        <button class="btn btn-secondary" id="saveIndustrialProperty">Save</button>
    @endif
    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
</form>
@if(!isset($is_dynamic_form))
    @include('admin.properties.industrial_property_javascript')
@endif