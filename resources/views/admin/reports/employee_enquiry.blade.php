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
                            <h5 class="mb-3">Employee By Enquiry <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.reports') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>

                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="display" id="reportTable">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
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



                $('#reportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.report.employee.enquiry') }}",
                        data: function(d) {
                            // d.filter_date_from = $('#filter_date_from').val();
                            // d.filter_date_to = $('#filter_date_to').val();
                            // d.employee_id = $('#employee_id').val();
                            // d.filter_prime = Number($('#filter_prime').prop('checked'));
                            // d.filter_hot = Number($('#filter_hot').prop('checked'));
                        },
                    },
                    columns: [{
                            data: 'employee',
                            name: 'employee'
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
            });
        </script>
    @endpush
