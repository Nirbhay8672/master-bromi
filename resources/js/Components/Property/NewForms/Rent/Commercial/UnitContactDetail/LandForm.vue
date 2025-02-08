<template>
    <!-- Survey Details - Start -->
    <div class="row mt-2">
    <b>Survey Details</b>
    </div>
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.survey_number !== '' ? 'focused' : ''">
                <label for="survey_number">Survey Number</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="survey_number"
                        v-model="form.survey_number">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group" >
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="form.plot_size !== '' ? 'focused' : ''">
                        <label for="plot_size"> Plot Size </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="plot_size"
                                v-model="form.plot_size">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.plot_size_unit"
                            id="plot-size-unit"
                            :options="land_units"
                            display-key="unit_name"
                            :search-keys="['unit_name']"
                            placeholder="Unit"
                        />
                    </div>
                </div>
        </div>
    </div> 
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.price !== '' ? 'focused' : ''">
                <label for="price">Price</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="price"
                        v-model="form.price">
                </div>
            </div>
        </div>
    </div>
    <!-- Survey Details - End -->

    <!-- TP Details - Start -->
    <div class="row mt-2">
    <b>TP Details</b>
    </div>
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.tp_number !== '' ? 'focused' : ''">
                <label for="tp_number">TP Number</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="tp_number"
                        v-model="form.tp_number">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.fp_number !== '' ? 'focused' : ''">
                <label for="fp_number">FP Number</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="fp_number"
                        v-model="form.fp_number">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group" >
                <div class="form-group col-md-7 m-b-20">
                    <div class="fname" :class="form.tp_plot_size !== '' ? 'focused' : ''">
                        <label for="tp_plot_size"> Plot Size </label>
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" id="tp_plot_size"
                                v-model="form.tp_plot_size">
                        </div>
                    </div>
                </div>
                <div class="input-group-append col-md-5">
                    <div class="form-group">
                        <Select2Wrapper
                            v-model="form.tp_plot_size_unit"
                            id="tp-plot-size-unit"
                            :options="land_units"
                            display-key="unit_name"
                            :search-keys="['unit_name']"
                            placeholder="Unit"
                        />
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-12 col-md-2">
            <div class="fname" :class="form.price !== '' ? 'focused' : ''">
                <label for="price">Price</label>
                <div class="fvalue">
                    <input class="form-control" type="text" value="" id="price"
                        v-model="form.price">
                </div>
            </div>
        </div>
    </div>
    <!-- TP Details - End -->


    <!-- Owner Information - Start -->
    <div class="row mt-2">
        <OwnerInformation :country-codes="countryCodes" :owner-info="form.owner_info"  />
    </div>
    <!-- Owner Information - End -->
    
    <!-- Other Contact Details - Start -->
    <OtherContactDetails :countryCodes="countryCodes" :contact-details="form.contact_details"  />
    <!-- Other Contact Details - End -->

    <!-- Key Available At - Start -->
    <div class="row gy-2 mt-2">
        <div class="col-12 col-md-3">
            <Select2Wrapper
                v-model="form.key_available_at"
                id="key-available-at"
                :options="keyAvailableAtCase"
                display-key="name"
                :search-keys="['name']"
                placeholder="Key Available At"
            />
        </div>
    </div>
    <!-- Key Available At - Start -->

    <!-- Document Upload - Start -->
    <div class="row gy-2 mt-3">
        <div class="col-12 col-md-4">
            <b>Images : </b>
            <input type="file" multiple accept="image/*" class="form-control mt-2" style="border:2px solid;border-radius: 5px;" @change="(e) => handleFileUpload('image', e)">
        </div>
        <div class="col-12 col-md-4">
            <b>Documents :</b>
            <input type="file" multiple class="form-control mt-2" style="border:2px solid;border-radius: 5px;" @change="(e) => handleFileUpload('document', e)">
        </div>
    </div>
    <!-- Document Upload - End -->
</template> 

<script setup>
import { reactive } from 'vue';
import UnitDetails from '../../../../UnitDetails.vue';
import OwnerInformation from '../../../../OwnerInformation.vue';
import OtherContactDetails from '../../../../OtherContactDetails.vue';
import Select2Wrapper from '../../../../../Select2Wrapper.vue';

const props = defineProps([
    'category',
    'countryCodes',
    'land_units'
]);

const form = reactive({
    unit_details: [
        {
            id:'',
            wing: '',
            unit_number: '',
            available: '',
            price_rent: '',
            furniture_status: '',
        }
    ],
    owner_info: {
        type:'',
        name:'',
        contact_code:'',
        contact:'',
        email:'',
        is_nri: false,
    },
    contact_details:[
        {
            id:null,
            name:'',
            contact_code: '',
            contact: '',
            position: '',   
        }
    ],
    survey_number: '',
    key_available_at: null,
    images: null,
    documents: null,
    plot_size:'',
    plot_size_unit: '',
    price:'',
    tp_number:'',
    fp_number:'',
    tp_plot_size:'',
    tp_plot_size_unit:'', 
})

const keyAvailableAtCase = [
    {
        id:1,
        name: 'Office',
    },
    {
        id:2,
        name: 'Owner',
    },
]

function handleFileUpload(type, event) {
    if(event.target.files.length == 0) return;

    if(type == 'image'){
        form.images = event.target.files;
    }

    if(type == 'document'){
        form.documents = event.target.files;
    }
}

defineExpose({
    form,
})
</script>