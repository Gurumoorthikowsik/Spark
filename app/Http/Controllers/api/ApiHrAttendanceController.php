<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roll;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Leavedays;
use App\Models\Workingdays;
use App\Models\Monthworking;
use Redirect;
use DB;
use DateTime;
use URL;
use Carbon\Carbon;
use App\Models\Serializeattendance;
use App\Models\Attendance_time_extended;

use Illuminate\Support\Facades\Validator;


class ApiHrAttendanceController extends Controller{  

    public function __construct(){
       
    }
    
function add_leave_days(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required'
            ]);
    
            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }          

            $Leave_days = Leavedays::orderBy('id','DESC');
            if($Leave_days->count() != 0){
                $i = 1;
                $out = []; 
                foreach ($Leave_days->get() as $key => $value){
                    $out[$key]['s_no'] = $i;
                    $out[$key]['leave_day_reason'] =$value->leave_reasion;
                    $out[$key]['leavedate'] =$value->leave_date;
                    $out[$key]['created_at'] = $value->created_at;
                    $out[$key]['remove_action'] =$value->id;
                    

                }
            }
           
            return apiResponse(1,'success',['Leave Day Report' => ($out)? $out : []]);
        }else{
            return apiResponse(0,'Invalid Request Method');
        }   
}



function add_leave_daysubmit(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'reason' => 'required',
            'date' => 'required'
       ], [
           'reason.required' => 'Leave Day Reason',
           'date.required' => 'Select a Month & Year',
       ]);
       if($validator->fails()){
        $errors = $validator->errors()->first();
         return apiResponse(0,$errors);
    }     
          
       $reason  = $request['reason'];
       $date  = $request['date'];
       
       $check_add_leave_days = Leavedays::select('leave_date')->where('leave_date',$date)->count();
       
        if($check_add_leave_days != 0){

            return apiResponse(0, 'Data Already Exist!!');      
        }

       $insertdata = [

           'leave_reasion' => $reason,
           'leave_date' => date('Y-m-d',strtotime($date)),
           'created_at' => date('Y-m-d H:i:s')
       ];

       $res = Leavedays::insert($insertdata);

           if($res){
            return apiResponse(1, 'Leave Day Calendar Added Successfully');
             
           }else{
            return apiResponse(0, 'Leave Day Added Invalid !!');
            
           }

    } 
}

function delete_leave_day(Request $request){


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'remove_action'=>'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
        }     
        $id = $request['remove_action'];     
        $check_leave =  Leavedays::where('id',$id);

        if($check_leave->count() != 0){
            Leavedays::where('id', $id)->delete();
            
            return apiResponse(1, 'Leave Day Delete Successfully');
        
        }else{
            return apiResponse(0, 'Some Error Occured');
        
        }   
    }
}



function office_working_days(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required'
        ]);     
        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }          

        $working_days = Workingdays::orderBy('id','DESC');
        if($working_days->count() != 0){
            $i = 1;
            $out = []; 
            foreach ($working_days->get() as $key => $value){
                $out[$key]['s_no'] = $i;
                $out[$key]['date'] =date('Y-M',strtotime($value->date));
                $out[$key]['no_of_days'] =$value->workingdays;
                $out[$key]['created_at'] = $value->created_at;
                $out[$key]['edit_action'] = $value->id;
                $out[$key]['remove_action'] = $value->id;

             
                $i++;

            }
        }else{
            $out = [];
            } 
            return apiResponse(1,'success',['Office Working Report' =>($out) ? $out : []]);
    
      }else{
        return apiResponse(0,'Invalid Request Method');
    }

    

}

function office_working_daysubmit(Request $request){


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'workingdays' => 'required',
            'date' => 'required',
        ], [
            'workingdays.required' => 'working Day',
            'date.required' => 'Select a Month & Year',
        ]);     
       
        $id = $request['remove_action'];  
         $workingdays  = $request['workingdays'];       
         $date  = $request['date'];

         $check_working_days = Workingdays::select('date')->where('date',$date)->count();
        
         if($check_working_days != 0){

            return apiResponse(0, 'Data Already Exist!!');
          

         }

         $insertdata = [

             'workingdays' => $workingdays,
             'date' => $date,
             'created_at' => date('Y-m-d H:i:s')
         ];

         $res = Workingdays::insert($insertdata);

             if($res){
                return apiResponse(1, 'Working Day Added Successfully');
                
             }else{
                return apiResponse(0, 'Working Day Added Invalid !!');
               
             }

      }

}


