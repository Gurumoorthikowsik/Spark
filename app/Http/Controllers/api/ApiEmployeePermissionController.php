<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;
use URL;
use App\Models\User;
use App\Models\Permission;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ApiEmployeePermissionController extends Controller{  

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

            $persmission = staff_permission_data($user_id);  $persmission_res = json_decode($persmission);
            $available_permission = [
                'name' =>  get_user($user_id,'username'),
                'email_id' => encrypt_decrypt("decrypt",get_user($user_id,'email')),
                'month_year' => date('M / Y'),
                'available_permission' => $persmission_res->available,
                'pending_permission' => $persmission_res->pending,
                'approved_permission' => $persmission_res->approved
            ];
            
            
            
            
            $permission_details=   DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','permission.updated_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->where('user_id', $user_id)->orderBy('id', 'desc');
           
            $i = 1;
            $out = [];   
            
           
        
            foreach ($permission_details->get() as $key => $value) {

                $out[$key]['s_no'] = $i;
                $out[$key]['permission_date'] = $value->permission_date;
                $out[$key]['from_time'] = $value->from_time;
                $out[$key]['to_time'] = $value->to_time;
                $out[$key]['hours'] = $value->hours;
                $out[$key]['reason'] = $value->resion;
                $out[$key]['apply_date'] =  $value->created_at;
                $out[$key]['status'] = $value->status;
                $out[$key]['approved_date'] = $value->updated_at;
                $out[$key]['delete_id'] = encrypt_decrypt('encrypt',$value->id);
                
                $i++;
              }
             
           
            return apiResponse(1,'success',['this_month_available_permission' => $available_permission,'apply_permission' => ($out) ? $out : []]);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }


    }

    function permissionsubmit(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'from_time' => 'required',
                'to_time' => 'required',
                'reason' => 'required',
            ], [
                'from_time.required' => 'Please Choose The From Time',
                'to_time.required' => 'Please Choose The To Time',
                'reason.required' => 'Please Enter The Permission Reason',
            ]);
            
              if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

                $pick_date = preg_split('/\s+/', $request['from_time']);
                $permission_date  = date('Y-m-d',strtotime($pick_date[0])); //$request['permission_date'];
                $from_time  = $request['from_time'];
                $to_time  = $request['to_time'];
                
                $reason  = $request['reason'];

                if($from_time >= $to_time){
                    return apiResponse ( 0,'Incorrect Time Format.From And To Time Mismatch !!');
                    
                }

                $from_time_split = preg_split('/\s+/', $from_time);
                $to_time_split = preg_split('/\s+/', $to_time);


                if($from_time_split[0] != $to_time_split[0]){
                    return apiResponse ( 0,'From And to Date Wrong');
                   
                }

                if($from_time_split[1] > $to_time_split[1]){
                    return apiResponse ( 0, 'Choose Permission Time Is Wrong !!');
                 
                }

                    $previous_month = date('Y-m', strtotime("-1 month"));
                    $startDate = new Carbon($previous_month.'-29');
                    $endDate = new Carbon(date('Y-m-'.'31'));

                    $now = strtotime(date('Y-m-d'));
                    if(strtotime($startDate) <= $now && $now <= strtotime($endDate)){

                     if(strtotime($to_time_split[0]) >= strtotime($startDate) && strtotime($to_time_split[0]) <= strtotime(date('Y-m-'.'28'))){

                    // choose to min convertion
                    $from_time_min = strtotime($from_time_split[1]);
                    $to_time_min = strtotime($to_time_split[1]);
                    $get_minutes = round(abs($to_time_min - $from_time_min) / 60,2);
                    $user_id = $request['user_id'];

                     // staff available permission time
                     $persmission = staff_permission_data($user_id);  
                     $persmission_res = json_decode($persmission);    

                    //  $user_id = Session::get("empuser_id");

                 if(in_array($get_minutes, ['120']) == 1){

                    $available_permission = $persmission_res->available;

                    if($available_permission >= $get_minutes){

                        $insertData = [
                            'user_id'   =>  $user_id,
                            'permission_date' => $permission_date,
                            'from_time' => $from_time_split[1],
                            'to_time'   => $to_time_split[1],
                            'hours'     => $get_minutes,
                            'resion'    => $reason,
                            'created_at'=> date('Y-m-d H:i:s')
                        ];

                       $Insert = Permission::insert($insertData);
                       
                         notification([
                             'user_id' => $user_id, 
                             'type' => 1, 
                             'name' => get_user($user_id,'username'),
                             'title' => 'Permission' ,     
                             'message' => get_user($user_id,'username').' Request For Permission'.' '.date('Y-m-d'), 
                             'created_at' => date('Y-m-d H:i:s'),       
                             'link'       => URL::to('').'/permission_request?status=Pending',        
                        ]) ;
                       if($Insert){
                        return apiResponse(1, 'Permission Submited Successfully');
                         
                       }else{
                        return apiResponse (0, 'Permission Submited Invalid !!');
                         
                       }
                       

                    }else{
                        return apiResponse ( 0, 'Your Available Permission '.$available_permission.' Minutes');
                        
                    }

                 }else{
                    return apiResponse( 0, 'The Minimum Of permit Taken Is 120 Min');
                    
                 }

                 }else{
                    $res = ['status' => 0,'msg' => 'Error. Permission apply choose date '.date('Y-M-d',strtotime($startDate)).' to '.date('Y-M-28',strtotime($endDate))];
                    echo json_encode($res); die;
              }

             }else{

            $res = ['status' => 0,'msg' => 'Permission Apply this month before 31th'];
            echo json_encode($res); die;
         }


         }

    }



    function deletepermission(Request $request){


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

        $check_permission = Permission::where('status','Pending')->where('id',$id);

            if($check_permission->count() != 0){

                $delete = Permission::where('id', $id)->delete();

                if($delete){
                    return apiResponse(1, 'Permission Delete Successfully');
                    
                }else{
                    return apiResponse(0, 'Permission Delete Invalid !!');
                    
                }
            }else{
                return apiResponse(0, 'Edit Id Invalid');
                
            }
    }
}



function permissionnotify(Request $request){
    
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
            return apiResponse( 1, 'success'); die;
         }else{
            return apiResponse( 0, 'Invalid '); die;
         }

    }else{
        return apiResponse( 0, 'Invalid Notification'); die;
    }
    
}

}


   
 }



?>