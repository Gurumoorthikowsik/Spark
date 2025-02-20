<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use DB;
use URL;
use Session;
use DateTime;
use App\Models\User;
use App\Models\Permission;
use App\Models\Notification;
use App\Models\Leave;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;


class ApiEmployeeLeaveController extends Controller{  

    public function __construct(){
       
    }

    
    public function index(Request $request ){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

            $user_id = $request['user_id'];

            $leave = staff_leave_data($user_id);  $leave_res = json_decode($leave);

            $available_leave = [
                'name' =>  get_user($user_id,'username'),
                'email_id' => encrypt_decrypt("decrypt",get_user($user_id,'email')),
                'month_year' => date('M / Y'),
                'available_leave' => (String) $leave_res->available,
                'pending_leave' => (String) $leave_res->pending,
                'approved_leave' => (String) $leave_res->approved
            ];
            
            
            
            
            $leave_details=  DB::table('leave')->select('user_id','leave_date','day','leave.status','created_at','leave.updated_at','Section','reason','id','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->where('user_id',$user_id)->orderBy('id', 'desc');
           
            $i = 1;
            $out = [];   
        
            foreach ($leave_details->get() as $key => $value) {

                $out[$key]['s_no'] = $i;
                $out[$key]['leavedate'] = $value->leave_date;
                $out[$key]['day'] = ($value->day == 1) ? 'Full Day' : 'Half Day';
                $out[$key]['zone'] = ($value->day == 1) ? '--' : $value->Section;
                $out[$key]['reason'] = $value->reason;
                $out[$key]['apply_date'] = $value->created_at;
                $out[$key]['status'] =  $value->status;
                $out[$key]['approved_date'] = $value->updated_at;
                $out[$key]['delete_id'] = encrypt_decrypt('encrypt',$value->id);
                
                $i++;
              }
            
           
            return apiResponse(1,'success',['this_month_available_leave' => $available_leave,'apply_leave' => ($out) ? $out : []]);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

    }

  
    function leavesubmit(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'leave_date' => 'required',
                'day' => 'required',
                'zone'=> 'required',
                'reason' => 'required',
            ], [
                'leave_date.required' => 'Please Choose The Leave Date',
                'day.required' => 'Please Choose The To Time',
                'zone.required' => 'Please Choose The To day',
                'reason.required' => 'Please Enter The Permission Reason',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

           $leave_date  = $request['leave_date'];
           $day         = $request['day'];
           $zone        = ($request['zone']) ? $request['zone'] : '';
           $reason      = $request['reason'];

           $user_id = $request['user_id'];
          
            $previous_month = date('Y-m', strtotime("-1 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-'.'31'));

           $now = strtotime(date('Y-m-d'));
           if(strtotime($startDate) <= $now && $now <= strtotime($endDate)){
                
                if(strtotime($leave_date) >= strtotime($startDate) && strtotime($leave_date) <= strtotime(date('Y-m-'.'28'))){

                $check_leave = Leave::where('leave_date',$leave_date)->Where('day', '0.5')->where('user_id',$user_id)->where('Section',$zone)->where('status','!=','Rejected');


            if($check_leave->count() == 0){
                     
                     // staff available leave
                     $leave = staff_leave_data($user_id);  
                     $leave_res = json_decode($leave);

                     $available_leave = $leave_res->available;

                     notification(['user_id' => $user_id, 
                     'type' => 1, 
                     'name' => get_user($user_id,'username'),
                     'title' => 'Leave' ,     
                     'message' => get_user($user_id,'username').' Request For Leave'.' '.date('Y-m-d'), 
                     'created_at' => date('Y-m-d H:i:s'),       
                     'link'       => URL::to('').'/leave_request?status=Pending',        
                ]) ;

                     if($available_leave >= $day){

                            $insertData = [
                                'user_id'   => $user_id,
                                'leave_date'=> $leave_date,
                                'day'       => $day,
                                'reason'    => $reason,
                                'status'    => 'Pending',
                                'Section'   => $zone,
                                'created_at'=> date('Y-m-d H:i:s')
                            ];

                           $Insert = Leave::insert($insertData);

                           if($Insert){
                            return apiResponse ( 1, 'Leave Submited Successfully');
                             
                           }else{
                            return apiResponse (0,'Leave Submited Invalid !!');
                              
                           }

                     }else{
                        return apiResponse( 0, 'Your Available Leave '.$available_leave.' '.'Days');
                       
                     }   

                    }else{

                    return apiResponse (0,'Already Apply '.$zone.' Leave');
                }  

           }else{

                return apiResponse (0,'Error. Please date Choose for '.date('Y-M-d',strtotime($startDate)).' to '.date('Y-M-28',strtotime($endDate)));
           }

       }else{
            return apiResponse (0,'Leave Apply date this month 31 th');
       }

       }
    }
    function deleteleave(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'delete_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
            }    
            
        $id = encrypt_decrypt('decrypt',$request['delete_id']);

        $check_permission = Leave::where('status','Pending')->where('id',$id);

            if($check_permission->count() != 0){

                $delete = Leave::where('id', $id)->delete();

                if($delete){
                    return apiResponse(1, 'Leave Apply Delete Successfully');
                 
                }else{
                    return apiResponse(0, 'Leave Apply Delete Invalid !!');
                   
                }
        }else{
            return apiResponse(0, 'Edit Id Invalid');
             
        }

    }

    }

    

    function leavenotify(Request $request){


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

 }



?>