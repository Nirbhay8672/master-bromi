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
                            <h5 class="mb-3">List of Units</h5>
                            @can('unit-create')
							<a class="btn btn-primary btn-air-primary"  href="{{route('admin.unit.add')}}">Add New Unit</a>
                            @endcan
                            <button class="btn btn-primary btn-air-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#filtermodal">Filter</button>
								<button style="display:none" class="btn btn-danger" id="resetfilter">Clear Filter</button>
								<button class="btn btn-primary btn-air-primary delete_table_row" style="display: none" onclick="deleteTableRow()"
									type="button">Delete</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="unitTable">
                                    <thead>
                                        <tr>
											<th>
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>
                                            <th>Project</th>
                                            <th>Wing</th>
                                            <th>Floor And Units</th>
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
        <div class="modal fade" id="unitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Unit</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                            novalidate="">
                            <input type="hidden" name="this_data_id" id="this_data_id">
                            <div class="row">


                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" name="project_id" id="project_id" required>
                                        <option value=""> Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="tower_id">
                                        <option value=""> Wing</option>
                                        @foreach ($towers as $tower)
                                            <option data-parent_id="" data-nameval="{{$tower['name']}}" value="{{  $tower['name'] }}">{{ $tower['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 m-b-4 mb-3">
                                    <select class="form-select" id="units_id">
                                        <option value=""> Unit Type</option>
                                        @foreach ($unit_types as $unit)
                                            <option data-parent_id="" data-size="{{ $unit['size'] }}"
                                                data-property_type="{{ $unit['property_type'] }}"
                                                data-measurement="{{ $unit['measurement'] }}" value="{{ $unit['name'] }}">
                                                {{ $unit['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 m-b-20">
									<label for="Property Type">Property Type</label>
                                    <input class="form-control" name="property_type" id="property_type" type="text"
                                        autocomplete="off"  disabled>
                                </div>
                                <div class="form-group col-md-6 m-b-20">
									<label for="Unit Size">Unit Size</label>
                                    <input class="form-control" name="unit_size" id="unit_size" type="text"
                                        autocomplete="off"  disabled>
                                </div>
                                <hr class="color-hr">
                                <label for="add Units"> Units</label>
                                <div><button type="button" class="btn mb-3 btn-primary btn-air-primary"
                                        id="add_floors">Add Unit</button></div>
                                <div class="row" id="all_floors">

                                </div>


                            </div>

                            @if (Auth::user()->can('unit-edit') || Auth::user()->can('unit-create'))
                                <button class="btn btn-secondary" id="saveUnit">Save</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="filter_form" novalidate="">
                            @csrf
                            <div>
                                <div class="row">

                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_project_id">
                                            <option value=""> Project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_tower_id">
                                            <option value="">Wing</option>
                                            @foreach ($towers as $tower)
                                                <option data-parent_id="filter_" value="{{ $tower['name'] }}">
                                                    {{ $tower['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_units_id">
                                            <option value=""> Unit</option>
                                            @foreach ($unit_types as $unit)
                                                <option data-parent_id="" data-size="{{ $unit['size'] }}"
                                                    data-property_type="{{ $unit['property_type'] }}"
                                                    data-measurement="{{ $unit['measurement'] }}"
                                                    value="{{ $unit['name'] }}">
                                                    {{ $unit['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_status">
                                            <option value="">Availability Status</option>
                                            <option value="Available">Available</option>
                                            <option value="SoldOut">Sold Out</option>
                                            <option value="OnHold">On Hold</option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <button class="btn btn-secondary" id="filtersearch">Filter</button>
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


                $('#unitTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.project.unit') }}",
                        data: function(d) {
                            d.filter_project_id = $('#filter_project_id').val();
                            d.filter_tower_id = $('#filter_tower_id').val();
                            d.filter_units_id = $('#filter_units_id').val();
                            d.filter_status = $('#filter_status').val();
                        },
                    },
                    columns: [
						{
                            data: 'select_checkbox',
                            name: 'select_checkbox',
							orderable: false
                        },
					{
                            data: 'project',
                            name: 'project'
                        },
                        {
                            data: 'tower_id',
                            name: 'tower_id'
                        },
                        {
                            data: 'floor_details',
                            name: 'floor_details'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false
                        },
                    ]
                });
            });

            function getUnit(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.project.getUnit') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('#this_data_id').val(data.id);
                        $('#project_id').val(data.project_id).trigger('change');;
                        $('#tower_id').val(data.tower_id).trigger('change');;
                        $('#units_id').val(data.units_id).trigger('change');;
                        if (data.units_id != '' && data.units_id != undefined) {
                            $('#property_type').val($('#units_id').find(':selected').attr('data-property_type')).trigger('change')
                            $('#unit_size').val(($('#units_id').find(':selected').attr('data-size') + ' ' + $('#units_id').find(':selected').attr('data-measurement')).trim()).change()
                        }
                        $('#all_floors').html('');
                        if (data.floor_details != '') {
                            details = JSON.parse(data.floor_details);
                            for (let i = 0; i < details.length; i++) {
                                id = makeid(10);
                                $('#all_floors').append(generate_floor_details(id))
								$("[data-contact_id=" + id + "] [name=floor_status]").select2()
                                $("[data-contact_id=" + id + "] [name=floor_number]").val(details[i][0]).trigger('change');
                                $("[data-contact_id=" + id + "] [name=unit_no]").val(details[i][1]);
                                $("[data-contact_id=" + id + "] [name=floor_status]").val(details[i][2]).trigger('change');
								$("[data-contact_id=" + id + "] [name=contact_no]").val(details[i][3]).trigger('change');
                            }
                        }
                        $('#unitModal').modal('show');
						triggerChangeinput()
                    }
                });
            }

            $(document).on('click', '#filtersearch', function(e) {
                e.preventDefault();
                search_enq = '';
				$('#resetfilter').show();
                $('#unitTable').DataTable().draw();
                $('#filtermodal').modal('hide');
            });

            $(document).on('click', '#resetfilter', function(e) {
                e.preventDefault();
				$(this).hide();
                $('#filter_form').trigger("reset");
                $('#unitTable').DataTable().draw();
                $('#filtermodal').modal('hide');
				triggerResetFilter()
            });


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
							url: "{{ route('admin.project.deleteUnit') }}",
                            data: {
								allids: JSON.stringify(rowss),
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
								$('.delete_table_row').hide();
                                $('#unitTable').DataTable().draw();
                            }
                        });
                    }
                })
				}
			}

            function deleteUnit(data) {
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
                            url: "{{ route('admin.project.deleteUnit') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#unitTable').DataTable().draw();
                            }
                        });
                    }
                })

            }

			$(document).on("click", ".open_modal_with_this", function (e) {
				$('#all_floors').html('')
				$('#all_floors').append(generate_floor_details(makeid(10)));
				$("#all_floors select").each(function(index) {
					$(this).select2();
				})
			})

            function generate_floor_details(id) {
                var myvar = '      <div data-contact_id= ' + id +
                    ' class="form-group col-md-1 m-b-20">' +
                    '       <input class="form-control" name="floor_number"' +
                    '           type="text"  autocomplete="off"' +
                    '           placeholder="Floor">' +
                    '   </div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-1 m-b-20">' +
                    '       <input class="form-control" name="unit_no"' +
                    '           type="text"  autocomplete="off"' +
                    '           placeholder="Unit No">' +
                    '   </div>' +
                    '       <div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mt-1">' +
                    '    <select class="form-select" name="floor_status">' +
                    '     <option value=""> Status </option>' +
                    '    <option value="Available">Available</option>' +
                    '     <option value="SoldOut">SoldOut</option>' +
                    '     <option value="OnHold">OnHold</option>' +
                    '  </select>  </div>' +
					'<div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-20">' +
                    '       <input class="form-control" name="contact_no"' +
                    '           type="text"  autocomplete="off"' +
                    '           placeholder="Contact">' +
                    '   </div>'+
                    '<div data-contact_id= ' + id +
                    ' class="form-group col-md-1 m-b-4 mb-3"><button data-contact_id=' + id +
                    ' class="remove_floors btn btn-danger btn-air-danger" type="button">-</button>  </div>'+
					'<div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
                    ' class="add_to_property btn btn-danger btn-air-danger" type="button">Add Property</button></div>';
                return myvar;

            }

            $(document).on('click', '.add_to_property', function(e) {
				$(this).prop('disabled',true)
				id = $(this).attr('data-contact_id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.unit.saveproperty') }}",
                    data: {
                        project_id: $('#project_id').val(),
						tower_id: $("#tower_id").select2().find(":selected").attr("data-nameval"),
						unit_no: $("[data-contact_id=" + id + "] [name=unit_no]").val(),
						contact_no: $("[data-contact_id=" + id + "] [name=contact_no]").val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                    }
                });
				$(this).remove();
			})

            function makeid(length) {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }

            $(document).on('click', '#add_floors', function(e) {
                id = makeid(10);
                $('#all_floors').append(generate_floor_details(id));
				$("#all_floors select").each(function(index) {
					$(this).select2();
				})
            })
            $(document).on('click', '.remove_floors', function(e) {
                id = $(this).attr('data-contact_id');
                $("[data-contact_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $(document).on('change', '#units_id', function(e) {
                if($(this).find(':selected').attr('data-property_type') == undefined){
                    $('#property_type').parent().parent().removeClass('focused');
                    $('#unit_size').parent().parent().removeClass('focused');
                }else{
                    $('#property_type').parent().parent().addClass('focused');
                    $('#unit_size').parent().parent().addClass('focused');
                }
                $('#property_type').val($(this).find(':selected').attr('data-property_type'))
                $('#unit_size').val((($(this).find(':selected').attr('data-size') + ' ' + $(this).find(':selected').attr(
                    'data-measurement')).replaceAll('undefined', "")).trim())

            })

            $(document).on('click', '#saveUnit', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
					return
                }
				$(this).prop('disabled',true);
                var floor_details = [];
                $("#all_floors [name=floor_number]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).parent().attr('data-contact_id');
                    floor = $(this).val();
                    no = $("[data-contact_id=" + unique_id + "] [name=unit_no]").val();
                    status = $("[data-contact_id=" + unique_id + "] [name=floor_status]").val();
					contact = $("[data-contact_id=" + unique_id + "] [name=contact_no]").val();
                    cona_arr.push(floor)
                    cona_arr.push(no)
                    cona_arr.push(status)
					cona_arr.push(contact)
					if (filtercona_arr(cona_arr)) {
						floor_details.push(cona_arr);
					}
                });

                floor_details = JSON.stringify(floor_details);

                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.project.saveUnit') }}",
                    data: {
                        id: id,
                        project_id: $('#project_id').val(),
                        tower_id: $('#tower_id').val(),
                        units_id: $('#units_id').val(),
                        floor_details: floor_details,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
						$('#unitTable').DataTable().draw();
                        $('#unitModal').modal('hide');
						$('#saveUnit').prop('disabled',false);
                    }
                });
            })
        </script>
    @endpush
