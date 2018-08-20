<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\BankAccount;
use Cavidel\BankTransaction;
use Cavidel\BankTransactionStaging;
use Excel;
use File;
use DB;
use Session;

class BankTransactionController extends Controller
{
    public function create_import()
    {
      $banks = BankAccount::all();
      $staging = BankTransactionStaging::all();

      return view('bank_transactions.create_import', compact('banks', 'staging'));
    }

    public function store_import(Request $request)
    {
      $this->validate($request, array(
        'file'      => 'required'
      ));

      if($request->hasFile('file')){
        $extension = File::extension($request->file->getClientOriginalName());
        // if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
        if ($extension == "csv") {

            $path = $request->file->getRealPath();
            // $csv = file_get_contents(Excel::load($path, function($file) {
            //
            // })->convert('csv'));
            // dd($csv);



            // $data = file_get_contents($path);
            //
            // $lines = explode("\r\n", $data);
            // dd($lines);
            // foreach ($lines as $line) {
            //   $row = explode(',', $line);
            //   $transactions[] = $row;
            // }

            // foreach (array_filter($transactions) as $trans) {
            //   if(empty($trans['1'])) continue;
            //   $insert[] = [
            //   'TransactionRef' => str_replace('"','', $trans['0']),
            //   'PostDate' => str_replace('"','', $trans['1']),
            //   'Reference' => str_replace('"','', $trans['2']),
            //   'ValueDate' => str_replace('"','', $trans['3']),
            //   'Debit' => str_replace('"','', $trans['4']),
            //   'Credit' => str_replace('"','', $trans['5']),
            //   'Balance' => str_replace('"','', $trans['6']),
            //   'Narration' => str_replace('"','', $trans['7']),
            //   ];
            // }
            // dd($insert);

            // $bank = BankAccount::find($request->bank);

            $transactions = array_map('str_getcsv', file($path));

            if(!empty($transactions)){
              BankTransactionStaging::truncate();

              foreach ($transactions as $trans) {
                $row = new BankTransactionStaging;
                $row->TransactionRef = $trans['0'];
                $row->PostDate = $trans['1'];
                $row->Reference = $trans['2'];
                $row->ValueDate = $trans['3'];
                $row->Debit = !empty($trans['4'])? str_replace(',','',$trans['4']) : '0';
                $row->Credit = !empty($trans['5'])? str_replace(',','',$trans['5']) : '0';
                $row->Balance = str_replace(',','',$trans['6']);
                $row->Narration = $trans['7'];
                $row->Bank = $request->bank;
                $row->AccountNumber = $request->account_number;
                $row->save();
              }
              // $insertData = DB::table('tblBankTransaction')->insert($insert);

              return redirect()->back()->with('warning', 'Your transactions are ready for upload.')->with('staging', '1');
            }
            else {
              return redirect()->back()->with('error', 'Error importing the data..');
            }

            // dd($lines);
            // if(!empty($data) && $data->count()){
            // }
          }
          else{
            return redirect()->back()->with('error', 'Please upload a csv file.');
          }

        }

      // Excel::load('file.xls', function($reader) {
      //     // reader methods
      // });

    }

    // public function complete_import()
    // {
    //   $staging = BankTransactionStaging::all();
    //   foreach ($staging as $stage) {
    //     $
    //   }
    // }
}
