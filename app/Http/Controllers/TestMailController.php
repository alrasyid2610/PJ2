<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class TestMailController extends Controller
{
    //

    public function index()
    {
        $this->whatsappNotification('+6289602999975');
        // $mailData = [
        //     'title' => "Peringatan License Fortigate akan EXPIRED 10 hari lagi",
        //     'body' => "test pengiriman email dari laravel"
        // ];

        // Mail::to([
        //     'harun_rasyid@dnpi.co.id',
        //     'chevy@dnpi.co.id',
        // ])->send(new DemoMail($mailData));

        dd("email sukses terkirim");
    }

    private function whatsappNotification(string $recipient)
    {
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= "+14155238886";
        $twilio = new Client($sid, $token);

        $body ="License Veam mau expired tagnggal 12 Desember 2022";

        return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);
    }
}
