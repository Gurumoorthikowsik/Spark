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
                        <h4 class="mb-sm-0">ADD PRODUCTS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('inventory/dashboard')}}"> Dashboard</a></li>
                                <li class="breadcrumb-item active">PRODUCT Details</li>
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
                            <form action="{{url('/productlist_insert')}}" method="post" id="add_productlist" autocomplete="off">

                            @csrf
                            <div class="row gy-5">
                           

                         
                            <div class="col-xxl-4 col-md-6 serialno_brand">
                                    <div>
                                    <label for="valueInput" class="form-label">Brand</label>
                                    <select class="form-select" id="inputGroupSelect01" name="brand" id="brand" >
                                            <option value="">Choose Brands...</option>
                                            @foreach ($brand as $brands)
                                                        <option value="{{$brands->id}}">{{$brands->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6 ">
                                    <div>
                                    <label for="valueInput" class="form-label">Accessories</label>
                                    <select class="form-select accessories" id="inputGroupSelect02" name="accessories" id="accessories" >
                                            <option value="">Choose Accessories...</option>
                                            @foreach ($accessories as $access)
                                                        <option value="{{$access->id}}">{{$access->accessories_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 serialno_brand" >
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
                                            placeholder="Enter a Processor" value="">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 processor_os">
                                    <div>
                                        <label for="placeholderInput" class="form-label">OS</label>
                                        <select class="form-select" id="inputGroupSelect03" name="os" id="os" >
                                            <option value="">Choose OS Type</option>
                                            @foreach($os as $value)
                                        <option value="{{$value->id}}">{{$value->os_name}}</option>
                                        @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 processor_os">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Laptop Charger</label>
                                        <input type="text" class="form-control error" name="Laptop_charger" id="Laptop_charger"
                                            placeholder="Enter a Laptop Charger" value="">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 sim_mobile_charger">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Sim Type</label>                                       
                                            <select class="form-select" id="inputGroupSelect04" name="sim" id="sim" >
                                            <option value="">Choose Sim Type</option>
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
                                        <input type="text" class="form-control error" name="phone_no" id="phone_no"
                                            placeholder="Enter a Phone Number" value="">
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-6 sim_mobile_charger">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Mobile-Charger</label>
                                        <select class="form-select" id="inputGroupSelect06" name="mobile_charger" id="mobile_charger" >
                                        <option value="">Choose Moblie Charger</option>
                                            @foreach ($mobile_charger as $brands)
                                                        <option value="{{$brands->id}}">{{$brands->mobile_charger_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              
                                <!--end col-->

                               

                             
                              
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

                                    <button type="submit" name="productlist" id="productlist" class="btn btn-success w-100">Submit</button>
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
        }else {
            $('.processor_os').hide();
            $('.sim_mobile_charger').hide();
        }
       
    })
    </script>
@include('common.inventory.inner_footer')                                 

