<?php

namespace App\Models\MasterProperty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyConstructionType extends Model
{
	protected $table = 'property_construction_types';
	protected $guarded = [];

	public function category(): HasMany
	{
		return $this->hasMany(PropertyCategory::class , 'property_construction_type_id', 'id');
	}
}
