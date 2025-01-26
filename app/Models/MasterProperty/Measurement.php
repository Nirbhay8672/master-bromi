<?php

namespace App\Models\MasterProperty;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $table = 'measurements';
    
    const MEASUREMENT_TYPE = [
        '1' => 'Area',
        '2' => 'Height',
        'area' => '1',
        'height' => '2',
    ];
}
