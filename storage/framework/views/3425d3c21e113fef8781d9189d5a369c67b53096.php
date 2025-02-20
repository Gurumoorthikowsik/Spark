<?php echo $__env->make('common.employee.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


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



    </style>

  <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/employees/attendance')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Attendance</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                               <!--  <input type="date" name="datepick" class="" style="height: 35px !important; "> -->
                            	<button type="button" class="btn btn-success add-btn " data-toggle="modal" data-target="#addModel" data-whatever="@mdo"><i class="fa fa-plus"></i> Entry Attendance</button>
                                </div>
                                <h4 class="card-title">Attendance Event List</h4>
                                <div class="table-responsive">
                                <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>From Event <b>(IN)</b></th>
                                                <th>From (In-Time)</th>
                                                <th>To Event <b>(Out)</b></th>
                                                <th>To (Out-Time)</th>                                                
                                                <th>Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if($employee->count() != 0): ?>
                                            <?php $i = 1; ?>
                                            <?php $__currentLoopData = $employee->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e(date('d-M-Y',strtotime($value->date))); ?></td>
                                                <td><?php echo e($value->from_event); ?></td>
                                                <td><?php echo e(date('H:i:s',strtotime($value->from_time))); ?></td>
                                                <?php if($value->to_event != ''): ?>
                                                 <td><?php echo e($value->to_event); ?></td>
                                                  <?php else: ?>
                                                 <td>--</td>
                                                <?php endif; ?>
                                                <?php if($value->to_time != ''): ?>
                                                <td><?php echo e(date('H:i:s',strtotime($value->to_time))); ?></td>
                                                <?php else: ?>
                                                <td>--</td>
                                                <?php endif; ?>                                                                                 
                                                <?php if($value->hours != ''): ?>
                                                <td><?php echo e($value->hours); ?></td>
                                                <?php else: ?>
                                                <td>--</td>   
                                                <?php endif; ?>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </table>

                                </div>


                            </div>
                        </div>
                    </div>



                    <div class="col-12 d-none">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Break spent Time</h4>
                                <div class="table-responsive">
                                <table class="table table-striped table-dark">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Morning Break Spent</th>
                                      <th scope="col">Lunch Break Spent</th>
                                      <th scope="col">Evening Break Spent</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row" style="color:white">1</th>
                                      <td style="color:white"><?php echo e(break_spend(emp_user_id(),2,3)); ?></td>
                                      <td style="color:white"><?php echo e(break_spend(emp_user_id(),4,5)); ?></td>
                                      <td style="color:white"><?php echo e(break_spend(emp_user_id(),6,7)); ?></td>
                                    </tr>
                                  </tbody>
                                </table>



                                </div>


                            </div>
                        </div>
                    </div>
                </div>


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
                        <h5 class="modal-title" id="exampleModalLabel">Entry Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
		                 <form action="#" id="entry-attendance-form" class="entry-attendance-form" method="post" autocomplete="off">
		                <?php echo e(csrf_field()); ?>


			              <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="form-group"><br><br>
                                            <label>Entry Attendance</label>
                                            <select class="form-control" id="event" name="event">
                                                <?php $__currentLoopData = $event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->type); ?></option>
                                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                </div>
                            </div>
                       <br><br>
		                <div class="modal-footer">
		                    <div class="hstack gap-2 justify-content-end">
		                        <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> -->

                                <button  style="display:none" type="button" class="btn btn-success loading_btn" id="" name=""  disabled > Loading ...</button>

		                        <button type="submit" class="btn btn-success entry_attendance_btn" id="entry_attendance_btn" name="entry_attendance_btn" >Submit</button>
		                    </div>
		                </div>

		            </form>
                </div>
            </div>
        </div>
        
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        var emp_base_url = "<?php echo URL::to('/employees/'); ?>";
    </script>
    
<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
<!-- new  -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>



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
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                className: 'btn btn-default',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
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
        
    </script>
   
  

<!-- end of new  --><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/employee/make_attendance.blade.php ENDPATH**/ ?>