<template>
    <div class="row">
        <div class="col-12 col-md-3 col-lg-2">
            <div class="bromi-form-wizard stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step mb-5" style="text-align:initial">
                        <button class="btn btn-primary" id="step0" data-action="#information-step">1</button>
                        <p class="ms-2">Information</p>
                    </div>
                    <div class="stepwizard-step mb-5" style="text-align:initial">
                        <button class="btn btn-light" id="step1" data-action="#profile-step">2</button>
                        <p class="ms-2">Property Details</p>
                    </div>

                    <div class="stepwizard-step" style="text-align:initial">
                        <button class="btn btn-light" id="step2" data-action="#unit-owner-step">3</button>
                        <p class="ms-2">Unit & Contact Information</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 col-lg-10 border-start ps-4">
            <div class="row">
                <div class="row mb-2">
                    <div class="col">
                        <label><b>Property For</b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 mb-4">
                        <template v-for="(propery_for, index ) in props.property_for_type" :key="`property_for_${index}`">
                            <div class="btn-group me-4" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" :value="propery_for.id" class="btn-check" name="property_for"
                                    :id="`property_for_${index}`" autocomplete="off" v-model="data.property_for"
                                    @change="resetValue(1)">
                                <label class="btn btn-outline-info btn-pill btn-sm py-1" :for="`property_for_${index}`">{{
                                    propery_for.name }}</label>
                            </div>
                        </template>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><b>Property Construction Type</b></label>
                        <div class="m-checkbox-inline custom-radio-ml mt-2">
                            <template v-for="(construction_type, index ) in props.property_construction_type"
                                :key="`property_construction_type_${index}`">
                                <input class="form-check-input" :id="construction_type.name" type="radio"
                                    name="property_type" :value="construction_type.id"
                                    v-model="data.property_construction_type" @change="resetValue(2)">
                                <label class="form-check-label ms-2" :for="construction_type.name">{{ construction_type.name
                                }}</label>
                            </template>
                        </div>
                    </div>
                    <template class="col-md-12" v-if="data.property_construction_type">
                        <label><b>Category</b></label>
                        <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2">
                            <template v-for="(construction_type, index ) in props.property_construction_type"
                                :key="`first_stage_${index}`">
                                <template v-if="data.property_construction_type == construction_type.id">
                                    <template v-for="(category, index ) in construction_type.category"
                                        :key="`category_stage_${index}`">
                                        <div class="btn-group bromi-checkbox-btn me-1 property-type-element" role="group"
                                            v-if="category.id != 8" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" :value="category.id"
                                                name="property_category" :id="`category-${category.id}}`" autocomplete="off"
                                                v-model="data.property_category" @change="resetValue(3)">
                                            <label class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                :for="`category-${category.id}}`">{{ category.name }}</label>
                                        </div>
                                        <template v-else>
                                            <div class="btn-group bromi-checkbox-btn me-1 property-type-element"
                                                role="group" v-if="data.property_for == 2"
                                                aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" :value="category.id"
                                                    name="property_category" :id="`category-${category.id}}`"
                                                    autocomplete="off" v-model="data.property_category"
                                                    @change="resetValue(3)">
                                                <label class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                    :for="`category-${category.id}}`">{{ category.name }}</label>
                                            </div>
                                        </template>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </template>
                    <template class="col-md-12 mt-5" v-if="data.property_category && data.property_category != 8">
                        <label><b>Sub Category</b></label>
                        <div class="m-checkbox-inline custom-radio-ml mt-2">
                            <template v-for="(construction_type, type_index ) in props.property_construction_type"
                                :key="`first_stage_${type_index}`">
                                <template v-for="(category, category_index ) in construction_type.category"
                                    :key="`category_stage_${category_index}`">
                                    <template v-if="data.property_category == category.id">
                                        <template v-for="(sub_cat, sub_category_index) in category.sub_category"
                                            :key="`sub_category_${sub_category_index}`">
                                            <div class="btn-group bromi-checkbox-btn me-1 property-type-element"
                                                role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" :value="sub_cat.id"
                                                    name="property_sub_category" :id="`sub-category-${sub_cat.id}}`"
                                                    autocomplete="off" v-model="data.property_sub_category">
                                                <label class="btn btn-outline-primary btn-pill btn-sm py-1"
                                                    :for="`sub-category-${sub_cat.id}}`">{{ sub_cat.name }}</label>
                                            </div>
                                        </template>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2 m-b-4 mb-4">
                    <select class="form-select" id="project_id">
                        <option value="">Project</option>
                        <template v-for="(project) in props.projects">
                            <option :value="project.id">{{ project.project_name }}</option>
                        </template>
                    </select>
                </div>
                <div class="col-md-2 m-b-4 mb-4">
                    <select class="form-select" id="city_id">
                        <option value="">City</option>
                        <template v-for="(city , city_index) in props.cities">
                            <option :value="city.id" :selected="city_index == 0">{{ city.name }}</option>
                        </template>
                    </select>   
                </div>
                <div class="col-md-2 m-b-4 mb-4">
                    <select class="form-select" id="locality_id">
                        <option value="">Locality</option>
                        <template v-for="(city) in props.cities">
                            <template v-if="city.id == data.selected_city">
                                <template v-for="(locality) in city.localities">
                                    <option :value="locality.id">{{ locality.name }}</option>
                                </template>
                            </template>
                        </template>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 m-b-4 mb-3">
                    <div class="fname" :class="data.address !== '' ? 'focused' : ''">
                        <label for="address">Address</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="address" v-model="data.address">
                        </div>
                    </div>
                </div>
                <div class="col-md-5 m-b-4 mb-3">
                    <div class="fname" :class="data.location_link !== '' ? 'focused' : ''">
                        <label for="location_link">Location Link</label>
                        <div class="fvalue">
                            <input
                                class="form-control"
                                type="text"
                                id="location_link"
                                v-model="data.location_link"
                                style="text-transform: lowercase !important;"
                            >
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row gy-2">
                <b>Area Size</b>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="form-group col-md-7 m-b-20">
                            <div class="fname" :class="other_details.saleable_area !== '' ? 'focused' : ''">
                                <label for="saleable_area">Salable Area</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="saleable_area" v-model="other_details.saleable_area">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="salable_area_unit">
                                    <template v-for="(unit) in props.land_units">
                                        <option :value="unit.id">{{ unit.unit_name }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="form-group col-md-7 m-b-20">
                            <div class="fname" :class="other_details.ceiling_height !== '' ? 'focused' : ''">
                                <label for="ceiling_height">Ceiling Height</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="ceiling_height" v-model="other_details.ceiling_height">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="ceiling_height_unit">
                                    <option value="ft">ft.</option>
                                    <option value="mt">mt.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check checkbox checkbox-solid-success">
                        <input class="form-check-input" id="is_terrace" type="checkbox" v-model="other_details.is_terrace">
                        <label class="form-check-label" for="is_terrace">Terrace</label>
                    </div>
                </div>
            </div>

            <div class="row gy-2">
                <div class="col">
                    <label for="add_carpet_area" class="add-input-link">{{ other_details.add_carpet_area != 1 ? '+ Add' : '- Remove'}} Carpet Area</label>
                    <input type="checkbox" value="1" id="add_carpet_area" class="d-none" v-model="other_details.add_carpet_area">
                    <label for="add_terrace_carpet_area" class="add-input-link ms-3" v-if="other_details.is_terrace == 1">{{ other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove'}} Terrace Carpet Area</label>
                    <input type="checkbox" value="1" id="add_terrace_carpet_area" class="d-none" v-model="other_details.add_terrace_carpet_area">
                </div>
            </div>        

            <div class="row gy-2 mt-1">
                <div class="col-md-4" v-show="other_details.add_carpet_area == 1">
                    <div class="input-group">
                        <div class="form-group col-md-7">
                            <div class="fname" :class="other_details.carpet_area !== '' ? 'focused' : ''">
                                <label for="carpet_area">Carpet Area</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="carpet_area" v-model="other_details.carpet_area">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="carpet_area_unit">
                                    <template v-for="(unit) in props.land_units">
                                        <option :value="unit.id">{{ unit.unit_name }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-show="other_details.is_terrace == 1">
                    <div class="input-group">
                        <div class="form-group col-md-7">
                            <div class="fname" :class="other_details.terrace_saleable_area !== '' ? 'focused' : ''">
                                <label for="terrace_saleable_area">Terrace Saleable Area</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="terrace_saleable_area" v-model="other_details.terrace_saleable_area">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="terrace_saleable_area_unit">
                                    <template v-for="(unit) in props.land_units">
                                        <option :value="unit.id">{{ unit.unit_name }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-show="other_details.add_terrace_carpet_area == 1">
                    <div class="input-group">
                        <div class="form-group col-md-7">
                            <div class="fname" :class="other_details.terrace_carpet_area !== '' ? 'focused' : ''">
                                <label for="terrace_carpet_area">Terrace Carpet Area</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="terrace_carpet_area" v-model="other_details.terrace_carpet_area">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="terrace_carpet_area_unit">
                                    <template v-for="(unit) in props.land_units">
                                        <option :value="unit.id">{{ unit.unit_name }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-3">
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.units_in_project !== '' ? 'focused' : ''">
                        <label for="units_in_project">Units in project</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="units_in_project" v-model="other_details.units_in_project">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.number_of_floor !== '' ? 'focused' : ''">
                        <label for="number_of_floor">Number of floor</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="number_of_floor" v-model="other_details.number_of_floor">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.units_in_towers !== '' ? 'focused' : ''">
                        <label for="units_in_towers">Units in towers</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="units_in_towers" v-model="other_details.units_in_towers">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.units_on_floor !== '' ? 'focused' : ''">
                        <label for="units_on_floor">Units on floor</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="units_on_floor" v-model="other_details.units_on_floor">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.number_of_elevators !== '' ? 'focused' : ''">
                        <label for="number_of_elevators">Number of elevators</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="number_of_elevators" v-model="other_details.number_of_elevators">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="row div_checkboxes1">
                    <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                        <input class="form-check-input" id="service_elevator" type="checkbox" v-model="other_details.service_elevator">
                        <label class="form-check-label" for="service_elevator">Service Elevator</label>
                    </div>

                    <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                        <input class="form-check-input" id="is_hot" type="checkbox" v-model="other_details.is_hot">
                        <label class="form-check-label" for="is_hot">Hot</label>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <b>Washrooms</b>
                <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2">
                    <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                        <input
                            type="radio"
                            class="btn-check"
                            value="Private Washrooms"
                            name="washrooms"
                            id="private_washroom"
                            v-model="other_details.washrooms">
                        <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="private_washroom">Private Washrooms</label>
                    </div>
                    <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                        <input
                            type="radio"
                            class="btn-check"
                            value="Public Washrooms"
                            name="washrooms"
                            id="public_washroom"
                            v-model="other_details.washrooms">
                        <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="public_washroom">Public Washrooms</label>
                    </div>
                    <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                        <input
                            type="radio"
                            class="btn-check"
                            value="Not Available"
                            name="washrooms"
                            id="not_available"
                            v-model="other_details.washrooms">
                        <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="not_available">Not Available</label>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-3">
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.four_wheeler_parking !== '' ? 'focused' : ''">
                        <label for="four_wheeler_parking">Four wheeler parking</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="four_wheeler_parking" v-model="other_details.four_wheeler_parking">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.two_wheeler_parking !== '' ? 'focused' : ''">
                        <label for="two_wheeler_parking">Two wheeler parking</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="two_wheeler_parking" v-model="other_details.two_wheeler_parking">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 m-b-4 mb-4">
                    <select class="form-select" id="priority">
                        <option value="">Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="col-md-2 m-b-4 mb-4">
                    <select class="form-select" id="source">
                        <option value="">Source</option>
                        <template v-for="(source) in props.property_source">
                            <option :value="source.id">{{ source.name }}</option>
                        </template>
                    </select>   
                </div>
            </div>

            <div class="row mt-2">
                <b>Availability Status</b>
                <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2">
                    <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                        <input
                            type="radio"
                            class="btn-check"
                            value="Available"
                            name="availability_status"
                            id="available"
                            v-model="other_details.availability_status">
                        <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="available">Available</label>
                    </div>
                    <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                        <input
                            type="radio"
                            class="btn-check"
                            value="Under Construction"
                            name="availability_status"
                            id="under_con"
                            v-model="other_details.availability_status">
                        <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="under_con">Under Construction</label>
                    </div>
                </div>
            </div>

            <div class="row mt-2" v-if="other_details.availability_status">
                <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2" v-if="other_details.availability_status == 'Available'">
                    <template v-for="(age) in age_of_property">
                        <div class="btn-group bromi-checkbox-btn me-1" role="group" aria-label="Basic radio toggle button group">
                            <input
                                type="radio"
                                class="btn-check"
                                :value="age"
                                name="age_of_property"
                                :id="`age-${age}`"
                                v-model="other_details.age_of_property">
                            <label class="btn btn-outline-primary btn-pill btn-sm py-1" :for="`age-${age}`">{{ age }}</label>
                        </div>
                    </template>
                </div>
                <div class="col-12 col-md-2" v-if="other_details.availability_status == 'Under Construction'">
                    <div class="fname" :class="other_details.available_from !== '' ? 'focused' : ''">
                        <label for="available_from">Available From</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="available_from" v-model="other_details.available_from">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-2 mt-3">
                <div class="col-12 col-md-7">   
                    <div class="fname" :class="other_details.remark !== '' ? 'focused' : ''">
                        <label for="remark">Property Remark</label>
                        <div class="fvalue">
                            <textarea class="form-control" type="text" value="" id="remark" v-model="other_details.remark"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <b>Unit Details</b>
            </div>
            <template v-for="(unit , index) in unit_details">
                <div class="row mt-2">
                    <div class="col-12 col-md-2">
                        <div class="fname" :class="unit.wing !== '' ? 'focused' : ''">
                            <label :for="`unit_wing_${index}`">Wing</label>
                            <div class="fvalue">
                                <input class="form-control" type="text" value="" :id="`unit_wing_${index}`" v-model="unit.wing">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="fname" :class="unit.unit_number !== '' ? 'focused' : ''">
                            <label :for="`unit_unit_number_${index}`">Unit No</label>
                            <div class="fvalue">
                                <input class="form-control" type="text" value="" :id="`unit_unit_number_${index}`" v-model="unit.wing">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 m-b-4 mb-4">
                        <select class="form-select" :id="`unit_available_${index}`">
                            <option value="">Available</option>
                            <option value="Rent Out">Rent Out</option>
                            <option value="Sold Sout">Sold Out</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="fname" :class="unit.price_rent !== '' ? 'focused' : ''">
                            <label :for="`unit_price_rent_${index}`">Price Rent</label>
                            <div class="fvalue">
                                <input class="form-control" type="text" value="" :id="`unit_price_rent_${index}`" v-model="unit.price_rent">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 m-b-4 mb-4">
                        <select class="form-select" :id="`furnished_status_${index}`">
                            <option value="">Furnished Status</option>
                            <option value="Furnished">Furnished</option>
                            <option value="Semi Furnished">Semi Furnished</option>
                            <option value="Unfurnished">Unfurnished</option>
                            <option value="Can Furnished">Can Furnished</option>
                        </select>
                    </div>
                    <div class="col-md-1 m-b-4 mb-4" v-if="index == 0">
                        <button class="btn btn-primary" type="button" @click="addUnit()">+</button>
                    </div>
                    <div class="col-md-1 m-b-4 mb-4" v-else>
                        <button class="btn btn-danger" type="button" @click="removeUnit(index)">-</button>
                    </div>
                </div>
            </template>

        </div>
    </div>
</template>

<script setup>

import { reactive , onMounted, nextTick } from 'vue';

onMounted(() => {
    $('#project_id').select2().on('change', function () {
        data.selected_project = $(this).val();
        if(data.selected_project > 0) {
            let project = props.projects.find(project => parseInt(project.id) == parseInt(data.selected_project));
            data.address = project.address; 
            data.location_link = project.location_link; 
        }
    });
    
    $('#city_id').select2().on('change', function () {
        data.selected_city = $(this).val();
    });
    
    $('#locality_id').select2().on('change', function () {
        data.selected_locality = $(this).val();
    });

    $('#city_id').val(props.cities[0]['id']).trigger('change');

    $('#salable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
    });

    $('#ceiling_height_unit').select2().on('change', function () {
        other_details.ceiling_height_unit = $(this).val();
    });

    $('#carpet_area_unit').select2().on('change', function () {
        other_details.carpet_area_unit = $(this).val();
    });

    $('#terrace_saleable_area_unit').select2().on('change', function () {
        other_details.terrace_saleable_area_unit = $(this).val();
    });

    $('#terrace_carpet_area_unit').select2().on('change', function () {
        other_details.terrace_carpet_area_unit = $(this).val();
    });

    $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
    });

    $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
    });

    unitDetailsSelect2(); // for unit details
});

const props = defineProps([
    'property_for_type',
    'property_construction_type',
    'projects',
    'cities',
    'authuser',
    'land_units',
    'property_source',
]);

const age_of_property = ['0-1 Years', '1-5 Years' , '5-10 Years' , '10+ Years'];

const data = reactive({
    'property_for': null,
    'property_construction_type': null,
    'property_category': null,
    'property_sub_category': null,
    'selected_project' : '',
    'selected_city' : '',
    'selected_locality' : '',
    'address' : '',
    'location_link' : '',
});

const other_details = reactive({
    'saleable_area' : '',
    'saleable_area_unit' : '',

    'ceiling_height' : '',
    'ceiling_height_unit' : '',

    'add_carpet_area' : '',
    'carpet_area' : '',
    'carpet_area_unit' : '',

    'is_terrace' : '',
    'terrace_saleable_area' : '',
    'terrace_saleable_area_unit' : '',

    'add_terrace_carpet_area' : '',
    'terrace_carpet_area' : '',
    'terrace_carpet_area_unit' : '',

    'units_in_project' : '',
    'number_of_floor' : '',
    'units_in_towers' : '',
    'units_on_floor' : '',
    'number_of_elevators' : '',

    'service_elevator' : '',
    'is_hot' : '',

    'washrooms' : '',

    'four_wheeler_parking' : '',
    'two_wheeler_parking' : '',

    'priority' : '',
    'source' : '',

    'availability_status' : '',
    'age_of_property' : '',
    'available_from' : '',

    'remark' : '',
});

const unit_details = reactive([
        {
            'wing' : '',
            'unit_number' : '',
            'available' : '',
            'price_rent' : '',
            'furnished_status' : '',
        }
    ],
);

function unitDetailsSelect2() {
    unit_details.forEach((unit_detail , index) => {
        $(`#unit_available_${index}`).select2().on('change', function () {
            unit_details[index].available = $(this).val();               
        });

        $(`#furnished_status_${index}`).select2().on('change', function () {
            unit_details[index].furnished_status = $(this).val();
        }); 
    });
}

function addUnit() {

    unit_details.push({
        'wing' : '',
        'unit_number' : '',
        'available' : '',
        'price_rent' : '',
        'furnished_status' : '',
    });
    
    nextTick(() => {
        unitDetailsSelect2();
    });
}

function removeUnit(index) {
    unit_details.splice(index , 1);
}

function resetValue(clicked_value) {
    // reset selected value on change input
    if (clicked_value == 1) {
        data.property_construction_type = null;
    }
    if (clicked_value == 1 || clicked_value == 2) {
        data.property_category = null;
    }
    data.property_sub_category = null;
}

</script>
