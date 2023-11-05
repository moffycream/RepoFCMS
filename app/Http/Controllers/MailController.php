<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTwoFactor;
use Illuminate\Support\Facades\Session;
use App\Models\UserAccounts;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject' => 'Two Factor Authentication',
            'body' => 'Hello! This is your 2 factor authentication code!',
            'code' => Session::get('2FACode'),
            'end' => 'This code is only valid for 10 minutes, please relogin if the code does not work, thank you!',
            'footer1' => 'Regards,',
            'footer2' => 'The FCMS Team',
        ];

        $username = Session::get('username');
        $user = UserAccounts::where('username', $username)->first();

        try {
            Mail::to($user->email)->send(new MailTwoFactor($data));
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Email not sent.');
        }
        return view('login.two-factor-authentication');
    }
}
