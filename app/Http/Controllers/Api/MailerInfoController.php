<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MailImap;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MailerInfoController extends Controller
{
    public function mailer_info_store(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'imap_host'         => 'required',
            'imap_port'         => 'required',
            'imap_username'     => 'required',
            'imap_password'     => 'required',
            'imap_protocol'     => 'required',
        ]);

        if($validator->fails()){
         return response()->json([
            'status'    => 0,
            'message'   => $validator->errors()->messages()
         ], 200);   
        }

        $mailer_info = new MailImap();
        $mailer_info->imap_mailer       = $request->imap_mailer;
        $mailer_info->imap_host         = $request->imap_host;
        $mailer_info->imap_port         = $request->imap_port;
        $mailer_info->imap_username     = $request->imap_username;
        $mailer_info->imap_password     = $request->imap_password;
        $mailer_info->imap_encryption   = $request->imap_encryption;
        $mailer_info->imap_protocol     = $request->imap_protocol;
        $mailer_info->save();

        return response()->json([
            'status'        => 1,
            'mailer_info'   => $mailer_info
        ], 200);
    }

    public function mailer_info_index():JsonResponse
    {
        $mailer_info = MailImap::first();
        return response()->json([
            'status'        => 1,
            'mailer_info'   => $mailer_info
        ], 200);
    }

    public function mailer_info_update(Request $request, $id):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'imap_host'         => 'required',
            'imap_port'         => 'required',
            'imap_username'     => 'required',
            'imap_password'     => 'required',
            'imap_protocol'     => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 0, 
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $mailer_update = MailImap::find($id);

        if(!$mailer_update){
            return response()->json([
                'status'    => 0,
                'message'   => 'Mailer Record Not Found'
            ], 200);
        }

        $mailer_update->imap_mailer         = $request->imap_mailer;
        $mailer_update->imap_host           = $request->imap_host;
        $mailer_update->imap_port           = $request->imap_port;
        $mailer_update->imap_username       = $request->imap_username;
        $mailer_update->imap_password       = $request->imap_password;
        $mailer_update->imap_encryption     = $request->imap_encryption;
        $mailer_update->imap_protocol       = $request->imap_protocol;
        $mailer_update->save();

        return response()->json([
            'status'        => 1,
            'mailer_update' => $mailer_update
        ], 200);
    }

    public function mailer_info_delete():JsonResponse
    {
        $mailer_delete = MailImap::find($id);
        $mailer_delete->delete();

        return response()->json([
            'status'        => 1, 
            'mailer_delete' => $mailer_delete
        ], 200);
    }
}
