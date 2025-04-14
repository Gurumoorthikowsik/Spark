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
                      
                                <?php if($certificate): ?>
                                <img src="<?php echo e($certificate->file); ?>" alt="Certificate Image" class="w-100">
                                <div class="text-center">
                                
                            
                            
                                <button id="downloadPdfBtn" class="btn btn-primary mt-3">Download Certificate as PDF</button>

                            </div>
                                <?php else: ?>
                                <p>No certificate found for this student.</p>
                            <?php endif; ?>
                                                       
                            </div>
                        </div>


                </div>



                
        </div>
        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>

        



<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const downloadBtn = document.getElementById("downloadPdfBtn");
        const imgElement = document.getElementById("certificateImage");

        if (!imgElement) {
            console.error("Certificate image not found!");
            return;
        }

        downloadBtn.addEventListener("click", async function () {
            const { jsPDF } = window.jspdf;

            const image = new Image();
            image.crossOrigin = "anonymous"; // for external images like Cloudinary
            image.src = imgElement.src;

            image.onload = function () {
                const pdf = new jsPDF();
                const imgWidth = 210; // A4 width in mm
                const ratio = image.height / image.width;
                const imgHeight = imgWidth * ratio;

                pdf.addImage(image, 'PNG', 0, 0, imgWidth, imgHeight);
                pdf.save("Student_Certificate.pdf");
            };

            image.onerror = function () {
                alert("Could not load certificate image.");
            };
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/employee/student-certificate.blade.php ENDPATH**/ ?>