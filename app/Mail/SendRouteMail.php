<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRouteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $memo;
    public function __construct($memo)
    {
        $this->memo = $memo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Memo Re-route')
            ->markdown('emails.memos.route');
    }
}
