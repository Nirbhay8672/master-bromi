<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotifications extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'notification',
		'seen',
        'notification_type',
        'property_id',
        'enquiry_id',
        'by_user',
        'new_user_id',
        'general_notif_status',
        'schedule_date',
        'notification_id',
        'first_notification',
        'second_notification',
        'state',
        'city',
        'lead_id'
        
	];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