function delete_office_working_day(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'remove_action'=>'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
        }     
        $id = $request['remove_action'];
        $workingdays =  Workingdays::where('id',$id);

    if($workingdays->count() != 0){
        Workingdays::where('id', $id)->delete();
        
        return apiResponse(1, 'Leave Day Delete Successfully');
       
    }else{
        return apiResponse(0, 'Some Error Occured');
       
    }
    }
}


function edit_office_working_days(Request $request){


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $validatedData = $request->validate([
            'user_id'=>'required',
            'workingdays' => 'required',   
            'edit_action'=> 'required'           
       ], [
           'workingdays.required' => 'Please Choose The Date',               
       ]);

       $workingdays  = $request['workingdays'];           
       $id = $request['edit_action']; 

       $updatedData = [
           'workingdays' => $workingdays,               
       ];

       $res = Workingdays::where('id',$id)->update($updatedData);

           if($res){
            return apiResponse(1, 'Office Working Days Updated Successfully');
              
           }else{
            return apiResponse(0, 'Updated Invalid');
          
           }
    }             
 
}

public function index(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'staff_roll_name' => 'required'
        ]);     
        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }          
        
        $level = $request['staff_roll_name'];
        if($level == 'all'){
            $employee = User::where('status', '!=',2);
        }else{
            $employee = User::where('status', '!=',2)->where('position',$level);

        }
        
    if($employee->count() != 0){
        $i = 1;
        $out = [];  
        foreach ($employee->get() as $key => $value){

            if($value->status == 1){
                $status = 'Active';
            }else{
                $status = 'Deactive';
            }
            $out[$key]['s_no'] = $i;
            $out[$key]['employee_id'] = $value->employee_id;
            $out[$key]['username'] =$value->username;
            $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
            $out[$key]['status'] = $status;
            $out[$key]['view_attendance_event'] = $value->userid;
            $out[$key]['daily_working_hours'] = $value->userid;
            $i++;
        }
    }else{
        $out = [];
        }

        return apiResponse(1,'success',['Attendance Staff List' =>($out) ? $out : []]);

    }else{
        return apiResponse(0,'Invalid Request Method');
    }
}

