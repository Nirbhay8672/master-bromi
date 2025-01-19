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
                        <a href="{{ route('admin.profile.details') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="user"></i>
                                    </div>
                                    <h5 class="font-primary">Profile</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">1</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            @can('user-list')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.users') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="users"></i>
                                    </div>
                                    <h5 class="font-primary">Users</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $user }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            @can('role-list')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.roles') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="unlock"></i>
                                    </div>
                                    <h5 class="font-primary">Roles</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $role }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            @can('settings-branches')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.branches') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="monitor"></i>
                                    </div>
                                    <h5 class="font-primary">Branches</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $branch }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            @can('settings-states')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.settings.state') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="map"></i>
                                    </div>
                                    <h5 class="font-primary">States</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $state }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            @can('settings-city')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.settings.city') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="home"></i>
                                    </div>
                                    <h5 class="font-primary">Cities</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $city }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            @can('area-list')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.areas') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="map-pin"></i>
                                    </div>
                                    <h5 class="font-primary">Locality</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $area }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.districts') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="map-pin"></i>
                                    </div>
                                    <h5 class="font-primary">Districts</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $total_district }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.talukas') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="map-pin"></i>
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
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.villages') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="map-pin"></i>
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

            @can('settings-builders')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.settings.builder') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="users"></i>
                                    </div>
                                    <h5 class="font-primary">Builders</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $builder }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('createInvoice') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="fa fa-credit-card bg-primary" style="font-size:36px">
                                        <i data-feather="users" class="d-none"></i>
                                    </div>
                                    <h5 class="font-primary ms-3">Invoice</h5>
                                </div>
                                <div class="media-end">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.VisitingCard') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="fa fa-file bg-primary" style="font-size:36px">
                                    </div>
                                    <h5 class="font-primary ms-3">Visiting Card</h5>
                                </div>
                                <div class="media-end">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            @can('settings-property-configuration')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.settings.property_configuration') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="grid"></i>
                                    </div>
                                    <h5 class="font-primary">Property Configuration</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan


            @can('settings-building-configuration')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.settings.building_configuration') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="command"></i>
                                    </div>
                                    <h5 class="font-primary">Building Configuration</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">11</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan

            @can('settings-enquiry-configuration')
            <div class="col-xl-3 col-md-6">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <a href="{{ route('admin.settings.enquiry_configuration') }}">
                            <div class="media pb-3">
                                <div class="media-body">
                                    <div class="coin-logo-img bg-primary">
                                        <i data-feather="shuffle"></i>
                                    </div>
                                    <h5 class="font-primary">Enquiry Configuration</h5>
                                </div>
                                <div class="media-end">
                                    <h4 class="mb-0 counter">{{ $enquiry }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
