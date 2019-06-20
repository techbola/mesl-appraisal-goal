<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppraisalCommentController extends Controller
{

    public function updateAppraisalComment(Request $request)
    {

//        dd($request->all());

        $this->validate($request, [
            'appraiseeComment' => 'required|string',
        ]);

        $appraisal = \MESL\AppraisalComment::find($request->commentID);

//        dd($appraisal);

        $appraisal->appraiseeComment = $request->appraiseeComment;

        $appraisal->save();

        Session::flash('success', 'Comment Updated!.');

        return back();

    }

    public function deleteAppraisalComment($id)
    {
        $appraisal = \MESL\AppraisalComment::find($id);

        $appraisal->delete();

        Session::flash('success', 'Comment Deleted.');

        return back();

    }

}
