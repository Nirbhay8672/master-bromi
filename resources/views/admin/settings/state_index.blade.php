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
                            <h5 class="mb-3">List of States <a  
                                class="btn custom-icon-theme-button tooltip-btn"
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
                                    <select name="" id="change_location_link" class="form-control">
                                        <option value="{{ route('admin.settings.state') }}">States</option>
                                        <option value="{{ route('admin.settings.city') }}">Cities</option>
                                        <option value="{{ route('admin.areas') }}">Localities</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#stateModal"
                                        data-tooltip="Add State"
                                    ><i class="fa fa-plus"></i></button>

                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn ms-3"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#importModal"
                                        data-tooltip="Import State"
                                        onclick="resetImportForm()"
                                    ><i class="fa fa-download"></i></button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="display" id="stateTable">
                                    <thead>
                                        <tr>
                                            <th>State</th>
                                            <th>Gst Type</th>
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
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New State</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <div class="form-row mb-2">
                                <div>
                                    <div class="form-group col-md-12 mb-1">
                                        <label for="State">State</label>
                                        <input
                                            class="form-control"
                                            name="state_name"
                                            id="state_name"
                                            type="text"
                                            required=""
                                            autocomplete="off"
                                        >
                                    </div>
                                    <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="is_inter_state" type="checkbox">
                                        <label class="form-check-label" for="is_inter_state">Is Inter State</label>
                                    </div>
                                    <label id="state_name-error" class="error" for="state_name"></label>
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="saveState">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="importModal" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import State</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-2">
                            <div class="form-group col-12 d-inline-block m-b-20">
                                <label class="mb-0">State</label>
                                <select id="import_state_id">
                                    <option value=""> State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="state_error"></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn custom-theme-button" id="importState">Import</button>
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

                $("#change_location_link").select2();
                $("#import_state_id").select2();
                
                $(document).on('change', '#change_location_link', function(e) {
                    window.location.href = $(this).val();
                })
                
                $('#stateTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.settings.state') }}",
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'gst_type',
                            name: 'gst_type'
                        },
                        {
                            data: 'Actions',
                            name: 'Actions',
                            orderable: false
                        },
                    ]
                });
            });

            $('#stateModal').on('hidden.bs.modal', function () {
                $("#this_data_id").val('');
                $("#state_name").val('');
                $('.error').addClass('d-none');
            });

            function getState(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.settings.getstate') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#this_data_id').val(data.id)
                        $('#state_name').val(data.name).trigger('change');

                        if(data.gst_type) {
                            if(data.gst_type == 'inter_state') {
                                $('#is_inter_state').prop('checked', true);
                            } else {
                                $('#is_inter_state').prop('checked', false);
                            }
                        }

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
                            url: "{{ route('admin.settings.destroystate') }}",
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

            $(document).on('click', '#saveState', function(e) {
                e.preventDefault();
				$("#modal_form").validate();

                console.log($("#modal_form").validate());

                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                var id = $('#this_data_id').val();

                var getVal=document.getElementById("is_inter_state").checked;

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.settings.savestate') }}",
                    data: {
                        id: id,
                        name: $('#state_name').val(),
                        gst_type: getVal ? 'inter_state' : 'intra_state',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#stateTable').DataTable().draw();
                        $('#stateModal').modal('hide');
						$('#saveState').prop('disabled',false);
                    }
                });
            });

            function resetImportForm() {
                let state_erorr = document.getElementById('state_error');
                state_erorr.classList.add('d-none');

                $('#import_state_id').val('').trigger('change');
            }

            $(document).on('click', '#importState', function(e) {
                let valid = true;
                let import_state = $('#import_state_id').val();

                let state_erorr = document.getElementById('state_error');
                state_erorr.classList.add('d-none');

                if(import_state == '') {
                    valid = false;
                    state_erorr.classList.remove('d-none');
                    state_erorr.innerHTML = 'Please select state';
                }

                if(valid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.settings.importstate') }}",
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
                            state_erorr.classList.remove('d-none');
                            state_erorr.innerHTML = 'State is already exist';
                        }
                    });
                }
            });

            $(document).on('click', '#importFile', function(e) {
                e.preventDefault();
                var formData = new FormData();
                var files = $('#import_file')[0].files[0];
                if (files == '') {
                    return;
                }
                formData.append('csv_file', files);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "{{ route('admin.settings.importstate') }}",
                    data: formData,
                    success: function(data) {
                        $('#stateTable').DataTable().draw();
                        $('#importmodal').modal('hide');
                        $('#import_form')[0].reset();
                    }
                });
            })
        </script>
    @endpush
