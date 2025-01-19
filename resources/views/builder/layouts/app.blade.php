<!DOCTYPE html>
<html lang="en">
@php
$route = Route::getCurrentRoute()->getName();
$drops_form = Helper::get_drop_variables();
$notifications = Helper::get_notifications();
$enquiry_count = Helper::enquiry_counts();
Helper::set_default_measuerement();
@endphp
@if (!empty($drops_form))
@foreach ($drops_form as $key => $value)
@php $$key = $value @endphp
@endforeach
@endif

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bromi ~ Property Management System">
    <meta name="keywords" content="">
    <meta name="author" content="Mr.Web">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/select2.css') }}">

    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/whether-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/datatables.css') }}">

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('admins/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <link href="{{ asset('admins/assets/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admins/assets/css/custom.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <style>
    input:not([type]),
    input[type="text"] {
        text-transform: capitalize;
    }

    .fname .form-control {
        border: 2px solid #1d2848 !important;
        border-radius: 5px;
    }

    .fname label {
        margin-bottom: 0px;
        top: 10px;
        padding: 0px 5px;
        left: 8px;
    }

    .focused label {
        top: -9px;
        background-color: #ffffff;
        padding: 0px 5px;
    }

    .select2_label {
        margin-bottom: 0px !important;
    }

    .select2_label.selected {
        top: -13px;
        background-color: #ffffff;
        padding: 0px 5px;
        left: 20px;
    }

    .input-group input.form-control {
        border-right: 0px !important;
        border-bottom-right-radius: 0px;
        border-top-right-radius: 0px;
    }

    .input-group input#search_input {
        border-right: 2px solid #1d2848 !important;
    }

    .select2-container--default .select2-selection--single {
        border: 2px solid #1d2848 !important;
        border-radius: 5px;
    }

    .input-group .input-group-append .select2-container .select2-selection--single {
        height: 42px !important;
    }

    .input-group .input-group-append .select2 .select2-selection {
        border: 2px solid #1d2848 !important;
        border-radius: 5px;
        border-bottom-left-radius: 0px;
        border-top-left-radius: 0px;
    }

    .select2-container--default .select2-selection--multiple {
        border: 2px solid #1d2848 !important;
        border-radius: 5px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin: 6px 1px !important;
        padding: 1px 5px !important;
    }

    .selection .select2-selection .select2-search__field {
        padding: 7px 0px;
        margin-left: 4px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        margin-bottom: -6px;
    }

    .sticky-nav-menu-tab {
        position: sticky;
        top: 70px;
        z-index: 4;
        overflow: auto;
        background-color: #e8e9ec;
        padding: 10px 0px;
    }

    .bg-light-blue {
        background-color: #61ddff !important;
        color: #ffffff;
    }

    .bg-light-purpel {
        background-color: #eb3a56 !important;
        color: #ffffff;
    }

    .bg-light-green {
        background-color: #0bc466 !important;
        color: #ffffff;
    }

    .bg-light-orange {
        background-color: #f9ad5e !important;
        color: #ffffff;
    }

    .bg-dark-blue {
        background-color: #3e4ffd !important;
        color: #ffffff;
    }

    .ct-series-a .ct-area {
        fill: #000000 !important;
    }

    .ct-series-a .ct-point,
    .ct-series-a .ct-line,
    .ct-series-a .ct-bar,
    .ct-series-a .ct-slice-donut {
        stroke: #53b4c3 !important;
    }
    </style>
    @stack('page-css')
</head>

