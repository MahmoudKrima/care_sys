<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;



class SmsController extends Controller
{
    public function sendSms(Request $request ){
        $sid = env("TWILIO_SID");
$token = env("TWILIO_TOKEN");
$senderNumber = env("TWILIO_PHONE");
$to = $request->contact;

$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create($to, // to
                           [
                               "body" => "This Is Your Verification Code :" .rand(100000,999999) ,
                               "from" => $senderNumber,
                           ]
                  );
   }
}
