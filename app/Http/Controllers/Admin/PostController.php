<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PostController extends Controller
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
    public function blogcatlist()
    {
        $blogcat = DB::table('post_category')->get();

        return view('admin.blog.category.index', compact('blogcat'));
    }

    public function index()
    {
        $post = DB::table('posts')
        ->join('post_category','posts.category_id','post_category.id')
        ->select('posts.*','post_category.category_name_en')
        ->get();
        return view('admin.blog.index', compact('post'));
    }
    public function store(Request $request)
    {
        $data=array();
        $data['post_title_en']=$request->post_title_en;
        $data['post_title_in']=$request->post_title_in;
        $data['category_id']=$request->category_id;
        $data['details_en']=$request->details_en;
        $data['details_in']=$request->details_in;

        $post_image = $request->file('post_image');
        if ($post_image) {
            $post_image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(300, 300)->save('public/media/post/' . $post_image_name);
            $data['post_image'] = 'public/media/post/' . $post_image_name;

            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Post Inserted Successfully',
                'alert-type'=>'success'
                );
                return Redirect()->route('all.blogpost')->with($notification);
        }else{
            $data['post_image']='';
            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Post Inserted Without Image',
                'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
        }
           
               
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogcategory = DB::table('post_category')->get();
        return view('admin.blog.create',compact('blogcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogcatstore(Request $request)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_in' => 'required|max:255'
        ]);

        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_in'] = $request->category_name_in;

        DB::table('post_category')->insert($data);

        $notification=array(
            'messege'=>'Blog Category Added Successfully',
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
    public function delete($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        $image1 = $post->post_image;
        unlink($image1);
        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
                 'messege'=>'Post Deleted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification); 
    }
    public function edit($id)
    {
        $postedit = DB::table('posts')->where('id', $id)->first(); 
        return view('admin.blog.edit',compact('postedit'));
    }
    public function update(Request $request, $id)
    {

        $oldimage = $request->old_image;

        $data = array();
          $data['post_title_en'] = $request->post_title_en;
          $data['post_title_in'] = $request->post_title_in;
          $data['category_id'] = $request->category_id;
          $data['details_en'] = $request->details_en;
          $data['details_in'] = $request->details_in;
        
          $post_image = $request->file('post_image');
        
          if ($post_image) {
              unlink($oldimage);
             $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
             Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
             $data['post_image'] = 'public/media/post/'.$post_image_name;
        
             DB::table('posts')->where('id',$id)->update($data);
             $notification=array(
                    'messege'=>'Post Updated Successfully',
                    'alert-type'=>'success'
                     );
                   return Redirect()->route('all.blogpost')->with($notification);
        
          }else{
              $data['post_image']= $oldimage;
               DB::table('posts')->where('id',$id)->update($data);
             $notification=array(
                    'messege'=>'Post Updated Without Image',
                    'alert-type'=>'success'
                     );
                    return Redirect()->route('all.blogpost')->with($notification);
         
               } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editblogcategory($id)
    {
        $blogcat = DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.category.edit', compact('blogcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateblogcategory(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_in' => 'required|max:255'
             ]);
    
            $data=array();
            $data['category_name_en']=$request->category_name_en;
            $data['category_name_in']=$request->category_name_in;
            $update=DB::table('post_category')->where('id',$id)->update($data);
            if ($update) {
                $notification=array(
                        'messege'=>'Blog Category Updated Successfully',
                        'alert-type'=>'success'
                        );
                    return Redirect()->route('add.blog.categorylist')->with($notification);
            }else{
                $notification=array(
                        'messege'=>'Nothing To Update',
                        'alert-type'=>'error'
                        );
                    return Redirect()->route('add.blog.categorylist')->with($notification);
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteblogcategory($id)
    {
        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
                 'messege'=>'Blog Category Deleted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification); 
    }
}
