<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Mail\Account\SendManagerMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class SendManagerMessagesController extends AccountController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendManagerMessage()
    {
        $title = 'Send message manager';
        return view('account.messages.sendManagerMessage',compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendManagerMessageSaveData(Request $request)
    {



        $manager = Auth::user()->manager()->first();
        if($manager){
            $data = $request->except('_token');


            $data['emailTo'] = $manager->email;

            Mail::send(new SendManagerMailer($data));

            return redirect()->back()->with(['success' =>_('account.email_has_been_sent')]);
        }
        else{
            return redirect()->back()->with(['fail' => 'Դուք չունեք մենեջեր']);
        }



    }
}
