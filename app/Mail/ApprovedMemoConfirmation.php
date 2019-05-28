<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedMemoConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $memo;
    public $next_approver;
    public function __construct($memo)
    {
        $this->memo = $memo;
        // $this->next_approver = $next_approver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.memos.confirmation');
    }
}
