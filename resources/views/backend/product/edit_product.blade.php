@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12 ">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-center">
                        <h4>Product Edit</h4>
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

                        <form action="{{route('ProductUpdate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="product_name" class="col-sm-2 col-form-label">Product
                                    Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="product_name" value="{{$product->product_name}}"
                                        class="form-control @error('product_name') is-invalid @enderror"
                                        id="product_name" placeholder="Enter product name">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-10">
                                    <select name="category_id" id="category_id" class="form-control">

                                        @foreach($categories as $category)
                                        <option @if($category->id == $product->category_id)selected @endif
                                            value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="subcategory_name" class="col-sm-2 col-form-label">Sub Category
                                    Name</label>
                                <div class="col-sm-10">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">

                                        @foreach($subcategories as $subcategori)
                                        <option @if($subcategori->id == $product->subcategory_id)selected @endif
                                            value="{{$subcategori->id}}">{{$subcategori->subcategory_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="product_summary" class="col-sm-2 col-form-label">Product Summary
                                </label>
                                <div class="col-sm-10">
                                    <textarea name="product_summary" id="product_summary"
                                class="form-control">{{$product->product_summary}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_description" class="col-sm-2 col-form-label">Product Description
                                </label>
                                <div class="col-sm-10">
                                    <textarea name="product_description" id="product_description"
                                        class="form-control">{{$product->product_description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_price" class="col-sm-2 col-form-label">Product Price</label>
                                <div class="col-sm-10">
                                    <input type="text" name="product_price" value="{{$product->product_price}}"
                                        class="form-control @error('product_price') is-invalid @enderror"
                                        id="product_price" placeholder="Enter product price ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_quantity" class="col-sm-2 col-form-label">Product
                                    Quantity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="product_quantity" value="{{$product->product_quantity}}"
                                        class="form-control @error('product_quantity') is-invalid @enderror"
                                        id="product_quantity" placeholder="Enter product quantity ">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_thumbnail" class="col-sm-2 col-form-label">Product
                                    Thumbnail</label>
                                <div class="col-sm-10">
                                    <input type="file" name="product_thumbnail" 
                                        class="form-control @error('product_thumbnail') is-invalid @enderror"
                                        id="product_thumbnail" placeholder="Enter product thumbnail "
                                        onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_preview" class="col-sm-2 col-form-label">Product Preview</label>

                                <div class="col-sm-10">
                                <img src="{{url('img/thumbnail').'/'.$product->product_thumbnail ?? ''}}" id="img" alt="your image" width="100" height="100" />
                                </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary ">update</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
