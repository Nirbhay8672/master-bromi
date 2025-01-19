@extends('superadmin.layouts.superapp')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <style>
            .card .card-body {
                border-radius: 15px;
            }
            .pt span, strong {
                font-size: 15px;
                margin: 5px 0;
            }
            .card-title {
                padding: 10px;
            }
            .card {
                margin-top: 20px;
            }   
        </style>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Leads </h5>
                            <button
                                class="btn custom-icon-theme-button tooltip-btn"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#leadModal"
                                data-tooltip="Add Lead"
                                onclick="resetData()"
                            ><i class="fa fa-plus"></i></button>
                            <button class="btn text-white delete_table_row ms-3 tooltip-btn"
                                    style="border-radius: 5px;display: none;background-color:red" onclick="deleteTableRow()"
                                    type="button" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="display" id="leadTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox"
                                                        name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Interested Plan</th>
                                            <th>Added By</th>
                                            <th>FollowUp & Remark</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="progressModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Lead Status</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="d-none" name="this_progress_data_id" id="this_progress_data_id">
                    <p class="border-top"></p>
                    <div class="row mb-1">
                        <div class="form-group col-md-4 m-b-20">
                            <div class="fname">
                                <select name="" id="status" class="form-select" style="border:1px solid black;border-radius:5px;">
                                    <option value="">Lead Progress </option>
                                    <option value="New Lead">New Lead</option>
                                    <option value="Lead Confirmed"> Lead Confirmed</option>
                                    <option value="Discussion"> Discussion</option>
                                    <option value="Demo Scheduled"> Demo Scheduled</option>
                                    <option value="Demo Completed"> Demo Completed</option>
                                    <option value="Due Followup"> Due Followup</option>
                                    <option value="Booked"> Booked</option>
                                    <option value="Lost"> Lost</option>
                                </select>
                                <span class="text-danger invalid-error d-none" id="status_error">Status is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 m-b-20">
                            {{-- <div class="col-12"> --}}
                                <div class="m-checkbox-inline custom-radio-ml d-flex">
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input class="form-check-input" id="progress_lead_type_1" type="radio" name="lead_type" value="Hot Lead" checked>
                                        <label class="form-check-label mb-0" for="progress_lead_type_1">Hot Lead</label>
                                    </div>
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input class="form-check-input" type="radio" id="progress_lead_type_2" name="lead_type" value="Warm Lead">
                                        <label class="form-check-label mb-0" for="progress_lead_type_2"> Warm Lead</label>
                                    </div>
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input class="form-check-input" id="progress_lead_type_3" type="radio" name="lead_type" value="Cold Lead">
                                        <label class="form-check-label mb-0" for="progress_lead_type_3">Cold Lead</label>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                    {{-- </div>
                    <div class="row"> --}}
                        <div class="form-group col-md-4 m-b-20">
                            <div class="fname">
                                <input value="{{date('Y-m-d')}}" class="form-control" name="followup_date" id="followup_date" type="date" autocomplete="off">
                                <span class="text-danger invalid-error d-none" id="followup_date_error">Follow up date is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 m-b-20">
                            <div class="fname">
                                <input value="{{date('H:i')}}" class="form-control" name="time" id="time" type="time" autocomplete="off">
                                <span class="text-danger invalid-error d-none" id="time_error">Time is required.</span>
                            </div>
                        </div>
                        <div class="form-group m-b-20">
                            <div class="fname">
                                <textarea name="progress_enquiry" class="form-control" id="progress_enquiry" cols="10" rows="5" placeholder="Enquiry"></textarea>
                                <span class="text-danger invalid-error d-none" id="progress_enquiry_error">Enquiry is required.</span>
                            </div>
                        </div>

                        <div class="text-center mt-3">  
                            <button class="btn custom-theme-button" type="button" onclick="saveProgress()">Save</button>
                            <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showprogressmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Progress</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-secondary" id="addProgressButton" data-id=""
                        onclick="updateStatusForm(this)">Add</button>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title bg-primary rounded">Lead Details</h4>
                            <div class="d-flex justify-content-between">
                                <div class="pt">
                                    <div class=""><strong>Name:</strong> <span id="nameRead"></span></div>
                                    <div class=""><strong>Company:</strong> <span id="companyRead"></span></div>
                                    <div class=""><strong>Phone:</strong> <span id="mobileRead"></span></div>
                                </div>
                                <div class="pt">
                                    <div class=""><strong>Email:</strong> <span id="emailRead"></span></div>
                                    <div class=""><strong>Plan:</strong> <span id="planRead"></span></div>
                                    <div class=""><strong>State:</strong> <span id="stateRead"></span></div>
                                </div>
                                <div class="pt">
                                    <div class=""><strong>City:</strong><span id="cityRead"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table custom-table-design mt-2">
                        <thead>
                            <tr>
                                <th scope="col">Added On</th>
                                <th scope="col">Lead Progress</th>
                                <th scope="col">NFD</th>
                                <th scope="col">Remarks </th>
                                <th scope="col">Type of Lead</th>
                                <th scope="col">Added By</th>
                            </tr>
                        </thead>
                        <tbody class="progress_data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assignLeadModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Lead</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <input type="hidden" name="lead_id" id="lead_id">
                        <div class="row mt-2">
                            <div class="form-group m-b-20 col-md-4">
                                <div class="fname">
                                    <select name="memeber" id="member_id">
                                        <option value="">-- Select Member --</option>
                                        @foreach($members as $member)
                                            <option value="{{$member->id}}">{{ $member->first_name }} {{ $member->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid-error d-none mt-2" id="member_error">Member is required.</span>
                                    <span class="text-danger invalid-error d-none mt-2" id="member_exist_error">This lead already assign to this member.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3">
                            <div class="col">
                                <button class="btn custom-theme-button" type="button" id="assignLead" onclick="assignLeadToMember()">Assign</button>
                            </div>
                        </div>
                    </form>
                   
                    <table class="table custom-table-design mt-2">
                        <thead>
                            <tr>
                                <th scope="col">Assign To</th>
                                <th scope="col">Assign At</th>
                            </tr>
                        </thead>
                        <tbody class="assign_history_table" id="assign_history_table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div hidden>
        <div id="mypopover-content">
            <div class="custom-tooltip-content">
                <div class="d-block w-100 blue-inq"><i class="fa fa-square"></i> New Lead</div>
                <div class="d-block w-100 org-inq"><i class="fa fa-square"></i> Lead Confirmed</div>
                <div class="d-block w-100 purple-inq"><i class="fa fa-square"></i> Demo Scheduled</div>
                <div class="d-block w-100 yellow-inq"><i class="fa fa-square"></i> Demo Completed</div>
                <div class="d-block w-100 red-inq"><i class="fa fa-square"></i> Due Followup</div>
                <div class="d-block w-100 lblue-inq"><i class="fa fa-square"></i> Discussion</div>
                <div class="d-block w-100 green-inq"><i class="fa fa-square"></i> Booked</div>
                <div class="d-block w-100 pink-inq"><i class="fa fa-square"></i> Lost</div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="leadModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lead Add / Edit</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                        <div class="row">
                            <div class="form-group col-md-4 m-b-20 d-none">
                                <div class="fname">
                                    <input type="text" name="this_data_id" id="this_data_id">
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <label for="first_name">Name</label>
                                    <input class="form-control" name="user_name" id="first_name" type="text" autocomplete="off">
                                </div>
                                <span class="text-danger invalid-error d-none" id="first_name_error">First name is required.</span>

                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <label for="company">Company Name</label>
                                    <input class="form-control" name="company" id="company" type="text"
                                        autocomplete="off">
                                </div>
                                <span class="text-danger invalid-error d-none" id="company_error">Company is required.</span>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                <label for="mobile">Mobile Number</label>
                                    <input class="form-control" name="mobile" id="mobile" type="text" autocomplete="off">
                                </div>
                                <span class="text-danger invalid-error d-none" id="mobile_error">Phone Number is required.</span>
                                <span class="text-danger invalid-error d-none" id="mobile_length_error">Phone Number is invalid.</span>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" id="email"
                                        style="text-transform: none !important;" type="text" autocomplete="off">
                                </div>
                                <span class="text-danger invalid-error d-none" id="email_error">Email is required.</span>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <select name="plan_interested_in" id="plan_interested_in" class="form-control">
                                        <option value="">Plan interested</option>
                                        @foreach($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }} - {{ $plan->price }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid-error d-none" id="plan_interested_in_error">Plan interested in is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <select name="state" id="state" onchange="setCities()">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger invalid-error d-none" id="state_error">Lead Type is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <select name="city" id="city">
                                        <option value="">Select City</option>
                                    </select>
                                    <span class="invalid-error d-none text-danger" id="city_error">City is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <label for="locality">Locality</label>
                                    <select class="form-select" id="area_id" name="locality" data-error="#locality_id_error">
                                        <option value="">Select Locality</option>
                                        {{-- @foreach ($areas as $area)
                                            <option data-city_id="{{ $area->city_id }}" data-state_id="{{ $area->state_id }}"
                                                value="{{ $area->id }}">{{ $area->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <span class="invalid-error d-none text-danger" id="locality_error">This field is required.</span>
                            </div>
                            
                            <div class="form-group m-b-20">
                                <div class="fname">
                                    <textarea name="enquiry" class="form-control" id="enquiry" cols="10" rows="5" placeholder="Remark"></textarea>
                                    <span class="text-danger invalid-error d-none" id="enquiry_error">Enquiry is required.</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button class="btn custom-theme-button" type="button" id="saveLead">Save</button>
                            <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @php
        $states_encoded = json_encode($states);
    @endphp
@endsection
@push('scripts')
    <script>

        function showAssignForm(data) {
            $('#member_id').val('').trigger('change');
            $('#lead_id').val($(data).attr('data-id'));
            
            let all_error = document.querySelectorAll('.invalid-error');

            all_error.forEach(element => {
                element.classList.add('d-none');
            });

            let lead_history_table = document.getElementById('assign_history_table');

            lead_history_table.innerHTML = '';

            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.getLeadHistory') }}",
                data: {
                    id : $('#lead_id').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(res_data) {
                    res_data.forEach(history => {
                        lead_history_table.innerHTML += `<tr>
                            <td>${history.member_name}</td>
                            <td>${history.assign_date}</td>
                        </tr>`;
                    });
                },
                error:function(error) {
                    console.log(error);
                }
            });

            $('#assignLeadModal').modal('show');
        }

        function assignLeadToMember() {

            let all_error = document.querySelectorAll('.invalid-error');

            all_error.forEach(element => {
                element.classList.add('d-none');
            });
            
            let valid = true;

            if($('#member_id').val() == '') {
                document.getElementById('member_error').classList.remove('d-none');
                valid = false;
            }

            if(valid) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.assignLead') }}",
                    data: {
                        id : $('#lead_id').val(),
                        member_id : $('#member_id').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#leadTable').DataTable().draw();
                        $('#assignLeadModal').modal('hide');
                    },
                    error:function(error) {
                        document.getElementById('member_exist_error').classList.remove('d-none');
                    }
                });
            }
        }
     
        let states = @Json($states_encoded);
        function setCities() {
            let state_id = $('#state').val();
            $('#city').val('');
            let city_element = document.getElementById('city');
            city_element.innerHTML = '';

            let all_states = JSON.parse(states);

            city_element.innerHTML += `<option value="">Select City</option>`;

            if(state_id) {
                let state_object = all_states.find((state_obj) => state_obj.id == state_id);
                
                state_object.cities.forEach(city => {
                    city_element.innerHTML += `<option value="${city['id']}">${city['name']}</option>`;
                });
            }
        }

        $('#city').on('change', function() {
            let id = $(this).val();
            var locality_element = document.getElementById('area_id');
            locality_element.innerHTML = '';
            locality_element.innerHTML += `<option value="">Select Locality</option>`;
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.superArea') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: (data) => {
                    data.forEach(locali => {
                        locality_element.innerHTML += `<option value="${locali['id']}">${locali['name']}</option>`;
                    });
                    let choosen = localStorage.getItem("locality");
                    console.log(choosen);
                    $('#area_id').val(choosen).trigger('change');
                },
                error: error => console.log(error)
            });
        });
        
        $(document).ready(function() {
            $('#leadTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.adminEnquiries') }}",
                columns: [
                    {
                        data: 'select_checkbox',
                        name: 'select_checkbox',
                        orderable: false
                    },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'company', name: 'company' },
                    { data: 'state', name: 'state' },
                    { data: 'city', name: 'city' },
                    { data: 'plan', name: 'plan' },
                    { data: 'added_by', name: 'added_by' },
                    { data: 'followup_date', name: 'followup_date' },
                    // { data: 'status', name: 'status' },
                    { data: 'Actions', name: 'Actions' },
                ],
                columnDefs: [
                    { targets: 1, width: '150px' },
                ],
                "drawCallback": function(settings, json) {
                        $('.color-code-popover').attr('data-bs-content', $('#mypopover-content').html());
                        setTimeout(() => {
                            $('.color-code-popover').popover({
                                html: true,
                            });
                        }, 500);
                        var popoverTriggerList = [].slice.call(document.querySelectorAll(
                            '[data-bs-toggle="popover"]'))
                        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                            return new bootstrap.Popover(popoverTriggerEl)
                        });
                    }
            });
        });

        function resetData() {
            $('.invalid-error').addClass('d-none');
            $('#modal_form').trigger("reset");
            $('#state').val('').trigger('change');
            $('#city').val('').trigger('change');
            $('#exampleModalLabel').text('ADD NEW LEAD');

            let all_error = document.querySelectorAll('.invalid-error');

            all_error.forEach(element => {
                element.classList.add('d-none');
            });

            $('#first_name').val('').trigger('change');
            $('#last_name').val('').trigger('change');
            $('#mobile').val('').trigger('change');
            $('#email').val('').trigger('change');
            $('#company').val('').trigger('change');
            $('#lead_type').val('').trigger('change');
            $('#plan_interested_in').val('').trigger('change');
            $('#enquiry').val('').trigger('change');
        }

        function getBromiEnq(data) {
            $('#modal_form').trigger("reset");
            resetData();
            $('#exampleModalLabel').text('Edit LEAD');
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.showEnquiry') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    localStorage.setItem("locality", data.brom_enq.locality);
                    $('#first_name').val(data.brom_enq.user_name).trigger('change');
                    $('#last_name').val(data.brom_enq.last_name).trigger('change');
                    $('#mobile').val(data.brom_enq.mobile).trigger('change');
                    $('#email').val(data.brom_enq.email).trigger('change');
                    $('#company').val(data.brom_enq.company).trigger('change');
                    $('#lead_type').val(data.brom_enq.lead_type).trigger('change');
                    $('#state').val(data.brom_enq.state_id).trigger('change');
                    $('#city').val(data.brom_enq.city_id).trigger('change');
                    $('#plan_interested_in').val(data.brom_enq.plan_interested_in).trigger('change');
                    $('#enquiry').val(data.brom_enq.enquiry).trigger('change');
                    $('#this_data_id').val(data.brom_enq.id);
                    $('#leadModal').modal('show');
                    $('#saveEnq').addClass('d-none');
                }
            });
        }

        function updateStatusForm(data) {
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.showEnquiry') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.brom_enq.lead_progress.length > 0) {
                        $('#followup_date').val(data.brom_enq.lead_progress[0].next_follow_up_date);
                        $('#time').val(data.brom_enq.lead_progress[0].next_follow_up_time);
                        $('[value="'+data.brom_enq.lead_progress[0].lead_type+'"]').prop('checked', true);
                        console.log(data.brom_enq.lead_progress[0]);
                    }
                    $('#progress_enquiry').val(data.brom_enq.enquiry);
                    $('#this_progress_data_id').val(data.brom_enq.id);
                    $('#status').val(data.brom_enq.status).trigger('change');
                    $('#showprogressmodal').modal('hide');
                    $('#progressModal').modal('show');
                }
            });
        }
        function showProgress(data) {
                $('.progress_data').html('')
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.getProgress') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        console.log('lead: ', data[0].lead);

                        // ---------------- display statically data -------
                        if (data.length > 0) {
                            $('#nameRead').text(data[0].lead.user_name)
                            $('#companyRead').text(data[0].lead.company)
                            $('#mobileRead').text(data[0].lead.mobile)
                            $('#emailRead').text(data[0].lead.email)
                            $('#planRead').text(data[0].lead.plan_interested.name)
                            $('#stateRead').text(data[0].lead.state.name)
                            $('#cityRead').text(data[0].lead.city.name)
                        }
                        // ---------------- display statically data -------
                        
                        for (let i = 0; i < data.length; i++) {
                            var str = '<tr>';
                            str += '   <td>' + data[i]['created_at'] + '</td>';
                            if (data[i]['progress'] !== null) {
                                str += '   <td>' + data[i]['progress'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['nfd'] !== null) {
                                str += '   <td>' + data[i]['nfd'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['remarks'] !== null) {
                                str += '   <td>' + data[i]['remarks'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['lead_type'] !== null) {
                                str += '   <td>' + data[i]['lead_type'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (CheckIfarraykeyExists(data, i, 'user', 'first_name')) {
                                str += '   <td>' + data[i]['user']['first_name'] + ' ' + data[i]['user'][
                                        'last_name'
                                    ] +
                                    '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            str += '</tr>';
                            $('.progress_data').append(str.replace('null', ''))
                        }
                    }
                });
                $('#addProgressButton').attr('data-id', id);
                $('#showprogressmodal').modal('show');
            }

            function CheckIfarraykeyExists(data, i, key1, key2) {
                try {
                    tmpvar = data[i][key1][key2]
                    return 1
                } catch (error) {
                    return 0
                }
            }

        function saveProgress(){
            let all_error = document.querySelectorAll('.invalid-error');

            all_error.forEach(element => {
                element.classList.add('d-none');
            });

            let valid = true;

            if($('#status').val() == '') {
                document.getElementById('status_error').classList.remove('d-none');
                valid = false;
            }

            if($('#followup_date').val() == '') {
                document.getElementById('followup_date_error').classList.remove('d-none');
                valid = false;
            }

            if($('#time').val() == '') {
                document.getElementById('time_error').classList.remove('d-none');
                valid = false;
            }

            if($('#progress_enquiry').val() == '') {
                document.getElementById('progress_enquiry_error').classList.remove('d-none');
                valid = false;
            }

            if (!valid) {
                return;
            }

            var id = $('#this_progress_data_id').val();

            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.saveProgress') }}",
                data: {
                    id: id,
                    status: $('#status').val(),
                    followup_date: $('#followup_date').val(),
                    time: $('#time').val(),
                    enquiry: $('#progress_enquiry').val(),
                    lead_type: $('input[name="lead_type"]:checked').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#leadTable').DataTable().draw();
                    $('#progressModal').modal('hide');
                },
                error:function(error) {
                    console.log(error);
                }
            });
        }

        // -------------------------- Delete -------------------
        $(document).on('change', '#select_all_checkbox', function(e) {
                if ($(this).prop('checked')) {
                    $('.delete_table_row').show();
                    $(".table_checkbox").each(function(index) {
                        $(this).prop('checked', true)
                    })
                } else {
                    $('.delete_table_row').hide();
                    $(".table_checkbox").each(function(index) {
                        $(this).prop('checked', false)
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
                } else {
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
                if (rowss.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                    }).then(function(isConfirm) {
                        if (isConfirm.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('superadmin.deleteLead') }}",
                                data: {
                                    allids: JSON.stringify(rowss),
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    $('.delete_table_row').hide();
                                    $('#leadTable').DataTable().draw();
                                }
                            });
                        }
                    })
                }
            }
            function deleteEnquiry(data) {
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
                            url: "{{ route('superadmin.deleteLead') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#leadTable').DataTable().draw();
                            }
                        });
                    }
                })
            }
        // -------------------------- Delete -------------------

        $(document).on('click', '#saveLead', function(e) {
            e.preventDefault();

            let all_error = document.querySelectorAll('.invalid-error');

            all_error.forEach(element => {
                element.classList.add('d-none');
            });
            
            let valid = true;
            
            if($('#first_name').val() == '') {
                document.getElementById('first_name_error').classList.remove('d-none');
                valid = false;
            }
            
            if($('#last_name').val() == '') {
                document.getElementById('last_name_error').classList.remove('d-none');
                valid = false;
            }
            
            if($('#mobile').val() == '') {
                document.getElementById('mobile_error').classList.remove('d-none');
                valid = false;
            }

            if($('#mobile').val() != '') {
                if($('#mobile').val().length != 10 || isNaN($('#mobile').val())) {
                    document.getElementById('mobile_length_error').classList.remove('d-none');
                    valid = false;
                }
            }

            if($('#email').val() == '') {
                document.getElementById('email_error').classList.remove('d-none');
                valid = false;
            }

            if($('#company').val() == '') {
                document.getElementById('company_error').classList.remove('d-none');
                valid = false;
            }
            
            if($('#lead_type').val() == '') {
                document.getElementById('lead_type_error').classList.remove('d-none');
                valid = false;
            }
            
            if($('#plan_interested_in').val() == '') {
                document.getElementById('plan_interested_in_error').classList.remove('d-none');
                valid = false;
            }
            
            if($('#enquiry').val() == '') {
                document.getElementById('enquiry_error').classList.remove('d-none');
                valid = false;
            }
            if($('#state').val() == '') {
                document.getElementById('state_error').classList.remove('d-none');
                valid = false;
            }
            if($('#city').val() == '') {
                document.getElementById('city_error').classList.remove('d-none');
                valid = false;
            }
            if($('#locality').val() == '') {
                document.getElementById('locality_error').classList.remove('d-none');
                valid = false;
            }
            
            if (!valid) {
                return;
            }

            var id = $('#this_data_id').val();

            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.saveEnquiry') }}",
                data: {
                    id: id,
                    user_name: $('#first_name').val(),
                    state: $('#state').val(),
                    city: $('#city').val(),
                    locality: $('#area_id').val(),
                    mobile: $('#mobile').val(),
                    email: $('#email').val(),
                    company: $('#company').val(),
                    followup_date: $('#followup_date').val(),
                    time: $('#time').val(),
                    plan_interested_in: $('#plan_interested_in').val(),
                    mobile_code: $('#mobile_code').val(),
                    enquiry: $('#enquiry').val(),
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    $('#leadTable').DataTable().draw();
                    $('#leadModal').modal('hide');
                },
                error:function(error) {
                    console.log(error);
                    if (error.responseJSON) {
                        var errorMessage = 'Something went wrong! May be duplicate email.';
                        $('#em_err').remove();
                        $('#email').after('<span class="text-danger" id="em_err">' + errorMessage + '</span>');
                    }
                }
            });
        })

    </script>
@endpush
