 <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo e(site_setting()->copyright); ?>

                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by BraveSpark.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    
    <script type="text/javascript">
        var base_url = "<?php echo URL::to('/'); ?>";
    </script>






    <!-- JAVASCRIPT -->

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/calander/calendar.js?<?php echo e(time()); ?>"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/jquery.validate.min.js?<?php echo e(time()); ?>"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/simplebar/simplebar.min.js"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/node-waves/waves.min.js"></script>

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/feather-icons/feather.min.js"></script>
        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/plugins.js"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/prismjs/prism.js"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/list.js/list.min.js"></script>


        <script src="<?php echo e(URL::to('/')); ?>/public/assets/libs/list.pagination.js/list.pagination.min.js"></script>

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/pages/crypto-transactions.init.js"></script>

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/pages/listjs.init.js"></script>

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/app.js"></script>

        <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/notify.min.js"></script>

        
        
        <!-- <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>



    

<!-- new  -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>










<!-- <script>
$(window).on('load',function(){
	setTimeout(function(){ // allowing 3 secs to fade out loader
	$('.page-loader').fadeOut('slow');
	},3500);
});
    </script> -->

    
<script>
  setTimeout(function(){
	$('.loader-bg').fadeToggle();
    }, 1000);
</script>

<!-- end of new  -->






    <script type="text/javascript">
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
	 $('.admin_notification').click(function(){
        var id = $(this).attr("data-id");
        var data_link = $(this).attr("data-link");
        $.ajax({
                url: base_url+"/update_notify",
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
</body>


</html><?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/common/inner_footer.blade.php ENDPATH**/ ?>