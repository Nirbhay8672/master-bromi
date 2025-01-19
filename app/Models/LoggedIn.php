<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoggedIn extends Model
{
	use HasFactory;
use SoftDeletes;

	protected $table = 'loggedin';

	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);
	}

	protected $fillable = [
		'user_id',
		'employee_id',
		'succeed',
		'ipaddress',
	];

	public function User()
	{
		return $this->belongsTo(User::class, 'employee_id', 'id')->withTrashed();
	}

}
