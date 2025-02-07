<template>
    <div class="row">
        <div class="col-12 col-md-3 col-lg-2">
            <div class="bromi-form-wizard stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step mb-5">
                        <button class="btn btn-primary" id="step0" data-action="#information-step">1</button>
                        <p class="ms-2">Information</p>
                    </div>
                    <div class="stepwizard-step mb-5">
                        <button class="btn btn-light" id="step1" data-action="#profile-step">2</button>
                        <p class="ms-2">Property Details</p>
                    </div>

                    <div class="stepwizard-step">
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
                                    :id="`property_for_${index}`" autocomplete="off" v-model="data.property_for" disabled>
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
                                    v-model="data.property_construction_type" @change="resetValue(2)" disabled>
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
                                                v-model="data.property_category" @change="resetValue(3)" disabled>
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
                                                    @change="resetValue(3)" disabled>
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
                                                    autocomplete="off" v-model="data.property_sub_category" disabled>
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

            <div class="row mt-5" v-show="data.property_category !== 4">
                <div class="col-md-3 m-b-4 mb-4">
                    <select class="form-select" id="project_id">
                        <option value="">Project</option>
                        <template v-for="(project) in props.projects">
                            <option :value="project.id">{{ project.project_name }}</option>
                        </template>
                    </select>
                </div>
                <div class="col-md-3 m-b-4 mb-4">
                    <select class="form-select" id="city_id">
                        <option value="">City</option>
                        <template v-for="(city, city_index) in props.cities">
                            <option :value="city.id" :selected="city_index == 0">{{ city.name }}</option>
                        </template>
                    </select>
                </div>
                <div class="col-md-3 m-b-4 mb-4">
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

            <div class="row mt-5" v-show="data.property_category == 4">
                <div class="col-md-3 m-b-4 mb-4">
                    <select class="form-select" id="district_id">
                        <option value="">District</option>
                        <template v-for="(district) in props.districts">
                            <option :value="district.id">{{ district.name }}</option>
                        </template>
                    </select>
                </div>
                <div class="col-md-3 m-b-4 mb-4">
                    <select class="form-select" id="taluka_id">
                        <option value="">Taluka</option>
                        <template v-for="(district) in props.districts">
                            <template v-if="district.id == data.selected_district">
                                <template v-for="(taluka) in district.talukas">
                                    <option :value="taluka.id">{{ taluka.name }}</option>
                                </template>
                            </template>
                        </template>
                    </select>
                </div>
                <div class="col-md-3 m-b-4 mb-4">
                    <select class="form-select" id="village_id">
                        <option value="">Village</option>
                        <template v-for="(district) in props.districts">
                            <template v-if="district.id == data.selected_district">
                                <template v-for="(taluka) in district.talukas">
                                    <template v-if="taluka.id == data.selected_taluka">
                                        <template v-for="(village) in taluka.villages">
                                            <option :value="village.id">{{ village.name }}</option>
                                        </template>
                                    </template>
                                </template>
                            </template>
                        </template>
                    </select>
                </div>
            </div>

            <div class="row mt-2" v-show="data.property_category == 4 || data.property_category == 8">
                <div class="col-md-3 m-b-4 mb-4">
                    <select class="form-select" id="zone_id">
                        <option value="">Zones</option>
                        <template v-for="(zone) in props.property_zones">
                            <option :value="zone.id">{{ zone.name }}</option>
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
                            <input class="form-control" type="text" id="location_link" v-model="data.location_link"
                                style="text-transform: lowercase !important;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>

import { reactive, onMounted, nextTick, ref } from 'vue';
import officeRetailForm from './Forms/officeRetailForm.vue';
import storageIndustrialForm from './Forms/storageIndustrialForm.vue';
import landForm from './Forms/LandForm.vue';
import flatForm from './Forms/flatForm.vue';
import vilaBanglowForm from './Forms/VilaBanglow.vue';
import penthouseForm from './Forms/PenthouseForm.vue';
import PlotForm from './Forms/PlotForm.vue';

let office_retail_form = ref(null);
let storage_industrial_form = ref(null);
let land_form = ref(null);
let flat_form = ref(null);
let villa_banglow_form = ref(null);
let penthouse_form = ref(null);
let plot_form = ref(null);

let files = ref({
    images: null,
    documents: null
});

let formData = new FormData();

