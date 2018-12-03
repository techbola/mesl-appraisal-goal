<?php

namespace Cavi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HappyBirthday extends Mailable
{
    use Queueable, SerializesModels;
    public $staff;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staff)
    {
        $this->staff = $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.HappyBirthday')
        ->subject('Happy Birthday From '.config('app.name'));
    }
}
