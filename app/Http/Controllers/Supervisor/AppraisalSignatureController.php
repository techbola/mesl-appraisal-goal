<?php

namespace MESL\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use MESL\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AppraisalSignatureController extends Controller
{

    public function updateAppraisalSign(Request $request)
    {

        $this->validate($request, [
            'appraiseeSign' => 'required|image',
        ]);

        $appraisal = \MESL\AppraisalSignature::find($request->signatureID);

        // Get image file
        $image = $request->file('appraiseeSign');
        // Make a image name based on user name and current timestamp
        $name = str_slug($request->input('appraiseeSign')).'_'.time();
        // Define folder path
        $folder = '/uploads/appraisals/';
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        // Upload image
        $appraisee_sign = $this->uploadOne($image, $folder, 'public', $name);

//        dd($filePath);

        $appraisal->appraiseeSign = $filePath;
        $appraisal->save();

        Session::flash('success', 'Signature Updated!.');

        return back();

    }

    public function deleteAppraisalSignature($id)
    {
        $appraisal = \MESL\AppraisalSignature::find($id);

        $appraisal->delete();

        Session::flash('success', 'Signature Deleted.');

        return back();

    }

}
