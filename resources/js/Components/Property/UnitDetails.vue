<template>
    <div class="row mt-5">
      <b>Unit Details</b>
      <template v-for="(unit, index) in unitDetails" :key="`unit-detail-${index}`">
        <div class="row mt-2">
          <div v-if="!excludeFields.includes('wing')" class="col-12 col-md-2">
            <div class="fname" :class="unit.wing !== '' ? 'focused' : ''">
              <label :for="`unit_wing_${index}`">Wing</label>
              <div class="fvalue">
                <input class="form-control" type="text" v-model="unit.wing" :id="`unit_wing_${index}`">
              </div>
            </div>
          </div>
          <div v-if="!excludeFields.includes('unit_number')" class="col-12 col-md-2">
            <div class="fname" :class="unit.unit_number !== '' ? 'focused' : ''">
              <label :for="`unit_unit_number_${index}`">Unit No</label>
              <div class="fvalue">
                <input class="form-control" type="text" v-model="unit.unit_number" :id="`unit_unit_number_${index}`">
              </div>
            </div>
          </div>
          <div v-if="!excludeFields.includes('availability')" class="col-md-2 m-b-4 mb-4">
            <Select2Wrapper
                v-model="unit.availability_status"
                :id="`unit-detail-${index}-availability-status`"
                :options="availabilityStatusCase"
                display-key="name"
                :search-keys="['name']"
                placeholder="Availability"
            />
          </div>
          <div v-if="!excludeFields.includes('price_rent')" class="col-12 col-md-2">
            <div class="fname" :class="unit.price_rent !== '' ? 'focused' : ''">
              <label :for="`unit_price_rent_${index}`">Price Rent</label>
              <div class="fvalue">
                <input class="form-control" type="text" v-model="unit.price_rent" :id="`unit_price_rent_${index}`">
              </div>
            </div>
          </div>
          <div v-if="!excludeFields.includes('furniture_status')" class="col-md-2 m-b-4 mb-4">

            <Select2Wrapper
                v-model="unit.furniture_status"
                :id="`unit-detail-${index}-furniture-status`"
                :options="furnitureStatusCase"
                display-key="name"
                :search-keys="['name']"
                placeholder="Furnished Status"
            />
          </div>
          <div class="col-md-1 m-b-4 mb-4">
            <button class="btn" :class="index === 0 ? 'btn-primary' : 'btn-danger'" type="button" @click="index === 0 ? addUnit() : removeUnit()">
              {{ index === 0 ? '+' : '-' }}
            </button>
          </div>
        </div>
      </template>
    </div>
  </template>
  
<script setup>
// import Select2Wrapper from '../Select2Wrapper.vue';
import Select2Wrapper from '../Select2Wrapper.vue';
const props = defineProps({
    unitDetails: {
        type: Array,
        required: true
    },
    propertyCategory: {
        type: Number,
        required: true
    },
    excludeFields: {
        type: Array,
        default: () => []
    }
});

const addUnit = () => {
    props.unitDetails.push({
        id:'',
        wing: '',
        unit_number: '',
        availability: '',
        price_rent: '',
        furniture_status: ''
    });
}
   
const removeUnit = (index) => {
    props.unitDetails.splice(index, 1);
}

const availabilityStatusCase =  [
    {
        id: 1,
        name: 'Rent Out',
    },
    {
        id: 2,
        name: 'Sold Out',
    },
];

const furnitureStatusCase = [
    {
        id: 1,
        name: 'Furnished'
    },
    {
        id: 2,
        name: 'Semi Furnished'
    },
    {
        id: 3,
        name: 'Unfurnished'
    },
    {
        id: 4,
        name: 'Can Furnished'
    },
];
</script>
  
<style scoped>
  .focused label {
    font-weight: bold;
  }
</style>
  