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
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee Upload Document</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <!-- row -->
    <div class="row">
        <div class="col-12 m-b-30">
            <!-- Button trigger modal -->
            <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal">Add Proof</button>
                <h4 class="d-inline">Add Employee Proof</h4> <br><br><br>

                <div class="row">
                <?php if($user_proof->count() != 0){  $decode = unserialize($user_proof->first()->document);?>

                @foreach($decode as $key => $value)

                    <div class="col-md-6 col-lg-3">                       
                        <div class="card" style="height: 458px;">
                            <img class="img-fluid" src="{{$value[$key.'_image']}}" alt="" style=" width: 100%;max-width: 400px;max-height: 10px;object-fit: fill;min-height: 307px;"> 
                            <div class="card-body">
                                <h5 class="card-title">{{$key}}</h5>
                                <p class="card-text"></p>

                                <?php if($value[$key.'_status'] == 0){
                                    $status = '<span class="badge badge-warning">Pending</span>';
                                }else if($value[$key.'_status'] == 1){
                                    $status = '<span class="badge badge-success">Approved</span>';
                                }else if($value[$key.'_status'] == 2){
                                    $status = '<span class="badge badge-danger">Rejected</span>';
                                    
                                }                                                                  
                                    ?>
                             
                                <p class="card-text">Status : {!!$status!!}                                 
                                </p>
                                <b> <?php echo (@$value[$key.'_reason'] != '') ? 'Rejected Reason: '.$value[$key.'_reason'] : ''; ?> </b>
                            </div>
                        </div>

                    </div>
                @endforeach
            <?php }else{ ?>
                <center><h3>Record Not Found</h3></center>
            <?php } ?>    
                </div>
               
        </div>
    </div>
</div>
</div>


<!-- Model popup -->
<div class="bootstrap-modal">
<div class="modal fade" id="basicModal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Proof Upload</h5>
<button type="button" class="close" data-dismiss="modal">
 <span>&times;</span>
</button>
</div>
<form action="#" id="employee_proof_form" class="employee_proof_form" method="post" autocomplete="off" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="col-lg-12">
 <label for="customername-field day" class="form-label">Choose Certificate Type * </label>
 <div class="form-group">
   <select class="form-control form-control-lg cls" name="type" id="type">
     <option value="">Choose Type</option> @foreach ($document_list as $value) <option value="{{$value->types}}">{{$value->types}}</option> @endforeach
   </select>
 </div>
</div>
<div class="col-lg-12">
 <label for="email-field" class="form-label">Choose file *</label>
 <input type="file" class="form-control" name="proof" id="proof">
</div>
<br>
<div class="col-auto">
 <button type="submit" class="btn btn-dark mb-2">Submit</button>
</div>
</form>
</div>
</div>
</div>
</div>                      
@include('common.employee.inner_footer')       

<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>

<!-- new  -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


