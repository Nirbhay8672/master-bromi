<?php

namespace App\Models;

use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class SuperCity extends Model
{
	use HasFactory;
	use SoftDeletes;
	use LogsActivity;


	protected $table = 'super_cities';

	protected $fillable = [
		'name',
		'state_id',
	];

	public function State()
	{
		return $this->belongsTo(State::class, 'state_id', 'id')->withTrashed();
	}

	public function users()
    {
        return $this->hasMany('App\Models\User');
    }
	
    public function areas()
    {
        return $this->hasMany(SuperAreas::class);
    }
}
