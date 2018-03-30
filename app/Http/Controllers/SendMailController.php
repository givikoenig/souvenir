<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Mail;
use App\Subscriber;

class SendMailController extends Controller
{
    /**
     * Show the application sendMail.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMail()
    {


    	$content = [
    		'title'=> 'Itsolutionstuff.com mail', 
    		'body'=> 'The body of your message.',
    		'button' => 'Click Here'
    		];
    	$subscribers = Subscriber::all();

    	foreach ($subscribers as $subscriber) {
	    	$receiverAddress = $subscriber->email;
	    	dump($receiverAddress);

	    	Mail::to($receiverAddress)->send(new OrderShipped($content));

	    }

    	dd('mail send successfully');
    }
}