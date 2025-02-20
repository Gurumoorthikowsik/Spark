<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Roll;
use App\Models\Laptop;
use App\Models\Charger;
use App\Models\Mouse;
use App\Models\Keyboard;
use App\Models\Userinventory;
use App\Models\Users_inventory;
use App\Models\Certificate;
use App\Models\Accessories;
use App\Models\Brand;
use App\Models\Os;
use App\Models\UserDocument;
use App\Models\Addproduct;
use App\Models\ProductInfo;
use App\Models\MobileCharger;
use App\Models\User_add_inventory;
use DB;
use Redirect;


class StaffController extends Controller{

    public function __construct(){

    }




    public function index(Request $request){

		try {

    	if($_SERVER['REQUEST_METHOD'] === 'POST'){


		    $validatedData = $request->validate([
	            'roll' => 'required',
	            'working_hrs' => 'required',
	            'staffname' => 'required',
	            'staffemail' => 'required',
	            'password' => 'required',
	            'c_password' => 'required',
				'b_num' => 'required',

	        ], [
	            'roll.required' => 'Choose Staff Roll',
	            'staffname.required' => 'Please Enter Staff Username',
	            'staffemail.required' => 'Please enter your Staff email ID',
	            'password.required' => 'Please enter a Password',
	            'c_password.required' => 'Please enter a Confirm Password',
	            'b_num.required' => 'Please enter a Batch Number',

				
	        ]);

		        $roll = $request['roll'];
		        $staffname = strtolower(trim($request['staffname']));
		        $staffemail = encrypt_decrypt('encrypt',trim($request['staffemail']));
		        $password = encrypt_decrypt('encrypt',trim($request['password']));
		        $batchnumber = strtolower(trim($request['b_num']));




		        	$check_email = User::select('email')->where('email',$staffemail)->where('status','!=',2);

				        if($check_email->count() == 0){
				        	// $get_emp_id = User::limit(1)->orderBy('userid', 'DESC')->first();
							// $emp_id = str_split($get_emp_id->employee_id,4);
							// $employee_ids = $emp_id[1] + 1;
							// $employee_id = 'KNACK'.str_pad($employee_ids,4,'0',STR_PAD_LEFT);

							$get_emp_id = User::limit(1)->orderBy('userid', 'DESC')->first();

							// Extract the numeric part of the employee ID by stripping the "BS" prefix
							$emp_id_number = substr($get_emp_id->employee_id, 2);

							// Increment the numeric part
							$employee_ids = (int)$emp_id_number + 1;

							// Format the new employee ID with the "BS" prefix and 4 digits
							$employee_id = 'BS' . str_pad($employee_ids, 3, '0', STR_PAD_LEFT);


				        	$inserData = [
					        	'username' => $staffname,
					        	'email' => $staffemail,
					        	'password' => $password,
					        	'profile_photo' => 'user_icon.png',
					        	'working_hrs' => $request['working_hrs'],
					        	'status' => 1,
					        	'employee_id' => $employee_id,
					        	'position' => get_position($roll),
								'designation' => get_position($roll),
					        	'department' => get_position($roll),
					        	'ip_address' => $request->ip(),
								'batch_number' => $batchnumber,
								'Areyoustudent' => 1,
					        	'created_date' => date('d-m-Y H:i:s'),
					        ];

				


		

					       $res =  User::insert($inserData);



					       if($res){
					       		 $res = ['status' => 1,'msg' => 'Staff Added Successfully'];
									return json_encode($res) ; die;
					       }else{
						       	$res = ['status' => 0,'msg' => 'Staff Added Invalid!!'];
								   return json_encode($res) ; die;
					       }
				        }else{
				        	 $res = ['status' => 0,'msg' => 'Email ID Already Exist !!'];
							 return json_encode($res) ; die;
				        }
    	}

	} catch (\Throwable $th) {
		$res = ['status' => 0,'msg' => $th];
		return json_encode($res) ; die;
		}


    	$data['roll'] = Roll::select('roll')->where('status',1)->get();
        $data['js_file'] = 'staff';
        $data['title'] = 'Add Student';
        return view('staff/add_staff',$data);
    }



