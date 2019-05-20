<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedMemo extends Mailable
{
    use Queueable, SerializesModels;

    public $memo;
    public $next_approver;
    public $current_approver;

    public function __construct($memo, $next_approver, $current_approver)
    {
        $this->memo             = $memo;
        $this->next_approver    = $next_approver;
        $this->current_approver = $current_approver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.memos.approval');
    }
}
