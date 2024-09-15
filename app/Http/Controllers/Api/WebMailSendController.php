<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\WebMail;
use App\helper\SendWebMailHelper;
use Illuminate\Http\Request;

class WebMailSendController extends Controller
{
    public function send_web_mail(Request $request)
    {
        // Validate the request
        $request->validate([
            'to'        => 'required|string',
            'subject'   => 'required|string',
            'message'   => 'required|string',
        ]);

        // Configure mail using helper
        SendWebMailHelper::configureMail();

        // Send email
        try {
            Mail::to($request->to)->send(new WebMail($request->subject, $request->message));
            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 200);
        }
    }
}

