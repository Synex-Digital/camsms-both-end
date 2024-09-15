@extends('dashboard.layouts.app')
@section('content')
{{-- <div class="container-fluid"> --}}
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="disabled" class="disabled">Mail</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">History</a></li>
        </ol>
        <div class="col-lg-12">
            <div class="card">
                @if(session('danger'))
                    <div class="alert alert-danger">{{ session('danger') }}</div>
                @endif

                <div class="card-header">
                    <h4 class="card-title">
                        Mail History List
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Sl. No</strong></th>
                                    <th><strong>Receiver Email</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Type</strong></th>
                                    <th><strong>Subject</strong></th>
                                    <th><strong>Message</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($send as $mail)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td><span class="w-space-no">{{ $mail->to }}</span></td>
                                        <td><span class="w-space-no">{{ $mail->category->name }}</span></td>
                                        <td><span class="w-space-no">{{ $mail->type }}</span></td>
                                        <td><span class="w-space-no">{{ $mail->subject }}</span></td>
                                        <td><span class="w-space-no">{{ $mail->content }}</span></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>

                                                <a href="#" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
