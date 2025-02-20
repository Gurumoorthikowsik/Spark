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

table td {
  word-wrap: break-word;
  max-width: 400px;
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
                                        <h5 class="card-title mb-0">Staff Inventory List</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for Inventory...">
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
                                            
                                 <table id="example" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th class="sort" data-sort="id" scope="col">S.No</th>
                                                <th class="sort"data-sort="name">Created Date</th>
                                                <th class="sort" data-sort="currency_name" scope="col">Employee ID</th>
                                                 <th class="sort" data-sort="name">User Name</th>
                                                 <th class="sort" data-sort="name">Brand</th>
                                                 <th class="sort" data-sort="name">Accessories</th>
                                                <th class="sort" data-sort="currency_name">Serial Number</th>
                                                <th class="sort" data-sort="role">Sim</th>
                                                <th class="sort" data-sort="role">Phone Number</th> 
                                                <th class="sort" data-sort="role">Mobile-Charger</th>
                                                <th class="sort" data-sort="role">Processor Number</th> 
                                                <th class="sort" data-sort="role">OS</th> 
                                                <th class="sort" data-sort="role">Laptop Charger</th>                                                                                                                                          
                                                @if(page_access(user_id(),'edit_Staff_Inventory_List') == 1)
                                                <th class="sort" data-sort="action">Action</th>
                                                @endif
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($inventory->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($inventory->get() as $value)
                                        <tr class="item">
                                            <td class="id">{{$i}}</td>
                                            <td class="currency_name">{{$value->created_at}}</td>
                                            <td class="currency_name">{{$value->employee_id}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="name">{{get_brand($value->brand)}}</td>
                                            <td class="currency_name">{{get_accessories($value->accessories)}}</td>
                                            <td class="currency_name">{{$value->serial_no}}</td>
                                            <td class="role">{{get_sim($value->sim)}}</td> 
                                            <td class="role">{{$value->phone_no}}</td>
                                            <td class="role">{{get_mobile_charger($value->mobile_charger)}}</td> 
                                            <td class="currency_name">{{$value->processor_no}}</td>
                                            <td class="currency_name">{{os_type($value->os)}}</td> 
                                            <td class="currency_name">{{$value->Laptop_charger}}</td>                                         
                                            @if(page_access(user_id(),'edit_Staff_Inventory_List') == 1)
                                            <td class="action">
                                                <a onclick="return confirm('Are you sure you would delete the Inventory ?');" href="{{URL::to('/delete_addinventory')}}/{{$value->id}}"><button class="btn btn-sm btn-danger remove-item-btn">Remove</button></a>
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