<template>
    <div class="row gy-2 mt-3">
        <b>Area Size</b>
        <div class="row gy-2">
            <div class="col">
                <label for="add_carpet_plot_area" class="add-input-link">{{ other_details.add_carpet_plot_area != 1 ? '+ Add' : '- Remove'}} Carpet Plot Area</label>
                <input type="checkbox" value="1" id="add_carpet_plot_area" class="d-none"
                    v-model="other_details.add_carpet_plot_area">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="other_details.saleable_plot_area !== '' ? 'focused' : ''">
                        <label for="saleable_plot_area">Salable Plot Area</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="saleable_plot_area"
                                v-model="other_details.saleable_plot_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="saleable_plot_area_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id">{{ unit.unit_name }}</option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" v-show="other_details.add_carpet_plot_area == 1">
            <div class="input-group">
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="other_details.carpet_plot_area !== '' ? 'focused' : ''">
                        <label for="carpet_plot_area">Carpet Plot Area</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="carpet_plot_area"
                                v-model="other_details.carpet_plot_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="carpet_plot_area_unit">
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
                    <input class="form-control" type="text" value="" id="units_in_project"
                        v-model="other_details.units_in_project">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="row div_checkboxes1">
            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                <input class="form-check-input" id="is_hot" type="checkbox" v-model="other_details.is_hot">
                <label class="form-check-label" for="is_hot">Hot</label>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="other_details.road_width_of_front_side !== '' ? 'focused' : ''">
                        <label for="road_width_of_front_side">Road width of front side</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="road_width_of_front_side"
                                v-model="other_details.road_width_of_front_side">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="road_width_of_front_side_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id" v-if="[24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.four_wheeler_parking !== '' ? 'focused' : ''">
                <label for="four_wheeler_parking">Four wheeler parking</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="four_wheeler_parking"
                        v-model="other_details.four_wheeler_parking">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.two_wheeler_parking !== '' ? 'focused' : ''">
                <label for="two_wheeler_parking">Two wheeler parking</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="two_wheeler_parking"
                        v-model="other_details.two_wheeler_parking">
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
            <div class="btn-group bromi-checkbox-btn me-1" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="Available" name="availability_status" id="available"
                    v-model="other_details.availability_status">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="available">Available</label>
            </div>
            <div class="btn-group bromi-checkbox-btn me-1" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="Under Construction" name="availability_status"
                    id="under_con" v-model="other_details.availability_status">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="under_con">Under
                    Construction</label>
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-5" v-if="other_details.availability_status">
        <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2"
            v-if="other_details.availability_status == 'Available'">
            <template v-for="(age) in age_of_property">
                <div class="btn-group bromi-checkbox-btn me-1" role="group"
                    aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" :value="age" name="age_of_property" :id="`age-${age}`"
                        v-model="other_details.age_of_property">
                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" :for="`age-${age}`">{{ age
                    }}</label>
                </div>
            </template>
        </div>
        <div class="col-12 col-md-2" v-if="other_details.availability_status == 'Under Construction'">
            <div class="fname" :class="other_details.available_from !== '' ? 'focused' : ''">
                <label for="available_from">Available From</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="available_from"
                        v-model="other_details.available_from">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-5">
        <b class="mb-2">Other Details</b>
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.temp_input_field !== '' ? 'focused' : ''">
                <label for="field_name">Field Name</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="field_name"
                        v-model="other_details.temp_input_field">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2" v-if="other_details.temp_input_field !== ''">
            <button class="btn btn-primary" type="button" @click="addOtherField()">Add Field</button>
        </div>
    </div>

    <template v-for="(other_detail  , index) in other_details.other_storage_industrial_detail">
        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <div class="form-check checkbox checkbox-solid-success mb-0">
                    <input class="form-check-input" :id="`other_detail_${other_detail.name}`" value="1" type="checkbox" v-model="other_detail.is_active">
                    <label class="form-check-label" :for="`other_detail_${other_detail.name}`" >{{ other_detail.name }}</label>
                </div>
            </div>
            <div class="col-12" :class="other_detail.exist ? 'col-md-7' : 'col-md-5'">
                <div class="fname" :class="other_detail.value !== '' ? 'focused' : ''">
                    <label :for="`other_detail_${other_detail.name}_value`">{{ other_detail.name }}</label>
                    <div class="fvalue">
                        <input class="form-control" type="text" value="" :id="`other_detail_${other_detail.name}_value`"
                            v-model="other_detail.value">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-2" v-if="!other_detail.exist">
                <button class="btn btn-danger" type="button" @click="removeOtherDetail(index)">-</button>
            </div>
        </div>
    </template>

    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-7">
            <div class="fname" :class="other_details.remark !== '' ? 'focused' : ''">
                <label for="remark">Property Remark</label>
                <div class="fvalue">
                    <textarea class="form-control" type="text" value="" id="remark"
                        v-model="other_details.remark"></textarea>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>

import { reactive, onMounted } from 'vue';

onMounted(() => {
    $('#saleable_plot_area_unit').select2().on('change', function () {
        other_details.saleable_plot_area_unit = $(this).val();
    });

    $('#carpet_plot_area_unit').select2().on('change', function () {
        other_details.carpet_plot_area_unit = $(this).val();
    });

    $('#road_width_of_front_side_unit').select2().on('change', function () {
        other_details.road_width_of_front_side_unit = $(this).val();
    });

    $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
    });

    $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
    });
});

const props = defineProps([
    'land_units',
    'property_source',
    'property_category',
]);

const age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];

const other_details = reactive({
    'saleable_plot_area': '',
    'saleable_plot_area_unit': '',

    'add_carpet_plot_area' : '',
    'carpet_plot_area': '',
    'carpet_plot_area_unit': '',

    'road_width_of_front_side' : '',
    'road_width_of_front_side_unit' : '',

    'units_in_project': '',
    'is_hot': '',

    'four_wheeler_parking': '',
    'two_wheeler_parking': '',

    'priority': '',
    'source': '',

    'availability_status': '',
    'age_of_property': '',
    'available_from': '',

    'two_road_corner': '',
    'remark': '',

    'temp_input_field' : '',

    'other_storage_industrial_detail' : [
        {
            'name' : 'Pollution Control Board',
            'value' : '',
            'is_active' : '',
            'exist' : true,
        },
        {
            'name' : 'EC/NOC',
            'value' : '',
            'is_active' : '',
            'exist' : true,
        },
        {
            'name' : 'Gas',
            'value' : '',
            'is_active' : '',
            'exist' : true,
        },
        {
            'name' : 'Power',
            'value' : '',
            'is_active' : '',
            'exist' : true,
        },
        {
            'name' : 'Water',
            'value' : '',
            'is_active' : '',
            'exist' : true,
        },
    ],
});

function addOtherField() {
    other_details.other_storage_industrial_detail.push({
        'name' : other_details.temp_input_field,
        'value' : '',
        'is_active' : '',
        'exist' : false,
    });

    other_details.temp_input_field = '';
}

function removeOtherDetail(index) {
    other_details.other_storage_industrial_detail.splice(index, 1);
}

function getData() {
    return other_details;
}

defineExpose({
    getData,
});

</script>
