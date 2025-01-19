<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Units extends Model
{
	use HasFactory;
	use LogsActivity;

	protected $table = 'land_units';
	protected $guarded = [];
}
