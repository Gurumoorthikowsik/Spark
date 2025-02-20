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
                                        <h5 class="card-title mb-0">Add Accesories</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                           
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Accessories</button>
                                          
                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for transactions...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div> -->
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->


                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div id="table-gridjs">
                                            
                                 <table id="brand" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="sort" data-sort="id" scope="col">S.No</th>
                                                <th class="sort" data-sort="form_name" scope="col">Accessories</th>                                               
                                                 <th class="sort" data-sort="date">Created Date</th>
                                                 <th class="sort" data-sort="action">Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($add_accessories->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($add_accessories->get() as $value)
                                       
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->accessories_name}}</td>
                                            <td class="name">{{$value->created_at}}</td>                                          
                                            <td class="action">              
                                                 <a href="#" data-id="{{$value->id}}" days="{{$value->accessories_name}}" dates="{{date('Y-M',strtotime($value->created_at))}}"  data-bs-toggle="modal" class="edit-add-brand" id="create-btn" data-bs-target="#showModaledit" ><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>                                                                                      
                                                 <a onclick="return confirm('Are you sure you would delete the day ?');" href="{{URL::to('/delete_add_access')}}/{{$value->id}}"><button class="btn btn-sm btn-danger remove-item-btn">Remove</button></a>
                                            </td>                                      
                                                                              
                                        </tr>
                                     
                                        @php $i++; @endphp
                                        @endforeach
                                        @else
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
                    <div class="modal-header bg-light p-3"> <h4>Add Accessories</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('inventory/'); ?>/edit_add_access" id="add_access" class="laptop-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="customername-field" class="form-label"> Accessories * </label>
                                <input type="text" class="form-control" name="accessories_name" id="accessories_name" class="hhhhhh"
                                placeholder="Enter The Brand Name">
                            </div>                        

                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="working_day_btn" type="submit" name="working_day_btn"  class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



<!-- Edit Modal -->

<div class="modal fade" id="showModaledit" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Edit Accessories List</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/edit_add_access" id="edit_add-brand-form" class="edit_add-brand-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <!-- <div class="mb-3">
                                <label for="customername-field" class="form-label">Date * </label>
                                <input type="text" class="form-control date" name="date"  id="date">
                            </div> -->


                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Accessories Name * </label>
                                <input type="text" class="form-control accessories_name" name="accessories_name"  id="accessories_name">
                            </div>

                            <input type="hidden" name="id" id="id">
                                                       
                           <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="inventory-btn" type="submit" name="inventory-btn" id="inventory-btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<!-- End Edit Modal -->



@include('common.inventory.inner_footer')




<script>
$(document).on("click",".edit-add-brand",function(){

        var data_id = $(this).attr("data-id");
        var days =   $(this).attr("days");
        var dates =   $(this).attr("dates");
        $("#id").val(data_id);
        $(".accessories_name").val(days);
        $(".created_at").val(dates);
})


$(document).ready(function() {
    $('#brand').DataTable( {
        scrollX:true,
        dom: 'Bfrtip',
        buttons: [
          
      {
             extend: 'copyHtml5',
             text: 'Copy',
             className: 'btn btn-default',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
         exportOptions: {
            columns: 'th:not(:last-child)'
         }
      },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'PDF',
            //     className: 'btn btn-default',
            //     exportOptions: {
            //         columns: 'th:not(:last-child)'
            //     }
            // },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
     

     
        ]
    } )
} );



    </script>
   
  





   
   <!-- end of edit model -->
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$("#datepicker").datepicker( {
    format: "mm-yyyy",

});
</script>


