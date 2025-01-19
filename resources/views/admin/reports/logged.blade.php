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
                            <h5 class="mb-3">Logged In Person Report <a class="btn custom-icon-theme-button tooltip-btn"
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
                                            <th>Login Id</th>
                                            <th>Login DateTime</th>
                                            <th>Login Succeed</th>
                                            <th>Ip Address</th>
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
                        url: "{{ route('admin.report.logged') }}",
                        data: function(d) {

                        },
                    },
                    columns: [{
                            data: 'employee_id',
                            name: 'employee_id'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'succeed',
                            name: 'succeed'
                        },
                        {
                            data: 'ipaddress',
                            name: 'ipaddress'
                        },
                    ]
                });
            });
        </script>
    @endpush
