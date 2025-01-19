<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DefaultMeasurement extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $table = 'default_measurement';

	protected $fillable = [
		'userid',
		'measure_id',
	];

}
