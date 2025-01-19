<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropdownTemplate extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $table = 'dropdown_template';

	protected $fillable = [
		'name',
		'dropdown_for',
		'parent_id',
	];
}
