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
                                <div class="col-xxl-6 box-col-6 col-lg-6">
                                    <div class="project-box">
                                        {{-- <span
                                            id="openAddFieldMOdal"
                                            data-dropdown_for="building_restriction"
                                            class="badge btn btn-primary badge-primary"
                                        >Add</span> --}}
                                        <h6>Building Restriction</h6>
                                        <div class="row details mt-5">
                                            <ul class="drop_list_container" id="building_restriction_ul">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 box-col-6 col-lg-6">
                                    <div class="project-box">
                                        {{-- <span
                                            id="openAddFieldMOdal"
                                            data-dropdown_for="building_architecture_type"
                                            class="badge btn btn-primary badge-primary"
                                        >Add</span> --}}
                                        <h6>Building Architecture Type</h6>
                                        <div class="row details mt-5">
                                            <ul class="drop_list_container" id="building_architecture_type_ul">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 box-col-6 col-lg-6">
                                    <div class="project-box">
                                        {{-- <span
                                            id="openAddFieldMOdal"
                                            data-dropdown_for="building_progress"
                                            class="badge btn btn-primary badge-primary"
                                        >Add</span> --}}
                                        <h6>Building Progress
                                        </h6>
                                        <div class="row details mt-5">
                                            <ul class="drop_list_container" id="building_progress_ul">

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
                        <div class="form-row">
                            <div class="form-group col-md-12 m-b-20">
                                <label for="name">Name:</label>
                                <input class="form-control" type="text"  name="field_name"
                                    id="field_name">
                            </div>
                        </div>
                        <button class="btn btn-secondary" id="saveField">Save</button>
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
            getList()
        });

        $(document).on('click', '#openAddFieldMOdal', function(e) {
            $('#parent_id').val('');
            $('#dropdown_for').val($(this).attr('data-dropdown_for'))
            $('#this_data_id').val('')
            $('#field_name').val('');
            $('#addmodal').modal('show');
			triggerChangeinput()
        })

        $(document).on('click', '.openEditFieldMOdal', function(e) {
            $('#dropdown_for').val($(this).attr('data-dropdown_for'))
            $('#this_data_id').val($(this).attr('data-id'))
            $('#field_name').val($(this).attr('data-name'))
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
                    type: 'building',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $(".drop_list_container").each(function(index) {
                        $(this).html('');
                    });
                    if (data != '') {
                        var data = JSON.parse(data);

                        let temp_array = [];

                        for (let i = 0; i < data.length; i++) {
                            if (!temp_array.includes(data[i]['name'])) {
                                var html = generateListHtml(data[i])
                                $('#' + data[i]['dropdown_for'] + '_ul').append(html)
                                temp_array.push(data[i]['name']);
                            }
                        }
                    }
					triggerChangeinput()
                }
            });
        }

        function generateListHtml(params) {
            var myvar = '<div class="col-lg-6 col-md-6 sm-12 d-inline-block">' +
                '     <div class="row">' +
                '         <div class="col-lg-7 col-md-7 col-sm-12 mb-2">' + params['name'] + '</div>' +
                '' +
                '     </div>' +
                ' </div>';
            return myvar;
        }

        $(document).on('click', '#saveField', function(e) {
            e.preventDefault();
			$(this).prop('disabled',true);
            var id = $('#this_data_id').val();
            var parent_id = '';
            $.ajax({
                type: "POST",
                url: "{{ route('admin.settings.save_settings_configuration') }}",
                data: {
                    id: id,
                    parent_id: parent_id,
                    name: $('#field_name').val(),
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
