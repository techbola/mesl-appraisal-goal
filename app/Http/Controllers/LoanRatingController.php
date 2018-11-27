<?php

namespace MESL\Http\Controllers;
use MESL\Gender;
use MESL\LoanRatingOption;
use MESL\LoanRating;
use MESL\Country;
use MESL\Customer;

use Illuminate\Http\Request;

class LoanRatingController extends Controller
{

  public function index()
  {
    $ratings = LoanRating::all();

    $Rate = LoanRatingOption::where('Slug', 'Rate')->first();

    return view('loan_rating.index', compact('ratings', 'Rate'));
  }

  public function view($id)
  {
    $rating = LoanRating::find($id);

    return view('loan_rating.view', compact('rating', 'genders', 'countries'));
  }

  public function create()
  {
    $genders = Gender::all();
    $countries = Country::orderBy('Country')->get();
    $customers = Customer::orderBy('Customer')->get();

    $BusinessLine = LoanRatingOption::where('Slug', 'BusinessLine')->first();
    $OfficeAddress = LoanRatingOption::where('Slug', 'OfficeAddress')->first();
    $ResidentialAddress = LoanRatingOption::where('Slug', 'ResidentialAddress')->first();
    $Purpose = LoanRatingOption::where('Slug', 'Purpose')->first();
    $LoanType = LoanRatingOption::where('Slug', 'LoanType')->first();
    $Period = LoanRatingOption::where('Slug', 'Period')->first();
    $Rate = LoanRatingOption::where('Slug', 'Rate')->first();
    $BorrowersCheques = LoanRatingOption::where('Slug', 'BorrowersCheques')->first();
    $GuarantorsCheques = LoanRatingOption::where('Slug', 'GuarantorsCheques')->first();
    $AdditionalIncome = LoanRatingOption::where('Slug', 'AdditionalIncome')->first();
    $DeedOfMortgage = LoanRatingOption::where('Slug', 'DeedOfMortgage')->first();
    $VehicleAgreement = LoanRatingOption::where('Slug', 'VehicleAgreement')->first();
    $StockHypothecation = LoanRatingOption::where('Slug', 'StockHypothecation')->first();
    $BankGuarantee = LoanRatingOption::where('Slug', 'BankGuarantee')->first();
    $ShareCertificate = LoanRatingOption::where('Slug', 'ShareCertificate')->first();
    $DepositsCertificate = LoanRatingOption::where('Slug', 'DepositsCertificate')->first();
    $CreditSearchReport = LoanRatingOption::where('Slug', 'CreditSearchReport')->first();
    $PaymentDefault = LoanRatingOption::where('Slug', 'PaymentDefault')->first();
    $FundDiversion = LoanRatingOption::where('Slug', 'FundDiversion')->first();
    $RepaymentPrimary = LoanRatingOption::where('Slug', 'RepaymentPrimary')->first();
    $RepaymentSecondary = LoanRatingOption::where('Slug', 'RepaymentSecondary')->first();
    $RepaymentOthers = LoanRatingOption::where('Slug', 'RepaymentOthers')->first();
    $HasJob = LoanRatingOption::where('Slug', 'HasJob')->first();
    $SecuritySufficient = LoanRatingOption::where('Slug', 'SecuritySufficient')->first();
    $InformationConsistent = LoanRatingOption::where('Slug', 'InformationConsistent')->first();
    $PurposeValue = LoanRatingOption::where('Slug', 'PurposeValue')->first();
    $JobExperience = LoanRatingOption::where('Slug', 'JobExperience')->first();

    return view('loan_rating.create', compact('customers', 'genders', 'countries', 'BusinessLine', 'OfficeAddress', 'ResidentialAddress', 'Purpose', 'LoanType', 'Period', 'Rate', 'BorrowersCheques', 'GuarantorsCheques', 'AdditionalIncome', 'DeedOfMortgage', 'VehicleAgreement', 'StockHypothecation', 'BankGuarantee', 'ShareCertificate', 'DepositsCertificate', 'CreditSearchReport', 'PaymentDefault', 'FundDiversion', 'RepaymentPrimary', 'RepaymentSecondary', 'RepaymentOthers', 'HasJob', 'SecuritySufficient', 'InformationConsistent', 'PurposeValue', 'JobExperience'));
  }

  public function store(Request $request)
  {
    foreach ($request->except('_token', 'MiddleName') as $data => $value) {
      $valids[$data] = "required";
    }
    $this->validate($request, $valids);

    $rating = LoanRating::create($request->except('_token'));
    $rating->StatusID ='1';
    if($rating->save())
      return redirect()->route('loan_ratings')->with('success', 'Loan rating was saved successfully');
    else
      return redirect()->back()->withInput()->with('danger', 'Loan could not be saved.');
  }

  public function approve($id)
  {
    $rating = LoanRating::find($id);
    if ($rating->StatusID == '1') {
      $rating->StatusID = '2';
    } elseif ($rating->StatusID == '2') {
      $rating->StatusID = '3';
    } elseif ($rating->StatusID == '3') {
      $rating->StatusID = '4';
    }

    $rating->save();

    if ($rating->StatusID == 4) {
      return redirect()->route('loan_ratings')->with('success', 'Approval was successful.');
    } else {
      return redirect()->route('loan_ratings')->with('success', 'Approval successful. Profile has been sent to the next reviewer.');
    }

  }

  public function reject($id)
  {
    $rating = LoanRating::find($id);
    $rating->StatusID = '5';
    $rating->save();

    return redirect()->route('loan_ratings')->with('success', 'Loan profile was rejected successfully.');
  }

}
