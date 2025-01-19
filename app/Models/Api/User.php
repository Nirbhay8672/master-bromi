<?php

namespace App\Models\Api;

use App\Scopes\VendorScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions, LogsActivity , SoftDeletes;

	protected static $recordEvents = ['created', 'updated', 'deleted'];
	protected static $logAttributes = [
		'first_name',
		'last_name',
		'email',
		'mobile_number',
		'address',
		'status',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'parent_id',
		'first_name',
		'middle_name',
		'last_name',
		'birth_date',
		'hire_date',
		'pincode',
		'city_id',
		'state_id',
		'email',
		'mobile_number',
		'office_number',
		'home_number',
		'position',
		'branch_id',
		'reporting_to',
		'property_for_id',
		'property_type_id',
		'specific_properties',
		'buildings',
		'email_verified_at',
		'email_verified',
		'password',
		'role_id',
		'vendor_id',
		'address',
		'status',
		'plan_id',
		'driving_license',
		'company_name',
		'subscribed_on',
		'verification_token',
		'is_verified',

	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Get the user's full name.
	 *
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	public function tapActivity(Activity $activity, string $eventName)
	{
		$activity->user_id = Session::get('parent_id');
	}

	public function Plan()
	{
		return $this->belongsTo(Subplans::class, 'plan_id', 'id')->withTrashed();
	}

	public function City()
	{
		return $this->belongsTo(City::class, 'city_id', 'id')->withTrashed();
	}

	public function State()
	{
		return $this->belongsTo(State::class, 'state_id', 'id')->withTrashed();
	}

	public function Branch()
	{
		return $this->belongsTo(Branches::class, 'branch_id', 'id')->withTrashed();
	}
}
