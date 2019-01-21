<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class HrInitiatedDocs extends Model
{
    protected $table   = 'tblHrInitiatedDocs';
    protected $guarded = ['DocRef'];
    public $timestamps = false;
    public $primaryKey = 'DocRef';

    // public $dates = ['UploadDate', 'LastUpdatedDate'];

    public function assignees_old()
    {
        return $this->hasMany('MESL\DocAssign', 'DocID', 'DocRef');
    }

    public function assignees()
    {
        return $this->belongsToMany('MESL\Staff', 'tblDocAssign', 'DocID', 'StaffID');
    }

    public function doctype()
    {
        return $this->belongsTo('MESL\DocType', 'DocTypeID', 'DocTypeRef');
    }

    public function initiator()
    {
        return $this->belongsTo('MESL\User', 'Initiator', 'id');
    }

    public function approver()
    {
        return $this->belongsTo('MESL\User', 'ApproverID', 'id');
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
