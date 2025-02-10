<?php

namespace App\Models\MasterProperty;

use App\Models\City;
use App\Models\District;
use App\Models\Projects;
use App\Models\PropertyConstructionDocument;
use App\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Builder\Property;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MasterProperty extends Model implements HasMedia
{
	use InteractsWithMedia;
	
	protected $table = 'property_master';
	protected $guarded = [];

	protected $casts = [
        'storage_inductrial_other_details' => 'array',
		'amenities' => 'array',
    ];

	public function extraSize(): HasMany
	{
		return $this->hasMany(PropertyAreaSize::class , 'property_id' , 'id');
	}
	
	public function areaSizes(): HasMany
	{
		return $this->hasMany(PropertyAreaSize::class, 'property_id', 'id');
	}

	public function project(): BelongsTo
	{
		return $this->belongsTo(Projects::class, 'project_id' , 'id');
	}

	public function city(): BelongsTo
	{
		return $this->belongsTo(City::class, 'city_id' , 'id');
	}

	public function propertyFor(): BelongsTo
	{
		return $this->belongsTo(PropertyForType::class, 'property_for' , 'id');
	}

	public function propertyConstructionType(): BelongsTo
	{
		return $this->belongsTo(PropertyConstructionType::class, 'property_contruction_type_id' , 'id');
	}

	public function propertyCategory(): BelongsTo
	{
		return $this->belongsTo(PropertyCategory::class, 'category_id' , 'id');
	}

	public function propertySubCategory(): BelongsTo
	{
		return $this->belongsTo(PropertySubCategory::class, 'sub_category_id' , 'id');
	}

	public function unitDetails(): HasMany
	{
		return $this->hasMany(PropertyUnitDetail::class , 'property_id' , 'id');
	}

	public  function contactDetails(): HasMany
	{
		return $this->hasMany(PropertyContactDetail::class, 'property_id', 'id');
		}

	public 	function village(): BelongsTo
	{
		return $this->belongsTo(Village::class);
	}

	public function district(): BelongsTo
	{
		return $this->belongsTo(District::class);
	}

	public function propertyConstructionDocuments(): HasMany
	{
		return $this->hasMany(PropertyConstructionDocument::class, 'property_id', 'id');
	}
}
