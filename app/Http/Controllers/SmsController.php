<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendOTP($phone, $message)
    {
        $account_sid = env('TWILIO_SID');
        $auth_token = env('TWILIO_TOKEN');
        $twilio_number = env('TWILIO_FROM');

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($phone, [
            'from' => $twilio_number,
            'body' => $message
        ]);
    }
}
