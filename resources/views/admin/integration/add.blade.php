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
        <div class="main-card mb-3 card">
             
            <div class="card-body">
                
                <div class="container-fluid">
                    <div class="row">
                    <h1>Add Template  <a class="btn custom-icon-theme-button tooltip-btn"
                            href="{{route('admin.email.index')}}"
                            data-tooltip="Back"
                            style="float: inline-end;"
                        >
                            <i class="fa fa-backward"></i>
                        </a>
                    </h1>
                </div>
                <form method="post" action="{{route('admin.email.store')}}" id="email_template_form">
                   
                    @csrf
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="" >Title</label><br>
                            <br>
                            <input name="title" placeholder="Title" type="text" value="" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="position-relative form-group mt-2">
                            <label for="lastname" class=" mt-2">Content</label>
                            <textarea id="content" data-error="#email_content_error" name="content"></textarea>
                            <div id="email_content_error"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="title" class="mb-0 mt-3">Status</label>
                        <div class="form-check checkbox  checkbox-solid-success ps-2 m-b-20">
                            <input class="form-check-input" name="status" id="status" value="1" type="checkbox" checked>
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
