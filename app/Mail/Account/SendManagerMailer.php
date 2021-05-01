<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SendManagerMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->data['emailTo'] = env('MAIL_FROM_ADDRESS');

       return $this->to($this->data['emailTo'], env('APP_NAME'))

            ->from(Auth::user()->email)
            ->subject($this->data['title'])
            ->markdown('mail.account.sendManagerMailer')->with(['data' => $this->data]);


    }
}
