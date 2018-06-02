<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    protected $table   = 'tblAccountGroup';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function account_types(){
      return $this->hasMany('Cavidel\AccountType', 'AccountGroupID', 'id');
    }

    public function totalClearedBalance(){
      $total = '0';
      foreach ($this->account_types as $types):
          if (count($types->gls) > 0):
            foreach ($types->gls as $accounts):
              $total += $accounts->BookBalance; $currency = $accounts->currency->Currency;
            endforeach;
          endif;
      endforeach;

      return $total;
    }

    public function txBalance($from = null, $to = null){

      $total = '0';
      foreach ($this->account_types as $types):
          $total += $types->txBalance($from, $to);
      endforeach;

      return $total;
    }

    public function txBalanceFormatted($from = null, $to = null)
    {
      $currency = '&#8358;';
      return $currency.' '.number_format($this->txBalance($from, $to));
    }


    public function getGlsAttribute(){
      $acc = [];
      foreach ($this->account_types as $types):
          if (count($types->gls) > 0):
            foreach ($types->gls as $accounts):
              $acc[] = $accounts;
            endforeach;
          endif;
      endforeach;

      return $acc;
    }

    public function totalClearedBalanceFormatted(){
      $currency = 'NGN';
      foreach ($this->account_types as $types):
          if (count($types->gls) > 0):
            foreach ($types->gls as $accounts):
              $currency = $accounts->currency->Currency;
            endforeach;
          endif;
      endforeach;
      return $currency.' '.number_format($this->totalClearedBalance());
    }



    public function txCredit($from = null, $to = null){

      $total = '0';
      foreach ($this->account_types as $types):
          $total += $types->txCredit($from, $to);
      endforeach;

      return $total;
    }

    public function txCreditFormatted($from = null, $to = null)
    {
      $currency = '&#8358;';
      return $currency.' '.number_format($this->txCredit($from, $to));
    }

    public function txDebit($from = null, $to = null){

      $total = '0';
      foreach ($this->account_types as $types):
          $total += $types->txDebit($from, $to);
      endforeach;

      return $total;
    }

    public function txDebitFormatted($from = null, $to = null)
    {
      $currency = '&#8358;';
      return $currency.' '.number_format($this->txDebit($from, $to));
    }

}
