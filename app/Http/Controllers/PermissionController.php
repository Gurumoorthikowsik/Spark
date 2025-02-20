<?php 
namespace App\Http\Controllers;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\Models\Event;
use DB;
use URL;
use Session;
use App\Models\User;
use App\Models\Permission;
use App\Models\Attendance;
use Carbon\Carbon;

class PermissionController extends Controller{

	public function __construct(){
       
    }
    
    public function index(Request $request){             
              
    	$data['user_permission'] =  User::select('userid','username','email','employee_id')->orderBy('userid', 'desc')->where('user_info.status','!=',2);                    
        $data['js_file'] = 'permission';
        $data['title'] = 'Permission Management';      
        return view('permission/staff_permission',$data);
    }

    

    function permission_request(Request $request){


         if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $validatedData = $request->validate([
                'status' => 'required',
            ], [
                'status.required' => 'Please Choose The Date',
            ]);

            $status  = $request['status'];
            $id = $request['id']; 

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
                                Session::flash('error', 'Permission Request Invalid Date !!');
                                return redirect()->back();
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
                        Session::flash('error', 'Permission Request Invalid Date !!');
                        return redirect()->back();
                    }

                    }

           
         

                if($res){
                    Session::flash('success', 'Permission '.$status.' Successfully');
                    return redirect()->back();
                }
                else{
                    Session::flash('error', 'Permission '.$status.' Invalid');
                    return redirect()->back();
                }

         }

         $params = $request->query->all();
      
            $curr_month = date('m');
            $previous_month = date('Y-m', strtotime("-1 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-'.'31'));

         if(@$params['status'] == 'Pending'){

            $data['permission_request'] =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->whereBetween('created_at', [$startDate, $endDate])->where('permission.status','Pending')->orderBy('id', 'desc');
         }else if(@$params['status'] == 'Approved'){
            $data['permission_request'] =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->whereBetween('created_at', [$startDate, $endDate])->where('permission.status','Approved')->orderBy('id', 'desc');
         }else{
            $data['permission_request'] =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc');
         }
        

        $data['js_file'] = 'permission';
        $data['title'] = 'Staff Permission Request';
        return view('permission/permission_request',$data);
    }
}  


// DB::table('permission')->select('id','user_id','from_time','to_time','hours','permission.status','created_at')->whereMonth('created_at','=',$curr_month)->orderBy('id', 'desc')->get();
// $data['user_permission'] =  DB::table('permission')->select('user_id','from_time','to_time','hours','permission.status','created_at','userid','email','username','employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'permission.user_id')->whereMonth('created_at','=',$curr_month)->orWhere('created_at',Null)->orderBy('userid', 'desc')->get();

// $data['user_permission'] =  DB::table('permission')->select('user_id','from_time','to_time','hours','permission.status','created_at','userid','email','username','employee_id')->rightJoin('user_info', 'user_info.userid', '=', 'permission.user_id')->orderBy('userid', 'desc')->get();