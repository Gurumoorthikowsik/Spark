<?php

ini_set('memory_limit', '-1');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController; 
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PrivilegesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\StaffdocumentController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\StaticController;


use App\Http\Controllers\Inventory\AuthController;
use App\Http\Controllers\Inventory\InventoryDashboardController;
use App\Http\Controllers\Inventory\LaptopInventoryController;
use App\Http\Controllers\Inventory\ChargerInventoryController;
use App\Http\Controllers\Inventory\MouseInventoryController; 
use App\Http\Controllers\Inventory\KeyboardInventoryController;


use App\Http\Controllers\Employee\EmployeeLoginController; 
use App\Http\Controllers\Employee\EmployeeDashboardController; 
use App\Http\Controllers\Employee\EmployeeReportController;
use App\Http\Controllers\Employee\EmployeeAttendanceController; 
use App\Http\Controllers\Employee\EmployeeProfileController;
use App\Http\Controllers\Employee\EmployeePermissionController;
use App\Http\Controllers\Employee\EmployeeLeaveController;


use App\Http\Controllers\ExcelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/clear-cache', function() {

    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('view:clear');
    return 'DONE DONE'; //Return anything
});


Route::get('/test', [HomeController::class, 'test']);

Route::get('/daily_attendance', [CronController::class, 'daily_attendance']);
Route::get('/calculate_month_working', [CronController::class, 'calculate_month_working']);
Route::get('/calculate_monthly_report_view/{id}', [CronController::class, 'calculate_monthly_report_view']);

Route::get('/hrerror', [LoginController::class, 'hrerror'])->name('hrerror');

