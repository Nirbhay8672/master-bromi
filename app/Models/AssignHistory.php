<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignHistory extends Model
{
    use HasFactory;
	use SoftDeletes;
    protected $guarded = [];

    public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
	}

    public function assign_user()
	{
		return $this->belongsTo(User::class, 'assign_id', 'id')->withTrashed();
	}
}
