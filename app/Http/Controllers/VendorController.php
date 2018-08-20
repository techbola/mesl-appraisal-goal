<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Vendor;
use Cavidel\Currency;
use Cavidel\Staff;
use Cavidel\Billing;
use Cavidel\BillingVendor;
use Illuminate\Http\Request;
use Cavidel\ProductService;
use Cavidel\ProductCategory;
use Cavidel\BillNarration;
use Cavidel\PaymentPlan;
use Cavidel\PymtPlan;
use Cavidel\Config;
use Cavidel\PlanOption;
use Cavidel\Brand;
use Cavidel\Project;

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

    public function new_bill(Request $request)
    {
        $id    = $request->vendor_id;
        $trans = \DB::statement("EXEC procInsertBillVendorCode $id");
        if ($trans) {

            $billCode = \DB::select('SELECT BillCode FROM  tblBillVendorCode WHERE (BillCodeRef =              (SELECT MAX(BillCodeRef) AS Expr1             FROM  tblBillVendorCode AS tblBillCode_1             WHERE (VendorID = ?)             GROUP BY VendorID))', [$id]);

            return redirect()->route('VendorNotificationBilling', [$id, $billCode[0]->BillCode])->with('success', 'New Bill Code was Created Successfully');
        } else {
            return redirect()->back()->with('error', 'New Bill Code cannot be created');
        }
    }

    public function view_bill($id)
    {
        $bill_id        = $id;
        $client_details = Vendor::where('VendorRef', $bill_id)->first();
        $bill_details   = BillingVendor::select('GroupID', 'BillingDate')
            ->where('ClientID', $bill_id)
            ->groupBy('GroupID', 'BillingDate')
            ->orderBy('BillingDate', 'DESC')
            ->get();
        return view('vendors.view_bill', compact('client_details', 'bill_details'));
    }

    public function save_bill_item(Request $request)
    {
        // dd($request->all());

        $save_bill = new BillingVendor($request->except(['CategoryID', 'Product', 'TotalPrice']));

        if ($save_bill->save()) {
            return redirect()->back()->with('success', 'Action was successfull');
        } else {
            return redirect()->back()->withInput()->with('error', 'Title failed to save');
        }
    }

    public function bill_payment(Request $request)
    {
        $billcode   = $request->Reference1;
        $userid     = \Auth::user()->id;
        $getdetails = \DB::table('tblBilling_Vendor')
            ->select('ClientID')
            ->where('GroupID', $billcode)
            ->first();
        $customer_ref = $getdetails->ClientID;
        $trans        = \DB::statement("EXEC procPostBillingVendor '$billcode', $userid ");
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
            $customer_names = \DB::table('tblVendors')
                ->select('Vendor')
                ->where('VendorRef', $request->PatientRef)
                ->first();

            $deletion = \DB::statement("EXEC procDeleteBillingVendor $id, '$billcode'");
            // $deletion    = \DB::table('tblBilling')->where('BillingID', '=', $id)->delete();

            // Mail::to(['adefayiga@gmail.com'])->send(new ProductDeletion($billcode, $productname, $firstname, $lastname, $middlename, $patient_name, $comment));

            return redirect()->back()->with('success', 'Product deleted Successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Product deletion was not successful');
        }
    }

    public function notification_bill($id, $billcode)
    {
        $client_id          = $id;
        $code               = $billcode;
        $client_details     = \DB::table('tblVendors')->where('VendorRef', $client_id)->first();
        $product_categories = ProductCategory::all();
        $bill_items         = BillingVendor::where('GroupID', $code)
        // ->leftJoin('tblPymtPlan', 'tblBilling_Vendor.PymtID', '=', 'tblPymtPlan.PlanRef')
        // ->leftJoin('tblPlanOption', 'tblBilling_Vendor.OptionID', '=', 'tblPlanOption.OptionRef')
            ->get();
        $id             = Auth()->user()->id;
        $staff_id       = Staff::select('StaffRef')->where('UserID', $id)->first();
        $today          = \Carbon\Carbon::now();
        $date           = $today->toDateString();
        $processedbills = \DB::table('tblBilling_Vendor')
            ->where('ClientID', $client_id)
            ->where('GroupID', $billcode)
            ->get();
        $outstanding             = \DB::select("EXEC procFinalBillAmount '$code'");
        $bill_details_collection = collect($processedbills);
        $payment_plans           = PymtPlan::all();
        $bill_amount             = $bill_details_collection->sum('Price');
        $amount_os               = $bill_details_collection->sum('AmountOutstanding');
        $options                 = PlanOption::all();
        $bill_narration          = BillNarration::where('BillCode', $code)->first();
        $brands                  = Brand::all();
        $projects                = Project::all();

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

        return view('vendors.notification_Billing', compact('client_details', 'projects', 'brands', 'date', 'product_categories', 'bill_items', 'staff_id', 'code', 'bill_amount', 'amount_os', 'bill_narration', 'debit_acct_details', 'outstanding', 'options', 'payment_plans', 'configs', 'gl', 'files'));
    }

}
