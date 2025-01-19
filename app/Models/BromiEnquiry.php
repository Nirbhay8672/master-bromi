<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class BromiEnquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['next_follow_up_date', 'next_follow_up_time'];

    public function getNextFollowUpDateAttribute()
    {
        if (!empty($this->followup_date)) {
            # code...
            return Carbon::parse($this->followup_date)->format('Y-m-d');
        }
        return null;
    }
    public function getNextFollowUpTimeAttribute() {
        if (!empty($this->followup_date)) {
            # code...
            return Carbon::parse($this->followup_date)->format('H:i');
        }
        return null;
    }

    public function User()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    
    public function LeadProgress()
    {
        return $this->hasMany(LeadProgress::class, 'lead_id', 'id')->orderBy('id', 'DESC');
    }
    
    public function activeProgress()
    {
        return $this->hasOne(LeadProgress::class, 'lead_id', 'id')->where('status', 1);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function planInterested()
    {
        return $this->belongsTo(Subplans::class, 'plan_interested_in', 'id');
    }

    public function LeadHistory()
    {
        return $this->hasMany(LeadAssignHistory::class, 'lead_id', 'id');
    }
}