    public function viewstaff(Request $request){
     	$data['employee'] = User::where('status', '!=',2)->orderBy('userid','DESC');


    	$data['js_file'] = 'staff';
        $data['title'] = 'View All Students';
        return view('staff/view_staff',$data);
    }

    public function staff_status(Request $request ,$id){

    	$user_id = encrypt_decrypt('decrypt',$id);

	    	if($user_id){
	    		$check_user = User::select('userid','status')->where('userid',$user_id);

	    			if($check_user->count() != 0){

	    				if($check_user->first()->status == 1){
	    					$updateData = ['status' => 0];
	    					$Update = User::where('userid', $user_id)->update($updateData);
		    				Session::flash('success', 'Status Deactive Successfully');
		    				return redirect()->back();
	    				}else if($check_user->first()->status == 0){
	    					$updateData = ['status' => 1];
	    					$Update = User::where('userid', $user_id)->update($updateData);
		    				Session::flash('success', 'Status Active Successfully');
		    				return redirect()->back();
	    				}else{
	    					Session::flash('error', 'Inavlid !!');
	    					return redirect()->back();
	    				}
	    			}else{
	    				Session::flash('error', 'Invalid User !!');
	    				return redirect()->back();
	    			}
	    	}else{
	    		Session::flash('error', 'Invalid User Id !!');
	    		return redirect()->back();
	    	}

    }

    public function delete_staff(Request $request ,$id){

    	$user_id = encrypt_decrypt('decrypt',$id);

	    	if($user_id){

	    		$check_user = User::select('userid','status')->where('userid',$user_id);

	    			if($check_user->count() != 0){

	    					$updateData = ['status' => 2];
	    					$Update = User::where('userid', $user_id)->update($updateData);
	    					if($Update){
	    						Session::flash('success', 'User Delete Successfully');
		    					return redirect()->back();
	    					}else{
	    						Session::flash('error', 'Invalid !!');
		    					return redirect()->back();
	    					}

	    			}else{
	    				Session::flash('error', 'Invalid User !!');
	    				return redirect()->back();
	    			}
	    	}else{
	    		Session::flash('error', 'Invalid User Id !!');
	    		return redirect()->back();
	    	}
    }


    public function edit_staff($id){
    	$user_id = encrypt_decrypt('decrypt',$id);
    	$check_user = User::where('userid',$user_id);

	    	if($check_user->count() != 0){

		    	$data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();


		

		    	$data['user'] = $check_user->first();
		    	$data['user_id'] = $id;
		    	$data['js_file'] = 'staff';
		        $data['title'] = 'Edit Staff';


		        return view('staff/edit_staff',$data);

	    	}else{
	    		Session::flash('error', 'Invalid User!!');
	    		return redirect()->back();
	    	}



    }

