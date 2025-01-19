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
                            <h5 class="mb-3">SMS Template <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <a href="{{route('superadmin.sms.create')}}" class="btn tooltip-btn custom-icon-theme-button btn-air-primary" data-tooltip="Add SMS Template"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="email_template_table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th width="30%">Actions</th>
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

    <div class="modal fade" id="emailTemplateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Template</h5>
                    <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="load_email_content">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#email_template_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.sms.index') }}",
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions'
                    },
                ]
            });
        });

        $(document).on('click','.delete-record',function(e){
            e.preventDefault();
            var URL = $(this).data('url');
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to delete this record!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-outline-danger ms-1"
                },
                buttonsStyling: !1,
            }).then(function(t) {
                if (t.value) {
                    $.ajax({
                        type: 'POST',
                        url: URL,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response.status == true){
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: "Record has been deleted.",
                                    customClass: {
                                        confirmButton: "btn btn-success"
                                    }
                                });
                                $('#email_template_table').DataTable().draw();
                            }else{
                                Swal.fire({
                                    title: "Cancelled",
                                    text: response.message,
                                    icon: "error",
                                    customClass: {
                                        confirmButton: "btn btn-success"
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click','.show-email-template',function(e){
            e.preventDefault();
            var URL = $(this).data('url');
            $.ajax({
                type: 'POST',
                url: URL,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#load_email_content').html(response);
                    $('#emailTemplateModal').modal('show');
                }
            });
        });
    </script>
@endpush
