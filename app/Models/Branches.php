<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branches extends Model
{
    use HasFactory;
use SoftDeletes;

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $fillable = [
		'user_id',
		'state_id',
		'city_id',
		'area_id',
		'name',
		'status',
	];


	public function City()
	{
		return $this->belongsTo(City::class, 'city_id', 'id')->withTrashed();
	}

	public function Area()
	{
		return $this->belongsTo(Areas::class, 'area_id', 'id')->withTrashed();
	}

}
