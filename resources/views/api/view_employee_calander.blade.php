<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Custom Stylesheet -->
    <link href="{{ asset('employee/css/style.css')}}?<?php echo time(); ?>" rel="stylesheet">
<!--     <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />-->
     <link href="{{ asset('employee/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/calander/css/calendar.css')}}?<?php echo time(); ?>" rel="stylesheet" type="text/css" />

    <link href="{{ asset('employee/css/bootstrap-datetimepicker.min.css')}}?<?php echo time(); ?>" rel="stylesheet">
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
</head>

<body>

             <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
             <div id="calendars"></div>
             
<!--         <div class="content-body">
            <div class="container-fluid mt-3">
                 <div class="flex-grow-1">
    
                </div>
                <div class="row">

                    <div class="col-lg-12 col-sm-12">

                    </div>
                    <div class="col-lg-12 col-sm-12">
                       

                        
                    </div>
                </div>
        </div>
        </div> -->

<!--**********************************
    Content body end
***********************************-->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/calander/employee_calendar.js')}}?<?php echo time(); ?>"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

</script>
<script src="{{ URL::to('/') }}/public/assets/js_files/<?php echo ($js_file) ? $js_file : '' ?>.js?<?php echo time(); ?>"></script>

<script>

    var mob_base_url = "<?php echo URL::to('/api/'); ?>";
    $(document).ready(function(e){
        var user_id = $("#user_id").val();
        calendar = new CalendarYvv("#calendars", moment().format("Y-M-D"), "Monday");
        calendar.funcPer = function(ev){
            console.log(ev)
        };
        $.ajax({
            url: mob_base_url+"/employee-dashboard-calander",
            type: "POST",
            data: {user_id : user_id},
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

    


</script>