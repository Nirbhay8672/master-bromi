<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropdownSettings extends Model
{
	use HasFactory;
    use SoftDeletes;

	protected $fillable = [
		'user_id',
		'name',
		'dropdown_for',
		'parent_id',
	];

	protected static function boot()
	{
		parent::boot();
	}
}
