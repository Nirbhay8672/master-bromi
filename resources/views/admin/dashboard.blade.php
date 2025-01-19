@extends('admin.layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/assets/css/vendors/chartist.css') }}">
    <div class="page-body" x-data="dashboard">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <div class="container-fluid general-widget">
            <div class="card">
                <div class="row card-body">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <div class="dropdown" style="border: 1px solid black;width:250px;">
                                <button
                                    class="btn dropdown-toggle"
                                    type="button"
                                    data-toggle="dropdown"
                                    aria-expanded="false"
                                    style="height: 44px;"
                                >
                                    Chart Selection
                                </button>
                                <div class="dropdown-menu p-1">
                                    <template x-for="(chart , index ) in chart_option" :key="index">
                                        <span>
                                            <div class="form-check" style="margin-left: 10px;margin-right:10px;margin-top:5px;">
                                                <input class="form-check-input pl-2" type="checkbox" x-model="charts" :value="chart" :id="`ck_${index}`">
                                                <label class="form-check-label" :for="`ck_${index}`" x-text="chart"></label>
                                            </div>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 bd-highlight">
                            <div class="input-group" style="border: 1px solid black;">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                <select class="form-control custom-select" id="choose_date_range" style="border: 1px solid black;width: 200px;">
                                    <option value="this_month" {{ $filter_value == 'this_month' ? 'selected' : ''}}>This Month</option>
                                    <option value="today" {{ $filter_value == 'today' ? 'selected' : ''}}>Today</option>
                                    <option value="yesterday" {{ $filter_value == 'yesterday' ? 'selected' : ''}}>Yesterday</option>
                                    <option value="this_week" {{ $filter_value == 'this_week' ? 'selected' : ''}}>This Week</option>
                                    <option value="last_month" {{ $filter_value == 'last_month' ? 'selected' : ''}}>Last Month</option>
                                    <option value="3month" {{ $filter_value == '3month' ? 'selected' : ''}}>Last 3 Month</option>
                                    <option value="6month" {{ $filter_value == '6month' ? 'selected' : ''}}>Last 6 Month</option>
                                    <option value="yearly" {{ $filter_value == 'yearly' ? 'selected' : ''}}>Last 1 Year</option>
                                    <option value="openModal" style="color: #333;font-weight: bold;min-height:100px;">
                                        Custom Date
                                    </option>
                                </select>
                            </div>
                        </div>

                        <button
                            type="button"
                            id="daterangeModalElement"
                            data-bs-toggle="modal"
                            class="d-none"
                            data-bs-target="#dateRangeModal"
                        >Custom Date</button>
                    </div>
                </div>
            </div>
            <div id="content-view">
                @include('admin.components.dashboard_content')
            </div>
        </div>
        <div class="modal fade" id="dateRangeModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Custom Filter</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-5">
                            <div class="col-5">
                                <div class="fname">
                                    <input type="date" class="form-control" id="from_date" max="{{ now()->format('Y-m-d') }}">
                                    <span id="from_date_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="text-center mt-2">
                                    <i class="fa fa-arrow-right fs-4"></i>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="fname">
                                    <input type="date" class="form-control" id="to_date" max="{{ now()->format('Y-m-d') }}">
                                    <span id="to_date_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-secondary" style="border-radius: 5px;" onclick="filterWithDate()">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $totalSource = json_encode($totalSource);
        @endphp
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admins/assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('admins/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('admins/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('admins/assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('admins/assets/js/chart/morris-chart/morris.js') }}"></script>
    <script src="{{ asset('admins/assets/js/chart/google/google-chart-loader.js') }}"></script>
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('dashboard', () => ({
                charts : [
                    'New Leads',
                    'New Leads Source Wise',
                    'All Assign Leads',
                    'Active Lead Source Wise',
                    'Lost Leads Source Wise',
                    'Stage Wise Leads',
                    'Stage And Person Wise Leads',
                    'Person Wise Leads',
                    'Person Wise Activity Report',
                    'Activity Not Planned In Lead',
                    'Assign Leads To Person Date Wise',
                    'Lead Lost Reason Person Wise',
                ],
                
                chart_option : [
                    'New Leads',
                    'New Leads Source Wise',
                    'All Assign Leads',
                    'Active Lead Source Wise',
                    'Lost Leads Source Wise',
                    'Stage Wise Leads',
                    'Stage And Person Wise Leads',
                    'Person Wise Leads',
                    'Person Wise Activity Report',
                    'Activity Not Planned In Lead',
                    'Assign Leads To Person Date Wise',
                    'Lead Lost Reason Person Wise',
                ],

                isIncludes(chart_name) {
                    return this.charts.includes(chart_name);
                },
                
                removeChart(chart_name) {
                    let index = this.charts.findIndex(chart => chart == chart_name);
                    this.charts.splice(index , 1);
                }
            }));
        });

    </script>
    
    <script>
    
        // first chart
        let first_chart_labels = [];
        let first_chart_data = [];

        Object.entries(@json($first_chart)).forEach(element => {
            first_chart_labels.push(element[0]);
            first_chart_data.push(parseInt(element[1]));
        });
        
        new Chartist.Line('#new-leads-chart', {
            labels: first_chart_labels,
            series: [first_chart_data]
        }, {
            low: 0,
            showArea: true
        });

        let second_chart_labels = [];
        let second_chart_data = [];

        @json($second_chart).forEach(element => {
            second_chart_labels.push(element['enquiry_source_case']);
            second_chart_data.push(parseInt(element['total_enquiry']));
        });

        new Chartist.Bar('#new-lead-source-wise', {
            labels: second_chart_labels,
            series: [
                second_chart_data,
            ]
        }, {
            stackBars: true,
            axisX: {
                labelInterpolationFnc: function(value) {
                    return value.split(/\s+/).map(function(word) {
                        return word[0];
                    }).join('');
                }
            },
            axisY: {
                offset: 20
            }
        }, [
            ['screen and (min-width: 400px)', {
                reverseData: true,
                horizontalBars: true,
                axisX: {
                    labelInterpolationFnc: Chartist.noop
                },
                axisY: {
                    offset: 60
                }
            }],
            ['screen and (min-width: 800px)', {
                stackBars: false,
                seriesBarDistance: 10
            }],
            ['screen and (min-width: 1000px)', {
                reverseData: false,
                horizontalBars: false,
                seriesBarDistance: 15
            }]
        ]);

        $(function() {
            for (var c = [], d = 0; d <= 360; d += 10) c.push({
                x: d,
                y: 1.5 + 1.5 * Math.sin(Math.PI * d / 180).toFixed(4)
            });
            window.m = Morris.Line({
                element: 'decimal-morris-chart',
                data: c,
                xkey: "x",
                ykeys: ["y"],
                labels: ["sin(x)"],
                parseTime: !1,
                lineColors: [zetaAdminConfig.primary],
                hoverCallback: function(a, b, c, d) {
                    return c.replace("sin(x)", "1.5 + 1.5 sin(" + d.x + ")")
                },
                xLabelMargin: 10,
                integerYLabels: !0
            })
        })

        let forth_chart_labels = [];
        let forth_chart_data = [];

        @json($second_chart).forEach(element => {
            forth_chart_labels.push(element['enquiry_source_case']);
            forth_chart_data.push(parseInt(element['total_enquiry']));
        });

        var chart = new ApexCharts(document.querySelector("#active-lead-source-wise"), {
            series: [{
                    name: "High - 2023",
                    data: forth_chart_data
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            colors: ['#4fb9d2', '#545454'],
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            xaxis: {
                categories: forth_chart_labels,
                title: {
                    text: 'Source'
                }
            },
            yaxis: {
                title: {
                    text: ''
                },
                min: 0,
                max: 30
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        });
        chart.render();

        let fifth_chart_labels = [];
        let fifth_chart_data = [];

        @json($fifth_chart).forEach(element => {
            fifth_chart_labels.push(element['source_type']);
            fifth_chart_data.push(parseInt(element['total_enquiry']));
        });

        var chart = new ApexCharts(document.querySelector("#lost-leads-source-wise"), {
            series: [
                {
                    name: "Lost Enquiry",
                    data: fifth_chart_data
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.5
                },
                toolbar: {
                    show: false
                }
            },
            colors: ['#f6639f', '#545454'],
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            xaxis: {
                categories: fifth_chart_labels,
                title: {
                    text: 'Source'
                }
            },
            yaxis: {
                title: {
                    text: ''
                },
                min: 0,
                max: 30
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        });
        chart.render();
    </script>
    <script>
        var data = [];
        var chart_data = JSON.parse(@Json($chart1data));
        var chart_added_for_rent = JSON.parse(@Json($prop_added_for_rent));
        var chart_added_for_sell = JSON.parse(@Json($prop_added_for_sell));
        var chart_rented = JSON.parse(@Json($prop_rented));
        var chart_sold = JSON.parse(@Json($prop_sold));
        var totalSource = JSON.parse(@Json($totalSource));

        $(document).ready(function() {
            dashboardInitial();
        })

        function filterWithDate() {
            let from = $('#from_date').val();
            let to = $('#to_date').val();

            let valid = true;

            $('#from_date_error').text("");
            $('#to_date_error').text("");

            if(from == '') {
                valid = false;
                $('#from_date_error').text("From date is required.");
            }

            if(to == '') {
                valid = false;
                $('#to_date_error').text("To date is required.");
            }

            if(to) {
                let date1 = new Date(from).getTime();
                let date2 = new Date(to).getTime();

                if (date1 >= date2) {
                    valid = false;
                    $('#to_date_error').text("To date must greater than from date.");
                }
            }

            if(valid) {
                window.location.href = "{{ route('admin') }}?from_date=" + from + "&to_date=" + to;
            }
        }

        $(document).on('change', '#choose_date_range', function() {
            var range = $(this).val();
            if(range != 'openModal') {
                if (range) {
                    window.location.href = "{{ route('admin') }}?date_range=" + range;
                }
            } else {
                let modalButton = document.getElementById('daterangeModalElement');
                modalButton.click();
                $("#choose_date_range").val("").trigger( "change" );
            }
        });

        function dashboardInitial() {
            for (let i = 0; i < chart_data.length; i++) {
                data.push({
                    name: chart_data[i]['name'],
                    data: chart_data[i]['data']
                })
            }

            var optionscolumnchart = {
                series: data,

                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                },
                yaxis: {
                    title: {
                        text: '$ (Total Enquiry by Months)'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Enquiry"
                        }
                    }
                }
            };

            var chartcolumnchart = new ApexCharts(
                document.querySelector("#chart-widget4"),
                optionscolumnchart
            );
            chartcolumnchart.render();



            var data2 = [];

            for (let i = 0; i < chart_added_for_rent.length; i++) {
                data2.push({
                    name: chart_added_for_rent[i]['name'],
                    data: chart_added_for_rent[i]['data']
                })
            }
            var chart_rent_options = {
                series: data2,

                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov',
                        'Dec'
                    ],
                },
                yaxis: {
                    title: {
                        text: 'Property Added For Rent'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Property"
                        }
                    }
                }
            };

            var chart_added_rent = new ApexCharts(
                document.querySelector("#pro-chart-rent"),
                chart_rent_options
            );
            chart_added_rent.render();

            var data2 = [];

            for (let i = 0; i < chart_added_for_sell.length; i++) {
                data2.push({
                    name: chart_added_for_sell[i]['name'],
                    data: chart_added_for_sell[i]['data']
                })
            }
            var chart_sell_options = {
                series: data2,

                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov',
                        'Dec'
                    ],
                },
                yaxis: {
                    title: {
                        text: 'Property Added For Sell'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Property"
                        }
                    }
                }
            };

            var chart_added_sell = new ApexCharts(
                document.querySelector("#pro-chart-sell"),
                chart_sell_options
            );
            chart_added_sell.render();

            var data2 = [];

            for (let i = 0; i < chart_rented.length; i++) {
                data2.push({
                    name: chart_rented[i]['name'],
                    data: chart_rented[i]['data']
                })
            }
            var chart_rented_options = {
                series: data2,

                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                yaxis: {
                    title: {
                        text: 'Property Rented'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Property"
                        }
                    }
                }
            };
            
            
            
            
            // third chart

            let third_chart_labels = [];
            let third_chart_data = [];
    
            @json($third_chart).forEach(element => {
                third_chart_labels.push(element['user_name']);
                third_chart_data.push(parseInt(element['total_inquiries']));
            });
    
            new Chartist.Bar('#pro-chart-rented', {
                labels: third_chart_labels,
                series: [
                    third_chart_data,
                ]
            }, {
                stackBars: true,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value.split(/\s+/).map(function(word) {
                            return word[0];
                        }).join('');
                    }
                },
                axisY: {
                    offset: 20
                }
            }, [
                ['screen and (min-width: 400px)', {
                    reverseData: true,
                    horizontalBars: true,
                    axisX: {
                        labelInterpolationFnc: Chartist.noop
                    },
                    axisY: {
                        offset: 60
                    }
                }],
                ['screen and (min-width: 800px)', {
                    stackBars: false,
                    seriesBarDistance: 10
                }],
                ['screen and (min-width: 1000px)', {
                    reverseData: false,
                    horizontalBars: false,
                    seriesBarDistance: 15
                }]
            ]);

            var data2 = [];

            for (let i = 0; i < chart_sold.length; i++) {
                data2.push({
                    name: chart_sold[i]['name'],
                    data: chart_sold[i]['data']
                })
            }
            var chart_sold_options = {
                series: data2,

                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov',
                        'Dec'
                    ],
                },
                yaxis: {
                    title: {
                        text: 'Property Sold'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Property"
                        }
                    }
                }
            };

            var chart_sold_chart = new ApexCharts(
                document.querySelector("#pro-chart-sold"),
                chart_sold_options
            );
            chart_sold_chart.render();


            for (let i = 0; i < totalSource.length; i++) {

                var optionsProgress1 = {
                    chart: {
                        height: 50,
                        type: 'bar',
                        stacked: true,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: '5%',
                            colors: {
                                backgroundBarColors: ['#f2f2f2']
                            }
                        },
                    },
                    colors: [$('#progress' + totalSource[i].id).attr('data-random_color')],
                    stroke: {
                        width: 0,
                    },
                    fill: {
                        colors: [$('#progress' + totalSource[i].id).attr('data-random_color')],
                        type: 'gradient',
                        gradient: {
                            gradientToColors: [$('#progress' + totalSource[i].id).attr('data-random_color')]
                        }
                    },
                    series: [{
                        name: totalSource[i].name,
                        data: [totalSource[i].percent]
                    }],
                    title: {
                        floating: true,
                        offsetX: -10,
                        offsetY: 5,
                        text: totalSource[i].name
                    },
                    subtitle: {
                        floating: true,
                        align: 'right',
                        offsetY: 0,
                        text: totalSource[i].percent + '%',
                        style: {
                            fontSize: '20px'
                        }
                    },
                    tooltip: {
                        enabled: false
                    },
                    xaxis: {
                        categories: [totalSource[i].name],
                    },
                    yaxis: {
                        max: 100
                    },
                    fill: {
                        opacity: 1
                    }
                }

                new ApexCharts(document.querySelector('#progress' + totalSource[i].id), optionsProgress1).render();

            }
        }
    </script>
    <script>
        if ($("#stage-wise-leads-chart").length > 0) {

            let seven_chart_labels = [];
            let seven_chart_data = [];
            
            @json($seventh_chart).forEach(element => {
                seven_chart_labels.push(element['progress']);
                seven_chart_data.push(parseInt(element['total_enquiry']));
            });

            var stage_wise_chart_data = {
                series: [
                    {
                        name: 'Stage Wise',
                        data: seven_chart_data,
                    }
                ],
                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 380
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: seven_chart_labels,
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },
                colors: ['#FF4560'],
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Enquiry"
                        }
                    }
                }
            };

            var stage_wise_chart_rented_chart = new ApexCharts(
                document.querySelector("#stage-wise-leads-chart"),
                stage_wise_chart_data
            );
            stage_wise_chart_rented_chart.render();
        }

        if ($("#stage-and-person-leads-chart").length > 0) {

            let seven_chart_labels = [];
            let seven_chart_data = [];

            let new_array = [];

            let p_labels = [];
            let p_data = [];
    
            @json($third_chart).forEach(element => {
                p_labels.push(element['user_name']);
                p_data.push(parseInt(element['total_inquiries']));
            });
            
            @json($seventh_chart).forEach(element => {
                new_array.push({
                    'name' : element['progress'],
                    'data' : [element['total_enquiry']],
                })
            });

            // basic bar chart
            var options2 = {
                chart: {
                    height: '800',
                    type: 'bar',
                    toolbar:{
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: new_array,
                xaxis: {
                    categories: p_labels,
                },
                colors:['#e6f6e0', '#b4e5cc', '#50c5d1', '#0d90b1', '#213751', '#191922', '#07080b' ]
            }

            var chart2 = new ApexCharts(
                document.querySelector("#stage-and-person-leads-chart"),
                options2
            );
            chart2.render();
        }
        
        if ($("#person-wise-leads-chart").length > 0) {
            
            let p_labels = [];
            let p_data = [];
    
            @json($third_chart).forEach(element => {
                p_labels.push(element['user_name']);
                p_data.push(parseInt(element['total_inquiries']));
            });

            // basic bar chart
            var options2 = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar:{
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    data: p_data,
                }],
                xaxis: {
                    categories: p_labels,
                },
                colors:['#db008c' ]
            }

            var chart2 = new ApexCharts(
                document.querySelector("#person-wise-leads-chart"),
                options2
            );
            chart2.render();
        }

        if($("#person_wise_activity_report").length > 0){
           var options = {
                series: [
                    {
                        name: 'False',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'Email',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'Call',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'WhatsApp',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'Follow up',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'Schedule Visit',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'Send Brochure',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }, {
                        name: 'Visit',
                        type: 'column',
                        data: [1.1, 3, 3.1]
                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                    toolbar:{
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },
                xaxis: {
                    categories: ['Pankaj','Dev Tester','testing user'],
                },
                yaxis: [
                    {
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            // color: '#008FFB'
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                ],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 10,
                        dataLabels: {
                            total: {
                                enabled: true,
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 900
                                }
                            }
                        }
                    },
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + ""
                        }
                    }
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };
            
            var chart = new ApexCharts(document.querySelector("#person_wise_activity_report"), options);
            chart.render();
        }

        if($("#activity_not_planned_lead").length > 0){
            var stage_wise_chart_data = {
                series: [
                    {
                        name: 'Series 1',
                        data: [5, 8, 4],
                    }
                ],
                legend: {
                    show: true
                },
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        radius: 10,
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    colors: ['transparent'],
                    curve: 'smooth',
                    lineCap: 'butt'
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                xaxis: {
                    categories: ['Pankaj', 'Hardik', 'Test user'],
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 0.9,
                        stops: [0, 100]
                    }
                },
                colors: ['#0d8daa'],
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Enquiry"
                        }
                    }
                }
            };

            var stage_wise_chart_rented_chart = new ApexCharts(
                document.querySelector("#activity_not_planned_lead"),
                stage_wise_chart_data
            );
            stage_wise_chart_rented_chart.render();
        }

        if($("#assign_lead_person").length > 0){
           var options = {
                series: [
                    {
                        name: 'Manish',
                        data: [44, 55, 57, 41, 36, 35]
                    }, {
                        name: 'Hardik',
                        data: [76, 85, 101, 41, 36, 35]
                    }, {
                        name: 'Pankaj',
                        data: [35, 41, 36, 41, 36, 35]
                    }, {
                        name: 'Admin',
                        data: [35, 41, 36, 41, 36, 35]
                    }, {
                        name: 'Test User',
                        data: [35, 41, 36, 41, 36, 35]
                    }, {
                        name: 'Shruti',
                        data: [35, 41, 36, 41, 36, 35]
                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                    toolbar:{
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },
                xaxis: {
                    categories: [ 04, 06, 07, 08, 09, 10],
                },
                yaxis: [
                    {
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            // color: '#008FFB'
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                ],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 10,
                        dataLabels: {
                            total: {
                                enabled: true,
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 900
                                }
                            }
                        }
                    },
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + ""
                        }
                    }
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                },
                colors:['#e6f6e0', '#b4e5cc', '#50c5d1', '#0d90b1', '#213751', '#191922', '#07080b' ]
            };
            
            var chart = new ApexCharts(document.querySelector("#assign_lead_person"), options);
            chart.render();
        }

        if($("#lead_lost_reason_person_wise").length > 0){
            var options = {
                series: [{
                    name: 'Income',
                    type: 'column',
                    data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                }, {
                    name: 'Cashflow',
                    type: 'column',
                    data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
                }],
                    chart: {
                    height: 350,
                    type: 'line',
                    stacked: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },
                xaxis: {
                    categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
                },
                yaxis: [
                {
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                        colors: '#008FFB',
                        }
                    },
                    title: {
                        text: "Income (thousand crores)",
                        style: {
                        color: '#008FFB',
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                {
                    seriesName: 'Income',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                        colors: '#00E396',
                        }
                    },
                    title: {
                        text: "Operating Cashflow (thousand crores)",
                        style: {
                        color: '#00E396',
                        }
                    },
                }
            ],
            tooltip: {
                fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
                },
            },
            legend: {
                horizontalAlign: 'left',
                offsetX: 40
            }
            };

            var chart = new ApexCharts(document.querySelector("#lead_lost_reason_person_wise"), options);
            chart.render();
        }
    </script>
@endpush
