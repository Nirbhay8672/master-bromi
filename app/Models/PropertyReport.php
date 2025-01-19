<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;

class PropertyReport extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $table = 'property_report';


	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $fillable = [
		'user_id',
		'action_by',
		'action_on',
		'action',
	];

	public function ActionBy()
	{
		return $this->belongsTo(User::class, 'action_by', 'id')->withTrashed();
	}


	public function Property()
	{
		return $this->belongsTo(Properties::class, 'action_on', 'id')->withTrashed();
	}


}
