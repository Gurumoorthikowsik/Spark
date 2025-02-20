<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Leavedays;
use App\Models\Leave;
use App\Models\Permission; 
use App\Models\UserDocument;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use Carbon\Carbon;
use App\Models\Attendance_time_extended;

class DashboardController extends Controller
{  

    public function __construct(){
       
    }
    
    public function index(Request $request ){
        $this_month = date("m");
        $this_year = date("Y");

        $previous_month = date('Y-m', strtotime("-1 month"));
        $startDate = new Carbon($previous_month.'-29');
        $endDate = new Carbon(date('Y-m-'.'31'));

        $data['roll'] = Roll::select('roll','sort_name')->where('status',1);

        

       
        $data['js_file'] = 'login';
        $data['title'] = 'Dashboard';
        return view('dashboard',$data);
    }


    function dashboard_calander(){

        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $limit = 31;
       $festival_leave = Leavedays::select('leave_date')->whereYear('leave_date', '=', $year)->whereMonth('leave_date', '=', $month)->get();
       $festival= [];      
       foreach ($festival_leave as $key => $value) {
            $festival[$key] = date('d',strtotime($value->leave_date));
       }

       // staff working hours start
       $user_id = user_id();
       
       $user_total_working = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'hours' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id' and MONTH(date) = '$month' and YEAR(date) = '$year' group by date ORDER BY date ASC LIMIT $day");

       $working_hrs = (get_user($user_id,'working_hrs') != '') ? get_user($user_id,'working_hrs') : '08:00';

           $completed_time = [];
           $tot_work_day = [];
           $low_working_day = [];
           $precent_day = [];
         
           foreach ($user_total_working as $key => $value) {
              $date = $value->date;
               $hours = ($date == date('Y-m-d')) ? today_working_hrs($user_id) : date('H:i',strtotime($value->hours));
            
                  if(date('m',strtotime($date)) == $month){
                   
                    $range = range(1, $day);
                    $get_date = date('d',strtotime($date));
                    $get_working_days = in_array($get_date, $range);

                                

                        if($get_working_days == 1){

                            $precent_day[] = date('d',strtotime($date));

                            if(strtotime($hours) >= strtotime($working_hrs)){

                                $completed_time[] =  date('d',strtotime($date));

                            }else{
                                $low_working_day[] =  date('d',strtotime($date));

                            }

                        }
                  }

           }
       // staff working hours end

        $range = range(1, $day);
        $remove_date = array_diff($range, $precent_day);
        $obcent = [];
        foreach ($remove_date as $key => $value) {
            // if($value != 07){
                $obcent[] = $value;
            // }
        }
   
        $leavedays = year_sunday();
        $total_festival = array_merge($leavedays,$festival);


      
        echo json_encode(['precent' =>  $completed_time,'low_working_day' => ($low_working_day) ? $low_working_day : [],'obsend' => ($obcent) ? $obcent : [] ,'leavedays' => $total_festival]);


    }




 }



?>