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
                            <h5 class="mb-3">List of Buildings</h5>
                                <button class="btn btn-primary btn-air-primary open_modal_with_this" type="button"
                                    data-bs-toggle="modal" data-bs-target="#buildingModal">Add New Building</button>
                        
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="buildingTable">
                                    <thead>
                                        <tr>
                                            <th>Building</th>
                                            <th>Address</th>
                                            <th>Builder Name</th>
                                            <th>Property Type</th>
                                            <th>Prime</th>
                                            <th></th>
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
        <div class="modal fade" id="buildingModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Building</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div class="row">
                                <h5 class="border-style"> Basic Information</h5>
                                <div class="form-group col-md-4 m-b-20">
									<label for="Building Name"> Name</label>
                                    	<input class="form-control" name="building_name" id="building_name" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="builder_id">
                                        <option value=""> Builder</option>
                                        @foreach ($builders as $builder)
                                            <option value="{{ $builder->id }}">{{ $builder->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="area_id">
                                        <option value="">Area</option>
                                        @foreach ($areas as $area)
                                            <option data-pincode="{{$area->pincode}}" data-city_id="{{$area->city_id}}" data-state_id="{{$area->state_id}}" value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 m-b-20">
									<label for="Address">Address</label>
                                    <input class="form-control" name="address" id="address" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-group col-md-6 m-b-20">
									<label for="Landmark">Landmark</label>
                                    <input class="form-control" name="landmark" id="landmark" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="state_id">
                                        <option value="">State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="city_id">
                                        <option value="">Cities</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 m-b-20">
									<label for="Pincode">Pincode</label>
                                    <input class="form-control" name="pincode" id="pincode" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-20">
                                    <input class="form-check-input" id="prime_building" type="checkbox">
                                    <label class="form-check-label" for="prime_building">Prime </label>
                                </div>
								<div class="d-flex align-items-center mb-3 col-md-2">
                                    <div class="form-group">
                                        <label class="switch mb-0">
                                            <input type="checkbox" id="status" ><span class="switch-state"></span>
                                        </label>
                                    </div>
                                    <div class="form-group ms-2">
                                        <label for="status" class="mb-1">Active</label>
                                    </div>
                                </div>


                                <h5 class="border-style"> Other Information</h5>
                                <div class="form-group col-md-4 m-b-20">
									<label for="Building Posession"> Posession(Year)</label>
                                    <input class="form-control" name="building_posession" id="building_posession"
                                        type="text" autocomplete="off" >
                                </div>
                                <div class="form-group col-md-2 m-b-20">
									<label for="Floor Count">Floor Count</label>
                                    <input class="form-control" name="floor_count" id="floor_count" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-group col-md-2 m-b-20">
									<label for="Unit No">Unit No</label>
                                    <input class="form-control" name="unit_no" id="unit_no" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-group col-md-4 m-b-20">
									<label for="Lift Count">Lift Count</label>
                                    <input class="form-control" name="lift_count" id="lift_count" type="text"
                                        autocomplete="off" >
                                </div>
                                <div class="form-group col-md-6 m-b-20">
									<label class="select2_label" for="Property Type">Property Type</label>
                                    <select class="form-select" id="property_type"   name="Proprty Type" title="Property Type" multiple="multiple">
                                        @forelse ($building_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'building_architecture_type')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-6 m-b-20">
									<label class="select2_label" for="Restricted User">Restricted User</label>
                                    <select class="form-select" id="restrictions"  multiple="multiple">
                                        @forelse ($building_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'building_restriction')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-20 mt-1">
                                    <select class="form-select form-design" id="building_status">
                                        <option value="">Status</option>
                                        @forelse ($building_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'building_progress')
                                                <option data-parent_id="{{ $props['parent_id'] }}"
                                                    value="{{ $props['id'] }}">{{ $props['name'] }}
                                                </option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-b-20 mt-1">
                                    <select class="form-select" id="building_quality">
                                        <option value="">Quality </option>
                                        <option value="1">Average</option>
                                        <option value="2">Excellent</option>
                                        <option value="3">Good</option>
                                        <option value="4">Poor</option>
                                    </select>
                                </div>

                                <h5 class="border-style"> Description</h5>
                                <div class="form-group col-md-6 m-b-20">
									<label for="Description"> Description</label>
                                    <input class="form-control" name="Bulding_description" id="Bulding_description"
                                        type="text" autocomplete="off" >
                                </div>

                                <h5 class="border-style"> Amenities</h5>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_pool" type="checkbox">
                                    <label class="form-check-label" for="amenity_pool">Swimming Pool</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_club_house"
                                        type="checkbox">
                                    <label class="form-check-label" for="amenity_club_house">Club house</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_passenger_lift"
                                        type="checkbox">
                                    <label class="form-check-label" for="amenity_passenger_lift">Passenger Lift</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_garden" type="checkbox">
                                    <label class="form-check-label" for="amenity_garden">Garden & Children Play
                                        Area</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_service_lift"
                                        type="checkbox">
                                    <label class="form-check-label" for="amenity_service_lift">Service Lift</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_streature_lift"
                                        type="checkbox">
                                    <label class="form-check-label" for="amenity_streature_lift">Streature Lift</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_ac" type="checkbox">
                                    <label class="form-check-label" for="amenity_ac">Central AC</label>
                                </div>
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-4 m-b-20">
                                    <input class="building_amenity form-check-input" id="amenity_gym" type="checkbox">
                                    <label class="form-check-label" for="amenity_gym">Gym</label>
                                </div>

                                <h5 class="border-style">Contact Details</h5>
                                <div><button type="button" class="btn mb-5 btn-primary btn-air-primary"
                                        id="add_contacts">Add Contact</button></div>
                                <div class="row" id="all_contacts">

                                </div>

                                <h5 class="border-style">Security Details</h5>
                                <div><button type="button" class="btn mb-5 btn-primary btn-air-primary"
                                        id="add_securities">Add Security Details</button></div>
                                <div class="row" id="all_securities">

                                </div>

                                <h5 class="border-style">Images/Documents</h5>
                                <div id="uploadImageBox" class="row">
                                    <div class="form-group col-md-4 m-b-4 mt-1">
                                        <select class="form-select" id="image_category">
                                            <option value=""> Category</option>
                                            <option value="1">Building Elevation</option>
                                            <option value="2">Common Amenities Photos</option>
                                            <option value="3">Master Layout Of Building</option>
                                            <option value="4">Brochure</option>
                                            <option value="5">Cost Sheet</option>
                                            <option value="6">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 m-b-4 mb-3"><input class="form-control"
                                            type="file" id="building_images" name="building_images"
                                             multiple></div>
                                    <div class="form-group col-md-2 m-b-4 mb-3"><button type="button"
                                            class="btn mb-2 btn-primary btn-air-primary" id="add_images">Upload</button>
                                    </div>
                                </div>
                                <div class="row" id="all_images">

                                </div>
                            </div>
                                <button class="btn btn-secondary" id="saveBuilding">Save</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="importmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Building</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="import_form" novalidate="">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12 m-b-20">
                                    <input class="form-control" type="file" accept=".csv" name="import_file"
                                        id="import_file">
                                </div>
                            </div>
                            <button class="btn btn-secondary" id="importFile">Save</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		@php
		$city_encoded = json_encode($cities);
		$state_encoded = json_encode($states);
		@endphp
    @endsection
    @push('scripts')
        <script>
			var shouldchangecity = 1;
            var building_image_show_url = "{{ asset('upload/building_images') }}";

            $(document).ready(function() {

                $('#modal_form').validate({ // initialize the plugin
                    rules: {
                        building_name: {
                            required: true,
                        },
                        pincode: {
                            digits: true,
                        },
                        building_posession: {
                            digits: true,
                        },
                        floor_count: {
                            digits: true,
                        },
                        unit_no: {
                            digits: true,
                        },
                        lift_count: {
                            digits: true,
                        },
                    },
                    submitHandler: function(form) { // for demo
                        alert('valid form submitted'); // for demo
                        return false; // for demo
                    }
                });


                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var go_data_id = urlParams.get('data_id')

				var cities = @Json($city_encoded);
				var states = @Json($state_encoded);

				$(document).on('change', '#state_id', function(e) {
					if (shouldchangecity) {
						$('#city_id').select2('destroy');
					citiesar = JSON.parse(cities);
					$('#city_id').html('');
					for (let i = 0; i < citiesar.length; i++) {
						if (citiesar[i]['state_id'] == $("#state_id").val()) {
							$('#city_id').append('<option value="'+citiesar[i]['id']+'">'+citiesar[i]['name']+'</option>')
						}
					}
					$('#city_id').select2();
					}
				})

                $('#buildingTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: "{{ route('admin.buildings') }}",
                        data: function(d) {
                            d.go_data_id = go_data_id;
                        }
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'builder',
                            name: 'builder'
                        },
                        {
                            data: 'property_type',
                            name: 'property_type'
                        },
                        {
                            data: 'is_prime',
                            name: 'is_prime'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false
                        },
                        {
                            data: 'Actions',
                            name: 'Actions',
                            orderable: false
                        },
                    ],
                    rowCallback: function(row, data, index) {
                        $(row).find('td:eq(5)').html('')
                        if (data.status) {
                            $(row).find('td:eq(5)').css('background-color', 'green');
                        } else {
                            $(row).find('td:eq(5)').css('background-color', 'orange');
                        }

                    },
                    columnDefs: [{
                            "width": "10%",
                            "targets": 0
                        },
                        {
                            "width": "35%",
                            "targets": 1
                        },
                        {
                            "width": "15%",
                            "targets": 2
                        },
                        {
                            "width": "15%",
                            "targets": 3
                        },
                        {
                            "width": "9%",
                            "targets": 4
                        },
                        {
                            "width": "0.1%",
                            "targets": 5
                        },
                        {
                            "width": "15%",
                            "targets": 6
                        },
                    ]
                });
            });

            function getBuilding(data) {
				shouldchangecity = 0
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getBuilding') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('#this_data_id').val(data.id);
                        $('#building_name').val(data.name);
                        $('#area_id').val(data.area_id).trigger('change');
                        $('#city_id').val(data.city_id).trigger('change');
                        $('#state_id').val(data.state_id).trigger('change');
                        $('#builder_id').val(data.builder_id).trigger('change');
                        $('#address').val(data.address);
                        $('#pincode').val(data.pincode);
                        $('#landmark').val(data.landmark);
                        $('#prime_building').prop('checked', Number(data.is_prime));
                        $('#building_posession').val(data.posession_year);
                        $('#floor_count').val(data.floor_count);
                        $('#unit_no').val(data.unit_no);
                        $('#lift_count').val(data.lift_count);
                        $('#property_type').val(JSON.parse(data.property_type)).trigger('change');
                        $('#restrictions').val(JSON.parse(data.restrictions)).trigger('change');
                        $('#building_status').val(data.building_status).trigger('change');;
                        $('#building_quality').val(data.building_quality).trigger('change');;
                        $('#Bulding_description').val(data.building_descriptions);
                        $('#status').prop('checked', Number(data.status));
						shouldchangecity = 1
                        $(".building_amenity").each(function(index) {
                            var amenities = JSON.parse(data.building_amenities)
                            if ((amenities != null) && (amenities.length > 0)) {
								$(this).prop('checked', Number(amenities[index]));
							}
                        });
                        $('#all_contacts').html('')
                        $('#all_securities').html('')
                        if (data.contact_details != '') {
                            details = JSON.parse(data.contact_details);
							if ((details != null) && (details.length > 0)) {
                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                $('#all_contacts').append(generate_contact_detail(id))
                                $("[data-contact_id=" + id + "] input[name=contact_person_name]").val(details[i][
                                    0
                                ]);
                                $("[data-contact_id=" + id + "] input[name=contact_person_no]").val(details[i][1]);
                            }
						}
                        }
                        if (data.security_details != '') {
                            details = JSON.parse(data.security_details);
							if ((details != null) && (details.length > 0)) {
                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                $('#all_securities').append(generate_security_detail(id))
                                $("[data-sec_id=" + id + "] input[name=security_name]").val(details[i][0]);
                                $("[data-sec_id=" + id + "] input[name=security_no]").val(details[i][1]);
                            }
						}
                        }
                        $('#all_images').html('');
                        if (data.images != '') {
                            for (let i = 0; i < data.images.length; i++) {
                                var category = '';
                                if (data.images[i].category == 1) {
                                    category = 'Building Elevation';
                                } else if (data.images[i].category == 2) {
                                    category = 'Common Amenities Photos';
                                } else if (data.images[i].category == 3) {
                                    category = 'Master Layout Of Building';
                                } else if (data.images[i].category == 4) {
                                    category = 'Brochure';
                                } else if (data.images[i].category == 5) {
                                    category = 'Cost Sheet';
                                } else if (data.images[i].category == 6) {
                                    category = 'Other';
                                }

                                var src = building_image_show_url + '/' + data.images[i].image;
                                if (src.includes('.pdf')) {
									$('#all_images').append('<div class="col-md-4 m-b-4 mb-3"><a target="_blank" href="'+src+'"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a><p>'+category+'</p></div>')
								}else{
									$('#all_images').append('<div class="col-md-4 m-b-4 mb-3"><img src="' + src +
                                    '" alt="" height="200" width="200"><p>'+category+'</p></div>')
								}
                            }

                        }
                        $('#buildingModal').modal('show');
						triggerChangeinput()
                    }
                });
            }

            function deleteBuilding(data) {
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
                            url: "{{ route('admin.deleteBuilding') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#buildingTable').DataTable().draw();
                            }
                        });
                    }
                })

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

			$(document).on("click", ".open_modal_with_this", function (e) {
				$('#all_contacts').html('')
				$('#all_securities').html('')
				$('#all_contacts').append(generate_contact_detail(makeid(10)));
				$('#all_securities').append(generate_security_detail(makeid(10)));
				$('#all_images').html('');
			})

            function generate_contact_detail(id) {
                var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-4 m-b-20">' +
                    '       <input class="form-control" name="contact_person_name" type="text"' +
                    '            autocomplete="off" placeholder="contact person Name">' +
                    '     </div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-4 m-b-20">' +
                    '       <input class="form-control" name="contact_person_no"' +
                    '           type="text"  autocomplete="off"' +
                    '           placeholder="Contact person No.">' +
                    '   </div>' +
                    '<div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
                    ' class="remove_contacts btn btn-danger btn-air-danger" type="button">-</button>  </div>';
                return myvar;
            }

            function generate_security_detail(id) {
                var myvar = '<div  data-sec_id= ' + id + ' class="form-group col-md-4 m-b-20">' +
                    '            <input class="form-control" name="security_name" ' +
                    '                type="text"  autocomplete="off" placeholder="Name of Security">' +
                    '        </div>' +
                    '<div  data-sec_id= ' + id + ' class="form-group col-md-4 m-b-20">' +
                    '            <input class="form-control" name="security_no" ' +
                    '                type="text"  autocomplete="off" placeholder="Contact no of Security">' +
                    '        </div>' +
                    '<div data-sec_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3"><button data-sec_id=' + id +
                    ' class="remove_securities btn btn-danger btn-air-danger" type="button">-</button>  </div>';
                return myvar;
            }

			$(document).on('change', '#area_id', function(e) {
				if ($(this).find(":selected").attr('data-state_id') !== undefined && $(this).find(":selected").attr('data-state_id') != '') {
					$('#state_id').val($(this).find(":selected").attr('data-state_id')).trigger('change')
				}
				if ($(this).find(":selected").attr('data-city_id') !== undefined && $(this).find(":selected").attr('data-city_id') != '') {
					$('#city_id').val($(this).find(":selected").attr('data-city_id')).trigger('change')
					$('#pincode').val($(this).find(":selected").attr('data-pincode')).trigger('change')
				}
			})

			var allowedselect2s = ['builder_id'];
			$(document).on('keydown', '.select2-search__field', function(e) {
				setTimeout(() => {
				var par = $(this).closest('.select2-dropdown')
				var tar = $(par).find('.select2-results')
				var kar = $(tar).find('.select2-results__options')
				var opt = $(kar).find('li')
				if (opt.length == 1 && $(opt[0]).text() == 'No results found') {
					var idd = $(kar).attr('id')
					idd = idd.replace("select2-", "");
					idd = idd.replace("-results", "");
					if (allowedselect2s.includes(idd)) {
						$("#"+idd+ " option[last_added='"+true+"']").each(function(i,e){
							$('#'+idd+' option[value="' + $(this).val() + '"]').detach();
						});
						if ($("#"+idd+ " option[value='"+$(this).val()+"']").length == 0) {
							var newState = new Option($(this).val(), $(this).val(), true, true);

							vvvv = $.parseHTML('<option last_added="true" value="'+$(this).val()+'" selected="">'+$(this).val()+'</option>');
							$("#"+idd).append(vvvv).trigger('change');
						}
					}else if ($(this).val() != '' && $(opt[0])[0] !== undefined && $($(opt[0])[0]).attr('id') != ''){
					var idd = $(kar).attr('id')
					idd = idd.replace("select2-", "");
					idd = idd.replace("-results", "");
					if (allowedselect2s.includes(idd)) {
						$("#"+idd+ " option[last_added='"+true+"']").each(function(i,e){
							$('#'+idd+' option[value="' + $(this).val() + '"]').detach();
						});
						if ($("#"+idd+ " option[value='"+$(this).val()+"']").length == 0) {
							var newState = new Option($(this).val(), $(this).val(), true, true);

							vvvv = $.parseHTML('<option last_added="true" value="'+$(this).val()+'" selected="">'+$(this).val()+'</option>');
							$("#"+idd).append(vvvv).trigger('change');
						}
					}
				}
				}
				}, 50);
			})

            $(document).on('click', '#add_contacts', function(e) {
                id = makeid(10);
                $('#all_contacts').append(generate_contact_detail(id));
            })
            $(document).on('click', '.remove_contacts', function(e) {
                id = $(this).attr('data-contact_id');
                $("[data-contact_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $(document).on('click', '#add_securities', function(e) {
                id = makeid(10);
                $('#all_securities').append(generate_security_detail(id));
            })
            $(document).on('click', '.remove_securities', function(e) {
                id = $(this).attr('data-sec_id');
                $("[data-sec_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $(document).on('click', '#add_images', function(e) {
                var fd = new FormData();
                var files = $('#building_images')[0].files;
                if (files.length == 0 || $('#this_data_id').val() == '') {
                    return;
                }
                fd.append('category', $('#image_category').val());
                fd.append('building_id', $('#this_data_id').val());
                for (let i = 0; i < files.length; i++) {
                    fd.append('images[]', files[i]);
                }


                fd.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: "{{ route('admin.saveBuildingImages') }}",
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#all_images').html('');
                        $('#building_images').val('');
                        if (response != '') {
                            images = JSON.parse(response);
							for (let i = 0; i < images.length; i++) {
                                var category = '';
                                if (images[i].category == 1) {
                                    category = 'Building Elevation';
                                } else if (images[i].category == 2) {
                                    category = 'Common Amenities Photos';
                                } else if (images[i].category == 3) {
                                    category = 'Master Layout Of Building';
                                } else if (images[i].category == 4) {
                                    category = 'Brochure';
                                } else if (images[i].category == 5) {
                                    category = 'Cost Sheet';
                                } else if (images[i].category == 6) {
                                    category = 'Other';
                                }

                                var src = building_image_show_url + '/' + images[i].image;
                                if (src.includes('.pdf')) {
									$('#all_images').append('<div class="col-md-4 m-b-4 mb-3"><a target="_blank" href="'+src+'"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a><p>'+category+'</p></div>')
								}else{
									$('#all_images').append('<div class="col-md-4 m-b-4 mb-3"><img src="' + src +
                                    '" alt="" height="200" width="200"><p>'+category+'</p></div>')
								}
                            }
                        }
                    },
                });
            })

            $(document).on('click', '#saveBuilding', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                var amenities = []
                var contact_details = [];
                var security_details = [];
                $(".building_amenity").each(function(index) {
                    if ($(this).prop('checked')) {
                        amenities.push(1);
                    } else {
                        amenities.push(0);
                    }
                });
                amenities = JSON.stringify(amenities);

                $("#modal_form [name=contact_person_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).parent().attr('data-contact_id');
                    name = $(this).val();
                    no = $("[data-contact_id=" + unique_id + "] input[name=contact_person_no]").val();
                    cona_arr.push(name)
                    cona_arr.push(no)
                    if (filtercona_arr(cona_arr)) {
						contact_details.push(cona_arr)
					}
                });
                contact_details = JSON.stringify(contact_details);
                $("#modal_form [name=security_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).parent().attr('data-sec_id');
                    name = $(this).val();
                    no = $("[data-sec_id=" + unique_id + "] input[name=security_no]").val();
                    cona_arr.push(name)
                    cona_arr.push(no)
					if (filtercona_arr(cona_arr)) {
						security_details.push(cona_arr)
					}
                });
                security_details = JSON.stringify(security_details);

                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveBuilding') }}",
                    data: {
                        id: id,
                        name: $('#building_name').val(),
                        city_id: $('#city_id').val(),
                        state_id: $('#state_id').val(),
                        area_id: $('#area_id').val(),
                        builder_id: $('#builder_id').val(),
                        address: $('#address').val(),
                        pincode: $('#pincode').val(),
                        status: Number($('#status').prop('checked')),
                        landmark: $('#landmark').val(),
                        prime_building: Number($('#prime_building').prop('checked')),
                        building_posession: $('#building_posession').val(),
                        floor_count: $('#floor_count').val(),
                        unit_no: $('#unit_no').val(),
                        lift_count: $('#lift_count').val(),
                        property_type: JSON.stringify($('#property_type').val()),
                        restrictions: JSON.stringify($('#restrictions').val()),
                        building_status: $('#building_status').val(),
                        building_quality: $('#building_quality').val(),
                        Bulding_description: $('#Bulding_description').val(),
                        contact_details: contact_details,
                        security_details: security_details,
                        amenities: amenities,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
						$('#buildingTable').DataTable().draw();
                        $('#buildingModal').modal('hide');
						$('#saveBuilding').prop('disabled',false);
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
                    url: "{{ route('admin.importbuilding') }}",
                    data: formData,
                    success: function(data) {
                        $('#buildingTable').DataTable().draw();
                        $('#importmodal').modal('hide');
                        $('#import_form')[0].reset();
                    }
                });
            })



        </script>
    @endpush
