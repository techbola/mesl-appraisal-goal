<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class SendCallMemo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $memo = $this->memo;

        // Prepare Meeting notes in PDF
        $pdf = PDF::loadView('pdf.call_memo', compact('memo'));

        return $this->markdown('emails.call_memo', compact('memo'))
            ->subject('Memo For Meeting With ' . $memo->customer->Customer)
            ->attachData($pdf->output(), 'Meeting_Notes_' . $memo->customer->Customer . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
