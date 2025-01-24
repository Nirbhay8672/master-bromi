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
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
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
        .dropdown-basic .dropdown .dropdown-content {
            left: auto !important;
        }
        /* country code */
        .country_code_area .input-group .input-group-append .select2 .select2-selection{
            border-bottom-left-radius: 5px !important;
            border-top-left-radius: 5px !important;
        }

        /* Enq read more-read less */
        #enquiryTable .read-more,
        #enquiryTable .read-less {
            cursor: pointer;
        }
        #enquiryTable .read-more:hover {
            color: blue;
        }
        #enquiryTable .read-less:hover {
            color: red;
        }

        .read-more{
            color: #7fb927;
        }

        .read-less{
            color: #7fb927;
        }
         /* prop read more-read less */
         #propertyTable .read-more,
        #propertyTable .read-less {
            cursor: pointer;
        }
        #propertyTable .read-more:hover {
            color: blue;
        }
        #propertyTable .read-less:hover {
            color: red;
        }

        /* Added Custom Style For Property Status */
        table.dataTable.stripe tbody tr.odd.important-row,
        table.dataTable.display tbody tr.odd.important-row {
            background-color: #c2c5ce !important;
        }
        table.dataTable.stripe tbody tr.even.important-row,
        table.dataTable.display tbody tr.even.important-row {
            background-color: #c2c5ce !important;
        }
        input:not([type]),
        input[type="text"] {
            text-transform: capitalize;
        }

        input[type="search"] {
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

        .tooltip-btn:hover::after {
            content: attr(data-tooltip);
            text-transform: none;
            position: absolute;
            bottom: 50px;
            transform: translateX(-50%);
            padding: 5px 10px;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 9999;
        }

        .tooltip-btn:hover::after {
            opacity: 1;
        }

        option {
            text-transform: capitalize !important;
        }
    </style>
    @stack('page-css')
</head>

<body style="text-transform: capitalize;">
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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                @if (!empty(Session::get('plan_id')))
                <div class="left-side-header col ps-0 d-none d-md-block">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2753 2.71436C16.0029 2.71436 19.8363 6.54674 19.8363 11.2753C19.8363 16.0039 16.0029 19.8363 11.2753 19.8363C6.54674 19.8363 2.71436 16.0039 2.71436 11.2753C2.71436 6.54674 6.54674 2.71436 11.2753 2.71436Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.8987 18.4878C20.6778 18.4878 21.3092 19.1202 21.3092 19.8983C21.3092 20.6783 20.6778 21.3097 19.8987 21.3097C19.1197 21.3097 18.4873 20.6783 18.4873 19.8983C18.4873 19.1202 19.1197 18.4878 19.8987 18.4878Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </g>
                                </g>
                            </svg></span>
                        <input class="form-control" autocomplete="off" type="text" id="search_input" name="search_input" placeholder="Search here.." aria-label="search" aria-describedby="basic-addon1">
                        <div class="position-absolute dropdown-search-list bg-white px-3">
                            <div id="result_container"></div>
                        </div>
                    </div>
                </div>

                <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li>
                            <div class="mode animated backOutRight" style="display: none">
                                <svg class="lighticon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1377 13.7902C19.2217 14.8742 16.3477 21.0542 10.6517 21.0542C6.39771 21.0542 2.94971 17.6062 2.94971 13.3532C2.94971 8.05317 8.17871 4.66317 9.67771 6.16217C10.5407 7.02517 9.56871 11.0862 11.1167 12.6352C12.6647 14.1842 17.0537 12.7062 18.1377 13.7902Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg>
                                <svg class="darkicon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z">
                                    </path>
                                    <path d="M18.3117 5.68834L18.4286 5.57143M5.57144 18.4286L5.68832 18.3117M12 3.07394V3M12 21V20.9261M3.07394 12H3M21 12H20.9261M5.68831 5.68834L5.5714 5.57143M18.4286 18.4286L18.3117 18.3117" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </li>
                        <li class="d-md-none resp-serch-input">
                            <div class="resp-serch-box"><i data-feather="search"></i></div>
                            <div class="form-group search-form">
                                <input type="text" placeholder="Search here...">
                            </div>
                        </li>

                        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M2.99609 8.71995C3.56609 5.23995 5.28609 3.51995 8.76609 2.94995" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M8.76616 20.99C5.28616 20.41 3.56616 18.7 2.99616 15.22L2.99516 15.224C2.87416 14.504 2.80516 13.694 2.78516 12.804" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M21.2446 12.804C21.2246 13.694 21.1546 14.504 21.0346 15.224L21.0366 15.22C20.4656 18.7 18.7456 20.41 15.2656 20.99" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.2661 2.94995C18.7461 3.51995 20.4661 5.23995 21.0361 8.71995" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg></a></li>
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M8.54248 9.21777H15.3975" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9702 2.5C5.58324 2.5 4.50424 3.432 4.50424 10.929C4.50424 19.322 4.34724 21.5 5.94324 21.5C7.53824 21.5 10.1432 17.816 11.9702 17.816C13.7972 17.816 16.4022 21.5 17.9972 21.5C19.5932 21.5 19.4362 19.322 19.4362 10.929C19.4362 3.432 18.3572 2.5 11.9702 2.5Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="onhover-show-div bookmark-flip">
                                <div class="flip-card">
                                    <div class="flip-card-inner">
                                        <div class="front dropdown-title pb-0 pt-0">
                                            <ul class="bookmark-dropdown">
                                                <li class="p-4">
                                                    <div class="row">
                                                        <p>Enquiry</p>

                                                        <div class="col-4 text-center mb-3">
                                                            <div data-bs-toggle="modal" data-bs-target="#drop_enquiryModal" class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="file-text"></i></div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Add
                                                                       
                                                                Enquiry</a></h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.enquiries') . '?filter_by=yesterday' }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="calendar"></i><span class="badge rounded-pill badge-warning">{{ !empty($enquiry_count['yes_counts']) ? $enquiry_count['yes_counts'] : 0 }}</span>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Yesterday</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.enquiries') . '?filter_by=today' }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="calendar"></i><span class="badge rounded-pill badge-warning">{{ !empty($enquiry_count['today_counts']) ? $enquiry_count['today_counts'] : 0 }}</span>
                                                                </div>
                                                                <h5 class="mt-2 text-center"> <a href="javascript:void(0)">Today</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.enquiries') . '?filter_by=tomorrow' }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="calendar"></i><span class="badge rounded-pill badge-warning">{{ !empty($enquiry_count['tomo_counts']) ? $enquiry_count['tomo_counts'] : 0 }}</span>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Tomorrow</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.enquiries') . '?filter_by=new' }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="layers"></i><span class="badge rounded-pill badge-warning">{{ !empty($enquiry_count['new_counts']) ? $enquiry_count['new_counts'] : 0 }}</span>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">New</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.enquiries') . '?filter_by=missed' }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="layers"></i><span class="badge rounded-pill badge-warning">{{ !empty($enquiry_count['miss_counts']) ? $enquiry_count['miss_counts'] : 0 }}</span>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Missed</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <p>Property</p>

                                                        <div class="col-4 text-center mb-3 drop_list_url" data-url="{{ route('admin.project.add') }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="file-text"></i></div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Add Project</a></h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center mb-3 drop_list_url" data-url="{{ route('admin.property.add') }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="file-text"></i></div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Add Propery</a></h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center mb-3 drop_list_url" data-url="{{ route('admin.partner.index') }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="file-text"></i></div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Add Partner</a></h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.shared.properties') }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="list"></i>
                                                                </div>
                                                                <h5 class="mt-2 text-center"> <a href="javascript:void(0)">Shared Properties</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.userRequest') }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="list"></i>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Shared
                                                                        Partner Requests</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 text-center drop_list_url" data-url="{{ route('admin.shared.requests') }}">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="list"></i>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Shared
                                                                        Property Requests</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="back dropdown-title">
                                            <ul>
                                                <li>
                                                    <div class="bookmark-dropdown flip-back-content">
                                                        <input type="text" placeholder="search...">
                                                    </div>
                                                </li>
                                                <li><a class="f-w-700 d-block flip-back" id="flip-back" href="javascript:void(0)">Back</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i data-feather="clipboard"></i>
                            </div>
                            <div class="onhover-show-div bookmark-flip">
                                <div class="flip-card">
                                    <div class="flip-card-inner">
                                        <div class="front dropdown-title">
                                            <ul class="bookmark-dropdown pb-0">
                                                <li class="p-0">
                                                    <div class="row">
                                                        <p>Tools</p>
                                                        <div class="col-4 text-center" data-bs-toggle="modal" data-bs-target="#drop_capital_gain_calculator">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="server"></i>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Capital
                                                                        Gain
                                                                        Calculator</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 text-center" data-bs-toggle="modal" data-bs-target="#drop3_whole_unit_calculator">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="smartphone"></i>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Whole
                                                                        Unit
                                                                        Calculator</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 text-center" data-bs-toggle="modal" data-bs-target="#drop4_emi_calculator">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="credit-card"></i>
                                                                </div>
                                                                <h5 class="mt-2"> <a href="javascript:void(0)">Emi
                                                                        Calculator</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9961 2.51416C7.56185 2.51416 5.63519 6.5294 5.63519 9.18368C5.63519 11.1675 5.92281 10.5837 4.82471 13.0037C3.48376 16.4523 8.87614 17.8618 11.9961 17.8618C15.1152 17.8618 20.5076 16.4523 19.1676 13.0037C18.0695 10.5837 18.3571 11.1675 18.3571 9.18368C18.3571 6.5294 16.4295 2.51416 11.9961 2.51416Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M14.306 20.5122C13.0117 21.9579 10.9927 21.9751 9.68604 20.5122" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg>

                                <?php $count = 0; ?>

                                @forelse ($notifications['notification'] as $noti)
                                    @if(Auth::user()->id == $noti['user_id'])
                                        <?php $count++ ?> 
                                    @endif
                                @endforeach

                                <span class="badge rounded-pill badge-warning">{{$count}}</span>

                            </div>
                            <div class="onhover-show-div notification-dropdown">
                                <a href="{{route('admin.notifications')}}">
                                    <div class="dropdown-title">
                                        <h3>Notifications</h3><a class="f-right" href="javascript:void(0)"> <i data-feather="bell">
                                            </i></a>
                                    </div>
                                </a>
                                <ul class="custom-scrollbar">
                                    @forelse ($notifications['notification'] as $noti)
                                        @if(Auth::user()->id == $noti['user_id'])
                                            <a href="{{route('admin.notifications')}}">
                                                <li>
                                                    <div class="media">
                                                        <div class="media-body m-l-0">
                                                            <p>{{ $noti['notification'] }}</p>
                                                            <span class="icomments">{{ $noti['created_at'] }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        @endif
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
                            <div class="media profile-media">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">

                                <li><a href="{{ route('admin.profile.details') }}"><i data-feather="user">
                                        </i><span>Profile Details</span></a></li>
                                <li><a href="{{ route('admin.logout') }}"><i data-feather="log-in"> </i><span>Log
                                            out</span></a></li>


                            </ul>
                        </li>
                    </ul>
                </div>
                @endif
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
                    <div class="logo-wrapper"><a href="{{ route('admin') }}"><img class="img-fluid for-light" src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" alt=""><img class="img-fluid for-dark" src="{{ asset('admins/assets/images/logo/Bromi-Logo.png') }}" alt=""></a>
                        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="{{ route('admin') }}"><img class="img-fluid" src="../assets/images/logo-icon.png" alt=""></a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">

                            @if (empty(Session::get('plan_id')))
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="{{ route('admin') }}"><img class="img-fluid" src="../assets/images/logo-icon.png" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i class="ps-2" aria-hidden="true"> </i></div>
                                </li>
                                <li class="sidebar-list"><a class="sidebar-link sidebar-title  @if ($route == 'admin.plans') active @endif" href="{{ route('admin.plans') }}"><i class="fa fa-map-marker"></i><span class="lan-3">Plans</span></a>
                                </li>
                            </ul>
                            @endif
                            @if (!empty(Session::get('plan_id')))
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="{{ route('admin') }}"><img class="img-fluid" src="../assets/images/logo-icon.png" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i class="ps-2" aria-hidden="true"> </i></div>
                                </li>

                                @can('view-dashboard')

                                <li class="sidebar-list">
                                    <a class="sidebar-link  @if ($route == 'admin') active @endif" href="{{ route('admin') }}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/dashboard.png" style="width: 20px;" alt="">
                                        {{-- <i class="fa fa-th-large"></i> --}}
                                        <span class="lan-6">Dashboard</span>
                                    </a>
                                </li>

                                @endcan

                                @can('property-list')

                                <li class="sidebar-list">
                                    <a class="sidebar-link {{ $route == 'admin.master_properties.index' ? 'active' : '' }}" href="{{ route('admin.master_properties.index') }}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/property.png" style="width: 20px;" alt="">
                                        <span class="lan-6">Properties</span>
                                    </a>
                                </li>

                                @endcan

                                <li class="sidebar-list"><a class="sidebar-link @if (str_contains($route, 'admin.settings')) active @endif" href="{{ route('admin.settings') }}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/settings.png" style="width: 20px;" alt="">
                                        {{-- <i class="fa fa-user"></i> --}}
                                        <span class="lan-6">Settings</span></a>
                                </li>

                                @can('enquiry-list')
                                <li class="sidebar-list">
                                    <a  class="sidebar-link
                                            @if ( $route == 'admin.enquiries' || $route == 'admin.settings.enquiry_configuration')
                                                active
                                            @endif"
                                        href="{{route('admin.enquiries')}}">
                                        <img
                                            src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/enquiry.png"
                                            style="width: 20px;"
                                        >
                                        <span class="lan-6">Enquiries</span>
                                    </a>
                                </li>
                                @endcan

                                <li class="sidebar-list"><a class="sidebar-link @if ($route == 'admin.enquiries.calendar') active @endif" href="{{route('admin.enquiries.calendar')}}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/enquiry.png" style="width: 20px;" alt="">
                                        {{-- <i class="fa fa-users"></i> --}}
                                        <span class="lan-6">Enquiry Calendar</span></a>
                                </li>

                                @can('project-list')

                                <li class="sidebar-list"><a class="sidebar-link " href="{{ route('admin.projects') }}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/project.png" style="width: 20px;" alt="">
                                        {{-- <i class="fa fa-users"></i> --}}
                                        <span class="lan-6">Projects</span></a>
                                </li>

                                @endcan

                                <li class="sidebar-list"><a class="sidebar-link " href="{{ route('admin.partner.index') }}">
                                        <i class="fa fa-users"></i>
                                        <span class="lan-6">Partners</span></a>
                                </li>
                                <li class="sidebar-list"><a class="sidebar-link @if (str_contains($route, 'admin.reports')) active @endif" href="{{ route('admin.reports') }}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/report.png" style="width: 20px;" alt="">
                                        {{-- <i class="fa fa-user"></i> --}}
                                        <span class="lan-6">Reports</span></a>
                                </li>

                                <li class="sidebar-list"><a class="sidebar-link" href="{{ route('admin.integration') }}">
                                        <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/report.png" style="width: 20px;" alt="">
                                        {{-- <i class="fa fa-user"></i> --}}
                                        <span class="lan-6">integrations</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link  <?php if ($route == 'admin') : ?> active <?php endif; ?>" href="<?php echo e(route('admin.index')); ?>">
                                        <i class="fa fa-ticket"></i>
                                        <span class="lan-6">Support Ticket</span>
                                    </a>
                                </li>
                            </ul>
                            @endif
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            @yield('content')
            <!-- footer start-->

        </div>
        <div class="modal fade" id="sear_bar_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" id="search_input" name="search_input" placeholder="Search..." class="form-control">
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
        <div class="modal fade" id="drop_capital_gain_calculator" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Capital Gain Calculator</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
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
                                            <input class="form-check-input" id="radio_year_1" type="radio" name="drop_capital_sale_year" value="2023_2024">
                                            <label class="form-check-label mb-0" for="radio_year_1">2023/24</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" type="radio" id="radio_year_2" name="drop_capital_sale_year" value="2022_2023">
                                            <label class="form-check-label mb-0" for="radio_year_2">2022/23</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="radio_year_3" type="radio" name="drop_capital_sale_year" value="2021_2022">
                                            <label class="form-check-label mb-0" for="radio_year_3">2021/22</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20 d-inline-block">
                                <label for="purchase_year" class="mb-0">Purchase Year</label>
                                <div class="input-group">
                                    <input class="form-control " id="drop_capital_purchase_date" type="date" data-language="en">
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-t-20 d-inline-block">
                                <label for="Purchase price">Purchase Price</label>
                                <input class="form-control" name="drop_capital_purchase_price" id="drop_capital_purchase_price" type="text" required="" autocomplete="off">
                            </div>

                            <div class="form-group col-md-4  m-t-20 d-inline-block">
                                <label for="Capital Gain">Sale Price</label>
                                <input class="form-control" name="drop_capital_sale_price" id="drop_capital_sale_price" type="text" required="" autocomplete="off">
                            </div>

                            <div class="form-group col-md-4 m-b-20 d-inline-block mt-3">
                                <div class="fname focused">
                                    <label for="Capital Gain">Aquisition index</label>
                                    <div class="fvalue">
                                        <input class="form-control" name="drop_capital_capital_gained" id="drop_capital_capital_gained" type="text" required="" autocomplete="off" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4 m-b-20 d-inline-block mt-3">
                                <div class="fname focused">
                                    <label for="Capital Gain">Capital Gain</label>
                                    <div class="fvalue">
                                        <input class="form-control" name="drop_capital_final" id="drop_capital_final" type="text" required="" autocomplete="off" disabled>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="drop3_whole_unit_calculator" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Whole Unit Calculator</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="drop3_modal_form" novalidate="">
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
        <div class="modal fade" id="drop4_emi_calculator" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabels">Emi Calculator</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="drop4_modal_form" novalidate="">
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
                                        <input class="form-control" name="drop4_loan" id="drop4_loan" type="text" required="" autocomplete="off" placeholder="Amount">
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
                                        <input class="form-control" name="drop_4_percentage" id="drop_4_percentage" type="text" required="" autocomplete="off" placeholder="Interest rate">
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
                                        <input class="form-control" name="drop_4_tenure" id="drop_4_tenure" type="text" required="" autocomplete="off" placeholder="No. of Months">
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
        <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
        <script>
          window.OneSignalDeferred = window.OneSignalDeferred || [];
          OneSignalDeferred.push(function(OneSignal) {
            OneSignal.init({
              appId: "{{config('app.onesignalId')}}",
            });
            //  let playerId = null;
            setTimeout(function(){
                let playerId = OneSignal.User.PushSubscription._id;
               
                // Construct the request headers
                const headers = new Headers({
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': "{{csrf_token()}}", // Replace with your actual CSRF token
                });
                
                // Construct the request options
                const requestOptions = {
                  method: 'POST',
                  headers: headers,
                  body: JSON.stringify({ playerId: playerId }),
                };
                
                // Construct the URL
                // const url = "{{route('admin.saveOnesignal')}}"; // Replace with your actual endpoint
                
                // Send the fetch request
                $.ajax({
                    url: "{{route('admin.saveOnesignal')}}", // Replace with your actual endpoint
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}" // Replace with your actual CSRF token
                    },
                    data: {
                        playerId: playerId
                    },
                    success: function(response) {
                        console.log('User ID sent to server successfully');
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending user ID to server:', error);
                    }
                });
                // fetch(url, requestOptions)
                //   .then(response => {
                //     if (!response.ok) {
                //       throw new Error(`HTTP error! Status: ${response.status}`);
                //     }
                //     return response.json();
                //   })
                //   .then(data => {
                //     // console.log(data);
                //     console.log('User ID sent to server successfully');
                //   })
                //   .catch(error => {
                //     console.error('Error sending user ID to server:', error);
                //   });
                
                // console.log("OneSignal User ID:", OneSignal.User.PushSubscription._id);
            }, 1000)

          });
        </script>
        
        <!-- Bootstrap js-->
        <script src="{{ asset('admins/assets/js/jquery.ui.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <script src="{{ asset('admins/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admins/assets/js/fullscreen.js') }}"></script>

        <!--{{-- sweetalert 2 --}}-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--{{-- axios  --}}-->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


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
            var view_properties_url = "{{ route('admin.properties') }}";

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
