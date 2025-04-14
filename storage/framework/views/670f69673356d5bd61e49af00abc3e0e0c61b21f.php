<?php echo $__env->make('common.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel="stylesheet"  href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

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
                        <h4 class="mb-sm-0">Add Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/dashboard')); ?>">Staff Details</a></li>
                                <li class="breadcrumb-item active">Add Student</li>
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

                            <form action="#" id="add-staff-form" class="add-staff-form" method="post" autocomplete="off">
                            <div class="row gy-5">
                                <div class="col-lg-5">
                                    <label for="valueInput" class="form-label">Student Role</label>
                                    <div class="input-group">
                                        
                                        <select class="form-select" id="inputGroupSelect01" name="roll" id="roll" >
                                            <option value="">Choose Staff Role...</option>
                                            <?php $__currentLoopData = $roll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->roll); ?>"><?php echo e($value->roll); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <label id="inputGroupSelect01-error" class="error" for="inputGroupSelect01"></label>
                                </div>

                                 <div class="col-lg-5">
                                    <div>
                                        
                                        <div class="form-icon">
                                            <label for="placeholderInput" class="form-label">Working Hours *</label>
                                            <input type="text" class="form-control" name="working_hrs" id="working_hrs"
                                                        placeholder="Enter Staff Working Hours Format : 00:00" >
                                        </div>
                                    </div>
                                 </div>
                                 
                                 <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" name="staffname" id="staffname"
                                            placeholder="Enter The Staff Name" value="">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="iconInput" class="form-label">Student Email</label>
                                        <div class="form-icon">
                                            <input type="email" class="form-control form-control-icon"
                                                id="staffemail" name="staffemail" placeholder="Enter The Staff Email ID">
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                            <label id="staffemail-error" class="error" for="staffemail"></label>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Student Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter The Staff Password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon" style="padding-top: 37px;width: 81px;"> <i class="fas fa-eye-slash icone" id="eye"></i></button>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Confirm password</label>
                                        <input type="password" class="form-control" id="c_password" name="c_password"
                                            placeholder=" Enter the staff confirm Password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon" style="padding-top: 37px;width: 81px;"> <i class="fas fa-eye-slash icone" id="eyes"></i></button>
                                          
                                    </div>
                                </div>

                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Batch number</label>
                                        <input type="number" class="form-control" id="b_num" name="b_num"
                                            placeholder=" Enter the Batch Number">
                                          
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

                                    <button type="submit" name="add_staff_btn" id="add_staff_btn" class="btn btn-success w-100">Submit</button>
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
<?php echo $__env->make('common.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                                    


<script>

$(function(){

$('#eye').click(function(){

 if($(this).hasClass('fa-eye-slash')){

 $(this).removeClass('fa-eye-slash');

 $(this).addClass('fa-eye');

 $('#password').attr('type','text');

}else{

 $(this).removeClass('fa-eye');

 $(this).addClass('fa-eye-slash');  

 $('#password').attr('type','password');
}
 });
});
 </script>


<script>

$(function(){

$('#eyes').click(function(){

 if($(this).hasClass('fa-eye-slash')){

 $(this).removeClass('fa-eye-slash');

 $(this).addClass('fa-eye');

 $('#c_password').attr('type','text');

}else{

 $(this).removeClass('fa-eye');

 $(this).addClass('fa-eye-slash');  

 $('#c_password').attr('type','password');
}
 });
});
 </script><?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/staff/add_staff.blade.php ENDPATH**/ ?>