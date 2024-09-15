@extends('dashboard.layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="" class="disabled">Contact</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
</ol>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Create Contact</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Contact Name" name="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" placeholder="Enter Contact Email" name="email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Contact Number</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control @error('number') is-invalid @enderror" placeholder="Enter Contact Number" name="number">
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Category Name</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            <option value="" disabled>If category is not in the list, than firstly add the category's information</option>
                                        </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Contact Address" name="address">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 col-form-label">Avatar</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" name="avatar">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Note</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="If you have any note, take down" name="note">
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
