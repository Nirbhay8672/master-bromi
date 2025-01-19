<div class="row">
    <div class="col-md-5 m-b-20">
        <label class="mb-0">Title:</label>
        <div><label class="form-check-label text-secondary">{{$email_template->title}}</label></div>
    </div>
    <div class="col-md-12 m-b-20">
        <label>Email Content:</label>
        <div>
            {!! $email_template->content !!}
        </div>
    </div>
</div>