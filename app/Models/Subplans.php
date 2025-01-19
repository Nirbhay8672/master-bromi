<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subplans extends Model
{
    use HasFactory;
use SoftDeletes;

	protected $fillable = [
		'name',
		'details',
		'price',
		'extra_user_price',
	];
}
