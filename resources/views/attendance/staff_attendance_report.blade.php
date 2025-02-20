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
                                <h4 class="mb-sm-0">Staff All Attendance Event Report</h4>

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
                                    
                                <!--end row-->
                            </div><!--end card-header-->


                            <form action="{{ url('/staff_attendance_report')}}" class="staff_attendance_report" id="staff_attendance_report" method="GET">
                                  @csrf
                                 <div class="input-group mb-3" style="width:800px;padding:10px">
                                   <input type="date" class="form-control" id="start_date" name="start_date" value="{{$pick_start_date}}" data-provider="flatpickr" onkeypress="return false;">&nbsp&nbsp
                                   <input type="date" class="form-control" id="end_date" name="end_date"  value="{{$pick_end_date}}" data-provider="flatpickr" onkeypress="return false;">&nbsp&nbsp
                                   <button class="btn btn-primary choose_date_btn" type="submit">SEARCH</button>&nbsp&nbsp     
                                   <a href="{{URL::to('')}}/staff_attendance_report">
                                   <input type="button"  value="RESET" style="height: 37px;width: 66px;" /> </a>
                                </div>                             
                               </form>
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div id="table-gridjs">
                                            
                                        <table  id="example" class="display nowrap" style="width:100%">
                                        <thead>
                                        <th class="sort" scope="col">S.No</th>
                                        <th class="sort" scope="col">Employee ID</th>
                                        <th class="sort" scope="col">User Name</th>
                                        <th class="sort" scope="col">Date</th>
                                        <th class="sort" scope="col">Login</th>
                                        <th class="sort" scope="col">Morning Break Start</th>
                                        <th class="sort" scope="col">Morning Break End</th>
                                        <th class="sort" scope="col">Morning Break Spent</th>
                                        <th class="sort" scope="col">Lunch Start</th>
                                        <th class="sort" scope="col">Lunch End</th>
                                        <th class="sort" scope="col">Lunch Break Spent</th>

                                        <th class="sort" scope="col">Evening Break Start</th>
                                        <th class="sort" scope="col">Evening Break End</th>
                                        <th class="sort" scope="col">Evening Break Spent</th>

                                        <th class="sort" scope="col">Logout</th>

                                      <!--   @foreach ($geteventtype as $event)                                          
                                            <th class="sort" scope="col">{{$event->type}}</th>
                                        @endforeach -->
                                        <th class="sort" scope="col">Others</th>
                                        <th class="sort" scope="col">Working Hours</th>
                                        <th class="sort" scope="col">Status</th>
                                      

                                        </thead>   


                                      
                                    </table><!--end table-->
                                   
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
<!-- ==========================================================Table End====================================================================== -->


           
            </div>




@include('common.inner_footer')

<script type="text/javascript"> 
    
     $('.choose_date_btn').click(function(){
       
    var start_date = document.getElementById("start_date").value;
    var end_date = document.getElementById("end_date").value; 
      
    
    if((start_date == '')){
        alert("Please Choose a From Date");
        document.getElementById("start_date").value = "";
        return false;
    }

    if((end_date == '')){
        alert("Please Choose a End Date");
        document.getElementById("end_date").value = "";
        return false;

    }

    if(Date.parse(end_date) < Date.parse(start_date)) {
        alert("End date should be greater than Start date");
        document.getElementById("start_date").value = "";
        document.getElementById("end_date").value = "";
        return false;
   
}
});
</script>




<script>
        $(document).ready(function () {        
        $('#example').DataTable({   
                           
            scrollX:true,
            dom: 'Bfrtip',
            lengthMenu: [ [ 10, 25, 50, 100, 200, 500, 1000, 5000, 10000 ],[ 10, 25, 50, 100, 200 , 500 , 1000, 5000, 10000]],            
            buttons: [
            'pageLength',
          {
             extend: 'copyHtml5',
             text: 'Copy',
             className: 'btn btn-default',
                // exportOptions: {
                //     columns: 'th:not(:last-child)'
                // }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
        //  exportOptions: {
        //     columns: 'th:not(:last-child)'
        //  }

      },            
        {

                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                // exportOptions: {
                //     columns: 'th:not(:last-child)'
                // }
            },
        ],
        
            "processing": true,
            "serverSide": true,           
           
            "ajax":{
                     "url": "{{ url('/staffattendance_report') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":function(data){ _token: "{{csrf_token()}}"}
                   },
                 
            "columns": [
                { "data": "user_id",render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1; }},
                { "data": "employee_id" },
                { "data": "username" },
                { "data": "date" },
                { "data": "login_in" },
                { "data": "mor_break_in" },
                { "data": "mor_break_end" },
                { "data": "mor_break_spent" },
                { "data": "lunch_begin" },
                { "data": "lunch_end" },
                { "data": "lunch_spent" },
                { "data": "even_break_in" },
                { "data": "even_break_end" },
                { "data": "even_break_spent" },
                { "data": "logout" },
                { "data": "other" },
                { "data": "total_hours" },
                { "data": "status" }
               
                
               
            ],

            

        });
    });
</script>
  
    
  
<script type="text/javascript">
	$('select').on('change', function() {
	  
        window.location.href = base_url+"/allattendance/"+this.value;

	});
</script>