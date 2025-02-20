<?php 
namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
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

class EmployeeAttendanceController extends Controller{  

    public function __construct(){

    }
 

   public function working_calendar(Request $request,$userID=""){

        $data['js_file'] = '';
        $data['title'] = 'Working Hours Calendar';
        return view('attendance/working_calendar',$data);
    }


    function attendance(Request $request){




       try {
           
        if($_SERVER['REQUEST_METHOD'] === 'POST'){


           $validatedData = $request->validate([
                'event' => 'required',
            ], [
                'event.required' => 'Choose Attendance Event',
            ]);

            $user_id    = emp_user_id();
            $event      = $request['event'];
            $event_name = get_event($event);
            $date_time  = date('Y-m-d H:i:s');
            $today_date  = date('Y-m-d');
            $today_date_qry  = date('d-m-Y');
            $date_time_event  = date('d-m-Y H:i:s');   

            

                                  
            $res = Attendance::where('user_id', emp_user_id())->whereNotIn('from_event_id', [9,10,11])->Where('from_time', 'like', '%' . $today_date_qry . '%');
 

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

                                                       
     
                    serialize_attentance($today_date,$event,$user_id,$date_time_event,"");

                    $out = Attendance::insert($InsertDate);


                    if($out){
                        $res = ['status' => 1,'msg' => $event_name.' Time Added Successfully'];



                        notification([
                             'user_id' => Session::get("empuser_id"), 
                             'type' => 1, 
                             'name' => Session::get("empusername"),
                             'title' => 'Attendance Opened' ,     
                             'message' => Session::get("empusername").' '.'Attendance Opened'.' '.date('Y-m-d'), 
                             'created_at' => date('Y-m-d H:i:s'),       
                             'link'       => '',        
                        ]) ;



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
              
                    $check_in_event = Attendance::where('user_id', emp_user_id())->Where('date', $today_date)->where('from_event_id',$event);

                    if($check_in_event->count() == 0){

                        $check_out_event = Attendance::where('user_id', emp_user_id())->Where('date', $today_date)->whereNotIn('from_event_id', [9,10,11])->limit(1)->orderBy('id','DESC')->first();
                    
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

                            
                        notification([
                             'user_id' => Session::get("empuser_id"), 
                             'type' => 1, 
                             'name' => Session::get("empusername"),
                             'title' => 'Attendance Closed' ,     
                             'message' => Session::get("empusername").' '.'Attendance Closed'.' '.date('Y-m-d'), 
                             'created_at' => date('Y-m-d H:i:s'),       
                             'link'       => '',        
                        ]) ;



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

                    $check_out_event = Attendance::where('user_id', emp_user_id())->Where('date',$today_date)->where('to_event_id',$event);

                    if($check_out_event->count() == 0){

                        $check_out_event = Attendance::where('user_id', emp_user_id())->Where('date', $today_date)->whereNotIn('from_event_id', [9,10,11])->limit(1)->orderBy('id','DESC')->first();


                        if($check_out_event->to_event_id != ''){
                            $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($check_out_event->to_event_id)->type.' Event'];
                            echo json_encode($res) ; die;
                        }

                        if(get_next_event($check_out_event->from_event_id)->id != $event){
                            $res = ['status' => 0,'msg' => 'Please Choose '.get_next_event($check_out_event->from_event_id)->type.' Event'];
                            echo json_encode($res) ; die;
                        }

                        $get_out_event = Attendance::select('id','from_time')->where('user_id', emp_user_id())->Where('date',$today_date)->orderBy('id','desc')->whereNotIn('from_event_id', [9,10,11])->limit(1)->first();
                            
                            $hours_cal = hours_cal($get_out_event->from_time,$date_time);
                            $out_UpdateData = [
                                'to_event_id' => $event,
                                'to_event' => $event_name,
                                'to_time' => $date_time_event,                               
                                'hours' => $hours_cal, 
                                'date' => $today_date,
                            ];                            
                            
                            
                        $out = Attendance::where('id', $get_out_event->id)->where('user_id',emp_user_id())->update($out_UpdateData);
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
                    $check_exit_event = Attendance::where('user_id', emp_user_id())->Where('date',$today_date)->where('to_event_id',$event);
                    if($check_exit_event->count() == 0){


                        $get_exit_event = Attendance::select('id','from_time','to_event_id','from_event_id')->where('user_id', emp_user_id())->Where('date',$today_date)->orderBy('id','desc')->whereNotIn('from_event_id', [9,10,11])->limit(1)->first();

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
                                  
                                    $out = Attendance::where('id', $get_exit_event->id)->where('user_id',emp_user_id())->update($exit_UpdateData);
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

        $previous_month = date('Y-m', strtotime("-6 month"));
        $startDate = new Carbon(date('Y-m-d'));
        $endDate = new Carbon(date('Y-m-'.'31'));

        $user_id = emp_user_id();
        $data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();

        if($startDate == $endDate){         
            $where = $startDate;
            $data['employee'] = Attendance::where('user_id',$user_id)->whereDate('created_at', $where)->orderBy('created_at','DESC');                        
        }else{            
            $where = [$startDate, $endDate];
            $data['employee'] = Attendance::where('user_id',$user_id)->whereBetween('created_at', $where)->orderBy('created_at','DESC');                        
        }

    } catch (\Exception $e) {
            
        $res = ['status' => 0,'msg' => "----------->" . $e ];
        echo json_encode($res) ; die;
        }

    
   
        $data['event'] = Event::select('id','type')->where('status',1)->get();
        $data['js_file'] = 'employee_attendance';
        $data['title'] = 'Entry Attendance';
        return view('employee/make_attendance',$data);

    }


    function daily_working_hrs(Request $request){



        $user_id = emp_user_id();
    
        $previous_month = date('Y-m', strtotime("-2 month"));
        $startDate = new Carbon($previous_month.'-29');
        $endDate = new Carbon(date('Y-m-d'));
       


        $all_dates = array();
        while ($startDate->lte($endDate)){
          $all_dates[] = $startDate->toDateString();

          $startDate->addDay();
        }

        // $previous_month = date('Y-m', strtotime("-1 month"));
        // $startDate = new Carbon($previous_month.'-28');
        // $endDate = new Carbon(date('Y-m-30'));
      

       // $festival_leave = Leavedays::select('leave_date')->whereBetween('leave_date', [$startDate, $endDate])->get();
       // $festival= []; 

       // foreach ($festival_leave as $key => $value) {
       //      $festival[$key] = date('Y-m-d',strtotime($value->leave_date));
       // }

       //  $leavedays = month_year_sunday();
       //  $total_festival = array_merge($leavedays,$festival);

       //  $data['leave_days'] = $total_festival();

        $data['get_month'] = $all_dates;

        $data['dec_user_id']= $user_id;
        $data['js_file'] = 'attendance';
        $data['title'] = 'View Daily Working Hours';
        return view('employee/daily_working_hours',$data);
    }

    function attendance_time_extended(Request $request){       
        
         $data['attendance_time_extended'] =  DB::table('attendance_time_extended')->select('user_id','extend_date','from_time','to_time','hours','attendance_time_extended.status','created_at','attendance_time_extended.updated_at','id','from_time','to_time','hours','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'attendance_time_extended.user_id')->where('user_id',Session::get("empuser_id"))->orderBy('id', 'desc');

        $data['js_file'] = 'employee_attendance_time_extended';
        $data['title'] = 'Employee Permission Management';
        return view('employee/attendance_time_extended',$data);
    }

    function attendance_time_extended_submit(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

           $validatedData = $request->validate([
                'from_time' => 'required',
                'to_time' => 'required',
                'reason' => 'required',
            ], [
                'from_time.required' => 'Please Choose The From Time',
                'to_time.required' => 'Please Choose The To Time',
                'reason.required' => 'Please Enter The Permission Reason',
            ]);

            $pick_date = preg_split('/\s+/', $request['from_time']);
            $extend_date  = date('Y-m-d',strtotime($pick_date[0])); //$request['permission_date'];
            $from_time  = $request['from_time'];
            $to_time  = $request['to_time'];
            $reason  = $request['reason'];   
            
            if($from_time >= $to_time){
                $res = ['status' => 0,'msg' => 'Incorrect Time Format.From And To Time Mismatch !!'];
                echo json_encode($res); die;
            }

            $from_time_split = preg_split('/\s+/', $from_time);
            $to_time_split = preg_split('/\s+/', $to_time);

            $from_time_min = strtotime($from_time_split[1]);
            $to_time_min = strtotime($to_time_split[1]);
            $get_minutes = round(abs($to_time_min - $from_time_min) / 60,2);    



                        $insertData = [
                            'user_id'   => Session::get("empuser_id"),
                            'extend_date' => $extend_date,
                            'from_time' => $from_time_split[1],
                            'to_time'   => $to_time_split[1],
                            'hours'     => $get_minutes,
                            'reason'    => $reason,
                            'created_at'=> date('Y-m-d H:i:s')
                        ];

                       $Insert = Attendance_time_extended::insert($insertData);
                       
                         notification([
                             'user_id' => Session::get("empuser_id"), 
                             'type' => 1, 
                             'name' => Session::get("empusername"),
                             'title' => 'Attendance Time Extend' ,     
                             'message' => Session::get("empusername").' '.'Attendance Time Extend'.' '.date('Y-m-d'), 
                             'created_at' => date('Y-m-d H:i:s'),       
                             'link'       => URL::to('').'/attendance_time_extended_request?status=Pending',        
                        ]) ;
                       if($Insert){
                         $res = ['status' => 1,'msg' => 'Attendance Time Extend Submited Successfully'];
                         echo json_encode($res); die;
                       }else{
                          $res = ['status' => 0,'msg' => 'Attendance Time Extend Submited Invalid !!'];
                          echo json_encode($res); die;
                       }                     
                   
         }

    }    

    function delete_attendance_time_extended($id){

        $id = encrypt_decrypt('decrypt',$id);

        $check_permission = Attendance_time_extended::where('status','Pending')->where('id',$id);

            if($check_permission->count() != 0){

                $delete = Attendance_time_extended::where('id', $id)->delete();

                if($delete){
                    Session::flash('success', 'Attendance Time Extend Delete Successfully');
                    return redirect()->back();
                }else{
                     Session::flash('error', 'Attendance Time Extend Delete Invalid !!');
                     return redirect()->back();
                }
            }else{
                 Session::flash('error', 'Edit Id Invalid');
                 return redirect()->back();
            }
    }


}


?>
