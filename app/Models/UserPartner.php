<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserPartner extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $table = 'user_partners';

	protected $primaryKey = 'id';
	protected $fillable = [
		'property_id',
		'user_id',
	];
}

