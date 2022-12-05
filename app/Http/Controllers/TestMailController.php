<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class TestMailController extends Controller
{
    //

    public function kocak() {
        return "kocak bgt anjir";
    }

    public function index($message)
    {
        $this->whatsappNotification('+6289602999975', $message);
        // $mailData = [
        //     'title' => "Peringatan License Fortigate akan EXPIRED 10 hari lagi",
        //     'body' => "test pengiriman email dari laravel"
        // ];

        // Mail::to([
        //     'harun_rasyid@dnpi.co.id',
        //     'chevy@dnpi.co.id',
        // ])->send(new DemoMail($mailData));
    }

    private function whatsappNotification(string $recipient, $message)
    {
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        // $wa_from= getenv()"+14155238886";
        $twilio = new Client($sid, $token);

        $body = $message;

        return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);
    }
}
