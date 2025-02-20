@include('common.inner_header')
@include('common.sidebar')

<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">View All Product List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">View Product List</a></li>
                                <li class="breadcrumb-item active">Add Staff</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            
           
        <div class="row gy-4">
            <div class="col-xxl-4 col-md-6">
                <div>
                    <label for="basiInput" class="form-label" style="color: green;font-weight: bold;">Employee ID:</label>
                    <input type="text" class="form-control" id="basiInput" value="{{$user->employee_id}}" style="color: blue;font-weight: bold;" disabled>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div>
                    <label for="basiInput" class="form-label" style="color: green;font-weight: bold;">Staff Name *</label>
                    <input type="text" class="form-control" name="staffname" id="staffname" value="{{$user->username}}" style="color: blue;font-weight: bold;" readonly>
                </div>
            </div>
        </div>
      
        
        <br>
        <div class="row">
            <div class="col-lg-12">
                
    </div></div>
    

    <form action="{{URL::to('/addinventory_insert')}}"  class="add-staff-form" method="post" autocomplete="off">        
        {{ csrf_field() }}
        <input type="hidden" name="userid"  id="userid" value="{{$userid}}" >
    <table class="display nowrap" id ="view_productlist" style="width:100%">
    <thead>
   
        <tr>
        <th class="sort" data-sort="id" id="checkbox" scope=""></th>
          <!-- <th>id</th> -->
          <th>ID</th>
          <th>Brand</th>
          <th>Accessories</th>          
          <th>Serial Number </th>
          <th>Sim Card</th>
          <th>Sim Type</th>
          <th>Phone Number</th>
          <th>Mobile-Charger</th>
          <th>Processor Number</th>
          <th>Os</th>
          <th>Laptop Charger</th>
          <!-- <th>Status</th>
          <th >Action</th> -->
        </tr>
    </thead>
    <tbody>
    @if($view_productlist->count() != 0)
    @php $i = 1; @endphp
    @foreach ($view_productlist->get() as $value)
        <tr>
            <!-- <td><input type="hidden" name="userid"  id="userid" value="" ></td> -->
            <td>
                <div class="form-check">
                    <input class="form-check-input addinventory_id" type="checkbox" value="{{$value->id}}" name="add_inventory[]" id="add_inventory">                
                </div>
            </td>
            <td>{{$i}}</td>
            <td>{{get_brand($value->brand)}}</td>
            <td>{{get_accessories($value->accessories)}}</td>
            <td><?php echo ($value->serial_no == '') ? '--' :($value->serial_no); ?></td>
            <td>{{get_sim($value->sim)}}</td>         
            <td>{{get_simcard($value->simcard)}}</td>
            <td><?php echo ($value->phone_no == '') ? '--' :($value->phone_no); ?></td>
            <td>{{get_mobile_charger($value->mobile_charger)}}</td>
            <td><?php echo ($value->processor_no == '') ? '--' :($value->processor_no); ?></td>              
            <td>{{os_type($value->os)}}</td>           
            <td><?php echo ($value->Laptop_charger == '') ? '--' :($value->Laptop_charger); ?></td>
            <!-- <td> 
            @if($value->status == 1)
                <span class="badge badge-soft-success text-uppercase">Active</span>
            @else
                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
            @endif 
            </td>
            <td class="action">
                <a href="{{URL::to('/addinventory_status/')}}/{{$value->id}}"><button class="btn btn-sm btn-warning edit-item-btn">Status</button></a> -->
            <!-- <a  href="{{URL::to('/get_edit_viewallproduct')}}/{{$value->id}}"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
            <a onclick="return confirm('Are you sure you would delete the Inventory ?');" href="{{URL::to('inventory/delete_productlist')}}/{{$value->id}}"><button class="btn btn-sm btn-danger remove-item-btn">Delete</button></a> -->   
            <!-- </td> -->
          
        </tr>
        @php $i++; @endphp
        @endforeach
        @else
        @endif
    </tbody>
   
  </table>
  <button type="submit" name="add_staff_btn" id="add_staff_btn" class="btn btn-success w-20 inventory_btn" value="submit" style="margin-left: 574px;">Submit</button>
  </form>
   <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            
                                            
                                        </div>
                                    </div>






        <!--  Modal-->
    <div class="modal fade" id="showModaledit" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Edit View Product List</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/edit_add_brand" id="edit_add-brand-form" class="edit_add-brand-form" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <!-- <div class="mb-3">
                                <label for="customername-field" class="form-label">Date * </label>
                                <input type="text" class="form-control date" name="date"  id="date">
                            </div> -->


                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Brand Name * </label>
                                <input type="text" class="form-control brand" name="brand"  id="brand">
                            </div>

                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Accessories Name * </label>
                                <input type="text" class="form-control accessories" name="accessories"  id="accessories">
                            </div>

                            <input type="hidden" name="id" id="id">
                                                       
                           <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="inventory-btn" type="submit" name="inventory-btn" id="inventory-btn" class="btn btn-success w-100" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- End Modal -->

@include('common.inner_footer')      


<script type="text/javascript"> 
    
     $('.inventory_btn').click(function(){
    var checkbox = document.getElementById("add_inventory").value;         
    
    if((checkbox == '')){
        alert("Please Select a Checkbox");
        document.getElementById("add_inventory").value = "";
        return false;
    }      

});
</script>



<script>

$(document).ready(function() { 

    $('#view_productlist').DataTable( {
        scrollX:true,
        dom: 'Bfrtip',
        lengthMenu: [ [ 10, 25, 50, 100, 200, 500, 1000, 5000, 10000 ],[ 10, 25, 50, 100, 200 , 500 , 1000, 5000, 10000]], 
        buttons: [
            'pageLength',
          
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
    } )
} );



    </script>


<script type="text/javascript">
	

    $('.edit-view-all-product').click(function(){       
        
        var id = $(this).attr("data-id");
        $.ajax({
            url: base_url+"/get_edit_viewallproduct/"+id,
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
                   
                //    $('.edit_date').val(res.start_date.trim());
                   $('#id').val(res.id);
                   $('.brand').val(res.brand);
                   $('.accessories').val(res.accessories);
                   $('#showModaledit').modal('show');

                }else{
                  
                  // $.notify(res.msg, {className: 'error',clickToHide: true,});

                }
               
            
            }
        });
    })
</script>

<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
                           


