<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Litigation extends Model
{
    protected $table      = 'tblLitigation';
    protected $guarded    = ['LitigationRef'];
    protected $primaryKey = 'LitigationRef';

    public function comments()
    {
        return $this->HasMany(LitigationStatus::class, 'LitigationID');
    }

    public function court()
    {
        return $this->belongsTo(Court::class, 'CourtID');
    }

    public function readable_status()
    {
        if ($this->Status == 0) {
            return '<label class="label label-default">Pending</label>';
        } else {
            return '<label class="label label-success">Completed</label>';
        }
    }

    public function files()
    {
        return $this->hasMany(LitigationFile::class, 'LitigationID', 'LitigationRef')->orderBy('created_at', 'desc');
    }
}
