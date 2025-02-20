<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
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


class AttendanceController extends Controller{  

    public function __construct(){

    }
 
    public function index(Request $request,$level=""){

        if($level == 'all'){
            $data['employee'] = User::where('status', '!=',2);
        }else{
            $data['employee'] = User::where('status', '!=',2)->where('position',$level);

        }
        session(['attendance_roll' => $level]);
        $data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();
        $data['params'] = $level;
        $data['js_file'] = 'attendance';
        $data['title'] = 'Total Attendance';
        return view('attendance/total_attendance',$data);

    }

    function view_all_allattendance(Request $request,$userID=""){
        
        $user_id = encrypt_decrypt('decrypt',$userID);
        $data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();
        $data['employee'] = Attendance::where('user_id',$user_id)->orderBy('id','desc');
        $data['userid'] = $userID;
        $data['dec_user_id']= $user_id;
        $data['js_file'] = 'attendance';
        $data['title'] = 'View All Working Attendance';
        return view('attendance/view_all_attendance',$data);
    }
    
    function working_calendar(Request $request,$userID=""){

        $data['js_file'] = '';
        $data['title'] = 'Working Hours Calendar';
        return view('attendance/working_calendar',$data);
    }


    function daily_working_hrs(Request $request,$userID=""){
        $user_id = encrypt_decrypt('decrypt',$userID);
        $data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();
        // $data['working_hrs'] = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'totaltime' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id'  group by date"); 

        $previous_month = date('Y-m', strtotime("-1 month"));
        $startDate = new Carbon($previous_month.'-29');
        $endDate = new Carbon(date('Y-m-d'));
        $all_dates = array();
        while ($startDate->lte($endDate)){
          $all_dates[] = $startDate->toDateString();

          $startDate->addDay();
        }       

        $data['get_month'] = $all_dates;
        $data['userid'] = $userID;
        $data['dec_user_id']= $user_id;
        $data['js_file'] = 'attendance';
        $data['title'] = 'View All Working Attendance';

       
        return view('attendance/daily_working_hours',$data);
    }


