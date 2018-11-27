<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Address1;
use MESL\Address2;
use MESL\MergedRecord;
use MESL\FileUpload;

class MergingController extends Controller
{
    public function get_data_merging()
    {
        $address1s = Address1::where('Status', 0)->get();
        $address2s = Address2::where('Status', 0)->get();
        $merged    = MergedRecord::all();
        return view('merging.data_merging', compact('address1s', 'address2s', 'merged'));
    }

    public function store(Request $request)
    {
        $address1 = $request->address1;
        $address2 = $request->address2;

        if (!is_null($address1) && !is_null($address2)) {
            $address1_data = Address1::where('Ref', $address1)->first();
            $address2_data = Address2::where('Ref', $address2)->first();

            $new_record = new MergedRecord;

            $new_record->Allotee   = $address1_data->Allotee;
            $new_record->EstateNo  = $address1_data->EstateNo;
            $new_record->BlockNo   = $address1_data->BlockNo;
            $new_record->Unit      = $address1_data->Unit;
            $new_record->FileNo    = $address2_data->FileNo;
            $new_record->HouseType = $address2_data->HouseType;

            $update_data = $new_record->save();
            if ($update_data) {
                $initial_data1 = \DB::table('address1')->where('Ref', $address1)->update(['Status' => 1]);
                $initial_data2 = \DB::table('address2')->where('Ref', $address2)->update(['Status' => 1]);
                return 'done';
            }
        } else {
            return redirect()->back()->with('error', 'Data cannot be matched because data where not choosen properly');
        }
    }

    public function fileupload()
    {
        return view('merging.file_uploading');
    }

    public function store_files(Request $request)
    {
        if ($request->hasFile('file1') || $request->hasFile('file2') || $request->hasFile('file3') || $request->hasFile('file4') || $request->hasFile('file5')) {

            $file = new FileUpload;

            if ($request->hasFile('file1')) {
                $filenamewithextension = $request->file('file1')->getClientOriginalName();
                $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension             = $request->file('file1')->getClientOriginalExtension();
                $filenametostore       = str_slug($filename) . time() . '.' . $extension;
                $saveFile              = $request->file('file1')->storeAs('UploadedFile', $filenametostore);
                $file->file1           = $filenametostore;
                $file->save();
            }if ($request->hasFile('file2')) {
                $filenamewithextension = $request->file('file2')->getClientOriginalName();
                $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension             = $request->file('file2')->getClientOriginalExtension();
                $filenametostore       = str_slug($filename) . time() . '.' . $extension;
                $saveFile              = $request->file('file2')->storeAs('UploadedFile', $filenametostore);
                $file->file2           = $filenametostore;
                $file->save();
            }if ($request->hasFile('file3')) {
                $filenamewithextension = $request->file('file3')->getClientOriginalName();
                $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension             = $request->file('file3')->getClientOriginalExtension();
                $filenametostore       = str_slug($filename) . time() . '.' . $extension;
                $saveFile              = $request->file('file3')->storeAs('UploadedFile', $filenametostore);
                $file->file3           = $filenametostore;
                $file->save();
            }if ($request->hasFile('file4')) {
                $filenamewithextension = $request->file('file4')->getClientOriginalName();
                $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension             = $request->file('file4')->getClientOriginalExtension();
                $filenametostore       = str_slug($filename) . time() . '.' . $extension;
                $saveFile              = $request->file('file4')->storeAs('UploadedFile', $filenametostore);
                $file->file4           = $filenametostore;
                $file->save();
            }if ($request->hasFile('file5')) {
                $filenamewithextension = $request->file('file5')->getClientOriginalName();
                $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension             = $request->file('file5')->getClientOriginalExtension();
                $filenametostore       = str_slug($filename) . time() . '.' . $extension;
                $saveFile              = $request->file('file5')->storeAs('UploadedFile', $filenametostore);
                $file->file5           = $filenametostore;
                $file->save();
            }
            return redirect()->back()->with('success', 'Some files were uploaded successfully');

        } else {
            return redirect()->back()->with('error', 'No file is uploaded');
        }
    }
}
