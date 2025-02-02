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
            <!-- first part start -->
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
                                            v-if="category.id != 8"
                                            aria-label="Basic radio toggle button group">
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
            <!-- first part end -->

            <!-- second part start -->
            <office-retail-form
                ref="office_retail_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                v-if="[1,2].includes(data.property_category)"
            ></office-retail-form>

            <storage-industrial-form
                ref="storage_industrial_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                v-if="[3].includes(data.property_category)"
            ></storage-industrial-form>

            <land-form
                ref="land_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                v-if="[4].includes(data.property_category)"
            ></land-form>

            <flat-form
                ref="flat_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                :amenities="props.amenities"
                v-if="[5].includes(data.property_category)"
            ></flat-form>

            <vila-banglow-form
                ref="villa_banglow_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                :amenities="props.amenities"
                v-if="[6].includes(data.property_category)"
            ></vila-banglow-form>

            <penthouse-form
                ref="penthouse_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                :amenities="props.amenities"
                v-if="[7].includes(data.property_category)"
            ></penthouse-form>

            <plot-form
                ref="plot_form"
                :land_units="props.land_units"
                :property_source="props.property_source"
                :property_category="data.property_category"
                :amenities="props.amenities"
                v-if="[8].includes(data.property_category)"
            ></plot-form>

            <!-- second part end -->

            <!-- 3rd part start -->

            <div class="row mt-5" v-show="data.property_category != 4">
                <b>Unit Details</b>
                <template v-for="(unit, index) in unit_details">
                    <div class="row mt-2">
                        <div class="col-12 col-md-2" v-show="![6,8].includes(data.property_category)">
                            <div class="fname" :class="unit.wing !== '' ? 'focused' : ''">
                                <label :for="`unit_wing_${index}`">Wing</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" :id="`unit_wing_${index}`"
                                        v-model="unit.wing">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="fname" :class="unit.unit_number !== '' ? 'focused' : ''">
                                <label :for="`unit_unit_number_${index}`">Unit No</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" :id="`unit_unit_number_${index}`"
                                        v-model="unit.unit_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 m-b-4 mb-4">
                            <select class="form-select" :id="`unit_available_${index}`">
                                <option value="">Available</option>
                                <option value="Rent Out">Rent Out</option>
                                <option value="Sold Out">Sold Out</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="fname" :class="unit.price_rent !== '' ? 'focused' : ''">
                                <label :for="`unit_price_rent_${index}`">Price Rent</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" :id="`unit_price_rent_${index}`"
                                        v-model="unit.price_rent">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 m-b-4 mb-4" v-show="![8].includes(data.property_category)">
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

            <div class="row mt-3" v-show="data.property_category == 4">
                <b>Survey Details</b>
            </div>

            <div class="row gy-2 mt-2" v-show="data.property_category == 4">
                <div class="col-12 col-md-3">
                    <div class="fname" :class="other_details.survey_number !== '' ? 'focused' : ''">
                        <label for="survey_number">Survey Number</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="survey_number"
                                v-model="other_details.survey_number">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="form-group col-md-7 m-b-20">
                            <div class="fname" :class="other_details.survey_plot_size !== '' ? 'focused' : ''">
                                <label for="survey_plot_size">Plot size</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="survey_plot_size"
                                        v-model="other_details.survey_plot_size">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="survey_plot_size_unit">
                                    <template v-for="(unit) in props.land_units">
                                        <option :value="unit.id">{{ unit.unit_name }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="fname" :class="other_details.survey_price !== '' ? 'focused' : ''">
                        <label for="survey_price">Price</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="survey_price"
                                v-model="other_details.survey_price">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2" v-show="data.property_category == 4">
                <b>Tp Details</b>
            </div>

            <div class="row gy-2 mt-2" v-show="data.property_category == 4">
                <div class="col-12 col-md-3">
                    <div class="fname" :class="other_details.tp_number !== '' ? 'focused' : ''">
                        <label for="tp_number">TP Number</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="tp_number"
                                v-model="other_details.tp_number">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="fname" :class="other_details.fp_number !== '' ? 'focused' : ''">
                        <label for="fp_number">FP Number</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="fp_number"
                                v-model="other_details.fp_number">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="input-group">
                        <div class="form-group col-md-7 m-b-20">
                            <div class="fname" :class="other_details.tp_plot_size !== '' ? 'focused' : ''">
                                <label for="tp_plot_size">Plot size</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="tp_plot_size"
                                        v-model="other_details.tp_plot_size">
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append col-md-5">
                            <div class="form-group">
                                <select class="form-select" id="tp_plot_size_unit">
                                    <template v-for="(unit) in props.land_units">
                                        <option :value="unit.id">{{ unit.unit_name }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="fname" :class="other_details.tp_price !== '' ? 'focused' : ''">
                        <label for="tp_price">Price</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="tp_price"
                                v-model="other_details.tp_price">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <b>Owner Information</b>
            </div>

            <div class="row gy-2 mt-2">
                <div class="col-md-2 m-b-4 mb-4">
                    <select class="form-select" id="owner_type">
                        <option value="">Owner</option>
                        <option value="Builder">Builder</option>
                        <option value="Individual">Individual</option>
                        <option value="Investor">Investor</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <div class="fname" :class="other_details.owner_name !== '' ? 'focused' : ''">
                        <label for="owner_name">Name</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="owner_name"
                                v-model="other_details.owner_name">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="input-group">
                        <div class="input-group-append col-md-4 m-b-20">
                            <div class="form-group country_code">
                                <select class="form-select" id="owner_contact_code">
                                    <template v-for="(country) in props.country_codes">
                                        <option :value="country.id">{{ country.country_iso }}({{ country.country_code }})
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <div class="fname" :class="other_details.owner_contact !== '' ? 'focused' : ''">
                                <label for="owner_contact">Contact</label>
                                <div class="fvalue">
                                    <input class="form-control" type="text" value="" id="owner_contact"
                                        v-model="other_details.owner_contact"
                                        style="border-right:2px solid #1d2848 !important; border-top-right-radius: 5px;border-bottom-right-radius: 5px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="fname" :class="other_details.owner_email !== '' ? 'focused' : ''">
                        <label for="owner_email">Email</label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="owner_email"
                                v-model="other_details.owner_email">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <b>Other Contact Details</b>
            </div>
            <template v-for="(other_contact, index) in other_contact_details">
                <div class="row mt-2">
                    <div class="col-12 col-md-2">
                        <div class="fname" :class="other_contact.name !== '' ? 'focused' : ''">
                            <label :for="`other_contact_name_${index}`">Name</label>
                            <div class="fvalue">
                                <input class="form-control" type="text" value="" :id="`other_contact_name_${index}`"
                                    v-model="other_contact.name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group">
                            <div class="input-group-append col-md-4 m-b-20">
                                <div class="form-group country_code">
                                    <select class="form-select" :id="`contact_code_${index}`">
                                        <template v-for="(country) in props.country_codes">
                                            <option :value="country.id">{{ country.country_iso }}({{ country.country_code
                                            }})
                                            </option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <div class="fname" :class="other_contact.contact !== '' ? 'focused' : ''">
                                    <label :for="`other_contact_contact_${index}`">Contact</label>
                                    <div class="fvalue">
                                        <input class="form-control" type="text" value=""
                                            :id="`other_contact_contact_${index}`" v-model="other_contact.contact"
                                            style="border-right:2px solid #1d2848 !important; border-top-right-radius: 5px;border-bottom-right-radius: 5px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="fname" :class="other_contact.position !== '' ? 'focused' : ''">
                            <label :for="`other_contact_position_${index}`">Position</label>
                            <div class="fvalue">
                                <input class="form-control" type="text" value="" :id="`other_contact_position_${index}`"
                                    v-model="other_contact.position">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 m-b-4 mb-4" v-if="index == 0">
                        <button class="btn btn-primary" type="button" @click="addContact()">+</button>
                    </div>
                    <div class="col-md-1 m-b-4 mb-4" v-else>
                        <button class="btn btn-danger" type="button" @click="removeContact(index)">-</button>
                    </div>
                </div>
            </template>

            <div class="row gy-2 mt-2">
                <div class="col-12 col-md-3">
                    <select class="form-select" id="key_available_at">
                        <option value="">Key Available At</option>
                        <option value="Office">Office</option>
                        <option value="Owner">Owner</option>
                    </select>
                </div>
            </div>

            <div class="row gy-2 mt-3">
                <div class="col-12 col-md-4">
                    <b>Images : </b>
                    <input type="file" class="form-control mt-2" style="border:2px solid;border-radius: 5px;">
                </div>
                <div class="col-12 col-md-4">
                    <b>Documments :</b>
                    <input type="file" class="form-control mt-2" style="border:2px solid;border-radius: 5px;">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 col-3">
                    <button class="btn btn-primary" @click="submitForm()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { reactive, onMounted, nextTick , ref } from 'vue';
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

onMounted(() => {
    $('#project_id').select2().on('change', function () {
        data.selected_project = $(this).val();
        if (data.selected_project > 0) {
            let project = props.projects.find(project => parseInt(project.id) == parseInt(data.selected_project));
            data.address = project.address;
            data.location_link = project.location_link;
        }
    }).select2('open');

    var allowedselect2s = ['project_id'];

    $(document).on('keydown', '.select2-search__field', function(e) {
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
                    $("#" + project_id + " option[last_added='" + true + "']").each(function(i, e) {
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
});

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

const data = reactive({
    'property_for': 1,
    'property_construction_type': 1,
    'property_category': 1,
    'property_sub_category': 1,
    'selected_project': '',
    'selected_city': '',
    'selected_locality': '',
    'selected_district': '',
    'selected_taluka': '',
    'selected_village': '',
    'selected_zone' : '',
    'address': '',
    'location_link': '',
});

const other_details = reactive({

    'survey_number': '',
    'survey_plot_size': '',
    'survey_plot_size_unit': '',
    'survey_price': '',

    'tp_number' : '',
    'fp_number' : '',
    'tp_plot_size' : '',
    'tp_plot_size_unit' : '',
    'tp_price' : '',

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
    unit_details.splice(index , 1);
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

function submitForm() {

    let post_data = {
        'basic_detail' : data,
        'other_details' : other_details,
        'unit_details' : unit_details,
        'other_contact_details' : other_contact_details,
    };

    if([1,2].includes(data.property_category)) {

        let office_retail_data = office_retail_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...office_retail_data
        };
    }

    if(data.property_category == 3) {
        let storage_industrial_data = storage_industrial_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...storage_industrial_data
        };
    }

    if(data.property_category == 4) {
        let land_data = land_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...land_data
        };
    }

    if(data.property_category == 5){
        let flat_data = flat_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...flat_data
        };
    }

    if(data.property_category == 6){
        let villa_banglow_data = villa_banglow_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...villa_banglow_data
        };
    }

    if(data.property_category == 7){
        let penthouse_form_data = penthouse_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...penthouse_form_data
        };
    }

    if(data.property_category == 8){
        let plot_form_data = plot_form.value.getData();

        post_data.other_details = {
            ...post_data.other_details,
            ...plot_form_data
        };
    }

    axios.post('/admin/master-properties/store-property', post_data)
    .then(response => {
        window.location.href = "/admin/master-properties/index";
    })
    .catch(error => {
        console.error(error);
    });
}

</script>
