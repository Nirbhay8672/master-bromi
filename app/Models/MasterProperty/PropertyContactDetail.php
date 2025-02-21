<?php

namespace App\Models\MasterProperty;

use App\Models\MasterProperty\MasterProperty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyContactDetail extends Model
{
    use HasFactory;

    protected $table = 'property_contact_details';

    protected $guarded = [];

    public function property(): BelongsTo
    {
        return $this->belongsTo(MasterProperty::class);
    }
}
