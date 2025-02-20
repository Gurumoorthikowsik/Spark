<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Roll;
use App\Models\Report;
use Redirect;
use DB;
use Illuminate\Support\Facades\Validator;


class ApiHrReportController extends Controller{  
    public function __construct(){
       
    }
    



    public function index(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validator = Validator::make($request->all(),[
                'user_id' => 'required'
          
            ]);

            $user_id = $request['user_id'];

            $user = User::select('username','email','position')->where('position','HR')->where('userid', $user_id)->first();
            
    
            $report = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid', $user_id)->orderBy('id', 'desc');
            if($report->count() != 0){
                $i = 1;
                $out = [];  
                foreach ($report->get() as $key => $value){
                    $out[$key]['s_no'] = $i;
                    $out[$key]['employee_id'] = $value->employee_id;
                    $out[$key]['username'] = $value->username;
                    $out[$key]['taskname'] =  $value->task;
                    $out[$key]['description'] =  $value->description;
                    $out[$key]['create_on'] = $value->created_at;
                    $out[$key]['report_action'] = $value->id;

                    $i++;

                }
            }else{
                $out = [];
            }
          
            return apiResponse(1,'success',['Report' => ($out) ? $out : []]);
                       
                        
        }else{
            return apiResponse(0, 'Invalid User!!');
    }
    }


    public function reportsubmit(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'date' => 'required',
                'task' => 'required',
                'role' => 'required',
                'description' => 'required',
              
            ], [
                'date.required' => 'Please Enter Today Date',
                'task.required' => 'Please Enter Today Task',
                'role.required' => 'Please Select Roll',
                'description.required' => 'Please enter Your Task Description',
            ]);
            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
                
                $task = $request['task'];
                $date = date('d-m-Y',strtotime($request['date']));
                $description = $request['description'];
                $user_id = $request['user_id'];

                        $inserData = [
                            'user_id' => $user_id,
                            'task' => $task,
                            'description' => $description,
                            'start_date' => $date.' / '.date('h:i:s:a'),
                            'status' => 'start',
                            'created_at' => date('d-m-Y h:i:s'),
                        ];

                       $res =  Report::insert($inserData);

                       if($res){
                        return apiResponse(1, 'Task Created Successfully');
                           
                       }else{
                        return apiResponse(0, 'Task Created Invalid');
                           
                       }
                        
        }

    }


    function get_edit_report(Request $request){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'report_action'=>'required'
             
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
            $user_id = $request['user_id'];
            $id = $request['report_action'];

        $report = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid', $user_id )->where('id',$id)->first();
        
        if($report){
            $get_date = explode('/',$report->start_date);
            $date = $get_date[0];
            $array = [
                'id' => $report->id,
                'description' => $report->description,
                'task' => $report->task,
                'start_date' => date('Y-m-d',strtotime($date)),
                'status' => 1
            ];

            echo json_encode($array);
        }else{
            $array = [
                'id' => $report->id,
                'description' => $report->description,
                'task' => $report->task,
                'start_date' => $report->start_date,
                'status' => 0
            ];

            echo json_encode($array);
        }
        

    }

}


function edit_working_report(Request $request){

    $validatedData = $request->validate([
           'user_id' => 'required',
           'report_action' => 'required',
           'date' => 'required',
           'task' => 'required',
           'description' => 'required',
       ], [
           'date.required' => 'Please Enter Today Date',
           'task.required' => 'Please Enter Today Task',
           'description.required' => 'Please enter Your Task Description',
       ]);

       $id = $request['report_action'];
       $task = $request['task'];
       $date = $request['date'];
       $description = $request['description'];
       $user_id = $request['user_id'];

       $updateData = [
           'task' => $task,
           'description' => $description,
           'start_date' => date('d-m-Y',strtotime($date)).' / '.date('h:i:s:a'),
           'created_at' => date('d-m-Y h:i:s'),
       ];

      
      $res =  Report::where('id', $id)->update($updateData);

      if($res){
        return apiResponse(1, 'Task Updated Successfully');
          
      }else{
        return apiResponse(0, 'Task Updated Invalid');
          
      }

}

function staff_working_report(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
         'user_id' => 'required',
         'staff_roll_name' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }
        $level = $request['staff_roll_name'];

        if($level == 'all'){
            $employee = User::where('status','!=',2);
        }else{
            $employee = User::where('status','!=',2)->where('position',$level);
        }

    if($employee->count() != 0){
        $i = 1;
        $out = []; 
        foreach ($employee->get() as $key => $value){

            if($value->status == 1){
                $status = 'Active';
            }else{
                $status = 'Deactive'; 
            }

            $out[$key]['s_no'] = $i;
            $out[$key]['employee_id'] = $value->employee_id;
            $out[$key]['username'] =$value->username;
            $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
            $out[$key]['status'] = $status;
            $out[$key]['workingreport_action'] =$value->userid;
            $i++;
        }

    }else{
        $out = [];
    }
    return apiResponse(1,'success',['staffReport' => ($out)? $out : []]);
    }else{
        return apiResponse(0,'Invalid Request Method');
    }
}

function view_staff_working(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
         'user_id' => 'required',
         'visit_user_id' => 'required',

        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }

    $userID = $request['user_id'];

    $user_id = $request['visit_user_id'];

    $roll = Roll::select('roll','sort_name')->where('status',1)->get();

    $report = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid',$user_id)->orderBy('id', 'desc');

    $userid = $userID;
    $dec_user_id= $user_id;

    $staffview_workingreport = [
        'name' => get_user($dec_user_id,'username'),
        'email' =>encrypt_decrypt('decrypt',get_user($dec_user_id,'email'))
      
    ];
    
    if($report->count() != 0){
        $i = 1;
        $out = []; 
        foreach ($report->get() as $key => $value){
            $out[$key]['s_no'] = $i;
            $out[$key]['employee_id'] = $value->employee_id;
            $out[$key]['username'] = $value->username;
            $out[$key]['taskname'] = $value->task;
            $out[$key]['description'] = $value->description;
            $out[$key]['created_on'] = $value->created_at;


            $i++; 

        }
    }else{
        $out = [];
    }
  
    return apiResponse(1,'success',['StaffViewWorkingReport' => $staffview_workingreport,'viewReport' => ($out)? $out : []]);

    }else{
        return apiResponse(0,'Invalid Request Method');
    }

}




function staff_working_roll(Request $request,$level=""){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required'
            
   
           ]);
   
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }

    $roll = Roll::select('roll','sort_name')->where('status',1)->get();
    $params = $level;
    $out = []; 
    foreach ($roll as $key => $value)	{
        $count_roll = DB::table('user_info')->where('status' ,'!=',2)->where('position',$value->sort_name)->count();

        $out[$key]['sort_name'] = $value->sort_name;
        $out[$key]['StaffRoll'] = $value->roll;
        $out[$key]['Count'] =$count_roll;

    }

    return apiResponse(1,'success',['viewStaffRoll' => ($out)? $out : []]);
    }else{
        return apiResponse(0,'Invalid Request Method');
    }
}




}

?>