<template>

    <!-- Project Details - Start -->
    <div class="row mt-5">
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.project_id"
                id="project"
                :options="projects"
                display-key="project_name"
                :search-keys="['project_name']"
                placeholder="Project"
                @select="onProjectChange"
            />
        </div>
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.city_id"
                id="city"
                :options="cities"
                display-key="name"
                :search-keys="['name']"
                placeholder="City"
                @select="onCiyChange"
            />
        </div>
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.locality_id"
                id="locality"
                :options="selectedOption.city?.localities ?? []"
                display-key="name"
                :search-keys="['name']"
                placeholder="Locality"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 m-b-4 mb-3">
            <div class="fname" :class="form.address != '' ? 'focused' : ''">
                <label for="address">Address</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="address" v-model="form.address">
                </div>
            </div>
        </div>
        <div class="col-md-5 m-b-4 mb-3">
            <div class="fname" :class="form.location_link != ''  ? 'focused' : ''">
                <label for="location_link">Location Link</label>
                <div class="fvalue">
                    <input class="form-control" type="text" id="location_link" v-model="form.location_link"
                        style="text-transform: lowercase !important;">
                </div>
            </div>
        </div>
    </div>
    <!-- Project Details - End -->

    <!-- Size Area Details - Start -->
    <div class="row gy-2">
        <div class="col-md-3">
            <div class="input-group" >
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="form.size_area_details.salable_plot_area !== '' ? 'focused' : ''">
                        <label for="salable_plot_area"> Salable Plot Area </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="salable_plot_area"
                                v-model="form.size_area_details.salable_plot_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.size_area_details.salable_plot_area_unit"
                            id="salable-plot-area-unit"
                            :options="land_units"
                            display-key="unit_name"
                            :search-keys="['unit_name']"
                            placeholder="Unit"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group" >
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="form.size_area_details.salable_constructed_area !== '' ? 'focused' : ''">
                        <label for="salable_constructed_area"> Salable Constructed Area </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="salable_constructed_area"
                                v-model="form.size_area_details.salable_constructed_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.size_area_details.salable_constructed_area_unit"
                            id="salable-constructed-area-unit"
                            :options="land_units"
                            display-key="unit_name"
                            :search-keys="['unit_name']"
                            placeholder="Unit"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group" >
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="form.size_area_details.carpet_plot_area !== '' ? 'focused' : ''">
                        <label for="carpet_plot_area"> Carpet Plot Area </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="carpet_plot_area"
                                v-model="form.size_area_details.carpet_plot_area">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.size_area_details.carpet_plot_area_unit"
                            id="carpet-area-unit"
                            :options="land_units"
                            display-key="unit_name"
                            :search-keys="['unit_name']"
                            placeholder="Unit"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="row div_checkboxes1">
            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                <input class="form-check-input" id="is_hot_property" type="checkbox" v-model="form.is_hot_property">
                <label class="form-check-label" for="is_hot_property">Hot</label>
            </div>
        </div>
    </div>
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.units_in_project !== '' ? 'focused' : ''">
                <label for="units_in_project">Units in project</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="units_in_project"
                        v-model="form.units_in_project">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group" >
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="form.size_area_details.road_width_of_front_side !== '' ? 'focused' : ''">
                        <label for="road_width_of_front_side"> Road Width Of Front Side </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="road_width_of_front_side"
                                v-model="form.size_area_details.road_width_of_front_side">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.size_area_details.road_width_of_front_side_unit"
                            id="road-width-of-front-side-unit"
                            :options="land_units"
                            display-key="unit_name"
                            :search-keys="['unit_name']"
                            placeholder="Unit"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Size Area Details - End -->

    <!-- Parking, Priority and Source Details - Start  -->
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.number_of_tw_parking !== '' ? 'focused' : ''">
                <label for="number_of_tw_parking">Four wheeler parking</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_tw_parking"
                        v-model="form.number_of_tw_parking">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.number_of_fw_parking !== '' ? 'focused' : ''">
                <label for="number_of_fw_parking">Two wheeler parking</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_fw_parking"
                        v-model="form.number_of_fw_parking">
                </div>
            </div>
        </div>
        <div class="col-md-2 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.priority"
                id="priority"
                :options="priorityCase"
                display-key="name"
                :search-keys="['name']"
                placeholder="Priority"
            />
        </div>
        <div class="col-md-2 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.source"
                id="sources"
                :options="sourcesCase"
                display-key="name"
                :search-keys="['name']"
                placeholder="Source"
            />
        </div>
    </div>
    <!-- Parking, Priority and Source Details - End  --> 

    <!-- Availability Status - Start -->
    <div class="row mt-2">
        <b>Availability Status</b>
        <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2">
            <div
                class="btn-group bromi-checkbox-btn me-1"
                role="group"
                aria-label="Basic radio toggle button group"
                v-for="(availabilityStatusCase, type) in availabilityStatusCase" :key="`availability-status-${type}`"
            >
                <input type="radio" class="btn-check" :value="type"  :id="`availability-status-${type}`"
                    v-model="form.availability_status" >
                <label class="btn btn-outline-primary btn-pill btn-sm py-1" :for="`availability-status-${type}`">{{ availabilityStatusCase }}</label>
            </div>
        </div>
    </div>
    <div class="row mt-2" v-if="form.availability_status">
        <div class="m-checkbox-inline custom-radio-ml mt-2 mb-2"
            v-if="form.availability_status == 1">
            <template v-for="(age, id) in ageOfProperty">
                <div class="btn-group bromi-checkbox-btn me-1" role="group"
                    aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" :value="id" :id="`age-${age}`"
                        v-model="form.age_of_property">
                    <label class="btn btn-outline-primary btn-pill btn-sm py-1" :for="`age-${age}`">{{ age
                    }}</label>
                </div>
            </template>
        </div>
        <div class="col-12 col-md-2" v-if="form.availability_status == 2">
            <div class="fname" :class="form.available_from !== '' ? 'focused' : ''">
                <label for="available_from">Available From</label>
                <div class="fvalue">
                    <input class="form-control" type="text" id="available_from"
                        v-model="form.available_from">
                </div>
            </div>
        </div>
    </div>
    <!-- Availability Status - End -->

    
    <!-- Other Details - Start -->
    <div class="row mt-3 mb-5">
        <b class="mb-2">Other Details</b>
        <div class="col-12 col-md-2">
            <div class="fname" :class="demoForm.new_other_detail !== '' ? 'focused' : ''">
                <label for="field_name">Field Name</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="field_name"
                        v-model="demoForm.new_other_detail">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2" v-if="demoForm.new_other_detail !== ''">
            <button class="btn btn-primary" type="button" @click="addOtherField()">Add Field</button>
        </div>
    </div>

    <template v-for="(otherDocumentDetail  , index) in form.other_document_details">
        <div class="row mb-3">
            <div class="col-12 col-md-4">
                <div class="form-check checkbox checkbox-solid-success mb-0">
                    <input class="form-check-input" :id="`other_detail_${otherDocumentDetail.name}`" value="1" type="checkbox" v-model="otherDocumentDetail.is_active">
                    <label class="form-check-label" :for="`other_detail_${otherDocumentDetail.name}`" >{{ otherDocumentDetail.name }}</label>
                </div>
            </div>
            <div class="col-12" :class="otherDocumentDetail.exist ? 'col-md-7' : 'col-md-5'">
                <div class="fname" :class="otherDocumentDetail.value !== '' ? 'focused' : ''">
                    <label :for="`other_detail_${otherDocumentDetail.name}_value`">{{ otherDocumentDetail.name }}</label>
                    <div class="fvalue">
                        <input class="form-control" type="text" value="" :id="`other_detail_${otherDocumentDetail.name}_value`"
                            v-model="otherDocumentDetail.value">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-2" v-if="!otherDocumentDetail.exist">
                <button class="btn btn-danger" type="button" @click="removeOtherDetail(index)">-</button>
            </div>
        </div>
    </template>
    <!-- Other Details - End -->

    <!-- Remark - Start -->
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-7">
            <div class="fname" :class="form.remark !== '' ? 'focused' : ''">
                <label for="remark">Property Remark</label>
                <div class="fvalue">
                    <textarea class="form-control" type="text" value="" id="remark"
                        v-model="form.remark"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- Remark - End -->

