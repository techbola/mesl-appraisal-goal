<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedMemo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($memo, $is_initiator)
    {
        $this->memo         = $memo;
        $this->is_initiator = $is_initiator;
    }

    public function build()
    {
        $memo         = $this->memo;
        $is_initiator = $this->is_initiator;

        return $this->markdown('emails.approved-memo', compact('memo', 'is_initiator'))
            ->subject('Approved Memo');
    }
}
