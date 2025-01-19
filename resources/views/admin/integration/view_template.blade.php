<div class="row">
    <div class="col-md-5 m-b-20">
        <label class="mb-0">Title:</label>
        <div><label class="form-check-label text-secondary">{{$integration->title}}</label></div>
    </div>
    <div class="col-md-12 m-b-20">
        <label>Email Content:</label>
        <div>
            {!! $integration->content !!}
        </div>
    </div>
</div>
