<div class="panel panel-default">
    <div class="panel-heading">Add reply</div>

        <div class="panel-body">
            <div class="comment-form">
            @php
            $url='';
                if (Auth::user()->role_id == 1){
                            $url=url('admin/comment');}
                            elseif(Auth::user()->role_id == 2){
                            $url=url('superadmin/comment');}
                            
            @endphp
                <form action="{{ url('admin/comment')}}" method="POST" class="form">
                    {!! csrf_field() !!}

                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">

                        <div class="fname">
                            <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>
                        </div>

                        @if ($errors->has('comment'))
                            <span class="help-block">
                               <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" style="border-radius:5px;" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</div>
