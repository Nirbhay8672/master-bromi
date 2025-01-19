@extends('admin.layouts.app')
@section('content')
    <div class="page-body">
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
                            <a data-bs-toggle="modal" data-bs-target="#cityModal">
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
                            <a href="{{route('admin.email.index')}}">
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

    </div>



<!-- EMAIL MODEL -->
<div class="modal fade" id="cityModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button class="btn btn-secondary" id="saveCity">Save</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- bulksMS MODEL -->
<div class="modal fade" id="bulksMS" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <a  class="btn btn-secondary" id="saveMail">Send Mail</a>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#saveCity').click(function(e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: "{{ route('admin.integrationemaildataget') }}",
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
            		console.log(response);
                    $('#cityModal').modal('hide');
					$('#sendmail').modal('hide');
				},
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
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
