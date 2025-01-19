@extends('admin.layouts.app')
@section('content')
    @php
        $is_dynamic_form = true;
    @endphp
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
                            <h5 class="mb-3">Add New Unit</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <div class="bromi-form-wizard stepwizard">
                                        <div class="stepwizard-row setup-panel">
                                            <div class="stepwizard-step" style="text-align:initial"><a
                                                    class="btn btn-primary" href="#unit-info">1</a>
                                                <p class="ms-2">Unit Details</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-lg-10 border-start ps-4">
                                    <form class="form-bookmark needs-validation modal_form" method="post" id="modal_form"
                                        novalidate="">
                                        <div class="setup-content" id="unit-info">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <input type="hidden" name="this_data_id" id="this_data_id">

                                                        <div>
                                                            <label><b>Information</b></label>
                                                        </div>
                                                        <div class="form-group col-md-4 m-b-4 mb-3">
                                                            <select class="form-select" name="project_id" id="project_id"
                                                                required>
                                                                <option value=""> Project</option>
                                                                @foreach ($projects as $project)
                                                                    @if (!empty($project->project_name))
                                                                        <option value="{{ $project->id }}">
                                                                            {{ $project->project_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4 m-b-4 mb-3">
                                                            <select class="form-select" id="tower_id">
                                                                <option value=""> Wing</option>
                                                                @foreach ($towers as $tower)
                                                                    <option data-parent_id=""
                                                                        data-nameval="{{ $tower['name'] }}"
                                                                        value="{{ $tower['name'] }}">{{ $tower['name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4 m-b-4 mb-3">
                                                            <select class="form-select" id="units_id">
                                                                <option value=""> Unit Type</option>
                                                                @foreach ($unit_types as $unit)
                                                                    <option data-parent_id=""
                                                                        data-size="{{ $unit['size'] }}"
                                                                        data-property_type="{{ $unit['property_type'] }}"
                                                                        data-measurement="{{ $unit['measurement'] }}"
                                                                        value="{{ $unit['name'] }}">
                                                                        {{ $unit['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 m-b-20">
                                                            <label for="Property Type">Property Type</label>
                                                            <input class="form-control" name="property_type"
                                                                id="property_type" type="text" autocomplete="off"
                                                                disabled>
                                                        </div>
                                                        <div class="form-group col-md-6 m-b-20">
                                                            <label for="Unit Size">Unit Size</label>
                                                            <input class="form-control" name="unit_size" id="unit_size"
                                                                type="text" autocomplete="off" disabled>
                                                        </div>
                                                        <hr class="color-hr">
                                                        <label for="add Units"> Units</label>
                                                        <div><button type="button"
                                                                class="btn mb-3 btn-primary btn-air-primary"
                                                                id="add_floors">Add Unit</button></div>
                                                        <div class="row" id="all_floors">

                                                        </div>

                                                    </div>
                                                    <button id="saveUnit" class="btn btn-primary nextBtn pull-right"
                                                        type="button">Finish</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admins/assets/js/form-wizard/form-wizard-two.js') }}"></script>
    <script>
        function floatingField() {
            //changed by Subhash
            $("form input").each(function(index) {
                if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
                    var inputhtml = $(this).clone()
                    var parentId = $(this).parent();
                    if (parentId.find('label').length > 0) {
                        $(this).remove();
                        var currenthtml = $(parentId).html()
                        $(parentId).html('<div class="fname">' + currenthtml + '<div class="fvalue">' + inputhtml[0]
                            .outerHTML + '</div>' + '</div>')
                    }
                }
            })
        }
        floatingField()

        function getUnit() {
            $('#modal_form').trigger("reset");
            var id = '{{ isset($current_id) ? $current_id : '' }}';
            if (id == '') {
                return;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('admin.project.getUnit') }}",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data == '') {
                        return
                    }
                    floatingField();
                    data = JSON.parse(data);
                    $('#this_data_id').val(data.id);
                    $('#project_id').val(data.project_id).trigger('change');;
                    $('#tower_id').val(data.tower_id).trigger('change');;
                    $('#units_id').val(data.units_id).trigger('change');;
                    if (data.units_id != '' && data.units_id != undefined) {
                        $('#property_type').val($('#units_id').find(':selected').attr('data-property_type'))
                            .trigger('change')
                        $('#unit_size').val(($('#units_id').find(':selected').attr('data-size') + ' ' + $(
                            '#units_id').find(':selected').attr('data-measurement')).trim()).change()
                    }
                    $('#all_floors').html('');
                    if (data.floor_details != '') {
                        details = JSON.parse(data.floor_details);
                        for (let i = 0; i < details.length; i++) {
                            id = makeid(10);
                            $('#all_floors').append(generate_floor_details(id))
                            floatingField()
                            $("[data-contact_id=" + id + "] [name=floor_status]").select2()
                            $("[data-contact_id=" + id + "] [name=floor_number]").val(details[i][0])
                                .trigger('change');
                            $("[data-contact_id=" + id + "] [name=unit_no]").val(details[i][1]);
                            $("[data-contact_id=" + id + "] [name=floor_status]").val(details[i][2])
                                .trigger('change');
                            $("[data-contact_id=" + id + "] [name=contact_no]").val(details[i][3]).trigger(
                                'change');
                        }
                    }
                    triggerChangeinput()
                    floatingField()
                }
            });
        }
        getUnit();

        function generate_floor_details(id) {
            var myvar = '      <div data-contact_id= ' + id +
                ' class="form-group col-md-1 m-b-20">' +
                '   <label>Floor</label>    <input class="form-control" name="floor_number"' +
                '           type="text"  autocomplete="off"' +
                '           >' +
                '   </div>' +
                '     <div data-contact_id= ' + id +
                ' class="form-group col-md-1 m-b-20">' +
                '    <label>Unit</label>   <input class="form-control" name="unit_no"' +
                '           type="text"  autocomplete="off"' +
                '           >' +
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
                '  class="form-group col-md-3 m-b-20">' +
                '   <label>Contact</label>    <input class="form-control" name="contact_no"' +
                '           type="text"  autocomplete="off"' +
                '           >' +
                '   </div>' +
                '<div data-contact_id= ' + id +
                ' class="form-group col-md-1 m-b-4 mb-3"><button data-contact_id=' + id +
                ' class="remove_floors btn btn-danger btn-air-danger" type="button">-</button>  </div>' +
                '<div data-contact_id= ' + id +
                ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
                ' class="add_to_property btn btn-danger btn-air-danger" type="button">Add Property</button></div>';
            return myvar;
        }

        $(document).on('click', '.add_to_property', function(e) {
            $(this).prop('disabled', true)
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
                success: function(data) {}
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
            floatingField()
        })
        $(document).on('click', '.remove_floors', function(e) {
            id = $(this).attr('data-contact_id');
            $("[data-contact_id=" + id + "]").each(function(index) {
                $(this).remove();
            });
            floatingField()
        })

        $(document).on('change', '#units_id', function(e) {
            if ($(this).find(':selected').attr('data-property_type') == undefined) {
                $('#property_type').parent().parent().removeClass('focused');
                $('#unit_size').parent().parent().removeClass('focused');
            } else {
                $('#property_type').parent().parent().addClass('focused');
                $('#unit_size').parent().parent().addClass('focused');
            }
            $('#property_type').val($(this).find(':selected').attr('data-property_type'))
            $('#unit_size').val((($(this).find(':selected').attr('data-size') + ' ' + $(this).find(':selected')
                .attr(
                    'data-measurement')).replaceAll('undefined', "")).trim())

        })

        $(document).on('click', '#saveUnit', function(e) {
            e.preventDefault();
            $("#modal_form").validate();
            if (!$("#modal_form").valid()) {
                return
            }
            $(this).prop('disabled', true);
            var floor_details = [];

            $("#all_floors [name=floor_number]").each(function(index) {
                let new_array = [];
                new_array.push($(this).val());
                floor_details.push(new_array)
            });

            $("#all_floors [name=unit_no]").each(function(index) {
                floor_details[index].push($(this).val());
            });

            $("#all_floors [name=floor_status]").each(function(index) {
                floor_details[index].push($(this).val());
            });

            $("#all_floors [name=contact_no]").each(function(index) {
                floor_details[index].push($(this).val());
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
                    var redirect_url = "{{ route('admin.project.unit') }}";
                    window.location.href = redirect_url;
                }
            });
        })
    </script>
@endpush
