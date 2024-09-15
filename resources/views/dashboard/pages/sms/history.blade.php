@extends('dashboard.layouts.app')
@section('content')
{{-- <div class="container-fluid"> --}}
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="disabled" class="disabled">SMS</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">History</a></li>
        </ol>
        <div class="col-lg-12">
            <div class="card">
                @if(session('danger'))
                    <div class="alert alert-danger">{{ session('danger') }}</div>
                @endif

                <div class="card-header">
                    <h4 class="card-title">
                        SMS History List
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Sl. No</strong></th>
                                    <th><strong>Sender</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Receiver Name</strong></th>
                                    <th><strong>Receiver Number</strong></th>
                                    <th><strong>Receiver Address</strong></th>
                                    <th><strong>Type</strong></th>
                                    <th><strong>Message</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td><strong>1</strong></td>

                                        <td><span class="w-space-no">Synex Digital</span></td>

                                        <td><span class="w-space-no">Jubayer</span></td>

                                        <td><span class="w-space-no">jubayer@gmail.com</span></td>

                                        <td><span class="w-space-no">01748296345</span></td>

                                        <td><span class="w-space-no">Songkor, Dhaka</span></td>

                                        <td></td>

                                        <td><span class="w-space-no">Web Developer</span></td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>

                                                <a href="#" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
