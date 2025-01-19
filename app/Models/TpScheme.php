<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TpScheme extends Model
{
    use HasFactory;
use SoftDeletes;

	protected $fillable = [
		'name',
		'villages',
		'tp_images',
	];
}
