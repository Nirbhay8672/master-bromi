<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Areas extends Model
{
	use HasFactory;
    use SoftDeletes;
	use LogsActivity;

	protected static $recordEvents = ['created', 'updated', 'deleted'];
	protected static $logAttributes = [
		'name',
		'city_id',
		'state_id',
		'status',
	];

	// protected static function boot()
	// {
	// 	parent::boot();
	// 	static::addGlobalScope(new VendorScope);
	// }

	protected $fillable = [
		'user_id',
		'name',
		'city_id',
		'state_id',
		'pincode',
		'status',
	];

	public function City()
	{
		return $this->belongsTo(City::class, 'city_id', 'id')->withTrashed();
	}

	public function State()
	{
		return $this->belongsTo(State::class, 'state_id', 'id')->withTrashed();
	}

}
