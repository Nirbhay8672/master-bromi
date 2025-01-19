@extends('admin.layouts.app')
@section('content')
    <div class="page-body" x-data="integration">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="container-fluid general-widget">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a data-bs-toggle="modal" data-bs-target="#cityModal" @click="reset()">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Bulk Email</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a data-bs-toggle="modal" data-bs-target="#bulksMS">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Bulk SMS</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{route('admin.email.index')}}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary"> Email template</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{route('admin.smsemail.index')}}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary"> SMS Template</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- EMAIL MODEL -->
        <div class="modal fade" id="cityModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <template x-if="email_bulk_array.length == 0">
                            <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
                        </template>
                        <template x-if="email_bulk_array.length > 0">
                            <h5 class="modal-title" id="exampleModalLabel">Plan Details</h5>
                        </template>
                        <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" x-show="email_bulk_array.length == 0">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                            <div class="form-row">
                                <span id="error" class="text-danger"></span>
                                <div class="form-group col-md-12 d-inline-block m-b-5">
                                    <label for="Email">Email</label>
                                    <input class="form-control" name="email" id="email" type="email" required="" autocomplete="off">
                                </div>
                                <span id="email_error" class="text-danger"></span>
                                <div class="form-group col-md-12 d-inline-block m-b-5 mt-3">
                                    <label for="City">Password</label>
                                    <input class="form-control" name="password" id="password" type="text" required="" autocomplete="off">
                                </div>
                                <span id="password_error" class="text-danger"></span>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button mt-3" id="saveCity">Save</button>
                                <button class="btn btn-primary mt-3 ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                    @if(count($email_bulk) > 0)
                    <template x-if="email_bulk_array.length > 0">
                        <div class="modal-body">
                            <p><strong>User name : </strong> {{ $email_bulk[0]->user_name }}</p>
                            <p><strong>Email : </strong> {{ $email_bulk[0]->email }}</p>
                            <p><strong>Email Balance : </strong> {{ $email_bulk[0]->email_balance }}</p>
                            <p><strong>Plan Expire : </strong> {{ $email_bulk[0]->expired_date }}</p>

                            <div class="text-center">
                                <button class="btn btn-primary" style="border-radius: 5px;" @click="chnageEmail">Change Account</button>
                            </div>
                        </div>
                    </template>
                    @endif
                </div>
            </div>
        </div>

        <!-- bulksMS MODEL -->
        <div class="modal fade" id="bulksMS" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
                        <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                            <div class="form-row">
                                <div class="form-group col-md-12 d-inline-block m-b-20">
                                    <label for="Email">Email</label>
                                    <input class="form-control" name="email" id="email" type="email" required="" autocomplete="off">
                                </div>
                                <div class="form-group col-md-12 d-inline-block m-b-20">
                                    <label for="City">Password</label>
                                    <input class="form-control" name="password" id="password" type="text" required="" autocomplete="off">
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="saveMail">Send Mail</button>
                                <button class="btn btn-primary ms-3" type="button" style="border-radius: 5px;" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script type="text/javascript">

    document.addEventListener('alpine:init', () => {

        let email_bulk = @json($email_bulk);

        Alpine.data('integration', () => ({

            email_bulk_array : email_bulk,

            reset() {
                this.email_bulk_array = email_bulk;
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
                document.getElementById('error').innerHTML = '';
            },

            chnageEmail() {
                this.email_bulk_array = [];
            }
        }));
    });

</script>

<script>
    $(document).ready(function() {
        $('#saveCity').click(function(e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            document.getElementById('email_error').innerHTML = '';
            document.getElementById('password_error').innerHTML = '';

            let valid = ( email != '' &&  password != '');

            if(!valid) {
                if(email == '') {
                    document.getElementById('email_error').innerHTML = 'Email is required.';
                }

                if(password == '') {
                    document.getElementById('password_error').innerHTML = 'Password is required.';
                }

                return;
            }

            $.ajax({
                url: "{{ route('admin.integrationemaildataget') }}",
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#cityModal').modal('hide');
					$('#sendmail').modal('hide');
                    document.getElementById('email').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('error').innerHTML = '';
				},
                error: function(response) {
                    document.getElementById('error').innerHTML = 'Somthing is wrong.';
                }
            });
        });
    });
    
        $(document).ready(function() {
        $('#bulksMS').click(function(e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: "#",
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
            		console.log(response);
                    $('#cityModal').modal('hide');
					$('#sendmail').modal('show');
				},
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
    
    


	$(document).ready(function() {
        $('#saveMail').click(function(e) {
            e.preventDefault();

            var email = 'rajan@gmail.com';
            var apiKey = '1234567';
			var password = '1234567'

            $.ajax({
                url: "{{ route('admin.integrationemailsendmailform') }}",
                method: 'POST',
                data: {
                    email: email,
                    password: password,
					apiKey: apiKey,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
            		console.log(response);
                    $('#cityModal').modal('hide');
					$('#sendmail').modal('show');
				},
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


@endsection
@push('scripts')
    <script></script>
@endpush
