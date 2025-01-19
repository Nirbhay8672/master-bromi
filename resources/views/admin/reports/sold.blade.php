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
                            <h5 class="mb-3">Property Sold / Rent Report <a class="btn custom-icon-theme-button tooltip-btn"
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
                                            <th>Name</th>
                                            <th>Area</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>DOE</th>
                                            <th>Closure Date</th>
                                            <th>Closure Days</th>
                                            <th>Closed By</th>
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
                        url: "{{ route('admin.reports.sold') }}",
                        data: function(d) {

                        },
                    },
                    columns: [{
                            data: 'building_id',
                            name: 'building_id'
                        },
                        {
                            data: 'areas',
                            name: 'areas'
                        },
                        {
                            data: 'budget_to',
                            name: 'budget_to'
                        },
                        {
                            data: 'enquiry_for',
                            name: 'enquiry_for'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'closure_date',
                            name: 'closure_date'
                        },
                        {
                            data: 'closure_days',
                            name: 'closure_days'
                        },
                        {
                            data: 'employee_id',
                            name: 'employee_id'
                        },
                    ]
                });
            });
        </script>
    @endpush
