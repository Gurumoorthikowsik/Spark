@include('common.inner_header')
@include('common.sidebar')

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
                        <h4 class="mb-sm-0">Attendance</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Attendance</a></li>
                                <li class="breadcrumb-item active">{{$title}}</li>
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
                        
                    <h5 class="mb-sm-0">{{$title}}</h5>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">

                        <form action="#" id="entry-attendance-form" class="entry-attendance-form" method="post" autocomplete="off">
                            <div class="row gy-6">
                                <div class="col-lg-8" style="padding-left:300px">
                                    <label for="valueInput" class="form-label">Attendance Event </label>
                                    <div class="input-group">
                                        <select class="form-select" id="inputGroupSelect01" name="event" id="event" >
                                            @foreach ($event as $value)
                                                <option value="{{$value->id}}">{{$value->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label id="inputGroupSelect01-error" class="error" for="inputGroupSelect01"></label>
                                </div>


                                <div class="container">
                                    <div class="row"><div class="col"></div><div class="col">
                                    <div class="col-xxl-4 col-md-12">
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
                                    <button type="submit" name="entry_attendance_btn" id="entry_attendance_btn" class="btn btn-success w-100 entry_attendance_btn">Submit</button>
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
@include('common.inner_footer')                                    