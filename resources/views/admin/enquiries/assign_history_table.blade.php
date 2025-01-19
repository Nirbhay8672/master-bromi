@forelse($assign_history as $item)
<tr>
    <td>{{($item->assign_user != null)? $item->assign_user->first_name.' '.$item->assign_user->last_name : '-'}}</td>
    <td>{{($item->user != null)? $item->user->first_name.' '.$item->user->last_name : '-'}}</td>
    <td>{{date('d-m-Y H:i:s',strtotime($item->created_at))}}</td>
</tr>
@empty
    <tr>
        <td colspan="3" class="text-center">No records found.</td>
    </tr>
@endforelse
