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
                            <h5 class="mb-3">Partner Requests</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="sharedUserTable">
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
                                            {{-- <th>Company Name</th> --}}
                                            <th>Email</th>
                                            <th>Company</th>
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
    @endsection
    @push('scripts')
        <script>
            // Index View Partner Data
            $('#sharedUserTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('admin.userRequest') }}",
                    data: function(d) {
                        console.log("userRequest", d);
                    },
                },
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'partner_name',
                    name: 'partner_id'
                }, {
                    data: 'partner_email',
                    name: 'email'
                },
				{
                    data: 'company_name',
                    name: 'company_name'
                },
				{
                    data: 'action',
                    name: 'action'
                },],
                columnDefs: [{
                        "width": "2%",
                        "targets": 0
                    },
                    {
                        "width": "12%",
                        "targets": 1
                    },
                    {
                        "width": "12%",
                        "targets": 2
                    },
                    {
                        "width": "12%",
                        "targets": 3
                    },
					{
                        "width": "12%",
                        "targets": 4
                    },

                ],
                "drawCallback": function(settings, json) {
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


			 // Accept Request
			 function acceptUsersRequest(data) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function(isConfirm) {
                    if (isConfirm.isConfirmed) {
                        var id = $(data).attr('data-id');
						console.log("id",id);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.userShared.accept') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
								console.log("Data shared req ==>",data);
                                $('#sharedUserTable').DataTable().draw();
                            }
                        });
                    }
                })

            }

            // Delete Partner
            function cancelRequest(data) {
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
                            url: "{{ route('admin.deletePartner') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#sharedUserTable').DataTable().draw();
                            }
                        });
                    }
                })

            }
        </script>
    @endpush
