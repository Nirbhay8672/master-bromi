<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LeadProgress extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_progress';
    protected $guarded = [];

    protected $appends = ['next_follow_up_date', 'next_follow_up_time'];

    public function getNextFollowUpDateAttribute()
    {
        if (!empty($this->nfd)) {
            # code...
            return Carbon::parse($this->nfd)->format('Y-m-d');
        }
        return null;
    }
    public function getNextFollowUpTimeAttribute()
    {
        if (!empty($this->nfd)) {
            # code...
            return Carbon::parse($this->nfd)->format('H:i');
        }
        return null;
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Lead()
    {
        return $this->belongsTo(BromiEnquiry::class, 'lead_id', 'id');
    }
}
