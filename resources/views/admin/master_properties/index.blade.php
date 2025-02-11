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
                                        <th>Property Info</th>
                                        <th>Units</th>
                                        <th>Price</th>
                                        <th>Remark</th>
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

                        html += `<td style="vertical-align:top"><font size="3"><a href="" style="font-weight: bold;">${row.category_id != 4 ? row.project.project_name : ( row.village?.name ?? '') }</a>`;

                        if (row.hot_property == '1') {
                            html += `<img style="height:22px;margin-left:10px;" src="/assets/images/hotProperty.png" alt="adasd">`;
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

                        html += row.property_sub_category ? row.property_sub_category.name : '';

                        let area = '';
                        let measure = '';

                        if ([1,2,5,7,8].includes(row.category_id)) {
                            area = row.extra_size[0]['salable_area_value'];
                            measure = row.extra_size[0]['salable_area_measurement_id'];
                        } else if (row.category_id == 3) {
                            let salable = row.extra_size[0]['salable_plot_area_value'] ?? '';
                            let constructed = row.extra_size[0]['salable_constructed_area_value'];
                            let measure = row.extra_size[0]['salable_plot_area_measurement_id'];

                            let res = area ? "P :" . area : "";

                            if (res) {
                                constructed = constructed ? ` - C : ${constructed}` : '';
                                area = `${res}${constructed}`;
                            } else {
                                constructed = constructed ? ` C : ${constructed}` : '';
                                area = `${constructed}`;
                            }
                            
                        } else if (row.category_id == 6) {
                            let salable = row.extra_size[0]['salable_plot_area_value'] ?? '';
                            let constructed = row.extra_size[0]['salable_constructed_area_value'];
                            let measure = row.extra_size[0]['salable_plot_area_measurement_id'] ?? 1;

                            let res = salable ? "P:" . salable : "";

                            if (res) {
                                constructed = constructed ? ` - C : ${constructed}` : '';
                                area = `${res} ${constructed}`;
                            } else {
                                constructed = constructed ? ` C : ${constructed}` : '';
                                area = `${constructed}`;
                            }
                        }

                        let saleable_unit  = land_units.filter(unit => unit.id == measure ?? 1);

                        area = area ?? 52;

                        if (area && saleable_unit.length > 0) {
                            value = `${area} ${saleable_unit[0]['unit_name']}`;
                        } else {
                            value = "Area Not Available";
                        }

                        html += `<br> ${value}`;

                        if (row.priority_type == 1) {
                            html += '<img style="height:24px;margin-top:25px;float: right;bottom: 38px;right:17px;position:relative;" src="/assets/prop_images/Red-Star.png" alt="">';
                        } else if (row.priority_type == 2) {
                            html += '<img style="height:24px;margin-top:25px;float: right;bottom: 38px;right:17px;position:relative;" src="/assets/prop_images/Blue-Star.png" alt="">';
                        } else if (row.priority_type == 3) {
                            html += '<img style="height:24px;margin-top:25px;float: right;bottom: 38px;right:17px;position:relative;" src="/assets/prop_images/Yellow-Star.png" alt="">';
                        }

                        let furniture_type = {
                            1 : 'Furnished',
                            2 : 'Semi Furnished',
                            3 : 'Unfurnished',
                            4 : 'Can Furnished',
                        };

                        if(![3,8].includes(row.property_category)) {
                            if(row.unit_details.length > 0) {
                                html += `<br> ${furniture_type[row.unit_details[0]['furniture_status']]}`;
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
                        if(![3,8].includes(row.property_category)) {
                            if(row.unit_details.length > 0) {
                                html += `<span>${row.unit_details[0]['wing'] ?? ''} - ${row.unit_details[0]['unit_no'] ?? ''}`;
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
                        if(![3,8].includes(row.property_category)) {
                            if(row.unit_details.length > 0) {
                                row.unit_details.forEach(element => {
                                    if (row.property_for == 1) {
                                        html += `₹ ${element.price_rent}`;
                                    } else if (row.property_for == 2) {
                                        html += `₹ ${element.price}`;
                                    } else if (row.property_for == 3) {
                                        html += `R : ₹ ${element.price_rent} <br> S : ₹ ${element.price ?? '-'}`;
                                    }
                                });
                                html += "<br>";
                            }
                        }
                        return html;
                    }
                },
                {
                    data: 'remark',
                    name: 'Remark'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    render:function (data, type, row) {
                        
                        let edit_url = "{{ route('admin.master_properties.updateForm', ['masterProperty' => '__ID__']) }}".replace('__ID__', row.id);

                        let html = "";

                        html += `<a href="${edit_url}"><i class="fa fa-pencil fs-5"></i></a>`;
                        html += '<i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa-trash pointer fa text-danger" type="button"></i>';
                        html += '<i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa-whatsapp pointer fa text-success" type="button"></i>';
                        html += '<i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa-plane pointer fa text-info" type="button"></i>';
                        html += '<i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa fa-clipboard pointer fa text-secondary" type="button"></i>';
                        html += '<i role="button" title="Delete" class="fs-22 py-2 mx-2 fa fa fa-phone-square pointer fa text-dark" type="button"></i>';

                        return html;
                    }
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
