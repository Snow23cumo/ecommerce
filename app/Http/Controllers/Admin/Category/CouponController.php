<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CouponController extends Controller
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
    public function coupon()
    {
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newslater()
    {
        $sub = DB::table('newslaters')->get();
        return view('admin.coupon.newslater',compact('sub'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecoupon(Request $request)
    {

        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);

        $notification=array(
            'messege'=>'Coupon Added Successfully',
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
    public function editcoupon($id)
    {
        $coupon = DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatecoupon(Request $request, $id)
    {
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->where('id',$id)->update($data);

        $notification=array(
            'messege'=>'Coupon Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('coupons')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletecoupon($id)
    {
        DB::table('coupons')->where('id',$id)->delete();

        $notification=array(
            'messege'=>'Coupon Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deletesub($id)
    {
        DB::table('newslaters')->where('id',$id)->delete();

        $notification=array(
            'messege'=>'Subscriber Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
