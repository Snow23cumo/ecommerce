@extends('admin.admin_layouts')

@section('admin_content')
 
<div class="sl-mainpanel">
     
    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Products List</h5>
       
      </div><!-- sl-page-title -->
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Product List
        <a href="{{ route('add.product') }}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
        
        </h6>
         
        <div class="table-wrapper">
            <div id="datatable1_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="datatable1_length"><label><select name="datatable1_length" aria-controls="datatable1" class="select2-hidden-accessible" tabindex="-1" aria-hidden="true"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 48px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-datatable1_length-xk-container"><span class="select2-selection__rendered" id="select2-datatable1_length-xk-container" title="10">10</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> items/page</label></div><div id="datatable1_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="datatable1"></label></div><table id="datatable1" class="table display responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable1_info" style="width: 987px;">
            
                </tbody>
              </table>

          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Status</th>
                <th class="width70">Opciones</th>
               
              </tr>
            </thead>
            
            <tbody>
                @foreach ($product as $row)
                <tr>
                   
                    <td>{{ $row->product_code }}</td>
                    <td>{{ $row->product_name }}</td>
                    <td> <img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"> </td>
                    <td>{{ $row->category_name }}</td>
                    <td>{{ $row->brand_name }}</td>
                    <td>{{ $row->product_quantity }}</td>
                    <td>
                   @if ($row->status == 1)
                       <span class="badge badge-success">Active</span>  
                       @else
                       <span class="badge badge-danger">Inactive</span>
                   @endif
                  </td>
                  <td>
                    <a href="{{ URL::to('edit/product/'.$row->id) }} " class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                    <a href="{{ URL::to('delete/product/'.$row->id) }}" class="btn btn-sm btn-danger" title="delete" id="delete"><i class="fa fa-trash"></i></a>
                  
                    <a href="{{ URL::to('view/product/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>
                  
                                @if($row->status == 1)
                     <a href="{{ URL::to('inactive/product/'.$row->id) }}" class="btn btn-sm btn-danger" title="Inactive" ><i class="fa fa-thumbs-down"></i></a>
                                @else
                      <a href="{{ URL::to('active/product/'.$row->id) }}" class="btn btn-sm btn-info" title="Active" ><i class="fa fa-thumbs-up"></i></a>
                                @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="dataTables_info" id="datatable1_info" role="status" aria-live="polite">Showing 41 to 50 of 57 entries</div><div class="dataTables_paginate paging_simple_numbers" id="datatable1_paginate"><a class="paginate_button previous" aria-controls="datatable1" data-dt-idx="0" tabindex="0" id="datatable1_previous">Previous</a><span><a class="paginate_button " aria-controls="datatable1" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="3" tabindex="0">3</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="4" tabindex="0">4</a><a class="paginate_button current" aria-controls="datatable1" data-dt-idx="5" tabindex="0">5</a><a class="paginate_button " aria-controls="datatable1" data-dt-idx="6" tabindex="0">6</a></span><a class="paginate_button next" aria-controls="datatable1" data-dt-idx="7" tabindex="0" id="datatable1_next">Next</a></div></div>
        </div><!-- table-wrapper -->
      </div><!-- card -->
  </div><!-- sl-mainpanel -->
 
@endsection