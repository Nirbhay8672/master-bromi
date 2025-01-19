@extends('admin.layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">View Enquiry</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row px-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <ul class="nav nav-pills sticky-nav-menu-tab mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1 active" id="v-customer-summary-tab"
                                                        data-bs-toggle="pill" data-bs-target="#v-customer-summary" type="button"
                                                        role="tab" aria-controls="v-customer-summary"
                                                        aria-selected="true">Summary</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1 " id="v-customer-enquiry-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-customer-enquiry" type="button" role="tab"
                                                        aria-controls="v-customer-enquiry" aria-selected="true">Enquiry
                                                        Details</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1" id="v-enquiry-assigning-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-enquiry-assigning" type="button" role="tab"
                                                        aria-controls="v-enquiry-assigning" aria-selected="false">Assigning
                                                        History</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1" id="v-enquiry-progress-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-enquiry-progress" type="button" role="tab"
                                                        aria-controls="v-enquiry-progress" aria-selected="false">Progress
                                                        History</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1" id="v-enquiry-schedule-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-enquiry-schedule" type="button" role="tab"
                                                        aria-controls="v-enquiry-schedule" aria-selected="false">Quick
                                                        Visit</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1" id="v-enquiry-comments-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-enquiry-comments" type="button" role="tab"
                                                        aria-controls="v-enquiry-comments" aria-selected="false">Comments</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-1" id="v-enquiry-matching-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-enquiry-matching" type="button" role="tab"
                                                        aria-controls="v-enquiry-matching" aria-selected="false">Matching
                                                        Property</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <div class="input-group mb-3">
                                                <select class="form-select form-control" id="enquiry_progress_status">
                                                    <option value="">Enquiry Progress</option>
                                                    <option value="Booked">Booked</option>
                                                    <option value="Lost">Lost</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" id="save_enquiry_progress_status">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-customer-summary" role="tabpanel"
                                            aria-labelledby="v-customer-summary-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Customer Information</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_1">
                                                            <h6 for="Client Name"><b>Client Name</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_1">
                                                            <div>: {{ $data->client_name }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_2">
                                                            <h6><b>Mobile</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_2">
                                                            <div>: {{ $data->client_mobile }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_3">
                                                            <h6><b>Email</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_3">
                                                            <div>: {{ $data->client_email }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_4">
                                                            <h6><b>NRI</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_4">
                                                            <div>: {{ $data->is_nri ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style mb-1">Other Contact(s)</h5>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table custom-table-design">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Title</th>
                                                                        <th scope="col">Contact No</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                <tbody>
                                                                    @forelse (json_decode($data->other_contacts) as $value)
                                                                        <tr>
                                                                            <td>{{ $value[0] }}</td>
                                                                            <td>{{ $value[1] }}</td>
                                                                        </tr>
                                                                    @empty
                                                                    @endforelse

                                                                </tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="row m-b-20 mt-4">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Remarks</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_5">
                                                            <h6><b>Telephonic Discussion:</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_5">
                                                            <div>: {{ $data->telephonic_discussion }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_6">
                                                            <h6><b>Highligths:</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_6">
                                                            <div>: {{ $data->highlights }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Customer Requirement</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_7">
                                                            <h6><b>Enquiry For</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_7">
                                                            <div>: {{ $data->enquiry_for }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_8">
                                                            <h6><b>Requirement Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_8">
                                                            <div>: {{ $prop_type }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_9">
                                                            <h6><b>Property Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_9">
                                                            <div>: {{ $requiretype_name }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_10">
                                                            <h6><b>Configuration</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_10">
                                                            <div>: {{ $configuration_name }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_11">
                                                            <h6><b>Area:</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_11">
															<div>:
                                                                {{ $data->area_from . ' ' . (isset($dropdowns[$data->area_from_measurement]['name']) ? $dropdowns[$data->area_from_measurement]['name'] .' to': '') }}

                                                                {{ $data->area_to . ' ' . (isset($dropdowns[$data->area_to_measurement]['name']) ? $dropdowns[$data->area_to_measurement]['name'] : '') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_12">
                                                            <h6><b>Enquiry Source</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_12">
                                                            <div>:
                                                                {{ isset($dropdowns[$data->enquiry_source]['name']) ? $dropdowns[$data->enquiry_source]['name'] : '' }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_13">
                                                            <h6><b>Furnished Status</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_13">
                                                            <div>: {{ $furnished }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_14">
                                                            <h6><b>Budget</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_14">
                                                            <div>: {{ $data->budget_from ? $data->budget_from : '0' }} to
                                                                {{ $data->budget_to }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_15">
                                                            <h6><b>Purpose</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_15">
                                                            <div>: {{ $data->purpose }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_16">
                                                            <h6><b>Building</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_16">
                                                            <div>: {{ $project_name }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_17">
                                                            <h6><b>Status</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_17">
                                                            <div>: {{ $data->enquiry_status ? 'Active' : 'In Active' }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_18">
                                                            <h6><b>Project Status</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_18">
                                                            <div>:
                                                                {{ isset($dropdowns[$data->project_status]['name']) ? $dropdowns[$data->project_status]['name'] : '' }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_19">
                                                            <h6><b>Locality</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_19">
                                                            <div>: {{ $area_name }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_20">
                                                            <h6><b>Pre-leased</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_20">
                                                            <div>: {{ $data->is_preleased ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style">Assigning History</h5>
                                                </div>
                                                <div class="form-group">
                                                    <table class="table table-responsive custom-table-design mb-3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Assigned To</th>
                                                                <th scope="col">Assigned By</th>
                                                                <th scope="col">Assigned At</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $ii = 0;
                                                            @endphp
                                                            @forelse ($data->AssignHistory as $value)
                                                                @if ($ii < 5)
                                                                    @php
                                                                        $ii++;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $value->user->first_name }}</td>
                                                                        <td>{{ $value->assign_user->first_name }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y g:i A') }}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                            @endforelse


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style">Progress History</h5>
                                                </div>
                                                <div class="form-group">
                                                    <table class="table table-responsive custom-table-design mb-3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Added On</th>
                                                                <th scope="col">Enquiry Progress</th>
                                                                <th scope="col">Sales Comments</th>
                                                                <th scope="col">NFD </th>
                                                                <th scope="col">Remarks</th>
                                                                <th scope="col">Type of Lead</th>
                                                                <th scope="col">Added By</th>

                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $ii = 0;
                                                            @endphp
                                                            @forelse ($data->Progress as $value)
                                                                @if ($ii < 5)
                                                                    @php
                                                                        $ii++;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}
                                                                        </td>
                                                                        <td>{{ $value->progress }}</td>
                                                                        <td>{{ isset($value->Dropdowns->name) ? $value->Dropdowns->name : '' }}
                                                                        </td>
                                                                        <td>{{ \Carbon\Carbon::parse($value->nfd)->format('d-m-Y g:i A') }}
                                                                        </td>
                                                                        <td>{{ $value->remarks }}</td>
                                                                        <td>{{ $value->lead_type }}</td>
                                                                        <td>{{ isset($value->User->first_name) ? $value->User->first_name . ' ' . $value->User->last_name : '' }}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                            @endforelse


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style">Quick Visit Schedule History</h5>
                                                </div>
                                                <div class="form-group">
                                                    <table class="table table-responsive custom-table-design mb-3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Added On</th>
                                                                <th scope="col">Site Visit Status</th>
                                                                <th scope="col">Visit Date</th>
                                                                <th scope="col">Assigned To </th>
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Added By</th>

                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $ii = 0;
                                                            @endphp
                                                            @forelse ($data->Visits as $value)
                                                                @if ($ii < 5)
                                                                    @php
                                                                        $ii++;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}
                                                                        </td>
                                                                        <td>{{ $value->visit_status }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($value->visit_date)->format('d-m-Y g:i A') }}
                                                                        </td>
                                                                        <td>{{ isset($value->AssignedTo->first_name) ? $value->AssignedTo->first_name . ' ' . $value->AssignedTo->last_name : '' }}
                                                                        </td>
                                                                        <td>{{ $value->description }}</td>
                                                                        <td>{{ isset($value->AssignedBy->first_name) ? $value->AssignedBy->first_name . ' ' . $value->AssignedBy->last_name : '' }}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                            @endforelse


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h5 class="border-style">Enquiry Comments</h5>
                                                </div>
                                                <div class="form-group">
                                                    <table class="table table-responsive custom-table-design mb-3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Added On</th>
                                                                <th scope="col">Comment</th>
                                                                <th scope="col">Added By</th>

                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            @forelse ($data->Comments as $value)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}
                                                                    </td>
                                                                    <td>{{ $value->comment }}</td>

                                                                    <td>{{ isset($value->User->first_name) ? $value->User->first_name . ' ' . $value->User->last_name : '' }}
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                            @endforelse


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-customer-enquiry" role="tabpanel"
                                            aria-labelledby="v-customer-enquiry-tab">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Customer Information</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_21">
                                                            <h6 for="Client Name"><b>Client Name</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_21">
                                                            <div>: {{ $data->client_name }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_22">
                                                            <h6><b>Mobile</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_22">
                                                            <div>: {{ $data->client_mobile }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_23">
                                                            <h6><b>Email</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_23">
                                                            <div>: {{ $data->client_email }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_24">
                                                            <h6><b>NRI</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_24">
                                                            <div>: {{ $data->is_nri ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style mb-1">Other Contact(s)</h5>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table custom-table-design">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Title</th>
                                                                        <th scope="col">Contact No</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                <tbody>
                                                                    @forelse (json_decode($data->other_contacts) as $value)
                                                                        <tr>
                                                                            <td>{{ $value[0] }}</td>
                                                                            <td>{{ $value[1] }}</td>
                                                                        </tr>
                                                                    @empty
                                                                    @endforelse

                                                                </tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="row m-b-20 mt-4">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Remarks</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_25">
                                                            <h6><b>Telephonic Discussion:</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_25">
                                                            <div>: {{ $data->telephonic_discussion }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_26">
                                                            <h6><b>Highligths:</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_26">
                                                            <div>: {{ $data->highlights }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <h5 class="border-style">Customer Requirement</h5>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_27">
                                                            <h6><b>Enquiry For</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_27">
                                                            <div>: {{ $data->enquiry_for }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_28">
                                                            <h6><b>Requirement Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_28">
                                                            <div>: {{ $prop_type }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_29">
                                                            <h6><b>Property Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_29">
                                                            <div>: {{ $requiretype_name }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_30">
                                                            <h6><b>Configuration</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_30">
                                                            <div>: {{ $configuration_name }}</div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_31">
                                                            <h6><b>Area:</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_31">
															<div>:
                                                                {{ $data->area_from . ' ' . (isset($dropdowns[$data->area_from_measurement]['name']) ? $dropdowns[$data->area_from_measurement]['name'] : '') }}
                                                                to
                                                                {{ $data->area_to . ' ' . (isset($dropdowns[$data->area_to_measurement]['name']) ? $dropdowns[$data->area_to_measurement]['name'] : '') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4 m-b-20 data_conent_32">
                                                            <h6><b>Enquiry Source</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_32">
                                                            <div>:
                                                                {{ isset($dropdowns[$data->enquiry_source]['name']) ? $dropdowns[$data->enquiry_source]['name'] : '' }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_33">
                                                            <h6><b>Furnished Status</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_33">
                                                            <div>: {{ $furnished }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_34">
                                                            <h6><b>Budget</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_34">
                                                            <div>: {{ $data->budget_from ? $data->budget_from : '0' }} to
                                                                {{ $data->budget_to }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_35">
                                                            <h6><b>Purpose</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_35">
                                                            <div>: {{ $data->purpose }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_36">
                                                            <h6><b>Building</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_36">
                                                            <div>: {{ $project_name }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_37">
                                                            <h6><b>Status</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_37">
                                                            <div>: {{ $data->enquiry_status ? 'Active' : 'In Active' }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_38">
                                                            <h6><b>Project Status</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_38">
                                                            <div>:
                                                                {{ isset($dropdowns[$data->project_status]['name']) ? $dropdowns[$data->project_status]['name'] : '' }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_39">
                                                            <h6><b>Locality</b></h6>
                                                        </div>

                                                        <div class="form-group col-8 m-b-20 data_conent_39">
                                                            <div>: {{ $area_name }}</div>
                                                        </div>

                                                        <div class="form-group col-4 m-b-20 data_conent_40">
                                                            <h6><b>Pre-leased</b></h6>
                                                        </div>
                                                        <div class="form-group col-8 m-b-20 data_conent_40">
                                                            <div>: {{ $data->is_preleased ? 'Yes' : 'No' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="v-enquiry-assigning" role="tabpanel"
                                            aria-labelledby="v-enquiry-assigning-tab">
                                            <h5 class="border-style">Assigning History</h5>
                                            <form class="form-bookmark needs-validation " method="post"
                                                id="transfer_form" novalidate="">

                                                <div class="form-row">
                                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                                        <select class="form-select" id="transfer_employee_id">
                                                            <option value=""> Employee</option>
                                                            @foreach ($employees as $employee)
                                                                <option value="{{ $employee->id }}">
                                                                    {{ $employee->first_name . ' ' . $employee->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                            <button class="btn btn-secondary mb-1" id="transferNow">Assign</button>
                                            <br>
                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Assigned To</th>
                                                            <th scope="col">Assigned By</th>
                                                            <th scope="col">Assigned At</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="assign-container">

                                                        @forelse ($data->AssignHistory as $value)
                                                            <tr>
                                                                <td>{{ $value->user->first_name }}</td>
                                                                <td>{{ $value->assign_user->first_name }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y g:i A') }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-enquiry-progress" role="tabpanel"
                                            aria-labelledby="v-enquiry-progress-tab">
                                            <h5 class="border-style">Progress History</h5>
                                            <button class="btn btn-secondary m-b-20" id="addProgressButton"
                                                data-id="" onclick="addProgress()">Add</button>

                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Added On</th>
                                                            <th scope="col">Enquiry Progress</th>
                                                            <th scope="col">Sales Comments</th>
                                                            <th scope="col">NFD </th>
                                                            <th scope="col">Remarks</th>
                                                            <th scope="col">Type of Lead</th>
                                                            <th scope="col">Added By</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody id="progress_container">

                                                        @forelse ($data->Progress as $value)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}
                                                                </td>
                                                                <td>{{ $value->progress }}</td>
                                                                <td>{{ isset($value->Dropdowns->name) ? $value->Dropdowns->name : '' }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($value->nfd)->format('d-m-Y g:i A') }}
                                                                </td>
                                                                <td>{{ $value->remarks }}</td>
                                                                <td>{{ $value->lead_type }}</td>
                                                                <td>{{ isset($value->User->first_name) ? $value->User->first_name . ' ' . $value->User->last_name : '' }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-enquiry-schedule" role="tabpanel"
                                            aria-labelledby="v-enquiry-schedule-tab">
                                            <h5 class="border-style">Quick Visit Schedule History</h5>
                                            <button class="btn btn-secondary m-b-20" id="addScheduleButton"
                                                data-id="" onclick="addscheduleVisit(this)">Add</button>
                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Added On</th>
                                                            <th scope="col">Site Visit Status</th>
                                                            <th scope="col">Visit Date</th>
                                                            <th scope="col">Assigned To </th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Added By</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody id="schedule_container">

                                                        @forelse ($data->Visits as $value)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}
                                                                </td>
                                                                <td>{{ $value->visit_status }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($value->visit_date)->format('d-m-Y g:i A') }}
                                                                </td>
                                                                <td>{{ isset($value->AssignedTo->first_name) ? $value->AssignedTo->first_name . ' ' . $value->AssignedTo->last_name : '' }}
                                                                </td>
                                                                <td>{{ $value->description }}</td>
                                                                <td>{{ isset($value->AssignedBy->first_name) ? $value->AssignedBy->first_name . ' ' . $value->AssignedBy->last_name : '' }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-enquiry-comments" role="tabpanel"
                                            aria-labelledby="v-enquiry-comments-tab">
                                            <h5 class="border-style">Enquiry Comments</h5>
                                            <div class="form-group col-md-9 m-b-10">
                                                <label for="Comments">Comments</label>
                                                <input class="form-control" name="enquiry_comment" id="enquiry_comment"
                                                    type="text" autocomplete="off">
                                            </div>
                                            <br>
                                            <button class="btn btn-secondary m-b-20" id="saveComment">Add</button>
                                            <br>
                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Added On</th>
                                                            <th scope="col">Comment</th>
                                                            <th scope="col">Added By</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody id="comments_container">

                                                        @forelse ($data->Comments as $value)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}
                                                                </td>
                                                                <td>{{ $value->comment }}</td>

                                                                <td>{{ isset($value->User->first_name) ? $value->User->first_name . ' ' . $value->User->last_name : '' }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-enquiry-matching" role="tabpanel"
                                            aria-labelledby="v-enquiry-matching-tab">
                                            <h5 class="border-style">Matching Property</h5>

                                            <br>

                                            <div class="form-group">
                                                <table class="table table-responsive custom-table-design mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Property For</th>
                                                            <th scope="col">Project Name</th>
                                                            <th scope="col">Modified On</th>
                                                            <th scope="col">Price</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody id="matching_container">

                                                        @forelse ($properties as $value)
                                                            <tr>
                                                                <td>{{ $value->property_for }}</td>

                                                                <td>{{ $value->Projects->project_name ? $value->Projects->project_name : '' }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') }}
                                                                </td>
                                                                <td>{{ $value->price }}</td>
                                                            </tr>
                                                        @empty
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="schedulemodal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Schedule Visit</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="schedule_form"
                            novalidate="">
                            <input type="hidden" name="schedule_visit_id" value="{{ $data->id }}"
                                id="schedule_visit_id">
                            <div class="row">
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <label class="mb-0">&nbsp;</label>
                                    <label class="select2_label" for="Property list">Property</label>
                                    <select class="form-select" id="property_list" multiple>
                                        @forelse ($prop_list as $list)
                                            @php
                                                $theprop = !empty(explode(' - ', $list)[0]) ? explode(' - ', $list)[0] : '';
                                                if (empty($theprop)) {
                                                    continue;
                                                }
												$real_list = explode(' - ',$list);
												unset($real_list[0]);
												$real_list = implode(' - ',$real_list);
                                            @endphp
                                            <option value="{{ $theprop }}">{{ $real_list }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-2 m-b-20">
                                    <label class="mb-0">&nbsp;</label>
                                    <select class="form-select" id="schedule_visit_status">
                                        <option value="">Status </option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Completed"> Completed</option>
                                        <option value="Cancelled"> Cancelled</option>
                                        <option value="Postponed"> Postponed</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 m-b-4 mb-3">
                                    <label class="mb-0">&nbsp;</label>
                                    <select class="form-select" id="schedule_assigned_to">
                                        <option value=""> Assigned To</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <label for="site_visit_time" class="mb-0">Site Visit Time:</label>
                                    <input class="form-control " id="site_visit_time" name="site_visit_time"
                                        type="datetime-local">
                                </div>
                                <div class="form-group col-md-2 m-b-20">
                                    <label for="Site Visit Time" class="mb-0">Remind Before (Minutes):</label>
                                    <input class="form-control" name="schedule_remind" id="schedule_remind"
                                        type="remarks" autocomplete="off">
                                </div>
                                <div class="form-group col-md-8 m-b-20">
                                    <label for="Site Visit Time" class="mb-0">Description:</label>
                                    <input class="form-control" name="schedule_description" id="schedule_description"
                                        type="remarks" autocomplete="off">
                                </div>
                            </div>
                            <button class="btn btn-secondary" id="saveSchedule">Save</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="progressmodal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Progress</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="progress_form"
                            novalidate="">
                            <div class="row">
                                <div class="form-group col-md-6 m-b-20">
                                    <label class="mb-0">Enquiry Progress:</label>
                                    <select class="form-select" id="progress_enquiry_progress">
                                        <option value="">Enquiry Progress </option>
                                        <option value="New Lead">New Lead</option>
                                        <option value="Lead Confirmed"> Lead Confirmed</option>
                                        <option value="Site Visit Scheduled"> Site Visit Scheduled</option>
                                        <option value="Site Visit Completed"> Site Visit Completed</option>
                                        <option value="Discussion"> Discussion</option>
                                        <option value="Booked"> Booked</option>
                                        <option value="Lost"> Lost</option>
										@forelse ($configuration_settings as $progs)
											@if ($progs['dropdown_for'] == 'enquiry_progress')
											@php
											$namee  = isset(explode('___',$progs['name'])[0])?explode('___',$progs['name'])[0]:'';
											@endphp
											<option value="{{ $progs['id'] }}"> {{ $namee }}</option>
											@endif
											@empty
											@endforelse

                                    </select>
                                </div>
                                <div class="form-group col-md-6 m-b-20">
                                    <div class="col-12">
                                        <div class="m-checkbox-inline custom-radio-ml">
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" id="progress_lead_type_1" type="radio"
                                                    name="progress_lead_type" value="Hot Lead">
                                                <label class="form-check-label mb-0" for="progress_lead_type_1">Hot
                                                    Lead</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" type="radio" id="progress_lead_type_2"
                                                    name="progress_lead_type" value="Warm Lead">
                                                <label class="form-check-label mb-0" for="progress_lead_type_2"> Warm
                                                    Lead</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" id="progress_lead_type_3" type="radio"
                                                    name="progress_lead_type" value="Cold Lead">
                                                <label class="form-check-label mb-0" for="progress_lead_type_3">Cold
                                                    Lead</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 m-b-4 mb-3">
                                    <label class="mb-0">Comments:</label>
                                    <select class="form-select" id="progress_sales_comment">
                                        <option value="">Sales Comments</option>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'enquiry_sales_comment')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-6 m-b-20">
                                    <label for="nfd" class="mb-0">NFD:</label>
                                    <input class="form-control " id="nfdDateTime" name="nfdDateTime"
                                        type="datetime-local">
                                </div>

                                <div class="form-group col-md-12 m-b-20">
                                    <label for="remarks" class="mb-0">Remarks:</label>
                                    <input class="form-control" name="progress_remarks" id="progress_remarks"
                                        type="remarks" autocomplete="off">
                                </div>
                            </div>
                            <button class="btn btn-secondary" id="saveProgress">Save</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('scripts')
        <script>

			for (let i = 1; i < 43; i++) {
				if ($('.data_conent_'+i).length > 1) {
					var strr = $($('.data_conent_'+i)[1]).html()
					strr = strr.replaceAll("<div>", "");
					strr = strr.replaceAll("</div>", "");
					strr = strr.replaceAll("-", "");
					strr = strr.replaceAll(":", "");
					strr = strr.replaceAll("No", "");
					strr = strr.trim();
					if (strr == '') {
						$('.data_conent_'+i).hide()
					}
				}
			}

            function makeid(length) {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }


            function generate_contact_detail(id) {
                var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-3 m-b-20">' +
                    '       <input class="form-control" name="contact_person_name" type="text"' +
                    '            autocomplete="off" placeholder="Contact person">' +
                    '     </div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-20">' +
                    '       <input class="form-control" name="contact_person_no"' +
                    '           type="text"  autocomplete="off"' +
                    '           placeholder="Contact person No.">' +
                    '   </div>' +
                    '       <div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3">' +
                    '    <select class="form-select" name="contact_status">' +
                    '     <option value="">Contact Status</option>' +
                    '    <option value="Contactable">Contactable</option>' +
                    '     <option value="Not Contactable">Not Contactable</option>' +
                    '  </select>  </div>' +
                    '<div data-contact_id= ' + id +
                    ' class="form-check custom-checkbox   checkbox-solid-success mb-0 col-md-1 m-b-20">' +
                    ' <input class="form-check-input" name="contact_nri" type="checkbox">' +
                    ' <label class="form-check-label" for="contact_nri">NRI</label>' +
                    '               </div>' +
                    '<div data-contact_id= ' + id +
                    ' class="form-group col-md-1 m-b-4 mb-3"><button data-contact_id=' + id +
                    ' class="remove_contacts btn btn-danger btn-air-danger" type="button">-</button>  </div>';
                return myvar;
            }

            $(document).on('click', '#add_contacts', function(e) {
                id = makeid(10);
                $('#all_contacts').append(generate_contact_detail(id));
                $("#all_contacts select").each(function(index) {
                    $(this).select2();
                })
            })

            $(document).on('click', '.remove_contacts', function(e) {
                id = $(this).attr('data-contact_id');
                $("[data-contact_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            function getEnquiry() {
                $('#modal_form').trigger("reset");
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getEnquiry') }}",
                    data: {
                        id: '{{ $data->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('#client_name').val(data.client_name);
                        $('#client_mobile').val(data.client_mobile);
                        $('#client_email').val(data.client_email);
                        $('#is_nri').prop('checked', Number(data.is_nri));
                        $('#enquiry_for').val(data.enquiry_for);
                        $('#requirement_type').val(JSON.parse(data.requirement_type)).trigger('change');
                        $('#property_type').val(JSON.parse(data.property_type)).trigger('change');
                        $('#configuration').val(JSON.parse(data.configuration)).trigger('change');
                        $('#area_size_from').val(data.area_size_from);
                        $('#area_size_to').val(data.area_size_to);
                        $('#area_measurement').val(data.area_measurement).trigger('change');
                        $('#enquiry_source').val(data.enquiry_source).trigger('change');
                        $('#furnished_status').val(JSON.parse(data.furnished_status)).trigger('change');
                        $('#budget_from').val(data.budget_from);
                        $('#budget_to').val(data.budget_to);
                        $('#purpose').val(data.purpose).trigger('change');;
                        $('#building_id').val(JSON.parse(data.building_id)).trigger('change');
                        $('#enquiry_status').val(data.enquiry_status).trigger('change');;
                        $('#project_status').val(data.project_status).trigger('change');;
                        $('#area_ids').val(JSON.parse(data.area_ids)).trigger('change');
                        $('#is_preleased').prop('checked', Number(data.is_preleased));
                        $('#telephonic_discussion').val(data.telephonic_discussion);
                        $('#highlights').val(data.highlights);
                        $('#enquiry_city_id').val(data.enquiry_city_id).trigger('change');
                        $('#enquiry_branch_id').val(data.enquiry_branch_id).trigger('change');
                        $('#employee_id').val(data.employee_id).trigger('change');
                        $('#is_favourite').prop('checked', Number(data.is_favourite));
                        $('#all_contacts').html('')
                        $('#all_contact_list_data').html('')
                        if (data.other_contacts != '') {
                            details = JSON.parse(data.other_contacts);
                            try {
                                for (let i = 0; i < details.length; i++) {
                                    id = makeid(10);
                                    $('#all_contacts').append(generate_contact_detail(id))
                                    $("[data-contact_id=" + id + "] select[name=contact_status]").select2()
                                    $("[data-contact_id=" + id + "] input[name=contact_person_name]").val(details[i]
                                        [
                                            0
                                        ]);
                                    $("[data-contact_id=" + id + "] input[name=contact_person_no]").val(details[i][
                                        1
                                    ]);
                                    $("[data-contact_id=" + id + "] select[name=contact_status]").val(details[i][
                                        2
                                    ]).trigger('change');
                                    $("[data-contact_id=" + id + "] input[name=contact_nri]").prop('checked',
                                        Number(
                                            details[i][3]));

                                }
                            } catch (error) {

                            }
                        }
                        triggerChangeinput()
                    }
                });
            }

            $(document).on('click', '#saveEnquiry', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
                    return
                }
                $(this).prop('disabled', true);
                var contact_details = [];
                $("#all_contacts [name=contact_person_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).parent().attr('data-contact_id');
                    name = $(this).val();
                    no = $("[data-contact_id=" + unique_id + "] input[name=contact_person_no]").val();
                    status = $("[data-contact_id=" + unique_id + "] select[name=contact_status]").val();
                    nri = $("[data-contact_id=" + unique_id + "] input[name=contact_nri]").prop('checked')
                    cona_arr.push(name)
                    cona_arr.push(no)
                    cona_arr.push(status)
                    cona_arr.push(Number(nri))
                    if (filtercona_arr(cona_arr)) {
                        contact_details.push(cona_arr);
                    }
                });
                contact_details = JSON.stringify(contact_details);


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveEnquiry') }}",
                    data: {
                        id: '{{ $data->id }}',
                        client_name: $('#client_name').val(),
                        client_mobile: $('#client_mobile').val(),
                        client_email: $('#client_email').val(),
                        is_nri: Number($('#is_nri').prop('checked')),
                        enquiry_for: $('#enquiry_for').val(),
                        requirement_type: JSON.stringify($('#requirement_type').val()),
                        property_type: JSON.stringify($('#property_type').val()),
                        configuration: JSON.stringify($('#configuration').val()),
                        area_size_from: $('#area_size_from').val(),
                        area_size_to: $('#area_size_to').val(),
                        area_measurement: $('#area_measurement').val(),
                        enquiry_source: $('#enquiry_source').val(),
                        furnished_status: JSON.stringify($('#furnished_status').val()),
                        budget_from: $('#budget_from').val(),
                        budget_to: $('#budget_to').val(),
                        purpose: $('#purpose').val(),
                        building_id: JSON.stringify($('#building_id').val()),
                        enquiry_status: $('#enquiry_status').val(),
                        project_status: $('#project_status').val(),
                        area_ids: JSON.stringify($('#area_ids').val()),
                        is_preleased: Number($('#is_preleased').prop('checked')),
                        other_contacts: contact_details,
                        telephonic_discussion: $('#telephonic_discussion').val(),
                        highlights: $('#highlights').val(),
                        enquiry_city_id: $('#enquiry_city_id').val(),
                        enquiry_branch_id: $('#enquiry_branch_id').val(),
                        employee_id: $('#employee_id').val(),
                        is_favourite: Number($('#is_favourite').prop('checked')),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#saveEnquiry').prop('disabled', false);
                        window.location.reload()
                    }
                });
            })


            $(document).on('click', '#transferNow', function(e) {
                e.preventDefault();
                var employee = $('#transfer_employee_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.transferEnquiry') }}",
                    data: {
                        enquiry_id: "{{ $data->id }}",
                        employee: employee,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        assignHistory("{{ $data->id }}")
                        $('#transfermodal').modal('hide');
                    }
                });
            });

            function assignHistory(id) {
                var call_url = "{{ route('admin.get.assign.history') }}?id=" + id;
                $.ajax({
                    type: "POST",
                    url: call_url,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#assign-container').html(data.html);
                    }
                });
            }


            $(document).on('click', '#saveComment', function(e) {
                $(this).prop('disabled', true)
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.enquiry.saveComment') }}",
                    data: {
                        id: '{{ $data->id }}',
                        comment: $('#enquiry_comment').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#enquiry_comment').val('')
                        $('#saveComment').prop('disabled', false)
                        getComments();
                    }
                });
            })

            $(document).on('click', '#saveProgress', function(e) {
                e.preventDefault();
                $(this).prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveProgress') }}",
                    data: {
                        enquiry_id: '{{ $data->id }}',
                        progress: $('#progress_enquiry_progress').val(),
                        lead_type: $('input[name="progress_lead_type"]:checked').val(),
                        sales_comment_id: $('#progress_sales_comment').val(),
                        nfd: $('#nfdDateTime').val(),
                        remarks: $('#progress_remarks').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#progressmodal').modal('hide');
                        $('#saveProgress').prop('disabled', false);
                        showProgress()
                    }
                });
            });

            $(document).on('click', '#save_enquiry_progress_status', function(e) {
                if($('#enquiry_progress_status').val() == ""){
                    alert('Please select the status.');
                    return;
                }
                $(this).prop('disabled', true);
                var $this = $(this);
                $this.html('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveProgress') }}",
                    data: {
                        enquiry_id: '{{ $data->id }}',
                        progress: $('#enquiry_progress_status').val(),
                        lead_type: "",
                        sales_comment_id: "",
                        nfd: "",
                        remarks: "",
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $this.prop('disabled', false);
                        $this.html('Update');
                        $('#enquiry_progress_status').val('');
                        $('#v-enquiry-progress-tab').trigger('click');
                        showProgress();
                    }
                });
            });

            function addProgress() {
                $('#progress_form')[0].reset();
                $('#progressmodal').modal('show');
            }

            function showProgress() {
                $('#progress_container').html('')
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getProgress') }}",
                    data: {
                        id: '{{ $data->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        for (let i = 0; i < data.length; i++) {
                            var str = '<tr>';
                            str += '   <td>' + data[i]['created_at'] + '</td>';
                            if (data[i]['progress'] !== null) {
                                str += '   <td>' + data[i]['progress'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['dropdowns'] !== null) {
                                str += '   <td>' + data[i]['dropdowns']['name'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['nfd'] !== null) {
                                str += '   <td>' + data[i]['nfd'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['remarks'] !== null) {
                                str += '   <td>' + data[i]['remarks'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['lead_type'] !== null) {
                                str += '   <td>' + data[i]['lead_type'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (CheckIfarraykeyExists(data, i, 'user', 'first_name')) {
                                str += '   <td>' + data[i]['user']['first_name'] + ' ' + data[i]['user'][
                                        'last_name'] +
                                    '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            str += '</tr>';
                            $('#progress_container').append(str.replace('null', ''))
                        }
                    }
                });
            }

            $(document).on('click', '#saveSchedule', function(e) {
                e.preventDefault();
                $(this).prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveSchedule') }}",
                    data: {
                        enquiry_id: '{{ $data->id }}',
                        visit_status: $('#schedule_visit_status').val(),
                        description: $('#schedule_description').val(),
                        visit_date: $('#site_visit_time').val(),
                        assigned_to: $('#schedule_assigned_to').val(),
                        schedule_remind: $('#schedule_remind').val(),
                        property_list: JSON.stringify($('#property_list').val()),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#schedulemodal').modal('hide');
                        $('#saveSchedule').prop('disabled', false);
                        showScheduleVisit()
                    },
                    error: function(data) {
                        $('#schedulemodal').modal('hide');
                        $('#saveSchedule').prop('disabled', false);
                        showScheduleVisit()
                    }
                });
            });

            function CheckIfarraykeyExists(data, i, key1, key2) {
                try {
                    tmpvar = data[i][key1][key2]
                    return 1
                } catch (error) {
                    return 0
                }
            }


            function showScheduleVisit() {
                $('#schedule_container').html('')
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getSchedule') }}",
                    data: {
                        id: '{{ $data->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        for (let i = 0; i < data.length; i++) {
                            var str = '<tr>';
                            str += '   <td>' + data[i]['created_at'] + '</td>';
                            if (data[i]['visit_status'] !== null) {
                                str += '   <td>' + data[i]['visit_status'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }

                            if (data[i]['visit_date'] !== null) {
                                str += '   <td>' + data[i]['visit_date'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (CheckIfarraykeyExists(data, i, 'assigned_to', 'first_name')) {
                                str += '   <td>' + data[i]['assigned_to']['first_name'] + ' ' + data[i][
                                        'assigned_to'
                                    ]['last_name'] +
                                    '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['description'] !== null) {
                                str += '   <td>' + data[i]['description'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (CheckIfarraykeyExists(data, i, 'assigned_by', 'first_name')) {
                                str += '   <td>' + data[i]['assigned_by']['first_name'] + ' ' + data[i][
                                        'assigned_by'
                                    ]['last_name'] +
                                    '</td>';
                            } else {
                                console.log(data[i]['assigned_by']['first_name']);
                                str += '<td></td>';
                            }
                            $('#schedule_container').append(str.replace('null', ''))
                        }
                    }
                });
            }


            function addscheduleVisit(data) {
                $('#schedule_form')[0].reset();
                $('#schedulemodal').modal('show');
                $('#schedule_assigned_to').val('{{ Auth::User()->id }}').trigger('change');
            }

            function getComments(params) {
                console.log(2145);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.enquiry.getComment') }}",
                    data: {
                        id: '{{ $data->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#comments_container').html('')
                        data = JSON.parse(data);
                        for (let i = 0; i < data.length; i++) {
                            var str = '<tr>';
                            str += '   <td>' + data[i]['created_at'] + '</td>';
                            if (data[i]['comment'] !== null) {
                                str += '   <td>' + data[i]['comment'] + '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            if (data[i]['user']['first_name'] !== null) {
                                str += '   <td>' + data[i]['user']['first_name'] + ' ' + data[i]['user'][
                                        'last_name'
                                    ] +
                                    '</td>';
                            } else {
                                str += '<td></td>';
                            }
                            $('#comments_container').append(str.replace('null', ''))
                        }
                    }
                });
            }
        </script>
    @endpush
