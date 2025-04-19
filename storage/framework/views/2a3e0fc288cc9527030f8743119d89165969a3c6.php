<?php echo $__env->make('common.employee.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    /* Optional styles for better card design */
    .card-preview {
        height: 150px;
        overflow: hidden;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    .card-body {
        overflow: hidden;
    }
</style>

 <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/employees/dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 mb-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?php echo e($proj->screenshot); ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($proj->template_name); ?></h5>
                                    <p class="card-text"><?php echo e($proj->desc); ?></p>
        
                  
                                    <a href="<?php echo e(URL::to('template')); ?>/<?php echo e($proj->id); ?>" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <!-- #/ container -->
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/Template/All-temp.blade.php ENDPATH**/ ?>