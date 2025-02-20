<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Laptop;
use App\Models\Charger;
use App\Models\Mouse;
use App\Models\Keyboard; 
use App\Models\Userinventory;
use App\Models\Certificate;
use App\Models\UserDocument;
use App\Models\User_add_inventory;
use DB;
use Redirect;


class ApiHrStaffController extends Controller{  

    public function __construct(){

    }


    
 
    public function add_staff(Request $request){	

    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		    $validator = Validator::make($request->all(),[
				'user_id'=>'required',
	            'roll' => 'required',
	            'working_hrs' => 'required',
	            'staffname' => 'required',
	            'staffemail' => 'required',
	            'password' => 'required',
	            'c_password' => 'required',
	        ], [
	            'roll.required' => 'Choose Staff Roll',
	            'staffname.required' => 'Please Enter Staff Username',
	            'staffemail.required' => 'Please enter your Staff email ID',
	            'password.required' => 'Please enter a Password',
	            'c_password.required' => 'Please enter a Confirm Password',
	        ]);

	        if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

		        $roll = $request['roll'];
		        $staffname = strtolower(trim($request['staffname']));
		        $staffemail = encrypt_decrypt('encrypt',trim($request['staffemail']));
		        $password = encrypt_decrypt('encrypt',trim($request['password']));
		        $c_password = encrypt_decrypt('encrypt',trim($request['c_password']));


			        if($password != $c_password){
			        	 return apiResponse(0,'Password and Confirm Password Dost Nat Match');
			        }

		        	$check_email = User::select('email')->where('email',$staffemail)->where('status','!=',2);

		        	
				        if($check_email->count() == 0){
				        	$get_emp_id = User::limit(1)->orderBy('userid', 'DESC')->first();
							$emp_id = str_split($get_emp_id->employee_id,4);
							$employee_ids = $emp_id[1] + 1;
							$employee_id = 'BIVS'.str_pad($employee_ids,4,'0',STR_PAD_LEFT);

				        	$inserData = [
					        	'username' => $staffname,
					        	'email' => $staffemail,
					        	'password' => $password,
					        	'profile_photo' => 'user_icon.png',
					        	'working_hrs' => $request['working_hrs'],
					        	'status' => 1,
					        	'employee_id' => $employee_id,
					        	'position' => get_position($roll),
					        	'ip_address' => $request->ip(),
					        	'created_date' => date('d-m-Y H:i:s'),
					        ];

					       $res =  User::insert($inserData);

					       if($res){
            					 return apiResponse(1,'Staff Added Successfully');

					       }else{
						       	return apiResponse(0,'Staff Added Invalid!!');
					       }
				        }else{
				        	 return apiResponse(0,'Email ID Already Exist !!');
				        }
    	}

    }


    public function roll_list(Request $request){

    	if($_SERVER['REQUEST_METHOD'] === 'GET'){

    		$roll = Roll::select('roll','sort_name')->where('status',1)->get();

    		$out = [];   
            foreach ($roll as $key => $value) {

                $out[$key]['roll'] = $value->roll;
                $out[$key]['sort_name'] = $value->sort_name;

            }

            return apiResponse(1,'success',['roll_list' => $out]);


    	}
    }


    public function viewstaff(Request $request){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

     	$employee = User::where('status', '!=',2)->orderBy('userid','DESC');
		 if($employee->count() != 0){
			$i = 1;
			$out = [];  
			foreach ($employee->get() as $key => $value){

				if(staff_allacated_inventory($value->userid) !== 0){
					$inven = 'Available';
				}else{
					$inven = 'Not Available';
				}

				if($value->status == 1){
					$status= 'Active';
				}else{
					$status= 'Deactive';
				}
				$out[$key]['s_no'] = $i;
				$out[$key]['user_id'] = $value->userid;
				$out[$key]['employee_id'] = $value->employee_id;
				$out[$key]['username'] = $value->username;
				$out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
				$out[$key]['role'] = get_roll($value->position);
				$out[$key]['ceatedate'] = date("d-M-Y",strtotime($value->created_date));
				$out[$key]['inventory'] = $inven;
				$out[$key]['status'] = $status;
				// $out[$key]['action'] = encrypt_decrypt('encrypt',$value->userid);
				$i++;
			}
		 }

		 return apiResponse(1,'success',['View_Staff' =>($out) ? $out : 'Record Not Found !!']);
    	
       
		}else{
				return apiResponse(0,'Invalid Request Method');
			}


	}



    public function staffstatus(Request $request){

		if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'visit_user_id' => 'required',
			
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
		$id = $request['user_id'];
	
    	
    	$user_id = $request['visit_user_id'];

	    	if($user_id){
	    		$check_user = User::select('userid','status')->where('userid',$user_id);

	    			if($check_user->count() != 0){

	    				if($check_user->first()->status == 1){
	    					$updateData = ['status' => 0];
	    					$Update = User::where('userid', $user_id)->update($updateData);
							return apiResponse(1, 'Status Deactive Successfully');
		    				
	    				}else if($check_user->first()->status == 0){
	    					$updateData = ['status' => 1];
	    					$Update = User::where('userid', $user_id)->update($updateData);
							return apiResponse(1, 'Status Active Successfully');
		    				
	    				}else{
							return apiResponse(0, 'Inavlid !!');
	    					
	    				}
	    			}else{
						return apiResponse(0, 'Invalid User !!');
	    				
	    			}
	    	}else{
				return apiResponse(0, 'Invalid User Id !!');
	    		
	    	}

    }
}

    public function deletestaff(Request $request){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'visit_user_id' => 'required',
				
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
		$id = $request['user_id'];
    	$user_id = $request['visit_user_id'];

	    	if($user_id){

	    		$check_user = User::select('userid','status')->where('userid',$user_id);

	    			if($check_user->count() != 0){

	    					$updateData = ['status' => 2];
	    					$Update = User::where('userid', $user_id)->update($updateData);
	    					if($Update){
	    						return apiResponse(1, 'User Delete Successfully');
		    				
	    					}else{
	    						return apiResponse(0, 'Invalid !!');
		    					
	    					}
		    				
	    			}else{
	    				return apiResponse(0, 'Invalid User !!');
	    			
	    			}
	    	}else{
	    		return apiResponse(0, 'Invalid User Id !!');
	    	
	    	}
    }
	}

    public function editstaff(Request $request){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
				'visit_user_id' => 'required',
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
			$id = $request['user_id'];
			$user_id = $request['visit_user_id'];
			$check_user = User::where('userid',$user_id);

	    	if($check_user->count() != 0){

		    	// $roll = Roll::select('roll','sort_name')->where('status',1)->get();
				// foreach ($roll as $value){

				// }

		    	// $laptop =  DB::table('user_inventory')

		    	// ->rightJoin('laptop_details', 'user_inventory.device_brand' ,'=', 'laptop_details.id',)->where('laptop_details.status',1)->whereNull('user_inventory.device_brand')->select('laptop_details.id','laptop_details.brand','laptop_details.serial_no')->get();

		    	// $charger = DB::table('user_inventory')->rightJoin('charger_details', 'user_inventory.charger', '=', 'charger_details.id')->where('charger_details.status',1)->whereNull('user_inventory.charger')->select('charger_details.id','charger_details.brand','charger_details.serial_no')->get();

		    	// $mouse = DB::table('user_inventory')->rightJoin('mouse_details', 'user_inventory.mouse', '=', 'mouse_details.id')->where('mouse_details.status',1)->whereNull('user_inventory.mouse')->select('mouse_details.id','mouse_details.brand','mouse_details.serial_no')->get();
		    	// $keyboard = DB::table('user_inventory')->rightJoin('keyboard_details', 'user_inventory.keyboard', '=', 'keyboard_details.id')->where('keyboard_details.status',1)->whereNull('user_inventory.keyboard')->select('keyboard_details.id','keyboard_details.brand','keyboard_details.serial_no')->get();
		    	// $inventory = Userinventory::where('status',1)->where('user_id',$user_id);
				
				
				$user = $check_user->first();


				$updatedata = [
					'user_id' => $user->userid,
					'employee_id' => $user->employee_id,
					'staff_name' => $user->username,
					'staff_email' => encrypt_decrypt('decrypt',$user->email),
					'staff_password' => encrypt_decrypt('decrypt',$user->password),
					'personal_email' => $user->personal_email,
					'phonenumber_1' => $user->phone_number,
					'phonenumber_2' => $user->phone_two,
					'blood_group' => $user->blood_group,
					'date_of_birth' => $user->date_birth,
					'permanment_address' => $user->address,
					'employee_id' => $user->employee_id,
					'staff_role_sort_name'=> $user->position,
					'sort_role'=> get_roll($user->position),
					'designation'=> $user->designation,
					'department'=> $user->department,
					'date_of_joining'=> $user->date_join,
					'official_mail_id'=> $user->official_mail,
					'working_hours'=> $user->working_hrs,
					'bank_name'=> $user->bank_name,
					'account_number'=> $user->account_number,
					'ifsc_number'=> $user->bank_ifsc,
					'branch_name'=> $user->branch_name,
					'pancard_number'=> $user->pan_card,
					'aadhar_number'=> $user->aadhar_number,
					'father_name'=> $user->father_name,
					'father_contact_no'=> $user->father_contact_no,
					'emergency_contact_relationship_one'=> $user->emergency_relationone,
					'emergency_contact_name_one'=> $user->emergency_contactone,
					'emergency_contact_phone_number_one'=>$user->emergency_number,
					'emergency_contact_relationship_two'=> $user->emergency_relationtwo,
					'emergency_contact_name_two'=> $user->emergency_contactsecond,
					'emergency_contact_phone_number_two'=> $user->emergency_second,

				];

		    	
				

				return apiResponse(1,'success',['staff_personal_details' => $updatedata]);

	    	}else{
	    		return apiResponse(0, 'Invalid User!!');
	    		
	    	}

	    
		}
    }

    public function editinsertstaff(Request $request){
		
    	if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$validator = Validator::make($request->all(),[
                'user_id' => 'required',
				'visit_user_id' => 'required',
				'staffname'=>'required',
				'staffemail'=>'required',
				'password'=>'required',
				'personalemail' => 'required',
				'phone_no_one' => 'required', 
				'phone_no_two' => 'required', 
				'blood_grp' => 'required',
				'dob' => 'required',
				'address' => 'required',
				'employee_id'=>'required',
				'staff_role_sort_name'=>'required',
				'designation' => 'required',
				'department' => 'required',
				'doj' => 'required',
				'officaial_mail' => 'required',
				'working_hrs' => 'required', 
				'bankname' => 'required',
				'account_no' => 'required',
				'ifsc' => 'required',
				'branch' => 'required',
				'pan_no' => 'required',
				'aadhaar_no' => 'required', 
				'father_name' => 'required',
				'father_contact' => 'required',
				'emcy_relation_one' => 'required', 
				'emcy_name_one' => 'required',
				'emcy_relation_contact_one' => 'required',
				'emcy_relation_two' => 'required', 
				'emcy_name_two' => 'required',
				'emcy_relation_contact_two' => 'required',
				
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

		
    		$id = $request['user_id'];
			$user_id = $request['visit_user_id'];
    		$check_user = User::where('userid',$user_id);			

    		if($check_user->count() != 0){

    			$staffname 						= $request['staffname'];
	    		$staffemail 					= strtolower($request['staffemail']);
				$password                       = $request['password'];
	    		$phone_no_one					= $request['phone_no_one'];
	    		$phone_no_two					= $request['phone_no_two'];
	    		$blood_grp						= $request['blood_grp'];
	    		$dob							= $request['dob'];
	    		$address 						= $request['address'];
				$employee_id                    = $request['employee_id'];
	    		$roll 							= $request['roll'];
	    		$designation					= $request['designation'];
	    		$department 					= $request['department'];
	    		$doj 							= $request['doj'];
	    		$personalemail 					= $request['personalemail'];
	    		$officaial_mail 				= $request['officaial_mail'];
	    		$bankname 						= $request['bankname'];
	    		$account_no 					= $request['account_no'];
	    		$ifsc 							= $request['ifsc'];
	    		$branch 						= $request['branch'];
	    		$pan_no 						= $request['pan_no'];
	    		$aadhaar_no 					= $request['aadhaar_no'];
	    		$father_name 					= $request['father_name'];
	    		$father_contact 				= $request['father_contact'];
	    		$emcy_relation_one 				= $request['emcy_relation_one'];
	    		$emcy_name_one 					= $request['emcy_name_one'];
	    		$emcy_relation_contact_one 		= $request['emcy_relation_contact_one'];
	    		$emcy_relation_two 				= $request['emcy_relation_two'];
	    		$emcy_name_two 					= $request['emcy_name_two'];
	    		$emcy_relation_contact_two		= $request['emcy_relation_contact_two'];
	    		$working_hrs					= $request['working_hrs'];
	    		$updateData = [

	    			'username' 					=> strtolower(trim($staffname)),
	    			'email'						=> encrypt_decrypt('encrypt',trim($staffemail)),
					'password'                  => encrypt_decrypt('encrypt',trim($password)),
	    			'designation'				=> trim($designation),
					'employee_id'               => trim($employee_id),
	    			'department'				=> trim($department),
	    			'blood_group'				=> trim($blood_grp),
	    			'date_join'					=> trim($doj),
	    			'official_mail'				=> strtolower(trim($officaial_mail)),
	    			'date_birth'				=> trim($dob),
	    			'bank_name'					=> trim($bankname),
	    			'bank_ifsc'					=> trim($ifsc),
	    			'branch_name'				=> trim($branch),
	    			'account_number'			=> trim($account_no),
	    			'pan_card'					=> trim($pan_no),
	    			'aadhar_number'				=> trim($aadhaar_no),
	    			'personal_email'			=> strtolower(trim($personalemail)),
	    			'phone_number'				=> trim($phone_no_one),
	    			'phone_two'					=> trim($phone_no_two),
	    			'father_name'				=> trim($father_name),
	    			'father_contact_no'			=> trim($father_contact),
	    			'emergency_relationone'		=> trim($emcy_relation_one),
	    			'emergency_contactone'		=> trim($emcy_name_one),
	    			'emergency_number'			=> trim($emcy_relation_contact_one),
	    			'emergency_relationtwo'		=> trim($emcy_relation_two),
	    			'emergency_contactsecond'	=> trim($emcy_name_two),
	    			'emergency_second'			=> trim($emcy_relation_contact_two),
	    			'address'					=> trim($address),
	    			'position' 					=> $request['staff_role_sort_name'],
	    			'working_hrs' 				=> trim($working_hrs),
	    		];

	    		$Update = User::where('userid', $user_id)->update($updateData);

	    		if($Update){
	    			return apiResponse(1, 'Staff Details Edit Successfully');
	    		
	    		}else{
	    			return apiResponse(0, 'Staff Details Edit Invalid !!');
	    			
	    		}

    		}else{
    			return apiResponse(0, 'Invalid User!!');
	    		
    		}

    		


    		

    	}
    	
    }


    function addinventory(Request $request){

    	if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$validator = Validator::make($request->all(),[
                'user_id' => 'required',
				
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

    		$request = $_POST;
    		$user_id = encrypt_decrypt('decrypt',$request['user_id']);
    		$check_user = User::where('userid',$user_id);

    		if($check_user->count() != 0){
    			$device 						= $request['device'];
	    		$brand 							= $request['brand'];
	    		$charger						= $request['charger'];
	    		$keyboard						= $request['keyboard'];
	    		$mouse							= $request['mouse'];

	    		$inserData = [
	    			'user_id' => $user_id,
	    			'device' => $device,
	    			'device_brand' => $brand,
	    			'charger' => $charger,
	    			'keyboard' => $keyboard,
	    			'mouse'  => $mouse,
	    			'created_at' => date('Y-m-d H:i:s')
	    		];

	    		$res =  Userinventory::insert($inserData);
		       if($res){
				return apiResponse(1, 'User Inventory Addedd Successfully');
	    			 
		       }else{
				return apiResponse(0, 'User Inventory Addedd Inavlid');
	    			
		       }

	    	}else{
	    		return apiResponse(0, 'Invalid User!!');
	    		
	    	}

    	}

    }

    function delete_staff_inventory($id){
    		
    	$check_inventory =  Userinventory::where('id',$id);

    		if($check_inventory->count() != 0){

    			$inventory = $check_inventory->first();
    			Userinventory::where('id', $id)->delete();
    			// Laptop::where('id', $inventory->device_brand)->update(['assigned' => 0]);
    			// Charger::where('id', $inventory->charger)->update(['assigned' => 0]);
    			// keyboard::where('id', $inventory->keyboard)->update(['assigned' => 0]);
    			// Mouse::where('id', $inventory->mouse)->update(['assigned' => 0]);

    			return apiResponse(1, 'User Inventory Delete Successfully');
	    		
    		}else{
    			return apiResponse(0, 'Some Error Occured');
	    		
    		}

    }

    function staff_inventory(){

    	$data['inventory'] =  DB::table('user_info')
            ->join('user_inventory', 'user_info.userid', '=', 'user_inventory.user_id')


            ->leftJoin('laptop_details', 'user_inventory.device_brand', '=', 'laptop_details.id')
            ->leftJoin('charger_details', 'user_inventory.charger', '=', 'charger_details.id')
            ->leftJoin('mouse_details', 'user_inventory.mouse', '=', 'mouse_details.id')
            ->leftJoin('keyboard_details', 'user_inventory.keyboard', '=', 'keyboard_details.id')


            ->select( 'user_info.username', 'user_info.employee_id','user_info.status','laptop_details.brand','laptop_details.serial_no','laptop_details.processors','charger_details.brand as charger_brand','charger_details.serial_no as charger_serial_no','mouse_details.brand as mouse_brand','mouse_details.serial_no as mouse_serial_no','keyboard_details.brand as keyboard_brand','keyboard_details.serial_no as keyboard_serial_no','user_inventory.status as inventory_status','user_inventory.device','user_inventory.id','user_inventory.others')->orderBy('user_info.username','ASC');

  
    	$data['js_file'] = 'staff';
        $data['title'] = 'Staff Inventory List';
        return view('staff/staff_inventory_list',$data);
    }


    function staff_proof(Request $request,$id=""){

    	$user_id = encrypt_decrypt('decrypt',$id);
    	$check_user = User::where('userid',$user_id);

    	if($check_user->count() != 0){
    		$user = $check_user->first();
    		if($_SERVER['REQUEST_METHOD'] === 'POST'){
		
    		$validatedData = $request->validate([
	            'type' => 'required',
	        ], [
	            'type.required' => 'Choose Upload Proof',
	        ]);

		        $type = $request['type'];

		        $img_extention = $request->file('proof')->getClientOriginalExtension();

                $in_array = in_array($img_extention, ['jpg','jpeg','png','JPG','JPEG','PNG']);

                if($in_array != 1){
                    Session::flash('error', 'Image Upload Extention Allow Only jpg ,jpeg ,png');
                    return redirect()->back();
                }
                
    			$upload = cloudinary()->upload($request->file('proof')->getRealPath(),['folder' => 'staff_proof/'.$user->employee_id.'-'.strtolower($user->username)])->getSecurePath();

	    			if($upload){
	    				$res = upload_proof_serialize($user->userid,$type,$upload);

	    				if($res){
	    					Session::flash('success', 'Staff '.$type.' Proof Upload Successfully');
		    				return redirect()->back();
	    				}else{
	    					Session::flash('error', 'Staff Proof Upload Some Error !!');
		    				return redirect()->back();
	    				}

	    			}else{
	    				Session::flash('error', 'Staff Proof Upload Some Error !!');
		    			return redirect()->back();
	    			}

	    	}else{
	    		$data['document_list'] = Certificate::where('status',1)->get();
	    		$data['user_proof'] = UserDocument::where('user_id',$user_id)->where('status',1)->first();  
	    		$data['user_id'] = $id;
				$data['js_file'] = 'staff';
		        $data['title'] = 'Edit Staff';
		        return view('staff/staff_proof',$data);

	    	}
    	}else{
    		Session::flash('error', 'Invalid User !!');
	    	return redirect()->back();
    	}
    	

    }


    function delete_user_proof($user_id,Request $request){

    	if($request->slug != ''){

    		$user_id = encrypt_decrypt('decrypt',$user_id);

    			$document = UserDocument::where('user_id',$user_id)->first();

    			if($document){

    				$data = unserialize($document->document);

    				if($data[$request->slug]){
    					$data[$request->slug] = '';
    					$update = UserDocument::where('user_id',$user_id)->update(['document' => serialize($data)]);

    					if($update){
    						Session::flash('success', 'User '.$request->slug.' Delete Successfully');
	    					return redirect()->back();
    					}else{
    						Session::flash('error', 'Invalid delete user proof');
	    					return redirect()->back();
    					}
    				}else{
    					Session::flash('error', 'Invalid delete user proof');
	    				return redirect()->back();
    				}
    				

    			}else{
    				Session::flash('error', 'Invalid User');
	    			return redirect()->back();
    			}


    	}else{
    		Session::flash('error', 'Invalid Link');
	    	return redirect()->back();
    	}

    }

	






	public function delete_addinventory(Request $request){

		if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
				'delete_id' => 'required',
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
			$id = $request['delete_id'];
	
        $check_addinventory =  User_add_inventory::where('id',$id);

            if($check_addinventory->count() != 0){

                $inventory = $check_addinventory->first();
                User_add_inventory::where('id', $id)->delete();                      
				return apiResponse(1, 'Record Delete Successfully');
               
            }else{
              
				return apiResponse(0, 'Some Error Occured');
            }

    }else{
		return apiResponse(0,'Invalid Request Method');
		}

	}

 }



?>