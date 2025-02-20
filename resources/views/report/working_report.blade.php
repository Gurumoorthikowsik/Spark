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
                                        <h5 class="card-title mb-0">Working Report </h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
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
                                            
                                 <table id="example" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="sort" data-sort="id" scope=""></th>
                                                 <th class="sort" data-sort="id" scope="col">S.No</th>
                                                 <th class="sort" data-sort="form_name" scope="col">Employee ID</th>
                                                 <th class="sort" data-sort="name">User Name</th>
                                                 <th class="sort" data-sort="status">Task Name</th>
                                                 <th class="sort" data-sort="status">Description</th>
                                                 <!-- <th class="sort" data-sort="action">Start Time</th> -->
                                               <!--   <th class="sort" data-sort="action">End Time</th>
                                                 <th class="sort" data-sort="action">Working hrs</th>
                                                 <th class="sort" data-sort="action">Status</th> -->
                                                 <th class="sort" data-sort="status">Created On</th>
                                                 <!-- <th class="sort" data-sort="status">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">

                                        @if($report->count() != 0)
                                        @php $i = 1; @endphp
                                        @foreach ($report->get() as $value)
                                        <tr class="item">
                                            <td class="currency_name"><a href="#" data-id="{{$value->id}}" title="Edit Task" class="edit_report"><i class="ri-edit-box-fill"></i></a></td>
                                            <td class="id">{{$i}}</td>
                                            <td class="form_name">{{$value->employee_id}}</td>
                                            <td class="name">{{$value->username}}</td>
                                            <td class="name">{{$value->task}}</td>
                                            <td class="currency_name">{{$value->description}}</td>
                                             <!-- <td class="currency_name">{{$value->start_date}}</td> -->
                                           <!--   <td class="currency_name">-</td>
                                             <td class="currency_name">-</td>
                                             <th class="sort" data-sort="action"></th> -->
                                            <td class="currency_name">{{$value->created_at}}</td>
                                           <!--  <td class="currency_name"><span class="badge bg-info">Pause</span> &nbsp &nbsp <span class="badge bg-danger">Stop</span></td> -->
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


        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Add Working Report</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/working_report" id="report-form" class="report-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="mb-3" id="modal-id" style="display: none;">
                                <label for="id-field" class="form-label">ID</label>
                                <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Date * </label>
                                <input type="text" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d") ?>"
                                placeholder="Date" data-provider="flatpickr" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Role *</label>
                                <input type="text" class="form-control" name="role" id="role" value="{{$user->position}}" readonly>
                            </div> 

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Task Name *</label>
                                <input type="text" class="form-control" name="task" id="task">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea5" class="form-label">Description *</label>
                                <textarea class="form-control" id="description" name="description" rows="10"  placeholder="Enter Working Description"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="report-btn" type="submit" name="report_btn" id="report_btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



     <div class="modal fade" id="edit_report_model" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Edit Working Report</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/edit_working_report" id="edit-report-form" class="edit-report-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3" id="modal-id" style="display: none;">
                                <label for="id-field" class="form-label">ID</label>
                                <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Date * </label>
                                <input type="text" class="form-control edit_date" name="date" id="date" placeholder="Staff Date Of Birth"  data-provider="flatpickr" value="<?php echo date("Y-m-d") ?>" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Task Name *</label>
                                <input type="text" class="form-control edit_task" name="task" id="task">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea5" class="form-label">Description *</label>
                                <textarea class="form-control edit_description" id="description" name="description" rows="10"  placeholder="Enter Working Description"></textarea>
                            </div>
                            <input type="hidden" name="id" id="id" >
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="report-btn" type="submit" name="report_btn" id="report_btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
   

   
<script type="text/javascript">
	$('select').on('change', function() {
	  
	  window.location.href = base_url+"/allattendance/"+this.value;

	});

    $('.edit_report').click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: base_url+"/get_edit_report/"+id,
            type: "POST",
            
             processData:false,
             contentType:false,
             cache:false,
             async:true,
            beforeSend: function() {
                $('#add_profile_btn').hide();
                $('#loader').show();
            },
            success: function (data) {                    
              var res = JSON.parse(data);
              
                if(res.status == 1){
                   
                   $('.edit_date').val(res.start_date.trim());
                   $('#id').val(res.id);
                   $('.edit_task').val(res.task);
                   $('.edit_description').val(res.description);
                   $('#edit_report_model').modal('show');

                }else{
                  
                  // $.notify(res.msg, {className: 'error',clickToHide: true,});

                }
               
            
            }
        });
    })
</script>