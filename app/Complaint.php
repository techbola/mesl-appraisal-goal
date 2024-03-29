<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = ['id'];

    public function sent()
    {
        return $this->notify_flag;
    }

    public function comments()
    {
        return $this->hasMany(ComplaintComment::class);
    }

    public function category()
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id');
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'LocationRef', 'location_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'ClientRef', 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function complaint_status()
    {
        return $this->belongsTo(ComplaintStatus::class, 'complaint_status_id');
    }

    public function status()
    {
        if ($this->resolved_flag == true) {
            return 'resolved';
        } else {
            return 'pending';
        }

    }

}
