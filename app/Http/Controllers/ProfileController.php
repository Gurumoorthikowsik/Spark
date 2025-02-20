<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use Redirect;


class ProfileController extends Controller{  

    public function __construct(){

    }
 
    public function index(Request $request){

    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

    		$validatedData = $request->validate([
	            'username' => 'required',
	            'email' => 'required',
	            'phone' => 'required',
	            'personalemail' => 'required',
	            'address' => 'required',
	        ], [
	            'username.required' => 'Please Enter Username',
	            'email.required' => 'Please enter your email ID',
	            'phone.required' => 'Please enter a Password',
	            'personalemail.required' => 'Please enter Your Personal Email ID',
	            'address.required' => 'Please enter Your Permanent Address',
	        ]);

		        $roll = $request['roll'];
		        $staffname = strtolower($request['username']);
		        $staffemail = encrypt_decrypt('encrypt',strtolower($request['email']));
		        $phone = $request['phone'];
		        $personalemail = strtolower($request['personalemail']);
		        $address = $request['address'];

	        	$check_email = User::select('email')->where('userid' ,'!=', user_id())->where('email',$staffemail);
			        if($check_email->count() == 0){
			        	$updateData = [
				        	'username' => $staffname,
				        	'email' => $staffemail,
				        	'phone_number' => $phone,
				        	'personal_email' => $personalemail,
				        	'address' => $address,
				        	
				        ];

				      	$Update = User::where('userid', user_id())->update($updateData);

			    		if($Update){
			    			$res = ['status' => 1,'msg' => 'Profile Edit Successfully'];
                             echo json_encode($res) ; die;
			    		}else{
			    			$res = ['status' => 0,'msg' => 'Profile Edit Invalid'];
                            echo json_encode($res) ; die;
			    		}

			        }else{
			        	 $res = ['status' => 0,'msg' => 'Email ID Already Exist !!'];
                         echo json_encode($res) ; die;
			        }
    	}

    	$data['user'] = User::select('username','email','phone_number','address')->where('userid',user_id())->first();
        $data['js_file'] = 'profile';
        $data['title'] = 'Profile';
        return view('profile',$data);

    }

}

?>