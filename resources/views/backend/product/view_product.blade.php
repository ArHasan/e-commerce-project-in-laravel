@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-center">
                        <h4 class="text-white"><b>Product List</b></h4>
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Sub Cat</th>
                                    <th scope="col">price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key=> $items)
                                <tr>
                                    <th scope="row">{{$products->firstItem() + $key}}</th>
                                    <td>{{ $items->product_name}}</td>
                                    {{-- Subcategory table-> category table -> category_name --}}
                                    <td>{{ $items->get_category->category_name}}</td>
                                    <td>{{ $items->get_subcategory->subcategory_name}}</td>
                                    <td>${{ $items->product_price}}</td>
                                    <td>{{ $items->product_quantity}}</td>
                                    <td><img src="{{url('/img/thumbnail/').'/'.$items->product_thumbnail }}" alt="image"
                                            width="100"></td>
                                    <td>
                                    <a href="{{url('/items')}}/{{$items->slug}}" target="_blank"
                                            class="btn btn-success">View</a>
                                        <a href="{{url('edit-product')}}/{{$items->id}}"
                                            class="btn btn-warning">Edit</a>
                                        <a href="{{url('/delete-product')}}/{{$items->id}}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>

                        </table>
                        {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
