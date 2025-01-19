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
                            <h5 class="mb-3">List of Talukas<a class="btn custom-icon-theme-button tooltip-btn"
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
                                        data-tooltip="Add Taluka"
                                        onclick="reset()"
                                    ><i class="fa fa-plus"></i></button>

                                    <button
                                        class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-tooltip="Import Talukas"
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
                                            <th>Taluka</th>
											<th>District</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add New Taluka</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <div class="form-row">
                                <div class="form-group col-md-7 d-inline-block m-b-20">
                                    <label for="taluka_name">Taluka</label>
                                    <input
                                        class="form-control"
                                        name="taluka_name"
                                        id="taluka_name"
                                        type="text"
                                        required
                                    >
                                </div>
                                <div class="form-group ms-3 col-md-4 d-inline-block m-b-4 mt-1">
                                    <label class="mb-0">State</label>
                                    <select class="form-select" id="district_id" required>
                                        <option value="">District</option>
                                        @forelse ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
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
                        <h5 class="modal-title" id="exampleModalLabel">Import Talukas</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation" method="post" id="import_form" novalidate="">
							<div class="form-row">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">District</label>
                                    <select id="import_district_id" required>
                                        <option value="">-- Select District --</option>
                                        @foreach ($super_admin_districts as $district)
                                            <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="state_error"></span>
                                </div>
							</div>
                            <template x-if="taluka_array.length > 0">
                                <div class="row p-2">
                                    <div class="row mb-3">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-6 m-b-10">
                                            <input class="project_amenity form-check-input filled" id="check_all" x-model="check_all" type="checkbox" value="" @click="selectCheckbox($event)">
                                            <label class="form-check-label" for="check_all">Select All Talukas</label>
                                        </div>
                                        <span class="text-danger" id="city_error"></span>
                                    </div>
                                    <template x-for="(taluka, index) in taluka_array">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-10">
                                            <input class="project_amenity form-check-input filled" :id="`taluka_${taluka.id}`" type="checkbox" :value="taluka.id" x-model="selected_taluka">
                                            <label class="form-check-label" :for="`taluka_${taluka.id}`" x-text="taluka.name"></label>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <div class="text-center">
                                <button class="btn custom-theme-button" type="button" @click="importCity()">Save</button>
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

            $('#cityModal').on('hidden.bs.modal', function () {
                $("#this_data_id").val('');
                $("#district_id").val('').trigger('change');
                $("#modal_form").validate().resetForm();
                $("#taluka_name").val('');
            });

            document.addEventListener('alpine:init', () => {

                Alpine.data('city_form', () => ({

                    init() {
                        let _this = this;
                        $('#import_district_id').on('change', function() {
                            _this.setTalukas();
                        });
                    },

                    taluka_array : [],
                    selected_taluka : [],
                    check_all : false,

                    selectCheckbox(event) {
                        _this = this;
                        if(event.target.checked) {
                            _this.taluka_array.forEach((city) => {
                                _this.selected_taluka.push(city.id);   
                            });
                        } else {
                            _this.selected_taluka = [];
                        }
                    },

                    setTalukas() {
                        let _this = this;
                        if($('#import_district_id').val() != '') {
                            _this.selected_taluka = [];
                            let url = "{{ route('admin.setting.getTaluka') }}";
                            axios.post(url , { 'district_id' : $('#import_district_id').val()}).then((response) => {
                                _this.taluka_array = response.data.data.taluka_data;
                            });
                        } else {
                            _this.taluka_array = [];
                        }
                    },

                    importCity() {
                        let _this = this;
                        document.getElementById('state_error').innerHTML = '';

                        let district_id = $('#import_district_id').val();

                        if(district_id == '' || this.selected_taluka.length == 0) {
                            if(district_id == '') {
                                document.getElementById('state_error').innerHTML = 'State field is required.';
                            }

                            if(this.selected_taluka.length == 0) {
                                let city_error =  document.getElementById('city_error');

                                if(city_error) {
                                    city_error.innerHTML = 'Please select at least one city.';
                                }
                            }

                            return;
                        }

                        let url = "{{ route('admin.importTaluka') }}";
                    
                        axios.post(url, {
                            'taluka_array' : _this.selected_taluka,
                            'district_id' : district_id,
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
                $('#cityTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.talukas') }}",
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
                            data: 'district_id',
                            name: 'district_id'
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
                    url: "{{ route('admin.save_taluka') }}",
                    data: {
                        id: id,
                        name: $('#taluka_name').val(),
						district_id: $('#district_id').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#cityTable').DataTable().draw();
                        $('#cityModal').modal('hide');
						$('#saveCity').prop('disabled',false);
                    }
                });
            })

            function reset() {
                $('#modal_form').trigger("reset");
                $('#district_id').val('').trigger('change')
            }

            function getCity(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.get_taluka') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#this_data_id').val(data.id)
                        $('#taluka_name').val(data.name).trigger('change');
						$('#district_id').val(data.district_id).trigger('change');
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
				if (rowss.length>0)
                {
					Swal.fire({
                        title: "Are you sure?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                    }).then(function(isConfirm) {
                        if (isConfirm.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.destroy_taluka') }}",
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
                            url: "{{ route('admin.destroy_taluka') }}",
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

        </script>
    @endpush