<body>
    <div class="loader-wrapper">
        <img src="{{ asset('admins/assets/images/bromi-loader.gif') }}" alt="" class="bromi-loader">
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href="{{ route('admin') }}">
                            <img class="img-fluid" src="" alt=""></a>
                    </div>
                    <div class="toggle-sidebar">
                        <div class="status_toggle sidebar-toggle d-flex">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="left-side-header col ps-0 d-none d-md-block">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.2753 2.71436C16.0029 2.71436 19.8363 6.54674 19.8363 11.2753C19.8363 16.0039 16.0029 19.8363 11.2753 19.8363C6.54674 19.8363 2.71436 16.0039 2.71436 11.2753C2.71436 6.54674 6.54674 2.71436 11.2753 2.71436Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.8987 18.4878C20.6778 18.4878 21.3092 19.1202 21.3092 19.8983C21.3092 20.6783 20.6778 21.3097 19.8987 21.3097C19.1197 21.3097 18.4873 20.6783 18.4873 19.8983C18.4873 19.1202 19.1197 18.4878 19.8987 18.4878Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </g>
                                </g>
                            </svg></span>
                        <input class="form-control" autocomplete="off" type="text" id="search_input" name="search_input"
                            placeholder="Search here.." aria-label="search" aria-describedby="basic-addon1">
                        <div class="position-absolute dropdown-search-list bg-white px-3">
                            <div id="result_container"></div>
                        </div>
                    </div>
                </div>

                <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
                            <div class="media profile-media">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li>
                                    <a href="{{ route('builder.logout') }}"><i data-feather="log-in"> </i>
                                        <span>Log out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template">
                    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
                </script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div>
                    <div class="logo-wrapper"><a href="{{ route('admin') }}"><img class="img-fluid for-light"
                                src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" alt=""><img
                                class="img-fluid for-dark" src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}"
                                alt=""></a>
                        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="{{ route('admin') }}"><img class="img-fluid"
                                src="../assets/images/logo-icon.png" alt=""></a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="{{ route('admin') }}"><img class="img-fluid"
                                            src="../assets/images/logo-icon.png" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i class="ps-2"
                                            aria-hidden="true"> </i></div>
                                </li>
                                <li class="sidebar-list"><a class="sidebar-link" href="{{ route('builder.projects') }}">
                                    <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/project.png"
                                        style="width: 20px;" alt="">
                                    <span class="lan-6">Projects</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            @yield('content')
            <!-- footer start-->

        </div>
        <div class="modal fade" id="sear_bar_modal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="serach_bar_body">
                        @csrf
                        <div class="container d-flex justify-content-center">
                            <div class="card mt-5 p-4">
                                <div class="input-group mb-3">
                                    <input type="text" id="search_input" name="search_input" placeholder="Search..."
                                        class="form-control">
                                    <div class="input-group-append"></div>
                                </div>
                                <span class="text mb-4"><span id="result_count">0</span> results</span>
                                <div id="result_container">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="drop_capital_gain_calculator" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Capital Gain Calculator</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <form action="" class="row">
                            <div class="form-group col-md-12 m-b-20 d-inline-block">
                                <div class="col-sm-12">
                                    <label for="Select Year"> Year</label>
                                </div>
                                <div class="col-12">
                                    <div class="m-checkbox-inline custom-radio-ml">
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="radio_year_1" type="radio"
                                                name="drop_capital_sale_year" value="2023_2024">
                                            <label class="form-check-label mb-0" for="radio_year_1">2023/24</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" type="radio" id="radio_year_2"
                                                name="drop_capital_sale_year" value="2022_2023">
                                            <label class="form-check-label mb-0" for="radio_year_2">2022/23</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="radio_year_3" type="radio"
                                                name="drop_capital_sale_year" value="2021_2022">
                                            <label class="form-check-label mb-0" for="radio_year_3">2021/22</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20 d-inline-block">
                                <label for="purchase_year" class="mb-0">Purchase Year</label>
                                <div class="input-group">
                                    <input class="form-control " id="drop_capital_purchase_date" type="date"
                                        data-language="en">
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-t-20 d-inline-block">
                                <label for="Purchase price">Purchase Price</label>
                                <input class="form-control" name="drop_capital_purchase_price"
                                    id="drop_capital_purchase_price" type="text" required="" autocomplete="off">
                            </div>

                            <div class="form-group col-md-4  m-t-20 d-inline-block">
                                <label for="Capital Gain">Sale Price</label>
                                <input class="form-control" name="drop_capital_sale_price" id="drop_capital_sale_price"
                                    type="text" required="" autocomplete="off">
                            </div>

                            <div class="form-group col-md-4 m-b-20 d-inline-block">
                                <div class="fname focused">
                                    <label for="Capital Gain">Aquisition index</label>
                                    <div class="fvalue">
                                        <input class="form-control" name="drop_capital_capital_gained"
                                            id="drop_capital_capital_gained" type="text" required="" autocomplete="off"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-b-20 d-inline-block">
                                <div class="fname focused">
                                    <label for="Capital Gain">Capital Gain</label>
                                    <div class="fvalue">
                                        <input class="form-control" name="drop_capital_final" id="drop_capital_final"
                                            type="text" required="" autocomplete="off" disabled>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="drop3_whole_unit_calculator" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Whole Unit Calculator</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="drop3_modal_form"
                            novalidate="">
                            <div>
                                <div class="row">
                                    <table class="bordered no-border">
                                        <thead>
                                            <th>Name</th>
                                            <th>SQFT</th>
                                            <th>Rs.</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Basic Plot</td>
                                                <td><input id="basic_sqft"></td>
                                                <td><input id="basic_rs"></td>
                                                <td id="basic_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Basic Construction</td>
                                                <td><input id="basic_construction_percent" placeholder="Percentage">
                                                </td>
                                                <td></td>
                                                <td id="basic_construction_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Registration Fee</td>
                                                <td><input id="registration_percent" placeholder="Percentage"></td>
                                                <td></td>
                                                <td id="registration_fee_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Stamp Duty</td>
                                                <td><input id="stamp_duty_sqft"></td>
                                                <td><input id="stamp_duty_rs"></td>
                                                <td id="stamp_duty_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Others</td>
                                                <td><input id="others_sqft"></td>
                                                <td><input id="others_rs"></td>
                                                <td id="others_total"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                                <td>total</td>
                                                <td id="groupa_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Other 1</td>
                                                <td><input id="other1_sqft"></td>
                                                <td><input id="other1_rs"></td>
                                                <td id="other1_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Other 2</td>
                                                <td><input id="other2_sqft"></td>
                                                <td><input id="other2_rs"></td>
                                                <td id="other2_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Maintanance</td>
                                                <td><input id="maintanance_sqft"></td>
                                                <td><input id="maintanance_rs"></td>
                                                <td id="maintanance_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Main Deposit</td>
                                                <td><input id="main_deposit_sqft"></td>
                                                <td><input id="main_deposit_rs"></td>
                                                <td id="main_deposit_total"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                                <td>total</td>
                                                <td id="groupb_total"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                            </tr>
                                            <tr>
                                                <td>Group A + Group B</td>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                                <td id="groupab_total"></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="drop4_emi_calculator" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Emi Calculator</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="drop4_modal_form"
                            novalidate="">
                            <div>
                                <div class="row">

                                    <div class="form-group col-md-8 m-b-10">
                                        <label for="Loan Amount">Amount</label>
                                        <div id="loan_amount_slider"></div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <h6>10000</h6>
                                            <h6>500000000</h6>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 m-b-10">
                                        <input class="form-control" name="drop4_loan" id="drop4_loan" type="text"
                                            required="" autocomplete="off" placeholder="Amount">
                                    </div>


                                    <div class="form-group col-md-8 m-b-10">
                                        <label for="percent slider">Interest Rate</label>
                                        <div id="loan_percent_slider"></div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <h6>1</h6>
                                            <h6>30</h6>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 m-b-10">
                                        <input class="form-control" name="drop_4_percentage" id="drop_4_percentage"
                                            type="text" required="" autocomplete="off" placeholder="Interest rate">
                                    </div>

                                    <div class="form-group col-md-8 m-b-10">
                                        <label for="month slider">Month</label>
                                        <div id="loan_month_slider"></div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <h6>1</h6>
                                            <h6>360</h6>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4 m-b-10">
                                        <input class="form-control" name="drop_4_tenure" id="drop_4_tenure" type="text"
                                            required="" autocomplete="off" placeholder="No. of Months">
                                    </div>

                                    <hr>
                                    <div class="form-group col-md-4 m-b-20">
                                        <p> Monthly Payment: <span id="monthly_payment"></span></p>
                                    </div>

                                    <div class="form-group col-md-4 m-b-20">
                                        <p> Total Payment: <span id="total_payment"></span></p>
                                    </div>

                                    <div class="form-group col-md-4 m-b-20">
                                        <p> Total Interest Cost: <span id="interest_cost"></span></p>
                                    </div>

                                    @dump(Auth::user())


                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.dropforms')
        <!-- latest jquery-->
        <script src="{{ asset('admins/assets/js/jquery-3.5.1.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('admins/assets/js/jquery.ui.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <script src="{{ asset('admins/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admins/assets/js/fullscreen.js') }}"></script>

        <!-- feather icon js-->
        <script src="{{ asset('admins/assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('admins/assets/js/sweetalert.js') }}"></script>

        <script src="{{ asset('admins/assets/js/icons/feather-icon/feather.min.js') }}"></script>

        <script src="{{ asset('admins/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
        <!-- scrollbar js-->

        <script src="{{ asset('admins/assets/js/scrollbar/simplebar.js') }}"></script>

        <script src="{{ asset('admins/assets/js/scrollbar/custom.js') }}"></script>
        <!-- Sidebar jquery-->

        <script src="{{ asset('admins/assets/js/config.js') }}"></script>
        <!-- Plugins JS start-->


        <script src="{{ asset('admins/assets/js/sidebar-menu.js') }}"></script>

        <script src="{{ asset('admins/assets/js/prism/prism.min.js') }}"></script>

        <script src="{{ asset('admins/assets/js/counter/jquery.waypoints.min.js') }}"></script>

        <script src="{{ asset('admins/assets/js/counter/jquery.counterup.min.js') }}"></script>

        <script src="{{ asset('admins/assets/js/counter/counter-custom.js') }}"></script>
        <script src="{{ asset('admins/assets/js/select2/select2.full.min.js') }}"></script>

        <script src="{{ asset('admins/assets/js/datepicker/date-picker/datepicker.js') }}"></script>

        <script src="{{ asset('admins/assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>

        <script src="{{ asset('admins/assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>

        <script src="{{ asset('admins/assets/js/owlcarousel/owl.carousel.js') }}"></script>

        <script src="{{ asset('admins/assets/js/general-widget.js') }}"></script>
        <script src="{{ asset('admins/assets/js/moment.js') }}"></script>
        <script src="{{ asset('admins/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admins/assets/js/tooltip-init.js') }}"></script>
        <script src="{{ asset('admins/assets/js/crypto.js') }}"></script>
        <script src="{{ asset('admins/assets/js/aes.js') }}"></script>
        <script src="{{ asset('admins/assets/js/touchspin/vendors.js') }}"></script>
        <script src="{{ asset('admins/assets/js/touchspin/touchspin.js') }}"></script>
        <script src="{{ asset('admins/assets/js/touchspin/input-groups.min.js') }}"></script>

        <script src="{{ asset('admins/assets/js/fullcalendar.js') }}"></script>

        <!-- Plugins JS Ends-->
        <!-- Theme js-->

        <script src="{{ asset('admins/assets/js/script.js') }}"></script>

        @stack('scripts')
        @push('scripts')
        <script>
        var search_url = "{{ route('admin.search') }}";
        var view_enquiry_url = "{{ route('admin.enquiries') }}";
        var view_area_url = "{{ route('admin.areas') }}";
        var view_projects_url = "{{ route('admin.projects') }}";
        var view_user_url = "{{ route('admin.users') }}";

        $("form select").each(function(index) {


            var attrs = $(this).attr('multiple');
            if (typeof attrs === 'undefined' || attrs === false) {
                $(this).find('option:first').attr('selected', 'selected')
                // $(this).find('option:first').attr('disabled', 'disabled')
            }

            $(this).select2();
        })

        //changed by Subhash
        $("form input").each(function(index) {
            if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
                var inputhtml = $(this).clone()
                var parentId = $(this).parent();
                if (parentId.find('label').length > 0) {
                    $(this).remove();
                    var currenthtml = $(parentId).html()
                    $(parentId).html('<div class="fname">' + currenthtml + '<div class="fvalue">' + inputhtml[0]
                        .outerHTML + '</div>' + '</div>')
                }
            }
        })


        // $('input').focus(function(){
        $(document).on('focus', 'form input', function(e) {
            $(this).parents('.fname').addClass('focused');
        });

        $(document).on('blur', 'form input', function(e) {
            var inputValue = $(this).val();
            if (inputValue == "") {
                $(this).parents('.fname').removeClass('focused');
            } else {
                $(this).addClass('filled');
            }
        })

        $(document).on('change', 'form input', function(e) {
            var inputValue = $(this).val();
            if (inputValue != "") {
                $(this).parents('.fname').addClass('focused');
            } else {
                $(this).parents('.fname').removeClass('focused');
            }
        })

        function triggerChangeinput(params) {
            setFocus()
            $('form input').each(function() {
                if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
                    ($(this).trigger('change'));
                }
            })
            $('form select').each(function() {
                var attrs = $(this).attr('multiple');
                if (typeof attrs === 'undefined' || attrs === false) {} else {
                    if ($(this).val().length == 0) {
                        const target = $(this);
                        const targetLabel = target.prev('.select2_label');
                        targetLabel.removeClass('selected');
                    } else {
                        const targetLabel = $(this).prev('.select2_label');
                        targetLabel.addClass('selected');
                    }
                }
            })
        }

        function triggerResetFilter(params) {
            $('#filter_form input').each(function() {
                if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
                    ($(this).trigger('change'));
                }
            })
            $('#filter_form select').each(function() {
                var attrs = $(this).attr('multiple');
                $(this).val('').trigger('change')
                if (typeof attrs === 'undefined' || attrs === false) {} else {
                    if ($(this).val().length == 0) {
                        const target = $(this);
                        const targetLabel = target.prev('.select2_label');
                        targetLabel.removeClass('selected');
                    } else {
                        const targetLabel = $(this).prev('.select2_label');
                        targetLabel.addClass('selected');
                    }
                }
            })
        }

        $('select').on('select2:open', (elm) => {
            const targetLabel = $(elm.target).prev('.select2_label');
            targetLabel.addClass('selected');
        }).on('select2:close', (elm) => {
            const target = $(elm.target);
            const targetLabel = target.prev('.select2_label');
            const targetOptions = $(elm.target.selectedOptions);
            if (targetOptions.length === 0) {
                targetLabel.removeClass('selected');
            }
        })

        $(document).on("click", ".open_modal_with_this", function(e) {
            $("#modal_form").trigger("reset");
            $("#modal_form select").each(function(index) {
                if (!($(this).attr('class')).includes('measure_select')) {
                    $(this).val('').trigger('change');
                } else {
                    $(this).trigger('change');
                }
            })
            $("#this_data_id").val("");
            triggerChangeinput()
        });

        $(document).on('click', '.select2_label', function(e) {
            id = $($(this).parent("div")).find("select").attr('id')
            if (id != '') {
                $('#' + id).select2('open');
            }

        });

        $(document).on('change', '#change_property_link', function(e) {
            window.location.href = $(this).val();
        })

        $(document).on('keyup', ".indian_currency_amount", function() {
            if (isNaN(($(this).val()).replaceAll(',', ''))) {
                $(this).val('')
            } else {
                $(this).val(fmt($(this).val()));
            }
        });

        function fmt(s) {
            var newvalue = s.replace(/,/g, '');
            var valuewithcomma = Number(newvalue).toLocaleString('en-IN');
            return valuewithcomma;
        }
        </script>
        <!-- login js-->
        <!-- Plugin used-->
</body>

</html>
