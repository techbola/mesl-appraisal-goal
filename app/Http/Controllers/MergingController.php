<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Address1;
use Cavidel\Address2;
use Cavidel\FileUpload;

class MergingController extends Controller
{
    public function get_data_merging()
    {
        $address1s = Address1::where('Status', 0)->get();
        $address2s = Address2::where('Status', 0)->get();
        $merged    = Address2::where('Status', 1)->get();
        return view('merging.data_merging', compact('address1s', 'address2s', 'merged'));
    }

    public function store(Request $request)
    {
        $address1 = $request->address1;
        $address2 = $request->address2;

        if (!is_null($address1) && !is_null($address2)) {
            $address1_data = Address1::where('Ref', $address1)->first();
            $address2_data = Address2::where('Ref', $address2)->first();

            $address2_data->BlockNumber = $address1_data->BlockNumber;
            $address2_data->FlatNumber  = $address1_data->FlatNumber;
            $address2_data->Housename   = $address1_data->HouseName;
            $address2_data->UpdateRef   = $address1;
            $address2_data->Status      = 1;

            $update_data = $address2_data->save();
            if ($update_data) {
                $initial_data = \DB::table('address1')->where('Ref', $address1)->update(['Status' => 1]);
                return redirect()->back()->with('success', 'Data merged successfuly');
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