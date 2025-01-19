<div class="setup-content" id="project-info">
    <div class="col-xs-12">
        <div class="col-md-12">
            <div class="row">
                <input type="hidden" name="this_data_id" id="this_data_id">
                <div>
                    <label><b>Builder Information</b></label>
                </div>
                @if ($role != 'builder')
                <div class="form-group col-md-3 m-b-4 mb-3">
                    <select class="form-select" id="builder_id" :class="errors.hasOwnProperty('builder_id') ? 'is-invalid' : ''">
                        <option value=""> Builder Name</option>
                        @foreach ($builders as $builder)
                            <option value="{{ $builder->id }}">{{ $builder->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger new_error d-none" id="err_builder_id">Builder name is required.</span>
                    <div class="invalid-feedback">
                        <span x-text="errors.builder_id"></span>
                    </div>
                </div>
                @endif
                <div class="form-group col-md-6 m-b-4 mb-3">
                    <div class="fname" :class="website == '' ? '' : 'focused' ">
                        <label for="Project Name">Website</label>
                        <div class="fvalue">
                            <input
                                class="form-control"
                                name="website"
                                x-model="website"
                                id="website"
                                type="text"
                                style="text-transform: lowercase !important;"
                                autocomplete="off"
                                :class="errors.hasOwnProperty('website') ? 'is-invalid' : ''"
                            >
                            <span class="text-danger new_error d-none" id="err_website">Website is required.</span>
                            <div class="invalid-feedback">
                                <span x-text="errors.website"></span>
                            </div>
                        </div>
                    </div>
                </div>                    
                <div>
                    <label><b>Project Information</b></label>
                </div>
                <div class="form-group col-md-6 m-b-20">
                    <div class="fname" :class="project_name == '' ? '' : 'focused' ">
                        <label for="Project Name">Project Name</label>
                        <div class="fvalue">
                            <input
                                class="form-control"
                                name="project_name"
                                x-model="project_name"
                                type="text"
                                id="project_name"
                                autocomplete="off"
                                :class="errors.hasOwnProperty('project_name') ? 'is-invalid' : ''"
                            >
                            <span class="text-danger new_error d-none" id="err_project_name">Project name is required.</span>
                            <div class="invalid-feedback">
                                <span x-text="errors.project_name"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="form-group col-md-6">
                        <div class="fname" :class="address == '' ? '' : 'focused' ">
                            <label for="Address">Address</label>
                            <div class="fvalue">
                                <input class="form-control" id="address" name="address" x-model="address" type="text" autocomplete="off" :class="errors.hasOwnProperty('address') ? 'is-invalid' : ''">
                                <span class="text-danger new_error d-none" id="err_address">Address is required.</span>
                                <div class="invalid-feedback">
                                    <span x-text="errors.address"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-md-3">
                        <select id="state_id" :class="errors.hasOwnProperty('state') ? 'is-invalid' : ''">
                            <option value="" disabled>Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger new_error d-none" id="err_state_id">State name is required.</span>
                        <div class="invalid-feedback">
                            <span x-text="errors.state"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <select id="city_id" class="form-select" :class="errors.hasOwnProperty('city') ? 'is-invalid' : ''" disabled=true>
                            <option value="" disabled>Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city['id'] }}">{{ $city['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger new_error d-none" id="err_city_id">City name is required.</span>
                        <div class="invalid-feedback">
                            <span x-text="errors.city"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <select class="form-select" id="area_id" :class="errors.hasOwnProperty('locality') ? 'is-invalid' : ''" disabled=true>
                            <option value="" disabled>Select Locality</option>
                            @foreach ($areas as $area)
                            <option data-pincode="{{ $area->pincode }}"
                                    data-city_id="{{ $area->city_id }}"
                                    data-state_id="{{ $area->state_id }}"
                                    value="{{ $area->id }}">
                                    {{ $area->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger new_error d-none" id="err_area_id">Locality name is required.</span>
                        <div class="invalid-feedback">
                            <span x-text="errors.locality"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="fname" :class="pincode == '' ? '' : 'focused' ">
                            <label for="Pincode">Pincode</label>
                            <div class="fvalue">
                                <input
                                    class="form-control"
                                    x-model="pincode"
                                    name="pincode"
                                    id="pincode"
                                    :class="errors.hasOwnProperty('pincode') ? 'is-invalid' : ''"
                                    type="text" autocomplete="off"
                                >
                                <span class="text-danger new_error d-none" id="err_pincode">Pincode field is required.</span>
                                <div class="invalid-feedback">
                                    <span x-text="errors.pincode"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="form-group col-md-6 m-b-20">
                        <div class="fname" :class="location_link == '' ? '' : 'focused' ">
                            <label for="location_link">Location Link</label>
                            <div class="fvalue">
                                <input class="form-control" style="text-transform: lowercase !important;" id="location_link" name="location_link" x-model="location_link" type="text" autocomplete="off" :class="errors.hasOwnProperty('location_link') ? 'is-invalid' : ''">
                                <span class="text-danger new_error d-none" id="err_location_link">Location link field is required.</span>
                                <div class="invalid-feedback">
                                    <span x-text="errors.location_link"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="form-group col-md-7">
                                <div class="fname" :class="land_size == '' ? '' : 'focused' ">
                                    <label for="land Size">Land Size</label>
                                    <input class="form-control" id="land_size" type="text" x-model="land_size"
                                    autocomplete="off" :class="errors.hasOwnProperty('land_area') ? 'is-invalid' : ''">
                                </div>
                            </div>
                            <div class="input-group-append col-md-5">
                                <div class="form-group form_measurement">
                                    <select class="form-select form_measurement measure_select" id="land_size_select">
                                        @forEach($land_units as $land_unit)
                                            <option value="{{ $land_unit->id }}" {{ $land_unit->id == 1 ? 'selected' : '' }}>{{ $land_unit->unit_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger new_error d-none" id="err_land_size">Land size field is required.</span>
                    </div>
                </div>

                <div class="form-group col-md-4 mt-1">
                    <div class="fname" :class="rera_no == '' ? '' : 'focused' ">
                        <label for="Rarea No">Rera No</label>
                        <div class="fvalue">
                            <input class="form-control" id="rera" x-model="rera_no" type="text" autocomplete="off" :class="errors.hasOwnProperty('rera_number') ? 'is-invalid' : ''" style="text-transform: none !important;">
                            <span class="text-danger new_error d-none" id="err_rera">Rera number field is required.</span>
                            <div class="invalid-feedback">
                                <span x-text="errors.rera_number"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4 m-b-20 mt-1">
                    <select class="form-select form-design" id="project_status" onchange="setProjectStatusInput(this)" :class="errors.hasOwnProperty('project_status') ? 'is-invalid' : ''">
                        <option value="">Project Status</option>
                        <option value="142">Ready Possession</option>
                        <option value="143">Under Construction</option>
                    </select>
                    <span class="text-danger new_error d-none" id="err_project_status">Project status field is required.</span>
                    <div class="invalid-feedback">
                        <span x-text="errors.project_status"></span>
                    </div>
                </div>

                <div
                    class="form-group col-md-4 m-b-20"
                    style="margin-top:3px;"
                    id="project_status_input">
                </div>
                
                <div class="row">
                    <div>
                        <label><b>Contact Details</b></label>
                    </div>

                    <template x-for="(other_contact, index) in other_contact_details">
                        <div class="row">
                            <div class="form-group col-md-2 m-b-20" id="other_contact_1">
                                <div class="fname" :class="other_contact.name == '' ? '' : 'focused' ">
                                    <label>Name</label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control" 
                                            x-model="other_contact.name"
                                            :id="`other_contact_name_${index}`"
                                            type="text"
                                            :class="errors.hasOwnProperty(`other_contact_details.${index}.name`) ? 'is-invalid' : ''"
                                        >
                                        <span class="text-danger new_error d-none" :id="`err_other_contact_name_${index}`">Name field is required.</span>
                                        <div class="invalid-feedback">
                                            <span x-text="errors[`other_contact_details.${index}.name`]"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3 m-b-20">
                                <div class="fname" :class="other_contact.mobile == '' ? '' : 'focused' ">
                                    <label>Mobile</label>
                                    <div class="fvalue">
                                        <input class="form-control" 
                                        x-model="other_contact.mobile"
                                        :id="`other_contact_mobile_${index}`"
                                        name="other_contact_mobile" type="text" autocomplete="off" data-bs-original-title="" title="">
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_other_contact_mobile_${index}`">Contact field is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-3 m-b-20">
                                <div class="fname" :class="other_contact.email == '' ? '' : 'focused' ">
                                    <label>Email</label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control"
                                            x-model="other_contact.email"
                                            :id="`other_contact_email_${index}`"
                                            style="text-transform: none !important;"
                                            name="other_contact_email" type="text" autocomplete="off" data-bs-original-title="" title=""
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_other_contact_email_${index}`">Email field is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-3 m-b-20">
                                <div class="fname" :class="other_contact.designation == '' ? '' : 'focused' ">
                                    <label>Designation</label>
                                    <div class="fvalue">
                                        <input
                                            class="form-control"
                                            :id="`other_contact_designation_${index}`"
                                            x-model="other_contact.designation"
                                            name="other_contact_designation"
                                            type="text" autocomplete="off" data-bs-original-title="" title=""
                                        >
                                    </div>
                                    <span class="text-danger new_error d-none" :id="`err_other_contact_designation_${index}`">Designation field is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-1 m-b-4 mb-3" x-show="index > 0">
                                <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" @click="removeOtherContact(`${index}`)" title="">-</button>
                            </div>
                            <div class="form-group col-md-1 m-b-4 mb-3" x-show="index == 0">
                                <button class="add_contacts btn btn-primary" style="border-radius:5px;" type="button" data-bs-original-title="" @click="addOtherContact()" title="">+</button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-3 m-b-20">
                        <div class="fname">
                            <label class="select2_label" for="Restricted User">Restricted User</label>
                            <select class="form-select" id="restrictions"
                            multiple="multiple" :class="errors.hasOwnProperty('restricted_user') ? 'is-invalid' : ''">
                                <option value="">Select user</option>
                                <option value="130">Bachelors</option>
                                <option value="131">Hospital</option>
                                <option value="132">Restaurant</option>
                                <option value="133">Company Guest House</option>
                                <option value="134">Night Call Center</option>
                                <option value="135">SPA & Massage Parlor</option>
                            </select>
                            <span class="text-danger new_error d-none" id="err_restrictions">At least one restrictions is required.</span>
                            <div class="invalid-feedback">
                                <span x-text="errors.restricted_user"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary nextBtn pull-right" style="border-radius:5px;"
                type="button" @click="tabChange('contact-wing')">Next</button>
        </div>
    </div>
</div>
