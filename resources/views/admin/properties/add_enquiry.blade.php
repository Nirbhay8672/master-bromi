@extends('admin.layouts.app')
@section('content')
    @php
        $is_dynamic_form = true;
    @endphp
    @if (!empty($edit_category) && !empty($edit_configuration))
        @php
            $edit_category = json_decode($edit_category[0]);
            $edit_configuration = json_decode($edit_configuration[0]);
        @endphp
    @endif
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
                            {{-- <h5 class="mb-3">Add Enquiry</h5> --}}
                            <h5 class="mb-3">Add Enquiry <a class="btn custom-icon-theme-button tooltip-btn"
                                    href="{{ route('admin.enquiries') }}" data-tooltip="Back" style="float: inline-end;">
                                    <i class="fa fa-backward"></i>
                                </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <div class="bromi-form-wizard stepwizard">
                                        <div class="stepwizard-row setup-panel">
                                            <div class="stepwizard-step mb-5" style="text-align:initial"><a
                                                    class="btn btn-primary" href="#customer-info" id="step0">1</a>
                                                <p class="ms-2">Customer Information</p>
                                            </div>
                                            <div class="stepwizard-step mb-5" style="text-align:initial"><a
                                                    class="btn btn-light" href="#customer-requirement" id="step1">2</a>
                                                <p class="ms-2">Customer Requirement</p>
                                            </div>
                                            <div class="stepwizard-step" style="text-align:initial"><a class="btn btn-light"
                                                    href="#other-contact" id="step2">3</a>
                                                <p class="ms-2">Other Details</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-lg-10 border-start ps-4">
                                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                                        novalidate="">
                                        <div class="setup-content" id="customer-info">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <input type="hidden" name="this_data_id" id="this_data_id">

                                                        <div>
                                                            <label><b>Customer Information</b></label>
                                                        </div>
                                                        <div class="form-group col-md-3 m-b-20">
                                                            <div class="fname">
                                                                <label for="Client Name">Client Name</label>
                                                                <input class="form-control" name="client_name"
                                                                    id="client_name" type="text" autocomplete="off">

                                                            </div>
                                                            <div class="invalid-feedback" id="client_name_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                        <div class="col-md-4 country_code_area">
                                                            <div class="input-group">
                                                                <div class="input-group-append col-md-4 m-b-20">
                                                                    <div class="form-group country_code">
                                                                        <div style="border-top-left-radius: 5px !important;border-bottom-left-radius: 5px !important"
                                                                            class="divSelect">
                                                                            <select class="form-control countries_list"
                                                                                id="country_code" name="country_code"
                                                                                style="border-top-left-radius: 5px !important;border-bottom-left-radius: 5px !important">
                                                                                @foreach ($country_codes as $country_code)
                                                                                    <option
                                                                                        data-parent_id="{{ $country_code->id }}"
                                                                                        value={{ $country_code->id }}>
                                                                                        +{{ $country_code->country_iso }}({{ $country_code->country_code }})
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="form-group col-md-8 m-b-20">
                                                                    <div class="fname">
                                                                        <label for="Mobile">Mobile</label>
                                                                        <input class="form-control" name="client_mobile"
                                                                            style="border-right:2px solid #1d2848 !important; border-top-right-radius: 5px;border-bottom-right-radius: 5px"
                                                                            id="client_mobile" type="text"
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="invalid-feedback" id="client_mobile_error"
                                                                        style="display: block;color:red;"></div>
                                                                </div> --}}
                                                                <div class="form-group col-md-8 m-b-20">
                                                                    <div class="fname">
                                                                        <label for="Mobile">Mobile</label>
                                                                        <input class="form-control" name="client_mobile"
                                                                            style="border-right:2px solid #1d2848 !important; border-top-right-radius: 5px;border-bottom-right-radius: 5px"
                                                                            id="client_mobile" type="text"
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="invalid-feedback" id="client_mobile_error"
                                                                        style="display: block;color:red;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--  <div class="form-group col-md-3 m-b-20">
                                                            <div class="fname">
                                                                <label for="Email">Email</label>
                                                                <input class="form-control" name="client_email"
                                                                    id="client_email" type="text" autocomplete="off"
                                                                    style="text-transform: lowercase;">
                                                            </div>
                                                            <div class="invalid-feedback" id="client_email_error"
                                                                style="display: block;color:red;"></div>
                                                        </div> --}}
                                                        <div class="form-group col-md-3 m-b-20">
                                                            <div class="fname">
                                                                <label for="Email">Email</label>
                                                                <input class="form-control" name="client_email"
                                                                    id="client_email" type="text" autocomplete="off"
                                                                    style="text-transform: lowercase;">
                                                            </div>
                                                            <div class="invalid-feedback" id="client_email_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                        <div class="col-md-1 m-b-20 ps-0">
                                                            <div class="form-check checkbox checkbox-solid-success mb-0">
                                                                <input class="form-check-input" id="is_nri"
                                                                    type="checkbox">
                                                                <label class="form-check-label" for="is_nri">NRI</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 m-b-20 ps-0">
                                                            <div
                                                                class="form-check checkbox checkbox-solid-success mb-0 ps-0">
                                                                <input class="form-check-input" id="is_favourite"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="is_favourite">Favourite</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary nextBtn" style="border-radius: 5px;"
                                                        id="nextFirst" type="button">Next</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="setup-content" id="customer-requirement">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <div>
                                                                <label><b>Customer Requirement</b></label>
                                                            </div>
                                                            @if (Auth::user()->parent_id !== null)
                                                                <input type="hidden" name="this_data_id"
                                                                    id="this_data_id">
                                                                @if (Auth::user()->enquiry_for_id == 'Rent')
                                                                    <div class="btn-group me-2" role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" value="Rent"
                                                                            class="btn-check" name="enquiry_for"
                                                                            id="propertyfor1" autocomplete="off" checked>
                                                                        <label
                                                                            class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                            for="propertyfor1">Rent</label>
                                                                    </div>
                                                                @endif
                                                                @if (Auth::user()->enquiry_for_id == 'Buy')
                                                                    <div class="btn-group me-2" role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" value="Buy"
                                                                            class="btn-check" name="enquiry_for"
                                                                            id="propertyfor2" autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                            for="propertyfor2">Buy</label>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="btn-group me-2" role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" value="Rent"
                                                                        class="btn-check" name="enquiry_for"
                                                                        id="propertyfor1" autocomplete="off" checked>
                                                                    <label
                                                                        class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                        for="propertyfor1">Rent</label>
                                                                </div>
                                                                <div class="btn-group me-2" role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" value="Buy"
                                                                        class="btn-check" name="enquiry_for"
                                                                        id="propertyfor2" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                        for="propertyfor2">Buy</label>
                                                                </div>
                                                            @endif
                                                            {{-- <div class="btn-group me-2" role="group"
                                                                aria-label="Basic radio toggle button group">
                                                                <input type="radio" value="Both" class="btn-check"
                                                                    name="enquiry_for" id="propertyfor3"
                                                                    autocomplete="off">
                                                                <label class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                    for="propertyfor3">Both</label>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 m-b-20">
                                                            <div>
                                                                <label><b>Requirement Type</b></label>
                                                            </div>
                                                            <?php
                                                            use Illuminate\Support\Facades\Auth;
                                                            
                                                            $jsonString = str_replace("'", '"', Auth::user()->enquiry_type);
                                                            $user_enquiry_types = json_decode($jsonString, true);
                                                            
                                                            $type_string = str_replace("'", '"', Auth::user()->specific_enquiry);
                                                            $user_specific_enq_types = json_decode($type_string, true);
                                                            ?>

                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                @if (Auth::user()->parent_id !== null)
                                                                    @if (in_array('85', $user_enquiry_types) || count($user_enquiry_types) == 0)
                                                                        <div class="btn-group bromi-checkbox-btn me-1"
                                                                            role="group"
                                                                            aria-label="Basic radio toggle button group">
                                                                            <input type="radio" data-parent_id=""
                                                                                class="btn-check" value="85"
                                                                                data-val="Commercial" name="property_type"
                                                                                id="propertytype-85" autocomplete="off"
                                                                                data-bs-original-title="" title="">
                                                                            <label
                                                                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                                for="propertytype-85">Commercial</label>
                                                                        </div>
                                                                    @endif
                                                                    @if (in_array('87', $user_enquiry_types) || count($user_enquiry_types) == 0)
                                                                        <div class="btn-group bromi-checkbox-btn me-1"
                                                                            role="group"
                                                                            aria-label="Basic radio toggle button group">
                                                                            <input type="radio" data-parent_id=""
                                                                                class="btn-check" value="87"
                                                                                data-val="Residential"
                                                                                name="property_type" id="propertytype-87"
                                                                                autocomplete="off"
                                                                                data-bs-original-title="" title="">
                                                                            <label
                                                                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                                for="propertytype-87">Residential</label>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" data-parent_id=""
                                                                            class="btn-check" value="85"
                                                                            data-val="Commercial" name="property_type"
                                                                            id="propertytype-85" autocomplete="off"
                                                                            data-bs-original-title="" title="">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="propertytype-85">Commercial</label>
                                                                    </div>
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" data-parent_id=""
                                                                            class="btn-check" value="87"
                                                                            data-val="Residential" name="property_type"
                                                                            id="propertytype-87" autocomplete="off"
                                                                            data-bs-original-title="" title="">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="propertytype-87">Residential</label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="invalid-feedback" id="property_type_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12 m-b-20">
                                                            <div>
                                                                <label><b>Category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                @forelse ($configuration_settings as $props)
                                                                    @if ($props['dropdown_for'] == 'property_specific_type')
                                                                        @if ($user_specific_enq_types !== null)
                                                                            @if (in_array($props['id'], $user_specific_enq_types) ||
                                                                                    (is_array($user_specific_enq_types) && count($user_specific_enq_types) == 0))
                                                                                <div class="btn-group bromi-checkbox-btn me-1 enquiry-type-element"
                                                                                    role="group"
                                                                                    data-enquiry-id="{{ $props['id'] }}"
                                                                                    aria-label="Basic radio toggle button group">
                                                                                    <input type="radio"
                                                                                        data-parent_id="{{ $props['parent_id'] }}"
                                                                                        class="btn-check"
                                                                                        value="{{ $props['id'] }}"
                                                                                        data-val="{{ $props['name'] }}"
                                                                                        name="property_category"
                                                                                        id="category-{{ $props['id'] }}"
                                                                                        autocomplete="off"
                                                                                        {{-- @if ($enquiry_list[0] == 'Office') {{ $props['name'] == 'Office' ? '' : '' }}
                                                                                @else  {{ $props['id'] == $enquiry_list[0]['property_type'] ? 'checked' : '' }} @endif --}}>

                                                                                    <label
                                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                                        for="category-{{ $props['id'] }}">{{ $props['name'] }}</label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            <div class="btn-group bromi-checkbox-btn me-1 enquiry-type-element"
                                                                                role="group"
                                                                                data-enquiry-id="{{ $props['id'] }}"
                                                                                aria-label="Basic radio toggle button group">
                                                                                <input type="radio"
                                                                                    data-parent_id="{{ $props['parent_id'] }}"
                                                                                    class="btn-check"
                                                                                    value="{{ $props['id'] }}"
                                                                                    data-val="{{ $props['name'] }}"
                                                                                    name="property_category"
                                                                                    id="category-{{ $props['id'] }}"
                                                                                    autocomplete="off"
                                                                                    {{-- @if ($enquiry_list[0] == 'Office') {{ $props['name'] == 'Office' ? '' : '' }}
                                                                                @else  {{ $props['id'] == $enquiry_list[0]['property_type'] ? 'checked' : '' }} @endif --}}>

                                                                                <label
                                                                                    class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                                    for="category-{{ $props['id'] }}">{{ $props['name'] }}</label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                            <div class="invalid-feedback" id="property_category_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 div_office_type" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="1" id="officeekind1"
                                                                        data-error="#office_type_error"
                                                                        name="office_type[]"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '259' && in_array('1', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="officeekind1">office
                                                                        space</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="2" id="officekind2"
                                                                        data-error="#office_type_error"
                                                                        name="office_type[]"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '259' && in_array('2', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="officekind2">Co-working office space</label>
                                                                </div>
                                                            </div>
                                                            <div id="office_type_error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 div_retail_type" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="3" id="retailkind1"
                                                                        name="retail_type[]"
                                                                        data-error="#retail_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '260' && in_array('3', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind1">Ground floor</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="4" id="retailkind2"
                                                                        name="retail_type[]"
                                                                        data-error="#retail_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '260' && in_array('4', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind2">1st floor</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="5" id="retailkind3"
                                                                        name="retail_type[]"
                                                                        data-error="#retail_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '260' && in_array('5', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind3">2nd floor</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="6" id="retailkind4"
                                                                        name="retail_type[]"
                                                                        data-error="#retail_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '260' && in_array('6', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind4">3rd floor</label>
                                                                </div>
                                                            </div>
                                                            <div id="retail_type_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 div_flat_type" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="13" id="flatkind1" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('13', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind1">1 rk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="14" id="flatkind2" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('14', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind2">1bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="15" id="flatkind3" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('15', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind3">2bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="16" id="flatkind4" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('16', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind4">3bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="17" id="flatkind5" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('17', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind5">4bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="18" id="flatkind6" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('18', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind6">5bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="19" id="flatkind7" name="flat_type[]"
                                                                        data-error="#flat_type_error" autocomplete="off"
                                                                        <?php
                                                                        if (!empty($edit_category) && !empty($edit_configuration) && in_array('19', $edit_configuration)) {
                                                                            if ($edit_category == '254' || $edit_category == '257') {
                                                                                echo 'checked';
                                                                            }
                                                                        }
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind7">5+bhk</label>

                                                                </div>
                                                                <div id="textboxWrapper"
                                                                    class="btn-group bromi-checkbox-btn me-1"
                                                                    style="width:10%;display: none;">
                                                                    <input type="text" id="txt5moreFlate"
                                                                        name="res_more" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div id="flat_type_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 div_vila_type" id="vila_type">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="14" id="vilakind1"
                                                                        name="vila_type[]"data-val="resedential"
                                                                        data-error="#vila_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '255' && in_array('14', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind1">1BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="15" id="vilakind2" name="vila_type[]"
                                                                        data-val="resedential"
                                                                        data-error="#vila_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '255' && in_array('15', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind2">2BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="16" id="vilakind3" name="vila_type[]"
                                                                        data-val="resedential"
                                                                        data-error="#vila_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '255' && in_array('16', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind3">3BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="17" id="vilakind4" name="vila_type[]"
                                                                        data-val="resedential"
                                                                        data-error="#vila_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '255' && in_array('17', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind4">4BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="18" id="vilakind5" name="vila_type[]"
                                                                        data-val="resedential"
                                                                        data-error="#vila_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '255' && in_array('18', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind5">5bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic checkbox toggle button group">
                                                                    <input type="checkbox" class="btn-check"
                                                                        value="19" id="vilakind6" name="vila_type[]"
                                                                        data-val="resedential"
                                                                        data-error="#vila_type_error" autocomplete="off"
                                                                        <?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '255' && in_array('18', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind6">5+bhk</label>

                                                                </div>
                                                                <div id="textboxWrapperVilla"
                                                                    class="btn-group bromi-checkbox-btn me-1"
                                                                    style="display: none;width:10%">
                                                                    <input type="text" id="txt5moreVilla"
                                                                        name="textbox" class="form-control">
                                                                </div>
                                                                <div id="vila_type_error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 div_plot_type" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="10" id="plotkind1"
                                                                        data-val="commercial" name="plot_type[]"
                                                                        data-error="#plot_type_error"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '262' && in_array('10', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="plotkind1">Commercial Land</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-val="agriculture" value="11"
                                                                        id="plotkind2" name="plot_type[]"
                                                                        data-error="#plot_type_error"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '262' && in_array('11', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="plotkind2">Agricultural/Farm Land</label>
                                                                </div>
                                                                {{-- <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="12" id="plotkind3"
                                                                        data-val="industrial" name="plot_type[]"
                                                                        data-error="#plot_type_error"
                                                                        autocomplete="off"
                                                                        // echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '262' && in_array('12', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="plotkind3">Industrial Land</label>
                                                                </div> --}}
                                                            </div>
                                                            <div id="plot_type_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 div_storage_type" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="7" id="storagekind1"
                                                                        data-error="#storage_type_error"
                                                                        name="storage_type[]"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '261' && in_array('7', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind1">Warehouse</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#storage_type_error" value="8"
                                                                        id="storagekind2" name="storage_type[]"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '261' && in_array('8', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind2">Cold Storage</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#storage_type_error" value="9"
                                                                        id="storagekind3" name="storage_type[]"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '261' && in_array('9', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind3">ind. shed</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#storage_type_error" value="20"
                                                                        id="storagekind4" name="storage_type[]"
                                                                        autocomplete="off"<?php
                                                                        echo !empty($edit_category) && !empty($edit_configuration) && $edit_category == '261' && in_array('20', $edit_configuration) ? 'checked' : '';
                                                                        ?>>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind4">Plotting</label>
                                                                </div>
                                                            </div>
                                                            <div id="storage_type_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row div_farm_house div_land_plot" id=""
                                                        style="display:none">
                                                        <div class="form-group col-md-3 mb-3 div_extra_land_details">
                                                            <select class="form-select" id="district_id">
                                                                <option value=""> District</option>
                                                                @foreach ($districts as $disctrict)
                                                                    <option value="{{ $disctrict->id }}">
                                                                        {{ $disctrict->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2 mb-3 div_extra_land_details">
                                                            <select class="form-select" id="taluka_id">
                                                                <option value=""> Taluka</option>
                                                                @foreach ($talukas as $taluka)
                                                                    <option data-parent_id="{{ $taluka->district_id }}"
                                                                        value="{{ $taluka->id }}">{{ $taluka->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2 m-b-4 mb-3 div_extra_land_details">
                                                            <label class="select2_label" for="Area">Village</label>
                                                            <select class="form-select" id="village_id" multiple>
                                                                {{-- <option value="">Village</option> --}}
                                                                @foreach ($villages as $village)
                                                                    <option data-parent_id="{{ $village->taluka_id }}"
                                                                        value="{{ $village->id }}">{{ $village->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4 the_constructed_carpet_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-4 m-b-20">
                                                                    <div> <label for="Area From">Area From</label>
                                                                        <input class="form-control" name="area_from"
                                                                            id="area_from" type="text"
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="invalid-feedback" id="area_from_error"
                                                                        style="display: block;color:red;">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-4 m-b-20">
                                                                    <div>
                                                                        <label for="Area To">Area To</label>
                                                                        <input class="form-control" name="area_to"
                                                                            id="area_to" type="text"
                                                                            autocomplete="off">
                                                                    </div>
                                                                    <div class="invalid-feedback" id="area_to_error"
                                                                        style="display: block;color:red;">
                                                                    </div>
                                                                </div>
                                                                <div class="input-group-append col-md-4 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <div>
                                                                            <select class="form-select measure_select"
                                                                                id="area_from_measurement">
                                                                                @foreach ($land_units as $land_unit)
                                                                                    <option value="{{ $land_unit->id }}"
                                                                                        {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                        {{ $land_unit->unit_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4 m-b-20 f-status">
                                                            <label class="select2_label" for="Furnished Status">Furnished
                                                                Status</label>
                                                            <select class="form-select" id="furnished_status" multiple>
                                                                @forelse ($configuration_settings as $props)
                                                                    @if ($props['dropdown_for'] == 'property_furniture_type')
                                                                        <option data-parent_id="{{ $props['parent_id'] }}"
                                                                            value="{{ $props['id'] }}">
                                                                            {{ $props['name'] }}
                                                                        </option>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            <div class="invalid-feedback" id="furnished_status_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>

                                                        <div class="form-group col-md-2 m-b-20 enq_budget">
                                                            <div>
                                                                <label for="Budget From">Budget From</label>
                                                                <input class="form-control indian_currency_amount"
                                                                    name="budget" value="" id="budget_from"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="budget_from_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>

                                                        <div class="form-group col-md-2 m-b-20 enq_budget">
                                                            <div>
                                                                <label for="Budget To">Budget To</label>
                                                                <input class="form-control indian_currency_amount"
                                                                    name="budget_to" id="budget_to" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="budget_to_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>

                                                        <div class="form-group col-md-2 m-b-20 both-price">
                                                            <div>
                                                                <label for="Rent Price">Rent Price</label>
                                                                <input class="form-control indian_currency_amount"
                                                                    name="rent_price" value="" id="rent_price"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            {{-- <div class="invalid-feedback" id="budget_from_error"
                                                                style="display: block;color:red;"></div> --}}
                                                        </div>

                                                        <div class="form-group col-md-2 m-b-20 both-price">
                                                            <div>
                                                                <label for="Sell Price">Sell Price</label>
                                                                <input class="form-control indian_currency_amount"
                                                                    name="sell_price" id="sell_price" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            {{-- <div class="invalid-feedback" id="budget_to_error"
                                                                style="display: block;color:red;"></div> --}}
                                                        </div>

                                                        <div class="form-group col-md-2 m-b-20 mb-3 enq-purpose">
                                                            <div>
                                                                <select class="form-select" id="purpose">
                                                                    <option value="">Purpose</option>
                                                                    <option value="Investment">Investment</option>
                                                                    <option value="Own Use">Own Use</option>
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback" id="purpose_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>


                                                        <div class="form-group col-md-4 m-b-20 mb-3 cat-project">
                                                            <div>
                                                                <label class="select2_label" for="Select Project">
                                                                    Project</label>
                                                                <select class="form-select" id="building_id" multiple>
                                                                    @foreach ($projects as $project)
                                                                        <option value="{{ $project->id }}">
                                                                            {{ $project->project_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback" id="building_id_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-2 m-b-20 mb-3 cat-project-status">
                                                            <div>
                                                                <select class="form-select" id="project_status">
                                                                    <option value="">Project Status</option>
                                                                    @forelse ($configuration_settings as $props)
                                                                        @if ($props['dropdown_for'] == 'building_progress')
                                                                            <option
                                                                                data-parent_id="{{ $props['parent_id'] }}"
                                                                                value="{{ $props['id'] }}">
                                                                                {{ $props['name'] }}
                                                                            </option>
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback" id="project_status_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-4 m-b-20">
                                                            <div>
                                                                <select class="form-select" id="enquiry_source">
                                                                    <option value="">Enquiry Source</option>
                                                                    @forelse ($configuration_settings as $props)
                                                                        @if ($props['dropdown_for'] == 'property_source')
                                                                            <option
                                                                                data-parent_id="{{ $props['parent_id'] }}"
                                                                                value="{{ $props['id'] }}"
                                                                                data-val="{{ $props['name'] }}">
                                                                                {{ $props['name'] }}
                                                                            </option>
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback" id="enquiry_source_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3 m-b-20 the_source_refrence mb-3">
                                                            <div>
                                                                <label for="Refrence">Refrence</label>
                                                                <input class="form-control" name="refrence"
                                                                    id="refrence" type="text" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3 m-b-4 mb-3 cat-zone">
                                                            <div>
                                                                <select class="form-select" id="zone"
                                                                    name="zone">
                                                                    <option value="">Zone</option>
                                                                    @forelse ($configuration_settings as $props)
                                                                        @if ($props['dropdown_for'] == 'property_zone')
                                                                            <option
                                                                                data-parent_id="{{ $props['parent_id'] }}"
                                                                                value="{{ $props['id'] }}">
                                                                                {{ $props['name'] }}
                                                                            </option>
                                                                            </option>
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback" id="zone_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-4 m-b-20 mb-3 cl-locality">
                                                            <div>
                                                                <label class="select2_label"
                                                                    for="Area">Locality</label>
                                                                <select class="form-select" id="area_ids" multiple>
                                                                    @foreach ($areas as $area)
                                                                        <option value="{{ $area->id }}">
                                                                            {{ $area->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="invalid-feedback" id="area_ids_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20">
                                                            <input class="form-check-input" id="is_preleased"
                                                                type="checkbox">
                                                            <label class="form-check-label"
                                                                for="is_preleased">Pre-leased</label>
                                                        </div>
                                                        <div class="form-check checkbox the_week_end_enq checkbox-solid-success mb-0 col-md-2 m-b-20"
                                                            style="display: none">
                                                            <input class="form-check-input" id="weekend_enq"
                                                                type="checkbox">
                                                            <label class="form-check-label"
                                                                for="weekend_enq">Weekend</label>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary previousBtn1 me-2" type="button"
                                                        style="border-radius: 5px;">Previous</button>
                                                    <button class="btn btn-primary nextBtn" id="nextSecond"
                                                        style="border-radius: 5px;" type="button">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setup-content" id="other-contact">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div>
                                                            <label><b>Other Contacts</b></label>
                                                        </div>

                                                        <div class="row" id="all_contacts">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div>
                                                            <label><b>Remarks</b></label>
                                                        </div>
                                                        <div class="form-group col-md-6 m-b-20 mt-1">
                                                            <div>
                                                                <label for="Telephonic Discussion">Remark</label>
                                                                <input class="form-control" name="telephonic_discussion"
                                                                    id="telephonic_discussion" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="telephonic_discussion_error"
                                                                style="display: block;color:red;"></div>
                                                        </div>
                                                    </div>

                                                    {{-- @dd("sadsad",$permissions); --}}
                                                    <div class="row">
                                                        <div>
                                                            <label><b>Enquiry Allocation</b></label>
                                                        </div>

                                                        <div class="form-group col-md-4 m-b-4 mb-3">
                                                            <select class="form-select" id="enquiry_branch_id">
                                                                <option value=""> branch</option>
                                                                @foreach ($branches as $branch)
                                                                    <option value="{{ $branch->id }}">
                                                                        {{ $branch->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback" id="enquiry_branch_id_error"
                                                                style="display: block;color:red;"></div>

                                                        </div>
                                                        @if (in_array('only-assigned', $permissions))
                                                            <div class="form-group col-md-4 m-b-4 mb-3">
                                                                <select class="form-select" id="employee_id">
                                                                    <option value=""> Employee</option>
                                                                    @foreach ($employees as $employee)
                                                                        <option value="{{ $employee->id }}">
                                                                            {{ $employee->first_name . ' ' . $employee->last_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="invalid-feedback" id="employee_id_error"
                                                                    style="display: block;color:red;"></div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                    <button class="btn btn-primary previousBtn2 me-2" type="button"
                                                        style="border-radius: 5px;">Previous</button>
                                                    <button id="saveEnquiry" class="btn btn-secondary" type="button"
                                                        style="border-radius: 5px;">Finish!</button>
                                                </div>
                                    </form>
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
    <script src="{{ asset('admins/assets/js/form-wizard/form-wizard-two.js') }}"></script>
    <script>
        let isValid = true;

        // $(document).on('keyup', ".indian_currency_amount", function() {
        //     if (isNaN(($(this).val()).replaceAll(',', ''))) {
        //         $(this).val('')
        //     } else {
        //         $(this).val(fmt($(this).val()));
        //     }
        // });

        function fmt(s) {
            if (!s || isNaN(s)) return ''; // Handle non-numeric or empty values
            var newvalue = s.replace(/,/g, '');
            var valuewithcomma = Number(newvalue).toLocaleString('en-IN');
            return valuewithcomma;
        }


        function validateField(inputSelector, errorSelector, errorMessage) {
            let isValidField = $(inputSelector).val().trim() !== '';
            $(inputSelector).toggleClass('is-invalid', !isValidField);
            $(errorSelector).toggle(!isValidField).text(errorMessage);
            return isValidField;
        }

        function validateSelect2(inputSelector, errorSelector, errorMessage) {
            isValid = $(inputSelector).val() !== ''; // Check if a value is selected
            console.log("select 2 val ==", $(inputSelector).val());
            $(errorSelector).toggle(!isValid).text(errorMessage);
            return isValid;
        }


        /**************************************/
        function validateMobileNumber(field, errorField, invalidErrorMessage) {
            var value = $(field).val().trim();
            var isValidMobileNumber = /^\d{10}$/.test(value);
            var hasNonDigits = /[^0-9]/.test(value);

            if (value !== '') {
                if (hasNonDigits || value.length < 10) {
                    $(errorField).text(invalidErrorMessage);
                } else {
                    $(errorField).text('');
                }
            } else {
                $(errorField).text('');
            }

            $(field).toggleClass('is-invalid', hasNonDigits || value.length > 10);

            return value === '' || isValidMobileNumber;
        }
        // function validateMobileNumber(field, errorField, invalidErrorMessage) {
        //     var value = $(field).val().trim();
        //     var isValidMobileNumber = /^\d{10}$/.test(value);
        //     var hasNonDigits = /[^0-9]/.test(value);

        //     if (value !== '') {
        //         if (hasNonDigits || value.length < 10) {
        //             $(errorField).text(invalidErrorMessage);
        //         } else {
        //             $(errorField).text('');
        //         }
        //     } else {
        //         $(errorField).text('');
        //     }

        //     $(field).toggleClass('is-invalid', hasNonDigits || value.length > 10);
        //     return value === '' || isValidMobileNumber;
        // }

        function validateEmail(field, errorField, invalidFormatMessage) {
            var value = $(field).val().trim();
            var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

            if (value !== '' && !isValidEmail) {
                $(errorField).text(invalidFormatMessage);
            } else {
                $(errorField).text('');
            }

            $(field).toggleClass('is-invalid', value !== '' && !isValidEmail);
            return value === '' || isValidEmail;
        }

        function validateForm() {
            var isValid = true;
            isValid = validateField('#client_name', '#client_name_error', 'Client name field is required') && isValid;
            isValid = validateMobileNumber('#client_mobile', '#client_mobile_error', 'Invalid mobile number format') &&
                isValid;
            isValid = validateEmail('#client_email', '#client_email_error', 'Invalid email format') && isValid;
            return isValid;
        }


        function validateNumericField(field, errorField, errorMessage) {
            var value = $(field).val().trim();
            var isValidNumeric = /^\d+$/.test(value);

            if (value === '') {
                $(errorField).text(errorMessage);
            } else if (!isValidNumeric) {
                $(errorField).text('Please enter a valid numeric value');
            } else {
                $(errorField).text('');
            }

            $(field).toggleClass('is-invalid', value === '' || !isValidNumeric);
            return value !== '' && isValidNumeric;
        }

        // function validateStep2Form() {
        //     isValid = true;
        //     // const selectedValues = $('#furnished_status').val();
        //     // isValid = selectedValues && selectedValues.length > 0 && isValid;
        //     // $('#furnished_status_error').toggle(!isValid).text(isValid ? '' : 'furnished status field is required');
        //     // isValid = validateField('#area_from', '#area_from_error', 'area from field is required') && isValid;
        //     // isValid = validateField('#area_to', '#area_to_error', 'area to field is required') && isValid;
        //     isValid = validateNumericField('#area_from', '#area_from_error', 'Area from field is required') && isValid;
        //     isValid = validateNumericField('#area_to', '#area_to_error', 'Area to field is required') && isValid;

        //     isValid = validateField('#budget_from', '#budget_from_error', 'budget from field is required') && isValid;
        //     isValid = validateField('#budget_to', '#budget_to_error', 'budget to field is required') && isValid;
        //     // isValid = validateSelect2('#purpose', '#purpose_error', 'purpose field is required') && isValid;
        //     // isValid = validateSelect2('#project_status', '#project_status_error', 'project status field is required') &&
        //     //     isValid;
        //     // isValid = validateSelect2('#enquiry_source', '#enquiry_source_error', 'enquiry source field is required') &&
        //     //     isValid;
        //     // isValid = validateSelect2('#zone', '#zone_error', 'zone field is required') && isValid;
        //     // const selectedArea = $('#area_ids').val();
        //     // isValid = selectedArea && selectedArea.length > 0 && isValid;
        //     // $('#area_ids_error').toggle(!isValid).text(isValid ? '' : 'area field field is required');
        //     // const selectedBuilding = $('#building_id').val();
        //     // isValid = selectedBuilding && selectedBuilding.length > 0 && isValid;
        //     // $('#building_id_error').toggle(!isValid).text(isValid ? '' : 'project field field is required');
        //     return isValid;
        // }
        function validateBudgetFields() {
            let budgetFrom = parseFloat($('#budget_from').val().replace(/,/g, ''));
            let budgetTo = parseFloat($('#budget_to').val().replace(/,/g, ''));
            if (isNaN(budgetFrom) || isNaN(budgetTo)) {
                $('#budget_to_error').text('Please enter numeric values').show();
                return false;
            }
            if (budgetFrom >= budgetTo) {
                $('#budget_to_error').text('Budget From must be greater than Budget To').show();
                return false;
            } else {
                $('#budget_to_error').hide();
                return true;
            }
        }

        function validateAreaFields() {
            var areaFrom = parseFloat($('#area_from').val());
            var areaTo = parseFloat($('#area_to').val());
            if (isNaN(areaFrom) || isNaN(areaTo)) {
                $('#area_to_error').text('Please enter numeric values').show();
                return false;
            }

            if (isNaN(areaFrom) || isNaN(areaTo) || areaTo <= areaFrom) {
                $('#area_to_error').text('Area To must be greater than Area From').show();
                return false;
            } else {
                $('#area_to_error').hide();
                return true;
            }
        }

        function validateStep2Form() {
            var isValid = true;

            // Validate area fields
            isValid = validateNumericField('#area_from', '#area_from_error', 'Area from field is required') && isValid;
            isValid = validateNumericField('#area_to', '#area_to_error', 'Area to field is required') && isValid;

            isValid = validateAreaFields() && isValid;
            // Validate budget fields
            isValid = validateField('#budget_from', '#budget_from_error', 'Budget from field is required') && isValid;
            isValid = validateField('#budget_to', '#budget_to_error', 'Budget to field is required') && isValid;

            isValid = validateBudgetFields() && isValid;

            return isValid;
        }
        // function validateStep3Form() {
        //     isValid = true;
        //     const selectedValues = $('#furnished_status').val();
        //     isValid = selectedValues && selectedValues.length > 0 && isValid;
        //     $('#furnished_status_error').toggle(!isValid).text(isValid ? '' : 'furnished status field is required');
        //     isValid = validateField('#telephonic_discussion', '#telephonic_discussion_error',
        //         'remarks field is required') && isValid;
        //     isValid = validateSelect2('#enquiry_branch_id', '#enquiry_branch_id_error', 'branch field is required') &&
        //         isValid;
        //     isValid = validateSelect2('#employee_id', '#employee_id_error', 'employee field is required') && isValid;

        //     //    employee_id 
        //     return isValid;
        // }

        $(document).ready(function() {
            $('#nextFirst').click(function() {
                if (validateForm()) {
                    console.log("All fields are valid");
                    $("#customer-requirement").show();
                } else {
                    console.log("Some fields are invalid");
                    $("#customer-info").show();
                    $("#step0").addClass("btn-primary");
                    $("#step1").removeClass("btn-primary");
                    $("#customer-requirement").hide();
                }
            });

            $('#nextSecond').click(function() {
                var isValid = true; // Initialize isValid to true

                if ($('input[name="property_type"]:checked').length === 0) {
                    isValid = false;
                    $("#property_type_error").show().text("Requirement field is required");
                } else {
                    $("#property_type_error").hide();
                }

                if ($('input[name="property_category"]:checked').length === 0) {
                    isValid = false;
                    $("#property_category_error").show().text("Category field is required");
                } else {
                    $("#property_category_error").hide();
                }

                if (!validateStep2Form()) {
                    isValid = false;
                }

                // If isValid is true, all validations passed, proceed to the next step
                if (isValid) {
                    console.log("All second fields are valid");
                    $("#other-contact").show();
                } else {
                    console.log("Some second fields are invalid");
                    $("#customer-requirement").show();
                    $("#step1").addClass("btn-primary");
                    $("#step2").removeClass("btn-primary");
                    $("#other-contact").hide();
                }
            });


            // $('#saveEnquiry').click(function() {
            //     if (validateStep3Form()) {
            //         console.log("All third fields are valid");
            //         $("#other-contact").show();
            //     } else {
            //         console.log("Some third fields are invalid");
            //         $("#other-contact").show();
            //         $("#step2").addClass("btn-primary");
            //         $("#step1").removeClass("btn-primary");
            //         $("#customer-requirement").hide();
            //     }
            // });
        });




        //#B 5+BHK then add txtbox
        $('input:checkbox[name*="flat_type"]').change(function() {
            if ($(this).val() === "19" && $(this).is(':checked')) {
                $('#textboxWrapper').show();
            } else {
                $('#textboxWrapper').hide();
            }
        });

        $('input:checkbox[name*="vila_type"]').change(function() {
            if ($(this).val() === "19" && $(this).is(':checked')) {
                $('#textboxWrapperVilla').show();
            } else {
                $('#textboxWrapperVilla').hide();
            }
        });
        //Default Selected display on add Enquiry City- locality
        let id = '{{ isset($current_id) ? $current_id : 'null' }}';
        if (id === 'null') {
            function updateStateSelect() {
                let auth = '{{ Auth::user() }}';
                // let authStateId = '{{ Auth::user()->state_id }}';
                let authCityId = '{{ Auth::user()->city_id }}';

                // $('#state_id').val(authStateId).trigger('change');
                $('#enquiry_city_id').val(authCityId).trigger('change');

                // $('#area_ids').html('');
                // for (let i = 0; i < areass.length; i++) {
                //     if (areass[i]['city_id'] == $("#state-dropdown").val()) {
                //         $('#area_id').append(`<option value="${areass[i]['id']}"
            //     data-pincode="${areass[i]['pincode']}"
            //     data-city_id="${areass[i]['city_id']}"
            //     data-state_id="${areass[i]['state_id']}">
            //     ${areass[i]['name']}
            //  </option>`);
                //     }
                // }
                // $('#area_ids').select2();
            }
            updateStateSelect();
        }

        var search_enq = '';
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var enqq = urlParams.get('pro')
        var filter_by = urlParams.get('filter_by')
        var calendar_date = urlParams.get('date')
        var calendar_type = urlParams.get('type')

        $('.matchbutton').hide()
        try {
            search_enq = decryptSimpleString(enqq);
            if (search_enq != '') {
                $('.matchbutton').show()
            } else {
                $('.matchbutton').hide()
            }
        } catch (error) {

        }

        $(document).on('change', '[name="property_type"]', function(e) {
            $('input[name=property_category]:checked').prop('checked', false).trigger('change')
            showReleventCategory()
        })


        $(document).on('change', '#enquiry_source', function(e) {
            var TheStatus = $($(this).find(":selected")).attr('data-val');

            if (TheStatus == 'Reference') {
                $('.the_source_refrence').show()
            } else {
                $('.the_source_refrence').hide()
            }
        })

        function showReleventCategory() {
            var parent_val = $('input[name=property_type]:checked').val();

            $("[name='property_category']").each(function(i, e) {
                if ($(this).attr('data-Parent_id') == parent_val) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }
        showReleventCategory()


        function resetallfields() {
            hidefields = ['div_office_type', 'div_vila_type', 'div_retail_type', 'div_flat_type', 'div_plot_type',
                'div_storage_type',
                'the_1rk', 'div_farm_house', 'div_land_plot'
            ]
            for (let i = 0; i < hidefields.length; i++) {
                $('.' + hidefields[i]).hide();
            }

        }

        resetallfields();
        $(document).on('change', '[name="property_category"]', function(e) {
            var category_type = $(this).attr('data-val');
            resetallfields()
            if (category_type == 'Flat') {
                $('.div_flat_type').show()
                $(".f-status").show();
                $('.the_1rk').show()
                $(".the_week_end_enq").hide();
            } else if (category_type == 'Penthouse') {
                $(".f-status").show();
                $(".the_week_end_enq").hide();
                $('.div_flat_type').show()
            } else if (category_type == 'Office') {
                $(".f-status").show();
                $(".the_week_end_enq").hide();
                $('.div_office_type').show()
            } else if (category_type == 'Retail') {
                $(".f-status").show();
                $(".the_week_end_enq").hide();
                $('.div_retail_type').show()
            } else if (category_type == 'Storage/industrial') {
                $(".f-status").hide();
                $(".the_week_end_enq").hide();
                $('.div_storage_type').show()
            } else if (category_type == 'Land') {
                $('.div_plot_type').show()
                $(".the_week_end_enq").hide();
                $(".f-status").hide();
            } else if (category_type == 'Farmhouse') {
                $('.div_farm_house').show()
                $(".the_week_end_enq").hide();
            } else if (category_type == 'Plot') {
                $(".f-status").hide();
                $('.div_land_plot').show()
                $(".the_week_end_enq").hide();
            } else if (category_type == 'Vila/Bunglow') {
                $(".the_week_end_enq").show();
                $(".f-status").show();
                $('.div_vila_type').show()
            }
        })

        $(document).on('click', '#matchagain', function(e) {
            e.preventDefault();
            $('#enquiryTable').DataTable().draw();
            $('#matchModal').modal('hide');
        })

        $(document).on('change', '#select_all_checkbox', function(e) {
            if ($(this).prop('checked')) {
                $('.delete_table_row').show();
                $(".table_checkbox").each(function(index) {
                    $(this).prop('checked', true)
                })
            } else {
                $('.delete_table_row').hide();
                $(".table_checkbox").each(function(index) {
                    $(this).prop('checked', false)
                })
            }
        })

        $(document).on('change', '.table_checkbox', function(e) {
            var rowss = [];
            $(".table_checkbox").each(function(index) {
                if ($(this).prop('checked')) {
                    rowss.push($(this).attr('data-id'))
                }
            })
            if (rowss.length > 0) {
                $('.delete_table_row').show();
            } else {
                $('.delete_table_row').hide();
            }
        })

        function deleteTableRow(params) {
            var rowss = [];
            $(".table_checkbox").each(function(index) {
                if ($(this).prop('checked')) {
                    rowss.push($(this).attr('data-id'))
                }
            })
            if (rowss.length > 0) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function(isConfirm) {
                    if (isConfirm.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.deleteEnquiry') }}",
                            data: {
                                allids: JSON.stringify(rowss),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('.delete_table_row').hide();
                                $('#enquiryTable').DataTable().draw();
                            }
                        });
                    }
                })
            }
        }

        function exportEnquiry(params) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.export.enquiry') }}",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    window.open(data)
                }
            });
        }

        function importEnquiries(params) {
            $('#importmodal').modal('show');
        }

        $(document).ready(function() {

            $(function() {
                $("body").tooltip({
                    selector: '[data-toggle=tooltip]'
                });
            })

            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var go_data_id = urlParams.get('data_id')

            $('#enquiryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.enquiries') }}",
                    data: function(d) {
                        d.filter_city_id = $('#filter_city_id').val();
                        d.filter_enquiry_branch_id = $('#filter_enquiry_branch_id').val();
                        d.filter_employee_id = $('#filter_employee_id').val();
                        d.filter_property_type = $('#filter_property_type').val();
                        d.filter_configuration = $('#filter_configuration').val();
                        d.filter_specific_type = JSON.stringify($('#filter_specific_type').val());
                        d.filter_area_id = JSON.stringify($('#filter_area_id').val());
                        d.filter_enquiry_for = $('#filter_enquiry_for').val();
                        d.filter_enquiry_source = $('#filter_enquiry_source').val();
                        d.filter_enquiry_progress = $('#filter_enquiry_progress').val();
                        d.filter_enquiry_status = $('#filter_enquiry_status').val();
                        d.filter_sales_comment = $('#filter_sales_comment').val();
                        d.filter_lead_type = $('input[name="filter_lead_type"]:checked').val();
                        d.filter_purpose = $('#filter_purpose').val();
                        d.filter_nfd_from = $('#filter_nfd_from').val();
                        d.filter_nfd_to = $('#filter_nfd_to').val();
                        d.filter_from_date = $('#filter_from_date').val();
                        d.filter_to_date = $('#filter_to_date').val();
                        d.filter_from_budget = $('#filter_from_budget').val();
                        d.filter_to_budget = $('#filter_to_budget').val();
                        d.filter_favourite = Number($('#filter_favourite').prop('checked'));
                        d.filter_new_enquiry = Number($('#filter_new_enquiry').prop('checked'));
                        d.filter_draft = Number($('#filter_draft').prop('checked'));
                        d.filter_prospect = Number($('#filter_prospect').prop('checked'));
                        d.go_data_id = go_data_id;
                        d.search_enq = search_enq;
                        d.match_property_type = Number($('#match_property_type').prop('checked'));
                        d.match_specific_type = Number($('#match_specific_type').prop('checked'));
                        d.match_configuration = Number($('#match_configuration').prop('checked'));
                        d.match_enquiry_for = Number($('#match_enquiry_for').prop('checked'));
                        d.match_inquiry_source = Number($('#match_inquiry_source').prop('checked'));
                        d.match_furnished_status = Number($('#match_furnished_status').prop('checked'));
                        d.match_building = Number($('#match_building').prop('checked'));
                        d.filter_by = filter_by
                        d.calendar_date = calendar_date
                        d.calendar_type = calendar_type
                    },
                },
                columns: [{
                        data: 'select_checkbox',
                        name: 'select_checkbox',
                        orderable: false
                    },
                    {
                        data: 'client_name',
                        name: 'client_name'
                    },
                    {
                        data: 'client_requirement',
                        name: 'client_requirement'
                    },
                    {
                        data: 'budget',
                        name: 'budget'
                    },
                    {
                        data: 'telephonic_discussion',
                        name: 'telephonic_discussion'
                    },
                    {
                        data: 'assigned_to',
                        name: 'assigned_to'
                    },
                    {
                        data: 'Actions2',
                        name: 'Actions2',
                        orderable: false
                    },
                ],
                columnDefs: [{
                        "width": "3%",
                        "targets": 0
                    }, {
                        "width": "17%",
                        "targets": 1
                    },
                    {
                        "width": "23%",
                        "targets": 2
                    },
                    {
                        "width": "10%",
                        "targets": 3
                    },
                    {
                        "width": "15%",
                        "targets": 4
                    },
                    {
                        "width": "9.99%",
                        "targets": 5
                    },
                    {
                        "width": "15%",
                        "targets": 6
                    }
                ],
                "drawCallback": function(settings, json) {
                    $('.color-code-popover').attr('data-bs-content', $('#mypopover-content').html());
                    setTimeout(() => {
                        $('.color-code-popover').popover({
                            html: true,
                        });
                    }, 500);
                    var popoverTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="popover"]'))
                    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                        return new bootstrap.Popover(popoverTriggerEl)
                    });
                }
            });
        });

        function matchingProperty(data) {
            urll = matching_property_url + '?enq=' + encryptSimpleString($(data).attr('data-id'));
            window.location = urll;
        }

        $(document).on('click', '#filtersearch', function(e) {
            e.preventDefault();
            go_data_id = '';
            $('#enquiryTable').DataTable().draw();
            $('#filtermodal').modal('hide');
            $('#resetfilter').show();
        });

        $(document).on('click', '#resetfilter', function(e) {
            e.preventDefault();
            $(this).hide();
            $('#filter_form').trigger("reset");
            $('#enquiryTable').DataTable().draw();
            $('#filtermodal').modal('hide');
            $('#filter_specific_type').val([]).trigger('change');
            $('#filter_area_id').val([]).trigger('change');
            triggerResetFilter()
        });


        function add_contact_click(plus) {
            $('#all_contacts').append(generate_contact_detail(makeid(10), plus));
            $("#all_contacts select").each(function(index) {
                $(this).select2();
            })
            floatingField();
        }

        if ('{{ isset($current_id) ? $current_id : '' }}' == '') {
            add_contact_click(1)
        }

        $(document).on('change', '.changeTheStatus', function(e) {
            stat = 0;
            if ($(this).prop('checked')) {
                stat = 1;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('admin.changeEnquiryStatus') }}",
                data: {
                    id: $(this).attr('data-id'),
                    status: stat,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {

                }
            });
        })

        function convertToStringArr(params) {
            var newarr = [];
            for (let i = 0; i < params.length; i++) {
                newarr.push(String(params[i]))
            }
            return newarr;
        }

        // bharat get
        function getEnquiry() {
            $('#modal_form').trigger("reset");
            var id = '{{ isset($current_id) ? $current_id : '' }}';
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getEnquiry') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data_obj) {
                    if (data_obj == '') {
                        return
                    }
                    // edit enquiry
                    data = JSON.parse(data_obj);
                    console.log("data.enquiry_for ==", data.enquiry_for);

                    // Requirement Type
                    if (data.requirement_type != null) {
                        $('input[name=property_type][value=' + data.requirement_type + ']').prop('checked',
                            true).trigger('change')
                    }

                    // category
                    if (data.property_type != null) {
                        $('input[name=property_category][value=' + data.property_type + ']').prop('checked',
                            true).trigger('change')
                    }
                    $('#this_data_id').val(data.id);
                    $('#client_name').val(data.client_name);
                    $('#client_mobile').val(data.client_mobile);
                    // $('#country_code').val(data.country_code);
                    $('#client_email').val(data.client_email);
                    $('#is_nri').prop('checked', Number(data.is_nri));

                    if (data.enquiry_for == 'Rent') {
                        document.getElementById('propertyfor1').checked = true;
                        $(".both-price").hide();
                        $(".enq-purpose").hide();
                        $('.enq_budget').show();
                    }

                    if (data.enquiry_for == 'Buy') {
                        document.getElementById('propertyfor2').checked = true;
                        $(".both-price").hide();
                        $(".enq-purpose").show();
                        $('.enq_budget').show();
                    }

                    if (data.enquiry_for == 'Both') {
                        document.getElementById('propertyfor3').checked = true;
                        $(".both-price").show();
                        $('.enq_budget').hide();
                    }

                    $('#area_from').val(data.area_from);
                    $('#area_to').val(data.area_to);
                    $('#area_from_measurement').val(data.area_from_measurement).trigger('change');
                    $('#area_to_measurement').val(data.area_to_measurement).trigger('change');
                    $('#enquiry_source').val(data.enquiry_source).trigger('change');

                    $('#furnished_status').val(JSON.parse(data.furnished_status)).trigger('change');
                    // $('#budget_from').val(data.budget_from);
                    // $('#budget_to').val(data.budget_to);
                    let formattedBudgetFrom = fmt(data.budget_from.toString());
                    let formattedBudgetTo = fmt(data.budget_to.toString());
                    $('#budget_from').val(formattedBudgetFrom);
                    $('#budget_to').val(formattedBudgetTo);
                    $('#rent_price').val(data.rent_price);
                    $('#sell_price').val(data.sell_price);
                    $('#purpose').val(data.purpose).trigger('change');;
                    $('#building_id').val(JSON.parse(data.building_id)).trigger('change');
                    $('#enquiry_status').val(data.enquiry_status).trigger('change');
                    $('#project_status').val(data.project_status).trigger('change');
                    $('#country_code').val(data.country_id).trigger('change');
                    $('#area_ids').val(JSON.parse(data.area_ids)).trigger('change');
                    $('#is_preleased').prop('checked', Number(data.is_preleased));
                    $('#weekend_enq').prop('checked', Number(data.weekend_enq));
                    $('#telephonic_discussion').val(data.telephonic_discussion);
                    $('#highlights').val(data.highlights);
                    $('#enquiry_city_id').val(data.enquiry_city_id).trigger('change');
                    $('#enquiry_branch_id').val(data.enquiry_branch_id).trigger('change');
                    $('#employee_id').val(data.employee_id).trigger('change');
                    $('#is_favourite').prop('checked', Number(data.is_favourite));
                    $('#all_contacts').html('')
                    $('#all_contact_list_data').html('')
                    $('#district_id').val(data.district_id);
                    $('#taluka_id').val(data.taluka_id);
                    $('#village_id').val(data.village_id);
                    $('#refrence').val(data.enquiry_source_refrence);

                    if (data.other_contacts != '') {
                        details = JSON.parse(data.other_contacts);
                        try {
                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                if (i == 0) {
                                    $('#all_contacts').append(generate_contact_detail(id, 1))
                                } else {
                                    $('#all_contacts').append(generate_contact_detail(id))
                                }
                                floatingField();
                                $("[data-contact_id=" + id + "] select[name=contact_country_code]").select2()
                                $("[data-contact_id=" + id + "] input[name=contact_person_name]").val(details[i]
                                    [
                                        0
                                    ]);
                                $("[data-contact_id=" + id + "] input[name=contact_person_no]").val(details[i][
                                    1
                                ]);

                                $("[data-contact_id=" + id + "] select[name=contact_country_code]").val(details[
                                    i][
                                    2
                                ]).trigger('change');
                                $("[data-contact_id=" + id + "] input[name=contact_nri]").prop('checked',
                                    Number(
                                        details[i][3]));

                            }
                        } catch (error) {

                        }
                    } else {
                        $('#all_contacts').append(generate_contact_detail(id, 1))
                    }
                    triggerChangeinput()
                    floatingField();
                }
            });
        }
        getEnquiry()

        function deleteEnquiry(data) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function(isConfirm) {
                if (isConfirm.isConfirmed) {
                    var id = $(data).attr('data-id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.deleteEnquiry') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#enquiryTable').DataTable().draw();
                        }
                    });
                }
            })
        }

        $(document).on('click', '#saveProgress', function(e) {

            e.preventDefault();
            $(this).prop('disabled', true);
            var id = $('#progress_enquiry_id').val()
            $.ajax({
                type: "POST",
                url: "{{ route('admin.saveProgress') }}",
                data: {
                    enquiry_id: id,
                    progress: $('#progress_enquiry_progress').val(),
                    lead_type: $('input[name="progress_lead_type"]:checked').val(),
                    sales_comment_id: $('#progress_sales_comment').val(),
                    nfd: $('#nfdDateTime').val(),
                    remarks: $('#progress_remarks').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#enquiryTable').DataTable().draw();
                    $('#progressmodal').modal('hide');
                    $('#saveProgress').prop('disabled', false);
                }
            });
        });

        $(document).on('click', '#saveSchedule', function(e) {
            e.preventDefault();
            $(this).prop('disabled', true);
            var id = $('#schedule_visit_id').val()
            $.ajax({
                type: "POST",
                url: "{{ route('admin.saveSchedule') }}",
                data: {
                    enquiry_id: id,
                    visit_status: $('#schedule_visit_status').val(),
                    description: $('#schedule_description').val(),
                    visit_date: $('#site_visit_time').val(),
                    assigned_to: $('#schedule_assigned_to').val(),
                    schedule_remind: $('#schedule_remind').val(),
                    property_list: JSON.stringify($('#property_list').val()),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#enquiryTable').DataTable().draw();
                    $('#saveSchedule').prop('disabled', false);
                },
                error: function(data) {
                    $('#saveSchedule').prop('disabled', false);
                }
            });
            $("#schedule_form select").each(function(index) {
                $(this).val('').trigger('change');
            })
            $('#schedule_form')[0].reset();
            getScheduleVisit(id)
        });

        function transferEnquiry(data) {
            var id = $(data).attr('data-id');
            var employee = $(data).attr('data-employee');
            assignHistory(id);
            $('#transfer_form_id').val(id);
            $('#transfer_employee_id').val(employee)
            $('#transfermodal').modal('show');
        }

        function assignHistory(id) {
            var call_url = "{{ route('admin.get.assign.history') }}?id=" + id;
            $.ajax({
                type: "POST",
                url: call_url,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#assign-history-section').html(data.html);
                }
            });
        }

        $(document).on('click', '#transferNow', function(e) {
            e.preventDefault();
            var id = $('#transfer_form_id').val()
            var employee = $('#transfer_employee_id').val()
            $.ajax({
                type: "POST",
                url: "{{ route('admin.transferEnquiry') }}",
                data: {
                    enquiry_id: id,
                    employee: employee,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#enquiryTable').DataTable().draw();
                    $('#transfermodal').modal('hide');
                }
            });
        });

        $(document).on('click', '.showNumberNow', function(e) {
            numb = $(this).attr('data-val');
            $(this).replaceWith('<a href="tel:' + numb + '">' + numb + '</a>');
        })

        function contactList(data) {
            $('#all_contacts').html('')
            $('#all_contact_list_data').html('')
            $('#contact_list_form')[0].reset();
            $('#contact_list_enquiry_id').val($(data).attr('data-id'));
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getContactList') }}",
                data: {
                    enquiry_id: $(data).attr('data-id'),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data != '') {
                        details = JSON.parse(data);
                        for (let i = 0; i < details.length; i++) {
                            id = makeid(10);
                            $('#all_contact_list_data').append(generate_contact_detail(id))
                            floatingField();
                            $("[data-contact_id=" + id + "] select[name=contact_country_code]").select2()
                            $("[data-contact_id=" + id + "] input[name=contact_person_name]").val(details[i][
                                0
                            ]);
                            $("[data-contact_id=" + id + "] input[name=contact_person_no]").val(details[i][1]);
                            $("[data-contact_id=" + id + "] select[name=contact_country_code]").val(details[i][
                                    2
                                ])
                                .trigger('change');
                            $("[data-contact_id=" + id + "] input[name=contact_nri]").prop('checked', Number(
                                details[i][3]));
                        }
                    }
                }
            });
            $('#contactlistmodal').modal('show');
        }

        $(document).on('click', '#saveContactList', function(e) {
            e.preventDefault();
            $(this).prop('disabled', true);
            var id = $('#contact_list_enquiry_id').val()
            contact_details = [];
            $("#all_contact_list_data [name=contact_person_name]").each(function(index) {
                cona_arr = []
                unique_id = $(this).closest('.form-group').attr('data-contact_id');
                name = $(this).val();
                no = $("[data-contact_id=" + unique_id + "] input[name=contact_person_no]").val();
                contact_code = $("[data-contact_id=" + unique_id + "] select[name=contact_country_code]")
                    .val();
                nri = $("[data-contact_id=" + unique_id + "] input[name=contact_nri]").prop('checked')
                cona_arr.push(name)
                cona_arr.push(no)
                cona_arr.push(contact_code)
                cona_arr.push(Number(nri))
                if (filtercona_arr(cona_arr)) {
                    contact_details.push(cona_arr);
                }
            });
            contact_details = JSON.stringify(contact_details);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.saveContactList') }}",
                data: {
                    enquiry_id: id,
                    contacts: contact_details,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#contactlistmodal').modal('hide');
                    $('#saveContactList').prop('disabled', false);
                }
            });
        })

        function addProgress(data) {
            $('#progress_form')[0].reset();
            $('#showprogressmodal').modal('hide');
            $('#progressmodal').modal('show');
            $('#progress_enquiry_id').val($(data).attr('data-id'));
        }

        function showProgress(data) {
            $('.progress_data').html('')
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getProgress') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        var str = '<tr>';
                        str += '   <td>' + data[i]['created_at'] + '</td>';
                        if (data[i]['progress'] !== null) {
                            str += '   <td>' + data[i]['progress'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (data[i]['dropdowns'] !== null) {
                            str += '   <td>' + data[i]['dropdowns']['name'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (data[i]['nfd'] !== null) {
                            str += '   <td>' + data[i]['nfd'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (data[i]['remarks'] !== null) {
                            str += '   <td>' + data[i]['remarks'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (data[i]['lead_type'] !== null) {
                            str += '   <td>' + data[i]['lead_type'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (CheckIfarraykeyExists(data, i, 'user', 'first_name')) {
                            str += '   <td>' + data[i]['user']['first_name'] + ' ' + data[i]['user'][
                                    'last_name'
                                ] +
                                '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        str += '</tr>';
                        $('.progress_data').append(str.replace('null', ''))
                    }
                }
            });
            $('#addProgressButton').attr('data-id', id);
            $('#showprogressmodal').modal('show');
        }

        function CheckIfarraykeyExists(data, i, key1, key2) {
            try {
                tmpvar = data[i][key1][key2]
                return 1
            } catch (error) {
                return 0
            }
        }

        function getScheduleVisit(id) {
            $('.schedule_data').html('')
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getSchedule') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        var str = '<tr>';
                        str += '   <td>' + data[i]['created_at'] + '</td>';
                        if (data[i]['visit_status'] !== null) {
                            str += '   <td>' + data[i]['visit_status'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }

                        if (data[i]['visit_date'] !== null) {
                            str += '   <td>' + data[i]['visit_date'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (CheckIfarraykeyExists(data, i, 'assigned_to', 'first_name')) {
                            str += '   <td>' + data[i]['assigned_to']['first_name'] + ' ' + data[i][
                                    'assigned_to'
                                ]['last_name'] +
                                '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (data[i]['description'] !== null) {
                            str += '   <td>' + data[i]['description'] + '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        if (CheckIfarraykeyExists(data, i, 'assigned_by', 'first_name')) {
                            str += '   <td>' + data[i]['assigned_by']['first_name'] + ' ' + data[i][
                                    'assigned_by'
                                ]['last_name'] +
                                '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        $('.schedule_data').append(str.replace('null', ''))
                    }
                }
            });
        }

        function showScheduleVisit(data) {
            var id = $(data).attr('data-id');
            var employee = $(data).attr('data-employee');
            getScheduleVisit(id)
            $('#schedule_form')[0].reset();
            $('#schedule_visit_id').val(id);
            $('#schedule_assigned_to').val(employee).trigger('change');
            $('#showschedulemodal').modal('show');
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

        function generate_contact_detail(id, plus = 0) {
            var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-4 m-b-20">' +
                '<div><label>Contact person</label>' +
                '<input class="form-control" name="contact_person_name" type="text"' +
                'autocomplete="off">' +
                '</div><div id="contact_person_name_error_' + id +
                '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                '</div>' +
                '<div  data-contact_id= ' + id + ' class="col-md-4 country_code_area">' +
                '   <div class="input-group">' +
                '       <div class="input-group-append col-md-4 m-b-20">' +
                '           <div class="form-group country_code">' +
                '               <div style="border-top-left-radius: 5px !important;border-bottom-left-radius: 5px !important" class="divSelect">' +
                '                   <select class="form-control countries_list" id="contact_country_code" name="contact_country_code" style="border-top-left-radius: 5px !important;border-bottom-left-radius: 5px !important">' +
                '                       @foreach ($country_codes as $country_code)' +
                '                           <option data-parent_id="{{ $country_code->id }}" value={{ $country_code->id }}>+{{ $country_code->country_iso }} ({{ $country_code->country_code }})</option>' +
                '                       @endforeach' +
                '                   </select>' +
                '               </div>' +
                '           </div>' +
                '       </div>' +
                '       <div class="form-group col-md-8 m-b-20">' +
                '           <div class="fname">' +
                '               <label for="Mobile">Mobile</label>' +
                '               <input class="form-control" name="contact_person_no" style="border-right:2px solid #1d2848 !important; border-top-right-radius: 5px;border-bottom-right-radius: 5px" id="contact_person_no" type="text" autocomplete="off">' +
                '           </div>' +
                '           <div class="invalid-feedback" id="contact_person_no_error' + id +
                '" style="display: block;color:red;"></div>' +
                '       </div>' +
                '   </div>' +
                '</div>' +
                '<div data-contact_id= ' + id +
                ' class="form-check custom-checkbox checkbox-solid-success mb-0 col-md-1 m-b-20">' +
                '   <input class="form-check-input" name="contact_nri" type="checkbox">' +
                '   <label class="form-check-label" for="contact_nri">NRI</label>' +
                '</div>' +
                '<div data-contact_id= ' + id +
                ' class="form-group col-md-1 m-b-4 mb-3"><button data-contact_id=' + id +
                ' class="' + ((plus) ? "add_contacts" : "remove_contacts") +
                ' btn btn-danger btn-air-danger" type="button">' + ((plus) ? "+" : "-") + '</button>  </div>';
            return myvar;

            // var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-4 m-b-20">' +
            //     '<div><label>Contact person</label>' +
            //     '       <input class="form-control" name="contact_person_name" type="text"' +
            //     '            autocomplete="off">' +
            //     '</div><div id="contact_person_name_error_' + id +
            //     '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //     '        </div>' +
            //     '     <div data-contact_id= ' + id +
            //     ' class="form-group col-md-4 m-b-20">' +
            //     '<div><label>Contact person No</label>' +
            //     '       <input class="form-control" name="contact_person_no"' +
            //     '           type="text"  autocomplete="off">' +
            //     '</div><div id="contact_person_no_error_' + id +
            //     '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //     '        </div>' +
            //     '<div data-contact_id= ' + id +
            //     ' class="form-check custom-checkbox   checkbox-solid-success mb-0 col-md-1 m-b-20">' +
            //     ' <input class="form-check-input" name="contact_nri" type="checkbox">' +
            //     ' <label class="form-check-label" for="contact_nri">NRI</label>' +
            //     '               </div>' +
            //     '<div data-contact_id= ' + id +
            //     ' class="form-group col-md-1 m-b-4 mb-3"><button data-contact_id=' + id +
            //     ' class="' + ((plus) ? "add_contacts" : "remove_contacts") +
            //     ' btn btn-danger btn-air-danger" type="button">' + ((plus) ? "+" : "-") + '</button>  </div>';
            // return myvar;
        }

        $(document).on('click', '.add_contacts', function(e) {
            add_contact_click(0)
        })

        $(document).on('click', '#add_contactsToList', function(e) {
            id = makeid(10);
            $('#all_contact_list_data').append(generate_contact_detail(id));
            $("#all_contact_list_data select").each(function(index) {
                $(this).select2();
            })
            floatingField();
        })

        $(document).on('click', '.remove_contacts', function(e) {
            id = $(this).attr('data-contact_id');
            $("[data-contact_id=" + id + "]").each(function(index) {
                $(this).remove();
            });
        })

        function convertToNumber(params) {
            return Number(params.replaceAll(",", ""));
        }

        $.validator.addMethod("checkBudget", function(value, element) {
            val2 = $('#budget_from').val()
            if (value != '' && val2 != '') {
                if (convertToNumber(value) < convertToNumber(val2)) {
                    return false;
                } else {
                    return true;
                }
            }
        }, 'Budget To greater than Budget From');

        $.validator.addMethod("checkArea", function(value, element) {
            val2 = $('#area_size_from').val()
            if (val2 != '' && value != '') {
                if (Number(value) < Number(val2)) {
                    return false;
                } else {
                    return true;
                }
            }
        }, 'Area To Must be greater than area from');

        $('#modal_form').validate({ // initialize the plugin
            rules: {
                area_size_from: {
                    digits: true,
                },
                area_size_to: {
                    digits: true,
                    checkArea: true,
                },
                // budget_to: {
                //     checkBudget: true,
                // },
            },
            submitHandler: function(form) { // for demo
                alert('valid form submitted'); // for demo
                return false; // for demo
            }
        });

        $(document).on('click', '#saveEnquiry', function(e) {

            var contact_details = [];
            var isValid = true;
            $("#all_contacts [name=contact_person_name]").each(function(index) {
                cona_arr = []
                unique_id = $(this).closest('.form-group').attr('data-contact_id');
                name = $(this).val();
                no = $("[data-contact_id=" + unique_id + "] input[name=contact_person_no]").val();
                contact_code = $("[data-contact_id=" + unique_id + "] select[name=contact_country_code]")
                    .val();
                nri = $("[data-contact_id=" + unique_id + "] input[name=contact_nri]").prop('checked')

                var isContactNumberValid = validateMobileNumber(
                    "[data-contact_id=" + unique_id + "] input[name=contact_person_no]",
                    "#contact_person_no_error" + unique_id,
                    "Invalid mobile number format"
                );

                // Update isValid only if the current field is invalid
                if (!isContactNumberValid) {
                    isValid = false;
                }

                cona_arr.push(name)
                cona_arr.push(no)
                // cona_arr.push(status)
                cona_arr.push(contact_code)
                cona_arr.push(Number(nri))
                if (filtercona_arr(cona_arr)) {
                    contact_details.push(cona_arr);
                }
            });
            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
            contact_details = JSON.stringify(contact_details);
            //bharat add subcategory done
            var configuration = '';
            if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                var configuration = $('input[name="office_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
            } else if ($('input[name=property_category]:checked').attr('data-val') == 'Land') {
                var configuration = $('input[name="plot_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
                //
            } else if ($('input[name=property_category]:checked').attr('data-val') == 'Flat') {
                console.log("flate cat here ==", configuration);
                var configuration = $('input[name="flat_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
            } else if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                var configuration = $('input[name="retail_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
            } else if ($('input[name=property_category]:checked').attr('data-val') == 'Storage/industrial') {
                var configuration = $('input[name="storage_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
            } else if ($('input[name=property_category]:checked').attr('data-val') == 'Penthouse') {
                var configuration = $('input[name="flat_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
            } else if ($('input[name=property_category]:checked').attr('data-val') == 'Vila/Bunglow') {
                var configuration = $('input[name="vila_type[]"]:checked').map(function() {
                    return this.value;
                }).get();
            } else {
                console.log("none sub category in enquiries : ==", configuration);
                var configuration = 0;
            }

            if (!isValid) {
                console.log("error on validations :", isValid);
                return
            } else {
                console.log("true redirect :", isValid);
                $(this).prop('disabled', true);
            }
            var id = $('#this_data_id').val()
            $.ajax({
                type: "POST",
                url: "{{ route('admin.saveEnquiry') }}",
                data: {
                    id: $('#this_data_id').val(),
                    client_name: $('#client_name').val(),
                    zone: $("#zone").val(),
                    client_mobile: $('#client_mobile').val(),
                    country_code: $('#country_code').val(),
                    client_email: $('#client_email').val(),
                    is_nri: Number($('#is_nri').prop('checked')),
                    enquiry_for: $("[name=enquiry_for]:checked").val(),
                    // requirement_type: [$("[name=property_type]:checked").val()],
                    requirement_type: $("[name=property_type]:checked").val(),
                    property_type: $("[name=property_category]:checked").val(),
                    // configuration: $('[name=configuration]:checked').val(),
                    configuration: configuration,
                    refrence: $('#refrence').val(),
                    area_from: $('#area_from').val(),
                    area_to: $('#area_to').val(),
                    area_from_measurement: $('#area_from_measurement').val(),
                    area_to_measurement: $('#area_from_measurement').val(),
                    enquiry_source: $('#enquiry_source').val(),
                    furnished_status: JSON.stringify($('#furnished_status').val()),
                    budget_from: $('#budget_from').val(),
                    // res_more: $('#txt5moreFlate').val() !== "" ? $('#txt5moreFlate').val() : $('#txt5moreVilla').val(),
                    budget_to: $('#budget_to').val(),
                    rent_price: $('#rent_price').val(),
                    sell_price: $('#sell_price').val(),
                    purpose: $('#purpose').val(),
                    building_id: JSON.stringify($('#building_id').val()),
                    enquiry_status: $('#enquiry_status').val(),
                    project_status: $('#project_status').val(),
                    area_ids: JSON.stringify($('#area_ids').val()),
                    is_preleased: Number($('#is_preleased').prop('checked')),
                    weekend_enq: Number($('#weekend_enq').prop('checked')),
                    other_contacts: contact_details,
                    telephonic_discussion: $('#telephonic_discussion').val(),
                    highlights: $('#highlights').val(),
                    enquiry_city_id: $('#enquiry_city_id').val(),
                    enquiry_branch_id: $('#enquiry_branch_id').val(),
                    employee_id: $('#employee_id').val(),
                    is_favourite: Number($('#is_favourite').prop('checked')),
                    _token: '{{ csrf_token() }}',
                    district_id: $('#district_id').val(),
                    taluka_id: $('#taluka_id').val(),
                    village_id: $('#village_id').val(),
                },
                success: function(data) {
                    var redirect_url = "{{ route('admin.enquiries') }}";
                    window.location.href = redirect_url;
                }
            });
        })


        $(document).on('click', '#importFile', function(e) {
            e.preventDefault();
            var formData = new FormData();
            var files = $('#import_file')[0].files[0];
            if (files == '') {
                return;
            }
            formData.append('csv_file', files);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: "{{ route('admin.importenquiry') }}",
                data: formData,
                success: function(data) {
                    $('#enquiryTable').DataTable().draw();
                    $('#importmodal').modal('hide');
                    $('#import_form')[0].reset();
                }
            });
        })

        function floatingField() {
            //changed by Subhash
            $("form input").each(function(index) {
                if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
                    var inputhtml = $(this).clone()
                    var parentId = $(this).parent();
                    if (parentId.find('label').length > 0) {
                        $(this).remove();
                        var currenthtml = $(parentId).html()
                        $(parentId).html('<div class="fname focused">' + currenthtml + '<div class="fvalue">' +
                            inputhtml[0]
                            .outerHTML + '</div>' + '</div>')
                    }
                }
            })
        }
        //---------------------------------------------------------------------------------------
        $(document).on('change', '[name="property_type"]', function(e) {
            $('input[name=property_category]:checked').prop('checked', false).trigger('change')
            resetallfields();
            //setIndividualfields();
            showReleventCategory()
        });

        showReleventCategory()

        function resetallfields() {
            hidefields = ['div_office_type', 'div_retail_type', 'div_vila_type', 'div_flat_type', 'div_plot_type',
                'div_storage_type', 'the_source_refrence',
                'div_property_address', 'div_flat_details', 'div_flat_details_2', 'div_flat_details_3',
                'div_description_section', 'div_survey_details', 'div_tp_details',
                'div_document_section', 'div_office_setup', 'div_road_width',
                'div_washroom_type_1', 'div_conference_room', 'div_reception_area', 'div_pantry_type',
                'div_availability_status', 'div_age_of_property', 'div_Possession_by', 'div_shop_facade_size',
                'div_floor_allowed_for_construction', 'div_borewell', 'div_property_dimensions', 'div_washroom_type_2',
                'div_flat_details_4', 'div_flat_details_5', 'div_other_details',
                'div_flat_details_7', 'div_flat_details_8', 'div_plot_ind_common',
                'div_area_size_details', 'div_area_size_details_land_plot', 'div_flat_details_vila',
                'div_checkboxes1', 'div_extra_retail_details', 'div_property_source', 'div_office_furnished',
                'div_care_taker', 'div_furnished_items', 'div_furnished_items_2', 'the_furnished_status',
                'div_construction_allowed_for', 'div_retail_furnished', 'div_amenities', 'div_amenities_checks'
            ]
            for (let i = 0; i < hidefields.length; i++) {
                $('.' + hidefields[i]).hide();
            }

        }

        $(document).on('change', '[name="enquiry_for"]', function(e) {
            resetallfields();
            showReleventCategory();
        });

        function showReleventCategory(params) {
            var parent_val = $('input[name=property_type]:checked').val();

            $("[name='property_category']").each(function(i, e) {
                if ($(this).attr('data-Parent_id') == parent_val) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });

            //Hide Land while click on rent or both 
            var theFor = $('input[name=enquiry_for]:checked').val();

            if (theFor == 'Buy' && parent_val == '87') {
                $('.enquiry-type-element[data-enquiry-id="256"]').show();
            } else {
                $('.enquiry-type-element[data-enquiry-id="256"]').hide();
            }

            // if (theFor == 'Rent' || theFor == 'Both') {
            //     $('.enquiry-type-element[data-enquiry-id="262"]').hide();
            // } else if (parent_val == '85') {
            //     $('.enquiry-type-element[data-enquiry-id="262"]').show();
            // }

            if (theFor == 'Both') {
                $(".both-price").show();
                $('.enq_budget').hide();
            } else if (theFor == 'Rent') {
                $(".both-price").hide();
                $('.enq_budget').show();
                $(".enq-purpose").hide();
            } else {
                $(".both-price").hide();
                $('.enq_budget').show();
                $(".enq-purpose").show();
            }
        }
        $(document).on('click', '.previousBtn1', function() {
            $("#customer-requirement").hide();
            $("#step1").removeClass("btn-primary");
            $("#step0").addClass("btn-primary");
            $("#customer-info").show();
        })
        $(document).on('click', '.previousBtn2', function() {
            $("#other-contact").hide();
            $("#step2").removeClass("btn-primary");
            $("#step1").addClass("btn-primary");
            $("#customer-requirement").show();
        })
        $(document).on('change', '.btn-check', function() {
            var attr_name = this.id;

            const newCategories = ['plotkind2'];
            if (newCategories.includes(attr_name)) {
                $(".div_land_plot").show();
                $(".cl-locality").hide();
                $(".f-status").hide();
                if (attr_name == "plotkind2") {
                    $(".cat-project").hide();
                    $(".cat-project-status").hide();
                }
            } else {
                $(".div_land_plot").hide();
                $(".cl-locality").show();
            }

            if (attr_name == "plotkind1") {
                $(".f-status").hide();
                $(".cat-project").hide();
                $(".cat-project-status").hide();
            }

            if (attr_name == "storagekind4") {
                $(".f-status").hide();
            }


        });
    </script>
@endpush



{{-- addneq --}}
