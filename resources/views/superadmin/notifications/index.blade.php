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
                            <h5 class="mb-3">Notifications </h5>
                            <button class="btn custom-icon-theme-button open_modal_with_this tooltip-btn" type="button"
                                data-bs-toggle="modal" data-bs-target="#notificationModal" data-tooltip="Add Notification"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="notificationTable">
                                    <thead>
                                        <tr>
                                            <th>Notification</th>
                                            <th>Status</th>
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
    <div class="modal fade" id="notificationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Notification</h5>
                    <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                        <input type="hidden" name="this_data_id" id="this_data_id">
                        <div class="row">
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <label for="notification">Notification</label>
                                    <input class="form-control" name="notification" id="notification" type="text" required="" autocomplete="off">
                                </div>
                            </div>
                             <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <input class="form-control" name="date" id="date" type="date"
                                    placeholder="Date" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <input class="form-control" name="time" id="time" type="time"
                                    placeholder="Time" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <div class="state-box">
                                        <select name="state" id="state" class="form-control" required>
                                            <option value="">Selecte State</option>
                                            @foreach ($states as $state )
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 m-b-20">
                                <div class="fname">
                                    <div class="city-box">
                                        <select name="city" id="city" class="form-control" required>
                                            <option value="">Selecte City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
								<input class="form-check-input" id="status" type="checkbox">
								<label class="form-check-label" for="status">Active</label>
							</div>
                        </div>
                        <div class="text-center">
                            <button class="btn custom-theme-button" id="saveNotification">Save</button>
                            <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function getNotification(data) {
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.getNotification') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    dataa = JSON.parse(data);
                    let sch = ['', ''];
                    if (dataa.schedule_date) {
                        sch = dataa.schedule_date.split(' ');
                    }
                    $('#this_data_id').val(dataa.id);
                    $('#notification').val(dataa.message).trigger('change');
					$('#status').prop('checked', Number(dataa.status));
                    $('#date').val(sch[0]);
                    $('#time').val(sch[1]);
                    $('#state').val(dataa.state).trigger('change');
                    $('#city').append(new Option(dataa.city?.name ?? '', dataa.city?.id ?? ''));
                    $('#city').val(dataa.city?.id ?? '').trigger('change');
                    $('#notificationModal').modal('show');
                    $('#notificationModal').on('shown.bs.modal', function () {
                        $('#city').val(dataa.city?.id ?? '').trigger('change');
                    });
                }
            });
        }

        function deleteNotification(data) {
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.deleteNotification') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#notificationTable').DataTable().draw();
                }
            });
        }

        $(document).ready(function() {
            $('#notificationTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.notifications') }}",
                columns: [{
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions'
                    },
                ]
            });

            $(document).on('click', '#saveNotification', function(e) {
                e.preventDefault();
                var id = $('#this_data_id').val()
                var features = [];
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.saveNotification') }}",
                    data: {
                        id: id,
                        message: $('#notification').val(),
                        schedule_date: $('#date').val() +' '+ $('#time').val(),
						state: $('#state').val(),
						city: $('#city').val(),
						status: Number($('#status').prop('checked')),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {

                        if (data.error) {
                            Swal.fire(
                                'Error',
                                'Notification not updated! <br/> Message, Schedule date and city are required.',
                                'danger'
                            )
                            return;
                        }
                        
                        $('#notificationTable').DataTable().draw();
                        $('#notificationModal').modal('hide');
                    }
                });
            })

        });
        
        // bind the event after the modal is shown
        $('#notificationModal').on('shown.bs.modal', function () {
            $(document).on('change', '#state', function(e) {
                var stateId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.cityByState') }}",
                    data: {
                        id: stateId,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#city').html('');
                        $('#city').html(data.data);
                    }
                });
            })
        });
    </script>
@endpush
