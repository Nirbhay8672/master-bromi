@extends('admin.layouts.app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="mb-3">Properties</h5>
                        <div class="row mt-2 mb-2">
                            <div class="col">
                                <a href="{{ route('admin.master_properties.addForm') }}" class="btn custom-icon-theme-button tooltip-btn" data-tooltip="Add Property"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="branchTable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px !important;">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                <label class="form-check-label" for="select_all_checkbox"></label>
                                            </div>
                                        </th>
                                        <th>Project Name</th>
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
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('#branchTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.master_properties.data_table') }}",
            columns: [{
                    data: 'select_checkbox',
                    name: 'select_checkbox',
                    orderable: false
                },
                {
                    data: 'project_name',
                    name: 'Project Name'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false
                },
            ],
            "order": [
                [1, "asc"]
            ],
        });
    });

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
                    console.log('delete-called');
                }
            })
        }
    }
</script>
@endpush
