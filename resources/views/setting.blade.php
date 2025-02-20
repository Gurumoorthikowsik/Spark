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
                                <h4 class="mb-sm-0">Site Setting</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{URL::to('/setting')}}">Site Setting</a></li>
                                        
                                     
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo URL::to('/'); ?>/site_setting" id="setting-form" class="setting-form" method="post" autocomplete="off" enctype="multipart/form-data">
                                 {{ csrf_field() }} 
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Site Setting</h4>
                                    <div class="flex-shrink-0">
                                   
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        
                                        <div class="row gy-4">
                                             <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="basiInput" class="form-label">Site Name *</label>
                                                    <input type="text" class="form-control" id="basiInput" name="site_name" id="site_name" value="{{$setting->site_name}}" >
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="basiInput" class="form-label">Site Fav Icon *</label>
                                                    <input type="file" class="form-control" name="fav_icon" id="fav_icon" value="{{$setting->site_fav}}">
                                                    <img src="{{$setting->site_fav}}" style="max-width:150px">
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="labelInput" class="form-label">Staff Logo *</label>
                                                    <input type="file" class="form-control" name="site_logo" id="site_logo" value="{{$setting->site_logo}}">
                                                    {{-- <img src="{{$setting->site_logo}}" style="max-width:150px"> --}}
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="placeholderInput" class="form-label">Contact Number *</label>
                                                    <input type="text" class="form-control" name="contact_no" id="contact_no" name="contact_no" value="{{$setting->contact_number}}"
                                                        placeholder="Enter The Contact Number">
                                                </div>
                                            </div>

                                           
                                            <div class="col-xxl-4 col-md-6">
                                                 <div>
                                                    <label for="exampleFormControlTextarea5" class="form-label">Address *</label>
                                                    <textarea class="form-control" id="address" name="address" rows="3"  placeholder="Enter The Address">{{$setting->address}}</textarea>
                                                </div>
                                            </div>

                                           <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="placeholderInput" class="form-label">Copy Right *</label>
                                                    <input type="text" class="form-control" name="copy_right" id="copy_right"
                                                        placeholder="Enter The Copy Right" value="{{$setting->copyright}}">
                                                </div>
                                            </div>

                                               <div class="col-xxl-4 col-md-6">
                                                <label for="valueInput" class="form-label">Site Undermaintance </label>
                                                <div class="input-group">
                                                    
                                                    <select class="form-select" id="inputGroupSelect01" name="undermaintance" id="undermaintance" >
                                                       
                                                            <option value="1" <?php echo ($setting->undermaintance == 1) ? 'selected' : ''; ?>>Yes</option>
                                                            <option value="0" <?php echo ($setting->undermaintance == 0) ? 'selected' : ''; ?>>No</option>
                                           
                                                    </select>
                                                </div>
                                                <label id="inputGroupSelect01-error" class="error" for="inputGroupSelect01"></label>
                                            </div>

                                            <div class="col-xxl-4 col-md-6">
                                                 <div>
                                                    <label for="exampleFormControlTextarea5" class="form-label">Employe News Content</label>
                                                    <textarea class="form-control" id="news_content" name="news_content" rows="3"  placeholder="Enter The News Content">{{$setting->news}}</textarea>
                                                </div>
                                            </div>


                                           
                                        </div>
                                    
                                        <!--end row-->
                                    </div>
                                </div>





                              
                               

                    
                               

                               
                             


                                
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


                        </div>
                    </div>
                </div>


@include('common.inner_footer')