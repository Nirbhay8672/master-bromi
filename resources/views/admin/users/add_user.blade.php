    @extends('admin.layouts.app')
    @section('content')
        @php
            $is_dynamic_form = true;
        @endphp
        <div class="page-body">
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
                                <h5 class="mb-3">User <a  
                                    class="btn custom-icon-theme-button tooltip-btn"
                                    href="{{ route('admin.users') }}"
                                    data-tooltip="Back"
                                    style="float: inline-end;"
                                >
                                    <i class="fa fa-backward"></i>
                                </a></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-2">
                                        <div class="bromi-form-wizard stepwizard">
                                            <div class="stepwizard-row setup-panel">
                                                <div class="stepwizard-step mb-5" style="text-align:initial"><a
                                                        class="btn btn-primary" href="#user-info">1</a>
                                                    <p class="ms-2">Employee Information</p>
                                                </div>
                                                <div class="stepwizard-step" style="text-align:initial"><a class="btn btn-light"
                                                        href="#employee-info">2</a>
                                                    <p class="ms-2">Other Details</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-lg-10 border-start ps-4">
                                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                                            novalidate="">
                                            <input type="hidden" name="this_data_id" id="this_data_id">
                                            <div class="setup-content" id="user-info">
                                                <div class="col-xs-12">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="mb-2"> 
                                                                <label><b>Employee Information</b></label>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <div>
                                                                    <label for="First Name">First Name</label>
                                                                    <input class="form-control" name="first_name" id="first_name"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <span id="first_name_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <div>   
                                                                    <label for="Middle Name">Middle Name</label>
                                                                    <input class="form-control" name="middle_name" id="middle_name"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <span id="middle_name_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <div>
                                                                    <label for="Last Name">Last Name</label>
                                                                    <input class="form-control" name="last_name" id="last_name"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <span id="last_name_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4 m-b-4 mb-3">
                                                                <div>
                                                                    <label for="Birth Date">Birth Date</label>
                                                                    <input class="form-control" style="border: 1px solid black;border-radius:5px;" name="birth_date" id="birth_date" type="date" data-language="en">
                                                                </div>
                                                                <span id="birth_date_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-4 mb-3">
                                                                <div>
                                                                    <label for="Hire Date">Hire Date</label>
                                                                    <input class="form-control" style="border: 1px solid black;border-radius:5px;" id="hire_date" name="hire_date" type="date" data-language="en">
                                                                </div>
                                                                <span id="hire_date_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="form-group col-md-3 m-b-4">
                                                                <select class="form-select" id="status">
                                                                    <option value="">Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">In Active</option>
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                                                <input class="form-check-input" id="working" type="checkbox">
                                                                <label class="form-check-label" for="working">Currently
                                                                    Working</label>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="form-group col-md-3 m-b-20 mb-3">
                                                                <label><b>Property Access</b></label>
                                                                <select class="form-select" id="property_for_id">
                                                                    <option value="" disabled>Property For</option>
                                                                    <option value="Rent">Rent</option>
                                                                    <option value="Sell">Sell</option>
                                                                    <option value="Both">All</option>
                                                                </select>
                                                                <span id="property_for_id_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                            <div class="form-group col-md-3 m-b-20 mb-3">
                                                                <label><b>Property Type</b></label>
                                                                <select class="form-select" id="property_type_id" onchange="setCategory()" multiple>
                                                                    <option
                                                                        data-parent_id="null"
                                                                        value="85"
                                                                    >Commercial</option>
                                                                    <option
                                                                        data-parent_id="null"
                                                                        value="87"
                                                                    >Residential</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20 mb-3">
                                                                <label><b>Specific Type</b></label>
                                                                <select class="form-select" id="specific_properties"
                                                                    multiple="multiple">
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20 mb-3">
                                                                <label><b>Project Access</b></label>
                                                                <select class="form-select" id="buildings"
                                                                    multiple="multiple">
                                                                    @foreach ($projects as $project)
                                                                        <option value="{{ $project->id }}">
                                                                            {{ $project->project_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20 mb-3 mt-3">
                                                                <label><b>Enquiry For</b></label>
                                                                <select class="form-select" id="enquiry_for_id">
                                                                    <option value="">Enquiry For</option>
                                                                    <option value="Rent">Rent</option>
                                                                    <option value="Buy">Buy</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20 mb-3 mt-3">
                                                                <label><b>Enquiry Access</b></label>
                                                                <select class="form-select" id="enquiry_permission">
                                                                    <option value="">Enquiries Access</option>
                                                                    <option value="all">All Enquiries</option>
                                                                    <option value="only_assigned">Only Assigned</option>
                                                                </select>
                                                                <span id="enquiry_permission_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20 mb-3 mt-3">
                                                                <label><b>Enquiry Type</b></label>
                                                                <select class="form-select" id="enquiry_type_id" onchange="setEnCategory()" multiple>
                                                                    <option
                                                                        data-parent_id="null"
                                                                        value="85"
                                                                    >Commercial</option>
                                                                    <option
                                                                        data-parent_id="null"
                                                                        value="87"
                                                                    >Residential</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20 mb-3 mt-3">
                                                                <label><b>Specific Enquiry Type</b></label>
                                                                    <select class="form-select" id="specific_enquiry"
                                                                        multiple="multiple">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <button
                                                            class="btn custom-theme-button nextBtn pull-right"
                                                            type="button"
                                                        >Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="setup-content" id="employee-info">
                                                <div class="col-xs-12">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div>
                                                                <label><b>Employee Address</b></label>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <div>
                                                                    <label for="Address">Address</label>
                                                                    <input class="form-control" name="address" id="address"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <span id="address_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div class="form-group col-md-4 m-b-4">
                                                                <select class="form-select" id="state_id">
                                                                    <option value="" disabled selected>Select State</option>
                                                                    @foreach ($states as $state)
                                                                        <option value="{{ $state->id }}">{{ $state->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <span id="state_id_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div class="form-group col-md-4 m-b-4">
                                                                <select class="form-select" id="city_id">
                                                                    <option value=""> City</option>
                                                                    @foreach ($cities as $city)
                                                                        <option value="{{ $city->id }}">
                                                                            {{ $city->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span id="city_id_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div class="form-group col-md-4 m-b-20">
                                                                <div>
                                                                    <label for="Pincode">Pincode</label>
                                                                    <input class="form-control" name="pincode" id="pincode"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <span id="pincode_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div>
                                                                <label><b>Employee Contact</b></label>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20">
                                                                <div>
                                                                    <label for="Mobile Number">Mobile Number</label>
                                                                    <input class="form-control" name="mobile_number"
                                                                        id="mobile_number" type="text" autocomplete="off">
                                                                </div>
                                                                <span id="mobile_number_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20">
                                                                <label for="Office No">Employee No.</label>
                                                                <input class="form-control" name="office_no" id="office_no"
                                                                    type="text" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md-2 m-b-20">
                                                                <label for="Home Phone No">Home Phone No</label>
                                                                <input class="form-control" name="home_phone_no"
                                                                    id="home_phone_no" type="text" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <div>
                                                                    <label for="Email">Email</label>
                                                                    <input class="form-control" name="email" id="email"
                                                                        type="text" autocomplete="off" style="text-transform: none;">
                                                                </div>
                                                                <span id="email_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div>
                                                                <label><b>Employee ID</b></label>
                                                            </div>

                                                            <div class="form-group col-md-2 m-b-20">
                                                                <select
                                                                    name="id_type"
                                                                    id="id_type"
                                                                    class="form-control"
                                                                >
                                                                <option value="">Select Id Type</option>
                                                                <option value="aadhaar_card">Aadhaar Card</option>
                                                                <option value="election_card">Election Card</option>
                                                                <option value="driving_license">Driving License</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4 m-b-20">
                                                                <input
                                                                    class="form-control"
                                                                    name="file"
                                                                    id="id_type_file"
                                                                    type="file"
                                                                    accept=".png,.jpg,.jpeg,.pdf"
                                                                    style="border: 2px solid black;border-radius:5px;"
                                                                >
                                                            </div>
                                                            
                                                            <div>
                                                                <label><b>Employee Position and Branch Access</b></label>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20">
                                                                <select class="form-select" id="position">
                                                                    <option value="">Position</option>
                                                                    <option value="Branch Manager">Branch Manager</option>
                                                                    <option value="Executive">Executive</option>
                                                                    <option value="Owner">Owner</option>
                                                                    <option value="Team Lead">Team Lead</option>
                                                                    <option value="vertical Head">vertical Head</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <label class="select2_label" for="Select Branch">
                                                                    Branch</label>
                                                                <select class="form-select" id="branch_id" multiple>
                                                                    @foreach ($branches as $branch)
                                                                        <option value="{{ $branch->id }}">
                                                                            {{ $branch->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4 m-b-20">
                                                                <label class="select2_label"
                                                                    for="Reporting to person">Reporting to person</label>
                                                                    <select class="form-select" id="reporting_to" multiple>
                                                                    @foreach ($employees as $employee)
                                                                        <option value="{{ $employee->id }}">
                                                                            {{ $employee->first_name . ' ' . $employee->last_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label><b>Employee Login Info</b></label>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20">
                                                                <div>
                                                                    <label for="Password">Password</label>
                                                                    <input class="form-control" name="password" id="password"
                                                                        type="text" autocomplete="off">
                                                                </div>
                                                                <span id="password_error" class="text-danger invalid-error d-none"></span>
                                                            </div>

                                                            <div class="form-group col-md-3 m-b-20">
                                                                <select class="form-select" id="role_id">
                                                                    <option value=""> Role</option>
                                                                    @foreach ($roles as $role)
                                                                        <option
                                                                            value="{{ $role->id }}">
                                                                            {{ explode('_---_', $role->name)[0] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span id="role_id_error" class="text-danger invalid-error d-none"></span>
                                                            </div>
                                                        </div>
                                                        <button
                                                            class="btn custom-theme-button nextBtn pull-right"
                                                            type="button"
                                                            id="saveUser"
                                                        >Finish</button>
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
            </div>
            @php
            $city_encoded = json_encode($cities);
            $state_encoded = json_encode($states);
            @endphp
        @endsection
        @push('scripts')
            <script src="{{ asset('admins/assets/js/form-wizard/form-wizard-two.js') }}"></script>
            <script>

                function setCategory() {
                    let property_types = $('#property_type_id').val();

                    let category_option = document.getElementById('specific_properties');
                    category_option.innerHTML = "";

                    if(property_types.includes('87')) {
                        category_option.innerHTML += '<option data-parent_id="87" value="254">Flat</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="255">Vila/Bunglow</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="256">Plot</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="257">Penthouse</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="258">Farmhouse</option>';
                    }

                    if(property_types.includes('85')) {
                        category_option.innerHTML += '<option data-parent_id="87" value="259">Office</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="260">Retail</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="261">Storage/industrial</option>';
                        category_option.innerHTML += '<option data-parent_id="87" value="262">Land</option>';
                    }
                }


                function setEnCategory() {
                    let enquiry_types = $('#enquiry_type_id').val();

                    let en_category_option = document.getElementById('specific_enquiry');
                    en_category_option.innerHTML = "";

                    if(enquiry_types.includes('87')) {
                        en_category_option.innerHTML += '<option data-parent_id="87" value="254">Flat</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="255">Vila/Bunglow</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="256">Plot</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="257">Penthouse</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="258">Farmhouse</option>';
                    }

                    if(enquiry_types.includes('85')) {
                        en_category_option.innerHTML += '<option data-parent_id="87" value="259">Office</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="260">Retail</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="261">Storage/industrial</option>';
                        en_category_option.innerHTML += '<option data-parent_id="87" value="262">Land</option>';
                    }
                }

                var shouldchangecity = 1;

                var cities = @Json($city_encoded);
                var states = @Json($state_encoded);

                document.getElementById('city_id').disabled = true;

                $(document).on('change', '#state_id', function(e) {
                    $('#city_id').select2('destroy');
                    citiesar = JSON.parse(cities);
                    $('#city_id').html('');
                    $('#city_id').append('<option value="" disabled selected>Select City</option>');
                    for (let i = 0; i < citiesar.length; i++) {
                        document.getElementById('city_id').disabled = false;
                        if (citiesar[i]['state_id'] == $("#state_id").val()) {
                            $('#city_id').append('<option value="'+citiesar[i]['id']+'">'+citiesar[i]['name']+'</option>')
                        }
                    }
                    $('#city_id').select2();
                });

                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var go_data_id = urlParams.get('data_id')
                var current_user_id = '{{ Auth::user()->id }}';


                function getUser(data) {
                    shouldchangecity = 0;
                    $('#modal_form').trigger("reset");
                    var id = '{{(isset($current_id)?$current_id:'')}}';
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.getUser') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data == '') {

                                let first_state = @json($first_state);
                                let first_city = @json($first_city);

                                $('#state_id').val(first_state.id).trigger('change');
                                $('#city_id').val(first_city.id).trigger('change');

                                return
                            }
                            dataa = JSON.parse(data).data;
                            role = JSON.parse(data).role;
                            if (current_user_id == dataa.id) {
                                $('#role_id').prop('disabled', true)
                            } else {
                                $('#role_id').prop('disabled', false)
                            }
                            $('#this_data_id').val(dataa.id)
                            $('#first_name').val(dataa.first_name)
                            $('#middle_name').val(dataa.middle_name)
                            $('#last_name').val(dataa.last_name)
                            $('#birth_date').val(dataa.birth_date)
                            $('#hire_date').val(dataa.hire_date)
                            $('#status').val(dataa.status).trigger('change');
                            $('#address').val(dataa.address)
                            $('#pincode').val(dataa.pincode)
                            $('#state_id').val(dataa.state_id).trigger('change');
                            $('#city_id').val(dataa.city_id).trigger('change');
                            $('#mobile_number').val(dataa.mobile_number);
                            $('#office_no').val(dataa.office_no);
                            $('#email').val(dataa.email);
                            $('#home_phone_no').val(dataa.home_number);
                            $('#office_no').val(dataa.office_number);
                            $('#id_type').val(dataa.id_type).trigger('change');


                            $('#position').val(dataa.position).trigger('change');
                            $('#property_for_id').val(dataa.property_for_id).trigger('change');
                            $('#enquiry_for_id').val(dataa.enquiry_for_id).trigger('change');
                            $('#working').prop('checked', Number(dataa.working));
                            shouldchangecity = 1;
                            $('#specific_properties').val([]).trigger('change');
                            $('#specific_enquiry').val([]).trigger('change');
                            $('#buildings').val([]).trigger('change');
                            $('#enquiry_permission').val([]).trigger('change');
                            $('#branch_id').val([]).trigger('change');
                            $('#reporting_to').val([]).trigger('change');
                            $('#property_type_id').val([]).trigger('change');
                            $('#enquiry_type_id').val([]).trigger('change');
                            $('#role_id').val(dataa.role_id).trigger('change');
                            
                            try {
                                $('#property_type_id').val(JSON.parse(dataa.property_type_id)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#enquiry_type_id').val(JSON.parse(dataa.enquiry_type)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#specific_properties').val(JSON.parse(dataa.specific_properties)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#specific_enquiry').val(JSON.parse(dataa.specific_enquiry)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#buildings').val(JSON.parse(dataa.buildings)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#branch_id').val(JSON.parse(dataa.branch_id)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#reporting_to').val(JSON.parse(dataa.reporting_to)).trigger('change');
                            } catch (error) {
                                //
                            }
                            try {
                                $('#enquiry_permission').val(dataa.enquiry_permission).trigger('change');
                            } catch (error) {
                                //
                            }
                            triggerChangeinput()
                        }
                    });
                }

                let errors_array = [];

                function validate() {
                    
                    Object.entries(errors_array).forEach(error => {
                        let error_element = document.getElementById(`${error[0]}_error`);

                        if(error_element) {
                            error_element.classList.remove('d-none');
                            error_element.innerText = error[1][0];
                        }
                    });
                }

                getUser();

                $(document).ready(function() {

                    $(document).on('click', '#saveUser', function(e) {

                        let all_error = document.querySelectorAll('.invalid-error');

                        all_error.forEach(element => {
                            element.classList.add('d-none');
                        });

                        var id = $('#this_data_id').val();

                        let form_data = new FormData();

                        form_data.set('id', id);
                        form_data.set('first_name', $('#first_name').val());
                        form_data.set('middle_name', $('#middle_name').val());
                        form_data.set('last_name', $('#last_name').val());
                        form_data.set('birth_date', $('#birth_date').val());
                        form_data.set('hire_date', $('#hire_date').val());
                        form_data.set('status', $('#status').val());
                        form_data.set('address', $('#address').val());
                        form_data.set('pincode', $('#pincode').val());
                        form_data.set('city_id', $('#city_id').val() ?? '');
                        form_data.set('state_id', $('#state_id').val() ?? '');
                        form_data.set('mobile_number', $('#mobile_number').val());
                        form_data.set('office_no', $('#office_no').val());
                        form_data.set('email', $('#email').val());
                        form_data.set('home_phone_no', $('#home_phone_no').val());
                        form_data.set('position', $('#position').val());
                        form_data.set('branch_id', JSON.stringify($('#branch_id').val()));
                        form_data.set('reporting_to', JSON.stringify($('#reporting_to').val()));
                        form_data.set('password', $('#password').val());
                        form_data.set('role_id', $('#role_id').val() ?? '');
                        form_data.set('property_for_id', $('#property_for_id').val());
                        form_data.set('enquiry_for_id', $('#enquiry_for_id').val());
                        form_data.set('property_type_id', JSON.stringify($('#property_type_id').val()));
                        form_data.set('enquiry_type_id', JSON.stringify($('#enquiry_type_id').val()));
                        form_data.set('specific_properties', JSON.stringify($('#specific_properties').val()));
                        form_data.set('specific_enquiry', JSON.stringify($('#specific_enquiry').val()));
                        form_data.set('buildings', JSON.stringify($('#buildings').val()));
                        form_data.set('enquiry_permission', $('#enquiry_permission').val());
                        form_data.set('working', Number($('#working').prop('checked')));

                        form_data.set('id_type', $('#id_type').val());
                        let id_type_file = document.getElementById('id_type_file');

                        if(id_type_file && id_type_file.files.length > 0)
                        {
                            let file = id_type_file.files[0];
                            form_data.set('id_type_file', file, file.name);
                        }

                        let url =  "{{ route('admin.saveUser') }}";

                        axios.post(url, form_data, {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then((res) => {
                            var redirect_url = "{{route('admin.users')}}";
                            window.location.href = redirect_url;
                        })
                        .catch((err) => {
                            if(err.response.status == 422) {
                                errors_array = err.response.data.errors;
                                validate();
                            }
                        });
                    })

                });
            </script>
        @endpush
