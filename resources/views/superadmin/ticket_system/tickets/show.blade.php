@extends('superadmin.layouts.superapp')
@section('content')
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
                            <h5 class="mb-3">Comment <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.tickets') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-md-6 col-md-offset-1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            {{ $ticket->title }}
                                        </div>
                        
                                        <div class="panel-body">
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                        
                                            <div class="ticket-info">
                                                <p>{{ $ticket->message }}</p>
                                                <p>Category: {{ $ticket->category->name }}</p>
                                                <p>
                                                    @if ($ticket->status === 'Open')
                                                        Status: <span class="label label-success">{{ $ticket->status }}</span>
                                                    @else
                                                        Status: <span class="label label-danger">{{ $ticket->status }}</span>
                                                    @endif
                                                </p>
                                                <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                                            </div>
                        
                                        </div>
                                    </div>
                                    <hr>
                                    @include('superadmin.ticket_system.tickets.comments')
                                    <hr>
                                    @include('superadmin.ticket_system.tickets.reply')
                                </div>
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
        function query() {
            $('#query').modal('show');
        }
        function comment() {
            var id=  document.getElementsByTagName("a").value
           console.log(id);
        }
        function userActivate(user, status) {
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.changeUserStatus') }}",
                data: {
                    id: $(user).attr('data-id'),
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#userTable').DataTable().draw();
                }
            });
        }

        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.users') }}",
                columns: [{
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'plan',
                        name: 'plan'
                    },
                    {
                        data: 'users',
                        name: 'users'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions'
                    },
                ]
            });

        });


        $('#modal_form').validate({ // initialize the plugin
            rules: {
                first_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                }
            },
            submitHandler: function(form) { // for demo
                alert('valid form submitted'); // for demo
                return false; // for demo
            }
        });

        function getUser(data) {
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.getUser') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    dataa = JSON.parse(data);
                    $('#this_data_id').val(dataa.id)
                    $('#first_name').val(dataa.first_name)
                    $('#last_name').val(dataa.last_name)
                    $('#email').val(dataa.email)
                    $('#userModal').modal('show');
                }
            });
        }


        $(document).on('click', '#saveUser', function(e) {
            e.preventDefault();
            $("#modal_form").validate();
            if (!$("#modal_form").valid()) {
                return
            }
            var id = $('#this_data_id').val()
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.saveUser') }}",
                data: {
                    id: id,
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    $('#userTable').DataTable().draw();
                    $('#userModal').modal('hide');
                }
            });
        })
    </script>
@endpush
