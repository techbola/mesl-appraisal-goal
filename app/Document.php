<?php

namespace Cavi;

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
        return $this->hasMany('Cavi\DocAssign', 'DocID', 'DocRef');
    }

    public function assignees()
    {
        return $this->belongsToMany('Cavi\Staff', 'tblDocAssign', 'DocID', 'StaffID');
    }

    public function doctype()
    {
        return $this->belongsTo('Cavi\DocType', 'DocTypeID', 'DocTypeRef');
    }

    public function initiator()
    {
        return $this->belongsTo('Cavi\User', 'Initiator', 'id');
    }

    public function approver()
    {
        return $this->belongsTo('Cavi\User', 'ApproverID', 'id');
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
