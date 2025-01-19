@extends('admin.layouts.app')
@section('content')
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
                            <h5 class="mb-3">Users <a  
                                class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            
                            @can('user-create')
                                @if(Auth::user()->total_free_user > 1)
                                    <a  
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        href="{{route('admin.user.add')}}"
                                        data-tooltip="Add User"
                                    >
                                        <i class="fa fa-plus"></i>
                                    </a>
                                @else
                                    <a
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        href="{{ route('admin.profile.details') }}"
                                        data-tooltip="Upgrade Plan Or Add Users"
                                    ><i class="fa fa-wrench"></i></a>
                                    <strong class="ms-3 text-danger">You have exceeded your user limit</strong>
                                @endif
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Status</th>
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
    <div class="modal fade" id="planModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upgrade Plan</h5>
                    <button class="btn-close btn-light" onclick="reset" type="button" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3 mb-4">
                        <div class="m-checkbox-inline custom-radio-ml">
                            <div class="form-check form-check-inline radio radio-primary">
                                <input
                                    class="form-check-input filled"
                                    id="user_limit"
                                    type="radio"
                                    name="plan_type"
                                    onclick="changeType(1)"
                                    value="1"
                                    checked
                                >
                                <label class="form-check-label mb-0" for="user_limit">User Limit</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-primary">
                                <input
                                    class="form-check-input filled"
                                    id="update_plan"
                                    type="radio"
                                    name="plan_type"
                                    onclick="changeType(2)"
                                    value="2"
                                >
                                <label class="form-check-label mb-0" for="update_plan">Update Plan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="user_limit_element">
                        <div class="form-group col-12 col-md-3 col-lg-3 mb-1">
                            <div class="fname focused">
                                <label for="State">User Limit</label>
                                <div class="fvalue">
                                    <input
                                        class="form-control"
                                        name="user_limit"
                                        id="user_limit_input"
                                        type="number"
                                        autocomplete="off"
                                    >
                                </div>
                                <span class="text-danger" id="user_limit_error"></span>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-secondary" onclick="updateUserLimit()">Save</button>
                                <button class="btn btn-danger ms-2" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="row d-none" id="plans_element">
                        @foreach ($plans as $plan)
                        <div class="col-xl-3 col-sm-6 xl-50 box-col-6">
                            <div class="pricing-block card text-center">
                                <div class="pricing-header">
                                    <h4 class="mt-5">{{$plan->name}}</h4>
                                    <div class="price-box">
                                        <div>
                                            <h3>{{$plan->price}}</h3>
                                            <p>/ month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pricing-list">
                                    <ul class="pricing-inner">
                                        <li>
                                            <h6>User Limit : {{$plan->user_limit}}</h6>
                                        </li>
                                        @if (!empty($plan->details) && !empty(explode('_---_',json_decode($plan->details,true))))
                                            @foreach (explode('_---_',json_decode($plan->details,true)) as $feature)
                                                <li>
                                                    <h6>{{$feature}}</h6>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <form action="{{route('admin.upgradePlan')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                        <button class="btn btn-primary btn-lg" type="submit"
                                        data-original-title="btn btn-primary btn-lg"
                                        title="">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
    <script>

        let user_limit_element = document.getElementById('user_limit_element');
        let plan_element = document.getElementById('plans_element');
        let radio_button = document.getElementById('user_limit');

        function changeType(type) {
            if(type == 1) {
                user_limit_element.classList.remove('d-none');
                plan_element.classList.add('d-none');
            } else {
                user_limit_element.classList.add('d-none');
                plan_element.classList.remove('d-none');
            }
        }

        function reset() {
            radio_button.checked = true;
            user_limit_element.classList.remove('d-none');
            plan_element.classList.add('d-none');
        }

        function updateUserLimit() {

            let valid = true;
            var user_limit = $('#user_limit_input').val();
            var user_limit_error = $('#user_limit_error');

            user_limit_error.text('');

            if(user_limit == '' || user_limit <= 0) {
                valid = false;
                user_limit_error.text('user limit is not valid.');
            }

            if(valid) {
                $.ajax({
                type: "POST",
                url: "{{ route('admin.upgradeUserLimit') }}",
                data: {
                        user_limit : user_limit,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#userTable').DataTable().draw();
                        $('#planModal').modal('hide');

                        var redirect_url = "{{route('admin.users')}}";
                        window.location.href = redirect_url;
                    }
                });
            }
        }

		var shouldchangecity = 1;

		var cities = @Json($city_encoded);
		var states = @Json($state_encoded);

		$(document).on('change', '#state_id', function(e) {
			if (shouldchangecity) {
				$('#city_id').select2('destroy');
			citiesar = JSON.parse(cities);
			$('#city_id').html('');
			for (let i = 0; i < citiesar.length; i++) {
				if (citiesar[i]['state_id'] == $("#state_id").val()) {
					$('#city_id').append('<option value="'+citiesar[i]['id']+'">'+citiesar[i]['name']+'</option>')
				}
			}
			$('#city_id').select2();
			}
		})

        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var go_data_id = urlParams.get('data_id')
        var current_user_id = '{{ Auth::user()->id }}';


        function getUser(data) {
			shouldchangecity = 0;
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getUser') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    dataa = JSON.parse(data).data;
                    role = JSON.parse(data).role
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
                    $('#driving_license').val(dataa.driving_license)
                    $('#status').val(dataa.status)
                    $('#address').val(dataa.address)
                    $('#pincode').val(dataa.pincode)
                    $('#city_id').val(dataa.city_id).trigger('change');
                    $('#state_id').val(dataa.state_id).trigger('change');
                    $('#mobile_number').val(dataa.mobile_number)
                    $('#office_no').val(dataa.office_no)
                    $('#email').val(dataa.email)
                    $('#home_phone_no').val(dataa.home_phone_no)
                    $('#position').val(dataa.position).trigger('change');
                    $('#property_for_id').val(dataa.property_for_id).trigger('change')
                    $('#working').prop('checked', Number(dataa.working));
					shouldchangecity = 1;
					$('#specific_properties').val([]).trigger('change');
					$('#buildings').val([]).trigger('change');
					$('#branch_id').val([]).trigger('change');
					$('#reporting_to').val([]).trigger('change');
					$('#property_type_id').val([]).trigger('change');
                    try {
                        $('#specific_properties').val(JSON.parse(dataa.specific_properties)).trigger('change');
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
                        $('#property_type_id').val(JSON.parse(dataa.property_type_id)).trigger('change');
                    } catch (error) {
						//
                    }
                    $('#role_id').val(role.split('_---_')[0]).trigger('change');
                    $('#userModal').modal('show');
					triggerChangeinput()
                }
            });
        }


        function deleteUser(data) {

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
                        url: "{{ route('admin.deleteUser') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#userTable').DataTable().draw();
                        }
                    });
                }
            })
        }

        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.users') }}",
                    data: function(d) {
                        d.go_data_id = go_data_id;
                    },
                },
                columns: [{
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'role_id',
                        name: 'role_id'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions',
                        orderable: false
                    },
                ]
            });


            $('#modal_form').validate({ // initialize the plugin
                rules: {
                    first_name: {
                        required: true,
                    },
                    middle_name: {
                        required: true,
                    },
                    email: {
                        email: true,
                    },
                    pincode: {
                        digits: true,
                    },
                },
                submitHandler: function(form) { // for demo
                    alert('valid form submitted'); // for demo
                    return false; // for demo
                }
            });

            $(document).on('click', '#saveUser', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveUser') }}",
                    data: {
                        id: id,
                        first_name: $('#first_name').val(),
                        middle_name: $('#middle_name').val(),
                        last_name: $('#last_name').val(),
                        birth_date: $('#birth_date').val(),
                        hire_date: $('#hire_date').val(),
                        driving_license: $('#driving_license').val(),
                        status: $('#status').val(),
                        address: $('#address').val(),
                        pincode: $('#pincode').val(),
                        city_id: $('#city_id').val(),
                        state_id: $('#state_id').val(),
                        mobile_number: $('#mobile_number').val(),
                        office_no: $('#office_no').val(),
                        email: $('#email').val(),
                        home_phone_no: $('#home_phone_no').val(),
                        position: $('#position').val(),
                        branch_id: JSON.stringify($('#branch_id').val()),
                        reporting_to: JSON.stringify($('#reporting_to').val()),
                        password: $('#password').val(),
                        role_id: $('#role_id').val(),
                        property_for_id: $('#property_for_id').val(),
                        property_type_id: JSON.stringify($('#property_type_id').val()),
                        specific_properties: JSON.stringify($('#specific_properties').val()),
                        buildings: JSON.stringify($('#buildings').val()),
                        working: Number($('#working').prop('checked')),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#userTable').DataTable().draw();
                        $('#userModal').modal('hide');
						$('#saveUser').prop('disabled',false);
                    }
                });
            })

        });
    </script>
@endpush
