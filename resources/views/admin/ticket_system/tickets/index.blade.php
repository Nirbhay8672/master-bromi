@extends('admin.layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Support Tickets</h5>
                            <div class="col">
                                <a  
                                    class="btn custom-icon-theme-button tooltip-btn"
                                    href="{{route('admin.create')}}"
                                    data-tooltip="Add Query"
                                >
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="background-color: rgba(223, 223, 223, 0.804)">
                                        <tr>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Last Update</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($tickets) > 0)
                                            @foreach ($tickets as $ticket)
                                            <tr>
                                                <td>
                                                    {{ $ticket->category->name }}
                                                </td>
                                                <td>
                                                    <a>
                                                        {{ $ticket->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($ticket->status === 'Open')
                                                        <span class="label label-success">{{ $ticket->status }}</span>
                                                    @else
                                                        <span class="label label-danger">{{ $ticket->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $ticket->updated_at ? \Carbon\Carbon::parse($ticket->updated_at)->format('d/m/Y h:i:s A') : '-' }}</td>
                                                <td class="w3-bar" style="padding-left: 6%;">
                                                    @if($ticket->status === 'Open') 
                                                        <a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}" id="demo"   class="btn btn-primary extra-fields-customer" style="border-radius: 5px;">Comment</a>
                                                @endif
                                            </td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5" class="text-center">No record found</td>
                                        </tr>
                                        @endif
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
