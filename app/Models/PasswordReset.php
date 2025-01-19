<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class PasswordReset extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;

	protected $table = 'password_resets';

	protected $fillable = [
		'token',
		'email',
	];


}
