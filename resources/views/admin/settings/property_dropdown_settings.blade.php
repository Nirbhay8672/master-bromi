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
                                    
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_construction_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Property Construction Type</h6>
                                    <div class="row details mt-5">

                                        <div class="col-lg-6 col-md-6 sm-12 d-inline-block"><div class="row"> <div class="col-lg-7 col-md-7 col-sm-12 mb-2">Industrial</div> <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right"></div></div></div>
                                        <div class="col-lg-6 col-md-6 sm-12 d-inline-block"><div class="row"> <div class="col-lg-7 col-md-7 col-sm-12 mb-2">Residential</div> <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right"></div></div></div>
                                        <div class="col-lg-6 col-md-6 sm-12 d-inline-block"><div class="row"> <div class="col-lg-7 col-md-7 col-sm-12 mb-2">Commercial</div> <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right"></div></div></div>
                                        <div class="col-lg-6 col-md-6 sm-12 d-inline-block"><div class="row"> <div class="col-lg-7 col-md-7 col-sm-12 mb-2">Residential & Commercial</div> <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right"></div></div></div>
                                        <div class="col-lg-6 col-md-6 sm-12 d-inline-block"><div class="row"> <div class="col-lg-7 col-md-7 col-sm-12 mb-2">Office & Retail</div> <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right"></div></div></div>

                                        <ul class="drop_list_container d-none " id="property_construction_type_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_specific_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Category</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_specific_type_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">
<!-- 
                                    <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_plan_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Sub Category</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_plan_type_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_priority_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Priority Type</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_priority_type_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_source"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Property Source</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_source_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 box-col-6 col-lg-6" style="display: none">
                                <div class="project-box">
                                    
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_for"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Property For</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_for_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">

                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_owner_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Owner Type</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_owner_type_ul">
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">

                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_furniture_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Furniture Type</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_furniture_type_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 box-col-6 col-lg-6 d-none">
                                <div class="project-box">
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_measurement_type"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Mesurement Type
                                    </h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_measurement_type_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">
<!-- 
                                    <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_zone"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->
                                    
                                    <h6>Property Zone</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_zone_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">

                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_amenities"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Amenities</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_amenities_ul">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 box-col-6 col-lg-6">
                                <div class="project-box">
                                    <!-- <span
                                        id="openAddFieldMOdal"
                                        data-dropdown_for="property_construction"
                                        class="badge btn btn-primary badge-primary"
                                    ><i class="fa fa-plus"></i></span> -->

                                    <h6>Property Construction Documents</h6>
                                    <div class="row details mt-5">
                                        <ul class="drop_list_container" id="property_construction_ul">

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
                    <div class="form-row row">
                        <div class="form-group col-md-7 m-b-20 d-inline-block">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" name="field_name" id="field_name">
                        </div>
                        <div id="additional_modal_field" class="form-group col-md-4 m-b-20">
                            <select class="form-select" id="parent_id">
                                <option value="">Property Construction Type*</option>

                            </select>
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
<div class="modal fade" id="addmodal1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add / Edit</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation " method="post" id="add_edit_form" novalidate="">
                    @csrf
                    <input type="hidden" name="dropdown_for" id="dropdown_for1">
                    <input type="hidden" name="this_data_id" id="this_data_id1">
                    <div class="form-row row">
                        <div class="form-group col-md-7 m-b-20 d-inline-block">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" name="field_name" id="field_name1">
                        </div>
                        <div id="additional_modal_field" class="form-group col-md-4 m-b-20">
                            <select class="form-select" id="parent_id1">
                                <option value="">Select Category*</option>

                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn custom-theme-button" id="saveField1">Save</button>
                        <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addmodal2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Const Docs</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation " method="post" id="add_edit_form" novalidate="">
                    @csrf
                    <!-- <input type="hidden" name="dropdown_for" id="dropdown_for1"> -->
                    <input type="hidden" name="this_data_id2" id="this_data_id1">
                    <div class="form-row row">
                        <div class="form-group col-md-7 m-b-20 d-inline-block">
                            <label for="name">Construction Name:</label>
                            <input class="form-control" type="text" name="const_doc_name" id="const_doc_name">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn custom-theme-button" id="const_save">Save</button>
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
    getListConst()
});
$(document).on('click', '#openAddFieldMOdal', function(e) {
    hideshowadditionalfield($(this).attr('data-dropdown_for'))
    $('#parent_id').val('');
    $('#dropdown_for').val($(this).attr('data-dropdown_for'))
    $('#this_data_id').val('')
    $('#field_name').val('');
    $('#addmodal').modal('show');
    triggerChangeinput()
})

