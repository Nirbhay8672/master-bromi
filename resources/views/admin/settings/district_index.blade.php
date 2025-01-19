@extends('admin.layouts.app')
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
                            <h5 class="mb-3">List of District<a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <select name="" id="change_search_link" class="form-control">
                                        <option value="{{ route('admin.districts') }}">Districts</option>
                                        <option value="{{ route('admin.talukas') }}">Talukas</option>
                                        <option value="{{ route('admin.villages') }}">Villages</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#stateModal"
                                        data-tooltip="Add District"
                                        onclick="reset()"
                                    ><i class="fa fa-plus"></i></button>

                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn ms-3"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#importModal"
                                        data-tooltip="Import District"
                                        onclick="resetImportForm()"
                                    ><i class="fa fa-download"></i></button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="display" id="stateTable">
                                    <thead>
                                        <tr>
                                            <th>District Name</th>
                                            <th>State Name</th>
                                            <th>Action</th>
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
        <div class="modal fade" id="stateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New District</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <div class="row">
                                <div class="form-group col-md-6 m-b-20">
									<label for="State">District</label>
                                    <input class="form-control" name="district_name" id="district_name" type="text"
                                        required="" autocomplete="off" >
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                                <div class="form-group col-md-6 d-inline-block m-b-4">
                                    <select class="form-select" id="state_id">
                                        <option value="">State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn custom-theme-button" id="saveDistrict">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import District</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="form-row mb-2">
                        <div class="form-group col-12 d-inline-block m-b-20">
                            <label class="mb-0">District</label>
                            <select id="import_district_id">
                                <option value=""> District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="district_error"></span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn custom-theme-button" id="importDistrict">Import</button>
                        <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#stateModal').on('hidden.bs.modal', function () {
                $("#this_data_id").val('');
                $("#state_id").val('').trigger('change');
                $("#modal_form").validate().resetForm();
                $("#district_name").val('');
            });

            $("#change_search_link").select2();
            $("#import_district_id").select2();
                
            $(document).on('change', '#change_search_link', function(e) {
                window.location.href = $(this).val();
            })

            $('#stateTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.districts') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'state_name',
                        name: 'state_name',
                    },
                    {
                        data: 'Actions',
                        name: 'Actions',
                        orderable: false
                    },
                ]
            });
        });

        $(document).on('click', '#importDistrict', function(e) {

            let valid = true;
            let import_state = $('#import_district_id').val();

            let district_erorr = document.getElementById('district_error');
            district_erorr.classList.add('d-none');

            if(import_state == '') {
                valid = false;
                district_erorr.classList.remove('d-none');
                district_erorr.innerHTML = 'Please select district';
            }

            if(valid) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.importDistrict') }}",
                    data: {
                        id: import_state,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#stateTable').DataTable().draw();
                        $('#importModal').modal('hide');
                        resetImportForm();
                    },
                    error: function(xhr, status, error) {
                        district_erorr.classList.remove('d-none');
                        district_erorr.innerHTML = 'District is already exist';
                    }
                });
            }
        });

        function resetImportForm() {
            let district_erorr = document.getElementById('district_error');
            district_erorr.classList.add('d-none');

            $('#import_district_id').val('').trigger('change');
        }

        function reset(data) {
            $('#this_data_id').val('');
            $('#district_name').val('');
            $('#state_id').val('').trigger('change');
        }

        function getState(data) {
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.get_district') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    data = JSON.parse(data)
                    $('#this_data_id').val(data.id)
                    $('#district_name').val(data.name).trigger('change');
                    $('#state_id').val(data.state_id).trigger('change');
                    $('#stateModal').modal('show');
                    triggerChangeinput()
                }
            });
        }

        function deleteState(data) {
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
                        url: "{{ route('admin.destroy-district') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#stateTable').DataTable().draw();
                        }
                    });
                }
            })

        }

        $(document).on('click', '#saveDistrict', function(e) {
            e.preventDefault();
            $("#modal_form").validate();
            if (!$("#modal_form").valid()) {
                return
            }
            var id = $('#this_data_id').val()
            $.ajax({
                type: "POST",
                url: "{{ route('admin.save_district') }}",
                data: {
                    id: id,
                    name: $('#district_name').val(),
                    state_id: $('#state_id').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#stateTable').DataTable().draw();
                    $('#stateModal').modal('hide');
                }
            });
        })

    </script>
@endpush
