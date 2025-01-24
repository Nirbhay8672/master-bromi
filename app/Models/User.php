<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
		'company_logo',
		'id_type',
		'id_file',
		'mobile_number',
		'rera',
		'gst',
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
		'total_user_limit',
		'driving_license',
		'company_name',
        'plan_type',
        'plan_expire_on',
		'subscribed_on',
		'verification_token',
		'is_verified',
		'payment_id',
        'total_extra_users_added',
        'total_user_created',
        'total_free_user',
        'total_paid_user',
        'temp_pass',
		'enquiry_for_id',
		'enquiry_type',
		'specific_enquiry',
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

	public function projects()
	{
		return $this->hasMany(Projects::class);
	}
	
	public function getPermissionsAttribute($attrbute)
    {
        $permissions = collect();
        if (!empty($attrbute)) {
            $permissions = collect(json_decode($attrbute, true));
        }
        return $permissions;
    }

	public function superCity()
	{
		return $this->belongsTo(SuperCity::class, 'city_id', 'id')->withTrashed();
	}

    /**
     * Retrieve the users that belong to the same team as the current user.
     *
     * This function returns a collection of User models where the parent_id
     * matches the current user's parent_id or id. It also includes the user
     * itself if the id matches the current user's parent_id or id.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

	public function teamUsers():Collection
	{
		return User::where('parent_id', $this->parent_id ?? $this->id)
			->orWhere('id', $this->parent_id ?? $this->id)
			->get();
	}
}
