<?php

namespace MESL\Mail;

use MESL\Appraisal;
use MESL\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupervisorRejectAppraisal extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $appraisal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, Appraisal $appraisal)
    {
        $this->staff = $staff;
        $this->appraisal = $appraisal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@mesl.test')
                    ->subject('Staff Appraisal - Appraisal Approval Status')
                    ->markdown('emails.appraisal.supervisor_reject_appraisal');
    }
}
