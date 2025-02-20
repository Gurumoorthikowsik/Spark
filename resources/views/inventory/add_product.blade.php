@include('common.inventory.inner_header')
@include('common.inventory.sidebar')
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
/* td .form-select  {
  
  width: 249px !important;
} */




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
                                        <h5 class="card-title mb-0">ADD PRODUCT LIST</h5>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">
                                           
                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for inventory...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div> -->
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->
                            <div class="row">
                                 <!-- <div class="col-sm" style="padding: 23px;">
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="add_product" data-bs-target="#add_product_modal"><i class="ri-add-line align-bottom me-1"></i> Add Brand</button>
                                </div>
                                <div class="col-sm" style="padding: 23px;">
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="add_access" data-bs-target="#add_access_model"><i class="ri-add-line align-bottom me-1"></i> Add Accessories</button>
                                </div> -->
                            <div class="col-lg-12">
                                <div class="card">
                                   
                                    <div class="card-body">
                                        <div id="table-gridjs">
                                           
    <form method="post" name="add_product" id="add_product">  


                <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
                </div>


                <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
                </div>


                <div class="table-responsive">  
                    <table class="display nowrap" id="dynamic_field">  
                        <tr>  
                        <th width="35%">Serial No</th>
                    <!-- <th width="35%">Proccessor No</th> -->
                    <th width="35%">Brand</th>
                    <th width="35%">Accessories</th>
                    <th width="30%">Action</th>
                        </tr>  
                        </thead>
               <tbody class = "tbody">

               </tbody>
               <tfoot>
                <tr>
                                <td colspan="3" align="right">&nbsp;</td>
                                <td>
                  @csrf
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                 </td>
                </tr>
               </tfoot>
                    </table>  
                    <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />   -->
                </div>


    </form>  
                                    <!--end table-->
                                    <!-- <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                           
                                           
                                        </div>
                                    </div> -->
                                </div>
                                <table class="display nowrap" id ="example" style="width:100%">
    <thead>
        <tr>
          <th>ID</th>
          <th>Serial No</th>
          <!-- <th>Proccessor No </th> -->
          <th>Brand</th>
          <th>Accessories</th>
          <th>status</th>
          <th >Action</th>
        </tr>
    </thead>
    <tbody>
    @if($product->count() !== 0)
    @php $i = 1; @endphp
        @foreach($product as $students)
        <tr>
            <td>{{$i}}</td>
            <td>{{$students->serial_no}}</td>
            <!-- <td>{{$students->processor_no}}</td> -->
            <td>{{get_brand($students->brand)}}</td>
            <td>{{get_accessories($students->accessories)}}</td>
            <td> 
                @if($students->status == 1)
                <span class="badge badge-soft-success text-uppercase">Active</span>
                @else
                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
                @endif
            </td>           
            <td class="action">
                                            <div class="d-flex gap-2">
                                                   
                                                    <div class="edit">
                                                        <a href="{{URL::to('/status/')}}/{{$students->id}}"><button class="btn btn-sm btn-warning edit-item-btn"
                                                        >Status</button></a>
                                                    </div>
                                               

                                                    <div class="edit">
                                                        <a href="#" data-id="{{$students->id}}" title="Edit Task" class="edit_report"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
                                                    </div>
                                                  
                                                    <div class="remove">
                                                        <a onclick="return confirm('Are you sure you would delete the inventory ?');" href="{{URL::to('/delete_product')}}/{{$students->id}}"><button class="btn btn-sm btn-danger remove-item-btn">Remove</button></a>
                                                    </div>
                                           
                                            </div>
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
                                    
   <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            
                                            
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
           

      

       
        <div class="modal fade" id="edit_report_model" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Edit Product Details</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('inventory/'); ?>/edit_add_product" id="edit-laptop-form" class="edit-laptop-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Serial No * </label>
                                <input type="text" class="form-control edit_serial_no" name="serial_no" id="serial_no"
                                placeholder="Enter The Laptop Brand Name">
                            </div>

                            <!-- <div class="mb-3">
                                <label for="email-field" class="form-label">Proccessor No *</label>
                                <input type="text" class="form-control edit_processor_no" name="processor_no" id="processor_no" placeholder="Enter The Laptop Serial Number">
                            </div>  -->

                            <div class="mb-3">
                                <!-- <label for="email-field" class="form-label">Brand *</label>
                                <input type="text" class="form-control brand" name="brand" id="brand" placeholder="Enter The Laptop processors"> -->
                                <label for="valueInput" class="form-label">Brand *</label>
                                                <div class="input-group">
                                                    
                                                    <select class="form-select brand" name="brand" id="brand">
                                                    @foreach($brand as $students)
                                                    <option value="{{$students->id}}">{{$students->brand_name}}</option>                                                  
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <label id="inputGroupSelect01-error" class="error" for="inputGroupSelect01"></label>
                            </div>

                            <div class="mb-3">
                                <!-- <label for="email-field" class="form-label">Brand *</label>
                                <input type="text" class="form-control brand" name="brand" id="brand" placeholder="Enter The Laptop processors"> -->
                                <label for="valueInput" class="form-label">Accessories *</label>
                                                <div class="input-group">
                                                    
                                                    <select class="form-select accessories" name="accessories" id="accessories">
                                                    @foreach($accessories as $students)
                                                    <option value="{{$students->id}}">{{$students->accessories_name}}</option>                                                  
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <label id="inputGroupSelect01-error" class="error" for="inputGroupSelect01"></label>
                            </div>
                            <input type="hidden" name="id" id="id" >
                            </div>
                            <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="laptop-btn" type="submit" name="laptop_btn" id="laptop_btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



@include('common.inventory.inner_footer')


<script type="text/javascript">

    $('.edit_report').click(function(){

        var id = $(this).attr("data-id");
        $.ajax({
            url: inv_url+"/edit_get_product/"+id,
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
                   
                    $('.brand option[value='+res.brand+']').attr('selected','selected');
                    $('.accessories option[value='+res.accessories+']').attr('selected','selected');
                    
                   $('#id').val(res.id);
                   $('.brand').val(res.brand);
                   $('.edit_serial_no').val(res.serial_no);
                   $('.edit_processor_no').val(res.processor_no);
                   $('.accessories').val(res.accessories);
                   $('#edit_report_model').modal('show');

                }else{
                  
                  $.notify(res.msg, {className: 'error',clickToHide: true,});

                }
               
            
            }
        });
    })
</script>



<script>
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="text" name="serial_no" class="form-control error" /></td>';     
        html += ' <td><select name="brand" class="form-select valid"><option value="">Select Brand</option>@foreach ($brand as $branded)<option value="{{$branded->id}}">{{$branded->brand_name}}</option>@endforeach</select></td>';
        html += '<td><select name="accessories" class="form-select valid"><option value="">Select Accesories</option>@foreach ($accessories as $accessoried)<option value="{{$accessoried->id}}">{{$accessoried->accessories_name}}</option>@endforeach</select></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('.tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('.tbody').html(html);
        }
 }
 

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 $('#add_product').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("product_insert") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
                setTimeout(function() { 
                            location.reload(); 
                }, 2000);
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

});
</script>
