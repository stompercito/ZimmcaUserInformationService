<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function pruebaEmail(){

    	$to_name = 'Jorge Alejandro';
		$to_email = 'coque.dong@gmail.com';
		$data = array('name'=>'Ogbonna Vitalis(sender_name)', 'body' => 'A test mail');

		Mail::send('email.prueba', $data, function($message) use ($to_name, $to_email) {
			$message->to($to_email, $to_name)
			->subject('Laravel Test Mail');
			$message->from('jdong@gmail.com','Test Mail');
		});

		return redirect('/login');
    }
}