onMounted(() => {

    console.log(props.property_master);

    $('#project_id').select2().on('change', function () {
        data.selected_project = $(this).val();
        if (data.selected_project > 0) {
            let project = props.projects.find(project => parseInt(project.id) == parseInt(data.selected_project));
            data.address = project.address;
            data.location_link = project.location_link;
        }
    });

    var allowedselect2s = ['project_id'];

    $(document).on('keydown', '.select2-search__field', function (e) {
        setTimeout(() => {
            var par = $(this).closest('.select2-dropdown')
            var tar = $(par).find('.select2-results')
            var kar = $(tar).find('.select2-results__options')
            var opt = $(kar).find('li')
            if (opt.length == 1 && $(opt[0]).text() == 'No results found' && $(this).val() != '') {
                var project_id = $(kar).attr('id')
                project_id = project_id.replace("select2-", "");
                project_id = project_id.replace("-results", "");
                if (allowedselect2s.includes(project_id)) {
                    $("#" + project_id + " option[last_added='" + true + "']").each(function (i, e) {
                        $('#' + project_id + ' option[value="' + $(this).val() + '"]').detach();
                    });
                    if ($("#" + project_id + " option[value='" + $(this).val() + "']").length == 0) {
                        let vvvv = $.parseHTML('<option last_added="true" value="' + $(this).val() +
                            '" selected="">' + $(this).val() + '</option>');
                        $("#" + project_id).append(vvvv).trigger('change');
                    }
                }
            }
        }, 50);
    });

    $('#city_id').select2().on('change', function () {
        data.selected_city = $(this).val();
    });

    $('#locality_id').select2().on('change', function () {
        data.selected_locality = $(this).val();
    });

    $('#district_id').select2().on('change', function () {
        data.selected_district = $(this).val();
    });

    $('#taluka_id').select2().on('change', function () {
        data.selected_taluka = $(this).val();
    });

    $('#village_id').select2().on('change', function () {
        data.selected_village = $(this).val();
    });

    $('#zone_id').select2().on('change', function () {
        data.selected_zone = $(this).val();
    });

    $('#city_id').val(props.cities[0]['id']).trigger('change');

    $('#owner_type').select2().on('change', function () {
        other_details.owner_type = $(this).val();
    });

    $('#survey_plot_size_unit').select2().on('change', function () {
        other_details.survey_plot_size_unit = $(this).val();
        setMainUnits($(this).val());
    });

    $('#tp_plot_size_unit').select2().on('change', function () {
        other_details.tp_plot_size_unit = $(this).val();
        setMainUnits($(this).val());
    });

    $('#owner_contact_code').select2().on('change', function () {
        other_details.owner_contact_code = $(this).val();
    });

    $('#key_available_at').select2().on('change', function () {
        other_details.key_available_at = $(this).val();
    });

    unitDetailsSelect2(); // for unit details
    otherContactSelect2(); // for other contact details

    $("#project_id").val(props.property_master.project_id).trigger('change');
    $("#city_id").val(props.property_master.city_id).trigger('change');

    nextTick(() => {
        $("#locality_id").val(props.property_master.area_id).trigger('change');
    });
});

const props = defineProps([
    'property_master',
    'property_for_type',
    'property_construction_type',
    'projects',
    'cities',
    'authuser',
    'land_units',
    'property_source',
    'country_codes',
    'districts',
    'property_zones',
    'amenities',
]);

const data = reactive({
    'property_for': props.property_master.property_for,
    'property_construction_type': props.property_master.property_contruction_type_id,
    'property_category': props.property_master.category_id,
    'property_sub_category': props.property_master.sub_category_id,
    'selected_project': '',
    'selected_city': '',
    'selected_locality': '',
    'selected_district': '',
    'selected_taluka': '',
    'selected_village': '',
    'selected_zone': '',
    'address': '',
    'location_link': '',
});

const other_details = reactive({

    'survey_number': '',
    'survey_plot_size': '',
    'survey_plot_size_unit': '',
    'survey_price': '',

    'tp_number': '',
    'fp_number': '',
    'tp_plot_size': '',
    'tp_plot_size_unit': '',
    'tp_price': '',

    'owner_type': '',
    'owner_name': '',
    'owner_contact_code': '',
    'owner_contact': '',
    'owner_email': '',
    'is_nri': '',

    'key_available_at': '',
});

const unit_details = reactive([
    {
        'wing': '',
        'unit_number': '',
        'available': '',
        'price_rent': '',
        'furnished_status': '',
    }
],
);

function unitDetailsSelect2() {
    unit_details.forEach((unit_detail, index) => {
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
        'wing': '',
        'unit_number': '',
        'available': '',
        'price_rent': '',
        'furnished_status': '',
    });

    nextTick(() => {
        unitDetailsSelect2();
    });
}

function removeUnit(index) {
    unit_details.splice(index, 1);
}

const other_contact_details = reactive([
    {
        'name': '',
        'contact_code': '',
        'contact': '',
        'position': '',
    }
],
);

function otherContactSelect2() {
    other_contact_details.forEach((unit_detail, index) => {
        $(`#contact_code_${index}`).select2().on('change', function () {
            other_contact_details[index].contact_code = $(this).val();
        });
    });
}

function addContact() {

    other_contact_details.push({
        'name': '',
        'contact_code': '',
        'contact': '',
        'position': '',
    });

    nextTick(() => {
        otherContactSelect2();
    });
}

function removeContact(index) {
    other_contact_details.splice(index, 1);
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

let isUpdatingMainUnit = false;

function setMainUnits(value) {

    if (isUpdatingMainUnit) return;
    isUpdatingMainUnit = true;

    let input_array = [
        'survey_plot_size_unit',
        'tp_plot_size_unit',
    ];

    input_array.forEach(select_input => {
        $(`#${select_input}`).val(value).trigger('change');
    });

    setTimeout(() => {
        isUpdatingMainUnit = false;
    }, 0);
}

function appendFormData(data, parentKey = "") {
    Object.keys(data).forEach((key) => {
        const fullKey = parentKey ? `${parentKey}[${key}]` : key;
        const value = data[key];

        if (value instanceof File) {
            formData.append(fullKey, value);
        } else if (typeof value === "object" && value !== null) {
            appendFormData(value, fullKey); // Recursively append nested objects
        } else {
            formData.append(fullKey, value ?? ""); // Ensure null values are sent as empty strings
        }
    });
};

function submitForm() {
}

function handleFileUpload(type, event) {
    if (event.target.files.length == 0) return;

    if (type == 'image') {
        files.value.images = event.target.files;
    }

    if (type == 'document') {
        files.value.documents = event.target.files;
    }
}

</script>
