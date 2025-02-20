<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;
use DB;
use URL;
use App\Models\User;
use App\Models\Leave;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;


class ApiHrLeaveController extends Controller{  

    public function __construct(){
       
    }
    public function index(Request $request){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required'
            ]);
    
            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }          
        $curr_month = date('m');
    	$user_leave = User::select('userid','username','email','employee_id')->where('status','!=',2)->orderBy('userid', 'desc');

     
        if($user_leave->count() != 0){
            $i = 1;
            $out = [];   
            foreach ($user_leave->get() as $key => $value){
                $leave = staff_leave_data($value->userid);  $leave_res = json_decode($leave);
                $out[$key]['s_no'] = $i;
                $out[$key]['user_id'] = $value->userid;
                $out[$key]['employee_id'] = $value->employee_id;
                $out[$key]['staffname'] =$value->username;
                $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
                $out[$key]['available'] = (String) $leave_res->available;
                $out[$key]['pending'] = (String) $leave_res->pending;
                $out[$key]['approved'] = (String) $leave_res->approved;
                $out[$key]['leave_carry_forward'] = (String) $leave_res->approved;
                
                $i++;
            }

        }else{
        $out = [];
    }
        return apiResponse(1,'success',['StaffViewAvailableLeave' => ($out)? $out : []]);
    }  else{
        return apiResponse(0,'Invalid Request Method');
    }
 
    }


    function leave_request(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            ]);
    
            if($validator->fails()){
                $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
            }
            $params = $request->query->all();
       
            $curr_month = date('Y');
            $previous_month = date('Y-m', strtotime("-1 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-'.'31'));
             if(@$params['status'] == 'Pending'){
    
                $leave_request =  DB::table('leave')->select('user_id','leave_date','day','Section','leave.status','created_at','id','day','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->whereYear('created_at','=',$curr_month)->where('leave.status','Pending')->orderBy('id', 'desc');
             }else if(@$params['status'] == 'Approved'){
                $leave_request =  DB::table('leave')->select('user_id','leave_date','day','Section','leave.status','created_at','id','day','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->whereYear('created_at','=',$curr_month)->whereBetween('created_at', [$startDate, $endDate])->where('leave.status','Approved')->orderBy('id', 'desc');
             }else{
                $leave_request =  DB::table('leave')->select('user_id','leave_date','day','Section','leave.status','created_at','id','day','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->whereYear('created_at','=',$curr_month)->orderBy('id', 'desc');
             }

             if($leave_request->count() != 0){
                $i = 1;
                $out = [];   
                foreach ($leave_request->get() as $key => $value){
                    if($value->status == 'Approved'){
                        $status = $value->status;
                    }elseif($value->status == 'Pending'){
                        $status = $value->status;
                    }else{
                        $status = $value->status;
                    }


                    if($value->status == 'Pending'){
                        $leave = $value->id;
                    }else{
                        $leave = null;
                    }
                    $out[$key]['s_no'] = $i;
                    $out[$key]['user_id'] = $value->userid;
                    $out[$key]['employee_id'] = $value->employee_id;
                    $out[$key]['staffname'] =$value->username;
                    $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
                    $out[$key]['leave_date'] = $value->leave_date;
                    $out[$key]['day'] = (String) $value->day;
                    $out[$key]['reason'] = $value->reason;
                    $out[$key]['section'] = (String) $value->Section;
                    $out[$key]['status'] = $status;
                    $out[$key]['apply_date'] = $value->created_at;
                    $out[$key]['leave_req_id'] =(String)  $leave;
                    $i++;
                }
             }else{
            $out = [];
            }
             return apiResponse(1,'success',['StaffLeaveRequest' =>($out) ? $out : []]);
 
          }else{
            return apiResponse(0,'Invalid Request Method');
        }
 
        
   }

   function leave_requestsubmit(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validatedData = $request->validate([
             'user_id' => 'required',
             'status' => 'required',
             'leave_req_id'=>'required'
         ], [
             'status.required' => 'Please Choose Status',
         ]);

         $status  = $request['status'];
         $id = $request['leave_req_id'];  

         $leave_data = Leave::select('user_id','leave_date','day','updated_at')->where('id',$id)->where('status','Pending');

                if($status == 'Approved'){
                   
                    
                    
                        if($leave_data->count() != 0){
                            $leave_data = $leave_data->first();

                            $working_hrs = (employee_get_user($leave_data->user_id,'working_hrs') != '') ? employee_get_user($leave_data->user_id,'working_hrs') : '08:00';

                            if($leave_data->day == '0.5'){

                                if($working_hrs == '12:00'){
                                    $hours = '05:30:00';
                                }else if($working_hrs == '08:00'){
                                    $hours = '04:00:00';
                                }else{
                                    $hours = '04:00:00';
                                }

                            }else{

                                if($working_hrs == '12:00'){
                                    $hours = '12:00:00';
                                }else if($working_hrs == '08:00'){
                                    $hours = '08:00:00';
                                }else{
                                    $hours = '08:00:00';
                                }

                            }

                            $from_time = date('d-m-Y',strtotime($leave_data->leave_date)).' '.'00:00:00';
                            $to_date = date('d-m-Y',strtotime($leave_data->leave_date)).' '.'00:00:00';

                            $insertData = [
                                'user_id' => $leave_data->user_id,
                                'from_event_id' => 10,
                                'from_event'    => 'Leave',
                                'from_time'     => $from_time,
                                'to_event_id'   => 10,
                                'to_event'      => 'Leave',
                                'to_time'       => $to_date,
                                'date'          => date('Y-m-d',strtotime($leave_data->leave_date)),
                                'hours'         => $hours,
                                'created_at'    =>  date('Y-m-d',strtotime($leave_data->leave_date)).' '.date('H:i:s'),

                            ];

                            Attendance::insert($insertData);
                            $updatedData = [
                                 'status' => $status,
                            ];
 
                            $res = Leave::where('id',$id)->update($updatedData); 

                            $day = ($leave_data->day == '0.5') ? 'Half Day' : 'Full Day';
                            $others = $day." Leave (Date : ".$leave_data->leave_date.")";
                            serialize_attentance($leave_data->leave_date,'other',$leave_data->user_id,$others,$hours);

                            notification(['user_id' => $leave_data->user_id,
                            'type' => 0,
                            'name' => employee_get_user($leave_data->user_id,'username'),
                            'title' => 'Permisson Message' , 
                            'message' => employee_get_user($leave_data->user_id,'username').' '.'Leave Approved'.' '.date('Y-m-d',strtotime($leave_data->updated_at)),  
                            'link'       => URL::to('').'/employees/permission',
                            'created_at' => date('Y-m-d H:i:s')]) ;
                                                   

                        }else{
                            return apiResponse(0, 'Leave Request Invalid date');
                           
                        }
                    

                }else{

                    $leave_data = $leave_data->first();

                    $updatedData = [
                         'status' => $status,
                    ];
 
                    $res = Leave::where('id',$id)->update($updatedData);
                    
                    notification(['user_id' => $leave_data->user_id,
                    'type' => 0,
                    'name' => employee_get_user($leave_data->user_id,'username'),
                    'title' => 'Permisson Message' , 
                    'message' => employee_get_user($leave_data->user_id,'username').' '.'Leave Rejected'.' '.date('Y-m-d',strtotime($leave_data->updated_at)), 
                    'link'       => URL::to('').'/employees/permission',
                    'created_at' => date('Y-m-d H:i:s')]) ;

                }

         
             if($res){
                return apiResponse(1, 'Leave '.$status.' Successfully');
                
             }else{
                return apiResponse(0, 'Leave '.$status.' Invalid');
                
             }

      }

     
}

function leave_notify(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'notification_id' => 'required'
           ]);

           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }

    $id = $request->notification_id;

    $get_record = Notification::where('id',$id)->where('status',1);

    if($get_record->count() != 0){

         $res =  Notification::where('id', $id)->update(['status' => 0]);
         if($res){
            return apiResponse( 1,'success'); die;
         }else{
            return apiResponse(0, 'Invalid'); die;
         }

    }else{
        return apiResponse( 0, 'Invalid Notification'); die;
    }
    
}
}


function read_notify(){    
    Notification::where('type',1)->where('status',1)->update(['status' => 0]);
    return redirect()->back();
}

}


?>