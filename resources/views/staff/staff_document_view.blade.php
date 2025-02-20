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
                                <!-- <h4 class="mb-sm-0">Edit Staff</h4> -->

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{URL::to('/staff_documents')}}">staff Documents</a></li>
                                        
                                        <li class="breadcrumb-item active">Upload Staff Proof</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                        <div class="row">

                            <div class="col-lg-12">

                            	 

                                <div class="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                              

                                              <!-- document image start   -->

                                                <div class="row gallery-wrapper">
                                           	@if(@$user_proof->document) 
                                           	<?php $document_status = 1;  $result = unserialize($user_proof->document);  ?>  
                         							@foreach($result as $key =>  $value)

                         								@if($value != '')
                                                    <div class="element-item col-xxl-3 col-xl-4 col-sm-6 project designing development"  data-category="designing development">
                                                        <div class="gallery-box card" style="width: 319px;height: 380px;">
                                                            <div class="gallery-container">
                                                                <a class="" target="_blank" href="{{$value[$key.'_image']}}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{$value[$key.'_image']}}" alt="{{strtoupper($key)}}" style="object-fit: cover;height: 100%;width: auto;min-height: 300px;overflow: hidden;" /> 
                                                                    <div class="gallery-overlay">
                                                                        <h5 class="overlay-caption">{{strtoupper($key)}}</h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            
                                                            <div class="box-content">
            												<br>
                                                                <?php 

                                                                if($value[$key.'_status'] == 0){
                                                                    $document_status = 0;
                                                                }else if($value[$key.'_status'] == 2){
                                                                    $document_status = 2;
                                                                } ?>
                                                                
                                                               
                                                            <div class="d-flex align-items-center mt-1" style="gap: 5px;font-size: 12px;">
                                                                <div class=" text-muted"><a href="#" class="text-body text-truncate">{{strtoupper($key)}}</a>
                                                                </div>

                                                                
                                                                    
                                                                    @if($value[$key.'_status'] == 0)
                                                                    <a href="/approve_document/{{$user_id}}/{{encrypt_decrypt('encrypt',$key)}}"><button type="button" class="btn btn-success add-btn" style="padding: 3px 8px 2px 6px;"> Approved </button></a>
                                                                    @elseif($value[$key.'_status'] == 1)
                                                                        <span>Status : <span class="badge badge-soft-primary text-success">Approved</span></span>
                                                                    @else
                                                                         <span>Status : <span class="badge badge-soft-primary text-danger">Rejected</span></span><br>                                                                         
                            
                                                                         @endif 
                                                                         
                                                                    @if($value[$key.'_status']==0)                                             
                                                                    <a href="#"  class="comment" document="{{$key}}"><button type="button" class="btn btn-danger add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" style="padding: 3px 8px 2px 6px;"> Rejected </button></a>
                                                                     @endif  
                                                                  </div>     
                                                                                                                              
                                                                                                                       

                                                                <!-- <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"></div>
                                                                    <div class="flex-shrink-0">
                                                                    <div class="d-flex gap-3">
                                                                    </div>  
                                                                                                  
                                                                    </div>                                                 
                                                                </div> -->
                                                            
                                                         
                                                            </div>
                                                        </div>
                                                       <b style="margin-left: 10px;"> <?php echo (@$value[$key.'_reason'] != '') ? 'Rejected Reason: '.$value[$key.'_reason'] : ''; ?></b>
                                                    </div> 
                                                
                                                  @endif
                                                @endforeach
                                                @endif

                                                <?php
                                                if($doc_id->count() > 0){
                                                    $id = $doc_id->first()->id;  
                                                    DB::table('user_document')->where('id',$id)->update(['option' => $document_status]); $document_status;
                                                }
                                                ?>
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
                    <div class="modal-header bg-light p-3"> <h4>Rejected Reason</h4>
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form action="<?php echo URL::to('/'); ?>/rejected_document" id="staff_document_view" class="staff_document_view" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="modal-body">  

                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="doc_id" id="doc_id" value="<?php echo @$doc_id->first()->id; ?>">
                            </div>

                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="document_name" id="document_name">
                            </div>                      	

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Reason *</label>
                                <input type="text" class="form-control" name="comment" id="comment">
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




        <script>
$(document).on("click",".comment",function(){

        var document = $(this).attr("document");
        $("#document_name").val(document);
        
})
</script>


<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
@include('common.inner_footer')                                    
 

