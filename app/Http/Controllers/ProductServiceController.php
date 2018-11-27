<?php

namespace MESL\Http\Controllers;

use MESL\ProductService;
use MESL\ProductCategory;
use MESL\Product;
use MESL\Location;
use MESL\Staff;
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

    public function product_service()
    {
        $categories = ProductCategory::all();
        $locations  = Location::all();
        $products   = ProductService::all();
        return view('product_service.product_service', compact('categories', 'locations', 'products'));
    }

    public function get_product_and_service(Request $request)
    {
        try {
            \DB::beginTransaction();
            $categoryRef = $request->CategoryID;
            $loc         = $request->LocationID;
            $user_id     = Auth::id();
            if (!empty([$categoryRef, $loc])) {
                $results = \DB::table('tblProductService')
                    ->select('ProductCategory', 'ProductService', 'ProductCode', 'ProductServiceRef')
                    ->join('tblProductCategory', 'tblProductService.CategoryID', '=', 'tblProductCategory.ProductCategoryRef')
                    ->where('CategoryID', $categoryRef)
                    ->where('LocationID', $loc)
                    ->get();
            }

            \DB::commit();
            return response()->json(['data' => $results])->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'Request cannot be processed, Make sure all search critaria are passed.', $status = 'false');
        }
    }

    public function post_new_product(Request $request)
    {
        $user_id    = Auth::id();
        $company_id = Staff::where('UserID', $user_id)->first();
        try {
            \DB::beginTransaction();
            $add_data             = new Product($request->all());
            $add_data->CompanyID  = $company_id->CompanyID;
            $add_data->InputterID = $user_id;
            $add_data->save();
            \DB::commit();
            return response($content = 'successful', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'false');
        }
    }

    public function post_new_category(Request $request)
    {
        $user_id    = Auth::id();
        $company_id = Staff::where('UserID', $user_id)->first();
        try {
            \DB::beginTransaction();
            $add_data             = new ProductCategory($request->all());
            $add_data->CompanyID  = $company_id->CompanyID;
            $add_data->InputterID = $user_id;
            $add_data->save();
            \DB::commit();
            return response($content = 'successful', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'false');
        }
    }

    public function post_new_product_service(Request $request)
    {
        $user_id    = Auth::id();
        $company_id = Staff::where('UserID', $user_id)->first();
        try {
            \DB::beginTransaction();
            $add_data             = new ProductService($request->all());
            $add_data->CompanyID  = $company_id->CompanyID;
            $add_data->InputterID = $user_id;
            $add_data->save();
            \DB::commit();
            return response($content = 'successful', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'false');
        }
    }

    public function product_service_editproduct($id)
    {
        try {
            \DB::beginTransaction();
            $id       = $id;
            $get_data = ProductService::where('ProductServiceRef', $id)->first();
            \DB::commit();
            return response()->json($get_data)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'false');
        }
    }

    public function post_edited_product(Request $request)
    {
        try {
            \DB::beginTransaction();
            $id   = $request->ProductServiceRef;
            $data = ProductService::where('ProductServiceRef', $id);
            $data->update($request->except(['_token', '_method', 'ProductServiceRef']));
            \DB::commit();
            return response($content = 'successful', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'false');
        }
    }

}
