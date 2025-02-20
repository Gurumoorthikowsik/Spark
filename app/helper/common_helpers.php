<?php 
use App\Models\User;
use App\Models\Roll;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Setting;
use App\Models\User_add_inventory; 
use App\Models\UserDocument; 
use Carbon\Carbon;
use App\Models\Permission;
use App\Models\Leave; 
use App\Models\Leavedays;
use App\Models\Serializeattendance;
use App\Models\Privileges;
use App\Models\Workingdays;

function test($test,$text){

    echo $test;
    echo '<br>';
    echo $text;
}

function encrypt_decrypt($type , $message){
    $encrypt_method = "AES-256-CBC";
    $secret_key = env('KEY', 'BraveHRportel7394');
    $secret_iv = env('IV', 'L8cUyyH6cUvAZoOTJbE4jSzkD661K16wShkHUearQqK8hWuJW4');
    $key = hash('sha256', $secret_key);    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if($type == 'encrypt'){
        $output = openssl_encrypt($message, $encrypt_method, $key, 0, $iv);
       
        $encrypt = base64_encode($output);
        return $encrypt;
    }else{
        $decrypt = openssl_decrypt(base64_decode($message), $encrypt_method, $key, 0, $iv);
       return $decrypt;
    }    
    
}

function get_user($userId,$feild){

    $check_user = User::where('userid',$userId);

    if($check_user->count() != 0){
        $user = $check_user->first();
        return $user->$feild;
    }else{
        return "";
    }
}


function site_setting(){

    $site_setting = Setting::first();

    return $site_setting;
}


function get_position($roll){

    $check_user = Roll::select('sort_name')->where('roll',$roll)->first();

    return $check_user->sort_name;
}


function get_roll($sort_name){

    $check_user = Roll::select('roll')->where('sort_name',$sort_name);
    if($check_user->count() != 0){
        return $check_user->first()->roll;

    }else{
        return '--';
    }
}



function user_id(){

    $userId = Session::get('hruser_id');
    $check_user = User::select('userid')->where('position','HR')->where('userid',$userId);

    if($check_user->count() != 0){
        $user = $check_user->first();
        return $user->userid;
    }else{
        return "";
    }
}  


function Dayzone(){
    date_default_timezone_set('Asia/Dhaka');
    $time=date('Hi'); 

    if (($time >= "0600") && ($time <= "1200")) {
      echo "Good Morning";
    } 

    elseif (($time >= "1201") && ($time <= "1600")) {
      echo "Good Afternoon";
    }

    elseif (($time >= "1601") && ($time <= "2100")) {
      echo "Good Evening";
    }

    elseif (($time >= "2101") && ($time <= "2400")) {
      echo "Good Night";
    }
    else{
      echo "Why aren't you asleep?";
    }
}


function hours_cal($from , $to){

       $timeIn        = new DateTime($from);
       $timeOut       = new DateTime($to);
       $hours = date_diff($timeIn, $timeOut) -> format("%H:%i:%s");
       return $hours;
}



function page_access($userId,$access){

    $check_user = User::select('page_access')->where('position','HR')->where('userid',$userId)->first();

    $result = unserialize($check_user->page_access);
    // echo '<pre>';
    // print_r($result);
    // die;
    $response = ($result) ? $result : [];
    if (in_array($access, $response)){
        return 1;
    }else{
        return 0;
    }
}


function get_event($id){

    $event = Event::select('type')->where('id',$id)->first();
    return $event->type;
  
}



// ===========================================================dashboard time calculate start===========================================================
// function today_working_hrs($userID){

//     $today_date  = date('d-m-Y');
//     $user_id = $userID;
//     $sum = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) AS totaltime FROM tbl_attendance WHERE `tbl_attendance`.`date` = '$today_date'  AND `tbl_attendance`.`user_id` = '$user_id'");
//     if($sum[0]->totaltime != ''){
//         $out = date('H:i',strtotime($sum[0]->totaltime));
//     }else{
//         $out = '0:00';
//     }

//     return $out;
// }


