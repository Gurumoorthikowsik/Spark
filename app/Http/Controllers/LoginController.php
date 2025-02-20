<?php 
namespace App\Http\Controllers;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{  

    public function __construct(){
       
    }


    public function mainindex(){


        $data['js_file'] = 'Index';
        $data['title'] = 'Inidex';      
        return view('coming-soon',$data);
    }
    
    public function index(){

        if(Session::get('hruser_id') != ''){
            return redirect('/dashboard');
        }

        $email = encrypt_decrypt('encrypt','BraveSpark@gmail.com');
        $pass = encrypt_decrypt('encrypt','Bs271528');


        // echo "<pre>";
        // print_r($email);

        // die;



        // echo "<pre>";
        // print_r($check);
        // die;


        $data['js_file'] = 'login';
        $data['title'] = 'Login';
        return view('login', $data);
    }


    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Please Enter The Email',
            'password.required' => 'Please Enter The Password'
        ]);

            $email = encrypt_decrypt('encrypt',trim($request['email']));      
            $password = encrypt_decrypt('encrypt',trim($request['password']));  


                 
                $check_user = User::select('email','password','userid','status','username','position')->where('position','HR')->where('email',$email)->where('password',$password);

  


                if($check_user->count() != 0){
                    $users = $check_user->first();

                    $user_id    = $users->userid;
                    $username   = $users->username;
                    $email_id   = $users->email;
                    $status     = $users->status;
                    $position     = $users->position;

                        if($position == 'HR'){

                            if($status == 1){
                                $session = [
                                    'hruser_id' => $user_id,
                                    'hrusername' => $username 
                                ];
                                session($session);

                                if(Session::get('hruser_id') && Session::get('hrusername')){
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
                                
                        }else{
                            $res = ['status' => 0,'msg' => 'Invalid Login . Access Only Human Resources','page' => 'login'];
                            echo json_encode($res) ; die;
                        }

                }else{
                    $res = ['status' => 0,'msg' => 'Invalid Login Details!!','page' => 'login'];
                    echo json_encode($res) ; die;
                }
  
    }






    public function logout(){

        Session::flush();
        return redirect('/');
    }

    public function click_fullscreen(){


        if(Session::get('fullscreen') == 'fullscreen-enable'){
            session(['fullscreen' => 'fullscreen-enable']);
        }else{
            session(['fullscreen' => '']);

        }
        return redirect()->back();

    }

    public function hrerror(){                
        return redirect()->back();
    }



    public function sendmailfun(){
        $toEmail = 'gurumoorthikowsik@gmail.com';

        $data = [
        'subject' => 'Welcome!',
        'body' => 'Thank you for joining our platform!'
    ];

        Mail::send([], $data, function ($message) use ($toEmail, $data) {
        $message->to($toEmail)
                ->subject($data['subject'])
                ->setBody($data['body']);
    });

    }

 }



?>