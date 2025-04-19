<?php echo $__env->make('common.employee.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Create Open Source Project</h4>

                                <div class="form-validation">

                    <form action="<?php echo e(URL::to('create-my-pro')); ?>" id="leave-day-form" class="leave-day-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">


                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="mb-3" id="modal-id">
                                            <label for="id-field" class="form-label">Template Name</label>
                                            <input type="text" id="template_name" name="template_name" class="form-control" placeholder="Template Name" />
                                        </div>

                                    </div>

                                    <div class="col-lg-6">

                                        <div class="mb-3" id="modal-id" >
                                            <label for="id-field" class="form-label">Description</label>
                                            <input type="text" id="desc" name="desc" class="form-control" placeholder="Description"  />
                                        </div>
                                        
                                    </div>

                                    <div class="col-lg-6">

                                        <div class="mb-3" id="modal-id" >
                                            <label for="id-field" class="form-label">Status</label>

                                            <select  class="form-control" name="status" id="status" >
                                                <option value="1">Enable</option>
                                                <option value="2">Disable</option>

                                            </select>
                                        </div>
                                        
                                    </div>

                                    <div class="col-lg-6">

                                        <div class="mb-3" id="modal-id" >
                                            <label for="id-field" class="form-label">Source File</label>
                                            <input type="file" id="file" name="file" class="form-control"/>
                                        </div>
                                        
                                    </div>


                                    <div class="col-lg-6">

                                        <div class="mb-3" id="modal-id" >
                                            <label for="id-field" class="form-label">Front Page Screen shot</label>
                                            <input type="file" id="screenshot" name="screenshot" class="form-control"/>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>

                       


                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="leave_day-btn" name="leave_day_btn">Submit</button>
                            </div>
                        </div>
                    </form>



                                </div>
                            </div>
                        </div>

           



                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>

<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/Template/create-student-template.blade.php ENDPATH**/ ?>