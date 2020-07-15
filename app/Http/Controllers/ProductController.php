<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductGallery;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{

    public function Product()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategories = SubCategory::orderBy('subcategory_name', 'asc')->get();
        return view('backend.product.product', compact('categories', 'subcategories'));
    }

    public function ProductPost(Request $request)
    {

        $slug = strtolower(str_replace(' ', '-', $request->product_name));
        $slug_check = Product::where('slug', $slug)->count();

        if ($slug_check >0) {
            $slug = $slug.'-'.time();
        }

        if ($request->hasfile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $ext = $slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(600, 622)->save(public_path('/img/thumbnail/'.$ext));

            $product_id = Product::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'slug' => $slug,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_thumbnail' => $ext,
                'created_at' => Carbon::now(),
            ]);

            if ($request->hasfile('product_gallary')) {
                $img = $request->file('product_gallary');
                foreach($img as $key=> $item) {
                    $ext2 = time().$key.'.'. $item->getClientOriginalExtension();
                    Image::make($item)->resize(600, 622)->save(public_path('/img/gallery/'.$ext2));
                    ProductGallery::insert([
                        'product_id'=> $product_id,
                        'product_gallary' =>$ext2,
                        'created_at' => Carbon::now()
                    ]);
                }
            }
            
        } 
        
        else {
            $product_id = Product::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'slug' => $slug,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'created_at' => Carbon::now(),
            ]);

            if ($request->hasfile('product_gallary')){
                $img2 = $request->file('product_gallary');
                foreach($img2 as $key=> $items) {
                  echo  $ext3 = time().$key.'.'. $items->getClientOriginalExtension();
                    Image::make($item)->resize(600, 622)->save(public_path('/img/gallery/' . $ext2));

                    ProductGallery::insert([
                        'product_id'=> $product_id,
                        'product_gallary' =>$ext2,
                        'created_at' => Carbon::now()
                    ]);
                }
            }
        }

        // return back();
        return 'ok';
    }

    public function ProductView()
    {
        $products = Product::paginate();
        return view('backend.product.view_product', compact('products'));
    }

    public function ProductEdit($pro_id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $product = product::FindOrFail($pro_id);
        session(['pro_id' => $pro_id]);
        return view('backend.product.edit_product', compact('categories', 'subcategories', 'product'));
    }

    public function ProductUpdate(Request $request)
    {

        $id = $request->session()->get('pro_id');

        $old_product = Product::findOrFail($id);

        $slug = $old_product->slug;
        $old_img = $old_product->product_thumbnail;

        if ($request->hasfile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $ext = $slug . '.' . $image->getClientOriginalExtension();
            if(file_exists(public_path('img/thumbnail/').$old_img)){
                unlink(public_path('img/thumbnail/').$old_img);
            }
            Image::make($image)->resize(600, 622)->save(public_path('/img/thumbnail/' . $ext));

            Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_thumbnail' => $ext,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'updated' => Carbon::now(),
            ]);
        }
        return redirect('view-product-list');
    }

    function ProductDelete($id){
        Product::findOrFail($id)->delete();
        return back();
    }
}
