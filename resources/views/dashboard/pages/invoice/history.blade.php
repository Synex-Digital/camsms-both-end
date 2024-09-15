@extends('dashboard.layouts.app')
@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="" class="disabled">Invoice</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">History</a></li>
        </ol>
        <div class="col-lg-12">
            <div class="card">
                @if(session('danger'))
                    <div class="alert alert-danger">{{ session('danger') }}</div>
                @endif

                <div class="card-header">
                    <h4 class="card-title">
                        Invoice History List
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Sl. No</strong></th>
                                    <th><strong>Invoice Number</strong></th>
                                    <th><strong>Invoice Date</strong></th>
                                    <th><strong>Sender</strong></th>
                                    <th><strong>Receiver Name</strong></th>
                                    <th><strong>Receiver Number</strong></th>
                                    <th><strong>Receiver Email</strong></th>
                                    <th><strong>Receiver Address</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Amount</strong></th>
                                    <th><strong>Due Date</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($invoices as $invoice)
                                        <td><strong>1</strong></td>

                                        <td><span class="w-space-no">{{ $invoice->invoice_number }}</span></td>

                                        <td><span class="w-space-no">{{ $invoice->invoice_date }}</span></td>

                                        <td><span class="w-space-no">{{ $invoice->user->name??'unknown' }}</span></td>
                                        <td><span class="w-space-no">{{ $invoice->contact->name }}</span></td>
                                        <td><span class="w-space-no">{{ $invoice->contact->number }}</span></td>
                                        <td><span class="w-space-no">{{ $invoice->contact->email }}</span></td>
                                        <td><span class="w-space-no">{{ $invoice->contact->address }}</span></td>
                                        
                                        

                                        <td><span class="w-space-no">{{ $invoice->amount }}</span></td>

                                        <td><span class="w-space-no">{{ $invoice->due_date }}</span></td>

                                        <td><span class="w-space-no badge badge-info">{{ $invoice->status }}</span></td>

                                        <td><span class="w-space-no">{{ $invoice->note }}</span></td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>

                                                <a href="#" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
