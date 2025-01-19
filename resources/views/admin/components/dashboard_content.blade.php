@php
    function rand_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xffffff));
    }
@endphp

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-3">
    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-light-green">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{ $total_enquiry }}</h1>
                        <h3 class="mb-0">Total Leads</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-light-purpel">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{ $total_active_leads }}</h1>
                        <h3 class="mb-0">Active Leads</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-info">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{$total_lost}}</h1>
                        <h3 class="mb-0">Lost Leads</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-light-orange">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{$total_win}}</h1>
                        <h3 class="mb-0">Booked Leads</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-secondary">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{$total_win}} : {{$total_lost}}</h1>
                        <h3 class="mb-0">Win Lose Ratio</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-info">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{ $total_property }}</h1>
                        <h3 class="mb-0">Total Property</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-light-orange">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{ $total_prop_for_sell }}</h1>
                        <h3 class="mb-0">Properties For Sale</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-light-green">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{ $total_prop_for_rent }}</h1>
                        <h3 class="mb-0">Properties For Rent</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card o-hidden">
            <div class="card-body bg-light-purpel">
                <div class="media static-widget my-3">
                    <div class="media-body text-center">
                        <h1 class="font-roboto">{{ $total_prop_for_both }}</h1>
                        <h3 class="mb-0">Properties For Both</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="custom-card bg-success o-hidden">
            <div class="column">
                <div class="total">{{ $total_prop_for_rec }}</div>
                <div class="name">Residential</div>
            </div>
            <div class="separator"></div>
            <div class="column">
                <div class="total">{{ $total_prop_for_comm }}</div>
                <div class="name">Commercial</div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12" x-show="isIncludes('New Leads')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>New Leads</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('New Leads')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="new-leads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" x-show="isIncludes('New Leads Source Wise')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>New Leads Source Wise</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('New Leads Source Wise')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="new-lead-source-wise"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" x-show="isIncludes('All Assign Leads')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>All Assign Leads</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('All Assign Leads')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="pro-chart-rented"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" x-show="isIncludes('Active Lead Source Wise')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Active lead Source Wise</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Active Lead Source Wise')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="active-lead-source-wise"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" x-show="isIncludes('Lost Leads Source Wise')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Lost Leads Source Wise</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Lost Leads Source Wise')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="lost-leads-source-wise"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <div class="card o-hidden" x-show="isIncludes('Stage Wise Leads')">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Stage wise Leads</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Stage Wise Leads')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="stage-wise-leads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card o-hidden" x-show="isIncludes('Person Wise Leads')">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Person Wise Leads</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Person Wise Leads')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="person-wise-leads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6" x-show="isIncludes('Stage And Person Wise Leads')">
        <div class="card o-hidden h-100">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Stage and Person Wise Leads</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Stage And Person Wise Leads')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget h-100">
                <div class="bottom-content card-body h-100">
                    <div class="row h-100">
                        <div class="col-12 h-100">
                            <div id="stage-and-person-leads-chart" class="h-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6" x-show="isIncludes('Person Wise Activity Report')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Person wise Activity Report</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Person Wise Activity Report')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="person_wise_activity_report"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6" x-show="isIncludes('Activity Not Planned In Lead')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Activity Not Planned in Lead</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Activity Not Planned In Lead')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="activity_not_planned_lead"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6" x-show="isIncludes('Assign Leads To Person Date Wise')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Assign Leads to Person date wise</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Assign Leads To Person Date Wise')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="assign_lead_person"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6" x-show="isIncludes('Lead Lost Reason Person Wise')">
        <div class="card o-hidden">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h5>Lead Lost Reason Person wise</h5>
                    <div class="p-2">
                        <button
                            class="btn custom-theme-button btn-sm"
                            style="border-radius: 5px;"
                            @click="removeChart('Lead Lost Reason Person Wise')"
                        >X</button>
                    </div>
                </div>
            </div>
            <div class="bar-chart-widget">
                <div class="bottom-content card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="lead_lost_reason_person_wise"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
