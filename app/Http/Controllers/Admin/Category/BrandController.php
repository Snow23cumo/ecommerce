<?php

namespace App\Http\Controllers\Admin\Category;

use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BrandController extends Controller
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
    public function brand()
    {
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
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
    public function storebrand(Request $request)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        
             ]);
        
             $data = array();
             $data['brand_name'] = $request->brand_name;
             $image = $request->file('brand_logo');
             if ($image) {
               $image_name = date('dmy_H_s_i');
               $ext = strtolower($image->getClientOriginalExtension());
               $image_full_name = $image_name.'.'.$ext;
               $upload_path = 'public/media/brand/';
               $image_url = $upload_path.$image_full_name;
               $success = $image->move($upload_path,$image_full_name);
        
               $data['brand_logo'] = $image_url;
               $brand = DB::table('brands')->insert($data);
                $notification=array(
                    'messege'=>'Brand Inserted Successfully',
                    'alert-type'=>'success'
                     );
                   return Redirect()->back()->with($notification);
             }else{
                  $brand = DB::table('brands')->insert($data);
                  $notification=array(
                    'messege'=>'Its Done',
                    'alert-type'=>'success'
                     );
                   return Redirect()->back()->with($notification);
             }
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
    public function editbrand($id)
    {
        $brand = DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatebrand(Request $request, $id)
    {
        $oldlogo = $request->old_logo;
        $data = array();
             $data['brand_name'] = $request->brand_name;
             $image = $request->file('brand_logo');
             if ($image) {
                 //unlink($oldlogo);
               $image_name = date('dmy_H_s_i');
               $ext = strtolower($image->getClientOriginalExtension());
               $image_full_name = $image_name.'.'.$ext;
               $upload_path = 'public/media/brand/';
               $image_url = $upload_path.$image_full_name;
               $success = $image->move($upload_path,$image_full_name);
        
               $data['brand_logo'] = $image_url;
               $brand = DB::table('brands')->where('id',$id)->update($data);
                $notification=array(
                    'messege'=>'Brand Updated Successfully',
                    'alert-type'=>'success'
                     );
                   return Redirect()->route('brands')->with($notification);
             }else{
                  $brand = DB::table('brands')->where('id',$id)->update($data);
                  $notification=array(
                    'messege'=>'Update Without Images',
                    'alert-type'=>'success'
                     );
                   return Redirect()->route('brands')->with($notification);
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletebrand($id)
    {
        $data = DB::table('brands')->where('id',$id)->first();
        $image = $data->brand_logo;
        unlink($image);
        $brand = DB::table('brands')->where('id',$id)->delete();
        $notification=array(
                 'messege'=>'Brand Deleted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification); 
    }
}
