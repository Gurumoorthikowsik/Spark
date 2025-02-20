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
use App\Models\Serializeattendance;
use App\Models\Monthworking;

class CronController extends Controller{  

    public function __construct(){
       
    }
    
    public function daily_attendance(Request $request ){
    	$today_date = date('Y-m-d');
    	$created_at = date('Y-m-d H:i:s');
    	


    		$get_users = User::where('status','!=',2)->get();

    		foreach ($get_users as $key => $value) {
    			
               $check_serialize_data = Serializeattendance::where('user_id',$value->userid)->whereDate('date', '=', date('Y-m-d'));;

                if($check_serialize_data->count() == 0){



                    $user_id = $value->userid;
                    $serialize = serialize(['other' => '']);
                    $date = $today_date;
                    $total_hours = '00:00:00';
                    $created_at = $created_at;

                        $insertData = [
                            'user_id' => $user_id,
                            'attendance' => $serialize,
                            'date' => $date,
                            'created_at' => $created_at
                        ];

                        Serializeattendance::insert($insertData);

                echo 'update';
                }else{
                    echo 'already update'.'<br>';
                }


                

    		}


    }


    function calculate_month_working(){

        

       // $get_users = User::where('userid',263)->where('status','!=',2)->get();
        $get_users = User::where('status','!=',2)->get();

        foreach ($get_users as $key => $value) {
            
            $user_id = $value->userid;
            $user_name = $value->username;
            $working_hours = ($value->working_hrs) ? $value->working_hrs : '08:00';

                $previous_month = date('Y-m', strtotime("-1 month"));
                $startDate = new Carbon($previous_month.'-29');
                $endDate = new Carbon(date('Y-m-28'));

                $previous_months = date('Y-m', strtotime("-1 month"));
                $startDates = new Carbon($previous_months.'-29');
                $endDates = new Carbon(date('Y-m-29'));

                $calculate_month_days = $endDates->diff($startDates)->format('%a');
                $startDate = date('Y-m-d',strtotime($startDate));
                $endDate = date('Y-m-d',strtotime($endDate));
               

                $employe_total_working_days = Serializeattendance::where('user_id',$user_id)->whereBetween('date', [$startDate, $endDate])->count();

                $employe_month_precent_days = Serializeattendance::where('user_id',$user_id)->where('total_hours','>=',$working_hours)->whereBetween('date', [$startDate, $endDate])->count();
              
   
                $employe_month_low_working_days = Serializeattendance::where('user_id',$user_id)->where('total_hours','<=',$working_hours)->whereBetween('date', [$startDate, $endDate])->count();

                // print_r($employe_month_low_working_days);
                

                $office_leave_count = count(cron_get_leave_days());
                
                $all_days_total = $employe_month_precent_days + $employe_month_low_working_days + $office_leave_count;
               
                echo $calculate_month_days;
                
                $absend_days = (self::absend_days($user_id) != '') ? self::absend_days($user_id) : 0;

                $nextmonth = date('Y-m', strtotime("+1 month"));
                $next_month = new Carbon($nextmonth.'-28');
                $endDates = new Carbon(date('Y-m-29'));

                $storeData = [
                    'user_id' => $user_id,
                    'date'    => date('Y-m-d'),
                    'from_date' => date('Y-m-d',strtotime($startDates)),
                    'to_date' => date('Y-m-d',strtotime($endDate)),
                    // 'from_date' => $endDates,
                    // 'to_date' => $next_month,
                    'month_total_days' => $calculate_month_days,
                    'offfice_working_days' => 0,
                    'office_leave_days'    => $office_leave_count,
                    'precent_days' => $employe_month_precent_days,
                    'low_working_days' => $employe_month_low_working_days,
                    'absend_days' => $absend_days,
                    'cl' => get_user_cl($user_id,[$startDate, $endDate]),
                    'permission' => get_user_permission($user_id),
                    'created_at' => date('Y-m-d H:i:s')
                ];

         

                $counting = Monthworking::where('user_id',$user_id)->whereDate('from_date', '<=',date("Y-m-d"))->whereDate('to_date', '>=',date("Y-m-d"))->count();

                    if($counting == 0){
                        Monthworking::insert($storeData);
                        echo 'insert Successfully'.'<br>';
                    }else{
                        Monthworking::where('user_id',$user_id)->whereDate('from_date', '<=',date("Y-m-d"))->whereDate('to_date', '>=',date("Y-m-d"))->update($storeData);
                        echo 'update Successfully'.'<br>';
                    }

                
            }

    }

    function absend_days($user_id){

        $previous_month = date('Y-m', strtotime("-1 month"));
        $startDate = new Carbon($previous_month.'-29');
        $endDate = new Carbon(date('Y-m-d'));
       


        $all_dates = array();
        while ($startDate->lte($endDate)){
          $all_dates[] = $startDate->toDateString();

          $startDate->addDay();
        }

        $leave_days =  cron_get_leave_days();

        $absend_count = 0;
        $absend_counts = 0;
        foreach (array_reverse($all_dates) as $key => $values){
            $get_hours = get_working_hours_cron($values,$user_id); 
            $value = json_decode($get_hours);
            $leave_find = in_array($values,$leave_days);

            if($value->attendance == 'no' && $leave_find != 1){
                $absend_counts += $absend_count+1;
            }

        }

        return $absend_counts;

    }


    function calculate_monthly_report_view($id){
        
        $user_id = encrypt_decrypt('decrypt',$id);    
       

        $cal_month_rep = Monthworking::where('user_id',$user_id)->get();      
        
       
       
        // $get_users = User::where('status','!=',2)->get();
        $get_users = User::where('userid',$user_id)->where('status','!=',2)->get();

       
        foreach ($get_users as $key => $value) {

        $user_id = $value->userid;
        $user_name = $value->username;
        $working_hours = ($value->working_hrs) ? $value->working_hrs : '10:45';

            $previous_month = date('Y-m', strtotime("-1 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-28'));

            $previous_months = date('Y-m', strtotime("-1 month"));
            $startDates = new Carbon($previous_months.'-29');
            $endDates = new Carbon(date('Y-m-29'));

            $calculate_month_days = $endDates->diff($startDates)->format('%a');
            $startDate = date('Y-m-d',strtotime($startDate));
            $endDate = date('Y-m-d',strtotime($endDate));                 

                $employe_month_precent_days = Serializeattendance::where('user_id',$user_id)->where('total_hours','>=',$working_hours)->whereBetween('date', [$startDate, $endDate])->get();                      
                echo '<pre>';
                print_r($cal_month_rep);
                die();
            }           
            
            
    }


}


 // $get_timing = Serializeattendance::select('hours')->where('status','=','Approved')->whereBetween('created_at', [$startDate, $endDate])->count();