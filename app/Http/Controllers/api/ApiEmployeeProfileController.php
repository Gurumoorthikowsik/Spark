<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roll;
use Redirect;
use DB;
use Illuminate\Support\Facades\Validator;


class ApiEmployeeProfileController extends Controller{  

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
            $user = User::where('userid',$user_id)->first();

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
            
           
            return apiResponse(1,'success',$data);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

    }

  
    public function changepassword(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'current_pass' => 'required',
                'new_pass' =>  'required',
                'confirm_pass'=>'required|same:new_pass'
            ], [
                'current_pass.required' => 'Please Enter The Email',
                'new_pass.required' => 'Please Enter The Password',
                'confirm_pass.required' => 'Please Enter The Password'
               ]);
   
               if($validator->fails()){
                   $errors = $validator->errors()->first();
                    return apiResponse(0,$errors);
               }

                $user_id = $request['user_id'];
				$current_pass =encrypt_decrypt('encrypt',$request['current_pass']);
				$new_pass =$request->new_pass;
				$confirm_pass =$request->confirm_pass;

				$check_old_password = User::select('password')->where('userid',$user_id)->where('password',$current_pass);			
				
				if($check_old_password->count() !=0){
					if($new_pass == $confirm_pass){
						$updateData =[
							'password' => encrypt_decrypt('encrypt',$new_pass)		
						];

						User::where('userid',$user_id)->update($updateData);
						
                        return apiResponse(1,'Password Changed Successfully');
					}else{
					
                        return apiResponse(0,'New Password & Confirm Password Not Matching');
						}					
					}else{
				
                    return apiResponse(0,'Current Password Does Not Match');
				}
				
}

    }

 }



?>