 <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Brave Spark Info Tech.
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
        var inv_url = "<?php echo URL::to('/inventory/'); ?>";
    </script>

    <!-- JAVASCRIPT -->

    <script src="{{ URL::to('/') }}/public/assets/js/jquery.min.js"></script>

    
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>

        <script src="{{ URL::to('/') }}/public/assets/calander/calendar.js?{{ time() }}"></script>

        <script src="{{ URL::to('/') }}/public/calander/calendar.js"></script>




        <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <!-- prismjs plugin -->
        <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
        <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>
        <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/crypto-transactions.init.js')}}"></script>
        <!-- listjs init -->
        <script src="{{ asset('assets/js/pages/listjs.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        
        
        <!-- <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>



        



        
<!-- new  -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          
      {
             extend: 'copyHtml5',
             text: 'Copy',
             className: 'btn btn-default',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
         extend: 'excel',
         text: 'Excel',
         className: 'btn btn-default',
         exportOptions: {
            columns: 'th:not(:last-child)'
         }
      },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'PDF',
            //     className: 'btn btn-default',
            //     exportOptions: {
            //         columns: 'th:not(:last-child)'
            //     }
            // },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
     

     
        ]
    } );
} );
    </script>
   
  
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
        <script src="{{ URL::to('/') }}/public/assets/js_files/<?php echo ($js_file) ? $js_file : '' ?>.js?<?php echo time(); ?>"></script>
    <?php } ?>


    <script src="{{ URL::to('/') }}/public/assets/js/notify.min.js"></script>


    @if ($errors->any())
      <script type="text/javascript">
          var error = "<?php echo $errors->all()[0]; ?>";
          $(document).ready(function(){
           $.notify(error, {className: 'error',clickToHide: true});
           });
      </script>
    @endif


    @if (Session::get('success'))
      <script type="text/javascript">
          var success = "<?php echo Session::get('success'); ?>";
          $(document).ready(function(){
           $.notify(success, {className: 'success',clickToHide: true});
           });
      </script>
    @endif

  @if (Session::get('error'))
      <script type="text/javascript">
          var error = "<?php echo Session::get('error'); ?>";
          $(document).ready(function(){
           $.notify(error, {className: 'error',clickToHide: true});
           });
      </script>
    @endif


</body>


</html>