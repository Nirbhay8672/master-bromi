<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandImages extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $fillable = [
		'land_id',
		'user_id',
		'construction_documents',
		'pro_id',
		'image',
	];
}
