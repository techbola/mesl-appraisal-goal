<?php

namespace MESL\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveRequest extends Mailable {
	use Queueable, SerializesModels;

	public $name;
	public $leave_request;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($name, $leave_request) {
		$this->name = $name;
		$this->leave_request = $leave_request;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown('emails.LeaveRequest');
	}
}
