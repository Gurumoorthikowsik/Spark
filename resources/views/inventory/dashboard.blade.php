@include('common.inventory.inner_header')
@include('common.inventory.sidebar')

<style>
.wrapper {
  margin: 50px;
}
</style>
        <!-- Vertical Overlay-->
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
                                <h4 class="mb-sm-0">Inventory Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/inventory/dashboard')}}">Dashboards</a></li>
                                       
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="">

                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1">{{Dayzone()}}, {{get_invuser(invuser_id(),'username')}}!</h4>
                                               
                                            </div>
       
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                             
                               
                                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h5 id="dashboard_popup_title"></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>                                                          

                                                            <!-- <input type="text" name="id" id="id" value=""> -->

                                                            <div class="modal-body">


                                                            <div class="mb-3">
                                                                <label for="customername-field" class="form-label">View Brands * </label>                                                                                                  
                                                            </div>
                                                                                                                       
                                                                <h5 class="fs-15">
                                                                <p id="dashboard_appends"></p>                                                   
                                                                </h5>
                                                            
                                                                <p class="text-muted">  </p>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                
                                                            </div> 
        
                                                         </div> 
                                                        <!-- /.modal-content -->
                                                      </div> 
                                                 </div>  
                                                <!-- /.modal -->
                                          
                               
                            <!-- cut the view all Brand -->         
                                    
                                                      
                                 
                           <!-- cut the view all accessories -->

                            <div class="row">       
                            <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1" style="text-align: center;padding: 12px;">View All Accessories & Brands</h4>                                               
                            </div>


                            @foreach ($roll->get() as $value)
                            @php  $count_roll = DB::table('add_product')->where('accessories',$value->id)->count(); @endphp
                            <!-- @php  $brand = DB::table('add_product')->where('accessories',$value->id)->count(); @endphp -->
                            @if($count_roll != 0)
                            <div class="col-xl-3 col-md-6">
                                            <div class="card card-animate bg-success">
                                               <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-light text-white rounded-2 fs-2">
                                                                <i class="ri-file-2-line"></i>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 ms-3">
                                                            <p class="text-uppercase fw-medium text-white-50 mb-3">Total {{$value->accessories_name}}<br><br><p>
                                                            <h4 class="fs-4 mb-3 text-white"><span class="counter-value" data-target="{{$count_roll}}"></span></h4>
                                                            
                                                        </div>
                                                        
                                                        <div class="flex-shrink-0 align-self-center">
                                                            <!-- <a href="{{URL::to('')}}/add_product?status=0"> -->
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" data-id="{{$value->id}}" class="dashboard">
                                                            <span  data-id="{{$value->id}}"  class="badge badge-soft-light fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>View Brands<span>
                                                                </span></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-->
                                        </div>
                            @endif
                            @endforeach

                            <div class="row">
                            <div class="col-xl-3 col-md-6">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Brands</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"> <span class="counter-value" data-target="{{$brand_count}}">0</span> </h2>
                                                            <p class="mb-0 text-white-50"><span class="badge badge-soft-light mb-0">
                                                                    <!-- <i class="ri-arrow-down-line align-middle"></i> 0.24 % -->
                                                                <!-- </span> vs. previous month</p> -->
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                 <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users text-info"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div> <!-- end card-->
                                        </div>


                                        <div class="col-xl-3 col-md-6">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Accessories</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"> <span class="counter-value" data-target="{{$access_count}}">0</span> </h2>
                                                            <p class="mb-0 text-white-50"><span class="badge badge-soft-light mb-0">
                                                                    <!-- <i class="ri-arrow-down-line align-middle"></i> 0.24 % -->
                                                                <!-- </span> vs. previous month</p> -->
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                 <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users text-info"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div> <!-- end card-->
                                        </div>
                         

                                                   
                            <!-- @foreach ($roll->get() as $value)
                                    @php  $count_roll = DB::table('add_product')->where('status','!=',2)->where('accessories',$value->id)->count();    @endphp
                                    @if($count_roll != 0)
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Total {{$value->accessories_name}}</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$count_roll}}"></span></h2>
                                                      <a href="{{URL::to('/inventory/laptop')}}"><p>View</p></a> -->
                                                    <!-- </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                                                <i class="ri-ticket-2-line"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    @endif
                                    @endforeach --> 
                                    
                                    <div class="row">
                                     <div class="col-xl-3 col-md-6">
                                            <div class="card card-animate bg-primary">
                                               <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-light text-white rounded-2 fs-2">
                                                                <i class="ri-file-2-line"></i>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 ms-3">
                                                            <p class="text-uppercase fw-medium text-white-50 mb-3">Available Stocks <br><br><p>
                                                            <h4 class="fs-4 mb-3 text-white"><span class="counter-value" data-target="{{$available}}"></span></h4>
                                                            <p class="text-white-50 mb-0"></p>
                                                        </div>
                                                        
                                                        <div class="flex-shrink-0 align-self-center">
                                                            <a href="{{URL::to('inventory/view_productlist')}}">
                                                            <span class="badge badge-soft-light fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>View<span>
                                                                </span></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-->
                                        </div>                                


                                <div class="col-xl-3 col-md-6">
                                            <div class="card card-animate bg-primary">
                                               <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-light text-white rounded-2 fs-2">
                                                                <i class="ri-file-2-line"></i>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 ms-3">
                                                            <p class="text-uppercase fw-medium text-white-50 mb-3">Return Stock's<br><br><p>
                                                            <h4 class="fs-4 mb-3 text-white"><span class="counter-value" data-target="{{$return_stock}}"></span></h4>
                                                            <p class="text-white-50 mb-0"></p>
                                                        </div>
                                                        
                                                        <div class="flex-shrink-0 align-self-center">
                                                            <a href="{{URL::to('inventory/return_stock_list')}}">
                                                            <span class="badge badge-soft-light fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>View<span>
                                                                </span></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-->
                                        </div>                                        
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

            

