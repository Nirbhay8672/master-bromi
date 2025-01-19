<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EnquiryComments extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'enquiry_id',
		'user_id',
		'comment',
	];
	public function User()
	{
		return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
	}

}
