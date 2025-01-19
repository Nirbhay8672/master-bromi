@extends('builder.layouts.app')
@section('content')
    @php
        $is_dynamic_form = true;
    @endphp
    <div class="page-body" x-data="add_project_form">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Project & Builder Information</h5>
                            <template x-if="id != ''"><strong>Update Project</strong></template>
                            <template x-if="id == ''"><strong>Create Project</strong></template>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-3" style="margin-left: -20px;">
                                    <div class="bromi-form-wizard stepwizard">
                                        <div class="stepwizard-row setup-panel">
                                            <div
                                                class="stepwizard-step mb-5"
                                                :class="Object.keys(errors).length == 0 ? '' : 'text-danger'"
                                                style="text-align:initial"
                                            >
                                                <button class="btn btn-primary" @click="tabChange('project-info')" id="project-info-link">1</button>
                                                <p class="ms-2">Project & Builder Information</p>
                                            </div>
                                            <div
                                                class="stepwizard-step mb-5"
                                                style="text-align:initial"
                                            >
                                                <button class="btn btn-light" @click="tabChange('contact-wing')" id="contact-wing-link">2</button>
                                                <p class="ms-2" :class="Object.keys(errors).length == 0 ? '' : 'text-danger'">Project Type & Basic Info</p>
                                            </div>
                                            <div
                                                class="stepwizard-step"
                                                style="text-align:initial"
                                            >
                                                <button class="btn btn-light" @click="tabChange('amenities')" id="amenities-link">3</button>
                                                <p class="ms-2" :class="Object.keys(errors).length == 0 ? '' : 'text-danger'">Parking & Amenities</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-9 border-start ps-4">
                                    <form class="form-bookmark needs-validation modal_form">

                                        @include('admin.projects.includes.first_section')

                                        @include('builder.projects.includes.second_section')
                                        
                                        <div class="setup-content d-none" id="amenities">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div>
                                                            <label><b>Parking Details</b></label>
                                                        </div>
                                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-4 m-b-20">
                                                            <input
                                                                class="project_amenity form-check-input"
                                                                id="parking_four_wheeler"
                                                                x-model="free_alloted_for_two_wheeler"
                                                                type="checkbox"
                                                            >
                                                            <label class="form-check-label" for="parking_four_wheeler">Free Alloted Parking for Four Wheeler</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                                            <input
                                                                class="project_amenity form-check-input"
                                                                id="parking_two_wheeler"
                                                                free_alloted_for_two_wheeler
                                                                x-model="free_alloted_for_four_wheeler"
                                                                type="checkbox"
                                                            >
                                                            <label class="form-check-label" for="parking_two_wheeler">Free Alloted Parking for Two Wheeler</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="available_for_purchase" type="checkbox" x-model="available_for_purchase">
                                                            <label class="form-check-label"
                                                                for="available_for_purchase">Available for Purchase</label>
                                                        </div>

                                                        <div class="row" x-show="available_for_purchase">
                                                            <div class="form-group col-md-3 m-b-20">
                                                                <div class="fname" :class="total_number_of_parking == '' ? '' : 'focused' ">
                                                                    <label>No. Of Parking</label>
                                                                    <div class="fvalue">
                                                                        <input class="form-control" min="1" max="10" x-model="total_number_of_parking" name="number_of_parking" type="number" autocomplete="off" data-bs-original-title="" title="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <hr>
                                                        <div>
                                                            <label><b>Basement Parking</b></label>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-3 m-b-20">
                                                            <div class="fname" :class="total_floor_for_parking == '' ? '' : 'focused' ">
                                                                <label>Total floor for parking</label>
                                                                <div class="fvalue">
                                                                    <input
                                                                        class="form-control"
                                                                        x-model="total_floor_for_parking"
                                                                        type="text"
                                                                        :class="errors.hasOwnProperty('total_floor_for_parking') ? 'is-invalid' : ''"
                                                                        id="total_floor_for_parking"
                                                                        @change="addRows()"
                                                                    >
                                                                    <div class="invalid-feedback">
                                                                        <span x-text="errors.total_floor_for_parking"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <template x-for="(parking , index) in parking_details">
                                                            <div class="row mt-3">
                                                                <div class="form-group col-md-2 m-b-20">
                                                                    <div class="fname" :class="parking.floor_number !=null ? 'focused' : '' ">
                                                                        <label>Floor No.</label>
                                                                        <div class="fvalue">
                                                                            <input class="form-control" x-model="parking.floor_number" name="floor_number" type="text" autocomplete="off" data-bs-original-title="" title="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3 m-b-20">
                                                                    <div class="fname" :class="parking.ev_charging_point == '' ? '' : 'focused' ">
                                                                        <label>EV Charging Point</label>
                                                                        <div class="fvalue">
                                                                            <input class="form-control" x-model="parking.ev_charging_point" name="ev_charging_point" type="text" autocomplete="off" data-bs-original-title="" title="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3 m-b-20">
                                                                    <div class="fname" :class="parking.hydraulic_parking == '' ? '' : 'focused' ">
                                                                        <label>Hydraulic Parking</label>
                                                                        <div class="fvalue">
                                                                            <input class="form-control" x-model="parking.hydraulic_parking" name="hydraulic_parking" type="text" autocomplete="off" data-bs-original-title="" title="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <div class="input-group">
                                                                        <div class="form-group col-md-7 m-b-20">
                                                                            <div class="fname" :class="parking.height_of_basement == '' ? '' : 'focused' ">
                                                                                <label class="mb-0">Height of Basement</label>
                                                                                <div class="fvalue">
                                                                                    <input class="form-control" name="height_of_basement" x-model="parking.height_of_basement" type="text" autocomplete="off" data-bs-original-title="" title="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="input-group-append col-md-5 m-b-20">
                                                                            <div class="form-group">
                                                                                <select class="form-select" name="height_of_basement_select" tabindex="-1" aria-hidden="true" :id="`height_basement_select_${index}`">
                                                                                    <option selected="selected" value="1">Ft.</option>
                                                                                    <option value="3">Meter</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>

                                                    <div class="row">
                                                        <hr>
                                                        <div>
                                                            <label><b>Amenities</b></label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="amenity_club_house" type="checkbox" x-model="amenities" value="club_house">
                                                            <label class="form-check-label" for="amenity_club_house">Club
                                                                house</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="amenity_passenger_lift" type="checkbox" x-model="amenities" value="passenger_lift">
                                                            <label class="form-check-label"
                                                                for="amenity_passenger_lift">Passenger Lift</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="amenity_service_lift" type="checkbox" x-model="amenities" value="service_lift">
                                                            <label class="form-check-label"
                                                                for="amenity_service_lift">Service Lift</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="amenity_streature_lift" type="checkbox" x-model="amenities" value="streature_lift">
                                                            <label class="form-check-label"
                                                                for="amenity_streature_lift">Streature Lift</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="amenity_ac" type="checkbox" x-model="amenities" value="central_ac">
                                                            <label class="form-check-label" for="amenity_ac">Central
                                                                AC</label>
                                                        </div>
                                                        <div
                                                            class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                            <input class="project_amenity form-check-input"
                                                                id="amenity_gym" type="checkbox" x-model="amenities" value="gym">
                                                            <label class="form-check-label" for="amenity_gym">Gym</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div>
                                                        <input type="hidden" :class="errors.hasOwnProperty('amenities') ? 'is-invalid' : ''">
                                                        <div class="invalid-feedback">
                                                            <span x-text="errors.amenities"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <hr>
                                                        <div>
                                                            <label><b>Images/Documents</b></label>
                                                        </div>
                                                        <div id="uploadImageBox" class="row">
                                                            <div class="form-group col-md-4 m-b-4 mt-1">
                                                                <select class="form-select" id="image_category" :class="errors.hasOwnProperty('document_category') ? 'is-invalid' : ''">
                                                                    <option value=""> Category</option>
                                                                    <option value="1">Building Elevation</option>
                                                                    <option value="2">Common Amenities Photos</option>
                                                                    <option value="3">Master Layout Of Building
                                                                    </option>
                                                                    <option value="4">Brochure</option>
                                                                    <option value="5">Cost Sheet</option>
                                                                    <option value="6">Other</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    <span x-text="errors.document_category"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 m-b-4 mb-3">
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" :class="errors.hasOwnProperty('document_image') ? 'is-invalid' : ''" accept="image/*,.pdf" type="file" id="document_image" name="document_image">
                                                                        <div class="invalid-feedback">
                                                                            <span x-text="errors.document_image"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-1 m-b-4 mb-3">
                                                                <button class="btn btn-primary" style="border-radius:5px;" type="button" @click="addOtherImageOrDoc()" title="">+</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                    <template x-for="(other_doc, index) in other_documents">
                                                        <div class="row">
                                                            <div class="form-group col-md-4 m-b-4 mt-1">
                                                                <select class="form-select" :id="`other_doc_${index}`" x-model="other_doc.document_type">
                                                                    <option value=""> Category</option>
                                                                    <option value="1">Building Elevation</option>
                                                                    <option value="2">Common Amenities Photos</option>
                                                                    <option value="3">Master Layout Of Building
                                                                    </option>
                                                                    <option value="4">Brochure</option>
                                                                    <option value="5">Cost Sheet</option>
                                                                    <option value="6">Other</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6 m-b-4 mb-3">
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" accept="image/*,.pdf" type="file" :id="`document_image_${index}`" name="document_image">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-1 m-b-4 mb-3">
                                                                <button class="btn btn-primary" style="border-radius:5px;" type="button" @click="removeOtherImageOrDoc(index)" title="">-</button>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    </div>
                                                    

                                                    <div class="row mt-3">
                                                        <div>
                                                            <label><b>Catlog File</b></label>
                                                        </div>
                                                        <div class="form-group col-md-6 m-b-4 mb-3">
                                                            <div class="fname">
                                                                <div class="fvalue">
                                                                    <input class="form-control" :class="errors.hasOwnProperty('catlog_file') ? 'is-invalid' : ''" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" id="catlog_file" name="catlog_file">
                                                                    <div class="invalid-feedback">
                                                                        <span x-text="errors.catlog_file"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="form-group col-md-6 m-b-4 mb-3">
                                                            <div class="fname">
                                                                <div class="fvalue">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter remark"
                                                                        x-model="remark"
                                                                        :class="errors.hasOwnProperty('remark') ? 'is-invalid' : ''"
                                                                    >
                                                                    <div class="invalid-feedback">
                                                                        <span x-text="errors.remark"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <button @click="submitHandle()" class="btn btn-secondary pull-right"
                                                    style="border-radius:5px;"
                                                    type="button">Finish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $city_encoded = json_encode($cities);
            $state_encoded = json_encode($states);
            $area_encoded = json_encode($areas);
            $project_data = isset($id) ? json_encode($id) : null;
            
            $first_state = json_encode($first_state);
            $first_city = json_encode($first_city);
        @endphp
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="text/javascript">

        document.getElementById('total_floor_for_parking').addEventListener('keypress', event => {
            if (!`${event.target.value}${event.key}`.match(/^[1-9]{0,2}$/)) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            }
        });

        var cities = @Json($city_encoded);
        var states = @Json($state_encoded);
        var areas = @Json($area_encoded);

        citiesar = JSON.parse(cities);
    	areass = JSON.parse(areas);

        document.addEventListener('alpine:init', () => {

            let data = @json($project_data);

            Alpine.data('add_project_form', () => ({

                init() {
                    
                    let state_id = JSON.parse(@Json($first_state));
                    let city_id = JSON.parse(@Json($first_city));
                    
                    $("#state_id").val(state_id['id']).trigger('change');
                    document.getElementById('city_id').disabled = false;

                    $('#city_id').html('');
                    $('#city_id').append(`<option value="" selected disabled>City</option>`);
                    for (let i = 0; i < citiesar.length; i++) {
                        if (citiesar[i]['state_id'] == $("#state_id").val()) {
                            $('#city_id').append('<option value="' + citiesar[i]['id'] + '">' + citiesar[i][
                                'name'
                            ] + '</option>')
                        }
                    }
                    $('#city_id').select2();
                    
                    $("#city_id").val(city_id['id']).trigger('change');
                    document.getElementById('area_id').disabled = false;

                    $('#area_id').html('');
                    $('#area_id').append(`<option value="" selected disabled>Locality</option>`);
                    for (let i = 0; i < areass.length; i++) {
                        if (areass[i]['state_id'] == $("#state_id").val()) {
                            $('#area_id').append(`<option value="${areass[i]['id']}"
                                data-pincode="${areass[i]['pincode']}"
                                data-city_id="${areass[i]['city_id']}"
                                data-state_id="${areass[i]['state_id']}">
                                ${areass[i]['name']}
                            </option>`);
                        }
                    }
                    $('#area_id').select2();
                    
                    if(data) {

                        let project_data = JSON.parse(data);
                        
                        
                        document.getElementById('state_id').disabled = false;
                        document.getElementById('city_id').disabled = false;
                        document.getElementById('area_id').disabled = false;

                        $('#city_id').select2('destroy');
    					$('#area_id').select2('destroy');
    					
    					$("#state_id").val(project_data['state_id']).trigger('change');
    
    					$('#city_id').html('');
                        for (let i = 0; i < citiesar.length; i++) {
    						if (citiesar[i]['state_id'] == $("#state_id").val()) {
    							$('#city_id').append('<option value="' + citiesar[i]['id'] + '">' + citiesar[i][
    								'name'
    							] + '</option>')
    						}
    					}
    					$('#city_id').select2();

                        $("#city_id").val(project_data['city_id']).trigger('change');

                        $('#area_id').html('');
                        $('#area_id').append(`<option value="" selected disabled>Locality</option>`);
                        for (let i = 0; i < areass.length; i++) {
    						if (areass[i]['state_id'] == $("#state_id").val()) {
    							$('#area_id').append(`<option value="${areass[i]['id']}"
                                    data-pincode="${areass[i]['pincode']}"
                                    data-city_id="${areass[i]['city_id']}"
                                    data-state_id="${areass[i]['state_id']}">
                                    ${areass[i]['name']}
                                </option>`);
    						}
    					}
    					$('#area_id').select2();
					
                        // first section
                        this.id = project_data['id'];
                        $("#builder_id").val(project_data['builder_id']).trigger('change');
                        this.website = project_data['website'] ?? '';

                        this.other_contact_details = JSON.parse(project_data['contact_details']) ?? [{'name' : '','mobile' : '','email' : '','designation' : ''}];

                        this.project_name = project_data['project_name'];
                        this.address = project_data['address'];

                        $("#area_id").val(project_data['area_id']).trigger('change');
                        
                        this.location_link = project_data['location_link'] ?? '';
                        this.pincode = project_data['pincode'] ?? '';
                        this.land_size = project_data['land_area'] ?? '';

                        this.$nextTick(function () {
                            $("#land_size_select").val(project_data['land_size_unit']).trigger('change');
                        });

                        this.rera_no = project_data['rera_number'] ?? '';
                        this.number_of_unit_in_project = project_data['number_of_units_in_project'];

                        $("#project_status").val(project_data['project_status']).trigger('change');

                        if(project_data['project_status'] == 142) {
                            $('#status').val(project_data['project_status_question']).trigger('change');
                        }

                        if(project_data['project_status'] == 143) {
                            this.project_status_question = project_data['project_status_question'];
                        }
                        
                        let restri_data = [];
                        JSON.parse(project_data['restrictions']).forEach((restriction) => {
                            if(restriction != '') {
                                restri_data.push(restriction);
                            } 
                        });
                    
                        $("#restrictions").val(restri_data).trigger('change');
                        $("#restrictions").closest('.fname').addClass('focused');
                    
                        // second section
                        this.sub_categories = [];
                        this.sub_category_single = '';
                        this.property_type = parseInt(project_data['property_type']);
                        $(`#propertytype${this.property_type}`).trigger('click');


                        if(project_data['property_type'] == 88 || project_data['property_type'] == 89) {

                            tower_details_object = JSON.parse(project_data['tower_details']);

                            if(project_data['property_type'] == 88) {
                                this.sub_category_single = project_data['sub_category_single'];
                                this.sub_categories = JSON.parse(project_data['sub_categories']);
                            }

                            if(project_data['property_type'] == 89) {
                                if(JSON.parse(project_data['sub_categories']).length > 0) {
                                    this.sub_categories = JSON.parse(project_data['sub_categories']);
                                } else {
                                    this.sub_category_single = project_data['sub_category_single'];
                                }
                                this.is_flat_or_penthouse = JSON.parse(tower_details_object['if_flat_or_penthouse']);
                            }

                            let array = {
                                14 : '1BHK',
                                15 : '2BHK',
                                16 : '3BHK',
                                17 : '4BHK',
                                18 : '5BHK',
                                19 : '5+BHK',
                            };

                            this.sub_categories.forEach(element => {
                                this.sub_category_array.push(array[element]);
                            });

                            let _this = this;
                            
                            this.if_office_or_retail = JSON.parse(tower_details_object['if_office_or_retail']);
                            this.$nextTick(function () {
                                $("#second_front_road_map_unit_select").val(parseInt(_this.if_office_or_retail.front_road_width_map_unit)).trigger('change');
                                $("#first_front_road_map_unit_select").val(parseInt(_this.if_office_or_retail.front_road_width_map_unit)).trigger('change');
                            });

                            this.if_office_tower_details = JSON.parse(tower_details_object['if_office_tower_details']);
                            this.if_office_tower_details_with_specification = tower_details_object['if_office_tower_details_with_specification'] == 'true' ? true  : false;

                            this.if_office_tower_details.forEach((tower_detail, index) => {
                                _this.$nextTick(function () {
                                    $(`#second_tower_detail_carpet_from_to_select_${index}`).val(tower_detail.carpet_from_to_map_unit).trigger('change');
                                    $(`#second_tower_detail_built_from_to_select_${index}`).val(tower_detail.built_from_to_map_unit).trigger('change');
                                    $(`#second_tower_detail_saleable_from_to_select_${index}`).val(tower_detail.saleable_from_to_map_unit).trigger('change');
                                    $(`#second_ceiling_height_map_unit_select_${index}`).val(tower_detail.ceiling_height_map_unit).trigger('change');
                                });
                            });

                            this.if_retail_tower_details = JSON.parse(tower_details_object['if_retail_tower_details']);

                            this.if_retail_tower_details.forEach((tower_detail, index) => {
                                _this.$nextTick(function () {
                                    $(`#floor_category_${index}`).val(tower_detail.sub_category).trigger('change');
                                    $(`#tower_size_from_to_select_${index}`).val(parseInt(tower_detail.size_from_map_unit)).trigger('change');
                                    $(`tower_front_opening_select_${index}`).val(tower_detail.tower_front_opening_map_unit).trigger('change');
                                    $(`tower_ceiling_select_${index}`).val(tower_detail.tower_ceiling_map_unit).trigger('change');

                                    $(`#extra_floor_category_${index}`).val(tower_detail.sub_category).trigger('change');
                                    $(`#extra_tower_size_from_to_select_${index}`).val(parseInt(tower_detail.size_from_map_unit)).trigger('change');
                                    $(`extra_tower_front_opening_select_${index}`).val(tower_detail.tower_front_opening_map_unit).trigger('change');
                                    $(`extra_tower_ceiling_select_${index}`).val(tower_detail.tower_ceiling_map_unit).trigger('change');
                                });
                            });

                            this.if_residential_only_wings.wing_details = JSON.parse(project_data['wing_details']);

                            this.if_residential_only_wings.wing_details.forEach((wing, index) => {
                                _this.$nextTick(function () {
                                    $(`#extra_sub_category_of_wings_${index}`).val(wing.sub_categories).trigger('change');
                                });
                            });

                            this.if_residential_only_units.unit_details = JSON.parse(project_data['unit_details']);

                            this.if_residential_only_units.unit_details.forEach((unit_details, index) => {
                                _this.$nextTick(function () {
                                    $(`#wing_array_${index}`).val(unit_details.wing).trigger('change');
                                    $(`#saleable_area_select_${index}`).val(parseInt(unit_details.saleable_map_unit)).trigger('change');
                                    $(`#built_up_area_select_${index}`).val(parseInt(unit_details.built_up_map_unit)).trigger('change');
                                    $(`#carpet_area_select_${index}`).val(parseInt(unit_details.carpet_area_map_unit)).trigger('change');
                                    $(`#wash_area_select_${index}`).val(parseInt(unit_details.wash_area_map_unit)).trigger('change');
                                    $(`#balcony_area_select_${index}`).val(parseInt(unit_details.balcony_area_map_unit)).trigger('change');
                                    $(`#floor_height_select_${index}`).val(parseInt(unit_details.floor_height_map_unit)).trigger('change');
                                    $(`#ceiling_height_select_${index}`).val(parseInt(unit_details.ceiling_height_map_unit)).trigger('change');
                                    $(`#terrace_carpet_select_${index}`).val(parseInt(unit_details.terrace_carpet_area_map_unit)).trigger('change');
                                    $(`#terrace_saleable_select_${index}`).val(parseInt(unit_details.terrace_saleable_area_map_unit)).trigger('change');

                                    $(`#second_wing_array_${index}`).val(unit_details.wing).trigger('change');
                                    $(`#second_saleable_area_select_${index}`).val(parseInt(unit_details.saleable_map_unit)).trigger('change');
                                    $(`#second_built_up_area_select_${index}`).val(parseInt(unit_details.built_up_map_unit)).trigger('change');
                                    $(`#second_carpet_area_select_${index}`).val(parseInt(unit_details.carpet_area_map_unit)).trigger('change');
                                    $(`#second_wash_area_select_${index}`).val(parseInt(unit_details.wash_area_map_unit)).trigger('change');
                                    $(`#second_balcony_area_select_${index}`).val(parseInt(unit_details.balcony_area_map_unit)).trigger('change');
                                    $(`#second_floor_height_select_${index}`).val(parseInt(unit_details.floor_height_map_unit)).trigger('change');
                                    $(`#second_ceiling_height_select_${index}`).val(parseInt(unit_details.ceiling_height_map_unit)).trigger('change');
                                    $(`#second_terrace_carpet_select_${index}`).val(parseInt(unit_details.terrace_carpet_area_map_unit)).trigger('change');
                                    $(`#second_terrace_saleable_select_${index}`).val(parseInt(unit_details.terrace_saleable_area_map_unit)).trigger('change');
                                });
                            });

                            this.if_residential_only_wings.wing_details.forEach((wing_details, index) => {
                                _this.$nextTick(function () {
                                    $(`#sub_category_of_wings_${index}`).val(wing_details.sub_categories).trigger('change');
                                    $(`#extra_sub_category_of_wings_${index}`).val(wing_details.sub_categories).trigger('change');
                                });
                            });

                        } else {
                            this.property_category = parseInt(project_data['property_category']);
                            $(`#category-${this.property_category}`).trigger('click');

                            if(JSON.parse(project_data['sub_categories']).length > 0) {
                                this.sub_categories = JSON.parse(project_data['sub_categories']);
                            } else {
                                this.sub_category_single = project_data['sub_category_single'];
                            }

                            let array = {
                                14 : '1BHK',
                                15 : '2BHK',
                                16 : '3BHK',
                                17 : '4BHK',
                                18 : '5BHK',
                                19 : '5+BHK',
                            };

                            this.sub_categories.forEach(element => {
                                this.sub_category_array.push(array[element]);
                            });

                            tower_details_object = JSON.parse(project_data['tower_details']);
                            
                            if(this.property_category == 254 || this.property_category == 257) {
                                this.is_flat_or_penthouse = JSON.parse(tower_details_object['if_flat_or_penthouse']);
                            }

                            if(this.property_type == 87) {
                                this.if_residential_only_wings.wing_details = JSON.parse(project_data['wing_details']);
                                this.if_residential_only_units.unit_details = JSON.parse(project_data['unit_details']);
                                let _this = this;

                                this.if_residential_only_units.unit_details.forEach((unit_details, index) => {
                                    _this.$nextTick(function () {
                                        $(`#wing_array_${index}`).val(unit_details.wing).trigger('change');
                                        $(`#saleable_area_select_${index}`).val(parseInt(unit_details.saleable_map_unit)).trigger('change');
                                        $(`#built_up_area_select_${index}`).val(parseInt(unit_details.built_up_map_unit)).trigger('change');
                                        $(`#carpet_area_select_${index}`).val(parseInt(unit_details.carpet_area_map_unit)).trigger('change');
                                        $(`#wash_area_select_${index}`).val(parseInt(unit_details.wash_area_map_unit)).trigger('change');
                                        $(`#balcony_area_select_${index}`).val(parseInt(unit_details.balcony_area_map_unit)).trigger('change');
                                        $(`#floor_height_select_${index}`).val(parseInt(unit_details.floor_height_map_unit)).trigger('change');
                                        $(`#ceiling_height_select_${index}`).val(parseInt(unit_details.ceiling_height_map_unit)).trigger('change');
                                        $(`#terrace_carpet_select_${index}`).val(parseInt(unit_details.terrace_carpet_area_map_unit)).trigger('change');
                                        $(`#terrace_saleable_select_${index}`).val(parseInt(unit_details.terrace_saleable_area_map_unit)).trigger('change');

                                        $(`#second_wing_array_${index}`).val(unit_details.wing).trigger('change');
                                        $(`#second_saleable_area_select_${index}`).val(parseInt(unit_details.saleable_map_unit)).trigger('change');
                                        $(`#second_built_up_area_select_${index}`).val(parseInt(unit_details.built_up_map_unit)).trigger('change');
                                        $(`#second_carpet_area_select_${index}`).val(parseInt(unit_details.carpet_area_map_unit)).trigger('change');
                                        $(`#second_wash_area_select_${index}`).val(parseInt(unit_details.wash_area_map_unit)).trigger('change');
                                        $(`#second_balcony_area_select_${index}`).val(parseInt(unit_details.balcony_area_map_unit)).trigger('change');
                                        $(`#second_floor_height_select_${index}`).val(parseInt(unit_details.floor_height_map_unit)).trigger('change');
                                        $(`#second_ceiling_height_select_${index}`).val(parseInt(unit_details.ceiling_height_map_unit)).trigger('change');
                                        $(`#second_terrace_carpet_select_${index}`).val(parseInt(unit_details.terrace_carpet_area_map_unit)).trigger('change');
                                        $(`#second_terrace_saleable_select_${index}`).val(parseInt(unit_details.terrace_saleable_area_map_unit)).trigger('change');
                                    });
                                });

                                this.if_residential_only_wings.wing_details.forEach((wing_details, index) => {
                                    this.$nextTick(function () {
                                        $(`#sub_category_of_wings_${index}`).val(wing_details.sub_categories).trigger('change');
                                        $(`#extra_sub_category_of_wings_${index}`).val(wing_details.sub_categories).trigger('change');
                                    });
                                });
                            }

                            if(this.property_category == 259) {
                                let _this = this;
                                this.if_office_tower_details = JSON.parse(tower_details_object['if_office_tower_details']);
                                this.if_office_tower_details_with_specification = tower_details_object['if_office_tower_details_with_specification'] == 'true' ? true  : false;


                                this.if_office_tower_details.forEach((tower_detail, index) => {
                                    _this.$nextTick(function () {
                                        $(`#tower_detail_carpet_from_to_select_${index}`).val(tower_detail.carpet_from_to_map_unit).trigger('change');
                                        $(`#tower_detail_built_from_to_select_${index}`).val(tower_detail.built_from_to_map_unit).trigger('change');
                                        $(`#tower_detail_saleable_from_to_select_${index}`).val(tower_detail.saleable_from_to_map_unit).trigger('change');
                                        $(`#first_ceiling_height_map_unit_select_${index}`).val(tower_detail.ceiling_height_map_unit).trigger('change');
                                    });
                                });
                            }

                            if(this.property_category == 259 || this.property_category == 260) {
                                let _this = this;
                                this.if_office_or_retail = JSON.parse(tower_details_object['if_office_or_retail']);
                                this.$nextTick(function () {
                                    $("#second_front_road_map_unit_select").val(parseInt(_this.if_office_or_retail.front_road_width_map_unit)).trigger('change');
                                    $("#first_front_road_map_unit_select").val(parseInt(_this.if_office_or_retail.front_road_width_map_unit)).trigger('change');
                                });
                            }

                            if(this.property_category == 260) {
                                this.if_retail_tower_details = JSON.parse(tower_details_object['if_retail_tower_details']);
                                let _this = this;

                                this.if_retail_tower_details.forEach((tower_detail, index) => {
                                    _this.$nextTick(function () {
                                        $(`#floor_category_${index}`).val(tower_detail.sub_category).trigger('change');
                                        $(`#tower_size_from_to_select_${index}`).val(parseInt(tower_detail.size_from_map_unit)).trigger('change');
                                        $(`#tower_front_opening_select_${index}`).val(tower_detail.tower_front_opening_map_unit).trigger('change');
                                        $(`#tower_ceiling_select_${index}`).val(tower_detail.tower_ceiling_map_unit).trigger('change');

                                        $(`#extra_floor_category_${index}`).val(tower_detail.sub_category).trigger('change');
                                        $(`#extra_tower_size_from_to_select_${index}`).val(parseInt(tower_detail.size_from_map_unit)).trigger('change');
                                        $(`#extra_tower_front_opening_select_${index}`).val(tower_detail.tower_front_opening_map_unit).trigger('change');
                                        $(`#extra_tower_ceiling_select_${index}`).val(tower_detail.tower_ceiling_map_unit).trigger('change');
                                    });
                                });
                            }

                            if(this.property_category == 262 || this.property_category == 256 || this.property_category == 258) {
                                this.if_farm_plot_land = JSON.parse(project_data['land_plot_details']);
                                let _this = this;
                                this.$nextTick(function () {
                                    $(`#land_area_select`).val(parseInt(_this.if_farm_plot_land.land_area_map_unit)).trigger('change');
                                    $(`#open_area_select`).val(_this.if_farm_plot_land.open_area_map_unit).trigger('change');
                                    $(`#common_area_select`).val(_this.if_farm_plot_land.common_area_map_unit).trigger('change');
                                    
                                    $(`#plot_size_from_select`).val(_this.if_farm_plot_land.plot_size_from_map_unit).trigger('change');
                                    $(`#plot_size_to_select`).val(_this.if_farm_plot_land.plot_size_to_map_unit).trigger('change');

                                    $(`#carpet_plot_size_select`).val(_this.if_farm_plot_land.carpet_plot_size_map_unit).trigger('change');

                                    $(`#constructed_saleable_area_select`).val(_this.if_farm_plot_land.constructed_saleable_area_map_unit).trigger('change');
                                    
                                    $(`#constructed_carpet_area_select`).val(_this.if_farm_plot_land.constructed_carpet_area_map_unit).trigger('change');

                                    $(`#constructed_built_up_from_area_select`).val(_this.if_farm_plot_land.constructed_built_up_from_map_unit).trigger('change');

                                    $(`#constructed_built_up_to_area_select`).val(_this.if_farm_plot_land.constructed_built_up_to_map_unit).trigger('change');
                                });
                            }

                            if(this.property_category == 261) {
                                this.if_ware_cold_ind_plot.types = JSON.parse(project_data['storage_industrial_details']);
                                this.storage_industrial = JSON.parse( project_data['storage_industrial_facilities']);

                                let _this = this;
                                this.$nextTick(function () {
                                    _this.if_ware_cold_ind_plot.types.forEach((type, index) => {
                                        $(`#carpet_from_to_select_${index}`).val(type.carpet_from_to_unit_map);
                                        $(`#constructed_from_to_select_${index}`).val(type.constructed_from_to_unit_map);
                                        $(`#road_width_of_front_side_area_from_to_select_${index}`).val(type.road_width_of_front_side_area_from_to_unit_map);
                                        $(`#type_ceiling_height_${index}`).val(type.ceiling_height_unit_map);
                                    });

                                    $('#pcb').prop('checked', _this.storage_industrial.pcb_detail != '' ? true : false);
                                    $('#ec').prop('checked', _this.storage_industrial.ec_detail != '' ? true : false);
                                    $('#gas').prop('checked', _this.storage_industrial.gas_detail != '' ? true : false);
                                    $('#power').prop('checked', _this.storage_industrial.power_detail != '' ? true : false);
                                    $('#water').prop('checked', _this.storage_industrial.water_detail != '' ? true : false);
                                });

                                this.extra_facilities = JSON.parse(project_data['extra_facilities']);
                            }
                        }
 
                        // third section

                        let parking_data = JSON.parse(project_data['parking_details']);
                        
                        this.free_alloted_for_four_wheeler = parking_data['free_alloted_for_four_wheeler'] == 'true' ? true : false;
                        this.free_alloted_for_two_wheeler = parking_data['free_alloted_for_two_wheeler'] == 'true' ? true : false;
                        this.available_for_purchase = parking_data['available_for_purchase'] == 'true' ? true : false;
                        
                        this.total_number_of_parking = parking_data['total_number_of_parking'];
                        this.total_floor_for_parking = parking_data['total_floor_for_parking'];

                        this.parking_details = JSON.parse(parking_data['parking_details']);

                        JSON.parse(parking_data['parking_details']).forEach((parking_detail, index) => {
                            this.$nextTick(function () {
                                $(`#height_basement_select_${index}`).val(parseInt(parking_detail.height_of_basement_map_unit)).trigger('change');
                            });
                        });

                        this.nextTickForDynamicAddfloor();

                        this.amenities = JSON.parse(project_data['amenities']);

                        $('#image_category').val(project_data['document_category']).trigger('change');

                        this.other_documents = project_data['other_documents'];
                        let _this_doc = this;

                        this.$nextTick(function () {
                            _this_doc.setSelect2ForOtherDoc();
                        });
                        
                        this.remark = project_data['remark'] ?? "";
                    }
                },

                errors : {},

                // first_sections

                id : '',
                website : '',
                other_contact_details : [{
                    'name' : '',
                    'mobile' : '',
                    'email' : '',
                    'designation' : '',
                }],
                project_name : '',
                address : '',
                location_link : '',
                pincode : '',
                land_size : '',
                rera_no : '',
                number_of_unit_in_project : '',  

                project_status_question : '',

                addOtherContact() {
                    this.other_contact_details.push({
                        'name' : '',
                        'mobile' : '',
                        'email' : '',
                        'designation' : '',
                    });
                },

                removeOtherContact(index = null) {
                    this.other_contact_details.splice(index , 1);
                },
                
                // second section

                property_type : 85,
                property_category : '',

                extra_category: '',

                sub_categories : [],
                sub_category_single : '',

                sub_category_array : [],

                wings_name_array : [],

                is_flat_or_penthouse : {
                    number_of_room: '',
                    number_of_towers : '',
                    number_of_floors : '',
                    total_units : '',
                    number_of_elevator : '',
                    service_elevator : '',
                },

                if_residential_only_wings : {
                    wing_name : '',
                    total_floors : '',
                    total_total_units : '',
                    sub_categories : [],

                    wing_details : [
                        {
                            wing_name : '',
                            total_floors : '',
                            total_total_units : '',
                            sub_categories : [],
                        }
                    ]
                },

                if_residential_only_units : {
                    wing : '',
                    saleable : '',

                    built_up : '',
                    carpet_area : '',
                    balcony : '',
                    wash_area : '',
                    terrace_carpet_area : '',
                    terrace_saleable_area : '',
                    floor_height : '',
                    ceiling_height : '',
                    servant_room : false,
                    service_lift : false,

                    has_terrace_and_carpet : false,

                    saleable_map_unit : '',
                    built_up_map_unit : '',
                    carpet_area_map_unit : '',
                    balcony_area_map_unit : '',
                    wash_area_map_unit : '',
                    terrace_carpet_area_map_unit : '',
                    terrace_saleable_area_map_unit : '',
                    floor_height_map_unit : '',
                    ceiling_height_map_unit : '',

                    unit_details : [
                        {
                            wing : '',
                            saleable : '',
                            saleable_to : '',

                            built_up : '',
                            built_up_to : '',
                            carpet_area : '',
                            carpet_area_to : '',
                            balcony : '',
                            balcony_to : '',
                            wash_area : '',
                            wash_area_to : '',
                            terrace_carpet_area : '',
                            terrace_carpet_area_to : '',
                            terrace_saleable_area_to : '',
                            floor_height : '',
                            servant_room : false,
                            service_lift : false,

                            has_terrace_and_carpet : false,
                            has_built_up : false,
                            has_carpet : false,

                            saleable_map_unit : '',
                            built_up_map_unit : '',
                            carpet_area_map_unit : '',
                            balcony_area_map_unit : '',
                            wash_area_map_unit : '',
                            terrace_carpet_area_map_unit : '',
                            terrace_saleable_area_map_unit : '',
                            floor_height_map_unit : '',
                        }
                    ]
                },

                if_office_or_retail : {
                    number_of_tower : '',
                    number_of_floor : '',
                    number_of_unit : '',
                    number_of_unit_each_block : '',
                    number_of_lift : '',
                    service_lift : false,
                    front_road_width : '',
                    front_road_width_map_unit : '',
                    washroom : 'private',
                    is_two_corner : false,
                },

                if_office_tower_details : [
                    {
                        tower_name : '',
                        carpet : '',
                        carpet_to : '',
                        built_up : '',
                        built_up_to : '',
                        saleable : '',
                        saleable_to : '',
                        ceiling_height : '',

                        is_carpet : false,
                        is_built_up : false,
                    }
                ],

                if_office_tower_details_with_specification : false,

                if_retail_tower_details : [
                    {
                        floor_name : '',
                        tower_name : '',
                        sub_category : '',
                        size_from : '',
                        size_to : '',
                        front_opening : '',
                        number_of_each_floor : '',
                        ceiling_height : '',

                        size_from_map_unit  : '',
                        size_to_map_unit  : '',
                        tower_ceiling_map_unit  : '',
                    }
                ],

                if_farm_plot_land : {
                    total_land_area : '',
                    total_land_area_to : '',
                    total_open_area : '',
                    total_open_area_to : '',
                    total_number_of_plot : '',
                    common_area : '',
                    common_area_to : '',

                    multiple_theme_phase : false,

                    land_area_map_unit : '',
                    open_area_map_unit : '',
                    common_area_map_unit : '',

                    phase_name : '',
                    plot_size_from : '',
                    plot_size_to : '',
                    plot_size_from_map_unit : '',
                    plot_size_to_map_unit : '',

                    add_carpet_plot_size : false,
                    add_constructed_carpet_area : false,
                    add_constructed_built_up_area : false,

                    carpet_plot_size : '',
                    carpet_plot_size_to : '',
                    carpet_plot_size_map_unit : '',

                    plot_with_construcation : false,

                    constructed_saleable_area : '',
                    constructed_saleable_area_to : '',
                    constructed_saleable_area_map_unit : '',

                    constructed_carpet_area : '',
                    constructed_carpet_area_to : '',
                    constructed_carpet_area_map_unit : '',

                    constructed_built_up_area_from : '',
                    constructed_built_up_area_to : '',

                    constructed_built_up_from_map_unit : '',
                    constructed_built_up_to_map_unit : '',

                    number_of_room : '',
                    number_of_bathroom : '',
                    number_of_balcony : '',
                    number_of_open_side : '',

                    servant_room : false,
                    number_of_parking : '',
                },

                if_ware_cold_ind_plot : {
                    number_of_unit : '',
                    types : [
                        {
                            plot_area_from : '',
                            plot_area_to : '',

                            construced_area_from : '',
                            construced_area_to : '',

                            road_width_of_front_side_area_from : '',
                            road_width_of_front_side_area_to : '',

                            ceiling_height : '',
                        }
                    ]
                },

                storage_industrial : {
                    gas : false,
                    gas_detail : '',
                    power : false,
                    power_detail : '',
                    water : false,
                    water_detail : '',
                    other : false,
                    other_detail : '',
                },

                new_facility_input : '',
                extra_facilities : [],

                resetData() {

                    this.wings_name_array = [];
                    
                    this.is_flat_or_penthouse = {
                        number_of_room : "",
                        number_of_towers : '',
                        number_of_floors : '',
                        total_units : '',
                        number_of_elevator : '',
                        service_elevator : '',
                    };

                    this.if_residential_only_wings = {
                        wing_name : '',
                        total_floors : '',
                        total_total_units : '',
                        sub_categories : [],

                        wing_details : [
                            {
                                wing_name : '',
                                total_floors : '',
                                total_total_units : '',
                                sub_categories : [],
                            }
                        ]
                    };

                    this.if_residential_only_units = {
                        wing : '',
                        saleable : '',

                        built_up : '',
                        carpet_area : '',
                        balcony : '',
                        wash_area : '',
                        terrace_carpet_area : '',
                        terrace_saleable_area : '',
                        floor_height : '',
                        ceiling_height : '',
                        servant_room : false,
                        service_lift : false,

                        has_terrace_and_carpet : false,

                        saleable_map_unit : '',
                        built_up_map_unit : '',
                        carpet_area_map_unit : '',
                        balcony_area_map_unit : '',
                        wash_area_map_unit : '',
                        terrace_carpet_area_map_unit : '',
                        terrace_saleable_area_map_unit : '',
                        floor_height_map_unit : '',
                        ceiling_height_map_unit : '',

                        unit_details : [
                            {
                                wing : '',
                                saleable : '',
                                saleable_to : '',

                                built_up : '',
                                built_up_to : '',
                                carpet_area : '',
                                carpet_area_to : '',
                                balcony : '',
                                balcony_to : '',
                                wash_area : '',
                                wash_area_to : '',
                                ceiling_height : '',
                                terrace_carpet_area : '',
                                terrace_carpet_area_to : '',
                                terrace_saleable_area_to : '',
                                floor_height : '',
                                servant_room : false,
                                service_lift : false,

                                has_terrace_and_carpet : false,
                                has_built_up : false,
                                has_carpet : false,

                                saleable_map_unit : '',
                                built_up_map_unit : '',
                                carpet_area_map_unit : '',
                                balcony_area_map_unit : '',
                                wash_area_map_unit : '',
                                terrace_carpet_area_map_unit : '',
                                terrace_saleable_area_map_unit : '',
                                floor_height_map_unit : '',
                            }
                        ]
                    };

                    this.if_office_or_retail = {
                        number_of_tower : '',
                        number_of_floor : '',
                        number_of_unit : '',
                        number_of_unit_each_block : '',
                        number_of_lift : '',
                        service_lift : false,
                        front_road_width : '',
                        front_road_width_map_unit : '',
                        washroom : 'private',
                        is_two_corner : false,
                    };

                    this.if_office_tower_details = [
                        {
                            tower_name : '',
                            carpet : '',
                            carpet_to : '',
                            built_up : '',
                            built_up_to : '',
                            saleable : '',
                            saleable_to : '',
                            ceiling_height : '',

                            is_carpet : false,
                            is_built_up : false,
                        }
                    ];

                    this.if_office_tower_details_with_specification = false;

                    this.if_retail_tower_details = [
                        {
                            floor_name : '',
                            tower_name : '',
                            sub_category : '',
                            size_from : '',
                            size_to : '',
                            front_opening : '',
                            number_of_each_floor : '',
                            ceiling_height : '',

                            size_from_map_unit  : '',
                            size_to_map_unit  : '',
                            tower_ceiling_map_unit  : '',
                        }
                    ];

                    this.if_farm_plot_land = {
                        total_land_area : '',
                        total_land_area_to : '',
                        total_open_area : '',
                        total_open_area_to : '',
                        total_number_of_plot : '',
                        common_area : '',
                        common_area_to : '',

                        multiple_theme_phase : false,

                        land_area_map_unit : '',
                        open_area_map_unit : '',
                        common_area_map_unit : '',

                        phase_name : '',
                        plot_size_from : '',
                        plot_size_to : '',

                        add_carpet_plot_size : false,
                        add_constructed_carpet_area : false,
                        add_constructed_built_up_area : false,

                        carpet_plot_size : '',
                        carpet_plot_size_to : '',
                        carpet_plot_size_map_unit : '',

                        plot_with_construcation : false,

                        constructed_saleable_area : '',
                        constructed_saleable_area_to : '',
                        constructed_saleable_area_map_unit : '',

                        constructed_carpet_area : '',
                        constructed_carpet_area_to : '',
                        constructed_carpet_area_map_unit : '',

                        constructed_built_up_area_from : '',
                        constructed_built_up_area_to : '',

                        number_of_room : '',
                        number_of_bathroom : '',
                        number_of_balcony : '',
                        number_of_open_side : '',

                        servant_room : false,
                        number_of_parking : '',
                    };

                    this.if_ware_cold_ind_plot = {
                        number_of_unit : '',
                        types : [
                            {
                                plot_area_from : '',
                                plot_area_to : '',

                                construced_area_from : '',
                                construced_area_to : '',

                                road_width_of_front_side_area_from : '',
                                road_width_of_front_side_area_to : '',

                                ceiling_height : '',
                            }
                        ]
                    };

                    this.storage_industrial = {
                        pcb : false,
                        pcb_detail : '',

                        ec : false,
                        ec_detail : '',

                        gas : false,
                        gas_detail : '',

                        power : false,
                        power_detail : '',
                        
                        water : false,
                        water_detail : '',
                    };

                    this.extra_facilities = [];
                    this.new_facility_input = '';
                },

                changePropertyType() {
                    this.property_category = '';
                    this.sub_category_single = '';
                    this.sub_categories = [];
                    this.wings_name_array = [];
                    this.new_facility_input = '';
                    this.sub_category_array = [];
                    this.resetData();
                },

                categoryChange() {
                    this.sub_categories = [];
                    this.sub_category_single = '';
                    this.resetData();
                    this.sub_category_array = [];
                },

                addWingSubCategory(event, value) {
                    let newArray = [];
                    if(event.target.checked) {
                        this.sub_category_array.push(value);
                        newArray = this.sub_category_array;
                    } else {
                        let originalArray = this.sub_category_array;
                        const valueToRemove = value;
                        newArray = originalArray.filter(item => item !== valueToRemove);
                    }


                    this.sub_category_array = [];

                    newArray.forEach((element, index) => {
                        this.sub_category_array.push(element);
                    });
                },

                manageWingNameArray() {
                    let _this = this;
                    this.wings_name_array = [];
                    this.if_residential_only_wings.wing_details.forEach(wing => {
                        _this.wings_name_array.push(wing.wing_name);
                    });
                },

                towerWithSpecification() {
                    this.if_office_tower_details = [];

                    if(!this.if_office_tower_details_with_specification) {
                        if(parseInt(this.if_office_or_retail.number_of_tower) > 0) {
                            for (let index = 0; index < this.if_office_or_retail.number_of_tower; index++) {
                                this.if_office_tower_details.push({
                                    tower_name : '',
                                    carpet : '',
                                    carpet_to : '',
                                    built_up : '',
                                    built_up_to : '',
                                    saleable : '',
                                    saleable_to : '',
                                    ceiling_height : '',

                                    is_carpet : false,
                                    is_built_up : false,
                                });
                            }
                        }
                        return;
                    }

                    this.if_office_tower_details.push({
                        tower_name : '',
                        carpet : '',
                        carpet_to : '',
                        built_up : '',
                        built_up_to : '',
                        saleable : '',
                        saleable_to : '',
                        ceiling_height : '',

                        is_carpet_built_up : false,
                    });
                },

                addCarpetPlotSize() {
                    this.if_farm_plot_land.add_carpet_plot_size = !this.if_farm_plot_land.add_carpet_plot_size; 
                },

                addConstCarpetArea() {
                    this.if_farm_plot_land.add_constructed_carpet_area = !this.if_farm_plot_land.add_constructed_carpet_area; 
                },

                addConstBuiltUpArea() {
                    this.if_farm_plot_land.add_constructed_built_up_area = !this.if_farm_plot_land.add_constructed_built_up_area; 
                },

                nexttickForFirstCondition() {
                    let _this = this;
                    this.$nextTick(function () {
                        $('#second_front_road_map_unit_select').select2();
                        $('#first_front_road_map_unit_select').select2();
                    });
                    return;
                },

                nextTickForTowerDetails() {
                    this.if_office_tower_details.forEach((element, index) => {
                        this.$nextTick(function () {
                            $(`#tower_detail_carpet_from_to_select_${index}`).select2();
                            $(`#tower_detail_built_from_to_select_${index}`).select2();
                            $(`#tower_detail_saleable_from_to_select_${index}`).select2();
                            $(`#first_ceiling_height_map_unit_select_${index}`).select2();

                            $(`#second_tower_detail_carpet_from_to_select_${index}`).select2();
                            $(`#second_tower_detail_built_from_to_select_${index}`).select2();
                            $(`#second_tower_detail_saleable_from_to_select_${index}`).select2();
                            $(`#second_ceiling_height_map_unit_select_${index}`).select2();
                        });
                    });
                },

                nextTickForIfResidentialWings() {
                    this.$nextTick(function () {
                        $('#sub_category_of_wings').select2();
                    });

                    this.if_residential_only_wings.wing_details.forEach((element,index)   => {
                        this.$nextTick(function () {
                            $(`#sub_category_of_wings_${index}`).select2({ placeholder: 'Sub Category' });
                            $(`#extra_sub_category_of_wings_${index}`).select2({ placeholder: 'Sub Category' });
                        }); 
                    });
                    return;
                },

                nextTickForIfRetail() {
                    let _this = this;

                    this.if_retail_tower_details.forEach((element,index)   => {
                        this.$nextTick(function () {
                            $(`#floor_category_${index}`).select2();
                            $(`#tower_front_opening_select_${index}`).select2();
                            $(`#ceiling_height_select_${index}`).select2();
                            $(`#tower_size_from_to_select_${index}`).select2();
                            $(`#tower_ceiling_select_${index}`).select2();

                            $(`#extra_floor_category_${index}`).select2();
                            $(`#extra_tower_front_opening_select_${index}`).select2();
                            $(`#extra_ceiling_height_select_${index}`).select2();
                            $(`#extra_tower_size_from_to_select_${index}`).select2();
                            $(`#extra_tower_ceiling_select_${index}`).select2();
                        });
                    });
                    return;
                },

                nexttickForFarm() {
                    this.$nextTick(function () {
                        $('#land_area_select').select2();
                        $('#open_area_select').select2();
                        $('#common_area_select').select2();
                        $('#plot_size_from_select').select2();
                        $('#plot_size_to_select').select2();
                    });
                    return;
                },

                selectOnMultiplePhase() {
                    this.$nextTick(function () {
                        $('#plot_size_from_select').select2();
                        $('#plot_size_to_select').select2();
                    });
                    return;
                },

                selectOnCarpetPlot() {
                    this.$nextTick(function () {
                        $('#carpet_plot_size_select').select2();
                    });
                    return;
                },

                selectOnConstSaleableArea() {
                    this.$nextTick(function () {
                        $('#constructed_saleable_area_select').select2();
                        $('#constructed_built_up_from_area_select').select2();
                        $('#constructed_built_up_to_area_select').select2();
                    });
                    return;
                },

                selectOnConstCarpetArea() {
                    this.$nextTick(function () {
                        $('#constructed_carpet_area_select').select2();
                    });
                    return;
                },

                nextTickForIfResidentialUnits() {
                    let _this = this;
                    this.if_residential_only_units.unit_details.forEach((element, index) => {
                        _this.$nextTick(function () {
                            $(`#wing_array_${index}`).select2();
                            $(`#saleable_area_select_${index}`).select2();
                            $(`#built_up_area_select_${index}`).select2();
                            $(`#carpet_area_select_${index}`).select2();
                            $(`#wash_area_select_${index}`).select2();
                            $(`#balcony_area_select_${index}`).select2();
                            $(`#terrace_carpet_select_${index}`).select2();
                            $(`#terrace_saleable_select_${index}`).select2();
                            $(`#floor_height_select_${index}`).select2();
                            $(`#ceiling_height_select_${index}`).select2();

                            $(`#second_wing_array_${index}`).select2();
                            $(`#second_saleable_area_select_${index}`).select2();
                            $(`#second_built_up_area_select_${index}`).select2();
                            $(`#second_carpet_area_select_${index}`).select2();
                            $(`#second_wash_area_select_${index}`).select2();
                            $(`#second_balcony_area_select_${index}`).select2();
                            $(`#second_terrace_carpet_select_${index}`).select2();
                            $(`#second_terrace_saleable_select_${index}`).select2();
                            $(`#second_floor_height_select_${index}`).select2();
                            $(`#second_ceiling_height_select_${index}`).select2();
                        });    
                    });
                    return;
                },

                addWingDetail() {
                    this.if_residential_only_wings.wing_details.push({
                        wing_name : '',
                        total_floors : '',
                        total_total_units : '',
                        sub_categories : [],
                    });
                },

                removeWingDetail(index) {
                    this.if_residential_only_wings.wing_details.splice(index,1);
                    this.manageWingNameArray();
                },

                addRetailUnitDetails() {
                    if(this.if_office_or_retail.number_of_tower > 0) {
                        this.if_retail_tower_details = [];
                        for (let index = 0; index < this.if_office_or_retail.number_of_tower; index++) {
                            this.if_retail_tower_details.push({
                                floor_name : '',
                                tower_name : '',
                                sub_category : '',
                                size_from : '',
                                size_to : '',
                                front_opening : '',
                                number_of_each_floor : '',
                                ceiling_height : '',

                                size_from_map_unit  : '',
                                size_to_map_unit  : '',
                                tower_ceiling_map_unit  : '',
                            });
                        }
                    }
                },

                addUnitDetail() {
                    this.if_residential_only_units.unit_details.push({                
                        wing : '',
                        saleable : '',
                        saleable_to : '',

                        built_up : '',
                        built_up_to : '',

                        carpet_area : '',
                        carpet_area_to : '',
                        
                        balcony : '',
                        balcony_to : '',
                        wash_area : '',
                        wash_area_to : '',
                        terrace_carpet_area : '',
                        terrace_carpet_area_to : '',
                        terrace_saleable_area_to : '',
                        floor_height : '',
                        ceiling_height : '',
                        servant_room : false,
                        service_lift : false,

                        has_terrace_and_carpet : false,
                        has_built_up : false,
                        has_carpet : false,

                        saleable_map_unit : '',
                        built_up_map_unit : '',
                        carpet_area_map_unit : '',
                        balcony_area_map_unit : '',
                        wash_area_map_unit : '',
                        terrace_carpet_area_map_unit : '',
                        terrace_saleable_area_map_unit : '',
                        floor_height_map_unit : '',
                        ceiling_height_map_unit : '',
                    });
                },

                removeUnitDetail(index) {
                    this.if_residential_only_units.unit_details.splice(index,1);
                },

                addType() {
                    this.if_ware_cold_ind_plot.types.push({
                        plot_area_from : '',
                        plot_area_to : '',

                        construced_area_from : '',
                        construced_area_to : '',

                        road_width_of_front_side_area_from : '',
                        road_width_of_front_side_area_to : '',

                        ceiling_height : '',
                        number_of_units : '',
                    });
                },

                removeType(index) {
                    this.if_ware_cold_ind_plot.types.splice(index,1);
                },

                nextTickForWareColdPlot() {
                    let _this = this;
                    this.if_ware_cold_ind_plot.types.forEach((type,index) => {
                        _this.$nextTick(function () {
                            $(`#carpet_from_to_select_${index}`).select2();
                            $(`#carpet_to_select_${index}`).select2();

                            $(`#constructed_from_to_select_${index}`).select2();
                            $(`#constructed_to_select_${index}`).select2();

                            $(`#road_width_of_front_side_area_from_to_select_${index}`).select2();
                            $(`#road_width_of_front_side_area_to_select_${index}`).select2();

                            $(`#type_ceiling_height_${index}`).select2();

                        });
                    });
                },

                floor_slug : {
                    37 : "Ground Floor Details",
                    38 : "1st Floor Details",
                    39 : "2nd Floor Details",
                    40 : "3rd Floor Details",
                },

                addNewUnitDetailsAccordingFloor(element_id) {
                    if(this.if_retail_tower_details[0].floor_name == "") 
                    {
                        this.if_retail_tower_details = [];
                    }

                    if(document.getElementById(element_id).checked) {
                        let value = $(`#${element_id}`).val();

                        this.if_retail_tower_details.push({
                            floor_name : this.floor_slug[value],
                            tower_name : '',
                            sub_category : '',
                            size_from : '',
                            size_to : '',
                            front_opening : '',
                            number_of_each_floor : '',
                            ceiling_height : '',

                            size_from_map_unit  : '',
                            size_to_map_unit  : '',
                            tower_ceiling_map_unit  : '',
                        });
                    } else {
                        let value = $(`#${element_id}`).val();
                        let index = this.if_retail_tower_details.findIndex(tower => tower.floor_name == this.floor_slug[value]);
                        if(index >=0 ) {
                            this.if_retail_tower_details.splice(index, 1);
                        }
                    }
                },

                // third section
                free_alloted_for_two_wheeler : false,
                free_alloted_for_four_wheeler : false,
                available_for_purchase : false,

                total_number_of_parking : '',
                total_floor_for_parking : '',

                parking_details : [],

                addRows() {

                    this.parking_details = [];

                    for (let index = 0; index < this.total_floor_for_parking; index++) {
                        this.parking_details.push({
                            floor_number : index,
                            ev_charging_point : '',
                            hydraulic_parking : '',
                            height_of_basement : '',
                            height_of_basement_map_unit : '',
                        });

                        this.$nextTick(function () {
                            $(`#height_basement_select_${index}`).select2();
                        });
                    }
                },

                nextTickForDynamicAddfloor() {
                    for (let index = 0; index < this.total_floor_for_parking; index++) {
                        this.$nextTick(function () {
                            $(`#height_basement_select_${index}`).select2();
                        });
                    }
                },

                addNewFacility() {
                    let exist = this.extra_facilities.findIndex(facility => facility.name == this.new_facility_input);

                    if(exist >= 0) {
                        this.new_facility_input = '';    
                        return;
                    }

                    this.extra_facilities.push({
                        'name' : this.new_facility_input,
                        'detail' : '',
                        'id' : '',
                    });
                    this.new_facility_input = '';
                },

                removeExtraFacility(index) {
                    this.extra_facilities.splice(index, 1);
                },

                amenities : [],

                document_category : '',
                remark : '',

                other_documents : [

                ],

                setSelect2ForOtherDoc() {
                    let _this = this;
                    this.$nextTick(function () {
                        _this.other_documents.forEach((element, index) => {
                            $(`#other_doc_${index}`).select2();
                        });
                    });
                },

                addOtherImageOrDoc() {
                    let _this = this;
                    this.other_documents.push({
                        'document_type' : '',
                        'file' : ''
                    });

                    this.setSelect2ForOtherDoc();
                },

                removeOtherImageOrDoc(index) {
                    this.other_documents.splice(index, 1);
                },

                tabChange(tab) {

                    let tabs = {
                        'project-info' : {
                            'active' : false,
                        },
                        'contact-wing' : {
                            'active' : false,
                        },
                        'amenities' :  {
                            'active' : false,
                        },  
                    };

                    let active_tab = null;

                    Object.entries(tabs).forEach(element => {
                        let tab_element = document.getElementById(element[0]);
                        
                        if (tab_element && tab_element.classList.contains("d-none")) {
                        } else {
                            active_tab = element[0];
                        }
                    });

                    let is_valid = true;

                    if(tab != active_tab) {
                        if(active_tab == 'project-info') {
                            is_valid = this.firstTabValidation();
                        }

                        if(active_tab == 'contact-wing') {
                            is_valid = this.secondTabValidation();
                        }
                    }

                    if(is_valid) {
                        Object.entries(tabs).forEach(element => {
                            let tab_index = document.getElementById(element[0]);
                            let tab_link = document.getElementById(`${element[0]}-link`);
                            if(element[0] != tab) {
                                tab_index.classList.add("d-none");
                                tab_link.classList.remove('btn-primary');
                                tab_link.classList.add('btn-light');
                            }
                        });

                        let new_tab = document.getElementById(tab);
                        let new_tab_link = document.getElementById(`${tab}-link`);
                        new_tab.classList.remove("d-none");
                        new_tab.removeAttribute('style');
                        new_tab_link.classList.remove('btn-light');
                        new_tab_link.classList.add('btn-primary');
                    }
                },

                firstTabValidation() {

                    let all_error = document.querySelectorAll('.new_error');

                    all_error.forEach(element => {
                        element.classList.add('d-none');
                    });

                    let is_valid = true;

                    let fields = [
                        'website',
                        'project_name',
                        'address',
                        'area_id',
                        'state_id',
                        'city_id',
                        'pincode',
                        'rera',
                        'land_size',
                        'land_size_unit',
                        'rera_number',
                        'project_status',
                        'status',
                    ];

                    fields.forEach(field => {
                        let ele = document.getElementById(field);

                        if(ele) {
                            if(ele.value == '') {
                                let error_field = document.getElementById(`err_${field}`);
                                if(error_field) {
                                    error_field.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }
                        }
                    });

                    this.other_contact_details.forEach((conatct_obj , index) => {
                        Object.entries(conatct_obj).forEach((key_name) => {
                            if(key_name[1] == '') {
                                let error_element = document.getElementById(`err_other_contact_${key_name[0]}_${index}`);
                                if(error_element) {
                                    error_element.classList.remove('d-none');
                                    is_valid = false;
                                }
                            } else {
                                if(key_name[0] == 'email') {
                                    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                                    if (!key_name[1].match(validRegex)) {
                                        let error_element = document.getElementById(`err_other_contact_${key_name[0]}_${index}`);
                                        error_element.innerText = 'Enter valid email address';
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }
                                if(key_name[0] == 'mobile') {
                                    if (key_name[1].length != 10 || isNaN(key_name[1])) {
                                        let error_element = document.getElementById(`err_other_contact_${key_name[0]}_${index}`);
                                        error_element.innerText = 'Enter valid mobile number';
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }
                            }
                        });
                    });

                    return is_valid;
                },

                secondTabValidation() {

                    let all_error = document.querySelectorAll('.new_error');

                    all_error.forEach(element => {
                        element.classList.add('d-none');
                    });

                    let is_valid = true;
                    
                    if(this.property_type == '')
                    { 
                        let property_type_error = document.getElementById('err_property_type');
                        if(property_type_error) {
                            property_type_error.classList.remove('d-none');
                            is_valid = false;
                        }
                    }

                    if([85, 87].includes(this.property_type)) {
                        if(this.property_category == '') {
                            let property_category_error = document.getElementById('err_property_category');
                            if(property_category_error) {
                                property_category_error.classList.remove('d-none');
                                is_valid = false;
                            }
                        }
                    }

                    let new_category_array = [...this.sub_categories];
                    let new_sub_category_single = this.sub_category_single;

                    if(new_sub_category_single != '') {
                        new_category_array.push(new_sub_category_single);
                    }

                    if(this.property_category != 256 && this.property_category != 258) {
                        if(new_category_array.length == 0) {
                            let sub_category_error = document.getElementById('err_sub_category');
                            if(sub_category_error) {
                                sub_category_error.classList.remove('d-none');
                                is_valid = false;
                            }
                        }
                    }

                    if(this.property_type == 85)
                    {
                        if(this.property_category == 259 || this.property_category == 260) 
                        {
                            // propert type = 85 commertical
                            // category = 259 Office
                            // sub category = 1 office space

                            if(this.if_office_or_retail.number_of_tower == '') {
                                let number_of_tower = document.getElementById('85_if_office_or_retail_number_of_tower');
                                if(number_of_tower) {
                                    let err_number_of_tower = document.getElementById('err_85_if_office_or_retail_number_of_tower');
                                    err_number_of_tower.classList.remove("d-none");
                                    is_valid = false;
                                }
                            } else {
                                if (isNaN(this.if_office_or_retail.number_of_tower)) {
                                    let err_number_of_tower = document.getElementById('err_85_if_office_or_retail_number_of_tower');
                                    if(err_number_of_tower) {
                                        err_number_of_tower.innerText = 'Number of tower must be number';
                                        err_number_of_tower.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.if_office_or_retail.number_of_floor == '') {
                                let number_of_floor = document.getElementById('85_if_office_or_retail_number_of_floor');
                                if(number_of_floor) {
                                    let err_number_of_floor = document.getElementById('err_85_if_office_or_retail_number_of_floor');
                                    err_number_of_floor.classList.remove("d-none");
                                    is_valid = false;
                                }
                            } else {
                                if (isNaN(this.if_office_or_retail.number_of_floor)) {
                                    let err_number_of_floor = document.getElementById('err_85_if_office_or_retail_number_of_floor');
                                    if(err_number_of_floor) {
                                        err_number_of_floor.innerText = 'Number of floor must be number';
                                        err_number_of_floor.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.if_office_or_retail.number_of_unit == '') {
                                let number_of_unit = document.getElementById('85_if_office_or_retail_number_of_unit');
                                if(number_of_unit) {
                                    let err_number_of_unit = document.getElementById('err_85_if_office_or_retail_number_of_unit');
                                    err_number_of_unit.classList.remove("d-none");
                                    is_valid = false;
                                }
                            } else {
                                if (isNaN(this.if_office_or_retail.number_of_unit)) {
                                    let err_number_of_unit = document.getElementById('err_85_if_office_or_retail_number_of_unit');
                                    if(err_number_of_unit) {
                                        err_number_of_unit.innerText = 'Number of unit must be number';
                                        err_number_of_unit.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.if_office_or_retail.number_of_lift == '') {
                                let number_of_lift = document.getElementById('85_if_office_or_retail_number_of_lift');
                                if(number_of_lift) {
                                    let err_number_of_lift = document.getElementById('err_85_if_office_or_retail_number_of_lift');
                                    err_number_of_lift.classList.remove("d-none");
                                    is_valid = false;
                                }
                            } else {
                                if (isNaN(this.if_office_or_retail.number_of_lift)) {
                                    let err_number_of_lift = document.getElementById('err_85_if_office_or_retail_number_of_lift');
                                    if(err_number_of_lift) {
                                        err_number_of_lift.innerText = 'Number of lift must be number';
                                        err_number_of_lift.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.if_office_or_retail.number_of_unit_each_block == '') {
                                let number_of_unit_each_block = document.getElementById('85_if_office_or_retail_number_of_unit_each_block');
                                if(number_of_unit_each_block) {
                                    let err_number_of_unit_each_block = document.getElementById('err_85_if_office_or_retail_number_of_unit_each_block');
                                    err_number_of_unit_each_block.classList.remove("d-none");
                                    is_valid = false;
                                }
                            } else {
                                if (isNaN(this.if_office_or_retail.number_of_unit_each_block)) {
                                    let err_number_of_unit_each_block = document.getElementById('err_85_if_office_or_retail_number_of_unit_each_block');
                                    if(err_number_of_unit_each_block) {
                                        err_number_of_unit_each_block.innerText = 'Number of unit each block must be number';
                                        err_number_of_unit_each_block.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.if_office_or_retail.front_road_width == '') {
                                let front_road_width = document.getElementById('85_if_office_or_retail_front_road_width');
                                if(front_road_width) {
                                    let err_front_road_width = document.getElementById('err_85_if_office_or_retail_front_road_width');
                                    err_front_road_width.classList.remove("d-none");
                                    is_valid = false;
                                }
                            } else {
                                if (isNaN(this.if_office_or_retail.front_road_width)) {
                                    let err_front_road_width = document.getElementById('err_85_if_office_or_retail_front_road_width');
                                    if(err_front_road_width) {
                                        err_front_road_width.innerText = 'Number of front raod width must be number';
                                        err_front_road_width.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.property_category == 259) {
                                this.if_office_tower_details.forEach((office_tower , index) => {

                                    Object.entries(office_tower).forEach((key_name) => {
                                        if(key_name[1] == '' && !['is_carpet','is_built_up','carpet','carpet_to','built_up','built_up_to'].includes(key_name[0])) {
                                            let error_element = document.getElementById(`err_259_tower_detail_${key_name[0]}_${index}`);
                                            if(error_element) {
                                                error_element.classList.remove('d-none');
                                                is_valid = false;
                                            }
                                        }

                                        if(key_name[0] == 'carpet' || key_name[0] == 'carpet_to') {
                                            if(office_tower.is_carpet) {
                                                if(key_name[1] == '') {
                                                    let error_element = document.getElementById(`err_259_tower_detail_${key_name[0]}_${index}`);
                                                    if(error_element) {
                                                        error_element.classList.remove('d-none');
                                                        is_valid = false;
                                                    }
                                                } 
                                            }
                                        }

                                        if(key_name[0] == 'built_up' || key_name[0] == 'built_up_to') {
                                            if(office_tower.is_built_up) {
                                                if(key_name[1] == '') {
                                                    let error_element = document.getElementById(`err_259_tower_detail_${key_name[0]}_${index}`);
                                                    if(error_element) {
                                                        error_element.classList.remove('d-none');
                                                        is_valid = false;
                                                    }
                                                } 
                                            }
                                        }
                                    });
                                });
                            }

                            if(this.property_category == 260) {
                                this.if_retail_tower_details.forEach((retail_tower , index) => {
                                    Object.entries(retail_tower).forEach((key_name) => {
                                        if(key_name[1] == '' && key_name[0] != 'sub_category') {
                                            let error_element = document.getElementById(`err_260_retail_tower_${key_name[0]}_${index}`);
                                            if(error_element) {
                                                error_element.classList.remove('d-none');
                                                is_valid = false;
                                            }
                                        }
                                    });
                                });
                            }
                        }

                        if(this.property_category == 261) {

                            this.if_ware_cold_ind_plot.types.forEach((cold_ind_plot , index) => {
                                Object.entries(cold_ind_plot).forEach((key_name) => {
                                    if(key_name[1] == '' && !['construced_area_from','construced_area_to'].includes(key_name[0])) {
                                        let error_element = document.getElementById(`err_cold_ind_plot_${key_name[0]}_${index}`);
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(['construced_area_from','construced_area_to'].includes(key_name[0])) {

                                        if(this.sub_category_single != 10) {
                                            if(key_name[1] == '') {
                                                let error_element = document.getElementById(`err_cold_ind_plot_${key_name[0]}_${index}`);
                                                if(error_element) {
                                                    error_element.classList.remove('d-none');
                                                    is_valid = false;
                                                }
                                            }
                                        }
                                    }
                                });
                            });

                            this.extra_facilities.forEach((facility , index) => {
                                if(facility.detail == '') {
                                    let error_element = document.getElementById(`err_extra_detail_${index}`);
                                    if(error_element) {
                                        error_element.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            });

                            if(this.storage_industrial.ec)
                            { 
                                if(this.storage_industrial.ec_detail == '') {
                                    let ec = document.getElementById('err_ec_detail');
                                    if(ec) {
                                        ec.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.storage_industrial.gas)
                            { 
                                if(this.storage_industrial.gas_detail == '') {
                                    let gas = document.getElementById('err_gas_detail');
                                    if(gas) {
                                        gas.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.storage_industrial.pcb)
                            { 
                                if(this.storage_industrial.pcb_detail == '') {
                                    let pcb = document.getElementById('err_pcb_detail');
                                    if(pcb) {
                                        pcb.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.storage_industrial.power)
                            { 
                                if(this.storage_industrial.power_detail == '') {
                                    let power = document.getElementById('err_power_detail');
                                    if(power) {
                                        power.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(this.storage_industrial.water)
                            { 
                                if(this.storage_industrial.water_detail == '') {
                                    let water = document.getElementById('err_water_detail');
                                    if(water) {
                                        water.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }
                        }
                    }

                    if(this.property_type == 87) {

                        if(this.property_category == 254 || this.property_category == 257) {

                            if(this.is_flat_or_penthouse.number_of_towers == '')
                            { 
                                let err_flat_number_of_tower = document.getElementById('err_flat_number_of_towers');
                                if(err_flat_number_of_tower) {
                                    err_flat_number_of_tower.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }

                            if(this.is_flat_or_penthouse.number_of_floors == '')
                            { 
                                let err_flat_number_of_floors = document.getElementById('err_flat_number_of_floors');
                                if(err_flat_number_of_floors) {
                                    err_flat_number_of_floors.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }

                            if(this.is_flat_or_penthouse.total_units == '')
                            { 
                                let err_flat_total_units = document.getElementById('err_flat_total_units');
                                if(err_flat_total_units) {
                                    err_flat_total_units.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }

                            if(this.is_flat_or_penthouse.number_of_elevator == '')
                            { 
                                let err_flat_number_of_elevator = document.getElementById('err_flat_number_of_elevator');
                                if(err_flat_number_of_elevator) {
                                    err_flat_number_of_elevator.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }

                            this.if_residential_only_wings.wing_details.forEach((res_wing , index) => {
                                Object.entries(res_wing).forEach((key_name) => {
                                    if(key_name[1] == '' && key_name[0] != 'sub_categories') {
                                        let error_element = document.getElementById(`err_first_res_wing_${key_name[0]}_${index}`);
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(key_name[0] == 'sub_categories') {
                                        let first_categories_select = document.getElementById(`sub_category_of_wings_${index}`);

                                        if(first_categories_select) {
                                            if(first_categories_select.value == '') {
                                                let error_element = document.getElementById(`err_first_res_wing_${key_name[0]}_${index}`);
                                                if(error_element) {
                                                    error_element.classList.remove('d-none');
                                                    is_valid = false;
                                                }
                                            }
                                        }
                                    }
                                });
                            });

                            this.if_residential_only_units.unit_details.forEach((res_unit_details , index) => {

                                let wing_element = document.getElementById(`wing_array_${index}`);
                                
                                if(wing_element) {
                                    if(wing_element.value == '') {
                                        let err_wing = document.getElementById(`err_if_residential_only_units_wing_${index}`);
                                        if(err_wing) {
                                            err_wing.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }

                                if(res_unit_details.has_built_up) {
                                    if(res_unit_details.built_up == '') {
                                        let error_built_up_from = document.getElementById(`err_if_residential_only_units_built_up_${index}`);
                                        if(error_built_up_from) {
                                            error_built_up_from.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(res_unit_details.built_up_to == '') {
                                        let error_built_up_to = document.getElementById(`err_if_residential_only_units_built_up_to_${index}`);
                                        if(error_built_up_to) {
                                            error_built_up_to.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }

                                if(res_unit_details.has_carpet) {
                                    if(res_unit_details.carpet_area == '') {
                                        let error_carpet_area_from = document.getElementById(`err_if_residential_only_units_carpet_area_${index}`);
                                        if(error_carpet_area_from) {
                                            error_carpet_area_from.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(res_unit_details.carpet_area_to == '') {
                                        let error_carpet_to = document.getElementById(`err_if_residential_only_units_carpet_area_to_${index}`);
                                        if(error_carpet_to) {
                                            error_carpet_to.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }

                                Object.entries(res_unit_details).forEach((key_name) => {

                                    let res_only_unit_fields = [
                                        'saleable',
                                        'saleable_to',
                                        'wash_area',
                                        'balcony',
                                        'floor_height',
                                        'ceiling_height',
                                    ];

                                    if(key_name[1] == '' && res_only_unit_fields.includes(key_name[0])) {
                                        let error_element = document.getElementById(`err_if_residential_only_units_${key_name[0]}_${index}`);
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                });
                            });
                        }

                        if(this.property_category == 255) {
                            this.if_residential_only_wings.wing_details.forEach((res_wing , index) => {
                                Object.entries(res_wing).forEach((key_name) => {
                                    if(key_name[1] == '' && key_name[0] != 'sub_categories') {
                                        let error_element = document.getElementById(`err_first_res_wing_${key_name[0]}_${index}`);
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(key_name[0] == 'sub_categories') {
                                        let first_categories_select = document.getElementById(`sub_category_of_wings_${index}`);

                                        if(first_categories_select) {
                                            if(first_categories_select.value == '') {
                                                let error_element = document.getElementById(`err_first_res_wing_${key_name[0]}_${index}`);
                                                if(error_element) {
                                                    error_element.classList.remove('d-none');
                                                    is_valid = false;
                                                }
                                            }
                                        }
                                    }
                                });
                            });

                            this.if_residential_only_units.unit_details.forEach((res_unit_details , index) => {

                                let wing_element = document.getElementById(`wing_array_${index}`);

                                if(wing_element) {
                                    if(wing_element.value == '') {
                                        let err_wing = document.getElementById(`err_if_residential_only_units_wing_${index}`);
                                        if(err_wing) {
                                            err_wing.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }

                                if(res_unit_details.has_built_up) {
                                    if(res_unit_details.built_up == '') {
                                        let error_built_up_from = document.getElementById(`err_if_residential_only_units_built_up_${index}`);
                                        if(error_built_up_from) {
                                            error_built_up_from.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(res_unit_details.built_up_to == '') {
                                        let error_built_up_to = document.getElementById(`err_if_residential_only_units_built_up_to_${index}`);
                                        if(error_built_up_to) {
                                            error_built_up_to.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }

                                if(res_unit_details.has_carpet) {
                                    if(res_unit_details.carpet_area == '') {
                                        let error_carpet_area_from = document.getElementById(`err_if_residential_only_units_carpet_area_${index}`);
                                        if(error_carpet_area_from) {
                                            error_carpet_area_from.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(res_unit_details.carpet_area_to == '') {
                                        let error_carpet_to = document.getElementById(`err_if_residential_only_units_carpet_area_to_${index}`);
                                        if(error_carpet_to) {
                                            error_carpet_to.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }

                                Object.entries(res_unit_details).forEach((key_name) => {

                                    let res_only_unit_fields = [
                                        'saleable',
                                        'saleable_to',
                                        'wash_area',
                                        'balcony',
                                        'floor_height',
                                        'ceiling_height',
                                    ];

                                    if(key_name[1] == '' && res_only_unit_fields.includes(key_name[0])) {
                                        let error_element = document.getElementById(`err_if_residential_only_units_${key_name[0]}_${index}`);
                                        if(error_element) {
                                            error_element.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                });
                            });
                        }

                        if(this.property_category == 256 || this.property_category == 258) {

                            if(this.if_farm_plot_land.total_open_area == '')
                            { 
                                let err_open_area = document.getElementById('err_if_farm_plot_land_total_open_area');
                                if(err_open_area) {
                                    err_open_area.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }

                            if(this.if_farm_plot_land.total_number_of_plot == '')
                            { 
                                let err_number_of_plot = document.getElementById('err_if_farm_plot_land_total_number_of_plot');
                                if(err_number_of_plot) {
                                    err_number_of_plot.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }

                            if(this.if_farm_plot_land.multiple_theme_phase) {

                                if(this.if_farm_plot_land.phase_name == '')
                                { 
                                    let err_phase_name = document.getElementById('err_if_farm_plot_land_phase_name');
                                    if(err_phase_name) {
                                        err_phase_name.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(this.if_farm_plot_land.plot_size_from == '')
                                { 
                                    let err_plot_size_from = document.getElementById('err_if_farm_plot_land_plot_size_from');
                                    if(err_plot_size_from) {
                                        err_plot_size_from.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(this.if_farm_plot_land.plot_size_to == '')
                                { 
                                    let err_plot_size_to = document.getElementById('err_if_farm_plot_land_plot_size_to');
                                    if(err_plot_size_to) {
                                        err_plot_size_to.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(this.if_farm_plot_land.add_carpet_plot_size) {
                                    
                                    if(this.if_farm_plot_land.carpet_plot_size == '')
                                    { 
                                        let err_carpet_plot_size = document.getElementById('err_if_farm_plot_land_carpet_plot_size');
                                        if(err_carpet_plot_size) {
                                            err_carpet_plot_size.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }

                                    if(this.if_farm_plot_land.carpet_plot_size_to == '')
                                    { 
                                        let err_carpet_plot_size_to = document.getElementById('err_if_farm_plot_land_carpet_plot_size_to');
                                        if(err_carpet_plot_size_to) {
                                            err_carpet_plot_size_to.classList.remove('d-none');
                                            is_valid = false;
                                        }
                                    }
                                }
                            }

                            if(this.if_farm_plot_land.plot_with_construcation) {

                                if(this.if_farm_plot_land.constructed_saleable_area == '')
                                { 
                                    let err_constructed_saleable_area = document.getElementById('err_if_farm_plot_land_constructed_saleable_area');
                                    if(err_constructed_saleable_area) {
                                        err_constructed_saleable_area.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(this.if_farm_plot_land.constructed_saleable_area_to == '')
                                { 
                                    let err_constructed_saleable_area_to = document.getElementById('err_if_farm_plot_land_constructed_saleable_area_to');
                                    if(err_constructed_saleable_area_to) {
                                        err_constructed_saleable_area_to.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }
                        }
                    }

                    if(this.property_type == 88) {

                        if(this.if_office_or_retail.number_of_tower == '') {
                            let number_of_tower = document.getElementById('88_if_office_or_retail_number_of_tower');
                            if(number_of_tower) {
                                let err_number_of_tower = document.getElementById('err_88_if_office_or_retail_number_of_tower');
                                err_number_of_tower.classList.remove("d-none");
                                is_valid = false;
                            }
                        } else {
                            if (isNaN(this.if_office_or_retail.number_of_tower)) {
                                let err_number_of_tower = document.getElementById('err_88_if_office_or_retail_number_of_tower');
                                if(err_number_of_tower) {
                                    err_number_of_tower.innerText = 'Number of tower must be number';
                                    err_number_of_tower.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }
                        }

                        if(this.if_office_or_retail.number_of_floor == '') {
                            let number_of_floor = document.getElementById('88_if_office_or_retail_number_of_floor');
                            if(number_of_floor) {
                                let err_number_of_floor = document.getElementById('err_88_if_office_or_retail_number_of_floor');
                                err_number_of_floor.classList.remove("d-none");
                                is_valid = false;
                            }
                        } else {
                            if (isNaN(this.if_office_or_retail.number_of_floor)) {
                                let err_number_of_floor = document.getElementById('err_88_if_office_or_retail_number_of_floor');
                                if(err_number_of_floor) {
                                    err_number_of_floor.innerText = 'Number of floor must be number';
                                    err_number_of_floor.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }
                        }

                        if(this.if_office_or_retail.number_of_unit_each_block == '') {
                            let number_of_unit = document.getElementById('88_if_office_or_retail_number_of_unit_each_block');
                            if(number_of_unit) {
                                let err_number_of_unit = document.getElementById('err_88_if_office_or_retail_number_of_unit_each_block');
                                err_number_of_unit.classList.remove("d-none");
                                is_valid = false;
                            }
                        } else {
                            if (isNaN(this.if_office_or_retail.number_of_unit)) {
                                let err_number_of_unit = document.getElementById('err_88_if_office_or_retail_number_of_unit_each_block');
                                if(err_number_of_unit) {
                                    err_number_of_unit.innerText = 'Number of unit must be number';
                                    err_number_of_unit.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }
                        }

                        if(this.if_office_or_retail.number_of_lift == '') {
                            let number_of_lift = document.getElementById('88_if_office_or_retail_number_of_lift');
                            if(number_of_lift) {
                                let err_number_of_lift = document.getElementById('err_88_if_office_or_retail_number_of_lift');
                                err_number_of_lift.classList.remove("d-none");
                                is_valid = false;
                            }
                        } else {
                            if (isNaN(this.if_office_or_retail.number_of_lift)) {
                                let err_number_of_lift = document.getElementById('err_88_if_office_or_retail_number_of_lift');
                                if(err_number_of_lift) {
                                    err_number_of_lift.innerText = 'Number of lift must be number';
                                    err_number_of_lift.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }
                        }

                        if(this.if_office_or_retail.front_road_width == '') {
                            let front_road_width = document.getElementById('88_if_office_or_retail_front_road_width');
                            if(front_road_width) {
                                let err_front_road_width = document.getElementById('err_88_if_office_or_retail_front_road_width');
                                err_front_road_width.classList.remove("d-none");
                                is_valid = false;
                            }
                        } else {
                            if (isNaN(this.if_office_or_retail.front_road_width)) {
                                let err_front_road_width = document.getElementById('err_88_if_office_or_retail_front_road_width');
                                if(err_front_road_width) {
                                    err_front_road_width.innerText = 'Number of front raod width must be number';
                                    err_front_road_width.classList.remove('d-none');
                                    is_valid = false;
                                }
                            }
                        }

                        this.if_office_tower_details.forEach((office_tower , index) => {

                            Object.entries(office_tower).forEach((key_name) => {
                                if(key_name[1] == '' && !['is_carpet','is_built_up','carpet','carpet_to','built_up','built_up_to'].includes(key_name[0])) {
                                    let error_element = document.getElementById(`err_88_tower_detail_${key_name[0]}_${index}`);
                                    if(error_element) {
                                        error_element.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(key_name[0] == 'carpet' || key_name[0] == 'carpet_to') {
                                    if(office_tower.is_carpet) {
                                        if(key_name[1] == '') {
                                            let error_element = document.getElementById(`err_88_tower_detail_${key_name[0]}_${index}`);
                                            if(error_element) {
                                                error_element.classList.remove('d-none');
                                                is_valid = false;
                                            }
                                        }
                                    }
                                }

                                if(key_name[0] == 'built_up' || key_name[0] == 'built_up_to') {
                                    if(office_tower.is_built_up) {
                                        if(key_name[1] == '') {
                                            let error_element = document.getElementById(`err_88_tower_detail_${key_name[0]}_${index}`);
                                            if(error_element) {
                                                error_element.classList.remove('d-none');
                                                is_valid = false;
                                            }
                                        } 
                                    }
                                }
                            });
                        });

                        
                        this.if_retail_tower_details.forEach((retail_tower , index) => {
                            Object.entries(retail_tower).forEach((key_name) => {
                                if(key_name[1] == '' && key_name[0] != 'sub_category') {
                                    let error_element = document.getElementById(`err_88_89_retail_tower_${key_name[0]}_${index}`);
                                    if(error_element) {
                                        error_element.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            });
                        });
                    }

                    if(this.property_type == 89) {
                        if(this.is_flat_or_penthouse.number_of_towers == '')
                        { 
                            let err_89_flat_number_of_tower = document.getElementById('err_89_flat_number_of_towers');
                            if(err_89_flat_number_of_tower) {
                                err_89_flat_number_of_tower.classList.remove('d-none');
                                is_valid = false;
                            }
                        }

                        if(this.is_flat_or_penthouse.number_of_floors == '')
                        { 
                            let err_89_flat_number_of_floors = document.getElementById('err_89_flat_number_of_floors');
                            if(err_89_flat_number_of_floors) {
                                err_89_flat_number_of_floors.classList.remove('d-none');
                                is_valid = false;
                            }
                        }

                        if(this.is_flat_or_penthouse.total_units == '')
                        { 
                            let err_89_flat_total_units = document.getElementById('err_89_flat_total_units');
                            if(err_89_flat_total_units) {
                                err_89_flat_total_units.classList.remove('d-none');
                                is_valid = false;
                            }
                        }

                        if(this.is_flat_or_penthouse.number_of_elevator == '')
                        { 
                            let err_89_flat_number_of_elevator = document.getElementById('err_89_flat_number_of_elevator');
                            if(err_89_flat_number_of_elevator) {
                                err_89_flat_number_of_elevator.classList.remove('d-none');
                                is_valid = false;
                            }
                        }

                        this.if_residential_only_wings.wing_details.forEach((res_wing , index) => {
                            Object.entries(res_wing).forEach((key_name) => {
                                if(key_name[1] == '' && key_name[0] != 'sub_categories') {
                                    let error_element = document.getElementById(`err_second_res_wing_${key_name[0]}_${index}`);
                                    if(error_element) {
                                        error_element.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(key_name[0] == 'sub_categories') {
                                    let first_categories_select = document.getElementById(`extra_sub_category_of_wings_${index}`);

                                    if(first_categories_select) {
                                        if(first_categories_select.value == '') {
                                            let error_element = document.getElementById(`err_second_res_wing_${key_name[0]}_${index}`);
                                            if(error_element) {
                                                error_element.classList.remove('d-none');
                                                is_valid = false;
                                            }
                                        }
                                    }
                                }
                            });
                        });

                        this.if_residential_only_units.unit_details.forEach((res_unit_details , index) => {

                            let wing_element = document.getElementById(`second_wing_array_${index}`);

                            if(wing_element) {
                                if(wing_element.value == '') {
                                    let err_wing = document.getElementById(`err_second_if_residential_only_units_wing_${index}`);
                                    if(err_wing) {
                                        err_wing.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(res_unit_details.has_built_up) {
                                if(res_unit_details.built_up == '') {
                                    let error_built_up_from = document.getElementById(`err_second_if_residential_only_units_built_up_${index}`);
                                    if(error_built_up_from) {
                                        error_built_up_from.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(res_unit_details.built_up_to == '') {
                                    let error_built_up_to = document.getElementById(`err_second_if_residential_only_units_built_up_to_${index}`);
                                    if(error_built_up_to) {
                                        error_built_up_to.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            if(res_unit_details.has_carpet) {
                                if(res_unit_details.carpet_area == '') {
                                    let error_carpet_area_from = document.getElementById(`err_second_if_residential_only_units_carpet_area_${index}`);
                                    if(error_carpet_area_from) {
                                        error_carpet_area_from.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(res_unit_details.carpet_area_to == '') {
                                    let error_carpet_to = document.getElementById(`err_second_if_residential_only_units_carpet_area_to_${index}`);
                                    if(error_carpet_to) {
                                        error_carpet_to.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            }

                            Object.entries(res_unit_details).forEach((key_name) => {

                                let res_only_unit_fields = [
                                    'saleable',
                                    'saleable_to',
                                    'wash_area',
                                    'wash_area_to',
                                    'balcony',
                                    'balcony_to',
                                    'floor_height',
                                    'ceiling_height',
                                ];

                                if(key_name[1] == '' && res_only_unit_fields.includes(key_name[0])) {
                                    let error_element = document.getElementById(`err_second_if_residential_only_units_${key_name[0]}_${index}`);
                                    if(error_element) {
                                        error_element.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }
                            });
                        });

                         
                        this.if_retail_tower_details.forEach((retail_tower , index) => {
                            Object.entries(retail_tower).forEach((key_name) => {
                                if(key_name[1] == '' && key_name[0] != 'sub_category') {
                                    let error_element = document.getElementById(`err_88_89_retail_tower_${key_name[0]}_${index}`);
                                    if(error_element) {
                                        error_element.classList.remove('d-none');
                                        is_valid = false;
                                    }
                                }

                                if(key_name[0] == 'sub_category') {

                                    let first_categories_selection = document.getElementById(`extra_floor_category_${index}`);

                                    if(first_categories_selection) {
                                        if(first_categories_selection.value == '') {
                                            let error_element = document.getElementById(`err_88_89_retail_tower_${key_name[0]}_${index}`);
                                            if(error_element) {
                                                error_element.classList.remove('d-none');
                                                is_valid = false;
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    }

                    return is_valid;
                },

 
                // submit section
                submitHandle() {

                    let _this = this;

                    this.if_residential_only_wings.wing_details.forEach((element , index) => {
                        if(this.property_type == 88 || this.property_type == 89)
                        {
                            element.sub_categories = $(`#extra_sub_category_of_wings_${index}`).val();
                        } else
                        {
                            element.sub_categories = $(`#sub_category_of_wings_${index}`).val();
                        }
                    });

                    this.if_office_tower_details.forEach((element , index) => {
                        if(this.property_type == 88 || this.property_type == 89)
                        {
                            element.carpet_from_to_map_unit = $(`#second_tower_detail_carpet_from_to_select_${index}`).val();
                            element.built_from_to_map_unit = $(`#second_tower_detail_built_from_to_select_${index}`).val();
                            element.saleable_from_to_map_unit = $(`#second_tower_detail_saleable_from_to_select_${index}`).val();
                            element.ceiling_height_map_unit = $(`#second_ceiling_height_map_unit_select_${index}`).val();
                        } else {
                            element.carpet_from_to_map_unit = $(`#tower_detail_carpet_from_to_select_${index}`).val();
                            element.built_from_to_map_unit = $(`#tower_detail_built_from_to_select_${index}`).val();
                            element.saleable_from_to_map_unit = $(`#tower_detail_saleable_from_to_select_${index}`).val();
                            element.ceiling_height_map_unit = $(`#first_ceiling_height_map_unit_select_${index}`).val();
                        }
                    });

                    this.if_residential_only_units.unit_details.forEach((element , index) => {
                        if(this.property_type == 88 || this.property_type == 89)
                        {
                            element.wing = $(`#second_wing_array_${index}`).val();
                            element.saleable_map_unit = $(`#second_saleable_area_select_${index}`).val();
                            element.built_up_map_unit = $(`#second_built_up_area_select_${index}`).val();
                            element.carpet_area_map_unit = $(`#second_carpet_area_select_${index}`).val();
                            element.balcony_area_map_unit = $(`#second_balcony_area_select_${index}`).val();
                            element.wash_area_map_unit = $(`#second_wash_area_select_${index}`).val();
                            element.terrace_carpet_area_map_unit = $(`#second_terrace_carpet_select_${index}`).val();
                            element.terrace_saleable_area_map_unit = $(`#second_terrace_saleable_select_${index}`).val();
                            element.floor_height_map_unit = $(`#second_floor_height_select_${index}`).val();
                            element.ceiling_height_map_unit = $(`#second_ceiling_height_select_${index}`).val();
                        } else {
                            element.wing = $(`#wing_array_${index}`).val();
                            element.saleable_map_unit = $(`#saleable_area_select_${index}`).val();
                            element.built_up_map_unit = $(`#built_up_area_select_${index}`).val();
                            element.carpet_area_map_unit = $(`#carpet_area_select_${index}`).val();
                            element.balcony_area_map_unit = $(`#balcony_area_select_${index}`).val();
                            element.wash_area_map_unit = $(`#wash_area_select_${index}`).val();
                            element.terrace_carpet_area_map_unit = $(`#terrace_carpet_select_${index}`).val();
                            element.terrace_saleable_area_map_unit = $(`#terrace_saleable_select_${index}`).val();
                            element.floor_height_map_unit = $(`#floor_height_select_${index}`).val();
                            element.ceiling_height_map_unit = $(`#ceiling_height_select_${index}`).val();
                            element.ceiling_height_map_unit = $(`#second_ceiling_height_select_${index}`).val();
                        }
                    });

                    if(this.property_type == 88 || this.property_type == 89)
                    {
                        this.if_office_or_retail.front_road_width_map_unit = $('#second_front_road_map_unit_select').val() ?? '';
                    } else {
                        this.if_office_or_retail.front_road_width_map_unit = $('#first_front_road_map_unit_select').val() ?? '';
                    }

                    this.if_retail_tower_details.forEach((element , index) => {
                        if(this.property_type == 88 || this.property_type == 89)
                        {
                            element.sub_category = $(`#extra_floor_category_${index}`).val() ?? '';
                            element.size_from_map_unit = $(`#extra_tower_size_from_to_select_${index}`).val() ?? '';
                            element.tower_front_opening_map_unit = $(`#extra_tower_front_opening_select_${index}`).val() ?? '';
                            element.tower_ceiling_map_unit = $(`#extra_tower_ceiling_select_${index}`).val() ?? '';
                        } else {
                            element.sub_category = $(`#floor_category_${index}`).val() ?? '';
                            element.size_from_map_unit = $(`#tower_size_from_to_select_${index}`).val() ?? '';
                            element.tower_front_opening_map_unit = $(`#tower_front_opening_select_${index}`).val() ?? '';
                            element.tower_ceiling_map_unit = $(`#tower_ceiling_select_${index}`).val() ?? '';
                        }
                    });

                    this.if_farm_plot_land.land_area_map_unit = $('#land_area_select').val() ?? '';
                    this.if_farm_plot_land.open_area_map_unit = $('#open_area_select').val() ?? '';
                    this.if_farm_plot_land.common_area_map_unit = $('#common_area_select').val() ?? '';
                    this.if_farm_plot_land.plot_size_from_map_unit = $('#plot_size_from_select').val() ?? '';
                    this.if_farm_plot_land.plot_size_to_map_unit = $('#plot_size_to_select').val() ?? '';

                    this.if_farm_plot_land.carpet_plot_size_map_unit = $('#carpet_plot_size_select').val() ?? '';

                    this.if_farm_plot_land.constructed_saleable_area_map_unit = $('#constructed_saleable_area_select').val() ?? '';
                    this.if_farm_plot_land.constructed_carpet_area_map_unit = $('#constructed_carpet_area_select').val() ?? '';
                    
                    this.if_farm_plot_land.constructed_built_up_from_map_unit = $('#constructed_built_up_from_area_select').val() ?? '';
                    this.if_farm_plot_land.constructed_built_up_to_map_unit = $('#constructed_built_up_to_area_select').val() ?? '';

                    let form_data = new FormData();
                    
                    // first section

                    form_data.set('id', this.id);
                    form_data.set('builder_id', $('#builder_id').val());
                    form_data.set('website', this.website);

                    form_data.set('other_contact_details', JSON.stringify(this.other_contact_details));

                    form_data.set('project_name', this.project_name);
                    form_data.set('address', this.address);

                    form_data.set('locality', $('#area_id').val() ?? '');
                    form_data.set('state', $('#state_id').val() ?? '');
                    form_data.set('city', $('#city_id').val() ?? '' );

                    form_data.set('location_link', this.location_link);
                    
                    let pincode = document.getElementById('pincode').value;
                    form_data.set('pincode', pincode);
                    form_data.set('land_area',  this.land_size);
                    form_data.set('land_size_unit', $('#land_size_select').val() ?? '');

                    form_data.set('number_of_unit_in_project',  this.number_of_unit_in_project);
                    form_data.set('rera_number', this.rera_no);

                    form_data.set('project_status', $('#project_status').val() ?? '');

                    let project_status = $('#project_status').val() ?? '';

                    if(project_status == 143) {
                        form_data.set('project_status_question', this.project_status_question);
                    }

                    if(project_status == 142) {
                        form_data.set('project_status_question', $('#status').val() ?? '');
                    }

                    form_data.set('restricted_user', JSON.stringify($('#restrictions').val()));

                    // second section

                    form_data.set('propery_type', this.property_type > 0 ? this.property_type : '');
                    form_data.set('property_category', this.property_category > 0 ? this.property_category : '');
                    form_data.set('sub_categories', JSON.stringify(this.sub_categories));
                    form_data.set('sub_category_single', this.sub_category_single);

                    form_data.set('is_flat_or_penthouse', JSON.stringify(this.is_flat_or_penthouse));

                    form_data.set('if_residential_only_wings', JSON.stringify(this.if_residential_only_wings.wing_details));
                    form_data.set('if_residential_only_units', JSON.stringify(this.if_residential_only_units.unit_details));

                    form_data.set('if_office_or_retail', JSON.stringify(this.if_office_or_retail));
                    form_data.set('if_office_tower_details', JSON.stringify(this.if_office_tower_details));

                    form_data.set('if_office_tower_details_with_specification', this.if_office_tower_details_with_specification);

                    form_data.set('if_retail_tower_details', JSON.stringify(this.if_retail_tower_details));
                    form_data.set('if_farm_plot_land', JSON.stringify(this.if_farm_plot_land));

                    this.if_ware_cold_ind_plot.types.forEach((type, index) => {
                        type.carpet_from_to_unit_map = $(`#carpet_from_to_select_${index}`).val() ?? '';
                        type.constructed_from_to_unit_map = $(`#constructed_from_to_select_${index}`).val() ?? '';
                        type.road_width_of_front_side_area_from_to_unit_map = $(`#road_width_of_front_side_area_from_to_select_${index}`).val() ?? '';
                        type.ceiling_height_unit_map = $(`#type_ceiling_height_${index}`).val() ?? '';
                    });

                    form_data.set('if_ware_cold_ind_plot', JSON.stringify(this.if_ware_cold_ind_plot.types));
                    form_data.set('storage_industrial_details', JSON.stringify(this.storage_industrial));
                    form_data.set('extra_facilities', JSON.stringify(this.extra_facilities));

                    // third section

                    form_data.set('total_number_of_parking', this.total_number_of_parking);
                    form_data.set('free_alloted_for_two_wheeler', this.free_alloted_for_two_wheeler);
                    form_data.set('free_alloted_for_four_wheeler', this.free_alloted_for_four_wheeler);
                    form_data.set('available_for_purchase', this.available_for_purchase);

                    form_data.set('total_floor_for_parking', this.total_floor_for_parking);

                    for (let index = 0; index < this.parking_details.length; index++) {
                        if($(`#height_basement_select_${index}`)) {
                            this.parking_details[index]['height_of_basement_map_unit'] = $(`#height_basement_select_${index}`).val() ?? '';
                        }
                    }

                    form_data.set('parking_details', JSON.stringify(this.parking_details));
                    form_data.set('amenities', this.amenities.length > 0 ? JSON.stringify(this.amenities) : '' );
                    
                    form_data.set('document_category', $('#image_category').val() ?? '');
                    let document_image = document.getElementById('document_image');
                    if(document_image && document_image.files.length > 0)
                    {
                        let file = document_image.files[0];
                        form_data.set('document_image', file, file.name);
                    }

                    let catlog_file = document.getElementById('catlog_file');
                    if(catlog_file && catlog_file.files.length > 0)
                    {
                        let file = catlog_file.files[0];
                        form_data.set('catlog_file', file, file.name);
                    }

                    form_data.set('remark', this.remark);

                    this.other_documents.forEach((other_document_detail, index) => {
                        let selected_value = $(`#other_doc_${index}`).val();
                        this.other_documents[index]['document_type'] = selected_value;

                        let other_doc = document.getElementById(`document_image_${index}`);
                        if(other_doc && other_doc.files.length > 0)
                        {
                            let file = other_doc.files[0];
                            form_data.set(`other_doc_${index}`, file, file.name);
                        }
                    });

                    form_data.set('other_documents', JSON.stringify(this.other_documents));

                    let url = "{{ route('builder.saveProject') }}";
                    
                    axios.post(url, form_data, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((res) => {
                        var redirect_url = "{{route('builder.projects')}}";
                        window.location.href = redirect_url;
                    })
                    .catch((err) => {
                        if(err.response.status != 500) {
                            _this.errors = err.response.data.errors;
                        }
                    });
                }
            }));
        });

    </script>

    <script src="{{ asset('admins/assets/js/form-wizard/form-wizard-two.js') }}"></script>
    
    <script>

		var shouldchangecity = 1;
		var building_image_show_url = "{{ asset('upload/document_image') }}";

		function enableTouchspin(params) {
                !(function(t, n, s) {
                    "use strict";
                    s("html");
                    s(".touchspin").TouchSpin({
                            buttondown_class: "btn btn-primary btn-square",
                            buttonup_class: "btn btn-primary btn-square",
                            buttondown_txt: '<i class="fa fa-minus"></i>',
                            buttonup_txt: '<i class="fa fa-plus"></i>',
                        }),
                        s(".touchspin-vertical").TouchSpin({
                            verticalbuttons: !0,
                            verticalupclass: "fa fa-angle-up",
                            verticaldownclass: "fa fa-angle-down",
                            buttondown_class: "btn btn-primary btn-square",
                            buttonup_class: "btn btn-primary btn-square",
                        }),
                        s(".touchspin-stop-mousewheel").TouchSpin({
                            mousewheel: !1,
                            buttondown_class: "btn btn-primary btn-square",
                            buttonup_class: "btn btn-primary btn-square",
                            buttondown_txt: '<i class="fa fa-minus"></i>',
                            buttonup_txt: '<i class="fa fa-plus"></i>',
                        }),
                        s(".touchspin-color").each(function(t) {
                            var n = "btn btn-primary btn-square",
                                u = "btn btn-primary btn-square",
                                a = s(this);
                            a.data("bts-button-down-class") &&
                                (n = a.data("bts-button-down-class")),
                                a.data("bts-button-up-class") &&
                                (u = a.data("bts-button-up-class")),
                                a.TouchSpin({
                                    mousewheel: !1,
                                    buttondown_class: n,
                                    buttonup_class: u,
                                    buttondown_txt: '<i class="fa fa-minus"></i>',
                                    buttonup_txt: '<i class="fa fa-plus"></i>',
                                });
                        });
                })(window, document, jQuery);
            }


		$(document).ready(function() {

			var queryString = window.location.search;
			var urlParams = new URLSearchParams(queryString);
			var go_data_id = urlParams.get('data_id');

			var cities = @Json($city_encoded);
			var states = @Json($state_encoded);
			var areas = @Json($area_encoded);

			$(document).on('change', '#state_id', function(e) {

                document.getElementById('city_id').disabled = $("#state_id").val() > 0 ? false : true;

				if (shouldchangecity) {
					$('#city_id').select2('destroy');

					citiesar = JSON.parse(cities);
					areass = JSON.parse(areas);

					$('#city_id').html('');
                    $('#city_id').append('<option value="" selected disabled>Select City</option>');
                    for (let i = 0; i < citiesar.length; i++) {
						if (citiesar[i]['state_id'] == $("#state_id").val()) {
							$('#city_id').append('<option value="' + citiesar[i]['id'] + '">' + citiesar[i][
								'name'
							] + '</option>')
						}
					}
					$('#city_id').select2();
				}
			});

            $('#city_id').on('change', function() {
                $(document).on('change', '#city_id', function(e) {
                    $('#area_id').html('');
                    areass = JSON.parse(areas);
                    $('#area_id').append('<option value="" selected disabled>Locality</option>');
                    for (let i = 0; i < areass.length; i++) {
                        if (areass[i]['city_id'] == $("#city_id").val()) {
                            $('#area_id').append(`<option value="${areass[i]['id']}"
                                data-pincode="${areass[i]['pincode']}"
                                data-city_id="${areass[i]['city_id']}"
                                data-state_id="${areass[i]['state_id']}">
                                ${areass[i]['name']}
                            </option>`);
                        }
                    }
                    $('#area_id').select2();
                    document.getElementById('area_id').disabled = $("#city_id").val() > 0 ? false : true;
                })
            });

			$('#projectTable').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('builder.projects') }}",
					data: function(d) {
						d.go_data_id = go_data_id;
					}
				},
				columns: [
					{
						data: 'select_checkbox',
						name: 'select_checkbox',
						orderable: false
					},
				{
						data: 'project_name',
						name: 'project_name'
					},
					{
						data: 'address',
						name: 'address'
					},
					{
						data: 'builder_id',
						name: 'builder_id'
					},
					{
						data: 'property_type',
						name: 'property_type'
					},
					{
						data: 'modified_at',
						name: 'modified_at'
					},
					{
						data: 'Actions',
						name: 'Actions',
						orderable: false
					},
				],
			});
		});

		$(document).on("click", ".open_modal_with_this", function(e) {
			$('#all_contacts').html('')
			$('#all_towers').html('')
			$('#all_unit_types').html('')
			$('#all_contacts').append(generate_contact_detail(makeid(10)));
			$('#all_towers').append(generate_tower_detail(makeid(10)));
			$("#all_towers select").each(function(index) {
				$(this).select2();
			})
			$('#all_unit_types').append(generate_unit_types_detail(makeid(10)));
			$("#all_unit_types select").each(function(index) {
				$(this).select2();
			})
			$('#all_images').html('');
			floatingField()
		})

		$(document).on('change', '[name=penthouse]', function(e) {

			if ($(this).prop('checked')) {
				unique_id = $(this).closest('div').attr('data-contact_id')
				$("[data-contact_id=" + unique_id + "] [name=terrace_carpet_area]").closest('.col-md-3').show()
				$("[data-contact_id=" + unique_id + "] [name=terrace_carpet_area_measurement]").closest('.col-md-3')
					.show()
				$("[data-contact_id=" + unique_id + "] [name=terrace_super_builtup_area]").closest('.col-md-3')
					.show()
				$("[data-contact_id=" + unique_id + "] [name=terrace_super_builtup_area_measurement]").closest(
					'.col-md-3').show()
			} else {
				$("[data-contact_id=" + unique_id + "] [name=terrace_carpet_area]").closest('.col-md-3').hide()
				$("[data-contact_id=" + unique_id + "] [name=terrace_carpet_area_measurement]").closest('.col-md-3')
					.hide()
				$("[data-contact_id=" + unique_id + "] [name=terrace_super_builtup_area]").closest('.col-md-3')
					.hide()
				$("[data-contact_id=" + unique_id + "] [name=terrace_super_builtup_area_measurement]").closest(
					'.col-md-3').hide()
			}
		})

		var allowedselect2s = ['builder_id'];
		$(document).on('keydown', '.select2-search__field', function(e) {
			setTimeout(() => {
				var par = $(this).closest('.select2-dropdown')
				var tar = $(par).find('.select2-results')
				var kar = $(tar).find('.select2-results__options')
				var opt = $(kar).find('li')
				if (opt.length == 1 && $(opt[0]).text() == 'No results found') {
					var idd = $(kar).attr('id')
					idd = idd.replace("select2-", "");
					idd = idd.replace("-results", "");
					if (allowedselect2s.includes(idd)) {
						$("#" + idd + " option[last_added='" + true + "']").each(function(i, e) {
							$('#' + idd + ' option[value="' + $(this).val() + '"]').detach();
						});
						if ($("#" + idd + " option[value='" + $(this).val() + "']").length == 0) {
							var newState = new Option($(this).val(), $(this).val(), true, true);

							vvvv = $.parseHTML('<option last_added="true" value="' + $(this).val() +
								'" selected="">' + $(this).val() + '</option>');
							$("#" + idd).append(vvvv).trigger('change');
						}
					}
				}else if ($(this).val() != '' && $(opt[0])[0] !== undefined && $($(opt[0])[0]).attr('id') != ''){
				var idd = $(kar).attr('id')
				idd = idd.replace("select2-", "");
				idd = idd.replace("-results", "");
				if (allowedselect2s.includes(idd)) {
					$("#"+idd+ " option[last_added='"+true+"']").each(function(i,e){
						$('#'+idd+' option[value="' + $(this).val() + '"]').detach();
					});
					if ($("#"+idd+ " option[value='"+$(this).val()+"']").length == 0) {
						var newState = new Option($(this).val(), $(this).val(), true, true);

						vvvv = $.parseHTML('<option last_added="true" value="'+$(this).val()+'" selected="">'+$(this).val()+'</option>');
						$("#"+idd).append(vvvv).trigger('change');
					}
				}
			}
			}, 50);
		})

		$(document).on('change', '#select_all_checkbox', function(e) {
			if ($(this).prop('checked')) {
				$('.delete_table_row').show();

				$(".table_checkbox").each(function(index) {
					$(this).prop('checked',true)
				})
			}else{
				$('.delete_table_row').hide();
				$(".table_checkbox").each(function(index) {
					$(this).prop('checked',false)
				})
			}
		})

		$(document).on('change', '.table_checkbox', function(e) {
			var rowss = [];
			$(".table_checkbox").each(function(index) {
				if ($(this).prop('checked')) {
					rowss.push($(this).attr('data-id'))
				}
			})
			if (rowss.length > 0) {
				$('.delete_table_row').show();
			}else{
				$('.delete_table_row').hide();
			}
		})

		function deleteTableRow(params) {
			var rowss = [];
			$(".table_checkbox").each(function(index) {
				if ($(this).prop('checked')) {
					rowss.push($(this).attr('data-id'))
				}
			})
			if (rowss.length>0) {
				Swal.fire({
				title: "Are you sure?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes',
			}).then(function(isConfirm) {
				if (isConfirm.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "{{ route('builder.deleteProject') }}",
						data: {
							allids: JSON.stringify(rowss),
							_token: '{{ csrf_token() }}'
						},
						success: function(data) {
							$('.delete_table_row').hide();
							$('#projectTable').DataTable().draw();
						}
					});
				}
			})
			}
		}
        
		function deleteProject(data) {
			Swal.fire({
				title: "Are you sure?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes',
			}).then(function(isConfirm) {
				if (isConfirm.isConfirmed) {
					var id = $(data).attr('data-id');
					$.ajax({
						type: "POST",
						url: "{{ route('builder.deleteProject') }}",
						data: {
							id: id,
							_token: '{{ csrf_token() }}'
						},
						success: function(data) {
							$('#projectTable').DataTable().draw();
						}
					});
				}
			})

		}

		function makeid(length) {
			var result = '';
			var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			var charactersLength = characters.length;
			for (var i = 0; i < length; i++) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}
			return result;
		}

		function generate_contact_detail(id) {
			var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-4 m-b-20">' +
				'<label>Contact Person Name</label>'+
				'       <input class="form-control" name="contact_person_name" type="text"' +
				'            autocomplete="off">' +
				'     </div>' +
				'     <div data-contact_id= ' + id +
				' class="form-group col-md-3 m-b-20">' +
				'<label>Contact Person No.</label>'+
				'       <input class="form-control" name="contact_person_no"' +
				'           type="text"  autocomplete="off">' +
				'   </div>' +
				'     <div data-contact_id= ' + id +
				' class="form-group col-md-4 m-b-20">' +
				'<label>Contact Type</label>'+
				'       <input class="form-control" name="contact_person_type"' +
				'           type="text"  autocomplete="off">' +
				'   </div>' +
				'<div data-contact_id= ' + id +
				' class="form-group col-md-1 m-b-4 mb-3"><button data-contact_id=' + id +
				' class="remove_contacts btn btn-primary" style="border-radius:5px;" type="button">-</button>  </div>';
			return myvar;
		}

		$(document).on('click', '#add_contacts', function(e) {
			id = makeid(10);
			$('#all_contacts').append(generate_contact_detail(id));
			floatingField();
		})
		$(document).on('click', '.remove_contacts', function(e) {
			id = $(this).attr('data-contact_id');
			$("[data-contact_id=" + id + "]").each(function(index) {
				$(this).remove();
			});
		})

		$(document).on('change', '#area_id', function(e) {
			if ($(this).find(":selected").attr('data-city_id') !== undefined && $(this).find(":selected").attr(
					'data-city_id') != '') {
				$('#pincode').val($(this).find(":selected").attr('data-pincode')).trigger('change');
			}
		})

		function generate_tower_detail(id) {

		}

		function generate_unit_types_detail(id) {
			$("#unit_types_template div,#unit_types_template button").each(function(index) {
				$(this).attr('data-contact_id', id)
			});
			var str = $("#unit_types_template").html()
			$("#unit_types_template div,#unit_types_template button").each(function(index) {
				$(this).attr('data-contact_id', '')
			});
			return str;
		}

        add_wings();

        function add_wings() {
            id = makeid(10);
			$('#all_towers').append(generate_tower_detail(id));
			$("#all_towers select").each(function(index) {
				$(this).select2();
			})
			floatingField();
        }

		$(document).on('click', '#add_towers', function(e) {
			id = makeid(10);
			$('#all_towers').append(generate_tower_detail(id));
			$("#all_towers select").each(function(index) {
				$(this).select2();
			})
			floatingField();
		})
		$(document).on('click', '.remove_towers', function(e) {
			id = $(this).attr('data-contact_id');
			$("[data-contact_id=" + id + "]").each(function(index) {
				$(this).remove();
			});
		})

        add_initial_unit();

        function add_initial_unit() {
            id = makeid(10);
			$('#all_unit_types').append(generate_unit_types_detail(id));
			$("#all_unit_types select").each(function(index) {
				$(this).select2();
			})
			floatingField();
        }

		$(document).on('click', '#add_unit_types', function(e) {
			id = makeid(10);
			$('#all_unit_types').append(generate_unit_types_detail(id));
			$("#all_unit_types select").each(function(index) {
				$(this).select2();
			})
			floatingField();
		})
		$(document).on('click', '.remove_unit_types', function(e) {
			id = $(this).attr('data-contact_id');
			$("[data-contact_id=" + id + "]").each(function(index) {
				$(this).remove();
			});
		})

		$('#modal_form').validate({ // initialize the plugin
			rules: {
				project_name: {
					required: true,
				},
				pincode: {
					required: true,
					digits: true,
				},
				email: {
					email: true,
				},
				floor_count: {
					digits: true,
				},
				unit_no: {
					digits: true,
				},
				lift_count: {
					digits: true,
				},
			},
			submitHandler: function(form) { // for demo
				alert('valid form submitted'); // for demo
				return false; // for demo
			}
		});


		$(document).on('click', '#saveProject', function(e) {
			e.preventDefault();
			$("#modal_form").validate();
			if (!$("#modal_form").valid()) {
				return
			}
			$(this).prop('disabled', true);
			var amenities = []
			var contact_details = [];
			var tower_details = [];
			var unit_details = [];
			$(".project_amenity").each(function(index) {
				if ($(this).prop('checked')) {
					amenities.push(1);
				} else {
					amenities.push(0);
				}
			});
			amenities = JSON.stringify(amenities);

			$("#all_contacts [name=contact_person_name]").each(function(index) {
				cona_arr = []
				unique_id = $(this).parent().attr('data-contact_id');
				name = $(this).val();
				no = $("[data-contact_id=" + unique_id + "] input[name=contact_person_no]").val();
				typee = $("[data-contact_id=" + unique_id + "] input[name=contact_person_type]").val();
				cona_arr.push(name)
				cona_arr.push(no)
				cona_arr.push(typee)
				if (filtercona_arr(cona_arr)) {
					contact_details.push(cona_arr);
				}
			});
			contact_details = JSON.stringify(contact_details);

			$("#all_towers [name=tower_name]").each(function(index) {
				cona_arr = []
				unique_id = $(this).parent().attr('data-contact_id');
				name = $(this).val();
				tower_total_units = $("[data-contact_id=" + unique_id + "] [name=tower_total_units]")
					.val();
				total_floor = $("[data-contact_id=" + unique_id + "] [name=total_floor]").val();
				cona_arr.push(name);
				cona_arr.push(tower_total_units);
				cona_arr.push(total_floor);
				if (filtercona_arr(cona_arr)) {
					tower_details.push(cona_arr);
				}
			})

			tower_details = JSON.stringify(tower_details);

			$("#all_unit_types [name=type_plan_name]").each(function(index) {
				cona_arr = []
				unique_id = $(this).parent().attr('data-contact_id');
				type_plan_name = $(this).val();
				requirement_type = $("[data-contact_id=" + unique_id + "] [name=requirement_type]").val();
				configuration = $("[data-contact_id=" + unique_id + "] [name=configuration]").val();
				builtuparea = $("[data-contact_id=" + unique_id +
					"] [name=builtup_area]").val();
				builtup_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=builtup_area_measurement]").val();
				rera_area = $("[data-contact_id=" + unique_id + "] [name=rera_area]").val();
				rera_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=rera_area_measurement]").val();
				wash_area = $("[data-contact_id=" + unique_id + "] [name=wash_area]").val();
				wash_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=wash_area_measurement]").val();
				balcony_area = $("[data-contact_id=" + unique_id + "] [name=balcony_area]").val();
				balcony_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=balcony_area_measurement]").val();
				carpet_area = $("[data-contact_id=" + unique_id + "] [name=carpet_area]").val();
				carpet_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=carpet_area_measurement]").val();
				terrace_carpet_area = $("[data-contact_id=" + unique_id + "] [name=terrace_carpet_area]")
					.val();
				terrace_carpet_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=terrace_carpet_area_measurement]").val();
				terrace_super_builtup_area = $("[data-contact_id=" + unique_id +
					"] [name=terrace_super_builtup_area]").val();
				terrace_super_builtup_area_measurement = $("[data-contact_id=" + unique_id +
					"] [name=terrace_super_builtup_area_measurement]").val();

				cona_arr.push(type_plan_name)
				cona_arr.push(requirement_type)
				cona_arr.push(configuration)
				cona_arr.push(builtuparea)
				cona_arr.push(builtup_area_measurement)
				cona_arr.push(rera_area)
				cona_arr.push(rera_area_measurement)
				cona_arr.push(wash_area)
				cona_arr.push(wash_area_measurement)
				cona_arr.push(balcony_area)
				cona_arr.push(balcony_area_measurement)
				cona_arr.push(carpet_area)
				cona_arr.push(carpet_area_measurement)
				cona_arr.push(terrace_carpet_area)
				cona_arr.push(terrace_carpet_area_measurement)
				cona_arr.push(terrace_super_builtup_area)
				cona_arr.push(terrace_super_builtup_area_measurement)
				if (filtercona_arr(cona_arr)) {
					unit_details.push(cona_arr);
				}
			});
			unit_details = JSON.stringify(unit_details);

			var id = $('#this_data_id').val()
			$.ajax({
				type: "POST",
				url: "{{ route('builder.saveProject') }}",
				data: {
					id: id,
					project_name: $('#project_name').val(),
					builder_id: $('#builder_id').val(),
					area_id: $('#area_id').val(),
					state_id: $('#state_id').val(),
					city_id: $('#city_id').val(),
					address: $('#address').val(),
					pincode: $('#pincode').val(),
					status: Number($('#status').prop('checked')),
					email: $('#email').val(),
					floor_count: $('#floor_count').val(),
					unit_no: $('#unit_no').val(),
					lift_count: $('#lift_count').val(),
					property_type: JSON.stringify($('#property_type').val()),
					project_description: $('#project_description').val(),
					contact_details: contact_details,
					amenities: amenities,
					tower_details: tower_details,
					unit_details: unit_details,
					building_posession: $('#building_posession').val(),
					is_prime: Number($('#prime_project').prop('checked')),
					restrictions: $('#restrictions').val(),
					project_status: $('#project_status').val(),
					building_quality: $('#building_quality').val(),
					_token: '{{ csrf_token() }}'
				},
				success: function(data) {
					var redirect_url = "{{route('builder.projects')}}";
                    window.location.href = redirect_url;
				}
			});
		})

		function floatingField(){
			//changed by Subhash
			$("form input").each(function(index) {
				if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
					var inputhtml = $(this).clone()
					var parentId = $(this).parent();
					if (parentId.find('label').length > 0) {
						$(this).remove();
						var currenthtml = $(parentId).html()
						$(parentId).html('<div class="fname">' + currenthtml + '<div class="fvalue">' + inputhtml[0]
							.outerHTML + '</div>' + '</div>')
					}
				}
			})
		}

		function setProjectStatusInput(value) {
			let input_div = document.getElementById('project_status_input');

			if(value.value !== '') {

                if(value.value != 142) {
                    input_div.innerHTML = `<div class="fname" :class="project_status_question == '' ? '' : 'focused' ">
					<label>Possession Month & Year</label>
                        <div class="fvalue">
                            <input class="form-control" x-model="project_status_question" name="projectStatusInput" type="text" autocomplete="off" :class="errors.hasOwnProperty('project_status_question') ? 'is-invalid' : ''">
                            <div class="invalid-feedback">
                                <span x-text="errors.project_status_question"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger new_error d-none" id="err_status">Status field is required.</span>`;

                } else {
                    input_div.innerHTML = `<div class="form-group col-md-6 m-b-4">
                        <select class="form-select" name="status" id="status">
                            <option value="">Age Of Property</option>
                            <option value="0 To 1 Years">0 To 1 Years</option>
                            <option value="1 To 5 Years">1 To 5 Years</option>
                            <option value="5 To 10 Years">5 To 10 Years</option>
                            <option value="10+ Years">10+ Years</option>
                        </select>
                    </div><span class="text-danger new_error d-none" id="err_status">Status field is required.</span>`;

                    $('#status').select2();
                }

			} else {
				input_div.innerHTML = '';
			}
		}

		showReleventCategory();

		function showReleventCategory(params) {

			var parent_val = $('input[name=property_type]:checked').val();
			$("[name='property_category']").each(function(i, e) {
				if ($(this).attr('data-Parent_id') == parent_val) {
					$(this).parent().show();
				} else {
					$(this).parent().hide();
				}
			});
		}

		function setIndividualfields() {
			hidefields = ['the_constructed_carpet_area', 'the_constructed_salable_area', 'the_constructed_builtup_area',
				'the_salable_plot_area', 'the_carpet_plot_area', 'the_centre_height', 'the_salable_area',
				'the_length_of_plot', 'the_width_of_plot', 'the_carpet_area', 'the_opening_width',
				'the_ceilling_height', 'the_builtup_area', 'the_plot_area', 'the_terrace_area', 'the_construction_area',
				'the_terrace_carpet_area', 'the_terrace_salable_area', 'the_total_units_in_project',
				'the_total_no_of_floor', 'the_total_units_in_tower', 'the_property_on_floors', 'the_no_of_elavators',
				'the_total_no_of_units', 'the_no_of_room', 'the_no_of_bathrooms',
				'the_no_of_balcony', 'the_no_of_floors_allowed', 'the_no_of_side_open', 'the_servent_room',
				'the_service_elavator', 'the_two_wheller_Parking', 'the_constructed_plot_price', 'the_1rk',
				'the_source_refrence', 'the_pre_leased_remarks', 'div_available_from'
			]
			for (let i = 0; i < hidefields.length; i++) {
				$('.' + hidefields[i]).hide();
			}
		}

		function resetallfields() {
                hidefields = ['div_office_type', 'div_vila_type', 'div_retail_type', 'div_flat_type', 'div_plot_type', 'div_storage_type',
                    'div_property_address', 'div_flat_details', 'div_flat_details_2', 'div_flat_details_3',
                    'div_description_section', 'div_survey_details', 'div_tp_details',
                    'div_document_section', 'div_office_setup', 'div_road_width',
                    'div_washroom_type_1', 'div_conference_room', 'div_reception_area', 'div_pantry_type',
                    'div_availability_status', 'div_age_of_property', 'div_Possession_by', 'div_shop_facade_size',
                    'div_floor_allowed_for_construction', 'div_borewell', 'div_property_dimensions', 'div_washroom_type_2',
                    'div_flat_details_4', 'div_flat_details_5', 'div_other_details',
                    'div_flat_details_7', 'div_flat_details_8', 'div_plot_ind_common',
                    'div_area_size_details', 'div_area_size_details_land_plot', 'div_flat_details_vila',
                    'div_checkboxes1', 'div_extra_retail_details', 'div_property_source', 'div_office_furnished',
                    'div_care_taker', 'div_furnished_items', 'div_furnished_items_2', 'the_furnished_status',
                    'div_construction_allowed_for', 'div_retail_furnished', 'div_amenities', 'div_amenities_checks'
                ]
                for (let i = 0; i < hidefields.length; i++) {
                    $('.' + hidefields[i]).hide();
                }

            }

		$(document).on('change', '[name="property_type"]', function(e) {
			$('input[name=property_category]:checked').prop('checked', false).trigger('change')
			setIndividualfields();
			showReleventCategory();
		})

		function addAddAreaButtons(arr, arr2) {
                for (let i = 0; i < arr.length; i++) {
                    if($("#add_area_button_container .add_other_area_details[data-val='"+arr[i]+"']").length==0){
						var str =
							'<div  class="form-group col-md-auto  mb-3"> <a class="add_other_area_details" style="color:#0078DB!important" href="javascript:void(0)" data-val="' +
							arr[i] + '" > + ' + arr2[i] + '</a> </div>';
						$('#add_area_button_container').append(str);
					}

                }
            }

		resetallfields();


		function generate_unit_detail(id, plus = 0) {
                var myvar = '<div class="row"><div  data-unit_id= ' +
                    id + ' class="form-group the_wing col-md-2 m-b-20">' +
                    '<label>Wing</label>' +
                    '            <input class="form-control" name="wing" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '<div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-20">' +
                    '<label>Unit No</label>' +
                    '            <input class="form-control" name="unit_unit_no" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '        <div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-4 mb-3">' +
                    '            <select class="form-select" name="unit_status" id="unit_status">' +
                    '                <option value="">Unit Status</option>' +
                    '                <option value="Available">Available</option>' +
                    '                <option value="Rent Out">Rent Out</option>' +
                    '                <option value="Sold Out">Sold Out</option>' +
                    '            </select>' +
                    '        </div>' +
                    '<div  data-unit_id= ' + id + ' class="the_price_rent form-group col-md-2 m-b-20">' +
                    '<label>Price Rent</label>' +
                    '            <input class="form-control indian_currency_amount" name="price_rent" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '<div  data-unit_id= ' + id + ' class="the_price form-group col-md-2 m-b-20">' +
                    '<label>Price</label>' +
                    '            <input class="form-control indian_currency_amount" name="price" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '<div class="the_constructed_plot_price row"><div  data-unit_id= ' + id +
                    ' class=" form-group col-md-2 m-b-20">' +
                    '<label class="price_constructed_label"> Construction Price</label>' +
                    '            <input class="form-control indian_currency_amount" data-unit_id= ' + id +
                    ' name="price_constructed" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '<div  data-unit_id= ' + id + ' class="col-md-2 m-b-20">' +
                    '<div class=" form-group">' +
                    '<label class="price_plot_label"> Plot Price</label>' +
                    '            <input class="form-control indian_currency_amount" data-unit_id= ' + id +
                    ' name="price_plot" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>'+

                    '</div>'+
                    '<div  data-unit_id= ' + id + ' class=" form-group col-md-2 m-b-20">' +
                    '<div class=" form-group">' +
                    '<label>Price</label>' +
                    '            <input class="form-control indian_currency_amount" data-unit_id= ' + id +
                    ' name="price_total" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>'+
                    '<small style="display:none"  class="text-secondary ps-1 converted_value"></small>'+
                    '</div></div>' +
                    '        <div  data-unit_id= ' + id + ' class="the_furnished_status form-group col-md-3 m-b-4 mb-3">' +
                    '            <select class="form-select" name="furnished_status" id="furnished_status">' +
                    '                <option value="">Furnished Status</option>' +
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_furniture_type')
                            '                <option data-val="{{ $props['name'] }}" value="{{ $props['id'] }}">{{ $props['name'] }}</option>' +
                        @endif
                    @empty
                    @endforelse

                '            </select>' +
                '        </div>' +
				'<div data-unit_id= ' + id +
                    ' class="form-group col-md-1 m-b-4 mb-3"><button data-unit_id=' + id +
                    ' class="' + ((plus) ? "add_units" : "remove_units") + ' btn btn-primary" style="border-radius:5px;" type="button">' + ((
                        plus) ? "+" : "-") + '</button>  </div>'+
                '</div>';
                return myvar;
            }
		
			function generate_furnished_detail(id) {
                var currentFurnished = $('input[name=property_category]:checked').attr('data-val')
                if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                    $("#office_furnished_template div,#office_furnished_template button,#office_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', id)
                        });
                    var str = $("#office_furnished_template").html()
                    $("#office_furnished_template div,#office_furnished_template button,#office_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', '')
                        });
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                    $("#retail_furnished_template div,#retail_furnished_template button,#retail_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', id)
                        });
                    var str = $("#retail_furnished_template").html()
                    $("#retail_furnished_template div,#retail_furnished_template button,#retail_furnished_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', '')
                        });
                } else if (currentFurnished != 'Storage/industrial' && currentFurnished != 'Plot') {
                    $("#furnished_types_template div,#furnished_types_template button,#furnished_types_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', id)
                        });
                    var str = $("#furnished_types_template").html()
                    $("#furnished_types_template div,#furnished_types_template button,#furnished_types_template input").each(
                        function(index) {
                            $(this).attr('data-unit_id', '')
                        });
                }
                return str;
            }
		
			function setFurnishedStatus(TheStatus, id) {
                $('.div_retail_furnished[data-unit_id="' + id + '"]').hide()
                $('.div_office_furnished[data-unit_id="' + id + '"]').hide()
                $('.div_furnished_items[data-unit_id="' + id + '"]').hide()
                $('.div_furnished_items_2[data-unit_id="' + id + '"]').hide()

                if (TheStatus == 'Unfurnished' || TheStatus == '' || TheStatus == undefined) {
                    return;
                }
                if ($('input[name=property_category]:checked').attr('data-val') == 'Retail') {
                    $('.div_retail_furnished[data-unit_id="' + id + '"]').show()
                } else if ($('input[name=property_category]:checked').attr('data-val') == 'Office') {
                    $('.div_office_furnished[data-unit_id="' + id + '"]').show()
                } else {
                    $('.div_furnished_items[data-unit_id="' + id + '"]').show()
                    $('.div_furnished_items_2[data-unit_id="' + id + '"]').show()

                }
            }

		function generate_contact_detail_click(plus = 0) {
                id = makeid(10);
                $('#all_owner_contacts').append(generate_contact_detail(id, plus));
                $("#all_owner_contacts select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            }

			function generate_unit_detail_click(plus = 0) {
                id = makeid(10);
                $('#all_units').append(generate_unit_detail(id, plus));
                $('#all_units').append(generate_furnished_detail(id));
                setFurnishedStatus('', id);
                $("#all_units .touchspin25").each(function(index) {
                    $(this).addClass('touchspin')
                    $(this).removeClass('touchspin25')
                });
                $("#all_units .remained").each(function(index) {
                    if ($(this).is('input')) {
                        $(this).attr('id', $(this).attr('id') + id)
                        $(this).removeClass('remained')
                    }
                    if ($(this).is('label')) {
                        $(this).attr('for', $(this).attr('for') + id)
                        $(this).removeClass('remained')
                    }
                });
                enableTouchspin();
                $("#all_units select").each(function(index) {
                    $(this).select2();
                })
                setSellRentBoth();
                floatingField();
            }

			function setSellRentBoth() {
                var theFor = $('input[name=property_for]:checked').val()
                if (theFor == 'Rent') {
                    $('.the_price_rent').show()
                    $('.the_price').hide()
                } else if (theFor == 'Sell') {
                    $('.the_price_rent').hide()
                    $('.the_price').show()
                } else {
                    $('.the_price_rent').show()
                    $('.the_price').show()
                }
                $('.the_constructed_plot_price').hide()
                var theFor2 = $('input[name=property_category]:checked').attr('data-val')
                if ((theFor2 == 'Vila/Bunglow') && (theFor == 'Sell' || theFor == 'Both')) {
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Penthouse' && (theFor == 'Sell' || theFor == 'Both')) {
                    $(".price_constructed_label").each(function(i, e) {
                        $(this).html('Flat Price')
                    });
                    $(".price_plot_label").each(function(i, e) {
                        $(this).html('Terrace Price')
                    });
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Farmhouse' && (theFor == 'Sell' || theFor == 'Both')) {
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Storage/industrial' && (theFor == 'Sell' || theFor == 'Both')) {
                    $('.the_constructed_plot_price').show()
                    $('.the_price').hide()
                }
                if (theFor2 == 'Plot' || theFor2 == 'Storage/industrial') {
                    $('.the_furnished_status').hide();
                }
                if (theFor2 == 'Vila/Bunglow' || theFor2 == 'Plot' || theFor2 == 'Farmhouse') {
                    $('.the_wing').hide();
                }
            }

        addInitialTower();

        function addInitialTower(){
            let category_type = 'Office';

            resetallfields();
                setIndividualfields();
                $('#all_units').html('')
                $('#all_owner_contacts').html('')
                $('#add_area_button_container').html('')
                $(".cl-locality").hide();
                if (category_type == 'Flat') {
                    showfields = ['div_flat_type', 'div_flat_details_2', 'div_area_size_details', 'the_builtup_area', ,
                        'the_salable_area', 'div_flat_details', 'the_no_of_bathrooms',
                        'the_no_of_elavators', 'the_property_on_floors', 'the_total_units_in_tower',
                        'the_total_units_in_project', 'the_servent_room', 'the_service_elavator',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'the_total_no_of_floor',
                        'the_two_wheller_Parking', 'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8',
                        'div_care_taker', 'div_availability_status', 'the_furnished_status', 'the_1rk',
                        'div_amenities','cl-locality','terrace',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Vila/Bunglow') {
                    showfields = ['div_flat_details_2', 'div_vila_type', 'div_area_size_details',
                        'the_constructed_salable_area', 'the_salable_plot_area',
                        'div_flat_details', 'the_no_of_bathrooms', 'the_no_of_balcony',
                        'the_total_no_of_units', 'the_no_of_side_open', 'the_no_of_room', 'the_servent_room',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'div_checkboxes1',
                        'div_flat_details_7', 'div_flat_details_8', 'div_care_taker', 'div_availability_status',
                        'div_furnished_items', 'div_furnished_items_2',
                        'the_furnished_status', 'div_amenities','cl-locality',
                    ];
                    addAddAreaButtons(['the_carpet_plot_area', 'the_constructed_carpet_area',
                        'the_constructed_builtup_area'
                    ], ['Add Carpet Plot Area', 'Add Constructed Carpet Area', 'Add Constructed Builtup Area']);
                } else if (category_type == 'Plot') {
                    showfields = ['div_flat_details_2', 'div_area_size_details', 'the_salable_area',
                        'div_flat_details', 'the_total_no_of_units', 'the_no_of_side_open', 'the_length_of_plot',
                        'the_width_of_plot', 'the_no_of_floors_allowed', 'div_flat_details_5', ,
                        'div_property_source','div_property_address' ,'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8','div_extra_land_details',
                    ];
                   // $('.div_extra_land_details').show()
                    addAddAreaButtons(['the_carpet_plot_area'], ['Add Carpet Plot Area']);
                } else if (category_type == 'Penthouse') {
                    showfields = ['div_flat_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_area', 'the_terrace_salable_area', 'div_flat_details',
                        'the_no_of_bathrooms',
                        'the_no_of_elavators', 'the_property_on_floors', 'the_total_units_in_tower',
                        'the_total_units_in_project', 'the_servent_room', 'the_service_elavator',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source',
                        'the_two_wheller_Parking', 'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8',
                        'div_care_taker',
                        'div_availability_status', 'div_amenities',
                        'the_furnished_status', 'the_total_no_of_floor', 'the_no_of_balcony','cl-locality',
                    ];
                    addAddAreaButtons(['the_carpet_area', 'the_builtup_area', 'the_terrace_carpet_area'], [
                        'Add Carpet Area', 'Add Builtup Area', 'Add Terrace Carpet Area'
                    ]);
                } else if (category_type == 'Farmhouse') {
                    showfields = ['div_flat_details_2', 'div_area_size_details', , 'the_constructed_salable_area',
                        'the_salable_plot_area', 'div_flat_details', 'the_no_of_bathrooms',
                        'the_total_no_of_units', 'the_servent_room', 'div_property_address',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source',
                        'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8', 'div_care_taker',
                        'div_availability_status', 'div_amenities',
                        'the_furnished_status', 'the_no_of_balcony', 'the_no_of_room', 'the_no_of_side_open','div_extra_land_details'
                    ];
                    addAddAreaButtons(['the_constructed_carpet_area', 'the_constructed_builtup_area',
                        'the_carpet_plot_area'
                    ], ['Add Constructed Carpet Area', 'Add Constructed Builtup Area', 'Add Carpet plot Area']);
                } else if (category_type == 'Office') {
                    showfields = ['div_office_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_area', 'div_flat_details', 'the_property_on_floors',
                        'the_total_units_in_project', 'the_total_no_of_floor', 'the_total_units_in_tower',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'the_no_of_elavators',
                        'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8', 'div_care_taker',
                        'div_availability_status', 'div_office_furnished', 'the_service_elavator',
                        'div_washroom_type_2',
                        'the_furnished_status','cl-locality','the_two_wheller_Parking',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Retail') {
                    showfields = ['div_retail_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_total_units_in_project', 'the_salable_area', 'the_opening_width',
                        'the_ceilling_height', 'div_flat_details', 'the_total_no_of_floor',
                        'the_total_units_in_tower', 'div_flat_details_5', 'div_flat_details_4',
                        'div_property_source', 'the_no_of_elavators', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_care_taker', 'the_service_elavator',
                        'div_availability_status', 'div_washroom_type_2',
                        'the_furnished_status', 'the_two_wheller_Parking', 'div_extra_retail_details','cl-locality',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Storage/industrial') {
                    showfields = ['div_storage_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_plot_area', 'the_constructed_salable_area',
                        'the_centre_height', 'div_flat_details', 'div_flat_details_5', 'div_flat_details_4',
                        'div_property_source', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_other_details',
                        'div_availability_status',
                        'the_furnished_status', 'the_two_wheller_Parking', 'div_road_width','cl-locality','div_care_taker'
                    ];
                    addAddAreaButtons(['the_carpet_plot_area', 'the_constructed_carpet_area'], ['Add Carpet plot Area',
                        'Add Constructed Carpet Area'
                    ]);
                } else if (category_type == 'Land') {
                    showfields = ['div_plot_type', 'div_flat_details', 'div_flat_details_2', 'div_property_address',
                        'div_area_size_details', 'div_borewell',
                        'the_length_of_plot', 'the_width_of_plot', 'div_flat_details_5',
                        'the_no_of_floors_allowed',
                        'div_property_source', 'div_checkboxes1', 'div_construction_allowed_for', 'div_tp_details',
                        'div_flat_details_8', 'div_plot_ind_common', 'div_survey_details', 'div_road_width',
                        'div_document_section',
                    ];
                }
                for (let i = 0; i < showfields.length; i++) {
                    $('.' + showfields[i]).show();
                }
                var id = '{{ isset($current_id) ? $current_id : '' }}';

                if (id == '') {
                    generate_contact_detail_click(1)
                    generate_unit_detail_click(1);
                }
        }

		$(document).on('change', '[name="property_category"]', function(e) {
                var category_type = $(this).attr('data-val');
                resetallfields();
                setIndividualfields();
                $('#all_units').html('')
                $('#all_owner_contacts').html('')
                $('#add_area_button_container').html('')
                $(".cl-locality").hide();
                if (category_type == 'Flat') {
                    showfields = ['div_flat_type', 'div_flat_details_2', 'div_area_size_details', 'the_builtup_area', ,
                        'the_salable_area', 'div_flat_details', 'the_no_of_bathrooms',
                        'the_no_of_elavators', 'the_property_on_floors', 'the_total_units_in_tower',
                        'the_total_units_in_project', 'the_servent_room', 'the_service_elavator',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'the_total_no_of_floor',
                        'the_two_wheller_Parking', 'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8',
                        'div_care_taker', 'div_availability_status', 'the_furnished_status', 'the_1rk',
                        'div_amenities','cl-locality','terrace',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Vila/Bunglow') {
                    showfields = ['div_flat_details_2', 'div_vila_type', 'div_area_size_details',
                        'the_constructed_salable_area', 'the_salable_plot_area',
                        'div_flat_details', 'the_no_of_bathrooms', 'the_no_of_balcony',
                        'the_total_no_of_units', 'the_no_of_side_open', 'the_no_of_room', 'the_servent_room',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'div_checkboxes1',
                        'div_flat_details_7', 'div_flat_details_8', 'div_care_taker', 'div_availability_status',
                        'div_furnished_items', 'div_furnished_items_2',
                        'the_furnished_status', 'div_amenities','cl-locality',
                    ];
                    addAddAreaButtons(['the_carpet_plot_area', 'the_constructed_carpet_area',
                        'the_constructed_builtup_area'
                    ], ['Add Carpet Plot Area', 'Add Constructed Carpet Area', 'Add Constructed Builtup Area']);
                } else if (category_type == 'Plot') {
                    showfields = ['div_flat_details_2', 'div_plot_type', 'div_area_size_details', 'the_salable_area',
                        'div_flat_details', 'the_total_no_of_units', 'the_no_of_side_open', 'the_length_of_plot',
                        'the_width_of_plot', 'the_no_of_floors_allowed', 'div_flat_details_5', ,
                        'div_property_source','div_property_address' ,'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8','div_extra_land_details',
                    ];
                   // $('.div_extra_land_details').show()
                    addAddAreaButtons(['the_carpet_plot_area'], ['Add Carpet Plot Area']);
                } else if (category_type == 'Penthouse') {
                    showfields = ['div_flat_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_area', 'the_terrace_salable_area', 'div_flat_details',
                        'the_no_of_bathrooms',
                        'the_no_of_elavators', 'the_property_on_floors', 'the_total_units_in_tower',
                        'the_total_units_in_project', 'the_servent_room', 'the_service_elavator',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source',
                        'the_two_wheller_Parking', 'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8',
                        'div_care_taker',
                        'div_availability_status', 'div_amenities',
                        'the_furnished_status', 'the_total_no_of_floor', 'the_no_of_balcony','cl-locality',
                    ];
                    addAddAreaButtons(['the_carpet_area', 'the_builtup_area', 'the_terrace_carpet_area'], [
                        'Add Carpet Area', 'Add Builtup Area', 'Add Terrace Carpet Area'
                    ]);
                } else if (category_type == 'Farmhouse') {
                    showfields = ['div_flat_details_2', 'div_area_size_details', , 'the_constructed_salable_area',
                        'the_salable_plot_area', 'div_flat_details', 'the_no_of_bathrooms',
                        'the_total_no_of_units', 'the_servent_room', 'div_property_address',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source',
                        'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8', 'div_care_taker',
                        'div_availability_status', 'div_amenities',
                        'the_furnished_status', 'the_no_of_balcony', 'the_no_of_room', 'the_no_of_side_open','div_extra_land_details'
                    ];
                    addAddAreaButtons(['the_constructed_carpet_area', 'the_constructed_builtup_area',
                        'the_carpet_plot_area'
                    ], ['Add Constructed Carpet Area', 'Add Constructed Builtup Area', 'Add Carpet plot Area']);
                } else if (category_type == 'Office') {
                    showfields = ['div_office_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_area', 'div_flat_details', 'the_property_on_floors',
                        'the_total_units_in_project', 'the_total_no_of_floor', 'the_total_units_in_tower',
                        'div_flat_details_5', 'div_flat_details_4', 'div_property_source', 'the_no_of_elavators',
                        'div_checkboxes1', 'div_flat_details_7', 'div_flat_details_8', 'div_care_taker',
                        'div_availability_status', 'div_office_furnished', 'the_service_elavator',
                        'div_washroom_type_2',
                        'the_furnished_status','cl-locality','the_two_wheller_Parking',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Retail') {
                    showfields = ['div_retail_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_total_units_in_project', 'the_salable_area', 'the_opening_width',
                        'the_ceilling_height', 'div_flat_details', 'the_total_no_of_floor',
                        'the_total_units_in_tower', 'div_flat_details_5', 'div_flat_details_4',
                        'div_property_source', 'the_no_of_elavators', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_care_taker', 'the_service_elavator',
                        'div_availability_status', 'div_washroom_type_2',
                        'the_furnished_status', 'the_two_wheller_Parking', 'div_extra_retail_details','cl-locality',
                    ];
                    addAddAreaButtons(['the_carpet_area'], ['Add Carpet Area']);
                } else if (category_type == 'Storage/industrial') {
                    showfields = ['div_storage_type', 'div_flat_details_2', 'div_area_size_details',
                        'the_salable_plot_area', 'the_constructed_salable_area',
                        'the_centre_height', 'div_flat_details', 'div_flat_details_5', 'div_flat_details_4',
                        'div_property_source', 'div_checkboxes1', 'div_flat_details_7',
                        'div_flat_details_8', 'div_other_details',
                        'div_availability_status',
                        'the_furnished_status', 'the_two_wheller_Parking', 'div_road_width','cl-locality','div_care_taker'
                    ];
                    addAddAreaButtons(['the_carpet_plot_area', 'the_constructed_carpet_area'], ['Add Carpet plot Area',
                        'Add Constructed Carpet Area'
                    ]);
                } else if (category_type == 'Land') {
                    showfields = ['div_plot_type', 'div_flat_details', 'div_flat_details_2', 'div_property_address',
                        'div_area_size_details', 'div_borewell',
                        'the_length_of_plot', 'the_width_of_plot', 'div_flat_details_5',
                        'the_no_of_floors_allowed',
                        'div_property_source', 'div_checkboxes1', 'div_construction_allowed_for', 'div_tp_details',
                        'div_flat_details_8', 'div_plot_ind_common', 'div_survey_details', 'div_road_width',
                        'div_document_section',
                    ];
                }
                for (let i = 0; i < showfields.length; i++) {
                    $('.' + showfields[i]).show();
                }
                var id = '{{ isset($current_id) ? $current_id : '' }}';

                if (id == '') {
                    generate_contact_detail_click(1)
                    generate_unit_detail_click(1);
                }
            })

	</script>
@endpush
