<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class CompanyDetails extends Model
{
	use HasFactory;
use SoftDeletes;
	use LogsActivity;

	protected static $recordEvents = ['created','updated'];

	protected $table = 'company_details';

	protected $fillable = [
		'user_id',
		'company_name',
		'company_email',
		'company_logo',
		'company_gst',

	];

	

	
}
