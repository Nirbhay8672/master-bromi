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

    <style>
        .custom-input-border {
            border: 1px solid blue;
        }

        .custom-select-border {
            border: 1px solid blue;
            border-bottom: none;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #e8e9ec !important;
            border-radius: 3px !important;
            height: 45px !important;
        }

        .select2-dropdown {
            border: 1px solid #e8e9ec !important;
        }
    </style>
</head>

<body>
    <!-- login page start-->
    <section> </section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card h-auto">
                    <form
                        class="theme-form login-form p-4"
                        action="{{ route('admin.storeUser') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <img height="150" width="150" class="mainLogo"
                            src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" alt="">
                        @csrf
                        <h4>Register</h4>
                        <h6>Be a part of our community today!</h6>
                        @if ($message = Session::get('error'))  
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('company_name') is-invalid @enderror"
                                        value="{{ old('company_name') }}"
                                        name="company_name"
                                        type="text"
                                        placeholder="Company Name"
                                        autocomplete="off"
                                        style="text-transform: capitalize;"
                                    >
                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <select
                                    class="@error('role_id') is-invalid @enderror"
                                    name="role_id"
                                    id="role_id"
                                >   
                                    <option value="">Account Created For</option>
                                    <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Agent</option>
                                    <option value="4" {{ old('role_id') == 4 ? 'selected' : '' }}>Builder</option>
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name') }}"
                                        name="first_name"
                                        type="text"
                                        placeholder="First Name"
                                        autofocus
                                        autocomplete="off"
                                        style="text-transform: capitalize;"
                                    >
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name') }}"
                                        name="last_name"
                                        type="text"
                                        placeholder="Last Name"
                                        autocomplete="off"
                                        style="text-transform: capitalize;"
                                    >
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        name="email"
                                        type="email"
                                        placeholder="E-mail Address"
                                        autocomplete="off"
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text">
                                    <i class="icon-mobile"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('mobile_number') is-invalid @enderror"
                                        value="{{ old('mobile_number') }}"
                                        name="mobile_number"
                                        type="text"
                                        placeholder="Contact Number"
                                        autocomplete="off"
                                    >
                                    @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 m-b-4 mb-3">
                                <select
                                    class="form-select custom-input-border @error('state_id') is-invalid @enderror"
                                    name="state_id"
                                    id="state_id"
                                >
                                    <option value="" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                        @if ($state['user_id'] == 6)
                                            <option
                                                value="{{ $state['id'] }}"
                                                {{ old('state_id') == $state['id'] ? 'selected' : ''}}
                                            >{{ $state['name']  }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 m-b-4 mb-3">
                                <select
                                    class="form-select custom-input-border @error('state_id') is-invalid @enderror"
                                    name="city_id"
                                    id="city_id"
                                >
                                    <option value="" disabled selected>Select City</option>
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('password') is-invalid @enderror"
                                        type="password"
                                        name="password"
                                        value=""
                                        placeholder="Password"
                                        autocomplete="off"
                                    >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input
                                        class="form-control custom-input-border @error('password_confirmation') is-invalid @enderror"
                                        type="password"
                                        value=""
                                        name="password_confirmation"
                                        placeholder="Confirm Password"
                                        autocomplete="off"
                                    >
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" style="border-radius: 5px;" type="submit">Register Now</button>
                        </div>
                        <p>Already have an account ?<a class="ms-2" href="{{ route('admin.login') }}">Login Here</a>
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
		$('#role_id').select2();
		var cities = @Json($city_encoded);
        var states = @Json($state_encoded);

        $(document).on('change', '#state_id', function(e) {
            $('#city_id').select2('destroy');
            citiesar = JSON.parse(cities);

            let new_array = [];

            citiesar.forEach(element => {
                let result = new_array.filter(city => city.name == element.name);

                if(result.length == 0) {
                    new_array.push(element);
                }
            });

            $('#city_id').html('');
            $('#city_id').append('<option value="" disabled selected>Select City</option>');

            for (let i = 0; i < new_array.length; i++) {
                if (new_array[i]['state_id'] == $("#state_id").val()) {
                    $('#city_id').append('<option value="' + new_array[i]['id'] + '">' + new_array[i][
                        'name'
                    ] + '</option>')
                }
            }
            $('#city_id').select2();
        })

	</script>
</body>

</html>
