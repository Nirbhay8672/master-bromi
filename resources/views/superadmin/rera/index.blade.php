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
                            <h5 class="mb-3">Rera Project Listing </h5>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="reraTable">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Promoter</th>
                                            <th>Reg No.</th>
                                            <th>District</th>
                                            <th>State</th>
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
            $('#reraTable').DataTable({
				searchDelay: 350,
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.rera') }}",
                columns: [{
                        data: 'project_name',
                        name: 'project_name'
                    },
                    {
                        data: 'promoter_name',
                        name: 'promoter_name'
                    },
                    {
                        data: 'reg_no',
                        name: 'reg_no'
                    },

                    {
                        data: 'district',
                        name: 'district'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                ]
            });


        });
    </script>
@endpush
