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
                        <template v-for="(property_for, index ) in property_for_type" :key="`property_for_${index}`">
                            <div class="btn-group me-4" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" :value="property_for.id" class="btn-check" name="property_for"
                                    :id="`property_for_${index}`" autocomplete="off" v-model="form.property_for_type_id">
                                <label class="btn btn-outline-info btn-pill btn-sm py-1" :for="`property_for_${index}`">{{
                                    property_for.name }}</label>
                            </div>
                        </template>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><b>Property Construction Type</b></label>
                        <div class="m-checkbox-inline custom-radio-ml mt-2">
                            <template v-for="(construction_type, index ) in property_construction_type"
                                :key="`property_construction_type_${index}`">
                                <input class="form-check-input" :id="construction_type.name" type="radio"
                                    name="property_type" :value="construction_type.id"
                                    v-model="form.property_construction_type_id" @change="onPropertyConstructionTypeChange">
                                <label class="form-check-label ms-2" :for="construction_type.name">{{ construction_type.name
                                    }}</label>
                            </template>
                        </div>
                    </div>
                    <template class="col-md-12" v-if="selectedOption.propertyConstructionType">
                        <label><b>Category</b></label>
                        <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2">
                            <template v-for="(category, index ) in selectedOption.propertyConstructionType.category"
                                :key="`category_stage_${index}`">
                                <div class="btn-group bromi-checkbox-btn me-1 property-type-element" role="group"
                                    aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" :value="category.id"
                                        name="property_category" :id="`category-${category.id}}`" autocomplete="off"
                                        v-model="form.category_id" @change="onCategoryChange">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1"
                                        :for="`category-${category.id}}`">{{ category.name }}</label>
                                </div>
                            </template>
                        </div>
                    </template>
                    <template class="col-md-12 mt-5" v-if="selectedOption.category">
                        <label><b>Sub Category</b></label>
                        <div class="m-checkbox-inline custom-radio-ml mt-2">
                            <template v-for="(sub_cat, sub_category_index) in selectedOption.category.sub_category"
                                :key="`sub_category_${sub_category_index}`">
                                <div class="btn-group bromi-checkbox-btn me-1 property-type-element"
                                    role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" :value="sub_cat.id"
                                        name="property_sub_category" :id="`sub-category-${sub_cat.id}}`"
                                        autocomplete="off" v-model="form.sub_category_id">
                                    <label class="btn btn-outline-primary btn-pill btn-sm py-1"
                                        :for="`sub-category-${sub_cat.id}}`">{{ sub_cat.name }} - {{ sub_cat.id }}</label>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            <PropertyDetailOfficeForm
                ref="propertyDetailOfficeFormRef"
                :category="selectedOption.category"
                :projects="projects"
                :cities="cities"
                :land_units="land_units"
            />
            <UnitContactDetailOfficeForm
                ref="unitContactDetailOfficeFormRef"
                :category="selectedOption.category"
                :country-codes="country_codes"
            />
            
            <div class="row mt-4">
                <div class="col-12 col-3">
                    <button class="btn btn-primary" @click="submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { reactive, onMounted, ref } from 'vue';
import PropertyDetailOfficeForm from './NewForms/Commercial/PropertyDetail/OfficeForm.vue';
import UnitContactDetailOfficeForm from './NewForms/Commercial/UnitContactDetail/OfficeForm.vue';

const props = defineProps([
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

let formData = new FormData();

const propertyDetailOfficeFormRef = ref(null);
const unitContactDetailOfficeFormRef = ref(null);

const form = reactive({
    property_for_type_id: props.property_for_type[0]?.id ?? null,
    property_construction_type_id: props.property_construction_type[0]?.id ?? null,
    category_id: null,
    sub_category_id: null,
});

const selectedOption = reactive({
    propertyConstructionType: null,
    category: null,
})

onMounted(() => {
    onPropertyConstructionTypeChange();
    onCategoryChange();
})

const onPropertyConstructionTypeChange = () =>{
    selectedOption.propertyConstructionType = props.property_construction_type.find((el) => el.id == form.property_construction_type_id);
}

const onCategoryChange = () => {
    selectedOption.category = selectedOption.propertyConstructionType.category.find((el) => el.id == form.category_id);
}

const submit = () => {
    appendFormData(form);
    appendFormData(propertyDetailOfficeFormRef.value.form);
    appendFormData(unitContactDetailOfficeFormRef.value.form);

    axios.post('/admin/master-properties/store-property', formData, {
      headers: { "Content-Type": "multipart/form-data" },
    })
    .then(response => {
        window.location.href = "/admin/master-properties/index";
    })
    .catch(error => {
        console.error(error);
    });
}


const appendFormData = (data, parentKey = "") => {
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
}
</script>
