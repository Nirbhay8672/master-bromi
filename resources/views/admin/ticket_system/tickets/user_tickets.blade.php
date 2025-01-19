@extends('admin.layouts.app')
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
                            <h5 class="mb-3">Query
                            <a class="btn btn-pill btn-primary" type="button" href="{{url('admin/create')}}" style="float:right">Add New request</a>
                             </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="userTable" style="border-collapse: collapse;
                                width: 100%;">
                           
                               <thead >           
                               <tr>
                                   <th style="border: 1px solid #dddddd;
                                   text-align: left;
                                   padding: 8px;">Category</th>
                                   <th style="border: 1px solid #dddddd;
                                   text-align: left;
                                   padding: 8px;">Title</th>
                                   <th style="border: 1px solid #dddddd;
                                   text-align: left;
                                   padding: 8px;">Status</th>
                                   <th style="border: 1px solid #dddddd;
                                   text-align: left;
                                   padding: 8px;">Last Updated</th>
                                   <th style="text-align:center" colspan="2">Actions</th>
                               </tr>
                               
                               <th>
                               </thead>
                               <tbody>
                               @foreach ($tickets as $ticket)
                                   <tr style="background-color: #dddddd">
                                       <td>
                                           {{ $ticket->category->name }}
                                       </td>
                                       <td>
                                           <a>
                                               #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                           </a>
                                       </td>
                                       <td>
                                           @if ($ticket->status === 'Open')
                                               <span class="label label-success">{{ $ticket->status }}</span>
                                           @else
                                               <span class="label label-danger">{{ $ticket->status }}</span>
                                           @endif
                                       </td>
                                       <td>{{ $ticket->updated_at }}</td>
                                       <td class="w3-bar text-center">
                                                 @if($ticket->status === 'Open')
                                                 
                                                 <form action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
                                                   {!! csrf_field() !!}
                                                   <a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}" id="demo"   class="btn btn-primary extra-fields-customer">Comment</a>
                                                   <button type="submit" class="btn btn-danger">Close</button>
                                               </form>
                                           @endif
                                       </td>
                                   </tr>
                                   @endforeach
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
    
@endpush