function today_working_hrs($userID){
    $today_date  = date('Y-m-d');


    $user_id = $userID;
     date_default_timezone_set('asia/kolkata');
     $check_event = $get_exit_event = Attendance::select('id','from_time','to_event_id')->whereNotIn('from_event_id', [9,10])->where('user_id', $user_id)->Where('date',$today_date)->orderBy('id','desc')->limit(1);

  
     


         if(@$check_event->first()->to_event_id == '' && $check_event->count() != 0){
            
            $res = hours_cal($check_event->first()->from_time,date('d-m-Y H:i:s'));

            $sum = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) AS totaltime FROM tbl_attendance WHERE `tbl_attendance`.`date` = '$today_date'  AND `tbl_attendance`.`user_id` = '$user_id'");
            if($sum[0]->totaltime != ''){
                $split = explode(":",$sum[0]->totaltime);
                $get = $split[0].":".$split[1]; //date('H:i',strtotime($sum[0]->totaltime));

            }else{

                $get = '0:00';

            }

            $out = cal_currenct_overall_time([$get,$res]);

         }else{

        $sum = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) AS totaltime FROM tbl_attendance WHERE `tbl_attendance`.`date` = '$today_date'  AND `tbl_attendance`.`user_id` = '$user_id'");
        if($sum[0]->totaltime != ''){
            $split = explode(":",$sum[0]->totaltime);
            $out = $split[0].":".$split[1]; //date('h:i',strtotime($sum[0]->totaltime));
        }else{
            $out = '0:00';
        }

     }

     return $out;
}

function cal_currenct_overall_time($time){
date_default_timezone_set('asia/kolkata');
$sum = strtotime('00:00:00');
$totaltime = 00;
$h = 00;
foreach( $time as $element ) {
    $timeinsec = strtotime($element) - $sum;
    $totaltime = $totaltime + $timeinsec;
}


$h = intval($totaltime / 3600);
$totaltime = $totaltime - ($h * 3600);

$m = intval($totaltime / 60);
return str_pad($h, 2, "0", STR_PAD_LEFT).':'.str_pad($m, 2, "0", STR_PAD_LEFT);

}

// ===========================================================dashboard time calculate end===========================================================



function year_sunday(){

    $month  = date('m');
    $year  = date('Y');
    $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
    $out = [];
    for($i = 1; $i<= $days; $i++){
       $day  = date('Y-m-'.$i);
       $result = date("l", strtotime($day));
       if($result == "Sunday"){
        $out[] = date("d", strtotime($day));
       }
    }

        return $out;
}


function from_to_year_sunday($start,$end){

        $start_date=strtotime(date("d-m-Y",strtotime($start)));
        $end_date=strtotime(date("d-m-Y",strtotime($end)));
        $out = [];
        while(1){
          $start_date=strtotime('next sunday', $start_date);
          
          if($start_date>$end_date)
            break;
          $out[] = date("Y-m-d",$start_date);

        }

        if(count(today_isweek($start)) != 0){
            return array_merge($out,today_isweek($start));
        }else{
            return $out;
        }
        
}

    function today_isweek($date){

        $dt1 = strtotime($date);
        $dt2 = date("l", $dt1);
        $dt3 = strtolower($dt2);

        if(($dt3 == "sunday")){
                return array($date);
        }else{
                return array();
        }
    }


function staff_allacated_inventory($user_id){

    $check_inventory = User_add_inventory::select('userid')->where('userid',$user_id);

    return $check_inventory->count(); 
}

function upload_proof_serialize($user_id,$type,$img){

    $document = UserDocument::where('user_id',$user_id)->first();

        if($document){

            $data = unserialize($document->document);
            $data[$type] = $img;
            $update = UserDocument::where('user_id',$user_id)->update(['document' => serialize($data)]);

                if($update){
                    return 1;
                }else{
                    return 0;

                }

        }else{

              $data[$type] = $img;
              $insertdata = [
                'user_id' => $user_id,
                'document' => serialize($data),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
              ];

                $insert = UserDocument::insert($insertdata);

                    if($insert){
                        return 1;
                    }else{
                        return 0;

                    }
        }

}


