@extends('superadmin.layouts.superapp')
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
                                <h5 class="mb-3">Lead Details</h5>
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
                                                aria-controls="v-site_visit_scheduled" aria-selected="true">Demo
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
                                                aria-controls="v-site_visit_completed" aria-selected="true">Demo Completed
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
                                                {{-- @php
                                                    $prop_type = $configuration_name = $requiretype_name = $furnished = $project_name = $area_name = '';
                                                    if (!empty($data->property_type) && isset(json_decode($data->property_type)[0])) {
                                                        foreach (json_decode($data->property_type) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $prop_type .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $prop_type .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if (!empty($data->configuration) && isset(json_decode($data->configuration)[0])) {
                                                        foreach (json_decode($data->configuration) as $key => $value) {
                                                            if (isset($dropdowns[$value]['name'])) {
                                                                if ($key > 0) {
                                                                    $configuration_name .= ', ' . $dropdowns[$value]['name'];
                                                                } else {
                                                                    $configuration_name .= $dropdowns[$value]['name'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $indId = array_filter($dropdowns, function ($value) {
                                                        return $value['dropdown_for'] == 'property_specific_type';
                                                    });

                                                    $requiretype_name = null;
                                                    if (
                                                        $dropdown = current(
                                                            array_filter($indId, function ($value) use ($data) {
                                                                return $value['parent_id'] == $data->requirement_type;
                                                            }),
                                                        )
                                                    ) {
                                                        $requiretype_name = $dropdown['name'];
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
                                                @endphp --}}
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
                                                                <h6 for="Client Name"><b>Name</b></h6>
                                                            </div>
                                                            
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->user_name }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Mobile</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->mobile }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Email</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->email }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Company</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{  $data->company }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Status</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->status }}</div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>State</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->state->name ?? '-' }}
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>City</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->city->name ?? '-' }}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Plan Interested In</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->planInterested->name }}</div>
                                                            </div>

                                                             <div class="form-group col-6 m-b-5">
                                                                <h6><b>Comment</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry }}</div>
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
                                @if (isset($site_visit_scheduled))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-site_visit_scheduled"
                                        role="tabpanel" aria-labelledby="v-site_visit_scheduled-tab">
                                        <div class="form-group col-md-12 mb-2">
                                            <h5 class="border-style">Demo Scheduled</h5>
                                        </div>
                                        @forelse ($site_visit_scheduled as $data)
                                            {{-- @dd($data->id); --}}

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
                                                            <h6><b>Lead Progress</b></h6>
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
                                                            <h6><b>Remarks</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->enquiry }}</div>
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
                                            <h5 class="border-style">Demo Completed</h5>
                                        </div>
                                        @forelse ($site_visit_completed as $data)
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
                                                            <h6><b>Lead Progress</b></h6>
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
                                                            <h6><b>Remarks</b></h6>
                                                        </div>
                                                        <div class="form-group col-6 m-b-5">
                                                            <div>: {{ $data->enquiry }}</div>
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
                                @if (isset($leadConf))
                                    <div class="tab-pane fade {{ $is_active }}" id="v-lead-confirm" role="tabpanel"
                                        aria-labelledby="v-lead-confirm-tab">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12 mb-2">
                                                <h5 class="border-style">Lead Confirm Schedule</h5>
                                            </div>
                                            @forelse($leadConf as $data)
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
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Lead Progress</b></h6>
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
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry }}</div>
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
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Lead Progress</b></h6>
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
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry }}</div>
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
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Lead Progress</b></h6>
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
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry }}</div>
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
                                                                <div>: {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <h6><b>Lead Progress</b></h6>
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
                                                                <h6><b>Remarks</b></h6>
                                                            </div>
                                                            <div class="form-group col-6 m-b-5">
                                                                <div>: {{ $data->enquiry }}</div>
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
                                    </div>
                                    @php $is_active = ''; @endphp
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="progressModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Lead Status</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="d-none" name="this_progress_data_id" id="this_progress_data_id">
                        <p class="border-top"></p>
                        <div class="row mb-1">
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <select name="" id="status" class="form-select" style="border:1px solid black;border-radius:5px;">
                                        <option value="">Lead Progress </option>
                                        <option value="New Lead">New Lead</option>
                                        <option value="Lead Confirmed"> Lead Confirmed</option>
                                        <option value="Discussion"> Discussion</option>
                                        <option value="Demo Scheduled"> Demo Scheduled</option>
                                        <option value="Demo Completed"> Demo Completed</option>
                                        <option value="Due Followup"> Due Followup</option>
                                        <option value="Booked"> Booked</option>
                                        <option value="Lost"> Lost</option>
                                    </select>
                                    <span class="text-danger invalid-error d-none" id="status_error">Status is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                {{-- <div class="col-12"> --}}
                                    <div class="m-checkbox-inline custom-radio-ml d-flex">
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="progress_lead_type_1" type="radio" name="lead_type" value="Hot Lead" checked>
                                            <label class="form-check-label mb-0" for="progress_lead_type_1">Hot Lead</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" type="radio" id="progress_lead_type_2" name="lead_type" value="Warm Lead">
                                            <label class="form-check-label mb-0" for="progress_lead_type_2"> Warm Lead</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="progress_lead_type_3" type="radio" name="lead_type" value="Cold Lead">
                                            <label class="form-check-label mb-0" for="progress_lead_type_3">Cold Lead</label>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                            </div>
                        {{-- </div>
                        <div class="row"> --}}
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <input value="{{date('Y-m-d')}}" class="form-control" name="followup_date" id="followup_date" type="date" autocomplete="off">
                                    <span class="text-danger invalid-error d-none" id="followup_date_error">Follow up date is required.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 m-b-20">
                                <div class="fname">
                                    <input value="{{date('H:i')}}" class="form-control" name="time" id="time" type="time" autocomplete="off">
                                    <span class="text-danger invalid-error d-none" id="time_error">Time is required.</span>
                                </div>
                            </div>
                            <div class="form-group m-b-20">
                                <div class="fname">
                                    <textarea name="progress_enquiry" class="form-control" id="progress_enquiry" cols="10" rows="5" placeholder="Enquiry"></textarea>
                                    <span class="text-danger invalid-error d-none" id="progress_enquiry_error">Enquiry is required.</span>
                                </div>
                            </div>

                            <div class="text-center mt-3">  
                                <button class="btn custom-theme-button" type="button" onclick="saveProgress()">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="showprogressmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Progress</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-secondary" id="addProgressButton" data-id=""
                            onclick="updateStatusForm(this)">Add</button>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title bg-primary rounded">Lead Details</h4>
                                <div class="d-flex justify-content-between">
                                    <div class="pt">
                                        <div class=""><strong>Name:</strong> <span id="nameRead"></span></div>
                                        <div class=""><strong>Company:</strong> <span id="companyRead"></span></div>
                                        <div class=""><strong>Phone:</strong> <span id="mobileRead"></span></div>
                                    </div>
                                    <div class="pt">
                                        <div class=""><strong>Email:</strong> <span id="emailRead"></span></div>
                                        <div class=""><strong>Plan:</strong> <span id="planRead"></span></div>
                                        <div class=""><strong>State:</strong> <span id="stateRead"></span></div>
                                    </div>
                                    <div class="pt">
                                        <div class=""><strong>City:</strong><span id="cityRead"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table custom-table-design mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Added On</th>
                                    <th scope="col">Lead Progress</th>
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
        /* function addProgress(data) {
            $('#progress_form')[0].reset();
            $('#showprogressmodal').modal('hide');
            $('#progressmodal').modal('show');
            $('#progress_enquiry_id').val($(data).attr('data-id'));
            // console.log("id modal prog ==", $('#progress_enquiry_id').val());
        } */

        function updateStatusForm(data) {
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.showEnquiry') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.brom_enq.lead_progress.length > 0) {
                        $('#followup_date').val(data.brom_enq.lead_progress[0].next_follow_up_date);
                        $('#time').val(data.brom_enq.lead_progress[0].next_follow_up_time);
                        $('[value="'+data.brom_enq.lead_progress[0].lead_type+'"]').prop('checked', true);
                        console.log(data.brom_enq.lead_progress[0]);
                    }
                    $('#progress_enquiry').val(data.brom_enq.enquiry);
                    $('#this_progress_data_id').val(data.brom_enq.id);
                    $('#status').val(data.brom_enq.status).trigger('change');
                    $('#showprogressmodal').modal('hide');
                    $('#progressModal').modal('show');
                }
            });
        }
        function showProgress(data) {
                $('.progress_data').html('')
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.getProgress') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        console.log('lead: ', data[0].lead);

                        // ---------------- display statically data -------
                        if (data.length > 0) {
                            $('#nameRead').text(data[0].lead.user_name)
                            $('#companyRead').text(data[0].lead.company)
                            $('#mobileRead').text(data[0].lead.mobile)
                            $('#emailRead').text(data[0].lead.email)
                            $('#planRead').text(data[0].lead.plan_interested.name)
                            $('#stateRead').text(data[0].lead.state.name)
                            $('#cityRead').text(data[0].lead.city.name)
                        }
                        // ---------------- display statically data -------
                        
                        for (let i = 0; i < data.length; i++) {
                            var str = '<tr>';
                            str += '   <td>' + data[i]['created_at'] + '</td>';
                            if (data[i]['progress'] !== null) {
                                str += '   <td>' + data[i]['progress'] + '</td>';
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

        function saveProgress(){
            let all_error = document.querySelectorAll('.invalid-error');

            all_error.forEach(element => {
                element.classList.add('d-none');
            });

            let valid = true;

            if($('#status').val() == '') {
                document.getElementById('status_error').classList.remove('d-none');
                valid = false;
            }

            if($('#followup_date').val() == '') {
                document.getElementById('followup_date_error').classList.remove('d-none');
                valid = false;
            }

            if($('#time').val() == '') {
                document.getElementById('time_error').classList.remove('d-none');
                valid = false;
            }

            if($('#progress_enquiry').val() == '') {
                document.getElementById('progress_enquiry_error').classList.remove('d-none');
                valid = false;
            }

            if (!valid) {
                return;
            }

            var id = $('#this_progress_data_id').val();

            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.saveProgress') }}",
                data: {
                    id: id,
                    status: $('#status').val(),
                    followup_date: $('#followup_date').val(),
                    time: $('#time').val(),
                    enquiry: $('#progress_enquiry').val(),
                    lead_type: $('input[name="lead_type"]:checked').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#leadTable').DataTable().draw();
                    $('#progressModal').modal('hide');
                },
                error:function(error) {
                    console.log(error);
                }
            });
        }

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
