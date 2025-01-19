@extends('superadmin.layouts.superapp')
@section('content')
    <div class="page-body" x-data="area_index">
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
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>

                            <div class="row mt-3 mb-3 gy-3">
                                <div style="width: 70px;">
                                    <button
                                        class="btn custom-icon-theme-button open_modal_with_this tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#areaModal"
                                        data-tooltip="Add Locality"
                                    ><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-12 col-lg-3 col-md-3">
                                    <select
                                        id="filter_state_id"
                                        class="form-control"
                                        style="border: 1px solid black;"
                                        x-model="selected_state"
                                        @change="selectState()"
                                    >
                                        <option value="">-- Select State --</option>
                                        <template x-for="(state, index) in states" :key="`state_${index}`">
                                            <option :value="state.id" style="text-transform: capitalize !important;"><span x-text="state.name"></span></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-3 col-md-3">
                                    <select
                                        id="filter_city_id"
                                        class="form-control"
                                        style="border: 1px solid black;"
                                        x-model="selected_city"
                                    >
                                        <option value="">-- Select City --</option>
                                        <template x-for="(city, index) in cities" :key="`city_${index}`">
                                            <option :value="city.id" style="text-transform: capitalize !important;"><span x-text="city.name"></span></option>
                                        </template>
                                    </select>
                                </div>
                                <div style="width: 300px;">
                                    <button
                                        class="btn custom-icon-theme-button tooltip-btn"
                                        type="button"
                                        data-tooltip="Filter"
                                        @click="filter()"
                                    ><i class="fa fa-filter"></i>
                                    </button>
                                    <button
                                        class="btn btn-warning ms-2 tooltip-btn"
                                        type="button"
                                        style="border-radius: 5px;"
                                        data-tooltip="Reset"
                                        @click="reset()"
                                    ><i class="fa fa-recycle"></i>
                                    </button>
                                    <button
                                        class="btn custom-icon-theme-button open_modal_with_this ms-2 tooltip-btn"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#importModal"
                                        data-tooltip="Import Localities"
                                    ><i class="fa fa-download"></i>
                                    </button>
                                    <button
                                        class="btn delete_table_row ms-3 tooltip-btn"
                                        style="display: none;background-color:red;border-radius:5px;color:white;"
                                        onclick="deleteTableRow()"
                                        data-tooltip="Delete Localities"
                                        type="button"
                                    ><i class="fa fa-trash"></i>
                                    </button>
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
                                                    <input class="form-check-input" id="select_all_checkbox"
                                                        name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>

                                            <th>Locality</th>
                                            <th>City</th>
                                            <th>Pincode</th>
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

        <div class="modal fade" id="importModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Locality</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark" action="{{ route('superadmin.areaImport') }}" method="POST" enctype="multipart/form-data">
                            @csrf    
                            <div class="form-row mb-2 mt-2">
                                <div>
                                    <div class="form-group col-md-12 mb-1">
                                        <label for="State">CSV File</label>
                                        <input
                                            class="form-control"
                                            name="csv_file"
                                            id="csv_file"
                                            accept=".csv"
                                            type="file"
                                            style="border:1px solid black"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <i class="fa fa-arrow-right me-2"></i><span class="text-primary" style="cursor: pointer;" onclick="openDocument('localities.csv')">Sample File</span>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button class="btn custom-theme-button" type="submit">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="areaModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Locality</h5>
                        <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="modal_form" novalidate="">
                            <div class="form-row">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">State</label>
                                    <select id="state_id">
                                        <option value=""> State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label class="mb-0">City</label>
                                    <select id="city_id">
                                        <option value=""> City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="this_data_id" id="this_data_id">
                                <div class="form-group col-md-5 d-inline-block m-b-20">
                                    <label for="area_name">Locality Name</label>
                                    <input class="form-control" name="test_name" id="area_name" type="text"
                                        required="" autocomplete="off">
                                </div>
                                <div class="form-group col-md-3 d-inline-block m-b-20">
                                    <label for="pincode">Pincode</label>
                                    <input class="form-control" name="pincode" id="pincode" type="text"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" type="button" id="saveArea">Save</button>
                                <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
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

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <script>
            var shouldchangecity = 1;

            $(document).ready(function() {

                var cities = @Json($city_encoded);
                var states = @Json($state_encoded);

				$("select").each(function(index) {
					$(this).select2();
				});

                $('#filter_city_id').select2('destroy');
                $('#filter_state_id').select2('destroy');

                $(document).on('change', '#state_id', function(e) {
                    if (shouldchangecity) {
                        $('#city_id').select2('destroy');
                        citiesar = JSON.parse(cities);
                        $('#city_id').html('');
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

                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var go_data_id = urlParams.get('data_id');

                let state_id = document.getElementById('filter_state_id');
                let city_id = document.getElementById('filter_city_id');

                $('#areaTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: "{{ route('superadmin.settings.area') }}",
                        data: function(d) {
                            d.go_data_id = go_data_id;
                            d.state_id = state_id.value ?? '';
                            d.city_id = city_id.value ?? '';
                        },
                    },
                    columns: [{
                            data: 'select_checkbox',
                            name: 'select_checkbox',
                        }, {
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
                            data: 'Actions',
                            name: 'Actions',
                            orderable: false
                        },
                    ]
                });
            });

            function getArea(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.settings.getarea') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#this_data_id').val(data.id).trigger('change');
                        $('#area_name').val(data.name).trigger('change');
                        $('#pincode').val(data.pincode).trigger('change');
                        $('#city_id').val(data.super_city_id).trigger('change');
                        $('#state_id').val(data.state_id).trigger('change');
                            $('#areaModal').modal('show');

                    }
                });
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
                                url: "{{ route('superadmin.settings.deletearea') }}",
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
                            url: "{{ route('superadmin.settings.deletearea') }}",
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
                $(this).prop('disabled', true);
                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.settings.savearea') }}",
                    data: {
                        id: id,
                        name: $('#area_name').val(),
                        super_city_id: $('#city_id').val(),
                        pincode: $('#pincode').val(),
                        state_id: $('#state_id').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#areaTable').DataTable().draw();
                        $('#areaModal').modal('hide');
                        $('#saveArea').prop('disabled', false);
                    }
                });
            })

            document.addEventListener('alpine:init', () => {

                Alpine.data('area_index', () => ({

                    init() {
                        this.states = JSON.parse(@JSON(json_encode($states)));

                        console.log(this.states);
                    },

                    states : [],
                    cities : [],
                    selected_state : null,
                    selected_city : null,

                    selectState() {
                        
                        this.selected_city = null;

                        if(this.selected_state) {
                            let obj = this.states.filter(state => state.id == this.selected_state);
                            this.cities = obj[0].cities;
                        } else {
                            this.cities = [];
                            this.selected_city = null;
                        }
                    },

                    filter() {
                        $('#areaTable').DataTable().draw();
                    },

                    reset() {
                        this.cities = [];
                        this.selected_state = null;
                        this.selected_city = null;

                        let state_id = document.getElementById('filter_state_id');
                        let city_id = document.getElementById('filter_city_id');

                        state_id.value = '';
                        city_id.value = '';

                        $('#areaTable').DataTable().draw();
                    }
                }));
            });

        </script>
    @endpush
