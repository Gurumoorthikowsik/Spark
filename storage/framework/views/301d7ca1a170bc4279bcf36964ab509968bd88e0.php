<?php
$page = ($title) ? $title : '';
$user = DB::table('user_info')->select('userid','main_access')->where('userid',user_id())->first();
?>

<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?php echo e(URL::to('dashboard')); ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo e(site_setting()->site_logo); ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?php echo e(URL::to('dashboard')); ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo e(site_setting()->site_logo); ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        
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
                            <a class="nav-link menu-link <?php echo e(($title == 'Dashboard') ? 'active' : ''); ?>" href="<?php echo e(URL::to('/dashboard')); ?>">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>

                        <?php if(page_access(user_id(),'edit_Add_Staff') == 1 || page_access(user_id(),'view_Staff_Details') == 1 || page_access(user_id(),'view_Staff_Documents') == 1 || page_access(user_id(),'view_Staff_Inventory_List') == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(($title == 'Add Staff' || $title == 'View All Staff' || $title == 'Edit Staff' || $title == 'Staff Inventory List') ? 'active' : ''); ?>" href="#sidebarStaff" data-bs-toggle="collapse" role="button" 
                                aria-expanded="false" aria-controls="sidebarStaff">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Student Details </span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarStaff">
                                <ul class="nav nav-sm flex-column">
                                    <?php if(page_access(user_id(),'edit_Add_Staff') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('addstaff')); ?>" class="nav-link" data-key="t-add_staff"> Add Student</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(page_access(user_id(),'view_Staff_Details') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('viewstaff')); ?>" class="nav-link" data-key="t-add_staff"> Student Details</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(page_access(user_id(),'view_Staff_Documents') == 1): ?>
                                    
                                    <?php endif; ?>
                                    <?php if(page_access(user_id(),'view_Staff_Inventory_List') == 1): ?>
                                     
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>

                        <?php endif; ?>

                        <?php if(page_access(user_id(),'view_Privileges') == 1): ?>
                        
                         <?php endif; ?>
                <!--      
                         <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(($title == 'working_report') ? 'active' : ''); ?>" href="<?php echo e(URL::to('/working_report')); ?>">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Working Report</span>
                            </a>
                        </li> -->

                        <?php if(page_access(user_id(),'view_Working_Report') == 1 || page_access(user_id(),'view_staff_working_Report') == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(($title == 'Report' || $title == 'Staff Report') ? 'active' : ''); ?>" href="#workingReport" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="workingReport">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Working Report </span>
                            </a>
                            <div class="collapse menu-dropdown" id="workingReport">
                                <ul class="nav nav-sm flex-column">
                                    <?php if(page_access(user_id(),'view_Working_Report') == 1): ?>
                                    
                                    <?php endif; ?>
                                    <?php if(page_access(user_id(),'view_staff_working_Report') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('/staff_working_report')); ?>/all" class="nav-link" data-key="t-staff_report">Student Working Report </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                        <?php endif; ?>


                        <?php if(page_access(user_id(),'view_Attendance') == 1  || page_access(user_id(),'view_Add_leave_days') == 1 || page_access(user_id(),'edit_Add_leave_days') == 1 || page_access(user_id(),'view_Office_Working_Days') == 1  || page_access(user_id(),'edit_Office_Working_Days') == 1  || page_access(user_id(),'view_Staff_Attendance_Event') == 1 || page_access(user_id(),'edit_Staff_Attendance_Event') == 1 || page_access(user_id(),'view_Staff_Attendance_Report') == 1 || page_access(user_id(),'view_Attendance_Time_Extend_Request') == 1 || page_access(user_id(),'edit_Attendance_Time_Extend_Request') == 1 || page_access(user_id(),'view_Calculate_MonthlyWorkingreport') == 1): ?>
                        <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(($title == 'Total Attendance' || $title == 'View All Working Attendance' || $title == 'Working Hours Calendar' || $title == 'View All Working Attendance' || $title == 'Entry Attendance' || $title == 'Add Leave Days'|| $title == 'Office Working Days') ? 'active' : ''); ?>" href="#sideAttendance" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sideAttendance">
                                <i class="ri-apps-2-line"></i> <span data-key="t-staff"> Attendance </span>
                            </a>
                            <div class="collapse menu-dropdown" id="sideAttendance">
                                <ul class="nav nav-sm flex-column">

                                    <?php if(page_access(user_id(),'view_Add_leave_days') == 1 ): ?>
                                     <li class="nav-item">
                                        <a href="<?php echo e(URL::to('add_leave_days')); ?>" class="nav-link" data-key="t-add_staff">Add Leave Days</a>
                                    </li>
                                    <?php endif; ?>

                                    <!-- <?php if(page_access(user_id(),'view_Office_Working_Days') == 1 ): ?>
                                    <li class="nav-item">
                                        <a href="/office_working_days" class="nav-link" data-key="t-add_staff">Office Working Days </a>
                                    </li>
                                    <?php endif; ?> -->
                                    
                                    <?php if(page_access(user_id(),'view_Attendance') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('attendance')); ?>" class="nav-link" data-key="t-add_staff">Attendance </a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(page_access(user_id(),'view_Staff_Attendance_Event') == 1): ?>

                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('allattendance/all')); ?>" class="nav-link" data-key="t-add_staff">Staff Attendance Event</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(page_access(user_id(),'view_Staff_Attendance_Report') == 1): ?>
                                    
                                    <?php endif; ?>                                    
                                    <?php if(page_access(user_id(),'view_Calculate_MonthlyWorkingreport') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('calculate_monthly_report')); ?>" class="nav-link" data-key="t-add_staff">Calculate Monthly Working Report </a>
                                    </li>
                                    <?php endif; ?>
                                    <!-- <?php if(page_access(user_id(),'view_Attendance_Time_Extend_Request') == 1): ?>
                                    <li class="nav-item">
                                        <a href="/attendance_time_extended_request" class="nav-link" data-key="t-add_staff">Attendance Time Extend </a>
                                    </li>
                                    <?php endif; ?> -->

                                   <!--  <li class="nav-item">
                                        <a href="/daily_working_hrs" class="nav-link" data-key="t-add_staff">Staff Daily Working Hours</a>
                                    </li> -->


                                    
                                </ul>
                            </div>      
                        </li>
                        <?php endif; ?>

                     
                     <?php if(page_access(user_id(),'edit_Permission_Request') == 1 || page_access(user_id(),'view_Permission_Request') == 1 || page_access(user_id(),'view_Staff_View_Permission_Hrs') == 1): ?>
                     
                        <?php endif; ?>

                        <?php if(page_access(user_id(),'view_Staff_View_Leave') == 1 || page_access(user_id(),'view_Leave_Request') == 1 || page_access(user_id(),'edit_Leave_Request') == 1): ?>
                        
                        <?php endif; ?>




                        <?php if(page_access(user_id(),'view_Staff_View_Leave') == 1 || page_access(user_id(),'view_Leave_Request') == 1 || page_access(user_id(),'edit_Leave_Request') == 1): ?>
          
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(($title == 'Project Management') ? 'active' : ''); ?>" 
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
                                    <?php if(page_access(user_id(), 'view_Staff_View_Leave') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('create-project')); ?>" class="nav-link" data-key="t-report">Add Poject name</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(page_access(user_id(), 'view_Leave_Request') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('view-project')); ?>" class="nav-link" data-key="t-report">Project Details</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(page_access(user_id(), 'view_Leave_Request') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('Admin-create-certificate')); ?>" class="nav-link" data-key="t-report">Add Certificate</a>
                                    </li>
                                    <?php endif; ?>
                                    

                                    
                                    <?php if(page_access(user_id(), 'view_Leave_Request') == 1): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(URL::to('Admin-view-certificate')); ?>" class="nav-link" data-key="t-report">Certificate</a>
                                    </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </li>

                        

                        <?php endif; ?>


 



                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
       
        <!-- Left Sidebar End --><?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/common/sidebar.blade.php ENDPATH**/ ?>