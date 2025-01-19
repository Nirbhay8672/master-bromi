<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Projects extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected $fillable = [
		'user_id',
		'builder_id',
		'website',

		'contact_details',

		'project_name',

		'address',
		'area_id',
		'state_id',
		'city_id',
		'pincode',
		'location_link',
		'land_area',
		'number_of_units_in_project',
		'rera_number',

		'project_status',
		'project_status_question',

		'restrictions',
		
		'property_type',
		'property_category',
		'sub_categories',
		'sub_category_single',
		
		'tower_details',
		'unit_details',
		'wing_details',
		'land_plot_details',
		'storage_industrial_details',
		'storage_industrial_facilities',

		'parking_for_four_wheeler',
		'parking_for_two_wheeler',
		'available_for_purchase',

		'number_of_parking',
		'total_floor_for_parking',
		'parking_details',
		
		'amenities',
		'document_category',
		'document_image',
		'catlog_file',
		'other_documents',
		
		'is_indirectly_store',
		'remark',
	];

	// protected static function boot()
	// {
	// 	parent::boot();
	// 	static::addGlobalScope(new VendorScope);
	// }

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
