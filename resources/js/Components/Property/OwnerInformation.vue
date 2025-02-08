<template>
    <div class="owner-information">
      <div class="row mt-2">
        <b>Owner Information</b>
      </div>
  
      <div class="row gy-2 mt-2">
        <div class="col-md-2 m-b-4 mb-4" v-if="ownerInfo.hasOwnProperty('type')">
            <Select2Wrapper
                v-model="ownerInfo.type"
                id="owner-info-owner-type"
                :options="ownerTypeCase"
                display-key="name"
                :search-keys="['name']"
                placeholder="Owner"
            />
        </div>
  
        <div class="col-12 col-md-2" v-if="ownerInfo.hasOwnProperty('name')">
          <div class="fname" :class="ownerInfo.name !== '' ? 'focused' : ''">
            <label for="name">Name</label>
            <div class="fvalue">
              <input class="form-control" type="text" id="name" v-model="ownerInfo.ame">
            </div>
          </div>
        </div>
  
        <div class="col-12 col-md-3" v-if="ownerInfo.hasOwnProperty('contact')">
          <div class="input-group">
            <div class="input-group-append col-md-4 m-b-20">
              <div class="form-group country_code">
                <Select2Wrapper
                    v-model="ownerInfo.contact_code"
                    id="owner-info-country-owner-contact-code"
                    :options="countryCodes"
                    display-key="code"
                    :search-keys="['code']"
                    placeholder="Owner"
                />
              </div>
            </div>
            <div class="form-group col-md-8">
              <div class="fname" :class="ownerInfo.contact !== '' ? 'focused' : ''">
                <label for="contact">Contact</label>
                <div class="fvalue">
                  <input class="form-control" type="text" id="contact" v-model="ownerInfo.contact"
                         style="border-right:2px solid #1d2848 !important; border-top-right-radius: 5px;border-bottom-right-radius: 5px">
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="col-12 col-md-3" v-if="ownerInfo.hasOwnProperty('email')">
          <div class="fname" :class="ownerInfo.email !== '' ? 'focused' : ''">
            <label for="email">Email</label>
            <div class="fvalue">
              <input class="form-control" type="text" id="email" v-model="ownerInfo.email">
            </div>
          </div>
        </div>
        <div class="col" v-if="ownerInfo.hasOwnProperty('is_nri')">
            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-2">
                <input class="form-check-input" id="is_nri" type="checkbox"
                    v-model="ownerInfo.is_nri">
                <label class="form-check-label" for="is_nri">Is NRI</label>
            </div>
        </div>
      </div>
    </div>
  </template>
  
<script setup>
import { ref, watch,  computed } from 'vue';
// import Select2Wrapper from '../Select2Wrapper.vue';
import Select2Wrapper from '../Select2Wrapper.vue';
  
const props = defineProps({
    countryCodes: {
        type: Array,
        required: true
    },
    hideDetails: {
        type: Array,
        default: () => []
    },
    ownerInfo: { // Now a single ownerInfo prop
        type: Object,
        required: true
    }
});

const ownerTypeCase = [
    {
        id: 1,
        name: 'Builder'
    },
    {
        id: 2,
        name: 'Individual'
    },
    {
        id: 3,
        name: 'Investor'
    },
] 
 
</script>
  
<style scoped>
/* Add any component-specific styles here */
</style>