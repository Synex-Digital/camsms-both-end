@extends('dashboard.layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="" class="disabled">Mail Configuration</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">Sender Mail Configuration</a></li>
</ol>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Sender Mail Configuration</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sender.mail.store') }}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Mail Mailer</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('mail_mailer') is-invalid @enderror" value="smtp" name="mail_mailer">
                                        @error('mail_mailer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Mail Host</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('mail_host') is-invalid @enderror" placeholder="example: imap.gmail.com" name="mail_host">
                                        @error('mail_host')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Mail Port</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('mail_port') is-invalid @enderror" placeholder="example: 2525" name="mail_port">
                                        @error('mail_port')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Mail Username</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('mail_username') is-invalid @enderror" placeholder="example: imap.gmail.com" name="mail_username">
                                        @error('mail_username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Mail Password</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('mail_password') is-invalid @enderror" name="mail_password">
                                        @error('mail_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Mail Encryption</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="mail_encryption" placeholder="example: ssl">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-sm-6 col-form-label">From Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control @error('mail_from_address') is-invalid @enderror" placeholder="example: WYHkP@example.com" name="mail_from_address">
                                    @error('mail_from_address')
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
