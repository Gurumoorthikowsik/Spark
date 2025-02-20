<?php echo $__env->make('common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel="stylesheet"  href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    
                <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="<?php echo e(URL::to('/')); ?>" class="d-inline-block auth-logo">
                                        <img src="<?php echo e(URL::to('/')); ?><?php echo e(asset('assets/imageslogo-light.png')); ?>" alt="" height="20">
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">
                            
                                <div class="card-body p-4"> 
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Welcome Back Admin Portal</h5>
                                        <p class="text-muted">Sign in to continue to K.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form action="#" id="login-form" class="login-form" method="post" autocomplete="off">
            
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Id">
                                            </div>
                    
                                            <div class="mb-3">
                                               <!--  <div class="float-end">
                                                    <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                                </div> -->
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="password" id="password" class="form-control pe-5" placeholder="Enter Your password" >

                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"> <i class="fas fa-eye-slash icone" id="eye"></i></button>

                                                </div>
                                            </div>

                                            
                                            <div class="mt-4">
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

                                                <button type="submit" name="login_btn" id="login_btn" class="btn btn-success w-100">Sign In</button>
                                            </div>

                             
                                        </form>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->
<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
<?php echo $__env->make('common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



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
 </script><?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/login.blade.php ENDPATH**/ ?>