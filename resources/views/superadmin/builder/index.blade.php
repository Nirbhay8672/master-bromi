@extends('superadmin.layouts.superapp')
@section('content')
<style>
    td {
        height: 37px !important;
    }
</style>
<div class="page-body" x-data="builder_index">
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
                        <h5 class="mb-3">Builders </h5>
                        <div class="row mt-3 mb-3 gy-3">
                            <div class="col-12 col-lg-3 col-md-3">
                                <select
                                    id="state_id"
                                    class="form-control"
                                    style="border: 1px solid black;"
                                    x-model="selected_state"
                                    @change="selectState()"
                                >
                                    <option value="">-- Select State --</option>
                                    <template x-for="(state, index) in states" :key="`state_${index}`">
                                        <option :value="state.id"><span x-text="state.name"></span></option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-12 col-lg-3 col-md-3">
                                <select
                                    id="city_id"
                                    class="form-control"
                                    style="border: 1px solid black;"
                                    x-model="selected_city"
                                >
                                    <option value="">-- Select City --</option>
                                    <template x-for="(city, index) in cities" :key="`city_${index}`">
                                        <option :value="city.id"><span x-text="city.name"></span></option>
                                    </template>
                                </select>
                            </div>
                            <div style="width: 150px;">
                                <button
                                    class="btn custom-icon-theme-button tooltip-btn"
                                    type="button"
                                    data-tooltip="Filter"
                                    @click="filter()"
                                ><i class="fa fa-filter"></i>
                                </button>
                                <button
                                    class="btn btn-warning ms-2 tooltip-btn"
                                    type="button"
                                    style="border-radius: 5px;"
                                    data-tooltip="Reset"
                                    @click="reset()"
                                ><i class="fa fa-recycle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="builderTable">
                                <thead>
                                    <tr>
                                        <th>Builder Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Total Projects</th>
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

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    $(document).ready(function() {

        let state_id = document.getElementById('state_id');
        let city_id = document.getElementById('city_id');

        $('#builderTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.builders') }}",
                data: function(d) {
                    d.state_id = state_id.value ?? '';
                    d.city_id = city_id.value ?? '';
                }
            },
            columns: [{
                    data: 'builder_name',
                    name: 'builder_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number'
                },
                {
                    data: 'state_name',
                    name: 'state_name'
                },
                {
                    data: 'city_name',
                    name: 'city_name'
                },
                {
                    data: 'projects_count',
                    name: 'projects_count'
                },
            ]
        });
    });

    document.addEventListener('alpine:init', () => {

        Alpine.data('builder_index', () => ({

            init() {
                this.states = JSON.parse(@JSON(json_encode($states)));
            },

            states : [],
            cities : [],
            selected_state : null,
            selected_city : null,

            selectState() {
                
                this.selected_city = null;

                if(this.selected_state) {
                    let obj = this.states.filter(state => state.id == this.selected_state);
                    this.cities = obj[0].cities;
                } else {
                    this.cities = [];
                    this.selected_city = null;
                }
            },

            filter() {
                $('#builderTable').DataTable().draw();
            },

            reset() {
                this.cities = [];
                this.selected_state = null;
                this.selected_city = null;

                let state_id = document.getElementById('state_id');
                let city_id = document.getElementById('city_id');

                state_id.value = '';
                city_id.value = '';

                $('#builderTable').DataTable().draw();
            }
        }));
    });

</script>
@endpush
