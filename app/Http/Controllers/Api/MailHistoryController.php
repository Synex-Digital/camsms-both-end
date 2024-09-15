<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\MailHistory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class MailHistoryController extends Controller
{
    function mail_history(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'user_id'       => 'required',
            'contact_id'    => 'required',
            'category_id'   => 'required',
            'type'          => 'required',
            'message'       => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $mail = new MailHistory();

        $mail->user_id      = $request->user_id;
        $mail->contact_id   = $request->contact_id;
        $mail->category_id  = $request->category_id;
        $mail->type         = $request->type;
        $mail->message      = $request->message;
        $mail->save();

        return response()->json([
            'status'        => 1,
            'mail'          => $mail,
        ], 200);
    }

    function mail_history_view():JsonResponse
    {
        $mail_history_view = MailHistory::all();

        $mail_history_view->map(function($mail_history){
            $mail_history['user_name']      = $mail_history->user?$mail_history->user->name:'Unknown';
            $mail_history['category_name']  = $mail_history->category?$mail_history->category->name:'Unknown';
            $mail_history['contact_name']   = $mail_history->contact?$mail_history->contact->name:'Unknown';
            $mail_history['contact_email']  = $mail_history->contact?$mail_history->contact->email:'Unknown';

            unset($mail_history->user_id);
            unset($mail_history->user);
            unset($mail_history->category_id);
            unset($mail_history->category);
            unset($mail_history->contact_id);
            unset($mail_history->contact);
        });

        return response()->json([
            'status'              => 1,
            'mail_history_view'   => $mail_history_view,
        ], 200);
    }

    function mail_history_update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'user_id'       => 'required',
            'contact_id'    => 'required',
            'category_id'   => 'required',
            'type'          => 'required',
            'messsage'      => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status'    => 0,
                'message'   => $validator->erros()->message(),
            ]);
        }

        $mail_history = MailHistory::find($id);

        if(!$mail_history){
            return response()->json([
                'status'    => 0,
                'message'   => 'Mail History record not found.',
            ], 200);
        }

        $category   = Category::all();
        $contact    = Contact::all();
        $user       = User::all();

        $mail_history->user_id          = $request->user_id;
        $mail_history->contact_id       = $request->contact_id;
        $mail_history->category_id      = $request->category_id;
        $mail_history->type             = $request->type;
        $mail_history->message          = $request->message;
        $mail_history->save();

        return response()->json([
            'status'        => 0,
            'mail_history'  => $mail_history,
            'category'      => $category,
            'contact'       => $contact,
            'user'          => $user,
        ], 200);
    }


    function mail_history_delete($id):JsonResponse{
        $mail_history = MailHistory::find($id);

        $mail_history->delete();

        return response()->json([
            'status'        => 1,
            'mail_history'  => $mail_history,
        ], 200);
    }
}
