@include('common.inner_header')
@include('common.sidebar')

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
                                        <h5 class="card-title mb-0">Office Working Report </h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                           
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                          
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
                                            
                                 <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th class="sort" data-sort="id" scope=""></th> -->
                                                 <th class="sort" data-sort="id" scope="col">S.No</th>
                                                
                                                 <th class="sort" data-sort="name"> Date</th>
                                                 <th class="sort" data-sort="form_name" scope="col"> No of Days</th>
                                                 <th class="sort" data-sort="status">Created at</th>
                                                 @if(page_access(user_id(),'edit_Office_Working_Days') == 1)
                                                 <th class="sort" data-sort="action">Action</th>
                                                 @endif
                                              
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($working_days->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($working_days->get() as $value)
                                        <tr class="item">
                                            <!-- <td class="currency_name"><a href="#" data-id="{{$value->id}}" title="Edit Task" class="edit_report"><i class="ri-edit-box-fill"></i></a></td> -->
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{date('Y-M',strtotime($value->date))}}</td>
                                            <td class="name">{{$value->workingdays}}</td>
                                            <td class="status">{{$value->created_at}}</td> 
                                            @if(page_access(user_id(),'edit_Office_Working_Days') == 1)
                                             <td class="action">                                           
                                             <a href="#" data-id="{{$value->id}}" days="{{$value->workingdays}}" dates="{{date('Y-M',strtotime($value->date))}}" data-bs-toggle="modal" class="edit-working-days" id="create-btn" data-bs-target="#showModaledit" ><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>                                                                                      
                                            <a onclick="return confirm('Are you sure you would delete the day ?');" href="{{URL::to('/delete_office_working_day')}}/{{$value->id}}"><button class="btn btn-sm btn-danger remove-item-btn">Remove</button></a>
                                            </td>
                                            @endif
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
                    <div class="modal-header bg-light p-3"> <h4>Add Office Working Days</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/office_working_days" id="office-working-form" class="office-working-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="customername-field" class="form-label"> Date * </label>
                                <input type="month" class="form-control" name="date" id="date" class="hhhhhh"
                                placeholder="Date" data-provider="datepicker">
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Number of Working Days *</label>
                                <input type="number" class="form-control" name="workingdays" id="workingdays">
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
                    <div class="modal-header bg-light p-3"> <h4>Edit Office Working Report</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/office_working_report" id="edit_office-working-form" class="office-working-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <!-- <div class="mb-3">
                                <label for="customername-field" class="form-label">Date * </label>
                                <input type="text" class="form-control date" name="date"  id="date">
                            </div> -->


                            <div class="mb-3">
                                <label for="customername-field" class="form-label">No of Days * </label>
                                <input type="number" class="form-control workingdays" name="workingdays"  id="workingdays">
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



@include('common.inner_footer')




<script>
$(document).on("click",".edit-working-days",function(){

        var data_id = $(this).attr("data-id");
        var days =   $(this).attr("days");
        var dates =   $(this).attr("dates");
        $("#id").val(data_id);
        $(".workingdays").val(days);
        $(".date").val(dates);
})


$(document).ready(function() {
    $('#example').DataTable( {
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


