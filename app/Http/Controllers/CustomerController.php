<?php

namespace App\Http\Controllers;

use App\AccountType;
use App\Country;
use App\Customer;
use App\Gender;
use App\Identification;
use App\MaritalStatus;
use App\Staff;
use Illuminate\Http\Request;

use Auth;
use App\GL;

class CustomerController extends Controller
{

    public function index()
    {
        // $customers = \DB::select("EXEC ProcViewCustomerDetails");
        $customers = Customer::where('CompanyID', $user->staff->CompanyID)->get();

        $accountofficers = Staff::all();
        $genders         = Gender::all();
        $identities      = Identification::all();
        $accounts        = AccountType::all();
        $countries       = Country::orderBy('Country')->get();
        $customers       = Customer::all();
        $maritalstatus   = MaritalStatus::all();

        return view('customers.index', compact('customers', 'accountofficers', 'genders', 'identities', 'maritalstatus', 'accounts', 'countries'));
    }

    public function customerEditList()
    {
        $customers = Customer::all();
        return view('customers.editList', compact('customers'));
    }


    public function create()
    {
        $accountofficers = Staff::all();
        $genders         = Gender::all();
        $identities      = Identification::all();
        $accounts        = AccountType::all();
        $countries       = Country::all();
        $customers       = Customer::all();
        $maritalstatus   = MaritalStatus::all();
        return view('customers.create', compact('customers', 'accountofficers', 'genders', 'identities', 'maritalstatus', 'accounts', 'countries'));
    }


    public function store(Request $request)
    {
        $customer = new Customer($request->all());
        $this->validate($request, [
            'FirstName' => 'required',
            'LastName' => 'required',
        ]);
        if ($request->hasFile('PassportLocation')) {
            $path        = "../public/images/customers/";
            $filename    = $_FILES['PassportLocation']['name'];
            $tmp         = $_FILES['PassportLocation']['tmp_name'];
            $ext         = substr($filename, strpos($filename, '.'));
            $new_name    = time() . $filename;
            $destination = $path . $new_name;
            if (move_uploaded_file($tmp, $destination)) {
                $customer->PassportLocation = $new_name;
                $customer->save();
                return redirect()->route('customers.index')->with('success', 'New Customer was added successfully');
            }
        }
        $customer->CompanyID = auth()->user()->staff->CompanyID;
        $customer->save();
        return redirect()->route('customers.index')->with('success', 'New Customer was added successfully');
    }


    public function show($id)
    {
        $customers = Customer::where('CustomerRef', $id)
            ->leftJoin('tblGender', 'tblCustomer.GenderID', '=', 'tblGender.GenderRef')
            ->leftJoin('tblCountry', 'tblCustomer.NationalityID', '=', 'tblCountry.CountryRef')
            ->leftJoin('tblMaritalStatus', 'tblCustomer.MaritalStatusID', '=', 'tblMaritalStatus.MaritalStatusRef')
            ->leftJoin('tblIdentification', 'tblCustomer.MeansOfID_ID', '=', 'tblIdentification.IdentificationRef')
            ->get();
        return view('customers.show', compact('customers'));
    }


    public function edit($id)
    {
        $accountofficers = Staff::all();
        $genders         = Gender::all();
        $identities      = Identification::all();
        $accounts        = AccountType::all();
        $countries       = Country::all();
        $customers       = Customer::all();
        $maritalstatus   = MaritalStatus::all();
        $customer        = Customer::where('CustomerRef', $id)->first();
        // return dd($TradeRef);
        return view('customers.edit', compact('customer', 'countries', 'accountofficers', 'customers', 'maritalstatus', 'accounts', 'identities', 'genders'));
    }


    public function update(Request $request, $id)
    {
        $customer = \DB::table('tblCustomer')->where('CustomerRef', $id);

        if ($customer->update($request->except(['_token', '_method']))) {
            return redirect()->route('customers.create')->with('success', 'Customer was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Customer failed to update');
        }
    }

    public function accounts_local(){
      $user = Auth::user();
      // $accounts = GL::where('BookBalance', '!=', '0')->where('CustomerID', $user->customer->CustomerRef)->whereIn('AccountTypeID', [5,8,13,16])->get();
      if ($user->hasRole(['Admin', 'staff'])) {
        $accounts = GL::whereIn('AccountTypeID', [5,8,13,16])->get();
      }else{
        $accounts = GL::where('CustomerID', $user->customer->CustomerRef)->whereIn('AccountTypeID', [5,8,13,16])->get();
      }
      $account_types = AccountType::whereIn('AccountTypeRef', [5,8,13,16])->get();

      return view('customers.accounts_local', compact('user', 'accounts', 'account_types'));
    }

    public function get_accounts_local($type, $bank) {
      $user = Auth::user();

      if($type == '0')
        $types = [5,8,13,16];
      else
        $types = [$type];

      if($bank == '0'){
        $bank1 = '%';
      }else{
        $bank1 = '%'.$bank.'%';
      }

      if ($user->hasRole(['Admin', 'staff'])) {
        $accounts = GL::whereIn('AccountTypeID', $types)->where('Description', 'LIKE', $bank1)->get();
      } else{
        $accounts = GL::where('CustomerID', $user->customer->CustomerRef)->whereIn('AccountTypeID', $types)->where('Description', 'LIKE', $bank1)->get();
      }

      return $accounts;
    }


    public function destroy($id)
    {
        //
    }
}
