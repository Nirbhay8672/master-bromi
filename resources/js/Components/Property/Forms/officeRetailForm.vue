<template>
    <div class="row gy-2">
    <b>Area Size</b>
    <div class="col-md-3">
        <div class="input-group">
            <div class="form-group col-md-7 m-b-20">
                <div class="fname" :class="other_details.saleable_area !== '' ? 'focused' : ''">
                    <label for="saleable_area">Saleble Area</label>
                    <div class="fvalue">
                        <input class="form-control" type="text" value="" id="saleable_area"
                            v-model="other_details.saleable_area">
                    </div>
                </div>
            </div>
            <div class="input-group-append col-md-5">
                <div class="form-group">
                    <select class="form-select" id="salable_area_unit">
                        <template v-for="(unit) in props.land_units">
                            <option :value="unit.id" v-if="![24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                        </template>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="form-group col-md-7 m-b-20">
                <div class="fname" :class="other_details.ceiling_height !== '' ? 'focused' : ''">
                    <label for="ceiling_height">Ceiling Height</label>
                    <div class="fvalue">
                        <input class="form-control" type="text" value="" id="ceiling_height"
                            v-model="other_details.ceiling_height">
                    </div>
                </div>
            </div>
            <div class="input-group-append col-md-5">
                <div class="form-group">
                    <select class="form-select" id="ceiling_height_unit">
                        <template v-for="(unit) in props.land_units">
                            <option :value="unit.id" v-if="[24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                        </template>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3" v-show="props.property_category == 2">
        <div class="input-group">
            <div class="form-group col-md-7 m-b-20">
                <div class="fname" :class="other_details.opening_width !== '' ? 'focused' : ''">
                    <label for="opening_width">Opening Width</label>
                    <div class="fvalue">
                        <input class="form-control" type="text" value="" id="opening_width"
                            v-model="other_details.opening_width">
                    </div>
                </div>
            </div>
            <div class="input-group-append col-md-5">
                <div class="form-group">
                    <select class="form-select" id="opening_width_unit">
                        <template v-for="(unit) in props.land_units">
                            <option :value="unit.id" v-if="[24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                        </template>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check checkbox checkbox-solid-success">
            <input class="form-check-input" id="is_terrace" value="1" type="checkbox" v-model="other_details.is_terrace" @change="resetValue([
                'terrace_saleable_area', 'terrace_saleable_area_unit' , 'terrace_carpet_area', 'terrace_carpet_area_unit'
            ])">
            <label class="form-check-label" for="is_terrace">Terrace</label>
        </div>
    </div>
    </div>

    <div class="row gy-2">
        <div class="col">
            <label for="add_carpet_area" class="add-input-link fw-bold">{{ other_details.add_carpet_area != 1 ? '+ Add' : '- Remove'}} Carpet Area</label>
            <input type="checkbox" value="1" id="add_carpet_area" class="d-none"
                v-model="other_details.add_carpet_area" @change="resetValue(['carpet_area','carpet_area_unit'])">
            <label for="add_terrace_carpet_area" class="add-input-link ms-3 fw-bold" v-if="other_details.is_terrace == 1">{{
                other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove' }} Terrace Carpet Area</label>
            <input type="checkbox" value="1" id="add_terrace_carpet_area" class="d-none"
                v-model="other_details.add_terrace_carpet_area" @change="resetValue(['terrace_carpet_area','terrace_carpet_area_unit'])">
        </div>
    </div>

    <div class="row gy-2 mt-1">
        <div class="col-md-4" v-show="other_details.add_carpet_area == 1">
            <div class="input-group">
                <div class="form-group col-md-7">
                    <div class="fname" :class="other_details.carpet_area !== '' ? 'focused' : ''">
                        <label for="carpet_area">Carpet Area</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="carpet_area"
                                v-model="other_details.carpet_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="carpet_area_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id" v-if="![24,25].includes(unit.id)">{{ unit.unit_name }}</option>
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
                            <input class="form-control" type="text" value="" id="terrace_saleable_area"
                                v-model="other_details.terrace_saleable_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="terrace_saleable_area_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id" v-if="![24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" v-show="other_details.add_terrace_carpet_area == 1 && other_details.is_terrace == 1">
            <div class="input-group">
                <div class="form-group col-md-7">
                    <div class="fname" :class="other_details.terrace_carpet_area !== '' ? 'focused' : ''">
                        <label for="terrace_carpet_area">Terrace Carpet Area</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="terrace_carpet_area"
                                v-model="other_details.terrace_carpet_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="terrace_carpet_area_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id" v-if="![24,25].includes(unit.id)">{{ unit.unit_name }}</option>
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
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.number_of_floor !== '' ? 'focused' : ''">
                <label for="number_of_floor">Number of floor</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_floor"
                        v-model="other_details.number_of_floor">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.units_in_towers !== '' ? 'focused' : ''">
                <label for="units_in_towers">Units in towers</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="units_in_towers"
                        v-model="other_details.units_in_towers">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2" v-if="props.property_category == 1">
            <div class="fname" :class="other_details.units_on_floor !== '' ? 'focused' : ''">
                <label for="units_on_floor">Units on floor</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="units_on_floor"
                        v-model="other_details.units_on_floor">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.number_of_elevators !== '' ? 'focused' : ''">
                <label for="number_of_elevators">Number of elevators</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_elevators"
                        v-model="other_details.number_of_elevators">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="row div_checkboxes1">
            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                <input class="form-check-input" id="service_elevator" value="1" type="checkbox"
                    v-model="other_details.service_elevator">
                <label class="form-check-label" for="service_elevator">Service Elevator</label>
            </div>

            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                <input class="form-check-input" id="is_hot" value="1" type="checkbox" v-model="other_details.is_hot">
                <label class="form-check-label" for="is_hot">Hot</label>
            </div>

            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2"
                v-if="props.property_category == 2">
                <input class="form-check-input" id="is_two_road_corner" value="1" type="checkbox"
                    v-model="other_details.two_road_corner">
                <label class="form-check-label" for="is_two_road_corner">Two Road Corner</label>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <b>Washrooms</b>
        <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2">
            <div class="btn-group bromi-checkbox-btn me-1" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="Private Washrooms" name="washrooms"
                    id="private_washroom" v-model="other_details.washrooms">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="private_washroom">Private
                    Washrooms</label>
            </div>
            <div class="btn-group bromi-checkbox-btn me-1" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="Public Washrooms" name="washrooms" id="public_washroom"
                    v-model="other_details.washrooms">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="public_washroom">Public
                    Washrooms</label>
            </div>
            <div class="btn-group bromi-checkbox-btn me-1" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="Not Available" name="washrooms" id="not_available"
                    v-model="other_details.washrooms">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="not_available">Not
                    Available</label>
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
                    v-model="other_details.availability_status" @change="resetValue(['age_of_property', 'available_from'])">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="available">Available</label>
            </div>
            <div class="btn-group bromi-checkbox-btn me-1" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="Under Construction" name="availability_status"
                    id="under_con" v-model="other_details.availability_status" @change="resetValue(['age_of_property', 'available_from'])">
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" for="under_con">Under
                    Construction</label>
            </div>
        </div>
    </div>

    <div class="row mt-2" v-if="other_details.availability_status">
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

    $('#salable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
    });

    $('#ceiling_height_unit').select2().on('change', function () {
        other_details.ceiling_height_unit = $(this).val();
        setOtherUnits($(this).val());
    });

    $('#opening_width_unit').select2().on('change', function () {
        other_details.opening_width_unit = $(this).val();
        setOtherUnits($(this).val());
    });

    $('#carpet_area_unit').select2().on('change', function () {
        other_details.carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
    });

    $('#terrace_saleable_area_unit').select2().on('change', function () {
        other_details.terrace_saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
    });

    $('#terrace_carpet_area_unit').select2().on('change', function () {
        other_details.terrace_carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
    });

    $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
    });

    $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
    });

    $('.select2-hidden-accessible').each(function() {
        var select2Instance = $(this).data('select2');
        if (select2Instance) {
            var options = $(this).children('option');           
            select2Instance.trigger('select', { data: { id: options.eq(0).val(), text: options.eq(0).text() } });
        }
    });
});

