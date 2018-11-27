<?php

namespace MESL\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReconExport implements FromCollection, WithHeadings
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
    public function headings(): array
    {
        // Headers displayed o eccel sheet
        return [
            '#', 'Date', 'Value Date ', 'Debit', 'Credit', 'Balance', 'Details', 'Bank Name', 'Branch', 'Recon Flag', 'Amount', 'Owner', 'Status', 'Created At', 'Updated At', 'Matched Flag',
        ];
    }
}
