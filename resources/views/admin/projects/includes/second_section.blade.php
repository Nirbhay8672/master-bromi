<div class="setup-content d-none" id="contact-wing">
    <div class="col-xs-12">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div>
                        <label><b>Property Type</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input filled" id="propertytype85" type="radio" name="property_type" data-val="Commercial" value="85" x-model="property_type" @click="changePropertyType()" checked="" data-bs-original-title="" title="">
                            <label class="form-check-label mb-0" for="propertytype85">Commercial</label>
                        </div>
                        <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input filled" id="propertytype87" type="radio" name="property_type" data-val="Residential" value="87" x-model="property_type" @click="changePropertyType()" data-bs-original-title="" title="">
                            <label class="form-check-label mb-0" for="propertytype87">Residential</label>
                        </div>
                        <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input filled" type="radio" id="property_type_88" name="property_type_88" x-model="property_type" value="88" @click="changePropertyType()" data-bs-original-title="" title="">
                            <label class="form-check-label mb-0" for="property_type_88">Office & Retail</label>
                        </div>
                        <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input filled" type="radio" id="property_type_89" name="property_type_89" x-model="property_type" value="89" @click="changePropertyType()" data-bs-original-title="" title="">
                            <label class="form-check-label mb-0" for="property_type_89">Residential & Commercial</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-danger new_error d-none" id="err_property_type">Property type is required.</span>
                        <input type="hidden" :class="errors.hasOwnProperty('propery_type') ? 'is-invalid' : ''">
                        <div class="invalid-feedback">
                            <span x-text="errors.propery_type"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" x-show="property_type==85 || property_type==87">
                <div class="col-md-12 mb-2">
                    <div>
                        <label><b>Category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml" :class="errors.hasOwnProperty('property_category') ? 'is-invalid' : ''">
                        @forelse ($property_configuration_settings as $props)
                            @if ( ($props['dropdown_for'] == 'property_specific_type') && $props['id'] != '262') 
                                <div class="btn-group bromi-checkbox-btn me-1"
                                    role="group" 
                                    aria-label="Basic radio toggle button group">
                                    <input type="radio"
                                        data-parent_id="{{ $props['parent_id'] }}"
                                        class="btn-check"
                                        value="{{ $props['id'] }}"
                                        data-val="{{ $props['name'] }}"
                                        name="property_category"
                                        x-model="property_category"
                                        id="category-{{ $props['id'] }}"
                                        data-error="#property_category_error"
                                        @click="categoryChange"
                                        {{ ($props['name'] == "Office") ? "checked" : "" }}
                                    >
                                    <label
                                        class="btn btn-outline-primary btn-pill btn-sm py-1"
                                        for="category-{{ $props['id'] }}">{{ $props['name'] }}</label>
                                </div>
                            @endif
                        @empty
                        @endforelse
                    </div>
                    <span class="text-danger new_error d-none" id="err_property_category">Property category is required.</span>
                    <div class="invalid-feedback">
                        <span x-text="errors.property_category"></span>
                    </div>
                </div>
            </div>

            <div class="row" x-show="property_type=='88'">
                <div class="row">
                    <div class="form-group col-md-12">
                        <h5 class="border-style">Office</h5>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div>
                            <label><b>Sub category</b></label>
                        </div>
                        <div class="m-checkbox-inline custom-radio-ml">
                            <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" value="35" id="extraofficeekind1" x-model="sub_category_single" name="sub_category_single" data-bs-original-title="" title="">
                                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraofficeekind1">office space</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" x-show="sub_category_single != ''">
                        <div>
                            <label><b>Tower Details</b></label>
                            <span class="d-none" x-text="nexttickForFirstCondition()"></span>
                        </div>
                        <div class="form-group col-md-2 m-b-20">
                            <div class="fname" :class="if_office_or_retail.number_of_tower == '' ? '' : 'focused' ">
                                <label>No. of Towers</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control" name="first_number_of_tower"
                                        type="text"
                                        id="88_if_office_or_retail_number_of_tower"
                                        x-model="if_office_or_retail.number_of_tower"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_88_if_office_or_retail_number_of_tower">Number of tower is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-20">
                            <div class="fname" :class="if_office_or_retail.number_of_floor == '' ? '' : 'focused' ">
                                <label>No. of Floors</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        name="first_number_of_floors"
                                        id="88_if_office_or_retail_number_of_floor"
                                        type="text"
                                        x-model="if_office_or_retail.number_of_floor"
                                        autocomplete="off"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_88_if_office_or_retail_number_of_floor">Number of floor is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-20">
                            <div class="fname" :class="if_office_or_retail.number_of_unit_each_block == '' ? '' : 'focused' ">
                                <label>No. of Unit each tower </label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        name="first_number_of_unit_each_block"
                                        id="88_if_office_or_retail_number_of_unit_each_block"
                                        x-model="if_office_or_retail.number_of_unit_each_block"
                                        type="text"
                                        autocomplete="off"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_88_if_office_or_retail_number_of_unit_each_block">Number of units is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-20">
                            <div class="fname" :class="if_office_or_retail.number_of_lift == '' ? '' : 'focused' ">
                                <label>No. of Lift </label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        x-model="if_office_or_retail.number_of_lift"
                                        name="first_number_of_lift"
                                        type="text"
                                        autocomplete="off"
                                        id="88_if_office_or_retail_number_of_lift"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_88_if_office_or_retail_number_of_lift">Number of lift is required.</span>
                            </div>
                        </div>

                        <div class="form-group col-md-5 m-b-5">
                            <div class="input-group">
                                <div class="form-group col-md-7 m-b-20">
                                    <div class="fname" :class="if_office_or_retail.front_road_width == '' ? '' : 'focused' ">
                                        <label class="mb-0">Front Road Width</label>
                                        <div class="fvalue">
                                            <input
                                                class="form-control"
                                                name="road_width"
                                                type="text"
                                                x-model="if_office_or_retail.front_road_width"
                                                autocomplete="off"
                                                id="88_if_office_or_retail_front_road_width"
                                            >
                                        </div>
                                        <span class="text-danger new_error d-none" id="err_88_if_office_or_retail_front_road_width">Front road width is required.</span>
                                    </div>
                                </div>
                                <div class="input-group-append col-md-5 m-b-20">
                                    <div class="form-group form_measurement">
                                        <select class="form-select form_measurement measure_select" name="road_width_select" id="second_front_road_map_unit_select">
                                            <option selected="selected" value="1">Ft.</option>
                                            <option value="3">Meter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-checkbox-inline">
                            <label><b>Washroom</b></label>
                            <div class="form-check form-check-inline radio radio-primary">
                                <input
                                    type="radio"
                                    id="private"
                                    name="washroom"
                                    x-model="if_office_or_retail.washroom"
                                    value="private"
                                >
                                <label for="private">Private</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-primary">
                                <input
                                    type="radio"
                                    id="public"
                                    name="washroom"
                                    value="public"
                                    x-model="if_office_or_retail.washroom"
                                >
                                <label for="public">Public</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check checkbox checkbox-solid-success col-md-6">
                                <input class="form-check-input" id="two_road_corner" x-model="if_office_or_retail.is_two_corner" name="two_road_corner" type="checkbox">
                                <label class="form-check-label" for="two_road_corner">Two road corner.</label>
                            </div>
                        </div>
                    </div>

                    <div x-show="sub_category_single != ''">
                        <template x-for="(tower_detail, index) in if_office_tower_details">
                            <div class="row">
                                <div class="mb-2">
                                    <hr>
                                    <span x-text="nextTickForTowerDetails()" class="d-none"></span>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <div class="fname" :class="tower_detail.tower_name == '' ? '' : 'focused' ">
                                        <label>Tower Name</label>
                                        <div class="fvalue">
                                            <input class="form-control" name="tower_name" x-model="tower_detail.tower_name" type="text" autocomplete="off" data-bs-original-title="" title="">
                                        </div>
                                        <span class="text-danger new_error d-none" :id="`err_88_tower_detail_tower_name_${index}`">Tower name is required.</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <div class="fname" :class="tower_detail.total_unit == '' ? '' : 'focused' ">
                                        <label>Total Units</label>
                                        <div class="fvalue">
                                            <input
                                                class="form-control"
                                                x-model="tower_detail.total_unit"
                                                name="total_units"
                                                type="text"
                                                autocomplete="off"
                                            >
                                        </div>
                                        <span class="text-danger new_error d-none" :id="`err_88_tower_detail_total_unit_${index}`">Total unit is required.</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Saleable Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.saleable == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.saleable"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_tower_detail_saleable_${index}`">Saleable from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.saleable_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.saleable_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_tower_detail_saleable_to_${index}`">Saleable to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`second_tower_detail_saleable_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                                @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-auto mb-3">
                                        <a
                                            class="add_constructed_carpet_area" style="color:#0078DB!important"
                                            @click="tower_detail.is_carpet = !tower_detail.is_carpet" href="javascript:void(0)"> <span x-text="tower_detail.is_carpet ? '- Remove Carpet Area' : '+ Add Carpet Area'"></span> 
                                        </a>
                                    </div>

                                    <div class="form-group col-md-auto mb-3">
                                        <a
                                            class="add_constructed_carpet_area" style="color:#0078DB!important"
                                            @click="tower_detail.is_built_up = !tower_detail.is_built_up" href="javascript:void(0)"> <span x-text="tower_detail.is_built_up ? '- Remove BuiltUp Area' : '+ Add BuiltUp Area'"></span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row" x-show="tower_detail.is_carpet">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Carpet Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.carpet == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.carpet"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_tower_detail_carpet_${index}`">Carpet from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.carpet_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.carpet_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_tower_detail_carpet_to_${index}`">Carpet to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`second_tower_detail_carpet_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" x-show="tower_detail.is_built_up">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Builtup Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.built_up == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.built_up"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_tower_detail_built_up_${index}`">Built up from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.built_up_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.built_up_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_tower_detail_built_up_to_${index}`">Built up to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`second_tower_detail_built_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div class="row" x-show="if_office_or_retail.number_of_tower > 1">
                            <div class="form-check checkbox  checkbox-solid-success col-md-6 m-b-20">
                                <input
                                    class="form-check-input"
                                    id="tower_with_specification"
                                    x-model="if_office_tower_details_with_specification"
                                    name="tower_with_specification"
                                    type="checkbox"
                                    @click="towerWithSpecification()"
                                >
                                <label class="form-check-label" for="tower_with_specification">Towers with a different specification.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" x-show="property_type=='89'">
                <div class="row">
                    <div class="form-group col-md-12">
                        <h5 class="border-style">Flat / Penthouse</h5>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-12 mb-1">
                            <div>
                                <label><b>Sub category</b></label>
                            </div>
                            <div class="m-checkbox-inline custom-radio-ml">
                                <div class="the_1rk btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check filled" value="13" x-model="sub_categories" @click="addWingSubCategory($event,'1 rk')" id="extraflatkind1" name="excat" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind1">1 rk</label>
                                </div>
                                <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check" value="14" id="extraflatkind2" x-model="sub_categories" name="flat_type[]" @click="addWingSubCategory($event,'1 bhk')" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind2">1bhk</label>
                                </div>
                                <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check" value="15" x-model="sub_categories" id="extraflatkind3" name="flat_type[]" @click="addWingSubCategory($event,'2 bhk')" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind3">2bhk</label>
                                </div>
                                <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check" value="16" x-model="sub_categories" id="extraflatkind4" name="flat_type[]" @click="addWingSubCategory($event,'3 bhk')" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind4">3bhk</label>
                                </div>
                                <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check" value="17" x-model="sub_categories" id="extraflatkind5" name="flat_type[]" @click="addWingSubCategory($event,'4 bhk')" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind5">4bhk</label>
                                </div>
                                <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check" value="18" x-model="sub_categories" id="extraflatkind6" name="flat_type[]" @click="addWingSubCategory($event,'5bhk')" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind6">5bhk</label>
                                </div>
                                <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                                    <input type="checkbox" class="btn-check" value="19" x-model="sub_categories" id="extraflatkind7" name="flat_type[]" @click="addWingSubCategory($event,'5+ bhk')" data-error="#flat_type_error" autocomplete="off" data-bs-original-title="" title="">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="extraflatkind7">5+bhk</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" x-show="sub_categories.includes('19')">
                        <div class="form-group col-md-3 m-b-20">
                            <div class="fname" :class="is_flat_or_penthouse.number_of_room == '' ? '' : 'focused' ">
                                <label>Total Room</label>
                                <input
                                    class="form-control"
                                    x-model="is_flat_or_penthouse.number_of_room"
                                    type="text"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2" x-show="sub_categories.includes('13') || sub_categories.includes('14') || sub_categories.includes('15') || sub_categories.includes('16') || sub_categories.includes('17') || sub_categories.includes('18') || sub_categories.includes('19')">
                        <div class="col-md-2 mb-3">
                            <div class="fname" :class="is_flat_or_penthouse.number_of_towers == '' ? '' : 'focused' ">
                                <label for="Total Floor">No. Of Tower</label>
                                <div class="fvalue">
                                    <input class="form-control" x-model="is_flat_or_penthouse.number_of_towers" type="text" autocomplete="off"
                                    data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_89_flat_number_of_towers">Number of tower is required.</span>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="fname" :class="is_flat_or_penthouse.number_of_floors == '' ? '' : 'focused' ">
                                <label for="Property on floor">No. Of Floors</label>
                                <div class="fvalue">
                                    <input class="form-control" x-model="is_flat_or_penthouse.number_of_floors" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_89_flat_number_of_floors">Number of floor is required.</span>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3 the_total_units_in_tower">
                            <div class="fname" :class="is_flat_or_penthouse.total_units == '' ? '' : 'focused' ">
                                <label for="Total Floor">Total Units</label>
                                <div class="fvalue">
                                    <input class="form-control" x-model="is_flat_or_penthouse.total_units" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_89_flat_total_units">Total unit is required.</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 the_total_elevator_in_tower">
                            <div class="fname" :class="is_flat_or_penthouse.number_of_elevator == '' ? '' : 'focused' ">
                                <label for="Total Floor">No. of Elevator in each tower</label>
                                <div class="fvalue">
                                    <input class="form-control" x-model="is_flat_or_penthouse.number_of_elevator" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_89_flat_number_of_elevator">Number of elevator is required.</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2" x-show="sub_categories.includes('13') || sub_categories.includes('14') || sub_categories.includes('15') || sub_categories.includes('16') || sub_categories.includes('17') || sub_categories.includes('18') || sub_categories.includes('19')">
                        <template x-for="(wing , index) in if_residential_only_wings.wing_details">
                            <div class="row">
                                <div class="form-group col-md-3 m-b-20">
                                    <span x-text="nextTickForIfResidentialWings()" class="d-none"></span>
                                    <div class="fname" :class="wing.wing_name == '' ? '' : 'focused' ">
                                        <label>Wing Name</label>
                                        <input
                                            class="form-control"
                                            x-model="wing.wing_name"
                                            type="text"
                                            autocomplete="off"
                                            @focusOut="manageWingNameArray()"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_second_res_wing_wing_name_${index}`">Wing name is required.</span>
                                </div>
                                <div class="form-group col-md-2 m-b-20">
                                    <div class="fname" :class="wing.total_total_units == '' ? '' : 'focused' ">
                                        <label>Total Units</label>
                                        <input class="form-control" x-model="wing.total_total_units" type="text" autocomplete="off">
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_second_res_wing_total_total_units_${index}`">Total units is required.</span>
                                </div>
                                <div class="form-group col-md-2 m-b-20">
                                    <div class="fname" :class="wing.total_floors == '' ? '' : 'focused' ">
                                        <label>Total Floor</label>
                                        <input class="form-control" x-model="wing.total_floors" type="text" autocomplete="off">
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_second_res_wing_total_floors_${index}`">Total floor is required.</span>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="fname">
                                        <select class="form-select" :id="`extra_sub_category_of_wings_${index}`" multiple="multiple">
                                            <template x-for="category in sub_category_array">
                                                <option :value="category">
                                                    <span x-text="category"></span>
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_second_res_wing_sub_categories_${index}`">Category is required.</span>
                                </div>
                                <div class="form-group col-md-1 m-b-4 mb-3" x-show="index > 0">
                                    <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" @click="removeWingDetail(index)" title="">-</button>
                                </div>
                                <div class="form-group col-md-1 m-b-4 mb-3" x-show="index == 0">
                                    <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" data-bs-original-title="" @click="addWingDetail()" title="">+</button>
                                </div>
                            </div>
                        </template>
                        
                        <div class="row">
                            <hr>
                            <div>
                                <label><b>Unit Details</b></label>
                                <span class="d-none" x-text="manageWingNameArray()"></span>
                                <span class="d-none" x-text="nextTickForIfResidentialUnits()"></span>
                            </div>
                        </div>
                        <template x-for="(unit , index) in if_residential_only_units.unit_details">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="fname" :class="unit.wing == '' ? '' : 'focused' ">
                                        <select class="form-select form-design" :id="`second_wing_array_${index}`">
                                            <option value="">Wing</option>
                                            <template x-for="wing_name in wings_name_array">
                                                <option :value="wing_name">
                                                    <span x-text="wing_name"></span>
                                                </option>
                                            </template>
                                        </select>
                                        <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_wing_${index}`">Wing name is required.</span>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.saleable == '' ? '' : 'focused' ">
                                                <label class="mb-0">Saleable</label>
                                                <input class="form-control" x-model="unit.saleable" name="saleable_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_saleable_${index}`">Saleable from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.saleable_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Saleable</label>
                                                <input class="form-control" x-model="unit.saleable_to" name="saleable_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_saleable_to_${index}`">Saleable to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`second_saleable_area_select_${index}`">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-auto mb-3">
                                        <a style="color:#0078DB!important" @click="unit.has_built_up = !unit.has_built_up" href="javascript:void(0)" data-bs-original-title="" title=""> <span x-text="unit.has_built_up ? '- Remove Built Up Area' : '+ Add Built Up Area' "></span>
                                        </a>
                                    </div>
                                    <div class="form-group col-md-auto mb-3">
                                        <a style="color:#0078DB!important" @click="unit.has_carpet = !unit.has_carpet" href="javascript:void(0)" data-bs-original-title="" title=""> <span x-text="unit.has_built_up ? '- Remove Carpet Area' : '+ Add Carpet Area' "></span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row mt-2" x-show="unit.has_built_up">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.built_up == '' ? '' : 'focused' ">
                                                <label class="mb-0">Built up Area</label>
                                                <input class="form-control" x-model="unit.built_up" name="built_up_areass" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_built_up_${index}`">Built up is required.</span><span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_built_up_${index}`">Built up is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.built_up_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Built up Area</label>
                                                <input class="form-control" x-model="unit.built_up_to" name="built_up_areass" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_built_up_to_${index}`">Built up to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`second_built_up_area_select_${index}`">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2" x-show="unit.has_carpet">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.carpet_area == '' ? '' : 'focused' ">
                                                <label class="mb-0">Carpet Area</label>
                                                <input class="form-control" x-model="unit.carpet_area" name="carpet_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_carpet_area_${index}`">Carpet area from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.carpet_area_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Carpet Area</label>
                                                <input class="form-control" x-model="unit.carpet_area_to" name="carpet_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_carpet_area_to_${index}`">Carpet area to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`second_carpet_area_select_${index}`">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.wash_area == '' ? '' : 'focused' ">
                                                <label class="mb-0">Wash Area</label>
                                                <input class="form-control" x-model="unit.wash_area" name="wash_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_wash_area_${index}`">Wash area from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.wash_area_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Wash Area</label>
                                                <input class="form-control" x-model="unit.wash_area_to" name="wash_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_wash_area_to_${index}`">Wash area to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`second_wash_area_select_${index}`">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.balcony == '' ? '' : 'focused' ">
                                                <label class="mb-0">Balcony Area</label>
                                                <input class="form-control" x-model="unit.balcony" name="balcony_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_balcony_${index}`">Balcony from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.balcony_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Balcony Area</label>
                                                <input class="form-control" x-model="unit.balcony_to" name="balcony_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_balcony_to_${index}`">Balcony to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`second_balcony_area_select_${index}`">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="form-group col-md-7 m-b-20">
                                            <div class="fname" :class="unit.floor_height == '' ? '' : 'focused' ">
                                                <label class="mb-0">Floor Height</label>
                                                <input class="form-control" x-model="unit.floor_height" name="floor_height" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_second_if_residential_only_units_floor_height_${index}`">floor height is required.</span>
                                        </div>
                                        <div class="input-group-append col-md-5 m-b-20">
                                            <div class="form-group form_measurement">
                                                <select class="form-select form_measurement measure_select" :id="`second_floor_height_select_${index}`">
                                                    <option selected="selected" value="1">Ft.</option>
                                                    <option value="3">Meter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="form-check checkbox  checkbox-solid-success col-md-3 m-b-20">
                                        <input
                                            class="project_amenity form-check-input" :id="`second_terrace_and_penthouse_checkbox_${index}`"
                                            x-model="unit.has_terrace_and_carpet"
                                            :name="`terrace_and_penthouse_checkbox_${index}`" type="checkbox">
                                        <label class="form-check-label" :for="`second_terrace_and_penthouse_checkbox_${index}`">Terrace & Penthouse</label>
                                    </div>

                                    <div class="form-check checkbox  checkbox-solid-success col-md-3 m-b-20">
                                        <input
                                            class="project_amenity form-check-input" :id="`second_servant_room_checkbox_${index}`"
                                            x-model="unit.servant_room"
                                            :name="`servant_room_checkbox_${index}`" type="checkbox">
                                        <label class="form-check-label" :for="`second_servant_room_checkbox_${index}`">Servant Room</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4" x-show="unit.has_terrace_and_carpet">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="unit.terrace_carpet_area == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Terrace carpet</label>
                                                    <input class="form-control" x-model="unit.terrace_carpet_area" name="terrace_carpet_area" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" :id="`second_terrace_carpet_select_${index}`"
                                                        name="terrace_carpet_area_measurement">
                                                        @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-4" x-show="unit.has_terrace_and_carpet">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="unit.terrace_saleable_area == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Terrace saleable</label>
                                                    <input
                                                        class="form-control"
                                                        name="terrace_super_builtup_area"
                                                        type="text"
                                                        x-model="unit.terrace_saleable_area"
                                                        autocomplete="off"
                                                    >
                                                </div>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" :id="`second_terrace_saleable_select_${index}`"
                                                        name="terrace_super_builtup_area_measurement">
                                                        @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1 m-b-4 mb-3" x-show="index > 0">
                                        <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" @click="removeUnitDetail(index)" title="">-</button>
                                    </div>
                                    <div class="form-group col-md-1 m-b-4 mb-3" x-show="index == 0">
                                        <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" data-bs-original-title="" @click="addUnitDetail()" title="">+</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="row" x-show="property_type=='88'||property_type=='89'">
                <div class="row mt-3">
                    <div class="form-group col-md-12">
                        <h5 class="border-style">Retail</h5>
                    </div>
                    <div class="col-md-12 mb-1">
                        <div>
                            <label><b>Sub category</b></label>
                        </div>

                        <div class="m-checkbox-inline custom-radio-ml">
                            <div class="btn-group bromi-checkbox-btn me-1"
                                role="group"
                                aria-label="Basic radio toggle button group">
                                <input type="checkbox" class="btn-check"
                                    value="37" id="extraretailkind1"
                                    x-model="sub_categories"
                                    @change="addNewUnitDetailsAccordingFloor('extraretailkind1')"
                                    data-error="#retail_type_error"
                                    autocomplete="off">
                                <label
                                    class="btn btn-outline-primary btn-pill btn-sm py-1"
                                    for="extraretailkind1">Ground floor</label>
                            </div>
                            <div class="btn-group bromi-checkbox-btn me-1"
                                role="group"
                                aria-label="Basic radio toggle button group">
                                <input type="checkbox" class="btn-check"
                                    data-error="#retail_type_error"
                                    x-model="sub_categories"
                                    value="38"
                                    id="extraretailkind2"
                                    @change="addNewUnitDetailsAccordingFloor('extraretailkind2')"
                                    autocomplete="off">
                                <label
                                    class="btn btn-outline-primary btn-pill btn-sm py-1"
                                    for="extraretailkind2">1st floor</label>
                            </div>
                            <div class="btn-group bromi-checkbox-btn me-1"
                                role="group"
                                aria-label="Basic radio toggle button group">
                                <input type="checkbox" class="btn-check"
                                    data-error="#retail_type_error"
                                    value="39"
                                    id="extraretailkind3"
                                    x-model="sub_categories"
                                    @change="addNewUnitDetailsAccordingFloor('extraretailkind3')"
                                    autocomplete="off">
                                <label
                                    class="btn btn-outline-primary btn-pill btn-sm py-1"
                                    for="extraretailkind3">2nd floor</label>
                            </div>
                            <div class="btn-group bromi-checkbox-btn me-1"
                                role="group"
                                aria-label="Basic radio toggle button group">
                                <input type="checkbox" class="btn-check" x-model="sub_categories"
                                    data-error="#retail_type_error" value="40"
                                    @change="addNewUnitDetailsAccordingFloor('extraretailkind4')"
                                    id="extraretailkind4"
                                    autocomplete="off">
                                <label
                                    class="btn btn-outline-primary btn-pill btn-sm py-1"
                                    for="extraretailkind4">3rd floor
                                </label>
                            </div>
                        </div>
                    </div>

                    <div x-show="sub_categories.length > 0">
                        <label><b>Unit Details</b></label>
                        <template x-for="(tower, index) in if_retail_tower_details">
                            <div class="row mt-2">
                                <div x-show="index > 0">
                                    <hr>
                                </div>

                                <div class="col-12 m-b-20">
                                    <span x-text="tower.floor_name" class="mb-3 text-primary"></span>
                                </div>

                                <div class="form-group col-md-3 m-b-20">
                                    <div class="fname" :class="tower.tower_name == '' ? '' : 'focused' ">
                                        <span class="d-none" x-text="nextTickForIfRetail()"></span>
                                        <label>Tower Name</label>
                                        <div class="fvalue">
                                            <input
                                                class="form-control"
                                                x-model="tower.tower_name"
                                                name="tower_name"
                                                type="text"
                                                autocomplete="off"
                                            >
                                        </div>
                                        <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_tower_name_${index}`">Tower name is required.</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 m-b-20">
                                    <select class="form-select" name="tower_sub_category" :id="`extra_floor_category_${index}`">
                                        <option value="">Sub Category</option>
                                        <option value="Ground">Ground</option>
                                        <option value="First">First</option>
                                        <option value="Second">Second</option>
                                    </select>
                                    <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_sub_category_${index}`">Sub Category is required.</span>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower.size_from == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size" data-bs-original-title="" x-model="tower.size_from"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_size_from_${index}`">Size from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower.size_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower.size_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_size_to_${index}`">Size to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`extra_tower_size_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-3 m-b-5">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="tower.front_opening == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Front Opening</label>
                                                    <input class="form-control" name="ceiling_height" type="text" 
                                                    x-model="tower.front_opening" autocomplete="off"
                                                    data-bs-original-title="" title="">
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_front_opening_${index}`">Front opening is required.</span>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" name="tower_front_opening_select" :id="`extra_tower_front_opening_select_${index}`">
                                                        <option selected="selected" value="1">Ft.</option>
                                                        <option value="3">Meter</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <div class="fname" :class="tower.number_of_each_floor == '' ? '' : 'focused' ">
                                            <label>No. of unit each floor</label>
                                            <div class="fvalue">
                                                <input class="form-control" x-model="tower.number_of_each_floor" name="no_of_unit_each_floor" type="text" autocomplete="off" data-bs-original-title="" title="">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_number_of_each_floor_${index}`">Number of each floor is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 m-b-5">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="tower.ceiling_height == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Ceiling Height</label>
                                                    <input class="form-control" name="ceiling_height" type="text" 
                                                    x-model="tower.ceiling_height" autocomplete="off" data-bs-original-title="" title="">
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_88_89_retail_tower_ceiling_height_${index}`">Ceiling height is required.</span>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" name="tower_ceiling_select" :id="`extra_tower_ceiling_select_${index}`">
                                                        <option selected="selected" value="1">Ft.</option>
                                                        <option value="3">Meter</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="row mb-1" x-show="property_category == 259">
                <div class="col-md-12 mb-1">
                    <div>
                        <label><b>Sub category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                value="1"
                                id="officeekind1"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="officeekind1"
                            >office space</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-1" x-show="property_category == 260">
                <div class="col-md-12 mb-1">
                    <div>
                        <label><b>Sub category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="3" id="retailkind1"
                                x-model="sub_categories"
                                data-error="#retail_type_error"
                                autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="retailkind1">Ground floor</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                data-error="#retail_type_error" x-model="sub_categories" value="4"
                                id="retailkind2"
                                autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="retailkind2">1st floor</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                data-error="#retail_type_error" value="5"
                                id="retailkind3" x-model="sub_categories"
                                autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="retailkind3">2nd floor</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check" x-model="sub_categories"
                                data-error="#retail_type_error" value="6"
                                id="retailkind4"
                                autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="retailkind4">3rd floor
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-1" x-show="property_category == 261">
                <div class="col-md-12 mb-1">
                    <div>
                        <label><b>Sub category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                value="7"
                                id="storagekind1"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="storagekind1">Warehouse</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                value="8"
                                id="storagekind2"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="storagekind2">Cold Storage</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                value="9"
                                id="storagekind3"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="storagekind3">ind. shed</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                value="10"
                                id="storagekind4"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="storagekind4">Plotting</label>
                        </div>
                    </div>
                    <div id="storage_type_error"></div>
                </div>
            </div>

            <div class="row mb-1" x-show="property_category == 254 || property_category == 257">
                <div class="col-md-12 mb-1">
                    <div>
                        <label><b>Sub category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="the_1rk btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                x-model="sub_categories"
                                @click="addWingSubCategory($event,'1 rk')"
                                value="13" id="flatkind1" name="flat_type[]"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind1">1 rk</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="14" id="flatkind2" x-model="sub_categories" name="flat_type[]"
                                @click="addWingSubCategory($event,'1 bhk')"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind2">1bhk</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="15" x-model="sub_categories" id="flatkind3" name="flat_type[]"
                                @click="addWingSubCategory($event,'2 bhk')"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind3">2bhk</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="16" x-model="sub_categories" id="flatkind4" name="flat_type[]"
                                @click="addWingSubCategory($event,'3 bhk')"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind4">3bhk</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="17" x-model="sub_categories" id="flatkind5" name="flat_type[]"
                                @click="addWingSubCategory($event,'4 bhk')"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind5">4bhk</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="18" x-model="sub_categories" id="flatkind6" name="flat_type[]"
                                @click="addWingSubCategory($event,'5bhk')"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind6">5bhk</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check"
                                value="19" x-model="sub_categories" id="flatkind7" name="flat_type[]"
                                @click="addWingSubCategory($event,'5+ bhk')"
                                data-error="#flat_type_error" autocomplete="off">
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="flatkind7">5+ bhk</label>
                        </div>
                    </div>
                    <div id="flat_type_error"></div>
                </div>
            </div>

            <div class="row mb-1 div_vila_type" x-show="property_category =='255'">
                <div class="col-md-12 mb-1">
                    <div>
                        <label><b>Sub category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check" value="21" id="vilakind1" @click="addWingSubCategory($event,'1 Bed')" data-val="resedential" x-model="sub_categories" name="vila_type" data-error="#vila_type_error" autocomplete="off" data-bs-original-title="" title="">
                            <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="vilakind1">1 Bed</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check" value="22" id="vilakind2" data-val="resedential" @click="addWingSubCategory($event,'2 Bed')" x-model="sub_categories" name="vila_type" data-error="#vila_type_error" autocomplete="off" data-bs-original-title="" title="">
                            <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="vilakind2">2 Bed</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                            <input type="checkbox" data-val="resedential" class="btn-check" value="23" id="vilakind3" @click="addWingSubCategory($event,'3 Bed')" x-model="sub_categories" name="vila_type" data-error="#vila_type_error" autocomplete="off" data-bs-original-title="" title="">
                            <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="vilakind3">3 Bed</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                            <input type="checkbox" data-val="resedential" class="btn-check" value="24" id="vilakind4" @click="addWingSubCategory($event,'4 Bed')" x-model="sub_categories" name="vila_type" data-error="#vila_type_error" autocomplete="off" data-bs-original-title="" title="">
                            <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="vilakind4">4 Bed</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                            <input type="checkbox" class="btn-check" value="25" data-val="resedential" x-model="sub_categories" @click="addWingSubCategory($event,'4+ Bed')" id="vilakind5" name="vila_type" data-error="#vila_type_error" autocomplete="off" data-bs-original-title="" title="">
                            <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="vilakind5">4+ Bed</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-1" x-show="property_category == 262">
                <div class="col-md-12 mb-1">
                    <div>
                        <label><b>Sub category</b></label>
                    </div>
                    <div class="m-checkbox-inline custom-radio-ml">
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio" 
                                class="btn-check"
                                value="10"
                                id="plotkind1"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="plotkind1">Commercial Land</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input 
                                type="radio" 
                                class="btn-check"
                                value="11"
                                id="plotkind2"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="plotkind2">Agricultural/Farm Land</label>
                        </div>
                        <div class="btn-group bromi-checkbox-btn me-1"
                            role="group"
                            aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                value="12"
                                id="plotkind3"
                                x-model="sub_category_single"
                                name="sub_category_single"
                            >
                            <label
                                class="btn btn-outline-primary btn-pill btn-sm py-1"
                                for="plotkind3">Industrial Land</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <span class="text-danger new_error d-none" id="err_sub_category">Sub category is required.</span>
            </div>

            <div class" x-show="sub_categories.includes('19')">
                <div class="form-group col-md-3 m-b-20">
                    <div class="fname" :class="is_flat_or_penthouse.number_of_room == '' ? '' : 'focused' ">
                        <label>Total Room</label>
                        <input
                            class="form-control"
                            x-model="is_flat_or_penthouse.number_of_room"
                            type="text"
                        >
                    </div>
                </div>
            </div>

            <hr>

            <template x-if="(sub_category_single != '') || (sub_categories.length > 0)">
                <div>
                    <div x-show="property_category == 261 && sub_category_single != ''">
                        <template x-for="(types, index) in if_ware_cold_ind_plot.types">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Plot Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="types.plot_area_from == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size" data-bs-original-title="" x-model="types.plot_area_from"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_plot_area_from_${index}`">Plot area from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="types.plot_area_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="types.plot_area_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_plot_area_to_${index}`">Plot area to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`carpet_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" x-show="sub_category_single != 10">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Construced Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="types.construced_area_from == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="types.construced_area_from"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_construced_area_from_${index}`">Construced area from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="types.construced_area_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="types.construced_area_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_construced_area_to_${index}`">Construced area to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`constructed_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Road width of front side area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="types.road_width_of_front_side_area_from == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="types.road_width_of_front_side_area_from"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_road_width_of_front_side_area_from_${index}`">size from is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="types.road_width_of_front_side_area_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="types.road_width_of_front_side_area_to"
                                                    >
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_road_width_of_front_side_area_to_${index}`">size to is required.</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`road_width_of_front_side_area_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 m-b-5">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="types.ceiling_height == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Ceiling Height</label>
                                                    <input class="form-control" type="text" 
                                                    x-model="types.ceiling_height">
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_ceiling_height_${index}`">Ceiling height is required.</span>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" :id="`type_ceiling_height_${index}`">
                                                        <option selected="selected" value="1">Ft.</option>
                                                        <option value="3">Meter</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <div class="fname" :class="types.number_of_units == '' ? '' : 'focused' ">
                                            <label>Total No. Of Units</label>
                                            <div class="fvalue">
                                                <input
                                                    class="form-control"
                                                    x-model="types.number_of_units"
                                                    type="text"
                                                >
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_cold_ind_plot_number_of_units_${index}`">Number of units is required.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2" x-show="index == 0">
                                    <div class="col-md-1">
                                        <span class="d-none" x-text="nextTickForWareColdPlot"></span>
                                        <button
                                            class="add_contacts btn btn-primary"
                                            type="button"
                                            style="border-radius:5px;"
                                            @click="addType()"
                                        >+</button>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2" x-show="index > 0">
                                    <div class="col-md-1">
                                        <button
                                            class="add_contacts btn btn-primary"
                                            type="button"
                                            style="border-radius:5px;"
                                            @click="removeType(index)"
                                        >-</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="row mt-2 mb-2 col-md-11" x-show="property_category == 261 && sub_category_single != ''">
                        <hr class="mb-4">
                        <div>
                            <label><b>Facilities</b></label>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-md-5">
                                <div class="fname">
                                    <label>Field Name</label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control valid filled"
                                            type="text"
                                            x-model="new_facility_input"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button
                                    class="btn mb-3 btn-primary btn-air-primary"
                                    type="button"
                                    :disabled="new_facility_input == ''"
                                    @click="addNewFacility()"
                                >Add Field</button>
                            </div>
                        </div>

                        <template x-for="(extra_facility, index) in extra_facilities" :key="`extra_facility_${index}`">
                            <div class="row mb-2">
                                <div class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        :id="`extra_facility_${index}`"
                                        :checked="extra_facility.detail != ''"
                                        x-model="extra_facility.id"
                                    >
                                    <label
                                        class="form-check-label"
                                        :for="`extra_facility_${index}`"
                                        x-text="extra_facility.name"
                                    ></label>
                                </div>
                                <div class="form-group mb-3 col-md-7 m-b-20" style="margin-left:5px;">
                                    <div class="fname" :class="extra_facility.detail  == '' ? '' : 'focused' ">
                                        <label x-text="extra_facility.name"></label>
                                        <div class="fvalue">
                                            <input
                                                class="form-control"
                                                type="text"
                                                x-model="extra_facility.detail"
                                            >
                                        </div>
                                        <span class="text-danger new_error d-none" :id="`err_extra_detail_${index}`">Details is required.</span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button
                                        class="add_contacts btn btn-primary" type="button"
                                        @click="removeExtraFacility(index)"
                                        style="border-radius:5px;"
                                    >-</button>
                                </div>
                            </div>
                        </template>

                        <div class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                            <input
                                class="form-check-input extra_industrial_field"
                                type="checkbox"
                                id="pcb"
                                :checked="storage_industrial.pcb_detail != ''"
                                x-model="storage_industrial.pcb"
                            >
                            <label
                                class="form-check-label"
                                for="pcb"
                            >Pollution Control Board</label>
                        </div>
                        <div class="form-group mb-3 col-md-9 m-b-20">
                            <div class="fname" :class="storage_industrial.pcb_detail == '' ? '' : 'focused' ">
                                <label> Pollution Control Board</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        type="text"
                                        x-model="storage_industrial.pcb_detail"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_pcb_detail">PCB Details is required.</span>
                            </div>
                        </div>

                        <div class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                            <input
                                class="form-check-input extra_industrial_field"
                                type="checkbox"
                                id="ec"
                                :checked="storage_industrial.ec_detail != ''"
                                x-model="storage_industrial.ec"
                            >
                            <label
                                class="form-check-label"
                                for="ec"
                            >EC</label>
                        </div>
                        <div class="form-group mb-3 col-md-9 m-b-20">
                            <div class="fname" :class="storage_industrial.ec_detail == '' ? '' : 'focused' ">
                                <label> EC</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        type="text"
                                        x-model="storage_industrial.ec_detail"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_ec_detail">EC Details is required.</span>
                            </div>
                        </div>

                        <div class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0 m-b-20">
                            <input
                                class="form-check-input extra_industrial_field"
                                type="checkbox"
                                id="gas"
                                :checked="storage_industrial.gas_detail != ''"
                                x-model="storage_industrial.gas"
                            >
                            <label
                                class="form-check-label"
                                for="gas"
                            >Gas</label>
                        </div>
                        <div class="form-group mb-3 col-md-9 m-b-20">
                            <div class="fname" :class="storage_industrial.gas_detail == '' ? '' : 'focused' ">
                                <label> Gas</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        type="text"
                                        x-model="storage_industrial.gas_detail"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_gas_detail">Gas Details is required.</span>
                            </div>
                        </div>

                        <div class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0">
                            <input
                                class="form-check-input extra_industrial_field"
                                type="checkbox"
                                id="power"
                                :checked="storage_industrial.power_detail != ''"
                                x-model="storage_industrial.power"
                            >
                            <label class="form-check-label" for="power">Power</label>
                        </div>
                        <div class="form-group col-md-9 mb-3">
                            <div class="fname" :class="storage_industrial.power_detail == '' ? '' : 'focused' ">
                                <label>Power</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        type="text"
                                        x-model="storage_industrial.power_detail"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_power_detail">Power Details is required.</span>
                            </div>
                        </div>
                        
                        <div class="form-check checkbox mb-3 checkbox-solid-success mb-0 col-md-3 pe-0">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="water"
                                :checked="storage_industrial.water_detail != ''"
                                x-model="storage_industrial.water"
                            >
                            <label class="form-check-label" for="water">Water</label>
                        </div>
                        <div class="form-group col-md-9 mb-3">
                            <div class="fname" :class="storage_industrial.water_detail == '' ? '' : 'focused' ">
                                <label>Water</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        type="text"
                                        x-model="storage_industrial.water_detail"
                                    >
                                </div>
                                <span class="text-danger new_error d-none" id="err_water_detail">Water Details is required.</span>
                            </div>
                        </div>
                    </div>
                    
                    <template x-if="property_category == '254' || property_category == '257'">
                        <div class="row mb-2">
                            <div class="col-md-2 mb-3">
                                <div class="fname" :class="is_flat_or_penthouse.number_of_towers == '' ? '' : 'focused' ">
                                    <label for="Total Floor">No. Of Tower</label>
                                    <div class="fvalue">
                                        <input class="form-control" x-model="is_flat_or_penthouse.number_of_towers" type="text" autocomplete="off"
                                        data-bs-original-title="" title="">
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_flat_number_of_towers">Number of tower is required.</span>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="fname" :class="is_flat_or_penthouse.number_of_floors == '' ? '' : 'focused' ">
                                    <label for="Property on floor">No. Of Floors</label>
                                    <div class="fvalue">
                                        <input class="form-control" x-model="is_flat_or_penthouse.number_of_floors" type="text" autocomplete="off" data-bs-original-title="" title="">
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_flat_number_of_floors">Number of floor is required.</span>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3 the_total_units_in_tower">
                                <div class="fname" :class="is_flat_or_penthouse.total_units == '' ? '' : 'focused' ">
                                    <label for="Total Floor">Total Units</label>
                                    <div class="fvalue">
                                        <input class="form-control" x-model="is_flat_or_penthouse.total_units" type="text" autocomplete="off" data-bs-original-title="" title="">
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_flat_total_units">Total unit is required.</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 the_total_elevator_in_tower">
                                <div class="fname" :class="is_flat_or_penthouse.number_of_elevator == '' ? '' : 'focused' ">
                                    <label for="Total Floor">No. of Elevator in each tower</label>
                                    <div class="fvalue">
                                        <input class="form-control" x-model="is_flat_or_penthouse.number_of_elevator" type="text" autocomplete="off" data-bs-original-title="" title="">
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_flat_number_of_elevator">Number of elevator is required.</span>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="property_category == '259' || property_category == '260'">
                        <div class="row mt-2">
                            <div>
                                <label><b>Tower Details</b></label>
                                <span class="d-none" x-text="nexttickForFirstCondition()"></span>
                            </div>
                            <div class="form-group col-12 col-md-2 col-lg-3 m-b-20">
                                <div class="fname" :class="if_office_or_retail.number_of_tower == '' ? '' : 'focused' ">
                                    <label>No. of Towers</label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control" name="first_number_of_tower"
                                            type="text"
                                            id="85_if_office_or_retail_number_of_tower"
                                            x-model="if_office_or_retail.number_of_tower"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_85_if_office_or_retail_number_of_tower">Number of tower is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-2 col-lg-3 m-b-20">
                                <div class="fname" :class="if_office_or_retail.number_of_floor == '' ? '' : 'focused' ">
                                    <label>No. of Floors</label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control"
                                            name="first_number_of_floors"
                                            type="text"
                                            x-model="if_office_or_retail.number_of_floor"
                                            autocomplete="off"
                                            id="85_if_office_or_retail_number_of_floor"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_85_if_office_or_retail_number_of_floor">Number of floor is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-2 col-lg-3 m-b-20">
                                <div class="fname" :class="if_office_or_retail.number_of_unit == '' ? '' : 'focused' ">
                                    <label>Total Units </label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control"
                                            x-model="if_office_or_retail.number_of_unit"
                                            name="first_total_units"
                                            type="text"
                                            id="85_if_office_or_retail_number_of_unit"
                                            autocomplete="off"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_85_if_office_or_retail_number_of_unit">Number of unit is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-2 col-lg-3 m-b-20">
                                <div class="fname" :class="if_office_or_retail.number_of_unit_each_block == '' ? '' : 'focused' ">
                                    <label>No. of Unit each tower </label>
                                    <div class="fvalue">
                                        <input  
                                            class="form-control"
                                            name="first_number_of_unit_each_block"
                                            x-model="if_office_or_retail.number_of_unit_each_block"
                                            type="text"
                                            autocomplete="off"
                                            id="85_if_office_or_retail_number_of_unit_each_block"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_85_if_office_or_retail_number_of_unit_each_block">Unit is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-2 col-lg-3 m-b-20">
                                <div class="fname" :class="if_office_or_retail.number_of_lift == '' ? '' : 'focused' ">
                                    <label>No. of Lift </label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control"
                                            x-model="if_office_or_retail.number_of_lift"
                                            name="first_number_of_lift"
                                            type="text"
                                            autocomplete="off"
                                            id="85_if_office_or_retail_number_of_lift"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_85_if_office_or_retail_number_of_lift">Number of list is required.</span>
                                </div>
                            </div>

                            <div class="form-group col-md-5 m-b-5">
                                <div class="input-group">
                                    <div class="form-group col-md-7 m-b-20">
                                        <div class="fname" :class="if_office_or_retail.front_road_width == '' ? '' : 'focused' ">
                                            <label class="mb-0">Front Road Width</label>
                                            <div class="fvalue">
                                                <input
                                                    class="form-control"
                                                    name="road_width"
                                                    type="text"
                                                    x-model="if_office_or_retail.front_road_width"
                                                    autocomplete="off"
                                                    id="85_if_office_or_retail_front_road_width"
                                                >
                                            </div>
                                        </div>
                                        <span class="text-danger new_error d-none" id="err_85_if_office_or_retail_front_road_width">Front road width is required.</span>
                                    </div>
                                    <div class="input-group-append col-md-5 m-b-20">
                                        <div class="form-group form_measurement">
                                            <select class="form-select form_measurement measure_select" name="road_width_select" id="first_front_road_map_unit_select">
                                                <option selected="selected" value="1">Ft.</option>
                                                <option value="3">Meter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-checkbox-inline">
                                <label><b>Washroom</b></label>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input
                                        type="radio"
                                        id="private"
                                        name="washroom"
                                        x-model="if_office_or_retail.washroom"
                                        value="private"
                                    >
                                    <label for="private">Private</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input
                                        type="radio"
                                        id="public"
                                        name="washroom"
                                        value="public"
                                        x-model="if_office_or_retail.washroom"
                                    >
                                    <label for="public">Public</label>
                                </div>
                            </div>
                            <div class="row" x-show="sub_categories.includes('3')">
                                <div class="form-check checkbox  checkbox-solid-success col-md-6">
                                    <input class="form-check-input" id="two_road_corner" x-model="if_office_or_retail.is_two_corner" name="two_road_corner" type="checkbox">
                                    <label class="form-check-label" for="two_road_corner">Two road corner.</label>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="property_category == '259'">
                        <template x-for="(tower_detail, index) in if_office_tower_details">
                            <div class="row">
                                <div class="mb-2">
                                    <hr>
                                    <span x-text="nextTickForTowerDetails()" class="d-none"></span>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <div class="fname" :class="tower_detail.tower_name == '' ? '' : 'focused' ">
                                        <label>Tower Name</label>
                                        <div class="fvalue">
                                            <input  
                                                class="form-control"
                                                name="tower_name"
                                                x-model="tower_detail.tower_name"
                                                type="text"
                                                autocomplete="off"
                                            >
                                        </div>
                                        <span class="text-danger new_error d-none" :id="`err_259_tower_detail_tower_name_${index}`">Tower name is required.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Saleable Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.saleable == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.saleable"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_saleable_${index}`">Saleable from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.saleable_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.saleable_to"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_saleable_to_${index}`">Saleable to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`tower_detail_saleable_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-5 m-b-5">
                                    <div class="input-group">
                                        <div class="form-group col-md-7 m-b-20">
                                            <div class="fname" :class="tower_detail.ceiling_height == '' ? '' : 'focused' ">
                                                <label class="mb-0">Ceiling Height</label>
                                                <div class="fvalue">
                                                    <input
                                                        class="form-control"
                                                        name="road_width"
                                                        type="text"
                                                        x-model="tower_detail.ceiling_height"
                                                        autocomplete="off"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_ceiling_height_${index}`">Ceiling height is required.</span>
                                        </div>
                                        <div class="input-group-append col-md-5 m-b-20">
                                            <div class="form-group form_measurement">
                                                <select class="form-select form_measurement measure_select" name="road_width_select" :id="`first_ceiling_height_map_unit_select_${index}`">
                                                    <option selected="selected" value="1">Ft.</option>
                                                    <option value="3">Meter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-auto mb-3">
                                        <a
                                            class="add_constructed_carpet_area" style="color:#0078DB!important"
                                            @click="tower_detail.is_carpet = !tower_detail.is_carpet" href="javascript:void(0)"> <span x-text="tower_detail.is_carpet ? '- Remove Carpet Area' : '+ Add Carpet Area'"></span>
                                        </a>
                                    </div>

                                    <div class="form-group col-md-auto mb-3">
                                        <a
                                            class="add_constructed_carpet_area" style="color:#0078DB!important"
                                            @click="tower_detail.is_built_up = !tower_detail.is_built_up" href="javascript:void(0)"> <span x-text="tower_detail.is_built_up ? '- Remove BuiltUp Area' : '+ Add BuiltUp Area'"></span> 
                                        </a>
                                    </div>
                                </div>

                                <div class="row" x-show="tower_detail.is_carpet">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Carpet Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.carpet == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size" data-bs-original-title="" x-model="tower_detail.carpet"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_carpet_${index}`">Carpet from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.carpet_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.carpet_to"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_carpet_to_${index}`">Carpet to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`tower_detail_carpet_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" x-show="tower_detail.is_built_up">
                                    <div class="form-group col-md-4 m-b-5">
                                        <span>Builtup Area</span>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.built_up == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size" data-bs-original-title="" x-model="tower_detail.built_up"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_built_up_${index}`">Built up from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower_detail.built_up_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower_detail.built_up_to"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_259_tower_detail_built_up_to_${index}`">Built up to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`tower_detail_built_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>

                    <template x-if="property_category == '259'">
                        <div class="row" x-show="if_office_or_retail.number_of_tower > 1">
                            <div class="form-check checkbox  checkbox-solid-success col-md-6 m-b-20">
                                <input
                                    class="form-check-input"
                                    id="tower_with_specification"
                                    x-model="if_office_tower_details_with_specification"
                                    name="tower_with_specification"
                                    type="checkbox"
                                    @click="towerWithSpecification()"
                                >
                                <label class="form-check-label" for="tower_with_specification">Towers with a different specification.</label>
                            </div>
                        </div>
                    </template>

                    <div class="row" x-show="property_category == '260'">
                        <div><hr></div>
                        <label><b>Unit Details</b></label>
                    </div>

                    <template x-if="property_category == '260'">
                        <template x-for="(tower, index) in if_retail_tower_details">
                            <div class="row mt-2">
                                <div x-show="index > 0">
                                    <hr>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <div class="fname" :class="tower.tower_name == '' ? '' : 'focused' ">
                                        <span class="d-none" x-text="nextTickForIfRetail()"></span>
                                        <label>Tower Name</label>
                                        <div class="fvalue">
                                            <input
                                                class="form-control"
                                                x-model="tower.tower_name"
                                                name="tower_name"
                                                type="text"
                                                autocomplete="off"
                                            >
                                        </div>
                                        <span class="text-danger new_error d-none" :id="`err_260_retail_tower_tower_name_${index}`">Tower name is required.</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 m-b-20">
                                    <select class="form-select" name="tower_sub_category" aria-hidden="true" :id="`floor_category_${index}`">
                                        <option value="">Sub Category</option>
                                        <option value="Ground">Ground</option>
                                        <option value="First">First</option>
                                        <option value="Second">Second</option>
                                    </select>
                                    <span class="text-danger new_error d-none" :id="`err_260_retail_tower_sub_category_${index}`">Sub Category is required.</span>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower.size_from == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size" data-bs-original-title="" x-model="tower.size_from"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_260_retail_tower_size_from_${index}`">Size from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="tower.size_to == '' ? '' : 'focused' ">
                                                <div class="fvalue">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="size"
                                                        x-model="tower.size_to"
                                                    >
                                                </div>
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_260_retail_tower_size_to_${index}`">Size to is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <select class="form-select" :id="`tower_size_from_to_select_${index}`" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-3 m-b-5">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="tower.front_opening == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Front Opening</label>
                                                    <input class="form-control" name="ceiling_height" type="text" 
                                                    x-model="tower.front_opening" autocomplete="off"
                                                    data-bs-original-title="" title="">
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_260_retail_tower_front_opening_${index}`">Front opening is required.</span>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" name="tower_front_opening_select" :id="`tower_front_opening_select_${index}`">
                                                        <option selected="selected" value="1">Ft.</option>
                                                        <option value="3">Meter</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <div class="fname" :class="tower.number_of_each_floor == '' ? '' : 'focused' ">
                                            <label>No. of unit each floor</label>
                                            <div class="fvalue">
                                                <input class="form-control" x-model="tower.number_of_each_floor" name="no_of_unit_each_floor" type="text" autocomplete="off" data-bs-original-title="" title="">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_260_retail_tower_number_of_each_floor_${index}`">Number of each floor is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 m-b-5">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="tower.ceiling_height == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Ceiling Height</label>
                                                    <input class="form-control" name="ceiling_height" type="text" 
                                                    x-model="tower.ceiling_height" autocomplete="off" data-bs-original-title="" title="">
                                                </div>
                                                <span class="text-danger new_error d-none" :id="`err_260_retail_tower_ceiling_height_${index}`">Ceiling height is required.</span>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" name="tower_ceiling_select" :id="`tower_ceiling_select_${index}`">
                                                        <option selected="selected" value="1">Ft.</option>
                                                        <option value="3">Meter</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <template x-if="index == 0">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <button
                                                class="btn btn-primary"
                                                style="border-radius: 5px;"
                                                type="button"
                                                @click="addRetailUnitDetails()"
                                            >+ Floor</button>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="index != 0">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <button
                                                class="btn btn-primary"
                                                style="border-radius: 5px;"
                                                type="button"
                                                @click="removeRetailUnitDetails(index)"
                                            >- Floor</button>
                                        </div>
                                    </div>
                                </template>

                            </div>
                        </template>
                    </template>

                    <template x-if="property_type == 87 && (property_category != '256') &&  (property_category != '258')">
                        <div class="row">
                            <div>
                                <label><b>Tower Details</b></label>
                                <span x-text="nextTickForIfResidentialWings()"></span>
                            </div>
                        </div>
                    </template>
                    

                    <div x-show="property_type == 87 && (property_category != '256') &&  (property_category != '258')">
                        <template x-for="(wing , index) in if_residential_only_wings.wing_details">
                            <div class="row">
                                <div class="form-group col-md-3 m-b-20">
                                    <div class="fname" :class="wing.wing_name == '' ? '' : 'focused' ">
                                        <label>Tower Name</label>
                                        <input
                                            class="form-control"
                                            x-model="wing.wing_name"
                                            type="text"
                                            autocomplete="off"
                                            @focusOut="manageWingNameArray()"
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_first_res_wing_wing_name_${index}`">Wing name is required.</span>
                                </div>
                                <div class="form-group col-md-2 m-b-20">
                                    <div class="fname" :class="wing.total_total_units == '' ? '' : 'focused' ">
                                        <label>Total Units</label>
                                        <input class="form-control" x-model="wing.total_total_units" type="text" autocomplete="off">
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_first_res_wing_total_total_units_${index}`">Total units is required.</span>
                                </div>
                                <div class="form-group col-md-2 m-b-20">
                                    <div class="fname" :class="wing.total_floors == '' ? '' : 'focused' ">
                                        <label>Total Floor</label>
                                        <input class="form-control" x-model="wing.total_floors" type="text" autocomplete="off">
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_first_res_wing_total_floors_${index}`">Total floor is required.</span>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="fname">
                                        <select class="form-select" :id="`sub_category_of_wings_${index}`" multiple="multiple">
                                            <template x-for="category in sub_category_array">
                                                <option :value="category">
                                                    <span x-text="category"></span>
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_first_res_wing_sub_categories_${index}`">Category is required.</span>
                                </div>
                                <div class="form-group col-md-1 m-b-4 mb-3" x-show="index > 0">
                                    <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" @click="removeWingDetail(index)" title="">-</button>
                                </div>
                                <div class="form-group col-md-1 m-b-4 mb-3" x-show="index == 0">
                                    <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" data-bs-original-title="" @click="addWingDetail()" title="">+</button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <template x-if="property_type == 87 && (property_category != '256') && (property_category != '258')">
                        <div class="row">
                            <hr>
                            <div>
                                <label><b>Unit Details</b></label>
                                <span class="d-none" x-text="manageWingNameArray()"></span>
                                <span x-text="nextTickForIfResidentialUnits()"></span>
                            </div>
                        </div>
                    </template>

                    <div x-show="property_type == 87 && (property_category != '256') && (property_category != '258')">
                        <template x-for="(unit , index) in if_residential_only_units.unit_details">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="fname" :class="unit.wing == '' ? '' : 'focused' ">
                                        <select class="form-select form-design" :id="`wing_array_${index}`">
                                            <option value="">Wing</option>
                                            <template x-for="wing_name in wings_name_array">
                                                <option :value="wing_name">
                                                    <span x-text="wing_name"></span>
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_wing_${index}`">Wing name is required.</span>
                                </div>

                                <div class="form-group col-md-9">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.saleable == '' ? '' : 'focused' ">
                                                <label class="mb-0">Saleable</label>
                                                <input class="form-control" x-model="unit.saleable" name="saleable_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_saleable_${index}`">Saleable from is required.</span>
                                        </div>
                                        <div class="form-group col-md-3 m-b-10">
                                            <div class="fname" :class="unit.saleable_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Saleable</label>
                                                <input class="form-control" x-model="unit.saleable_to" name="saleable_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_saleable_to_${index}`">Saleable to is required.</span>
                                        </div>
                                        <div class="form-group col-md-2 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`saleable_area_select_${index}`">
                                                @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-auto mb-3">
                                        <a style="color:#0078DB!important" @click="unit.has_built_up = !unit.has_built_up" href="javascript:void(0)" data-bs-original-title="" title="">+ Add Built Up Area
                                        </a>
                                    </div>
                                    <div class="form-group col-md-auto mb-3">
                                        <a style="color:#0078DB!important" @click="unit.has_carpet = !unit.has_carpet" href="javascript:void(0)" data-bs-original-title="" title=""> + Add Carpet Area
                                        </a>
                                    </div>
                                </div>

                                <div class="row mt-2" x-show="unit.has_built_up">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-2 m-b-10">
                                            <div class="fname" :class="unit.built_up == '' ? '' : 'focused' ">
                                                <label class="mb-0">Built up Area</label>
                                                <input class="form-control" x-model="unit.built_up" name="built_up_areass" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_built_up_${index}`">Built up form is required.</span>
                                        </div>
                                        <div class="form-group col-md-2 m-b-10">
                                            <div class="fname" :class="unit.built_up_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Built up Area</label>
                                                <input class="form-control" x-model="unit.built_up_to" name="built_up_areass" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_built_up_to_${index}`">Built up to  is required.</span>
                                        </div>
                                        <div class="form-group col-md-2 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`built_up_area_select_${index}`">
                                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2" x-show="unit.has_carpet">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-2 m-b-10">
                                            <div class="fname" :class="unit.carpet_area == '' ? '' : 'focused' ">
                                                <label class="mb-0">Carpet Area</label>
                                                <input class="form-control" x-model="unit.carpet_area" name="carpet_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_carpet_area_${index}`">Carpet area from is required.</span>
                                        </div>
                                        <div class="form-group col-md-2 m-b-10">
                                            <div class="fname" :class="unit.carpet_area_to == '' ? '' : 'focused' ">
                                                <label class="mb-0">Carpet Area</label>
                                                <input class="form-control" x-model="unit.carpet_area_to" name="carpet_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_carpet_area_to_${index}`">Carpet area to is required.</span>
                                        </div>
                                        <div class="form-group col-md-2 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`carpet_area_select_${index}`">
                                                @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-7 m-b-10">
                                            <div class="fname" :class="unit.wash_area == '' ? '' : 'focused' ">
                                                <label class="mb-0">Wash Area</label>
                                                <input class="form-control" x-model="unit.wash_area" name="wash_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_wash_area_${index}`">Wash area is required.</span>
                                        </div>
                                        <div class="form-group col-md-5 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`wash_area_select_${index}`">
                                                @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="form-group col-md-7 m-b-10">
                                            <div class="fname" :class="unit.balcony == '' ? '' : 'focused' ">
                                                <label class="mb-0">Balcony Area</label>
                                                <input class="form-control" x-model="unit.balcony" name="balcony_area" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_balcony_${index}`">Balcony area is required.</span>
                                        </div>
                                        <div class="form-group col-md-5 m-b-10">
                                            <select class="form-select form_measurement measure_select" :id="`balcony_area_select_${index}`">
                                                @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 d-none">
                                    <div class="input-group">
                                        <div class="form-group col-md-7 m-b-20">
                                            <div class="fname" :class="unit.floor_height == '' ? '' : 'focused' ">
                                                <label class="mb-0">Floor Height</label>
                                                <input class="form-control" x-model="unit.floor_height" name="floor_height" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_floor_height_${index}`">Floor height is required.</span>
                                        </div>
                                        <div class="input-group-append col-md-5 m-b-20">
                                            <div class="form-group form_measurement">
                                                <select class="form-select form_measurement measure_select" :id="`floor_height_select_${index}`">
                                                    <option selected="selected" value="1">Ft.</option>
                                                    <option value="3">Meter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="form-group col-md-7 m-b-20">
                                            <div class="fname" :class="unit.ceiling_height == '' ? '' : 'focused' ">
                                                <label class="mb-0">Ceiling Height</label>
                                                <input class="form-control" x-model="unit.ceiling_height" name="floor_height" type="text" autocomplete="off">
                                            </div>
                                            <span class="text-danger new_error d-none" :id="`err_if_residential_only_units_ceiling_height_${index}`">Ceiling height is required.</span>
                                        </div>
                                        <div class="input-group-append col-md-5 m-b-20">
                                            <div class="form-group form_measurement">
                                                <select class="form-select form_measurement measure_select" :id="`second_ceiling_height_select_${index}`">
                                                    <option selected="selected" value="1">Ft.</option>
                                                    <option value="3">Meter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="form-check checkbox  checkbox-solid-success col-md-3 m-b-20">
                                        <input
                                            class="project_amenity form-check-input" :id="`servant_room_checkbox_${index}`"
                                            x-model="unit.servant_room"
                                            :name="`servant_room_checkbox_${index}`" type="checkbox">
                                        <label class="form-check-label" :for="`servant_room_checkbox_${index}`">Servant Room</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4" x-show="unit.has_terrace_and_carpet">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="unit.terrace_saleable_area == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Terrace saleable</label>
                                                    <input
                                                        class="form-control"
                                                        name="terrace_super_builtup_area"
                                                        type="text"
                                                        x-model="unit.terrace_saleable_area"
                                                        autocomplete="off"
                                                    >
                                                </div>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" :id="`terrace_saleable_select_${index}`"
                                                        name="terrace_super_builtup_area_measurement">
                                                        @forEach($land_units as $land_unit)
                                                            <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" x-show="unit.has_terrace_and_carpet">
                                        <div class="input-group">
                                            <div class="form-group col-md-7 m-b-20">
                                                <div class="fname" :class="unit.terrace_carpet_area == '' ? '' : 'focused' ">
                                                    <label class="mb-0">Terrace carpet</label>
                                                    <input class="form-control" x-model="unit.terrace_carpet_area" name="terrace_carpet_area" type="text" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="input-group-append col-md-5 m-b-20">
                                                <div class="form-group form_measurement">
                                                    <select class="form-select form_measurement measure_select" :id="`terrace_carpet_select_${index}`"
                                                        name="terrace_carpet_area_measurement">
                                                        @forEach($land_units as $land_unit)
                                                            <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1 m-b-4 mb-3" x-show="index > 0">
                                        <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" @click="removeUnitDetail(index)" title="">-</button>
                                    </div>
                                    <div class="form-group col-md-1 m-b-4 mb-3" x-show="index == 0">
                                        <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" data-bs-original-title="" @click="addUnitDetail()" title="">+</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <hr>
                    </div>
                </div>
            </template>

            <template x-if="property_category == '262' || property_category == '256' || property_category == '258'">
                <div class="row mt-4">
                    <span x-text="nexttickForFarm()"></span>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="form-group col-md-6 m-b-10">
                                    <div class="fname" :class="if_farm_plot_land.total_open_area == '' ? '' : 'focused' ">
                                        <label class="mb-0">Total Open Area</label>
                                        <div class="fvalue">
                                            <input class="form-control" x-model="if_farm_plot_land.total_open_area" name="total_open_area" type="text" autocomplete="off" data-bs-original-title="" title="">
                                        </div>
                                        <span class="text-danger new_error d-none" id="err_if_farm_plot_land_total_open_area">Open area is required.</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 m-b-10">
                                    <select class="form-select form_measurement measure_select" name="open_area_map_select" id="open_area_select">
                                        @forEach($land_units as $land_unit)
                                            <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6 m-b-20">
                                <div class="fname" :class="if_farm_plot_land.total_number_of_plot == '' ? '' : 'focused' ">
                                    <label>Total No. of Plots</label>
                                    <div class="fvalue">
                                        <input class="form-control" x-model="if_farm_plot_land.total_number_of_plot" name="total_no_of_plots" type="text" autocomplete="off" data-bs-original-title="" title="">
                                    </div>
                                    <span class="text-danger new_error d-none" id="err_if_farm_plot_land_total_number_of_plot">number of plot is required.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="property_category == '262' || property_category == '256' || property_category == '258'">
                <div class="row">
                    <div class="form-check checkbox checkbox-solid-success col-md-6 m-b-20">
                        <input
                            class="project_amenity form-check-input" id="multiple_phase" name="multiple_phase" x-model="if_farm_plot_land.multiple_theme_phase" type="checkbox" data-bs-original-title="" title="">
                        <label class="form-check-label" for="multiple_phase">Project is with multiple theme/phase</label>
                    </div>
                    <div class="form-check checkbox checkbox-solid-success col-md-6 m-b-20">
                        <input
                            class="project_amenity form-check-input"
                            x-model="if_farm_plot_land.plot_with_construcation"
                            id="prots_with_construction"
                            name="prots_with_construction"
                            type="checkbox"
                            data-bs-original-title="" title="">
                        <label class="form-check-label" for="prots_with_construction">Plots with construction</label>
                    </div>
                </div>
            </template>

            <template x-if="if_farm_plot_land.multiple_theme_phase">
                <div class="row">
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname" :class="if_farm_plot_land.phase_name == '' ? '' : 'focused' ">
                            <span class="d-none" x-text="selectOnMultiplePhase()"></span>
                            <label>Phase name</label>
                            <div class="fvalue">
                                <input class="form-control" x-model="if_farm_plot_land.phase_name" name="phase_name" type="text" autocomplete="off" data-bs-original-title="" title="">
                            </div>
                            <span class="text-danger new_error d-none" id="err_if_farm_plot_land_phase_name">Phase name is required.</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="input-group mb-3">
                            <div class="form-group col-md-2 m-b-10">
                                <div class="fname" :class="if_farm_plot_land.plot_size_from == '' ? '' : 'focused' ">
                                    <label class="mb-0">Saleable Plot from</label>
                                    <div class="fvalue">
                                        <input type="text" name="saleable_plot_from" class="form-control" data-bs-original-title="" x-model="if_farm_plot_land.plot_size_from" title="">
                                    </div>
                                </div>
                                <span class="text-danger new_error d-none" id="err_if_farm_plot_land_plot_size_from">Saleable from is required.</span>
                            </div>
                            <div class="form-group col-md-2 m-b-10">
                                <div class="fname" :class="if_farm_plot_land.plot_size_to == '' ? '' : 'focused' ">
                                    <label class="mb-0">Saleable Plot to</label>
                                    <div class="fvalue">
                                        <input type="text" name="saleable_plot_from" class="form-control" data-bs-original-title="" x-model="if_farm_plot_land.plot_size_to" title="">
                                    </div>
                                </div>
                                <span class="text-danger new_error d-none" id="err_if_farm_plot_land_plot_size_to">Saleable to is required.</span>
                            </div>
                            <div class="form-group col-md-2 m-b-10">
                                <select class="form-select form_measurement measure_select" name="common_area_map_select" id="plot_size_from_select">
                                    @forEach($land_units as $land_unit)
                                        <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-auto mb-3">
                            <a
                                class="add_constructed_carpet_area" style="color:#0078DB!important"
                                @click="addCarpetPlotSize()"
                                href="javascript:void(0)"> + Carpet Plot Size
                            </a>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="if_farm_plot_land.add_carpet_plot_size">
                <div class="row mt-2">
                    <div class="input-group mb-3">
                        <div class="form-group col-md-2 m-b-10">
                            <div class="fname" :class="if_farm_plot_land.carpet_plot_size == '' ? '' : 'focused' ">
                                <span x-text="selectOnCarpetPlot()" class="d-none"></span>
                                <label class="mb-0">Carpet Plot Size</label>
                                <div class="fvalue">
                                    <input class="form-control" x-model="if_farm_plot_land.carpet_plot_size" name="carpet_plot_size" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_if_farm_plot_land_carpet_plot_size">Carpet from is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-2 m-b-10">
                            <div class="fname" :class="if_farm_plot_land.carpet_plot_size_to == '' ? '' : 'focused' ">
                                <span x-text="selectOnCarpetPlot()" class="d-none"></span>
                                <label class="mb-0">Carpet Plot Size</label>
                                <div class="fvalue">
                                    <input class="form-control" x-model="if_farm_plot_land.carpet_plot_size_to" name="carpet_plot_size" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_if_farm_plot_land_carpet_plot_size_to">Carpet to is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-2 m-b-10">
                            <select class="form-select" name="carpet_plot_size_select" tabindex="-1" aria-hidden="true" id="carpet_plot_size_select">
                                @forEach($land_units as $land_unit)
                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="if_farm_plot_land.plot_with_construcation">
                <div class="row mt-2">
                    <div class="input-group mb-3">
                        <div class="form-group col-md-3 m-b-10">
                            <div class="fname" :class="if_farm_plot_land.constructed_saleable_area == '' ? '' : 'focused' ">
                                <span x-text="selectOnConstSaleableArea()" class="d-none"></span>
                                <label class="mb-0">Constructed Saleable Area</label>
                                <div class="fvalue">
                                    <input class="form-control" 
                                    x-model="if_farm_plot_land.constructed_saleable_area" name="constructed_saleable_area" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_if_farm_plot_land_constructed_saleable_area">constructed saleable from is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-10">
                            <div class="fname" :class="if_farm_plot_land.constructed_saleable_area_to == '' ? '' : 'focused' ">
                                <span x-text="selectOnConstSaleableArea()" class="d-none"></span>
                                <label class="mb-0">Constructed Saleable Area</label>
                                <div class="fvalue">
                                    <input class="form-control" 
                                    x-model="if_farm_plot_land.constructed_saleable_area_to" name="constructed_saleable_area" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                                <span class="text-danger new_error d-none" id="err_if_farm_plot_land_constructed_saleable_area_to">constructed saleable to is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-2 m-b-10">
                            <select class="form-select" name="constructed_saleable_area_select" tabindex="-1" aria-hidden="true" id="constructed_saleable_area_select">
                                @forEach($land_units as $land_unit)
                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname" :class="if_farm_plot_land.number_of_room == '' ? '' : 'focused' ">
                            <label>No. Of Room</label>
                            <div class="fvalue">
                                <input class="form-control" x-model="if_farm_plot_land.number_of_room" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname" :class="if_farm_plot_land.number_of_bathroom == '' ? '' : 'focused' ">
                            <label>No. Of Bathroom</label>
                            <div class="fvalue">
                                <input class="form-control" x-model="if_farm_plot_land.number_of_bathroom" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname" :class="if_farm_plot_land.number_of_balcony == '' ? '' : 'focused' ">
                            <label>No. Of Balcony</label>
                            <div class="fvalue">
                                <input class="form-control" x-model="if_farm_plot_land.number_of_balcony" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname" :class="if_farm_plot_land.number_of_open_side == '' ? '' : 'focused' ">
                            <label>No. Of Open Side</label>
                            <div class="fvalue">
                                <input class="form-control" x-model="if_farm_plot_land.number_of_open_side" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname" :class="if_farm_plot_land.number_of_car_park == '' ? '' : 'focused' ">
                            <label>No. Of Car Park</label>
                            <div class="fvalue">
                                <input class="form-control" x-model="if_farm_plot_land.number_of_car_park" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-check checkbox  checkbox-solid-success col-md-3 m-b-20">
                        <input
                            class="project_amenity form-check-input" id="servant_room"
                            x-model="if_farm_plot_land.servant_room"
                            name="servant_room" type="checkbox">
                        <label class="form-check-label" for="servant_room">Servant Room</label>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-auto mb-3">
                            <a
                                style="color:#0078DB!important"
                                @click="addConstCarpetArea()"
                                href="javascript:void(0)"> + Constructed Carpet Area
                            </a>
                        </div>
                        <div class="form-group col-md-auto mb-3">
                            <a
                                style="color:#0078DB!important"
                                @click="addConstBuiltUpArea()"
                                href="javascript:void(0)"> + Constructed Built up Area
                            </a>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="if_farm_plot_land.add_constructed_carpet_area && if_farm_plot_land.plot_with_construcation">
                <div class="row mt-2">
                    <div class="input-group mb-3">
                        <div class="form-group col-md-3 m-b-10">
                            <span x-text="selectOnConstCarpetArea()" class="d-none"></span>
                            <div class="fname" :class="if_farm_plot_land.constructed_carpet_area == '' ? '' : 'focused' ">
                                <label class="mb-0">Constructed Carpet Area</label>
                                <div class="fvalue">
                                    <input class="form-control" 
                                    x-model="if_farm_plot_land.constructed_carpet_area" name="constructed_carpet_area" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-10">
                            <div class="fname" :class="if_farm_plot_land.constructed_carpet_area_to == '' ? '' : 'focused' ">
                                <label class="mb-0">Constructed Carpet Area</label>
                                <div class="fvalue">
                                    <input class="form-control" 
                                    x-model="if_farm_plot_land.constructed_carpet_area_to" name="constructed_carpet_area" type="text" autocomplete="off" data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-10">
                            <select class="form-select" name="constructed_saleable_area_select" tabindex="-1" aria-hidden="true" id="constructed_carpet_area_select">
                            @forEach($land_units as $land_unit)
                                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="if_farm_plot_land.add_constructed_built_up_area && if_farm_plot_land.plot_with_construcation">
                <div class="row mt-2">
                    <div class="input-group mb-3">
                        <div class="form-group col-md-3 m-b-10">
                            <span x-text="selectOnConstSaleableArea()" class="d-none"></span>
                            <div class="fname" :class="if_farm_plot_land.constructed_built_up_area_from == '' ? '' : 'focused' ">
                                <label class="mb-0">Built up from</label>
                                <div class="fvalue">
                                    <input type="text" class="form-control" x-model="if_farm_plot_land.constructed_built_up_area_from">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-10">
                            <div class="fname" :class="if_farm_plot_land.constructed_built_up_area_to == '' ? '' : 'focused' ">
                                <label class="mb-0">Built up to</label>
                                <div class="fvalue">
                                    <input type="text" x-model="if_farm_plot_land.constructed_built_up_area_to" class="form-control"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3 m-b-10">
                            <select class="form-select form_measurement measure_select" id="constructed_built_up_to_area_select">
                                @forEach($land_units as $land_unit)
                                    <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </template>

            <button class="btn btn-primary nextBtn pull-right" style="border-radius:5px;"
                type="button" @click="tabChange('amenities')">Next</button>
            </div>
    </div>
</div>
