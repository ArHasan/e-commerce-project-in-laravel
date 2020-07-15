@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="container ">
            <div class="row justify-content-md-center">
                <div class="col-md-12 mt-5">
                    <div class="card bg-light mb-3">

                        <div class="card-header bg-primary text-center">
                            <h4>Add Category</h4>
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

                            <form action="{{url('/add-category-post')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="category_name" value="{{old('category_name')}}"
                                            class="form-control @error('category_name') is-invalid @enderror" id="name"
                                            placeholder="Enter Category name">
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
    </div> <!-- container -->

</div> <!-- content -->

@endsection
