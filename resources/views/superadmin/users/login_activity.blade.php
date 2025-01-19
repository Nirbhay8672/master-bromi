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
                        <h5 class="mb-3">Users Login Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="userTable">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>IP Address</th>
                                        <th>Login At</th>
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
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('superadmin.usersLoginActivity') }}",
            columns: [{
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'ip_address',
                    name: 'ip_address',
                },
                {
                    data: 'date_time',
                    name: 'date_time',
                },
            ]
        });
    });
</script>
@endpush
