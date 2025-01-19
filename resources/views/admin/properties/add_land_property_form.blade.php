<form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
    <input type="hidden" name="this_data_id" id="this_data_id">
    <div>
        <div class="row">
            <h5 class="border-style">INFORMATION</h5>
            <div class="form-group col-md-3 m-b-4 mb-3">
                <label for="Category" class="mb-0">Category</label>
                <select class="form-select" name="specific_type" id="specific_type">
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
            <div class="form-group col-md-4 m-b-4 mb-3">
                <label for="District" class="mb-0">District</label>
                <select class="form-select" id="district_id">
                    <option value=""> District</option>
                    @foreach ($districts as $disctrict)
                        <option value="{{ $disctrict->id }}">{{ $disctrict->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3 m-b-4 mb-3">
                <label for="Taluka" class="mb-0">Taluka</label>
                <select class="form-select" id="taluka_id">
                    <option value=""> Taluka</option>
                    @foreach ($talukas as $taluka)
                        <option data-parent_id="{{ $taluka->district_id }}"
                            value="{{ $taluka->id }}">{{ $taluka->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 m-b-4 mb-3">
                <label for="Village" class="mb-0">Village</label>
                <select class="form-select" id="village_id">
                    <option value=""> Village</option>
                    @foreach ($villages as $village)
                        <option data-parent_id="{{ $village->taluka_id }}"
                            value="{{ $village->id }}">{{ $village->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3 m-b-4">
                <select class="form-select" id="zone">
                    <option value=""> Zone</option>
                    <option value="R1">R1</option>
                    <option value="R1">R1</option>
                    <option value="R3">R3</option>
                </select>
            </div>
            <div class="form-group col-md-4 m-b-20">
                <label for="FSI">FSI</label>
                <input class="form-control" name="fsi" id="fsi" type="text" autocomplete="off" >
            </div>
            <div class="form-group col-md-5 m-b-4">
                <select class="form-select" id="configuration">
                    <option value="">Configuration</option>
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_plan_type')
                            <option data-parent_id="{{ $props['parent_id'] }}"
                                value="{{ $props['id'] }}">{{ $props['name'] }}
                            </option>
                            </option>
                        @endif
                    @empty
                    @endforelse
                </select>
            </div>

            <h5 class="border-style">Survey Details</h5>
            <div class="form-group col-md-3 m-b-20">
                <label for="Survey Number">Survey Number</label>
                <input class="form-control" name="survey_number" id="survey_number" type="text"
                        autocomplete="off" >
            </div>
            <div class="col-md-4 m-b-20">
                <div class="input-group">
                    <div class="form-group col-md-8 m-b-20 top1x">
                        <label for="Plot Size">Plot Size</label>
                        <input class="form-control" name="plot_size" id="plot_size"
                            type="text"  autocomplete="off"
                            >
                    </div>
                    <div class="input-group-append col-md-4 m-b-20">
                        <div class="form-group form_measurement">
                            <select class="form-select  measure_select" id="plot_measurement">
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
            <div class="form-group col-md-5 m-b-20">
                <label for="Price">Price</label>
                <input class="form-control indian_currency_amount" name="price" id="price" type="text"
                        autocomplete="off" >
            </div>

            <h5 class="border-style">TP Details</h5>
            <div class="form-group col-md-3 m-b-20">
                <label for="TP Number">TP Number</label>
                <input class="form-control" name="tp_number" id="tp_number" type="text"
                        autocomplete="off" >
            </div>
            <div class="form-group col-md-3 m-b-20">
                <label for="FP Number">FP Number</label>
                <input class="form-control" name="fp_number" id="fp_number" type="text"
                        autocomplete="off" >
            </div>
            <div class="col-md-3 m-b-20">
                <div class="input-group">
                    <div class="form-group col-md-7 m-b-20">
                        <label for="Plot Size">Plot Size</label>
                        <input class="form-control" name="plot2_size" id="plot2_size"
                            type="text"  autocomplete="off"
                            >
                    </div>
                    <div class="input-group-append col-md-5 m-b-20">
                        <div class="form-group form_measurement">
                            <select class="form-select measure_select" id="plot2_measurement">
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
            <div class="form-group col-md-3 m-b-20">
                <label for="Price">Price</label>
                <input class="form-control indian_currency_amount" name="price2" id="price2" type="text"
                        autocomplete="off" >
            </div>

            <h5 class="border-style">Other Information</h5>
            <div class="form-group col-md-6 m-b-20">
                <label for="Address">Address</label>
                <input class="form-control" name="address" id="address" type="text"
                        autocomplete="off" >
            </div>
            <div class="form-group col-md-6 m-b-20">
                <label for="Remarks">Remarks</label>
                <input class="form-control" name="remarks" id="remarks" type="text"
                        autocomplete="off" >
            </div>
            <div class="form-group col-md-3 m-b-4">
                <select class="form-select" id="status">
                    <option value=""> Status</option>
                    <option value="1">Available</option>
                    <option value="2">Sold Out</option>
                </select>
            </div>
            <div class="form-group col-md-6 m-b-20">
                <label for="Location Url">Location Url</label>
                <input class="form-control" name="location_url" id="location_url" type="text"
                        autocomplete="off" >
            </div>
            <div class="form-group col-md-3 m-b-4">
                <select class="form-select" id="property_source">
                    <option value="">Property</option>
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
            <div class="form-group col-md-12 m-b-20">
                <label for="Refrence">Refrence</label>
                <input class="form-control" name="refrence" id="refrence" type="text"
                        autocomplete="off" >
            </div>

            <h5 class="border-style">Owner Contact Details</h5>
            <div><button type="button" class="btn mb-5 btn-primary btn-air-primary"
                    id="add_owner_contacts3">Add Contact</button></div>
            <div class="row" id="all_owner_contacts">

            </div>

            <h5 class="border-style">Images/Documents</h5>
            <div id="uploadImageBox" class="row">

                <div class="form-group col-md-5 m-b-4 mb-3"><input class="form-control"
                        type="file" id="land_images" name="land_images" accept=".jpg,.png"
                        multiple></div>
                <div class="form-group col-md-3 m-b-4 mb-3"><button type="button"
                        class="btn mb-2 btn-primary btn-air-primary"
                        id="add_images">Upload</button></div>
            </div>
            <div class="row" id="all_images">

            </div>
        </div>
    </div>
    @if (Auth::user()->can('land-property-edit') || Auth::user()->can('land-property-create'))
        <button class="btn btn-secondary" id="saveLandProperty">Save</button>
    @endif
    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
</form>
@if(!isset($is_dynamic_form))
    @include('admin.properties.land_form_javascript')
@endif