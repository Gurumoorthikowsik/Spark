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
                                        <h5 class="card-title mb-0">Staff Documents List</h5>
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
                                                <th class="sort" data-sort="currency_name" scope="col">Employee ID</th>
                                                 <th class="sort" data-sort="name">User Name</th>
                                                <th class="sort" data-sort="currency_name">Email ID</th>
                                                <th class="sort" data-sort="role">Role</th>
                                                <th class="sort" data-sort="status">Document Status</th>
                                                @if(page_access(user_id(),'edit_Staff_Documents') == 1)
                                                <th class="sort" data-sort="action">Action</th>
                                                @endif
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody class="list form-check-all">


                                        @if($employee->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($employee->get() as $value)
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="employe">{{$value->employee_id}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="currency_name">{{encrypt_decrypt('decrypt',$value->email)}}</td>
                                            <td class="role">{{get_roll($value->position)}}</td>
                                            <td class="status">
                                                @if($value->option == '1')
                                                <span class="badge badge-soft-success text-uppercase">Approved</span>
                                                @elseif($value->option == '0')
                                                <span class="badge badge-soft-warning text-uppercase">Pending</span>
                                                @elseif($value->option == '2')
                                                <span class="badge badge-soft-danger text-uppercase">Rejected</span>
                                                @else
                                                <span class="badge badge-soft-primary text-uppercase">Not Uploaded</span>
                                                
                                                @endif
                                            </td>
                                            @if(page_access(user_id(),'edit_Staff_Documents') == 1)
                                            <td>                                            
                                                <div class="d-flex gap-2">                                                
                                                    <div class="edit">                                                    
                                                        <a href="{{URL::to('/staff_document_view')}}/{{encrypt_decrypt('encrypt',$value->userid)}}"><button class="btn btn-sm btn-success edit-item-btn"><i class="bx bxs-file-doc"></i></button></a>                                                    
                                                    </div>                                                
                                                </div>                                            
                                            </td>
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
