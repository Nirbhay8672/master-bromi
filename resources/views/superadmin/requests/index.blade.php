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
                            <h5 class="mb-3">Requests </h5>

                            <button class="btn custom-icon-theme-button open_modal_with_this tooltip-btn" type="button"
                                data-bs-toggle="modal" data-bs-target="#requestModal"  onclick="resetData()" data-tooltip="Add Lead"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="requestTable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Request</th>
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
    <div class="modal fade" id="requestModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Request</h5>
                    <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                        <div class="row">
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <textarea name="enquiry" id="enquiry" cols="100" rows="10"></textarea>
                                </div>
                            </div>
                            
                        </div>

                        <div class="text-center">
                            <button class="btn custom-theme-button" id="saveEnq">Save</button>
                            <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
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
            $('#requestTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.listEnquiries') }}",
                columns: [{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'enquiry',
                        name: 'enquiry'
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


        $('#modal_form').validate({ // initialize the plugin
            rules: {
                enquiry: {
                    required: true,
                },
            },
            submitHandler: function(form) { // for demo
                alert('valid form submitted'); // for demo
                return false; // for demo
            }
        });


        function resetData() {
            $('#saveEnq').removeClass('d-none');
            $('#exampleModalLabel').text('ADD NEW REQUEST');
        }

        function getBromiEnq(data) {
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.showEnquiry') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    $('#enquiry').val(data.brom_enq.enquiry);
                    $('#requestModal').modal('show');
                    $('#saveEnq').addClass('d-none');
                    $('#exampleModalLabel').text('Your Request');
                }
            });
        }

        $(document).on('click', '#saveEnq', function(e) {
            e.preventDefault();
            $("#modal_form").validate();
            if (!$("#modal_form").valid()) {
                return
            }
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.saveEnquiry') }}",
                data: {
                    enquiry: $('#enquiry').val(),
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    $('#requestTable').DataTable().draw();
                    $('#requestModal').modal('hide');
                }, 
                error:function(error) {
                    console.log(error);
                    // Check if the error object contains responseJSON
                    if (error.responseJSON) {
                        // Retrieve the error message from responseJSON
                        var errorMessage = 'Something went wrong!';
                        // Display or handle the error message as needed
                        $('#em_err').remove();
                        $('#enquiry').after('<span class="text-danger" id="em_err">' + errorMessage + '</span>');
                        console.log(errorMessage);
                    }
                }
            });
        })
    </script>
@endpush
