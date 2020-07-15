<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\Category;
use App\Cart;
use Carbon\Carbon;  


class FrontendController extends Controller
{
    function FrontPage(){
        // $product = product::limit(8)->get();
        $product = product::all();
        return view('frontend.main',compact('product'));
    }

    function singleProduct($slug){
        $product = product::where('slug',$slug)->first();
        $title = $product->product_name;
        $related_product = product::where('category_id',$product->category_id)->limit(4)->inRandomOrder()->get();
        return view('frontend.single-product',compact('product','title','related_product'));
    }

    function shop(){
        $categories = Category::orderBy('category_name','asc')->get();
        $products = Product::orderBy('product_name','asc')->get();
        return view('frontend.shop',compact('categories','products'));
    } 

    function SingleCart($product_id){
      $user_ip = $_SERVER['REMOTE_ADDR'];
      if(Cart::where('product_id',$product_id)->where('user_ip',$user_ip)->exists()){
        Cart::where('product_id',$product_id)->where('user_ip',$user_ip)->increment('product_quantity');
      }
      else{
        Cart::insert([
            'product_id'=>$product_id,
            'user_ip'=>$user_ip,
            'created_at'=>Carbon::now(),
        
        ]);
      }
        return back();
    }

   
 
}
