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
                            <h5 class="mb-3">Enquiry Calendar</h5>
                            <div class="row">
                                <div class="col-md-4 mt-1 m-b-20">
                                    <select class="form-select" id="employee_id">
                                        <option value=""> Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name . ' ' . $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mt-1 m-b-20">
                                    <select class="form-select" id="month_id">
                                        <option value=""> Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May </option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-1 m-b-20">
                                    <select class="form-select" id="year_id">
                                        <option value=""> Year</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row" id="cheks">

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_all" type="checkbox">
                                    <label class="form-check-label" for="enquiry_all"> All</label>
                                </div>


                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_new_enquiry" type="checkbox">
                                    <label class="form-check-label" for="enquiry_new_enquiry">New Enquiry</label>
                                </div>

                                {{-- Lead Conf --}}
                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_lead_confirmed" type="checkbox">
                                    <label class="form-check-label" for="enquiry_lead_confirmed">Lead Confirmed</label>
                                </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_site_schedule" type="checkbox">
                                    <label class="form-check-label" for="enquiry_site_schedule">Site Visit Scheduled</label>
                                </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_sitecompleted" type="checkbox">
                                    <label class="form-check-label" for="enquiry_sitecompleted">Site Visit
                                        Completed</label>
                                </div>

                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_dis_scheduled" type="checkbox">
                                    <label class="form-check-label" for="enquiry_dis_scheduled">Discussion Schedule</label>
                                </div>


                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_deal_done" type="checkbox">
                                    <label class="form-check-label" for="enquiry_deal_done">Deal Done</label>
                                </div>


                                <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-2 m-b-10">
                                    <input class="form-check-input" id="enquiry_deal_lost" type="checkbox">
                                    <label class="form-check-label" for="enquiry_deal_lost">Deal Lost</label>
                                </div>

                            </div>
                            <div class="card-body">
                                <div id="calendar"></div>
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
            var selectElement = document.getElementById("year_id");

            // Set the range of years
            var startYear = 2015; // Change this to the start year of your range
            var endYear = 2030; // Change this to the end year of your range

            // Loop through the range of years and add options to the select element
            for (var year = endYear; year >= startYear; year--) {
                var option = document.createElement("option");
                option.text = year;
                option.value = year;
                selectElement.add(option);
            }

            setTimeout(() => {
                $('#enquiry_all').click()
            }, 500);

            var defay = moment().year()
            var defam = moment().month() + 1
            var defad = moment().date()


            function initcal(events = []) {
                console.log("in", events);
                $('#calendar').fullCalendar('destroy');
                if ($('#month_id').val() != '') {
                    if (defam != $('#month_id').val()) {
                        defad = 5
                        defam = $('#month_id').val();
                    }
                }
                if ($('#year_id').val() != '') {
                    if (defam != $('#year_id').val()) {
                        defay = $('#year_id').val();
                    }
                }

                $('#calendar').fullCalendar({
                    defaultDate: new Date(defay + '-' + defam + '-' + defad),
                    editable: true,
                    eventLimit: 0, // allow "more" link when too many events
                    displayEventTime: false,
                    header: {
                        left: 'title',
                        center: '',
                        right: ' ',
                    },
                    events: events,
                    eventRender: function(event, element) {
                        // if (event.classname === 'event-type-lost') {
                        //     element.css('background-color', 'red');
                        // } else if (event.classname === 'event-type-new-enquiry') {
                        //     element.css('background-color', 'yellow');
                        // } else {
                        //     element.css('background-color', 'blue');
                        // }
                        if (event.classname === 'event-type-lost') {
                            element.css('background-color', '#ff0066');
                        } else if (event.classname === 'event-type-new-enquiry') {
                            element.css('background-color', '#1d2848');
                        } else if (event.classname === 'event-type-discussion') {
                            element.css('background-color', '#00f0ff');
                        } else if (event.classname === 'event-type-lead-confirmed') {
                            element.css('background-color', '#ff7e00');
                        } else if (event.classname === 'event-type-booked') {
                            element.css('background-color', 'green');
                        } else if (event.classname === 'event-type-site-visit-scheduled') {
                            element.css('background-color', '#a200ff');
                        } else if (event.classname === 'event-type-site-visit-completed') {
                            element.css('background-color', 'yellow');
                        }
                    },
                });
            }

            initcal()
            refreshCal()

            $(document).on('change', '#month_id,#year_id,#employee_id', function() {
                refreshCal()
                // initcal()
            })

            function refreshCal(params) {
                var employee = $('#employee_id').val()
                var month = $('#month_id').val()
                var year = $('#year_id').val()
                var newe = Number($('#enquiry_new_enquiry').prop('checked'))
                var leadConf = Number($('#enquiry_lead_confirmed').prop('checked'))
                var site = Number($('#enquiry_site_schedule').prop('checked'))
                var sitecomp = Number($('#enquiry_sitecompleted').prop('checked'))
                var dis = Number($('#enquiry_dis_scheduled').prop('checked'))
                var done = Number($('#enquiry_deal_done').prop('checked'))
                var lost = Number($('#enquiry_deal_lost').prop('checked'))

                $.ajax({
                    type: "POST",
                    url: "{{ route('superadmin.enquiries.calendar') }}",
                    data: {
                        employee: employee,
                        month: month,
                        year: year,
                        newe: newe,
                        leadConf: leadConf,
                        sitecomp: sitecomp,
                        site: site,
                        dis: dis,
                        done: done,
                        lost: lost,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var evets = [];
                        if (data != '') {
                            data = JSON.parse(data);
                            evets = data;
                        }

                        initcal(evets)
                    }
                });

            }


            $(document).on('change', '#enquiry_all', function() {
                if (Number($('#enquiry_all').prop('checked'))) {
                    $("#cheks input").each(function(index) {
                        if ($(this).attr('id') != 'enquiry_all') {
                            $(this).prop('checked', true).trigger('change')
                        }
                    });
                } else {
                    $("#cheks input").each(function(index) {
                        if ($(this).attr('id') != 'enquiry_all') {
                            $(this).prop('checked', false).trigger('change')
                        }
                    });
                }
            })

            $(document).on('click', '#cheks input[type=checkbox]', function() {
                setTimeout(() => {
                    refreshCal();
                }, 200);
            })


        })
    </script>
@endpush
