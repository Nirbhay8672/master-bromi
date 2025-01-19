<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
use HasFactory;
	use SoftDeletes;
	protected $table = 'property_partner';

	protected $primaryKey = 'id';
	protected $fillable = [
		'user_id',
		'partner_id',
		'status',
	];

	public function user()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function requestSendingUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
