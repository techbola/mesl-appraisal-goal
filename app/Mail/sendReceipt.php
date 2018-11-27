<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;

class sendReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $cash_entry;
    public $client_details;
    public $narrations;
    public $amount_in_words;

    public function __construct($cash_entry, $client_details, $narrations, $amount_in_words)
    {
        $this->cash_entry      = $cash_entry;
        $this->client_details  = $client_details;
        $this->narrations      = $narrations;
        $this->amount_in_words = $amount_in_words;
    }

    public function build()
    {
        $cash_entry      = $this->cash_entry;
        $client_details  = $this->client_details;
        $narrations      = $this->narrations;
        $amount_in_words = $this->amount_in_words;

        $pdf = PDF::loadView('receipts.template_pdf', compact('company_details', 'narrations', 'client_details', 'cash_entry', 'amount_in_words'));

        return $this->markdown('emails.receipt_singular')
            ->subject('Receipt ')
            ->attachData($pdf->output(), 'Receipt_' . $client_details->Customer . '.pdf' ?? '-' . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