$(document).on('click', '#openAddFieldMOdal1', function(e) {
    hideshowadditionalfield($(this).attr('data-dropdown_for'))
    $('#parent_id1').val('');
    $('#dropdown_for1').val($(this).attr('data-dropdown_for'))
    $('#this_data_id1').val('')
    $('#field_name1').val('');
    $('#addmodal1').modal('show');
    triggerChangeinput()
})

$(document).on('click', '#openAddFieldMOdal2', function(e) {
    hideshowadditionalfield($(this).attr('data-dropdown_for'))
    $('#parent_id1').val('');
    $('#dropdown_for1').val($(this).attr('data-dropdown_for'))
    $('#this_data_id1').val('')
    $('#field_name1').val('');
    $('#addmodal2').modal('show');
    triggerChangeinput()
})

function hideshowadditionalfield(str) {
    if (str == 'property_specific_type' || str == 'property_plan_type') {
        $('#additional_modal_field').show()
    } else {
        $('#additional_modal_field').hide()
    }
}
$(document).on('click', '.openEditFieldMOdal', function(e) {
    hideshowadditionalfield($(this).attr('data-dropdown_for'))
    if ($(this).attr('data-parent_id') != '' && $(this).attr('data-parent_id') != 'null') {
        $('#parent_id').val($(this).attr('data-parent_id')).trigger('change');
    }
    $('#dropdown_for').val($(this).attr('data-dropdown_for'))
    $('#this_data_id').val($(this).attr('data-id'))
    $('#field_name').val($(this).attr('data-name'))
    triggerChangeinput()
    $('#addmodal').modal('show');;
})

$(document).on('click', '.openEditFieldMOdal1', function(e) {
    hideshowadditionalfield($(this).attr('data-dropdown_for'))
    if ($(this).attr('data-parent_id') != '' && $(this).attr('data-parent_id') != 'null') {
        $('#parent_id1').val($(this).attr('data-parent_id')).trigger('change');
    }
    $('#dropdown_for1').val($(this).attr('data-dropdown_for'))
    $('#this_data_id1').val($(this).attr('data-id'))
    $('#field_name1').val($(this).attr('data-name'))
    triggerChangeinput()
    $('#addmodal1').modal('show');;
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

$(document).on('click', '.deleteField1', function(e) {
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
                url: "{{ route('admin.settings.delete_settings_configuration1') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    getSubcategory();
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
            type: 'property',
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            $(".drop_list_container").each(function(index) {
                $(this).html('');
            });
            if (data != '') {
                var data = JSON.parse(data);
                $('#parent_id').html('<option value="">Property Construction Type*</option>')
                $('#parent_id1').html('<option value="">Select Category*</option>')
                for (let i = 0; i < data.length; i++) {
                    if (data[i]['dropdown_for'] == 'property_construction_type') {
                        $('#parent_id').append('<option value="' + data[i]['id'] + '">' + data[i][
                            'name'
                        ] + '</option>')
                    }
                    if (data[i]['dropdown_for'] == 'property_specific_type') {
                        $('#parent_id1').append('<option value="' + data[i]['id'] + '">' + data[i][
                            'name'
                        ] + '</option>')
                    }
                    var html = generateListHtml(data[i])
                    $('#' + data[i]['dropdown_for'] + '_ul').append(html)
                }
                getSubcategory()
            }
            triggerChangeinput()
        }
    });
}

function getSubcategory() {
    $.ajax({
        type: "POST",
        url: "{{ route('admin.settings.get_subcategory') }}",
        data: {
            type: 'subcategory',
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            if (data != '') {
                    $('#property_plan_type_ul').html('');
                var data = JSON.parse(data);
                for (let i = 0; i < data.length; i++) {
                    var html = generateListHtml1(data[i]);
                    $('#property_plan_type_ul').append(html);
                }
            }
            triggerChangeinput()
        }
    });
}