function view_all_allattendance(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
         'user_id' => 'required',
         'visit_user_id' => 'required',

        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }  
    $userID = $request['user_id'];
    $user_id = $request['visit_user_id'];

    $roll = Roll::select('roll','sort_name')->where('status',1)->get();
    $employee = Attendance::where('user_id',$user_id)->orderBy('id','desc');
    $userid = $userID;
    $dec_user_id= $user_id;

    $staff_view_attendance = [
        'name' => get_user($dec_user_id,'username'),
        'email' =>encrypt_decrypt('decrypt',get_user($dec_user_id,'email'))
      
    ];

    if($employee->count() != 0){
        $i = 1;
        $out = []; 
        foreach ($employee->get() as  $key => $value){

            if($value->to_event != ''){
                $toevent = $value->to_event;
            }else{
                $toevent = '--';
            }
            if($value->to_time != ''){
                $totime = date('H:i:s',strtotime($value->to_time));
            }else{
                $totime = '--';
            }
            if($value->hours != ''){
                $hours = $value->hours;
            }else{
                $hours = '--';
            }

            $out[$key]['s_no'] = $i;
            $out[$key]['date'] = date('d-M-Y',strtotime($value->date));
            $out[$key]['from_event'] = $value->from_event;
            $out[$key]['from'] = date('H:i:s',strtotime($value->from_time));
            $out[$key]['to_event'] = $toevent;
            $out[$key]['to'] = $totime;
            $out[$key]['hours'] = $hours; 
            $i++; 
        }
    }else{
        $out = [];
    }
  
    return apiResponse(1,'success',['Staff View Attendance' => $staff_view_attendance,'viewattendance' => ($out)? $out : []]);
    }else{
        return apiResponse(0,'Invalid Request Method');
    }

 }

 function daily_working_hrs(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
         'user_id' => 'required',
         'visit_user_id' => 'required'

        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }  


    $userID = $request['user_id'];
    $user_id = $request['visit_user_id'];
    $roll = Roll::select('roll','sort_name')->where('status',1)->get();
    // $data['working_hrs'] = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'totaltime' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id'  group by date"); 

    $previous_month = date('Y-m', strtotime("-2 month"));
    $startDate = new Carbon($previous_month.'-29');
    $endDate = new Carbon(date('Y-m-d'));
    $all_dates = array();
    while ($startDate->lte($endDate)){
      $all_dates[] = $startDate->toDateString();

      $startDate->addDay();
    }       

    $get_month = $all_dates;
    $userid = $userID;
    $dec_user_id= $user_id;
    $dailystaff_view_attendance = [
        'name' => get_user($dec_user_id,'username'),
        'email' =>encrypt_decrypt('decrypt',get_user($dec_user_id,'email'))
      
    ];
    if($get_month){
        $i = 1; 
        $leave_days =  get_leave_days();
        foreach (array_reverse($get_month) as $key => $values){     

            $get_hours = get_working_hours_hr_portal($dec_user_id,$values); $value = json_decode($get_hours); 
            $work_hours =  (get_user($dec_user_id,'working_hrs') != '') ? get_user($dec_user_id,'working_hrs') : '08:00';
            $leave_find = in_array($values,$leave_days);
            if(strtotime(str_replace('Min', '', get_today_time($value->totaltime))) >=  strtotime($work_hours)){
                $status = 'Completed';
            }elseif($value->attendance == 'yes' && strtotime(str_replace('Min', '', get_today_time($value->totaltime))) <=  strtotime($work_hours)){
                $status = 'Low Working Hours';
            }elseif($value->attendance == 'no' && $leave_find != 1){
                $status = 'Absent'; 
            }elseif($value->attendance == 'no' && $leave_find == 1){
                $status = 'Leave';
            }
            $out[$key]['s_no'] = $i;
            $out[$key]['date'] = $value->date;
            $out[$key]['working_hrs'] = ($value->totaltime == '') ? '--' : get_today_time($value->totaltime);
            $out[$key]['status'] = $status;
            $i++;

        }
    }

   
    return apiResponse(1,'success',['Daily working Hours' => $dailystaff_view_attendance,'Daily Working Staff Attendance' => ($out)? $out : []]);
    }else{
        return apiResponse(0,'Invalid Request Method');
    }

 }



 
   


 function calculate_monthly_report(Request $request){
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $validator = Validator::make($request->all(),[
             'user_id' => 'required',
          ]);

           if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
            } 

         $params = $request->query->all();

           if(@$params['month'] != ''){

        $expolde = explode("-",$params['month']);
        $startDates = date('Y-m-29', strtotime(date(@$expolde[0].'-'.@$expolde[1])." -1 month"));

        $endDates = date('Y-m-d',strtotime(date(@$expolde[0].'-'.@$expolde[1].'-28')));

        $month_report = DB::table('user_info')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.working_hrs','calculate_month_working.id','calculate_month_working.date','calculate_month_working.from_date','calculate_month_working.to_date','calculate_month_working.month_total_days','calculate_month_working.offfice_working_days','calculate_month_working.office_leave_days','calculate_month_working.precent_days','calculate_month_working.low_working_days','calculate_month_working.absend_days','calculate_month_working.cl','calculate_month_working.permission')->rightJoin('calculate_month_working', 'user_info.userid', '=', 'calculate_month_working.user_id')->whereDate('calculate_month_working.from_date',$startDates)->whereDate('calculate_month_working.to_date',$endDates)->where('user_info.status','!=',2)->orderBy('calculate_month_working.id', 'DESC');

    
    }
    else{
            $pick_date = (@$params['month']) ? @$expolde[0].'-'.@$expolde[1] : date('Y-m');
            $previous_months = date('Y-m', strtotime("-1 month"));
            $startDates = new Carbon($previous_months.'-29');
            $endDates = new Carbon(date('Y-m-28'));
         
           $month_report = DB::table('user_info')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.working_hrs','calculate_month_working.id','calculate_month_working.date','calculate_month_working.from_date','calculate_month_working.to_date','calculate_month_working.month_total_days','calculate_month_working.offfice_working_days','calculate_month_working.office_leave_days','calculate_month_working.precent_days','calculate_month_working.low_working_days','calculate_month_working.absend_days','calculate_month_working.cl','calculate_month_working.permission')->rightJoin('calculate_month_working', 'user_info.userid', '=', 'calculate_month_working.user_id')->whereDate('calculate_month_working.from_date',$startDates)->whereDate('calculate_month_working.to_date',$endDates)->where('user_info.status','!=',2)->orderBy('calculate_month_working.id', 'DESC');
           }

       
           if($month_report->count() != 0){
            $out = [];
            $i = 1;
            foreach ($month_report->get() as $key => $value) {
                $out[$key]['s_no'] = $i;
                $out[$key]['username'] = $value->username;
                $out[$key]['employee_id'] = $value->employee_id;
                $out[$key]['working_time'] = ($value->working_hrs) ? $value->working_hrs : '08:00';
                $out[$key]['month'] = date('M',strtotime($value->to_date));
                $out[$key]['from_to_date'] = $value->from_date.'-'.$value->to_date;
                $out[$key]['month_over_all_day'] = $value->month_total_days;
                $out[$key]['precent_days'] = $value->precent_days;
                $out[$key]['low_working_days'] = $value->low_working_days;
                $out[$key]['absend_days'] = $value->absend_days;
                $out[$key]['office_leave_days'] = $value->office_leave_days;
                $out[$key]['cl'] = $value->cl;
                $out[$key]['permission'] = $value->permission;
                $out[$key]['action_id'] = $value->userid;
                $i++;
            }
           }else{
            $out = [];
            }
         return apiResponse(1,'success',['calculate_monthly_report' => ($out)? $out : []]);
        }else{
            return apiResponse(0,'Invalid Request Method');
        }
 }




 public function cal_month_rep_view(Request $request){

   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
           'user_id' => 'required',
           'action_id'=>'required'
        ]);

         if($validator->fails()){
          $errors = $validator->errors()->first();
           return apiResponse(0,$errors);
          } 

          $user_id = $request['action_id'];
          $check_user = User::where('userid',$user_id)->where('status','!=',2)->first();
  
              $user_id = $check_user->userid;
              $user_name = $check_user->username;
              $working_hours = ($check_user->working_hrs) ? $check_user->working_hrs : '08:00';
  
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
  
                  $employe_month_precent_days = Serializeattendance::where('user_id',$user_id)->where('total_hours','>=',$working_hours)->whereBetween('date', [$startDate, $endDate]);
  
                  $employe_month_low_working_days = Serializeattendance::where('user_id',$user_id)->where('total_hours','<=',$working_hours)->whereBetween('date', [$startDate, $endDate]);
                  
                  $cal_month_rep = Monthworking::where('user_id',$user_id)->whereBetween('date', [$startDate, $endDate]);
                
                  $office_leave_count = cron_get_leave_days();
                  
                  $absend_days = (@self::absend_days($user_id)) ? @self::absend_days($user_id) : [];
         
                  $cal_month_rep = Monthworking::select('user_id')->where('user_id',$user_id)->get();
                  $calculate_month_days = $calculate_month_days;
                  $employe_month_precent_days = $employe_month_precent_days;
                  $employe_month_low_working_days = $employe_month_low_working_days;
                  $employe_month_absent_days = $absend_days;
                  $office_leave_count = $office_leave_count;
                //   $data['employe_total_working_days'] = $cal_month_rep->
                  $user = $check_user->first();
                  $cal_month_rep = $cal_month_rep->first();
                  $user_id = $user_id;

                $Month_Total_Working_Days = [
                    'Month_Total_Working_Days' =>  $calculate_month_days,
                    'Present_Days' =>  $employe_month_precent_days->count(),
                    'Low_Working_Days' =>  $employe_month_low_working_days->count(),
                    'Absent_Days' =>  count($employe_month_absent_days),
                    'Office_Leave_Days' =>  count($office_leave_count)
                ];


                if($employe_month_precent_days->count() != 0){

                    $out = [];   
                    foreach($employe_month_precent_days->get() as $key => $value){
                    $out[$key]['employeemonthpercentday'] = $value->date;
                    }
                }else{
                    $out = [];
                }



               

                if($employe_month_low_working_days->count() != 0){

                    $outin = [];   
                    foreach($employe_month_low_working_days->get() as $key => $value){
                    $outin[$key]['Low_Working_Days'] = $value->date;
                    }
                }else{
                    $outin = [];
                }

                if(count($employe_month_absent_days) != 0){

                    $in = [];   
                    foreach($employe_month_absent_days as $key => $value){
                    $in[$key]['employemonthday'] = $value;

                    }
                }else{
                    $in = [];
                }


               
               
                    $inin = [];   
                    foreach($office_leave_count as $key => $value){
                    $inin[$key]['officeleaveday'] = $value;

                    }


                $cl = [
                    'cl' =>  (Int) $cal_month_rep->cl,
                    'Permission'=>(Int) $cal_month_rep->permission

                ];
                


                
  
            return apiResponse(1,'success',['Month_Total_Working_Days'=>$Month_Total_Working_Days,'Present_Days'=>($out) ? $out : [],'Low_Working_Days'=>($outin) ? $outin : [],'Absent_Days'=>($in) ? $in : [],'Office_Leave_Days'=>($inin) ? $inin : [],'cl'=>$cl]);
                  
        }else{
            return apiResponse(0,'Invalid Request Method');
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
    $absend_counts = [];
    foreach (array_reverse($all_dates) as $key => $values){
        $get_hours = get_working_hours_cron($values,$user_id); 
        $value = json_decode($get_hours);
        $leave_find = in_array($values,$leave_days);


        if($value->attendance == 'no' && $leave_find != 1){
            $absend_counts[]= $value->date;
        }

    }

    return array_reverse($absend_counts);

    

}













 }


 

?>