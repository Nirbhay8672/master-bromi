@extends('superadmin.layouts.superapp')
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
                            <h5 class="mb-3">Tp Schemes <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('superadmin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                            <button
                                class="btn custom-icon-theme-button open_modal_with_this tooltip-btn"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#tpModal"
                                data-tooltip="Add Tp Scheme"
                            ><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="tpTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
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
    </div>
    <div class="modal fade" id="tpModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Tp Scheme</h5>
                    <button class="btn-close bg-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form" novalidate="">
                        <input type="hidden" name="this_data_id" id="this_data_id">
                        <div class="row">

                            <div class="form-group col-md-5 m-b-20">
                                <div class="fname">
                                    <label for="tp_name">Name</label>
                                <input class="form-control" name="name" id="tp_name" type="text" placeholder="Name"
                                    required="" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="district_id">
                                    <option value=""> District</option>
                                    @foreach ($districts as $disctrict)
                                        <option value="{{ $disctrict->id }}">{{ $disctrict->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-select" id="taluka_id">
                                    <option value=""> Taluka</option>
                                    @foreach ($talukas as $taluka)
                                        <option data-parent_id="{{ $taluka->district_id }}" value="{{ $taluka->id }}">
                                            {{ $taluka->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 m-b-4 mb-3">
                                <select class="form-select" id="village_id" multiple>
                                    <option value=""> Village</option>
                                    @foreach ($villages as $village)
                                        <option data-parent_id="{{ $village->taluka_id }}" value="{{ $village->id }}">
                                            {{ $village->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn custom-theme-button" id="saveTp">Save</button>
                            <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#district_id').select2();
        $('#taluka_id').select2();
        $('#village_id').select2();

        function getTp(data) {
            $('#modal_form').trigger("reset");
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.getTpScheme') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    dataa = JSON.parse(data);
                    $('#this_data_id').val(dataa.id);
                    $('#tp_name').val(dataa.name).trigger('change');
                    $('#village_id').val(JSON.parse(dataa.villages)).trigger('change');
                    $('#tpModal').modal('show');
                }
            });
        }
        
        function deleteTp(data) {
            var id = $(data).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('superadmin.deleteScheme') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#tpTable').DataTable().draw();
                }
            });
        }

        $(document).on('change', '#district_id', function(e) {
            var parent_value = $(this).val();
            $("#taluka_id option").each(function() {
                if (parent_value !== '') {
                    if ($(this).attr('value') != '') {
                        if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                            parent_value) {
                            $(this).attr('disabled', 'disabled');
                        } else {
                            $(this).removeAttr('disabled');
                        }
                    }
                } else {
                    $(this).removeAttr('disabled');
                }
            });
            $('#taluka_id').select2();
        });

        $(document).on('change', '#taluka_id', function(e) {
            var parent_value = $(this).val();
            $("#village_id option").each(function() {
                if (parent_value !== '') {
                    if ($(this).attr('value') != '') {
                        if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                            parent_value) {
                            $(this).attr('disabled', 'disabled');
                        } else {
                            $(this).removeAttr('disabled');
                        }
                    }
                } else {
                    $(this).removeAttr('disabled');
                }
            });
            $('#village_id').select2();
        });

        $(document).ready(function() {
            $('#tpTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('superadmin.tpscheme') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'Actions',
                        name: 'Actions'
                    },
                ]
            });

            $(document).on('click', '#saveTp', function(e) {
                e.preventDefault();
                var id = $('#this_data_id').val()
                var features = [];
                $('input[name="features[]"]').each(function() {
                    features.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.saveScheme') }}",
                    data: {
                        id: id,
                        name: $('#tp_name').val(),
                        villages: JSON.stringify($('#village_id').val()),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#tpTable').DataTable().draw();
                        $('#tpModal').modal('hide');
                    }
                });
            })

        });
    </script>
@endpush
