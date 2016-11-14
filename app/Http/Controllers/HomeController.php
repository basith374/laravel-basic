<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Gallery;
use App\Setting;
use Mail;
use App\Mail\ContactMail;

class HomeController extends Controller
{
    
    public function migrate() {
    	Artisan::call('migrate', ['--seed' => '']);
    	echo 'migrated&seeded';
    }
    
	public function getIndex() {
    	return view('home');
	}

	public function postContact(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'msg' => $request->message
        ];
        // return view('emails.contact', $data);
        Mail::send('emails.contact', $data, function($m) use ($request) {
            $m->from('mailer@example.com', 'Your Website');
            $m->to('info@example.com', 'Website Moderator')->subject('Contact Letter');
        });
        return redirect('/contact')->withSuccess('Your message has been sent!');
	}

}
