@extends('admin.layouts.app')
@forelse ($configuration_settings as $progs)
    @if ($progs['dropdown_for'] == 'enquiry_progress')
        @push('page-css')
            @php
                $class_namee = isset(explode('___', $progs['name'])[0]) ? explode('___', $progs['name'])[0] : '';
                $class_colorr = isset(explode('___', $progs['name'])[1]) ? explode('___', $progs['name'])[1] : '';
                $class_namee = Helper::cleanString($class_namee);
            @endphp
        @endpush
    @endif
@empty
@endforelse
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
                            <h5 class="mb-3">List of Enquiries</h5>

                            <div class="col">

                                @can('enquiry-create')
                                    <a class="btn custom-icon-theme-button tooltip-btn" href="{{ route('admin.enquiry.add') }}"
                                        data-tooltip="Add Enquiry">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                @endcan

                                <button class="btn ms-3 custom-icon-theme-button tooltip-btn" type="button"
                                    data-bs-toggle="modal" data-bs-target="#filtermodal" data-tooltip="Filter"><i
                                        class="fa fa-filter"></i></button>

                                <button class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                    style="background-color: #FF0000 !important;display: none;" type="button"
                                    data-tooltip="Clear Filter" id="resetfilter"><i class="fa fa-refresh"></i></button>

                                <button class="btn matchbutton ms-3 custom-icon-theme-button tooltip-btn" type="button"
                                    data-bs-toggle="modal" data-bs-target="#matchModal" data-tooltip="Matching"><i
                                        class="fa fa-random"></i></button>

                                @can('export-enquiry')
                                    <button class="btn ms-3 custom-icon-theme-button tooltip-btn" onclick="exportEnquiry()"
                                        type="button" data-tooltip="Export"><i class="fa fa-upload"></i></button>
                                @endcan

                                <button class="btn ms-3 custom-icon-theme-button tooltip-btn" onclick="importEnquiries()"
                                    type="button" data-tooltip="Import"><i class="fa fa-download"></i></button>

                                @can('enquiry-delete')
                                    <button class="btn text-white delete_table_row ms-3 tooltip-btn"
                                        style="border-radius: 5px;display: none;background-color:red" onclick="deleteTableRow()"
                                        type="button" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="enquiryTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox"
                                                        name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Requirement</th>
                                            <th>Price</th>
                                            <th>Follow Up & Remarks</th>
                                            <th>Assigned</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="enquiryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Enquiry</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div class="row">
                                <h5 class="border-style">Customer Information</h5>
                                <div class="form-group col-md-3 m-b-20">
                                    <label for="Client Name">Client Name</label>
                                    <input class="form-control" name="client_name" id="client_name" type="text"
                                        autocomplete="off">
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <label for="Mobile">Mobile</label>
                                    <input class="form-control" name="client_mobile" id="client_mobile" type="text"
                                        autocomplete="off">
                                </div>
                                <div class="form-group col-md-4 m-b-20">
                                    <label for="Email">Email</label>
                                    <input class="form-control" name="client_email" id="client_email" type="email"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-1 m-b-20 ps-0">
                                    <div class="form-check checkbox checkbox-solid-success mb-0">
                                        <input class="form-check-input" id="is_nri" type="checkbox">
                                        <label class="form-check-label" for="is_nri">NRI</label>
                                    </div>
                                </div>
                                <div class="col-md-1 m-b-20 ps-0">
                                    <div class="form-check checkbox checkbox-solid-success mb-0 ps-0">
                                        <input class="form-check-input" id="is_favourite" type="checkbox">
                                        <label class="form-check-label" for="is_favourite">Favourite</label>
                                    </div>
                                </div>
                                <hr class="color-hr">
                                <h5 class="border-style mt-2">Customer Requirement</h5>

                                <div class="form-group col-md-2 m-b-20">
                                    <select class="form-select" id="enquiry_for">
                                        <option value=""> For</option>
                                        <option value="Rent">Rent</option>
                                        <option value="Buy">Buy</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5 m-b-20">
                                    <label class="select2_label" for="Requirement Type">Requirement Type</label>
                                    <select class="form-select" id="requirement_type" multiple>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_construction_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-5 m-b-20">
                                    <label class="select2_label" for="Property Type">Property Type</label>
                                    <select class="form-select" id="property_type" multiple>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_specific_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-2 m-b-20">
                                    <label for="Area From">Area From</label>
                                    <input class="form-control" name="area_size_from" id="area_size_from" type="text"
                                        autocomplete="off">
                                </div>

                                <div class="form-group col-md-2 m-b-20">
                                    <label for="Area To">Area To</label>
                                    <input class="form-control" name="area_size_to" id="area_size_to" type="text"
                                        autocomplete="off">
                                </div>

                                <div class="form-group col-md-2 m-b-20">
                                    <select class="form-select measure_select" id="area_measurement">
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                <option @if ($props['id'] == Session::get('default_measurement')) selected @endif
                                                    data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-2 m-b-20">
                                    <label class="select2_label" for="Configuration">Configuration</label>
                                    <select class="form-select" id="configuration" multiple>
                                        @forelse (config('constant.property_configuration') as $key=>$props)
                                            <option value="{{ $key }}">{{ $props }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-4 m-b-20">
                                    <select class="form-select" id="enquiry_source">
                                        <option value="">Enquiry Source</option>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_source')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-4 m-b-20">
                                    <label class="select2_label" for="Furnished Status">Furnished Status</label>
                                    <select class="form-select" id="furnished_status" multiple>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_furniture_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-2 m-b-20">
                                    <label for="Budget From">Budget From</label>
                                    <input class="form-control indian_currency_amount" name="budget" id="budget_from"
                                        type="text" autocomplete="off">
                                </div>

                                <div class="form-group col-md-2 m-b-20">
                                    <label for="Budget To">Budget To</label>
                                    <input class="form-control indian_currency_amount" name="budget_to" id="budget_to"
                                        type="text" autocomplete="off">
                                </div>

                                <div class="form-group col-md-2 m-b-20 mb-3">
                                    <select class="form-select" id="purpose">
                                        <option value="">Purpose</option>
                                        <option value="Investment">Investment</option>
                                        <option value="Own Use">Own Use</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 m-b-20 mb-3">
                                    <select class="form-select" id="enquiry_status">
                                        <option value="">Status</option>
                                        <option value="Active">Active</option>
                                        <option value="In Active">In Active</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4 m-b-20 mb-3">
                                    <label class="select2_label" for="Select Project"> Project</label>
                                    <select class="form-select" id="building_id" multiple>
                                        @foreach ($projects as $property)
                                            @if ($property->Projects && $property->Projects->project_name)
                                                <option value="{{ $property->project_id }}">
                                                    {{ $property->Projects->project_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-2 m-b-20 mb-3">
                                    <select class="form-select" id="project_status">
                                        <option value="">Project Status</option>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'building_progress')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-4 m-b-20 mb-3">
                                    <label class="select2_label" for="Area">Area</label>
                                    <select class="form-select" id="area_ids" multiple>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20">
                                    <input class="form-check-input" id="is_preleased" type="checkbox">
                                    <label class="form-check-label" for="is_preleased">Pre-leased</label>
                                </div>


                                <h5 class="border-style">Other Contact(s)</h5>
                                <div><button type="button" class="btn mb-3 btn-primary btn-air-primary"
                                        id="add_contacts">Add Contact</button></div>
                                <div class="row" id="all_contacts">

                                </div>

                                <h5 class="border-style">Remarks</h5>
                                <div class="form-group col-md-6 m-b-20 mt-1">
                                    <label for="Telephonic Discussion">Telephonic Discussion</label>
                                    <input class="form-control" name="telephonic_discussion" id="telephonic_discussion"
                                        type="text" autocomplete="off">
                                </div>

                                <div class="form-group col-md-6 m-b-20 mt-1">
                                    <label for="Highligths">Highligths</label>
                                    <input class="form-control" name="highlights" id="highlights" type="text"
                                        autocomplete="off">
                                </div>

                                <h5 class="border-style">Enquiry Allocation</h5>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="enquiry_city_id">
                                        <option value="">City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="enquiry_branch_id">
                                        <option value=""> branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">
                                                {{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="employee_id">
                                        <option value=""> Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (Auth::user()->can('enquiry-edit') || Auth::user()->can('enquiry-create'))
                                <button class="btn btn-secondary" id="saveEnquiry">Save</button>
                            @endif
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="filtermodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="filter_form" novalidate="">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <select class="form-select" id="filter_enquiry_for">
                                            <option value="">Enquiry For</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Buy">Buy</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <select class="form-select" id="filter_property_type">
                                            <option value="">Requirement Type</option>
                                            @forelse ($configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_construction_type' && in_array($props['id'], $prop_type))
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <label class="select2_label" for="Specific Property">Category</label>
                                        <select class="form-select" id="filter_specific_type" multiple>
                                            @forelse ($configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_specific_type')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_configuration">
                                            <option value="">Sub Category</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <select class="form-select" id="filter_employee_id">
                                            <option value=""> Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->first_name . ' ' . $employee->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <select class="form-select" id="filter_city_id">
                                            <option value=""> city</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <select class="form-select" id="filter_enquiry_branch_id">
                                            <option value=""> branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <label class="select2_label" for="Select Area"> Locality</label>
                                        <select class="form-select" id="filter_area_id" multiple>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-4">
                                        <select class="form-select" id="filter_enquiry_source">
                                            <option value="">Enquiry Source</option>
                                            @forelse ($configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_source')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <!-- Filter Progress -->
                                    <div class="form-group col-md-3 m-b-20 mb-4">
                                        <select class="form-select" id="filter_enquiry_progress">
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
                                                        $namee = isset(explode('___', $progs['name'])[0])
                                                            ? explode('___', $progs['name'])[0]
                                                            : '';
                                                    @endphp
                                                    <option value="{{ $progs['id'] }}"> {{ $namee }}</option>
                                                @endif
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_enquiry_status">
                                            <option value="">Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_sales_comment">
                                            <option value="">Sales Comments</option>
                                            @forelse ($configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'enquiry_sales_comment')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-7 m-b-20">
                                        <div class="col-12">
                                            <div class="m-checkbox-inline custom-radio-ml">
                                                <input type="hidden" name="filter_lead_type" value="" />
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" id="filter_lead_type_1"
                                                        type="radio" name="filter_lead_type" value="Hot Lead">
                                                    <label class="form-check-label mb-0" for="filter_lead_type_1">Hot
                                                        Lead</label>
                                                </div>
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" type="radio"
                                                        id="filter_lead_type_2" name="filter_lead_type"
                                                        value="Warm Lead">
                                                    <label class="form-check-label mb-0" for="filter_lead_type_2"> Warm
                                                        Lead</label>
                                                </div>
                                                <div class="form-check form-check-inline radio radio-primary">
                                                    <input class="form-check-input" id="filter_lead_type_3"
                                                        type="radio" name="filter_lead_type" value="Cold Lead">
                                                    <label class="form-check-label mb-0" for="filter_lead_type_3">Cold
                                                        Lead</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 m-b-20">
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_purpose">
                                            <option value="">Purpose</option>
                                            <option value="Investment">Investment</option>
                                            <option value="Own Use">Own Use</option>
                                        </select>
                                    </div>
                                    <hr class="color-hr">
                                    <div class="form-group col-md-6 m-b-4 mb-3 ">
                                        <label for="NFD From">Followup Date From: </label>
                                        <div class="input-group">
                                            <input class="form-control " id="filter_nfd_from" type="date"
                                                data-language="en">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-b-4 mb-3 ">
                                        <label for="NFD To">Followup Date To: </label>
                                        <div class="input-group">
                                            <input class="form-control " id="filter_nfd_to" type="date"
                                                data-language="en">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-b-4 mb-3">
                                        <label for="From Date">From Date</label>
                                        <div class="input-group">
                                            <input class="form-control " id="filter_from_date" type="date"
                                                data-language="en">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-b-4 mb-3">
                                        <label for="To Date">To Date</label>
                                        <div class="input-group">
                                            <input class="form-control " id="filter_to_date" type="date"
                                                data-language="en">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <label for="From Budget">From Budget</label>
                                        <input class="form-control indian_currency_amount" name="filter_from_budget"
                                            id="filter_from_budget" type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <label for="To Budget">To Budget</label>
                                        <input class="form-control indian_currency_amount" name="filter_to_budget"
                                            id="filter_to_budget" type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <label for="From Budget">From Area</label>
                                        <input class="form-control" name="filter_from_area" id="filter_from_area"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
                                        <label for="To Budget">To Area</label>
                                        <input class="form-control" name="filter_to_area" id="filter_to_area"
                                            type="text" autocomplete="off">
                                    </div>
                                    <hr class="color-hr">
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="filter_favourite" type="checkbox">
                                        <label class="form-check-label" for="filter_favourite">Favourite Enquiry</label>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="filter_new_enquiry" type="checkbox">
                                        <label class="form-check-label" for="filter_new_enquiry">New Enquiry</label>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="week_end_enq" type="checkbox">
                                        <label class="form-check-label" for="week_end_enq">Weekend</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button class="btn custom-theme-button" type="button" id="filtersearch">Filter</button>
                                <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="importmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Enquiries</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="import_form" novalidate="">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-5 m-b-20">
                                    <label for="Choose File">File</label>
                                    <input class="form-control" type="file" accept=".xlsx" name="import_file"
                                        id="import_file">
                                </div>
                                <br>
                                <div class="col-md-3 m-b-4 mb-4">
                                    <select class="form-select" name="project_id" data-error="#project_id_error"
                                        id="import_category">
                                        <option value="">Select Category</option>
                                        @forelse ($configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_specific_type')
                                                <option data-val="{{ $props['name'] }}" value="{{ $props['id'] }}">
                                                    {{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <br>
                                <div class="form-group col-md-5 m-b-10">
                                    <a id="import_url" href="{{ route('admin.importenquiryTemplate') }}">Download Sample
                                        file</a>
                                </div>
                                <br>
                            </div>
                            <button class="btn btn-secondary" id="importFile">Save</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="transfermodal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Transfer Enquiry</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="transfer_form" novalidate="">
                            @csrf
                            <div class="form-row">
                                <table class="table custom-table-design mt-2 table-responsive mb-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Assigned To</th>
                                            <th scope="col">Assigned By</th>
                                            <th scope="col">Assigned At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="assign-history-section"></tbody>
                                </table>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <input type="hidden" name="transfer_form_id" id="transfer_form_id">
                                    <select class="form-select" id="transfer_employee_id">
                                        <option value=""> Employee </option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-secondary" id="transferNow">Save</button>
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
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="progress_form"
                            novalidate="">
                            <input type="hidden" name="progress_enquiry_id" id="progress_enquiry_id">
                            @forelse ($configuration_settings as $progs)
                                @if ($progs['dropdown_for'] == 'enquiry_progress')
                                    @php
                                        $namee = isset(explode('___', $progs['name'])[0])
                                            ? explode('___', $progs['name'])[0]
                                            : '';
                                    @endphp
                                    <option value="{{ $progs['id'] }}"> {{ $namee }}</option>
                                @endif
                            @empty
                            @endforelse

                            <div class="row">
                                <div class="form-group col-md-4 m-b-20">
                                    <label class="mb-0">Enquiry Progress: </label>
                                    <select class="form-select" id="progress_enquiry_progress">
                                        <option value="">Enquiry Progress </option>
                                        <option value="New Lead">New Lead</option>
                                        <option value="Lead Confirmed"> Lead Confirmed</option>
                                        <option value="Discussion"> Discussion</option>
                                        <option value="Booked"> Booked</option>
                                        <option value="Lost"> Lost</option>
                                        @forelse ($configuration_settings as $progs)
                                            @if ($progs['dropdown_for'] == 'enquiry_progress')
                                                @php
                                                    $namee = isset(explode('___', $progs['name'])[0])
                                                        ? explode('___', $progs['name'])[0]
                                                        : '';
                                                @endphp
                                                <option value="{{ $progs['id'] }}"> {{ $namee }}</option>
                                            @endif
                                        @empty
                                        @endforelse

                                    </select>
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
                                <div class="form-group col-md-4 m-b-20">
                                    <label for="Site Visit Time" class="mb-0">Remind Before (Minutes):</label>
                                    <div class="form-group">
                                        <div class="fname">
                                            <select class="form-select" id="reminider_before_minute" multiple="multiple">
                                                <option value="" disabled>Select Minutes </option>
                                                <option value="30 mins">30 mins</option>
                                                <option value="1 hour">1 hour</option>
                                                <option value="90 mins">90 mins</option>
                                                <option value="120 mins">120 mins</option>
                                                <option value="24 hour">24 hour</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input class="form-control d-none" name="schedule_remind" id="schedule_remind"
                                        type="remarks" autocomplete="off">
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

                                <div class="form-group col-md-3 m-b-20">
                                    <label for="nfdDate" class="mb-0">Site Visit Date:</label>
                                    <input class="form-control limitYear4digits" id="site_visit_date1" name="nfdDate"
                                        max='31-12-2050' type="date" oninput="limitYearTo4Digits1()">
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <label for="nfdTime" class="mb-0">Site Visit Time:</label>
                                    <input class="form-control" id="site_visit_time1" name="nfdTime" type="time">
                                </div>

                                <div class="form-group col-md-12 m-b-20">
                                    <label for="remarks" class="mb-0">Remarks:</label>
                                    <input class="form-control" name="progress_remarks" id="progress_remarks"
                                        type="remarks" autocomplete="off">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn custom-theme-button" type="button" id="saveProgress">Save</button>
                                <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
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
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
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

        <!-- Schedule Modal -->
        <div class="modal fade" id="showschedulemodal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Show Schedule Visit</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="schedule_form"
                            novalidate="">
                            <input type="hidden" name="schedule_visit_id" id="schedule_visit_id">
                            <div class="row">
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <label class="mb-0">&nbsp;</label>
                                    <label class="select2_label" for="Property list">Property</label>
                                    <select class="form-select" id="property_list" multiple>
                                        @foreach ($projects as $property)
                                            @if ($property->Projects && $property->Projects->project_name)
                                                <option value="{{ $property->id }}">
                                                    {{ $property->Projects->project_name }}
                                                </option>
                                            @endif
                                        @endforeach
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
                                                {{ $employee->first_name . ' ' . $employee->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 m-b-20">
                                    <label for="Site Visit Time" class="mb-0">Remind Before (Minutes):</label>
                                    <div class="form-group">
                                        <div class="fname">
                                            <select class="form-select" id="reminider_before_minute" multiple="multiple">
                                                <option value="" disabled>Select Minutes </option>
                                                <option value="30 mins">30 mins</option>
                                                <option value="1 hour">1 hour</option>
                                                <option value="90 mins">90 mins</option>
                                                <option value="120 mins">120 mins</option>
                                                <option value="24 hour">24 hour</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input class="form-control d-none" name="schedule_remind" id="schedule_remind"
                                        type="remarks" autocomplete="off">
                                </div>

                                <div class="form-group col-md-3 m-b-20">
                                    <label for="site_visit_date" class="mb-0">Site Visit Date:</label>
                                    <input class="form-control limitYear4digits" id="site_visit_date"
                                        name="site_visit_date" type="date" oninput="limitYearTo4Digits()">
                                </div>
                                <div class="form-group col-md-3 m-b-20">
                                    <label for="site_visit_time" class="mb-0">Site Visit Time:</label>
                                    <input class="form-control" id="site_visit_time" name="site_visit_time"
                                        type="time">
                                </div>
                                <div class="form-group col-md-6 m-b-20">
                                    <label for="Site Visit Time" class="mb-0">Description:</label>
                                    <input class="form-control" name="schedule_description" id="schedule_description"
                                        type="remarks" autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 m-b-20">
                                        <div class="row">
                                            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-4 m-b-20">
                                                <input class="form-check-input" id="email_reminder_schedule"
                                                    type="checkbox" value="">
                                                <label class="form-check-label" for="email_reminder_schedule">Email
                                                    Reminder</label>
                                            </div>
                                            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-4 m-b-20">
                                                <input class="form-check-input" id="sms_reminder_schedule"
                                                    type="checkbox" value="">
                                                <label class="form-check-label" for="sms_reminder_schedule">SMS
                                                    Reminder</label>
                                            </div>
                                            <div class="form-check checkbox checkbox-solid-success mb-0 col-md-4 m-b-20">
                                                <input class="form-check-input" id="wp_reminder" type="checkbox"
                                                    value="">
                                                <label class="form-check-label" for="wp_reminder">Whatsapp
                                                    Reminder</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-b-20">
                                        <div class="col-12">
                                            <div class="m-checkbox-inline custom-radio-ml">
                                                <input type="hidden" name="filter_lead_type" value="" />
                                                <div class="form-check form-check-inline radio radio-primary m-b-20">
                                                    <input class="form-check-input" id="filter_lead_type_11"
                                                        type="radio" name="filter_lead_type" value="Hot Lead" />
                                                    <label class="form-check-label mb-0" for="filter_lead_type_11">Hot
                                                        Lead</label>
                                                </div>

                                                <div class="form-check form-check-inline radio radio-primary m-b-20">
                                                    <input class="form-check-input" type="radio"
                                                        id="filter_lead_type_12" name="filter_lead_type"
                                                        value="Warm Lead" />
                                                    <label class="form-check-label mb-0" for="filter_lead_type_12">Warm
                                                        Lead</label>
                                                </div>

                                                <div class="form-check form-check-inline radio radio-primary m-b-20">
                                                    <input class="form-check-input" id="filter_lead_type_13"
                                                        type="radio" name="filter_lead_type" value="Cold Lead" />
                                                    <label class="form-check-label mb-0" for="filter_lead_type_13">Cold
                                                        Lead</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <button class="btn btn-secondary" id="saveSchedule" data-id="">Save</button>

                        <table class="table custom-table-design mt-2">
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
                            <tbody class="schedule_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contactlistmodal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contact List</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="contact_list_form"
                            novalidate="">
                            <div><button type="button" class="btn mb-2 btn-primary btn-air-primary"
                                    id="add_contactsToList">Add Contact</button></div>
                            <input type="hidden" name="contact_list_enquiry_id" id="contact_list_enquiry_id">
                            <div class="row" id="all_contact_list_data">

                            </div>
                            <button class="btn btn-secondary" id="saveContactList">Save</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="matchModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Match By</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation" method="post" id="match_modal" novalidate="">
                            @csrf
                            <div>
                                <div class="row" id="matchbyfield">
                                    <div class="col-md-6">
                                        <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                            <input class="form-check-input" id="match_enquiry_all" type="checkbox">
                                            <label class="form-check-label" for="match_enquiry_all">Select All</label>
                                        </div>
                                        <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                            <input class="form-check-input" checked id="match_enquiry_for"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_enquiry_for">Enquiry For</label>
                                        </div>
                                        <div
                                            class="form-check checkbox  checkbox-solid-success mb-0 m-b-10 the_enquiry_sub_cat">
                                            <input class="form-check-input" checked id="match_specific_sub_type"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_specific_sub_type">Enquiry Sub
                                                Category</label>
                                        </div>
                                        <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                            <input class="form-check-input" checked id="match_budget_from_type"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_budget_from_type">Enquiry
                                                Budget</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                            <input class="form-check-input" checked id="match_property_type"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_property_type">Enquiry
                                                Requirement</label>
                                        </div>
                                        <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                            <input class="form-check-input" checked id="match_specific_type"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_specific_type">Enquiry
                                                Category</label>
                                        </div>
                                        <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                            <input class="form-check-input" checked id="match_enquiry_size"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_enquiry_size">Enquiry Size</label>
                                        </div>
                                        <div class="form-check checkbox the_matching_weekend checkbox-solid-success mb-0 m-b-10"
                                            style="display: none">
                                            <input class="form-check-input" checked id="match_enquiry_weekend"
                                                type="checkbox">
                                            <label class="form-check-label" for="match_enquiry_weekend">Property
                                                Weekend</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn custom-theme-button" type="button" id="matchagain">Match</button>
                                <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div hidden>
            <div id="mypopover-content">
                <div class="custom-tooltip-content">
                    <div class="d-block w-100 blue-inq"><i class="fa fa-square"></i> New Lead</div>
                    <div class="d-block w-100 org-inq"><i class="fa fa-square"></i> Lead Confirmed</div>
                    <div class="d-block w-100 purple-inq"><i class="fa fa-square"></i> Site Visit Scheduled</div>
                    <div class="d-block w-100 yellow-inq"><i class="fa fa-square"></i> Site Visit Completed</div>
                    <div class="d-block w-100 lblue-inq"><i class="fa fa-square"></i> Discussion</div>
                    <div class="d-block w-100 green-inq"><i class="fa fa-square"></i> Booked</div>
                    <div class="d-block w-100 pink-inq"><i class="fa fa-square"></i> Lost</div>
                    @forelse ($configuration_settings as $progs)
                        @if ($progs['dropdown_for'] == 'enquiry_progress')
                            @php
                                $namee = isset(explode('___', $progs['name'])[0])
                                    ? explode('___', $progs['name'])[0]
                                    : '';
                                $colorr = isset(explode('___', $progs['name'])[1])
                                    ? explode('___', $progs['name'])[1]
                                    : '';
                                $class_namee = Helper::cleanString($namee);

                            @endphp
                            <div class="d-block w-100 {{ $class_namee }}"><i class="fa fa-square"></i>
                                {{ $namee }}
                            </div>
                        @endif
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

        <?php
            $matchEnquiryFor = isset($_GET['match_enquiry_for']) ? $_GET['match_enquiry_for'] : null;
            $matchPropertyType = isset($_GET['match_property_type']) ? $_GET['match_property_type'] : null;
            $matchSpecificType = isset($_GET['match_specific_type']) ? $_GET['match_specific_type'] : null;
            $matchSpecificSubType = isset($_GET['match_specific_sub_type']) ? $_GET['match_specific_sub_type'] : null;
            $matchEnquiryWeekend = isset($_GET['match_enquiry_weekend']) ? $_GET['match_enquiry_weekend'] : null;
            $matchBudgetType = isset($_GET['match_budget_from_type']) ? $_GET['match_budget_from_type'] : null;
            $matchEnqSize = isset($_GET['match_enquiry_size']) ? $_GET['match_enquiry_size'] : null;
            $matchEnqSource = isset($_GET['match_inquiry_source']) ? $_GET['match_inquiry_source'] : null;
        ?>
    @endsection
    @push('scripts')
        <script>

            let filter_apply = 0;

            $(document).on('change', '#import_category', function() {
                var type = $('#import_category option:selected').attr('data-val')
                $('#import_url').attr('href', $('#import_url').attr('href') + '?type=' + type);
            })

            function limitYearTo4Digits1() {
                const dateInput = document.getElementById('site_visit_date1');
                const inputValue = dateInput.value;
                const parts = inputValue.split('-');
                if (parts.length === 3) {
                    const year = parts[0].trim();
                    if (year.length > 4) {
                        parts[0] = year.slice(-4);
                    }
                    const formattedDate = parts.join('-');
                    dateInput.value = formattedDate;
                }
            }

            function limitYearTo4Digits() {
                const dateInput = document.getElementById('site_visit_date');
                const inputValue = dateInput.value;

                const parts = inputValue.split('-');

                if (parts.length === 3) {
                    const year = parts[0].trim();
                    if (year.length > 4) {
                        parts[0] = year.slice(-4);
                    }

                    const formattedDate = parts.join('-');

                    dateInput.value = formattedDate;
                }
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#match_enquiry_for').prop('checked', <?= $matchEnquiryFor === '1' ? 'true' : 'false' ?>);
                $('#match_property_type').prop('checked', <?= $matchPropertyType === '1' ? 'true' : 'false' ?>);
                $('#match_specific_type').prop('checked', <?= $matchSpecificType === '1' ? 'true' : 'false' ?>);
                $('#match_specific_sub_type').prop('checked', <?= $matchSpecificSubType === '1' ? 'true' : 'false' ?>);
                $('#match_enquiry_weekend').prop('checked', <?= $matchEnquiryWeekend === '1' ? 'true' : 'false' ?>);

                $('#match_budget_from_type').prop('checked', <?= $matchBudgetType === '1' ? 'true' : 'false' ?>);
                $('#match_enquiry_size').prop('checked', <?= $matchEnqSize === '1' ? 'true' : 'false' ?>);
                $('#match_inquiry_source').prop('checked', <?= $matchEnqSource === '1' ? 'true' : 'false' ?>);

            });
            $(document).ready(function() {
                const enquiryProgressDropdown = document.getElementById('progress_enquiry_progress');
                $('#progress_enquiry_progress').on('change', function() {
                    const selectedValue = this.value;
                    const options = enquiryProgressDropdown.options;
                    if (selectedValue === 'Lead Confirmed') {
                        removeOption('New Lead');
                    } else if (selectedValue === 'Discussion') {
                        removeOption('New Lead');
                        removeOption('Lead Confirmed');
                    } else if (selectedValue === 'Booked') {
                        removeOption('New Lead');
                        removeOption('Lead Confirmed');
                        removeOption('Discussion');
                    } else if (selectedValue === 'Lost') {
                        removeOption('New Lead');
                        removeOption('Lead Confirmed');
                        removeOption('Discussion');
                        removeOption('Booked');
                    }
                });

                function removeOption(value) {
                    for (let i = 0; i < enquiryProgressDropdown.options.length; i++) {
                        if (enquiryProgressDropdown.options[i].value === value) {
                            enquiryProgressDropdown.remove(i);
                            break;
                        }
                    }
                }
            });

            $('#filter_specific_type').on('change', function() {
                var selectedCategories = [];
                $('#filter_specific_type option:selected').each(function() {
                    selectedCategories.push($(this).text().trim());
                });

                var url = "{{ route('admin.getEnquiryConfiguration') }}";

                try {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET",
                        `${url}?selectedCategories=${encodeURIComponent(JSON.stringify(selectedCategories))}`, true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);

                                var subCategorySelect = document.getElementById('filter_configuration');
                                subCategorySelect.innerHTML = '<option value="">Sub Category</option>';

                                for (var key in data) {
                                    if (data.hasOwnProperty(key)) {
                                        var option = document.createElement('option');
                                        option.value = key;
                                        option.text = data[key];
                                        option.dataset.category = data[key];
                                        subCategorySelect.appendChild(option);
                                    }
                                }
                            } else {
                            }
                        }
                    };

                    xhr.send();
                } catch (error) {
                }
            });

            var search_enq = '';
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var enqq = urlParams.get('pro')
            var filter_by = urlParams.get('filter_by')
            var calendar_date = urlParams.get('date')
            var calendar_type = urlParams.get('type')

            $('.matchbutton').hide()
            try {
                search_enq = decryptSimpleString(enqq);
                if (search_enq != '') {
                    $('.matchbutton').show()
                } else {
                    $('.matchbutton').hide()
                }
            } catch (error) {
            }

            $(document).on('click', '#matchagain', function(e) {
                e.preventDefault();
                let selectedCheckboxes = {
                    match_enquiry_for: $('#match_enquiry_for').prop('checked') ? 1 : 0,
                    match_property_type: $('#match_property_type').prop('checked') ? 1 : 0,
                    match_specific_type: $('#match_specific_type').prop('checked') ? 1 : 0,
                    match_specific_sub_type: $('#match_specific_sub_type').prop('checked') ? 1 : 0,
                    match_enquiry_weekend: $('#match_enquiry_weekend').prop('checked') ? 1 : 0,
                    match_budget_from_type: $('#match_budget_from_type').prop('checked') ? 1 : 0,
                    match_enquiry_size: $('#match_enquiry_size').prop('checked') ? 1 : 0,
                    match_inquiry_source: $('#match_inquiry_source').prop('checked') ? 1 : 0,
                };

                let queryString = Object.entries(selectedCheckboxes)
                    .filter(([key, value]) => value === 1)
                    .map(([key, value]) => `${key}=${value}`)
                    .join('&');

                let dataId = $(this).attr('data-id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.enquiry.category') }}",
                    data: {
                        id: dataId
                    },
                    success: function(data) {
                        let redirectUrl;
                        if (data.property_type == 261) {
                            redirectUrl = "{{ route('admin.industrial.properties') }}";
                        } else if (data.property_type == 262 || data.property_type == 256) {
                            redirectUrl = "{{ route('admin.land.properties') }}";
                        } else {
                            redirectUrl = "{{ route('admin.properties') }}";
                        }
                        let url = redirectUrl + '?' + queryString + '&enq=' + encryptSimpleString(dataId);
                        window.location = url;
                    },
                    error: function(xhr, status, error) {
                    }
                });
            });

            function matchingProperty(data) {
                $('#matchModal').modal('show');
                let enquiryId = $(data).attr('data-id');
                $('#matchagain').attr('data-id', enquiryId);
            }

            $(document).on('change', '#select_all_checkbox', function(e) {
                if ($(this).prop('checked')) {
                    $('.delete_table_row').show();
                    $(".table_checkbox").each(function(index) {
                        $(this).prop('checked', true)
                    })
                } else {
                    $('.delete_table_row').hide();
                    $(".table_checkbox").each(function(index) {
                        $(this).prop('checked', false)
                    })
                }
            })

            $(document).on('change', '.table_checkbox', function(e) {
                var rowss = [];
                $(".table_checkbox").each(function(index) {
                    if ($(this).prop('checked')) {
                        rowss.push($(this).attr('data-id'))
                    }
                })
                if (rowss.length > 0) {
                    $('.delete_table_row').show();
                } else {
                    $('.delete_table_row').hide();
                }
            })

            function deleteTableRow(params) {
                var rowss = [];
                $(".table_checkbox").each(function(index) {
                    if ($(this).prop('checked')) {
                        rowss.push($(this).attr('data-id'))
                    }
                })
                if (rowss.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                    }).then(function(isConfirm) {
                        if (isConfirm.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.deleteEnquiry') }}",
                                data: {
                                    allids: JSON.stringify(rowss),
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    $('.delete_table_row').hide();
                                    $('#enquiryTable').DataTable().draw();
                                }
                            });
                        }
                    })
                }
            }

            function exportEnquiry(params) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.export.enquiry') }}",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        window.open(data)
                    }
                });
            }

            function importEnquiries(params) {
                $('#importmodal').modal('show');
            }

            $(document).ready(function() {

                $(function() {
                    $("body").tooltip({
                        selector: '[data-toggle=tooltip]'
                    });
                })

                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var go_data_id = urlParams.get('data_id')
                if (window.location.pathname.toLowerCase() === '/admin/enquiries' && window.location.search === '?') {
                    $('#match_enquiry_all, #match_enquiry_for, #match_property_type, #match_specific_type, #match_specific_sub_type, #match_enquiry_weekend, #match_budget_from_type, #match_enquiry_size, #match_inquiry_source')
                        .prop('checked', true);
                }

                $('#match_enquiry_all').on('change', function() {
                    let isChecked = $(this).prop('checked');
                    $('#match_enquiry_for, #match_property_type, #match_specific_type, #match_specific_sub_type, #match_enquiry_weekend, #match_budget_from_type, #match_enquiry_size, #match_inquiry_source')
                        .prop('checked', isChecked);
                });


                $('#enquiryTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.enquiries') }}",
                        data: function(d) {
                            d.filter_city_id = $('#filter_city_id').val();
                            d.filter_enquiry_branch_id = $('#filter_enquiry_branch_id').val();
                            d.filter_employee_id = $('#filter_employee_id').val();
                            d.filter_property_type = $('#filter_property_type').val();
                            d.filter_configuration = $('#filter_configuration').val();
                            d.filter_specific_type = JSON.stringify($('#filter_specific_type').val());
                            d.filter_area_id = JSON.stringify($('#filter_area_id').val());
                            d.filter_enquiry_for = $('#filter_enquiry_for').val();
                            d.filter_enquiry_source = $('#filter_enquiry_source').val();
                            d.filter_enquiry_progress = $('#filter_enquiry_progress').val();
                            d.filter_enquiry_status = $('#filter_enquiry_status').val();
                            d.filter_sales_comment = $('#filter_sales_comment').val();
                            d.filter_lead_type = $('input[name="filter_lead_type"]:checked').val();
                            d.filter_purpose = $('#filter_purpose').val();
                            d.filter_nfd_from = $('#filter_nfd_from').val();
                            d.filter_nfd_to = $('#filter_nfd_to').val();
                            d.filter_from_date = $('#filter_from_date').val();
                            d.filter_to_date = $('#filter_to_date').val();
                            d.filter_from_budget = $('#filter_from_budget').val();
                            d.filter_to_budget = $('#filter_to_budget').val();
                            d.filter_from_area = $('#filter_from_area').val();
                            d.filter_to_area = $('#filter_to_area').val();
                            d.filter_favourite = Number($('#filter_favourite').prop('checked'));
                            d.filter_new_enquiry = Number($('#filter_new_enquiry').prop('checked'));
                            d.week_end_enq = Number($('#week_end_enq').prop('checked'));
                            d.go_data_id = go_data_id;
                            d.search_enq = search_enq;
                            d.match_property_type = Number($('#match_property_type').prop('checked'));
                            d.match_specific_type = Number($('#match_specific_type').prop('checked'));
                            d.match_specific_sub_type = Number($('#match_specific_sub_type').prop(
                                'checked'));
                            d.match_enquiry_weekend = Number($('#match_enquiry_weekend').prop('checked'));
                            d.match_budget_from_type = Number($('#match_budget_from_type').prop('checked'));
                            d.match_enquiry_for = Number($('#match_enquiry_for').prop('checked'));
                            d.match_inquiry_source = Number($('#match_inquiry_source').prop('checked'));
                            d.match_enquiry_size = Number($('#match_enquiry_size').prop('checked'));
                            d.filter_by = filter_by;
                            d.calendar_date = calendar_date;
                            d.calendar_type = calendar_type;
                            d.filter_apply = filter_apply;
                        },
                    },
                    columns: [{
                            data: 'select_checkbox',
                            name: 'select_checkbox',
                            orderable: false
                        },
                        {
                            data: 'client_name',
                            name: 'client_name'
                        },
                        {
                            data: 'client_requirement',
                            name: 'client_requirement'
                        },
                        {
                            data: 'budget',
                            name: 'budget'
                        },
                        {
                            data: 'telephonic_discussion',
                            name: 'telephonic_discussion',
                            render: function(data, type, full, meta) {
                                if (data && data.length > 100) {
                                    return '<div style="max-width:250px"><span class="truncated">' +
                                        data.substr(0, 100) +
                                        '...</span><span class="full" style="display:none;">' + data +
                                        '</span><span class="read-more">Read More</span></div>';
                                } else {
                                    return `<div style="max-width:250px"><span class="truncated full">${data}</span></div>`;
                                }
                            }
                        },
                        {
                            data: 'assigned_to',
                            name: 'assigned_to'
                        },
                        {
                            data: 'Actions2',
                            name: 'Actions2',
                            orderable: false
                        },
                    ],
                    columnDefs: [{
                            "width": "3%",
                            "targets": 0
                        }, {
                            "width": "15%",
                            "targets": 1
                        },
                        {
                            "width": "20%",
                            "targets": 2
                        },
                        {
                            "width": "13%",
                            "targets": 3
                        },
                        {
                            "width": "18%",
                            "targets": 4
                        },
                        {
                            "width": "9.99%",
                            "targets": 5
                        },
                        {
                            "width": "15%",
                            "targets": 6
                        }
                    ],
                    "createdRow": function(row, data, dataIndex) {
                        if (data['enq_status'] == 0) {
                            $(row).addClass('important-row');
                        }
                    },
                    "drawCallback": function(settings, json) {
                        $('.color-code-popover').attr('data-bs-content', $('#mypopover-content').html());
                        setTimeout(() => {
                            $('.color-code-popover').popover({
                                html: true,
                            });
                        }, 500);
                        var popoverTriggerList = [].slice.call(document.querySelectorAll(
                            '[data-bs-toggle="popover"]'))
                        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                            return new bootstrap.Popover(popoverTriggerEl)
                        });
                    }
                });
            });

            $('#enquiryTable .read-more, #enquiryTable .read-less').css('cursor', 'pointer');
            $('#enquiryTable').on('click', '.read-more', function() {
                $(this).siblings('.truncated').hide();
                $(this).siblings('.full').show();
                $(this).text(' ...Read Less').removeClass('read-more').addClass('read-less');
            });
            $('#enquiryTable').on('click', '.read-less', function() {
                $(this).siblings('.full').hide();
                $(this).siblings('.truncated').show();
                $(this).text('...Read More').removeClass('read-less').addClass('read-more');
            });

            function matchingProperty(data) {
                $('#matchModal').modal('show');
                let enquiryId = $(data).attr('data-id'); // Retrieve data-id attribute from 'data' parameter
                $('#matchagain').attr('data-id', enquiryId); // Set data-id attribute for #matchagain button
                getEnquiryCategory(enquiryId);
            }

            function getEnquiryCategory(enquiryID) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.enquiry.category') }}",
                    data: {
                        id: enquiryID, // Pass the enquiryID directly
                    },
                    success: function(data) {

                        if (typeof data.configuration === "string") {
                            try {
                                data.configuration = JSON.parse(data.configuration);
                            } catch (e) {
                            }
                        }

                        if (Array.isArray(data.configuration)) {
                            let configValue = data.configuration[0]; // Access the first element
                            if (configValue === "15" && data.weekend_enq == '1') {
                                $('.the_matching_weekend').show();
                            } else {
                                $('.the_matching_weekend').hide();
                            }
                        } else if (data.configuration == 0) {
                            $('.the_enquiry_sub_cat').hide();
                        } else {
                            $('.the_enquiry_sub_cat').show();
                        }

                    },
                    error: function(xhr, status, error) {
                    }
                });
            }


            $(document).on('click', '#filtersearch', function(e) {
                e.preventDefault();
                filter_apply = 1;
                go_data_id = '';
                $('#enquiryTable').DataTable().draw();
                $('#resetfilter').removeClass('d-none');
                $('#filtermodal').modal('hide');
                $('#resetfilter').show();
            });

            $(document).on('click', '#resetfilter', function(e) {
                e.preventDefault();
                filter_apply = 0;
                $(this).hide();
                $('#filter_form').trigger("reset");
                $('#enquiryTable').DataTable().draw();
                $('#filtermodal').modal('hide');
                triggerResetFilter()
            });

            $(document).on("click", ".open_modal_with_this", function(e) {
                $('#all_contacts').html('')
                $('#all_contacts').append(generate_contact_detail(makeid(10)));
                $("#all_contacts select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            })

            $(document).on('change', '#filter_property_type', function(e) {
                var parent_value = $(this).val();
                $("#filter_specific_type option , #filter_configuration option").each(function() {
                    if (parent_value !== '') {
                        if ($(this).attr('value') != '') {
                            if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                                parent_value) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        }
                    } else {
                        $(this).show();
                    }
                });
            });

            $(document).on('change', '.changeTheStatus', function(e) {
                stat = 0;
                if ($(this).prop('checked')) {
                    stat = 1;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.changeEnquiryStatus') }}",
                    data: {
                        id: $(this).attr('data-id'),
                        status: stat,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                    }
                });
            })

            function getEnquiry(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getEnquiry') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('#this_data_id').val(data.id);
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
                        $('#enquiryModal').modal('show');
                        $('#all_contacts').html('')
                        $('#all_contact_list_data').html('')
                        if (data.other_contacts != '') {
                            details = JSON.parse(data.other_contacts);
                            try {
                                for (let i = 0; i < details.length; i++) {
                                    id = makeid(10);
                                    $('#all_contacts').append(generate_contact_detail(id))
                                    floatingField();
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
                        floatingField();
                    }
                });
            }

            function deleteEnquiry(data) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function(isConfirm) {
                    if (isConfirm.isConfirmed) {
                        var id = $(data).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.deleteEnquiry') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#enquiryTable').DataTable().draw();
                            }
                        });
                    }
                })
            }

            $.validator.addMethod("maxDate", function(value, element) {
                var curDate = new Date("2050-12-31");
                var inputDate = new Date(value);
                var isTyped = $(element).data('isTyped');

                if (value === '') {
                    return true;
                }

                if (inputDate < curDate) {
                    if (isTyped) {
                        return false; // Typed date is invalid
                    }
                    return true;
                }

                return false; // Invalid date
            }, function(params, element) {
                var isTyped = $(element).data('isTyped');

                if (isTyped) {
                    return ""; // Error message for typed date
                }
                return "Invalid Date!"; // Default error message
            });

            // save progress
            $(document).on('click', '#saveProgress', function(e) {
                e.preventDefault();
                if (!$('#progress_form').valid()) {
                    return;
                }
                $(this).prop('disabled', true);

                var id = $('#progress_enquiry_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveProgress') }}",
                    data: {
                        enquiry_id: id,
                        progress: $('#progress_enquiry_progress').val(),
                        lead_type: $('input[name="progress_lead_type"]:checked').val(),
                        sales_comment_id: $('#progress_sales_comment').val(),
                        nfd: $('#site_visit_date1').val() + ' ' + $('#site_visit_time1').val(),
                        remarks: $('#progress_remarks').val(),
                        time_before: JSON.stringify($('#reminider_before_minute').val()),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#enquiryTable').DataTable().draw();
                        $('#progressmodal').modal('hide');
                        $('#saveProgress').prop('disabled', false);
                    }
                });
            });

            // save Schedule Visit
            $(document).on('click', '#saveSchedule', function(e) {
                e.preventDefault();
                if (!$('#schedule_form').valid()) {
                    return
                }
                $(this).prop('disabled', true);
                var id = $('#schedule_visit_id').val()

                reminder_time_before = $('#reminider_before_minute').val();
                var email_reminder = document.getElementById("email_reminder_schedule");
                var sms_reminder = document.getElementById("sms_reminder_schedule");
                var email = email_reminder.checked == true ? 1 : 0;
                var sms = sms_reminder.checked == true ? 1 : 0;


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveSchedule') }}",
                    data: {
                        enquiry_id: id,
                        visit_status: $('#schedule_visit_status').val(),
                        description: $('#schedule_description').val(),
                        visit_date: $('#site_visit_date').val() + ' ' + $('#site_visit_time').val(),
                        assigned_to: $('#schedule_assigned_to').val(),
                        schedule_remind: $('#schedule_remind').val(),
                        property_list: JSON.stringify($('#property_list').val()),
                        lead_type: $('input[name="filter_lead_type"]:checked').val(),
                        time_before: JSON.stringify(reminder_time_before),
                        email_reminder: email,
                        sms_reminder: sms,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#enquiryTable').DataTable().draw();
                        $('#showschedulemodal').modal('hide');
                        $('#saveSchedule').prop('disabled', false);
                    },
                    error: function(data) {
                        $('#saveSchedule').prop('disabled', false);
                    }
                });
                $("#schedule_form select").each(function(index) {
                    $(this).val('').trigger('change');
                })
                $('#schedule_form')[0].reset();
                getScheduleVisit(id)
            });

            function transferEnquiry(data) {
                var id = $(data).attr('data-id');
                var employee = $(data).attr('data-employee');
                assignHistory(id);
                $('#transfer_form_id').val(id);
                $('#transfer_employee_id').val(employee)
                $('#transfermodal').modal('show');
            }

            function assignHistory(id) {
                var call_url = "{{ route('admin.get.assign.history') }}?id=" + id;
                $.ajax({
                    type: "POST",
                    url: call_url,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#assign-history-section').html(data.html);
                    }
                });
            }

            $(document).on('click', '#transferNow', function(e) {
                e.preventDefault();
                var id = $('#transfer_form_id').val()
                var employee = $('#transfer_employee_id').val()
                if (employee) {
                    $('#transfermodal').modal('hide');
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.transferEnquiry') }}",
                    data: {
                        enquiry_id: id,
                        employee: employee,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#enquiryTable').DataTable().draw();
                        $('#transfermodal').modal('hide');
                    }
                });
            });

            $(document).on('click', '.showNumberNow', function(e) {
                numb = $(this).attr('data-val');
                $(this).replaceWith('<a href="tel:' + numb + '">' + numb + '</a>');
            })

            function contactList(data) {
                $('#all_contacts').html('')
                $('#all_contact_list_data').html('')
                $('#contact_list_form')[0].reset();
                $('#contact_list_enquiry_id').val($(data).attr('data-id'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getContactList') }}",
                    data: {
                        enquiry_id: $(data).attr('data-id'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data != '') {
                            details = JSON.parse(data);
                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                $('#all_contact_list_data').append(generate_contact_detail(id))
                                floatingField()

                                $("[data-contact_id=" + id + "] select[name=contact_status]").select2()
                                $("[data-contact_id=" + id + "] input[name=contact_person_name]").val(details[i][
                                    0
                                ]);
                                $("[data-contact_id=" + id + "] input[name=contact_person_no]").val(details[i][1]);
                                $("[data-contact_id=" + id + "] select[name=contact_status]").val(details[i][2])
                                    .trigger('change');
                                $("[data-contact_id=" + id + "] input[name=contact_nri]").prop('checked', Number(
                                    details[i][3]));
                            }
                            triggerChangeinput()
                            floatingField();
                        }
                    }
                });
                $('#contactlistmodal').modal('show');
            }

            $(document).on('click', '#saveContactList', function(e) {
                e.preventDefault();
                $(this).prop('disabled', true);
                var id = $('#contact_list_enquiry_id').val()
                contact_details = [];
                $("#all_contact_list_data [name=contact_person_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).closest('.form-group').attr('data-contact_id');
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
                    url: "{{ route('admin.saveContactList') }}",
                    data: {
                        enquiry_id: id,
                        contacts: contact_details,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#contactlistmodal').modal('hide');
                        $('#saveContactList').prop('disabled', false);
                    }
                });
            })

            function addProgress(data) {
                $('#progress_form')[0].reset();
                $('#showprogressmodal').modal('hide');
                $('#progressmodal').modal('show');
                $('#progress_enquiry_id').val($(data).attr('data-id'));
            }

            function showProgress(data) {
                $('.progress_data').html('')
                var id = $(data).attr('data-id');
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

            function getScheduleVisit(id) {
                $('.schedule_data').html('')
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getSchedule') }}",
                    data: {
                        id: id,
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
                                str += '<td></td>';
                            }
                            $('.schedule_data').append(str.replace('null', ''))
                        }
                    }
                });
            }

            function showScheduleVisit(data) {
                var id = $(data).attr('data-id');
                var employee = $(data).attr('data-employee');
                getScheduleVisit(id)
                $('#schedule_form')[0].reset();
                $('#schedule_visit_id').val(id);
                $('#schedule_assigned_to').val(employee).trigger('change');
                $('#showschedulemodal').modal('show');
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
                var myvar = '<div data-contact-id=' + id + ' class="row"><div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-20">' +
                    '<label>Contact person</label>' +
                    '       <input class="form-control" name="contact_person_name" type="text"' +
                    '            autocomplete="off">' +
                    '     </div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-20">' +
                    '<label>Contact person No</label>' +
                    '       <input class="form-control" name="contact_person_no"' +
                    '           type="text"  autocomplete="off">' +
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
                    ' class="remove_contacts btn btn-danger btn-air-danger" type="button">-</button>  </div></div>';
                return myvar;
            }

            $(document).on('click', '#add_contacts', function(e) {
                id = makeid(10);
                $('#all_contacts').append(generate_contact_detail(id));
                $("#all_contacts select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            })

            $(document).on('click', '#add_contactsToList', function(e) {
                id = makeid(10);
                $('#all_contact_list_data').append(generate_contact_detail(id));
                $("#all_contact_list_data select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            })

            $(document).on('click', '.remove_contacts', function(e) {
                id = $(this).attr('data-contact_id');
                $("[data-contact_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            function convertToNumber(params) {
                return Number(params.replaceAll(",", ""));
            }

            $.validator.addMethod("checkBudget", function(value, element) {
                val2 = $('#budget_from').val()
                if (value != '' && val2 != '') {
                    if (convertToNumber(value) < convertToNumber(val2)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }, 'Budget To Must be greater than budget from hereeee');

            $.validator.addMethod("checkArea", function(value, element) {
                val2 = $('#area_size_from').val()
                if (val2 != '' && value != '') {
                    if (Number(value) < Number(val2)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }, 'Area To Must be greater than area from');

            $('#modal_form').validate({ // initialize the plugin
                rules: {
                    client_name: {
                        required: true,
                    },
                    client_email: {
                        email: true,
                    },
                    area_size_from: {
                        digits: true,
                    },
                    area_size_to: {
                        digits: true,
                        checkArea: true,
                    },
                    budget_to: {
                        checkBudget: true,
                    },
                },
                submitHandler: function(form) { // for demo
                    alert('valid form submitted'); // for demo
                    return false; // for demo
                }
            });


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
                    unique_id = $(this).closest('.form-group').attr('data-contact_id');
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

                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveEnquiry') }}",
                    data: {
                        id: $('#this_data_id').val(),
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
                        $('#enquiryTable').DataTable().draw();
                        $('#enquiryModal').modal('hide');
                        $('#saveEnquiry').prop('disabled', false);
                    }
                });
            })


            $(document).on('click', '#importFile', function(e) {
                e.preventDefault();
                var formData = new FormData();
                var files = $('#import_file')[0].files[0];
                if (files == '') {
                    return;
                }
                formData.append('csv_file', files);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "{{ route('admin.importenquiry') }}",
                    data: formData,
                    success: function(data) {
                        $('#enquiryTable').DataTable().draw();
                        $('#importmodal').modal('hide');
                        $('#import_form')[0].reset();
                    }
                });
            })

            function floatingField() {
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
            }
        </script>
    @endpush
