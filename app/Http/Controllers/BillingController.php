<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Customer;
use Cavidel\Billing;
use Cavidel\Location;
use Cavidel\CashEntry;
use Cavidel\ProductCategory;
use Cavidel\BuildingProject;
use Cavidel\ProductService;
use Cavidel\Staff;
use Illuminate\Http\Request;
use Cavidel\ProductDeleted;
use Cavidel\Title;
use Cavidel\Nationality;
use Cavidel\Gender;
use Cavidel\MaritalStatus;
use Cavidel\PaymentPlan;
use Cavidel\HouseType;
use Cavidel\Config;

class BillingController extends Controller
{
    public function search_client()
    {
        $user               = auth()->user();
        $product_categories = ProductCategory::orderBy('ProductCategory')->get();
        $locations          = Location::orderBy('Location')->get();
        $titles             = Title::orderBy('Title')->get();
        $nationalities      = Nationality::orderBy('Nationality')->get();
        $genders            = Gender::all();
        $maritalstatuses    = MaritalStatus::orderBy('MaritalStatus')->get();
        $staff              = Staff::where('CompanyID', $user->CompanyID)->get();
        $paymentplans       = PaymentPlan::orderBy('PaymentPlan')->get();
        $housetypes         = HouseType::orderBy('HouseType')->get();
        return view('billings.search_client', compact('product_categories', 'locations', 'titles', 'nationalities', 'genders', 'maritalstatuses', 'staff', 'paymentplans', 'housetypes'));
    }

