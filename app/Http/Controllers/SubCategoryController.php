<?php

namespace App\Http\Controllers;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    function SubCategory(){
     $categories =  Category::orderBy('category_name','asc')->get();
        return view('backend.subcategory.subcategory',compact('categories'));
    }
    function SubCategoryPost(Request $request){
        SubCategory::insert([
            'subcategory_name' =>$request->subcategory_name,
            'category_id' =>$request->category_id,
            'created_at' =>Carbon::now(),
        ]);
        return back()->with('success','Sub Category Added Successfully');
    }
    function SubCategoryView(){
        $scount = SubCategory::count();
        // $categories = SubCategory::orderBy('subcategory_name','asc')->paginate(10);
        $categories = SubCategory::with('get_category')->paginate(10);
        return view('backend.subcategory.subcategory_view',compact('categories','scount'));
    }
    function SubCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();
        return back();
    }
    function SubCategoryEdit(){
        $categories = SubCategory::all();
        return view('backend.subcategory',compact('categories'));
    }
    function SubCategoryUpdate(){
        SubCategory::all();
        return view('backend.subcategory');
    }

    function SubCategoryDeleted(){
        $scount = SubCategory::onlyTrashed()->count();
        $categories = SubCategory::onlyTrashed()->paginate(10);
        return view('backend.subcategory.subcategory_deleted',compact('categories','scount'));
    }

    function SubCategoryRestore($id){
        SubCategory::withTrashed()->findOrFail($id)->restore();
        return back()->with('restore','Data Restore Successfully');
    }
    function SubCategoryPdeleted($id){
        SubCategory::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('pdelete','Data Parmanent Delete Successfully');
    }
}
