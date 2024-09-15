<?php

namespace App\helper;

use App\Models\SendMailer;
use Illuminate\Support\Facades\Config;

class SendWebMailHelper
{
    // public static function configureMail()
    // {
    //     $send_mailer = SendMailer::first();
    //     if($send_mailer){
    //         config::set('mail.mailer.smtp.transport', $send_mailer->mail_mailer);
    //         config::set('mail.host.smtp.host', $send_mailer->mail_host);
    //         config::set('mail.port.smtp.port', $send_mailer->mail_port);
    //         config::set('mail.username.smtp.username', $send_mailer->mail_username);
    //         config::set('mail.password.smtp.password', $send_mailer->mail_password);
    //         config::set('mail.encryption.smtp.encryption', $send_mailer->mail_encryption);
    //         config::set('mail.from.address', $send_mailer->mail_from_address);
    //     }
    // }
}
