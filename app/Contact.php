<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table   = 'tblContacts';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';

    public function projects()
    {
      return $this->hasMany('MESL\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('MESL\Country', 'CountryID', 'CountryRef');
    }

    public function title()
    {
      return $this->belongsTo('MESL\Title', 'TitleID', 'TitleRef');
    }

    public function housetype()
    {
      return $this->belongsTo('MESL\HouseType', 'HouseTypeID', 'HouseTypeRef');
    }

    public function estate()
    {
      return $this->belongsTo('MESL\BuildingProject', 'EstateID', 'BuildingProjectRef');
    }

    public function call_memos()
    {
      return $this->hasMany('MESL\CallMemo', 'CustomerID')->orderBy('MeetingDate', 'desc');
    }

    public function conversations()
    {
      return $this->hasMany('MESL\Conversation', 'ContactID')->orderBy('VisitDate', 'desc');
    }
}
