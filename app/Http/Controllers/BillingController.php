<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Client;
use Cavidel\Billing;
use Cavidel\ProductCategory;
use Cavidel\Staff;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function search_client()
    {
        return view('billings.search_client');
    }

    public function client_search(Request $request)
    {
        $client_name = $request->client_name;
        $results     = Client::where('Name', 'like', '%' . $client_name . '%')->get();
        return view('billings.search_result', compact('results'));
    }

    public function new_bill(Request $request)
    {
        $id    = $request->client_id;
        $trans = \DB::statement("EXEC procInsertBillCode $id");
        if ($trans) {

            $billCode = \DB::select('SELECT BillCode FROM  tblBillCode WHERE (BillCodeRef =              (SELECT MAX(BillCodeRef) AS Expr1             FROM  tblBillCode AS tblBillCode_1             WHERE (ClientID = ?)             GROUP BY ClientID))', [$id]);

            return redirect()->route('NotificationBilling', [$id, $billCode[0]->BillCode])->with('success', 'New Bill Code was Created Successfully');
        } else {
            return redirect()->back()->with('error', 'New Bill Code cannot be created');
        }
    }

    public function notification_bill($id, $billcode)
    {
        $client_id          = $id;
        $code               = $billcode;
        $client_details     = \DB::table('tblClients')->where('ClientRef', $client_id)->first();
        $product_categories = ProductCategory::all();
        $bill_items         = Billing::where('GroupID', $code)->get();
        $id                 = Auth()->user()->id;
        $staff_id           = Staff::select('StaffRef')->where('UserID', $id)->first();

        return view('billings.notification_Billing', compact('client_details', 'product_categories', 'bill_items', 'staff_id', 'code'));
    }

    public function get_product($cat_id)
    {
        // $user_id = Auth()->user()->staffId;
        // $user_location = \DB::table('tblStaff')
        // ->select('LocationID')
        // ->where('StaffRef', $user_id)
        // ->first();

        $products = \DB::table('tblProductService')
            ->select('ProductService', 'ProductServiceRef', 'Price')
            ->where('CategoryID', $cat_id)
            ->get();

        return response()->json($products)->setStatusCode(200);
    }

    public function get_price($prod_id)
    {
        $product_price = \DB::table('tblProductService')
            ->select('Price')
            ->where('ProductServiceRef', $prod_id)
            ->first();

        return response()->json($product_price)->setStatusCode(200);
    }

    public function save_bill_item(Request $request)
    {
        $productCode = \DB::table('tblProductService')->select('ProductCode')->where('ProductServiceRef', $request->InvItemID)->first();

        $pro      = $request->Produt_ServiceType;
        $filtered = explode(" / ", $pro);
        $pro      = $filtered[0];

        $save_bill                     = new Billing($request->except(['CategoryID', 'Product', 'TotalPrice']));
        $save_bill->Produt_ServiceType = $pro;
        if ($save_bill->save()) {
            return redirect()->back()->with('success', 'Product was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Title failed to save');
        }
    }

    public function bill($client_id, $code)
    {
        $client_id = $client_id;
        $code      = $code;

        $client_details = Client::where('ClientRef', $client_id)->first();
        $bill_header    = Billing::select('BillingDate')->first();
        $total_bill     = Billing::where('GroupID', $code)->sum('Price');
        $bills          = Billing::where('GroupID', $code)->get();
        return view('billings.bill', compact('client_details', 'code', 'bill_header', 'total_bill', 'bills'));
    }

    public function view_bill($id)
    {
        $bill_id        = $id;
        $client_details = Client::where('ClientRef', $bill_id)->first();
        $bill_details   = Billing::select('GroupID', 'BillingDate')
            ->where('ClientID', $bill_id)
            ->groupBy('GroupID', 'BillingDate')
            ->orderBy('BillingDate', 'DESC')
            ->get();
        return view('billings.view_bill', compact('client_details', 'bill_details'));
    }

}
