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

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="cityTable">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Activity</th>
											<th>Subject</th>
                                            <th>Date</th>
											<th>Now</th>
                                            <th>Old</th>
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
                $('#cityTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: "{{ route('admin.logs') }}",
                    columns: [{
                            data: 'user',
                            name: 'user'
                        },
                        {
                            data: 'activity',
                            name: 'activity'
                        },{
                            data: 'subject',
                            name: 'subject'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },{
                            data: 'new',
                            name: 'new'
                        },
                        {
                            data: 'old',
                            name: 'old'
                        },
                    ],
                    "order":  [[ 1, "asc"]],
                });
            });


        </script>
    @endpush
