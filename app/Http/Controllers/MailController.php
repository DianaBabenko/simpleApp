<?php

namespace App\Http\Controllers;

use App\Mail\Greeting;
use Illuminate\Http\Response;
use Mail;

class MailController extends Controller
{
    /**
     * @return Response
     */
    public function send(): Response
    {
        $userName = 'Den';
        $newMessages = 11;
        $file = storage_path('app/routes.txt');

        Mail::to('baben.k.o.diana2019@gmail.com')
            ->send(new Greeting($userName, $newMessages, $file));

        return new Response('Send');
    }
}
