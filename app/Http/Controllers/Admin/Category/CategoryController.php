<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $category = Category::orderBy('id')->get();
        return view('admin.category.category', compact('category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecategory(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        $category = new Category();
        $category->category_name=$request->category_name;
        $category->save();

        $notification=array(
            'messege'=>'Category Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editcategory($id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatecategory(Request $request, $id)
    { $validateData = $request->validate([
        'category_name' => 'required|max:255',
         ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $update=DB::table('categories')->where('id',$id)->update($data);
        if ($update) {
            $notification=array(
                    'messege'=>'Category Updated Successfully',
                    'alert-type'=>'success'
                    );
                return Redirect()->route('categories')->with($notification);
        }else{
            $notification=array(
                    'messege'=>'Nothing To Update',
                    'alert-type'=>'error'
                    );
                return Redirect()->route('categories')->with($notification);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletecategory($id)
    {
        DB::table('categories')->where('id',$id)->delete();

        $notification=array(
            'messege'=>'Category Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
