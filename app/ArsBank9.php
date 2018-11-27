<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class ArsBank9 extends Model
{

  protected $table = 'ars_banks9';

    /*
    |-----------------------------------
    | process save
    |-----------------------------------
     */
    public function saveBankItem($details, $debit, $credit, $date, $status)
    {
        // body..
        $owner   = 'cavidel';
        $balance = 00.00;

        $this->details = $details;
        $this->debit   = $debit;
        $this->credit  = $credit;
        $this->date    = $date;
        $this->status  = $status;
        $this->balance = $balance;
        $this->owner   = $owner;
        $this->save();

        return [
            'status'  => 'success',
            'code'    => 200,
            'message' => 'add item successful !',
        ];
    }

    /*
    |-----------------------------------
    | load all items
    |-----------------------------------
     */
    public function loadBankItem()
    {
        // body..
        $all_items = ArsBank::all();
        if (count($all_items) > 0) {
            $item_box = [];
            foreach ($all_items as $item) {

                if ($item->debit == null) {
                    $item->debit = 00.00;
                }

                if ($item->credit == null) {
                    $item->credit = 00.00;
                }

                # code...
                $data = [
                    'id'        => $item->id,
                    'owner'     => $item->owner,
                    'details'   => $item->details,
                    'balance'   => $item->balance,
                    'credit'    => number_format($item->credit, 2),
                    'debit'     => number_format($item->debit, 2),
                    'status'    => $item->status,
                    'date'      => $item->date,
                    'last_seen' => $item->created_at->diffForHumans(),
                ];

                // push to item box
                array_push($item_box, $data);
            }
        } else {
            $item_box = [];
        }

        // return item
        return $item_box;
    }
}