    public function client_search(Request $request)
    {
        $product_categories = ProductCategory::orderBy('ProductCategory')->get();
        $locations          = Location::orderBy('Location')->get();
        $client_name        = $request->client_name;
        $results            = Customer::where('Customer', 'like', '%' . $client_name . '%')->get();
        $user               = auth()->user();
        $titles             = Title::orderBy('Title')->get();
        $nationalities      = Nationality::orderBy('Nationality')->get();
        $genders            = Gender::all();
        $maritalstatuses    = MaritalStatus::orderBy('MaritalStatus')->get();
        $staff              = Staff::where('CompanyID', $user->CompanyID)->get();
        $paymentplans       = PaymentPlan::orderBy('PaymentPlan')->get();
        $housetypes         = HouseType::orderBy('HouseType')->get();
        return view('billings.search_result', compact('results', 'product_categories', 'locations', 'titles', 'nationalities', 'countries', 'genders', 'maritalstatuses', 'staff', 'paymentplans', 'housetypes'));
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
        // $files = [];

        // foreach (\Illuminate\Support\Facades\Storage::files('public/course_images') as $filename) {

        //     array_push($files, str_replace('public/course_images/', '', $filename));
        // }
        $client_id          = $id;
        $code               = $billcode;
        $client_details     = \DB::table('tblCustomer')->where('CustomerRef', $client_id)->first();
        $product_categories = ProductCategory::all();
        $bill_items         = Billing::where('GroupID', $code)->get();
        $id                 = Auth()->user()->id;
        $staff_id           = Staff::select('StaffRef')->where('UserID', $id)->first();
        $today              = \Carbon\Carbon::now();
        $date               = $today->toDateString();
        $processedbills     = \DB::table('tblBilling')
            ->where('ClientID', $client_id)
            ->where('GroupID', $billcode)
            ->get();
        $outstanding             = \DB::select("EXEC procFinalBillAmount '$code'");
        $bill_details_collection = collect($processedbills);
        $payment_plans           = \DB::table('tblPymtPlan')->get();
        $bill_amount             = $bill_details_collection->sum('Price');
        $amount_os               = $bill_details_collection->sum('AmountOutstanding');

        $debit_acct_details = collect(\DB::select("SELECT GLRef, tblGL.Description  + ' - ' +  tblCurrency.Currency + CONVERT(varchar, format(tblGL.BookBalance,'#,##0.00'))
                         AS CUST_ACCT
                            FROM            tblGL INNER JOIN
                         tblAccountType ON tblGL.AccountTypeID = tblAccountType.AccountTypeRef INNER JOIN
                         tblCustomer ON tblGL.CustomerID = tblCustomer.CustomerRef INNER JOIN
                         tblCurrency ON tblGL.CurrencyID = tblCurrency.CurrencyRef INNER JOIN
                         tblBranch ON tblGL.BranchID = tblBranch.BranchRef
                         Where tblGL.AccountTypeID = ?
                         Order By tblGL.Description", [54]));
        $configs = Config::first();
        $gl      = \DB::table('tblCustomer')
            ->select('GLRef')
            ->join('tblGL', 'tblCustomer.CustomerRef', '=', 'tblGl.CustomerID')
            ->where('tblCustomer.CustomerRef', $client_id)
            ->first();

        return view('billings.notification_Billing', compact('client_details', 'date', 'product_categories', 'bill_items', 'staff_id', 'code', 'bill_amount', 'amount_os', 'debit_acct_details', 'outstanding', 'payment_plans', 'configs', 'gl', 'files'));
    }

    public function get_product($cat_id)
    {
        $products = \DB::select("EXEC procProductServices $cat_id");
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
        // dd($request->all());
        $productCode = \DB::table('tblProductService')->select('ProductCode')->where('ProductServiceRef', $request->InvItemID)->first();

        $save_bill = new Billing($request->except(['CategoryID', 'Product', 'TotalPrice']));

        if ($save_bill->save()) {
            return redirect()->back()->with('success', 'Product was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Title failed to save');
        }
    }

    public function bill($client_id, $code)
    {
        $client_id       = $client_id;
        $code            = $code;
        $user_id         = \Auth::user()->id;
        $coy             = Staff::where('UserID', $user_id)->first();
        $company_id      = $coy->CompanyID;
        $company_details = \DB::table('tblCompany')->where('CompanyRef', $company_id)->first();
        $client_details  = Customer::where('CustomerRef', $client_id)->first();
        $bill_header     = Billing::select('BillingDate')->first();
        $total_bill      = Billing::where('GroupID', $code)->sum('Price');
        $bills           = Billing::where('GroupID', $code)->get();
        $tax             = ($total_bill / 100) * 5;
        return view('billings.bill', compact('client_details', 'code', 'bill_header', 'total_bill', 'company_details', 'bills', 'tax'));
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

    public function productdeletion(Request $request)
    {
        $deleteproduct = new ProductDeleted($request->all());
        $this->validate($request, [
            'Comment' => 'required',
        ]);

        if ($deleteproduct->save()) {
            $id          = $request->BillingID;
            $productname = $request->ProductService;
            $deletedid   = $request->DeletedBy;
            $staffname   = Staff::where('UserID', $deletedid)->first();
            // $firstname     = $staffname->FirstName;
            // $lastname      = $staffname->LastName;
            // $middlename    = $staffname->MiddleName;
            $billcode       = $request->BillCode;
            $comment        = $request->Comment;
            $customer_names = \DB::table('tblCustomer')
                ->select('Customer')
                ->where('CustomerRef', $request->PatientRef)
                ->first();

            $deletion = \DB::statement("EXEC procDeleteBilling $id, '$billcode'");
            // $deletion    = \DB::table('tblBilling')->where('BillingID', '=', $id)->delete();

            // Mail::to(['adefayiga@gmail.com'])->send(new ProductDeletion($billcode, $productname, $firstname, $lastname, $middlename, $patient_name, $comment));

            return redirect()->back()->with('success', 'Product deleted Successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Product deletion was not successful');
        }
    }

    public function bill_payment(Request $request)
    {
        $billcode   = $request->Reference1;
        $userid     = \Auth::user()->id;
        $getdetails = \DB::table('tblBilling')
            ->select('ClientID')
            ->where('GroupID', $billcode)
            ->first();
        $customer_ref = $getdetails->ClientID;
        $trans        = \DB::statement("EXEC procPostBilling '$billcode', $userid ");
        if ($trans) {
            $cashentries                = new CashEntry($request->all());
            $cashentries->PostingTypeID = 16;
            $cashentries->PostFlag      = 1;
            if ($cashentries->save()) {
                return redirect()->route('NotificationBilling', [$customer_ref, $billcode])->with('success', 'Bill Posting was successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Cash Entry failed to save');
            }
        }
    }

    public function get_client_details_onrequest($id)
    {
        $ref            = $id;
        $client_details = Customer::where('CustomerRef', $ref)->first();
        return response()->json($client_details)->setStatusCode(200);
    }

    public function submit_edited_client_data(Request $request)
    {
        $id      = $request->CustomerRef;
        $details = Customer::where('CustomerRef', $id)->first();
        $details->update($request->except(['_token', '_method']));
        return response($content = 'Updated Successfully', $status = 200);
    }
}
