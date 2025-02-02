<template>
    <div class="row gy-2 mt-3">
        <b>Area Size</b>
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
    </div>

    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.number_of_floors_allowed !== '' ? 'focused' : ''">
                <label for="number_of_floors_allowed">Number of floors allowed</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_floors_allowed"
                        v-model="other_details.number_of_floors_allowed">
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
        <div class="col-md-3 m-b-4 mb-4">
            <select class="form-select" id="construction_allowed_for">
                <option value="">Construction allowed for</option>
                <option value="">Residential</option>
                <option value="">Commercial</option>
                <option value="">Industrial</option>
            </select>
        </div>
    </div>
    
    <div class="row mt-5">
        <b>Construction Documents</b>
    </div>

    <template v-for="(document, index) in construction_docs">
        <div class="row mt-2">
            <div class="col-md-4">
                <select class="form-select" :id="`document_category_${index}`">
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
            <div class="col-12 col-md-4">
                <input type="file" :id="`document_file_${index}`" name="" class="form-control" style="border: 2px solid;border-radius: 5px;">
            </div>
            <div class="col-md-1 m-b-4 mb-4" v-if="index == 0">
                <button class="btn btn-primary" type="button" @click="addDoc()">+</button>
            </div>
            <div class="col-md-1 m-b-4 mb-4" v-else>
                <button class="btn btn-danger" type="button" @click="removeDoc(index)">-</button>
            </div>
        </div>
    </template>

    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="other_details.fsi_far !== '' ? 'focused' : ''">
                <label for="fsi_far">FSI / FAR</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="fsi_far"
                        v-model="other_details.fsi_far">
                </div>
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

import { reactive, onMounted , nextTick } from 'vue';

onMounted(() => {
    $('#length_of_plot_unit').select2().on('change', function () {
        other_details.length_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
    });

    $('#width_of_plot_unit').select2().on('change', function () {
        other_details.width_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
    });

    $('#road_width_of_front_side_unit').select2().on('change', function () {
        other_details.road_width_of_front_side_unit = $(this).val();
        setOtherUnits($(this).val());
    });
    
    $('#construction_allowed_for').select2().on('change', function () {
        other_details.construction_allowed_for = $(this).val();
    });

    $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
    });

    $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
    });

    documentSelect2(); // for documents

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

const other_details = reactive({
    'length_of_plot': '',
    'length_of_plot_unit': '',

    'width_of_plot': '',
    'width_of_plot_unit': '',

    'number_of_floors_allowed': '',

    'road_width_of_front_side' : '',
    'road_width_of_front_side_unit' : '',

    'construction_allowed_for' : '',
    'fsi_far' : '',

    'priority': '',
    'source': '',
    'remark': '',
});

let construction_docs = reactive([
    {
        'category' : '',
        'file' : '',
    }
]);

function documentSelect2() {
    construction_docs.forEach((document, index) => {
        $(`#document_category_${index}`).select2().on('change', function () {
            construction_docs[index].category = $(this).val();
        });
    });
}

function addDoc() {

    construction_docs.push({
        'category' : '',
        'file' : '',
    });

    nextTick(() => {
        documentSelect2();
    });
}

function removeDoc(index) {
    construction_docs.splice(index , 1);
}

let isUpdatingOtherUnit = false;

function setOtherUnits(value) {

    if (isUpdatingOtherUnit) return;
    isUpdatingOtherUnit = true;

    let input_array = [
        'length_of_plot_unit',
        'width_of_plot_unit',
        'road_width_of_front_side_unit',
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
