<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    protected $table = 'form_types';
    protected $fillable = [
        'id', 'filed_type','option_type','filed_name','group_name','parent_id','form_id'
    ];
}