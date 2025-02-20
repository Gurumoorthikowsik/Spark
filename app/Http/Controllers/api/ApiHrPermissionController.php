<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use DB;
use URL;
use App\Models\User;
use App\Models\Permission;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class ApiHrPermissionController extends Controller{  

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
              
    	$user_permission =  User::select('userid','username','email','employee_id')->orderBy('userid', 'desc')->where('user_info.status','!=',2);                    
        if($user_permission->count() != 0){
            $i = 1; 
            $out = [];   
            foreach ($user_permission->get() as $key => $value){

                $persmission = staff_permission_data($value->userid);  $persmission_res = json_decode($persmission);
                $out[$key]['s_no'] = $i;
                $out[$key]['user_id'] = $value->userid;
                $out[$key]['employee_id'] = $value->employee_id;
                $out[$key]['staffname'] =$value->username;
                $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
                $out[$key]['date'] = date('d-M-Y');
                $out[$key]['available'] =(String) $persmission_res->available;
                $out[$key]['pending'] =  (String) $persmission_res->pending;
                $out[$key]['approved'] = (String) $persmission_res->approved;
              $i++;
            }
        }else{
        $out = [];
    }

    return apiResponse(1,'success',['StaffViewPermissionHours' => ($out)? $out : []]);
    }else{
        return apiResponse(0,'Invalid Request Method');
    }

 }


 function permission_request(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
        'user_id' => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
            return apiResponse(0,$errors);
        }

        $params = $request->query->all();
 
        $curr_month = date('m');
        $previous_month = date('Y-m', strtotime("-1 month"));
        $startDate = new Carbon($previous_month.'-29');
        $endDate = new Carbon(date('Y-m-'.'31'));
 
     if(@$params['status'] == 'Pending'){
 
        $permission_request =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->whereBetween('created_at', [$startDate, $endDate])->where('permission.status','Pending')->orderBy('id', 'desc');
     }else if(@$params['status'] == 'Approved'){
        $permission_request =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->whereBetween('created_at', [$startDate, $endDate])->where('permission.status','Approved')->orderBy('id', 'desc');
     }else{
        $permission_request =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
     }
     
    
     if($permission_request->count() != 0){
        $i = 1;
        $out = [];   
        foreach ($permission_request->get() as $key => $value){

            if($value->status == 'Approved'){
                $status = $value->status;
            }elseif($value->status == 'Pending'){
                $status = $value->status;
            }else{
                $status = $value->status;
            }

            if($value->status == 'Pending'){
                $permissionaction = $value->id;
            }else{
                $permissionaction = null;
            }

            $out[$key]['s_no'] = $i;
            $out[$key]['user_id'] = $value->userid;
            $out[$key]['employee_id'] = $value->employee_id;
            $out[$key]['permission_date'] = $value->permission_date;
            $out[$key]['staff_name'] = $value->username;
            $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
            $out[$key]['from_time'] =(String) $value->from_time;
            $out[$key]['to_time'] = (String)$value->to_time;
            $out[$key]['hours'] = (String)$value->hours;
            $out[$key]['reason'] = $value->resion;
            $out[$key]['apply_date'] = $value->created_at;
            $out[$key]['status'] = $status;
            $out[$key]['permission_req_id'] = (String)$permissionaction;
            $i++;  
        }
     }else{
        $out = [];
    }
        return apiResponse(1,'success',['PermissionRequest' =>($out) ? $out : []]);

    }else{
            return apiResponse(0,'Invalid Request Method');
        }
}




 function permission_requestsubmit(Request $request){


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
          'user_id' => 'required',
           'status' => 'required',
           'permission_req_id'=>'required'
       ], [
           'status.required' => 'Please Choose The Date',
       ]);
       if($validator->fails()){
        $errors = $validator->errors()->first();
         return apiResponse(0,$errors);
    }          
      

       $status  = $request['status'];
       $id = $request['permission_req_id']; 

       $permission_data = Permission::select('user_id','permission_date','from_time','to_time','hours','updated_at')->where('id',$id)->where('status','Pending');

               if($status == 'Approved'){
                 
                   
                   
                       if($permission_data->count() != 0){
                           $permission_data = $permission_data->first();

                           if($permission_data->hours == '120'){
                               $hours = '02:00:00';
                           }else if($permission_data->hours == '90'){
                               $hours = '01:30:00';
                           }else if($permission_data->hours == '60'){
                               $hours = '01:00:00';
                           }else{
                               $hours = '00:30:00';
                           }

                           $from_time = date('d-m-Y',strtotime($permission_data->permission_date)).' '.$permission_data->from_time;
                           $to_date = date('d-m-Y',strtotime($permission_data->permission_date)).' '.$permission_data->to_time;

                           $insertData = [
                               'user_id' => $permission_data->user_id,
                               'from_event_id' => 9,
                               'from_event'    => 'Permission',
                               'from_time'     => $from_time,
                               'to_event_id'   => 9,
                               'to_event'      => 'Permission',
                               'to_time'       => $to_date,
                               'date'          => date('Y-m-d',strtotime($permission_data->permission_date)),
                               'hours'         => $hours,
                               'created_at'    =>  date('Y-m-d',strtotime($permission_data->permission_date)).' '.date('H:i:s'),

                           ];

                           Attendance::insert($insertData);

                           $others = "Permission (".$permission_data->from_time." - ".$permission_data->to_time.")";

                           serialize_attentance(date('Y-m-d',strtotime($permission_data->permission_date)),'other',$permission_data->user_id,$others,"");

                           $updatedData = [
                                'status' => $status,
                           ];

                           $res = Permission::where('id',$id)->update($updatedData);

                           notification(['user_id' => $permission_data->user_id,
                           'type' => 0,
                           'name' => employee_get_user($permission_data->user_id,'username'),
                           'title' => 'Permisson Message' , 
                           'message' => employee_get_user($permission_data->user_id,'username').' '.'Permission Approved'.' '.date('Y-m-d',strtotime($permission_data->updated_at)), 
                           'link'       => URL::to('').'/employees/permission',
                           'created_at' => date('Y-m-d H:i:s')]) ;

                       }else{
                        return apiResponse(0, 'Permission Request Invalid Date !!');
                          
                       }
                       

               }else{

                   $permission_data = $permission_data->first();

                   if($permission_data->count() != 0){
                    $updatedData = [
                       'status' => $status,
                   ];

                   $res = Permission::where('id',$id)->update($updatedData);


                   notification(['user_id' => $permission_data->user_id,
                   'type' => 0,
                   'name' => employee_get_user($permission_data->user_id,'username'),
                   'title' => 'Permisson Message' , 
                   'message' => employee_get_user($permission_data->user_id,'username').' '.'Permission Rejected'.' '.date('Y-m-d',strtotime($permission_data->updated_at)), 
                   'link'       => URL::to('').'/employees/permission',
                   'created_at' => date('Y-m-d H:i:s')]) ;

               }else{
                return apiResponse(0, 'Permission Request Invalid Date !!');
                 
               }

               }    

           if($res){
            return apiResponse(1, 'Permission '.$status.' Successfully');
              
           }
           else{
            return apiResponse(0, 'Permission '.$status.' Invalid');
              
           }

    }  
  
}

}


?>