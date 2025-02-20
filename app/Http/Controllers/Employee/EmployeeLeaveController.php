<?php 
namespace App\Http\Controllers\Employee;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;
use URL;
use Session;
use DateTime;
use App\Models\User;
use App\Models\Permission;
use App\Models\Leave;
use Carbon\Carbon;

class EmployeeLeaveController extends Controller
{  

    public function __construct(){

    }
    
    public function index(){

        $data['leave_details'] =  DB::table('leave')->select('user_id','leave_date','day','leave.status','created_at','leave.updated_at','Section','reason','id','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->where('user_id',Session::get("empuser_id"))->orderBy('id', 'desc');

        $data['js_file'] = 'employee-leave';
        $data['title'] = 'Employee Leave Management';
        return view('employee/leave', $data);
    }

    function leave_submit(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

           $validatedData = $request->validate([
                'leave_date' => 'required',
                'day' => 'required',
                'reason' => 'required',
            ], [
                'leave_date.required' => 'Please Choose The Leave Date',
                'day.required' => 'Please Choose The To Time',
                'reason.required' => 'Please Enter The Permission Reason',
            ]);

           $leave_date  = $request['leave_date'];
           $day         = $request['day'];
           $zone        = ($request['zone']) ? $request['zone'] : '';
           $reason      = $request['reason'];

           $user_id = Session::get("empuser_id");
          
            $previous_month = date('Y-m', strtotime("-1 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-'.'31'));

       
           $now = strtotime(date('Y-m-d'));
           if(strtotime($startDate) <= $now && $now <= strtotime($endDate)){
                
           if(strtotime($leave_date) >= strtotime($startDate) && strtotime($leave_date) <= strtotime(date('Y-m-'.'28'))){

             

            $check_leave = Leave::where('leave_date',$leave_date)->Where('day', '0.5')->where('user_id',$user_id)->where('Section',$zone)->where('status','!=','Rejected');

            if($check_leave->count() == 0){
                
                // if(date('d',strtotime($leave_date)) <= date('d')){
                     
                     // staff available leave
                     $leave = staff_leave_data(Session::get("empuser_id"));  
                     $leave_res = json_decode($leave);

                     $available_leave = $leave_res->available;
                   

                     notification(['user_id' => $user_id, 
                     'type' => 1, 
                     'name' => Session::get("empusername"),
                     'title' => 'Leave' ,     
                     'message' => Session::get("empusername").' Request For Leave'.' '.date('Y-m-d'), 
                     'created_at' => date('Y-m-d H:i:s'),       
                     'link'       => URL::to('').'/leave_request?status=Pending',        
                ]) ;

                     if($available_leave >= $day){                        
            
                            $insertData = [
                                'user_id'   => Session::get("empuser_id"),
                                'leave_date'=> $leave_date,
                                'day'       => $day,
                                'reason'    => $reason,
                                'status'    => 'Pending',
                                'Section'   => $zone,
                                'created_at'=> date('Y-m-d H:i:s')
                            ];

                           $Insert = Leave::insert($insertData);

                           if($Insert){
                             $res = ['status' => 1,'msg' => 'Leave Submited Successfully'];
                             echo json_encode($res); die;
                           }else{
                              $res = ['status' => 0,'msg' => 'Leave Submited Invalid !!'];
                              echo json_encode($res); die;
                           }

                     }else{
                        $res = ['status' => 0,'msg' => 'Your Available Leave '.$available_leave.' '.'Days'];
                        echo json_encode($res); die;
                     }  
                } else{
                    $res = ['status' => 0,'msg' => 'Already Apply '.$zone.' Leave'];
                    echo json_encode($res); die;
                    }  

                // }else{
                //     $res = ['status' => 0,'msg' => 'Error. Leave Apply Date Invalid !!'];
                //     echo json_encode($res); die;
                // }

           }else{
                $res = ['status' => 0,'msg' => 'Error. Please date Choose for '.date('Y-M-d',strtotime($startDate)).' to '.date('Y-M-28',strtotime($endDate))];
                echo json_encode($res); die;
           }

       }else{

            $res = ['status' => 0,'msg' => 'Leave Apply this month before 31th'];
            echo json_encode($res); die;
       }

       }
    }

    function delete_leave($id){

        $id = encrypt_decrypt('decrypt',$id);

        $check_permission = Leave::where('status','Pending')->where('id',$id);

            if($check_permission->count() != 0){

                $delete = Leave::where('id', $id)->delete();

                if($delete){
                    Session::flash('success', 'Leave Apply Delete Successfully');
                    return redirect()->back();
                }else{
                     Session::flash('error', 'Leave Apply Delete Invalid !!');
                     return redirect()->back();
                }
        }else{
             Session::flash('error', 'Edit Id Invalid');
             return redirect()->back();
        }

    }


    function leave_notify(Request $request){

        $id = $request->notification_id;

        $get_record = Notification::where('id',$id)->where('status',1);

        if($get_record->count() != 0){

             $res =  Notification::where('id', $id)->update(['status' => 0]);
             if($res){
                 echo json_encode(['status' => 1,'msg' => ($request->link != '') ? (String) $request->link : '']); die;
             }else{
                 echo json_encode(['status' => 0,'msg' => 'Invalid Notification Link']); die;
             }

        }else{
          echo json_encode(['status' => 0,'msg' => 'Invalid Notification Link']); die;
        }
        
 }

}