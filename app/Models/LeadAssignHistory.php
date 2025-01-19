<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadAssignHistory extends Model
{

	protected static $recordEvents = ['created','updated','deleted'];
	protected static $logAttributes = ['name'];

	protected $table = 'lead_assign_history';

	protected $guarded = [];

	public function user()
    {
        return $this->hasOne(User::class, 'member_id', 'id');
    }
}
