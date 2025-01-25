<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected static $recordEvents = ['created','updated','deleted'];
	protected static $logAttributes = ['name'];

	protected $table = 'city';

	protected $fillable = [
		'user_id',
		'name',
		'state_id',
	];

	public function State()
	{
		return $this->belongsTo(State::class, 'state_id', 'id')->withTrashed();
	}

	public function localities() : HasMany
	{
		return $this->hasMany(Areas::class, 'city_id');
	}

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
