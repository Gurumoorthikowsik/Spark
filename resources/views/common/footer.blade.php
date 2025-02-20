<!-- footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                {{-- <p class="mb-0 text-muted">&copy; {{site_setting()->copyright}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->


       
            


        <!-- JAVASCRIPT -->
        <script src="{{ URL::to('/') }}/public/assets/js/jquery.min.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/js/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ URL::to('/') }}/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/libs/node-waves/waves.min.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/libs/feather-icons/feather.min.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/js/plugins.js"></script>


        <script src="{{ URL::to('/') }}/public/assets/js/plugins.js"></script>
        <script src="{{ URL::to('/') }}/public/assets/js/notify.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>

        <!-- particles js -->
        <script src="{{ URL::to('/') }}/public/assets/libs/particles.js/particles.js"></script>

        
        <!-- particles app js -->
        <script src="{{ URL::to('/') }}/public/assets/js/pages/particles.app.js"></script>



        <script src="{{ URL::to('/') }}/public/assets/js/pages/password-addon.init.js"></script>

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


    </body>

</html>