@include('common.inventory.inner_footer')


<script type="text/javascript">
        // $('.dashboard').click(function(){
            $(document).on("click",".dashboard",function(){
            // var id = this.value;             
            var id = $(this).attr("data-id");
            $("#id").val(id);
            $.ajax({
            url: base_url+"/get_dashboard_names/"+id,
            type: "POST",
            // dataType: "json",
             processData:false,
             contentType:false,
             cache:false,
             async:true,
            beforeSend: function() {
                // $('#add_profile_btn').hide();
                // $('#loader').show();
            },
            success: function (data) {  
                // alert();
            // $('#dashboard_appends').html(data);
              var res = JSON.parse(data);
              var contents = res.content;
              added_row = [];
              push = [];
              for (var i = 0; i < contents.length; i++) {
                    var brand = contents[i].brand;
                    var count = contents[i].count;               

                    added_row = '<tr>'
                    + '<td style="padding-top:5px;">' + brand +  '</td>'
                    + '<td style="padding-top:5px;">' + count +  '</td>'
                    + '</tr>';
                    push.push(added_row)
                }  
                var data ='<table style="width:100%"><thead><tr><th>Brand</th><th>Count</th></tr></thead><tbody">'+push+'</tbody></table>';

                    $('#dashboard_appends').html(data.replace(/[, ]+/g, " "))
                    $('#dashboard_popup_title').html(res.title);

                    // console.log('<table><thead><tr><th>Brand</th><th>count</th></tr></thead><tbody>'+push+'</tbody></table>');
               
            
            }
        });
    })
</script>




<script>

$( document ).ready(function() {
$('.viewbrands').on('click', function(){

var brands_id = $(this).attr("data_id");
// alert(brands_id)
$.ajax({
 url: "{{url('inventory/viewbrands')}}",
 type: 'POST',
//  processData:false,
//  contentType:false,
//  cache:false,
//  async:true,
 data: { id :brands_id },

 success: function (data) {    
    
    // var res = JSON.parse(data);
    console.log(data);
 }
});
});
});
</script>




<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">

    // var events = [{start: '2022/08/10', end: '2022/08/11', summary: "", mask: true,color: 'orange'}, {start: '2017/10/08', end: '2017/10/13', summary: "Example Event #3", mask: true}];

    // $('#calendar').calendar({'events': events});

    


</script>