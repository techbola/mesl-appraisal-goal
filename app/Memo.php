<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $guarded = ['id'];

    public function memos()
    {
        return $this->belongsTo(Staff::class);
    }

    public function attachments()
    {
        return $this->hasMany(MemoAttachment::class);
    }

    public function sent()
    {
        return $this->NotifyFlag;
    }

    public function status()
    {
        if ($this->NotifyFlag == 0) {
            return 'Not Sent';
        } elseif ($this->ApproverID == 0) {
            return true;
        } elseif ($this->ApproverID == $this->ApproverID1) {
            return 'With Approver 1 ' . '(' . Staff::where('UserID', $this->ApproverID1)->first()->Fullname . ')';
        } elseif ($this->ApproverID == $this->ApproverID2) {
            return 'With Approver 2 ' . '(' . Staff::where('UserID', $this->ApproverID2)->first()->Fullname . ')';
        } elseif ($this->ApproverID == $this->ApproverID3) {
            return 'With Approver 3 ' . '(' . Staff::where('UserID', $this->ApproverID3)->first()->Fullname . ')';
        } elseif ($this->ApproverID == $this->ApproverID4) {
            return 'With Approver 4 ' . '(' . Staff::where('UserID', $this->ApproverID4)->first()->Fullname . ')';
        }

    }

    public function approvers()
    {
        $approvers_array = [];
        if (!is_null($this->ApproverID1) && $this->ApproverID1 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID1)->first()->Fullname);
        }

        if (!is_null($this->ApproverID2) && $this->ApproverID2 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID2)->first()->Fullname);
        }

        if (!is_null($this->ApproverID3) && $this->ApproverID3 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID3)->first()->Fullname);
        }

        if (!is_null($this->ApproverID4) && $this->ApproverID4 != 0) {
            array_push($approvers_array, Staff::where('UserID', $this->ApproverID4)->first()->Fullname);
        }

        return implode(', ', $approvers_array);
    }

    public function approved()
    {
        if ($this->ApproverID == 0 && $this->ApprovedFlag == true) {
            return true;
        } else {
            return false;
        }
    }

    public function initiator()
    {
        return $this->belongsTo(Staff::class, 'initiator_id', 'StaffRef');
    }

}
