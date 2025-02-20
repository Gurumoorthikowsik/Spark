<?php 
namespace App\Http\Controllers\Employee;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\User;

class EmployeeLoginController extends Controller
{  

    public function __construct(){

    }
    
    public function index(){
    
        if(Session::get('empuser_id') != ''){
            return redirect('/employees/dashboard');
        }

        $data['js_file'] = 'employee-login';
        $data['title'] = 'Student Login';
        return view('employee/login', $data);
    }


    public function login(Request $request){

        

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
         $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Please Enter The Email',
            'password.required' => 'Please Enter The Password'
        ]);
            $email = encrypt_decrypt('encrypt',$request['email']);
            $password = encrypt_decrypt('encrypt',$request['password']);

                $check_user = User::select('email','password','userid','status','username','inventory_access')->where('email',$email)->where('password',$password);


                if($check_user->count() != 0){
                    $users = $check_user->first();

                    $user_id    = $users->userid;
                    $username   = $users->username;
                    $email_id   = $users->email;
                    $status     = $users->status;
                    $inventory_access     = $users->inventory_access;

                        // if($inventory_access == 1){

                            if($status == 1){
                                $session = [
                                    'empuser_id' => $user_id,
                                    'empusername' => $username 
                                ];
                                session($session);

                                if(Session::get('empuser_id') && Session::get('empusername')){
                                    $res = ['status' => 1,'msg' => 'Login Successfully','page' => 'dashboard'];
                                        echo json_encode($res);
                                }else{
                                    $res = ['status' => 0,'msg' => 'Login Invalid !!','page' => 'login'];
                                    echo json_encode($res) ; die;
                                }

                            }else{
                                $res = ['status' => 0,'msg' => 'Your Account Has Been Suspended Please Contect By HR!','page' => 'login'];
                                echo json_encode($res) ; die;
                            }

                        // }else{
                        //     $res = ['status' => 0,'msg' => 'Invalid Login . Access Only Human Resources','page' => 'login'];
                        //     echo json_encode($res) ; die;
                        // }

                }else{
                    $res = ['status' => 0,'msg' => 'Invalid Login Details!!','page' => 'login'];
                    echo json_encode($res) ; die;
                }
            }else{
                // die();
                return response()->view('errors.hrerror');
            }
  
    }

    function logout(){

        Session::flush();
        return redirect('/');
    }  



 }



?>