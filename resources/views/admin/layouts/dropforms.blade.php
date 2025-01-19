    <div class="modal fade" id="drop_enquiryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="drop_exampleModalLabel">Add New Enquiry</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="drop_modal_form"
                        novalidate="">
                        <input type="hidden" name="this_data_id" id="drop_this_data_id">
                        <div class="row">
                            <div class="form-group col-md-4 m-b-20">
								<label for="Client Name">Client Name</label>
                                <input class="form-control" name="client_name" id="drop_client_name" type="text"
                                    required="" autocomplete="off" >
                            </div>
                            <div class="form-group col-md-3 m-b-20">
								<label for="Client Mobile">Client Mobile</label>
                                <input class="form-control" name="client_mobile" id="drop_client_mobile" type="text"
                                    required="" autocomplete="off" >
                            </div>
                            <div class="form-group col-md-5 m-b-20">
								<label for="Client Email">Client Email</label>
                                <input class="form-control" name="client_email" id="drop_client_email" type="email"
                                    required="" autocomplete="off" >
                            </div>
							<div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                <input class="form-check-input" id="drop_is_nri" type="checkbox">
                                <label class="form-check-label" for="drop_is_nri">NRI</label>
                            </div>

                            <hr  class="color-hr">

                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="drop_enquiry_for">
                                    <option value="">Enquiry For</option>
                                    <option value="Rent">Rent</option>
                                    <option value="Buy">Buy</option>
									<option value="Both">Both</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="drop_requirement_type">
                                    <option value="">requirement Type</option>
                                    @forelse ($drop_configuration_settings as $props)
                                        @if ($props['dropdown_for'] == 'property_construction_type')
                                            <option data-parent_id="{{ $props['parent_id'] }}"
                                                value="{{ $props['id'] }}">
                                                {{ $props['name'] }}
                                            </option>
                                            </option>
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="drop_property_type">
                                    <option value="">Property type</option>
                                    @forelse ($drop_configuration_settings as $props)
                                        @if ($props['dropdown_for'] == 'property_specific_type')
                                            <option data-parent_id="{{ $props['parent_id'] }}"
                                                value="{{ $props['id'] }}">
                                                {{ $props['name'] }}
                                            </option>
                                            </option>
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="drop_configuration">
                                    <option value="">Configuration</option>
									@forelse (config('constant.property_configuration') as $key=>$props)
									<option
										value="{{ $key }}">{{ $props }}
									</option>
									@empty
									@endforelse
                                </select>
                            </div>

                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="drop_enquiry_source">
                                    <option value="">Enquiry Source</option>
                                    @forelse ($drop_configuration_settings as $props)
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

                            <div class="form-group col-md-3 m-b-20">
								<label for="Area Size From">Area Size From</label>
                                <input class="form-control" name="area_size_from" id="drop_area_size_from"
                                    type="text" required="" autocomplete="off" >
                            </div>

                            <div class="form-group col-md-3 m-b-20">
								<label for="Area Size To">Area Size To</label>
                                <input class="form-control" name="area_size_to" id="drop_area_size_to" type="text"
                                    required="" autocomplete="off" >
                            </div>

                            <div class="form-group col-md-2 m-b-4 mb-3">
                                <select class="form-select form_measurement measure_select" id="drop_area_measurement">
                                    @forelse ($drop_configuration_settings as $props)
                                        @if ($props['dropdown_for'] == 'property_measurement_type')
                                            <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
                                                value="{{ $props['id'] }}">
                                                {{ $props['name'] }}
                                            </option>
                                            </option>
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group col-md-3 m-b-20">
								<label for="Budget From">Budget From</label>
                                <input class="form-control indian_currency_amount" name="budget" id="drop_budget_from" type="text"
                                    required="" autocomplete="off" >
                            </div>

                            <div class="form-group col-md-3 m-b-20">
								<label for="Budget To">Budget To</label>
                                <input class="form-control indian_currency_amount" name="budget_to" id="drop_budget_to" type="text"
                                    required="" autocomplete="off" >
                            </div>

                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="drop_furnished_status">
                                    <option value="">Furnished Status</option>
                                    @forelse ($drop_configuration_settings as $props)
                                        @if ($props['dropdown_for'] == 'property_furniture_type')
                                            <option data-parent_id="{{ $props['parent_id'] }}"
                                                value="{{ $props['id'] }}">{{ $props['name'] }}
                                            </option>
                                            </option>
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>


                            <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-12 m-b-20">
                                <input class="form-check-input" id="drop_is_preleased" type="checkbox">
                                <label class="form-check-label" for="is_preleased">Pre-leased</label>
                            </div>

							<hr  class="color-hr">

                            <div class="form-group col-md-4 m-b-4 mb-3">
                                <select class="form-select" id="drop_area_ids">
                                    <option value="">Area</option>
                                    @foreach ($drop_areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-8 m-b-20">
								<label for="Telephonic Discussion">Telephonic Discussion</label>
                                <input class="form-control" name="telephonic_discussion"
                                    id="drop_telephonic_discussion" type="text" required="" autocomplete="off"
                                    >
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn custom-theme-button" id="drop_saveEnquiry"></button>
                            <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="drop_instaModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="drop2_drop_exampleModalLabel">Add Insta property</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="drop2_modal_form"
                        novalidate="">
                        <div>
                            <div class="row">
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_property_for">
                                        <option value=""> For</option>
                                        @forelse ($drop_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_for')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_property_type">
                                        <option value=""> Type</option>
                                        @forelse ($drop_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_construction_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_specific_type">
                                        <option value="">Category</option>
                                        @forelse ($drop_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_specific_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_configuration">
                                        <option value="">Configuration</option>
										@forelse (config('constant.property_configuration') as $key=>$props)
										<option
											value="{{ $key }}">{{ $props }}
										</option>
										@empty
										@endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_building_id">
                                        <option value=""> Project</option>
                                        @foreach ($drop_projects as $building)
                                            <option data-addr="{{ $building->address }}"
                                                value="{{ $building->id }}">
                                                {{ $building->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
									<label for="Property Wing"> Wing</label>
                                    <input class="form-control" name="property_wing" id="drop2_property_wing"
                                        type="text" required="" autocomplete="off" >
                                </div>
                                <div class="form-group col-md-3 m-b-20">
									<label for="Unit No">Unit No</label>
                                    <input class="form-control" name="property_unit_no" id="drop2_property_unit_no"
                                        type="text" required="" autocomplete="off" >
                                </div>
                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_furnished_status">
                                        <option value="">Furnished Status</option>
                                        @forelse ($drop_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_furniture_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-md-6 m-b-20">
                                    <div class="input-group">
                                        <div class="form-group col-md-9 m-b-20">
											<label for="Super Builtup Area">Salable Area</label>
                                            <input class="form-control" name="super_builtup_area"
                                                id="drop2_super_builtup_area" type="text" required=""
                                                autocomplete="off" >
                                        </div>
										<div class="input-group-append col-md-3 m-b-20">
                                        	<div class="form-group ">
                                            <select class="form-select form_measurement measure_select" id="drop2_super_builtup_measurement">
                                                @forelse ($drop_configuration_settings as $props)
                                                    @if ($props['dropdown_for'] == 'property_measurement_type')
                                                        <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
                                                            value="{{ $props['id'] }}">{{ $props['name'] }}
                                                        </option>
                                                        </option>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-b-20">
                                    <div class="input-group">
                                        <div class="form-group col-md-9 m-b-20">
											<label for="Plot Area">Plot Area</label>
                                            <input class="form-control" name="plot_area" id="drop2_plot_area"
                                                type="text" required="" autocomplete="off"
                                                >
                                        </div>
                                        <div class="input-group-append col-md-3 m-b-20">
                                            <div class="form-group ">
                                                <select class="form-select form_measurement measure_select" id="drop2_plot_measurement">
                                                    @forelse ($drop_configuration_settings as $props)
                                                        @if ($props['dropdown_for'] == 'property_measurement_type')
                                                            <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
                                                                value="{{ $props['id'] }}">{{ $props['name'] }}
                                                            </option>
                                                            </option>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 m-b-20">
                                    <div class="input-group">
                                        <div class="form-group col-md-9 m-b-20">
											<label for="Terrace">Terrace</label>
                                            <input class="form-control" name="terrace" id="drop2_terrace"
                                                type="text" required="" autocomplete="off"
                                                >
                                        </div>
                                        <div class="input-group-append col-md-3 m-b-20">
                                            <div class="form-group ">
                                                <select class="form-select form_measurement measure_select" id="drop2_terrace_measuremnt">
                                                    @forelse ($drop_configuration_settings as $props)
                                                        @if ($props['dropdown_for'] == 'property_measurement_type')
                                                            <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
                                                                value="{{ $props['id'] }}">{{ $props['name'] }}
                                                            </option>
                                                            </option>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group col-md-3 m-b-4 mb-3">
                                    <select class="form-select" id="drop2_source_of_property">
                                        <option value="">Source </option>
                                        @forelse ($drop_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_source')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group col-md-3 m-b-20">
									<label for="Commission">Commission</label>
                                    <input class="form-control" name="commision" id="drop2_commision" type="text"
                                        required="" autocomplete="off" >
                                </div>

                                <div class="form-group col-md-3 m-b-20">
									<label for="Owner Name">Owner Name</label>
									<input class="form-control"
                                        name="owner_name" id="drop2_owner_name" type="text" required=""
                                        autocomplete="off" > </div>

                                <div class="form-group col-md-3 m-b-20">
									<label for="Owner Contact No">Owner Contact No</label>
									<input class="form-control"
                                        name="owner_contact_no" id="drop2_owner_contact_no" type="text"
                                        required="" autocomplete="off" > </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input" id="drop2_is_specific_number" type="checkbox">
                                    <label class="form-check-label" for="drop2_is_specific_number">Specific
                                        Number</label>
                                </div>
                                <div class="form-group col-md-3 m-b-20">
									<label for="Owner Contact Specific No">Owner Contact Specific No</label>
                                    <input class="form-control" name="owner_contact_specific_no"
                                        id="drop2_owner_contact_specific_no" type="text" required=""
                                        autocomplete="off" >
                                </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20">
                                    <input class="form-check-input" id="drop2_hot_property" type="checkbox">
                                    <label class="form-check-label" for="drop2_hot_property">Hot Property</label>
                                </div>

                                <div class="form-group col-md-3 m-b-20">
									<label for="Price">Price</label>
                                    <input class="form-control indian_currency_amount" name="price" id="drop2_price" type="text"
                                        required="" autocomplete="off" >
                                </div>

                                <div class="form-group col-md-7 m-b-20">
									<label for="Property Remarks"> Remarks</label>
                                    <input class="form-control" name="property_remarks" id="drop2_property_remarks"
                                        type="text" required="" autocomplete="off"
                                        >
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn custom-theme-button" id="drop2_saveProperty">Save</button>
                            <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>

            $(document).on('change', '#drop_requirement_type', function(e) {
                var parent_value = $(this).val();
                $("#drop_property_type option , #drop_configuration option").each(function() {
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


            $(document).on('change', '#drop2_property_type', function(e) {
                var parent_value = $(this).val();
                $("#drop2_specific_type option , #drop2_configuration option").each(function() {
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

            $(document).on('click', '#drop_saveEnquiry', function(e) {
                e.preventDefault();
                // $("#modal_form").validate();
                // if (!$("#modal_form").valid()) {
                //     return
                // }



                var id = $('#drop_this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveEnquiry') }}",
                    data: {
                        id: $('#drop_this_data_id').val(),
                        client_name: $('#drop_client_name').val(),
                        client_mobile: $('#drop_client_mobile').val(),
                        client_email: $('#drop_client_email').val(),
                        is_nri: Number($('#drop_is_nri').prop('checked')),
                        enquiry_for: $('#drop_enquiry_for').val(),
                        requirement_type: $('#drop_requirement_type').val(),
                        property_type: $('#drop_property_type').val(),
                        configuration: $('#drop_configuration').val(),
                        area_size_from: $('#drop_area_size_from').val(),
                        area_size_to: $('#drop_area_size_to').val(),
                        area_measurement: $('#drop_area_measurement').val(),
                        enquiry_source: $('#drop_enquiry_source').val(),
                        furnished_status: $('#drop_furnished_status').val(),
                        budget_from: $('#drop_budget_from').val(),
                        budget_to: $('#drop_budget_to').val(),
                        purpose: $('#drop_purpose').val(),
                        building_id: $('#drop_building_id').val(),
                        enquiry_status: $('#drop_enquiry_status').val(),
                        project_status: $('#drop_project_status').val(),
                        area_ids: $('#drop_area_ids').val(),
                        is_preleased: Number($('#drop_is_preleased').prop('checked')),
                        telephonic_discussion: $('#drop_telephonic_discussion').val(),
                        highlights: $('#drop_highlights').val(),
                        enquiry_city_id: $('#drop_enquiry_city_id').val(),
                        enquiry_branch_id: $('#drop_enquiry_branch_id').val(),
                        employee_id: $('#drop_employee_id').val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#drop_enquiryModal').modal('hide');
                    }
                });
            })

            $(document).on('click', '#drop2_saveProperty', function(e) {
                e.preventDefault();
                // $("#modal_form").validate();
                // if (!$("#modal_form").valid()) {
                //     return
                // }
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveinstaProperty') }}",
                    data: {
                        id: '',
                        property_for: $('#drop2_property_for').val(),
                        property_type: $('#drop2_property_type').val(),
                        specific_type: $('#drop2_specific_type').val(),
                        building_id: $('#drop2_building_id').val(),
                        property_wing: $('#drop2_property_wing').val(),
                        property_unit_no: $('#drop2_property_unit_no').val(),
                        configuration: $('#drop2_configuration').val(),
                        property_status: $('#drop2_property_status').val(),
                        super_builtup_area: $('#drop2_super_builtup_area').val(),
                        super_builtup_measurement: $('#drop2_super_builtup_measurement').val(),
                        plot_area: $('#drop2_plot_area').val(),
                        plot_measurement: $('#drop2_plot_measurement').val(),
                        terrace: $('#drop2_terrace').val(),
                        terrace_measuremnt: $('#drop2_terrace_measuremnt').val(),
                        hot_property: Number($('#drop2_hot_property').prop('checked')),
                        furnished_status: $('#drop2_furnished_status').val(),
                        commision: $('#drop2_commision').val(),
                        source_of_property: $('#drop2_source_of_property').val(),
                        price: $('#drop2_price').val(),
                        property_remarks: $('#drop2_property_remarks').val(),
                        is_specific_number: Number($('#drop2_is_specific_number').prop('checked')),
                        owner_contact_specific_no: $('#drop2_owner_contact_specific_no').val(),
                        owner_name: $('#drop2_owner_name').val(),
                        owner_number: $('#drop2_owner_contact_no').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#drop_instaModal').modal('hide');
						if ($('#propertyTable')) {
							$('#propertyTable').DataTable().draw();
						}
                    }
                });
            })
        </script>
    @endpush
