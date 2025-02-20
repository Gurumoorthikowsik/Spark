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



    </style>

  <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/employees/attendance')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Leave Details</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            	<button type="button" class="btn btn-success add-btn float-right" data-toggle="modal" data-target="#addModel" data-whatever="@mdo"><i class="fa fa-plus"></i> Add Leave</button>
                                <br>
                                <h4 class="card-title">{{date('M')}} Month Available Leave</h4>
                                <div class="table-responsive">
                                <table id="example" class="display nowrap example" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email ID</th>
                                                <th>Month/Year</th>
                                                <th>Available</th>
                                                <th>Pending</th>
                                                <th>Approved</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                       <?php  $leave = staff_leave_data(Session::get("empuser_id"));  $leave_res = json_decode($leave); ?>
                                           <tr>
                                               <th>1</th>
                                               <th>{{ get_user(Session::get("empuser_id"),'username') }}</th>
                                               <th>{{ encrypt_decrypt("decrypt",get_user(Session::get("empuser_id"),'email')) }}</th>
                                               <th>{{date('M / Y')}}</th>
                                               <th>{{$leave_res->available}} Day</th>
                                               <th>{{$leave_res->pending}} Day</th>
                                               <th>{{$leave_res->approved}} Day</th>
                                           </tr>
             
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Overall Apply Leave Details</h4>
                                <div class="table-responsive">
                                <table id="example" class="display nowrap example" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Leave Date</th>
                                                <th>Day</th>
                                                <th>Zone</th>
                                                <th>Reason</th>
                                                <th>Apply Date & Time</th>
                                                <th>Status</th>
                                                <th>Approved Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                        @php $i = 1; @endphp
                                        @foreach ($leave_details->get() as $value)    
                                        <tr class="item">
                                            <td>{{$i}}</td>
                                            <td>{{$value->leave_date}}</td> 
                                            <td><?php  echo ($value->day == 1) ? 'Full Day' : 'Half Day'; ?></td> 
                                            <td><?php  echo ($value->day == 1) ? '--' : $value->Section; ?></td> 
                                            <td>{{$value->reason}}</td> 
                                            <td>{{$value->created_at}}</td> 
                                             <td>
                                                @if($value->status == 'Approved')
                                                    <span class="badge badge-success">{{$value->status}}</span>
                                                @elseif($value->status == 'Pending')
                                                    <span class="badge badge-warning">{{$value->status}}</span>
                                                @else($value->status == 'Rejected')
                                                    <span class="badge badge-danger">{{$value->status}}</span>
                                                @endif
                                            </td> 
                                            <td>
                                                @if($value->status == 'Pending')
                                                    --
                                                @else
                                                {{$value->updated_at}} 
                                                @endif
                                            </td>
                                            <td>
                                            
                                               @if($value->status == 'Pending')
                                                <!-- <a href="#" data-id="6" title="Edit Permission" class="edit_report"><span class="label label-secondary">Edit</span></a> &nbsp &nbsp  -->
                                                <a href="/employees/delete_leave/{{encrypt_decrypt('encrypt',$value->id)}}" data-id="6" title="Delete Permission" class="edit_report"><span class="label label-danger">Delete</span></a>
                                                @else
                                                    --
                                                @endif
                                               
                                            <td>
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach

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
                        <h5 class="modal-title" id="exampleModalLabel">Add Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
		                 <form action="#" id="leave-form" class="leave-form" method="post" autocomplete="off">
		                {{ csrf_field() }}
                        <br>
			                <div class="col-lg-12">
                                <div class="basic-form">
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Leave Date * </label>
                                        <input type="date" class="form-control" name="leave_date" id="leave_date" placeholder="From TIme" data-provider="flatpickr" onkeypress="return false;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                            <label for="customername-field day" class="form-label">Section * </label>
                            <div class="form-group">
                                    <select class="form-control form-control-lg cls" name="day" id="day">
                                        <option value="1">Full Day</option>
                                        <option value="0.5">Half Day</option>                                                
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 none_cls">
                            <label for="customername-field" class="form-label">Zone * </label>
                            <div class="form-group">
                                    <select class="form-control form-control-lg" name="zone" id="zone">                      
                                        <option value="Morning">Morning</option>     
                                        <option value="Afternoon">Afternoon</option>                                                
                                    </select>
                                </div>
                            </div>
                           

                              <div class="col-lg-12">
                                <div class="basic-form">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Reason * </label>
                                        <textarea class="form-control" name="reason" id="reason" placeholder="Please Enter The Reason" rows="6"></textarea>
                                </div>
                                </div>
                            </div>


                       <br><br>
		                <div class="modal-footer">
		                    <div class="hstack gap-2 justify-content-end">
		                        <button type="submit" class="btn btn-success" id="leave_btn" name="leave_btn" class="btn btn-success w-100 leave_btn" >Submit</button>
		                    </div>
		                </div>

		            </form>
                </div>
            </div>
        </div>

@include('common.employee.inner_footer')

        
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
    $('.example').DataTable( {
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
            $(function () {
                $('#from_time').datetimepicker({
                         format: 'DD/MM/YYYY HH:mm'
                });
            });

            $(function () {
                $('#to_time').datetimepicker({
                    format: 'DD/MM/YYYY HH:mm'
                });
            });
    </script>


<script type="text/javascript">


$(".none_cls").hide();
$(".day").hide();
$('.cls').on('change', function () {
    if (this.value === "1"){
        $(".none_cls").hide();
        $(".day").hide();   
               
    }else{
        $(".none_cls").show();
         $(".day").hide();         
    }      
               
           
             
              
 });
</script>

  

<!-- end of new  -->