<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerificationToken extends Model
{
	use HasFactory;
use SoftDeletes;

	//protected $table = ' verification_tokens';

	protected $fillable = [
		'id',
		'token',
		'user_id'
	];
}
