<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class TravelTransport extends Model
{
    protected $table   = 'tblTravelTransporter';
    protected $guarded = ['TransporterRef'];
    public $primaryKey = 'TransporterRef';
    public $timestamps = false;
}
