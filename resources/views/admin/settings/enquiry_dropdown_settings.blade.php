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
            <div class="row project-cards">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">{{ $type }} <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="row" id="configuration_container">

                                <div class="col-xxl-8 box-col-8 col-lg-8">
                                    <div class="project-box">
                                    
                                        <span
                                            id="openAddFieldMOdal"
                                            data-dropdown_for="enquiry_sales_comment"
                                            class="badge btn btn-primary badge-primary"
                                        ><i class="fa fa-plus"></i></span>
                                            
                                        <h6>Sales Comment</h6>
                                        <div class="row details mt-5">
                                            <ul class="drop_list_container" id="enquiry_sales_comment_ul">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <div class="modal fade" id="addmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add / Edit</h5>
                    <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation " method="post" id="add_edit_form" novalidate="">
                        @csrf
                        <input type="hidden" name="dropdown_for" id="dropdown_for">
                        <input type="hidden" name="this_data_id" id="this_data_id">
                        <div class="row">
                            <div class="form-group col-md-7 m-b-20 d-inline-block">
                                <label for="name">Name:</label>
                                <input class="form-control" type="text"  name="field_name"
                                    id="field_name">
                            </div>
                            <div class="form-group col-md-4 m-b-20 d-inline-block">
                                <select class="form-select" id="parent_id">
                                    <option value="1">Item Category* </option>
									<option value="2">New Lead</option>
									<option value="3"> Lead Confirmed</option>
									<option value="4"> Site Visit Scheduled</option>
									<option value="5"> Site Visit Completed</option>
									<option value="6"> Discussion</option>
									<option value="7"> Booked</option>
									<option value="8"> Lost</option>
                                </select>
                            </div>
							<div class="form-group col-md-7 m-b-20 " id="color_picker">
								<label class="col-sm-3 col-form-label pt-0">Color picker</label>
								  <input class="form-control form-control-color" id="color_picker_input" type="color" value="#5655e5">
							  </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn custom-theme-button" id="saveField">Save</button>
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
            getList()
        });

        $(document).on('click', '#openAddFieldMOdal', function(e) {
            $('#parent_id').val('');
            $('#dropdown_for').val($(this).attr('data-dropdown_for'))
            $('#this_data_id').val('')
            $('#field_name').val('');
			if ($(this).attr('data-dropdown_for') == 'enquiry_progress') {
				$('#parent_id').next(".select2-container").hide();
				$('#color_picker').show();
			}else{
				$('#parent_id').next(".select2-container").show();
				$('#color_picker').hide();
			}
            $('#addmodal').modal('show');
			triggerChangeinput()
        })

        $(document).on('click', '.openEditFieldMOdal', function(e) {
            if ($(this).attr('data-parent_id') != '' && $(this).attr('data-parent_id') != 'null') {
                $('#parent_id').val($(this).attr('data-parent_id')).trigger('change');
            }
            $('#dropdown_for').val($(this).attr('data-dropdown_for'))
            $('#this_data_id').val($(this).attr('data-id'))
            $('#field_name').val($(this).attr('data-name'))
			if ($(this).attr('data-dropdown_for') == 'enquiry_progress') {
				$('#field_name').val($(this).attr('data-name').split("___")[0])
				$('#color_picker_input').val($(this).attr('data-name').split("___")[1])
			}
			if ($(this).attr('data-dropdown_for') == 'enquiry_progress') {
				$('#parent_id').next(".select2-container").hide();
			}else{
				$('#parent_id').next(".select2-container").show();
			}
			triggerChangeinput()
            $('#addmodal').modal('show');;
        })

        $(document).on('click', '.deleteField', function(e) {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(function(isConfirm) {
                if (isConfirm.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.settings.delete_settings_configuration') }}",
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            getList();
                        }
                    });
                }
            })

        });

        function getList() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.settings.get_settings_configuration') }}",
                data: {
                    type: 'enquiry',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $(".drop_list_container").each(function(index) {
                        $(this).html('');
                    });
                    if (data != '') {
                        var data = JSON.parse(data);
                        for (let i = 0; i < data.length; i++) {
                            var html = generateListHtml(data[i])
                            $('#' + data[i]['dropdown_for'] + '_ul').append(html)
                        }
                    }
					triggerChangeinput()

                }
            });
        }

        function generateListHtml(params) {

            var myvar = '<div class="col-lg-6 col-md-6 sm-12 d-inline-block">' +
                '     <div class="row">' +
                '         <div class="col-lg-7 col-md-7 col-sm-12 mb-2">' + params['name'].split('___')[0] + '</div>' +
                '         <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right">' +
                ' <i data-name="' + params['name'] + '" data-parent_id="' + params['parent_id'] + '" data-dropdown_for="' +
                params['dropdown_for'] + '"' +
                '     data-id="' + params['id'] + '"  role="button" class="openEditFieldMOdal pointer  fa-pencil fa"></i>' +
                '<i data-id="' + params['id'] + '"  role="button" class="deleteField fa pointer m-l-5  fa-trash"></i>' +
                '         </div>' +
                '' +
                '     </div>' +
                ' </div>';
            return myvar;
        }

        $(document).on('click', '#saveField', function(e) {
            e.preventDefault();
			$(this).prop('disabled',true);
            var id = $('#this_data_id').val();
            var parent_id = $('#parent_id').val();
			var vall = $('#field_name').val()
			if ($('#dropdown_for').val() == 'enquiry_progress') {
				vall =  vall +'___' + $('#color_picker_input').val();
			}
            $.ajax({
                type: "POST",
                url: "{{ route('admin.settings.save_settings_configuration') }}",
                data: {
                    id: id,
                    parent_id: parent_id,
                    name: vall,
                    dropdown_for: $('#dropdown_for').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    getList();
                    $('#addmodal').modal('hide');
					$('#saveField').prop('disabled',false);
                }
            });
        })
    </script>
@endpush
