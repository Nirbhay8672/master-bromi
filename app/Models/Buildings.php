<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Buildings extends Model
{
	use HasFactory;
use SoftDeletes;
	use LogsActivity;

	protected static $recordEvents = ['created', 'updated', 'deleted'];
	protected static $logAttributes = [
		'name',
		'builder_id',
		'area_id',
		'address',
		'city_id',
		'state_id',
		'pincode',
		'status',
	];


	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $fillable = [
		'user_id',
		'name',
		'builder_id',
		'area_id',
		'address',
		'city_id',
		'state_id',
		'pincode',
		'status',
		'landmark',
		'is_prime',
		'posession_year',
		'floor_count',
		'unit_no',
		'lift_count',
		'property_type',
		'restrictions',
		'building_status',
		'building_quality',
		'building_descriptions',
		'building_amenities',
		'contact_details',
		'security_details',
		'document_images',
	];


	public function City()
	{
		return $this->belongsTo(City::class, 'city_id', 'id')->withTrashed();
	}

	public function State()
	{
		return $this->belongsTo(State::class, 'state_id', 'id')->withTrashed();
	}

	public function Area()
	{
		return $this->belongsTo(Areas::class, 'area_id', 'id')->withTrashed();
	}

	public function Builder()
	{
		return $this->belongsTo(Builders::class, 'builder_id', 'id')->withTrashed();
	}

	public function Images()
	{
		return $this->hasMany(BuildingImages::class, 'building_id', 'id')->withTrashed();
	}

	public function tapActivity(Activity $activity, string $eventName)
	{
		$activity->user_id = Session::get('parent_id');
	}
}
