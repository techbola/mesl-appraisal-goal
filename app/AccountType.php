<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table   = 'tblAccountType';
    protected $guarded = ['AccountTypeRef'];

    const CREATED_AT = 'InputDateTime';
    const UPDATED_AT = 'ModifiedDateTime';

    public function gls(){
      return $this->hasMany('MESL\GL', 'AccountTypeID', 'AccountTypeRef');
    }

    public function transactions(){
      $gls = $this->gls;
      $glids = [];
      foreach ($gls as $gl) {
        $glids[] = $gl->GLRef;
      }
      $transactions = Transaction::whereHas('gl', function($query) use($gls, $glids){
        $query->whereIn('GLRef', $glids);
      })->get();
      // $transactions = Transaction::whereHas('gl')->get();

      return $transactions;
    }

    public function totalClearedBalance(){
      $total = '0';
      if (count($this->gls) > 0):
        foreach ($this->gls as $accounts):
          $total += $accounts->BookBalance; $currency = $accounts->currency->Currency;
        endforeach;
      endif;

      return $total;
    }

    public function totalClearedBalanceFormatted(){
      $currency = 'NGN';
      if (count($this->gls) > 0):
        foreach ($this->gls as $accounts):
          $currency = $accounts->currency->Currency;
        endforeach;
      endif;

      return $currency.' '.number_format($this->totalClearedBalance());
    }

    public function txBalance($from = null, $to = null){
      // if ($this->AccountType == '108') {
      if (stripos($this->AccountType, 'Retained Profit') !== FALSE) {
        $to = $to ?? date('Y-m-d');
        return collect(\DB::select("exec procPLTotal '2005-01-01', '$to'"))->first()->RetainedPL;
      }
      if (empty($from) && empty($to)) {
        $transactions = $this->transactions();
      } elseif (empty($from)) {
        $transactions = $this->transactions()->where('ValueDate', '<=', $to);
      } else {
        $transactions = $this->transactions()->where('ValueDate', '>=', $from)->where('ValueDate', '<=', $to);
      }
      $total = '0';
      if (count($transactions) > 0):
        foreach ($transactions as $tx):
          if ($tx->TransactionTypeID == 3 || $tx->TransactionTypeID == 2) {
            $total += $tx->Amount * -1;
          } else {
            $total += $tx->Amount;
          }
          $currency = $tx->currency->Currency;
        endforeach;
      endif;

      return $total;
    }

    public function txBalanceFormatted($from = null, $to = null)
    {
      $currency = '&#8358;';
      return $currency.' '.number_format($this->txBalance($from, $to));
    }

    public function txCredit($from = null, $to = null){
      if (empty($from) && empty($to)) {
        $transactions = $this->transactions();
      } elseif (empty($from)) {
        $transactions = $this->transactions()->where('ValueDate', '<=', $to);
      } else {
        $transactions = $this->transactions()->where('ValueDate', '>=', $from)->where('ValueDate', '<=', $to);
      }
      $total = '0';
      if (count($transactions) > 0):
        foreach ($transactions as $tx):
          if ($tx->TransactionTypeID == 4 || $tx->TransactionTypeID == 1) {
            $total += $tx->Amount;
          } else {
            // $total += $tx->Amount;
            continue;
          }
          $currency = $tx->currency->Currency;
        endforeach;
      endif;

      return $total;
    }

    public function txCreditFormatted($from = null, $to = null)
    {
      $currency = '&#8358;';
      return $currency.' '.number_format($this->txCredit($from, $to));
    }

    public function txDebit($from = null, $to = null){
      if (empty($from) && empty($to)) {
        $transactions = $this->transactions();
      } elseif (empty($from)) {
        $transactions = $this->transactions()->where('ValueDate', '<=', $to);
      } else {
        $transactions = $this->transactions()->where('ValueDate', '>=', $from)->where('ValueDate', '<=', $to);
      }
      $total = '0';
      if (count($transactions) > 0):
        foreach ($transactions as $tx):
          if ($tx->TransactionTypeID == 3 || $tx->TransactionTypeID == 2) {
            $total += $tx->Amount * -1;
          } else {
            // $total += $tx->Amount;
            continue;
          }
          $currency = $tx->currency->Currency;
        endforeach;
      endif;

      return $total;
    }

    public function txDebitFormatted($from = null, $to = null)
    {
      $currency = '&#8358;';
      return $currency.' '.number_format($this->txDebit($from, $to));
    }

}
