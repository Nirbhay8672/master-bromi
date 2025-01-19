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
                            <h5 class="mb-3">Employee Performance <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.reports') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="employee_performance">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Total Property</th>
                                            <th>Total Enquiry</th>
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
                $('#employee_performance').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.employee.performance') }}",
                        data: function(d) {

                        },
                    },
                    columns: [{
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'total_property',
                            name: 'total_property'
                        },
                        {
                            data: 'total_enquiry',
                            name: 'total_enquiry'
                        }
                    ]
                });
            });
        </script>
    @endpush
