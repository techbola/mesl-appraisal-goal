<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendComplaintNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Complaints Request')
            ->markdown('emails.complaints.sent');
    }
}
