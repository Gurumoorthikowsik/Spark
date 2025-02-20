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
select[readonly]
{
    pointer-events: none;
}
select#brand {
    background-color: cornflowerblue;
}
select#accessories {
    background-color: cornflowerblue;
}


</style>

 <div class="vertical-overlay"></div>
<div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit View All Product Lists</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('inventory/dashboard')}}">Dashboard</a></li>
                                        <!-- <li class="breadcrumb-item"><a href="{{URL::to('/viewstaff')}}">Edit View All Product List</a></li> -->
                                        
                                        <li class="breadcrumb-item active">Edit View All Product List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{URL::to('/updateproductlist_inventory')}}" id="edit_viewall_product" class="edit-staff-form" method="post" autocomplete="off">
                                 {{ csrf_field() }} 
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Edit View All Product List</h4>
                                    <div class="flex-shrink-0">
                                        <!-- <div class="form-check form-switch form-switch-right form-switch-md">
                                   
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Inventory </button>

                                           
                                        </div> -->
                                    </div>
                                </div><!-- end card header -->
                                <input type="hidden" name="id"  id="id" value="{{$check_user}}">
                                <input type="hidden" name="userid"  id="userid" value="{{$check_product}}">
                                <div class="card-body">
                                
                                    <div class="live-preview">
                                        
                                        <div class="row gy-4">
                                             <div class="col-xxl-4 col-md-6">                                        
                                             <label for="valueInput" class="form-label">Brand Name * </label>
                                                <div class="input-group">
                                                <select class="form-select" name="brand" id="brand" readonly>
                                                <option value="">Choose Brands...</option>
                                                @if($brand->count() > 0 )
                                                        @foreach ($brand as $brands)
                                                            
                                                            <option value="{{$brands->id}}" @if($brands->id == $user->brand) selected @endif>{{$brands->brand_name}}</option>
                                                       
                                                            @endforeach
                                                        @endif
                                                </select> 
                                                <!-- <input type="text" class="form-control" name="brand" id="brand" value="{{$brands->id}}" @if($brands->id == $user->brand) selected @endif>{{$brands->brand_name}} readonly> -->
                                                </div>
                                             
                                            </div>

                                            <div class="col-xxl-4 col-md-6">                                           
                                             <label for="labelInput" class="form-label">Accessories Name *</label>
                                                    <!-- <input type="text" class="form-control accessories" name="accessories" id="accessories" value="{{get_accessories($user->accessories)}}" readonly> -->
                                           
                                            <select class="form-select accessories"  name="accessories" id="accessories" readonly>
                                            <option value="">Choose Accessories...</option>
                                            @if($accessories->count() > 0 )
                                            @foreach ($accessories as $access)
                                            <option value="{{$access->id}}" @if($access->id == $user->accessories) selected @endif>{{$access->accessories_name}}</option>
                                            @endforeach
                                            @endif
                                                </select> 
                                           
                                           
                                                </div>
                                           
                                            <!--end col-->


                                            @if($user->serial_no != null|| $user->serial_no != "")
                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="labelInput" class="form-label">Serial Number *</label>
                                                    <input type="text" class="form-control" name="serial_no" id="serial_no" value="{{$user->serial_no}}" placeholder="Please Enter Serial Number">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            @endif

                                            
                                            <div class="col-xxl-4 col-md-6 mob">
                                                <div>
                                                <label for="placeholderInput" class="form-label">Sim Type</label>   
                                                                                    
                                                    <select class="form-select mob" name="sim" id="sim" >                                                                                               
                                                    <option value="">Choose Sim...</option>
                                                    @if($sim->count() > 0 )
                                                    @foreach ($sim as $sims)
                                                    <option value="{{$sims->id}}" @if($sims->id == $product->sim) selected @endif>{{$sims->sim_type}}</option>
                                                @endforeach
                                                @endif

                                              
                                                    </select>                                                                                                      
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 mob">
                                                <div>
                                                <label for="placeholderInput" class="form-label">Sim Card</label>
                                                <select class="form-select"  name="simcard"  id="simcard" >   
                                                <option value="">Choose Sim Card...</option>  
                                                @if($simcards->count() > 0 )                                           
                                                @foreach ($simcards as $simcs)
                                                        
                                                        <option value="{{$simcs->id}}" @if($simcs->id == $product->simcard) selected @endif>{{$simcs->sim_name}}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                                </div>
                                            </div>
                                            

                                           <div class="col-xxl-4 col-md-6 mob">
                                                <div>
                                                    <label for="labelInput" class="form-label ">Phone Number *</label>
                                                    <input type="number" class="form-control" name="phone_no" id="phone_no" value="{{$product->phone_no}}" placeholder="Please Enter The Phone Number">
                                                </div>
                                            </div>

                                           <div class="col-xxl-4 col-md-6 mob">
                                                <div>
                                                <label for="placeholderInput" class="form-label">Mobile-Charger</label>
                                                <select class="form-select"  name="mobile_charger" id="inputGroupSelect02" id="mobile_charger" >
                                                <option value="">Choose Mobile Charger</option> 
                                                @if($mobilecharger->count() > 0 )                                                     
                                                @foreach ($mobilecharger as $value)
                                                       
                                                        <option value="{{$value->id}}" @if($value->id == $product->mobile_charger) selected @endif>{{$value->mobile_charger_name}}</option>
                                                
                                                        @endforeach
                                                @endif
                                                </select>
                                                </div>
                                            </div>

                                            

                                            <div class="col-xxl-4 col-md-6 lap">
                                                <div>
                                                    <label for="labelInput" class="form-label ">Processor Number *</label>
                                                    <input type="text" class="form-control" name="processor_no" id="processor_no" placeholder="Please Enter a Processor Number" value="{{$product->processor_no}}">
                                                </div>
                                            </div>
                                            


                                            <div class="col-xxl-4 col-md-6 lap">
                                                <div>
                                                <label for="placeholderInput" class="form-label">OS</label>
                                                <select class="form-select" id="inputGroupSelect04" name="os" id="os" > 
                                                <option value="">Choose OS</option>  
                                                @if($os->count() > 0 )                                              
                                                @foreach ($os as $value)
                                                        
                                                <option value="{{$value->id}}" @if($value->id == $product->os) selected @endif>{{$value->os_name}}</option>
                                                
                                               
                                                @endforeach
                                                @endif
                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 lap">
                                                <div>
                                                    <label for="placeholderInput" class="form-label ">Laptop Charger *</label>
                                                    <input type="text" class="form-control" name="Laptop_charger" id="Laptop_charger" placeholder="Please Enter a Laptop Charger Number" value="{{$product->Laptop_charger}}" data-provider="flatpickr">                                                        
                                                </div>
                                            </div>
                                           
                                  
                                                    </div>

                                        
                                <div class="card-header align-items-center d-flex">
                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                       
                                        <div class="row gy-4">
                                    <div class="container">

                                    <div class="row"><div class="col"></div><div class="col">
                                      <div class="col-xxl-8 col-md-12">
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
                                    
                                    <button type="submit" name="edit_staff_btn" id="edit_staff_btn" class="btn btn-success w-100">Submit</button>
                                    
                                    </center>
                                 </div>
                                </div><div class="col"></div></div>


                      
                            </div>  
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </form>
                            </div>
                                    
                                        <!--end row-->
                                    </div>

                                    
                                </div>



                                
</div>
</div>
</div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
   var id =  $(".accessories").val();
   
    $('.lap').hide();
    $('.mob').hide();
    
        if(id == '6'){
            $('.lap').hide();
            $('.mob').show();
        }else if(id =='1'){
            $('.lap').show();
            $('.mob').hide(); 
        }else if(id =='5'){
            $('.lap').hide();
            $('.mob').hide(); 
        }else if(id =='2'){
            $('.lap').hide();
            $('.mob').hide(); 
        }else if(id =='4'){
            $('.lap').hide();
            $('.mob').hide(); 
        } else if(id =='7'){
            $('.lap').hide();
            $('.mob').hide(); 
        } else if(id =='3'){
            $('.lap').hide();
            $('.mob').hide(); 
        } 
    });
    </script>


                              
    @include('common.inventory.inner_footer')   








