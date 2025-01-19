<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = 'subcategory';

	protected $fillable = [
		'cat_id',
		'name',
		'editable',
		'status'
	];

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}
}