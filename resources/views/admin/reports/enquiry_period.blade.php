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
                            <h5 class="mb-3">Enquiry By Period <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.reports') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <div class="row">
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="month_id">
                                        <option value=""> Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May </option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="year_id">
                                        <option value="">Year</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="display" id="reportTable">
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>New Enquiry</th>
                                            <th>Confirmed Enquiry</th>
                                            <th>Site Visit Scheduled</th>
                                            <th>Site Visit Completed</th>
                                            <th>Discussion</th>
                                            <th>Booked</th>
                                            <th>Lost</th>
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
            $(document).ready(function() {

                $(document).on('click', '#filtersearch', function(e) {
                    e.preventDefault();
                    $('#resetfilter').show();
                    $('#reportTable').DataTable().draw();
                    $('#filtermodal').modal('hide');
                });

                $(document).on('click', '#resetfilter', function(e) {
                    e.preventDefault();
                    $(this).hide();
                    $('#filter_form').trigger("reset");
                    $('#reportTable').DataTable().draw();
                    $('#filtermodal').modal('hide');
                    triggerResetFilter()
                });




                $('#reportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.reports.enquiry.period') }}",
                        data: function(d) {
                            d.month_id = $('#month_id').val();
                            d.year_id = $('#year_id').val();
                        },
                    },
                    columns: [{
                            data: 'period',
                            name: 'period'
                        },
                        {
                            data: 'new_enquiry',
                            name: 'new_enquiry'
                        },
                        {
                            data: 'confirmed_enquiry',
                            name: 'confirmed_enquiry'
                        },
                        {
                            data: 'site_visit_scheduled',
                            name: 'site_visit_scheduled'
                        },
                        {
                            data: 'site_visit_completed',
                            name: 'site_visit_completed'
                        },
                        {
                            data: 'discussion',
                            name: 'discussion'
                        },
                        {
                            data: 'booked',
                            name: 'booked'
                        },
                        {
                            data: 'lost',
                            name: 'lost'
                        },
                    ]
                });

                $(document).on('change', '#year_id,#month_id',
                    function(e) {
                        $('#reportTable').DataTable().draw();
                    })
            });
        </script>
    @endpush
