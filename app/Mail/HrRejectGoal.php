<?php

namespace MESL\Mail;

use MESL\Appraisal;
use MESL\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HrRejectGoal extends Mailable
{
    use Queueable, SerializesModels;

    public $appraisal;
    public $staff;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, Appraisal $appraisal)
    {
        $this->appraisal = $appraisal;
        $this->staff = $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@mesl.test')
                    ->subject('Staff Appraisal - Goals Approval Status')
                    ->markdown('emails.hr_reject_goal');
    }
}
