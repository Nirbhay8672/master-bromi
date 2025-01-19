<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{
    protected $table = 'form_fields';
    protected $fillable = [
        'id', 'form_id','field_type_id'
    ];
}