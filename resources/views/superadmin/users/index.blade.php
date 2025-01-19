@extends('superadmin.layouts.superapp')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="mb-3">Users </h5>
                        <div class="row mt-3 mb-3 gy-3">
                            <div style="width: 70px;">
                                <button
                                    class="btn custom-icon-theme-button tooltip-btn"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#userModal"
                                    data-tooltip="Add User"
                                    onclick="resetData()"
                                ><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-12 col-lg-2 col-md-2">
                                <select
                                    id="filter_type"
                                    class="form-control"
                                    style="border: 1px solid black;"
                                    onchange="updateFilter()"
                                >
                                    <option value="">-- Select filter --</option>
                                    <option value="state">State</option>
                                    <option value="city">City</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-2 col-md-2">
                                <div class="fname">
                                    <input
                                        type="text"
                                        id="filter_value"
                                        class="form-control"
                                        placeholder="Search ...."
                                        onkeyup="filter()"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div style="width: 150px;">
                                <button
                                    class="btn btn-warning tooltip-btn"
                                    type="button"
                                    style="border-radius: 5px;"
                                    onclick="reset()"
                                    data-tooltip="Reset"
                                ><i class="fa fa-recycle"></i>
                                </button>
                                <button
                                    class="btn text-white delete_table_row ms-3 tooltip-btn"
                                    style="border-radius: 5px;display: none;background-color:red"
                                    onclick="deleteTableRow()"
                                    type="button"
                                    data-tooltip="Delete"
                                ><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="userTable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px !important;">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                <label class="form-check-label" for="select_all_checkbox"></label>
                                            </div>
                                        </th>
                                        <th style="min-width:150px;">Full Name</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Company Name</th>
                                        <th>Plan</th>
                                        <th>Subscription</th>
                                        <th>Expiry</th>
                                        <th>Users</th>
                                        <th>Active</th>
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
<div class="modal fade" id="userModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark modal_form" method="post" id="modal_form">
                    <div class="row">
                        <div class="form-group d-none">
                            <input type="text" class="form-control" name="this_data_id" id="this_data_id">
                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <label for="first_name">First Name</label>
                                <input class="form-control" name="first_name" id="first_name" type="text" autocomplete="off" autofocus>
                            </div>
                            <span class="custom-error d-none text-danger" id="first_name_error">First name is required.</span>
                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <label for="last_name">Last Name</label>  
                                <input class="form-control" name="last_name" id="last_name" type="text" autocomplete="off">
                            </div>
                            <span class="custom-error d-none text-danger" id="last_name_error">Last name is required.</span>

                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <label for="email">Email</label>
                                <input class="form-control" name="email" id="email" style="text-transform: none !important;" type="text" autocomplete="off">
                            </div>
                            <span class="custom-error d-none text-danger" id="email_error">Email is required.</span>

                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <label for="mobile_number">Mobile Number</label>
                                <input class="form-control" maxlength="10" name="mobile_number" id="mobile_number" type="text" autocomplete="off">
                            </div>
                            <span class="custom-error d-none text-danger" id="mobile_number_error">Mobile number is required.</span>

                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" id="password" type="text" autocomplete="off">
                            </div>
                            <span class="custom-error d-none text-danger" id="password_error">Password is required.</span>
                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <select name="state" id="state" onchange="setCities()">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="custom-error d-none text-danger" id="state_error">State is required.</span>
                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <select name="city" id="city">
                                    <option value="">Select City</option>
                                </select>
                                <span class="custom-error d-none text-danger" id="city_error">City is required.</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-20">
                            <div class="fname">
                                <label for="company_name">Company Name</label>
                                <input class="form-control" name="company_name" id="company_name" type="text" autocomplete="off">
                            </div>
                            <span class="custom-error d-none text-danger" id="company_name_error">Company name is required.</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn custom-theme-button" type="button" id="saveUser">Save</button>
                        <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<button
    class="btn custom-icon-theme-button d-none"
    type="button"
    id="openList"
    data-bs-toggle="modal"
    data-bs-target="#userListModal"
><i class="fa fa-plus"></i>
</button>

