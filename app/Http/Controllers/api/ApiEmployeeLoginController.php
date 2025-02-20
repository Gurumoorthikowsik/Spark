<?php 
namespace App\Http\Controllers\api;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Session;
use App\Models\User;

class ApiEmployeeLoginController extends Controller{  

    public function __construct(){

    }
    


    public function login(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),
            [
             'email' => 'required',
             'password' => 'required',
            ],[
            'email.required' => 'Please Enter The Email',
            'password.required' => 'Please Enter The Password'
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

            $email = encrypt_decrypt('encrypt',$request['email']);
            $password = encrypt_decrypt('encrypt',$request['password']);

                $check_user = User::select('email','password','userid','status','username','inventory_access','auth_key')->where('email',$email)->where('password',$password);


                if($check_user->count() != 0){
                    $users = $check_user->first();

                    $user_id    = $users->userid;
                    $username   = $users->username;
                    $email_id   = $users->email;
                    $status     = $users->status;
                    $inventory_access     = $users->inventory_access;
                    $auth_keys = $users->auth_key;
                       
                        if($auth_keys == ''){
                                $auth_key = base64_encode(Str::random(70)); 
                                User::where('userid',$user_id)->update(array('auth_key'=> $auth_key));
                        }else{
                                 $auth_key = $auth_keys;
                        }

                            if($status == 1){
                                $res = ['user_id' => $user_id,'auth_key' => ($auth_key) ? $auth_key : ''];
                                return apiResponse(1,'Login Successfully',$res);
                            }else{
                                return apiResponse(0,'Your Account Has Been Suspended Please Contect By HR!');
                            }

                }else{
                    return apiResponse(0,'Invalid Login Details!!');
                }

        }else{

            echo '<h2>Forbidden</h2>';
            die;
        }
  
    }






 }



?>