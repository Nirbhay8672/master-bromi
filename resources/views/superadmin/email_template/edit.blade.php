@extends('superadmin.layouts.superapp')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="card-header pb-3">
                    <h5 class="mb-3">Edit Email Template <a class="btn custom-icon-theme-button tooltip-btn"
                        href="{{ route('superadmin.email.index') }}"
                        data-tooltip="Back"
                        style="float: inline-end;"
                    >
                        <i class="fa fa-backward"></i>
                    </a></h5>
                </div>
                <div class="container-fluid mt-3" style="margin-top: 10px !important;">
                <form method="post" action="{{route('superadmin.email.update',$email_template->id)}}" id="email_template_form">
                    @csrf
                    <input type="hidden" name="id" value="{{$email_template->id}}">
                    <div class="col-md-6 mt-2" style="margin-top: 10px !important;">
                        <div class="position-relative form-group {{$email_template->title ? 'focused' : ''}}">
                            <label for="title" class="">Title</label>
                            <input name="title" type="text" value="{{$email_template->title}}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="position-relative form-group">
                            <label for="lastname" class="">Content</label>
                            <textarea id="content" data-error="#email_content_error" name="content" cols="30" rows="50">{!! $email_template->content !!}</textarea>
                            <div id="email_content_error"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="title" class="mb-0 mt-3">Status</label>
                        <div class="form-check checkbox  checkbox-solid-success ps-2 m-b-20">
                            <input class="form-check-input" name="status" id="status" value="1" type="checkbox" @if($email_template->status) checked @endif>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                    <button class="mt-1 btn btn-primary">Submit</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<!-- Plugins JS start-->
{{-- <script src="{{ asset('admins/assets/js/editor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admins/assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ asset('admins/assets/js/editor/ckeditor/styles.js') }}"></script>
<script src="{{ asset('admins/assets/js/editor/ckeditor/ckeditor.custom.js') }}"></script> --}}
<script src="https://cdn.ckeditor.com/4.7.0/full-all/ckeditor.js"></script>

<script>
    // Default ckeditor
    CKEDITOR.replace('content', {
        height: '400px',
        on: {
            contentDom: function( evt ) {
                // Allow custom context menu only with table elemnts.
                evt.editor.editable().on( 'contextmenu', function( contextEvent ) {
                    var path = evt.editor.elementPath();

                    if ( !path.contains( 'table' ) ) {
                        contextEvent.cancel();
                    }
                }, null, null, 5 );
            }
        }
    });

    $( "#email_template_form" ).validate({
        ignore: [],
        debug: false,
        rules: {
            title: {
                required: true
            },
            content: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
			var placement = $(element).data('error');
			if (placement) {
				$(placement).append(error)
			} else {
				error.insertAfter(element);
			}
		}
    });
</script>
@endpush
