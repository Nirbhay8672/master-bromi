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
                            <h5 class="mb-3">List of States <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <div style="width: 150px;">
                                <button
                                    class="btn custom-icon-theme-button open_modal_with_this tooltip-btn"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#stateModal"
                                    data-tooltip="Add State"
                                ><i class="fa fa-plus"></i>
                                </button>
                                <button
                                    class="btn custom-icon-theme-button open_modal_with_this ms-2 tooltip-btn"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#importModal"
                                    data-tooltip="Import States"
                                ><i class="fa fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="stateTable">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 80px;">Sr No.</th>
                                            <th>State Name</th>
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
        <div class="modal fade" id="importModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import State</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark" action="{{ route('superadmin.stateImport') }}" method="POST" enctype="multipart/form-data">
                            @csrf    
                            <div class="form-row mb-2 mt-2">
                                <div>
                                    <div class="form-group col-md-12 mb-1">
                                        <label for="State">CSV File</label>
                                        <input
                                            class="form-control"
                                            name="csv_file"
                                            id="csv_file"
                                            accept=".csv"
                                            type="file"
                                            style="border:1px solid black"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <i class="fa fa-arrow-right me-2"></i><span class="text-primary" style="cursor: pointer;" onclick="openDocument('states.csv')">Sample File</span>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button class="btn custom-theme-button" type="submit">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="stateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                                    <label id="state_name-error" class="error" for="state_name"></label>
                                </div>
                                <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input" id="is_inter_state" type="checkbox">
                                    <label class="form-check-label" for="is_inter_state">Is Inter State</label>
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" type="button" id="saveState">Save</button>
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

                $('#stateTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('superadmin.settings.state') }}",
                    },
                    columns: [{
                            data: 'id',
                            name: 'id',
                        },
                        {
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
                    ],
                    columnDefs: [{
                        "width": "3%",
                        "targets": 0
                    }],
                });
            });

            function getState(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.settings.getState') }}",
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
                            url: "{{ route('superadmin.settings.deleteState') }}",
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

                if (!$("#modal_form").valid()) {
					return
                }

                $(this).prop('disabled',true);
                var id = $('#this_data_id').val();

                var getVal=document.getElementById("is_inter_state").checked;

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.settings.saveState') }}",
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
            })

        </script>
    @endpush
