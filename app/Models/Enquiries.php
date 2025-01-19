<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Enquiries extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected static $recordEvents = ['created', 'updated', 'deleted'];
	protected static $logAttributes = [
		'client_name',
		'client_mobile',
		'client_email',
		'is_nri',
		'enquiry_for',
		'requirement_type',
		'property_type',
		// 'sub_category_type',
		'configuration',
		'area_from',
		'area_to',
		'area_from_measurement',
		'area_to_measurement',
		'enquiry_source',
		'furnished_status',
		'budget_from',
		'budget_to',
		'purpose',
		'building_id',
		'enquiry_status',
		'project_status',
		'area_ids',
		'is_preleased',
		'no_care_customer',
		'other_contacts',
		'telephonic_discussion',
		'highlights',
		'enquiry_city_id',
		'enquiry_branch_id',
		'employee_id',
		'district_id',
		'taluka_id',
		'village_id',
	];

	protected $fillable = [
		'user_id',
		'client_name',
		'client_mobile',
		'client_email',
		'is_nri',
		'enquiry_for',
		'requirement_type',
		'property_type',
		'enq_status',
		// 'sub_category_type',
		'configuration',
		'area_size_from',
		'area_size_to',
		'area_measurement',
		'enquiry_source',
		'furnished_status',
		'budget_from',
		'budget_to',
		'purpose',
		'building_id',
		'enquiry_status',
		'project_status',
		'area_ids',
		'is_preleased',
		'other_contacts',
		'telephonic_discussion',
		'highlights',
		'enquiry_city_id',
		'enquiry_branch_id',
		'employee_id',
		'is_favourite',
		'transfer_date',
		'added_by',
		'district_id',
		'taluka_id',
		'village_id',
	];

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	public function tapActivity(Activity $activity, string $eventName)
	{
		$activity->user_id = Session::get('parent_id');
	}



	public function Employee()
	{
		return $this->belongsTo(User::class, 'employee_id', 'id')->withTrashed();
	}


	public function Projects()
	{
		return $this->belongsTo(Projects::class, 'building_id', 'id')->withTrashed();
	}


	public function Progress()
	{
		return $this->hasMany(EnquiryProgress::class, 'enquiry_id', 'id')->orderBy('id', 'DESC')->withTrashed();
	}

	public function Visits()
	{
		return $this->hasMany(QuickSiteVisit::class, 'enquiry_id', 'id')->orderBy('id', 'DESC')->withTrashed();
	}


	public function Comments()
	{
		return $this->hasMany(EnquiryComments::class, 'enquiry_id', 'id')->withTrashed();
	}

	public function AssignHistory()
	{
		return $this->hasMany(AssignHistory::class, 'enquiry_id', 'id')->orderBy('id', 'DESC')->withTrashed();
	}

	public function activeProgress()
	{
		return $this->hasOne(EnquiryProgress::class, 'enquiry_id', 'id')->where('status', 1)->withTrashed();
	}

	public function city()
	{
		return $this->hasOne(City::class, 'enquiry_city_id', 'id');
	}
}
