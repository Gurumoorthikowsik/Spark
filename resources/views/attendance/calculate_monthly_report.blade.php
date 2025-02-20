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
                                        <h5 class="card-title mb-0">Calculate Monthly Report</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for staff...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div> -->
                                           
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->



                            <form action="{{ url('/calculate_monthly_report')}}" class="calculate_monthly_report" id="calculate_monthly_report" method="GET">
                                  @csrf
                                 <div class="input-group mb-3" style="width:500px;padding:10px">                        
                                    <input type="month" class="form-control" id="month" name="month" value="{{$pick_date}}" data-provider="flatpickr" onkeypress="return false;">&nbsp&nbsp                                                  
                                    <!-- <button class="btn btn-primary date"  id="month" type="submit">SEARCH</button>&nbsp&nbsp                                                              -->
                                    <a href="{{URL::to('')}}/calculate_monthly_report">
                                   <input type="button"  value="RESET" style="height: 37px;width: 66px;" /> </a>
                                </div>                             
                            </form>


                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div id="table-gridjs">
                                            

                                            
                                 <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th class="sort" data-sort="id" scope="col">S.No</th>
                                                <th class="sort" data-sort="id" scope="col">User Name</th>
                                                <th class="sort" data-sort="id" scope="col">Employee ID</th>
                                                <th class="sort" data-sort="id" scope="col">Working Time</th>
                                                <th class="sort" data-sort="currency_name" scope="col">Month</th>
                                                 <th class="sort" data-sort="name">From & To Date</th>
                                                <th class="sort" data-sort="currency_name">Month Over All Days</th>
                                                <th class="sort" data-sort="role">Present Days</th>
                                                <th class="sort" data-sort="date">Low Working Days</th>
                                                <th class="sort" data-sort="status">Absent Days</th>
                                                <th class="sort" data-sort="status">Office Leave Days</th>
                                                <th class="sort" data-sort="status">CL</th>
                                                <th class="sort" data-sort="status">Permission</th>
                                                <th class="sort" data-sort="status">Action</th>
                                                
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($month_report->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($month_report->get() as $value)
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="employe">{{$value->username}}</td>
                                            <td class="name">{{$value->employee_id}}</td>
                                            <td class="name"><?php echo ($value->working_hrs) ? $value->working_hrs : '08:00'; ?></td>
                                            <td class="currency_name">{{date('M',strtotime($value->to_date))}}</td>
                                           
                                            <td class="role">{{$value->from_date}} - {{$value->to_date}}</td>
                                            <td class="date">{{$value->month_total_days}} Days</td>
                                            <td class="date" style="color:#0dc20d">{{$value->precent_days}}</td>
                                            <td class="date" style="color:#f29d56">{{$value->low_working_days}}</td>
                                            <td class="date" style="color:#ff5e5e">{{$value->absend_days}}</td>
                                            <td class="date" style="color:#7571f9">{{$value->office_leave_days}}</td>
                                            <td class="date">{{$value->cl}}</td>
                                            <td class="date">{{$value->permission}}</td>
                                            <td class="date">   
                                                <div class="edit">
                                                        <a href="{{URL::to('/cal_month_rep_view')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn">View</button></a>
                                                </div>
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



@include('common.inner_footer')

<script>
      $('.date').click(function(){    
        var id = $(this).attr("value");
        // alert(id);
      });
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        scrollX:true,
        dom: 'Bfrtip',
        lengthMenu: [ [ 10, 25, 50, 100, 200, 500, 1000, 5000, 10000 ],[ 10, 25, 50, 100, 200 , 500 , 1000, 5000, 10000]],       
          
        buttons: [
            'pageLength',
          
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

$('#month').change(function(){

    var date = $(this).val();
    // alert(date);
    location.href = base_url+"/calculate_monthly_report?month="+date;
})
    </script>
