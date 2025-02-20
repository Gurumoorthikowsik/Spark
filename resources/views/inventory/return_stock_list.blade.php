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
                        <h4 class="mb-sm-0">View All Return Stock List</h4>

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
          <th>Return Reason</th>          
        </tr>
    </thead>
    <tbody>
    @php $i = 1; @endphp
    @foreach ($return_stock->get() as $value)
        <tr>
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
            <td class="status">                                                
                <span class="badge badge-soft-danger text-uppercase">{{$value->return_reason}}</span>                                                
            </td>
            <!-- <td>{{$value->return_reason}}</td>          -->
        </tr>
      
        @php $i++; @endphp
        @endforeach
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
</script>



<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
                           
