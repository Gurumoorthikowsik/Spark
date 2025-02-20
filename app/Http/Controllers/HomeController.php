<?php 
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roll;
use DB;

class HomeController extends Controller
{  

    public function __construct(){
       
    }
    
    public function test(){
        
        // chnage user encrypt to email and password

        $user_list = DB::table('into_login')->select('email','password','userid','position')->get();


            foreach ($user_list as $key => $value) {
            
                // $encrypt = encrypt_decrypt('decrypt',$value->email);

                    if($value->position == ""){
                        // $email = encrypt_decrypt('encrypt',$value->email);
                        // $password = encrypt_decrypt('encrypt',$value->password);
                        
                        $updateData = [
                            // 'email' => $email,
                            'position' => 'technical'
                        ];

                        $Update = DB::table('into_login')->where('userid', $value->userid)->update($updateData);
                        
                    }
               
            }


        // foreach ($user_list as $key => $value) {
            
        //     echo 'id===>'.$value->userid.'======>email===>'.encrypt_decrypt('decrypt',$value->email).'===>postion====>'.$value->position;
        //     echo '<br>';
        //     echo 'password====>'.encrypt_decrypt('decrypt',$value->password);
        //     echo '<br>';
        // }

    }


 }


?>