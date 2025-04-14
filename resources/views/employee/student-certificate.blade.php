@include('common.employee.inner_header')
@include('common.employee.sidebar')

 <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/employees/dashboard')}}">Dashboard</a></li>
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
                      
                                @if($certificate)
                                <img src="{{ $certificate->file }}" alt="Certificate Image" class="w-100">
                                <div class="text-center">
                                {{-- <a href="{{ route('certificate.download') }}" class="btn btn-primary mt-5" target="_blank">Download Certificate (PDF)</a> --}}
                            
                            
                                {{-- <button id="downloadPdfBtn" class="btn btn-primary mt-3">Download Certificate as PDF</button> --}}

                            </div>
                                @else
                                <p>No certificate found for this student.</p>
                            @endif
                                                       
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

        



@include('common.employee.inner_footer')
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
