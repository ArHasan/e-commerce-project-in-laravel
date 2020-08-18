@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="container ">
            <div class="row justify-content-md-center">
                <div class="col-md-12 mt-5">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-center">
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>!</strong> {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{url('/update-category-post')}}" method="post">
                            @csrf
                        <input type="hidden" value="{{$category->id}}" name="category_id">

                            <div class="form-group">
                                <label for="name">Name</label>
                            <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control @error('category_name') is-invalid @enderror"
                                    id="name" placeholder="Enter name">
                            </div>
                            @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
