<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use SMS;

class SMSController extends Controller
{
    public function sendSms(Request $request){

        $validator = Validator::make($request->all(), [
            'number'        => 'required',
            'message'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->first()
            ], 200);
        }

        $response =SMS::Send($request->number, $request->message);

        if(!$response){
            return response()->json([
                'status'    => 0,
                'message'   => 'SMS could not be sent.',
            ], 200);
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'SMS sent successfully.',
        ], 200);
    }
}
