<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailImap;
use App\Models\Category;
use App\Models\MailHistory;
use App\Models\SendMailer;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Validator;

class MailConfigController extends Controller
{

    //............Mail IMAP Configuaration..........//
    public function mail_imap_view()
    {
        return view('dashboard.pages.mail_config.mail_imap', [
        ]);
    }

    public function mail_imap_store(Request $request)
    {
        $request->validate([
            'imap_mailer'       => 'required',
            'imap_host'         => 'required',
            'imap_port'         => 'required',
            'imap_username'     => 'required',
            'imap_password'     => 'required',
            'imap_protocol'     => 'required',
        ]);

        $imap = new MailImap();

        $imap->imap_mailer      = $request->imap_mailer;
        $imap->imap_host        = $request->imap_host;
        $imap->imap_port        = $request->imap_port;
        $imap->imap_username    = $request->imap_username;
        $imap->imap_password    = $request->imap_password;
        $imap->imap_encryption  = $request->imap_encryption;
        $imap->imap_protocol    = $request->imap_protocol;
        $imap->save();

        return back()->with('success', 'Imap Config Save Successfully');
    }


     //............Mail SMTP(sender) Configuaration..........//

    public function sender_mail_view()
    {
        return view('dashboard.pages.mail_config.sender_mail');
    }


    public function sender_mail_store(Request $request)
    {
        $request->validate([
            'mail_mailer'           => 'required',
            'mail_host'             => 'required',
            'mail_port'             => 'required',
            'mail_username'         => 'required',
            'mail_password'         => 'required',
            'mail_from_address'     => 'required',
        ]);

        $sender = new SendMailer();

        $sender->mail_mailer        = $request->mail_mailer;
        $sender->mail_host          = $request->mail_host;
        $sender->mail_port          = $request->mail_port;
        $sender->mail_username      = $request->mail_username;
        $sender->mail_password      = $request->mail_password;
        $sender->mail_from_address  = $request->mail_from_address;
        $sender->mail_encryption    = $request->mail_encryption;
        $sender->save();

        return back()->with('success', 'Sender Mail Config Save Successfully');
    }



    //............Mail Send..........//
    public function mail_send_form()
    {
        $categories = Category::all();
        return view('dashboard.pages.mail.send', compact('categories'));
    }

    public function mail_send_store(Request $request)
    {
        $request->validate([
            'to'          => 'required',
            'subject'     => 'required',
            'content'     => 'required',
        ]);

        $smtp_info = SendMailer::first();

        config([
            'mail.mailers.smtp.transport'  => 'smtp',
            'mail.mailers.smtp.host'       => $smtp_info->mail_host,
            'mail.mailers.smtp.port'       => $smtp_info->mail_port,
            'mail.mailers.smtp.encryption' => $smtp_info->mail_encryption,
            'mail.mailers.smtp.username'   => $smtp_info->mail_username,
            'mail.mailers.smtp.password'   => $smtp_info->mail_password,
            'mail.from.address'            => $smtp_info->mail_from_address,
        ]);

        $data = [
            'to' => $request->to,
            'subject' => $request->subject,
            'content' => $request->content,
        ];

        Mail::to($request->to)->send(new SendMail($data));
        return back()->with('success', 'Mail Send Successfully');

        MailHistory::create([
            'to'          => $request->to,
            'category_id' => $request->category_id,
            'type'        => $request->type,
            'subject'     => $request->subject,
            'content'     => $request->content,
        ]);

        // $send->to           = $request->to;
        // $send->category_id  = $request->category_id;
        // $send->type         = $request->type;
        // $send->subject      = $request->subject;
        // $send->content      = $request->content;
        // $send->save();

        // return back()->with('success', 'Mail Send Successfully');
    }


    //............Mail Send History..........//
    public function mail_send_history()
    {
        $send = MailHistory::all();
        return view('dashboard.pages.mail.history', [
            'send' => $send
        ]);
    }

    //............Mail Inbox..........//
    public function mail_inbox()
    {

        $imap_info = MailImap::first();

        if(!$imap_info){

            return back()->with('error', 'Please Configure Imap First');
        }
            // Configure the IMAP client using the provided form data
            $client = Client::make([
                'host'          => $imap_info->imap_host,
                'port'          => $imap_info->imap_port,
                'encryption'    => $imap_info->imap_encryption , // You can adjust this based on the mail server
                'validate_cert' => false,
                'username'      => $imap_info->imap_username,
                'password'      => $imap_info->imap_password,
                'protocol'      => $imap_info->imap_protocol,
            ]);
            // Connect to the IMAP server
            $client->connect();

            // Get all mailboxes
            $mailboxes = $client->getFolders();
            $emails = [];
            // Loop through mailboxes to fetch emails
            foreach ($mailboxes as $mailbox) {
                $messages = $mailbox->messages()->all()->get();

                foreach ($messages as $message) {
                    $emails[] = [
                        'subject' => $message->getSubject(),
                        'from'    => $message->getFrom()[0]->mail,
                        'date'    => $message->getDate(),
                        'body'    => $message->getTextBody(), // or getTextBody() for plain text
                    ];
                }
            }
            // Pass emails to the view
            return view('dashboard.pages.mail.inbox', [
                'emails' => $emails
            ]);

        // } catch (\Exception $e) {
        //     return back()->with('error', 'Failed to fetch emails: ' . $e->getMessage());
        // }
    }

}
