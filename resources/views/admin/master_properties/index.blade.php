@extends('admin.layouts.app')
<style>
    table.dataTable tbody td {
        line-height: 22px;
    }

    table.dataTable {
        font-size: 13px;
    }

    table.dataTable .fa-map-marker {
        margin-top: 3px;
    }

    .dataTables_wrapper table.dataTable th, .dataTables_wrapper table.dataTable td {
        padding: 3px !important;
        padding-left: 25px !important;
        padding-right: 25px !important;
    }
</style>
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
                            <table id="propertyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 3% !important;">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                <input class="form-check-input" id="select_all_checkbox" name="selectrows" type="checkbox">
                                                <label class="form-check-label" for="select_all_checkbox"></label>
                                            </div>
                                        </th>
                                        <th style="min-width: 25% !important;">Project Name</th>
                                        <th style="min-width: 20% !important;">Property Info</th>
                                        <th style="min-width: 12% !important;">Units</th>
                                        <th style="min-width: 12% !important;">Price</th>
                                        <th style="min-width: 18% !important;">Remark</th>
                                        <th style="min-width: 10% !important;">Action</th>
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
        <div class="row">
            <div class="col-4">
                <a href="{{ route('admin.master_properties.resetData') }}">Remove All Data - Do not click here</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('#propertyTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.master_properties.data_table') }}",
            columns: [{
                    data: 'select_checkbox',
                    name: 'select_checkbox',
                    orderable: false,
                    render: function(data, type, row) {

                        return `<div class="form-check checkbox checkbox-primary mb-0">
                            <input class="form-check-input table_checkbox" data-id="${row.id}" name="select_row[]" id="checkbox-primary-${row.id}" type="checkbox">
                            <label class="form-check-label" for="checkbox-primary-${row.id}"></label>
                        </div>`;
                    }
                },
                {
                    data: 'project_name',
                    name: 'Project Name',
                    render: function(data, type , row) {

                        let html = '';

                        html += `<font size="3">`;

                        if ([1,2].includes(parseInt(row.category_id))) {
                            let view_url = "{{ route('admin.master_properties.view', ['masterProperty' => '__ID__']) }}".replace('__ID__', row.id);
                            html += `<a href="${view_url}" style="font-weight: bold;">${row.category_id != 4 ? row.project.project_name : ( row.village?.name ?? '') }</a>`;
                        } else {
                            html += `<a href="" style="font-weight: bold;">${row.category_id != 4 ? row.project.project_name : ( row.village?.name ?? '') }</a>`;
                        }

                        if (row.hot_property == '1') {
                            html += `<img style="height:24px;margin-top:43px;float: right;bottom: 38px;position:relative;" src="/assets/images/hotProperty.png" alt="adasd">`;
                        }

                        html += '</font>';

                        if(row.project.area) {
                            html += `<br>Locality : ${ row.project.area ? row.project.area.name : '-'}`;
                        }

                        if(row.location_link) {
                            html += `<br> <a href="${row.location_link}" target="_blank">
                                <i class="fa fa-map-marker fa-1x cursor-pointer color-code-popover" data-bs-trigger="hover focus">  check on map </i>
                            </a>`;
                        }

                        return html;
                    }
                },
                {
                    data: 'information',
                    name: 'Information',
                    render: function(data, type , row) {

                        let land_units = @json($land_units);

                        let html = '';
                        
                        if(row.property_for == '1') {
                            html += 'Rent | ';
                        }
                        if(row.property_for == '2') {
                            html += 'Sell | ';
                        }
                        if(row.property_for == '3') {
                            html += 'Rent & Sell | ';
                        }

                        html += row.property_sub_category ? row.property_sub_category.name : row.property_category.name;

                        let area = '';
                        let measure = '';

                        if ([1,2,5,7,8].includes(parseInt(row.category_id))) {
                            area = row.extra_size[0]['salable_area_value'];
                            measure = row.extra_size[0]['salable_area_measurement_id'];

                            let saleable_unit  = land_units.filter(unit => unit.id == measure);

                            if (area !='' && saleable_unit.length > 0) {
                                value = `${area} ${saleable_unit[0]['unit_name']}`;
                            } else {
                                value = "Area Not Available";
                            }

                            html += `<br> ${value}`;
                        }
                        else if (row.category_id == 6) {
                            let salable = row.extra_size[0]['salable_plot_area_value'];
                            let measure = row.extra_size[0]['salable_plot_area_measurement_id'];

                            area = `P : ${salable}`;

                            let saleable_unit  = land_units.filter(unit => unit.id == measure);

                            if (area !='' && saleable_unit.length > 0) {
                                value = `${area} ${saleable_unit[0]['unit_name']}`;
                            } else {
                                value = "Area Not Available";
                            }

                            html += `<br> ${value}`;
                        }


                        if (row.priority_type == 1) {
                            html += '<img style="height:24px;margin-top:25px;float: right;bottom: 38px;position:relative;" src="/assets/prop_images/Red-Star.png" alt="">';
                        } else if (row.priority_type == 2) {
                            html += '<img style="height:24px;margin-top:25px;float: right;bottom: 38px;position:relative;" src="/assets/prop_images/Blue-Star.png" alt="">';
                        } else if (row.priority_type == 3) {
                            html += '<img style="height:24px;margin-top:25px;float: right;bottom: 38px;position:relative;" src="/assets/prop_images/Yellow-Star.png" alt="">';
                        }

                        let furniture_type = {
                            1 : 'Furnished',
                            2 : 'Semi Furnished',
                            3 : 'Unfurnished',
                            4 : 'Can Furnished',
                        };

                        if(![3,8].includes(parseInt(row.property_category))) {
                            if(row.unit_details.length > 0 && row.unit_details[0]['furniture_status']) {
                                html += `<br> ${furniture_type[row.unit_details[0]['furniture_status']]}`;

                                if([1,5,6,7].includes(parseInt(row.category_id))) {

                                    if(row.unit_details.length == 1) {
                                            html += `<div class="dropdown-basic" style="position:relative; float:right; margin-right : -20px;">
                                            <div class="dropdown">
                                                <i class="dropbtn fa fa-info-circle p-0 text-dark fs-6"></i>
                                                <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">`;

                                                row.unit_details.forEach((element , index) => {

                                                        html += `<div class="row p-1">`;

                                                            if(row.category_id == 1) {
                                                                html += `<div class="col-12 mb-2"><b>No. of cabins : </b> ${element['no_of_cabins']}</div>`;
                                                                html += `<div class="col-12 mb-2"><b>No. of seats : </b> ${element['no_of_seats']}</div>`;
                                                                html += `<div class="col-12 mb-2"><b>No. of conference room : </b> ${element['no_of_conference_room']}</div>`;
                                                            } else {
                                                                Object.entries(element['furniture_total']).forEach((element)  => {
                                                                    if(element[1] > 0) {
                                                                        html += `<div class="col-12 col-md-4 mb-2 d-flex justify-content-between"><b>${element[0]} : </b> ${element[1]}</div>`;
                                                                    }
                                                                });
                                                            }

                                                            html += '<div class="col-12"><hr></div>';

                                                            Object.entries(element['facilities']).forEach((faci)  => {

                                                                function slugToTitle(slug) {
                                                                    return slug.split('_')
                                                                            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                                                                            .join(' ');
                                                                }

                                                                let title = slugToTitle(faci[1]);

                                                                html += `<div class="col-12 col-md-6 mb-2 d-flex justify-content-between">${title}</div>`;
                                                            });

                                                            html += `</div>`;
                                                });
                                        
                                        html += `</div></div></div>`;
                                    } else {

                                        html += `<div class="dropdown-basic" style="position:relative; float:right; margin-right : -20px;">
                                            <div class="dropdown">
                                                <i class="dropbtn fa fa-info-circle p-0 text-dark fs-6"></i>
                                                <div class="dropdown-content mx-wd-350 cust-top-20 rounded" style="padding-right:10px;">`;
                                                
                                                html +=`<div class="accordion" id="accordionExample_${row.id}">`;

                                                row.unit_details.forEach((element , index) => {
                                                    html += `<div class="accordion-item">
                                                        <div class="row p-2">
                                                            <div class="col-12">
                                                                <button class="${index != 0 ? 'collapsed' : ''}" style="width:100%;margin-right:15px;line-height: 11px;max-height: 29px;border: 1px solid black;;" type="button" data-bs-toggle="collapse" data-bs-target="#unit_${index}" aria-expanded="${index == 0 ? 'true' : ''}" aria-controls="unit_${index}">
                                                                    Unit ${index + 1}
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div id="unit_${index}" class="accordion-collapse collapse ${index == 0 ? 'show' : ''}" aria-labelledby="headingOne" data-bs-parent="#accordionExample_${row.id}" style="border:none !important;">
                                                        <div class="accordion-body" style="border:none;">`;

                                                        html += `<div class="row mt-2">`;

                                                            if(row.category_id == 1) {
                                                                html += `<div class="col-12 mb-2"><b>No. of cabins : </b> ${element['no_of_cabins']}</div>`;
                                                                html += `<div class="col-12 mb-2"><b>No. of seats : </b> ${element['no_of_seats']}</div>`;
                                                                html += `<div class="col-12 mb-2"><b>No. of conference room : </b> ${element['no_of_conference_room']}</div>`;
                                                            } else {
                                                                Object.entries(element['furniture_total']).forEach((element)  => {
                                                                    if(element[1] > 0) {
                                                                        html += `<div class="col-12 col-md-4 mb-2 d-flex justify-content-between"><b>${element[0]} : </b> ${element[1]}</div>`;
                                                                    }
                                                                });
                                                            }

                                                            html += '<div class="col-12"><hr></div>';

                                                            Object.entries(element['facilities']).forEach((faci)  => {

                                                                function slugToTitle(slug) {
                                                                    return slug.split('_')
                                                                            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                                                                            .join(' ');
                                                                }

                                                                let title = slugToTitle(faci[1]);

                                                                html += `<div class="col-12 col-md-6 mb-2 d-flex justify-content-between">${title}</div>`;
                                                            });

                                                            html += `</div>`;

                                                        html += `</div>
                                                        </div>
                                                    </div>`;
                                                });
                                        
                                        html += `</div></div></div></div>`;
                                    }
                                }
                            }
                        }

                        return html;
                    }
                },
                {
                    data: 'city_name',
                    name: 'City Name',
                    render: function(data, type , row) {
                        let html = '';
                        if(![4].includes(row.property_category)) {
                            if(row.unit_details.length > 0) {
                                if(row.unit_details[0]['wing']) {
                                    html += `<span>${row.unit_details[0]['wing'] ?? ''}</span> - `;
                                }
                                if(row.unit_details[0]['unit_no']) {
                                    html += `${row.unit_details[0]['unit_no'] ?? ''}</span>`;
                                }

                                if(row.unit_details.length > 1) {
                                    html += `<div class="dropdown-basic" style="position:relative; float:right; margin-right : -20px;">
                                            <div class="dropdown">
                                                <i class="dropbtn fa fa-info-circle p-0 text-dark fs-6"></i>
                                                <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">`;

                                    row.unit_details.forEach((element , index) => {

                                        if(index != 0) {
                                            html += '<hr>';
                                        }
                                        html += `<div>
                                            <span>Unit - ${index  + 1 }</span></div>
                                            <div class="row"><span>`;
                                            if(element['wing']) {
                                                html += `${element['wing'] ?? ''} - `;
                                            }
                                            if(element['unit_no']) {
                                                html += `${element['unit_no'] ?? ''}`;
                                            }
                                        html += `</span></div>`;
                                    });

                                    html += '</div></div></div>';
                                }
                            }
                        }
                        return html;
                    }
                },
                {
                    data: 'address',
                    name: 'Address',
                    render: function(data, type , row) {
                        let html = '';
                        if(![3,8].includes(parseInt(row.property_category))) {
                            if(row.unit_details.length > 0) {
                                if (row.property_for == 1) {
                                    if(row.unit_details[0].price_rent) {
                                        html += `₹ ${parseInt(row.unit_details[0].price_rent).toLocaleString('en-IN')}`;
                                    }
                                } else if (row.property_for == 2) {
                                    if(row.unit_details[0].price) {
                                        html += `₹ ${parseInt(row.unit_details[0].price).toLocaleString('en-IN')}`;
                                    }
                                } else if (row.property_for == 3) {
                                    if(row.unit_details[0].price_rent && row.unit_details[0].price) {
                                        html += `R : ₹ ${parseInt(row.unit_details[0].price_rent).toLocaleString('en-IN')} <br> S : ₹ ${row.unit_details[0].price ? parseInt(row.unit_details[0].price).toLocaleString('en-IN') : '-'}`;
                                    }
                                }
                                html += "<br>";
                            }


                            if(row.unit_details.length > 1) {
                                html += `<div class="dropdown-basic" style="position:relative; float:right; margin-right : -20px;margin-top:-20px;">
                                        <div class="dropdown">
                                            <i class="dropbtn fa fa-info-circle p-0 text-dark fs-6"></i>
                                            <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">`;

                                row.unit_details.forEach((element , index) => {

                                    if(index != 0) {
                                        html += '<hr>';
                                    }

                                    html += `<span class="mb-2">Unit - ${index  + 1 }</span><br>`;

                                    if (row.property_for == 1) {
                                        if(element.price_rent) {
                                            html += `₹ ${parseInt(element.price_rent).toLocaleString('en-IN')}`;
                                        }
                                    } else if (row.property_for == 2) {
                                        if(element.price) {
                                            html += `₹ ${parseInt(element.price).toLocaleString('en-IN')}`;
                                        }
                                    } else if (row.property_for == 3) {
                                        if(element.price && element.price_rent) {
                                            html += `R : ₹ ${parseInt(element.price_rent).toLocaleString('en-IN')} <br> S : ₹ ${element.price ? parseInt(element.price).toLocaleString('en-IN') : '-'}`;
                                        }
                                    }
                                    html += "<br>";
                                });

                                html += '</div></div></div>';
                            }
                        }
                        return html;
                    }
                },
                {
                    data: 'remark',
                    name: 'Remark',
                    render: function(data, type, full, meta) {
                        if (data && data.length > 20) {
                            return `<div style="max-width:250px;"><span class="truncated" style="text-transform:none;">${data.substr(0, 20)} ...</span><span class="full" style="display:none;text-transform:none;"> ${data} </span><br><span class="read-more" style="text-transform:none;"> Read more</span></div>`;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    render:function (data, type, row) {
                        
                        let edit_url = "{{ route('admin.master_properties.updateForm', ['masterProperty' => '__ID__']) }}".replace('__ID__', row.id);

                        let html = `<div class="row" style="margin-left:-25px;">
                            <div class="col-4">
                                <a href="${edit_url}"><i class="fs-22 py-2 mx-2 fa fa-pencil pointer fa"></i></a>
                            </div>
                            <div class="col-4">
                                <i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa-trash pointer fa text-danger" type="button"></i>
                            </div>
                            <div class="col-4">
                                <i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa-whatsapp pointer fa text-success" type="button"></i>
                            </div>
                        </div>
                        <div class="row" style="margin-left:-25px;">
                            <div class="col-4">
                                <i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa-plane pointer fa text-info" type="button"></i>
                            </div>
                            <div class="col-4">
                                <i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa fa-clipboard pointer fa text-secondary" type="button"></i>
                            </div>
                            <div class="col-4">
                                <i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa fa-phone-square pointer fa text-dark" type="button"></i>
                            </div>
                        </div>`;

                        return html;
                    }
                },
            ],
            "order": [
                [1, "asc"]
            ],
        });
    });

    $('#propertyTable .read-more, #propertyTable .read-less').css('cursor', 'pointer');

    $('#propertyTable').on('click', '.read-more', function() {
        $(this).siblings('.truncated').hide();
        $(this).siblings('.full').show();
        $(this).text('Read Less').removeClass('read-more').addClass('read-less');
    });
    $('#propertyTable').on('click', '.read-less', function() {
        $(this).siblings('.full').hide();
        $(this).siblings('.truncated').show();
        $(this).text('Read More').removeClass('read-less').addClass('read-more');
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
