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
                                        <h5 class="card-title mb-0">Staff View Available Leave </h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">

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
                                                 <th class="sort" data-sort="name">Staff Name</th>
                                                 <th class="sort" data-sort="status">Email ID</th>
                                                 <!-- <th class="sort" data-sort="date">Date</th> -->
                                                 <th class="sort" data-sort="currency_name">Available</th>
                                                 <th class="sort" data-sort="details">Pending</th>
                                                 <th class="sort" data-sort="type">Approved</th>
                                                 <th class="sort" data-sort="type">Leave Carry Forward</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($user_leave->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($user_leave->get() as $value)

                                        <?php  $leave = staff_leave_data($value->userid);  $leave_res = json_decode($leave); ?>
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->employee_id}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="status">{{encrypt_decrypt('decrypt',$value->email)}}</td> 
                                            <!-- <td class="date">{{date('M-Y')}}</td>  -->                                            
                                            <td class="currency_name">{{$leave_res->available}} Day</td>
                                            <td class="currency_name">{{$leave_res->pending}} Day</td>                                              
                                            <td class="currency_name">{{$leave_res->approved}}</td> 
                                            <td class="currency_name">{{$leave_res->approved}}</td> 

                                             
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




@include('common.inner_footer')



<script>
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

