<?php

namespace App\Models\MasterProperty;

use App\Models\MasterProperty\MasterProperty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyUnitDetail extends Model
{
    use HasFactory;

    protected $table = 'property_unit_details';

    protected $guarded = [];

    protected $casts = [
        'furniture_total' => 'array',
        'facilities' => 'array',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(MasterProperty::class);
    }
}
