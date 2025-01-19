@extends('admin.layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Raise Ticket <a class="btn custom-icon-theme-button tooltip-btn"
                                href="<?php echo e(route('admin.index')); ?>"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form
                                class="form-horizontal"
                                role="form"
                                method="POST"
                                action="{{route('admin.new.ticket')}}"
                                enctype="multipart/form-data"
                            >
                                {!! csrf_field() !!}
        
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>
        
                                    <div class="col-md-4">
                                        <div class="fname">
                                            <input id="title" placeholder="Enter title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                                        </div>
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <span>{{ $errors->first('title') }}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        
                                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} mt-3">
                                    <label for="category" class="col-md-4 control-label">Category</label>
        
                                    <div class="col-md-4">
                                        <select id="category" type="category" class="form-control" name="category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
        
                                        @if ($errors->has('category'))
                                            <span class="text-danger">
                                                <span>{{ $errors->first('category') }}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        
                                <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }} mt-3">
                                    <label for="priority" class="col-md-4 control-label">Priority</label>
        
                                    <div class="col-md-4">
                                        <select id="priority" type="" class="form-control" name="priority">
                                            <option value="">Select Priority</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
        
                                        @if ($errors->has('priority'))
                                            <span class="text-danger">
                                                <span>{{ $errors->first('priority') }}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="priority" class="col-md-4 control-label">Attachment</label>

                                    <div class="col-md-4">
                                        <input type="file" style="border: 1px solid black;border-radius:5px;" name="attachment" id="attachment" class="form-control">
                                    </div>
                                </div>
                        
                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }} mt-3">
                                    <label for="message" class="col-md-4 control-label">Message</label>
        
                                    <div class="col-md-6">
                                        <div class="fname">
                                            <textarea rows="5" id="message" class="form-control" name="message"></textarea>
                                        </div>
        
                                        @if ($errors->has('message'))
                                            <span class="text-danger">
                                                <span>{{ $errors->first('message') }}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" style="border-radius: 5px;">
                                            <i class="fa fa-btn fa-ticket me-2"></i> Raised
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
