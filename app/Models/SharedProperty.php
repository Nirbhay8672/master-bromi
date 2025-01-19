<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharedProperty extends Model
{
	use HasFactory;
	use SoftDeletes;
	protected $table = 'share_property';

	protected $fillable = [
		'user_id',
		'partner_id',
		'property_id',
		'accepted',
	];

	public function Property_details()
	{
		return $this->belongsTo(Properties::class, 'property_id', 'id')->with('Projects')->withTrashed();
	}

	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
	}
	
	public function Partner()
	{
		return $this->belongsTo(User::class, 'partner_id', 'id');
	}
}
