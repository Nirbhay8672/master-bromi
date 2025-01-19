<script>
    var land_image_show_url = "{{ asset('upload/land_images') }}";

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    @if(!isset($is_dynamic_form))
        $(document).ready(function (e) {
            $('#all_owner_contacts').html('')
            $('#all_images').html('');
            $('#all_owner_contacts').append(generate_contact_detail3(makeid(10)));
            $("#all_owner_contacts select").each(function(index) {
                $(this).select2();
            })
            floatingField()
        })
    @endif

    function generate_contact_detail3(id) {
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
            ' class="remove_owner_contacts3 btn btn-danger btn-air-danger" type="button">-</button>  </div>';
        return myvar;
    }

    $(document).on('click', '#add_owner_contacts3', function(e) {
        id = makeid(10);
        $('#all_owner_contacts').append(generate_contact_detail3(id));
        $("#all_owner_contacts select").each(function(index) {
            $(this).select2();
        })
        floatingField();
    })
    
    $(document).on('click', '.remove_owner_contacts3', function(e) {
        id = $(this).attr('data-contact_id');
        $("[data-contact_id=" + id + "]").each(function(index) {
            $(this).remove();
        });
    })

    $(document).on('click', '#add_images', function(e) {
        var fd = new FormData();
        var files = $('#land_images')[0].files;
        if (files.length == 0 || $('#this_data_id').val() == '') {
            return;
        }
        fd.append('land_id', $('#this_data_id').val());
        for (let i = 0; i < files.length; i++) {
            fd.append('images[]', files[i]);
        }


        fd.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: "{{ route('admin.saveLandImages') }}",
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#all_images').html('');
                $('#land_images').val('');
                if (response != '') {
                    images = JSON.parse(response);
                    for (let i = 0; i < images.length; i++) {
                        var src = land_image_show_url + '/' + images[i];
                        $('#all_images').append('<div class="col-md-4 m-b-4 mb-3"><img src="' +
                            src + '" alt="" height="200" width="200"></div>')
                    }
                }
            },
        });
    })

    $(document).on('change', '#village_id', function(e) {
        setTimeout(() => {
            vill = $('#village_id').select2().find(":selected").attr("data-parent_id")
            if (Number(vill) > 0) {
                $('#taluka_id').val(vill).trigger('change')
            }
        }, 100);
    })

    $(document).on('change', '#taluka_id', function(e) {
        setTimeout(() => {
            vill = $('#taluka_id').select2().find(":selected").attr("data-parent_id")
            if (Number(vill) > 0) {
                $('#district_id').val(vill).trigger('change')
            }
        }, 100);
    })


    $('#modal_form').validate({ // initialize the plugin
        rules: {
            specific_type: {
                required: true,
            },
            plot_size: {
                digits: true,
            },
            plot2_size: {
                digits: true,
            },
        },
        submitHandler: function(form) { // for demo
            alert('valid form submitted'); // for demo
            return false; // for demo
        }
    });

    $(document).on('click', '#saveLandProperty', function(e) {
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
                owner_details.push(cona_arr);
            }
        });
        owner_details = JSON.stringify(owner_details);
        var id = $('#this_data_id').val()
        $.ajax({
            type: "POST",
            url: "{{ route('admin.land.saveProperty') }}",
            data: {
                id: id,
                specific_type: $('#specific_type').val(),
                district_id: $('#district_id').val(),
                taluka_id: $('#taluka_id').val(),
                village_id: $('#village_id').val(),
                zone: $('#zone').val(),
                fsi: $('#fsi').val(),
                configuration: $('#configuration').val(),
                survey_number: $('#survey_number').val(),
                plot_size: $('#plot_size').val(),
                plot_measurement: $('#plot_measurement').val(),
                price: $('#price').val(),
                tp_number: $('#tp_number').val(),
                fp_number: $('#fp_number').val(),
                plot2_size: $('#plot2_size').val(),
                plot2_measurement: $('#plot2_measurement').val(),
                price2: $('#price2').val(),
                address: $('#address').val(),
                remarks: $('#remarks').val(),
                status: $('#status').val(),
                location_url: $('#location_url').val(),
                property_source: $('#property_source').val(),
                refrence: $('#refrence').val(),
                owner_details: owner_details,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                @if(!isset($is_dynamic_form))
                    var redirect_url = "{{route('admin.land.properties')}}";
                    window.location.href = redirect_url;
                @else
                    $('#propertyTable').DataTable().draw();
                @endif
                $('#landpropertyModal').modal('hide');
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
