<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\BankAccount;
use Cavi\BankTransaction;
use Cavi\BankTransactionStaging;
use Excel;
use File;
use DB;
use Session;
use Cavi\SimpleXLSX;
use Carbon;

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
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

          $path = $request->file->getRealPath();

          if ($extension == "xlsx" || $extension == "xls") {
            $xlsx = @(new SimpleXLSX($path));
            $transactions =  $xlsx->rows();
            // dd($transactions);
          } elseif($extension == 'csv') {
            $transactions = array_map('str_getcsv', file($path));
          }


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

            $bank = BankAccount::find($request->bank);
            // $account_no = BankAccount::find($request->account_no);
            $clean_trans = [];



            if(!empty($transactions)){

              $duplicate = BankTransaction::where('PostDate', end($transactions)[1])->where('Narration', end($transactions)[7])->where('AccountNumber', $bank->AccountNumber)->get();
              if (count($duplicate) > 0) {
                return redirect()->back()->with('error', 'Looks like this data already exists. Please try another file.');
              }

              foreach ($transactions as $trans2) {
                // dd(count(array_filter($trans2)));
                if(count(array_filter($trans2)) > 4 && is_numeric($trans2[0]))
                $clean_trans[] = $trans2;
              }
              // dd($clean_trans);
              BankTransactionStaging::truncate();

              foreach ($clean_trans as $trans) {
                $row = new BankTransactionStaging;
                $row->TransactionRef = $trans['0'];
                $row->PostDate = !empty($trans['1'])? Carbon::parse($trans['1'])->format('Y-m-d') : '';
                $row->Reference = !empty($trans['2'])? str_replace(',','',$trans['2']) : '';
                $row->ValueDate = $trans['3'];
                $row->Debit = !empty($trans['4'])? str_replace(',','',$trans['4']) : '0';
                $row->Credit = !empty($trans['5'])? str_replace(',','',$trans['5']) : '0';
                $row->Balance = str_replace(',','',$trans['6']);
                $row->Narration = !empty($trans['7'])? str_replace(',','',$trans['7']) : '';
                $row->Bank = $bank->BankName;
                $row->AccountNumber = $bank->AccountNumber;
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

    public function get_account_no($id)
    {
      $bank = BankAccount::find($id);
      return $bank->AccountNumber;
    }

    public function complete_import()
    {
      $import = DB::statement('procInsertBankTransactions');

      if ($import) {
        return redirect()->back()->with('success', 'Your data has been imported successfully.');
      } else {
        return redirect()->back()->with('error', 'There was a problem importing your data.');
      }

    }
}
