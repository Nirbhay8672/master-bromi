@extends('admin.layouts.app')
@section('content')
    <div class="page-body" x-data="city_form">
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
                            <h5 class="mb-3">List of Cities <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#cityModal"
                                        data-tooltip="Add City"
                                    ><i class="fa fa-plus"></i></button>

                                    <button
                                        class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-tooltip="Import City"
                                        data-bs-toggle="modal"
                                        data-bs-target="#importmodal"
                                    ><i class="fa fa-download"></i></button>

                                    <button
                                        class="btn text-white delete_table_row ms-3 tooltip-btn"
                                        style="border-radius: 5px;display: none;background-color:red"
                                        onclick="deleteTableRow()"
                                        type="button"
                                        data-tooltip="Delete"
                                    ><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="cityTable">
                                    <thead>
                                        <tr>
											<th style="width: 10px !important;">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>
                                            <th>City</th>
											<th>State</th>
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
        <div class="modal fade" id="cityModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New City</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <div class="row mb-2">
                                <div class="col-6 mb-2" style="margin-top: 20px;">
                                    <div class="form-group mb-1">
                                        <label for="City">City</label>
                                        <input
                                            class="form-control"
                                            name="city_name"
                                            id="city_name"
                                            type="text"
                                            required
                                        >  
                                    </div>
                                    <label id="city_name-error" class="error" for="city_name"></label>
                                </div>
                                <div class="col-6 mb-2">
                                    <label class="mb-0">State</label>
                                    <select class="form-select" id="state_id" required>
                                        <option value="">State</option>
                                        @forelse ($states as $state)
                                            @if($state->user_id == auth()->user()->id)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="saveCity">Save</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Import Cities</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation" method="post" id="import_form" novalidate="">
							<div class="form-row">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">State</label>
                                    <select id="import_state_id" required>
                                        <option value=""> State</option>
                                        @foreach ($states as $state)
                                            @if($state->user_id == 6)
                                                <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="state_error"></span>
                                </div>
							</div>
                            <template x-if="city_array.length > 0">
                                <div class="row p-2">
                                    <div class="row mb-3">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-6 m-b-10">
                                            <input class="project_amenity form-check-input filled" id="check_all" x-model="check_all" type="checkbox" value="" @click="selectCheckbox($event)">
                                            <label class="form-check-label" for="check_all">Select All City</label>
                                        </div>
                                        <span class="text-danger" id="city_error"></span>
                                    </div>
                                    <template x-for="(city, index) in city_array">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-10">
                                            <input class="project_amenity form-check-input filled" :id="`city_${city.id}`" type="checkbox" :value="city.id" x-model="selected_city">
                                            <label class="form-check-label" :for="`city_${city.id}`" x-text="city.name"></label>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <div class="text-center">
                                <button class="btn custom-theme-button" type="button" @click="importCity">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')

        <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script type="text/javascript">

            document.addEventListener('alpine:init', () => {
    
                Alpine.data('city_form', () => ({

                    init() {
                        let _this = this;
                        $('#import_state_id').on('change', function() {
                            _this.setcities();
                        });
                    },

                    city_array : [],
                    selected_city : [],
                    check_all : false,

                    selectCheckbox(event) {
                        _this = this;
                        if(event.target.checked) {
                            _this.city_array.forEach((city) => {
                                _this.selected_city.push(city.id);   
                            });
                        } else {
                            _this.selected_city = [];
                        }
                    },

                    setcities() {
                        let _this = this;
                        if($('#import_state_id').val() != '') {
                            _this.selected_city = [];
                            let url = "{{ route('admin.settings.getCityForImport') }}";
                            axios.post(url , { 'state_id' : $('#import_state_id').val()}).then((response) => {
                                _this.city_array = response.data.data.city_data;
                            });
                        } else {
                            _this.city_array = [];
                        }
                    },

                    importCity() {
                        let _this = this;
                        document.getElementById('state_error').innerHTML = '';

                        let state_id = $('#import_state_id').val();
                        if(state_id == '' || this.selected_city.length == 0) {
                            if(state_id == '') {
                                document.getElementById('state_error').innerHTML = 'State field is required.';
                            }

                            if(this.selected_city.length == 0) {
                                let city_error =  document.getElementById('city_error');

                                if(city_error) {
                                    city_error.innerHTML = 'Please select at least one city.';
                                }
                            }

                            return;
                        }

                        let url = "{{ route('admin.importcity') }}";
                    
                        axios.post(url, {
                            'city_array' : _this.selected_city,
                            'state_id' : state_id,
                        })
                        .then((res) => {
                            $('#cityTable').DataTable().draw();
                            $('#importmodal').modal('hide');
                            $('#import_form')[0].reset();
                        });
                    }
                }));
            });

        </script>

        <script>

            $(document).ready(function() {

                $('#cityModal').on('hidden.bs.modal', function () {
                    $("#this_data_id").val('');
                    $("#city_name").val('');
                    $("#modal_form").validate().resetForm();
                    $("#state_id").val('').trigger('change');
                });

                $('#cityTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.settings.city') }}",
                    columns: [
						{
                            data: 'select_checkbox',
                            name: 'select_checkbox',
							orderable: false
                        },
						{
                            data: 'name',
                            name: 'name'
                        },
						{
                            data: 'state_id',
                            name: 'state_id'
                        },
                        {
                            data: 'Actions',
                            name: 'Actions',
                            orderable: false
                        },
                    ],
					columnDefs: [{
                            "width": "3%",
                            "targets": 0
                        }
                    ],
                });
            });

            function getCity(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.settings.getcity') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#this_data_id').val(data.id)
                        $('#city_name').val(data.name).trigger('change');
						$('#state_id').val(data.state_id).trigger('change');
                        $('#cityModal').modal('show');
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
                            url: "{{ route('admin.settings.destroycity') }}",
                            data: {
								allids: JSON.stringify(rowss),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
								$('.delete_table_row').hide();
                                $('#cityTable').DataTable().draw();
                            }
                        });
                    }
                })
				}
			}


            function deleteCity(data) {
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
                            url: "{{ route('admin.settings.destroycity') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#cityTable').DataTable().draw();
                            }
                        });
                    }
                })
            }

            $(document).on('click', '#saveCity', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.settings.savecity') }}",
                    data: {
                        id: id,
                        name: $('#city_name').val(),
						state_id: $('#state_id').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#cityTable').DataTable().draw();
                        $('#cityModal').modal('hide');
						$('#saveCity').prop('disabled',false);
                    }
                });
            })

        </script>
    @endpush
