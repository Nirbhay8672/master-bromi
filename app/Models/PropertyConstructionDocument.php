<?php

namespace App\Models;

use App\Models\MasterProperty\MasterProperty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PropertyConstructionDocument extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(MasterProperty::class);
    } 
}
