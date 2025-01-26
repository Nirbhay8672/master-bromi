@extends('admin.layouts.app')

@push('page-css')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        .input-group .input-group-append .select2-container .select2-selection--single {
            height: 45px !important;
        }

        .add-input-link {
            color:#0078DB;
            cursor: pointer;
        }
    
        .btn {
            border-radius: 5px;
        }
    </style>
@endpush

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
                        <h5 class="mb-3">Add Property</h5>
                    </div>
                    <div class="card-body">
                        <div id="app">
                            <add-property-form
                                :property_for_type="{{ $property_for_type }}"
                                :property_construction_type="{{ $property_construction_type }}"
                                :projects="{{ $projects }}"
                                :cities="{{ $cities }}"
                                :authuser="{{ auth()->user() }}"
                                :land_units="{{ $land_units }}"
                                :property_source="{{ $property_source }}"
                            ></add-property-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('admins/assets/js/form-wizard/property_wizard.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
