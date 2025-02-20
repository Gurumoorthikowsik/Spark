@php
$page = ($title) ? $title : '';
$user = DB::table('user_info')->select('userid','main_access')->where('userid',user_id())->first();
@endphp

<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{URL::to('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{site_setting()->site_logo}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{site_setting()->site_logo}}" alt="" height="50"> --}}
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{URL::to('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{site_setting()->site_logo}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{site_setting()->site_logo}}" alt="" height="50"> --}}
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                         <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Dashboard') ? 'active' : ''}}" href="{{URL::to('/dashboard')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>

                        @if(page_access(user_id(),'edit_Add_Staff') == 1 || page_access(user_id(),'view_Staff_Details') == 1 || page_access(user_id(),'view_Staff_Documents') == 1 || page_access(user_id(),'view_Staff_Inventory_List') == 1)
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Add Staff' || $title == 'View All Staff' || $title == 'Edit Staff' || $title == 'Staff Inventory List') ? 'active' : ''}}" href="#sidebarStaff" data-bs-toggle="collapse" role="button" 
                                aria-expanded="false" aria-controls="sidebarStaff">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Student Details </span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarStaff">
                                <ul class="nav nav-sm flex-column">
                                    @if(page_access(user_id(),'edit_Add_Staff') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('addstaff')}}" class="nav-link" data-key="t-add_staff"> Add Student</a>
                                    </li>
                                    @endif
                                    @if(page_access(user_id(),'view_Staff_Details') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('viewstaff')}}" class="nav-link" data-key="t-add_staff"> Student Details</a>
                                    </li>
                                    @endif
                                    @if(page_access(user_id(),'view_Staff_Documents') == 1)
                                    {{-- <li class="nav-item">
                                        <a href="{{URL::to('staff_documents')}}" class="nav-link" data-key="t-add_staff"> Student Documents</a>
                                    </li> --}}
                                    @endif
                                    @if(page_access(user_id(),'view_Staff_Inventory_List') == 1)
                                     {{-- <li class="nav-item">
                                        <a href="{{URL::to('staff_inventory')}}" class="nav-link" data-key="t-add_staff"> Student Inventory List</a>
                                    </li> --}}
                                    @endif
                                </ul>
                            </div>
                        </li>

                        @endif

                        @if(page_access(user_id(),'view_Privileges') == 1)
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'privileges') ? 'active' : ''}}" href="{{URL::to('/privileges')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">privileges</span>
                            </a>
                        </li> --}}
                         @endif
                <!--      
                         <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'working_report') ? 'active' : ''}}" href="{{URL::to('/working_report')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Working Report</span>
                            </a>
                        </li> -->

                        @if(page_access(user_id(),'view_Working_Report') == 1 || page_access(user_id(),'view_staff_working_Report') == 1)
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Report' || $title == 'Staff Report') ? 'active' : ''}}" href="#workingReport" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="workingReport">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Working Report </span>
                            </a>
                            <div class="collapse menu-dropdown" id="workingReport">
                                <ul class="nav nav-sm flex-column">
                                    @if(page_access(user_id(),'view_Working_Report') == 1)
                                    {{-- <li class="nav-item">
                                        <a href="{{URL::to('/working_report')}}" class="nav-link" data-key="t-report">Working Report </a>
                                    </li> --}}
                                    @endif
                                    @if(page_access(user_id(),'view_staff_working_Report') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('/staff_working_report')}}/all" class="nav-link" data-key="t-staff_report">Student Working Report </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @endif


                        @if(page_access(user_id(),'view_Attendance') == 1  || page_access(user_id(),'view_Add_leave_days') == 1 || page_access(user_id(),'edit_Add_leave_days') == 1 || page_access(user_id(),'view_Office_Working_Days') == 1  || page_access(user_id(),'edit_Office_Working_Days') == 1  || page_access(user_id(),'view_Staff_Attendance_Event') == 1 || page_access(user_id(),'edit_Staff_Attendance_Event') == 1 || page_access(user_id(),'view_Staff_Attendance_Report') == 1 || page_access(user_id(),'view_Attendance_Time_Extend_Request') == 1 || page_access(user_id(),'edit_Attendance_Time_Extend_Request') == 1 || page_access(user_id(),'view_Calculate_MonthlyWorkingreport') == 1)
                        <li class="nav-item">
                        <a class="nav-link menu-link {{ ($title == 'Total Attendance' || $title == 'View All Working Attendance' || $title == 'Working Hours Calendar' || $title == 'View All Working Attendance' || $title == 'Entry Attendance' || $title == 'Add Leave Days'|| $title == 'Office Working Days') ? 'active' : ''}}" href="#sideAttendance" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sideAttendance">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Attendance </span>
                            </a>
                            <div class="collapse menu-dropdown" id="sideAttendance">
                                <ul class="nav nav-sm flex-column">

                                    @if(page_access(user_id(),'view_Add_leave_days') == 1 )
                                     <li class="nav-item">
                                        <a href="{{URL::to('add_leave_days')}}" class="nav-link" data-key="t-add_staff">Add Leave Days</a>
                                    </li>
                                    @endif

                                    <!-- @if(page_access(user_id(),'view_Office_Working_Days') == 1 )
                                    <li class="nav-item">
                                        <a href="/office_working_days" class="nav-link" data-key="t-add_staff">Office Working Days </a>
                                    </li>
                                    @endif -->
                                    
                                    @if(page_access(user_id(),'view_Attendance') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('attendance')}}" class="nav-link" data-key="t-add_staff">Attendance </a>
                                    </li>
                                    @endif

                                    @if(page_access(user_id(),'view_Staff_Attendance_Event') == 1)

                                    <li class="nav-item">
                                        <a href="{{URL::to('allattendance/all')}}" class="nav-link" data-key="t-add_staff">Staff Attendance Event</a>
                                    </li>
                                    @endif
                                    @if(page_access(user_id(),'view_Staff_Attendance_Report') == 1)
                                    {{-- <li class="nav-item">
                                        <a href="{{URL::to('staff_attendance_report')}}" class="nav-link" data-key="t-add_staff">Staff All Attendance Event Report </a>
                                    </li> --}}
                                    @endif                                    
                                    @if(page_access(user_id(),'view_Calculate_MonthlyWorkingreport') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('calculate_monthly_report')}}" class="nav-link" data-key="t-add_staff">Calculate Monthly Working Report </a>
                                    </li>
                                    @endif
                                    <!-- @if(page_access(user_id(),'view_Attendance_Time_Extend_Request') == 1)
                                    <li class="nav-item">
                                        <a href="/attendance_time_extended_request" class="nav-link" data-key="t-add_staff">Attendance Time Extend </a>
                                    </li>
                                    @endif -->

                                   <!--  <li class="nav-item">
                                        <a href="/daily_working_hrs" class="nav-link" data-key="t-add_staff">Staff Daily Working Hours</a>
                                    </li> -->


                                    
                                </ul>
                            </div>      
                        </li>
                        @endif

                     
                     @if(page_access(user_id(),'edit_Permission_Request') == 1 || page_access(user_id(),'view_Permission_Request') == 1 || page_access(user_id(),'view_Staff_View_Permission_Hrs') == 1)
                     {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Permission' || $title == 'Permission') ? 'active' : ''}}" href="#permission" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="permission">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Permission </span>
                            </a>
                            <div class="collapse menu-dropdown" id="permission">
                                <ul class="nav nav-sm flex-column">
                                    @if(page_access(user_id(),'view_Staff_View_Permission_Hrs') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('/staff_view_permission')}}" class="nav-link" data-key="t-report">Staff View Permission Hrs</a>
                                    </li>
                                    @endif
                                    @if(page_access(user_id(),'view_Permission_Request') == 1)
                                     <li class="nav-item">
                                        <a href="{{URL::to('/permission_request')}}" class="nav-link" data-key="t-report">Permission Request</a>
                                    </li>

                                    @endif
                                   <!--  @if(page_access(user_id(),'view_staff_working_Report') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('/staff_working_report')}}/all" class="nav-link" data-key="t-staff_report">Staff Working Report </a>
                                    </li>
                                    @endif -->


                                </ul>
                            </div>
                        </li> --}}
                        @endif

                        @if(page_access(user_id(),'view_Staff_View_Leave') == 1 || page_access(user_id(),'view_Leave_Request') == 1 || page_access(user_id(),'edit_Leave_Request') == 1)
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Leave Management' || $title == 'Leave Management') ? 'active' : ''}}" href="#leave" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="leave">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Leave Management </span>
                            </a>
                            <div class="collapse menu-dropdown" id="leave">
                                <ul class="nav nav-sm flex-column">
                                @if(page_access(user_id(),'view_Staff_View_Leave') == 1)
                                    <li class="nav-item">
                                        <a href="{{URL::to('/staff_view_leave')}}" class="nav-link" data-key="t-report">Staff View Leave</a>
                                    </li>
                                @endif
                                @if(page_access(user_id(),'view_Leave_Request') == 1)
                                     <li class="nav-item">
                                        <a href="{{URL::to('/leave_request')}}" class="nav-link" data-key="t-report">Leave Request</a>
                                    </li>
                                @endif
                                </ul>
                            </div>
                        </li> --}}
                        @endif




                        @if(page_access(user_id(),'view_Staff_View_Leave') == 1 || page_access(user_id(),'view_Leave_Request') == 1 || page_access(user_id(),'edit_Leave_Request') == 1)
          
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ ($title == 'Project Management') ? 'active' : '' }}" 
                               href="#project-management" 
                               data-bs-toggle="collapse" 
                               role="button"
                               aria-expanded="false" 
                               aria-controls="project-management">
                                <i class="ri-apps-2-line"></i> 
                                <span data-key="t-staff">Project Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="project-management">
                                <ul class="nav nav-sm flex-column">
                                    @if(page_access(user_id(), 'view_Staff_View_Leave') == 1)
                                    <li class="nav-item">
                                        <a href="{{ URL::to('create-project') }}" class="nav-link" data-key="t-report">Add Poject name</a>
                                    </li>
                                    @endif
                                    @if(page_access(user_id(), 'view_Leave_Request') == 1)
                                    <li class="nav-item">
                                        <a href="{{ URL::to('view-project') }}" class="nav-link" data-key="t-report">Project Details</a>
                                    </li>
                                    @endif

                                    @if(page_access(user_id(), 'view_Leave_Request') == 1)
                                    <li class="nav-item">
                                        <a href="{{ URL::to('Admin-create-certificate') }}" class="nav-link" data-key="t-report">Add Certificate</a>
                                    </li>
                                    @endif
                                    

                                    
                                    @if(page_access(user_id(), 'view_Leave_Request') == 1)
                                    <li class="nav-item">
                                        <a href="{{ URL::to('Admin-view-certificate') }}" class="nav-link" data-key="t-report">Certificate</a>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                        </li>

                        

                        @endif


 



                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
       
        <!-- Left Sidebar End -->