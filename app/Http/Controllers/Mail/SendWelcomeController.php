<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendWelcomeController extends Controller
{
    public function sendWelcomeEmail()
    {
        $name = "nader";
        $email = "silenthope2015@gmail.com";

        $data = [
            'name' => $name,
        ];

        Mail::to($email)->send(new WelcomeMail($data));

        return redirect('/');
    }
}
