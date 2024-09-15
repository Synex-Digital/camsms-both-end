<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\SendHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class SendHistoryController extends Controller
{
    function send_history(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'contact_id'    => 'required',
            'category_id'   => 'required',
            'type'          => 'required',
            'message'       => 'required',
        ]);

        if ($validator->fails()) { //validation fails message
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $send = new SendHistory();

        $send->user_id          = $request->user_id;
        $send->contact_id       = $request->contact_id;
        $send->category_id      = $request->category_id;
        $send->type             = $request->type;
        $send->message          = $request->message;
        $send->save();

        return response()->json([
            'status'   => 1,
            'send'     => $send,
        ], 200);
    }


    function send_history_view()
    {
        $send_history_view  = SendHistory::all();

        $send_history_view->map(function($send_history){
            $send_history['user_name']      = $send_history->user?$send_history->user->name:'Unknown';
            $send_history['category_name']  = $send_history->category?$send_history->category->name:'Unknown';
            $send_history['contact_name']   = $send_history->contact?$send_history->contact->name:'Unknown';
            $send_history['contact_number'] = $send_history->contact?$send_history->contact->number:'Unknown';
            unset($send_history->user_id);
            unset($send_history->user);
            unset($send_history->category_id);
            unset($send_history->category);
            unset($send_history->contact_id);
            unset($send_history->contact);
        });

        return response()->json([
            'status'            => 1,
            'send_history_view' => $send_history_view,
        ], 200);
    }


    function send_history_update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|exists:user,id',
            'contact_id'    => 'required|exists:contact,id',
            'category_id'   => 'required|exists:category,id',
            'type'          => 'required',
            'message'       => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $send_history   = SendHistory::find($id);

        if(!$send_history){
            return response()->json([
                'status'    => 0,
                'message'   => 'Send History record not found.'
            ], 200);
        }
        $category       = Category::all();
        $contact        = Contact::all();

        $send_history->user_id      = $request->user_id;
        $send_history->contact_id   = $request->contact_id;
        $send_history->category_id  = $request->category_id;
        $send_history->type         = $request->type;
        $send_history->message      = $request->message;

        $send_history->save();

        return response()->json([
            'status'        => 1,
            'send_history'  => $send_history,
            'category'      => $category,
            'contact'       => $contact
        ], 200);
    }


    function send_history_delete($id)
    {
        $send_history = SendHistory::find($id);

        $send_history->delete();

        return response()->json([
            'status'        => 1,
            'send_history'  => $send_history,
        ], 200);
    }

}
