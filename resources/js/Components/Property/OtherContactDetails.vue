<template>
    <div class="row mt-3">
      <b>Other Contact Details</b>
    </div>
    <template v-for="(otherContact, index) in contactDetails" :key="index">
      <div class="row mt-2">
        <div class="col-12 col-md-2">
          <div class="fname" :class="otherContact.name !== '' ? 'focused' : ''">
            <label :for="`other_contact_name_${index}`">Name</label>
            <div class="fvalue">
              <input
                class="form-control"
                type="text"
                :id="`other_contact_name_${index}`"
                v-model="otherContact.name"
              />
            </div>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="input-group">
            <div class="input-group-append col-md-4 m-b-20">
              <div class="form-group country_code">
                <Select2Wrapper
                    v-model="otherContact.contact_code"
                    id="other-contact-detail-contact-code"
                    :options="countryCodes"
                    display-key="code"
                    :search-keys="['code']"
                    placeholder="Owner"
                />
              </div>
            </div>
            <div class="form-group col-md-8">
              <div class="fname" :class="otherContact.contact !== '' ? 'focused' : ''">
                <label :for="`other_contact_contact_${index}`">Contact</label>
                <div class="fvalue">
                  <input
                    class="form-control"
                    type="text"
                    :id="`other_contact_contact_${index}`"
                    v-model="otherContact.contact"
                    style="border-right: 2px solid #1d2848 !important; border-top-right-radius: 5px; border-bottom-right-radius: 5px"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-2">
          <div class="fname" :class="otherContact.position !== '' ? 'focused' : ''">
            <label :for="`other_contact_position_${index}`">Position</label>
            <div class="fvalue">
              <input
                class="form-control"
                type="text"
                :id="`other_contact_position_${index}`"
                v-model="otherContact.position"
              />
            </div>
          </div>
        </div>
        <div class="col-md-1 m-b-4 mb-4" v-if="index === 0">
          <button class="btn btn-primary" type="button" @click="addContact">
            +
          </button>
        </div>
        <div class="col-md-1 m-b-4 mb-4" v-else>
          <button class="btn btn-danger" type="button" @click="removeContact(index)">
            -
          </button>
        </div>
      </div>
    </template>
  </template>
  
  <script setup>
  // import Select2Wrapper from '../Select2Wrapper.vue';
  import Select2Wrapper from '../../Components/Select2Wrapper.vue';
  
  const props = defineProps({
    countryCodes: {
      type: Array,
      required: true,
    },
    contactDetails: {
      type: Array,
      required: true,
    },
  });
  
  const addContact = () => {
    props.contactDetails.push({ name: '', contact: '', position: '', country_code: '' });
  };
  
  const removeContact = (index) => {
    props.contactDetails.value.splice(index, 1);
  }; 
  
  </script>