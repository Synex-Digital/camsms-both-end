<?php

namespace App\helper;

class ImapHelper
{
    private $connection;

    // Connect to the IMAP server
    public function __construct($hostname, $username, $password)
    {
        $this->connection = imap_open($hostname, $username, $password) or die('Cannot connect to IMAP server: ' . imap_last_error());
    }

    // Fetch a list of emails
    public function fetchEmails($mailbox = 'INBOX')
    {
        $emails = imap_search($this->connection, 'ALL', SE_UID);
        if (!$emails) {
            return [];
        }

        $emailList = [];
        foreach ($emails as $email_uid) {
            $header = imap_headerinfo($this->connection, $email_uid);
            $emailList[] = [
                'uid' => $email_uid,
                'subject' => $header->subject,
                'from' => $header->from[0]->mailbox . '@' . $header->from[0]->host,
                'date' => $header->date,
            ];
        }

        return $emailList;
    }

    // Fetch a single email's details
    public function fetchEmail($uid)
    {
        $structure = imap_fetchstructure($this->connection, $uid);
        $body = imap_fetchbody($this->connection, $uid, 1);

        return [
            'structure' => $structure,
            'body' => $body
        ];
    }

    // Delete an email
    public function deleteEmail($uid)
    {
        imap_delete($this->connection, $uid);
        imap_expunge($this->connection);
    }

    // Close the IMAP connection
    public function close()
    {
        imap_close($this->connection);
    }
}
