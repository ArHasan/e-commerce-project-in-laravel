@extends('frontend.master')

 @section('title')
 All Products | ArH
 @endsection
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>All Products</h2>
                        <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach($categories as  $value)
                            <li>
                            <a data-toggle="tab" href="#chair{{$value->id}}">{{$value->category_name}}</a>
                            </li>
                            @endforeach
                        
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">

                        @foreach($products as $key=> $item)
                        <li class="col-xl-3 col-lg-4 col-sm-6 col-12  @if($key>7) moreload @endif">
                            <div class="product-wrap">
                                <div class="product-img">
                                
                                    <img src="{{url('img/thumbnail').'/'.$item->product_thumbnail}}" alt="{{$item->product_name}}">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                            <li><a href=""><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{route('SingleCart',$item->id)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                <h3><a href="{{route('single-product',$item->slug)}}">{{$item->product_name}}</a></h3>
                                    <p class="pull-left">${{$item->product_price}}

                                    </p>
                                    <ul class="pull-right d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-half-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </li>  
                        @endforeach
                        
                        
                        <li class="col-12 text-center">
                            <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                        </li>
                    </ul>
                </div>
                @foreach($categories as  $value2)
                
                <div class="tab-pane" id="chair{{$value2->id}}">
                    <ul class="row">
                        @foreach(App\Product::where('category_id',$value2->id)->get() as $key=> $items)
                        <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                            <div class="product-wrap">
                                <div class="product-img">
                                   
                                    <img src="{{url('img/thumbnail').'/'.$items->product_thumbnail}}" alt="{{$items->product_name}}">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                            <li><a href=""><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{route('SingleCart',$items->id)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('single-product',$items->slug)}}">{{$items->product_name}}</a></h3>
                                    <p class="pull-left">${{$items->product_price}}

                                    </p>
                                    <ul class="pull-right d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-half-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
               
                @endforeach
            </div>
        </div>
    </div>
    <!-- product-area end -->
@endsection