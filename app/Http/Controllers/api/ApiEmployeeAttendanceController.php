<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\Models\User;
use App\Models\Roll;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Leavedays;
use App\Models\Attendance_time_extended;
use Redirect;
use DB;
use DateTime;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Validator;


class ApiEmployeeAttendanceController extends Controller{  

    public function __construct(){
       
    }
    
    function dailyworkinghrs(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

            $user_id = $request['user_id'];
            $previous_month = date('Y-m', strtotime("-2 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-d'));
           
            $all_dates = array();
            while ($startDate->lte($endDate)){
              $all_dates[] = $startDate->toDateString();
    
              $startDate->addDay();
            }

            $get_month = $all_dates;
            $dec_user_id = $user_id;

            if($get_month){
                
                $leave_days =  get_leave_days();
                $i = 1;
                $out = [];   
                foreach (array_reverse($get_month) as $key => $values){

                    $leave_find = in_array($values,$leave_days);

                    $get_hours = get_working_hoursapi($dec_user_id,$values); $value = json_decode($get_hours); 
                    $work_hours =  (get_user($dec_user_id,'working_hrs') != '') ? get_user($dec_user_id,'working_hrs') : '08:00';
                    if(strtotime(str_replace('Min', '', get_today_time($value->totaltime))) >=  strtotime($work_hours)){
                        $status = 'Completed';
                    }elseif($value->attendance == 'yes' && strtotime(str_replace('Min', '', get_today_time($value->totaltime))) <=  strtotime($work_hours)){
                        $status = 'Low Working Hours';
                    }elseif($value->attendance == 'no'  && $leave_find != 1){
                        $status = 'Absent';
                    }elseif($value->attendance == 'no' && $leave_find == 1){
                        $status = 'Leave';
                    }

                    $out[$key]['s_no'] = $i;
                    $out[$key]['date'] = $values;
                    $out[$key]['working_hours'] = ($value->totaltime == '') ? '--' : get_today_time($value->totaltime);
                    $out[$key]['status'] = $status;

                    $i++; 
                }
            }
           
            return apiResponse(1,'success',['working_hours' => $out]);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }
        
        
    }



    function attendance(Request $request){


        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[         
             'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

          
        $previous_month = date('Y-m', strtotime("-6 month"));
        $startDate = date('Y-m-d');
        $endDate = new Carbon(date('Y-m-'.'31'));

        $user_id = $request['user_id'];
        $roll = Roll::select('roll','sort_name')->where('status',1)->get();
        $event = Event::select('id','type')->where('status',1)->get();
        
        if($startDate == $endDate){
            $where = $startDate;
            $employee = Attendance::where('user_id',$user_id)->whereDate('created_at', $where)->orderBy('created_at','DESC');                        
        }else{
            $where = [$startDate, $endDate];
            $employee = Attendance::where('user_id',$user_id)->whereBetween('created_at', $where)->orderBy('created_at','DESC');                        
        }

        if($employee->count() != 0){
            $i = 1;
            $out = [];   
            foreach ($employee->get() as $key => $value){


                if($value->to_event != ''){
                    $to_event = $value->to_event;
                }else{
                    $to_event ='--';
                }

                if($value->to_time != ''){
                    $to_time = date('H:i:s',strtotime($value->to_time));
                }else{
                    $to_time = '--';
                }
                if($value->hours != ''){
                    $hours= $value->hours;
                }else{
                    $hours='--';
                }

                $out[$key]['s_no'] = $i;
                $out[$key]['date'] = date('d-m-Y',strtotime($value->date));
                $out[$key]['fromevent_in'] = $value->from_event;
                $out[$key]['from_intime'] = date('H:i:s',strtotime($value->from_time));
                $out[$key]['toevent_out'] = $to_event;
                $out[$key]['to_outtime'] = $to_time;
                $out[$key]['hours'] = $hours;


                $i++;
            }
        }else{
            $out = [];
        }
        

        $timeleft = [
            'morning_break_spent' =>  break_spend( $user_id,2,3),
            'lunch_spent' => break_spend($user_id ,4,5),
            'evening_break_spent' => break_spend($user_id ,6,7)
            
        ];

        
        return apiResponse(1,'success',['attendance' => $out,'time_spent'=>$timeleft]);
       
        }else{
            return apiResponse(0,'Invalid Request Method');
        }


    }





 }



?>