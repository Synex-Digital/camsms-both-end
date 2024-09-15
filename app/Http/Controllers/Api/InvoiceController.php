<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function invoice_store(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'contact_id'    => 'required',
            'category_id'   => 'required',
            'amount'        => 'required',
            'due_date'      => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->messages()
            ], 200);
        }

        $invoice = new Invoice();

        $invoice->invoice_number    = $request->invoice_number;
        $invoice->invoice_date      = $request->invoice_date;
        $invoice->user_id           = $request->user_id;
        $invoice->contact_id        = $request->contact_id;
        $invoice->category_id       = $request->category_id;
        $invoice->amount            = $request->amount;
        $invoice->status            = $request->status;
        $invoice->due_date          = $request->due_date;
        $invoice->note              = $request->note;
        $invoice->save();

        return response()->json([
            'status'    => 1,
            'invoice'   => $invoice
        ], 200);
    }

    function invoice_view():JsonResponse
    {
        $invoice_view = Invoice::all();
        $invoice_view->map(function($invoice_store)
        {
            $invoice_store['user_name']       = $invoice_store->user?$invoice_store->user->name:'Unknown';
            $invoice_store['contact_name']    = $invoice_store->contact?$invoice_store->contact->name:'Unknown';
            $invoice_store['contact_number']  = $invoice_store->contact?$invoice_store->contact->number:'Unknown';
            $invoice_store['contact_email']   = $invoice_store->contact?$invoice_store->contact->email:'Unknown';
            $invoice_store['category_name']   = $invoice_store->category?$invoice_store->category->name:'Unknown';

            unset($invoice_store->user_id);
            unset($invoice_store->user);
            unset($invoice_store->contact_id);
            unset($invoice_store->contact);
            unset($invoice_store->category_id);
            unset($invoice_store->category);
        });

        return response()->json([
            'status'        => 1,
            'invoice_view'  => $invoice_view
        ], 200);
    }

    function invoice_update(Request $request, $id):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'contact_id'    => 'required',
            'category_id'   => 'required',
            'amount'        => 'required',
            'due_date'      => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 0,
                'message'   => $validator->errors()->messages(),
            ], 200);
        }

        $invoice_update = Invoice::find($id);

        if(!$invoice_update){
            return response()->json([
                'status'    => 0,
                'message'   => 'Invoice Record Not Found',
            ], 200);
        }

        $invoice_update->invoice_number     = $request->invoice_number;
        $invoice_update->invoice_date       = $request->invoice_date;
        $invoice_update->user_id            = $request->user_id;
        $invoice_update->contact_id         = $request->contact_id;
        $invoice_update->category_id        = $request->category_id;
        $invoice_update->amount             = $request->amount;
        $invoice_update->status             = $request->status;
        $invoice_update->due_date           = $request->due_date;
        $invoice_update->note               = $request->note;
        $invoice_update->save();

        return response()->json([
            'status' => 1,
            'mailer_update' => $invoice_update
        ], 200);
    }

    function invoice_delete($id):JsonResponse
    {
        $invoice_delete = Invoice::find($id);
        $invoice_delete->delete();

        return response()->json([
            'status'            => 1,
            'invoice_delete'    => $invoice_delete,
        ], 200);


    }
 

    public function download() {

        $invoice_download = Invoice::all();
        $invoice_download->map(function($invoice_store)
        {
            $invoice_store['user_name']       = $invoice_store->user?$invoice_store->user->name:'Unknown';
            $invoice_store['contact_name']    = $invoice_store->contact?$invoice_store->contact->name:'Unknown';
            $invoice_store['contact_number']  = $invoice_store->contact?$invoice_store->contact->number:'Unknown';
            $invoice_store['contact_email']   = $invoice_store->contact?$invoice_store->contact->email:'Unknown';
            $invoice_store['category_name']   = $invoice_store->category?$invoice_store->category->name:'Unknown';

            unset($invoice_store->user_id);
            unset($invoice_store->user);
            unset($invoice_store->contact_id);
            unset($invoice_store->contact);
            unset($invoice_store->category_id);
            unset($invoice_store->category);
        });

        $data = [
            [
                'invoice_number'        => $invoice_download->invoice_number,
                'invoice_date'          => $invoice_download->invoice_date,
                'amount'                => $invoice_download->amount,
                'status'                => $invoice_download->status,
                'due_date'              => $invoice_download->due_date,
                'note'                  => $invoice_download->note,
            ]
        ];
     
        // $pdf = Pdf::loadView('pdf', ['data' => $data]);
     
        // return $pdf->download();
        return view('pdf', [
            'invoice_download' => $invoice_download,
            'data' => $data
        ]);
    }
}
