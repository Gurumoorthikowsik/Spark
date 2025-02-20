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
                        <h4 class="mb-sm-0">View All Calculate Monthly Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">View Calculate Monthly Report List</a></li>
                                <li class="breadcrumb-item active">View Calculate Monthly Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            
           
       
            
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="#" method="post">

                                        <h4>View Calculate Monthly Report</h4>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label" for="val-username"> Month Total Working Days: 
                                            </label>
                                            <label class="col-lg-3 col-form-label" for="val-username"> <b>{{$calculate_month_days}}</b>
                                            </label>

                                            </div>
                                            <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"  for="val-username"> Present Days ({{$employe_month_precent_days->count()}}):
                                            </label>
                                                @if($employe_month_precent_days->count() != 0)
                                                @foreach($employe_month_precent_days->get() as $key => $value)
                                                <label class="col-lg-3 col-form-label" style="width:9%;" for="val-username"> <b>{{$value->date}}</b>
                                                 </label>
                                                @endforeach
                                                @else
                                                <label class="col-lg-3 col-form-label" for="val-username"> <b>--</b>
                                                </label>
                                                @endif
                                            
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"  for="val-username"> Low Working Days ({{$employe_month_low_working_days->count()}}):
                                            </label>
                                            @if($employe_month_low_working_days->count() != 0)
                                            @foreach($employe_month_low_working_days->get() as $key => $value)

                                            <label class="col-lg-2 col-form-label" style="width:9%;" for="val-username">{{$value->date}}
                                            </label>
                                                @endforeach
                                                @else
                                                <label class="col-lg-3 col-form-label" for="val-username"> <b>--</b>
                                                </label>
                                                @endif

                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"  for="val-username"> Absent Days ({{count($employe_month_absent_days)}}):
                                            </label>
                                            @if(count($employe_month_absent_days) != 0)
                                            @foreach($employe_month_absent_days as $key => $value)

                                            <label class="col-lg-2 col-form-label" style="width:9%;" for="val-username"> {{$value}}
                                            </label>
                                                @endforeach
                                                @else
                                                <label class="col-lg-3 col-form-label" for="val-username"> <b>--</b>
                                                </label>
                                                @endif

                                     </div> 
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"  for="val-username"> Office Leave Days ({{count($office_leave_count)}}):
                                            </label>
                                            
                                            @foreach($office_leave_count as $value)
                                            <label class="col-lg-2 col-form-label" style="width:9%;" for="val-username">{{$value}}
                                            </label>
                                            @endforeach
                                              

                                        </div> 
                                     

                                        <div class="form-group row">
                                          

                                             <label class="col-lg-2 col-form-label" for="val-username"> CL :
                                            </label>
                                            <label class="col-lg-3 col-form-label" for="val-username"> {{$cal_month_rep->cl}}
                                            </label>
                                            <label class="col-lg-2 col-form-label" for="val-username"> Permission :
                                            </label>
                                            <label class="col-lg-3 col-form-label" for="val-username"> {{$cal_month_rep->permission}}
                                            </label>

                                        </div>


                                        

                                    </form>
                                </div>
                            </div>
                        
      
        
        <br>
        <div class="row">
            <div class="col-lg-12">                
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
                           


