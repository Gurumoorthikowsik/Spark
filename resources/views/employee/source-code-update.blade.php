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
                           
                                <div class="card" style="border: 1px solid #ddd; border-radius: 5px; padding: 20px; margin: 10px;">
                                    <div class="card-header" style="font-weight: bold; font-size: 1.2em;">
                                        Source Code
                                    </div>
                                    <div class="card-body">
                                        <!-- Preformatted code block -->
                                        <pre id="sourceCodeContent" style="background-color: #f4f4f4; padding: 15px; border-radius: 5px; white-space: pre-wrap; word-wrap: break-word;">
                                            {{$updateSrc->source_code}}
                                        </pre>
                                
                                        <!-- Copy button -->
                                        <button id="copyButton" style="margin-top: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                            Copy Code
                                        </button>
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
            <!-- #/ container -->
        </div>

@include('common.employee.inner_footer')

<script>
    document.getElementById('copyButton').addEventListener('click', function() {
        const sourceCode = document.getElementById('sourceCodeContent').textContent;
        const textArea = document.createElement('textarea');
        textArea.value = sourceCode;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

        $.notify('Code copied to clipboard', { 
    className: 'success', 
    clickToHide: true 
});
    });
</script>
