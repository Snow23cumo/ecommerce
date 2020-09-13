@extends('admin.admin_layouts')

@section('admin_content')
 
<div class="sl-mainpanel">
     
    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Post Table</h5>
       
      </div><!-- sl-page-title -->
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Post List
        <a href="{{ route('add.blogpost') }}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
        
        </h6>
         
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Post Image</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($post as $key=>$row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->post_title_en }}</td>
                    <td>{{ $row->category_name_en }}</td>
                  
                    <td> <img src="{{ URL::to($row->post_image) }}" height="70px;" width="80px;"> </td>
                    <td>
                        <a href="{{ URL::to('admin/edit/post/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{ URL::to('delete/post/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                        
                     </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          
        </div><!-- table-wrapper -->
        
      </div><!-- card -->
  </div><!-- sl-mainpanel -->
</div>
@endsection