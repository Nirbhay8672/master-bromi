<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandProperty extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $fillable = [
		'user_id',
		'specific_type',
		'district_id',
		'taluka_id',
		'village_id',
		'zone',
		'fsi',
		'configuration',
		'survey_number',
		'plot_size',
		'plot_measurement',
		'price',
		'tp_number',
		'fp_number',
		'plot2_size',
		'plot2_measurement',
		'price2',
		'address',
		'remarks',
		'status',
		'location_url',
		'property_source',
		'refrence',
		'owner_details',
	];


	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	public function District()
	{
		return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
	}

	public function Taluka()
	{
		return $this->belongsTo(Taluka::class, 'taluka_id', 'id')->withTrashed();
	}

	public function Village()
	{
		return $this->belongsTo(Village::class, 'village_id', 'id')->withTrashed();
	}

	public function Images()
	{
		return $this->hasMany(LandImages::class, 'land_id', 'id')->withTrashed();
	}
}
