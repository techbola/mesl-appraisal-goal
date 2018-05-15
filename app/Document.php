<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table   = 'tblDocMgt';
    protected $guarded = ['DocRef'];
    public $timestamps = false;
    public $primaryKey = 'DocRef';

    // public $dates = ['UploadDate', 'LastUpdatedDate'];

    public function assignees_old()
    {
        return $this->hasMany('App\DocAssign', 'DocID', 'DocRef');
    }

    public function assignees()
    {
        return $this->belongsToMany('App\Staff', 'tblDocAssign', 'DocID', 'StaffID');
    }

    public function doctype()
    {
        return $this->belongsTo('App\DocType', 'DocTypeID', 'DocTypeRef');
    }

    public function initiator()
    {
        return $this->belongsTo('App\User', 'Initiator', 'id');
    }

    // sent documnts
    public function sent()
    {
        return $this->NotifyFlag;
    }

    // public function getAssigneeIdsAttribute(){
    //   return $this->assignees()->pluck('Recipient')->toArray();
    // }

}
