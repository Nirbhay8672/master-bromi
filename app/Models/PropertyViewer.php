<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyViewer extends Model
{
	use HasFactory;
use SoftDeletes;

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $table = 'property_viewer';


	protected $fillable = [
		'user_id',
		'property_id',
		'visited_by',
	];

	public function Employee()
	{
		return $this->belongsTo(User::class, 'visited_by', 'id')->withTrashed();
	}

	public function Property()
	{
		return $this->belongsTo(Properties::class, 'property_id', 'id')->withTrashed();
	}

}
