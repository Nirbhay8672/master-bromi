<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifications extends Model
{
    use HasFactory;
use SoftDeletes;

	protected $table = 'notifications';

	protected $fillable = [
		'message',
		'status',
    	'schedule_date',
        'state',
        'city'
	];

    public function city() {
        return $this->belongsTo(SuperCity::class, 'city', 'id');
    }
}
