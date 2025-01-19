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
                            <h5 class="mb-3">Notifications</h5>


                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="display" id="notiTable">
                                    <thead>
                                        <tr>
                                            <th>Notification</th>
                                            <th>Date</th>
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


                $('#notiTable').DataTable({
                    processing: true,
                    serverSide: true,
				    ordering: false,
                    ajax: {
                        url: "{{ route('admin.notifications') }}",
                    },
                    columns: [{
                            data: 'notification',
                            name: 'notification'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ],
                    "order":  [[ 1, "asc"]],
                });
            });
        </script>
    @endpush
