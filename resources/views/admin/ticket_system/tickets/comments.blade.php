<div class="comments">
    @foreach($ticket->comments as $comment)
        <div class="panel panel-@if($ticket->user->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">
            <div class="panel panel-heading">
                @php
                    $user=App\Models\User::where('id',$comment->user_id)->select('role_id')->first();
                @endphp

                @if ($user->role_id == 1)
                   <b>Message From Admin</b>
                
                   @elseif($user->role_id == 3)
                <b>Message From Supper Admin</b>
                @endif

                <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
            </div>

            <div class="panel panel-body mb-2" style="text-transform: none;">
                {{ $comment->comment }}
            </div>
        </div>
    @endforeach
</div>
