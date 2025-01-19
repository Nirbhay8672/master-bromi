<div class="panel panel-default">
    <div class="panel-heading">Add reply</div>
    <div class="panel-body">
        <div class="comment-form">
        
            <form action="{{ url('superadmin/comment') }}" method="POST" class="form">
                {!! csrf_field() !!}

                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <div class="fname">
                    <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
