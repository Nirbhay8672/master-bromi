@extends('superadmin.layouts.superapp')
@section('content')
<style>
    td {
        height: 37px !important;
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
                        <h5 class="mb-3">Tickets</h5>
                    </div>
                    <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 col-lg-2 col-md-2">
                            <select
                                id="filter_category"
                                class="form-control"
                                style="border: 1px solid black;"
                                onchange="updateFilter()"
                            >
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-lg-2 col-md-2">
                            <select
                                id="filter_status"
                                class="form-control"
                                style="border: 1px solid black;"
                                onchange="updateFilter()"
                            >
                                <option value="">-- Select Status --</option>
                                <option value="Open">Open</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div id="builderTable_wrapper" class="dataTables_wrapper no-footer">
                            <table class="display" id="ticketTable">
                                <thead>
                                    <tr role="row">
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Username</th>
                                        <th>City</th>
                                        <th>Attachment</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
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
            $(document).ready(function() {
                $('#ticketTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('superadmin.tickets') }}",
                        data: function(d) {
                            d.filter_category = $("#filter_category").val();
                            d.filter_status = $("#filter_status").val();
                        }
                    },
                    columns: [{
                            data: 'category_name',
                            name: 'category_name'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'ticket_status',
                            name: 'ticket_status'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name'
                        },
                        {
                            data: 'city_name',
                            name: 'city_name'
                        },
                        {
                            data: 'attachement',
                            name: 'attachement'
                        },
                        {
                            data: 'updated_at_format',
                            name: 'updated_at_format'
                        },
                        {
                            data: 'Actions',
                            name: 'Actions'
                        },
                    ],
                });
            });
        });

        function updateFilter() {
            $('#ticketTable').DataTable().draw();
        }

        function closeTicket() {

            let id = event.target.dataset.abc;
            let url = "{{ url('superadmin/close_ticket/ticket_id') }}";
            let newStr = url.replace("ticket_id", id);

            event.target.classList.add('d-none');

            $.ajax({
                type: "POST",
                url: newStr,
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#ticketTable').DataTable().draw();
                }
            });
        }
    </script>
@endpush
