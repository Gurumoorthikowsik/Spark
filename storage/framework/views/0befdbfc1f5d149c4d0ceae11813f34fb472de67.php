<?php echo $__env->make('common.employee.inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common.employee.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<style>
    .card.gradient-1 .card-body {
    padding: 1.88rem 1.81rem;
    height: 147px;
    }
    .card.gradient-1 marquee {
    height: 100px;
    text-align:justify;
    }
</style>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
                                    
              
            <div class="container-fluid mt-3">
                 <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1"><?php echo e(Dayzone()); ?>, <?php echo e(get_user(emp_user_id(),'username')); ?>!</h4>
                   
                </div><br>
                <div class="row">

                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body" id="working_hrs_card" style="background-color: #f93c95;border-radius:inherit">
                                <h3 class="card-title text-white">Today Working Hours</h3>
                                <div class="d-inline-block">
                                    <h3 class="text-white"><?php echo e(today_working_hrs(emp_user_id())); ?>  Hrs:Min </h3>
                                    <h5><p class="text-white mb-5"><?php echo e(date('d / M / Y')); ?></p></h5>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>

                                <div class="card gradient-1">
                                    <div class="card-header">News</div>
                                    <div class="card-body">
                                        <marquee  direction = "up" scrollamount="2" onmouseover="stop()" onmouseout="start()"><?php echo e(site_setting()->news); ?></marquee>
                                    </div>
                                    
                                </div>
                    </div>
                    <div class="col-lg-8 col-sm-6">
                        <div class="card">
                            <!-- <div class="card-body"> -->
                               <!--  <h3 class="card-title text-white">Net Profit</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">$ 8541</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                <div id="calendar"></div>
                            <!-- </div> -->

                        </div>
                    </div>
                    <!-- <p>News</p>
                     <div class="col-lg-12 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-white">Net Profit</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">$ 8541</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>

                        </div>
                    </div> -->
                </div>



                
        </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

<?php echo $__env->make('common.employee.inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function(e){
        calendar = new CalendarYvv("#calendar", moment().format("Y-M-D"), "Monday");
        calendar.funcPer = function(ev){
            console.log(ev)
        };
        $.ajax({
            url: emp_base_url+"/dashboard_calander",
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

    


</script><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/employee/dashboard.blade.php ENDPATH**/ ?>