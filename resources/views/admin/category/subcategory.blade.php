@extends('admin.admin_layouts')

@section('admin_content')

 <div class="sl-mainpanel">
     

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Sub Category Table</h5>
         
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Sub Category List
  <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
          </h6>
           

          <div class="table-wrapper">
            <div id="datatable1_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="datatable1_length"><label><select name="datatable1_length" aria-controls="datatable1" class="select2-hidden-accessible" tabindex="-1" aria-hidden="true"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 48px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-datatable1_length-xk-container"><span class="select2-selection__rendered" id="select2-datatable1_length-xk-container" title="10">10</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> items/page</label></div><div id="datatable1_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="datatable1"></label></div><table id="datatable1" class="table display responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable1_info" style="width: 987px;">
            
            </tbody>
          </table>
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Sub Category name</th>
                  <th class="wd-15p">Category name</th>
                  <th class="wd-20p">Action</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($subcat as $key=>$row)
                <tr>
                  <td>{{ $key +1 }}</td>
                  <td>{{ $row->subcategory_name }}</td>
                   <td>{{ $row->category_name }}</td>
                  <td>
                    <a href="{{ URL::to('edit/subcategory/'.$row->id) }} " class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ URL::to('delete/subcategory/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                  </td>
                   
                </tr>
                @endforeach
                 
              </tbody>
            </table>
            <div class="dataTables_info" id="datatable1_info" role="status" aria-live="polite">Showing 41 to 50 of 57 entries</div><div class="dataTables_paginate paging_simple_numbers" id="datatable1_paginate"><a class="paginate_button previous" aria-controls="datatable1" data-dt-idx="0" tabindex="0" id="datatable1_previous">Previous</a><span><a class="paginate_button " aria-controls="datatable1" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="3" tabindex="0">3</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="4" tabindex="0">4</a><a class="paginate_button current" aria-controls="datatable1" data-dt-idx="5" tabindex="0">5</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="6" tabindex="0">6</a></span><a class="paginate_button next" aria-controls="datatable1" data-dt-idx="7" tabindex="0" id="datatable1_next">Next</a></div></div>
          </div><!-- table-wrapper -->
        </div><!-- card -->

        

 
    </div><!-- sl-mainpanel -->



  <!-- LARGE MODAL -->
        <div id="modaldemo3" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Sub Category Add</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
             
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
       <form method="post" action="{{ route('store.subcategory') }}">
        @csrf
         <div class="modal-body pd-20"> 
        <div class="form-group">
          <label for="exampleInputEmail1">Sub Category Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sub Category" name="subcategory_name">
          
        </div>



        <div class="form-group">
          <label for="exampleInputEmail1">Category Name</label>
           <select class="form-control" name="category_id">
         
          @foreach($category as $row)
          <option value="{{ $row->id }}"> {{ $row->category_name }}  </option> 
          @endforeach  

           </select>
          
        </div>
          
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Sumbit</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
                </form>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->

 

@endsection