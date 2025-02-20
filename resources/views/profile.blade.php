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
                        <h4 class="mb-sm-0">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
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

                            <form action="#" id="add-profile-form" class="add-profile-form" method="post" autocomplete="off">
                            <div class="row gy-5">
           

                                 
                                 <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Enter The User Name" value="{{$user->username}}">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="iconInput" class="form-label">Email</label>
                                        <div class="form-icon">
                                            <input type="email" class="form-control form-control-icon"
                                                id="email" name="email" placeholder="Enter The Email ID" value="{{encrypt_decrypt('decrypt',$user->email)}}">
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                            <label id="staffemail-error" class="error" for="staffemail"></label>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            placeholder="Enter The Phone Number" value="{{$user->phone_number}}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Personal Email ID</label>
                                        <input type="email" class="form-control" id="personalemail" name="personalemail"
                                            placeholder="Enter The Personal Email ID" value="{{$user->personal_email}}">
                                    </div>
                                </div>


                                <div class="col-xxl-5 col-md-6">
                                     <div>
                                        <label for="exampleFormControlTextarea5" class="form-label">Permanent Address *</label>
                                        <textarea class="form-control" id="address" name="address" rows="3"  placeholder="Enter Staff Permanent Address">{{$user->address}}</textarea>
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

                                    <button type="submit" name="add_profile_btn" id="add_profile_btn" class="btn btn-success w-100 add_profile_btn">Submit</button>
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
@include('common.inner_footer')                                    