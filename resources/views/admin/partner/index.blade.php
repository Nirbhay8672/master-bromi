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
                            <h5 class="mb-3">Partners</h5>
                            <div class="col">
                                <button
                                    class="btn custom-icon-theme-button tooltip-btn"
                                    type="button"
                                    onclick="parentModal()"
                                    data-tooltip="Add Partner"
                                ><i class="fa fa-plus"></i></button>

                                {{-- <a  
                                    class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                    href="{{ route('admin.partnerRequest') }}"
                                    data-tooltip="Requests"
                                >
                                    <i class="fa fa-user-plus"></i>
                                </a> --}}
                                <a  
                                    class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                    href="{{ route('admin.userRequest') }}"
                                    data-tooltip="Partner Requests"
                                >
                                    <i class="fa fa-user-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="partnerTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px !important;">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox"
                                                        name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Partner Contact</th>
                                            <th>User Contact</th>
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
         <div class="modal fade" id="ParentModel" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <button class="btn btn-secondary" style="border-radius:5px;" id="saveSchedule" data-id="">find</button>
                                </div>
                            </div>
                        </form>
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
            // bharat partner
            function parentModal() {
                $('#err_partner').html('');
                $('#ParentModel').modal('show');
            }

            // Find User Partner
            function findUserRecords() {
                var partnerEmail = $("#partner_email").val();
                var partnerNumber = $("#partner_number").val();

                // validate
                if (!partnerEmail && !partnerNumber) {
                    $('#err_partner').html('Please add at least one field');
                    return;
                }
                $.ajax({
                    url: "{{ route('admin.findUser') }}",
                    method: "get",
                    data: {
                        partner_email: partnerEmail,
                        partner_number: partnerNumber
                    },
                    success: function(data) {
                        var tbody = $("#tBody");

                        tbody.empty();

                        data.forEach(function(user) {

                            var row = `<tr>
                                <td>${user.first_name} ${user.last_name}</td>
                                <td>${user.company_name}</td>
                                <td style="text-transform:none !important;">${user.email}</td>
                                <td><button class="btn btn-primary btn-sm add-partner-btn" data-user-id="${user.id}">Add Partner</button></td>
                            </tr>`;

                            tbody.append(row);
                        });
                        
                    },
                    error: function(xhr, status, error) {
                        console.log("errr ", error);
                    }
                });
            }

            // Add Partner Store DB
            function addPartnerToDB(userId) {
                console.log("user id", userId);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.addPartner') }}",
                    method: "post",
                    data: {
                        user_id: userId,
                        _token: csrfToken,
                    },
                    success: function(response) {
                        if (response.status === 'sucess') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Partner added successfully',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.href = "{{ route('admin.partner.index') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred during the AJAX request',
                        });
                    }
                });
            }

            $(document).ready(function() {
                $("#saveSchedule").on("click", function(e) {
                    e.preventDefault();
                    $('#err_partner').html('');
                    findUserRecords();
                });

                // Event listener for the "Add Partner" buttons
                $("#tBody").on("click", ".add-partner-btn", function() {
                    var userId = $(this).data("user-id");
                    addPartnerToDB(userId);
                });

                // close button
                $("#btnClose").click(function() {
                    var elementID = $(this).attr("id");
                    $("#partner_email").val() = "";
                    $("#partner_number").val() = '';
                });
            });

            // Index View Partner Data
            $('#partnerTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('admin.partner.index') }}",
                    data: function(d) {
                        console.log("ddddddd", d);
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false
                    }, {
                        data: 'partner_name',
                        name: 'partner_id'
                    }, {
                        data: 'company_name',
                        name: 'company_name'
                    }, {
                        data: 'partner_email',
                        name: 'email'
                    }, {
                        data: 'partner_number',
                        name: 'mobile_no'
                    }, {
                        data: 'user_number',
                        name: 'user_number'
                    },
                    //  {
                    //     data: 'status',
                    //     name: 'status'
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                "order":  [[ 1, "asc"]],
                columnDefs: [{
                        "width": "2%",
                        "targets": 0
                    },
                    {
                        "width": "18%",
                        "targets": 1
                    },
                    {
                        "width": "15%",
                        "targets": 2
                    },
                    {
                        "width": "5%",
                        "targets": 3
                    },
                    {
                        "width": "15%",
                        "targets": 4
                    },
                    {
                        "width": "15%",
                        "targets": 5
                    },
                    {
                        "width": "15%",
                        "targets": 6
                    }, {
                        "width": "15%",
                        "targets": 6
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


            // Delete Partner
            function deletePartner(data) {
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
                                $('#partnerTable').DataTable().draw();
                            }
                        });
                    }
                })

            }
        </script>
    @endpush
