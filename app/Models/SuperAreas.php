<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class SuperAreas extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected $table = 'super_areas';

	protected $fillable = [
		'name',
		'super_city_id',
		'state_id',
		'pincode',
	];

	public function City()
	{
		return $this->belongsTo(SuperCity::class, 'super_city_id', 'id')->withTrashed();
	}

	public function State()
	{
		return $this->belongsTo(State::class, 'state_id', 'id')->withTrashed();
	}

}
