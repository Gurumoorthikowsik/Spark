@include('common.inner_header')
@include('common.sidebar')

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
                                        <h5 class="card-title mb-0">Staff Permission Request</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                           
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
                                                 <th class="sort" data-sort="id" scope="col">S.No</th>
                                                 <th class="sort" data-sort="form_name" scope="col">Emploaye ID</th>
                                                 <th class="sort" data-sort="form_name" scope="col">Permission date</th>
                                                 <th class="sort" data-sort="name">Staff Name</th>
                                                 <th class="sort" data-sort="status">Email ID</th>
                                                 <th class="sort" data-sort="date">From Time</th>
                                                 <th class="sort" data-sort="currency_name">To Time</th>
                                                 <th class="sort" data-sort="details">Hours</th>
                                                 <th class="sort" data-sort="type">Reason</th>
                                                 <th class="sort" data-sort="type">Apply Date</th>
                                                 <th class="sort" data-sort="type">Status</th>
                                                 @if(page_access(user_id(),'edit_Permission_Request') == 1)
                                                 <th class="sort" data-sort="type">Action</th>
                                                 @endif
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($permission_request->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($permission_request->get() as $value)

                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->employee_id}}</td>
                                            <td class="form_name">{{$value->permission_date}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="status">{{encrypt_decrypt('decrypt',$value->email)}}</td> 
                                            <td class="date">{{$value->from_time}}</td> 
                                            <td class="currency_name">{{$value->to_time}}</td> 
                                            <td class="currency_name">{{$value->hours}} Min</td> 
                                            <td class="currency_name">{{$value->resion}}</td> 
                                            <td class="currency_name">{{$value->created_at}}</td> 
                                            <td class="currency_name">
                                                @if($value->status == 'Approved')
                                                    <span class="badge badge-soft-success text-uppercase">{{$value->status}}</span>
                                                @elseif($value->status == 'Pending')
                                                    <span class="badge badge-soft-warning text-uppercase">{{$value->status}}</span>
                                                @else($value->status == 'Rejected')
                                                    <span class="badge badge-soft-danger text-uppercase">{{$value->status}}</span>
                                                @endif
                                            </td> 
                                            @if(page_access(user_id(),'edit_Permission_Request') == 1)
                                            <td class="currency_name">
                                                @if($value->status == 'Pending')
                                                <a href="#" data-id="{{$value->id}}" data-bs-toggle="modal" class="model_action" id="create-btn" data-bs-target="#showModal" ><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
                                                @else
                                                --
                                                @endif
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
                               
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
    <!-- =====================================================TableEnd================================================ -->
            </div>

        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Staff Permission Action</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/permission_request" id="add-inventory-form" class="add-inventory-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Choose Option * </label>
                                <select class="form-select" id="inputGroupSelect01" name="status" id="status" >
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                </select>
                            </div>

                            <input type="hidden" name="id" id="id">


<!--                             <div class="mb-3">
                                <label for="basiInput" class="form-label"> Reasion </label>
                                <input type="text" class="form-control" id="reasion" name="reasion" placeholder="Rejected Reason">
                            </div> -->
                           
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


@include('common.inner_footer')



<script>

$(document).on("click",".model_action",function(){

    var data_id = $(this).attr("data-id");
    $("#id").val(data_id);
    // alert(data_id);
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
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                className: 'btn btn-default',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
     

     
        ]
    } );
} );
    </script>
   
  

   
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$("#datepicker").datepicker( {
    format: "dd-mm-yyyy",

});
</script>

