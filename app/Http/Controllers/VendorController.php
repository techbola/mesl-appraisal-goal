<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Vendor;
use Cavidel\Currency;
use Cavidel\Staff;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function search_vendors()
    {
        $currencies = Currency::all();
        $vendors    = Vendor::all();
        return view('company_vendors.search_vendors', compact('currencies', 'vendors'));
    }

    public function search_company_vendor(Request $request)
    {
        $search_data = $request->Vendor;
        $results     = Vendor::where('Vendor', 'like', '%' . $search_data . '%')
            ->get();
        return view('company_vendors.search_result', compact('results'));
    }

    public function submit_vendor(Request $request)
    {
        $user_id               = \Auth::id();
        $staff_details         = Staff::where('UserID', $user_id)->first();
        $post_data             = new Vendor($request->all());
        $post_data->CompanyID  = $staff_details->CompanyID;
        $post_data->InputterID = $user_id;
        $post_data->save();
        return response($content = 'Vendor Saved Successfully', $status = 200);
    }

}
