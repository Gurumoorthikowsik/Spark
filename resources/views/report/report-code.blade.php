@include('common.inner_header')
@include('common.sidebar')


<style type="text/css">
.dataTables_wrapper { font-family: "--vz-body-font-family"}


.dt-buttons button {
    background: #0ab39c;
    color: white;
    border: #0ab39c;
    border-radius: 0.25rem;
    padding: 10px;
}
thead {
    background: #f3f6f9;
}
div#example_paginate span a.paginate_button.current {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #405189 !important;
    border-color: #405189 !important;
    font-weight: 500 !important;
}
a.paginate_button {
    border: 1px solid #e2e2ec !important;
    
}div#example_paginate a {
    margin: 5px 3px;
}
div.dt-buttons {
    float: left;
    padding-bottom: 16px;
}
button.dt-button:hover:not(.disabled){
    border: 1px solid #fff;
background: linear-gradient(to bottom, rgb(10 179 156) 0%, rgb(10 179 156) 100%);
}
table.dataTable.display>tbody>tr.odd>.sorting_1{
    box-shadow:unset !important;
}
table.dataTable.display tbody tr:hover>.sorting_1, table.dataTable.order-column.hover tbody tr:hover>.sorting_1 {
     box-shadow: unset !important; 
}
a#example_previous {
    border: 1px solid #e9ebec;
    background: white;
    color: #878a99 !important;
    border-radius: 0.25rem !important;
}

table td {
  word-wrap: break-word;
  max-width: 400px;
}

</style>


            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

<!-- ==========================================================Table Start====================================================================== -->
                <div class="page-content">
                    <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Student View Working Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{URL::to('/staff_working_report')}}/{{Session::get('working_roll')}}">Working Report Staff List</a></li>
                                        
                                        <li class="breadcrumb-item active">Student View Working Report</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                        <div class="card" id="contactList">
                            <div class="card-header">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-3">
                                        <h5 class="card-title mb-0">Student Source Code</h5>
                                        <br>
                                    </div><!--end col-->
                                    <div class="col-md-auto ms-auto">
                                        <div class="d-flex gap-2">

                                            <!-- <select class="form-select" aria-label=".form-select-sm example">
                                                 <option value="today">Today</option>
                                                 <option value="all">ALL</option>
                                                 <option value="day">Day</option>
                                                 <option value="month">Month</option>
                                            </select> &nbsp &nbsp -->

                                            <!-- <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for days...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                            -->
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-header-->
                            <div class="row">
                            <div class="col-lg-12">
                           
                                


<div class="card" style="border: 1px solid #ddd; border-radius: 5px; padding: 20px; margin: 10px;">
    <div class="card-header" style="font-weight: bold; font-size: 1.2em;">
        Source Code
    </div>
    <div class="card-body">
        <!-- Preformatted code block -->
        <pre id="sourceCodeContent" style="background-color: #f4f4f4; padding: 15px; border-radius: 5px; white-space: pre-wrap; word-wrap: break-word;">
            {{$report->source_code}}
        </pre>

        <!-- Copy button -->
        <button id="copyButton" style="margin-top: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Copy Code
        </button>
    </div>
</div>


<form action="{{ URL::to('/srcupdate') }}" method="POST">
    {{ csrf_field() }}

    <!-- Hidden input to pass the report id -->
    <input type="hidden" name="id" value="{{ $report->id }}">

    <input type="hidden" name="user_id" value="{{ $report->user_id }}">


    <div class="mb-3">
        <label for="source-code" class="form-label">Source Code*</label>
        <textarea class="form-control" name="source_code" id="source_code" rows="10" placeholder="Write your code here..."></textarea>
    </div>

    <button type="submit" class="btn btn-success">Update Code</button>
</form>



                           
                        </div><!--end card-->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<!-- ==========================================================Table End====================================================================== -->


           
            </div>






@include('common.inner_footer')

  
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

