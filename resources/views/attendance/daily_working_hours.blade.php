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
                                <h4 class="mb-sm-0">STAFF VIEW DAILY WORKING HOURS</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{URL::to('/allattendance')}}/{{Session::get('attendance_roll')}}">Attendance Staff List</a></li>
                                        
                                        <li class="breadcrumb-item active">Staff View Attendance</li>
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
                                        <h5 class="card-title mb-0">Staff View Attendance</h5>
                                        <br>
                                        <h5 class="card-title mb-0">Name :  {{get_user($dec_user_id,'username')}} <br> Email : {{encrypt_decrypt('decrypt',get_user($dec_user_id,'email'))}}</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for days...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div> -->
                                           
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->
                            <div class="row">
                            <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- <ul class="nav nav-pills mb-3">
                                    <li class="nav-item"><a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Today</a>
                                    </li>
                                    <li class="nav-item"><a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Weekly</a>
                                    </li>
                                    <li class="nav-item"><a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="true">Monthly</a>
                                    </li>
                                      <li class="nav-item"><a href="#navpills-4" class="nav-link" data-toggle="tab" aria-expanded="true">Year</a>
                                    </li>
                                </ul> -->                               
                                
                                <div class="tab-content br-n pn">

                                                    <!-- Today -->

                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row align-items-center">                                            
                                            <div class="col-sm-6 col-md-12 col-xl-12">
                                            <table id="example" class="display nowrap " style="width:100%">
                                           <thead>
                                               <tr>
                                                   <th class="sort" data-sort="id">#</th>
                                                   <th class="sort" data-sort="form_name">Date</th>
                                                   <th class="sort" data-sort="currency_name">Working Hours</th>
                                                   <th class="sort" data-sort="currency_name">Status</th>
                                               </tr><!--end tr-->
                                           </thead>
                                           <tbody class="list form-check-all">
                                         
                                           @if($get_month)
                                           @php $i = 1; $leave_days =  get_leave_days(); @endphp
                                           @foreach (array_reverse($get_month) as $key => $values)
                                           <?php  $get_hours = get_working_hours_hr_portal($dec_user_id,$values); $value = json_decode($get_hours); ?>

                                           <tr class="item"> 
                                               <td class="id">{{$i}}</td>
                                               <td class="form_name">{{$value->date}}</td>
                                               <td class="currency_name"><?php echo ($value->totaltime == '') ? '--' : get_today_time($value->totaltime); ?></td>
   
                                               <td class="form_name">
                                               <?php  $work_hours =  (get_user($dec_user_id,'working_hrs') != '') ? get_user($dec_user_id,'working_hrs') : '08:00';
                                                ?>

                                               @php $leave_find = in_array($values,$leave_days); @endphp

                                               @if(strtotime(str_replace('Min', '', get_today_time($value->totaltime))) >=  strtotime($work_hours))
                                                  <span class="badge badge-outline-success">Completed</span>

                                               @elseif($value->attendance == 'yes' && strtotime(str_replace('Min', '', get_today_time($value->totaltime))) <=  strtotime($work_hours))

                                                   <span class="badge badge-outline-warning">Low Working Hours</span>

                                               @elseif($value->attendance == 'no' && $leave_find != 1)

                                                   <span class="badge badge-outline-danger">Absent</span>

                                                @elseif($value->attendance == 'no' && $leave_find == 1)

                                                    <span class="badge badge-outline-primary">Leave</span> 
                                                      
                                               @endif
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of main  -->


                            </div>
                        </div>
                    </div>
                        </div><!--end card-->
</div>
</div>
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
                    columns: [ 0, ':visible' ]
                }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
         exportOptions: {
            columns: ':visible'
         }
      },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'PDF',
            //     className: 'btn btn-default',
            //     exportOptions: {
            //         columns: [ 0, ':visible' ]
            //     }
            // },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
     
        ]
    } );
} );
    </script>



<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        scrollX:true,
        dom: 'Bfrtip',
        buttons: [
           
      {
             extend: 'copyHtml5',
             text: 'Copy',
             className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
         exportOptions: {
            columns: ':visible'
         }
      },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'PDF',
            //     className: 'btn btn-default',
            //     exportOptions: {
            //         columns: [ 0, ':visible' ]
            //     }
            // },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
     
        ]
    } );
} );
    </script>
   


   <script>
$(document).ready(function() {
    $('#example2').DataTable( {
        scrollX:true,
        dom: 'Bfrtip',
        buttons: [
           
      {
             extend: 'copyHtml5',
             text: 'Copy',
             className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
         exportOptions: {
            columns: ':visible'
         }
      },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'PDF',
            //     className: 'btn btn-default',
            //     exportOptions: {
            //         columns: [ 0, ':visible' ]
            //     }
            // },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
     
        ]
    } );
} );
    </script>
   

   <script>
$(document).ready(function() {
    $('#example3').DataTable( {
        scrollX:true,
        dom: 'Bfrtip',
        buttons: [
           
      {
             extend: 'copyHtml5',
             text: 'Copy',
             className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
         exportOptions: {
            columns: ':visible'
         }
      },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'PDF',
            //     className: 'btn btn-default',
            //     exportOptions: {
            //         columns: [ 0, ':visible' ]
            //     }
            // },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
     
        ]
    } );
} );
    </script>
   