@php 
  $getnotification =  DB::table('notification')->where('user_id',Session::get('empuser_id'))->where('status',1)->where('type',0)->limit(100)->orderBy('id','desc');  
@endphp 
    
@php 

$profile = DB::table('user_info')->where('userid',Session::get('empuser_id'))->select('profile_photo')->first();

@endphp
    

<style>
    img.img-responsive {
    margin-top: -21px;
}

.nav-header {
    background-image: linear-gradient(55deg, var(--cretech-secondary, #9c2ede) 0%, var(--cretech-primary, #6a2dec) 100%);
}

</style>
    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{URL::to('employees/dashboard')}}">
                    <img src="https://res.cloudinary.com/dyeyiicvo/image/upload/v1739199895/x0kivv9w3kzphmdsjwkf.png"alt="" class="img-responsive">
                    <span class="logo-compact"><img src="https://res.cloudinary.com/dyeyiicvo/image/upload/v1739199706/mg3bwvmprxnz4qt7ne3r.png" alt=""></span>
                    <span class="brand-title">
                        {{-- <img src="{{site_setting()->site_logo}}" alt="" height="40"> --}}
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>

                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                    
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">{{$getnotification->count()}}</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication" style="height:300px;width:318px;overflow-y: scroll;">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">{{$getnotification->count()}}</span>
                                    </a>
                                </div>

                                @if($getnotification->count() != 0)
                                @foreach ($getnotification->get() as $key => $value)
                                <div class="dropdown-content-body">
                                
                                    <ul>
                                        <li>
                                            <a href="#" class="employee_notification" data-link="{{$value->link}}"  data-id="{{$value->id}}" >
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading" value="{{$value->id}}">{{ $value->title }}</h6>
                                                    <span class="notification-text">{{ $value->message }}</span> 
                                                </div>
                                            </a>
                                        </li>
                                
                                    </ul>
                                    
                                </div>
                                @endforeach 
                                @else
                                <div class="dropdown-content-body">
                                
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                
                                                <div class="notification-content">
                                                    <h5 class="notification-heading"><b>Record Not Found !!</b></h5>
                                                    <span class="notification-text"></span> 
                                                </div>
                                            </a>
                                        </li>
                                
                                    </ul>
                                    
                                </div>
                                @endif
                            </div>
                        </li>

                        <li class="icons dropdown">
                  

                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>


                                <?php if ($profile->profile_photo == 'user_icon.png') { ?>
                                    <img src="{{ URL::to('/public/employee/images/user/1.png') }}" height="40" width="40" alt="">
                                    <?php } else { ?>
                                    <img src="<?= htmlspecialchars($profile->profile_photo) ?>" height="40" width="40" alt="">
                                <?php } ?>
                                
                            </div>

                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                <h6 class="dropdown-header" style="color:black;"><b>{{get_user(emp_user_id(),'username')}}!</b></h6>
                                    <ul>                                                                         
                                          
                                        <li>
                                            <a href="{{URL::to('/employees/profile')}}"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                           
                                        
                                        <hr class="my-2">
                                        <li><a href="{{URL::to('/employees/logout')}}"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <!-- <li class="nav-label">Dashboard</li> -->

                    <li>
                        <a href="{{URL::to('/employees/dashboard')}}" aria-expanded="true">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>


                    
                    <li>
                        <a href="{{URL::to('/employees/working_report')}}" aria-expanded="true">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Working Report</span>
                        </a>
                    </li>

                    

                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Attendance</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/employees/attendance')}}">Entry Attendance</a></li>
                            <li><a href="{{URL::to('/employees/daily_working_hrs')}}">Daily Working Hours</a></li>
                            <!-- <li><a href="{{URL::to('/employees/attendance_time_extended')}}">Attendance Time Extend</a></li>                             -->
                        </ul>
                    </li>


    

                   
                


                    {{-- <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Permission</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/employees/permission')}}">Permission Management</a></li>
                        </ul>
                    </li> --}}



                    {{-- <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Leave</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/employees/leave_management')}}">Leave Management</a></li>
                        </ul>
                    </li> --}}


                    {{-- <li>
                        <a href="{{URL::to('/employees/employee_proof')}}" aria-expanded="true">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Documents</span>
                        </a>
                    </li> --}}

                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-desktop"></i><span class="nav-text">Task Management</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('taskassign') }}">Live Project</a></li>

                            <li><a href="{{ URL::to('myprojects') }}">Create Template</a></li>


                           <li> <a href="{{URL::to('viewall-template')}}" aria-expanded="true">
                            All Templates
                            </a>
                        </li>

                        @if (Dev_access(Session::get('empuser_id')) == 3)
                        <li><a href="{{ URL::to('Bugsmake') }}">Create Bug</a></li>
                        @endif
                    
                        </ul>
                    </li>
                    

                    
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Certificate Management</span>
                        </a>
                    
                    </li>
   
                    
                    {{-- <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Job Opening Post</span>
                        </a>
                    
                    </li> --}}



            
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->



