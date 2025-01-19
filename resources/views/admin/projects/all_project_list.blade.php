@extends('admin.layouts.app')
@section('content')
    <style>
        tr {
            height: 50px;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">All Projects</h5>
                            <div class="row">
                                <div class="col-2">
                                    <select
                                        name="area"
                                        id="area"
                                        class="form-control"
                                        style="border: 2px solid black;"
                                        onchange="changeArea()"
                                    >
                                        <option value="">All Area</option>
                                        @foreach($all_areas as $area)
                                            <option value="{{ $area['id'] }}">{{ $area['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="projectTable">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Builder Name</th>
                                            <th>Address</th>
                                            <th>Property Type</th>
                                            <th>City</th>
                                            <th>Area</th>
                                            <th>Remark</th>
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

            function changeArea() {
                $('#projectTable').DataTable().draw();
            }
            
            $(document).ready(function() {
                $('#projectTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.all-projects') }}",
                        data: function(d) {
                            d.filter_area = $('#area').val();
                        },
                    },
                    columns: [
                        { 
                            data: "project_name",
                            name: 'project_name',
                            render : function ( data, type, row, meta ) {
                                let project_data = row;
                                
                                if(project_data.is_indirectly_store > 0) {
                                    return `<span style="cursor: pointer;" title="View after fill all data">${data}</span>`;
                                } else {
                                    var url = '{{ route("admin.viewProject", ":id") }}';
                                    url = url.replace(':id', project_data.id);
                                    return `<a href="${url}">${data}</a>`;    
                                }
                                
                            }
                        },
                        {
                            data: 'builder_name',
                            name: 'builder_name'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'property_type',
                            name: 'property_type'
                        },
                        {
                            data: 'city_name',
                            name: 'city_name'
                        },
                        {
                            data: 'area_name',
                            name: 'area_name'
                        },
                        {
                            data: 'remark',
                            name: 'remark'
                        },
                    ],
                });
            });
        </script>
    @endpush