    function attendance(Request $request){

        try {


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $validatedData = $request->validate([
                'event' => 'required',
            ], [
                'event.required' => 'Choose Attendance Event',
            ]);

            $user_id    = user_id();
            $event      = $request['event'];
            $event_name = get_event($event);
            $date_time  = date('Y-m-d H:i:s');
            $date_time_event  = date('d-m-Y H:i:s');
            $today_date  = Carbon::now()->format('Y-m-d');
            $today_date_qry  = date('d-m-Y');

            $res = Attendance::where('user_id', user_id())->whereNotIn('from_event_id', [9,10,11])->Where('from_time', 'like', '%' . $today_date_qry . '%');

 


            if($res->count() == 0){

                $check_login_event = Attendance::where('user_id', $user_id)->Where('date', $today_date)->where('from_event_id','1');

                if($check_login_event->count() != 0){
                    $res = ['status' => 0,'msg' => 'Already Login Event Entry'];
                    echo json_encode($res) ; die;
                }
                
                
                if($event == 1){
                    $InsertDate = [
                        'user_id' => $user_id,
                        'from_event_id' => $event,
                        'from_event' => $event_name,
                        'from_time' => $date_time_event,
                        'date' => $today_date,
                        'created_at' => $date_time
                    ];

                    $out = Attendance::insert($InsertDate);

                    serialize_attentance($today_date,$event,$user_id,$date_time_event,"");

                    if($out){
                        $res = ['status' => 1,'msg' => $event_name.' Time Added Successfully'];
                        echo json_encode($res) ; die;
                    }else{
                        $res = ['status' => 0,'msg' => $event_name.' Time Added Invalid !!'];
                        echo json_encode($res) ; die;
                    }

                }else{
                    $res = ['status' => 0,'msg' => 'Please Choose Login In Event'];
                    echo json_encode($res) ; die;
                }

            }else{
               

                $in_array = ["1","3","5","7"];
                $out_array = ["2","4","6"];
                $exit_array = ["8"];

                if(in_array($event,$in_array)){
                    // echo 'in_array'; exit;
                    $check_in_event = Attendance::where('user_id', user_id())->Where('date', $today_date)->where('from_event_id',$event);
                    
                    if($check_in_event->count() == 0){

                        
                        $check_out_event = Attendance::where('user_id', user_id())->Where('date', $today_date)->whereNotIn('from_event_id', [9,10,11])->limit(1)->orderBy('id','DESC')->first();
                    
                            if($check_out_event->to_event_id == ''){
                                $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($check_out_event->from_event_id)->type.' Event'];
                                echo json_encode($res) ; die;
                            }

                            if(get_next_event($check_out_event->to_event_id)->id != $event){
                                $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($check_out_event->to_event_id)->type.' Event'];
                                echo json_encode($res) ; die;
                            }

                        $In_InsertData = [
                            'user_id' => $user_id,
                            'from_event_id' => $event,
                            'from_event' => $event_name,
                            'from_time' => $date_time_event,
                            'date' => $today_date,
                            'created_at' => $date_time
                        ];

                        $out = Attendance::insert($In_InsertData);
                        serialize_attentance($today_date,$event,$user_id,$date_time_event,"");

                        if($out){
                            $res = ['status' => 1,'msg' => $event_name.' Time Added Successfully'];
                            echo json_encode($res) ; die;
                        }else{
                            $res = ['status' => 0,'msg' => $event_name.' Time Added Invalid !!'];
                            echo json_encode($res) ; die;
                        }

                    }else{
                        $res = ['status' => 0,'msg' => 'Already Entry This Event'];
                        echo json_encode($res) ; die;
                    }

                }else if(in_array($event,$out_array)){

                    $check_out_event = Attendance::where('user_id', user_id())->Where('date',$today_date)->where('to_event_id',$event);

                    if($check_out_event->count() == 0){


                        $check_out_event = Attendance::where('user_id', user_id())->Where('date', $today_date)->whereNotIn('from_event_id', [9,10,11])->limit(1)->orderBy('id','DESC')->first();


                        if($check_out_event->to_event_id != ''){
                            $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($check_out_event->to_event_id)->type.' Event'];
                            echo json_encode($res) ; die;
                        }

                        if(get_next_event($check_out_event->from_event_id)->id != $event){
                            $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($check_out_event->from_event_id)->type.' Event'];
                            echo json_encode($res) ; die;
                        }

                        $get_out_event = Attendance::select('id','from_time')->where('user_id', user_id())->Where('date',$today_date)->orderBy('id','desc')->whereNotIn('from_event_id', [9,10,11])->limit(1)->first();
                            
                        $hours_cal = hours_cal($get_out_event->from_time,$date_time);

                            $out_UpdateData = [
                                'to_event_id' => $event,
                                'to_event' => $event_name,
                                'to_time' => $date_time_event,
                                'hours' => $hours_cal, 
                                'date' => $today_date,
                            ];
                            
                      
                        $out = Attendance::where('id', $get_out_event->id)->where('user_id',user_id())->update($out_UpdateData);

                        serialize_attentance($today_date,$event,$user_id,$date_time_event,"");

                        if($out){
                            $res = ['status' => 1,'msg' => $event_name.' Time Added Successfully'];
                            echo json_encode($res) ; die;
                        }else{
                            $res = ['status' => 0,'msg' => $event_name.' Time Added Invalid !!'];
                            echo json_encode($res) ; die;
                        }

                    }else{
                         $res = ['status' => 0,'msg' => 'Already Entry This Event'];
                         echo json_encode($res) ; die;
                    }

                }else if(in_array($event,$exit_array)){
                  $check_exit_event = Attendance::where('user_id', user_id())->Where('date',$today_date)->where('to_event_id',$event);
                    if($check_exit_event->count() == 0){


                        $get_exit_event = Attendance::select('id','from_time','to_event_id','from_event_id')->where('user_id', user_id())->Where('date',$today_date)->orderBy('id','desc')->whereNotIn('from_event_id', [9,10,11])->limit(1)->first();

                         if($get_exit_event->to_event_id == ""){


                                if(get_next_event($get_exit_event->from_event_id)->id == 2 || get_next_event($get_exit_event->from_event_id)->id == 8){
                                   
                                        $hours_cal = hours_cal($get_exit_event->from_time,$date_time);

                                        $exit_UpdateData = [
                                            'to_event_id' => $event,
                                            'to_event' => $event_name,
                                            'to_time' => $date_time_event,                                            
                                            'hours' => $hours_cal,
                                            'date' => $today_date,
                                        ];
                                  
                                    $out = Attendance::where('id', $get_exit_event->id)->where('user_id',user_id())->update($exit_UpdateData);
                                    serialize_attentance($today_date,$event,$user_id,$date_time_event,"");
                                    if($out){
                                        $res = ['status' => 1,'msg' => $event_name.' Time Added Successfully'];
                                        echo json_encode($res) ; die;
                                    }else{
                                        $res = ['status' => 0,'msg' => $event_name.' Time Added Invalid !!'];
                                        echo json_encode($res) ; die;
                                    }

                                }else{
                                    $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($get_exit_event->from_event_id)->type.' Event'];
                                    echo json_encode($res) ; die;
                                }

                         }else{
                            $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($get_exit_event->to_event_id)->type.' Event'];
                            echo json_encode($res) ; die;
                         }

                    }else{
                         $res = ['status' => 0,'msg' => 'Already Entry This Event'];
                         echo json_encode($res) ; die;
                    }
                }

               $spent = strtotime($out_UpdateData["from_event_id"]) - strtotime($In_InsertData["to_event_id"]);

            }


        }

    }


    catch (\Exception $e) {
        $res = ['status' => 0,'msg' => $e];
        echo json_encode($res) ; die;

}

        $data['event'] = Event::select('id','type')->where('status',1)->get();
        $data['js_file'] = 'attendance';
        $data['title'] = 'Entry Attendance';
        return view('attendance/make_attendance',$data);

    }


    function add_leave_days(Request $request){

         if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $validatedData = $request->validate([
                'reason' => 'required',
                'date' => 'required',
            ], [
                'reason.required' => 'Leave Day Reason',
                'date.required' => 'Select a Month & Year',
            ]);

            $reason  = $request['reason'];
            $date  = $request['date'];
            
            $check_add_leave_days = Leavedays::select('leave_date')->where('leave_date',$date)->count();
            
             if($check_add_leave_days != 0){

               Session::flash('error', 'Data Already Exist!!');
               return redirect()->back();

             }

            $insertdata = [

                'leave_reasion' => $reason,
                'leave_date' => date('Y-m-d',strtotime($date)),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $res = Leavedays::insert($insertdata);

                if($res){
                    Session::flash('success', 'Leave Day Calendar Added Successfully');
                    return redirect()->back();
                }else{
                    Session::flash('error', 'Leave Day Added Invalid !!');
                    return redirect()->back();
                }

         }

        $data['Leave_days'] = Leavedays::orderBy('id','DESC');
        $data['js_file'] = 'add_leave_days';
        $data['title'] = 'Add Leave Days';
        return view('attendance/add_leave_days',$data);
    }


    function delete_leave_day($id){

        $check_leave =  Leavedays::where('id',$id);

        if($check_leave->count() != 0){
            Leavedays::where('id', $id)->delete();
            
            Session::flash('success', 'Leave Day Delete Successfully');
            return redirect()->back();
        }else{
            Session::flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    function office_working_days(Request $request){


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validatedData = $request->validate([
                'workingdays' => 'required',
                'date' => 'required',
            ], [
                'workingdays.required' => 'working Day',
                'date.required' => 'Select a Month & Year',
            ]);     
           
    
             $workingdays  = $request['workingdays'];       
             $date  = $request['date'];

             $check_working_days = Workingdays::select('date')->where('date',$date)->count();
            
             if($check_working_days != 0){

               Session::flash('error', 'Data Already Exist!!');
               return redirect()->back();

             }
    
             $insertdata = [
    
                 'workingdays' => $workingdays,
                 'date' => $date,
                 'created_at' => date('Y-m-d H:i:s')
             ];
    
             $res = Workingdays::insert($insertdata);
    
                 if($res){
                     Session::flash('success', 'Working Day Added Successfully');
                     return redirect()->back();
                 }else{
                     Session::flash('error', 'Working Day Added Invalid !!');
                     return redirect()->back();
                 }
    
          }
    
         $data['working_days'] = Workingdays::orderBy('id','DESC');
     
    
        $data['js_file'] = 'office_working_days';
        $data['title'] = 'Office Working Days';
        return view('attendance/office_working_days',$data);
    
    
    }


    

    public function staff_attendance_report(Request $request){

        $params = $request->query->all();

        $data['geteventtype'] = Event::where('status', 1)->get();

    
              
        if(@$params['start_date'] != '' && @$params['end_date'] != ''){
             $startDate = date('Y-m-d',strtotime($params['start_date']));
             $endDate = date('Y-m-d',strtotime($params['end_date']));
        }else{
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');            
        }       

        $session = [
            'start_date' => $startDate,
            'end_date' => $endDate 
        ];
        session($session);
        
        $data['attendance'] = DB::table('serialize_attendance')->select('serialize_attendance.user_id','serialize_attendance.id','serialize_attendance.attendance','serialize_attendance.date','serialize_attendance.total_hours','serialize_attendance.created_at','userid','user_info.username','user_info.email','user_info.employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'serialize_attendance.user_id')->where('user_info.userid','!=',2)->whereBetween('serialize_attendance.date', [$startDate, $endDate])->orderBy('user_info.userid', 'ASC')->orderBy('serialize_attendance.date', 'DESC')->get()->toArray();        
        $data['js_file'] = 'attendance';
        $data['pick_start_date'] = @($params['start_date']) ? @$params['start_date'] : '';
        $data['pick_end_date'] = @($params['end_date']) ? @$params['end_date'] : '';
        $data['title'] = 'Staff Attendance Report';
        return view('attendance/staff_attendance_report',$data);

    }

    function staffattendance_report(Request $request){

        
        $columns = array( 
                                0 =>'user_id', 
                                1 =>'employee_id',
                                2=> 'username',
                                3=> 'date',
                                4=> 'login_in',
                                5=> 'mor_break_in',
                                6=> 'mor_break_end',
                                7=> 'mor_break_spent',
                                8=> 'lunch_begin',
                                9=> 'lunch_end',
                                10=> 'lunch_spent',
                                11=> 'even_break_in',
                                12=> 'even_break_end',
                                13=> 'even_break_spent',
                                14=> 'logout',
                                15=> 'other',
                                16=> 'total_hours',
                                17=> 'status',
                        );
    
        $startDate = (Session::get('start_date')) ? Session::get('start_date') : date('Y-m-d');
        $endDate = (Session::get('end_date')) ? Session::get('end_date') : date('Y-m-d');
            
        $totalData = DB::table('serialize_attendance')->select('serialize_attendance.user_id','serialize_attendance.id','serialize_attendance.attendance','serialize_attendance.date','serialize_attendance.total_hours','serialize_attendance.created_at','userid','user_info.username','user_info.email','user_info.employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'serialize_attendance.user_id')->where('user_info.userid','!=',2)->orderBy('user_info.userid', 'ASC')->whereBetween('serialize_attendance.date', [$startDate, $endDate])->orderBy('serialize_attendance.date', 'DESC')->get()->count();
            
        $totalFiltered = $totalData; 
    
        $limit = $request->input('length');
        $start = $request->input('start');
        // $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts =  DB::table('serialize_attendance')->select('serialize_attendance.user_id','serialize_attendance.id','serialize_attendance.attendance','serialize_attendance.date','serialize_attendance.total_hours','serialize_attendance.created_at','userid','user_info.username','user_info.email','user_info.employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'serialize_attendance.user_id')->where('user_info.userid','!=',2)->orderBy('user_info.userid', 'ASC')->whereBetween('serialize_attendance.date', [$startDate, $endDate])->orderBy('serialize_attendance.date', 'DESC')->offset($start)->limit($limit)
            // ->orderBy($order,$dir)
            ->get();
    
            $totalFiltered = DB::table('serialize_attendance')->select('serialize_attendance.user_id','serialize_attendance.id','serialize_attendance.attendance','serialize_attendance.date','serialize_attendance.total_hours','serialize_attendance.created_at','userid','user_info.username','user_info.email','user_info.employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'serialize_attendance.user_id')->where('user_info.userid','!=',2)->orderBy('user_info.userid', 'ASC')->whereBetween('serialize_attendance.date', [$startDate, $endDate])->orderBy('serialize_attendance.date', 'DESC')->get()->count();
           
        }
        else {
            $search = $request->input('search.value'); 
          
    
            $posts =  DB::table('serialize_attendance')->select('serialize_attendance.user_id','serialize_attendance.id','serialize_attendance.attendance','serialize_attendance.date','serialize_attendance.total_hours','serialize_attendance.created_at','userid','user_info.username','user_info.email','user_info.employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'serialize_attendance.user_id')->where('user_info.userid','!=',2)->orderBy('user_info.userid', 'ASC')->orderBy('serialize_attendance.date', 'DESC')      
                            ->whereBetween('serialize_attendance.date', [$startDate, $endDate])
                            ->where('user_id','LIKE',"%{$search}%")
                            // ->orWhere('employee_id', 'LIKE',"%{$search}%")
                            ->orWhere('username', 'LIKE',"%{$search}%")
                            // ->orWhere('date', 'LIKE',"%{$search}%")
                         
                            ->offset($start)
                            ->limit($limit)
                            // ->orderBy($order,$dir)
                            ->get()->toArray();
    
            // $totalFiltered = DB::table('serialize_attendance')->select('serialize_attendance.user_id','serialize_attendance.id','serialize_attendance.attendance','serialize_attendance.date','serialize_attendance.total_hours','serialize_attendance.created_at','userid','user_info.username','user_info.email','user_info.employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'serialize_attendance.user_id')->where('user_info.userid','!=',2)->whereBetween('serialize_attendance.date', [$startDate, $endDate])->orderBy('user_info.userid', 'ASC')->orderBy('serialize_attendance.date', 'DESC')->get()
            //                  ->where('user_id','LIKE',"%{$search}%")
            //                  ->orWhere('employee_id', 'LIKE',"%{$search}%")
            //                  ->orWhere('username', 'LIKE',"%{$search}%")            
            //                  ->orWhere('date', 'LIKE',"%{$search}%")
            //                  ->count();
        }
    
        
    
        $data = array();
        if(!empty($posts))
        {
    
            $attendance = $posts;
            $i = 1;
            foreach ($attendance as $value){
    
    
                $decrypt = unserialize($value->attendance);
                if(@$decrypt[1]){
                $login = date('H:i:s',strtotime($decrypt[1]));
                }else{
                    $login = "--";
                }
    
                if(@$decrypt[2]){
                 $morn_break_in = date('H:i:s',strtotime($decrypt[2]));
                }
                else{
                    $morn_break_in = "--";
                }
    
                if(@$decrypt[3])
                {$mor_break_end= date('H:i:s',strtotime($decrypt[3]));}
                else{
                    $mor_break_end= '--' ;
    
                }
                
                if($morn_break_in != '--' && $mor_break_end != '--'){
                    $mor_break_spent= hours_calculate($decrypt[2],$decrypt[3]);
                }else{
                    $mor_break_spent=  '--';
    
                }
    
                if(@$decrypt[4])
                    {$lunch_begin=date('H:i:s',strtotime($decrypt[4]));
                    }
                else{
                    $lunch_begin=  '--';
                 }
    
                if(@$decrypt[5])
                {$lunch_end= date('H:i:s',strtotime($decrypt[5]));}
                else{
                    $lunch_end=  '--';
                }

                if($lunch_begin != '--' && $lunch_end != '--'){
                    $lunch_spent= hours_calculate($decrypt[4],$decrypt[5]);
                }else{
                    $lunch_spent=  '--';
    
                }

               if(@$decrypt[6])
                {$even_break_in = date('H:i:s',strtotime($decrypt[6]));}
                else{
                    $even_break_in = '--';
                }
                if(@$decrypt[7])
                    {$even_break_end=date('H:i:s',strtotime($decrypt[7]));}
                else{
                    $even_break_end=  '--';
                }

                if($even_break_in != '--' && $even_break_end != '--'){
                    $even_break_spent= hours_calculate($decrypt[6],$decrypt[7]);
                }else{
                    $even_break_spent=  '--';
    
                }

                if(@$decrypt[8])
                {$logout=date('H:i:s',strtotime($decrypt[8]));}
                else{
                    $logout=  '--';
                }
                if(@$decrypt['other'])
                {$other= $decrypt['other'];}
                else{
                  $other=  '--';
                }
    
                $work_hours =  (get_user($value->user_id,'working_hrs') != '') ? get_user($value->user_id,'working_hrs') : '08:00';
    
                $half_hours =  (get_user($value->user_id,'working_hrs') == '12:00') ? '06:00' : '04:30';
               
                if(strtotime($value->total_hours) >=  strtotime($work_hours)){
                    $status= '<span class="badge badge-outline-success">Completed</span>';
                }
                elseif($value->date != date('Y-m-d') && $value->total_hours != '00:00:00' && strtotime($value->total_hours) <=  strtotime($work_hours)){
                $status= '<span class="badge badge-outline-warning">Low Working Hours</span>';
               }
    
                elseif($value->date == date('Y-m-d') && $value->total_hours != '00:00:00' && strtotime($value->total_hours) <=  strtotime($work_hours)){
    
                    $status='<span class="badge badge-outline-primary">In Progress</span>';
                }
                elseif($value->date >= date('Y-m-d') && $value->total_hours == '00:00:00'){
                    $status= '--';
    
                }
                elseif($value->date <= date('Y-m-d') && $value->total_hours == '00:00:00'){
                    $status= '<span class="badge badge-outline-danger">Absent</span>';
                }
             
                
                $nestedData['user_id'] = $i;
                $nestedData['employee_id'] = $value->employee_id;
                $nestedData['username'] = $value->username;
                $nestedData['date'] = $value->date;
                $nestedData['login_in'] = $login;
                $nestedData['mor_break_in'] =  $morn_break_in;
                $nestedData['mor_break_end'] = $mor_break_end;
                $nestedData['mor_break_spent'] = $mor_break_spent;
                $nestedData['lunch_begin'] = $lunch_begin;
                $nestedData['lunch_end'] = $lunch_end;
                $nestedData['lunch_spent'] = $lunch_spent;
                $nestedData['even_break_in'] = $even_break_in;
                $nestedData['even_break_end'] = $even_break_end;
                $nestedData['even_break_spent'] = $even_break_spent;
                $nestedData['logout'] = $logout;
                $nestedData['other'] = $other;
                $nestedData['total_hours'] = ($value->total_hours) ? $value->total_hours : '--';
                $nestedData['status'] = $status;
                $data[] = $nestedData;
            
                $i++;
            }
        }
    
        
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }
    


    function office_working_report(Request $request){


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $validatedData = $request->validate([
               'workingdays' => 'required',               
           ], [
               'workingdays.required' => 'Please Choose The Date',               
           ]);

           $workingdays  = $request['workingdays'];           
           $id = $request['id']; 

           $updatedData = [
               'workingdays' => $workingdays,               
           ];

           $res = Workingdays::where('id',$id)->update($updatedData);

               if($res){
                   Session::flash('success', 'Office Working Days Updated Successfully');
                   return redirect()->back();
               }else{
                   Session::flash('error', 'Updated Invalid');
                   return redirect()->back();
               }
        }             

        $data['js_file'] = 'attendance';
        $data['title'] = 'Office Working Days';
        return view('attendance/office_working_days',$data);
   }



function delete_office_working_day($id){

    $workingdays =  Workingdays::where('id',$id);

    if($workingdays->count() != 0){
        Workingdays::where('id', $id)->delete();
        
        Session::flash('success', 'Leave Day Delete Successfully');
        return redirect()->back();
    }else{
        Session::flash('error', 'Some Error Occured');
        return redirect()->back();
    }
}


function attendance_time_extended_request(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validatedData = $request->validate([
             'status' => 'required',
         ], [
             'status.required' => 'Please Choose The Date',
         ]);

         $status  = $request['status'];
         $id = $request['id']; 

         $attendance_time_extended_data = Attendance_time_extended::select('user_id','extend_date','from_time','to_time','hours','updated_at')->where('id',$id)->where('status','Pending');

                 if($status == 'Approved'){             
                    
                 
                            if($attendance_time_extended_data->count() != 0){
                                $attendance_time_extended_data = $attendance_time_extended_data->first();

                                // if($attendance_time_extended_data->hours == '120'){
                                //     $hours = '02:00:00';
                                // }else if($attendance_time_extended_data->hours == '90'){
                                //     $hours = '01:30:00';
                                // }else if($attendance_time_extended_data->hours == '60'){
                                //     $hours = '01:00:00';
                                // }else{
                                //     $hours = '00:30:00';
                                // }
                         
                             $from_time = date('d-m-Y',strtotime($attendance_time_extended_data->extend_date)).' '.$attendance_time_extended_data->from_time.':00';
                             
                             $to_date = date('d-m-Y',strtotime($attendance_time_extended_data->extend_date)).' '.$attendance_time_extended_data->to_time.':00';

                              $hours = date("H:i:s",strtotime(hours_cal($from_time, $to_date)));
                                    
                             $insertData = [
                                 'user_id' => $attendance_time_extended_data->user_id,
                                 'from_event_id' => 11,
                                 'from_event'    => 'Attendance Time Extended',
                                 'from_time'     => $from_time,
                                 'to_event_id'   => 11,
                                 'to_event'      => 'Attendance Time Extended',
                                 'to_time'       => $to_date,
                                 'date'          => date('Y-m-d',strtotime($attendance_time_extended_data->extend_date)),
                                 'hours'         => $hours,
                                 'created_at'    =>  date('Y-m-d',strtotime($attendance_time_extended_data->extend_date)).' '.date('H:i:s'),

                             ];

                             Attendance::insert($insertData);

                             $others = "Attendance Time Extended (".$attendance_time_extended_data->from_time." - ".$attendance_time_extended_data->to_time.")";

                             serialize_attentance(date('Y-m-d'),'other',$attendance_time_extended_data->user_id,$others,"");

                             $updatedData = [
                                  'status' => $status,
                             ];
  
                             $res = Attendance_time_extended::where('id',$id)->update($updatedData);

                             notification(['user_id' => $attendance_time_extended_data->user_id,
                             'type' => 0,
                             'name' => employee_get_user($attendance_time_extended_data->user_id,'username'),
                             'title' => 'Attendance Time Extended Message' , 
                             'message' => employee_get_user($attendance_time_extended_data->user_id,'username').' '.'Attendance Time Extended Approved'.' '.date('Y-m-d',strtotime($attendance_time_extended_data->updated_at)), 
                             'link'       => URL::to('').'/employees/attendance_time_extended',
                             'created_at' => date('Y-m-d H:i:s')]) ;
                                              

                 }else{
                    Session::flash('error', 'Permission Request Invalid Date !!');
                    return redirect()->back();
                }
            }else{

                     $attendance_time_extended_data = $attendance_time_extended_data->first();

                     if($attendance_time_extended_data->count() != 0){
                      $updatedData = [
                         'status' => $status,
                     ];

                     $res = Attendance_time_extended::where('id',$id)->update($updatedData);


                     notification(['user_id' => $attendance_time_extended_data->user_id,
                     'type' => 0,
                     'name' => employee_get_user($attendance_time_extended_data->user_id,'username'),
                     'title' => 'Attendance Time Extended Message' , 
                     'message' => employee_get_user($attendance_time_extended_data->user_id,'username').' '.'Attendance Time Extended Rejected'.' '.date('Y-m-d',strtotime($attendance_time_extended_data->updated_at)), 
                     'link'       => URL::to('').'/employees/attendance_time_extended',
                     'created_at' => date('Y-m-d H:i:s')]) ;

                 }else{
                     Session::flash('error', 'Attendance Time Extended Request Invalid Date !!');
                     return redirect()->back();
                 }

                 }

        
      

             if($res){
                 Session::flash('success', 'Attendance Time Extended '.$status.' Successfully');
                 return redirect()->back();
             }
             else{
                 Session::flash('error', 'Attendance Time Extended '.$status.' Invalid');
                 return redirect()->back();
             }

      }

      $params = $request->query->all();
   
         $curr_month = date('m');
         $previous_month = date('Y-m', strtotime("-1 month"));
         $startDate = new Carbon($previous_month.'-29');
         $endDate = new Carbon(date('Y-m-'.'30'));

      if(@$params['status'] == 'Pending'){

         $data['attendance_time_extended_request'] =  DB::table('attendance_time_extended')->select('user_id','extend_date','from_time','to_time','hours','attendance_time_extended.status','created_at','id','from_time','to_time','hours','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'attendance_time_extended.user_id')->whereBetween('created_at', [$startDate, $endDate])->where('attendance_time_extended.status','Pending')->orderBy('id', 'desc');
      }else if(@$params['status'] == 'Approved'){
         $data['attendance_time_extended_request'] =  DB::table('attendance_time_extended')->select('user_id','extend_date','from_time','to_time','hours','attendance_time_extended.status','created_at','id','from_time','to_time','hours','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'attendance_time_extended.user_id')->whereBetween('created_at', [$startDate, $endDate])->where('attendance_time_extended.status','Approved')->orderBy('id', 'desc');
      }else{
         $data['attendance_time_extended_request'] =  DB::table('attendance_time_extended')->select('user_id','extend_date','from_time','to_time','hours','attendance_time_extended.status','created_at','id','from_time','to_time','hours','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'attendance_time_extended.user_id')->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
      }

    $data['js_file'] = 'permission';
    $data['title'] = 'Staff Permission Request';
    return view('attendance/attendance_time_extended_request',$data);
}  


public function calculate_monthly_report(Request $request){ 

   $params = $request->query->all();

   if(@$params['month'] != ''){

    $expolde = explode("-",$params['month']);
    $startDates = date('Y-m-29', strtotime(date(@$expolde[0].'-'.@$expolde[1])." -1 month"));

    $endDates = date('Y-m-d',strtotime(date(@$expolde[0].'-'.@$expolde[1].'-28')));

     $data['month_report'] = DB::table('user_info')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.working_hrs','calculate_month_working.id','calculate_month_working.date','calculate_month_working.from_date','calculate_month_working.to_date','calculate_month_working.month_total_days','calculate_month_working.offfice_working_days','calculate_month_working.office_leave_days','calculate_month_working.precent_days','calculate_month_working.low_working_days','calculate_month_working.absend_days','calculate_month_working.cl','calculate_month_working.permission')->rightJoin('calculate_month_working', 'user_info.userid', '=', 'calculate_month_working.user_id')->whereDate('calculate_month_working.from_date',$startDates)->whereDate('calculate_month_working.to_date',$endDates)->where('user_info.status','!=',2)->orderBy('calculate_month_working.id', 'DESC');

   }else{

    $startDates = date('Y-m-29', strtotime(date('Y-m-d')." -1 month"));

    $endDates = date('Y-m-d',strtotime(date('Y-m-28')));
 

    $data['month_report'] = DB::table('user_info')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.working_hrs','calculate_month_working.id','calculate_month_working.date','calculate_month_working.from_date','calculate_month_working.to_date','calculate_month_working.month_total_days','calculate_month_working.offfice_working_days','calculate_month_working.office_leave_days','calculate_month_working.precent_days','calculate_month_working.low_working_days','calculate_month_working.absend_days','calculate_month_working.cl','calculate_month_working.permission')->rightJoin('calculate_month_working', 'user_info.userid', '=', 'calculate_month_working.user_id')->whereDate('calculate_month_working.from_date',$startDates)->whereDate('calculate_month_working.to_date',$endDates)->where('user_info.status','!=',2)->orderBy('calculate_month_working.id', 'DESC');

   }
 
    $data['pick_date'] = (@$params['month']) ? @$expolde[0].'-'.@$expolde[1] : date('Y-m');
    // $data['pick_date'] = (@$params['month']) ? @$params['month'] : date('m');
    $data['js_file'] = 'Cal_month_rep';   
    $data['title'] = 'Calculate Monthly Report';
    return view('attendance/calculate_monthly_report',$data);

}

    public function cal_month_rep_view($id){
        $user_id = encrypt_decrypt('decrypt',$id);
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
       
                $data['cal_month_rep'] = Monthworking::select('user_id')->where('user_id',$user_id)->get();
                $data['calculate_month_days'] = $calculate_month_days;
                $data['employe_month_precent_days'] = $employe_month_precent_days;
                $data['employe_month_low_working_days'] = $employe_month_low_working_days;
                $data['employe_month_absent_days'] = $absend_days;
                $data['office_leave_count'] = $office_leave_count;
                // $data['employe_total_working_days'] = $cal_month_rep->
                $data['user'] = $check_user->first();
                $data['cal_month_rep'] = $cal_month_rep->first();
                $data['user_id'] = $id;
                $data['js_file'] = 'staff';
                $data['title'] = 'Calculate Monthly Report';


                return view('attendance/cal_month_rep_view',$data);

                 

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



