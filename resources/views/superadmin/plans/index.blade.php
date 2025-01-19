@extends('superadmin.layouts.superapp')
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
                            <h5 class="mb-3">Plans <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <button
                                class="btn custom-icon-theme-button open_modal_with_this tooltip-btn"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#planModal"
                                data-tooltip="Add Plan"
                                onclick="resetData()"
                            ><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="planTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Extra User Price</th>
                                            <th>Upto Users</th>
                                            <th>Free users</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Plan</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                        <input type="hidden" name="this_data_id" id="this_data_id">
                        <div class="row">

                            <div class="form-group col-md-4 m-b-20">
                                <label for="plan_name">Plan Name</label>
                                <div class="fname">
                                    <input
                                        class="form-control"
                                        name="name"
                                        id="plan_name"
                                        type="text" 
                                        placeholder="Name"
                                        required=""
                                        autocomplete="off"
                                    >
                                    <span class="text-danger error_span" id="error_name"></span>
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-b-20">
                                <label for="plan_price">Plan Price</label>
                                <div class="fname">
                                    <input
                                        class="form-control"
                                        name="price"
                                        id="plan_price"
                                        type="text"
                                        placeholder="Price"
                                        required=""
                                        autocomplete="off"
                                    >
                                    <span class="text-danger error_span" id="error_price"></span>
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-b-20">
                                <label for="user_limit">Upto User</label>
                                <div class="fname">
                                    <input
                                        class="form-control"
                                        name="user_limit"
                                        id="user_limit"
                                        type="text"
                                        placeholder="Upto user"
                                        required=""
                                        autocomplete="off"
                                    >
                                    <span class="text-danger error_span" id="error_user_limit"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-4 m-b-20">
                                <label for="extra_user_price">Extra User Price</label>
                                <div class="fname">
                                    <input
                                        class="form-control"
                                        name="extra_user_price"
                                        id="extra_user_price"
                                        type="text"
                                        placeholder="Extra User Price"
                                        required=""
                                        autocomplete="off"
                                    >
                                    <span class="text-danger error_span" id="error_extra_user_price"></span>
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-b-20">
                                <label for="free_user">Free User</label>
                                <div class="fname">
                                    <input
                                        class="form-control"
                                        name="free_user"
                                        id="free_user"
                                        type="text"
                                        placeholder="Free User"
                                        required=""
                                        autocomplete="off"
                                    >
                                    <span class="text-danger error_span" id="error_free_user"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 m-b-20">
                                    <button onclick=addFeature() class="btn btn-pill btn-primary" type="button">Add
                                        Feature</button>
                                </div>
                            </div>

                            <div class="" id="feature-container">
                            </div>
                        </div>

                        <button class="btn custom-theme-button" id="savePlan">Save</button>
                        <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function getPlan(data) {

            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.getPlan') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    dataa = JSON.parse(data);
                    featurestring = '';
                    if (dataa.details != '') {
                        featurestring = JSON.parse(dataa.details)
                    }
                    $('#this_data_id').val(dataa.id);
                    $('#plan_name').val(dataa.name);
                    $('#plan_price').val(dataa.price);
                    $('#user_limit').val(dataa.user_limit);
                    $('#extra_user_price').val(dataa.extra_user_price);
                    $('#free_user').val(dataa.free_user);
                    if (featurestring != '') {
                        features = featurestring.split('_---_')
                        $('#feature-container').html('');
                        features.forEach(element => {

                            inp = `<div class="row">
                                    <div class="form-group col-md-4 m-b-20">
                                        <div class="fname">
                                            <input
                                                class="form-control"
                                                name="features[]"
                                                id="user_limit"
                                                type="text"
                                                placeholder="Feature"
                                                required=""
                                                value="${element}"
                                                autocomplete="off"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button
                                            onclick="deletethis(this)"
                                            class="btn btn-danger"
                                            type="button"
                                        ><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>`;
                            $('#feature-container').append(inp)
                        });
                    }
                    $('#planModal').modal('show');
                }
            });
        }

        function deletethis(params) {
            $(params).parent().parent().remove();
        }

        function addFeature() {

            inp = `<div class="row">
                <div class="form-group col-md-4 m-b-20">
                    <div class="fname">
                        <input
                            class="form-control"
                            name="features[]"
                            id="user_limit"
                            type="text"
                            placeholder="Feature"
                            required=""
                            autocomplete="off"
                        >
                    </div>
                </div>
                <div class="col-2">
                    <button
                        onclick="deletethis(this)"
                        class="btn btn-danger"
                        type="button"
                    ><i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>`;
            
            $('#feature-container').append(inp)
        }

        function resetData() {
            let all_error = document.querySelectorAll('.error_span');

            all_error.forEach(element => {
                let erorr_span = document.getElementById(element.id);
                erorr_span.classList.add('d-none');
            });
        }

        function deletePlan(data) {
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.deletePlan') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#planTable').DataTable().draw();
                }
            });
        }

        $(document).ready(function() {
            $('#planTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.plans') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'extra_user_price',
                        name: 'Extra User Price'
                    },
                    {
                        data: 'user_limit',
                        name: 'Upto Users'
                    },
                    {
                        data: 'free_user',
                        name: 'Free Users'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions'
                    },
                ]
            });

            $(document).on('click', '#savePlan', function(e) {

                e.preventDefault();
                var id = $('#this_data_id').val()
                var features = [];
                $('input[name="features[]"]').each(function() {
                    features.push($(this).val());
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.savePlan') }}",
                    data: {
                        id: id,
                        name: $('#plan_name').val(),
                        price: $('#plan_price').val(),
                        user_limit: $('#user_limit').val(),
                        extra_user_price: $('#extra_user_price').val(),
                        free_user: $('#free_user').val(),
                        features: features,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#planTable').DataTable().draw();
                        $('#planModal').modal('hide');
                    },
                    error: function(xhr) {

                        resetData();

                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        
                        Object.entries(errors).forEach((error , key ) => {
                            let error_element = document.getElementById(`error_${error[0]}`);
                            error_element.classList.remove('d-none');
                            error_element.innerHTML = error[1][0];
                        });
                    }
                });
            })

        });
    </script>
@endpush
