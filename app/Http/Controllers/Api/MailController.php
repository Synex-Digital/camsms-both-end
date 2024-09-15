<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function send_mail(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'to'        => 'required|email',
            'subject'   => 'required',
            'content'   => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'status'    => 0,
                'message'   => $validate->errors()->messages()
            ], 200);
        }

        try {
            MailHelper::send_mail($request->to, $request->subject, $request->content);

            return response()->json([
                'status'    => 1,
                'message'   => 'Email sent successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Email could not be sent.',
                'error'     => $e->getMessage()
            ], 200);
        }


        // try {
        //     Mail::to($request->email)->send(new SendMail($request->subject, $request->content));

        //         return response()->json([
        //             'status'    => 1,
        //             'message'   => 'Email sent successfully.',
        //         ], 200);

        //     } catch (\Exception $e) {
        //         return response()->json([
        //             'status'    => 0,
        //             'message'   => 'Email could not be sent.',
        //             'error'     => $e->getMessage()
        //         ], 200);
        //     }
    }
}
