<?php

namespace Cavidel\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ReconExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ledger_items = \DB::table('ars_ledgers')->where('recon_flag', 0)->orderBy('date', 'ASC')->get();

        $bank_items = \DB::table('ars_banks')->where('recon_flag', 0)->orderBy('date', 'ASC')->get();

        $ledger_items = array_map('serialize', $ledger_items->toArray());
        $bank_items   = array_map('serialize', $bank_items->toArray());
        $diff         = array_map('unserialize', array_diff_assoc($bank_items, $ledger_items));
        return collect($diff);
    }
}
