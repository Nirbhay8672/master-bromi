@extends('superadmin.layouts.superapp')
@section('content')
    @php
        $permissions = Auth::user()->permissions;
    @endphp
    <div class="page-body" x-data="area_index">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row p-2">

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::STATE))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.settings.state') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                        </div>
                                        <h5 class="font-primary">States</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_state }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::CITY))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.settings.city') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                        </div>
                                        <h5 class="font-primary">Cities</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_city }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::AREA))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.settings.area') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                        </div>
                                        <h5 class="font-primary">Localities</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_locality }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::DISTRICT))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.settings.district') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                        </div>
                                        <h5 class="font-primary">Districts</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_dist }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::TALUKA))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.settings.taluka') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                        </div>
                                        <h5 class="font-primary">Talukas</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_taluka }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::VILLAGE))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.settings.village') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                        </div>
                                        <h5 class="font-primary">Villages</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_village }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::UNITS))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.units') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <i class="fa fa-columns fs-5"></i>
                                        </div>
                                        <h5 class="font-primary">Measurement Units</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_units }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::TP_SCHEME))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.tpscheme') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <i class="fa fa-copy fs-5"></i>
                                        </div>
                                        <h5 class="font-primary">Tp Scheme</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_tp }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::PLANS))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.plans') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <i class="fa fa-th-list fs-5"></i>
                                        </div>
                                        <h5 class="font-primary">Plans</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_plans }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::EMAIL_TEMPLATE))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.email.index') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <i class="fa fa-envelope fs-5"></i>
                                        </div>
                                        <h5 class="font-primary">Email Template</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_email }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if ($permissions->contains(\App\Constants\SupAdminPermissions::SMS_TEMPLATE))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.sms.index') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <i class="fa fa-envelope fs-5"></i>
                                        </div>
                                        <h5 class="font-primary">SMS Template</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_sms }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                
                @if ($permissions->contains(\App\Constants\SupAdminPermissions::COUPONS))
                <div class="col-12 col-md-6 col-lg-4 col-sm-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('superadmin.coupons') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <div class="coin-logo-img bg-primary">
                                            <i class="fa fa-ticket fs-5"></i>
                                        </div>
                                        <h5 class="font-primary">Coupons</h5>
                                    </div>
                                    <div class="media-end">
                                        <h4 class="mb-0 counter">{{ $total_coup }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    @endsection
