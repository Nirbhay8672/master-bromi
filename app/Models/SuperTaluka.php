<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class SuperTaluka extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected $table = 'super_talukas';

	protected $fillable = [
		'name',
		'district_id',
	];

	public function district()
	{
		return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
	}
}
