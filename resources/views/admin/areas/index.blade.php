@extends('admin.layouts.app')
@section('content')
    <div class="page-body" x-data="area_form">
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
                            <h5 class="mb-3">List of Locality <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <div class="row mt-2 mb-2">
                                <div class="col">

                                    @can('area-create')
                                    <button
                                        class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#areaModal"
                                        data-tooltip="Add Locality"
                                    ><i class="fa fa-plus"></i></button>
                                    @endcan

                                    <button
                                        class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-tooltip="Import Locality"
                                        data-bs-toggle="modal"
                                        data-bs-target="#importmodal"
                                    ><i class="fa fa-download"></i></button>

                                    @can('area-delete')

                                    <button
                                        class="btn text-white delete_table_row ms-3 tooltip-btn"
                                        style="border-radius: 5px;display: none;background-color:red"
                                        onclick="deleteTableRow()"
                                        type="button"
                                        data-tooltip="Delete"
                                    ><i class="fa fa-trash"></i></button>
                                    
                                    @endcan
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="areaTable">
                                    <thead>
                                        <tr>
											<th style="width: 10px !important;">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>

                                            <th>Locality</th>
                                            <th>City</th>
                                            <th>Pincode</th>
                                            <th>State</th>
                                            <th>status</th>
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
        <div class="modal fade" id="areaModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Locality</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="modal_form" novalidate="">
                            <div class="row">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">State</label>
                                    <select id="state_id" required>
                                        <option value=""> State</option>
                                        @foreach ($states as $state)
                                            @if($state['user_id'] == auth()->user()->id)
                                                <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">City</label>
                                    <select id="city_id" required>
                                        <option value=""> City</option>
                                        @foreach ($cities as $city)
                                            @if($city['user_id'] == auth()->user()->id)
                                                <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <div>
                                        <label for="area_name">Locality Name</label>
                                        <input
                                            class="form-control"
                                            name="test_name"
                                            id="area_name"
                                            type="text"
                                            required=""
                                            autocomplete="off"
                                            required
                                        >
                                    </div>
                                    <label id="area_name-error" class="error" for="area_name"></label>
                                </div>
                                <div class="form-group col-md-3 d-inline-block m-b-20">
                                    <div>
                                        <label for="pincode">Pincode</label>
                                        <input class="form-control" name="pincode" id="pincode" type="text"
                                        autocomplete="off" required>
                                    </div>
                                    <label id="pincode-error" class="error" for="pincode"></label>
                                </div>
                                <div class="row">
                                    <div class="d-flex align-items-center mb-3 col-md-2">
                                        <div class="form-group me-2">
                                            <label for="area_active" class="mb-1">Active</label>
                                        </div>
                                        <div class="media-body text-end icon-state">
                                            <label class="switch mb-0">
                                                <input type="checkbox" id="area_active" checked>
                                                <span class="switch-state"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" type="button" id="saveArea">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="importmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Areas</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="import_form" novalidate="">
                            <div class="row g-3 mt-2 mb-4">
                                <div class="col">
                                    <select id="import_state_id">
                                        <option value=""> State</option>
                                        @foreach ($states as $state)
                                            @if($state['user_id'] == 6)
                                                <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="state_error"></span>
                                </div>
                                <div class="col">
                                    <select id="import_city_id">
                                        <option value="">-- Select City --</option>
                                    </select>
                                    <span class="text-danger" id="city_error"></span>
                                </div>
                            </div>
                            <template x-if="area_array.length > 0">
                                <div class="row p-2">
                                    <div class="row mb-3">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-6 m-b-10">
                                            <input class="project_amenity form-check-input filled" id="check_all" x-model="check_all" type="checkbox" value="" @click="selectCheckbox($event)">
                                            <label class="form-check-label" for="check_all">Select All Area</label>
                                        </div>
                                        <span class="text-danger" id="area_error"></span>
                                    </div>
                                    <template x-for="(area, index) in area_array">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-10">
                                            <input class="project_amenity form-check-input filled" :id="`area_${area.id}`" type="checkbox" :value="area.id" x-model="selected_area">
                                            <label class="form-check-label" :for="`area_${area.id}`" x-text="area.name"></label>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <div class="text-center">
                                <button class="btn custom-theme-button" type="button" @click="importArea">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @php
            $city_encoded = json_encode($cities);
            $state_encoded = json_encode($states);
            $supercities = json_encode($supercities);
        @endphp
    @endsection
    @push('scripts')

        <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script type="text/javascript">

            $('#areaModal').on('hidden.bs.modal', function () {
                $("#this_data_id").val('');
                $("#city_id").val('').trigger('change');
                $("#state_id").val('').trigger('change');
                $("#modal_form").validate().resetForm();
                $("#area_name").val('');
                $("#pincode").val('');
                $("#area_active").attr('checked', false);
            });

            document.addEventListener('alpine:init', () => {
    
                Alpine.data('area_form', () => ({

                    init() {
                        let _this = this;
                        $('#import_city_id').on('change', function() {
                            _this.setArea();
                        });
                    },

                    area_array : [],
                    selected_area : [],
                    check_all : false,

                    selectCheckbox(event) {
                        _this = this;
                        if(event.target.checked) {
                            _this.area_array.forEach((city) => {
                                _this.selected_area.push(city.id);   
                            });
                        } else {
                            _this.selected_area = [];
                        }
                    },

                    setArea() {
                        let _this = this;
                        if($('#import_city_id').val() != '') {
                            _this.selected_area = [];
                            let url = "{{ route('admin.settings.getAreaForImport') }}";
                            axios.post(url , { 'city_id' : $('#import_city_id').val()}).then((response) => {
                                _this.area_array = response.data.data.area_data;
                            });
                        } else {
                            _this.area_array = [];
                        }
                    },

                    importArea() {
                        let _this = this;
                        document.getElementById('city_error').innerHTML = '';
                        document.getElementById('state_error').innerHTML = '';

                        let city_id = $('#import_city_id').val();
                        let state_id = $('#import_state_id').val();

                        if(city_id == '' || this.selected_area.length == 0 || state_id == '') {
                            if(city_id == '') {
                                document.getElementById('city_error').innerHTML = 'City field is required.';
                            }
                            if(state_id == '') {
                                document.getElementById('state_error').innerHTML = 'State field is required.';
                            }

                            if(this.selected_area.length == 0) {
                                let area_error =  document.getElementById('area_error');

                                if(area_error) {
                                    area_error.innerHTML = 'Please select at least one area.';
                                }
                            }

                            return;
                        }

                        let url = "{{ route('admin.importarea') }}";
                    
                        axios.post(url, {
                            'area_array' : _this.selected_area,
                            'city_id' : city_id,
                            'state_id' : state_id,
                        })
                        .then((res) => {
                            $('#areaTable').DataTable().draw();
                            $('#importmodal').modal('hide');
                            $('#import_form')[0].reset();
                        });
                    }
                }));
            });

        </script>

        <script>
            var shouldchangecity = 1;

            $(document).ready(function() {

                var cities = @Json($city_encoded);
                var states = @Json($state_encoded);
                var supercities = @Json($supercities);

                $(document).on('change', '#state_id', function(e) {
                    if (shouldchangecity) {
                        $('#city_id').select2('destroy');
                        citiesar = JSON.parse(cities);
                        $('#city_id').html('');
                        $('#city_id').html('<option value="" disabled>Select City</option>');
                        for (let i = 0; i < citiesar.length; i++) {
                            if (citiesar[i]['state_id'] == $("#state_id").val()) {
                                $('#city_id').append('<option value="' + citiesar[i]['id'] + '">' + citiesar[i][
                                    'name'
                                ] + '</option>')
                            }
                        }
                        $('#city_id').select2();
                    }
                })

                $(document).on('change', '#import_state_id', function(e) {
                    $('#import_city_id').select2('destroy');
                    supercitiess = JSON.parse(supercities);
                    $('#import_city_id').html('');
                    $('#import_city_id').append('<option value="">-- Select City --</option>');
                    for (let i = 0; i < supercitiess.length; i++) {
                        if (supercitiess[i]['state_id'] == $("#import_state_id").val()) {
                            $('#import_city_id').append('<option value="' + supercitiess[i]['id'] + '">' + supercitiess[i][
                                'name'
                            ] + '</option>')
                        }
                    }
                    $('#import_city_id').select2();
                })

                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var go_data_id = urlParams.get('data_id')


                $('#areaTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: "{{ route('admin.areas') }}",
                        data: function(d) {
                            d.go_data_id = go_data_id;
                        },
                    },
                    "order":  [[ 1, "asc"]],
                    columns: [
						{
                            data: 'select_checkbox',
                            name: 'select_checkbox',
							orderable: false
                        },{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'pincode',
                            name: 'pincode'
                        },
                        {
                            data: 'state',
                            name: 'state'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'Actions',
                            name: 'Actions',
                            orderable: false
                        },
                    ]
                });
            });

            function getArea(data) {
                shouldchangecity = 0;
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getArea') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#this_data_id').val(data.id)
                        $('#area_name').val(data.name)
                        $('#pincode').val(data.pincode)
                        $('#city_id').val(data.city_id).trigger('change');
                        $('#state_id').val(data.state_id).trigger('change');
                        $('#area_active').prop('checked', Number(data.status)),
                            $('#areaModal').modal('show');
                        shouldchangecity = 1
                        triggerChangeinput()
                    }
                });
            }


			$(document).on('change', '#select_all_checkbox', function(e) {
				if ($(this).prop('checked')) {
					$('.delete_table_row').show();

					$(".table_checkbox").each(function(index) {
						$(this).prop('checked',true)
					})
				}else{
					$('.delete_table_row').hide();
					$(".table_checkbox").each(function(index) {
						$(this).prop('checked',false)
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
				}else{
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
				if (rowss.length>0) {
					Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function(isConfirm) {
                    if (isConfirm.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.deleteArea') }}",
                            data: {
								allids: JSON.stringify(rowss),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
								$('.delete_table_row').hide();
                                $('#areaTable').DataTable().draw();
                            }
                        });
                    }
                })
				}
			}


            function deleteArea(data) {
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
                            url: "{{ route('admin.deleteArea') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#areaTable').DataTable().draw();
                            }
                        });
                    }
                })

            }

            $(document).on('click', '#saveArea', function(e) {
                e.preventDefault();
				$("#modal_form").validate();
                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveArea') }}",
                    data: {
                        id: id,
                        name: $('#area_name').val(),
                        city_id: $('#city_id').val(),
                        pincode: $('#pincode').val(),
                        state_id: $('#state_id').val(),
                        status: Number($('#area_active').prop('checked')),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#areaTable').DataTable().draw();
                        $('#areaModal').modal('hide');
						$('#saveArea').prop('disabled',false);
                    }
                });
            })
        </script>
    @endpush
