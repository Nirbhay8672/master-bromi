<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\VendorScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShareProperty extends Model
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
    
    protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendorScope);

		self::created(function ($model) {
			$data = [];
			$data['user_id'] = Session::get('parent_id');
			$data['action_by'] = Auth::User()->id;
			$data['action_on'] = $model->id;
			$data['action'] = 'created';
			PropertyReport::create($data);
		});

		self::updated(function ($model) {
			$data = [];
			$data['user_id'] = Session::get('parent_id');
			$data['action_by'] = Auth::User()->id;
			$data['action_on'] = $model->id;
			$data['action'] = 'updated';
			PropertyReport::firstOrCreate($data);
		});
	}

	public function Property_details()
	{
		return $this->belongsTo(Properties::class, 'property_id', 'id')->with('Projects')->withTrashed();
	}

	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
	}
}
