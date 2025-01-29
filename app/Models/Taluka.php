<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taluka extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'taluka';

	protected $guarded = [];

	public function District()
	{
		return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
	}

	public function villages()
	{
		return $this->hasMany(Village::class);
	}
}
