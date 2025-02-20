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
                        <h4 class="mb-sm-0">Return Stock</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Staff Details</a></li>
                                <li class="breadcrumb-item active">Add Staff</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">

                            <form action="{{url('inventory/return_product_submit')}}" id="return_stock" class="return_stock" method="post" autocomplete="off">
                            @csrf
                            <div class="row gy-5">
                            <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" class="hhhhhh"
                                        placeholder="Date"  data-provider="datepicker">
                                    </div>
                                </div>
                           

                            <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <label for="valueInput" class="form-label">Brand</label>
                                    <select class="form-select" name="brand" id="brand" >
                                            <option value="">Choose Brands...</option>
                                            @foreach ($brand as $brands)
                                                        <option value="{{$brands->id}}">{{$brands->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <label for="valueInput" class="form-label">Accessories</label>
                                    <select class="form-select accessories"  name="accessories" id="accessories" >
                                            <option value="">Choose Accessories...</option>
                                            @foreach ($accessories as $access)
                                                        <option value="{{$access->id}}">{{$access->accessories_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <label for="placeholderInput" class="form-label">Serial Number</label>
                                        <input type="text" class="form-control error" name="serial_no" id="serial_no"
                                            placeholder="Enter a S.No" value="">
                                    </div>
                                </div>
                                 
                                 <div class="col-xxl-4 col-md-6 processor_os">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Processor Number</label>
                                        <input type="text" class="form-control error" name="processor_no" id="processor_no"
                                            placeholder="Enter a Processor Number" value="">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 processor_os">
                                    <div>
                                        <label for="placeholderInput" class="form-label">os</label>
                                        <select class="form-select" id="inputGroupSelect03" name="os" id="os" >
                                            <option value="">Choose OS Type</option>
                                            @foreach($os as $value)
                                        <option value="{{$value->id}}">{{$value->os_name}}</option>
                                        @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->

                              
                                <div class="col-xxl-4 col-md-6 sim_mobile_charger">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Sim Type </label>
                                        <select class="form-select" id="inputGroupSelect04" name="sim" id="sim" >
                                            <option value="">Choose Sim ....</option>
                                            @foreach ($sim as $value)
                                                        <option value="{{$value->id}}">{{$value->sim_type}}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 sim_mobile_charger">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Sim Card</label>
                                        <select class="form-select" id="inputGroupSelect05" name="simcard" id="simcard" >
                                        <option value="">Choose Sim Card</option>
                                            @foreach ($simcard as $simcards)
                                                        <option value="{{$simcards->id}}">{{$simcards->sim_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 sim_mobile_charger">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control error" id="phone_no" name="phone_no"
                                            placeholder="Enter a Phone Number">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 sim_mobile_charger">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Mobile-Charger</label>
                                        <select class="form-select" id="inputGroupSelect05" name="mobile_charger" id="mobile_charger" >
                                        <option value="">Choose Moblie Charger</option>
                                            @foreach ($mobile_charger as $brands)
                                                        <option value="{{$brands->id}}">{{$brands->mobile_charger_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 processor_os">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Laptop-Charger</label>
                                        <input type="text" class="form-control error" id="Laptop_charger" name="Laptop_charger"
                                            placeholder="Enter a Return Reason">
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Return Reason</label>
                                        <input type="text" class="form-control error" id="reason" name="reason"
                                            placeholder="Enter a Return Reason">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Return By</label>
                                        <input type="text" class="form-control" id="return_by" name="return_by"
                                            placeholder="Enter a Name">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Product Condition</label>
                                        <input type="text" class="form-control" id="product_condition" name="product_condition"
                                            placeholder="Enter a Product Condition">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Remarks</label>
                                        <textarea id="remarks" name="remarks" rows="4" cols="50">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="container">

                                    <div class="row"><div class="col"></div><div class="col">
                                      <div class="col-xxl-4 col-md-12">
                                    <center>
                                    <button style="display: none;" type="button" id="loader" class="btn btn-success w-100 btn-load">
                                            <span class="d-flex align-items-center">
                                                <span class="flex-grow-1 me-2">
                                                    Loading...
                                                </span>
                                                <span class="spinner-border flex-shrink-0" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </span>
                                            </span>
                                    </button>

                                    <button type="submit" name="return_stock" id="return_stock" class="btn btn-success w-100">Submit</button>
                                    </center>
                                 </div>
                                </div><div class="col"></div></div>


                      
                            </div>
                            <!--end row-->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div></div>
    <table class="display nowrap" id ="example" style="width:100%">
    <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Brand</th>
          <th>Accessories</th>  
          <th>Serial No</th>        
          <th>Proccessor No </th>         
          <th>Return Reason</th>
          <th>Return By</th>
          <th>Product Condition</th>
          <th>Remarks</th>
          <th>Status</th>
          <th >Action</th>
        </tr>
    </thead>
    <tbody>
    @if($return_product->count() !== 0)
    @php $i = 1; @endphp
        @foreach($return_product as $product)   
        <tr>
            <td>{{$i}}</td>
            <td>{{$product->date}}</td>
            <td>{{get_brand($product->brand)}}</td>
            <td>{{get_accessories($product->accessories)}}</td>
            <td>{{$product->serial_no}}</td>
            <td><?php echo ($product->processor_no == '') ? '--' :($product->processor_no); ?></td>             
            <td>{{$product->reason}}</td>
            <td>{{$product->return_by}}</td>
            <td>{{$product->product_condition}}</td>  
            <td>{{$product->remarks}}</td>  
            <td> 
                @if($product->status == 1)
                <span class="badge badge-soft-success text-uppercase">Active</span>
                @else
                <span class="badge badge-soft-danger text-uppercase">Deactive</span>
                @endif
            </td>
            <td class="action"><a href="{{URL::to('inventory/return_status/')}}/{{$product->id}}"><button class="btn btn-sm btn-warning edit-item-btn">Status</button></a>
            <a  href="{{URL::to('inventory/edit_returnproduct/')}}/{{$product->id}}"><button class="btn btn-sm btn-success edit-item-btn">Edit</button></a>
            <a onclick="return confirm('Are you sure you would delete the Inventory ?');" href="{{URL::to('inventory/delete_returnproduct')}}/{{$product->id}}"><button class="btn btn-sm btn-danger remove-item-btn">Delete</button></a>
     <!-- <form method="post" class="delete_form" action="#">
      {{csrf_field()}} 
      <input type="hidden" name="_method" value="DELETE" />
      <button type="submit" class="btn btn-danger">Delete</button>
     </form> -->
    </td>
          
        </tr>
        @php $i++; @endphp
        @endforeach
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

<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>


<script type="text/javascript">

    $('.processor_os').hide();
    $('.sim_mobile_charger').hide();
    
    $('.accessories').change(function(){
        var id = this.value;
        if(id == 1){
            $('.processor_os').show();
            $('.sim_mobile_charger').hide();
        }else if(id == 6){
            $('.processor_os').hide();
            $('.sim_mobile_charger').show();
        }else if(id == 5){
            $('.processor_os').hide();
            $('.sim_mobile_charger').hide();
        }else if(id == 2) {
            $('.processor_os').hide();
            $('.sim_mobile_charger').hide();
        }else if(id == 3) {
            $('.processor_os').hide();
            $('.sim_mobile_charger').hide();
        }else if(id == 4) {
            $('.processor_os').hide();
            $('.sim_mobile_charger').hide();
        }else if(id == 7){
            $('.processor_os').hide();
            $('.sim_mobile_charger').hide();
        }
       
    })
    </script>


@include('common.inventory.inner_footer')                                 
