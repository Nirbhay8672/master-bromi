@extends('superadmin.layouts.superapp')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">

            </div>
        </div>
    </div>
    <div class="modal fade" id="dateRangeModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Custom Filter</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-5">
                        <div class="col-5">
                            <div class="fname">
                                <input type="date" class="form-control" id="from_date" max="{{ now()->format('Y-m-d') }}">
                                <span id="from_date_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="text-center mt-2">
                                <i class="fa fa-arrow-right fs-4"></i>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="fname">
                                <input type="date" class="form-control" id="to_date" max="{{ now()->format('Y-m-d') }}">
                                <span id="to_date_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-secondary" style="border-radius: 5px;" onclick="filterWithDate()">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="row card-body">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="p-2 bd-highlight">
                        <div class="input-group" style="border: 1px solid black;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <select class="form-control custom-select" id="choose_date_range" style="border: 1px solid black;width: 200px;">
                                <option value="this_month" {{ $filter_value == 'this_month' ? 'selected' : ''}}>This Month</option>
                                <option value="today" {{ $filter_value == 'today' ? 'selected' : ''}}>Today</option>
                                <option value="yesterday" {{ $filter_value == 'yesterday' ? 'selected' : ''}}>Yesterday</option>
                                <option value="this_week" {{ $filter_value == 'this_week' ? 'selected' : ''}}>This Week</option>
                                <option value="last_month" {{ $filter_value == 'last_month' ? 'selected' : ''}}>Last Month</option>
                                <option value="3month" {{ $filter_value == '3month' ? 'selected' : ''}}>Last 3 Month</option>
                                <option value="6month" {{ $filter_value == '6month' ? 'selected' : ''}}>Last 6 Month</option>
                                <option value="yearly" {{ $filter_value == 'yearly' ? 'selected' : ''}}>Last 1 Year</option>
                                <option value="openModal" style="color: #333;font-weight: bold;min-height:100px;">
                                    Custom Date
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="daterangeModalElement" data-bs-toggle="modal" class="d-none" data-bs-target="#dateRangeModal" data-bs-original-title="" title="">Custom Date</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 col-sm-6">
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-light-green">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_active_users }}</h1>
                                <h3 class="mb-0">Total Active User</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-sm-6">
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-light-purpel">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_users }}</h1>
                                <h3 class="mb-0">Total User</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-sm-6">
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-light-orange">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_sub_users }}</h1>
                                <h3 class="mb-0">Total Sub Users</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-sm-6"> 
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-info">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_ex_users }}</h1>
                                <h3 class="mb-0">Total users</h3>
                                <small>Package expire in next month / next week</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-sm-6"> 
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-light-orange">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_builder }}</h1>
                                <h3 class="mb-0">Total Builders</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-md-6 col-lg-3 col-sm-6">
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-info">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_members }}</h1>
                                <h3 class="mb-0">Total Team Members</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-sm-6">
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-light-green">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_requests }}</h1>
                                <h3 class="mb-0">Total Bromi Requests</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-sm-6"> 
                <div class="card o-hidden" style="height: 150px;">
                    <div class="card-body bg-light-purpel">
                        <div class="media static-widget my-3">
                            <div class="media-body text-center">
                                <h1 class="font-roboto">{{ $total_projects }}</h1>
                                <h3 class="mb-0">Total Projects</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).on('change', '#choose_date_range', function() {
            var range = $(this).val();
            if(range != 'openModal') {
                if (range) {
                    window.location.href = "{{ route('superadmin') }}?date_range=" + range;
                }
            } else {
                let modalButton = document.getElementById('daterangeModalElement');
                modalButton.click();
            }
        });

        function filterWithDate() {
            let from = $('#from_date').val();
            let to = $('#to_date').val();

            let valid = true;

            $('#from_date_error').text("");
            $('#to_date_error').text("");

            if(from == '') {
                valid = false;
                $('#from_date_error').text("From date is required.");
            }

            if(to == '') {
                valid = false;
                $('#to_date_error').text("To date is required.");
            }

            if(to) {
                let date1 = new Date(from).getTime();
                let date2 = new Date(to).getTime();

                if (date1 >= date2) {
                    valid = false;
                    $('#to_date_error').text("To date must greater than from date.");
                }
            }

            if(valid) {
                window.location.href = "{{ route('superadmin') }}?from_date=" + from + "&to_date=" + to;
            }
        }

    </script>
@endpush
