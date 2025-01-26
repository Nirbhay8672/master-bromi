<?php

namespace App\Models\MasterProperty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyAreaSize extends Model
{
    use HasFactory;

    protected $table = 'property_area_size';

    protected $guarded = [];

   public const SIZE_AREA_TYPE = [
        '1' => 'Carpet Area,',
        '2' => 'Ceiling Height,',
        '3' => 'Salable Area,',
        '4' => 'Terrace Carpet Area,',
        '5' => 'Terrace Salable Area,',
        'carpet_area' => '1',
        'ceiling_height' => '2',
        'salable_area' => '3',
        'terrace_carpet_area' => '4',
        'terrace_salable_area' => '5', 
   ]; 

   public function property(): BelongsTo
   {
       return $this->belongsTo(MasterProperty::class);
   }

   public function measurement(): BelongsTo
   {
       return $this->belongsTo(Measurement::class);
   }
}
