<?php

namespace App\Models\MasterProperty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyCategory extends Model
{
	protected $table = 'property_categories';
	protected $guarded = [];

	public function subCategory(): HasMany
	{
		return $this->hasMany(PropertySubCategory::class , 'category_id', 'id');
	}
}
