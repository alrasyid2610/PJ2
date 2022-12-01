<?php

namespace App\Console\Commands;

use App\Mail\DemoMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';

    /**
     * Execute the console command.
     *
     * @return int
     */

     private function whatsappNotification(string $recipient)
    {
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= "+14155238886";
        $twilio = new Client($sid, $token);
        $body ="License Veam mau expired tagnggal 12 Desember 2022";

        return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);
    }


    public function handle()
    {
        $quotes = [
            'Mahatma Gandhi' => 'Live as if you were to die tomorrow. Learn as if you were to live forever.',
            'Friedrich Nietzsche' => 'That which does not kill us makes us stronger.',
            'Theodore Roosevelt' => 'Do what you can, with what you have, where you are.',
            'Oscar Wilde' => 'Be yourself; everyone else is already taken.',
            'William Shakespeare' => 'This above all: to thine own self be true.',
            'Napoleon Hill' => 'If you cannot do great things, do small things in a great way.',
            'Milton Berle' => 'If opportunity doesn’t knock, build a door.'
        ];

        // Setting up a random word
        $key = array_rand($quotes);
        $data = $quotes[$key];

        $mailData = [
            'title' => "Peringatan License Fortigate akan EXPIRED 10 hari lagi",
            'body' => "test pengiriman email dari laravel"
        ];

        Mail::to([
            'harun_rasyid@dnpi.co.id',
            'alrasyid2610@gmail.com',
        ])->send(new DemoMail($mailData));

        $this->info('Successfully sent daily quote to everyone.');
    }
}
