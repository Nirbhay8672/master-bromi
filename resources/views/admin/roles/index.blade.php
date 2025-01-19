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
                            <h5 class="mb-3">List of Roles <a  
                                class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            
                            @can('role-create')
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#roleModal"
                                        data-tooltip="Add Role"
                                        onclick="setDefault()"
                                    ><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="roleTable">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Actions</th>
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
        <div class="modal fade" id="roleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div class="row">
                                <div class="form-group col-md-12 m-b-20">
                                    <label for="Role">Role</label>
                                    <input class="form-control" name="name" id="name" type="text" required=""
                                        autocomplete="off">
                                </div>

                                <div class="row">
                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/dashboard.png" style="width: 20px;" alt=""> Dashboard</h5>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-5 m-b-20">
                                    <input class="form-check-input permission_checkbox" id="permission_id_1"
                                        name="permission[]" data-id="1" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_1">View Dashboard</label>
                                </div>

                                <h5 class="border-style"><i class="fa fa-map-o fs-6"></i> Locality</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_1"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_1"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_1" id="permission_id_2"
                                        name="permission[]" data-id="2" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_2">Locality List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_1" id="permission_id_3"
                                        name="permission[]" data-id="3" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_3">Locality Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_1" id="permission_id_4"
                                        name="permission[]" data-id="4" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_4">Locality Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_1" id="permission_id_5"
                                        name="permission[]" data-id="5" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_5">Locality Delete</label>
                                </div>

                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/property.png" style="width: 20px;" alt=""> Property</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_2"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_2"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_6"
                                        name="permission[]" data-id="6" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_6">Property List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_7"
                                        name="permission[]" data-id="7" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_7">Property Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_8"
                                        name="permission[]" data-id="8" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_8">Property Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_9"
                                        name="permission[]" data-id="9" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_9">Property Delete</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_10"
                                        name="permission[]" data-id="10" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_10">Search Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_11"
                                        name="permission[]" data-id="11" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_11">Import Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_12"
                                        name="permission[]" data-id="12" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_12">Export Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_2" id="permission_id_64"
                                        name="permission[]" data-id="64" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_64">Shared Property</label>
                                </div>

								<div style="display: none">
									<h5 class="border-style">Buildings</h5>
									<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
										<input class="form-check-input permission_checkbox select_all" id="select_all_3"
											type="checkbox" data-bs-original-title="" title="">
										<label class="form-check-label" for="select_all_3"> Select All</label>
									</div>
									<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
										<input class="form-check-input permission_checkbox select_all_3" id="permission_id_13"
											name="permission[]" data-id="13" type="checkbox" data-bs-original-title=""
											title="">
										<label class="form-check-label" for="permission_id_13">Building List</label>
									</div>
									<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
										<input class="form-check-input permission_checkbox select_all_3" id="permission_id_14"
											name="permission[]" data-id="14" type="checkbox" data-bs-original-title=""
											title="">
										<label class="form-check-label" for="permission_id_14">Building Create</label>
									</div>
									<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
										<input class="form-check-input permission_checkbox select_all_3" id="permission_id_15"
											name="permission[]" data-id="15" type="checkbox" data-bs-original-title=""
											title="">
										<label class="form-check-label" for="permission_id_15">Building Edit</label>
									</div>
									<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
										<input class="form-check-input permission_checkbox select_all_3" id="permission_id_16"
											name="permission[]" data-id="16" type="checkbox" data-bs-original-title=""
											title="">
										<label class="form-check-label" for="permission_id_16">Building Delete</label>
									</div>
								</div>

                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/enquiry.png" style="width: 20px;" alt=""> Enquiry</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_4"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_4"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_17"
                                        name="permission[]" data-id="17" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_17">Enquiry List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_18"
                                        name="permission[]" data-id="18" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_18">Enquiry Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_19"
                                        name="permission[]" data-id="19" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_19">Enquiry Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_20"
                                        name="permission[]" data-id="20" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_20">Enquiry Delete</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_21"
                                        name="permission[]" data-id="21" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_21">Delete Enquiry Progress</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_76"
                                        name="permission[]" data-id="76" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_76">Only Assigned</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_77"
                                        name="permission[]" data-id="77" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_77">Export Enquiry</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_4" id="permission_id_22"
                                        name="permission[]" data-id="22" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_22">Bulk Enquiry Transfer</label>
                                </div>
                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/project.png" style="width: 20px;" alt=""> Projects</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_5"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_5"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_23"
                                        name="permission[]" data-id="23" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_23">Project List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_24"
                                        name="permission[]" data-id="24" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_24">Project Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_25"
                                        name="permission[]" data-id="25" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_25">Project Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_26"
                                        name="permission[]" data-id="26" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_26">Project Delete</label>
                                </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_27"
                                        name="permission[]" data-id="27" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_27">Unit List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_28"
                                        name="permission[]" data-id="28" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_28">Unit Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_29"
                                        name="permission[]" data-id="29" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_29">Unit Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_5" id="permission_id_30"
                                        name="permission[]" data-id="30" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_30">Unit Delete</label>
                                </div>

                                <h5 class="border-style"><i class="fa fa-users"></i> User</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_6"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_6"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_6" id="permission_id_31"
                                        name="permission[]" data-id="31" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_31">User List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_6" id="permission_id_32"
                                        name="permission[]" data-id="32" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_32">User Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_6" id="permission_id_33"
                                        name="permission[]" data-id="33" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_33">User Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_6" id="permission_id_34"
                                        name="permission[]" data-id="34" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_34">User Delete</label>
                                </div>

                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/property.png" style="width: 20px;" alt=""> Land Property</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_7"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_7"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_35"
                                        name="permission[]" data-id="35" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_35">Land Property List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_36"
                                        name="permission[]" data-id="36" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_36">Land Property Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_37"
                                        name="permission[]" data-id="37" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_37">Land Property Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_38"
                                        name="permission[]" data-id="38" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_38">Land Property Delete</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_39"
                                        name="permission[]" data-id="39" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_39">Export Land Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_40"
                                        name="permission[]" data-id="40" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_40">Search Land Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_7" id="permission_id_41"
                                        name="permission[]" data-id="41" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_41">Import Land Property</label>
                                </div>

                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/property.png" style="width: 20px;" alt=""> Industrial Property</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_8"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_8"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_42"
                                        name="permission[]" data-id="42" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_42">Industrial Property
                                        List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_43"
                                        name="permission[]" data-id="43" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_43">Industrial Property
                                        Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_44"
                                        name="permission[]" data-id="44" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_44">Industrial Property
                                        Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_45"
                                        name="permission[]" data-id="45" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_45">Industrial Property
                                        Delete</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_46"
                                        name="permission[]" data-id="46" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_46">Export Industrial
                                        Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_47"
                                        name="permission[]" data-id="47" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_47">Search Industrial
                                        Property</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_8" id="permission_id_48"
                                        name="permission[]" data-id="48" type="checkbox" data-bs-original-title=""
                                        title="">
                                    <label class="form-check-label" for="permission_id_48">Import Industrial
                                        Property</label>
                                </div>

                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/report.png" style="width: 20px;" alt=""> Reports</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_10"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_10"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_57" name="permission[]" data-id="57" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_57">Report Employee Audit
                                        Log</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_58" name="permission[]" data-id="58" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_58">Report Employee by
                                        Enquiry</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_59" name="permission[]" data-id="59" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_59">Report Enquiry by
                                        Period</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_60" name="permission[]" data-id="60" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_60">Logged in Report</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_61" name="permission[]" data-id="61" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_61">Report Enquiry Remarks</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_62" name="permission[]" data-id="62" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_62">Report Property Sold</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_10"
                                        id="permission_id_63" name="permission[]" data-id="63" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_63">Report Property Viewer</label>
                                </div>
                                <h5 class="border-style"><img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/icons/settings.png" style="width: 20px;" alt=""> Settings</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_11"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_11"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_65" name="permission[]" data-id="65" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_65">Settings City</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_66" name="permission[]" data-id="66" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_66">Settings States</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_67" name="permission[]" data-id="67" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_67">Settings Builders</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_68" name="permission[]" data-id="68" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_68">Settings Branches</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_69" name="permission[]" data-id="69" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_69">Settings Property
                                        Configuration</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_70" name="permission[]" data-id="70" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_70">Settings Building
                                        Configuration</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_11"
                                        id="permission_id_71" name="permission[]" data-id="71" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_71">Settings Enquiry
                                        Configuration</label>
                                </div>
                                <h5 class="border-style"><i class="fa fa-unlock-alt fs-5"></i> Roles</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all" id="select_all_12"
                                        type="checkbox" data-bs-original-title="" title="">
                                    <label class="form-check-label" for="select_all_12"> Select All</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_12"
                                        id="permission_id_72" name="permission[]" data-id="72" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_72">Role List</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_12"
                                        id="permission_id_73" name="permission[]" data-id="73" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_73">Role Create</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_12"
                                        id="permission_id_74" name="permission[]" data-id="74" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_74">Role Edit</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input permission_checkbox select_all_12"
                                        id="permission_id_75" name="permission[]" data-id="75" type="checkbox"
                                        data-bs-original-title="" title="">
                                    <label class="form-check-label" for="permission_id_75">Role Delete</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="saveRole">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).ready(function() {
                    $('#roleTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('admin.roles') }}",
                        columns: [{
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'Actions',
                                name: 'Actions',
                                orderable: false
                            },
                        ]
                    });
                });
            });
            
            function setSelectedValue() {
                $('.permission_checkbox').prop('checked', false);
                $('#this_data_id').val('');
            }

            function setDefault() {
                setTimeout(setSelectedValue, 100);
            }

            function getRole(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getRole') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        name = data['role'].name;
                        $('#this_data_id').val(data['role'].id);
                        $('#name').val(name.split('_---_')[0]);
                        data['permission'].forEach(element => {
                            $('#permission_id_' + element.id).prop('checked', true);
                        });
                        if ($('#name').val() == 'Admin') {
                            // $('#saveRole').hide()
                        } else {
                            // $('#saveRole').show()
                        }
                        $('#roleModal').modal('show');
                        triggerChangeinput()
                    }
                });
            }

            function deleteRole(data) {
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
                            url: "{{ route('admin.deleteRole') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#roleTable').DataTable().draw();
                            }
                        });
                    }
                })

            }

            const allEqual = arr => arr.every(v => v === arr[0])
            $(document).on('click', '.form-check', function(e) {
                if (e.target.tagName == 'INPUT') {
                    var thiss = $(this).find('input').first();
                    id = $(thiss).attr('id').replace('select_all_', '')
                    if (!id.includes('permission')) {
                        if ($(thiss).prop('checked')) {
                            $('.select_all_' + id).each(function(index) {
                                $(this).prop('checked', true)
                            });
                        } else {
                            $('.select_all_' + id).each(function(index) {
                                $(this).prop('checked', false)
                            });
                        }
                    } else {
                        if (id.includes('permission')) {
                            var classes = $(thiss).attr('class').split(' ');
                            console.log(classes);
                            for (let i = 0; i < classes.length; i++) {
                                if ((classes[i]).includes('select_all_')) {
                                    var all_d = [];
                                    $('.' + classes[i]).each(function(index) {
                                        all_d.push($(this).prop('checked'))
                                    });
                                    if (!allEqual(all_d)) {
                                        $('#' + classes[i]).prop('checked', false)
                                    } else {
                                        if (all_d[0] == true) {
                                            $('#' + classes[i]).prop('checked', true)
                                        } else {
                                            $('#' + classes[i]).prop('checked', false)
                                        }
                                    }
                                }

                            }
                        }

                    }
                }
            })

            $(document).on('click', '#saveRole', function(e) {
                e.preventDefault();
                var id = $('#this_data_id').val()
                var permissions = [];
                $('input:checkbox:checked.permission_checkbox').each(function() {
                    permissions.push($(this).attr('data-id'));
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveRole') }}",
                    data: {
                        id: id,
                        name: $('#name').val(),
                        permission: permissions,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#roleTable').DataTable().draw();
                        $('#roleModal').modal('hide');
                    }
                });
            })
        </script>
    @endpush
