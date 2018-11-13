<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table   = 'tblContacts';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';

    public function projects()
    {
      return $this->hasMany('Cavi\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('Cavi\Country', 'CountryID', 'CountryRef');
    }

    public function title()
    {
      return $this->belongsTo('Cavi\Title', 'TitleID', 'TitleRef');
    }

    public function housetype()
    {
      return $this->belongsTo('Cavi\HouseType', 'HouseTypeID', 'HouseTypeRef');
    }

    public function estate()
    {
      return $this->belongsTo('Cavi\BuildingProject', 'EstateID', 'BuildingProjectRef');
    }

    public function call_memos()
    {
      return $this->hasMany('Cavi\CallMemo', 'CustomerID')->orderBy('MeetingDate', 'desc');
    }

    public function conversations()
    {
      return $this->hasMany('Cavi\Conversation', 'ContactID')->orderBy('VisitDate', 'desc');
    }
}