Route::group(['middleware' => ['checkauth','web','throttle:1000,1']], function () {


   Route::get('/', [StaticController::class, 'StaticWebsite']);

    Route::get('/about-us', [StaticController::class, 'about']);

    Route::get('/contact', [StaticController::class, 'contact']);

    Route::get('/cybersecurity', [StaticController::class, 'cybersecurity']);

    Route::get('/web-development', [StaticController::class, 'webdevelopment']);

    Route::get('/software-development', [StaticController::class, 'softwaredevelopment']);

    Route::get('/mobile-app-development', [StaticController::class, 'mobileappdevelopment']);

    Route::get('/digital-marketing', [StaticController::class, 'digitalmarketing']);


    Route::get('/training-course', [StaticController::class, 'coursePage']);

    Route::get('/BraveSparkLogin', [LoginController::class, 'index']);

    
    Route::get('/sendmailfun', [LoginController::class, 'sendmailfun']);

    Route::get('/click_fullscreen', [LoginController::class, 'click_fullscreen']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/dashboard_calander', [DashboardController::class, 'dashboard_calander']);
    Route::match(['get', 'post'],'/addstaff', [StaffController::class, 'index']);
    Route::get('/viewstaff', [StaffController::class, 'viewstaff'])->name('view_staff');
    Route::get('/staff_status/{id}', [StaffController::class, 'staff_status']);
    Route::get('/delete_staff/{id}', [StaffController::class, 'delete_staff']);
    Route::post('/get_add_staff_inventory/{id}', [StaffController::class, 'get_add_staff_inventory']);
    Route::match(['get', 'post'],'/edit_staff/{id}', [StaffController::class, 'edit_staff']);
    Route::post('/edit_insert_staff', [StaffController::class, 'edit_insert_staff']);
    Route::get('/staff_documents', [StaffdocumentController::class, 'staff_documents'])->name('staff_documents');
    Route::get('/staff_document_view/{id}', [StaffdocumentController::class, 'staff_document_view']);
    Route::get('/approve_document/{id}/{id1}', [StaffdocumentController::class, 'approve_document']);
    Route::post('rejected_document',[StaffdocumentController::class,'rejected_document'])->name('rejected_document');

    Route::get('/get_brand_names/{id}', [StaffController::class, 'get_brand_names']);    
    Route::match(['get', 'post'],'/add_inventory/{id}', [StaffController::class, 'add_inventory']);  
    Route::match(['get', 'post'],'/addinventory_insert', [StaffController::class, 'addinventory_insert'])->name('addinventory_insert');
    
    Route::get('/addinventory_status/{id}', [StaffController::class, 'addinventory_status']);
    
    
    // Route::get('/staff_inventory', [StaffController::class, 'staff_inventory']);
    Route::post('/addinventory', [StaffController::class, 'addinventory']);
    Route::get('/delete_staff_inventory/{id}', [StaffController::class, 'delete_staff_inventory']);
    Route::get('/staff_inventory', [StaffController::class, 'staff_inventory']);
    Route::match(['get', 'post'],'/staff_proof/{id}', [StaffController::class, 'staff_proof']);
    Route::get('/delete_user_proof/{id}', [StaffController::class, 'delete_user_proof']);
    Route::get('/delete_addinventory/{id}', [StaffController::class, 'delete_addinventory']); 



    Route::match(['get', 'post'],'/profile', [ProfileController::class, 'index']);
    Route::match(['get', 'post'],'/site_setting', [SettingController::class, 'index']); 


    
    // Attendance controller
    Route::get('/allattendance/{id}', [AttendanceController::class, 'index']);  
    Route::get('/view_all_allattendance/{id}', [AttendanceController::class, 'view_all_allattendance']);
    Route::get('/working_calendar/{id}', [AttendanceController::class, 'working_calendar']);
    Route::match(['get', 'post'],'/attendance', [AttendanceController::class, 'attendance']);
    Route::get('/daily_working_hrs/{id}', [AttendanceController::class, 'daily_working_hrs']);
    Route::match(['get', 'post'],'/add_leave_days', [AttendanceController::class, 'add_leave_days']);
    Route::get('/delete_leave_day/{id}', [AttendanceController::class, 'delete_leave_day']);
    Route::match(['get', 'post'],'/office_working_days', [AttendanceController::class, 'office_working_days']);
    Route::match(['get', 'post'],'/office_working_report', [AttendanceController::class, 'office_working_report']);
    Route::get('/delete_office_working_day/{id}', [AttendanceController::class, 'delete_office_working_day']);
    Route::get('/staff_attendance_report', [AttendanceController::class, 'staff_attendance_report']);  
    Route::get('/calculate_monthly_report', [AttendanceController::class, 'calculate_monthly_report']);  
    Route::match(['get', 'post'],'/staffattendance_report', [AttendanceController::class, 'staffattendance_report']);
    Route::match(['get', 'post'],'/attendance_time_extended_request', [AttendanceController::class, 'attendance_time_extended_request']);

    Route::match(['get', 'post'],'/cal_month_rep_view/{id}', [AttendanceController::class, 'cal_month_rep_view']);
    

    // Report controller
    Route::match(['get', 'post'],'/working_report', [ReportController::class, 'index']);
    Route::post('/get_edit_report/{id}', [ReportController::class, 'get_edit_report']);  
    Route::post('/edit_working_report', [ReportController::class, 'edit_working_report']);
    Route::get('/staff_working_report/{id}', [ReportController::class, 'staff_working_report']);
    Route::get('/view_staff_working/{id}', [ReportController::class, 'view_staff_working']);

    Route::get('download/{file}', [ReportController::class, 'downloadFile'])->name('downloadFile');

    Route::get('view-src/{id}', [ReportController::class, 'viewsrc']);

    Route::post('/srcupdate', [ReportController::class, 'srcupdate']);  

    


    // privileges
    Route::get('/privileges', [PrivilegesController::class, 'index']);
    Route::get('/edit_privileges/{id}', [PrivilegesController::class, 'edit_privileges']);
    Route::post('/edit_access', [PrivilegesController::class, 'edit_access']);
    
    // Permission
    Route::get('/staff_view_permission', [PermissionController::class, 'index']);
    Route::match(['get', 'post'],'/permission_request', [PermissionController::class, 'permission_request']);
    
    // Leave
    Route::get('/staff_view_leave', [LeaveController::class, 'index']);
    Route::match(['get', 'post'],'/leave_request', [LeaveController::class, 'leave_request']);
    
    Route::post('/update_notify', [EmployeeReportController::class, 'update_notify']);    
    Route::post('/permission_notify', [EmployeePermissionController::class, 'permission_notify']);
    Route::post('/leave_notify', [LeaveController::class, 'leave_notify']);
    Route::get('/read_notify', [LeaveController::class, 'read_notify']);


    Route::get('create-project', [LeaveController::class, 'projectadd']);
    Route::get('getStudentsByRole', [LeaveController::class, 'getStudentsByRole'])->name('getStudentsByRole');
    Route::post('addproject', [LeaveController::class, 'addproject']);    

    Route::get('view-project', [LeaveController::class, 'view_project']);
    Route::get('update-task-status', [LeaveController::class, 'view_project']);

    Route::get('Admin-view-certificate', [LeaveController::class, 'view_Certificate_table']);
    Route::get('Admin-create-certificate', [LeaveController::class, 'create_certificate']);

    Route::post('addcertificate', [LeaveController::class, 'addcertificate']);    

    


    Route::post('update-task-status', [EmployeePermissionController::class, 'updateStatus']);    
    Route::post('update-task-status', [EmployeePermissionController::class, 'updateStatus']);    

  });


    Route::group(['middleware' => ['inventoryauth','web','throttle:1000,1']], function () { 

         Route::get('/inventory', [AuthController::class, 'index']);         
         Route::post('inventory/login', [AuthController::class, 'login']);
         Route::get('inventory/logout', [AuthController::class, 'logout']);

         // inventory dashboard
         Route::post('/get_dashboard_names/{id}', [InventoryDashboardController::class, 'get_dashboard_names']);
        Route::get('/delete_product/{id}', [InventoryDashboardController::class, 'delete_product']);
        Route::get('/status/{id}', [InventoryDashboardController::class, 'status']);
        Route::post('product_insert', [InventoryDashboardController::class,'product_insert'])->name('product_insert');
        Route::get('inventory/dashboard', [InventoryDashboardController::class, 'index']);
        Route::get('/add_product', [InventoryDashboardController::class, 'add_product']);
        Route::get('/add_brand_access', [InventoryDashboardController::class, 'add_brand_access']);
        Route::get('inventory/staff_inventory', [InventoryDashboardController::class, 'staff_inventory']);
        Route::get('inventory/delete_staff_inventory/{id}', [InventoryDashboardController::class, 'delete_staff_inventory']);
        Route::post('inventory/viewbrands', [InventoryDashboardController::class, 'viewbrands']);

        // new
        Route::get('/add_productlist', [InventoryDashboardController::class, 'add_productlist']);
        Route::post('/productlist_insert', [InventoryDashboardController::class,'productlist_insert']);

        //View Product List
        Route::get('inventory/view_productlist', [InventoryDashboardController::class, 'view_productlist']);
        Route::get('inventory/view_productlist/get_edit_viewallproduct/{id}/{user_id}', [InventoryDashboardController::class, 'get_edit_viewallproduct']);
        Route::get('inventory/productlist_status/{id}/{user_id}', [InventoryDashboardController::class, 'productlist_status']);
        Route::post('inventory/delete_productlist/{id}/{userid}', [InventoryDashboardController::class, 'delete_productlist']); 
        Route::post('/updateproductlist_inventory', [InventoryDashboardController::class, 'updateproductlist_inventory']);


         //Add Brand & Accessories
        Route::get('/add_brand', [InventoryDashboardController::class, 'add_brand']);
        Route::post('/edit_add_brand', [InventoryDashboardController::class, 'edit_add_brand']); 
        Route::post('/edit_add_access', [InventoryDashboardController::class, 'edit_add_access']); 
        Route::get('/add_accessories', [InventoryDashboardController::class, 'add_accessories']);

         //Add Sim & Charger Type & Data cable
         Route::get('/add_sim', [InventoryDashboardController::class, 'add_sim']);
         Route::post('inventory/add_sim_submit', [InventoryDashboardController::class,'add_sim_submit'])->name('add_sim_submit');

         Route::get('/add_charger', [InventoryDashboardController::class, 'add_charger']);

         //Add,Edit,Delete Product 
         Route::post('inventory/add_product_submit', [InventoryDashboardController::class,'add_product_submit'])->name('add_product_submit');
         Route::post('inventory/add_access_submit', [InventoryDashboardController::class,'add_access_submit'])->name('add_access_submit');
         Route::get('/delete_add_brand/{id}', [InventoryDashboardController::class, 'delete_add_brand']);
         Route::get('/delete_add_access/{id}', [InventoryDashboardController::class, 'delete_add_access']);
         Route::post('inventory/edit_get_product/{id}', [InventoryDashboardController::class, 'edit_get_product']);  
         Route::post('inventory/edit_add_product', [InventoryDashboardController::class, 'edit_add_product']);          
        // user staff stock list
        Route::get('/staffstocklist', [InventoryDashboardController::class, 'staffstocklist']);




         //Return Stock   
        // Route::get('inventory/return_stock', [InventoryDashboardController::class, 'return_stock']);
        Route::get('inventory/return_stock_list', [InventoryDashboardController::class, 'return_stock_list']);
        Route::post('inventory/return_product_submit', [InventoryDashboardController::class,'return_product_submit'])->name('return_product_submit');
        Route::get('inventory/return_status/{id}', [InventoryDashboardController::class, 'return_status']);
        Route::get('inventory/delete_returnproduct/{id}', [InventoryDashboardController::class, 'delete_returnproduct']); 
        Route::get('inventory/edit_returnproduct/{id}', [InventoryDashboardController::class, 'edit_returnproduct']);   
        Route::post('inventory/update_returnproduct', [InventoryDashboardController::class, 'update_returnproduct']); 
                  
         //Add OS
         Route::get('/add_os', [InventoryDashboardController::class, 'add_os']);
         Route::post('inventory/add_os_submit', [InventoryDashboardController::class,'add_os_submit'])->name('add_os_submit');
         Route::get('/delete_os/{id}', [InventoryDashboardController::class, 'delete_os']);
         Route::post('/edit_add_os', [InventoryDashboardController::class, 'edit_add_os']); 
         Route::get('/os_status/{id}', [InventoryDashboardController::class, 'os_status']);

         //Add Mobile
         Route::get('/add_mobile', [InventoryDashboardController::class, 'add_mobile']);
         


        //Stock Count & Available 
        // Route::get('/stock_count_available', [InventoryDashboardController::class, 'stock_count_available']);
         
         //Laptop inventory
         Route::match(['get', 'post'],'inventory/laptop/{id?}', [LaptopInventoryController::class, 'laptop']);
         Route::get('inventory/lap_status/{id}', [LaptopInventoryController::class, 'lap_status']);
         Route::get('inventory/delete_laptop/{id}', [LaptopInventoryController::class, 'delete_laptop']); 
         Route::post('inventory/edit_get_laptop/{id}', [LaptopInventoryController::class, 'edit_get_laptop']);  
         Route::post('inventory/edit_laptop', [LaptopInventoryController::class, 'edit_laptop']); 


         // Charger Inventory
         Route::match(['get', 'post'],'inventory/charger/{id?}', [ChargerInventoryController::class, 'charger']);
         Route::get('inventory/charger_status/{id}', [ChargerInventoryController::class, 'charger_status']);
         Route::get('inventory/delete_charger/{id}', [ChargerInventoryController::class, 'delete_charger']); 
         Route::post('inventory/edit_get_charger/{id}', [ChargerInventoryController::class, 'edit_get_charger']);  
         Route::post('inventory/edit_charger', [ChargerInventoryController::class, 'edit_charger']); 


          // Mouse Inventory
         Route::match(['get', 'post'],'inventory/mouse/{id?}', [MouseInventoryController::class, 'mouse']);
         Route::get('inventory/mouse_status/{id}', [MouseInventoryController::class, 'mouse_status']);
         Route::get('inventory/delete_mouse/{id}', [MouseInventoryController::class, 'delete_mouse']); 
         Route::post('inventory/edit_get_mouse/{id}', [MouseInventoryController::class, 'edit_get_mouse']);  
         Route::post('inventory/edit_mouse', [MouseInventoryController::class, 'edit_mouse']);


          // Keyboard Inventory
         Route::match(['get', 'post'],'inventory/keyboard/{id?}', [KeyboardInventoryController::class, 'keyboard']);
         Route::get('inventory/keyboard_status/{id}', [KeyboardInventoryController::class, 'keyboard_status']);
         Route::get('inventory/delete_keyboard/{id}', [KeyboardInventoryController::class, 'delete_keyboard']); 
         Route::post('inventory/edit_get_keyboard/{id}', [KeyboardInventoryController::class, 'edit_get_keyboard']);  
         Route::post('inventory/edit_keyboard', [KeyboardInventoryController::class, 'edit_keyboard']);


    });





Route::group(['middleware' => ['employeeauth','undermaintenance','web','throttle:1000,1']], function () { 


    
     
     Route::get('students-login', [EmployeeLoginController::class, 'index']);
     Route::match(['get', 'post'],'employees/login', [EmployeeLoginController::class, 'login']);
     Route::get('employees/logout', [EmployeeLoginController::class, 'logout']);

     // dashboard
    Route::get('employees/dashboard', [EmployeeDashboardController::class, 'index']);
    Route::post('employees/dashboard_calander', [EmployeeDashboardController::class, 'dashboard_calander']);

    // Working Report

    Route::match(['get', 'post'],'employees/working_report', [EmployeeReportController::class, 'index']);
    Route::post('employees/get_edit_report/{id}', [EmployeeReportController::class, 'get_edit_report']);
    Route::post('employees/edit_working_report', [EmployeeReportController::class, 'edit_working_report']); 
    Route::get('employees/updateSrccode/{id}', [EmployeeReportController::class, 'updateSrccode']);

    
    // Attentance
    Route::match(['get', 'post'],'employees/attendance', [EmployeeAttendanceController::class, 'attendance']);  
    Route::get('employees/daily_working_hrs', [EmployeeAttendanceController::class, 'daily_working_hrs']);
    Route::get('employees/attendance_time_extended', [EmployeeAttendanceController::class, 'attendance_time_extended']);  
    Route::post('employees/attendance_time_extended_submit', [EmployeeAttendanceController::class, 'attendance_time_extended_submit']);
    Route::get('employees/delete_attendance_time_extended/{id}', [EmployeeAttendanceController::class, 'delete_attendance_time_extended']);

    //Profile
    Route::get('employees/profile', [EmployeeProfileController::class, 'index']);  
    Route::post('employees/ChangePassword',[EmployeeProfileController::class,'changePassword']);

    Route::match(['get', 'post'], '/employees/Studentprofileupdate', [EmployeeProfileController::class, 'Studentprofileupdate']);


    // permission
    Route::get('employees/permission', [EmployeePermissionController::class, 'index']);  
    Route::post('employees/permission_submit', [EmployeePermissionController::class, 'permission_submit']); 
    Route::get('employees/delete_permission/{id}', [EmployeePermissionController::class, 'delete_permission']); 



    //TASK Assign

    Route::get('taskassign', [EmployeePermissionController::class, 'task']);  
    Route::get('taskboard', [EmployeePermissionController::class, 'taskboard']);  

    Route::get('Bugsmake', [EmployeePermissionController::class, 'Bugsmake']);  
    Route::post('addbugs', [EmployeePermissionController::class, 'addbugs']);  

    Route::post('updateStatusboard', [EmployeePermissionController::class, 'updateStatusboard']);  


    Route::get('certificate-view', [EmployeePermissionController::class, 'certificate_view']);  

    Route::get('myprojects', [EmployeePermissionController::class, 'myprojects']);  

    Route::post('create-my-pro', [EmployeePermissionController::class, 'createmypro']);  

    Route::get('template', [EmployeePermissionController::class, 'viewSource']);  

    Route::get('viewall-template', [EmployeePermissionController::class, 'viewalltemplate']);  

    Route::get('template/{id}', [EmployeePermissionController::class, 'Templates']);

    //Leave    
    Route::get('employees/leave_management', [EmployeeLeaveController::class, 'index']);  
    Route::post('employees/leave_submit', [EmployeeLeaveController::class, 'leave_submit']);
    Route::get('employees/delete_leave/{id}', [EmployeeLeaveController::class, 'delete_leave']);  


    //Documents
    Route::match(['get', 'post'],'/employees/employee_proof', [EmployeeReportController::class, 'employee_proof']);
    // Route::get('employees/delete_proof/{id}', [EmployeeReportController::class, 'delete_proof']); 
    

    // Notification 
    Route::post('employees/update_notify', [EmployeeReportController::class, 'update_notify']);
    Route::post('employees/permission_notify', [EmployeePermissionController::class, 'permission_notify']);
    Route::post('employees/leave_notify', [EmployeeLeaveController::class, 'leave_notify']);

    


    

});
