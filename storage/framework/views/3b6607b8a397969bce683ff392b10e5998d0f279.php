<?php
$page = ($title) ? $title : '';
$user = DB::table('user_info')->select('userid','main_access')->where('userid',user_id())->first();
?>


<?php echo $__env->make('common.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Vertical Overlay-->
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
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/dashboard')); ?>">Dashboards</a></li>
                                       
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="">

                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1"><?php echo e(Dayzone()); ?>, <?php echo e(get_user(user_id(),'username')); ?>!</h4>
                                               
                                            </div>
       
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <div class="row">


                                <?php $__currentLoopData = $roll->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php  $count_roll = DB::table('user_info')->where('status','!=',2)->where('position',$value->sort_name)->count();    ?>
                                    <?php if($count_roll != 0): ?>
                                    <div class="col-xl-3 col-md-6">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total <?php echo e($value->roll); ?></p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"> <span class="counter-value" data-target="<?php echo e($count_roll); ?>">0</span> </h2>
                                                            <p class="mb-0 text-white-50"><span class="badge badge-soft-light mb-0">
                                                                    <!-- <i class="ri-arrow-down-line align-middle"></i> 0.24 % -->
                                                                <!-- </span> vs. previous month</p> -->
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                 <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users text-info"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div> <!-- end card-->
                                        </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <!-- <br> -->
                        
     
                    
                            </div> <!-- end .h-100-->



                        </div> <!-- end col -->

                        <div class="col-auto layout-rightside-col">
                            <div class="overlay"></div>
                            <div class="layout-rightside">
                               
                            </div> <!-- end .rightbar-->

                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

            

<?php echo $__env->make('common.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $(document).ready(function(e){
        calendar = new CalendarYvv("#calendar", moment().format("Y-M-D"), "Monday");
        calendar.funcPer = function(ev){
            console.log(ev)
        };
        $.ajax({
            url: base_url+"/dashboard_calander",
            type: "POST",
             processData:false,
             contentType:false,
             cache:false,
             async:true,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function (data) {                    
              var res = JSON.parse(data);

              

              const precent = res.precent.map(precents => {
                return Number(precents);
              });


              const low_working_day = res.low_working_day.map(low_working_day => {
                return Number(low_working_day);
              });

              const leavedays = res.leavedays.map(leavedays => {
                return Number(leavedays);
              });
             
              calendar.obsend = res.obsend;
              calendar.precent = precent;
              calendar.low_working_day = low_working_day;
              calendar.leavedays = leavedays;
              calendar.createCalendar();
        
            }
        });


    });
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">

    // var events = [{start: '2022/08/10', end: '2022/08/11', summary: "", mask: true,color: 'orange'}, {start: '2017/10/08', end: '2017/10/13', summary: "Example Event #3", mask: true}];

    // $('#calendar').calendar({'events': events});

    


</script><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/dashboard.blade.php ENDPATH**/ ?>