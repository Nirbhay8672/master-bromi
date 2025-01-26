<?php

namespace App\Models\MasterProperty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Builder\Property;

class MasterProperty extends Model
{
	protected $table = 'property_master';
	protected $guarded = [];

	public function areaSize(): HasMany
	{
		return $this->hasMany(PropertyAreaSize::class);
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
