<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function __construct(){
        $this->middleware('verified');
    }

    function category(){
        return view('backend.category');
    }
    
    function CategoryPost(Request $request){
        // $cat = new category;
        // $cat->category_name = $request->name;
        // $cat->save();

        // From Validation
        $request->validate([
            'category_name' => ['required','min:3','max:30','unique:categories'],
        ],[ 'category_name.required' => 'তুমি ইনপুট দেও নি ?',
            'category_name.min' =>'Your Enter Uper then 3 latter'    
        ]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
        Category::insert([
            'category_name' =>$request->category_name,
            'created_at' =>Carbon::now(), 
            ]);
        return back()->with('success','Added Category Successfully');
    }

    function CategoryView(){
        // $category = Category::all();
        $category = Category::orderBy('category_name','asc')->paginate(3);;
        return view('backend.view_category',compact('category'));
    }

    function CategoryDelete($id){
        // "DELETE FROM user  WHERE id = $id"
        // findOrFail() function working only for ID
        // Others where function Like slug find and delete
        // Category::findOrFail($id)->delete();
        Category::where('id',$id)->delete();
        return back()->with('success','Delete Category Successfully');
    }

    function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.edit_category',compact('category'));
    }

    function CategoryUpdate(Request $request){
        $id = $request->category_id;
        Category::findOrFail($id)->update([
            'category_name' =>$request->category_name,
        ]);
        return redirect('view-category-list')->with('update','Updated data successfully');
   }
        
 }

 