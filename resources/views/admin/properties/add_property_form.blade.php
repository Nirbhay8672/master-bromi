@extends('admin.layouts.app')
@section('content')
    @php
        $is_dynamic_form = true;
    @endphp
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
                            <h5 class="mb-3">Add Property</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <div class="bromi-form-wizard stepwizard">
                                        <div class="stepwizard-row setup-panel">
                                            <div class="stepwizard-step mb-5" style="text-align:initial">
                                                <button class="btn btn-primary" id="step0"
                                                    data-action="#information-step">1</button>
                                                <p class="ms-2">Information</p>
                                            </div>
                                            <div class="stepwizard-step mb-5" style="text-align:initial">
                                                <button class="btn btn-light" id="step1"
                                                    data-action="#profile-step">2</button>
                                                <p class="ms-2">Property Details</p>
                                            </div>

                                            <div class="stepwizard-step" style="text-align:initial">
                                                <button class="btn btn-light" id="step2"
                                                    data-action="#unit-owner-step">3</button>
                                                <p class="ms-2">Unit & Contact Information</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-lg-10 border-start ps-4">
                                    <form class="form-bookmark needs-validation modal_form" enctype="multipart/form-data"
                                        method="post" id="modal_form" novalidate="">
                                        <div class="setup-content" id="information-step">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <div>
                                                                <label><b>Property For</b></label>
                                                            </div>
                                                            <input type="hidden" name="this_data_id" id="this_data_id">
                                                            <div class="btn-group me-2" role="group"
                                                                aria-label="Basic radio toggle button group">
                                                                <input type="radio" value="Rent" class="btn-check"
                                                                    name="property_for" id="propertyfor1" autocomplete="off"
                                                                    checked>
                                                                <label class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                    for="propertyfor1">Rent</label>
                                                            </div>
                                                            <div class="btn-group me-2" role="group"
                                                                aria-label="Basic radio toggle button group">
                                                                <input type="radio" value="Sell" class="btn-check"
                                                                    name="property_for" id="propertyfor2"
                                                                    autocomplete="off">
                                                                <label class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                    for="propertyfor2">Sell</label>
                                                            </div>
                                                            <div class="btn-group me-2" role="group"
                                                                aria-label="Basic radio toggle button group">
                                                                <input type="radio" value="Both" class="btn-check"
                                                                    name="property_for" id="propertyfor3"
                                                                    autocomplete="off">
                                                                <label class="btn btn-outline-info btn-pill btn-sm py-1"
                                                                    for="propertyfor3">Both</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Property Type</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <input class="form-check-input" id="propertytype85"
                                                                    type="radio" name="property_type"
                                                                    data-val="Commercial" value="85" checked=""
                                                                    data-bs-original-title="" title="">
                                                                <label class="form-check-label mb-0"
                                                                    for="propertytype85">Commercial</label>
                                                                <input class="form-check-input" id="propertytype87"
                                                                    type="radio" name="property_type"
                                                                    data-val="Residential" value="87"
                                                                    data-bs-original-title="" title="">
                                                                <label class="form-check-label mb-0"
                                                                    for="propertytype87">Residential</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                @forelse ($property_configuration_settings as $props)
                                                                    @if ($props['dropdown_for'] == 'property_specific_type')
                                                                        <div class="btn-group bromi-checkbox-btn me-1 property-type-element"
                                                                            role="group"
                                                                            aria-label="Basic radio toggle button group"
                                                                            data-property-id="{{ $props['id'] }}">
                                                                            <input type="radio"
                                                                                data-parent_id="{{ $props['parent_id'] }}"
                                                                                class="btn-check"
                                                                                value="{{ $props['id'] }}"
                                                                                data-val="{{ $props['name'] }}"
                                                                                name="property_category"
                                                                                id="category-{{ $props['id'] }}"
                                                                                data-error="#property_category_error"
                                                                                autocomplete="off">
                                                                            <label
                                                                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                                for="category-{{ $props['id'] }}">{{ $props['name'] }}</label>
                                                                        </div>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                            <div>
                                                                <label id="property_category_error"></label>
                                                            </div>
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
                                                                        data-error="#office_type_error" name="office_type"
                                                                        autocomplete="off">
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
                                                                        data-error="#office_type_error" name="office_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="officekind2">Co-working</label>
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
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="3" id="retailkind1"
                                                                        data-error="#retail_type_error" name="retail_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind1">Ground floor</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#retail_type_error" value="4"
                                                                        id="retailkind2" name="retail_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind2">1st floor</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#retail_type_error" value="5"
                                                                        id="retailkind3" name="retail_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind3">2nd floor</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#retail_type_error" value="6"
                                                                        id="retailkind4" name="retail_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="retailkind4">3rd floor</label>
                                                                </div>
                                                            </div>
                                                            <div id="retail_type_error"></div>
                                                        </div>
                                                    </div>
                                                    {{-- old flat --}}
                                                    <div class="row mb-3 div_flat_type" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Sub category</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="the_1rk btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="13" id="flatkind1" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind1">1 rk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="14" id="flatkind2" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind2">1bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="15" id="flatkind3" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind3">2bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="16" id="flatkind4" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind4">3bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="17" id="flatkind5" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind5">4bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="18" id="flatkind6" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="flatkind6">5bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1 txt5plus"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="19" id="flatkind7" name="flat_type"
                                                                        data-error="#flat_type_error" autocomplete="off">
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
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="14" id="vilakind1"
                                                                        data-val="resedential" name="vila_type"
                                                                        data-error="#vila_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind1">1 BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="15" id="vilakind2"
                                                                        data-val="resedential" name="vila_type"
                                                                        data-error="#vila_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind2">2 BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" data-val="resedential"
                                                                        class="btn-check" value="16" id="vilakind3"
                                                                        name="vila_type" data-error="#vila_type_error"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind3">3 BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" data-val="resedential"
                                                                        class="btn-check" value="17" id="vilakind4"
                                                                        name="vila_type" data-error="#vila_type_error"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind4">4 BHK</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="18" data-val="resedential"
                                                                        id="vilakind5" name="vila_type"
                                                                        data-error="#vila_type_error" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="vilakind5">5bhk</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group txt5plus">
                                                                    <input type="radio" class="btn-check"
                                                                        value="19" data-val="resedential"
                                                                        id="vilakind6" name="vila_type"
                                                                        data-error="#vila_type_error" autocomplete="off">
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
                                                                        data-val="commercial" name="plot_type"
                                                                        data-error="#plot_type_error" autocomplete="off"
                                                                        onchange="toggleProjectDropdown(this)">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="plotkind1">Commercial Land</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-val="agriculture" value="11"
                                                                        id="plotkind2" name="plot_type"
                                                                        data-error="#plot_type_error" autocomplete="off"
                                                                        onchange="toggleProjectDropdown(this)">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="plotkind2">Agricultural/Farm Land</label>
                                                                </div>
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
                                                                        name="storage_type" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind1">Warehouse</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#storage_type_error" value="8"
                                                                        id="storagekind2" name="storage_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind2">Cold Storage</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#storage_type_error" value="9"
                                                                        id="storagekind3" name="storage_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind3">ind. shed</label>
                                                                </div>
                                                                {{-- bharat subcategory 2nd task --}}
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        data-error="#storage_type_error" value="20"
                                                                        id="storagekind4" name="storage_type"
                                                                        autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="storagekind4">Plotting</label>
                                                                </div>
                                                            </div>
                                                            <div id="storage_type_error"></div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary nextBtn" style="border-radius: 5px;"
                                                        id="nextButton" type="button">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- mb validation --}}
                                        <div class="setup-content" id="profile-step">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row div_flat_details_2" id="">
                                                        {{-- Project Dropdown  --}}
                                                        <div class="col-md-2 m-b-4 mb-4" id="project_hide">
                                                            <!-- <button id="openDropdownButton">Add Prop</button> -->
                                                            <select class="form-select" name="project_id"
                                                                data-error="#project_id_error" id="project_id">
                                                                <option value="">Project</option>
                                                                @foreach ($projects as $building)
                                                                    <option data-addr="{{ $building->address }}"
                                                                        data-city="{{ $building->city_id }}"
                                                                        data-area="{{ $building->area_id }}"
                                                                        data-location="{{ $building->location_link }}"
                                                                        value="{{ $building->id }}">
                                                                        {{ $building->project_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div id="project_id_error" style="color: red"></div>
                                                        </div>

                                                        {{-- state city --}}
                                                        @php
                                                            $authStateId = Auth::user()->state_id;
                                                        @endphp
                                                        <div class="form-group col-md-3 m-b-4 mb-3 state-hide">
                                                            <select class="form-select" id="state_id"
                                                                data-error="#state_id_error">
                                                                <option value="">Select States</option>
                                                                @foreach ($states as $state)
                                                                    @if ($state['user_id'] == auth()->user()->id)
                                                                        <option value="{{ $state['id'] }}">
                                                                            {{ $state['name'] }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <div id="state_id_error" style="color: red"></div>
                                                        </div>

                                                        <div class="form-group col-md-3 m-b-4 mb-3">
                                                            <select id="state-dropdown" class="form-control"
                                                                data-error="#city_id_error">
                                                                <option value="">Select City</option>
                                                                @foreach ($cities as $city)
                                                                    <option data-city_id="{{ $city->state_id }}"
                                                                        data-state_id="{{ $city->state_id }}"
                                                                        value="{{ $city->id }}">{{ $city->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div id="city_id_error" style="color: red"></div>
                                                        </div>

                                                        <div class="form-group col-md-3 m-b-4 mb-3 cl-locality">
                                                            <select class="form-select" id="area_id"
                                                                data-error="#locality_id_error">
                                                                <option value="">Select Locality</option>
                                                                @foreach ($areas as $area)
                                                                    <option data-city_id="{{ $area->city_id }}"
                                                                        data-state_id="{{ $area->state_id }}"
                                                                        value="{{ $area->id }}">{{ $area->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div id="locality_id_error" style="color: red"></div>
                                                        </div>

                                                        <div class="col-md-5 m-b-4 mb-3">
                                                            <div>
                                                                <label for="Addresss">Address</label>
                                                                <input class="form-control" type="text" value=""
                                                                    name="address" id="address">
                                                            </div>
                                                            <div class="invalid-feedback" id="address_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div
                                                            class="row col-md-7 div_flat_details_7 mb-3 location_link_cls">
                                                            <div class="form-group col-md-9">
                                                                <label for="Link">Location Link</label>
                                                                <input class="form-control" name="property_link"
                                                                    id="property_link" style="text-transform: lowercase !important;" type="text" autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="property_link_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row div_property_address" id="">
                                                        <div class="form-group col-md-3 mb-3 div_extra_land_details">
                                                            <select class="form-select" id="district_id"
                                                                data-error="#district_id_error">
                                                                <option value=""> District</option>
                                                                @foreach ($districts as $disctrict)
                                                                    <option value="{{ $disctrict->id }}">
                                                                        {{ $disctrict->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="district_id_error" style="color: red"></div>
                                                        </div>
                                                        <div class="form-group col-md-2 mb-3 div_extra_land_details">
                                                            <select class="form-select" id="taluka_id"
                                                                data-error="#taluka_id_error">
                                                                <option value=""> Taluka</option>
                                                                @foreach ($talukas as $taluka)
                                                                    <option data-parent_id="{{ $taluka->district_id }}"
                                                                        value="{{ $taluka->id }}">{{ $taluka->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div id="taluka_id_error" style="color: red"></div>
                                                        </div>
                                                        <div class="form-group col-md-2 m-b-4 mb-3 div_extra_land_details">
                                                            <select class="form-select" id="village_id"
                                                                data-error="#village_id_error">
                                                                <option value=""> Village</option>
                                                                @foreach ($villages as $village)
                                                                    <option data-parent_id="{{ $village->taluka_id }}"
                                                                        value="{{ $village->id }}">{{ $village->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div id="village_id_error" style="color: red"></div>
                                                        </div>

                                                        <div class="form-group col-md-3 m-b-4 mb-3">
                                                            <select class="form-select" id="zone"
                                                                data-error="#zone_id_error">
                                                                <option value="">Zone</option>
                                                                @forelse ($property_configuration_settings as $props)
                                                                    @if ($props['dropdown_for'] == 'property_zone')
                                                                        <option data-parent_id="{{ $props['parent_id'] }}"
                                                                            value="{{ $props['id'] }}">
                                                                            {{ $props['name'] }}
                                                                        </option>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            <div id="zone_id_error" style="color: red"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row div_area_size_details" id="">
                                                        <div>
                                                            <label><b>Area Size</b></label>
                                                        </div>
                                                        <!---------------Terrace Id------------------->
                                                        <div class="col-md-3 the_terrace_area" style="display:none">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <div class="fname">
                                                                        <label for="terrace Area">Terrace Area</label>
                                                                        <div class="fvalue"><input class="form-control"
                                                                                name="terrace_area" id="terrace_area"
                                                                                type="text" autocomplete="off"
                                                                                data-bs-original-title="" title="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!------------------------------------------------>
                                                        <div class="col-md-3 the_salable_plot_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Salable Plot Area">Salable Plot
                                                                        Area</label>
                                                                    <input class="form-control" name="salable_plot_area"
                                                                        id="salable_plot_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="salable_plot_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="invalid-feedback" id="salable_plot_area_error"
                                                                    style="display: block;color:red;"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 the_constructed_salable_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Salable Constructed Area">Salable
                                                                        Constructed Area</label>
                                                                    <input class="form-control"
                                                                        name="constructed_salable_area"
                                                                        id="constructed_salable_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="constructed_salable_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback"
                                                                id="constructed_salable_area_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>


                                                        <div class="col-md-4 the_constructed_builtup_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Constructed Builtup Area">Constructed
                                                                        builtup Area</label>
                                                                    <input class="form-control"
                                                                        name="constructed_builtup_area"
                                                                        id="constructed_builtup_area" type="text"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="constructed_builtup_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 the_centre_height">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Centre Height">Centre Height</label>
                                                                    <input class="form-control"
                                                                        name="storage_centre_height"
                                                                        id="storage_centre_height" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="storage_centre_height_measurement">
                                                                            <option value="ft">
                                                                                ft.
                                                                            </option>
                                                                            <option value="mt">
                                                                                mt.
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="storage_centre_height_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>

                                                        <div class="col-md-4 the_constructed_carpet_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Constructed Carpet Area">Constructed Carpet
                                                                        Area</label>
                                                                    <input class="form-control"
                                                                        name="constructed_carpet_area"
                                                                        id="constructed_carpet_area" type="text"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="constructed_carpet_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 the_carpet_plot_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Carpet Plot Area">Carpet Plot Area</label>
                                                                    <input class="form-control" name="carpet_plot_area"
                                                                        id="carpet_plot_area" type="text"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="carpet_plot_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 the_salable_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Salable Area">Salable Area</label>
                                                                    <input class="form-control" name="salable_area"
                                                                        id="salable_area" type="text"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="salable_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="salable_area_error"
                                                                style="display: none;color:red;">Please enter Salable
                                                                area
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 the_length_of_plot">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Length of plot">Length of plot</label>
                                                                    <input class="form-control" name="length_of_plot"
                                                                        id="length_of_plot" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="length_of_plot_measurement">
                                                                            <option value="ft">
                                                                                ft.
                                                                            </option>
                                                                            <option value="mt">
                                                                                mt.
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="length_of_plot_error"
                                                                style="display: none;color:red;"></div>

                                                        </div>

                                                        <div class="col-md-3 the_width_of_plot">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="width of plot">Width of
                                                                        plot</label>
                                                                    <input class="form-control" name="width_of_plot"
                                                                        id="width_of_plot" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="width_of_plot_measurement">
                                                                            <option value="ft">
                                                                                ft.
                                                                            </option>
                                                                            <option value="mt">
                                                                                mt.
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="width_of_plot_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <!--<div class="col-md-3 the_carpet_area">-->
                                                        <!--    <div class="input-group">-->
                                                        <!--        <div class="form-group col-md-7 m-b-20">-->
                                                        <!--            <label for="Carpet Area">Carpet Area</label>-->
                                                        <!--            <input class="form-control" name="carpet_area"-->
                                                        <!--                id="carpet_area" type="text"-->
                                                        <!--                autocomplete="off">-->
                                                        <!--        </div>-->
                                                        <!--        <div class="input-group-append col-md-5 m-b-20">-->
                                                        <!--            <div class="form-group form_measurement">-->
                                                        <!--                <select-->
                                                        <!--                    class="form-select measure_select measure_square"-->
                                                        <!--                    id="carpet_area_measurement">-->
                                                        <!--                    @foreach ($land_units as $land_unit)
    -->
                                                        <!--                        <option value="{{ $land_unit->id }}"-->
                                                        <!--                            {{ $land_unit->id == 1 ? 'selected' : '' }}>-->
                                                        <!--                            {{ $land_unit->unit_name }}</option>-->
                                                        <!--
    @endforeach-->
                                                        <!--                </select>-->
                                                        <!--            </div>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <div class="col-md-3 the_opening_width">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Entrance Width">Opening Width</label>
                                                                    <input class="form-control" name="entrance_width"
                                                                        id="entrance_width" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="entrance_width_measurement">
                                                                            <option value="ft">
                                                                                ft.
                                                                            </option>
                                                                            <option value="mt">
                                                                                mt.
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="invalid-feedback" id="entrance_width_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 the_ceilling_height">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Ceiling Height">Ceiling Height</label>
                                                                    <input class="form-control" name="ceiling_height"
                                                                        id="ceiling_height" type="text" value="0.00"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="ceiling_height_measurement">
                                                                            <option value="ft">
                                                                                ft.
                                                                            </option>
                                                                            <option value="mt">
                                                                                mt.
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="ceiling_height_error"
                                                                style="display: none;color:red;">Please enter ceiling
                                                                height</div>
                                                        </div>
                                                        <div class="col-md-3 the_carpet_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Carpet Area">Carpet Area</label>
                                                                    <input class="form-control" name="carpet_area"
                                                                        id="carpet_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="carpet_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 the_builtup_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Builtup Area">Builtup Area</label>
                                                                    <input class="form-control" name="builtup_area"
                                                                        id="builtup_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="builtup_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="builtup_area_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>

                                                        <div class="row col-md-2 div_checkboxes1">

                                                            <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20 terrace"
                                                                style="display:none">
                                                                <input class="form-check-input" id="is_terrace"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="is_terrace">Terrace</label>
                                                            </div>
                                                            <div class="invalid-feedback" id="terrace_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>

                                                        <div class="col-md-3 the_plot_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Plot Area">Plot Area</label>
                                                                    <input class="form-control" name="plot_area"
                                                                        id="plot_area" type="text" autocomplete="off">
                                                                </div>
                                                                {{-- <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="plot_area_measurement">
                                                                            @forelse ($property_configuration_settings as $props)
                                                                                @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                                    <option
                                                                                        @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                                        data-parent_id="{{ $props['parent_id'] }}"
                                                                                        value="{{ $props['id'] }}">
                                                                                        {{ $props['name'] }}
                                                                                    </option>
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="plot_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 the_construction_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-8 m-b-20">
                                                                    <label for="Contruction Area">Contruction
                                                                        Area</label>
                                                                    <input class="form-control" name="construction_area"
                                                                        id="construction_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                {{-- <div class="input-group-append col-md-4 m-b-20 ">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select  measure_select"
                                                                            id="construction_area_measurement">
                                                                            @forelse ($property_configuration_settings as $props)
                                                                                @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                                    <option
                                                                                        @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                                        data-parent_id="{{ $props['parent_id'] }}"
                                                                                        value="{{ $props['id'] }}">
                                                                                        {{ $props['name'] }}
                                                                                    </option>
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="construction_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 the_terrace_salable_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Terrace Salable Area">Terrace Salable
                                                                        Area</label>
                                                                    <input class="form-control"
                                                                        name="terrace_salable_area"
                                                                        id="terrace_salable_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="terrace_salable_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback"id="terrace_salable_area_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>

                                                        <div class="col-md-4 the_terrace_carpet_area">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Terrace Carpet Area">Terrace Carpet
                                                                        Area</label>
                                                                    <input class="form-control" name="terrace_carpet_area"
                                                                        id="terrace_carpet_area" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                {{-- <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="terrace_carpet_area_measurement">
                                                                            @forelse ($property_configuration_settings as $props)
                                                                                @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                                    <option
                                                                                        @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                                        data-parent_id="{{ $props['parent_id'] }}"
                                                                                        value="{{ $props['id'] }}">
                                                                                        {{ $props['name'] }}
                                                                                    </option>
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div> --}}
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select
                                                                            class="form-select measure_select measure_square"
                                                                            id="terrace_carpet_area_measurement">
                                                                            @foreach ($land_units as $land_unit)
                                                                                <option value="{{ $land_unit->id }}"
                                                                                    {{ $land_unit->id == 1 ? 'selected' : '' }}>
                                                                                    {{ $land_unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row" id="add_area_button_container">

                                                        </div>



                                                    </div>

                                                    <div class="div_flat_details">

                                                        <div class="row ">
                                                            <div class="col-md-2 mb-3 the_total_units_in_project">
                                                                <div>
                                                                    <label for="Total Floor">Units in project</label>
                                                                    <input class="form-control"
                                                                        name="total_units_in_project"
                                                                        id="total_units_in_project" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback"id="total_units_in_project_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_total_no_of_floor">
                                                                <div>
                                                                    <label for="Property on floor">no. of floor</label>
                                                                    <input class="form-control" name="total_no_of_floor"
                                                                        id="total_no_of_floor" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="total_no_of_floor_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_total_units_in_tower">
                                                                <div>
                                                                    <label for="Total Floor">Units in tower</label>
                                                                    <input class="form-control"
                                                                        name="total_units_in_tower"
                                                                        id="total_units_in_tower" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="total_units_in_tower_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_property_on_floors">
                                                                <div>
                                                                    <label for="Total Floor">Units on Floor</label>
                                                                    <input class="form-control" name="property_on_floors"
                                                                        id="property_on_floors" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="property_on_floors_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_no_of_elavators">
                                                                <div>
                                                                    <label for="No of elavators">No Of Elavators</label>
                                                                    <input class="form-control" name="no_of_elavators"
                                                                        id="no_of_elavators" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="no_of_elavators_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>

                                                            <div class="col-md-2 mb-3 the_no_of_balcony">
                                                                <div>
                                                                    <label for="No of Balcony">No Of Balcony</label>
                                                                    <input class="form-control" name="no_of_balcony"
                                                                        id="no_of_balcony" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="no_of_balcony_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>

                                                            <div class="col-md-2 mb-3 the_total_no_of_units">
                                                                <div>
                                                                    <label for="Total No. of units">Total No. of
                                                                        units</label>
                                                                    <input class="form-control" name="total_no_of_units"
                                                                        id="total_no_of_units" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="total_no_of_units_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_no_of_room">
                                                                <div>
                                                                    <label for="NO. of room">No. of room</label>
                                                                    <input class="form-control" name="no_of_room"
                                                                        id="no_of_room" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="no_of_room_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_no_of_bathrooms">
                                                                <div>
                                                                    <label for="No of bathrooms">No Of Bathrooms</label>
                                                                    <input class="form-control" name="no_of_bathrooms"
                                                                        id="no_of_bathrooms" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="no_of_bathrooms_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>

                                                            <div class="col-md-3 mb-3 the_no_of_floors_allowed">
                                                                <div>
                                                                    <label for="No Of Floors Allowed">No Of Floors
                                                                        Allowed</label>
                                                                    <input class="form-control"
                                                                        name="no_of_floors_allowed"
                                                                        id="no_of_floors_allowed" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback"
                                                                    id="no_of_floors_allowed_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                            <div class="col-md-2 mb-3 the_no_of_side_open">
                                                                <div>
                                                                    <label for="No Of Side Open">No Of Side Open</label>
                                                                    <input class="form-control" name="no_of_side_open"
                                                                        id="no_of_side_open" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="invalid-feedback" id="no_of_side_open_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="row div_checkboxes1">
                                                            <div
                                                                class="form-check checkbox the_service_elavator checkbox-solid-success mb-0 col-md-2">
                                                                <input class="form-check-input" id="service_elavator"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="service_elavator">Service Elavator
                                                                </label>
                                                            </div>

                                                            <div
                                                                class="form-check checkbox the_servent_room checkbox-solid-success mb-0 col-md-2 m-b-20">
                                                                <input class="form-check-input" id="servant_room"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="servant_room">Servant
                                                                    Room</label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-2">
                                                                <input class="form-check-input" id="hot_property"
                                                                    type="checkbox">
                                                                <label class="form-check-label" for="hot_property">Hot
                                                                </label>
                                                            </div>
                                                            {{-- <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20">
                                                                <input class="form-check-input" id="is_favourite"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="is_favourite">Favourite</label>
                                                            </div> --}}
                                                            {{-- <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20 terrace" --}}
                                                            {{-- style="display:none"> --}}
                                                            {{-- <input class="form-check-input" id="terrace_id" --}}
                                                            {{-- type="checkbox"> --}}
                                                            {{-- <label class="form-check-label" --}}
                                                            {{-- for="terrace_id">Terrace</label> --}}
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 div_washroom_type_2" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Washrooms</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="1" id="washoroom2_1"
                                                                        name="washrooms2_type" autocomplete="off"
                                                                        @selected(true)>
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="washoroom2_1">Private Washrooms</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="2" id="washoroom2_2"
                                                                        name="washrooms2_type" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="washoroom2_2">Public Washrooms</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="3" id="washoroom2_3"
                                                                        name="washrooms2_type" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="washoroom2_3">Not-Available</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4 div_road_width" id="">
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Road width front side">Road width of
                                                                        front side</label>
                                                                    <input class="form-control" name="front_road_width"
                                                                        id="front_road_width" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="front_road_width_measurement">
                                                                            <option value="ft">
                                                                                ft.
                                                                            </option>
                                                                            <option value="mt">
                                                                                mt.
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback" id="front_road_width_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>

                                                    </div>

                                                    <div class="row mb-3 div_construction_allowed_for" id="">

                                                        <div class="form-group col-md-3 m-b-4 mb-3">
                                                            <label class="select2_label"
                                                                for="Select Construction allowed for"> Construction
                                                                allowed
                                                                for</label>
                                                            <select class="form-select" id="construction_allowed_for"
                                                                name="construction_allowed_for[]" multiple>
                                                                <option value="residential">Residential </option>
                                                                <option value="commercial">Commercial </option>
                                                                <option value="industrial">Industrial </option>
                                                            </select>
                                                        </div>
                                                        {{-- <div class="form-group col-md-3 m-b-4 mb-3">
                                                            <label class="select2_label"
                                                                for="Select Construction Documents"> Construction
                                                                Documents</label>
                                                            <select class="form-select" id="construction_documents"
                                                                multiple>
                                                                @foreach ($property_const_docs as $document)
                                                                    <option value="{{ $document->id }}">
                                                                        {{ $document->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    </div>

                                                    <div class="row">
                                                        <div class="mb-4 div_construction_documents">
                                                            <label><b>Construction Documents :</b></label>
                                                            <div class="input-group control-group increment">
                                                                <div class="input-group-prepend col-md-3"
                                                                    style="margin-right: 2%">
                                                                    <select class="custom-select"
                                                                        name="const_doc_type[]">
                                                                        <option value=""> Category</option>
                                                                        <option value="1">Building Elevation</option>
                                                                        <option value="2">Common Amenities Photos
                                                                        </option>
                                                                        <option value="3">Master Layout Of Building
                                                                        </option>
                                                                        <option value="4">Brochure</option>
                                                                        <option value="5">Cost Sheet</option>
                                                                        <option value="6">Other</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="file" id="const_documents"
                                                                        name="const_documents[]"
                                                                        class="form-control col-md-4"
                                                                        style="margin-right: 2%">
                                                                </div>
                                                                <div class="input-group-btn" style="margin-left: 2%">
                                                                    <div class="form-group col-md-1">
                                                                        <button class="btn btn-primary add-docs"
                                                                            style="border-radius:5px;" type="button"
                                                                            title="">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clone hide">
                                                                {{-- <div class="control-group input-group"
                                                                    style="margin-top:10px">
                                                                    <div class="input-group-prepend">
                                                                        <select class="custom-select">
                                                                            <option selected>Select Type</option>
                                                                            <option value="1">Type 1</option>
                                                                            <option value="2">Type 2</option>
                                                                            <option value="3">Type 3</option>
                                                                        </select>
                                                                    </div>
                                                                    <input type="file" name="const_documents[]"
                                                                        class="form-control">
                                                                    <div class="input-group-btn">
                                                                        <button
                                                                            class="btn btn-primary btn-air-primary rem-docs"
                                                                            type="button">
                                                                            <i
                                                                                class="glyphicon glyphicon-remove"></i>Remove
                                                                        </button>
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row div_plot_ind_common" id="">
                                                        <div class="form-group col-md-3 mb-3">
                                                            <label for="FSI">FSI/FAR</label>
                                                            <input class="form-control" name="fsi" id="fsi"
                                                                type="text" autocomplete="off">
                                                        </div>
                                                        <div class="invalid-feedback" id="fsi_error"
                                                            style="display: none;color:red;"></div>
                                                    </div>

                                                    <div class="row mb-3 div_borewell" id="">
                                                        <div>
                                                            <label><b>Borewell</b></label>
                                                        </div>
                                                        <div class="form-group col-md-2 pe-0">
                                                            <label for="No. of borewell">No. of borewell</label>
                                                            <input class="form-control" name="no_of_borewell"
                                                                id="no_of_borewell" type="text" autocomplete="off">
                                                        </div>
                                                        <div class="invalid-feedback" id="no_of_borewell_error"
                                                            style="display: none;color:red;"></div>
                                                    </div>

                                                    <div class="row mb-3 div_flat_details_4" id="">
                                                        <div class="form-group col-md-2 pe-0">
                                                            <div>
                                                                <label for="Four Wheeler Parking">Four Wheeler
                                                                    Parking</label>
                                                                <input class="form-control" name="fourwheller_parking"
                                                                    id="fourwheller_parking" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="fourwheller_parking_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-2 pe-0 the_two_wheller_Parking">
                                                            <div>
                                                                <label for="Two Wheeler Parking">Two Wheeler
                                                                    Parking</label>
                                                                <input class="form-control" name="twowheeler_parking"
                                                                    id="twowheeler_parking" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="twowheeler_parking_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row div_flat_details_5" id="">
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success col-md-2 m-b-20">
                                                            <input class="form-check-input" id="is_pre_leased"
                                                                type="checkbox">
                                                            <label class="form-check-label"
                                                                for="is_pre_leased">Pre-leased</label>
                                                        </div>
                                                        <div class="form-group the_pre_leased_remarks col-md-8 m-b-20">
                                                            <div>
                                                                <label for="Pre Leased Remarks">Pre-Leased Remarks</label>
                                                                <input class="form-control" name="pre_leased_remarks"
                                                                    id="pre_leased_remarks" type="text"
                                                                    autocomplete="off">
                                                                <div class="invalid-feedback"
                                                                    id="pre_leased_remarks_error"
                                                                    style="display: none;color:red;"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row div_property_source" id="">
                                                        <div class="form-group col-md-2 mb-3">
                                                            <select class="form-select" id="Property_priority">
                                                                <option value="">Priority</option>
                                                                @forelse ($property_configuration_settings as $props)
                                                                    @if ($props['dropdown_for'] == 'property_priority_type')
                                                                        <option
                                                                            data-parent_id="{{ $props['parent_id'] }}"
                                                                            value="{{ $props['id'] }}">
                                                                            {{ $props['name'] }}
                                                                        </option>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            <div class="invalid-feedback" id="Property_priority_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3 m-b-4 mb-3">
                                                            <select class="form-select" id="property_source">
                                                                <option value="">Source</option>
                                                                @forelse ($property_configuration_settings as $props)
                                                                    @if ($props['dropdown_for'] == 'property_source')
                                                                        <option
                                                                            data-parent_id="{{ $props['parent_id'] }}"
                                                                            value="{{ $props['id'] }}"
                                                                            data-val="{{ $props['name'] }}">
                                                                            {{ $props['name'] }}
                                                                        </option>
                                                                        </option>
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            <div class="invalid-feedback" id="property_source_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-5 m-b-20 the_source_refrence mb-3">
                                                            <label for="Refrence">Refrence</label>
                                                            <input class="form-control" name="refrence" id="refrence"
                                                                type="text" autocomplete="off">
                                                            <div class="invalid-feedback" id="refrence_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                    </div>


                                                    <div class="row mb-3 div_availability_status" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Availability Status</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="1" id="availability1"
                                                                        name="availability_status" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="availability1">Available</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="0" id="availability0"
                                                                        name="availability_status" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="availability0">Under construction</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 div_age_of_property" id="">
                                                        <div class="col-md-12 mb-3">
                                                            <div>
                                                                <label><b>Age of property</b></label>
                                                            </div>
                                                            <div class="m-checkbox-inline custom-radio-ml">
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="1" id="age_of_property1"
                                                                        name="propertyage" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="age_of_property1">0-1 years</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="2" id="age_of_property2"
                                                                        name="propertyage" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="age_of_property2">1-5 years</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="3" id="age_of_property3"
                                                                        name="propertyage" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="age_of_property3">5-10 years</label>
                                                                </div>
                                                                <div class="btn-group bromi-checkbox-btn me-1"
                                                                    role="group"
                                                                    aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                        value="4" id="age_of_property4"
                                                                        name="propertyage" autocomplete="off">
                                                                    <label
                                                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                        for="age_of_property4">10+ years</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row div_available_from mb-3" id="">
                                                        <div class="col-md-3">
                                                            <label>Available From</label>
                                                            <input class="form-control" id="available_from"
                                                                name="available_from" type="text"
                                                                autocomplete="off">
                                                            <div class="invalid-feedback" id="available_from_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row " id="">
                                                        <div
                                                            class=" div_amenities form-check checkbox  checkbox-solid-success col-md-2 m-b-20">
                                                            <input class="form-check-input" id="is_amenities"
                                                                type="checkbox">
                                                            <label class="form-check-label"
                                                                for="is_amenities">Amenities</label>
                                                        </div>
                                                        <div class="row div_amenities_checks">
                                                            <div>
                                                                <label><b>Amenities</b></label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_pool" name="property_amenities"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_pool">Swimming
                                                                    Pool</label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_club_house" name="property_amenities"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_club_house">Club
                                                                    house</label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_passenger_lift"
                                                                    name="property_amenities" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_passenger_lift">Garden</label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_garden" name="property_amenities"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_garden">Children Play
                                                                    Area</label>
                                                            </div>
                                                            {{-- <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_service_lift" name="property_amenities"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_service_lift">Service Lift</label>
                                                            </div> --}}
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_streature_lift"
                                                                    name="property_amenities" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_streature_lift">Streature Lift</label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_ac" name="property_amenities"
                                                                    type="checkbox">
                                                                <label class="form-check-label" for="amenity_ac">Central
                                                                    AC</label>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="project_amenity form-check-input"
                                                                    id="amenity_gym" name="property_amenities"
                                                                    type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="amenity_gym">Gym</label>
                                                            </div>
                                                            @foreach ($amenities as $key => $value)
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input class="project_amenity form-check-input"
                                                                        id="amenity_{{ $value['name'] }}"
                                                                        name="property_amenities" type="checkbox">
                                                                    <label class="form-check-label"
                                                                        for="amenity_{{ $value['name'] }}">{{ $value['name'] }}</label>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                    <div class="row div_other_details" id="">

                                                        <label><b>Other Details</b></label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Field Name</label>
                                                                <input class="form-control" id="New_industrial_field"
                                                                    name="New_industrial_field" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="col-md-2"><button
                                                                    class="btn mb-3 btn-primary btn-air-primary"
                                                                    type="button" id="add_industrial_detail">Add
                                                                    Field</button>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="idustrial_fields_container">
                                                            <div
                                                                class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="pollution_control_board" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="pollution_control_board">Pollution Control
                                                                    Board</label>
                                                            </div>

                                                            <div class="form-group mb-3 col-md-9 m-b-20">
                                                                <label>Pollution Control Board</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="pollution_control_board_remarks"
                                                                    id="pollution_control_board_remarks" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div
                                                                class="form-check checkbox mb-3  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="ec_noc" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="ec_noc">EC/NOC</label>
                                                            </div>

                                                            <div class="form-group mb-3 col-md-9 m-b-20">
                                                                <label>EC/NOC</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="ec_noc_remark" id="ec_noc_remark"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            {{-- <div
                                                                class="form-check mb-3 checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="bail" type="checkbox">
                                                                <label class="form-check-label" for="bail">Bail
                                                                    Membership</label>
                                                            </div> --}}

                                                            {{-- <div class="form-group mb-3 col-md-9 m-b-20">
                                                                <label>Bail Membership</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="bail_remark" id="bail_remark" type="text"
                                                                    autocomplete="off">
                                                            </div> --}}
                                                            {{-- <div
                                                                class="form-check checkbox  mb-3 checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="discharge" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="discharge">Discharge</label>
                                                            </div> --}}

                                                            {{-- <div class="form-group mb-3 col-md-9 m-b-20">
                                                                <label>Discharge</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="discharge_remark" id="discharge_remark"
                                                                    type="text" autocomplete="off">
                                                            </div> --}}

                                                            <div
                                                                class="form-check checkbox mb-3  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="gujrat_gas" type="checkbox">
                                                                <label class="form-check-label" for="gujrat_gas">
                                                                    Gas</label>
                                                            </div>
                                                            <div class="form-group mb-3 col-md-9 m-b-20">
                                                                <label> Gas</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="gujrat_gas_remark" id="gujrat_gas_remark"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            <div
                                                                class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="power" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="power">Power</label>
                                                            </div>

                                                            <div class="form-group col-md-9 mb-3">
                                                                <label>Power</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="power_remark" id="power_remark"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            <div
                                                                class="form-check checkbox mb-3  checkbox-solid-success mb-0 col-md-3 pe-0">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="water" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="water">Water</label>
                                                            </div>
                                                            <div class="form-group col-md-9 mb-3">
                                                                <label>Water</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="water_remark" id="water_remark"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            {{-- <div
                                                                class="form-check checkbox  mb-3 checkbox-solid-success mb-0 col-md-3 pe-0">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="machinery" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="machinery">Machinery</label>
                                                            </div> --}}
                                                            {{-- <div class="form-group col-md-9 mb-3">
                                                                <label>Machinery</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="machinery_remark" id="machinery_remark"
                                                                    type="text" autocomplete="off">
                                                            </div> --}}
                                                            {{-- <div
                                                                class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0">
                                                                <input class="form-check-input extra_industrial_field"
                                                                    id="etl_necpt" type="checkbox">
                                                                <label class="form-check-label"
                                                                    for="etl_necpt">ETL/CEPT/ NLTL</label>
                                                            </div> --}}
                                                            {{-- <div class="form-group col-md-9 mb-3 m-b-20">
                                                                <label>ETL/CEPT/NLTL</label>
                                                                <input class="form-control extra_industrial_field_remark"
                                                                    name="etl_necpt_remark" id="etl_necpt_remark"
                                                                    type="text" autocomplete="off">
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 div_extra_retail_details" id="">
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20">
                                                            <input class="form-check-input" id="two_road_corner"
                                                                type="checkbox">
                                                            <label class="form-check-label" for="two_road_corner">Two
                                                                Road
                                                                Corner</label>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md- mb-3">
                                                            <label for="remarks">Remarks</label>
                                                            <input class="form-control" name="remarks" id="remarks"
                                                                type="text" autocomplete="off">
                                                        </div>
                                                        <div class="invalid-feedback" id="remarks_error"
                                                            style="display: none;color:red;"></div>
                                                    </div>
                                                    <button class="btn btn-primary previousBtn1" type="button"
                                                        style="border-radius: 5px;">Previous</button>
                                                    <button class="btn btn-primary ms-3 nextBtn submitClick"
                                                        style="border-radius: 5px;" id="nextButtonSecond"
                                                        type="button">Next</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="setup-content" id="unit-owner-step">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="div_flat_details_7">
                                                        <label><b>Unit Details</b></label>
                                                    </div>
                                                    <div class="row div_flat_details_7">

                                                        <div class="row" id="all_units">

                                                        </div>
                                                    </div>

                                                    <div class="row div_survey_details" id="">
                                                        <label><b>Survey Details</b></label>
                                                        <div class="form-group col-md-3 m-b-20">
                                                            <label for="Survey Number">Survey Number</label>
                                                            <input class="form-control" name="survey_number"
                                                                id="survey_number" type="text" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-4 m-b-20">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-8 m-b-20 top1x">
                                                                    <label for="Plot Size">Plot Size</label>
                                                                    <input class="form-control" name="plot_size"
                                                                        id="plot_size" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-4 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="survey_plot_measurement">
                                                                            @forelse ($property_configuration_settings as $props)
                                                                                @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                                    <option
                                                                                        @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                                        data-parent_id="{{ $props['parent_id'] }}"
                                                                                        value="{{ $props['id'] }}">
                                                                                        {{ $props['name'] }}
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
                                                            <input class="form-control indian_currency_amount"
                                                                name="price" id="price" type="text"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>

                                                    {{-- bharat tp --}}
                                                    <div class="row div_tp_details" id="">
                                                        <label><b>TP Details</b></label>
                                                        <div class="form-group col-md-3 m-b-20">
                                                            <label for="TP Number">TP Number</label>
                                                            <input class="form-control" name="tp_number"
                                                                id="tp_number" type="text" autocomplete="off">
                                                        </div>
                                                        <div class="form-group col-md-3 m-b-20">
                                                            <label for="FP Number">FP Number</label>
                                                            <input class="form-control" name="fp_number"
                                                                id="fp_number" type="text" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-3 m-b-20">
                                                            <div class="input-group">
                                                                <div class="form-group col-md-7 m-b-20">
                                                                    <label for="Plot Size">Plot Size</label>
                                                                    <input class="form-control" name="plot2_size"
                                                                        id="plot2_size" type="text"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="input-group-append col-md-5 m-b-20">
                                                                    <div class="form-group form_measurement">
                                                                        <select class="form-select measure_select"
                                                                            id="plot2_measurement">
                                                                            @forelse ($property_configuration_settings as $props)
                                                                                @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                                    <option
                                                                                        @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                                                        data-parent_id="{{ $props['parent_id'] }}"
                                                                                        value="{{ $props['id'] }}">
                                                                                        {{ $props['name'] }}
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
                                                            <input class="form-control indian_currency_amount"
                                                                name="price2" id="price2" type="text"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-12"> --}}
                                                    <div class="row div_flat_details_8">
                                                        <div>
                                                            <label><b>Owner Information</b></label>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <div>
                                                                <select class="form-select" id="owner_is">
                                                                    <option value="">Owner </option>
                                                                    @forelse ($property_configuration_settings as $props)
                                                                        @if ($props['dropdown_for'] == 'property_owner_type')
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
                                                            <div class="invalid-feedback" id="owner_is_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <div>
                                                                <label for="Owner Name">Name</label>
                                                                <input class="form-control" name="owner_info_name"
                                                                    id="owner_info_name" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback" id="owner_info_name_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <div>
                                                                <label for="Owner Contact Specific No">Contact</label>
                                                                <input class="form-control"
                                                                    name="owner_contact_specific_no"
                                                                    id="owner_contact_specific_no" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="invalid-feedback"
                                                                id="owner_contact_specific_no_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <div>
                                                                <label for="Email">Email</label>
                                                                <input class="form-control" name="property_email"
                                                                    id="property_email" type="text"
                                                                    autocomplete="off"
                                                                    style="text-transform: lowercase;">
                                                            </div>
                                                            <div class="invalid-feedback" id="property_email_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>

                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-1 m-b-20">
                                                            <input class="form-check-input" id="is_nri"
                                                                type="checkbox">
                                                            <label class="form-check-label" for="is_nri">NRI</label>
                                                        </div>

                                                        <div>
                                                            <label><b>Other Contact Details</b></label>
                                                        </div>


                                                        <div class="row" id="all_owner_contacts">

                                                        </div>

                                                        {{--  <div class="div_care_taker">
                                                                <label><b>Care Taker Information</b></label>
                                                            </div>

                                                            <div class="form-group div_care_taker col-md-4 m-b-20">
                                                                <label for="Care Take Name">Care Taker Name</label>
                                                                <input class="form-control" name="care_take_name"
                                                                    id="care_take_name" type="text"
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="form-group div_care_taker col-md-4 m-b-20">
                                                                <label for="Care Take Contact No">Care Taker Contact
                                                                    No</label>
                                                                <input class="form-control" name="care_take_contact_no"
                                                                    id="care_take_contact_no" type="text"
                                                                    autocomplete="off">
                                                            </div> --}}
                                                        {{-- <div class="form-group div_care_taker col-md-3 m-b-4">
                                                                <select class="form-select" id="key_arrangement">
                                                                    <option value="">Key Available At</option>
                                                                    <option value="Office"
                                                                        {{ $edit_property[0] == 'Office' ? 'selected' : '' }}>
                                                                        Office</option>
                                                                    <option value="Owner"
                                                                        {{ $edit_property[0] == 'Owner' ? 'selected' : '' }}>
                                                                        Owner</option>
                                                                    <option value="cotact_1"
                                                                        {{ $edit_property[0] == 'cotact_1' ? 'selected' : '' }}>
                                                                        Other contact 1</option>
                                                                    <option value="cotact_2"
                                                                        {{ $edit_property[0] == 'cotact_2' ? 'selected' : '' }}>
                                                                        Other contact 2</option>
                                                                    <option value="cotact_3"
                                                                        {{ $edit_property[0] == 'cotact_3' ? 'selected' : '' }}>
                                                                        Other contact 3</option>
                                                                </select>
                                                            </div> --}}

                                                        <div class="form-group div_care_taker col-md-3 m-b-4">
                                                            <select class="form-select" id="key_arrangement">
                                                                <option value="">Key Available At</option>
                                                                <option value="Office"> Office </option>
                                                                <option value="Owner"> Owner </option>
                                                            </select>
                                                            <div class="invalid-feedback" id="key_arrangement_error"
                                                                style="display: none;color:red;"></div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                    <div class="row">
                                                        <div class="row mb-3 " id="retail_furnished_template"
                                                            style="display:none">
                                                            <div class="row mb-3 div_retail_furnished">
                                                                <div class="col-md-5">
                                                                    <label for="Remarks">Remarks</label>
                                                                    <input class="form-control furnished_type_item"
                                                                        name="retail_furnished_remarks"
                                                                        id="retail_furnished_remarks" type="text"
                                                                        autocomplete="off" style="display: none">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3 " id="office_furnished_template"
                                                            style="display: none">
                                                            <div class="row mb-3 div_office_furnished">

                                                                <div class="col-md-2">
                                                                    <label for="No of seats">No. of seats</label>
                                                                    <input class="form-control furnished_type_item"
                                                                        name="no_of_seats" id="no_of_seats"
                                                                        type="text" autocomplete="off">
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <label for=" No of cabins "> No. of
                                                                        cabins</label>
                                                                    <input class="form-control furnished_type_item"
                                                                        name="no_of_cabins" id="no_of_cabins"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for=" No of conference room"> No. of conference
                                                                        room</label>
                                                                    <input class="form-control furnished_type_item"
                                                                        name="no_of_conference_room"
                                                                        id="no_of_conference_room" type="text"
                                                                        autocomplete="off">
                                                                </div>

                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-2">
                                                                    <input class="form-check-input furnished_type2_item"
                                                                        id="office_pantry" type="checkbox">
                                                                    <label class="form-check-label"
                                                                        for="office_pantry">Pantry
                                                                    </label>
                                                                </div>

                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-2">
                                                                    <input class="form-check-input furnished_type2_item"
                                                                        id="office_reception" type="checkbox">
                                                                    <label class="form-check-label"
                                                                        for="office_reception">Reception
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row mb-3 div_conference_room" id="">
                                                            <div class="col-md-12 mb-3">
                                                                <div>
                                                                    <label><b>Conference Room</b></label>
                                                                </div>
                                                                <div class="m-checkbox-inline custom-radio-ml">
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="1" id="conference1"
                                                                            name="conference_available"
                                                                            autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="conference1">Available</label>
                                                                    </div>
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="0" id="conference0"
                                                                            name="conference_available"
                                                                            autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="conference0">Not-Available</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3 div_reception_area" id="">
                                                            <div class="col-md-12 mb-3">
                                                                <div>
                                                                    <label><b>Reception Area</b></label>
                                                                </div>
                                                                <div class="m-checkbox-inline custom-radio-ml">
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="1" id="reception1"
                                                                            name="reception_available"
                                                                            autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="reception1">Available</label>
                                                                    </div>
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="0" id="reception0"
                                                                            name="reception_available"
                                                                            autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="reception0">Not-Available</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3 div_pantry_type" id="">
                                                            <div class="col-md-12 mb-3">
                                                                <div>
                                                                    <label><b>Pantry Type</b></label>
                                                                </div>
                                                                <div class="m-checkbox-inline custom-radio-ml">
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="1" id="pantry1"
                                                                            name="pantry_available" autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="pantry1">Available</label>
                                                                    </div>
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="2" id="pantry2"
                                                                            name="pantry_available" autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="pantry2">Shared</label>
                                                                    </div>
                                                                    <div class="btn-group bromi-checkbox-btn me-1"
                                                                        role="group"
                                                                        aria-label="Basic radio toggle button group">
                                                                        <input type="radio" class="btn-check"
                                                                            value="0" id="pantry0"
                                                                            name="pantry_available" autocomplete="off">
                                                                        <label
                                                                            class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                                            for="pantry0">Not-Available</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="furnished_types_template" style="display: none">
                                                            <div class="row div_furnished_items">
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class="furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_light_count"
                                                                                type="text" value="0">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">Light</span>
                                                                </div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class="furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_fans_count"
                                                                                type="text" value="0">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">Fans</span>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class="furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_ac_count" type="text"
                                                                                value="0">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">AC</span>
                                                                </div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class=" furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_tv_count" type="text"
                                                                                value="0">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">TV</span>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class=" furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_beds_count"
                                                                                type="text" value="0">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">Beds</span>
                                                                </div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class=" furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_wardobe_count"
                                                                                type="text" value="0">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">Wardobe</span>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class=" furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_geyser_count"
                                                                                type="text" value="0">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">Geyser</span>
                                                                </div>
                                                                <div class="col-md-2 mb-3 pe-0">
                                                                    <div class="cust-touch-pin">
                                                                        <div class="input-group">
                                                                            <input
                                                                                class=" furnished_type_item touchspin25 border-0 text-center ms-0"
                                                                                name="property_sofa_count"
                                                                                type="text" value="0">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3 mb-3 align-self-center">
                                                                    <span class="align-middle">Sofa</span>
                                                                </div>
                                                            </div>
                                                            <div class="row div_furnished_items_2" id="">
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_washing" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_washing">Washing Machine</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_stove" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_stove">Stove</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_fridge" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_fridge">Fridge</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_water" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_water">Water
                                                                        Purifier</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_micro" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_micro">Microwave</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_kitchen" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_kitchen">Modular Kitchen</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_chimney" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_chimney">Chimney</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_dinning" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_dinning">Dinning Table</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_curtains" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_curtains">Curtains</label>
                                                                </div>
                                                                <div
                                                                    class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                    <input
                                                                        class="furnished_type2_item form-check-input remained"
                                                                        id="amenity_exhaust" type="checkbox">
                                                                    <label class="form-check-label remained"
                                                                        for="amenity_exhaust">Exhaust Fan</label>
                                                                </div>
                                                            </div>
                                                            <hr id="hr_furnished">
                                                        </div>
                                                    </div>
                                                    {{-- Image Document Upload --}}
                                                    <div class="row col md-12 mt-2 mb-4">
                                                        <div class="col md-6">
                                                            <div class="row div_document_section" id="">
                                                                <label><b>Images :</b></label>
                                                                <div id="uploadImageBox" class="row">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="file"
                                                                            id="land_images" name="land_images"
                                                                            accept=".jpg,.png" multiple>
                                                                    </div>
                                                                    <span style="color: red;"
                                                                        id="property_image"></span>
                                                                    {{-- <div class="form-group col-md-3 m-b-4 mb-3"><button
                                                                        type="button"
                                                                        class="btn mb-2 btn-primary btn-air-primary submitFnl"
                                                                        id="add_images">Upload</button></div> --}}
                                                                </div>
                                                                {{-- <div class="row" id="all_images"
                                                                style="max-height: 300px;overflow-y: auto;">
                                                            </div> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col md-6">
                                                            <div class="row div_document_section" id="">
                                                                <label><b>Documents :</b></label>
                                                                <div id="uploadImageBox" class="row">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="file"
                                                                            id="land_document" name="land_document"
                                                                            accept=".jpg,.png" multiple>
                                                                    </div>
                                                                    <span style="color: red;"
                                                                        id="property_image"></span>
                                                                    {{-- <div class="form-group col-md-3 m-b-4 mb-3"><button
                                                                            type="button"
                                                                            class="btn mb-2 btn-primary btn-air-primary submitFnl"
                                                                            id="add_images">Upload</button></div> --}}
                                                                </div>
                                                                {{-- <div class="row" id="all_document"
                                                                    style="max-height: 300px;overflow-y: auto;">
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary previousBtn2"
                                                        style="border-radius: 5px;" type="button">Previous</button>
                                                    <button id="saveProperty"
                                                        class="btn btn-primary ms-3 nextBtn submitFnl" id="submitFnl"
                                                        type="button" style="border-radius: 5px;">Finish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $dist_encoded = json_encode($districts);
            $tal_encoded = json_encode($talukas);
            $vil_encoded = json_encode($villages);

            $state_encoded = json_encode($states);
            $city_encoded = json_encode($cities);
            $area_encoded = json_encode($areas);

        @endphp
    @endsection
    @push('scripts')
        <script src="{{ asset('admins/assets/js/form-wizard/property_wizard.js') }}"></script>
        <script>
            // Hide State dropdown

            //#B 5+BHK then add txtbox
            $('input[name="flat_type"][value="19"]').change(function() {
                if ($(this).is(':checked')) {
                    $('#textboxWrapper').show();
                } else {
                    $('#textboxWrapper').hide();
                }
            });
            $('input[name="vila_type"][value="19"]').change(function() {
                if ($(this).is(':checked')) {
                    $('#textboxWrapperVilla').show();
                } else {
                    $('#textboxWrapperVilla').hide();
                }
            });


            let isValid = true;
            let penthouseConf, farmConf, landConfiguration, plotConf, VillaCategory, landCategory, villaConfiguration,
                flateConfiguration, officeConf, retailConfiguration, storageConfiguration, theForLand;
            $(document).ready(function() {
                // Initialize Select2 for all dropdowns
                $('#project_id, #state_id, #area_id, #zone, #village_id, #taluka_id, #district_id, #state-dropdown')
                    .select2();

                // Function to validate dropdown
                function validateDropdown(dropdown, errorDiv, errorMessage) {
                    var selectedData = dropdown.select2('data');
                    // console.log("Selected Data:", selectedData); 
                    if (!selectedData || !selectedData.length || !selectedData[0].id) {
                        errorDiv.text(errorMessage).show();
                        return false;
                    } else {
                        errorDiv.hide();
                        return true;
                    }
                }

                function validateField(inputSelector, errorSelector, errorMessage) {
                    isValid = $(inputSelector).val().trim() !== '';
                    $(inputSelector).toggleClass('is-invalid', !isValid);
                    $(errorSelector).toggle(!isValid).text(errorMessage);
                    return isValid;
                }

                //office_type
                $(document).on('change', 'input[name=office_type]', function() {
                    office_type_val = $(this).attr('data-val');
                    console.log("office_type ==", office_type_val);
                    if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                        officeConf = $('input[name=office_type]:checked')
                            .val(); // Assign value to global configuration variable
                        console.log("officeConf ==", officeConf);
                    }
                });

                // Retail retail_type
                $(document).on('change', 'input[name=retail_type]', function() {
                    storage_type_val = $(this).attr('data-val');
                    console.log("storage_type ==", storage_type_val);
                    if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                        retailConfiguration = $('input[name=retail_type]:checked')
                            .val(); // Assign value to global configuration variable
                        console.log("retailConfiguration ==", retailConfiguration);
                    }
                });

                // storage/ind.
                $(document).on('change', 'input[name=storage_type]', function() {
                    storage_type_val = $(this).attr('data-val');
                    console.log("storage_type ==", storage_type_val);
                    if ($('input[name=property_category]:checked').attr('data-val') == 'Storage/industrial') {
                        storageConfiguration = $('input[name=storage_type]:checked')
                            .val(); // Assign value to global configuration variable
                        console.log("storageConfigurationConfff ==", storageConfiguration);
                    }
                });

                //strg cat
                $(document).on('change', '[name="property_category"]', function(e) {
                    storageCategory = $(this).attr('data-val') === 'Storage/industrial'
                    console.log("storageCategory ==", storageCategory);
                });

                // Land.
                $(document).on('change', 'input[name=plot_type]', function() {
                    plot_type_val = $(this).attr('data-val');
                    console.log("plot_type ==", plot_type_val);
                    if ($('input[name=property_category]:checked').attr('data-val') == 'Land') {
                        landConfiguration = $('input[name=plot_type]:checked').val();
                        console.log("landConfiguration ==", landConfiguration);


                    }
                });

                //land cat
                $(document).on('change', '[name="property_category"]', function(e) {
                    landCategory = $(this).attr('data-val') === 'Land'
                    console.log("landCategory ==", landCategory);
                });

                // Flate and Penthouse
                $(document).on('change', 'input[name=flat_type]', function() {
                    let flat_type_val = $(this).attr('data-val');
                    console.log("flat_type ==", flat_type_val);
                    if ($('input[name=property_category]:checked').attr('data-val') === 'Flat' || $(
                            'input[name=property_category]:checked').attr('data-val') === 'Penthouse') {
                        flateConfiguration = $('input[name=flat_type]:checked').val();
                        console.log("flateConfiguration ==", flateConfiguration);
                    }
                });

                // Villa
                $(document).on('change', 'input[name=vila_type]', function() {
                    vila_type_val = $(this).attr('data-val');
                    console.log("vila_type ==", vila_type_val);
                    if ($('input[name=property_category]:checked').attr('data-val') === 'Vila/Bunglow') {
                        villaConfiguration = $('input[name=vila_type]:checked').val();
                        console.log("villaConfiguration ==", villaConfiguration);
                    }
                });

                //villa cat
                $(document).on('change', '[name="property_category"]', function(e) {
                    VillaCategory = $(this).attr('data-val') === 'Vila/Bunglow'
                    console.log("VillaCategory ==", VillaCategory);
                });

                //Penthouse cat
                $(document).on('change', '[name="property_category"]', function(e) {
                    penthouseConf = $(this).attr('data-val') === 'Penthouse'
                    console.log("penthouseConf ==", penthouseConf);
                });

                //farmhouse
                $(document).on('change', '[name="property_category"]', function(e) {
                    farmConf = $(this).attr('data-val') === 'Farmhouse'
                    console.log("farmConf ==", farmConf);
                });

                //Plot
                $(document).on('change', '[name="property_category"]', function(e) {
                    plotConf = $(this).attr('data-val') === 'Plot'
                    console.log("plotConf ==", plotConf);
                });

                function validateForm() {
                    isValid = true;

                    if (flateConfiguration || plotConf || officeConf || retailConfiguration) {
                        console.log("enter in salable area ==");
                        isValid = validateField('#salable_area', '#salable_area_error',
                                'Salable Area filed is required') &&
                            isValid;
                    }
                    if (VillaCategory || farmConf) {
                        console.log("enter in const salable ==");
                        isValid = validateField('#constructed_salable_area', '#constructed_salable_area_error',
                            'constructed salable area field is required') && isValid;
                        isValid = validateField('#salable_plot_area', '#salable_plot_area_error',
                            'Salable plot area field is required') && isValid;
                    }
                    // if (officeConf || flateConfiguration) {
                    //     isValid = validateField('#property_on_floors', '#property_on_floors_error',
                    //         'units floor field is required') && isValid;
                    // }
                    // if (flateConfiguration) {
                    //     // isValid = validateField('#builtup_area', '#builtup_area_error',
                    //     //     'Built up area field is required') && isValid;
                    //     isValid = validateField('#no_of_bathrooms', '#no_of_bathrooms_error',
                    //         'no of bathroom field is required') && isValid;
                    // }
                    // if (retailConfiguration) {
                    //     isValid = validateField('#entrance_width', '#entrance_width_error',
                    //         'entrance width field is required') && isValid;
                    // }

                    // if (storageConfiguration == '7' || storageConfiguration == '8' || storageConfiguration == '9') {
                    //     isValid = validateField('#constructed_salable_area', '#constructed_salable_area_error',
                    //         'constructed salable area field is required') && isValid;
                    // }
                    // if (villaConfiguration || farmConf) {
                    //     isValid = validateField('#no_of_balcony', '#no_of_balcony_error',
                    //         'no of balcony field is required') && isValid;
                    //     isValid = validateField('#total_no_of_units', '#total_no_of_units_error',
                    //         'units field is required') && isValid;
                    //     isValid = validateField('#no_of_side_open', '#no_of_side_open_error',
                    //         'no of side open field is required') && isValid;
                    //     isValid = validateField('#no_of_bathrooms', '#no_of_bathrooms_error',
                    //         'no of bathroom field is required') && isValid;
                    // }
                    // if (farmConf) {
                    //     isValid = validateField('#no_of_room', '#no_of_room_error',
                    //         'rooms field is required') && isValid;
                    // }
                    // if (landConfiguration) {
                    //     // console.log("valid land prop");
                    //     // isValid = validateField('#length_of_plot', '#length_of_plot_error',
                    //     //     'length of plot field is required') && isValid;
                    //     //     Valid = validateField('#width_of_plot', '#width_of_plot_error',
                    //     //     'length of plot field is required') && isValid;

                    // }
                    if (storageConfiguration) {
                        console.log("enter in storage center ==");
                        // isValid = validateField('#salable_plot_area', '#salable_plot_area_error',
                        //     'Salable plot area field is required') && isValid;
                        isValid = validateField('#storage_centre_height', '#storage_centre_height_error',
                            'center height field is required') && isValid;
                        // isValid = validateField('#front_road_width', '#front_road_width_error',
                        //     'front road side field is required') && isValid;
                        // isValid = validateField('#total_units_in_project', '#total_units_in_project_error',
                        //     'total units field is required') && isValid;
                        // isValid = validateField('#twowheeler_parking', '#twowheeler_parking_error',
                        //     'two wheel parking field is required') && isValid;
                    }
                    // if (flateConfiguration || officeConf || retailConfiguration) {
                    //     isValid = validateField('#ceiling_height', '#ceiling_height_error',
                    //         'ceiling height field is required') && isValid;
                    //     // isValid = validateField('#total_units_in_project', '#total_units_in_project_error',
                    //     //     'total units field is required') && isValid;
                    //     // isValid = validateField('#total_no_of_floor', '#total_no_of_floor_error',
                    //     //     'no of floor field is required') && isValid;
                    //     // isValid = validateField('#total_units_in_tower', '#total_units_in_tower_error',
                    //     //     'unit tower field is required') && isValid;
                    //     // isValid = validateField('#no_of_elavators', '#no_of_elavators_error',
                    //     //     'elavators field is required') && isValid;
                    //     // isValid = validateField('#twowheeler_parking', '#twowheeler_parking_error',
                    //     //     'two wheel parking field is required') && isValid;
                    // }
                    // if (penthouseConf) {
                    //     isValid = validateField('#no_of_balcony', '#no_of_balcony_error',
                    //         'no of balcony field is required') && isValid;
                    //     isValid = validateField('#terrace_salable_area', '#terrace_salable_area_error',
                    //         'terrace salable area field is required') && isValid;
                    // }
                    // isValid = validateField('#property_link', '#property_link_error',
                    //     'Location Link field is required') && isValid;
                    isValid = validateField('#address', '#address_error',
                        'address field is required') && isValid;
                    // isValid = validateField('#fourwheller_parking', '#fourwheller_parking_error',
                    //     'four wheel parking field is required') && isValid;
                    // isValid = validateField('#remarks', '#remarks_error',
                    //     'remarks field is required') && isValid;
                    return isValid;
                }

                // Update theForLand when plot_type is clicked
                $(document).on('change', 'input[name=plot_type]', function() {
                    theForLand = $(this).attr('data-val');
                    console.log("theForLand select dropdown val ==", theForLand);

                    if (theForLand === 'agriculture') {
                        console.log("location show ==")
                        $(".location_link_cls").show();
                    } else {
                        console.log("location hide ==")
                        $(".location_link_cls").hide();
                    }
                });

                // Validation on 2ndstep submit
                const stateLength = $('#state_id').find('option').length;
                $('#nextButtonSecond').click(function() {
                    $('input[name=plot_type]:checked').trigger('change');
                    // var isValid = true;
                    var isValid = validateForm();
                    if (stateLength > 2) {
                        console.log("enter in state ==");
                        isValid = validateDropdown($('#state_id'), $('#state_id_error'),
                            'State field is required.') && isValid;
                    }
                    if (!landCategory) {
                        console.log("enter in project ==");
                        isValid = validateDropdown($('#project_id'), $('#project_id_error'),
                            'project field is required.') && isValid;
                    }

                    isValid = validateDropdown($('#state-dropdown'), $('#city_id_error'),
                        'City field is required.') && isValid;
                    isValid = validateDropdown($('#area_id'), $('#locality_id_error'),
                        'Locality field is required.') && isValid;
                    // isValid = validateDropdown($('#property_source'), $('#property_source_error'),
                    //     'property source field is required.') && isValid;
                    // isValid = validateDropdown($('#Property_priority'), $('#Property_priority_error'),
                    //     'property priority field is required.') && isValid;

                    if (theForLand === 'commercial' || theForLand === 'agriculture' || farmConf) {
                        console.log("enter in zone-vlg-taluka-dist ==");
                        isValid = validateDropdown($('#zone'), $('#zone_id_error'),
                            'Zone field is required') && isValid;
                        isValid = validateDropdown($('#village_id'), $('#village_id_error'),
                            'Village field is required') && isValid;
                        isValid = validateDropdown($('#taluka_id'), $('#taluka_id_error'),
                            'Taluka field is required') && isValid;
                        isValid = validateDropdown($('#district_id'), $('#district_id_error'),
                            'District field is required') && isValid;
                    }

                    if (isValid) {
                        console.log("isvalid error true ==", isValid);
                        $("#unit-owner-step").show();
                    } else {
                        console.log("isvalid false done ==", isValid);
                        $("#profile-step").show();
                        $("#step1").addClass("btn-primary");
                        $("#step2").removeClass("btn-primary");
                        $("#profile-step").show();
                        $("#unit-owner-step").hide();
                    }
                    return isValid;
                });

            });


            const numberOfOptions = $('#state_id').find('option').length;
            if (numberOfOptions > 2) {
                $('.state-hide').show();
            } else {
                $('.state-hide').hide();
            }

            var cities = @Json($city_encoded);
            var states = @Json($state_encoded);
            var areas = @Json($area_encoded);
            citiesar = JSON.parse(cities);
            areass = JSON.parse(areas);
            $(document).ready(function() {

                //#B Project default Open on add Prop first - time
                $('#project_id').select2().select2('open');
                $('#nextButton').click(function() {
                    $('#project_id').select2('toggleDropdown');
                });

                // $('#project_id').select2().select2('open');

                // // Click event handler for the nextButton
                // $('#nextButton').click(function() {
                //     // Toggle the dropdown
                //     $('#project_id').select2('toggleDropdown');
                //     var selectedProject = $('#project_id').val();
                //     if (!selectedProject) {
                //         $('#project_id_error').text('Please select a project.');
                //         return false;
                //     } else {
                //         $('#project_id_error').text('');
                //     }
                // });

                // // Change event handler for the project dropdown
                // $('#project_id').on('change', function() {
                //     if ($(this).val()) {
                //         $('#project_id_error').text('');
                //     }
                // });

                //#B This function used for in input textbox only numeric value enter not string 
                function restrictToNumeric(inputSelectors) {
                    $(inputSelectors.join(',')).on('input', function() {
                        let inputValue = $(this).val();
                        let numericValue = inputValue.replace(/[^0-9]/g, '');
                        $(this).val(numericValue);
                    });
                }
                restrictToNumeric(['#terrace_salable_area', '#salable_area', '#another_area', '#length_of_plot',
                    '#width_of_plot', '#carpet_area', '#entrance_width', '#ceiling_height',
                    '#storage_centre_height', '#carpet_plot_area', '#constructed_builtup_area',
                    '#constructed_salable_area', '#salable_plot_area', '#constructed_carpet_area'
                ]);


                $(".add-docs").click(function() {
                    var cloneHtml = '<div class="clone hide">' +
                        '<div class="control-group input-group" style="margin-top:10px">' +
                        '<div class="input-group-prepend col-md-3" style="margin-right: 2%">' +
                        '<select class="custom-select select2-hidden-accessible" name="const_doc_type[]" tabindex="-1" aria-hidden="true">' +
                        '<option value=""> Category</option>' +
                        '<option value="1">Building Elevation</option>' +
                        '<option value="2">Common Amenities Photos</option>' +
                        '<option value="3">Master Layout Of Building</option>' +
                        '<option value="4">Brochure</option>' +
                        '<option value="5">Cost Sheet</option>' +
                        '<option value="6">Other</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-md-4" style="margin-right: 2%">' +
                        '<input type="file" name="const_documents[]" class="form-control" data-bs-original-title="" title="">' +
                        '</div>' +
                        '<div class="form-group col-md-1">' +
                        '<button class="btn btn-primary rem-docs" style="border-radius:5px;" type="button" title="">-</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $(".increment").after(cloneHtml);

                    // Reinitialize Select2
                    $(".custom-select").select2();
                });

                $("body").on("click", ".rem-docs", function() {
                    $(this).parents(".control-group").remove();
                });



            });

            //Hide Constructed Salable Area when click on storage->plotting
            $('#storagekind4').click(function() {
                if ($(this).prop('checked')) {
                    $('.the_constructed_salable_area').hide();
                    $('.the_centre_height').hide();
                } else {
                    $('.the_constructed_salable_area').show();
                    $('.the_centre_height').show();
                }
            });

            //Disable Price on Land
            var $price1 = $('#price');
            var $price2 = $('#price2');
            $price1.on('input', function() {
                if ($(this).val() !== '') {
                    $price2.prop('disabled', true);
                } else {
                    $price2.prop('disabled', false);
                }
            });
            $price2.on('input', function() {
                if ($(this).val() !== '') {
                    $price1.prop('disabled', true);
                } else {
                    $price1.prop('disabled', false);
                }
            });

            //Add property default select state-city-locality
            let id = '{{ isset($current_id) ? $current_id : 'null' }}';
            if (id === 'null') {
                function updateStateSelect() {
                    let auth = '{{ Auth::user() }}';
                    let authStateId = '{{ Auth::user()->state_id }}';
                    let authCityId = '{{ Auth::user()->city_id }}';

                    $('#state_id').val(authStateId).trigger('change');
                    $('#state-dropdown').val(authCityId).trigger('change');

                    $('#area_id').html('');
                    for (let i = 0; i < areass.length; i++) {
                        if (areass[i]['city_id'] == $("#state-dropdown").val()) {
                            $('#area_id').append(`<option value="${areass[i]['id']}"
                            data-pincode="${areass[i]['pincode']}"
                            data-city_id="${areass[i]['city_id']}"
                            data-state_id="${areass[i]['state_id']}">
                            ${areass[i]['name']}
                        	</option>`);
                        }
                    }
                    $('#area_id').select2();
                }
                updateStateSelect();
            }

            //Measurement (units) are change all on one change
            $(".measure_square").select2();
            $(".measure_square").on("change", function() {
                let selectedValue = $(this).val();
                $(".measure_square").val(selectedValue).trigger("change.select2");
            });
            // });

            // {{-- Hide field comment by Bharat-script --}}
            function toggleProjectDropdown(input) {
                var hideElement = document.getElementById('project_hide');
                if (input.value === '10') {
                    hideElement.style.display = 'none';
                } else if (input.value === '11') {
                    hideElement.style.display = 'none';
                } else {
                    projectDropdown.style.display = 'block';
                }
            }

            $(document).ready(function() {
                $('#state_id').on('change', function() {
                    $(document).on('change', '#state_id', function(e) {
                        $('#state-dropdown').select2('destroy');
                        $('#area_id').select2('destroy');
                        // citiesar = JSON.parse(cities);
                        // areass = JSON.parse(areas);
                        $('#state-dropdown').html('');
                        for (let i = 0; i < citiesar.length; i++) {
                            if (citiesar[i]['state_id'] == $("#state_id").val()) {
                                $('#state-dropdown').append('<option value="' + citiesar[i]['id'] +
                                    '">' + citiesar[i][
                                        'name'
                                    ] + '</option>')
                            }
                        }
                        $('#state-dropdown').select2();

                        $('#area_id').html('');
                        for (let i = 0; i < areass.length; i++) {
                            if (areass[i]['state_id'] == $("#state_id").val()) {
                                $('#area_id').append(`<option value="${areass[i]['id']}"
                            data-pincode="${areass[i]['pincode']}"
                            data-city_id="${areass[i]['city_id']}"
                            data-state_id="${areass[i]['state_id']}">
                            ${areass[i]['name']}
                        </option>`);
                            }
                        }
                        $('#area_id').select2();
                    })
                });

                $('#state-dropdown').on('change', function() {
                    $(document).on('change', '#state-dropdown', function(e) {
                        $('#area_id').html('');
                        for (let i = 0; i < areass.length; i++) {
                            if (areass[i]['city_id'] == $("#state-dropdown").val()) {
                                $('#area_id').append(`<option value="${areass[i]['id']}"
                                    data-pincode="${areass[i]['pincode']}"
                                    data-city_id="${areass[i]['city_id']}"
                                    data-state_id="${areass[i]['state_id']}">
                                    ${areass[i]['name']}
                                </option>`);
                            }
                        }
                        $('#area_id').select2();
                    })
                });
            });
        </script>

        <script>
            var land_image_show_url = "{{ asset('upload/land_images') }}";

            function enableTouchspin(params) {
                !(function(t, n, s) {
                    "use strict";
                    s("html");
                    s(".touchspin").TouchSpin({
                            buttondown_class: "btn btn-primary btn-square",
                            buttonup_class: "btn btn-primary btn-square",
                            buttondown_txt: '<i class="fa fa-minus"></i>',
                            buttonup_txt: '<i class="fa fa-plus"></i>',
                        }),
                        s(".touchspin-vertical").TouchSpin({
                            verticalbuttons: !0,
                            verticalupclass: "fa fa-angle-up",
                            verticaldownclass: "fa fa-angle-down",
                            buttondown_class: "btn btn-primary btn-square",
                            buttonup_class: "btn btn-primary btn-square",
                        }),
                        s(".touchspin-stop-mousewheel").TouchSpin({
                            mousewheel: !1,
                            buttondown_class: "btn btn-primary btn-square",
                            buttonup_class: "btn btn-primary btn-square",
                            buttondown_txt: '<i class="fa fa-minus"></i>',
                            buttonup_txt: '<i class="fa fa-plus"></i>',
                        }),
                        s(".touchspin-color").each(function(t) {
                            var n = "btn btn-primary btn-square",
                                u = "btn btn-primary btn-square",
                                a = s(this);
                            a.data("bts-button-down-class") &&
                                (n = a.data("bts-button-down-class")),
                                a.data("bts-button-up-class") &&
                                (u = a.data("bts-button-up-class")),
                                a.TouchSpin({
                                    mousewheel: !1,
                                    buttondown_class: n,
                                    buttonup_class: u,
                                    buttondown_txt: '<i class="fa fa-minus"></i>',
                                    buttonup_txt: '<i class="fa fa-plus"></i>',
                                });
                        });
                })(window, document, jQuery);
            }

            var district = @Json($dist_encoded);
            var taluka = @Json($tal_encoded);
            var vilage = @Json($vil_encoded);

            $(document).on('change', '#district_id', function(e) {

                $('#taluka_id').select2('destroy');
                $('#village_id').select2('destroy');
                talukasss = JSON.parse(taluka);
                $('#taluka_id').html('');
                $('#village_id').html('');

                $('#taluka_id').append('<option value="">Select Taluka</option>');

                for (let i = 0; i < talukasss.length; i++) {
                    if (talukasss[i]['district_id'] == $("#district_id").val()) {
                        $('#taluka_id').append('<option value="' + talukasss[i]['id'] + '">' + talukasss[i][
                            'name'
                        ] + '</option>')
                    }
                }

                $('#taluka_id').select2();
                $('#village_id').select2();
            })

            $(document).on('change', '#taluka_id', function(e) {

                $('#village_id').select2('destroy');
                vilagess = JSON.parse(vilage);
                $('#village_id').html('');

                $('#village_id').append('<option value="">Select Village</option>');

                for (let i = 0; i < vilagess.length; i++) {
                    if (vilagess[i]['taluka_id'] == $("#taluka_id").val()) {
                        $('#village_id').append('<option value="' + vilagess[i]['id'] + '">' + vilagess[i][
                            'name'
                        ] + '</option>')
                    }
                }
                $('#village_id').select2();
            })

            $(document).on('change', '[name="property_for"]', function(e) {
                // console.log("prop chnged");
                setSellRentBoth();
            });

            $(document).on('click', '#add_industrial_detail', function(e) {
                var TheField = $('#New_industrial_field').val()
                if (TheField != '') {
                    $('#New_industrial_field').val('')
                    var theFieldId = TheField.replace(/[^A-Z0-9]/ig, "_");
                    if ($('#' + theFieldId).length > 0) {
                        Swal.fire(
                            'Error',
                            'This Field Already Exists',
                            'danger'
                        )
                        return;
                    }
                    str =
                        '<div  class="mb-2 form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20 rm-' +
                        theFieldId + '"><input class="form-check-input extra_industrial_field" id="' +
                        theFieldId + '"  type="checkbox"> <label class="form-check-label" for="' + theFieldId + '">' +
                        TheField + '</label> </div>  <div class="mb-3 form-group col-md-7 m-b-20 rm-' + theFieldId +
                        '"> <label>' + TheField +
                        '</label> <input class="form-control extra_industrial_field_remark" name="' + theFieldId +
                        '"  type="text" autocomplete="off">  </div><div class="mb-3 form-group col-md-2 m-b-20 rm-' +
                        theFieldId + '"> <button id="' + theFieldId +
                        '" class="rm-other btn btn-danger btn-air-danger" type="button">-</button></div>'
                    $('#idustrial_fields_container').append(str)
                    floatingField()
                }
            })

            function setSplitedValue(val, no) {
                try {
                    return val.split('_-||-_')[no - 1]
                } catch (error) {

                }
            }

            // categorybhrt
            function setSellRentBoth() {
                var theFor = $('input[name=property_for]:checked').val()
                console.log("the for ==", theFor);
                var selectedCategory = $('input[name=property_category]:checked').attr('data-val');
                if (theFor == 'Rent') {
                    $('.the_price_rent').show()
                    $('.the_price').hide()
                    $('.div_flat_details_5').hide()

                } else if (theFor == 'Sell') {
                    $('.the_price_rent').hide()
                    $('.the_price').show()
                } else {
                    $('.the_price_rent').show()
                    $('.the_price').show()
                    // $('.div_flat_details_5').hide()

                }
                $('.the_constructed_plot_price').hide()
                var theFor2 = $('input[name=property_category]:checked').attr('data-val')
                if ((theFor2 == 'Vila/Bunglow') && (theFor == 'Sell' || theFor == 'Both')) {
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Penthouse' && (theFor == 'Sell' || theFor == 'Both')) {
                    $(".price_constructed_label").each(function(i, e) {
                        $(this).html('Flat Price')
                    });
                    $(".price_plot_label").each(function(i, e) {
                        $(this).html('Terrace Price')
                    });
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Farmhouse' && (theFor == 'Sell' || theFor == 'Both')) {
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Storage/industrial' && (theFor == 'Sell' || theFor == 'Both')) {
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Plot' || theFor2 == 'Storage/industrial' || theFor2 == 'Land') {
                    $('.the_furnished_status').hide();
                }
                if (theFor2 == 'Plot') {
                    $('.the_furnished_status').hide();
                }
                if (theFor2 == 'Vila/Bunglow' || theFor2 == 'Plot' || theFor2 == 'Farmhouse') {
                    $('.the_wing').hide();
                }
            }

            $(document).on('keyup', '[name="price_constructed"]', function(e) {
                var id = $(this).attr('data-unit_id');
                var Amount1 = parseInt(($('[name="price_constructed"][data-unit_id="' + id + '"]').val()).replaceAll(
                    ',', ''));
                var Amount2 = parseInt(($('[name="price_plot"][data-unit_id="' + id + '"]').val()).replaceAll(',', ''));

                if (Amount1 > 0 && Amount2 > 0) {
                    let number = (Amount1) + (Amount2);
                    let format_number = number.toLocaleString('en-IN');
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(format_number).trigger('change');
                }

                if (Amount1 > 0 && Amount2 == 0) {
                    let format_number = Amount1.toLocaleString('en-IN');
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(format_number).trigger('change');
                }

                if (Amount2 > 0 && Amount1 == 0) {
                    let format_number = Amount2.toLocaleString('en-IN');
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(format_number).trigger('change');
                }

                if (Amount2 == 0 && Amount1 == 0) {
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(0).trigger('change');
                }
            })

            $(document).on('keyup', '[name="price_plot"]', function(e) {
                var id = $(this).attr('data-unit_id');
                var Amount1 = parseInt(($('[name="price_constructed"][data-unit_id="' + id + '"]').val()).replaceAll(
                    ',', ''));
                var Amount2 = parseInt(($('[name="price_plot"][data-unit_id="' + id + '"]').val()).replaceAll(',', ''));

                if (Amount1 > 0 && Amount2 > 0) {
                    let number = (Amount1) + (Amount2);
                    let format_number = number.toLocaleString('en-IN');
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(format_number).trigger('change');
                }

                if (Amount1 > 0 && Amount2 == 0) {
                    let format_number = Amount1.toLocaleString('en-IN');
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(format_number).trigger('change');
                }

                if (Amount2 > 0 && Amount1 == 0) {
                    let format_number = Amount2.toLocaleString('en-IN');
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(format_number).trigger('change');
                }

                if (Amount2 == 0 && Amount1 == 0) {
                    $('[name="price_total"][data-unit_id="' + id + '"]').val(0).trigger('change');
                }
            })

            // bhrt
            $(document).on('change', '[name="availability_status"]', function(e) {
                if ($(this).val() == 1) {
                    $('.div_age_of_property').show()
                    $('.div_available_from').hide()
                    $('input[name="available_from"]').val('');
                } else {
                    $('.div_age_of_property').hide()
                    $('.div_available_from').show()
                    $('input[name="propertyage"]').prop('checked', false);
                }
            })

            $(document).on('change', '[name="property_type"]', function(e) {
                $('input[name=property_category]:checked').prop('checked', false).trigger('change')
                resetallfields();
                setIndividualfields();
                showReleventCategory();
            })

            $(document).on('change', 'select[name="furnished_status"]', function(e) {
                var TheStatus = $($(this).find(":selected")).attr('data-val');
                var id = $(this).parent().attr('data-unit_id')
                setFurnishedStatus(TheStatus, id)
            });

            function setFurnishedStatus(TheStatus, id) {
                $('#hr_furnished').hide();
                $('.div_retail_furnished[data-unit_id="' + id + '"]').hide()
                $('.div_office_furnished[data-unit_id="' + id + '"]').hide()
                $('.div_furnished_items[data-unit_id="' + id + '"]').hide()
                $('.div_furnished_items_2[data-unit_id="' + id + '"]').hide()
                $('.hr-element[data-unit_id="' + id + '"]').hide();

                if (TheStatus == 'Unfurnished' || TheStatus == '' || TheStatus == undefined) {
                    return;
                } else if (TheStatus == "Furnished" || TheStatus == "Semi Furnished" || TheStatus == "Can Furnished") {
                    $('#hr_furnished').show();
                }
                if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                    $('.div_retail_furnished[data-unit_id="' + id + '"]').show()
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                    $('.div_office_furnished[data-unit_id="' + id + '"]').show()
                } else {
                    $('.div_furnished_items[data-unit_id="' + id + '"]').show()
                    $('.div_furnished_items_2[data-unit_id="' + id + '"]').show()
                }
            }

            $(document).on('change', '#property_source', function(e) {
                var TheStatus = $($(this).find(":selected")).attr('data-val');
                if (TheStatus == 'Reference') {
                    $('.the_source_refrence').show()
                } else {
                    $('.the_source_refrence').hide()
                }
            })

            $(document).on('change', '#is_pre_leased', function(e) {
                if ($(this).prop('checked')) {
                    $('.the_pre_leased_remarks').show()
                } else {
                    $('.the_pre_leased_remarks').hide()
                }
            })

            $(document).on('change', '#is_amenities', function(e) {
                if ($(this).prop('checked')) {
                    $('.div_amenities_checks').show()
                } else {
                    $('.div_amenities_checks').hide()
                }
            })

            $(document).on('change', '[name="plot_type"]', function(e) {
                var theFor = $('input[name=plot_type]:checked').attr('data-val');
                $('.div_borewell').show()
                $('.div_construction_allowed_for').show()
                $('.div_construction_documents').show()
                $('.div_construction_docs_allowed_for').show()
                $('.the_no_of_floors_allowed').show()
                $('.div_plot_ind_common').show()
                $('.div_tp_details').show()
                $('.div_construction_allowed_for').show()
                $('.div_borewell').show()
                if (theFor == 'commercial') {
                    console.log("comm ==");
                    $('.div_borewell').hide()
                    $('.div_extra_land_details').show()
                    $(".cl-locality").show();
                } else if (theFor == 'agriculture') {
                    console.log("agriii ==");
                    $('.div_construction_allowed_for').hide()
                    $('.div_construction_documents').hide()
                    $('.div_construction_docs_allowed_for').hide()
                    $('.the_no_of_floors_allowed').hide()
                    $('.div_plot_ind_common').hide()
                    $('.div_tp_details').hide()
                    $('.div_extra_land_details').show()
                    $(".cl-locality").hide();
                } else if (theFor == 'industrial') {
                    console.log("industrial ==");
                    $('.div_construction_allowed_for').hide()
                    $('.div_construction_documents').hide()
                    $('.div_construction_docs_allowed_for').hide()
                    $('.div_borewell').hide()
                    $('.div_extra_land_details').hide()
                    $(".cl-locality").show();
                }
            });

            showReleventCategory()

            function resetallfields() {
                hidefields = ['div_office_type', 'div_retail_type', 'div_flat_type', 'div_vila_type', 'div_plot_type',
                    'div_storage_type',
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
                    'div_construction_allowed_for', 'div_retail_furnished', 'div_amenities', 'div_amenities_checks',
                    'div_construction_documents', 'div_construction_docs_allowed_for',
                ]
                for (let i = 0; i < hidefields.length; i++) {
                    $('.' + hidefields[i]).hide();
                }
            }

            function addAddAreaButtons(arr, arr2) {
                for (let i = 0; i < arr.length; i++) {
                    if ($("#add_area_button_container .add_other_area_details[data-val='" + arr[i] + "']").length == 0) {
                        var str =
                            '<div  class="form-group col-md-auto  mb-3"> <a class="add_other_area_details" style="color:#0078DB!important" href="javascript:void(0)" data-val="' +
                            arr[i] + '" > + ' + arr2[i] + '</a> </div>';
                        $('#add_area_button_container').append(str);
                    }

                }
            }

            function removeAddAreaButtons(arr) {
                for (let i = 0; i < arr.length; i++) {
                    if ($("#add_area_button_container .add_other_area_details[data-val='" + arr[i] + "']").length > 0) {
                        $("#add_area_button_container .add_other_area_details[data-val='" + arr[i] + "']").parent('div')
                            .remove();
                    }
                }
            }

            $(document).on('click', '.add_other_area_details', function(e) {
                $('.' + $(this).attr('data-val')).show()
                $(this).hide()
            })

            resetallfields()
            $(document).on('change', '[name="property_category"]', function(e) {
                var category_type = $(this).attr('data-val');
                console.log("cat type", category_type);
                resetallfields();
                setIndividualfields();
                $('#all_units').html('')
                $('#all_owner_contacts').html('')
                $('#add_area_button_container').html('')
                $(".cl-locality").hide();
                if (category_type == 'Flat') {
                    showfields = ['div_flat_type', 'div_flat_details_2', 'div_area_size_details', 'the_builtup_area', ,
                        'the_salable_area', 'div_flat_details', 'the_no_of_bathrooms',
                        'the_no_of_elavators', 'the_property_on_floors', 'the_total_units_in_tower',
                        'the_total_units_in_project', 'the_servent_room', 'the_service_elavator',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'the_total_no_of_floor',
                        'the_two_wheller_Parking', 'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8',
                        'div_care_taker', 'div_availability_status', 'the_furnished_status', 'the_1rk',
                        'div_amenities', 'cl-locality', 'terrace', 'div_document_section', 'the_ceilling_height',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Vila/Bunglow') {
                    showfields = ['div_vila_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_constructed_salable_area', 'the_salable_plot_area',
                        'div_furnished_items', 'div_furnished_items_2',
                        'div_flat_details', 'the_no_of_bathrooms', 'the_no_of_balcony',
                        'the_total_no_of_units', 'the_no_of_side_open', 'the_servent_room',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'div_checkboxes1',
                        'div_flat_details_7', 'div_flat_details_8', 'div_care_taker', 'div_availability_status',
                        'the_furnished_status', 'div_amenities', 'cl-locality', 'div_document_section',
                        // 'the_no_of_room',
                    ];
                    addAddAreaButtons(['the_carpet_plot_area', 'the_constructed_carpet_area',
                        'the_constructed_builtup_area'
                    ], ['Add Carpet Plot Area', 'Add Constructed Carpet Area', 'Add Constructed Builtup Area']);
                } else if (category_type == 'Plot') {
                    showfields = ['div_flat_details_2', 'div_area_size_details', 'the_salable_area',
                        'div_flat_details', 'the_total_no_of_units', 'the_no_of_side_open', 'the_length_of_plot',
                        'the_width_of_plot', 'the_no_of_floors_allowed',
                        'div_property_source', 'div_property_address', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_document_section', 'cl-locality',
                        // div_flat_details_5
                    ];
                    $('.div_extra_land_details').hide()
                    // $('.div_extra_land_details').show()
                    addAddAreaButtons(['the_carpet_plot_area'], ['Add Carpet Plot Area']);
                } else if (category_type == 'Penthouse') {
                    showfields = ['div_flat_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_area', 'the_terrace_salable_area', 'div_flat_details',
                        'the_no_of_bathrooms',
                        'the_no_of_elavators', 'the_property_on_floors', 'the_total_units_in_tower',
                        'the_total_units_in_project', 'the_servent_room', 'the_service_elavator',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source',
                        'the_two_wheller_Parking', 'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8',
                        'div_care_taker',
                        'div_availability_status', 'div_amenities',
                        'the_furnished_status', 'the_total_no_of_floor', 'the_no_of_balcony', 'cl-locality',
                        'div_document_section', 'the_ceilling_height',
                    ];
                    addAddAreaButtons(['the_carpet_area', 'the_builtup_area', 'the_terrace_carpet_area'], [
                        'Add Carpet Area', 'Add Builtup Area', 'Add Terrace Carpet Area'
                    ]);
                } else if (category_type == 'Farmhouse') {
                    showfields = ['div_flat_details_2', 'div_area_size_details', , 'the_constructed_salable_area',
                        'the_salable_plot_area', 'div_flat_details', 'the_no_of_bathrooms',
                        'the_total_no_of_units', 'the_servent_room', 'div_property_address',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source',
                        'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8', 'div_care_taker',
                        'div_availability_status', 'div_amenities',
                        'the_furnished_status', 'the_no_of_balcony', 'the_no_of_room', 'the_no_of_side_open',
                        'div_extra_land_details', 'div_document_section', 'cl-locality',
                    ];
                    addAddAreaButtons(['the_constructed_carpet_area', 'the_constructed_builtup_area',
                        'the_carpet_plot_area'
                    ], ['Add Constructed Carpet Area', 'Add Constructed Builtup Area', 'Add Carpet plot Area']);
                } else if (category_type == 'Office') {
                    showfields = ['div_office_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_area', 'div_flat_details', 'the_property_on_floors',
                        'the_total_units_in_project', 'the_total_no_of_floor', 'the_total_units_in_tower',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'the_no_of_elavators',
                        'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8', 'div_care_taker',
                        'div_availability_status', 'div_office_furnished', 'the_service_elavator',
                        'div_washroom_type_2', 'terrace', 'the_ceilling_height',
                        'the_furnished_status', 'cl-locality', 'the_two_wheller_Parking', 'div_document_section',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Retail') {
                    showfields = ['div_retail_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_total_units_in_project', 'the_salable_area', 'the_opening_width',
                        'the_ceilling_height', 'div_flat_details', 'the_total_no_of_floor',
                        'the_total_units_in_tower', 'div_flat_details_5', 'div_flat_details_4',
                        'div_property_source', 'the_no_of_elavators', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_care_taker', 'the_service_elavator',
                        'div_availability_status', 'div_washroom_type_2',
                        'the_furnished_status', 'the_two_wheller_Parking', 'div_extra_retail_details',
                        'cl-locality', 'div_document_section',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Storage/industrial') {
                    showfields = ['div_storage_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_plot_area', 'the_constructed_salable_area',
                        'the_centre_height', 'div_flat_details', 'div_flat_details_5', 'div_flat_details_4',
                        'div_property_source', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_other_details',
                        'div_availability_status', 'the_total_units_in_project',
                        'the_furnished_status', 'the_two_wheller_Parking', 'div_road_width', 'cl-locality',
                        'div_care_taker', 'div_document_section',
                    ];
                    addAddAreaButtons(['the_carpet_plot_area', 'the_constructed_carpet_area'], ['Add Carpet plot Area',
                        'Add Constructed Carpet Area'
                    ]);
                } else if (category_type == 'Land') {
                    console.log("Land here ==")
                    showfields = ['div_plot_type', 'div_flat_details', 'div_flat_details_2', 'div_property_address',
                        'div_area_size_details', 'div_borewell',
                        'the_length_of_plot', 'the_width_of_plot',
                        'the_no_of_floors_allowed', 'div_construction_documents',
                        // 'div_care_taker','div_flat_details_5','div_flat_details_7'
                        'div_property_source', 'div_checkboxes1', 'div_construction_allowed_for', 'div_tp_details',
                        'div_flat_details_8', 'div_plot_ind_common', 'div_document_section', 'div_survey_details',
                        'div_road_width', 'div_construction_docs_allowed_for', 'div_extra_land_details',
                    ];
                }
                for (let i = 0; i < showfields.length; i++) {
                    $('.' + showfields[i]).show();
                }
                var id = '{{ isset($current_id) ? $current_id : '' }}';
                if (id == '') {
                    generate_contact_detail_click(1)
                    generate_unit_detail_click(1);
                }
            })

            function setIndividualfields() {
                hidefields = ['the_constructed_carpet_area', 'the_constructed_salable_area', 'the_constructed_builtup_area',
                    'the_salable_plot_area', 'the_carpet_plot_area', 'the_centre_height', 'the_salable_area',
                    'the_length_of_plot', 'the_width_of_plot', 'the_carpet_area', 'the_opening_width',
                    'the_ceilling_height', 'the_builtup_area', 'the_plot_area', 'the_terrace_area', 'the_construction_area',
                    'the_terrace_carpet_area', 'the_terrace_salable_area', 'the_total_units_in_project',
                    'the_total_no_of_floor', 'the_total_units_in_tower', 'the_property_on_floors', 'the_no_of_elavators',
                    'the_total_no_of_units', 'the_no_of_room', 'the_no_of_bathrooms',
                    'the_no_of_balcony', 'the_no_of_floors_allowed', 'the_no_of_side_open', 'the_servent_room',
                    'the_service_elavator', 'the_two_wheller_Parking', 'the_constructed_plot_price', 'the_1rk',
                    'the_source_refrence', 'the_pre_leased_remarks', 'div_available_from'
                ]
                for (let i = 0; i < hidefields.length; i++) {
                    $('.' + hidefields[i]).hide();
                }
            }
            setIndividualfields();

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
                var theFor = $('input[name=property_for]:checked').val();
                if (theFor == 'Sell' && parent_val == '87') {
                    $('.property-type-element[data-property-id="256"]').show();
                } else {
                    $('.property-type-element[data-property-id="256"]').hide();
                }
            }

            $(document).on('change', '#project_id', function(e) {
                if (isNaN(Number($(this).val()))) {
                    $('#address').removeAttr('disabled')
                } else {
                    $('#address').attr('disabled', 'disabled')
                    $('#address').val($('#project_id').find(":selected").attr('data-addr')).trigger(
                        'change');
                }
                $('#address').parent().parent().addClass('focused')
                $('#address').val($('#project_id').find(":selected").attr('data-addr')).trigger('change');
                $('#city_id').val($('#project_id').find(":selected").attr('data-city')).trigger('change');
                $('#state-dropdown').val($('#project_id').find(":selected").attr('data-city')).trigger('change');
                $('#area_id').val($('#project_id').find(":selected").attr('data-area')).trigger('change');
                $('#property_link').val($('#project_id').find(":selected").attr('data-location')).trigger('change');
            })

            var allowedselect2s = ['project_id'];
            $(document).on('keydown', '.select2-search__field', function(e) {
                setTimeout(() => {
                    var par = $(this).closest('.select2-dropdown')
                    var tar = $(par).find('.select2-results')
                    var kar = $(tar).find('.select2-results__options')
                    var opt = $(kar).find('li')
                    if (opt.length == 1 && $(opt[0]).text() == 'No results found' && $(this).val() != '') {
                        var idd = $(kar).attr('id')
                        idd = idd.replace("select2-", "");
                        idd = idd.replace("-results", "");
                        if (allowedselect2s.includes(idd)) {
                            $("#" + idd + " option[last_added='" + true + "']").each(function(i, e) {
                                $('#' + idd + ' option[value="' + $(this).val() + '"]').detach();
                            });
                            if ($("#" + idd + " option[value='" + $(this).val() + "']").length == 0) {
                                var newState = new Option($(this).val(), $(this).val(), true, true);

                                vvvv = $.parseHTML('<option last_added="true" value="' + $(this).val() +
                                    '" selected="">' + $(this).val() + '</option>');
                                $("#" + idd).append(vvvv).trigger('change');
                            }
                        }
                    } else if ($(this).val() != '' && $(opt[0])[0] !== undefined && $($(opt[0])[0]).attr(
                            'id') != '') {
                        var idd = $(kar).attr('id')
                        idd = idd.replace("select2-", "");
                        idd = idd.replace("-results", "");
                        if (allowedselect2s.includes(idd)) {
                            $("#" + idd + " option[last_added='" + true + "']").each(function(i, e) {
                                $('#' + idd + ' option[value="' + $(this).val() + '"]').detach();
                            });
                            if ($("#" + idd + " option[value='" + $(this).val() + "']").length == 0) {
                                var newState = new Option($(this).val(), $(this).val(), true, true);

                                vvvv = $.parseHTML('<option last_added="true" value="' + $(this).val() +
                                    '" selected="">' + $(this).val() + '</option>');
                                $("#" + idd).append(vvvv).trigger('change');
                            }
                        }
                    }
                }, 50);
            })

            function makeid(length) {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }

            // bharat contact
            function generate_contact_detail(id, plus = 0) {
                var myvar = '<div data-contact-id=' + id + ' class="row"><div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-20">' +
                    '<div><label>Name</label>' +
                    '       <input class="form-control" name="other_name" id="other_name" type="text"' +
                    '            autocomplete="off">' +
                    '</div><div id="other_name_error_' + id +
                    '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-2 m-b-20">' +
                    '<div><label>Contact No</label>' +
                    '       <input class="form-control" name="other_contact" id="other_contact"' +
                    '           type="text"  autocomplete="off">' +
                    '</div><div id="other_contact_error_' + id +
                    '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-2 m-b-20">' +
                    '<div><label>Position</label>' +
                    '       <input class="form-control" name="position" id="position"' +
                    '           type="text"  autocomplete="off">' +
                    '</div><div id="position_error_' + id +
                    '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
                    ' class="' + ((plus) ? "add_owner_contacts get-pos" : "remove_owner_contacts remove-pos") +
                    ' btn btn-primary" type="button" style="border-radius: 5px;">' + ((plus) ? "+" : "-") + '</button>  </div>'
                '</div>';
                // if (plus === 0) {
                //     var selectElement = document.getElementById("key_arrangement");
                //     var optionValue = 'Other contact ' + (selectElement.options.length - 2);
                //     var newOption = document.createElement("option");
                //     newOption.value = optionValue;
                //     newOption.text = optionValue;
                //     selectElement.add(newOption);
                // }'
                if (plus === 0) {
                    var selectElement = document.getElementById("key_arrangement");
                    var nameInput = document.getElementById("other_name");
                    var nameValue = nameInput.value;
                    var optionValue = nameValue + (selectElement.options.length - 2);
                    var newOption = document.createElement("option");
                    newOption.value = optionValue;
                    newOption.text = optionValue;
                    selectElement.add(newOption);
                }
                return myvar;
            }

            function generate_furnished_detail(id) {
                var currentFurnished = $('input[name=property_category]:checked').attr('data-val')
                if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                    $("#office_furnished_template div,#office_furnished_template button,#office_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', id)
                        });
                    var str = $("#office_furnished_template").html()
                    $("#office_furnished_template div,#office_furnished_template button,#office_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', '')
                        });
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                    $("#retail_furnished_template div,#retail_furnished_template button,#retail_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', id)
                        });
                    var str = $("#retail_furnished_template").html()
                    $("#retail_furnished_template div,#retail_furnished_template button,#retail_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', '')
                        });
                } else if (currentFurnished != 'Storage/industrial' && currentFurnished != 'Plot') {
                    $("#furnished_types_template div,#furnished_types_template button,#furnished_types_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', id)
                        });
                    var str = $("#furnished_types_template").html()
                    $("#furnished_types_template div,#furnished_types_template button,#furnished_types_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', '')
                        });
                }
                return str;
            }

            // function generate_unit_detail(id, plus = 0) {
            //     var myvar = '<div class="row"><div  data-unit_id= ' +
            //         id + ' class="form-group the_wing col-md-2 m-b-20">' +
            //         '<div><label>Wing</label>' +
            //         '            <input class="form-control" name="wing" ' +
            //         '                type="text"  autocomplete="off">' +
            //         '</div><div id="wing_no_error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '</div>' +
            //         '<div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-20">' +
            //         '<div><label>Unit No</label>' +
            //         '            <input class="form-control" name="unit_unit_no" ' +
            //         '                type="text"  autocomplete="off">' +
            //         '</div><div id="unit_no__error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '</div>' +
            //         '        <div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-4 mb-3">' +
            //         '            <select class="form-select" name="unit_status">' +
            //         '                <option value="Available">Available</option>' +
            //         '                <option value="Rent Out">Rent Out</option>' +
            //         '                <option value="Sold Out">Sold Out</option>' +
            //         '            </select>' +
            //         '        </div>' +

            //         '<div  data-unit_id= ' + id + ' class="the_price_rent form-group col-md-2 m-b-20">' +
            //         '<div><label>Price Rent</label>' +
            //         '            <input class="form-control indian_currency_amount" name="price_rent" ' +
            //         '                type="text"  autocomplete="off">' +
            //         '</div><div id="price_rent_error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '        </div>' +

            //         '<div  data-unit_id= ' + id + ' class="the_price form-group col-md-2 m-b-20">' +
            //         '<div><label>Price</label>' +
            //         '            <input class="form-control indian_currency_amount" name="price" ' +
            //         '                type="text"  autocomplete="off">' +
            //         '</div><div id="price_error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '        </div>' +

            //         '<div class="the_constructed_plot_price row"><div  data-unit_id= ' + id +
            //         ' class=" form-group col-md-2 m-b-20">' +
            //         '<div><label class="price_constructed_label"> Construction Price</label>' +
            //         '            <input class="form-control indian_currency_amount" data-unit_id= ' + id +
            //         ' name="price_constructed" ' +
            //         '                type="text"  autocomplete="off">' +
            //         '</div><div id="price_constructed_error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '        </div>' +

            //         '<div  data-unit_id= ' + id + ' class="col-md-2 m-b-20">' +
            //         '<div class=" form-group">' +
            //         '<div><label class="price_plot_label"> Plot Price</label>' +
            //         '            <input class="form-control indian_currency_amount" data-unit_id= ' + id +
            //         ' name="price_plot" ' +
            //         '                type="text"  autocomplete="off">' +
            //         '</div><div id="price_plot_error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '        </div>' +

            //         '</div>' +
            //         '<div  data-unit_id= ' + id + ' class=" form-group col-md-2 m-b-20">' +
            //         '<div class=" form-group">' +
            //         '<div><label>Price</label>' +
            //         '            <input class="form-control indian_currency_amount" data-unit_id= ' + id +
            //         ' name="price_total" ' +
            //         '                type="text"  autocomplete="off" disabled>' +
            //         '</div><div id="price_total_error_' + id +
            //         '" class="invalid-feedback" style="display: none; color: red;"></div>' +
            //         '        </div>' +
            //         '<small style="display:none"  class="text-secondary ps-1 converted_value"></small>' +
            //         '</div></div>' +
            //         '        <div  data-unit_id= ' + id + ' class="the_furnished_status form-group col-md-3 m-b-4 mb-3">' +
            //         '            <select class="form-select" name="furnished_status">' +
            //         '                <option value="">Furnished Status</option>' +
            //                             @forelse ($property_configuration_settings as $props)
            //                                 @if ($props['dropdown_for'] == 'property_furniture_type')
            //                                     '<option data-val="{{ $props['name'] }}" value="{{ $props['id'] }}">{{ $props['name'] }}</option>' +
            //                                 @endif
            //                             @empty
            //                             @endforelse
            //                         '</select>' +

            //                             '</div>' +
            //                             '<div data-unit_id= ' + id +
            //                             ' class="form-group col-md-1 m-b-4 mb-3"><button data-unit_id=' + id +
            //                             ' class="' + ((plus) ? "add_units" : "remove_units") +
            //                             ' btn btn-primary" type="button" style="border-radius: 5px;">' + ((
            //                                 plus) ? "+" : "-") + '</button>  </div>' +
            //                             '</div>';
            //                         return myvar;
            //                     }

            function generate_unit_detail(id, plus = 0) {
                var myvar = '<div class="row">' +
                    '<div data-unit_id="' + id + '" class="form-group the_wing col-md-2 m-b-20">' +
                    '<div>' +
                    '<label>Wing</label>' +
                    '<input class="form-control" name="wing" type="text" autocomplete="off">' +
                    '</div>' +
                    '<div id="wing_' + id + '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="form-group col-md-2 m-b-20">' +
                    '<div>' +
                    '<label>Unit No</label>' +
                    '<input class="form-control" name="unit_unit_no" type="text" autocomplete="off">' +
                    '</div>' +
                    '<div id="unit_no__error_' + id + '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="form-group col-md-2 m-b-4 mb-3">' +
                    '<select class="form-select" name="unit_status">' +
                    '<option value="Available">Available</option>' +
                    '<option value="Rent Out">Rent Out</option>' +
                    '<option value="Sold Out">Sold Out</option>' +
                    '</select>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="the_price_rent form-group col-md-2 m-b-20">' +
                    '<div>' +
                    '<label>Price Rent</label>' +
                    '<input class="form-control indian_currency_amount" name="price_rent" type="text" autocomplete="off">' +
                    '</div>' +
                    '<div id="price_rent_error_' + id + '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="the_price form-group col-md-2 m-b-20">' +
                    '<div>' +
                    '<label>Price</label>' +
                    '<input class="form-control indian_currency_amount" name="price" type="text" autocomplete="off">' +
                    '</div>' +
                    '<div id="price_error_' + id + '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<div class="the_constructed_plot_price row">' +
                    '<div data-unit_id="' + id + '" class="col-md-2 m-b-20">' +
                    '<div class="form-group">' +
                    '<div>' +
                    '<label class="price_plot_label">Plot Price</label>' +
                    '<input class="form-control indian_currency_amount" data-unit_id="' + id +
                    '" name="price_plot" type="text" autocomplete="off">' +
                    '</div>' +
                    '<div id="price_plot_error_' + id + '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="form-group col-md-2 m-b-20">' +
                    '<div>' +
                    '<label class="price_constructed_label">Construction Price</label>' +
                    '<input class="form-control indian_currency_amount" data-unit_id="' + id +
                    '" name="price_constructed" type="text" autocomplete="off">' +
                    '</div>' +
                    '<div id="price_constructed_error_' + id +
                    '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="form-group col-md-2 m-b-20">' +
                    '<div class="form-group">' +
                    '<div>' +
                    '<label>Price</label>' +
                    '<input class="form-control indian_currency_amount" data-unit_id="' + id +
                    '" name="price_total" type="text" autocomplete="off" disabled>' +
                    '</div>' +
                    '<div id="price_total_error_' + id +
                    '" class="invalid-feedback" style="display: none; color: red;"></div>' +
                    '</div>' +
                    '<small style="display:none" class="text-secondary ps-1 converted_value"></small>' +
                    '</div>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="the_furnished_status form-group col-md-3 m-b-4 mb-3">' +
                    '<select class="form-select" name="furnished_status">' +
                    '<option value="">Furnished Status</option>';
                @forelse ($property_configuration_settings as $props)
                    @if ($props['dropdown_for'] == 'property_furniture_type')
                        myvar +=
                            '<option data-val="{{ $props['name'] }}" value="{{ $props['id'] }}">{{ $props['name'] }}</option>';
                    @endif
                @empty
                @endforelse
                myvar += '</select>' +
                    '</div>' +
                    '<div data-unit_id="' + id + '" class="form-group col-md-1 m-b-4 mb-3">' +
                    '<button data-unit_id="' + id + '" class="' + ((plus) ? "add_units" : "remove_units") +
                    ' btn btn-primary" type="button" style="border-radius: 5px;">' + ((plus) ? "+" : "-") + '</button>' +
                    '</div>' +
                    '</div>';
                return myvar;
            }


            //decimal

            $(document).on('click', '.add_owner_contacts', function(e) {
                generate_contact_detail_click(0);
            })
            $(document).on('click', '.remove_owner_contacts', function(e) {
                id = $(this).attr('data-contact_id');
                $("[data-contact_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $(document).on('click', '.add_units', function(e) {
                generate_unit_detail_click();
            })

            function generate_contact_detail_click(plus = 0) {
                id = makeid(10);
                $('#all_owner_contacts').append(generate_contact_detail(id, plus));
                $("#all_owner_contacts select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            }

            function generate_unit_detail_click(plus = 0) {
                id = makeid(10);
                $('#all_units').append(generate_unit_detail(id, plus));
                $('#all_units').append(generate_furnished_detail(id));
                setFurnishedStatus('', id);
                $("#all_units .touchspin25").each(function(index) {
                    $(this).addClass('touchspin')
                    $(this).removeClass('touchspin25')
                });
                $("#all_units .remained").each(function(index) {
                    if ($(this).is('input')) {
                        $(this).attr('id', $(this).attr('id') + id)
                        $(this).removeClass('remained')
                    }
                    if ($(this).is('label')) {
                        $(this).attr('for', $(this).attr('for') + id)
                        $(this).removeClass('remained')
                    }
                });
                enableTouchspin();
                $("#all_units select").each(function(index) {
                    $(this).select2();
                })
                setSellRentBoth();
                floatingField();
            }

            $(document).on('click', '.remove_units', function(e) {
                id = $(this).attr('data-unit_id');
                $("[data-unit_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $('#modal_form').validate({ // initialize the plugin
                rules: {
                    property_for: {
                        required: true,
                    },
                    property_type: {
                        required: true,
                    },
                    specific_type: {
                        required: true,
                    },
                    project_id: {
                        required: true,
                    },
                    property_unit_no: {
                        digits: true,
                    },
                    carpet_area: {
                        digits: true,
                    },
                    super_builtup_area: {
                        digits: true,
                    },
                    plot_area: {
                        digits: true,
                    },
                    terrace: {
                        digits: true,
                    },
                    property_email: {
                        email: true,
                    },
                },
                submitHandler: function(form) { // for demo
                    alert('valid form submitted'); // for demo
                    return false; // for demo
                }
            });

            function getProperty() {
                var id = '{{ isset($current_id) ? $current_id : 'null' }}';
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getProperty') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data == '') {
                            return
                        }

                        //Disable Price on Land
                        var $price1 = $('#price');
                        var $price2 = $('#price2');

                        $price1.on('input', function() {
                            if ($(this).val() !== '') {
                                $price2.prop('disabled', true);
                            } else {
                                $price2.prop('disabled', false);
                            }
                        });

                        $price2.on('input', function() {
                            if ($(this).val() !== '') {
                                $price1.prop('disabled', true);
                            } else {
                                $price1.prop('disabled', false);
                            }
                        });
                        // edit property selected valdata.width_of_plot, 1
                        data = JSON.parse(data);
                        const ceilingHeight = data.ceiling_height;
                        let parts = ceilingHeight.split('_-||-_');
                        $('#this_data_id').val(data.id);
                        $('input[name=property_for][value=' + data.property_for + ']').prop('checked', true)
                        $('input[name=property_type][value=' + data.property_type + ']').prop('checked', true)
                            .trigger('change')
                        $('input[name=property_category][value=' + data.property_category + ']').prop('checked',
                            true).trigger('change');
                        if (data.configuration != '' && data.configuration != null) {
                            $('input[name=office_type][value=' + data.configuration + ']').prop('checked', true)
                            $('input[name=retail_type][value=' + data.configuration + ']').prop('checked', true)
                            $('input[name=flat_type][value=' + data.configuration + ']').prop('checked', true)
                            // bharat subcategory
                            $('input[name=vila_type][value=' + data.configuration + ']').prop('checked', true)
                            $('input[name=plot_type][value=' + data.configuration + ']').prop('checked', true)
                            $('input[name=storage_type][value=' + data.configuration + ']').prop('checked', true)
                        }
                        $('#price').val(data.survey_price);
                        if (data.survey_price !== '') {
                            $('#price2').prop('disabled', true);
                        }
                        $('#price2').val(data.fp_plot_price);

                        $('#remarks').val(data.remarks);
                        $('#project_id').val(data.project_id);
                        $('#state-dropdown').val(data.city_id);
                        $('#state_id').val(data.state_id);
                        $('#area_id').val(data.locality_id);
                        $('#address').val(data.address);
                        $('#property_link').val(data.location_link);
                        $('#district_id').val(data.district_id);
                        $('#taluka_id').val(data.taluka_id);
                        $('#village_id').val(data.village_id);
                        $('#zone').val(data.zone_id);
                        $('#constructed_carpet_area').val(setSplitedValue(data.constructed_carpet_area, 1));
                        $('#constructed_carpet_area_measurement').val(setSplitedValue(data.constructed_carpet_area,
                            2));
                        $('#constructed_salable_area').val(setSplitedValue(data.constructed_salable_area, 1));
                        $('#constructed_salable_area_measurement').val(setSplitedValue(data
                            .constructed_salable_area,
                            2));
                        $('#constructed_builtup_area').val(setSplitedValue(data.constructed_builtup_area, 1));
                        $('#constructed_builtup_area_measurement').val(setSplitedValue(data
                            .constructed_builtup_area,
                            2));
                        $('#salable_plot_area').val(setSplitedValue(data.salable_plot_area, 1));
                        $('#salable_plot_area_measurement').val(setSplitedValue(data.salable_plot_area, 2));
                        $('#carpet_plot_area').val(setSplitedValue(data.carpet_plot_area, 1));
                        $('#carpet_plot_area_measurement').val(setSplitedValue(data.carpet_plot_area, 2));
                        $('#salable_area').val(setSplitedValue(data.salable_area, 1));
                        $('#salable_area_measurement').val(setSplitedValue(data.salable_area, 2));
                        $('#carpet_area').val(setSplitedValue(data.carpet_area, 1));
                        $('#carpet_area_measurement').val(setSplitedValue(data.carpet_area, 2));
                        $('#storage_centre_height').val(setSplitedValue(data.storage_centre_height, 1));
                        $('#storage_centre_height_measurement').val(setSplitedValue(data.storage_centre_height,
                            2));
                        $('#length_of_plot').val(setSplitedValue(data.length_of_plot, 1));
                        $('#length_of_plot_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#width_of_plot').val(setSplitedValue(data.width_of_plot, 1));
                        $('#width_of_plot_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#entrance_width').val(setSplitedValue(data.entrance_width, 1));
                        $('#entrance_width_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#ceiling_height').val(parseFloat(parts[0]));
                        // $('#ceiling_height').val(setSplitedValue(data.ceiling_height, 1));
                        $('#ceiling_height_measurement').val(parts[1]);
                        $('#builtup_area').val(setSplitedValue(data.builtup_area, 1));
                        $('#builtup_area_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#plot_area').val(setSplitedValue(data.plot_area, 1));
                        $('#plot_area_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#terrace').val(setSplitedValue(data.terrace, 1));
                        $('#terrace_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#construction_area').val(setSplitedValue(data.construction_area, 1));
                        $('#construction_area_measurement').val(setSplitedValue(data.constructed_carpet_area, 2));
                        $('#terrace_carpet_area').val(setSplitedValue(data.terrace_carpet_area, 1));
                        $('#terrace_carpet_area_measurement').val(setSplitedValue(data.terrace_carpet_area, 2));
                        $('#terrace_salable_area').val(setSplitedValue(data.terrace_salable_area, 1));
                        $('#terrace_salable_area_measurement').val(setSplitedValue(data.terrace_salable_area,
                            2));
                        $('#total_units_in_project').val(data.total_units_in_project);
                        $('#total_no_of_floor').val(data.total_no_of_floor);
                        $('#total_units_in_tower').val(data.total_units_in_tower);
                        $('#property_on_floors').val(data.property_on_floors);
                        $('#no_of_elavators').val(data.no_of_elavators);
                        $('#no_of_balcony').val(data.no_of_balcony);
                        $('#total_no_of_units').val(data.total_no_of_units);
                        $('#no_of_room').val(data.no_of_room);
                        $('#no_of_bathrooms').val(data.no_of_bathrooms);
                        $('#no_of_floors_allowed').val(data.no_of_floors_allowed);
                        $('#no_of_side_open').val(data.no_of_side_open);
                        $('#service_elavator').prop('checked', Number(data.service_elavator)).trigger('change');
                        $('#servant_room').prop('checked', Number(data.servant_room)).trigger('change');
                        $('#hot_property').prop('checked', Number(data.hot_property)).trigger('change');
                        $('#is_favourite').prop('checked', Number(data.is_favourite)).trigger('change');
                        $('#is_pre_leased').prop('checked', Number(data.is_pre_leased)).trigger('change');
                        $('#is_terrace').prop('checked', Number(data.is_terrace)).trigger('change');
                        $('#front_road_width').val(setSplitedValue(data.front_road_width, 1));
                        $('#front_road_width_measurement').val(setSplitedValue(data.front_road_width, 2));
                        $('#construction_allowed_for').val(data.construction_allowed_for);
                        $('#construction_documents').val(data.construction_documents);
                        $('#fsi').val(data.fsi);
                        $('#no_of_borewell').val(data.no_of_borewell);
                        $('#fourwheller_parking').val(data.fourwheller_parking);
                        $('#twowheeler_parking').val(data.twowheeler_parking);
                        $('#pre_leased_remarks').val(data.pre_leased_remarks);
                        $('#Property_priority').val(data.Property_priority);
                        $('#property_source').val(data.source_of_property).trigger('change');
                        $('#refrence').val(data.property_source_refrence);
                        $('#available_from').val(data.available_from);
                        $('input[name=washrooms2_type][value=' + data.washrooms2_type + ']').prop('checked', true)
                        $('input[name=propertyage][value=' + data.propertyage + ']').prop('checked', true)
                        $('input[name=availability_status][value=' + data.availability_status + ']').prop('checked',
                            true)
                        $('#two_road_corner').prop('checked', Number(data.two_road_corner)).trigger('change');
                        $('#survey_number').val(data.survey_number);
                        $('#price').val(data.survey_price);
                        $('#tp_number').val(data.tp_number);
                        $('#fp_number').val(data.fp_number);
                        $('#plot_size').val(setSplitedValue(data.survey_plot_size, 1));
                        $('#survey_plot_measurement').val(setSplitedValue(data.survey_plot_size, 2));
                        $('#plot2_size').val(setSplitedValue(data.fp_plot_size, 1));
                        $('#plot2_measurement').val(setSplitedValue(data.fp_plot_size, 2));
                        $('#price2').val(data.fp_plot_price);
                        $('#owner_is').val(data.owner_is);
                        $('#owner_info_name').val(data.owner_name);
                        $('#owner_contact_specific_no').val(data.owner_contact);
                        $('#property_email').val(data.owner_email);
                        $('#is_nri').prop('checked', Number(data.owner_nri)).trigger('change');
                        $('#care_take_name').val(data.care_taker_name);
                        $('#care_take_contact_no').val(data.care_taker_contact);
                        $('#key_arrangement').val(data.key_available_at).trigger('change');
                        $('input[name=conference_available][value=' + data.conference_room + ']').prop('checked',
                            true)
                        $('input[name=reception_available][value=' + data.reception_area + ']').prop('checked',
                            true)
                        $('input[name=pantry_available][value=' + data.pantry_type + ']').prop('checked', true)

                        if (Number(data.is_terrace) == 1) {
                            $(".the_terrace_salable_area").show();
                            addAddAreaButtons(['the_terrace_carpet_area'], ['Add Terrace Carpet Area']);
                            if (
                                (setSplitedValue(data.terrace_carpet_area, 1) != undefined) &&
                                (setSplitedValue(data.terrace_carpet_area, 1) != "undefined") &&
                                (setSplitedValue(data.terrace_carpet_area, 1) != "") &&
                                (setSplitedValue(data.terrace_carpet_area, 1) != " ")
                            ) {
                                $(".the_terrace_carpet_area").show();
                                removeAddAreaButtons(['the_terrace_carpet_area']);
                            } else {
                                $(".the_terrace_carpet_area").hide();

                            }
                        } else {
                            $(".the_terrace_salable_area").hide();
                            $(".the_terrace_carpet_area").hide();
                            removeAddAreaButtons(['the_terrace_carpet_area']);
                        }
                        if (data.amenities != '') {
                            if ((data.amenities).includes("1")) {
                                $('#is_amenities').prop('checked', true).trigger('change')
                                $('.div_amenities_checks').show()
                                var amrr = JSON.parse(data.amenities)
                                for (let i = 0; i < amrr.length; i++) {
                                    $($('.project_amenity')[i]).prop('checked', Number(amrr[i])).trigger('change')
                                }
                            }
                        }

                        if (data.other_industrial_fields != '') {
                            $('#idustrial_fields_container').html('');
                            var amrr = JSON.parse(data.other_industrial_fields)
                            for (let i = 0; i < amrr[0].length; i++) {
                                str =
                                    '<div  class="mb-3 form-check checkbox  checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20"><input class="form-check-input extra_industrial_field" id="' +
                                    amrr[2][i] + '" ' + ((Number(amrr[0][i])) ? 'checked' : '') +
                                    ' type="checkbox"> <label class="form-check-label" for="' +
                                    amrr[2][i] + '">' +
                                    amrr[3][i] +
                                    '</label> </div>  <div class="mb-3 form-group col-md-9 m-b-20"> <label>' +
                                    amrr[3][i] +
                                    '</label> <input class="form-control extra_industrial_field_remark" name="' +
                                    amrr[2][i] + '"  value="' + amrr[1][i] +
                                    '"  type="text" autocomplete="off">  </div>'
                                $('#idustrial_fields_container').append(str)
                                floatingField()
                            }
                        }

                        // if (data.contact_details != '') {
                        //     details = JSON.parse(data.contact_details);
                        //     if ((details != null) && (details.length > 0)) {
                        //         for (let i = 0; i < details.length; i++) {
                        //             id = makeid(10);
                        //             if (i == 0) {
                        //                 $('#all_owner_contacts').append(generate_contact_detail(id, 1))
                        //             } else {
                        //                 $('#all_owner_contacts').append(generate_contact_detail(id, 0))
                        //             }
                        //             floatingField()
                        //             $("[data-contact_id=" + id + "] select[name=owner_status]").select2()
                        //             $("[data-contact_id=" + id + "] input[name=owner_name]").val(details[i][0]);
                        //             $("[data-contact_id=" + id + "] input[name=owner_contact_no]").val(details[i][
                        //                 1
                        //             ]);
                        //             $("[data-contact_id=" + id + "] select[name=owner_status]").val(details[i][2])
                        //                 .trigger('change');
                        //         }
                        //     } else {
                        //         generate_contact_detail_click(1)
                        //     }
                        // }

                        //bharat other contact
                        if (data.other_contact_details != '') {
                            details = JSON.parse(data.other_contact_details);
                            if ((details != null) && (details.length > 0)) {
                                for (let i = 0; i < details.length; i++) {
                                    id = makeid(10);
                                    if (i == 0) {
                                        $('#all_owner_contacts').append(generate_contact_detail(id, 1))
                                    } else {
                                        $('#all_owner_contacts').append(generate_contact_detail(id, 0))
                                    }
                                    floatingField()
                                    $("[data-contact_id=" + id + "] input[name=other_name]").val(details[i][0]);
                                    $("[data-contact_id=" + id + "] input[name=other_contact]").val(details[i][1]);
                                    $("[data-contact_id=" + id + "] input[name=position]").val(details[i][2]);
                                }
                            } else {
                                generate_contact_detail_click(1)
                            }
                        }

                        if (data.unit_details != '') {
                            details = JSON.parse(data.unit_details);
                            if ((details != null) && (details.length > 0)) {
                                for (let i = 0; i < details.length; i++) {
                                    id = makeid(10);
                                    if (i == 0) {
                                        $('#all_units').append(generate_unit_detail(id, 1))
                                    } else {
                                        $('#all_units').append(generate_unit_detail(id, 0))
                                    }

                                    $('#all_units').append(generate_furnished_detail(id));
                                    setFurnishedStatus('', id);
                                    $("#all_units .touchspin25").each(function(index) {
                                        $(this).addClass('touchspin')
                                        $(this).removeClass('touchspin25')
                                    });
                                    $("#all_units .remained").each(function(index) {
                                        if ($(this).is('input')) {
                                            $(this).attr('id', $(this).attr('id') + id)
                                            $(this).removeClass('remained')
                                        }
                                        if ($(this).is('label')) {
                                            $(this).attr('for', $(this).attr('for') + id)
                                            $(this).removeClass('remained')
                                        }
                                    });
                                    enableTouchspin();
                                    setSellRentBoth();

                                    floatingField()
                                    $("[data-unit_id=" + id + "] select[name=unit_status]").select2()
                                    $("[data-unit_id=" + id + "] select[name=furnished_status]").select2()
                                    $("[data-unit_id=" + id + "] input[name=wing]").val(details[i][0]);
                                    $("[data-unit_id=" + id + "] input[name=unit_unit_no]").val(details[i][1]);
                                    $("[data-unit_id=" + id + "] select[name=unit_status]").val(details[i][2])
                                        .trigger('change');
                                    $("[data-unit_id=" + id + "] input[name=price]").val(details[i][3]);
                                    $("[data-unit_id=" + id + "] input[name=price_rent]").val(details[i][4]);
                                    $("[data-unit_id=" + id + "] input[name=price_constructed]").val(details[i][5]);
                                    $("[data-unit_id=" + id + "] input[name=price_plot]").val(details[i][6]);
                                    $("[data-unit_id=" + id + "] input[name=price_total]").val(details[i][7]);
                                    $("[data-unit_id=" + id + "] select[name=furnished_status]").val(details[i][8])
                                        .trigger('change');

                                    if (Array.isArray(details[i][9])) {
                                        for (let v = 0; v < details[i][9].length; v++) {
                                            $($(".furnished_type_item[data-unit_id=" + id + "] ")[v]).val(details[i]
                                                [9][v])
                                        }
                                    }
                                    if (Array.isArray(details[i][10])) {
                                        for (let c = 0; c < details[i][10].length; c++) {
                                            $($(".furnished_type2_item[data-unit_id=" + id + "]")[c]).prop(
                                                'checked', Number(details[i][10][c]))
                                        }
                                    }

                                }
                            } else {
                                generate_unit_detail_click(1);
                            }
                        }

                        triggerChangeinput()
                        floatingField();
                    }
                });
            }
            getProperty()

            console.log("outide farmConf", farmConf);
            //save property
            $(document).on('click', '.submitFnl', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
                    return
                }
                let allFieldsValid = true;

                console.log("third final clicked");
                // $(this).prop('disabled', true);
                var owner_details = [];
                var unit_details = [];
                var amenity_details = [];
                var other_contact_details = [];

                $("#modal_form [name=owner_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).closest('.form-group').attr('data-contact_id');
                    name = $(this).val();
                    console.log("name owner ", name);
                    contact = $("[data-contact_id=" + unique_id + "] input[name=owner_contact_no]").val();
                    cona_arr.push(name)
                    cona_arr.push(contact)
                    if (filtercona_arr(cona_arr)) {
                        owner_details.push(cona_arr);
                    }
                });
                owner_details = JSON.stringify(owner_details);
                // other_contact_details
                $("#modal_form [name=other_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).closest('.form-group').attr('data-contact_id');
                    name = $(this).val();
                    otherName = $("[data-contact_id=" + unique_id + "] input[name=other_name]").val();
                    otherContact = $("[data-contact_id=" + unique_id + "] input[name=other_contact]").val();
                    position = $("[data-contact_id=" + unique_id + "] input[name=position]").val();
                    // if (otherName.trim() === "") {
                    //     $("#other_name_error_" + unique_id).text("other name field is required").show();
                    //     allFieldsValid = false;
                    // } else {
                    //     $("#other_name_error_" + unique_id).hide();
                    //     console.log("1");
                    //     // allFieldsValid = true;
                    // }
                    // if (position.trim() === "") {
                    //     $("#position_error_" + unique_id).text("position field is required").show();
                    //     allFieldsValid = false;
                    // } else {
                    //     $("#position_error_" + unique_id).hide();
                    //     // allFieldsValid = true;
                    //     console.log("2");

                    // }
                    // if (otherContact.trim() === "") {
                    //     $("#other_contact_error_" + unique_id).text("contact field is required").show();
                    //     allFieldsValid = false;

                    // } else {
                    //     $("#other_contact_error_" + unique_id).hide();
                    //     // allFieldsValid = true;
                    //     console.log("3");

                    // }
                    cona_arr.push(otherName)
                    cona_arr.push(otherContact)
                    cona_arr.push(position)
                    if (filtercona_arr(cona_arr)) {
                        other_contact_details.push(cona_arr);
                    }
                });
                other_contact_details = JSON.stringify(other_contact_details);



                $("#modal_form [name=unit_unit_no]").each(function(index) {
                    let cona_arr = [];
                    let unique_id = $(this).closest('.form-group').attr('data-unit_id');
                    let name = $(this).val();
                    let furnisheditem = [];
                    let furnisheditem2 = [];
                    let wing = $("[data-unit_id=" + unique_id + "] input[name=wing]").val();
                    let unit = $("[data-unit_id=" + unique_id + "] input[name=unit_unit_no]").val();
                    status = $("[data-unit_id=" + unique_id + "] select[name=unit_status]").val();
                    price = $("[data-unit_id=" + unique_id + "] input[name=price]").val();
                    pricerent = $("[data-unit_id=" + unique_id + "] input[name=price_rent]").val();
                    priceconstructed = $("[data-unit_id=" + unique_id + "] input[name=price_constructed]")
                        .val();
                    priceplot = $("[data-unit_id=" + unique_id + "] input[name=price_plot]").val();
                    pricetotal = $("[data-unit_id=" + unique_id + "] input[name=price_total]").val();
                    furnished = $("[data-unit_id=" + unique_id + "] select[name=furnished_status]").val();
                    $(".furnished_type_item[data-unit_id=" + unique_id + "]").each(function() {
                        furnisheditem.push($(this).val());
                    })
                    $(".furnished_type2_item[data-unit_id=" + unique_id + "]").each(function() {
                        furnisheditem2.push(Number($(this).prop('checked')));
                    })

                    // if (!plotConf && (!landCategory && pricerent.trim() === "")) {
                    //     console.log("44");
                    //     $("#price_rent_error_" + unique_id).text("price rent field is required").show();
                    //     allFieldsValid = false;
                    // } else {
                    //     $("#price_rent_error_" + unique_id).hide();
                    //     console.log("4");
                    // }

                    // if (!plotConf && !storageCategory && !landCategory && furnished.trim() === "") {
                    //     console.log("55");
                    //     $("#furnished_status_error_" + unique_id).text("furnished field is required").show();
                    //     allFieldsValid = false;
                    // } else {
                    //     $("#furnished_status_error_" + unique_id).hide();
                    //     console.log("5");
                    // }

                    // if (penthouseConf || retailConfiguration || flateConfiguration || officeConf ||
                    //     storageConfiguration) {
                    //     console.log(":is not farm, vila, plot", penthouseConf, retailConfiguration,
                    //         flateConfiguration, officeConf, landCategory);
                    //     if (wing.trim() === "") {
                    //         console.log("66");
                    //         $("#wing_no_error_" + unique_id).text("Wing field is required").show();
                    //         allFieldsValid = false;
                    //     } else {
                    //         $("#wing_no_error_" + unique_id).hide();
                    //         console.log("6");
                    //     }
                    // } else {
                    //     console.log("wing else  :");
                    // }

                    if (!landCategory && unit.trim() === "") {
                        console.log("77");
                        $("#unit_no__error_" + unique_id).text("unit field is required").show();
                        allFieldsValid = false;
                    } else {
                        $("#unit_no__error_" + unique_id).hide();
                        console.log("7");

                    }


                    cona_arr.push(wing)
                    cona_arr.push(name)
                    cona_arr.push(status)
                    cona_arr.push(price)
                    cona_arr.push(pricerent)
                    cona_arr.push(priceconstructed)
                    cona_arr.push(priceplot)
                    cona_arr.push(pricetotal)
                    cona_arr.push(furnished)
                    cona_arr.push(furnisheditem)
                    cona_arr.push(furnisheditem2)
                    if (filtercona_arr(cona_arr)) {
                        unit_details.push(cona_arr);
                    }
                });
                unit_details = JSON.stringify(unit_details);
                project_amenity = [];
                extra_industrial_fields = [];
                extra_industrial_fields_remarks = [];
                extra_industrial_fields_ids = [];
                extra_industrial_fields_labels = [];
                $(".project_amenity").each(function() {
                    project_amenity.push(Number($(this).prop('checked')));
                })
                $(".extra_industrial_field").each(function() {
                    extra_industrial_fields.push(Number($(this).prop('checked')));
                    extra_industrial_fields_ids.push($(this).attr('id'));
                    extra_industrial_fields_labels.push($('label[for=' + $(this).attr('id') + ']').html());
                })
                $(".extra_industrial_field_remark").each(function() {
                    extra_industrial_fields_remarks.push($(this).val());
                })
                all_extra_industrial_fields = [extra_industrial_fields, extra_industrial_fields_remarks,
                    extra_industrial_fields_ids, extra_industrial_fields_labels
                ];

                var configuration = '';

                if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                    var configuration = $('input[name=office_type]:checked').val()
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Land') {
                    var configuration = $('input[name=plot_type]:checked').val()
                    //
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Flat') {
                    var configuration = $('input[name=flat_type]:checked').val()
                    //
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                    var configuration = $('input[name=retail_type]:checked').val()
                    //
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Storage/industrial') {
                    var configuration = $('input[name=storage_type]:checked').val()
                    //
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Penthouse') {
                    var configuration = $('input[name=flat_type]:checked').val()
                    //
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Vila/Bunglow') {
                    var configuration = $('input[name=vila_type]:checked').val()
                    //
                }
                var other_name = $("input[id='other_name']")
                    .map(function() {
                        return $(this).val();
                    }).get();
                var other_contact = $("input[id='other_contact']")
                    .map(function() {
                        return $(this).val();
                    }).get();
                var position = $("input[id='position']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                var id = $('#this_data_id').val()
                $('.add-btn').click(function() {
                    $('.increment').append('<input type="file" name="const_documents[]" class="form-control">');
                });

                if ($("#owner_info_name").val().trim() === "") {
                    $("#owner_info_name_error").text("owner's name field is required").show();
                    allFieldsValid = false;
                } else {
                    $("#owner_info_name_error").hide();
                    // allFieldsValid = true;
                }

                if ($("#owner_contact_specific_no").val().trim() === "") {
                    $("#owner_contact_specific_no_error").text("contact field is required").show();
                    allFieldsValid = false;

                } else {
                    $("#owner_contact_specific_no_error").hide();
                    // allFieldsValid = true;
                }

                if ($("#property_email").val().trim() === "") {
                    $("#property_email_error").text("Email field is required").show();
                    allFieldsValid = false;
                } else {
                    // Check if the entered email format is valid
                    var email = $("#property_email").val().trim();
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(email)) {
                        $("#property_email_error").text("Please enter a valid email address").show();
                        allFieldsValid = false;
                    } else {
                        $("#property_email_error").hide();
                    }
                }

                // if ($("#key_arrangement").val().trim() === "") {
                //     $("#key_arrangement_error").text("key field is required").show();
                // } else {
                //     $("#key_arrangement_error").hide();
                // }

                if (!allFieldsValid) {
                    console.log("error validation on all field :", allFieldsValid);
                    return
                } else {
                    console.log("success run :", allFieldsValid);
                }

                // save property
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveProperty') }}",
                    data: {
                        id: id,
                        property_for: $('input[name=property_for]:checked').val(),
                        property_type: $('input[name=property_type]:checked').val(),
                        property_category: $('input[name=property_category]:checked').val(),
                        configuration: configuration,
                        project_id: $('#project_id').val(),
                        city_id: $('#state-dropdown').val(),
                        locality_id: $('#area_id').val(),
                        address: $('#address').val(),
                        property_link: $('#property_link').val(),
                        district_id: $('#district_id').val(),
                        taluka_id: $('#taluka_id').val(),
                        village_id: $('#village_id').val(),
                        res_more: $('#txt5moreFlate').val() !== "" ? $('#txt5moreFlate').val() : $(
                            '#txt5moreVilla').val(),
                        zone_id: $('#zone').val(),
                        constructed_carpet_area: $('#constructed_carpet_area').val() + '_-||-_' + $(
                            '#constructed_carpet_area_measurement').val(),
                        constructed_salable_area: $('#constructed_salable_area').val() + '_-||-_' + $(
                            '#constructed_salable_area_measurement').val(),
                        constructed_builtup_area: $('#constructed_builtup_area').val() + '_-||-_' + $(
                            '#constructed_builtup_area_measurement').val(),
                        salable_plot_area: $('#salable_plot_area').val() + '_-||-_' + $(
                            '#salable_plot_area_measurement').val(),
                        carpet_plot_area: $('#carpet_plot_area').val() + '_-||-_' + $(
                            '#carpet_plot_area_measurement').val(),
                        salable_area: $('#salable_area').val() + '_-||-_' + $('#salable_area_measurement')
                            .val(),
                        carpet_area: $('#carpet_area').val() + '_-||-_' + $('#carpet_area_measurement').val(),
                        storage_centre_height: $('#storage_centre_height').val() + '_-||-_' + $(
                            '#storage_centre_height_measurement').val(),
                        length_of_plot: $('#length_of_plot').val() + '_-||-_' + $('#length_of_plot_measurement')
                            .val(),
                        width_of_plot: $('#width_of_plot').val() + '_-||-_' + $('#width_of_plot_measurement')
                            .val(),
                        entrance_width: $('#entrance_width').val() + '_-||-_' + $('#entrance_width_measurement')
                            .val(),
                        ceiling_height: $('#ceiling_height').val() + '_-||-_' + $('#ceiling_height_measurement')
                            .val(),
                        builtup_area: $('#builtup_area').val() + '_-||-_' + $('#builtup_area_measurement')
                            .val(),
                        plot_area: $('#plot_area').val() + '_-||-_' + $('#plot_area_measurement').val(),
                        terrace: $('#terrace').val() + '_-||-_' + $('#terrace_measurement').val(),
                        construction_area: $('#construction_area').val() + '_-||-_' + $(
                            '#construction_area_measurement').val(),
                        terrace_carpet_area: $('#terrace_carpet_area').val() + '_-||-_' + $(
                            '#terrace_carpet_area_measurement').val(),
                        terrace_salable_area: $('#terrace_salable_area').val() + '_-||-_' + $(
                            '#terrace_salable_area_measurement').val(),
                        total_units_in_project: $('#total_units_in_project').val(),
                        total_no_of_floor: $('#total_no_of_floor').val(),
                        total_units_in_tower: $('#total_units_in_tower').val(),
                        property_on_floors: $('#property_on_floors').val(),
                        no_of_elavators: $('#no_of_elavators').val(),
                        no_of_balcony: $('#no_of_balcony').val(),
                        total_no_of_units: $('#total_no_of_units').val(),
                        no_of_room: $('#no_of_room').val(),
                        no_of_bathrooms: $('#no_of_bathrooms').val(),
                        no_of_floors_allowed: $('#no_of_floors_allowed').val(),
                        no_of_side_open: $('#no_of_side_open').val(),
                        service_elavator: Number($('#service_elavator').prop('checked')),
                        servant_room: Number($('#servant_room').prop('checked')),
                        hot_property: Number($('#hot_property').prop('checked')),
                        is_favourite: Number($('#is_favourite').prop('checked')),
                        is_terrace: Number($('#is_terrace').prop('checked')),
                        washrooms2_type: $('input[name=washrooms2_type]:checked').val(),
                        is_pre_leased: Number($('#is_pre_leased').prop('checked')),
                        front_road_width: $('#front_road_width').val() + '_-||-_' + $(
                            '#front_road_width_measurement').val(),
                        construction_allowed_for: $('#construction_allowed_for').val(),
                        construction_documents: $('#construction_documents').val(),
                        fsi: $('#fsi').val(),
                        no_of_borewell: $('#no_of_borewell').val(),
                        fourwheller_parking: $('#fourwheller_parking').val(),
                        twowheeler_parking: $('#twowheeler_parking').val(),
                        pre_leased_remarks: $('#pre_leased_remarks').val(),
                        Property_priority: $('#Property_priority').val(),
                        property_source: $('#property_source').val(),
                        refrence: $('#refrence').val(),
                        availability_status: $('input[name=availability_status]:checked').val(),
                        available_from: $('#available_from').val(),
                        propertyage: $('input[name=propertyage]:checked').val(),
                        amenities: JSON.stringify(project_amenity),
                        two_road_corner: Number($('#two_road_corner').prop('checked')),
                        unit_details: unit_details,
                        survey_number: $('#survey_number').val(),
                        survey_plot_size: $('#plot_size').val() + '_-||-_' + $('#survey_plot_measurement')
                            .val(),
                        survey_price: $('#price').val(),
                        fp_plot_price: $('#price2').val(),
                        tp_number: $('#tp_number').val(),
                        fp_number: $('#fp_number').val(),
                        fp_plot_size: $('#plot2_size').val() + '_-||-_' + $('#plot2_measurement').val(),
                        owner_is: $('#owner_is').val(),
                        other_industrial_fields: JSON.stringify(all_extra_industrial_fields),
                        owner_name: $('#owner_info_name').val(),
                        owner_contact: $('#owner_contact_specific_no').val(),
                        owner_email: $('#property_email').val(),
                        owner_nri: Number($('#is_nri').prop('checked')),
                        contact_details: owner_details,
                        care_taker_name: $('#care_take_name').val(),
                        care_taker_contact: $('#care_take_contact_no').val(),
                        key_available_at: $('#key_arrangement').val(),
                        conference_room: $('input[name=conference_available]:checked').val(),
                        reception_area: $('input[name=reception_available]:checked').val(),
                        pantry_type: $('input[name=pantry_available]:checked').val(),
                        _token: '{{ csrf_token() }}',
                        remarks: $('#remarks').val(),
                        state_id: $('#state_id').val(),
                        other_name: other_name,
                        other_contact: other_contact,
                        position: position,
                        other_contact_details: other_contact_details,
                        // is_key: is_key
                    },
                    success: function(data) {
                        console.log("data fnl after prop ==", data.data);
                        if (data.data != '') {
                            let fd = new FormData();
                            let filesImages = $('#land_images')[0].files;
                            let filesDocuments = $('#land_document')[0].files;
                            let construction_docs = document.getElementsByName("const_documents[]");
                            let files = [];

                            for (let i = 0; i < construction_docs.length; i++) {
                                if (construction_docs[i].files.length > 0) {
                                    for (let j = 0; j < construction_docs[i].files.length; j++) {
                                        files.push(construction_docs[i].files[j]);
                                    }
                                }
                            }

                            $("select[name='const_doc_type[]']").each(function() {
                                var selectedValue = $(this).val();
                                fd.append('const_doc_type[]', selectedValue);
                            });

                            if (filesImages.length == 0 || construction_docs
                                .length == 0) {
                                let propertyCategory = data.data.property_category;
                                if (propertyCategory === '262' || propertyCategory === '256') {
                                    window.location.href = "{{ route('admin.land.properties') }}";
                                } else if (propertyCategory === '261') {
                                    window.location.href = "{{ route('admin.industrial.properties') }}";
                                } else {
                                    window.location.href = "{{ route('admin.properties') }}";
                                }
                                property_image.innerHTML = 'Property Image is required.';
                            }
                            if (filesImages.length > 0) {
                                for (let i = 0; i < filesImages.length; i++) {
                                    fd.append('images[]', filesImages[i]);
                                }
                            }
                            if (files.length > 0) {
                                for (let i = 0; i < files.length; i++) {
                                    fd.append('construction_docs[]', files[i]);
                                }
                            }
                            if (filesDocuments.length > 0) {
                                for (let i = 0; i < filesDocuments.length; i++) {
                                    fd.append('documents[]', filesDocuments[i]);
                                }
                            }

                            fd.append('land_id', $('#this_data_id').val());
                            fd.append('pro_id', data.data.id);
                            fd.append('_token', '{{ csrf_token() }}');
                            console.log("fdd ==", fd);
                            // return;
                            $.ajax({
                                url: "{{ route('admin.saveLandImages') }}",
                                type: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log("Response ==", response);
                                    $('#all_images').html('');
                                    $('#land_images').val('');
                                    $('#land_document').val('');
                                    if (response != '') {
                                        function isImageFile(fileType) {
                                            var imageExtensions = ['jpg', 'jpeg', 'png', 'gif',
                                                'bmp'
                                            ];
                                            return imageExtensions.includes(fileType);
                                        }
                                        $('#propertyModal').modal('hide');
                                        setTimeout(function() {
                                            let propertyCategory = data.data
                                                .property_category;
                                            if (propertyCategory === '262' ||
                                                propertyCategory === '256') {
                                                window.location.href =
                                                    "{{ route('admin.land.properties') }}";
                                            } else if (propertyCategory === '261') {
                                                window.location.href =
                                                    "{{ route('admin.industrial.properties') }}";
                                            } else {
                                                window.location.href =
                                                    "{{ route('admin.properties') }}";
                                            }
                                        }, 2000);
                                    }
                                },
                            });
                        }
                        // $('#propertyModal').modal('hide');
                        // var redirect_url = "{{ route('admin.properties') }}";
                        // window.location.href = redirect_url;
                        // $('#saveProperty').prop('disabled',false);
                    }
                });
            })

            var uploadImageField = document.getElementById("land_images");
            var uploadDocumentField = document.getElementById("land_document");

            var maxImageCount = 10;
            var maxImageSize = 2097152;
            var maxDocumentSize = 2097152;

            uploadImageField.onchange = function() {
                if (this.files.length > maxImageCount) {
                    this.value = '';
                    Swal.fire({
                        title: "Maximum image count limit is " + maxImageCount,
                        icon: "warning",
                    });
                }
            };

            uploadDocumentField.onchange = function() {
                var totalSize = 0;
                for (var i = 0; i < this.files.length; i++) {
                    totalSize += this.files[i].size;
                }
                if (totalSize >= maxDocumentSize) {
                    this.value = '';
                    Swal.fire({
                        title: "Total size of all documents exceeds the maximum limit of 10 MB",
                        icon: "warning",
                    });
                }
            };

            function isImageFile(fileType) {
                var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                return imageExtensions.includes(fileType);
            }

            $(document).on('change', '#property_type', function(e) {
                var parent_value = $(this).val();
                $("#specific_type option , #configuration option").each(function() {
                    if (parent_value !== '') {
                        if ($(this).attr('value') != '') {
                            if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                                parent_value) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        }
                    } else {
                        $(this).show();
                    }
                });
            });

            $(document).on('change', '#filter_property_type', function(e) {
                var parent_value = $(this).val();
                $("#filter_specific_type option , #filter_configuration option").each(function() {
                    if (parent_value !== '') {
                        if ($(this).attr('value') != '') {
                            if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                                parent_value) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        }
                    } else {
                        $(this).show();
                    }
                });
            });

            function isImageFile(fileName) {
                var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                var extension = fileName.split('.').pop().toLowerCase();
                return imageExtensions.includes(extension);
            }

            $(document).on('change', '#land_images', function() {
                var fileName = this.files[0].name.toLowerCase();

                if (!isImageFile(fileName)) {
                    $(this).val(''); // Clear the input field
                    Swal.fire({
                        title: "Only image files are supported for images.",
                        icon: "warning",
                    });
                }
            });

            $(document).on('change', '#land_document', function() {
                var fileType = this.files[0].type.toLowerCase();
                var fileName = this.files[0].name.toLowerCase();
                var fileExtensions = ["pdf", "xlsx", "xls", "docx", "doc", "pptx", "ppt"];

                var fileExtension = fileName.split(".").pop();

                if (fileExtensions.includes(fileExtension) || (fileType === 'application/pdf' || fileType.includes(
                        'excel'))) {
                    // The selected file has a valid extension or MIME type
                    // You can proceed with your logic here
                } else {
                    $(this).val(''); // Clear the input field
                    Swal.fire({
                        title: "Only Document files are supported.",
                        icon: "warning",
                    });
                }
            });

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

                $("form select").each(function(index) {
                    var attrs = $(this).attr('multiple');
                    if (typeof attrs === 'undefined' || attrs === false) {
                        $(this).find('option:first').attr('selected', 'selected')
                        // $(this).find('option:first').attr('disabled', 'disabled')
                    }
                    $(this).select2();
                })
            }

            function isPDFExcelWordFile(fileType) {
                var allowedTypes = ["application/pdf", "application/vnd.ms-excel",
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/msword",
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                ];
                return allowedTypes.includes(fileType);
            }

            $(document).on('click', '.previousBtn1', function() {
                $("#profile-step").hide();
                $("#step1").removeClass("btn-primary");
                $("#step0").addClass("btn-primary");
                $("#information-step").show();
            })
            $(document).on('click', '.previousBtn2', function() {
                $("#unit-owner-step").hide();
                $("#step2").removeClass("btn-primary");
                $("#step1").addClass("btn-primary");
                $("#profile-step").show();
            })
            //cl-locality
            const urlParams = new URLSearchParams(window.location.search);
            const param_x = urlParams.get('view');
            if (param_x != null) {
                $("#step" + param_x).addClass("btn-primary");
                $("#step0").removeClass("btn-primary");
            }
            //terece
            $(document).on('click', "#is_terrace", function() {
                if ($("#is_terrace").prop("checked") == true) {
                    $(".the_terrace_salable_area").show();
                    addAddAreaButtons(['the_terrace_carpet_area'], ['Add Terrace Carpet Area']);
                } else {
                    $(".the_terrace_salable_area").hide();
                    $(".the_terrace_carpet_area").hide();
                    removeAddAreaButtons(['the_terrace_carpet_area']);
                }
            });
            $(document).on('click', '.rm-other', function() {
                var currentId = this.id;
                $('.rm-' + currentId).remove();
            });
        </script>
    @endpush
