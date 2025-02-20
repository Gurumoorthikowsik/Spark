<?php echo $__env->make('common.employee.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet"  href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="<?php echo e(URL::to('/')); ?>"> <h4><?php echo e(site_setting()->site_name); ?></h4></a>
        
                                <form action="#" id="emp-login-form" method="post" class="mt-5 mb-5 login-input emp-login-form" autocomplete="off">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"  id="password" placeholder="Password">

                                          <button class="btn btn-link" style="cursor: pointer;float: right;position: relative;top: -35px;color: gray;" type="button" id="password-addon"> <i class="fas fa-eye-slash icone" id="eye"></i></button>
                                    </div>
                                    <button style="display: none;" type="button" name="login_btn" id="login_btn" class="btn login-form__btn submit w-100 loading_btn">Loading ...</button>
                                    <button type="submit" name="login_btn" id="login_btn" class="btn login-form__btn submit w-100 login_btn">Sign In</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $__env->make('common.employee.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


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
 </script><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/employee/login.blade.php ENDPATH**/ ?>