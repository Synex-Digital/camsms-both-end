@extends('dashboard.layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="" class="disabled">Mail</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">Send</a></li>
</ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Send Mail</h4>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('mail.send.store') }}" method="POST">
                        @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mail To</label>
                                <input type="text" class="form-control @error('to') is-invalid @enderror" name="to" id="">
                                @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label">Category</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            <option value="" disabled>If category is not in the list, than firstly add the category's information</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label">Type</label>
                                    <input type="text" class="form-control" name="type" id="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="">
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Message</label>
                                <textarea class="from-control custom-code  @error('content') is-invalid @enderror" rows="5" name="content" value=""></textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
