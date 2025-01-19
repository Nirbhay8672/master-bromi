<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustrialProperty extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $fillable = [
		'user_id',
		'property_for',
		'specific_type',
		'building_id',
		'area_id',
		'city_id',
		'state_id',
		'property_wing',
		'property_unit_no',
		'configuration',
		'property_status',
		'construction_area',
		'construction_measurement',
		'source_of_property',
		'zone',
		'plot_area',
		'plot_measurement',
		'hot_property',
		'commission',
		'pre_leased',
		'Property_description',
		'price',
		'price_remarks',
		'remarks',
		'address',
		'owner_details',
		'gpcb',
		'gpcb_remarks',
		'ec_noc',
		'ec_noc_remarks',
		'bail',
		'bail_remarks',
		'discharge',
		'discharge_remarks',
		'gujrat_gas',
		'gujrat_gas_remarks',
		'power',
		'power_remarks',
		'water',
		'water_remarks',
		'machinery',
		'machinery_remarks',
		'etl_necpt',
		'etl_necpt_remarks',
	];

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	public function Projects()
	{
		return $this->belongsTo(Projects::class, 'building_id', 'id')->withTrashed();
	}

	public function Area()
	{
		return $this->belongsTo(Areas::class, 'area_id', 'id')->withTrashed();
	}


}
