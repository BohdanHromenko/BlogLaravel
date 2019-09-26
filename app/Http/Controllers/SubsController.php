<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use Mail;
use App\Subscription;
use Illuminate\Http\Request;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions'
        ]);

        $subs = Subscription::add($request->get('email'));

        Mail::to($subs)->send(new SubscribeEmail($subs));

        return redirect()->back()->with('status', 'Check your E-mail');
    }

    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Your email has been confirmed.');
    }
}
