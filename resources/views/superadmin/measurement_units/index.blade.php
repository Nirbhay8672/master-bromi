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
                            <h5 class="mb-3">Measurement Units <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        onclick="reset()"
                                        data-bs-toggle="modal"
                                        data-bs-target="#roleModal"
                                        data-tooltip="Add Measurement Unit"
                                    ><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="roleTable">
                                    <thead>
                                        <tr>
                                            <th>Measurement Name</th>
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
        <div class="modal fade" id="roleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Measurement Unit</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div class="row">
                                <div class="form-group col-md-12 m-b-20">
                                    <div class="fname">
                                        <input
                                            class="form-control"
                                            name="name"
                                            id="name"
                                            type="text"
                                            placeholder="Enter unit name"
                                            autocomplete="off"
                                        >
                                    </div>
                                    <span class="text-danger d-none name-validation" id="name_error">Name is required.</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="saveUnit">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).ready(function() {
                    $('#roleTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('superadmin.units') }}",
                        columns: [{
                                data: 'unit_name',
                                name: 'unit_name'
                            },
                            {
                                data: 'Actions',
                                name: 'Actions',
                                orderable: false
                            },
                        ]
                    });
                });
            });

            function reset() {
                $('#this_data_id').val('');
                $('#name').val('');
                document.getElementById('name_error').classList.add('d-none');
            }

            function getUnit(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.getUnit') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(unit_data) {
                        $('#this_data_id').val(unit_data.id);
                        $('#name').val(unit_data.unit_name);
                        $('#roleModal').modal('show');
                    }
                });
            }

            function deleteUnit(data) {
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
                            url: "{{ route('superadmin.deleteUnits') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#roleTable').DataTable().draw();
                            }
                        });
                    }
                })
            }

            $(document).on('click', '#saveUnit', function(e) {

                let is_valid = true;
                if($('#name').val() == '') {
                    document.getElementById('name_error').classList.remove('d-none');
                    is_valid = false;
                }

                if(is_valid) {
                    e.preventDefault();
                    var id = $('#this_data_id').val()
                    var permissions = [];
                    $('input:checkbox:checked.permission_checkbox').each(function() {
                        permissions.push($(this).attr('data-id'));
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.saveUnits') }}",
                        data: {
                            id: id,
                            name: $('#name').val(),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#roleTable').DataTable().draw();
                            $('#roleModal').modal('hide');
                        }
                    });
                }
            })
        </script>
    @endpush
