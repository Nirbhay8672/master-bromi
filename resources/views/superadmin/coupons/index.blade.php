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
                            <h5 class="mb-3">Coupons <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <button class="btn custom-icon-theme-button open_modal_with_this tooltip-btn" type="button"
                                data-bs-toggle="modal" data-bs-target="#couponModal" data-tooltip="Add Coupon"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="couponTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Discount Type</th>
                                            <th>Amount Off</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Is Active</th>
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
    <div class="modal fade" id="couponModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
                    <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                        <input type="hidden" name="this_data_id" id="this_data_id">
                        <div class="row">
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <input class="form-control" name="coupon_name" id="coupon_name" type="text"
                                    placeholder="Coupon Name" required="" autocomplete="off">
                                    <span class="text-danger invalid-error d-none" id="coupon_name_error">Coupon name is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <input class="form-control" name="coupon_code" id="coupon_code" type="text"
                                        placeholder="Coupon Code" required="" autocomplete="off">
                                    <span class="text-danger invalid-error d-none" id="coupon_code_error">Coupon code is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <select id="discount_type" class="form-control">
                                        <option value="">Select Discount Type</option>
                                        <option value="1">% off</option>
                                        <option value="2">Flat amount off</option>
                                    </select>
                                    <span class="text-danger invalid-error d-none" id="discount_type_error">Discount type is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <input class="form-control" name="amount_off" id="amount_off" type="text"
                                        placeholder="Value" required="" autocomplete="off">
                                    <span class="text-danger invalid-error d-none" id="amount_off_error">Amount is required.</span>
                                </div>
                            </div>
							<div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-20">
								<input class="form-check-input" id="status" type="checkbox" checked>
								<label class="form-check-label" for="status">Active</label>
							</div>
							<div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-20">
								<input class="form-check-input" id="one_time_use" type="checkbox">
								<label class="form-check-label" for="one_time_use">One Time Use</label>
							</div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5 m-b-10">
                                <span>Coupon Validate Range</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="form-group col-md-5 m-b-20">
                                    <div class="fname">
                                        <input class="form-control" name="date_from" id="date_from" type="date" required="" autocomplete="off">
                                        <span class="text-danger invalid-error d-none" id="date_from_error">Date from is required.</span>
                                    </div>
                                </div>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">To</span>
                                </div>
                                <div class="form-group col-md-5 m-b-20">
                                    <div class="fname">
                                        <input style="border: 1px solid black;" class="form-control" name="date_to" id="date_to" type="date" required="" autocomplete="off">
                                        <span class="text-danger invalid-error d-none" id="date_to_error">Date to required.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn custom-theme-button" id="saveCoupon">Save</button>
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
        function getCoupon(data) {
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.getCoupon') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    dataa = JSON.parse(data);
                    $('#this_data_id').val(dataa.id);
                    $('#coupon_name').val(dataa.name);
                    $('#coupon_code').val(dataa.code);
                    $('#amount_off').val(dataa.amount_off);
                    $('#discount_type').val(dataa.discount_type);
                    $('#date_from').val(dataa.date_from);
                    $('#date_to').val(dataa.date_to);
					$('#status').prop('checked', Number(dataa.status));
					$('#one_time_use').prop('checked', Number(dataa.one_time_use));
                    $('#couponModal').modal('show');
                }
            });
        }

        function deleteCoupon(data) {
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.deleteCoupon') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#couponTable').DataTable().draw();
                }
            });
        }

        function updateStatus(element, id) {

            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.update_coupon') }}",
                data: {
                    id: id,
                    status : element.checked ? 1 : 0,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#couponTable').DataTable().draw();
                }
            });
        }

        $(document).ready(function() {

            $('#discount_type').select2('destroy');
            
            $('#couponTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.coupons') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'discount_flag',
                        name: 'discount_flag'
                    },
                    {
                        data: 'amount_off',
                        name: 'amount_off'
                    },
                    {
                        data: 'date_from',
                        name: 'date_from'
                    },
                    {
                        data: 'date_to',
                        name: 'date_to'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions'
                    },
                ]
            });

            $(document).on('click', '#saveCoupon', function(e) {
                e.preventDefault();
                var id = $('#this_data_id').val()
                var features = [];

                let all_error = document.querySelectorAll('.invalid-error');

                all_error.forEach(element => {
                    element.classList.add('d-none');
                });

                let valid = true;

                if($('#coupon_name').val() == '') {
                    document.getElementById('coupon_name_error').classList.remove('d-none');
                    valid = false;
                }

                if($('#coupon_code').val() == '') {
                    document.getElementById('coupon_code_error').classList.remove('d-none');
                    valid = false;
                }

                if($('#amount_off').val() == '') {
                    document.getElementById('amount_off_error').classList.remove('d-none');
                    valid = false;
                }

                if($('#discount_type').val() == '') {
                    document.getElementById('discount_type_error').classList.remove('d-none');
                    valid = false;
                }

                if($('#date_from').val() == '') {
                    document.getElementById('date_from_error').classList.remove('d-none');
                    valid = false;
                }

                if($('#date_to').val() == '') {
                    document.getElementById('date_to_error').classList.remove('d-none');
                    valid = false;
                }

                if(valid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('superadmin.saveCoupon') }}",
                        data: {
                            id: id,
                            name: $('#coupon_name').val(),
                            code: $('#coupon_code').val(),
                            amount_off: $('#amount_off').val(),
                            discount_type: $('#discount_type').val(),
                            date_from: $('#date_from').val(),
                            date_to: $('#date_to').val(),
                            status: Number($('#status').prop('checked')),
                            one_time_use: Number($('#one_time_use').prop('checked')),
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(data) {
                            $('#couponTable').DataTable().draw();
                            $('#couponModal').modal('hide');
                        }
                    });
                }
            })
        });
    </script>
@endpush
