<?php

namespace Cavi\Mail;

use Cavi\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderBill extends Mailable
{
    use Queueable, SerializesModels;

    public $customerDetails;
    public $processedbills;
    public $totalprice;
    public $totaloutstanding;
    public $discount;
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customerDetails, $processedbills, $totalprice, $totaloutstanding, $discount, $total)
    {
        $this->customerDetails  = $customerDetails;
        $this->processedbills   = $processedbills;
        $this->totalprice       = $totalprice;
        $this->totaloutstanding = $totaloutstanding;
        $this->discount         = $discount;
        $this->total            = $total;
    }

/**
 * Build the message.
 *
 * @return $this
 */
    public function build()
    {
        return $this->view('emails.bill');
    }
}
