<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class EnquiryProgress extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $fillable = [
		'enquiry_id',
		'user_id',
		'progress',
		'lead_type',
		'sales_comment_id',
		'nfd',
		'status',
		'remarks',
		'time_before',
		'email_reminder',
		'sms_reminder',
	];


	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
	}

	public function Enquiry()
	{
		return $this->belongsTo(Enquiries::class, 'enquiry_id', 'id')->withTrashed();
	}

	public function Dropdowns()
	{
		return $this->belongsTo(DropdownSettings::class, 'sales_comment_id', 'id')->withTrashed();
	}

}
