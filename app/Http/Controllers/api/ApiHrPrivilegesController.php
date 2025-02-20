<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Privileges;
use Redirect;
use Illuminate\Support\Facades\Validator;


class ApiHrPrivilegesController extends Controller{  

    public function __construct(){
       
    }
    
    public function index(Request $request){
        
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

    	$employee = User::where('status', '!=',2)->where('position','HR');

        if($employee->count() != 0){

            $i = 1;
            $out = [];  
            foreach ($employee->get() as $key => $value){

                $access = 'no';

                if(get_user($request['user_id'],'main_access') == 1 || page_access($request['user_id'],'edit_Privileges') == 1){
                    if($request['user_id'] != $value->userid && get_user($value->userid,'main_access') != 1){

                        $access = 'yes';
                    }
                }

                if($value->status == 1){
                    $status='Active';
                }else{
                    $status='Deactive';
                }

                $out[$key]['s_no'] = $i;
                $out[$key]['visit_user_id'] = $value->userid;
                $out[$key]['employee_id'] = $value->employee_id;
                $out[$key]['username'] = $value->username;
                $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
                $out[$key]['roll'] = get_roll($value->position);
                $out[$key]['createdate'] = date("d-M-Y",strtotime($value->created_date));
                $out[$key]['status'] =  $status;
                $out[$key]['edit_id'] = encrypt_decrypt('encrypt',$value->userid);
                $out[$key]['privileges_submit_access'] = $access;
              
                $i++;

            }
        }else{
            $out = [];
        }
        
    
        return apiResponse(1,'success',['privileges_hr_list' => ($out) ? $out : []]);


    }else{
        return apiResponse(0,'Invalid Request Method');
    }

}


public function privilegestype(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        $access = Privileges::where('status',1)->get();

        $out = [];   
        foreach ($access as $key => $value) {

            $out[$key]['privileges']   =  str_replace('_', ' ',$value->privileges);
            $out[$key]['view_access']  = 'view_'.$value->privileges;
            $out[$key]['edit_access']  = 'edit_'.$value->privileges;
            $out[$key]['status']  = $value->status;
            $out[$key]['view']  = $value->view;
            $out[$key]['edit']  = $value->edit;

        }

        return apiResponse(1,'success',['privilegeslist' => $out]);
    }
}
   
public function hr_get_access_options(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
         'user_id' => 'required',
         'visit_user_id'=>'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }

        $user_id = $request['visit_user_id'];

        $check_user = User::where('status', '!=',2)->where('position','HR')->where('userid',$user_id);

        if($check_user->count() != 0){

            $access = Privileges::where('status',1)->get();

            $i = 1;
            $out = [];  
            foreach ($access as $key => $value){
                
                $out[$key]['Privileges'] = str_replace('_', ' ',$value->privileges);
                $out[$key]['view_access'] = (page_access($user_id,'view_'.$value->privileges) == 1) ? 'view_'.$value->privileges : null;
                $out[$key]['edit_access'] = (page_access($user_id,'edit_'.$value->privileges) == 1) ? 'edit_'.$value->privileges : null;

                // if($value->view == 1){
                //     $view= (page_access($user_id,'view_'.$value->privileges) == 1) ? 'view_'.$value->privileges : ''; 
                // }elseif($value->view == 0){
                //     $view= '--';
                // }
                // if($value->edit == 1){
                //     $edit = (page_access($user_id,'edit_'.$value->privileges) == 1) ? 'edit_'.$value->privileges : '';
                // }elseif($value->edit == 0){
                //     $edit= '--';
                // }
                // $out[$key]['s_no'] = $i;
                // $out[$key]['privileges'] = str_replace('_', ' ',$value->privileges);
                // $out[$key]['view'] = $view;
                // $out[$key]['edit'] =  $edit;
              
                $i++;
            }  

    }else{
        $out = [];
    }	
    return apiResponse(1,'success',['hr_get_access_options' => ($out) ? $out : []]);	
     
    }else{
        return apiResponse(0, 'Invalid User!!');
}
}



function submit_access_options(Request $request){



    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'visit_user_id'=>'required'
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }

        $user_id = $request['visit_user_id'];

        $check_user = User::where('status', '!=',2)->where('position','HR')->where('userid',$user_id);

        if($check_user->count() == 0){
            return apiResponse(0, 'Invalid visit ID!!');
        }


        $view = ($request['view']) ? $request['view'] : [];
        $edit = ($request['edit']) ? $request['edit'] : [];

        $compain = array_merge($view,$edit);
        $res = serialize($compain);

        $updateData = [
            'page_access' => $res
        ];

        $Update = User::where('userid', $user_id)->update($updateData);

        if($Update){
            return apiResponse(1, 'Page Access Added Successfully');
    
        }else{
            return apiResponse(0, 'Page Access Added Invalid!!');
           
        }
        
    }
}


function employee_profile(Request $request){

     if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

            $user_id = $request['user_id'];
            $user = User::where('status', '!=',2)->where('position','HR')->where('userid',$user_id)->first();

            if($user->count() != 0){

                $data['employee_id'] = $user->employee_id;
                $data['employee_name'] = $user->username;
                $data['employee_email'] = encrypt_decrypt('decrypt',$user->email);
                $data['personal_email'] = $user->personal_email;
                $data['blood_group'] = $user->blood_group;
                $data['date_of_birth'] = $user->date_birth;
                $data['permanent_address'] = $user->address;
                $data['employee_roll'] = ucwords($user->position);
                $data['designation'] = ucwords($user->designation);
                $data['department'] = $user->department;
                $data['date_of_joining'] = $user->date_join;
                $data['offical_mail_id'] = $user->official_mail;
                $data['daily_compete_working_hrs'] = ($user->working_hrs) ? $user->working_hrs : '08:00';
            


                $access = Privileges::where('status',1)->get();

                $i = 1;
                $out = [];  
                foreach ($access as $key => $value){

                    $checking_view = privileges_get_view($value->id);

                    if($checking_view == 1){
                       $view_access = (page_access($user_id,'view_'.$value->privileges) == 1) ? 1 : 0;
                    }else{
                       $view_access = null;

                    }

                    $checking_edit = privileges_get_edit($value->id);

                    if($checking_edit == 1){
                        $edit_access = (page_access($user_id,'edit_'.$value->privileges) == 1) ? 1 : 0;
                    }else{
                        $edit_access = null;
                    }

                    $out[$key]['Privileges'] = str_replace('_', ' ',$value->privileges);
                    $out[$key]['view_access'] = $view_access;
                    $out[$key]['edit_access'] = $edit_access;
                    $i++;
                }  


                return apiResponse(1,'success',['hr_details' => $data,'privileges' => ($out) ? $out : []]);

           }else{
                return apiResponse(0, 'Invalid User!!');

           }

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

}






 }



?>