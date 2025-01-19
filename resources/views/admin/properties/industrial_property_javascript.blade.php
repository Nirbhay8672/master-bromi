@php
    $city_encoded = json_encode($cities);
    $state_encoded = json_encode($states);
@endphp
<script>
    var shouldchangecity = 1;

    var cities = @Json($city_encoded);
    var states = @Json($state_encoded);

    $(document).on('change', '#state_id', function(e) {
        if (shouldchangecity) {
            $('#city_id').select2('destroy');
            citiesar = JSON.parse(cities);
            $('#city_id').html('');
            for (let i = 0; i < citiesar.length; i++) {
                if (citiesar[i]['state_id'] == $("#state_id").val()) {
                    $('#city_id').append('<option value="'+citiesar[i]['id']+'">'+citiesar[i]['name']+'</option>')
                }
            }
            $('#city_id').select2();
        }
    })

    $(document).on('change', '#area_id', function(e) {
        if ($(this).find(":selected").attr('data-state_id') !== undefined && $(this).find(":selected").attr('data-state_id') != '') {
            $('#state_id').val($(this).find(":selected").attr('data-state_id')).trigger('change')
        }
        if ($(this).find(":selected").attr('data-city_id') !== undefined && $(this).find(":selected").attr('data-city_id') != '') {
            $('#city_id').val($(this).find(":selected").attr('data-city_id')).trigger('change')
        }
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

    function generate_contact_detail2(id) {
        var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-3 m-b-20">' +
            '<label>Owner Name</label>'+
            '       <input class="form-control" name="owner_name" type="text"' +
            '            autocomplete="off">' +
            '     </div>' +
            '     <div data-contact_id= ' + id +
            ' class="form-group col-md-3 m-b-20">' +
            '<label>Owner Contact No.</label>'+
            '       <input class="form-control" name="owner_contact_no"' +
            '           type="text"  autocomplete="off">' +
            '   </div>' +
            '       <div data-contact_id= ' + id +
            ' class="form-group col-md-3 m-b-4 mb-3">' +
            '    <select class="form-select" name="owner_status">' +
            '     <option value="">Owner Status</option>' +
            '    <option value="Contactable">Contactable</option>' +
            '     <option value="Not Contactable">Not Contactable</option>' +
            '  </select>  </div>' +
            '<div data-contact_id= ' + id +
            ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
            ' class="remove_owner_contacts2 btn btn-danger btn-air-danger" type="button">-</button>  </div>';
        return myvar;
    }

    $(document).on('click', '#add_owner_contacts2', function(e) {
        id = makeid(10);
        $('#all_owner_contacts').append(generate_contact_detail2(id));
        $("#all_owner_contacts select").each(function(index) {
            $(this).select2();
        })
        floatingField();
    })

    $(document).on('click', '.remove_owner_contacts2', function(e) {
        id = $(this).attr('data-contact_id');
        $("[data-contact_id=" + id + "]").each(function(index) {
            $(this).remove();
        });
    })

    @if(!isset($is_dynamic_form))
        $(document).ready(function () {
            $('#all_owner_contacts').html('')
            $('#all_owner_contacts').append(generate_contact_detail2(makeid(10)));
            $("#all_owner_contacts select").each(function(index) {
                $(this).select2();
            })
            floatingField();
        })
    @endif

    $('#modal_form').validate({ // initialize the plugin
        rules: {
            property_for: {
                required: true,
            },
            building_id: {
                required: true,
            },
            property_unit_no: {
                digits: true,
            },
            plot_area: {
                digits: true,
            },
            construction_area: {
                digits: true,
            },
        },
        submitHandler: function(form) { // for demo
            alert('valid form submitted'); // for demo
            return false; // for demo
        }
    });

    $(document).on('click', '#saveIndustrialProperty', function(e) {
        e.preventDefault();
        $("#modal_form").validate();
        if (!$("#modal_form").valid()) {
            return
        }
        $(this).prop('disabled',true);
        var owner_details = [];
        $("#modal_form [name=owner_name]").each(function(index) {
            cona_arr = []
            unique_id = $(this).closest('.form-group').attr('data-contact_id');
            name = $(this).val();
            contact = $("[data-contact_id=" + unique_id + "] input[name=owner_contact_no]").val();
            status = $("[data-contact_id=" + unique_id + "] select[name=owner_status]").val();
            cona_arr.push(name)
            cona_arr.push(contact)
            cona_arr.push(status)
            if (filtercona_arr(cona_arr)) {
                owner_details.push(cona_arr)
            }
        });
        owner_details = JSON.stringify(owner_details);
        var id = $('#this_data_id').val()
        $.ajax({
            type: "POST",
            url: "{{ route('admin.industrial.saveProperty') }}",
            data: {
                id: id,
                property_for: $('#property_for').val(),
                building_id: $('#building_id').val(),
                address: $('#address').val(),
                area_id: $('#area_id').val(),
                city_id: $('#city_id').val(),
                state_id: $('#state_id').val(),
                specific_type: $('#specific_type').val(),
                configuration: $('#configuration').val(),
                zone: $('#zone').val(),
                property_wing: $('#property_wing').val(),
                property_unit_no: $('#property_unit_no').val(),
                property_status: $('#property_status').val(),
                plot_area: $('#plot_area').val(),
                plot_measurement: $('#plot_measurement').val(),
                construction_area: $('#construction_area').val(),
                construction_measurement: $('#construction_measurement').val(),
                hot_property: Number($('#hot_property').prop('checked')),
                is_pre_leased: Number($('#is_pre_leased').prop('checked')),
                property_description: $('#property_description').val(),
                commision: $('#commision').val(),
                source_of_property: $('#source_of_property').val(),
                price: $('#price').val(),
                price_remarks: $('#price_remarks').val(),
                property_remarks: $('#property_remarks').val(),
                owner_details: owner_details,
                gpcb: Number($('#gpcb').prop('checked')),
                gpcb_remarks: $('#gpcb_remarks').val(),
                ec_noc: Number($('#ec_noc').prop('checked')),
                ec_noc_remark: $('#ec_noc_remark').val(),
                bail: Number($('#bail').prop('checked')),
                bail_remark: $('#bail_remark').val(),
                gujrat_gas: Number($('#gujrat_gas').prop('checked')),
                gujrat_gas_remark: $('#gujrat_gas_remark').val(),
                discharge: Number($('#discharge').prop('checked')),
                discharge_remark: $('#discharge_remark').val(),
                power: Number($('#power').prop('checked')),
                power_remark: $('#power_remark').val(),
                water: Number($('#water').prop('checked')),
                water_remark: $('#water_remark').val(),
                machinery: Number($('#machinery').prop('checked')),
                machinery_remark: $('#machinery_remark').val(),
                etl_necpt: Number($('#etl_necpt').prop('checked')),
                etl_necpt_remark: $('#etl_necpt_remark').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                @if(!isset($is_dynamic_form))
                    var redirect_url = "{{route('admin.industrial.properties')}}";
                    window.location.href = redirect_url;
                @else
                    $('#propertyTable').DataTable().draw();
                @endif
                $('#industrialpropertyModal').modal('hide');
                $('#saveProperty').prop('disabled',false);
            }
        });
    })

    function floatingField(){
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

                $("form select").each(function(index) {
                    var attrs = $(this).attr('multiple');
                    if (typeof attrs === 'undefined' || attrs === false) {
                        $(this).find('option:first').attr('selected', 'selected')
                        // $(this).find('option:first').attr('disabled', 'disabled')
                    }
                    $(this).select2();
                })
            }
</script>