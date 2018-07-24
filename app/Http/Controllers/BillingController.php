<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Customer;
use Cavidel\Billing;
use Cavidel\Location;
use Cavidel\ProductCategory;
use Cavidel\ProductService;
use Cavidel\Staff;
use Illuminate\Http\Request;

use Cavidel\Title;
use Cavidel\Nationality;
use Cavidel\Gender;
use Cavidel\MaritalStatus;
use Cavidel\PaymentPlan;
use Cavidel\HouseType;

class BillingController extends Controller
{
    public function search_client()
    {
        $user = auth()->user();
        $product_categories = ProductCategory::orderBy('ProductCategory')->get();
        $locations          = Location::orderBy('Location')->get();
        $titles = Title::orderBy('Title')->get();
        $nationalities = Nationality::orderBy('Nationality')->get();
        $genders = Gender::all();
        $maritalstatuses = MaritalStatus::orderBy('MaritalStatus')->get();
        $staff = Staff::where('CompanyID', $user->CompanyID)->get();
        $paymentplans = PaymentPlan::orderBy('PaymentPlan')->get();
        $housetypes = HouseType::orderBy('HouseType')->get();
        return view('billings.search_client', compact('product_categories', 'locations', 'titles', 'nationalities', 'genders', 'maritalstatuses', 'staff', 'paymentplans', 'housetypes'));
    }

    public function client_search(Request $request)
    {
        $product_categories = ProductCategory::orderBy('ProductCategory')->get();
        $locations          = Location::orderBy('Location')->get();
        $client_name        = $request->client_name;
        $results            = Customer::where('Customer', 'like', '%' . $client_name . '%')->get();
        // dd($results[0]->CustomerRef);

        $user = auth()->user();
        $titles = Title::orderBy('Title')->get();
        $nationalities = Nationality::orderBy('Nationality')->get();
        $genders = Gender::all();
        $maritalstatuses = MaritalStatus::orderBy('MaritalStatus')->get();
        $staff = Staff::where('CompanyID', $user->CompanyID)->get();
        $paymentplans = PaymentPlan::orderBy('PaymentPlan')->get();
        $housetypes = HouseType::orderBy('HouseType')->get();
        return view('billings.search_result', compact('results', 'product_categories', 'locations', 'titles','nationalities', 'countries', 'genders', 'maritalstatuses', 'staff', 'paymentplans', 'housetypes'));
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
        $client_details     = \DB::table('tblCustomer')->where('CustomerRef', $client_id)->first();
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

        $products = \DB::select ("EXEC procProductServices $cat_id");
        // \DB::table('tblProductService')
        //     ->select('ProductService', 'ProductServiceRef', 'Price')
        //     ->where('CategoryID', $cat_id)
        //     ->get();

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

        $client_details = Customer::where('CustomerRef', $client_id)->first();
        $bill_header    = Billing::select('BillingDate')->first();
        $total_bill     = Billing::where('GroupID', $code)->sum('Price');
        $bills          = Billing::where('GroupID', $code)->get();
        $tax            = ($total_bill / 100) * 5;
        return view('billings.bill', compact('client_details', 'code', 'bill_header', 'total_bill', 'bills', 'tax'));
    }

    public function view_bill($id)
    {
        $bill_id        = $id;
        $client_details = Customer::where('CustomerRef', $bill_id)->first();
        $bill_details   = Billing::select('GroupID', 'BillingDate')
            ->where('ClientID', $bill_id)
            ->groupBy('GroupID', 'BillingDate')
            ->orderBy('BillingDate', 'DESC')
            ->get();
        return view('billings.view_bill', compact('client_details', 'bill_details'));
    }

}
