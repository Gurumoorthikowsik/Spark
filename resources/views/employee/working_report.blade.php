@include('common.employee.inner_header')
@include('common.employee.sidebar')


<style>

    
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

#edit_source_code {
    width: 100%; /* Make sure the textarea spans the full width of its container */
    min-height: 100px; /* Optional: set a minimum height */
    max-height: 500px; /* Optional: set a max height before scrolling */
    overflow-y: auto; /* Ensures vertical scroll appears when content exceeds the height */
    resize: vertical; /* Allows users to resize the textarea vertically */
}


    </style>


<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/employees/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Working Report</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">

            	<!-- Content Start -->

            		 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            	<button type="button" class="btn btn-success add-btn float-right" data-toggle="modal" data-target="#addModel" data-whatever="@mdo"><i class="fa fa-plus"></i> Add</button>
                                <h4 class="card-title">Working Report List</h4>



                                <div class="table-responsive">
                                <table id="example" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Task Name</th>
                                                <th>Description</th>
                                                <th>Created On</th>
                                                <th>Action</th>
                                                <th>View</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                    	  @if($report->count() != 0)
	                                       @php $i = 1; @endphp
	                                       @foreach ($report->get() as $value)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$value->task}}</td>
                                                <td>{{$value->description}}</td>
                                                <!-- <td>{{$value->start_date}}</td> -->
                                                <td>{{$value->created_at}}</td>
                                                <td><a href="#" data-id="{{$value->id}}" title="Edit Task" class="edit_report"><span class="label label-secondary">Edit</span></a>
                                              
                                                    <td>
      
                                                        <a href="{{ URL::to('/employees/updateSrccode/' . $value->id) }}" class="btn btn-success edit_report text-white">View</a>

                                                    </td>

                                                    
                                                    
                                                </td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endforeach
                                        @endif
                                        </tbody>
                             
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            	<!-- Content End -->



            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

                 <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Working Report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button>
                            </div>
		                 <form action="<?php echo URL::to('/'); ?>/employees/working_report" id="report-form" class="report-form" method="post" autocomplete="off" enctype="multipart/form-data">
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
                                <label for="email-field" class="form-label d-none">From Mail *</label>
                                <input type="hidden" class="form-control" name="frommail" id="frommail" value="{{$user->email}}" readonly>
                            </div> 

                            
                            <div class="mb-3">
                                <label for="email-field" class="form-label">To *</label>
                                <input type="text" class="form-control" name="to_email" id="to_email">
                            </div>




                            <div class="mb-3">
                                <label for="email-field" class="form-label">Task Name *</label>
                                <input type="text" class="form-control" name="task" id="task">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea5" class="form-label">Description *</label>
                                <textarea class="form-control" id="description" name="description" rows="6"  placeholder="Enter Working Description"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label"> Upload File*</label>
                                <input type="file" class="form-control" name="dailytask" id="dailytask" accept=".zip,.rar,.7zip">
                            </div>

                            <div class="mb-3">
                                <label for="source-code" class="form-label">Source Code*</label>
                                <textarea class="form-control" name="source_code" id="source_code" rows="10" placeholder="Write your code here..."></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="report-btn" type="submit" name="report_btn" id="report_btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>


                <div class="modal fade show in" id="edit_report_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Working Report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button>
                            </div>
		                  <form action="<?php echo URL::to('/'); ?>/employees/edit_working_report" id="edit-report-form" class="edit-report-form" method="post" autocomplete="off">
		                        {{ csrf_field() }}
		                        <div class="modal-body">
		                            <div class="mb-3" id="modal-id" style="display: none;">
		                                <label for="id-field" class="form-label">ID</label>
		                                <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
		                            </div>

		                            <div class="mb-3">
		                                <label for="customername-field" class="form-label">Date * </label>
		                                <input type="date" class="form-control edit_date" name="date" id="date" placeholder="Staff Date Of Birth"  data-provider="flatpickr" value="<?php echo date("Y-m-d") ?>" readonly>
		                            </div>

		                            <div class="mb-3">
		                                <label for="email-field" class="form-label">Task Name *</label>
		                                <input type="text" class="form-control edit_task" name="task" id="task">
		                            </div>

		                            <div class="mb-3">
		                                <label for="exampleFormControlTextarea5" class="form-label">Description *</label>
		                                <textarea class="form-control edit_description" id="description" name="description" rows="10"  placeholder="Enter Working Description"></textarea>
		                            </div>

                                    <div class="mb-3">
                                        <label for="source-code" class="form-label">Source Code*</label>
                                        <textarea class="form-control edit_source_code" name="edit_source_code" id="edit_source_code" placeholder="Write your code here..."></textarea>
                                    </div>


		                            <input type="hidden" name="id" id="id" >
		                        </div>
		                        <div class="modal-footer">
		                            <div class="hstack gap-2 justify-content-end">
		                                <button type="submit" class="btn btn-success" id="report-btn" type="submit" name="report_btn" id="report_btn" class="btn btn-success w-100" >Submit</button>
		                            </div>
		                        </div>
		                    </form>
                        </div>
                    </div>
                </div>

@include('common.employee.inner_footer')



        
<!-- new  -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<script>
$(document).ready(function() {
    $('#example').DataTable( {
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
   
  

<!-- end of new  -->

<script type="text/javascript">


	 $('.edit_report').click(function(){

        var id = $(this).attr("data-id");
        $.ajax({
            url: emp_base_url+"/get_edit_report/"+id,
            type: "POST",
            
             processData:false,
             contentType:false,
             cache:false,
             async:true,
            beforeSend: function() {
            	$('#preloader').css("display","block");
                $('#add_profile_btn').hide();
                $('#loader').show();
            },
            success: function (data) {                    
              var res = JSON.parse(data);
              
                if(res.status == 1){

                    console.log('Check the loggg----->', res.source_code);
                    
                 
                   $('.edit_date').val(res.start_date.trim());
                   $('#id').val(res.id);
                   $('.edit_task').val(res.task);
                   $('.edit_description').val(res.description);
                   $('.edit_source_code').val(res.source_code);
                   $('#edit_report_model').modal('show');
                   setTimeout(function() { 
                        $('#preloader').css("display","none");

                        }, 2000);

                }else{
                  
                  // $.notify(res.msg, {className: 'error',clickToHide: true,});

                }
               
            
            }
        });
    })
</script>