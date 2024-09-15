<?php

namespace App\helper;

use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function send_mail($to, $subject, $content)
    {
        Mail::raw($content, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });
    }
}
