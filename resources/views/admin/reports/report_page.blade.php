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

                @can('report-employee-audit-log')
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.employee.audit') }}">
                                <div class="media pb-3">
                                    <div class="media-body">

                                        <h5 class="font-primary">Employee Audit
											Log</h5>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan

                @can('report-employee-by-enquiry')
				<div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.employee.performance') }}">
                                <div class="media pb-3">
                                    <div class="media-body">

                                        <h5 class="font-primary">Employee Performance</h5>
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
                            <a href="{{ route('admin.report.employee.enquiry') }}">
                                <div class="media pb-3">
                                    <div class="media-body">

                                        <h5 class="font-primary">Employee By
											enquiry</h5>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                @can('report-enquiry-by-period')
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.reports.enquiry.period') }}">
                                <div class="media pb-3">
                                    <div class="media-body">

                                        <h5 class="font-primary">Enquiry By
											Period</h5>
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
                            <a href="{{ route('admin.report.source.enquiry.page') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Source Vise Leads</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.assigned.enquiry.page') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Assigned Leads</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.active_source.enquiry.page') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Active Source Leads</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.lost_source.enquiry.page') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Lost Source Leads</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.stage.enquiry.page') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Stage Enquiry</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.person_date.enquiry.page') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Person Date Vise Enquiry</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                
                @can('logged-in-report')
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.report.logged') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Logged In report</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan

                @can('report-enquiry-remarks')
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.enquiry.remarks') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Enquiry Remarks</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan

                @can('report-property-sold')
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.reports.sold') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Property Sold</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan

                @can('report-property-viewer')
                <div class="col-xl-3 col-md-6">
                    <div class="card crypto-chart overflow-hidden">
                        <div class="card-header card-no-border">
                            <a href="{{ route('admin.reports.viewer') }}">
                                <div class="media pb-3">
                                    <div class="media-body">
                                        <h5 class="font-primary">Property Viewer</h5>
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
