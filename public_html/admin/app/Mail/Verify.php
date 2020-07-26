<?php

namespace App\Mail;

use Auth;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Verify extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }
    public function build()
    {
        return $this->subject("TrysKubai Visata, Prašome patvirtinti paskyrą")->Priority(2)->view('mails.verify');
    }
}
