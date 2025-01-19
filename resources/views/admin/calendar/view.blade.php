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
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <div class="d-flex">
                                <h5 class="mb-3">Enquiry Details</h5>
                                <div class="mb-3 ms-auto">
                                    @php
                                        $date = request()->query('date');
                                        $formattedDate = \Carbon\Carbon::parse($date)->format('F j, Y');
                                    @endphp
                                    <p style="font-size: 18px; font-weight: bold;">Date:
                                        {{ $formattedDate ?? 'Default Date' }}</p>
                                </div>
                            </div>
                            <div>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    @php $is_active = 'active'; @endphp
                                    @if (isset($new_enquiry))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}" id="v-new-enquiry-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-new-enquiry" type="button"
                                                role="tab" aria-controls="v-new-enquiry" aria-selected="true">New
                                                Enquiry
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($new_enquiry) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif
                                    @if (isset($leadConf))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}" id="v-lead-confirm-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-lead-confirm" type="button"
                                                role="tab" aria-controls="v-lead-confirm" aria-selected="true">Lead
                                                Confirm
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($leadConf) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif
                                    {{-- @dd($site_visit_scheduled); --}}
                                    @if (isset($site_visit_scheduled))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}"
                                                id="v-site_visit_scheduled-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-site_visit_scheduled" type="button" role="tab"
                                                aria-controls="v-site_visit_scheduled" aria-selected="true">Site Visit
                                                Scheduled
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($site_visit_scheduled) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif
                                    {{-- site completed --}}
                                    @if (isset($site_visit_completed))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}"
                                                id="v-site_visit_completed-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-site_visit_completed" type="button" role="tab"
                                                aria-controls="v-site_visit_completed" aria-selected="true">Site
                                                Visit
                                                Completed
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($site_visit_completed) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif

                                    @if (isset($discussion_schedule))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}" id="v-discussion_schedule-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-discussion_schedule" type="button"
                                                role="tab" aria-controls="v-discussion_schedule"
                                                aria-selected="false">Discussion Schedule
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($discussion_schedule) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif
                                    @if (isset($booked))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}" id="v-booked-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-booked" type="button"
                                                role="tab" aria-controls="v-booked" aria-selected="false">Booked
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($booked) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif
                                    @if (isset($lost))
                                        <li class="nav-item position-relative" role="presentation">
                                            <button class="nav-link mx-1 {{ $is_active }}" id="v-lost-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-lost" type="button" role="tab"
                                                aria-controls="v-lost" aria-selected="false">Lost
                                                <span
                                                    class="position-absolute top-0 end-1 translate-middle badge rounded-pill bg-primary">
                                                    {{ count($lost) ?? 0 }}
                                                </span>
                                            </button>
                                        </li>
                                        @php $is_active = ''; @endphp
                                    @endif
                                    <div class="col-md-1 ms-auto text-end">
                                        <a href="{{ route('admin.enquiries.calendar') }}" data-bs-original-title=""
                                            title="">
                                            <button class="nav-link mx-1 active" id="v-view-summary-tab"
                                                data-bs-original-title="" title="">Back</button>
                                        </a>
                                    </div>
                                </ul>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                @php $is_active = 'show active'; @endphp
                                @if (isset($new_enquiry))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-new-enquiry" role="tabpanel"
                                        aria-labelledby="v-new-enquiry-tab">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12 mb-2">
                                                <h5 class="border-style">New Enquiry</h5>
                                            </div>
                                            @forelse($new_enquiry as $data)
                                                @php
                                                    // $indId = array_filter($dropdowns, function ($value) {
                                                    //     return $value['dropdown_for'] == 'property_specific_type';
                                                    // });
                                                    // // dd('indIdindId', $indId,$data);
                                                    // $requiretype_name = null;
                                                    // if (
                                                    //     $dropdown = current(
                                                    //         array_filter($indId, function ($value) use ($data) {
                                                    //             return $value['parent_id'] == $data->requirement_type;
                                                    //         }),
                                                    //     )
                                                    // ) {
                                                    //     $requiretype_name = $dropdown['name'];
                                                    // }
                                                    // if (!empty($data->requirement_type) && isset(json_decode($data->requirement_type)[0])) {
                                                    // if (!empty($data->requirement_type)) {
                                                    //     // foreach (json_decode($data->requirement_type) as $key => $value) {
                                                    //     if (isset($dropdowns[$value]['name'])) {
                                                    //         if ($key > 0) {
                                                    //             $requiretype_name .= ', ' . $dropdowns[$value]['name'];
                                                    //         } else {
                                                    //             $requiretype_name .= $dropdowns[$value]['name'];
                                                    //         }
                                                    //     }
                                                    //     // }
                                                    // }
                                                    $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                                    $indId = [];
                                                    foreach ($dropdowns as $key => $value) {
                                                        if ($value['dropdown_for'] == 'property_specific_type') {
                                                            $indId[] = $value;
                                                        }
                                                    }
                                                    $requiretype_name = null;
                                                    $prop_type = null;
                                                    foreach ($indId as $dropdown) {
                                                        if ($dropdown['parent_id'] == $data->requirement_type) {
                                                            $requiretype_name = $dropdown['name'];
                                                            $prop_type = $dropdown['parent_id'];
                                                            break;
                                                        }
                                                    }

                                                    if (!empty($data->furnished_status) && isset(json_decode($data->furnished_status)[0])) {
                                                        foreach (json_decode($data->furnished_status) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $furnished .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $furnished .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->building_id) && isset(json_decode($data->building_id)[0])) {
                                                        foreach (json_decode($data->building_id) as $key => $value) {
                                                            if (isset($builds[$value]['project_name'])) {
                                                                if ($key > 0) {
                                                                    $project_name .= ', ' . $builds[$value]['project_name'];
                                                                } else {
                                                                    $project_name .= $builds[$value]['project_name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->area_ids)) {
                                                        foreach (json_decode($data->area_ids) as $key => $value) {
                                                            if (isset($areas[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $area_name .= ', ' . $areas[$value]['name'];
                                                                } else {
                                                                    $area_name .= $areas[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <input type="hidden" id="enq_id_new" value="{{ $data->id }}">
                                                {{-- <input type="hidden" id="enq_id_new" value="{{ $data->id }}"> --}}
                                                <script>
                                                    var idNewEnq = {{ $data->id }};
                                                    localStorage.setItem('enq_id', idNewEnq);
                                                </script>
                                                 
                                                <div class="col-md-4 mb-3">
                                                    <div class="card-body h-100">
                                                        <div class="row">
                                                            <div class="form-group col-12 m-b-5 text-end">
                                                                <i role="button" title="Edit"
                                                                    data-id="{{ $data->id }}"
                                                                    onclick=showProgress(this)
                                                                    class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                    type="button"></i>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6 for="Client Name"><b>Client Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->client_name }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Mobile</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->client_mobile }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Email</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div style="text-transform: lowercase;">: {{ $data->client_email }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry For</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry_for }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Category</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $requiretype_name }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Configuration</b></h6>
                                                            </div> --}}
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $configuration_name }}</div>
                                                            </div> --}}
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Area:</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{-- {{ $data->area_size_from . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] .'to': '') }} --}}
                                                                    {{ $data->area_from . ' To ' . $data->area_to }}
                                                                    {{-- {{ $data->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Budget</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                    to {{ $data->budget_to }}</div>
                                                            </div>
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <h6><b>Enquiry Source</b></h6>-->
                                                            <!--</div>-->
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <div>:-->
                                                            <!--        {{ isset($dropdowns[$data->enquiry_source]['name']) ? $dropdowns[$data->enquiry_source]['name'] : '' }}-->
                                                            <!--    </div>-->
                                                            <!--</div>-->

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Furnished Status</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $furnished }}</div>
                                                            </div>


                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Purpose</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->purpose }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Building</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $project_name }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Status</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry_status ? 'Active' : 'In Active' }}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Project Status</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ isset($dropdowns[$data->project_status]['name']) ? $dropdowns[$data->project_status]['name'] : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Area</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $area_name }}</div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="mb-5">No record found.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                                @if (isset($site_visit_scheduled))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-site_visit_scheduled"
                                        role="tabpanel" aria-labelledby="v-site_visit_scheduled-tab">
                                        <div class="form-group col-md-12 mb-2">
                                            <h5 class="border-style">Site Visit Scheduled</h5>
                                        </div>
                                        @forelse ($site_visit_scheduled as $data)
                                        @php
                                        $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                        $indId = [];
                                        foreach ($dropdowns as $key => $value) {
                                            if ($value['dropdown_for'] == 'property_specific_type') {
                                                $indId[] = $value;
                                            }
                                        }
                                        $requiretype_name = null;
                                        $prop_type = null;
                                        foreach ($indId as $dropdown) {
                                            if ($dropdown['parent_id'] == $data->Enquiry->requirement_type) {
                                                $requiretype_name = $dropdown['name'];
                                                $prop_type = $dropdown['parent_id'];
                                                break;
                                            }
                                        }
                                        if (!empty($data->Enquiry->furnished_status) && isset(json_decode($data->Enquiry->furnished_status)[0])) {
                                            foreach (json_decode($data->Enquiry->furnished_status) as $key => $value) {
                                                if (isset($dropdowns[$value]['name'])) {
                                                    if ($key > 0) {
                                                        $furnished .= ', ' . $dropdowns[$value]['name'];
                                                    } else {
                                                        $furnished .= $dropdowns[$value]['name'];
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($data->Enquiry->building_id) && isset(json_decode($data->Enquiry->building_id)[0])) {
                                            foreach (json_decode($data->Enquiry->building_id) as $key => $value) {
                                                if (isset($builds[$value]['project_name'])) {
                                                    if ($key > 0) {
                                                        $project_name .= ', ' . $builds[$value]['project_name'];
                                                    } else {
                                                        $project_name .= $builds[$value]['project_name'];
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($data->Enquiry->area_ids)) {
                                            foreach (json_decode($data->Enquiry->area_ids) as $key => $value) {
                                                if (isset($areas[$value]['name'])) {
                                                    if ($key > 0) {
                                                        $area_name .= ', ' . $areas[$value]['name'];
                                                    } else {
                                                        $area_name .= $areas[$value]['name'];
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                            <div class="col-md-4 mb-3">
                                                <div class="card-body h-100">
                                                    <div class="row">
                                                        <div class="form-group col-12 m-b-5 text-end">
                                                            <i role="button" title="Edit"
                                                                data-id="{{ $data->id }}" onclick=showProgress(this)
                                                                class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                type="button"></i>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Added On</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Enquiry Progress</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->progress }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Sales Comments</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->dropdowns ? $data->dropdowns->name : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>NFD</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>:
                                                                {{ $data->nfd ? date('d-m-Y', strtotime($data->nfd)) : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6 for="Client Name"><b>Client Name</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->Enquiry->client_name }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Mobile</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->Enquiry->client_mobile }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Email</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div  style="text-transform: lowercase;">: {{ $data->Enquiry->client_email }}</div>
                                                        </div>

                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Enquiry For</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->Enquiry->enquiry_for }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Property Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>:
                                                                {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Property Category</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $requiretype_name }}</div>
                                                        </div>
                                                        {{-- <div class="form-group col-6 m-b-5">
                                                            <h6><b>Configuration</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $configuration_name }}</div>
                                                        </div> --}}
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Area:</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>:
                                                                {{-- {{ $data->Enquiry->area_size_from . ' ' . (isset($dropdowns[$data->Enquiry->area_measurement]['name']) ? $dropdowns[$data->Enquiry->area_measurement]['name'] .'to': '') }} --}}
                                                                {{ $data->Enquiry->area_from . ' To ' . $data->Enquiry->area_to }}
                                                                {{-- {{ $data->Enquiry->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Budget</b></h6>
                                                        </div>

                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                to {{ $data->budget_to }}</div>
                                                        </div>
                                                        <!--<div class="form-group col-6 m-b-5">-->
                                                        <!--    <h6><b>Enquiry Source</b></h6>-->
                                                        <!--</div>-->
                                                        <!--<div class="form-group col-6 m-b-5">-->
                                                        <!--    <div>:-->
                                                        <!--        {{ isset($dropdowns[$data->Enquiry->enquiry_source]['name']) ? $dropdowns[$data->Enquiry->enquiry_source]['name'] : '' }}-->
                                                        <!--    </div>-->
                                                        <!--</div>-->

                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Furnished Status</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $furnished }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Remarks</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->remarks }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Type of Lead</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ ucFirst($data->lead_type) }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="mb-5">No record found.</div>
                                        @endforelse
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                                @if (isset($site_visit_completed))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-site_visit_completed"
                                        role="tabpanel" aria-labelledby="v-site_visit_completed-tab">
                                        <div class="form-group col-md-12 mb-2">
                                            <h5 class="border-style">Site Visit Scheduled</h5>
                                        </div>
                                        @forelse ($site_visit_completed as $data)
                                            @php
                                                $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                                $indId = [];
                                                foreach ($dropdowns as $key => $value) {
                                                    if ($value['dropdown_for'] == 'property_specific_type') {
                                                        $indId[] = $value;
                                                    }
                                                }
                                                $requiretype_name = null;
                                                $prop_type = null;
                                                foreach ($indId as $dropdown) {
                                                    if ($dropdown['parent_id'] == $data->Enquiry->requirement_type) {
                                                        $requiretype_name = $dropdown['name'];
                                                        $prop_type = $dropdown['parent_id'];
                                                        break;
                                                    }
                                                }
                                                if (!empty($data->Enquiry->furnished_status) && isset(json_decode($data->Enquiry->furnished_status)[0])) {
                                                    foreach (json_decode($data->Enquiry->furnished_status) as $key => $value) {
                                                        if (isset($dropdowns[$value]['name'])) {
                                                            if ($key > 0) {
                                                                $furnished .= ', ' . $dropdowns[$value]['name'];
                                                            } else {
                                                                $furnished .= $dropdowns[$value]['name'];
                                                            }
                                                        }
                                                    }
                                                }
                                                if (!empty($data->Enquiry->building_id) && isset(json_decode($data->Enquiry->building_id)[0])) {
                                                    foreach (json_decode($data->Enquiry->building_id) as $key => $value) {
                                                        if (isset($builds[$value]['project_name'])) {
                                                            if ($key > 0) {
                                                                $project_name .= ', ' . $builds[$value]['project_name'];
                                                            } else {
                                                                $project_name .= $builds[$value]['project_name'];
                                                            }
                                                        }
                                                    }
                                                }
                                                if (!empty($data->Enquiry->area_ids)) {
                                                    foreach (json_decode($data->Enquiry->area_ids) as $key => $value) {
                                                        if (isset($areas[$value]['name'])) {
                                                            if ($key > 0) {
                                                                $area_name .= ', ' . $areas[$value]['name'];
                                                            } else {
                                                                $area_name .= $areas[$value]['name'];
                                                            }
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <div class="col-md-4 mb-3">
                                                <div class="card-body h-100">
                                                    <div class="row">
                                                        <div class="form-group col-12 m-b-5 text-end">
                                                            <i role="button" title="Edit"
                                                                data-id="{{ $data->id }}" onclick=showProgress(this)
                                                                class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                type="button"></i>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Added On</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Enquiry Progress</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->progress }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Sales Comments</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->dropdowns ? $data->dropdowns->name : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6 for="Client Name"><b>Client Name</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->Enquiry->client_name }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Mobile</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->Enquiry->client_mobile }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Email</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div  style="text-transform: lowercase;">: {{ $data->Enquiry->client_email }}</div>
                                                        </div>

                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Enquiry For</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->Enquiry->enquiry_for }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Property Type</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>:
                                                                {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Property Category</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $requiretype_name }}</div>
                                                        </div>
                                                        {{-- <div class="form-group col-6 m-b-5">
                                                            <h6><b>Configuration</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $configuration_name }}</div>
                                                        </div> --}}
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Area:</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>:
                                                                {{-- {{ $data->Enquiry->area_size_from . ' ' . (isset($dropdowns[$data->Enquiry->area_measurement]['name']) ? $dropdowns[$data->Enquiry->area_measurement]['name'] .'to': '') }} --}}
                                                                {{ $data->Enquiry->area_from . ' To ' . $data->Enquiry->area_to }}
                                                                {{-- {{ $data->Enquiry->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Budget</b></h6>
                                                        </div>

                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                to {{ $data->budget_to }}</div>
                                                        </div>
                                                        <!--<div class="form-group col-6 m-b-5">-->
                                                        <!--    <h6><b>Enquiry Source</b></h6>-->
                                                        <!--</div>-->
                                                        <!--<div class="form-group col-6 m-b-5">-->
                                                        <!--    <div>:-->
                                                        <!--        {{ isset($dropdowns[$data->Enquiry->enquiry_source]['name']) ? $dropdowns[$data->Enquiry->enquiry_source]['name'] : '' }}-->
                                                        <!--    </div>-->
                                                        <!--</div>-->

                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Furnished Status</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $furnished }}</div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>NFD</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>:
                                                                {{ $data->nfd ? date('d-m-Y', strtotime($data->nfd)) : '' }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <h6><b>Remarks</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->remarks }}</div>
                                                        </div>
                                                        {{-- <div class="form-group col-6 m-b-5">
                                                            <h6><b>Type of Lead</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ ucFirst($data->lead_type) }}</div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="mb-5">No record found.</div>
                                        @endforelse
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                                @if (isset($leadConf))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-lead-confirm" role="tabpanel"
                                        aria-labelledby="v-lead-confirm-tab">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12 mb-2">
                                                <h5 class="border-style">Lead Confirm Schedule</h5>
                                            </div>
                                            @forelse($leadConf as $data)
                                                @php
                                                    $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                                    $indId = [];
                                                    foreach ($dropdowns as $key => $value) {
                                                        if ($value['dropdown_for'] == 'property_specific_type') {
                                                            $indId[] = $value;
                                                        }
                                                    }
                                                    $requiretype_name = null;
                                                    $prop_type = null;
                                                    foreach ($indId as $dropdown) {
                                                        if ($dropdown['parent_id'] == $data->Enquiry->requirement_type) {
                                                            $requiretype_name = $dropdown['name'];
                                                            $prop_type = $dropdown['parent_id'];
                                                            break;
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->furnished_status) && isset(json_decode($data->Enquiry->furnished_status)[0])) {
                                                        foreach (json_decode($data->Enquiry->furnished_status) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $furnished .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $furnished .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->building_id) && isset(json_decode($data->Enquiry->building_id)[0])) {
                                                        foreach (json_decode($data->Enquiry->building_id) as $key => $value) {
                                                            if (isset($builds[$value]['project_name'])) {
                                                                if ($key > 0) {
                                                                    $project_name .= ', ' . $builds[$value]['project_name'];
                                                                } else {
                                                                    $project_name .= $builds[$value]['project_name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->area_ids)) {
                                                        foreach (json_decode($data->Enquiry->area_ids) as $key => $value) {
                                                            if (isset($areas[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $area_name .= ', ' . $areas[$value]['name'];
                                                                } else {
                                                                    $area_name .= $areas[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-md-4 mb-3">
                                                    <div class="card-body h-100">
                                                        <div class="row">
                                                            <div class="form-group col-12 m-b-5 text-end">
                                                                <i role="button" title="Edit"
                                                                    data-id="{{ $data->id }}"
                                                                    onclick=showProgress(this)
                                                                    class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                    type="button"></i>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Added On</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry Progress</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->progress }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>NFD</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->nfd ? date('d-m-Y', strtotime($data->nfd)) : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6 for="Client Name"><b>Client Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_name }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Mobile</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_mobile }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Email</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div  style="text-transform: lowercase;">: {{ $data->Enquiry->client_email }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry For</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->enquiry_for }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Category</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $requiretype_name }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Configuration</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $configuration_name }}</div>
                                                            </div> --}}
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Area:</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{-- {{ $data->Enquiry->area_size_from . ' ' . (isset($dropdowns[$data->Enquiry->area_measurement]['name']) ? $dropdowns[$data->Enquiry->area_measurement]['name'] .'to': '') }} --}}
                                                                    {{ $data->Enquiry->area_from . ' To ' . $data->Enquiry->area_to }}
                                                                    {{-- {{ $data->Enquiry->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Budget</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                    to {{ $data->budget_to }}</div>
                                                            </div>
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <h6><b>Enquiry Source</b></h6>-->
                                                            <!--</div>-->
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <div>:-->
                                                            <!--        {{ isset($dropdowns[$data->Enquiry->enquiry_source]['name']) ? $dropdowns[$data->Enquiry->enquiry_source]['name'] : '' }}-->
                                                            <!--    </div>-->
                                                            <!--</div>-->

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Furnished Status</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $furnished }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->remarks }}</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="mb-5">No record found.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                                @if (isset($discussion_schedule))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-discussion_schedule"
                                        role="tabpanel" aria-labelledby="v-discussion_schedule-tab">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12 mb-2">
                                                <h5 class="border-style">Discussion Schedule</h5>
                                            </div>
                                            @forelse($discussion_schedule as $data)
                                                @php
                                                    $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                                    $indId = [];
                                                    foreach ($dropdowns as $key => $value) {
                                                        if ($value['dropdown_for'] == 'property_specific_type') {
                                                            $indId[] = $value;
                                                        }
                                                    }
                                                    $requiretype_name = null;
                                                    $prop_type = null;
                                                    foreach ($indId as $dropdown) {
                                                        if ($dropdown['parent_id'] == $data->Enquiry->requirement_type) {
                                                            $requiretype_name = $dropdown['name'];
                                                            $prop_type = $dropdown['parent_id'];
                                                            break;
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->furnished_status) && isset(json_decode($data->Enquiry->furnished_status)[0])) {
                                                        foreach (json_decode($data->Enquiry->furnished_status) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $furnished .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $furnished .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->building_id) && isset(json_decode($data->Enquiry->building_id)[0])) {
                                                        foreach (json_decode($data->Enquiry->building_id) as $key => $value) {
                                                            if (isset($builds[$value]['project_name'])) {
                                                                if ($key > 0) {
                                                                    $project_name .= ', ' . $builds[$value]['project_name'];
                                                                } else {
                                                                    $project_name .= $builds[$value]['project_name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->area_ids)) {
                                                        foreach (json_decode($data->Enquiry->area_ids) as $key => $value) {
                                                            if (isset($areas[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $area_name .= ', ' . $areas[$value]['name'];
                                                                } else {
                                                                    $area_name .= $areas[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-md-4 mb-3">
                                                    <div class="card-body h-100">
                                                        <div class="row">
                                                            <div class="form-group col-12 m-b-5 text-end">
                                                                <i role="button" title="Edit"
                                                                    data-id="{{ $data->id }}"
                                                                    onclick=showProgress(this)
                                                                    class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                    type="button"></i>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Added On</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry Progress</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->progress }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Sales Comments</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->dropdowns ? $data->dropdowns->name : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>NFD</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->nfd ? date('d-m-Y', strtotime($data->nfd)) : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6 for="Client Name"><b>Client Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_name }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Mobile</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_mobile }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Email</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div  style="text-transform: lowercase;">: {{ $data->Enquiry->client_email }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry For</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->enquiry_for }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Category</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $requiretype_name }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Configuration</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $configuration_name }}</div>
                                                            </div> --}}
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Area:</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{-- {{ $data->Enquiry->area_size_from . ' ' . (isset($dropdowns[$data->Enquiry->area_measurement]['name']) ? $dropdowns[$data->Enquiry->area_measurement]['name'] .'to': '') }} --}}
                                                                    {{ $data->Enquiry->area_from . ' To ' . $data->Enquiry->area_to }}
                                                                    {{-- {{ $data->Enquiry->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Budget</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                    to {{ $data->budget_to }}</div>
                                                            </div>
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <h6><b>Enquiry Source</b></h6>-->
                                                            <!--</div>-->
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <div>:-->
                                                            <!--        {{ isset($dropdowns[$data->Enquiry->enquiry_source]['name']) ? $dropdowns[$data->Enquiry->enquiry_source]['name'] : '' }}-->
                                                            <!--    </div>-->
                                                            <!--</div>-->

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Furnished Status</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $furnished }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->remarks }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Type of Lead</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ ucFirst($data->lead_type) }}</div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="mb-5">No record found.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                                @if (isset($booked))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-booked" role="tabpanel"
                                        aria-labelledby="v-booked-tab">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12 mb-2">
                                                <h5 class="border-style">Booked</h5>
                                            </div>
                                            @forelse($booked as $data)
                                                @php
                                                    $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                                    $indId = [];
                                                    foreach ($dropdowns as $key => $value) {
                                                        if ($value['dropdown_for'] == 'property_specific_type') {
                                                            $indId[] = $value;
                                                        }
                                                    }
                                                    $requiretype_name = null;
                                                    $prop_type = null;
                                                    foreach ($indId as $dropdown) {
                                                        if ($dropdown['parent_id'] == $data->Enquiry->requirement_type) {
                                                            $requiretype_name = $dropdown['name'];
                                                            $prop_type = $dropdown['parent_id'];
                                                            break;
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->furnished_status) && isset(json_decode($data->Enquiry->furnished_status)[0])) {
                                                        foreach (json_decode($data->Enquiry->furnished_status) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $furnished .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $furnished .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->building_id) && isset(json_decode($data->Enquiry->building_id)[0])) {
                                                        foreach (json_decode($data->Enquiry->building_id) as $key => $value) {
                                                            if (isset($builds[$value]['project_name'])) {
                                                                if ($key > 0) {
                                                                    $project_name .= ', ' . $builds[$value]['project_name'];
                                                                } else {
                                                                    $project_name .= $builds[$value]['project_name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->area_ids)) {
                                                        foreach (json_decode($data->Enquiry->area_ids) as $key => $value) {
                                                            if (isset($areas[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $area_name .= ', ' . $areas[$value]['name'];
                                                                } else {
                                                                    $area_name .= $areas[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-md-4 mb-3">
                                                    <div class="card-body h-100">
                                                        <div class="row">
                                                            <div class="form-group col-12 m-b-5 text-end">
                                                                <i role="button" title="Edit"
                                                                    data-id="{{ $data->id }}"
                                                                    onclick=showProgress(this)
                                                                    class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                    type="button"></i>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Added On</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry Progress</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->progress }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Sales Comments</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->dropdowns ? $data->dropdowns->name : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>NFD</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->nfd ? date('d-m-Y', strtotime($data->nfd)) : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6 for="Client Name"><b>Client Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_name }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Mobile</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_mobile }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Email</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div  style="text-transform: lowercase;">: {{ $data->Enquiry->client_email }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry For</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->enquiry_for }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Category</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $requiretype_name }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Configuration</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $configuration_name }}</div>
                                                            </div> --}}
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Area:</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{-- {{ $data->Enquiry->area_size_from . ' ' . (isset($dropdowns[$data->Enquiry->area_measurement]['name']) ? $dropdowns[$data->Enquiry->area_measurement]['name'] .'to': '') }} --}}
                                                                    {{ $data->Enquiry->area_from . ' To ' . $data->Enquiry->area_to }}
                                                                    {{-- {{ $data->Enquiry->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Budget</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                    to {{ $data->budget_to }}</div>
                                                            </div>
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <h6><b>Enquiry Source</b></h6>-->
                                                            <!--</div>-->
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <div>:-->
                                                            <!--        {{ isset($dropdowns[$data->Enquiry->enquiry_source]['name']) ? $dropdowns[$data->Enquiry->enquiry_source]['name'] : '' }}-->
                                                            <!--    </div>-->
                                                            <!--</div>-->

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Furnished Status</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $furnished }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->remarks }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Type of Lead</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ ucFirst($data->lead_type) }}</div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="mb-5">No record found.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                                @if (isset($lost))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-lost" role="tabpanel"
                                        aria-labelledby="v-lost-tab">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12 mb-2">
                                                <h5 class="border-style">Lost</h5>
                                            </div>
                                            @forelse($lost as $data)
                                                @php
                                                    $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';

                                                    $indId = [];
                                                    foreach ($dropdowns as $key => $value) {
                                                        if ($value['dropdown_for'] == 'property_specific_type') {
                                                            $indId[] = $value;
                                                        }
                                                    }
                                                    $requiretype_name = null;
                                                    $prop_type = null;
                                                    foreach ($indId as $dropdown) {
                                                        if ($dropdown['parent_id'] == $data->Enquiry->requirement_type) {
                                                            $requiretype_name = $dropdown['name'];
                                                            $prop_type = $dropdown['parent_id'];
                                                            break;
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->furnished_status) && isset(json_decode($data->Enquiry->furnished_status)[0])) {
                                                        foreach (json_decode($data->Enquiry->furnished_status) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $furnished .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $furnished .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->building_id) && isset(json_decode($data->Enquiry->building_id)[0])) {
                                                        foreach (json_decode($data->Enquiry->building_id) as $key => $value) {
                                                            if (isset($builds[$value]['project_name'])) {
                                                                if ($key > 0) {
                                                                    $project_name .= ', ' . $builds[$value]['project_name'];
                                                                } else {
                                                                    $project_name .= $builds[$value]['project_name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->Enquiry->area_ids)) {
                                                        foreach (json_decode($data->Enquiry->area_ids) as $key => $value) {
                                                            if (isset($areas[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $area_name .= ', ' . $areas[$value]['name'];
                                                                } else {
                                                                    $area_name .= $areas[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-md-4 mb-3">
                                                    <div class="card-body h-100">
                                                        <div class="row">
                                                            <div class="form-group col-12 m-b-5 text-end">
                                                                <i role="button" title="Edit"
                                                                    data-id="{{ $data->id }}"
                                                                    onclick=showProgress(this)
                                                                    class="fs-22 py-2 mx-2 fa-pencil pointer fa "
                                                                    type="button"></i>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Added On</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry Progress</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->progress }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Sales Comments</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->dropdowns ? $data->dropdowns->name : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>NFD</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $data->nfd ? date('d-m-Y', strtotime($data->nfd)) : '' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6 for="Client Name"><b>Client Name</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_name }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Mobile</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->client_mobile }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Email</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div  style="text-transform: lowercase;">: {{ $data->Enquiry->client_email }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Enquiry For</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->Enquiry->enquiry_for }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Type</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{ $prop_type === 85 ? 'Commercial' : 'Residential' }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Property Category</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $requiretype_name }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Configuration</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $configuration_name }}</div>
                                                            </div> --}}
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Area:</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>:
                                                                    {{-- {{ $data->Enquiry->area_size_from . ' ' . (isset($dropdowns[$data->Enquiry->area_measurement]['name']) ? $dropdowns[$data->Enquiry->area_measurement]['name'] .'to': '') }} --}}
                                                                    {{ $data->Enquiry->area_from . ' To ' . $data->Enquiry->area_to }}
                                                                    {{-- {{ $data->Enquiry->area_size_to . ' ' . (isset($dropdowns[$data->area_measurement]['name']) ? $dropdowns[$data->area_measurement]['name'] : '') }} --}}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Budget</b></h6>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->budget_from ? $data->budget_from : '0' }}
                                                                    to {{ $data->budget_to }}</div>
                                                            </div>
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <h6><b>Enquiry Source</b></h6>-->
                                                            <!--</div>-->
                                                            <!--<div class="form-group col-6 m-b-5">-->
                                                            <!--    <div>:-->
                                                            <!--        {{ isset($dropdowns[$data->Enquiry->enquiry_source]['name']) ? $dropdowns[$data->Enquiry->enquiry_source]['name'] : '' }}-->
                                                            <!--    </div>-->
                                                            <!--</div>-->

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Furnished Status</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $furnished }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->remarks }}</div>
                                                            </div>
                                                            {{-- <div class="form-group col-6 m-b-5">
                                                                <h6><b>Type of Lead</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ ucFirst($data->lead_type) }}</div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="mb-5">No record found.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                            </div>
                        </div>
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
                            <input type="hidden" name="progress_enquiry_id" id="progress_enquiry_id">
                            <div class="row">
                                <div class="form-group col-md-4 m-b-20">
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
                                                    $namee = isset(explode('___', $progs['name'])[0]) ? explode('___', $progs['name'])[0] : '';
                                                @endphp
                                                <option value="{{ $progs['id'] }}"> {{ $namee }}</option>
                                            @endif
                                        @empty
                                        @endforelse

                                    </select>
                                </div>
                                <div class="form-group col-md-8 m-b-20">
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
                                <div class="form-group col-md-4 m-b-4 mb-3">
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

        <div class="modal fade" id="showprogressmodal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Progress</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-secondary" id="addProgressButton" data-id=""
                            onclick="addProgress(this)">Add</button>

                        <table class="table custom-table-design mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Added On</th>
                                    <th scope="col">Enquiry Progress</th>
                                    <th scope="col">Sales Comments</th>
                                    <th scope="col">NFD</th>
                                    <th scope="col">Remarks </th>
                                    <th scope="col">Type of Lead</th>
                                    <th scope="col">Added By</th>
                                </tr>
                            </thead>
                            <tbody class="progress_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function addProgress(data) {
            $('#progress_form')[0].reset();
            $('#showprogressmodal').modal('hide');
            $('#progressmodal').modal('show');
            $('#progress_enquiry_id').val($(data).attr('data-id'));
            // console.log("id modal prog ==", $('#progress_enquiry_id').val());
        }

        function showProgress(data) {
            $('.progress_data').html('')
            var id = $(data).attr('data-id');
            var retrievedId = localStorage.getItem('enq_id');
            // console.log("id ahow progress ==", id, "retrievedId ==", retrievedId);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.getProgress') }}",
                data: {
                    id: id,
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
                                    'last_name'
                                ] +
                                '</td>';
                        } else {
                            str += '<td></td>';
                        }
                        str += '</tr>';
                        $('.progress_data').append(str.replace('null', ''))
                    }
                }
            });
            $('#addProgressButton').attr('data-id', id);
            $('#showprogressmodal').modal('show');
        }

        function CheckIfarraykeyExists(data, i, key1, key2) {
            try {
                tmpvar = data[i][key1][key2]
                return 1
            } catch (error) {
                return 0
            }
        }

        $(document).on('click', '#saveProgress', function(e) {
            // console.log("edit modal data ==");
            e.preventDefault();
            $(this).prop('disabled', true);
            var id = $('#progress_enquiry_id').val()
            var retrievedId = localStorage.getItem('enq_id');
            // console.log("id  777 ahow progress ==", id, "retrievedId ==", retrievedId);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.saveProgress') }}",
                data: {
                    enquiry_id: retrievedId,
                    progress: $('#progress_enquiry_progress').val(),
                    lead_type: $('input[name="progress_lead_type"]:checked').val(),
                    sales_comment_id: $('#progress_sales_comment').val(),
                    nfd: $('#nfdDateTime').val(),
                    remarks: $('#progress_remarks').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // console.log("data save progress bhrt ==", data, "==", id);
                    $('#progressmodal').modal('hide');
                    $('#saveProgress').prop('disabled', false);
                    deleteRecord(id);
                    location.reload();
                }
            });
        });

        function deleteRecord(id) {
            console.log("delete modal called ==", id);
            // alert("delere iod", id)
            $.ajax({
                type: "DELETE",
                url: "{{ route('admin.enquiries.calendar.delete', ['id' => '__id__']) }}".replace('__id__', id),
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log("Record deleted successfully ==", res);
                    // window.location.href = "{{ route('admin.enquiries.calendar') }}";
                }
            });
        }
    </script>
@endpush
