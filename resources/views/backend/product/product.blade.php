@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-12 ">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-center">
                            <h4>Product Add</h4>
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

                            <form action="{{url('/add-product-post')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-2 col-form-label">Product
                                        Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product_name" value="{{old('product_name')}}"
                                            class="form-control @error('product_name') is-invalid @enderror"
                                            id="product_name" placeholder="Enter product name">
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

                                <div class="form-group row">
                                    <label for="subcategory_name" class="col-sm-2 col-form-label">Sub Category
                                        Name</label>
                                    <div class="col-sm-10">
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($subcategories as $subcategori)
                                            <option value="{{$subcategori->id}}">{{$subcategori->subcategory_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group row">
                                    <label for="product_summary" class="col-sm-2 col-form-label">Product Summary
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="product_summary" id="product_summary"
                                            class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="product_description" class="col-sm-2 col-form-label">Product Description
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="product_description" id="product_description"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="product_price" class="col-sm-2 col-form-label">Product Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product_price" value="{{old('product_price')}}"
                                            class="form-control @error('product_price') is-invalid @enderror"
                                            id="product_price" placeholder="Enter product price ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="product_quantity" class="col-sm-2 col-form-label">Product
                                        Quantity</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product_quantity" value="{{old('product_quantity')}}"
                                            class="form-control @error('product_quantity') is-invalid @enderror"
                                            id="product_quantity" placeholder="Enter product quantity ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="product_thumbnail" class="col-sm-2 col-form-label">Product
                                        Thumbnail</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="product_thumbnail" value="{{old('product_thumbnail')}}"
                                            class="form-control @error('product_thumbnail') is-invalid @enderror"
                                            id="product_thumbnail" placeholder="Enter product thumbnail "  onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="product_preview" class="col-sm-2 col-form-label">Product Preview</label>
                                    
                                    <div class="col-sm-10">
                                        <img id="img" alt="your image" width="100" height="100" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="product_gallary" class="col-sm-2 col-form-label">Product
                                        Gallary</label>
                                    <div class="col-sm-10">
                                        <input type="file" multiple name="product_gallary[]" value="{{old('product_gallary')}}"
                                            class="form-control @error('product_gallary') is-invalid @enderror"
                                            id="product_gallary" placeholder="Enter product gallary ">
                                    </div>
                                </div>


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
@endsection
