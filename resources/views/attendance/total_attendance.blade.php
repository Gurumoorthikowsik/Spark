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
                <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Attendance Staff List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                        
                                        <li class="breadcrumb-item active">Attendance Staff List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                        <div class="card" id="contactList">
                            <div class="card-header">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-3">
                                        <h5 class="card-title mb-0">Attendance Staff List</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                        	<select class="form-select" aria-label=".form-select-sm example">
                                        		 <option value="all" <?php echo ($params == 'all') ? 'selected' : '' ?>>ALL</option>
                                        		 @foreach ($roll as $value)	
                                        		 @php  $count_roll = DB::table('user_info')->where('status' ,'!=',2)->where('position',$value->sort_name)->count();   @endphp
                                                

                                                	<option value="{{$value->sort_name}}"  <?php echo ($value->sort_name == $params) ? 'selected' : '' ?> >{{$value->roll}}  &nbsp &nbsp (<h5>{{$count_roll}}</h5>)</option>
                                               	 @endforeach
                                            </select> &nbsp &nbsp
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
                                                <th class="sort" data-sort="form_name" scope="col">Employee ID</th>
                                                 <th class="sort" data-sort="name">User Name</th>
                                                <th class="sort" data-sort="currency_name">Email ID</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody class="list form-check-all">


                                        @if($employee->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($employee->get() as $value)
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->employee_id}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="currency_name">{{encrypt_decrypt('decrypt',$value->email)}}</td>
                                         
                                           
                                            <td class="status">
                                                @if($value->status == 1)
                                                <span class="badge badge-soft-success text-uppercase">Active</span>
                                                @else
                                                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                              
                                                    <div class="edit">
                                                        <a href="{{URL::to('/view_all_allattendance')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn">View Attendance Event</button></a>

                                                        <!-- <a href="{{URL::to('/working_calendar')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn">Working Hours Calendar</button></a> -->

                                                          <a href="{{URL::to('/daily_working_hrs')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn">Daily Working Hours</button></a>
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        @else
                                         <tr>
                                            <td>
                                                <center><p class="not_found">Records Not Found</p></center>
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
    } );
} );
    </script>
   
  
<script type="text/javascript">
	$('select').on('change', function() {
	  
	  window.location.href = base_url+"/allattendance/"+this.value;

	});
</script>