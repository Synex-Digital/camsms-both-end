@extends('dashboard.layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
</ol>
    <!-- {{-- <div class="container-fluid"> --}} -->
        <div class="row">

                <div class="col-lg-5">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="card-header">
                            <h4 class="card-title">Create Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.store')}}" method="POST">
                            @csrf
                                <div class="form-group row">
                                    <label for="formFile" class="form-label">Category Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" type="text" name="name">
                                        @error('name')
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


                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class='card-title'>All Categories</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th><strong>Sl. No</strong></th>
                                            <th><strong>Category Name</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $sl => $category)
                                            <tr>
                                                <td>{{ $sl+1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td><span class="badge badge-primary">Active</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
@endsection


