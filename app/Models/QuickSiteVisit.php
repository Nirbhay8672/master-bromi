<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuickSiteVisit extends Model
{
	use HasFactory;
    use SoftDeletes;
    
    protected $table = 'quick_schedule_visit';


	protected $fillable = [
		'enquiry_id',
		'visit_status',
		'description',
		'visit_date',
		'assigned_to',
		'assigned_by',
		'status',
		'email_reminder',
		'sms_reminder',
		'schedule_remind',
		'property_list',
	];


	public function AssignedTo()
	{
		return $this->belongsTo(User::class, 'assigned_to', 'id')->withTrashed();
	}

	public function AssignedBy()
	{
		return $this->belongsTo(User::class, 'assigned_by', 'id')->withTrashed();
	}

	public function Enquiry()
	{
		return $this->belongsTo(Enquiries::class, 'enquiry_id', 'id')->withTrashed();
	}

}
