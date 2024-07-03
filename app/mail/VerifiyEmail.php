<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifiyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public function __construct($otp){
      $this->otp = $otp;
    }
    public function build()
    {
        $otp =$this->otp;
        return $this->view('emails.verifiyAccount', compact('otp')); // view file located in resources/views/emails/welcome.blade.php
    }
}
