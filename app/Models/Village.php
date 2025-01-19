<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'village';

	protected $guarded = [];

	public function Taluka()
	{
		return $this->belongsTo(Taluka::class, 'taluka_id', 'id')->withTrashed();
	}

	public function District()
	{
		return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
	}
}
