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
                                        <h5 class="card-title mb-0">Staff View Available Permission </h5>
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
                                        <!-- <form action="{{ url('/staff_view_permission')}}" class="permission-form" id="permission-form" method="GET">
                                  @csrf
                                 <div class="input-group mb-3" style="width:800px;padding:10px">
                                   <input type="date" class="form-control"  name="start_date"value="">&nbsp&nbsp
                                   <input type="date" class="form-control"  name="end_date"  value="">&nbsp&nbsp
                                   <button class="btn btn-primary" id="date" type="submit">SEARCH</button>&nbsp&nbsp
                           
                                   <input type="button" onclick="location.href='http://localhost/HR_PORTAL_NEW/staff_view_permission';" value="RESET" />
                                </div>
                               </form> -->
                                 <table id="example" class="display nowrap " style="width:100%">
                                 
                                        <thead>                                       
                                            <tr>
                                                 <th class="sort" data-sort="id" scope="col">S.No</th>
                                                 <th class="sort" data-sort="form_name" scope="col">Emploaye ID</th>
                                                 <th class="sort" data-sort="name">Staff Name</th>
                                                 <th class="sort" data-sort="status">Email ID</th>
                                                 <th class="sort" data-sort="date">Date</th>
                                                 <th class="sort" data-sort="currency_name">Available</th>
                                                 <th class="sort" data-sort="details">Pending</th>
                                                 <th class="sort" data-sort="type">Approved</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($user_permission->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($user_permission->get() as $value)

                                        <?php  $persmission = staff_permission_data($value->userid);  $persmission_res = json_decode($persmission); ?>
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->employee_id}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="status">{{encrypt_decrypt('decrypt',$value->email)}}</td> 
                                            <td class="date">{{date('d-M-Y')}}</td> 
                                            <td class="currency_name">{{$persmission_res->available}} Min</td> 
                                            <td class="currency_name">{{$persmission_res->pending}} Min</td> 
                                            <td class="currency_name">{{$persmission_res->approved}} Min</td> 

                                             
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

<script type="text/javascript">
    
     $('.permission-form').click(function(){
   
    var start_date = document.getElementById("start_date").value;
    var endDate = document.getElementById("endDate").value;
    
    if ((Date.parse(endDate) < Date.parse(start_date))) {
        alert("End date should be greater than Start date");
        document.getElementById("endDate").value = "";
   }
});
</script>


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

