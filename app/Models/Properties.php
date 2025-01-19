<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Properties extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'user_id',
		'property_for',
		'property_type',
		'property_category',
		'configuration',
		'project_id',
		'city_id',
		'state_id',
		'locality_id',
		'address',
		'location_link',
		'district_id',
		'taluka_id',
		'village_id',
		'zone_id',
		'constructed_carpet_area',
		'constructed_salable_area',
		'constructed_builtup_area',
		'salable_plot_area',
		'carpet_plot_area',
		'salable_area',
		'carpet_area',
		'storage_centre_height',
		'length_of_plot',
		'width_of_plot',
		'entrance_width',
		'ceiling_height',
		'builtup_area',
		'plot_area',
		'terrace',
		'construction_area',
		'terrace_carpet_area',
		'terrace_salable_area',
		'total_units_in_project',
		'total_no_of_floor',
		'total_units_in_tower',
		'property_on_floors',
		'no_of_elavators',
		'no_of_balcony',
		'total_no_of_units',
		'no_of_room',
		'no_of_bathrooms',
		'no_of_floors_allowed',
		'no_of_side_open',
		'service_elavator',
		'servant_room',
		'hot_property',
		'is_favourite',
		'front_road_width',
		'construction_allowed_for',
		'fsi',
		'no_of_borewell',
		'fourwheller_parking',
		'twowheeler_parking',
		'is_pre_leased',
		'pre_leased_remarks',
		'Property_priority',
		'source_of_property',
		'property_source_refrence',
		'availability_status',
		'propertyage',
		'available_from',
		'amenities',
		'other_industrial_fields',
		'two_road_corner',
		'unit_details',
		'survey_number',
		'survey_plot_size',
		'survey_price',
		'tp_number',
		'fp_number',
		'fp_plot_size',
		'fp_plot_price',
		'owner_is',
		'owner_name',
		'owner_contact',
		'owner_email',
		'owner_nri',
		'contact_details',
		'care_taker_name',
		'care_taker_contact',
		'key_available_at',
		'conference_room',
		'reception_area',
		'pantry_type',
		'washrooms2_type',
		'added_by',
		'status',
		'prop_status',
		'remarks',
		'other_contact_details',
	];

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);

		self::created(function ($model) {
			$data = [];
			$data['user_id'] = Session::get('parent_id');
			$data['action_by'] = Auth::User()->id;
			$data['action_on'] = $model->id;
			$data['action'] = 'created';
			PropertyReport::create($data);
		});

		self::updated(function ($model) {
			$data = [];
			$data['user_id'] = Session::get('parent_id');
			$data['action_by'] = Auth::User()->id;
			$data['action_on'] = $model->id;
			$data['action'] = 'updated';
			PropertyReport::firstOrCreate($data);
		});
	}

	public function Projects()
	{
		return $this->belongsTo(Projects::class, 'project_id', 'id')->with('Area')->withTrashed();
	}

	public function Locality()
	{
		return $this->belongsTo(Areas::class, 'locality_id', 'id')->withTrashed();
	}

	public function Village()
	{
		return $this->belongsTo(Village::class, 'village_id', 'id')->withTrashed();
	}

	public function District()
	{
		return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
	}

	public function Taluka()
	{
		return $this->belongsTo(Taluka::class, 'taluka_id', 'id')->withTrashed();
	}

	public function AddedBy()
	{
		return $this->belongsTo(User::class, 'added_by', 'id')->withTrashed();
	}

/*	protected $casts = [
        'property_for' => 'string',
        'property_type' => 'integer',
        'property_category' => 'integer',
        'configuration' => 'integer',
        'project_id' => 'integer',
        'city_id' => 'integer',
        'locality_id' => 'integer',
        'address' => 'string',
        'property_link' => 'string',
        'district_id' => 'integer',
        'taluka_id' => 'integer',
        'village_id' => 'integer',
        'zone_id' => 'integer',
        'constructed_carpet_area' => 'string',
        'constructed_salable_area' => 'string',
        'constructed_builtup_area' => 'string',
        'salable_plot_area' => 'string',
        'carpet_plot_area' => 'string',
        'salable_area' => 'string',
        'carpet_area' => 'string',
        'storage_centre_height' => 'string',
        'length_of_plot' => 'string',
        'width_of_plot' => 'string',
        'entrance_width' => 'string',
        'ceiling_height' => 'string',
        'builtup_area' => 'string',
        'plot_area' => 'string',
        'terrace' => 'string',
        'construction_area' => 'string',
        'terrace_carpet_area' => 'string',
        'terrace_salable_area' => 'string',
        'total_units_in_project' => 'integer',
        'total_no_of_floor' => 'integer',
        'total_units_in_tower' => 'integer',
        'property_on_floors' => 'integer',
        'no_of_elavators' => 'integer',
        'no_of_balcony' => 'integer',
        'total_no_of_units' => 'integer',
        'no_of_room' => 'integer',
        'no_of_bathrooms' => 'integer',
        'no_of_floors_allowed' => 'integer',
        'no_of_side_open' => 'integer',
        'service_elavator' => 'integer', // Assuming service_elavator should be an integer
        'servant_room' => 'integer', // Assuming servant_room should be an integer
        'hot_property' => 'integer', // Assuming hot_property should be an integer
        'is_favourite' => 'integer', // Assuming is_favourite should be an integer
        'is_terrace' => 'integer', // Assuming is_terrace should be an integer
        'is_pre_leased' => 'integer', // Assuming is_pre_leased should be an integer
        'front_road_width' => 'string',
        'construction_allowed_for' => 'string',
        'fsi' => 'string',
        'no_of_borewell' => 'integer',
        'fourwheller_parking' => 'string',
        'twowheeler_parking' => 'string',
        'pre_leased_remarks' => 'string',
        'Property_priority' => 'string',
        'property_source' => 'string',
        'refrence' => 'string',
        'available_from' => 'string',
        'two_road_corner' => 'integer', // Assuming two_road_corner should be an integer
        'unit_details' => 'json', // Assuming unit_details is an array
        'survey_number' => 'string',
        'survey_plot_size' => 'string',
        'survey_price' => 'string',
        'tp_number' => 'string',
        'fp_number' => 'string',
        'fp_plot_size' => 'string',
        'fp_plot_price' => 'string',
        'owner_is' => 'integer',
        'other_industrial_fields' => 'json', // Assuming other_industrial_fields is a nested array
        'owner_name' => 'string',
        'owner_contact' => 'string',
        'owner_email' => 'string',
        'owner_nri' => 'integer',
        'contact_details' => 'json', // Assuming contact_details is an array
        'remarks' => 'string',
        'state_id' => 'integer',
        'other_name' => 'json', // Assuming other_name is an array
        'other_contact' => 'json', // Assuming other_contact is an array
        'position' => 'json', // Assuming position is an array
        'other_contact_details' => 'json', // Assuming other_contact_details is an array

    ];*/
}
