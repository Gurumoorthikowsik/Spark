<?php echo $__env->make('common.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

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
                        <h4 class="mb-sm-0">Create Project</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/dashboard')); ?>">Project Details</a></li>
                                <li class="breadcrumb-item active">Create Project</li>
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

                        <form action="<?php echo e(URL::to('addcertificate')); ?>" id="add-create-form" class="add-create-form" method="post" autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row gy-5">
                    
            
                                    
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Student Id</label>
                                        <input type="text" class="form-control" name="StudentId" id="StudentI"
                                            placeholder="Enter The StudentId" value="">
                                    </div>
                                </div>


                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="placeholderInput" class="form-label">Certificate Student Name</label>
                                            <input type="text" class="form-control" name="Cname" id="Cname"
                                                placeholder="Enter The Certificate Name" value="">
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="placeholderInput" class="form-label">Course Complete Date</label>
                                            <input type="Date" class="form-control" name="CDate" id="CDate"
                                                placeholder="Enter Complete Date" value="">
                                        </div>
                                    </div>
                                    
                                    

                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Course Name</label>
                                        <input type="text" class="form-control" name="coursename" id="coursename"
                                            placeholder="Enter The coursename" value="">
                                    </div>
                                </div>

                      



                                <div class="col-xxl-5 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Certificate File</label>
                                        <input type="file" class="form-control" id="file" name="file" >
                                          
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





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>
 

 $(document).ready(function() {
    // Initialize Select2 on the multi-select dropdown
    $('#student_names').select2({
        placeholder: 'Select student(s)...',
        allowClear: true // This allows clearing the selection
    });

    // When the role or batch is selected/changed
    $('#inputGroupSelect01, #batch').change(function() {
        
        var roll = $('#inputGroupSelect01').val();  // Get the selected role
        var batch = $('#batch').val();  // Get the entered batch value

        if (roll && batch) {
            $.ajax({
                url: '<?php echo e(route('getStudentsByRole')); ?>',  // Route to fetch students
                type: 'GET',
                data: { 
                    roll: roll,  // Pass selected roll
                    batch: batch // Pass batch value
                },
                success: function(response) {
                    if (response.success) {
                        // Clear the select options before appending new ones
                        $('#student_names').empty();
                        
                        // Populate the student names in the multi-select dropdown
                        response.students.forEach(function(student) {
                            $('#student_names').append(
                                $('<option>', {
                                    value: student.userid, // Set the userid as the value
                                    text: `${student.username} (${student.userid})` // Display username and userid
                                })
                            );
                        });

                        // Refresh Select2 to reflect the changes
                        $('#student_names').trigger('change');
                    } else {
                        // If no students are found, show a message
                        $('#student_names').empty().append('<option>No students found</option>');
                        $('#student_names').trigger('change');
                    }
                },
                error: function() {
                    alert('Error fetching student names');
                }
            });
        } else {
            // Clear the dropdown if no role or batch is selected
            $('#student_names').empty().append('<option>Select student(s)...</option>');
            $('#student_names').trigger('change');
        }
    });
});


</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


<script type="text/javascript">
    <?php if(session('success')): ?>
        toastr.success('<?php echo e(session('success')); ?>', 'Success', {
            timeOut: 2000
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        toastr.error('<?php echo e(session('error')); ?>', {
            timeOut: 2000
        });
    <?php endif; ?>

    <?php if(session('primary')): ?>
        toastr.primary('<?php echo e(session('primary')); ?>', {
            timeOut: 2000
        });
    <?php endif; ?>

    <?php if(session('message')): ?>
        toastr.message('<?php echo e(session('message')); ?>', {
            timeOut: 2000
        });
    <?php endif; ?>

    <?php if(session('info')): ?>
        toastr.info('<?php echo e(session('info')); ?>', {
            timeOut: 2000
        });
    <?php endif; ?>


    <?php if(!empty($errors->all())): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error("<?php echo e($error); ?>")
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/project/create-certificate.blade.php ENDPATH**/ ?>