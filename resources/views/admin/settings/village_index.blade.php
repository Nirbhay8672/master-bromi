@extends('admin.layouts.app')
@section('content')
    <div class="page-body" x-data="village_form">
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
                            <h5 class="mb-3">List of Villages<a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <button
                                        class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#areaModal"
                                        data-tooltip="Add Village"
                                    ><i class="fa fa-plus"></i></button>

                                    <button
                                        class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-tooltip="Import Villages"
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
                                <table class="display" id="areaTable">
                                    <thead>
                                        <tr>
											<th style="width: 10px !important;">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>

                                            <th>Village</th>
                                            <th>Taluka</th>
                                            <th>District</th>
                                            <th>Status</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add New Village</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="modal_form" novalidate="">
                            <div class="row">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">District</label>
                                    <select id="state_id" required>
                                        <option value=""> District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">Taluka</label>
                                    <select id="city_id" required>
                                        <option value=""> Taluka</option>
                                        @foreach ($talukas as $taluka)
                                            @if($taluka['user_id'] == auth()->user()->id)
                                                <option value="{{ $taluka['id'] }}">{{ $taluka['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label for="area_name">Village Name</label>
                                    <input class="form-control" name="test_name" id="area_name" type="text"
                                        required="" autocomplete="off" required>
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
                                <button class="btn custom-theme-button" id="saveArea">Save</button>
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
                                    <select id="import_district_id">
                                        <option value=""> District</option>
                                        @foreach ($superDistrict as $district)
                                            <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="district_error"></span>
                                </div>
                                <div class="col">
                                    <select id="import_taluka_id">
                                        <option value="">-- Select Taluka --</option>
                                    </select>
                                    <span class="text-danger" id="taluka_error"></span>
                                </div>
                            </div>
                            <template x-if="village_array.length > 0">
                                <div class="row p-2">
                                    <div class="row mb-3">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-6 m-b-10">
                                            <input class="project_amenity form-check-input filled" id="check_all" x-model="check_all" type="checkbox" value="" @click="selectCheckbox($event)">
                                            <label class="form-check-label" for="check_all">Select All Area</label>
                                        </div>
                                        <span class="text-danger" id="area_error"></span>
                                    </div>
                                    <template x-for="(area, index) in village_array">
                                        <div class="form-check checkbox checkbox-solid-success mb-0 col-md-3 m-b-10">
                                            <input class="project_amenity form-check-input filled" :id="`area_${area.id}`" type="checkbox" :value="area.id" x-model="selected_area">
                                            <label class="form-check-label" :for="`area_${area.id}`" x-text="area.name"></label>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <div class="text-center">
                                <button class="btn custom-theme-button" @click="importArea()" type="button">Save</button>
                                <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @php
            $district_encoded = json_encode($districts);
            $taluka_encoded = json_encode($talukas);

            $supertalukas = json_encode($superTaluka);
        @endphp
    @endsection
    @push('scripts')

    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script type="text/javascript">

            $('#areaModal').on('hidden.bs.modal', function () {
                $("#this_data_id").val('');
                $("#state_id").val('').trigger('change');
                $("#city_id").val('').trigger('change');
                $("#modal_form").validate().resetForm();
                $("#area_name").val('');
                $("#area_active").attr('checked', false);
            });

            document.addEventListener('alpine:init', () => {
    
                Alpine.data('village_form', () => ({

                    init() {
                        let _this = this;
                        $('#import_taluka_id').on('change', function() {
                            _this.setArea();
                        });
                    },

                    village_array : [],
                    selected_area : [],
                    check_all : false,

                    selectCheckbox(event) {
                        _this = this;
                        if(event.target.checked) {
                            _this.village_array.forEach((city) => {
                                _this.selected_area.push(city.id);   
                            });
                        } else {
                            _this.selected_area = [];
                        }
                    },

                    setArea() {
                        let _this = this;
                        if($('#import_taluka_id').val() != '') {
                            _this.selected_area = [];
                            let url = "{{ route('admin.settings.getVillageForImport') }}";
                            axios.post(url , { 'taluka_id' : $('#import_taluka_id').val()}).then((response) => {
                                _this.village_array = response.data.data.village_data;
                            });
                        } else {
                            _this.village_array = [];
                        }
                    },

                    importArea() {
                        let _this = this;
                        document.getElementById('taluka_error').innerHTML = '';
                        document.getElementById('district_error').innerHTML = '';

                        let city_id = $('#import_taluka_id').val();
                        let state_id = $('#import_district_id').val();

                        if(city_id == '' || this.selected_area.length == 0 || state_id == '') {
                            if(city_id == '') {
                                document.getElementById('taluka_error').innerHTML = 'Taluka field is required.';
                            }
                            if(state_id == '') {
                                document.getElementById('district_error').innerHTML = 'District field is required.';
                            }

                            if(this.selected_area.length == 0) {
                                let area_error =  document.getElementById('area_error');

                                if(area_error) {
                                    area_error.innerHTML = 'Please select at least one village.';
                                }
                            }

                            return;
                        }

                        let url = "{{ route('admin.importvillage') }}";
                    
                        axios.post(url, {
                            'village_array' : _this.selected_area,
                            'taluka_id' : city_id,
                            'district_id' : state_id,
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

                var districts = @Json($district_encoded);
                var talukas = @Json($taluka_encoded);

                $(document).on('change', '#state_id', function(e) {
                    if (shouldchangecity) {
                        $('#city_id').select2('destroy');
                        talukasss = JSON.parse(talukas);
                        $('#city_id').html('');
                        for (let i = 0; i < talukasss.length; i++) {
                            if (talukasss[i]['district_id'] == $("#state_id").val()) {
                                $('#city_id').append('<option value="' + talukasss[i]['id'] + '">' + talukasss[i][
                                    'name'
                                ] + '</option>')
                            }
                        }
                        $('#city_id').select2();
                    }
                })

                var supercities = @Json($supertalukas);

                $(document).on('change', '#import_district_id', function(e) {
                    $('#import_taluka_id').select2('destroy');
                    supercitiess = JSON.parse(supercities);
                    $('#import_taluka_id').html('');
                    $('#import_taluka_id').append('<option value="">-- Select Taluka --</option>');
                    for (let i = 0; i < supercitiess.length; i++) {
                        if (supercitiess[i]['district_id'] == $("#import_district_id").val()) {
                            $('#import_taluka_id').append('<option value="' + supercitiess[i]['id'] + '">' + supercitiess[i][
                                'name'
                            ] + '</option>')
                        }
                    }
                    $('#import_taluka_id').select2();
                })

                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var go_data_id = urlParams.get('data_id');

                $('#areaTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: "{{ route('admin.villages') }}",
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
                            data: 'taluka',
                            name: 'taluka'
                        },
                        {
                            data: 'district',
                            name: 'district'
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
                    url: "{{ route('admin.get_village') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#this_data_id').val(data.id)
                        $('#area_name').val(data.name)
                        $('#city_id').val(data.taluka_id).trigger('change');
                        $('#state_id').val(data.district_id).trigger('change');
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
                            url: "{{ route('admin.destroy_village') }}",
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
                            url: "{{ route('admin.destroy_village') }}",
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
                    url: "{{ route('admin.save_village') }}",
                    data: {
                        id: id,
                        name: $('#area_name').val(),
                        taluka_id: $('#city_id').val(),
                        district_id: $('#state_id').val(),
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
