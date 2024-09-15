@extends('dashboard.layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="" class="disabled">Mail Configuration</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">Mail IMAP</a></li>
</ol>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Mail IMAP Configuration</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mail.imap.store') }}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">IMAP Mailer</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('imap_mailer') is-invalid @enderror" placeholder="example: smtp" name="imap_mailer">
                                        @error('imap_mailer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">IMAP Host</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('imap_host') is-invalid @enderror" placeholder="example: imap.gmail.com" name="imap_host">
                                        @error('imap_host')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">IMAP Port</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('imap_port') is-invalid @enderror" placeholder="example: 993" name="imap_port">
                                        @error('imap_port')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">IMAP Username</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('imap_username') is-invalid @enderror" placeholder="example: imap.gmail.com" name="imap_username">
                                        @error('imap_username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">IMAP Password</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('imap_password') is-invalid @enderror" name="imap_password">
                                        @error('imap_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">IMAP Encryption</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="imap_encryption" placeholder="example: ssl">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-sm-6 col-form-label">IMAP Protocol</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control @error('imap_protocol') is-invalid @enderror" placeholder="example: imap" name="imap_protocol">
                                    @error('imap_protocol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
