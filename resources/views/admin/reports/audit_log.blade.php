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
                            <h5 class="mb-3">Employee Audit Log <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.reports') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
							<div class="row">
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <label for="filter_date_from">From:</label>
                                    <div class="input-group">
                                        <input class="form-control " id="filter_date_from" type="date"
                                            data-language="en">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <label for="filter_date_to">To:</label>
                                    <div class="input-group">
                                        <input class="form-control " id="filter_date_to" type="date"
                                            data-language="en">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
									<Label> Employee:</Label>
                                    <select class="form-select" id="employee_id">
                                        <option value=""> Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
								<div class="form-check checkbox  checkbox-solid-success mt-3 col-md-1 m-b-20">
									<input class="form-check-input" id="filter_prime" type="checkbox">
									<label class="form-check-label" for="filter_prime">Prime</label>
								</div>
								<div class="form-check checkbox  checkbox-solid-success mt-3 col-md-1 m-b-20">
									<input class="form-check-input" id="filter_hot" type="checkbox">
									<label class="form-check-label" for="filter_hot">Hot</label>
								</div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="display" id="reportTable">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            <th>Property Added</th>
                                            <th>Property Updated</th>
                                            <th>Property Deleted</th>
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

				$(document).on('change', '#filter_date_from,#filter_date_to,#employee_id,#filter_prime,#filter_hot', function(e) {
					$('#reportTable').DataTable().draw();
				})

                $('#reportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.report.employee.audit') }}",
                        data: function(d) {
                            d.filter_date_from = $('#filter_date_from').val();
							d.filter_date_to = $('#filter_date_to').val();
							d.employee_id = $('#employee_id').val();
							d.filter_prime = Number($('#filter_prime').prop('checked'));
							d.filter_hot = Number($('#filter_hot').prop('checked'));
                        },
                    },
                    columns: [{
                            data: 'action_by',
                            name: 'action_by'
                        },
                        {
                            data: 'added',
                            name: 'added'
                        },
                        {
                            data: 'updated',
                            name: 'updated'
                        },
                        {
                            data: 'deleted',
                            name: 'deleted'
                        },
                    ]
                });
            });
        </script>
    @endpush
