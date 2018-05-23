<?php

namespace Cavidel;

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
        return $this->hasMany('Cavidel\DocAssign', 'DocID', 'DocRef');
    }

    public function assignees()
    {
        return $this->belongsToMany('Cavidel\Staff', 'tblDocAssign', 'DocID', 'StaffID');
    }

    public function doctype()
    {
        return $this->belongsTo('Cavidel\DocType', 'DocTypeID', 'DocTypeRef');
    }

    public function initiator()
    {
        return $this->belongsTo('Cavidel\User', 'Initiator', 'id');
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