const props = defineProps([
    'land_units',
    'property_source',
    'property_category',
]);

const age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];

const other_details = reactive({
    'saleable_area': '',
    'saleable_area_unit': '',

    'opening_width': '',
    'opening_width_unit': '',

    'ceiling_height': '',
    'ceiling_height_unit': '',

    'add_carpet_area': '',
    'carpet_area': '',
    'carpet_area_unit': '',

    'is_terrace': '',
    'terrace_saleable_area': '',
    'terrace_saleable_area_unit': '',

    'add_terrace_carpet_area': '',
    'terrace_carpet_area': '',
    'terrace_carpet_area_unit': '',

    'units_in_project': '',
    'number_of_floor': '',
    'units_in_towers': '',
    'units_on_floor': '',
    'number_of_elevators': '',

    'service_elevator': '',
    'is_hot': '',

    'washrooms': '',

    'four_wheeler_parking': '',
    'two_wheeler_parking': '',

    'priority': '',
    'source': '',

    'availability_status': '',
    'age_of_property': '',
    'available_from': '',

    'two_road_corner': '',
    'remark': '',
});

function resetValue(array) {
    array.forEach(element => {
        other_details[element] = '';
    });
}

let isUpdatingMainUnit = false;

function setSameMainUnits(value) {

    if (isUpdatingMainUnit) return;
    isUpdatingMainUnit = true;

    let input_array = [
        'salable_area_unit',
        'carpet_area_unit',
        'terrace_carpet_area_unit',
        'terrace_saleable_area_unit',
    ];

    input_array.forEach(select_input => {
        $(`#${select_input}`).val(value).trigger('change');
    });

    setTimeout(() => {
        isUpdatingMainUnit = false;
    }, 0);
}

let isUpdatingOtherUnit = false;

function setOtherUnits(value) {

    if (isUpdatingOtherUnit) return;
    isUpdatingOtherUnit = true;

    let input_array = [
        'ceiling_height_unit',
        'opening_width_unit',
    ];

    input_array.forEach(select_input => {
        $(`#${select_input}`).val(value).trigger('change');
    });

    setTimeout(() => {
        isUpdatingOtherUnit = false;
    }, 0);
}

function getData() {
    return other_details;
}

defineExpose({
    getData,
});

</script>
