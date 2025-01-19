<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstaProperties extends Model
{
    use HasFactory;
use SoftDeletes;
	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $fillable = [
		'user_id',
		'property_for',
		'property_type',
		'specific_type',
		'building_id',
		'property_wing',
		'property_unit_no',
		'configuration',
		'super_builtup_area',
		'super_builtup_measurement',
		'plot_area',
		'plot_measurement',
		'terrace',
		'terrace_measuremnt',
		'hot_property',
		'furnished_status',
		'commision',
		'source_of_property',
		'price',
		'property_remarks',
		'is_specific_number',
		'owner_contact_specific_no',
		'owner_name',
		'owner_number',
	];

	public function Project()
	{
		return $this->belongsTo(Projects::class, 'building_id', 'id')->withTrashed();
	}
}