function generateListHtml1(params) {
    var myvar = '<div class="col-lg-6 col-md-6 sm-12 d-inline-block">' + '<div class="row">' +
        ' <div class="col-lg-7 col-md-7 col-sm-12 mb-2">' + params['name'] + '</div>' +
        ' <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right">';
    if (params['editable'] != 1) {
        myvar += ' <i data-name="' + params['name'] + '" data-parent_id="' + params['cat_id'] +
            '" data-dropdown_for="' + params['dropdown_for'] + '"' + '     data-id="' + params['id'] +
            '"  role="button" class="openEditFieldMOdal1 pointer  fa-pencil fa"></i>' + '<i data-id="' + params['id'] +
            '"  role="button" class="deleteField1 fa pointer m-l-5  fa-trash"></i>';
    }
    myvar += '         </div>' +
        '' +
        '     </div>' +
        ' </div>';
    return myvar;
}

function generateListHtml(params) {
    var myvar = '<div class="col-lg-6 col-md-6 sm-12 d-inline-block">' + '<div class="row">' +
        ' <div class="col-lg-7 col-md-7 col-sm-12 mb-2">' + params['name'] + '</div>' +
        ' <div class="col-lg-4 col-md-4 col-sm-12 mb-2" style="text-align:right">';

    if(params.dropdown_for != 'property_priority_type') {
        if (params['editable'] != 1) {
            myvar += ' <i data-name="' + params['name'] + '" data-parent_id="' + params['parent_id'] +
                '" data-dropdown_for="' + params['dropdown_for'] + '"' + '     data-id="' + params['id'] +
                '"  role="button" class="openEditFieldMOdal pointer  fa-pencil fa"></i>' + '<i data-id="' + params['id'] +
                '"  role="button" class="deleteField fa pointer m-l-5  fa-trash"></i>';
        }
    }

    myvar += '</div>' +
        '' +
        '     </div>' +
        ' </div>';
    return myvar;
}

$(document).on('click', '#saveField', function(e) {
    e.preventDefault();
    $(this).prop('disabled', true);
    var id = $('#this_data_id').val();
    var parent_id = $('#parent_id').val();
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
            $('#saveField').prop('disabled', false);
        }
    });
})
$(document).on('click', '#saveField1', function(e) {
    e.preventDefault();
    $(this).prop('disabled', true);
    var id = $('#this_data_id1').val();
    var parent_id = $('#parent_id1').val();
    $.ajax({
        type: "POST",
        url: "{{ route('admin.settings.save_settings_configuration1') }}",
        data: {
            id: id,
            parent_id: parent_id,
            name: $('#field_name1').val(),
            dropdown_for: $('#dropdown_for1').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            getList();
            getSubcategory();
            $('#addmodal1').modal('hide');
            $('#saveField1').prop('disabled', false);
        }
    });
})

function getListConst() {
    var id = $('#this_data_id2').val();
    $.ajax({
        type: "get",
        url: "{{ route('admin.settings.get_const_docs') }}",
        data: {
            id: id,
            name: $('#const_doc_name').val(),
        },
        success: function(data) {
            console.log("const docs =", data);
            $('#addmodal2').modal('hide');
            $('#const_save').prop('disabled', false);
            var listContainer = $('#property_construction_ul');
            listContainer.empty(); 
            if (data.length > 0) {
                data.forEach(function(item) {
                    listContainer.append('<li>' + item.name + '</li>');
                });
            } else {
                listContainer.append('<li>No documents found</li>');
            }
        }
    });
}


$(document).on('click', '#const_save', function(e) {
    console.log("const save clicked ==");
    e.preventDefault();
    $(this).prop('disabled', true);
    var id = $('#this_data_id2').val();
    $.ajax({
        type: "POST",
        url: "{{ route('admin.settings.save_const_docs') }}",
        data: {
            id: id,
            name: $('#const_doc_name').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            getListConst();
            $('#addmodal2').modal('hide');
            $('#const_save').prop('disabled', false);
        }
    });
})
</script>
@endpush
