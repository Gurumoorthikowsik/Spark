@include('common.inventory.inner_header')
@include('common.inventory.sidebar')
<style type="text/css">
.dataTables_wrapper { font-family: "--vz-body-font-family"}

.dt-buttons button {
    background: #0ab39c;
    color: white;
    border: #0ab39c;
    border-radius: 0.25rem;
    padding: 10px;
}
thead {
    background: #f3f6f9;
}
div#example_paginate span a.paginate_button.current {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #405189 !important;
    border-color: #405189 !important;
    font-weight: 500 !important;
}
a.paginate_button {
    border: 1px solid #e2e2ec !important;
    
}div#example_paginate a {
    margin: 5px 3px;
}
div.dt-buttons {
    float: left;
    padding-bottom: 16px;
}
button.dt-button:hover:not(.disabled){
    border: 1px solid #fff;
background: linear-gradient(to bottom, rgb(10 179 156) 0%, rgb(10 179 156) 100%);
}
table.dataTable.display>tbody>tr.odd>.sorting_1{
    box-shadow:unset !important;
}
table.dataTable.display tbody tr:hover>.sorting_1, table.dataTable.order-column.hover tbody tr:hover>.sorting_1 {
     box-shadow: unset !important; 
}
a#example_previous {
    border: 1px solid #e9ebec;
    background: white;
    color: #878a99 !important;
    border-radius: 0.25rem !important;
}
</style>

            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

<!-- ==========================================================Table Start====================================================================== -->
                <div class="page-content">
                    <div class="container-fluid">

                        <div class="card" id="contactList">
                            <div class="card-header">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-3">
                                        <h5 class="card-title mb-0">Mouse Details </h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">

                                                <div class="container">
                                                  <div class="row">
                                                    <div class="col-sm">
                                                       <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Mouse</button>
                                                    </div>
                                                    <div class="col-sm">
                                                      <select class="form-select" aria-label=".form-select-sm example">
                                                         <option value="all" <?php echo ($id == 1) ? 'selected' : ''; ?>>All</option>
                                                         <option value="available" <?php echo ($id == 'available') ? 'selected' : ''; ?>>Available</option>   
                                                      </select>
                                                    </div>
                                                    <div class="col-sm">
                                                     <!-- <div class="search-box">
                                                        <input type="text" class="form-control search" placeholder="Search for inventory...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div> -->
                                                    </div>
                                                  </div>
                                                </div>

                                            
                                            
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div id="table-gridjs">
                                            
                                 <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th class="sort" data-sort="id" scope=""></th> -->
                                                 <th class="sort" data-sort="id" scope="col">S.No</th>
                                                 <th class="sort" data-sort="form_name" scope="col">Brand</th>
                                                 <th class="sort" data-sort="name">Type</th>
                                                 <th class="sort" data-sort="currency_name">Serial No</th>
                                                 <th class="sort" data-sort="status">Status</th>

                                                 <th class="sort" data-sort="date">Created Date</th>
                                                 <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($mouse->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($mouse->get() as $value)
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->brand}}</td>
                                            <td class="name">{{$value->type}}</td>
                                            <td class="currency_name"><b>{{$value->serial_no}}</b></td>
                                            <td class="status">
                                                @if($value->status == 1)
                                                <span class="badge badge-soft-success text-uppercase">Active</span>
                                                @else
                                                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
                                                @endif
                                            </td>
                                            <td class="date">{{$value->created_at}}</td>

                                            <td class="action">
                                            <div class="d-flex gap-2">
                                                   
                                                    <div class="edit">
                                                        <a href="{{URL::to('/inventory/mouse_status')}}/{{encrypt_decrypt('encrypt',$value->id)}}"><button class="btn btn-sm btn-warning edit-item-btn"
                                                        >Status</button></a>
                                                    </div>
                                               

                                                    <div class="edit">
                                                        <a href="#" data-id="{{$value->id}}" title="Edit Task" class="edit_report"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
                                                    </div>
                                                  
                                                    <div class="remove">
                                                        <a onclick="return confirm('Are you sure you would delete the inventory ?');" href="{{URL::to('/inventory/delete_mouse')}}/{{encrypt_decrypt('encrypt',$value->id)}}"><button class="btn btn-sm btn-danger remove-item-btn">Remove</button></a>
                                                    </div>
                                           
                                            </div>
                                            </td>
                                           
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        @else
                                         <tr>
                                            <td></td><td></td><td></td>
                                            <td align="center">
                                                <h5 class="mt-2">Sorry! No Result Found</h5>     
                                            </td>
                                        </tr>
                                        @endif
                                                
                                        </tbody>
                                    </table><!--end table-->
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            
                                            
                                        </div>
                                    </div>
                                </div>




                                
                                </div>
                                    </div>
                                </div>
                                      
                                </div>
                                    </div>
                                <!-- <div class="d-flex justify-content-end mt-3">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div> -->
                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<!-- ==========================================================Table End====================================================================== -->
            </div>




        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Add Mouse Details</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('inventory/'); ?>/mouse" id="mouse-form" class="mouse-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">


                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Brand * </label>
                                <input type="text" class="form-control" name="brand" id="brand"
                                placeholder="Enter The Mouse Brand Name">
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Serial Number*</label>
                                <input type="text" class="form-control" name="serial_no" id="serial_no" placeholder="Enter The Mouse Serial Number">
                            </div> 

                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="mouse-btn" type="submit" name="mouse_btn" id="mouse_btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



     <div class="modal fade" id="edit_report_model" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Edit Mouse Details</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('inventory/'); ?>/edit_mouse" id="edit-mouse-form" class="edit-mouse-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Brand * </label>
                                <input type="text" class="form-control edit_brand" name="brand" id="brand"
                                placeholder="Enter The Mouse Brand Name">
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Serial Number*</label>
                                <input type="text" class="form-control edit_serial_no" name="serial_no" id="serial_no" placeholder="Enter The Mouse Serial Number">
                            </div> 

                            <input type="hidden" name="id" id="id" >
                            </div>
                            <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="mouse-btn" type="submit" name="mouse_btn" id="mouse_btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


@include('common.inventory.inner_footer')
<script type="text/javascript">


    $('.edit_report').click(function(){

        var id = $(this).attr("data-id");
        $.ajax({
            url: inv_url+"/edit_get_mouse/"+id,
            type: "POST",
            
             processData:false,
             contentType:false,
             cache:false,
             async:true,
            beforeSend: function() {
                $('#add_profile_btn').hide();
                $('#loader').show();
            },
            success: function (data) {                    
              var res = JSON.parse(data);
              
                if(res.status == 1){
                   
                   $('#id').val(res.id);
                   $('.edit_brand').val(res.brand);
                   $('.edit_serial_no').val(res.serial_no);
                   $('#edit_report_model').modal('show');

                }else{
                  
                  $.notify(res.msg, {className: 'error',clickToHide: true,});

                }
               
            
            }
        });
    })
</script>

<script type="text/javascript">
    $('select').on('change', function() {
      
      window.location.href = inv_url+"/mouse/"+this.value;

    });
</script>