    public function edit_insert_staff(Request $request){

    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

    		$request = $_POST;
    		$user_id = encrypt_decrypt('decrypt',$request['user_id']);
    		$check_user = User::where('userid',$user_id);

    		if($check_user->count() != 0){

    			$staffname 						= $request['staffname'];
	    		$staffemail 					= strtolower($request['staffemail']);
				$password                       = $request['password'];
	    		$phone_no_one					= $request['phone_no_one'];
	    		$dob							= $request['dob'];
	    		$address 						= $request['address'];
				$employee_id                    = $request['employee_id'];



	    		$roll 							= $request['roll'];
	    		$department 					= $request['department'];
	    		$doj 							= $request['doj'];
	    		$working_hrs					= $request['working_hrs'];

				$College					= $request['College'];
				$College_dep					= $request['College_dep'];
				$Student_year					= $request['Student_year'];

				$Dateofjoin					= $request['doj'];

				$fees					= $request['fees'];
				$First_paid					= $request['First_paid'];
				$Second_paid					= $request['Second_paid'];
				$third_paid					= $request['third_paid'];
				$Fourth_paid					= $request['Fourth_paid'];
				$batch_day					= $request['batch_day'];



	    		$updateData = [

	    			'username' 					=> strtolower(trim($staffname)),
	    			'email'						=> encrypt_decrypt('encrypt',trim($staffemail)),
					'password'                  => encrypt_decrypt('encrypt',trim($password)),
	    			'designation'				=> trim($department),
					'employee_id'               => trim($employee_id),
	    			'department'				=> trim($department),
	    			'date_join'					=> trim($doj),
	    			'date_birth'				=> trim($dob),
	    			'phone_number'				=> trim($phone_no_one),
	    			'address'					=> trim($address),
	    			'position' 					=> trim($roll),
	    			'working_hrs' 				=> trim($working_hrs),
					'College' 				    => trim($College),
	    			'College_dep' 				=> trim($College_dep),
	    			'Student_year' 				=> trim($Student_year),
					'date_join' 				=> trim($Dateofjoin),
					'fees' 				        => trim($fees),
	    			'First_paid' 				=> trim($First_paid),
	    			'Second_paid' 				=> trim($Second_paid),
	    			'third_paid' 				=> trim($third_paid),
					'Fourth_paid' 				=> trim($Fourth_paid),
					'batch_day'                 => trim($batch_day),



	    		];



	    		$Update = User::where('userid', $user_id)->update($updateData);

	    		if($Update){
	    			Session::flash('success', 'Staff Details Edit Successfully');
	    			return redirect()->back();
	    		}else{
	    			Session::flash('error', 'Staff Details Edit Invalid !!');
	    			return redirect()->back();
	    		}

    		}else{
    			Session::flash('error', 'Invalid User!!');
	    		return redirect()->back();
    		}






    	}

    }


    function addinventory(Request $request){

    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

    		$request = $_POST;
    		$user_id = encrypt_decrypt('decrypt',$request['user_id']);
    		$check_user = User::where('userid',$user_id);

    		if($check_user->count() != 0){
    			$device 	= $request['device'];
				$os 	= $request['os'];
	    		$post_brand = explode('-',$request['brand']);
				$brand = $post_brand[0];
				// echo '<br>';
				 $serial_no = $post_brand[1];
				// echo '<br>';

				//  $processor_no = $post_brand[2];

				 $check_inventory = Users_inventory::select('serial_no')->where('serial_no',$serial_no)->count();
            	// echo $check_inventory;
				// die;
				 if($check_inventory != 0){

				   Session::flash('error', 'Data Already Exist!!');
				   return redirect()->back();

				 }


	    		$inserData = [
	    			'user_id' => $user_id,
	    			'device' => $device,
					'os' => $os,
	    			'brand' => $brand,
	    			'serial_no' => $serial_no,
	    			// 'processor_no' => $processor_no,
	    			// 'mouse'  => $mouse,
	    			'created_at' => date('Y-m-d H:i:s')
	    		];

	    		$res =  Users_inventory::insert($inserData);

	    		// if($brand != ""){
	    		// 	Laptop::where('id', $brand)->update(['assigned' => 1]);

	    		// }else{
	    		// 	Laptop::where('id', $brand)->update(['assigned' => 0]);

	    		// }


	    		// if($charger != ""){

	    		// 	Charger::where('id', $charger)->update(['assigned' => 1]);
	    		// }else{
	    		// 	Charger::where('id', $charger)->update(['assigned' => 0]);

	    		// }

	    		// if($keyboard != ""){
	    		// 	keyboard::where('id', $keyboard)->update(['assigned' => 1]);

	    		// }else{
	    		// 	keyboard::where('id', $keyboard)->update(['assigned' => 0]);

	    		// }

	    		// if($mouse != ""){
	    		// 	Mouse::where('id', $charger)->update(['assigned' => 1]);

	    		// }else{
	    		// 	Mouse::where('id', $charger)->update(['assigned' => 0]);
	    		// }

		       if($res){
	                 Session::flash('success', 'User Inventory Addedd Successfully');
	    			 return redirect()->back();
		       }else{
		       		Session::flash('error', 'User Inventory Addedd Inavlid');
	    			return redirect()->back();
		       }

	    	}else{
	    		Session::flash('error', 'Invalid User!!');
	    		return redirect()->back();
	    	}

    	}

    }

    function delete_staff_inventory($id){

    	$check_inventory =  Users_inventory::where('id',$id);

    		if($check_inventory->count() != 0){

    			$inventory = $check_inventory->first();
    			Users_inventory::where('id', $id)->delete();
    			// Laptop::where('id', $inventory->device_brand)->update(['assigned' => 0]);
    			// Charger::where('id', $inventory->charger)->update(['assigned' => 0]);
    			// keyboard::where('id', $inventory->keyboard)->update(['assigned' => 0]);
    			// Mouse::where('id', $inventory->mouse)->update(['assigned' => 0]);

    			Session::flash('success', 'User Inventory Delete Successfully');
	    		return redirect()->back();
    		}else{
    			Session::flash('error', 'Some Error Occured');
	    		return redirect()->back();
    		}

    }

    function staff_inventory(){

    	$data['inventory'] =  DB::table('user_info')
            ->join('users_add_inventory', 'user_info.userid', '=', 'users_add_inventory.userid')


            ->leftJoin('add_product', 'users_add_inventory.brand', '=', 'add_product.id')


            ->select( 'user_info.username', 'user_info.employee_id','user_info.status','add_product.brand','add_product.serial_no','users_add_inventory.brand',
					'users_add_inventory.accessories','users_add_inventory.sim','users_add_inventory.phone_no','users_add_inventory.mobile_charger','users_add_inventory.processor_no',
					'users_add_inventory.serial_no','users_add_inventory.Laptop_charger','users_add_inventory.os','users_add_inventory.id','users_add_inventory.created_at')->orderBy('user_info.username','ASC');


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

	function get_brand_names($id){
		$get_brand =  DB::table('add_product')->leftJoin('brand', 'add_product.brand' ,'=', 'brand.id')->where('brand.status',1)->where('accessories',$id)->select('brand.brand_name','add_product.serial_no','brand.id as brand_id','add_product.id as product_id')->get();

		echo '<label for="customername-field" class="form-label">Choose Brand * </label>
		<select class="form-select device valid" id="inputGroupSelect01" name="brand" id="brand" aria-invalid="false"><option value="">Choose Option</option>';
		foreach($get_brand as $key => $value){
			echo '<option value="'.$value->brand_name.' '.'-' .' '.$value->serial_no.' '. '-'.' '.$value->processor_no.'">'.$value->brand_name.' '.'-' .' '.$value->serial_no.' '. '-'.' '.$value->processor_no.'</option>';
		}

		echo '</select>';
		die;
    }

	public function add_inventory(Request $request,$id){

		$user_id = encrypt_decrypt('decrypt',$id);
		$check_user = User::where('userid',$user_id);

		$get_user_stack = User_add_inventory::select('product_id')->get()->toArray();
		$inStack_id=[];
		foreach($get_user_stack as $key => $value){
			$inStack_id[] = $value['product_id'];
		}

		$data['view_productlist'] =  DB::table('add_product')
        ->join('productinfo', 'add_product.id', '=', 'productinfo.product_id')
        ->leftJoin('os', 'os.id', '=', 'productinfo.os')
        ->leftJoin('sim', 'sim.id', '=', 'productinfo.sim')
		->leftJoin('simcard', 'simcard.id', '=', 'productinfo.simcard')
        ->select( 'add_product.serial_no','add_product.id', 'productinfo.processor_no','add_product.brand','add_product.accessories','add_product.status','productinfo.userid','productinfo.os','productinfo.sim','productinfo.phone_no','productinfo.mobile_charger','productinfo.mobile_charger','productinfo.Laptop_charger','os.os_name','productinfo.simcard','simcard.sim_name','sim.sim_type')->whereNotIn('add_product.id',$inStack_id)->where('add_product.status','=',1)->orderBy('add_product.id','ASC');

	   $data['brand'] = Brand::select('brand_name','id')->where('status',1)->get();
	   $data['accessories'] = Accessories::select('accessories_name','id')->where('status',1)->get();
	   $data['serial_no'] = Addproduct::select('serial_no','id')->where('status',1)->get();
	   $data['processor_no'] = ProductInfo::select('processor_no','userid')->where('status',1)->whereNotNull('processor_no')->get();
	   $data['os'] = Os::select('*')->orderBy('id', 'DESC')->get();
	   $data['MobileCharger'] = MobileCharger::select('*')->orderBy('id', 'DESC')->get();
	   $data['Laptop_charger'] = ProductInfo::select('Laptop_charger','userid')->where('status',1)->whereNotNull('Laptop_charger')->get();
	   $data['phone_no'] = ProductInfo::select('phone_no','userid')->where('status',1)->whereNotNull('phone_no')->get();

	   $data['user'] = $check_user->first();
	   $data['userid'] = $id;
	   $data['js_file'] = 'staff';
	   $data['title'] = 'View All Staff';
	   return view('staff/add_inventory',$data);
   }


	public function addinventory_insert(Request $request){

		$validatedData = $request->validate([
			'add_inventory' => 'required',
		], [
			'add_inventory.required' => 'Select Any Product Field',
		]);

		$userid = encrypt_decrypt('decrypt',$request['userid']);
    	$check_user = User::where('userid',$userid);

    if($check_user->count() != 0){

		$add_inventory = $request->add_inventory;

		$view_productlist =  DB::table('add_product')
        ->join('productinfo', 'add_product.id', '=', 'productinfo.product_id')
        ->leftJoin('os', 'os.id', '=', 'productinfo.os')
        ->leftJoin('sim', 'sim.id', '=', 'productinfo.sim')
		->leftJoin('simcard', 'simcard.id', '=', 'productinfo.simcard')
        ->select( 'add_product.serial_no','add_product.id', 'productinfo.processor_no','add_product.brand','add_product.accessories','add_product.status','productinfo.userid','productinfo.simcard','simcard.sim_name','productinfo.os','productinfo.sim','productinfo.phone_no','productinfo.mobile_charger','productinfo.mobile_charger','productinfo.Laptop_charger','os.os_name','sim.sim_type')->whereIn('add_product.id',$add_inventory)->get()->toArray();

		foreach($view_productlist as $key => $value){


		$insertData = [
			'product_id' => $value->id,
			'userid' => $userid,
			'brand' => $value->brand,
			'accessories' => $value->accessories,
			'serial_no' => $value->serial_no,
			'processor_no' => $value->processor_no,
			'sim' => $value->sim,
			'simcard' => $value->simcard,
			'phone_no' => $value->phone_no,
			'mobile_charger' => $value->mobile_charger,
			'os' => $value->os,
			'Laptop_charger' => $value->Laptop_charger,
			'created_at' => Carbon::now()


		];

		$res =  User_add_inventory::insert($insertData);

		}

		if($res){
			Session::flash('success', 'User Inventory Addedd Successfully');
			return redirect()->back();
			// return Redirect::route('/edit_staff', array('id' =>$userid))
            //     ->with('succes','Alread Apply for this post');
	  }
	}
	}



	public function delete_addinventory($id){

        $check_addinventory =  User_add_inventory::where('id',$id);

            if($check_addinventory->count() != 0){

                $inventory = $check_addinventory->first();
                User_add_inventory::where('id', $id)->delete();

                Session::flash('success', 'Record Delete Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }

    }

	public function addinventory_status(Request $request,$id){

        $id = $request['id'];

        $check_addinventory = User_add_inventory::select('id','status')->where('id',$id);

        if($check_addinventory->count() != 0){

            if($check_addinventory->first()->status == 1){
                $updateData = ['status' => 0];
                $Update = User_add_inventory::where('id', $id)->update($updateData);
                Session::flash('success', 'Status Deactive Successfully');
                return redirect()->back();
            }else if($check_addinventory->first()->status == 0){
                $updateData = ['status' => 1];
                $Update = User_add_inventory::where('id', $id)->update($updateData);
                Session::flash('success', 'Status Active Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Inavlid !!');
                return redirect()->back();
            }
        }
        else{
            Session::flash('error', 'Invalid data !!');
            return redirect()->back();
        }

    }

 }



?>
