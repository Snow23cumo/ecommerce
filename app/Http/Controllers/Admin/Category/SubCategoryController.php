<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
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
    public function subcategories()
    {
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')->join('categories','subcategories.category_id','categories.id')->select('subcategories.*','categories.category_name')->get(); 

        return view('admin.category.subcategory', compact('category','subcat'));
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
    public function storesubcat(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name'=>'required'
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;

        DB::table('subcategories')->insert($data);

        $notification=array(
            'messege'=>'Subcategory Inserted Successfully',
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
    public function editsubcat($id)
    {
        $subcat = DB::table('subcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        return view('admin.category.edit_subcat', compact('subcat','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesubcat(Request $request, $id)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;

        DB::table('subcategories')->where('id',$id)->update($data);

        $notification=array(
            'messege'=>'Subcategory Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('subcategories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletesubcat($id)
    {
        DB::table('subcategories')->where('id',$id)->delete();

        $notification=array(
            'messege'=>'Subcategory Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
