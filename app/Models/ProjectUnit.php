<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectUnit extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $fillable = [
		'user_id',
		'project_id',
		'units_id',
		'tower_id',
		'floor_details',
	];

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	public function Project()
	{
		return $this->belongsTo(Projects::class, 'project_id', 'id')->withTrashed();
	}
}
