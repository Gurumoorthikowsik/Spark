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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Attendance Time Extend Details</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">             
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <button type="button" class="btn btn-success add-btn float-right" data-toggle="modal" data-target="#addModel" data-whatever="@mdo"><i class="fa fa-plus"></i> Add </button>
                                <h4 class="card-title">Attendance Time Extend Details</h4>
                                <div class="table-responsive">
                                <table id="example" class="display nowrap example" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Extend Date</th>
                                                <th>From Time</th>
                                                <th>To Time</th>
                                                <th>Hours</th>
                                                <th>Reason</th>
                                                <th>Apply Date</th>
                                                <th>Status</th>
                                                <th>Approved Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Attendance Time Extend Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
		                 <form action="#" id="employee_attendance_time_extended" class="employee_attendance_time_extended" method="post" autocomplete="off">
		                {{ csrf_field() }}
                        <br>
			              <div class="col-lg-12">
                                <div class="basic-form">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">From Time * </label>
                                    <input type="text" class="form-control" name="from_time" id="from_time" placeholder="From TIme" data-provider="flatpickr" onkeypress="return false;">
                            </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="basic-form">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">To Time * </label>
                                    <input type="text" class="form-control" name="to_time" id="to_time" placeholder="To Time" data-provider="flatpickr" onkeypress="return false;">
                            </div>
                                </div>
                            </div>

                              <div class="col-lg-12">
                                <div class="basic-form">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Reason * </label>
                                    <!-- <t type="text" class="form-control" name="to_time" id="to_time" placeholder="To Time" data-provider="flatpickr" onkeypress="return false;"> -->
                                        <textarea class="form-control" name="reason" id="reason" placeholder="Please Enter The Reason" rows="6"></textarea>
                                </div>
                                </div>
                            </div>


                       <br><br>
		                <div class="modal-footer">
		                    <div class="hstack gap-2 justify-content-end">
		                        <button type="submit" class="btn btn-success" id="permission_btn" name="permission_btn" class="btn btn-success w-100 permission_btn" >Submit</button>
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

