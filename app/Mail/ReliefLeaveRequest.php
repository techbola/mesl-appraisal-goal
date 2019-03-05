<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReliefLeaveRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $leave_request;

    public function __construct($leave_request)
    {
        $this->leave_request = $leave_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Leave Request')
            ->markdown('emails.leave.relief');
    }
}
