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
                        <h4 class="mb-sm-0">Edit Privileges</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">privileges</a></li>
                                <li class="breadcrumb-item active">Edit Privileges</li>
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
                        

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview" style="margin-left:350px">

                    <form action="<?php echo URL::to('/'); ?>/edit_access" id="add-staff-form" class="add-staff-form" method="post" autocomplete="off">{{ csrf_field() }}
                        <table class="table" style="width:40%;">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Privileges</th>
                              <th scope="col">View</th>
                              <th scope="col">Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                             @php $i=1; @endphp @foreach ($access as $value)
                            <tr>
                              <th scope="row">{{$i}}</th>
                              <td>{{$value->privileges}}</td>
                              <input type="hidden" name="user_id" value="{{$user_id}}">
                              <td>
                                @if($value->view == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="view_{{$value->privileges}}" <?php echo (page_access($user_id,'view_'.$value->privileges) == 1) ? 'checked' : ''; ?> name="view[]" id="auth-remember-check">
                                </div>
                                @elseif($value->view == 0)
                                <div class="form-check"> --
                                </div> 
                                @endif  
                              </td>

                              <td>
                                @if($value->edit == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="edit_{{$value->privileges}}" <?php echo (page_access($user_id,'edit_'.$value->privileges) == 1) ? 'checked' : ''; ?> name="edit[]" id="auth-remember-check">
                                    @elseif($value->edit == 0)
                                <div class="form-check"> --
                                </div> 
                                @endif  
                                </div>   
                              </td>
                            </tr>
                             @php $i++; @endphp   
                             @endforeach
                          </tbody>
                        </table>

                         <?php if(get_user(user_id(),'main_access') == 1 || page_access(user_id(),'edit_Privileges') == 1){ ?>
                            @if(user_id() != $user_id && get_user($user_id,'main_access') != 1)
                         <button type="submit" name="add_staff_btn" id="add_staff_btn" class="btn btn-success w-20" style="margin-left: 210px;">Submit</button>
                            @endif
                            <?php } ?>
                    </form>

                    </div>
                </div>
            </div>
    </div></div>

<script type="text/javascript">
    var base_url = "<?php echo URL::to('/'); ?>";
</script>
@include('common.inner_footer')                                    

