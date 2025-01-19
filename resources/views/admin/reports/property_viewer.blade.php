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
                            <h5 class="mb-3">Property Viewer <a class="btn custom-icon-theme-button tooltip-btn"
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
                                            <th>Employee Name</th>
                                            <th>Visited On </th>
                                            <th>Area Name</th>
                                            <th>Building Name</th>
                                            <th>Wing/Unit Name</th>
                                            <th>Property For</th>
                                            <th>Status</th>
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
                        url: "{{ route('admin.reports.viewer') }}",
                        data: function(d) {

                        },
                    },
                    columns: [{
                            data: 'visited_by',
                            name: 'visited_by'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'area',
                            name: 'area'
                        },
                        {
                            data: 'building',
                            name: 'building'
                        },
                        {
                            data: 'wing',
                            name: 'wing'
                        },
                        {
                            data: 'propertyfor',
                            name: 'propertyfor'
                        },
                        {
                            data: 'property_status',
                            name: 'property_status'
                        },
                    ]
                });
            });
        </script>
    @endpush
