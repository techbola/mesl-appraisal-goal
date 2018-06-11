<?php

namespace Cavidel\Http\Controllers;

use Cavidel\ProductService;
use Cavidel\Staff;
use Auth;
use Illuminate\Http\Request;

class ProductServiceController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'Price' => 'required',
        ]);

        $user_id  = auth()->user()->id;
        $staff_id = Staff::select('StaffRef')->where('UserID', $user_id)->first();

        $product            = new ProductService($request->all());
        $product->EnteredBy = $staff_id->StaffRef;
        if ($product->save()) {
            return redirect()->route('SearchClient')->with('success', 'Product or Service was created successfully');
        } else {
            return redirect()->back()->with('error', 'The Product or Service could not be created at this time.');
        }
    }
}
