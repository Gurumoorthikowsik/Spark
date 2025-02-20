<!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p><?php echo e(site_setting()->copyright); ?></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->



    <script src="<?php echo e(URL::to('/')); ?>/public/employee/plugins/common/common.min.js"></script>


    <script src="<?php echo e(URL::to('/')); ?>/public/employee/js/custom.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/js/settings.js"></script>


    <script src="<?php echo e(URL::to('/')); ?>/public/employee/js/gleek.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/js/styleSwitcher.js"></script>


    <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/assets/calander/employee_calendar.js"></script>


    <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/jquery.validate.min.js"></script>

        
    <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/notify.min.js"></script>


    <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/jquery.validate.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/plugins/chart.js/Chart.bundle.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/plugins/pg-calendar/js/pignose.calendar.min.js"></script>


    <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/plugins/tables/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/public/employee/js/bootstrap-datetimepicker.min.js"></script>

        
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#preloader').fadeOut(800);
        });
    </script>
        <script type="text/javascript">
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            var emp_base_url = "<?php echo URL::to('/employees/'); ?>";
        </script>

       
        <?php if($js_file != ''){ ?>
        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js_files/<?php echo ($js_file) ? $js_file : '' ?>.js?<?php echo time(); ?>"></script>
    <?php } ?>

    <?php if($errors->any()): ?>
      <script type="text/javascript">
          var error = "<?php echo $errors->all()[0]; ?>";
          $(document).ready(function(){
           $.notify(error, {className: 'error',clickToHide: true});
           });
      </script>
    <?php endif; ?>


    <?php if(Session::get('success')): ?>
      <script type="text/javascript">
          var success = "<?php echo Session::get('success'); ?>";
          $(document).ready(function(){
           $.notify(success, {className: 'success',clickToHide: true});
           });
      </script>
    <?php endif; ?>

  <?php if(Session::get('error')): ?>
      <script type="text/javascript">
          var error = "<?php echo Session::get('error'); ?>";
          $(document).ready(function(){
           $.notify(error, {className: 'error',clickToHide: true});
           });
      </script>
    <?php endif; ?>

    <script type="text/javascript">
	 $('.employee_notification').click(function(){
        var id = $(this).attr("data-id");
        var data_link = $(this).attr("data-link");
        $.ajax({
                url: emp_base_url+"/update_notify",
                type: "POST",
                data: {notification_id : id,link : data_link},
                success: function (data) {                    
                  var res = JSON.parse(data);
                    if(res.status == 1){
                        if(res.msg != ''){
                             window.location.href = res.msg;
                        }else{
                            location.reload();
                        }
                    }else{
                      $.notify(res.msg, {className: 'error',clickToHide: true,});
                        
                    }
                   
                
                }
            });
    })
</script>
</body><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/common/employee/inner_footer.blade.php ENDPATH**/ ?>