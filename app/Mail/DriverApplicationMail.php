<?php

namespace App\Mail;

use App\Models\DriverApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DriverApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public DriverApplication $application;

    public function __construct(DriverApplication $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('New Driver Application: ' . $this->application->full_name)
            ->view('emails.driver.application')
            ->with([
                'application' => $this->application,
            ]);
    }
}
