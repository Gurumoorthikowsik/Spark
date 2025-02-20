<script src="{{ URL::to('/') }}/public/employee/plugins/common/common.min.js"></script>
<script src="{{ URL::to('/') }}/public/employee/js/custom.min.js"></script>
<script src="{{ URL::to('/') }}/public/employee/js/settings.js"></script>
<script src="{{ URL::to('/') }}/public/employee/js/gleek.js"></script>
<script src="{{ URL::to('/') }}/public/employee/js/styleSwitcher.js"></script>

      <!-- JAVASCRIPT -->

<script src="{{ URL::to('/') }}/public/assets/js/jquery.min.js"></script>
<script src="{{ URL::to('/') }}/public/assets/js/jquery.validate.min.js"></script>
<script src="{{ URL::to('/') }}/public/assets/js/notify.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    


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

       
        <?php if(isset($js_file)){ ?>
        <script src="{{ URL::to('/') }}/public/assets/js_files/<?php echo ($js_file) ? $js_file : '' ?>.js?<?php echo time(); ?>"></script>
        <?php } ?>


    @if ($errors->any())
      <script type="text/javascript">
          var error = "<?php echo $errors->all()[0]; ?>";
          $(document).ready(function(){
           $.notify(error, {className: 'error',clickToHide: true});
           });
      </script>
    @endif

    <script type="text/javascript">

    </script>
    </body>

</html>