<div class="modal fade" id="userListModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User List</h5>
                <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <h3 class="text-danger">This users cant be delete</h3>
                <ul id="user_list" class="mt-3">
                </ul>

                <div class="text-center mt-5">
                    <button class="btn custom-theme-button" type="button" onclick="deleteAllUsers()">Delete Remaining Users</button>
                    <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
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

    let states = @Json($states_encoded);

    function updateFilter() {
        let filterOn = document.getElementById('filter_type');
        let search_input = document.getElementById('filter_value');
        search_input.value = '';

        if(filterOn.value != '')
        {
            search_input.readOnly = false;
            search_input.placeholder = `Search ${filterOn.value}`;
        } else {
            search_input.readOnly = true;
            search_input.placeholder = 'Search ....';
        }
    }

    function delayedFunction() {
        $('#userTable').DataTable().draw();
    }

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

    function filter() {
        setTimeout(delayedFunction, 1000);
    }

    function reset() {
        let filterOn = document.getElementById('filter_type');
        let search_input = document.getElementById('filter_value');

        search_input.value = '';
        filterOn.value = '';
        $('#userTable').DataTable().draw();
    }

    function userActivate(user, status) {
        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.changeUserStatus') }}",
            data: {
                id: $(user).attr('data-id'),
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#userTable').DataTable().draw();
            }
        });
    }

    $(document).ready(function() {
        let filterOn = document.getElementById('filter_type');
        let search_input = document.getElementById('filter_value');
        $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.users') }}",
                data: function(d) {
                    d.filter_type = filterOn.value;
                    d.filter_value = search_input.value;
                }
            },
            columns: [
                {
                    data: 'select_checkbox',
                    name: 'select_checkbox',
                    orderable: false
                },
                {
                    data: "email" , render : function ( data, type, row, meta ) {
                        return `<span>${row.first_name} ${row.last_name}</span><br> <span>${row.mobile_number}</span>`; 
                    }
                },
                {
                    data: 'state_name',
                    name: 'state_name'
                },
                {
                    data: 'city_name',
                    name: 'city_name'
                },
                {
                    data: 'company_name',
                    name: 'company_name',
                },
                {
                    data: 'plan',
                    name: 'plan'
                },
                {
                    data: 'subscribed_on',
                    name: 'subscribed_on'
                },
                {
                    data: 'plan_expire_on',
                    name: 'plan_expire_on'
                },
                {
                    data: 'users',
                    name: 'users'
                },
                {
                    data: 'active',
                    name: 'active'
                },
                {
                    data: 'Actions',
                    name: 'Actions'
                },
            ]
        });

    });


    function getUser(data) {
        resetData();
        $('#modal_form').trigger("reset");

        $('#exampleModalLabel').text('Edit User');

        var id = $(data).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.getUser') }}",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#this_data_id').val(data.main_user.id).trigger('change');
                $('#first_name').val(data.main_user.first_name).trigger('change');
                $('#last_name').val(data.main_user.last_name).trigger('change');
                $('#email').val(data.main_user.email).trigger('change');
                $('#mobile_number').val(data.main_user.mobile_number).trigger('change');
                $('#state').val(data.main_user.state_id).trigger('change');
                setCities();

                $('#city').val(data.main_user.city_id).trigger('change');
                $('#company_name').val(data.main_user.company_name).trigger('change');

                $('#userModal').modal('show');
            }
        });
    }

    function resetData() {
        let all_error = document.querySelectorAll('.custom-error');

        all_error.forEach(element => {
            element.classList.add('d-none');
        });

        $('#exampleModalLabel').text('Add User');

        $('#this_data_id').val('');
        $('#first_name').val('').trigger('change');
        $('#last_name').val('').trigger('change');
        $('#email').val('').trigger('change');
        $('#mobile_number').val('').trigger('change');
        $('#password').val('').trigger('change');
        $('#state').val('').trigger('change');
        $('#city').val('').trigger('change');
        $('#company_name').val('').trigger('change');
    }

    $(document).on('click', '#saveUser', function(e) {

        let all_error = document.querySelectorAll('.custom-error');

        var id = $('#this_data_id').val();

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

        if($('#email').val() == '') {
            document.getElementById('email_error').classList.remove('d-none');
            valid = false;
        }

        if($('#mobile_number').val() == '') {
            document.getElementById('mobile_number_error').classList.remove('d-none');
            valid = false;
        }

        if(id == '') {
            if($('#password').val() == '') {
                document.getElementById('password_error').classList.remove('d-none');
                valid = false;
            }

        }
    
        if($('#state').val() == '') {
            document.getElementById('state_error').classList.remove('d-none');
            valid = false;
        }

        if($('#city').val() == '') {
            document.getElementById('city_error').classList.remove('d-none');
            valid = false;
        }

        if($('#company_name').val() == '') {
            document.getElementById('company_name_error').classList.remove('d-none');
            valid = false;
        }

        if (!valid) {
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.saveUser') }}",
            data: {
                id: id,
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                mobile_number: $('#mobile_number').val(),
                password: $('#password').val(),
                state: $('#state').val(),
                city: $('#city').val(),
                company_name: $('#company_name').val(),
                _token: '{{ csrf_token() }}',
            },
            success: function(data) {
                $('#userTable').DataTable().draw();
                $('#userModal').modal('hide');
            }
        });
    });

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
    });

    let deletable_users = [];

    function deleteTableRow(params) {
        var rowss = [];
        $(".table_checkbox").each(function(index) {
            if ($(this).prop('checked')) {
                rowss.push($(this).attr('data-id'))
            }
        })
        if (rowss.length>0)
        {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function(isConfirm) {
                if (isConfirm.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.checkForDeleteUsers') }}",
                        data: {
                            allids: rowss,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            let openListButton = document.getElementById('openList');
                            openListButton.click();

                            let userList = document.getElementById('user_list');
                            userList.innerHTML = '';

                            response.user_list.forEach((user, index) => {
                                userList.innerHTML += `<li>${index + 1} . ${user}</li>`;
                            });

                            $('.delete_table_row').hide();

                            deletable_users = response.deletable_user;

                            $('#select_all_checkbox').prop('checked',false);
                        }
                    });
                }
            })
        }
    }

    function deleteAllUsers() {
        $.ajax({
            type: "POST",
            url: "{{ route('superadmin.deleteAllUsers') }}",
            data: {
                allids: deletable_users,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#userTable').DataTable().draw();
                $('#userListModal').modal('hide');
                deletable_users = [];
                $('#select_all_checkbox').prop('checked',false);
            }
        });
    }

</script>
@endpush
