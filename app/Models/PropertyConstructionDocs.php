<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\VendorScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PropertyConstructionDocs extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'property_construction_docs';
    protected $fillable = [
        'id',
		'user_id',
        'name',
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
}
