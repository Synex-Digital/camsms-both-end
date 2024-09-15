<?php

namespace App\Http\Controllers\Api;

use App\helper\ImapHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\MailerInfoController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    private $imap;

    public function __construct()
    {
        // Provide your IMAP server details
        $mailer_info = (new MailerInfoController)->mailer_info_index()->original;

        $hostname = '{'.$mailer_info->mailer_info[0]->imap_host.':'.$mailer_info->mailer_info[0]->imap_port.'/'.$mailer_info->mailer_info[0]->imap_protocol.'/'.$mailer_info->mailer_info[0]->imap_encryption.'/novalidate-cert}';

        // $hostname = '{mail.synexdigital.com:993/imap/ssl/novalidate-cert}';
        $username = $mailer_info->imap_username;
        $password = $mailer_info->imap_password;

        $this->imap = new ImapHelper($hostname, $username, $password);
    }

    public function index()
    {
        try {
            $emails = $this->imap->fetchEmails();
            return response()->json(['status' => 'success', 'data' => $emails], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($uid)
    {
        try {
            $email = $this->imap->fetchEmail($uid);
            return response()->json(['status' => 'success', 'data' => $email], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($uid)
    {
        try {
            $this->imap->deleteEmail($uid);
            return response()->json(['status' => 'success', 'message' => 'Email deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function __destruct()
    {
        $this->imap->close();
    }
}
