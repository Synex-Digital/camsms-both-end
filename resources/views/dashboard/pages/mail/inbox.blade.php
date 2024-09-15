@extends('dashboard.layouts.app')
@section('content')
{{-- <div class="container-fluid"> --}}
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="disabled" class="disabled">Mail</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Inbox</a></li>
        </ol>
        <div class="col-lg-12">
            <div class="card">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card-header">
                    <h4 class="card-title">
                        Mail Inbox List
                    </h4>
                </div>
                <div class="card-body">
                    @if (!empty($emails) && count($emails) > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Sl. No</strong></th>
                                        <th><strong>Subject</strong></th>
                                        <th><strong>From</strong></th>
                                        <th><strong>Date</strong></th>

                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $email['subject'] }}</td>
                                            <td>{{ $email['from'] }}</td>
                                            <td>{{ $email['date'] }}</td>
                                            
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
                    @else
                        <div class="alert alert-danger">No Email Found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
