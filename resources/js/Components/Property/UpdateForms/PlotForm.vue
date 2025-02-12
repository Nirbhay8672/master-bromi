<template>
    <div class="row gy-2 mt-3">
        <b>Area Size</b>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="other_details.saleable_area !== '' ? 'focused' : ''">
                        <label for="saleable_area">Saleable Area</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="saleable_area"
                                v-model="other_details.saleable_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="saleable_area_unit">
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
                    <div class="fname" :class="other_details.length_of_plot !== '' ? 'focused' : ''">
                        <label for="length_of_plot">Length of plot</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="length_of_plot"
                                v-model="other_details.length_of_plot">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="length_of_plot_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id" v-if="[24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="other_details.width_of_plot !== '' ? 'focused' : ''">
                        <label for="width_of_plot">Width of plot</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="width_of_plot"
                                v-model="other_details.width_of_plot">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <select class="form-select" id="width_of_plot_unit">
                            <template v-for="(unit) in props.land_units">
                                <option :value="unit.id" v-if="[24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" v-show="other_details.add_carpet_plot_area == 1">
            <div class="input-group">
                <div class="form-group col-md-7">
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
                                <option :value="unit.id" v-if="![24,25].includes(unit.id)">{{ unit.unit_name }}</option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-2">
        <div class="col">
            <label for="add_carpet_plot_area" class="add-input-link fw-bold">{{ other_details.add_carpet_plot_area != 1 ? '+ Add' : '- Remove'}} Carpet Plot Area</label>
            <input type="checkbox" value="1" id="add_carpet_plot_area" class="d-none" v-model="other_details.add_carpet_plot_area" @change="resetValue(['carpet_plot_area','carpet_plot_area_unit'])">
        </div>
    </div>

    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-3">
            <div class="fname" :class="other_details.number_of_units !== '' ? 'focused' : ''">
                <label for="number_of_units">No. of units</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_units"
                        v-model="other_details.number_of_units">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="fname" :class="other_details.number_of_floors_allowed !== '' ? 'focused' : ''">
                <label for="number_of_floors_allowed">No. of floors allowed</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_floors_allowed"
                        v-model="other_details.number_of_floors_allowed">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="fname" :class="other_details.number_of_open_side !== '' ? 'focused' : ''">
                <label for="number_of_open_side">No. of open side</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_open_side"
                        v-model="other_details.number_of_open_side">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="row div_checkboxes1">
            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                <input class="form-check-input" id="is_hot" value="1" type="checkbox" v-model="other_details.is_hot">
                <label class="form-check-label" for="is_hot">Hot</label>
            </div>
        </div>
    </div>
    
    <div class="row gy-2 mt-3">
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
    $('#saleable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
    });

    $('#length_of_plot_unit').select2().on('change', function () {
        other_details.length_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
    });

    $('#width_of_plot_unit').select2().on('change', function () {
        other_details.width_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
    });

    $('#carpet_plot_area_unit').select2().on('change', function () {
        other_details.carpet_plot_area_unit = $(this).val();
        setSameMainUnits($(this).val());
    });
    
    $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
    });

    $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
    });

    if(props.property_master.area_sizes.length == 1) {
                
        other_details.saleable_area = props.property_master.area_sizes[0].salable_area_value;
        $('#saleable_area_unit').val(props.property_master.area_sizes[0].salable_area_measurement_id).trigger('change');

        other_details.length_of_plot = props.property_master.area_sizes[0].length_of_plot_value;
        $('#length_of_plot_unit').val(props.property_master.area_sizes[0].length_of_plot_measurement_id).trigger('change');

        other_details.width_of_plot = props.property_master.area_sizes[0].width_of_plot_value;
        other_details.carpet_plot_area = props.property_master.area_sizes[0].carpet_plot_area_value;

        other_details.add_carpet_plot_area = props.property_master.area_sizes[0].carpet_plot_area_value ? 1 : 0;
    }

    other_details.number_of_floors_allowed = props.property_master.no_of_floors_allowed;
    other_details.number_of_units = props.property_master.no_of_units;
    other_details.number_of_open_side = props.property_master.no_of_open_side;

    other_details.is_hot = props.property_master.hot_property ? true : false;

    let priority = {
        1 : 'High',
        2 : 'Medium',
        3 : 'Low',
    };

    $('#priority').val(priority[props.property_master.priority_type]).trigger('change');
    $('#source').val(props.property_master.source).trigger('change');

    other_details.availability_status = props.property_master.availability_status ? 'Available' : 'Under Construction';

    if(props.property_master.availability_status == 1) {
        other_details.age_of_property = age_of_property[props.property_master.property_age - 1];
    } else {
        other_details.available_from = props.property_master.available_from;
    }

    other_details.remark = props.property_master.remark;
});

const props = defineProps([
    'land_units',
    'property_source',
    'property_category',
    'property_master',
]);

const other_details = reactive({
    'saleable_area': '',
    'saleable_area_unit': '',

    'length_of_plot': '',
    'length_of_plot_unit': '',

    'width_of_plot': '',
    'width_of_plot_unit': '',

    'add_carpet_plot_area': '',
    'carpet_plot_area': '',
    'carpet_plot_area_unit': '',

    'number_of_units' : '',
    'number_of_floors_allowed': '',
    'number_of_open_side' : '',

    'is_hot' : '',

    'priority': '',
    'source': '',
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
        'saleable_area_unit',
        'carpet_plot_area_unit',
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
        'length_of_plot_unit',
        'width_of_plot_unit',
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
