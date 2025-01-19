@extends('admin.layouts.app')
@section('title', 'My Tickets')
@push('css')
    <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color: coral;}
    </style>
@endpush
@section('content')
   
   <div class="page-body">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket"> My Tickets</i>
                </div>

                <div class="panel-body card">
                    @if($tickets->isEmpty())
                        <p>You have not created any tickets.</p>
                    @else
                       <table style=" border-collapse: collapse;
  width: 100%;">
                            <thead>
                                <tr>
                                    <th style="padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;">Category</th>
                                    <th style="padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;">Title</th>
                                    <th style="padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;">Status</th>
                                    <th style="padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;">Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>
                                            {{ $ticket->category->name }}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/tickets/' . $ticket->ticket_id) }}">
                                                {{ $ticket->title }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($ticket->status == "Open")
                                                <span class="label label-success">{{ $ticket->status }}</span>
                                            @else
                                                <span class="label label-danger">{{ $ticket->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ticket->updated_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $tickets->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection










