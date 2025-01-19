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
                            <h5 class="mb-3">Project vise unit</h5>
                            <div class="row">
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" name="project_id" id="project_id">
                                        <option value=""> Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="propertyTable">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Property For </th>
                                            <th>Wing </th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Furnished Status</th>
                                            <th>Contact</th>
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
                $('#propertyTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: "{{ route('admin.project.byunit') }}",
                        data: function(d) {
                            d.project_id = $('#project_id').val();
                        },
                    },
                    columns: [{
                            data: 'project',
                            name: 'project',
                        },
						 {
                            data: 'property_for',
                            name: 'property_for',
                        },
						{
                            data: 'wing',
                            name: 'wing',
                        },
                        {
                            data: 'unit',
                            name: 'unit'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'fstatus',
                            name: 'fstatus'
                        },
                        {
                            data: 'contact',
                            name: 'contact'
                        },
                    ],
                    columnDefs: [{
                        className: 'text-center',
                        targets: [0, 1, 2, 3, 4]
                    }, ]
                });

                $(document).on('change', '#project_id', function(e) {
                    $('#propertyTable').DataTable().draw();
                })

            });
        </script>
    @endpush