function employee_upload_proof_serialize($user_id,$type,$img){

    $document = UserDocument::where('user_id',$user_id)->first();

        if($document){

            $data = unserialize($document->document);
            $data[$type] = [
                $type.'_image' => $img,
                $type.'_status' => 0
             ];

            $update = UserDocument::where('user_id',$user_id)->update(['document' => serialize($data),'option' => 0]);

                if($update){
                    return 1;
                }else{
                    return 0;

                }

        }else{

              $data[$type] = [
                $type.'_image' => $img,
                $type.'_status' => 0
              ];
              

              $insertdata = [
                'user_id' => $user_id,
                'document' => serialize($data),
                'status' => 1,
                'option' => 0,
                'created_at' => date('Y-m-d H:i:s'),
              ];

                $insert = UserDocument::insert($insertdata);

                    if($insert){
                        return 1;
                    }else{
                        return 0;

                    }
        }

}


function staff_permission_data($user_id){

    $this_month = date('m');

    $permission = Permission::where('user_id',$user_id)->whereMonth('created_at','=',$this_month);

    if($permission->count() != 0){

        $approved = Permission::select('hours')->where('user_id',$user_id)->where('status','=','Approved')->whereMonth('created_at','=',$this_month)->sum('hours');

        $pending = Permission::select('hours')->where('user_id',$user_id)->where('status','=','Pending')->whereMonth('created_at','=',$this_month)->sum('hours');

        $rejected = Permission::select('hours')->where('user_id',$user_id)->where('status','=','Rejected')->whereMonth('created_at','=',$this_month)->sum('hours');


        $available = 120 - $approved;

        $permission_available = $available - $pending;

        $pending = $pending;

        $res = ['available' => $permission_available,'pending' => $pending,'approved' => $approved];
        return json_encode($res);

    }else{
        $res = ['available' => 120,'pending' => '0','approved' => '0'];
        return json_encode($res);

    }

}


function staff_leave_data($user_id){

    $this_month = date('m');

    $leave = Leave::where('user_id',$user_id)->whereMonth('created_at','=',$this_month);

    if($leave->count() != 0){

        $approved = Leave::select('day')->where('user_id',$user_id)->where('status','=','Approved')->whereMonth('created_at','=',$this_month)->sum('day');

        $pending = Leave::select('day')->where('user_id',$user_id)->where('status','=','Pending')->whereMonth('created_at','=',$this_month)->sum('day');

        $rejected = Leave::select('day')->where('user_id',$user_id)->where('status','=','Rejected')->whereMonth('created_at','=',$this_month)->sum('day');


        $available = 1 - $approved;

        $leave_available = $available - $pending;

        $pending = $pending;

        $res = ['available' => $leave_available,'pending' => $pending,'approved' => $approved];
        return json_encode($res);

    }else{
        $res = ['available' => 1,'pending' => '0','approved' => '0'];
        return json_encode($res);

    }

}

function get_today_time($time) {
    $duration = date('H:i:s',strtotime($time));
    
    $validate = preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/", $duration);

    if($validate == 1){

    $split = explode(":",$duration);

        if($split[0] > '12'){

            return '00:00';
        }else if($split[0] == '00'){
            return '00:'.$split[1].':'.$split[2]."";
        }else{

            return $split[0].":".$split[1].":".$split[3];
        }

    }else{
        return $duration;
    }
}

function get_working_hours($date){
    $date_change = date('Y-m-d',strtotime($date));
    $user_id = Session::get("empuser_id");

    $get_hours = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'totaltime' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id' AND `date` = '$date_change' group by date");

    if(count($get_hours) != 0){

         return json_encode(['date' => $get_hours[0]->date,'totaltime' => $get_hours[0]->totaltime,'attendance' => 'yes']);
    }else{
         return json_encode(['date' => $date_change,'totaltime' => '','attendance' => 'no']);
    }

}



