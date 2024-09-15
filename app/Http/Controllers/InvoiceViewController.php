<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;

class InvoiceViewController extends Controller
{
    public function invoice_history(){

        
        $invoices = Invoice::paginate(12);
        return view('dashboard.pages.invoice.history', compact('invoices'));

    }
}
