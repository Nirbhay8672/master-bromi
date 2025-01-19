<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class SuperVillages extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected $table = 'super_villages';

	protected $fillable = [
		'name',
		'super_taluka_id',
		'district_id',
	];

	public function Taluka()
	{
		return $this->belongsTo(SuperTaluka::class, 'super_taluka_id', 'id')->withTrashed();
	}

	public function District()
	{
		return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
	}
}
