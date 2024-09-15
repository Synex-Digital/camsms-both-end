<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SendMailer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendMailerInfoController extends Controller
{
    public function send_mailer_info_store(Request $request):JsonResponse 
    {
        $validator = Validator::make($request->all(), [
            'mail_mailer'           => 'required',
            'mail_port'             => 'required',
            'mail_username'         => 'required',
            'mail_password'         => 'required',
            'mail_from_address'     => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 0, 
                'message'   => $validator->errors()->messages()
            ], 200);
        }

        $send_mailer_store = new SendMailer();

        $send_mailer_store->mail_mailer         = $request->mail_mailer;
        $send_mailer_store->mail_host           = $request->mail_host;
        $send_mailer_store->mail_port           = $request->mail_port;
        $send_mailer_store->mail_username       = $request->mail_username;
        $send_mailer_store->mail_password       = $request->mail_password;
        $send_mailer_store->mail_encryption     = $request->mail_encryption;
        $send_mailer_store->mail_from_address   = $request->mail_from_address;
        $send_mailer_store->save(); 

        return response()->json([
            'status'    => 1,
            'send_mailer_store' => $send_mailer_store
        ], 200);
    }

    public function send_mailer_info_index():JsonResponse
    {
        $send_mailer_info_index = SendMailer::all();
        return response()->json([
            'status' => 1,
            'send_mailer_info_index' => $send_mailer_info_index
        ], 200);
    }

    public function send_mailer_update(Request $request, $id):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'mail_mailer'           => 'required',
            'mail_port'             => 'required',
            'mail_username'         => 'required',
            'mail_password'         => 'required',
            'mail_from_address'     => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'status'    =>0,
                'message'   => $validator->errors()->messages()
            ], 200);
        }

        $send_mailer_update = SendMailer::find($id);

        if(!$send_mailer_update){
            return response()->json([
                'status'    => 0,
                'message'   => 'Send Mailer Information Not Found'
            ], 200);
        }

        $send_mailer_update->mail_mailer            = $request->mail_mailer;
        $send_mailer_update->mail_host              = $request->mail_host;
        $send_mailer_update->mail_port              = $request->mail_report;
        $send_mailer_update->mail_username          = $request->mail_username;
        $send_mailer_update->mail_password          = $request->mail_password;
        $send_mailer_update->mail_encryption        = $request->mail_encryption;
        $send_mailer_update->mail_from_address      = $request->mail_from_address;
        $send_mailer_update->save();

        return response()->json([
            'status'                => 1,
            'send_mailer_update'    => $send_mailer_update
        ], 200);
    }

    public function send_mailer_delete($id):JsonResponse
    {
        $send_mailer_delete = SendMailer::find($id);
        $send_mailer_delete->delete();
        return response()->json([
            'status' => 1,
            'send_mailer_delete' => $send_mailer_delete
        ], 200);
    }
}
