<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table   = 'tblContacts';
    protected $guarded = ['CustomerRef'];
    public $primaryKey = 'CustomerRef';

    public function projects()
    {
      return $this->hasMany('Cavidel\Project', 'CustomerID');
    }

    public function country()
    {
      return $this->belongsTo('Cavidel\Country', 'CountryID', 'CountryRef');
    }

    public function title()
    {
      return $this->belongsTo('Cavidel\Title', 'TitleID', 'TitleRef');
    }

    public function housetype()
    {
      return $this->belongsTo('Cavidel\HouseType', 'HouseTypeID', 'HouseTypeRef');
    }

    public function call_memos()
    {
      return $this->hasMany('Cavidel\CallMemo', 'CustomerID')->orderBy('MeetingDate', 'desc');
    }

    public function conversations()
    {
      return $this->hasMany('Cavidel\Conversation', 'ContactID')->orderBy('Date', 'desc');
    }
}
