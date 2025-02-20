<?php 
use App\Models\User;
use App\Models\Roll;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Setting;
use App\Models\Userinventory; 
use App\Models\UserDocument; 
use Carbon\Carbon;
use App\Models\Notification;


function employee_get_user($userId,$feild){

    $check_user = User::where('userid',$userId);

    if($check_user->count() != 0){
        $user = $check_user->first();
        return $user->$feild;
    }else{
        return "";
    }
}


function emp_user_id(){

    $userId = Session::get('empuser_id');
    $check_user = User::select('userid')->where('userid',$userId);

    if($check_user->count() != 0){
        $user = $check_user->first();
        return $user->userid;
    }else{
        return "";
    }
} 


function notification($insertdata=[]){   
    $insert = Notification::insert($insertdata);   
    return true;
}

function hours_calculate($from , $to){

       $timeIn        = new DateTime($from);
       $timeOut       = new DateTime($to);
       $hours = date_diff($timeIn, $timeOut) -> format("%H:%i:%s");
       return $hours;
}

function break_spend($user_id,$start_id,$to_id){

    $today = date('Y-m-d');

    $to_event = Attendance::select('to_time')->where('user_id',$user_id)->where('to_event_id',$start_id)->where('date',$today);
    $from_event = Attendance::select('from_time')->where('user_id',$user_id)->where('from_event_id',$to_id)->where('date',$today);


    if($to_event->count() != 0 && $from_event->count() != 0 && $to_event->first()->to_time != '' && $from_event->first()->from_time != ''){
        $from = $to_event->first()->to_time;
        $to = $from_event->first()->from_time;

       $res =  hours_calculate($from,$to);

    }else{

        $res = '--';
    }

    return $res;


}


function month_year_sunday(){

    $month  = date('m');
    $year  = date('Y');
    $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
    $out = [];
    for($i = 1; $i<= $days; $i++){
       $day  = date('Y-m-'.$i);
       $result = date("l", strtotime($day));
       if($result == "Sunday"){
        $out[] = date("Y-m-d", strtotime($day));
       }
    }

        return $out;
}


    function apiResponse($status,$msg,$data='none'){

       header('Content-Type: application/json');
       if($data == 'none'){
          $res = ['status' => ($status) ? $status : 0,'message' => ($msg) ? $msg : ""];
       }else{
          $data_array = ($data) ? (object) $data : (object) array();
          $res = ['status' => ($status) ? $status : 0,'message' => ($msg) ? $msg : ""] + ["data" => $data_array];
       }
        
     
       echo json_encode($res);
       die;
    }


?>