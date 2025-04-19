<?php echo $__env->make('common.employee.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/employees/dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Task</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>project Name </th>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>GitUrl / WebsiteUrl</th>
                                                
                                                <th>view</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="item">
                                                    <td class="id"><?php echo e($loop->iteration); ?></td>
                                                    <td class="form_name"><?php echo e($values->project); ?></td>
                                                    <td class="form_name"><?php echo e($values->desc); ?></td>
                                                    <td class="form_name"><?php echo e($values->type); ?></td>
                                        
                                                    <td>
                                                        <?php if($values->status == 1): ?>
                                                            <span class="badge badge-warning">Processing</span>
                                                        <?php elseif($values->status == 2): ?>
                                                            <span class="badge badge-danger">Pending</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-success">Completed</span>
                                                        <?php endif; ?>
                                                    </td>
                                        
                                                    <td class="form_name">
                                                        <a href="<?php echo e($values->git_url); ?>" class="fa fa-github fa-2x" target="_blank"></a>
                                                    </td>
                                                    

                                                    <td class="form_name">
                                                        <a href="<?php echo e(url('taskboard')); ?>" class="fa fa-2x fa-eye"></a>
                                                    </td>


                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        
                                        


                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>
</div>
</div>

</div>

<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/employee/task-assign.blade.php ENDPATH**/ ?>