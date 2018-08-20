<?php

namespace Cavidel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        return $this->view('emails.receipt');
    }
}
