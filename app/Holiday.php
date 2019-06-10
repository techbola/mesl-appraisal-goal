<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded    = ['HolidayRef'];
    protected $table      = 'tblHoliday';
    protected $primaryKey = 'HolidayRef';
    const CREATED_AT      = 'InputDatetime';
    const UPDATED_AT      = 'ModifiedDatetime';
}
