<?php

namespace App\Models\MasterProperty;

use App\Models\City;
use App\Models\Projects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Builder\Property;

class MasterProperty extends Model
{
	protected $table = 'property_master';
	protected $guarded = [];

	protected $casts = [
        'storage_inductrial_other_details' => 'array',
    ];

	public function areaSize(): HasMany
	{
		return $this->hasMany(PropertyAreaSize::class);
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
		return $this->hasMany(PropertyUnitDetail::class);
	}

	public  function contactDetails(): HasMany
	{
		return $this->hasMany(PropertyContactDetail::class);
	}
}
