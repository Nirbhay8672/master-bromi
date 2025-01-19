<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bromi ~ Property Management System">
    <meta name="keywords" content="">
    <meta name="author" content="Mr.Web">
    <link rel="icon" href="{{ asset('admins/assets/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admins/assets/images/logo/favicon.png') }}" type="image/x-icon">
    <title>Bromi ~ Property Management System</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('admins/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/responsive.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/select2.css') }}">
</head>

<body>
    <!-- login page start-->
    <section> </section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card h-auto">
                    <form class="theme-form login-form" method="post" action="{{ route('admin.register') }}">
                        <img height="150" width="150" class="mainLogo"
                            src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" alt="">
                        @csrf
                        <h4>Register</h4>
                        <h6>Be a part of our community today!</h6>
                        @if (session('error'))
                            <span class="text-danger"> {{ session('error') }}</span>
                        @endif
                        <span class="text-danger"> {{ session('error') }}</span>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" value="{{ old('first_name') }}" name="first_name"
                                        type="text" required="" placeholder="First Name"
                                        @error('first_name') is-invalid @enderror autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" value="{{ old('last_name') }}" name="last_name"
                                        type="text" required="" placeholder="Last Name"
                                        @error('last_name') is-invalid @enderror>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" value="{{ old('email') }}" name="email" type="email"
                                    required="" placeholder="E-mail Address" @error('email') is-invalid @enderror>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group"><span class="input-group-text"><i
                                        class="icon-mobile"></i></span>
                                <input class="form-control" value="{{ old('mobile_number') }}" name="mobile_number"
                                    type="text" required="" placeholder="Contact Number"
                                    @error('mobile_number') is-invalid @enderror>
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						<div class="form-group">
                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                            <input class="form-control" value="{{ old('company_name') }}" name="company_name"
                                type="text" required="" placeholder="Company Name"
                                @error('company_name') is-invalid @enderror autofocus>
                            @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						</div>
						<div class="form-group">
                            <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" value="{{ old('branch_id') }}" name="branch_id"
                                    type="text" required="" placeholder="Branch"
                                    @error('branch_id') is-invalid @enderror autofocus>
                                @error('branch_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
						</div>
                        <div class="row">
                            <div class="form-group col-md-6 m-b-4 mb-3">
                                <select class="form-select" name="state_id" id="state_id">
                                    <option value="">State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 m-b-4 mb-3">
                                <select class="form-select" name="city_id" id="city_id">
                                    <option value="">Cities</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password"
                                        @error('password') is-invalid @enderror required="" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        @error('password') is-invalid @enderror required=""
                                        placeholder="Confirm Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Register Now</button>
                        </div>
                        <p>Already have an account?<a class="ms-2" href="{{ route('admin.login') }}">Login Here</a>
                        </p>


                    </form>
                </div>
            </div>
        </div>
		@php
		$city_encoded = json_encode($cities);
		$state_encoded = json_encode($states);
	@endphp
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('admins/assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('admins/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('admins/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('admins/assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
	<script src="{{ asset('admins/assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
	<script>
		$('#state_id').select2();
		$('#city_id').select2();
		var cities = @Json($city_encoded);
                var states = @Json($state_encoded);

                $(document).on('change', '#state_id', function(e) {
                        $('#city_id').select2('destroy');
                        citiesar = JSON.parse(cities);
                        $('#city_id').html('');
                        for (let i = 0; i < citiesar.length; i++) {
                            if (citiesar[i]['state_id'] == $("#state_id").val()) {
                                $('#city_id').append('<option value="' + citiesar[i]['id'] + '">' + citiesar[i][
                                    'name'
                                ] + '</option>')
                            }
                        }
                        $('#city_id').select2();

                })
	</script>
</body>

</html>
