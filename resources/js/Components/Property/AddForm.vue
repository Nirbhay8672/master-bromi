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
            <p>Property For - {{ data.property_for }}</p>
            <p>Property Type - {{ data.property_construction_type }}</p>
            <p>Property Category - {{ data.property_category }}</p>
            <p>Property Sub Category - {{ data.property_sub_category }}</p>
            <p>City - {{ data.selected_city }}</p>
            <p>Locality - {{ data.selected_locality }}</p>
            <p>saleable area - {{ other_details.saleable_area_unit }}</p>
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
                    <select class="form-select" id="city_id" v-model="data.selected_city">
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
                <hr class="ms-3">
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
                    <label for="add_terrace_carpet_area" class="add-input-link ms-3" v-if="other_details.is_terrace">{{ other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove'}} Terrace Carpet Area</label>
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
        </div>
    </div>
</template>

<script setup>

import { reactive , onMounted } from 'vue';

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
});

const props = defineProps([
    'property_for_type',
    'property_construction_type',
    'projects',
    'cities',
    'authuser',
    'land_units',
]);

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
});

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
