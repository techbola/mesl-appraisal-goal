<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ExamCollation extends Model
{
    protected $table   = 'tblExamCollation';
    protected $guarded = ['ExamCollationRef'];
    public $timestamps = false;
    public $primaryKey = 'ExamCollationRef';

    public function question()
    {
        return $this->belongsTo(Question::class, 'QuestionID');
    }
}
