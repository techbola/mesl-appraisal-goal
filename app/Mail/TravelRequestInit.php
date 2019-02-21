<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TravelRequestInit extends Mailable
{
    use Queueable, SerializesModels;

    public $travel_request;
    public function __construct($travel_request)
    {
        $this->travel_request = $travel_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Travel Request')
            ->markdown('emails.travel.init');
    }
}
