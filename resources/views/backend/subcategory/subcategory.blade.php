@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="container ">
            <div class="row justify-content-md-center">
                <div class="col-md-12 mt-5">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-center">
                            <h4>Add SubCategory</h4>
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
                            @if(session('update'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>!</strong> {{session('update')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form action="{{url('/add-subcategory-post')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="subcategory_name" class="col-sm-2 col-form-label">Sub Category
                                        Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="subcategory_name" value="{{old('subcategory_name')}}"
                                            class="form-control @error('subcategory_name') is-invalid @enderror"
                                            id="subcategory_name" placeholder="Enter Subcategory name">
                                    </div>
                                </div>
                                @error('subcategory_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group row">
                                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary ">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
