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
                            <h5 class="mb-3">Shared Property to others</h5>
							{{-- <a href="{{ route('admin.userRequest') }}"><button class="btn btn-primary btn-air-primary "
								type="button">User
								Requests</button></a> --}}
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="display" id="propertyTable2">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Property Info</th>
                                            <th>Request By</th>
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
        {{-- Partner modal --}}
        <div class="modal fade" id="UserModel" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Partner</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close" id="btnClose">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" route="" id="findRecordForm"
                            novalidate="">
                            <input type="hidden" name="schedule_visit_id" id="schedule_visit_id">
                            <div class="row">
                                <div class="form-group col-md-12 m-b-4 mb-3">
                                    <label class="mb-0">&nbsp;</label>
                                    <label class="select2_label" for="Property list">Email</label>
                                    <input class="form-control" name="partner_email" value="" id="partner_email"
                                        type="email" autocomplete="off">
                                </div>
                                <center><label for="" class="text-cnter">OR</label></center>
                                <div class="form-group col-md-612m-b-4 mb-3">
                                    <label class="mb-0">&nbsp;</label>
                                    <label class="select2_label" for="Property list">Number</label>
                                    <input class="form-control" name="partner_number" value="" id="partner_number"
                                        type="text" autocomplete="off">
                                </div>
                                <span style="color: red" id="err_partner"></span>
                                <div class="form-group col-md-2 m-b-4 mb-3">
                                    <button class="btn btn-secondary" id="saveSchedule" data-id="">find</button>
                                </div>
                            </div>
                        </form>
                        {{-- test@mrweb.co.in  9876543210 --}}
                        <table class="table custom-table-design mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Email</th>
                                    {{-- <th scope="col">Number By</th> --}}
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {

                // User Requests
                // $('#userRequestBtn').click(function() {
                //     $('#UserModel').modal('show');
                // });
				// $('#userRequestBtn').click(() => $('#UserModel').modal('show'));

                $('#propertyTable2').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: {
                        url: "{{ route('admin.shared.requests') }}",
                        data: function(d) {
                            //
                        },
                    },
                    columns: [{
                            data: 'project_name',
                            name: 'project_name'
                        },
                        {
                            data: 'property_info',
                            name: 'property_info'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name'
                        },
                        {
                            data: 'Action',
                            name: 'Action'
                        },
                    ]
                });
            });

            // Accept Request
            function acceptRequest(data) {
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
                            url: "{{ route('admin.shared.accept') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
								console.log("data prop ==>",data);
                                $('#propertyTable2').DataTable().draw();
                            }
                        });
                    }
                })

            }

            // Cancel Request
            function cancelRequest(data) {
                console.log("cancel Req:");
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function(isConfirm) {
                    if (isConfirm.isConfirmed) {
                        var id = $(data).attr('data-id');
                        console.log("id:", id);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.shared.cancel') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#propertyTable2').DataTable().draw();
                            }
                        });
                    }
                })

            }
        </script>
    @endpush
