<template>
    <!-- Project Details - Start -->
    <div class="row mt-5">
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.district_id"
                id="district"
                :options="districts"
                display-key="name"
                :search-keys="['name']"
                placeholder="District"
                @select="onDistrictChange"
            />
        </div>
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.taluka_id"
                id="taluka"
                :options="selectedOption.district?.talukas ?? []"
                display-key="name"
                :search-keys="['name']"
                placeholder="Taluka"
                @select="onTalukaChange"
            />
        </div>
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.village_id"
                id="village"
                :options="selectedOption.taluka?.villages ?? []"
                display-key="name"
                :search-keys="['name']"
                placeholder="Village"
            />
        </div>
        <div class="col-md-3 m-b-4 mb-4">
            <Select2Wrapper
                v-model="form.zone_id"
                id="zone"
                :options="zones"
                display-key="name"
                :search-keys="['name']"
                placeholder="Zone"
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
                    <div class="fname" :class="form.size_area_details.length_of_plot !== '' ? 'focused' : ''">
                        <label for="length_of_plot"> Length Of Plot </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="length_of_plot"
                                v-model="form.size_area_details.length_of_plot">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.size_area_details.length_of_plot_unit"
                            id="length-of-plot-unit"
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
                    <div class="fname" :class="form.size_area_details.width_of_plot !== '' ? 'focused' : ''">
                        <label for="width_of_plot"> Width Of Plot </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="width_of_plot"
                                v-model="form.size_area_details.width_of_plot">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.size_area_details.width_of_plot_unit"
                            id="width-of-plot-unit"
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
    <!-- Size Area Details - End -->

    <!-- Parking, Priority and Source Details - Start  -->
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.number_of_floor_allowed !== '' ? 'focused' : ''">
                <label for="number_of_floor_allowed">Number Of Floor Allowed</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="number_of_floor_allowed"
                        v-model="form.number_of_floor_allowed">
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
        <div class="col-md-3">
            <Select2Wrapper
                v-model="form.construction_allowed_for"
                id="construction-allowed-for"
                :options="constructionAllowedFor"
                display-key="name"
                :search-keys="['name']"
                placeholder="Construction Allowed For"
            />
        </div>
    </div>
    <div class="row mt-5">
        <b>Construction Documents</b>
    </div>

    <template v-for="(document, index) in form.construction_docs">
        <div class="row mt-2">
            <div class="col-md-4">
                <Select2Wrapper
                    v-model="document.type"
                    :id="`document-type-${index}`"
                    :options="docTypeCase"
                    display-key="name"
                    :search-keys="['name']"
                    placeholder="Category"
                />
            </div>
            <div class="col-12 col-md-4">
                <input type="file" :id="`document_file_${index}`" @change="(e) => handleFileUpload(e, index)" name="" class="form-control" style="border: 2px solid;border-radius: 5px;">
            </div>
            <div class="col-md-1 m-b-4 mb-4" v-if="index == 0">
                <button class="btn btn-primary" type="button" @click="addDoc()">+</button>
            </div>
            <div class="col-md-1 m-b-4 mb-4" v-else>
                <button class="btn btn-danger" type="button" @click="removeDoc(index)">-</button>
            </div>
        </div>
    </template>

        <!-- Parking, Priority and Source Details - Start  -->
        <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.fsi_far !== '' ? 'focused' : ''">
                <label for="fsi_far">FSI/FAR</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="fsi_far"
                        v-model="form.fsi_far">
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
    'districts',
    'zones'
])

const demoForm = reactive({
    is_terrace: false,
    add_carpet_area: false,
    add_terrace_carpet_area:false,
});

const form  = reactive({
    district_id : null,
    taluka_id: null,
    village_id: null,
    zone_id: null,
    address: '',
    location_link: '',
    size_area_details: {
        length_of_plot: '',
        length_of_plot_unit: '',
        width_of_plot: '',
        width_of_plot_unit: '',
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
    number_of_floor_allowed: false,
    construction_allowed_for: null,
    construction_docs:[
        {
            'type' : '',
            'file' : '',
        }        
    ],
    fsi_far: '',
})

const selectedOption = reactive ({
    district: null,
    taluka: null,
})

const onDistrictChange = (district) => {
    selectedOption.district = district.id != form.district_id ? district : null
}
const onTalukaChange = (taluka) => {
    selectedOption.taluka = taluka.id != form.city_id ? taluka : null
}

defineExpose({
    form,
})


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

const constructionAllowedFor = [
    {
        id:1,
        name: 'Residential'
    },
    {
        id:2,
        name: 'Commercial'
    },    {
        id:3,
        name: 'Industrial'
    },
];

const handleFileUpload = (event, index) => {
    form.construction_docs[index].file = event.target.files[0];
}


const addDoc = () => {
    form.construction_docs.push({
        'type' : '',
        'file' : '',
    });
}

const removeDoc = (index) => { 
 form.construction_docs.splice(index , 1);
}

const docTypeCase = [
    {
        id: 1,
        name: 'Building Elevation'
    },
    {
        id: 2,
        name:'Common Amenities Photos'
    },
    {
        id: 3,
        name:'Master Layout Of Building'
    },
    {
        id: 4,
        name:'Master Layout Of Building'
    },
    {
        id: 5,
        name:'Brochure'
    },
    {
        id: 6,
        name:'Other'
    }
];

</script>