</template>

<script setup>
import { reactive } from 'vue';
import Select2Wrapper from '../../../../../Select2Wrapper.vue';

const props = defineProps([
    'category',
    'projects',
    'cities',
    'land_units',
])

const demoForm = reactive({
    add_carpet_plot_area: false,
    new_other_detail:'',
});

const form  = reactive({
    project_id : null,
    city_id: null,
    locality_id: null,
    address: '',
    location_link: '',
    size_area_details: {
        salable_plot_area:'',
        salable_plot_area_unit: '',
        salable_constructed_area :'',
        salable_constructed_area_unit: '',
        carpet_plot_area: '',
        carpet_plot_area_unit:'',
    },
    is_have_service_elevator: false,
    is_hot_property: false,
    washroom_type: null,
    number_of_tw_parking: '',
    number_of_fw_parking: '',
    priority: null,
    source: null,
    availability_status: null,
    age_of_property: null,
    available_from: '',
    remark:'',
    units_in_project: '',
    number_of_floor: '',
    units_in_towers: '',
    units_on_floor: '',
    number_of_elevators: '',
    road_width_of_front_side:'',
    road_width_of_front_side_unit:'',
    other_document_details: [
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
})

const selectedOption = reactive ({
    city: null,
})

const onProjectChange = (project) =>{
    form.address = project?.address ?? ''
    form.location_link = project?.location_link ?? ''
} 

const onCiyChange = (city) => {
    selectedOption.city = city.id != form.city_id ? city : null
}


function addOtherField() {
    form.other_document_details.push({
        'name' : demoForm.new_other_detail,
        'value' : '',
        'is_active' : '',
        'exist' : false,
    });

    demoForm.new_other_detail = '';
}

function removeOtherDetail(index) {
    form.other_document_details.splice(index, 1);
}


defineExpose({
    form,
})

const washroomTypesCase = {
    1 : 'Private Washrooms',
    2 : 'Public Washrooms',
    3 : 'Not Available' ,
}

const priorityCase =[
    {
        id: 1,
        name: 'High'
    },
    {
        id: 2,
        name: 'Medium'
    },
    {
        id: 3,
        name: 'Low'
    },
];

const sourcesCase =[
    {
        id: 'Advertise',
        name: 'Advertise'
    },
    {
        id: 'Reference',
        name: 'Reference'
    },
    {
        id: '99 Acres',
        name: '99 Acres'
    },
    {
        id: 'Magicbricks',
        name: 'Magicbricks'
    },
    {
        id: 'Housing',
        name: 'Housing'
    },
];

const availabilityStatusCase = {
    1 : 'Available',
    2 : 'Under Construction',
}

const ageOfProperty = {
    1:'0-1 Years',
    2:'1-5 Years',
    3:'5-10 Years',
    4:'10+ Years'
}

</script>