@include('common.inner_header')
@include('common.sidebar')

<div class="vertical-overlay"></div>


          <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">


                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Edit Staff</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{URL::to('/viewstaff')}}">View All Staff</a></li>
                                        
                                        <li class="breadcrumb-item active">Upload Staff Proof</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                        <div class="row">

                            <div class="col-lg-12">

                            	 <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Staff Proof </button>

                                <div class="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                              

                                              <!-- document image start   -->

                                                <div class="row gallery-wrapper">
                                           	@if(@$user_proof->document) 
                                           	<?php   $result = unserialize($user_proof->document); if($result){ ?>  
                							@foreach($result as $key =>  $value)

                								@if($value != '')
                                                    <div class="element-item col-xxl-3 col-xl-4 col-sm-6 project designing development"  data-category="designing development">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="" target="_blank" href="{{$value[$key.'_image']}}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{$value[$key.'_image']}}" alt="{{strtoupper($key)}}" /> 
                                                                    <div class="gallery-overlay">
                                                                        <h5 class="overlay-caption">{{strtoupper($key)}}</h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            
                                                            <div class="box-content">
            												<br>
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="#" class="text-body text-truncate">{{strtoupper($key)}}</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                         
                                                                          <!--   <a href="{{URL::to('')}}/delete_user_proof/{{$user_id}}?slug={{$key}}"><button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                                                                <i class=" ri-delete-bin-4-fill"> Delete</i>
                                                                            </button></a> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                
                                                  @endif
                                                @endforeach
                                                <?php } ?>
                                                @endif
                                                <!-- document image end -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- ene card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div>
                    <!-- container-fluid -->
                </div>

            </div>



          <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;max-height: 500px;">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3"> <h4>Proof Upload</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/staff_proof/<?php echo $user_id; ?>" id="proof-form" class="proof-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="modal-body">
                        	<div class="mb-3">
                                <label for="customername-field" class="form-label">Choose Certificate Type* </label>
                                <select class="form-select"  name="type" id="type" >
                                    <option value="">Choose Type</option>
                                    @foreach ($document_list as $value)
                                        <option value="{{$value->types}}">{{$value->types}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Upload *</label>
                                <input type="file" class="form-control" name="proof" id="proof">
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
<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
@include('common.inner_footer')                                    
 
