<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class State extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected static $recordEvents = ['created','updated','deleted'];
	protected static $logAttributes = ['name'];

	protected $table = 'state';

	protected $guarded = [];

	public function cities()
	{
		return $this->hasMany(SuperCity::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
