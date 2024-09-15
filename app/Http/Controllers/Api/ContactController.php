<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ContactController extends Controller
{
    function contact(Request $request): JsonResponse{

        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'number'     => 'required',
            'address'    => 'required',
        ]);

        if ($validator->fails()) { //validation fails message
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $contact = new Contact();

        $contact->name          = $request->name;
        $contact->email         = $request->email;
        $contact->number        = $request->number;
        $contact->address       = $request->address;
        $contact->category_id   = $request->category_id;
        $contact->avatar        = $request->avatar;
        $contact->note          = $request->note;
        $contact->save();

        return response()->json([
            'status'    => 1,
            'contact'   => $contact,
        ], 200);
    }


    function contact_view() {
        $contact_view   = Contact::all();

        $contact_view->map(function($contact){
            $contact['category_name'] = $contact->category?$contact->category->name:'Unknown';
            unset($contact->category_id);
            unset($contact->category);
        });

        return response()->json([
            'status'    => 1,
            'contact'   => $contact_view,
        ], 200);
    }

    function contact_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'number'     => 'required',
            'address'    => 'required',
        ]);

        if ($validator->fails()) { //validation fails message
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $contact    = Contact::find($id);
        $category   = Category::all();

        $contact->name          = $request->name;
        $contact->email         = $request->email;
        $contact->number        = $request->number;
        $contact->address       = $request->address;
        $contact->category_id   = $request->category_id;
        $contact->avatar        = $request->avatar;
        $contact->note          = $request->note;

        $contact->save();

        return response()->json([
            'status'    => 1,
            'contact'   => $contact,
            'category'  => $category
        ], 200);
    }


    function contact_delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json([
            'status'    => 1,
            'contact'   => $contact,
        ], 200);
    }
}
