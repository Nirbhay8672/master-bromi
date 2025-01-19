<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bromi ~ Property Management System">
    <meta name="keywords"
        content="">
    <meta name="author" content="Mr.Web">
    <link rel="icon" href="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" type="image/x-icon">
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

    <style>
        .custom-input-border {
            border: 1px solid blue;
        }
    </style>
</head>

<body>
    <!-- login page start-->
    <section> </section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" style="width: 450px !important;" method="post" action="{{ route('admin.login') }}">
						<img height="150" width="150" class="mainLogo" src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" alt="">
						@csrf
                        <h4>Login</h4>
                        <h6>We are happy to see you again!</h6>
                        @if (session('warning'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ session('warning') }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))  
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('registration_success'))  
                            <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if (session('inactive_user'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ session('inactive_user') }}</strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control custom-input-border" value="{{ old('email') }}" name="email" type="email"
                                    required="" placeholder="Enter Email Address" @error('email') is-invalid @enderror
                                    autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control custom-input-border" type="password" name="password"
                                    @error('password') is-invalid @enderror required="" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" style="border-radius: 5px;" type="submit">Sign in</button>
                        </div>
						<div class="form-group">
    							<a href="{{route('admin.forgotpassword')}}" class="forgot-password-link">Forgot Password?</a>
						</div>
						<p>Don't have an account?<a class="ms-2" href="{{route('admin.register')}}">Create Account</a></p>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="{{ asset('admins/assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>
