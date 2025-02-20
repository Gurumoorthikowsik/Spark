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
                                <h4 class="mb-sm-0">Staff View All Attendance Report</h4>

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

                                            <!-- <select class="form-select" aria-label=".form-select-sm example">
                                                 <option value="today">Today</option>
                                                 <option value="all">ALL</option>
                                                 <option value="day">Day</option>
                                                 <option value="month">Month</option>
                                            </select> &nbsp &nbsp -->

                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for days...">
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
                                                 <th>#</th>
                                                 <th class="sort" data-sort="id">Date</th>
                                                 <th class="sort" data-sort="id">From Event</th>
                                                 <th class="sort" data-sort="name">From</th>
                                                 <th class="sort" data-sort="id">To Event</th>
                                                <th class="sort" data-sort="currency_name">To</th>
                                                <th class="sort" data-sort="status">Hours</th>
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody class="list form-check-all">


                                        @if($employee->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($employee->get() as $value)
                                        <tr class="item">
                                            <td>{{$i}}</td>
                                            <td class="id">{{date('d-M-Y',strtotime($value->date))}}</td>

                                            <td class="id">{{$value->from_event}}</td>

                                            <td class="form_name">{{date('H:i:s',strtotime($value->from_time))}}</td>
                                             @if($value->to_event != '')
                                             <td class="id">{{$value->to_event}}</td>
                                              @else
                                             <td class="currency_name">--</td>
                                            @endif

                                            @if($value->to_time != '')
                                            <td class="currency_name">{{date('H:i:s',strtotime($value->to_time))}}</td>
                                            @else
                                            <td class="currency_name">--</td>
                                            @endif

                                            @if($value->hours != '')
                                            <td class="currency_name">{{$value->hours}}</td>
                                            @else
                                            <td class="currency_name">--</td>
                                            @endif

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
   