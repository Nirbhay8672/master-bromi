<template>

    <!-- Unit Details - Start -->
    <div class="row mt-5">
        <UnitDetails
        :unit-details="form.unit_details"
        :property-category="category?.id"
        />
    </div>
    <!-- Unit Details - End -->

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
    key_available_at: null,
    images: null,
    documents: null,
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