@extends('admin.layouts.app')

@section('content')

<style>
    .custom-table-design {
        border: 1px solid #8798be;
    }
</style>
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
                        <h5 class="mb-3">Details of Property <a class="btn custom-icon-theme-button tooltip-btn" href="{{ route('admin.master_properties.index') }}" data-tooltip="Back" style="float: inline-end;">
                            <i class="fa fa-backward"></i>
                        </a></h5>
                    </div>
                    
                    @if(in_array($property_master->category_id, [1, 2]))
                        @include('admin.master_properties.views.officeretail')
                    @endif

                    @if(in_array($property_master->category_id, [3]))
                        @include('admin.master_properties.views.storage')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
