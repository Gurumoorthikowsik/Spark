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

                            <form action="{{URL::to('/inventory/update_returnproduct')}}" id="return_stock" class="return_stock" method="post" autocomplete="off">
                            @csrf
                            <div class="row gy-5">
                            <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <input type="hidden" class="form-control" name="id" id="id" value = "{{$return->id}}">
                                        <label for="placeholderInput" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" class="hhhhhh"
                                        placeholder="Date"  data-provider="datepicker" value = "{{$return->date}}">
                                    </div>
                                </div>
                           

                            <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <label for="valueInput" class="form-label">Brand</label>
                                    <select class="form-select" name="brand" id="brand" readonly>
                                        <option value="">Choose Brands...</option>
                                            @if($brand->count() > 0 )
                                            @foreach ($brand as $brands)           
                                        <option value="{{$brands->id}}" @if($brands->id == $return->brand) selected @endif>{{$brands->brand_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <label for="valueInput" class="form-label">Accessories</label>
                                    <select class="form-select accessories" name="accessories" id="accessories" readonly>
                                            <option value="">Choose Accessories...</option>
                                            @if($accessories->count() > 0 )
                                            @foreach ($accessories as $access)
                                            <option value="{{$access->id}}" @if($access->id == $return->accessories) selected @endif>{{$access->accessories_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                    <label for="placeholderInput" class="form-label">Serial Number</label>
                                        <input type="text" class="form-control error" name="serial_no" id="serial_no"
                                            placeholder="Enter a S.No" value = "{{$return->serial_no}}">
                                    </div>
                                </div>
                                 
                                 <div class="col-xxl-4 col-md-6 lap">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Processor Number</label>
                                        <input type="text" class="form-control error" name="processor_no" id="processor_no"
                                            placeholder="Enter a Processor" value = "{{$return->processor_no}}">
                                    </div>
                                </div>
                                <!--end col-->
 
                                <div class="col-xxl-4 col-md-6 mob">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Sim Type</label>
                                        <select class="form-select mob" name="sim" id="sim" >                                                                                               
                                            <option value="">Choose Sim...</option>
                                                @if($sim->count() > 0 )
                                                @foreach ($sim as $sims)
                                                <option value="{{$sims->id}}" @if($sims->id == $return->sim) selected @endif>{{$sims->sim_type}}</option>
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
                                                        
                                                <option value="{{$simcs->id}}" @if($simcs->id == $return->simcard) selected @endif>{{$simcs->sim_name}}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-md-6 mob">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" name="phone_no" id="phone_no" value="{{$return->phone_no}}" placeholder="Please Enter The Phone Number">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 mob">
                                                <div>
                                                <label for="placeholderInput" class="form-label">Mobile-Charger</label>
                                                <select class="form-select"  name="mobile_charger" id="inputGroupSelect02" id="mobile_charger" > 
                                                <option value="">Choose Mobile-Charger...</option> 
                                                @if($mobilecharger->count() > 0 )                                                     
                                                @foreach ($mobilecharger as $value)
                                                       
                                                        <option value="{{$value->id}}" @if($value->id == $return->mobile_charger) selected @endif>{{$value->mobile_charger_name}}</option>
                                                
                                                        @endforeach
                                                @endif
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-md-6 lap">
                                                <div>
                                                <label for="placeholderInput" class="form-label">OS</label>
                                                <select class="form-select" id="inputGroupSelect04" name="os" id="os" > 
                                                <option value="">Choose OS...</option>  
                                                @if($os->count() > 0 )                                              
                                                @foreach ($os as $value)
                                                        
                                                <option value="{{$value->id}}" @if($value->id == $return->os) selected @endif>{{$value->os_name}}</option>
                                                
                                               
                                                @endforeach
                                                @endif
                                                </select>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 lap">
                                                <div>
                                                    <label for="placeholderInput" class="form-label ">Laptop Charger *</label>
                                                    <input type="text" class="form-control" name="Laptop_charger" id="Laptop_charger" placeholder="Please Enter a Laptop Charger Number" value="{{$return->Laptop_charger}}" data-provider="flatpickr">                                                        
                                                </div>
                                            </div>
                              
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Return Reason</label>
                                        <input type="text" class="form-control error" id="reason" name="reason"
                                            placeholder="Enter a Return Reason" value = "{{$return->reason}}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Return By</label>
                                        <input type="text" class="form-control" id="return_by" name="return_by"
                                            placeholder="Enter a Name" value = "{{$return->return_by}}">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Product Condition</label>
                                        <input type="text" class="form-control" id="product_condition" name="product_condition"
                                            placeholder="Enter a Return Reason" value = "{{$return->product_condition}}" >
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Remarks</label>
                                        <textarea id="remarks" name="remarks" rows="4" cols="50">
                                        {{$return->remarks}}
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
   
  

<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>




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
