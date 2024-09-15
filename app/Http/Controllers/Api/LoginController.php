<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) { //validation fails message
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        //Loggin attempt
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->validity !== null) {
                $validityDateString = trim($user->validity);

                // Adjust format to consider date and time (if present)
                $validityDate = Carbon::createFromFormat('Y-m-d H:i:s', $validityDateString);

                if ($validityDate !== false && $validityDate->isPast()) {
                    return response()->json([
                        'status' => 0,
                        'user' => 'User validation expired',
                    ], 200);
                }
            }

            $profile = $user->profile != null ? asset('files/user/' . $user->profile) : null;
            $user->profile = $profile;
            $user->date = $validityDate->format('d M y');

            return response()->json([
                'status'    => 1,
                'user'      => $user,
            ], 200);
        }

        else {
            return response()->json([
                'status'    => 0,
                'user'      => 'Not Found',
            ], 200);
        }
    }
}
