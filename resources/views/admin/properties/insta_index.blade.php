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
                            <h5 class="mb-3">Insta Properties</h5>
                                <button class="btn btn-primary btn-air-primary open_modal_with_this" type="button"
                                    data-bs-toggle="modal" data-bs-target="#instaModal"> New Insta Property</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="propertyTable">
                                    <thead>
                                        <tr>
                                            <th>Building Name</th>
                                            <th>DOE</th>
                                            <th>Available For</th>
                                            <th>Configuration</th>
                                            <th>Wing/Unit NO.</th>
                                            <th>Furnished</th>
                                            <th>Price</th>
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
        <div class="modal fade" id="instaModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Insta property</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" name="property_for" id="property_for">
											<option value="">For</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Sell">Sell</option>
											<option value="Both">Both</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" name="property_type" id="property_type">
                                            <option value=""> Type</option>
                                            @forelse ($property_configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_construction_type')
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
                                        <select class="form-select" name="specific_type" id="specific_type">
                                            <option value="">Category</option>
                                            @forelse ($property_configuration_settings as $props)
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
                                        <select class="form-select" name="configuration" id="configuration">
                                            <option value="">Configuration</option>
											@forelse (config('constant.property_configuration') as $key=>$props)
											<option
												value="{{ $key }}">{{ $props }}
											</option>
											@empty
											@endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4">
                                        <select class="form-select" name="building_id" id="building_id">
                                            <option value=""> Project</option>
                                            @foreach ($projects as $project)
                                                <option data-addr="{{ $project->address }}" value="{{ $project->id }}">
                                                    {{ $project->project_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
										<label for="Wing">Wing</label>
                                        <input class="form-control" name="property_wing" id="property_wing" type="text"
                                            autocomplete="off" >
                                    </div>
                                    <div class="form-group col-md-3 m-b-20">
										<label for="Unit">Unit</label>
                                        <input class="form-control" name="property_unit_no" id="property_unit_no"
                                            type="text" autocomplete="off" >
                                    </div>
                                    <div class="form-group col-md-3 m-b-4">
                                        <select class="form-select" id="furnished_status">
                                            <option value="">Furnished Status</option>
                                            @forelse ($property_configuration_settings as $props)
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

                                    <div class="col-md-6 m-b-20">
                                        <div class="input-group">
                                            <div class="form-group col-md-5 m-b-20">
												<label for="Super Builtup Area">Salable Area</label>
                                                <input class="form-control" name="super_builtup_area"
                                                    id="super_builtup_area" type="text" autocomplete="off"
                                                    >
                                            </div>
                                            <div class="input-group-append col-md-3 m-b-20">
												<div class="form-group">
                                                <select class="form-select form_measurement measure_select" id="super_builtup_measurement">
                                                    @forelse ($property_configuration_settings as $props)
                                                        @if ($props['dropdown_for'] == 'property_measurement_type')
                                                            <option  @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
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
                                            <div class="form-group col-md-6 m-b-20">
												<label for="Plot Area">Plot Area</label>
                                                <input class="form-control" name="plot_area" id="plot_area"
                                                    type="text" autocomplete="off" >
                                            </div>
                                            <div class="input-group-append col-md-3 m-b-20">
                                                <div class="form-group">
                                                    <select class="form-select form_measurement measure_select" id="plot_measurement">
                                                        @forelse ($property_configuration_settings as $props)
                                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
                                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
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
                                            <div class="form-group col-md-6 m-b-20">
												<label for="Terrace">Terrace</label>
                                                <input class="form-control" name="terrace" id="terrace" type="text"
                                                    autocomplete="off" >
                                            </div>
                                            <div class="input-group-append col-md-3 m-b-20">
                                                <div class="form-group">
                                                    <select class="form-select form_measurement measure_select" id="terrace_measuremnt">
                                                        @forelse ($property_configuration_settings as $props)
                                                            @if ($props['dropdown_for'] == 'property_measurement_type')
                                                                <option @if( $props['id'] == Session::get('default_measurement')) selected @endif data-parent_id="{{ $props['parent_id'] }}"
                                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                                </option>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4">
                                        <select class="form-select" id="source_of_property">
                                            <option value="">Source </option>
                                            @forelse ($property_configuration_settings as $props)
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
										<label for="Commission">Commission</label>
                                        <input class="form-control" name="commision" id="commision" type="text"
                                            autocomplete="off" >
                                    </div>

                                    <div class="form-group col-md-3 m-b-20">
										<label for="Owner Name">Owner Name</label>
										<input class="form-control"
                                            name="owner_name" id="owner_name" type="text" autocomplete="off"
                                            > </div>

                                    <div class="form-group col-md-3 m-b-20">
										<label for="Owner Contact No">Owner Contact No</label>
										<input class="form-control"
                                            name="owner_contact_no" id="owner_contact_no" type="text"
                                            autocomplete="off" > </div>

                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="is_specific_number" type="checkbox">
                                        <label class="form-check-label" for="is_specific_number">Specific
                                            Number</label>
                                    </div>
                                    <div class="form-group col-md-3 m-b-20 p-0">
										<label for="Specific No">Specific No</label>
                                        <input class="form-control" name="owner_contact_specific_no"
                                            id="owner_contact_specific_no" type="text" autocomplete="off"
                                            >
                                    </div>

                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-20">
                                        <input class="form-check-input" id="hot_property" type="checkbox">
                                        <label class="form-check-label" for="hot_property">Hot </label>
                                    </div>

                                    <div class="form-group col-md-3 m-b-20">
										<label for="Price">Price</label>
                                        <input class="form-control indian_currency_amount" name="price" id="price" type="text"
                                            autocomplete="off" >
                                    </div>

                                    <div class="form-group col-md-7 m-b-20">
										<label for="Remarks"> Remarks</label>
                                        <input class="form-control" name="property_remarks" id="property_remarks"
                                            type="text" autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->can('insta-property-edit') || Auth::user()->can('insta-property-create'))
                                <button class="btn btn-secondary" id="saveProperty">Save</button>
                            @endif
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#propertyTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
					@if(!Auth::user()->can('search-insta-property'))
					searching:false,
					@endif
                    ajax: {
                        url: "{{ route('admin.insta.properties') }}",
                    },
                    columns: [{
                            data: 'building_id',
                            name: 'building_id',
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'property_for',
                            name: 'property_for'
                        },
                        {
                            data: 'configuration',
                            name: 'configuration'
                        },
                        {
                            data: 'property_wing',
                            name: 'property_wing'
                        },
                        {
                            data: 'furnished_status',
                            name: 'furnished_status'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'Actions',
                            name: 'Actions',
                            orderable: false
                        },
                    ]
                });
            });



            $(document).on('change', '#property_type', function(e) {
                var parent_value = $(this).val();
                $("#specific_type option , #configuration option").each(function() {
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

            $(document).on('click', '.showNumberNow', function(e) {
                numb = $(this).attr('data-val');
                $(this).replaceWith('<a href="tel:'+numb+'">'+numb+'</a>');
            })

            function getProperty(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getinstaProperty') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('#this_data_id').val(data.id);
                        $('#property_for').val(data.property_for).trigger('change');
                        $('#property_type').val(data.property_type).trigger('change');
                        $('#specific_type').val(data.specific_type).trigger('change');
                        $('#building_id').val(data.building_id).trigger('change');
                        $('#property_wing').val(data.property_wing)
                        $('#property_unit_no').val(data.property_unit_no)
                        $('#configuration').val(data.configuration).trigger('change');
                        $('#property_status').val(data.property_status).trigger('change');
                        $('#super_builtup_area').val(data.super_builtup_area)
                        $('#super_builtup_measurement').val(data.super_builtup_measurement).trigger('change');
                        $('#plot_area').val(data.plot_area)
                        $('#plot_measurement').val(data.plot_measurement).trigger('change');
                        $('#terrace').val(data.terrace)
                        $('#terrace_measuremnt').val(data.terrace_measuremnt).trigger('change');
                        $('#hot_property').prop('checked', Number(data.hot_property))
                        $('#furnished_status').val(data.furnished_status).trigger('change');
                        $('#commision').val(data.commision)
                        $('#source_of_property').val(data.source_of_property).trigger('change');
                        $('#price').val(data.price)
                        $('#property_remarks').val(data.property_remarks)
                        $('#is_specific_number').val(data.is_specific_number)
                        $('#owner_contact_specific_no').prop('checked', Number(data.owner_contact_specific_no))
                        $('#owner_name').val(data.owner_name)
                        $('#owner_number').val(data.owner_number)
                        $('#instaModal').modal('show');
						triggerChangeinput()
                    }
                });
            }



            function deleteProperty(data) {
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
                            url: "{{ route('admin.deleteinstaProperty') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#propertyTable').DataTable().draw();
                            }
                        });
                    }
                })

            }

            $('#modal_form').validate({ // initialize the plugin
                rules: {
                    property_for: {
                        required: true,
                    },
                    property_type: {
                        required: true,
                    },
                    specific_type: {
                        required: true,
                    },
                    configuration: {
                        required: true,
                    },
                    building_id: {
                        required: true,
                    },
                    property_unit_no: {
                        digits: true,
                    },
                    super_builtup_area: {
                        digits: true,
                    },
                    plot_area: {
                        digits: true,
                    },
                    terrace: {
                        digits: true,
                    },
                },
                submitHandler: function(form) { // for demo
                    alert('valid form submitted'); // for demo
                    return false; // for demo
                }
            });




            $(document).on('click', '#saveProperty', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveinstaProperty') }}",
                    data: {
                        id: $('#this_data_id').val(),
                        property_for: $('#property_for').val(),
                        property_type: $('#property_type').val(),
                        specific_type: $('#specific_type').val(),
                        building_id: $('#building_id').val(),
                        property_wing: $('#property_wing').val(),
                        property_unit_no: $('#property_unit_no').val(),
                        configuration: $('#configuration').val(),
                        property_status: $('#property_status').val(),
                        super_builtup_area: $('#super_builtup_area').val(),
                        super_builtup_measurement: $('#super_builtup_measurement').val(),
                        plot_area: $('#plot_area').val(),
                        plot_measurement: $('#plot_measurement').val(),
                        terrace: $('#terrace').val(),
                        terrace_measuremnt: $('#terrace_measuremnt').val(),
                        hot_property: Number($('#hot_property').prop('checked')),
                        furnished_status: $('#furnished_status').val(),
                        commision: $('#commision').val(),
                        source_of_property: $('#source_of_property').val(),
                        price: $('#price').val(),
                        property_remarks: $('#property_remarks').val(),
                        is_specific_number: Number($('#is_specific_number').prop('checked')),
                        owner_contact_specific_no: $('#owner_contact_specific_no').val(),
                        owner_name: $('#owner_name').val(),
                        owner_number: $('#owner_contact_no').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
						$('#instaModal').modal('hide');
                        $('#propertyTable').DataTable().draw();
						$('#saveProperty').prop('disabled',false);
                    }
                });
            })
        </script>
    @endpush