function get_working_hours_cron($date,$user_id){
    $date_change = date('Y-m-d',strtotime($date));
    $user_id = $user_id;

    $get_hours = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'totaltime' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id' AND `date` = '$date_change' group by date");

    if(count($get_hours) != 0){

         return json_encode(['date' => $get_hours[0]->date,'totaltime' => $get_hours[0]->totaltime,'attendance' => 'yes']);
    }else{
         return json_encode(['date' => $date_change,'totaltime' => '','attendance' => 'no']);
    }

}



function get_leave_days(){

   $previous_month = date('Y-m', strtotime("-2 month"));
   $startDate = new Carbon($previous_month.'-29');
   $endDate = new Carbon(date('Y-m-d'));

   $festival_leave = Leavedays::select('leave_date')->whereBetween('leave_date', [$startDate , $endDate])->get();
   $festival= [];      
   foreach ($festival_leave as $key => $value) {
        $festival[$key] = date('Y-m-d',strtotime($value->leave_date));
   }

    $leavedays = from_to_year_sunday($startDate,$endDate);
    $total_festival = array_merge($leavedays,$festival);

    return $total_festival;

}



function cron_get_leave_days(){

  
   $startDate = date('Y-m-29', strtotime(date('Y-m')." -1 month"));
   $endDate = date('Y-m-d',strtotime(date('Y-m-28')));
   $endDates = date('Y-m-d',strtotime(date('Y-m-28')));

   $festival_leave = Leavedays::select('leave_date')->whereBetween('leave_date', [$startDate , $endDates])->get();
   $festival= [];      
   foreach ($festival_leave as $key => $value) {
        $festival[$key] = date('Y-m-d',strtotime($value->leave_date));
   }

    $leavedays = from_to_year_sunday($startDate,$endDates);
    $total_festival = array_merge($leavedays,$festival);

    return $total_festival;

}




function get_working_hours_hr_portal($user_id,$date){
    $date_change = date('Y-m-d',strtotime($date));
    $user_id = $user_id;

    $get_hours = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'totaltime' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id' AND `date` = '$date_change' group by date");

    if(count($get_hours) != 0){

         return json_encode(['date' => $get_hours[0]->date,'totaltime' => $get_hours[0]->totaltime,'attendance' => 'yes']);
    }else{
         return json_encode(['date' => $date_change,'totaltime' => '','attendance' => 'no']);
    }
   
}


function serialize_attentance($date,$event_id,$user_id,$time,$total_hours = ""){



    $check_attentance = Serializeattendance::select('id','user_id','date','attendance','total_hours')->where('user_id',$user_id)->Where('date',$date);

    if($check_attentance->count() == 0){

        $data = [
            $event_id => $time,
            'other'   => "",
        ];

        $serialize = serialize($data);

        $insertData = [
            'user_id' => $user_id,
            'attendance' => $serialize,
            'date' => $date,
            'total_hours' => ($total_hours == "") ? '00:00:00' : $total_hours,
            'created_at' => date('Y-m-d H:i:s')
        ];


        Serializeattendance::insert($insertData);

        return true;

    }else if($event_id == 'other'){



        $data = unserialize($check_attentance->first()->attendance);

        $data[$event_id] = (@$data[$event_id]) ? $data[$event_id].' - '.$time : $time; //$time;

        $serialize = serialize($data);
        
        $sum = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) AS totaltime FROM tbl_attendance WHERE `tbl_attendance`.`date` = '$date'  AND `tbl_attendance`.`user_id` = '$user_id'");

            if(@$sum[0]->totaltime != ''){
                $total_hourss = date('H:i:s',strtotime($sum[0]->totaltime));
            }else if($check_attentance->first()->total_hours != ''){
                $total_hourss = $check_attentance->first()->total_hours;
            }else{
                $total_hourss = '00:00:00';
            }   


            $updateData = [
                'attendance' => $serialize,
                'total_hours' => $total_hourss,
            ];

         Serializeattendance::where('id',$check_attentance->first()->id)->update($updateData);

         return true;

    }else{
     
        $data = unserialize($check_attentance->first()->attendance);

        $data[$event_id] = $time; //$time;

        $serialize = serialize($data);
        
        $sum = DB::select("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) AS totaltime FROM tbl_attendance WHERE `tbl_attendance`.`date` = '$date'  AND `tbl_attendance`.`user_id` = '$user_id'");

            if(@$sum[0]->totaltime != ''){
                $total_hourss = date('H:i:s',strtotime($sum[0]->totaltime));
            }else if($check_attentance->first()->total_hours != ''){
                $total_hourss = $check_attentance->first()->total_hours;
            }else{
                $total_hourss = '00:00:00';
            }   

            $updateData = [
                'attendance' => $serialize,
                'total_hours' => $total_hourss,
            ];

        Serializeattendance::where('id',$check_attentance->first()->id)->update($updateData);

         return true;
    }

    


}

