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

#error{
color: red;
}



</style>


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
                                <li class="breadcrumb-item"><a href="{{URL::to('inventory/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Product List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                
    </div></div>
    <table class="display nowrap" id ="view_productlist" style="width:100%">
    <thead>
   
        <tr>
          <th>ID</th>
          <th>Created Date</th>
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
          <th>Status</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if($view_productlist->count() != 0)
    @php $i = 1; @endphp
    @foreach ($view_productlist->get() as $value)
        <tr>
            <td>{{$i}}</td>
            <td>{{$value->created_at}}</td>
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
            <td> 
            @if($value->status == 1)
                <span class="badge badge-soft-success text-uppercase">Active</span>
            @else
                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
            @endif 
            </td>
            <td class="action"><a href="{{URL::to('inventory/productlist_status/')}}/{{$value->id}}/{{$value->userid}}"><button class="btn btn-sm btn-warning edit-item-btn">Status</button></a>
            <a  href="{{URL::to('inventory/view_productlist/get_edit_viewallproduct')}}/{{$value->id}}/{{$value->userid}}"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
            <!-- <a onclick="return confirm('Are you sure you would delete the Inventory ?');" href="{{URL::to('inventory/delete_productlist')}}/{{$value->id}}/{{$value->userid}}"><button class="btn btn-sm btn-danger remove-item-btn">Delete</button></a> -->
            <a href="#"  class="comment"><button type="button" class="btn btn-danger add-btn get_delete_id" data-bs-toggle="modal" data-id="{{$value->id}}" id="create-btn" data-bs-target="#showModal" style="padding: 3px 8px 2px 6px;">Delete</button></a>
            </td>
          
        </tr>
        @php $i++; @endphp
        @endforeach
        @else
        @endif
    </tbody>
   
  </table>
   <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            
                                            
                                        </div>
                                    </div>





        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Rejected Reason</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="{{URL::to('inventory/delete_productlist')}}/{{@$value->id}}/{{@$value->userid}}" id="rejected_reason" class="staff_document_view" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="modal-body"> 

                             <div class="mb-3">
                                <input type="hidden" class="form-control delete_id" name="product_id" id="product_id">
                            </div>                      
   	
                            <div class="mb-3">
                                <label for="email-field" class="form-label">Reason *</label>
                                <input type="text" class="form-control" name="return_reason" id="return_reason">
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
 
<!-- End Modal -->

@include('common.inventory.inner_footer')      


<script>

$(document).ready(function() {
    $('#view_productlist').DataTable( {
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
    } )
} );

$('.get_delete_id').click(function(){
    var id = $(this).attr("data-id")
    $('.delete_id').val(id);
})

    </script>



<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
                           
