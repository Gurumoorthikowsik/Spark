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
                                        <h5 class="card-title mb-0">{{$title}}</h5>
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
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div id="table-gridjs">
                                            

                                            
                                                <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th class="sort" data-sort="id" scope="col">S.No</th>
                                                <th class="sort" data-sort="currency_name" scope="col">Student Roll</th>
                                                 <th class="sort" data-sort="name">User Name</th>
                                                 <th class="sort" data-sort="name">project Name</th>
                                                 <th class="sort" data-sort="name">Project Status</th>
                                                 <th class="sort" data-sort="date">Create Date</th>
                                                 <th class="sort" data-sort="name">Download Project</th>

                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody class="list form-check-all">


                                        @if($project->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($project->get() as $value)
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="employe">{{$value->roll_name}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="currency_name">{{$value->project}}</td>

                                            <td class="status">
                                                @if($value->status == 1)
                                                    <span class="badge badge-soft-primary text-uppercase">Processing</span>
                                                @elseif($value->status == 2)
                                                    <span class="badge badge-soft-danger text-uppercase">Pending</span>
                                                @else
                                                    <span class="badge badge-soft-success text-uppercase">Completed</span>
                                                @endif
                                            </td>
                                            <td class="date">{{date("d-M-Y",strtotime($value->created_at))}}</td>


                                            <td><a href="{{$value->project_file}}"><button class="btn btn-sm btn-warning edit-item-btn">Download</button></a></td>

                                           
                                            {{-- <td><a href="{{URL::to('/edit_staff')}}/{{encrypt_decrypt('encrypt',$value->user_id)}}"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a></td> --}}

                                        

                                   
                                            {{-- <td>
                                                <div class="d-flex gap-2">
                                                    @if(page_access(user_id(),'edit_Staff_Details') == 1)
                                                    <div class="edit">
                                                        <a href="{{URL::to('/staff_status')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-warning edit-item-btn"
                                                        >Status</button></a>
                                                    </div>
                                                    @endif
                                                    @if(page_access(user_id(),'edit_Staff_Details') == 1)
                                                    <div class="edit">
                                                        <a href="{{URL::to('/edit_staff')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
                                                    </div>
                                                    @endif
                                                    <!-- <div class="edit">
                                                        <a href="{{URL::to('/staff_proof')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn"><i class="bx bxs-file-doc"></i></button></a>
                                                    </div> -->

                                                    @if(page_access(user_id(),'edit_Staff_Details') == 1)
                                                    <div class="remove">
                                                        <a onclick="return confirm('Are you sure you would delete the user ?');" href="{{URL::to('/delete_staff')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-danger remove-item-btn">Remove</button></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td> --}}
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
