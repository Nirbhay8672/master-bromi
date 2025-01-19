<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rera extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $table = 'rera';

	protected $fillable = [
		'state',
		'district',
		'project_name',
		'promoter_name',
		'reg_no',
	];
}
