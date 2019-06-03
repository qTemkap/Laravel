<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function sendRequest(Request $request) {
    	$mess = $request->message;
    	$resipient = $request->emailTO;
    	$sender = $request->emailMail;

		Mail::raw($mess, function($message) use($resipient, $sender)
		{
		    $message->to($resipient)->subject('Hello!');
		    $message->from($sender);
		});
    }
}