function get_next_event($id){

   $get_event = Event::select('id','type')->where('id','>',$id)->where('status',1)->limit(1)->orderBy('id','ASC');

   if($get_event->count() != 0){
        return $get_event->first();
   }else{
        return '0';
   }


}


function get_working_hoursapi($userid,$date){
    $date_change = date('Y-m-d',strtotime($date));
    $user_id = $userid;

    $get_hours = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'totaltime' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id' AND `date` = '$date_change' group by date");

    if(count($get_hours) != 0){

         return json_encode(['date' => $get_hours[0]->date,'totaltime' => $get_hours[0]->totaltime,'attendance' => 'yes']);
    }else{
         return json_encode(['date' => $date_change,'totaltime' => '','attendance' => 'no']);
    }



}

// function mobile_notify_link($link){

//     $split = explode('/',$link);
//     $split_end = end($split);
//     if(@$split_end == 'employee_proof'){
//         return 'https://staging.biovustech.com/api/employee-proof';
//     }else if(@$split_end == 'permission'){
//         return 'https://staging.biovustech.com/api/employees-permission';
//     }else if(@$split_end == 'leave_management'){
//         return 'https://staging.biovustech.com/api/employees-leave_management';

//     }else{
//         return '';
//     }

// }

function privileges_get_view($id){

    $check = Privileges::select('view')->where('status',1)->where('id',$id)->first()->view;

    if($check == 1){
        return 1;
    }else{
        return 0;
    }
}


function privileges_get_edit($id){

    $check = Privileges::select('edit')->where('status',1)->where('id',$id)->first()->edit;

    if($check == 1){
        return 1;
    }else{
        return 0;
    }
}



function get_user_cl($user_id,$date=[]){
 
 $month_year = date('Y-m');

 $working = Leave::select('day','leave_date')->where('user_id',$user_id)->whereBetween('leave_date', $date)->where('status','Approved')->get();
    $out = 0;
 foreach ($working as $key => $value) {
     $out += $value->day;
 }
 return $out;
 

}



function getuserName($id){
    $user = User::select('username')->where('userid',$id)->first();

    if($user){
        return $user->username;
    }else{
        return '--';
    }
}



function stu_page_access($userId){

    $check_user = User::select('position')->where('position',$userId)->first();

    echo "<pre>";
    print_r($check_user);
    die;
    

    $result = unserialize($check_user->page_access);
    // echo '<pre>';
    // print_r($result);
    // die;
    $response = ($result) ? $result : [];
    if (in_array($access, $response)){
        return 1;
    }else{
        return 0;
    }
}




function Dev_access($userId) {
    $user = User::select('position', 'userid') 
        ->where('position', 'Tester')
        ->where('userid', $userId)
        ->first();

    // Check if the user exists and return the user ID
    return $user ? $user->id : null; // Return null if no user is found
}



function get_user_permission($user_id){
 
 $month_year = date('Y-m');

 $working = Permission::where('user_id',$user_id)->whereMonth('permission_date',date('m'))->whereYear('permission_date',date('Y'))->where('status','Approved')->count();

 if($working != 0){
    return $working;
 }else{
    return 0;
 }

}

?>