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
                            <h5 class="mb-3">Query <a class="btn custom-icon-theme-button tooltip-btn"
                                href="<?php echo e(route('admin.index')); ?>"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong>{{ $ticket->title }}</strong>
                                        </div>
                        
                                        <div class="panel-body">
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                        
                                            <div class="ticket-info">
                                                <p>{{ $ticket->message }}</p>
                                                <p>Category: {{ $ticket->category->name }}</p>
                                                <p>
                                                    @if ($ticket->status === 'Open')
                                                        Status: <span class="label label-success">{{ $ticket->status }}</span>
                                                    @else
                                                        Status: <span class="label label-danger">{{ $ticket->status }}</span>
                                                    @endif
                                                </p>
                                                <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @include('admin.ticket_system.tickets.comments')
                                    <hr>
                                    @include('admin.ticket_system.tickets.reply')
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
             // invoice
             $('.extra-fields-customer').click(function() {
                $('.customer_records').clone().appendTo('.customer_records_dynamic');
                $('.customer_records_dynamic .customer_records').addClass('single remove');
                $('.single .extra-fields-customer').remove();
                $('.single').append('<a href="#" class="remove-field btn-remove-customer">Remove Fields</a>');
                $('.customer_records_dynamic > .single').attr("class", "remove");

                $('.customer_records_dynamic input').each(function() {
                    var count = 0;
                    var fieldname = $(this).attr("name");
                    $(this).attr('name', fieldname + count);
                    count++;
                });

                });

                $(document).on('click', '.remove-field', function(e) {
                $(this).parent('.remove').remove();
                e.preventDefault();
                });
            // end add multiple form input
        </script>
    @endpush













