<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Privileges;
use Redirect;



class PrivilegesController extends Controller{  

    public function __construct(){

    }
 
    public function index(Request $request){

    	$data['employee'] = User::where('status', '!=',2)->where('position','HR');

    	$data['js_file'] = 'Privileges';
        $data['title'] = 'Privileges';
        return view('privileges/privileges',$data);

    }

    public function edit_privileges($id){

    	$user_id = encrypt_decrypt('decrypt',$id);
    	$check_user = User::where('status', '!=',2)->where('position','HR')->where('userid',$user_id);

    	if($check_user->count() != 0){
    		$data['employee'] = User::where('status', '!=',2)->where('position','HR')->where('userid',$user_id)->first();
    		$data['access'] = Privileges::where('status',1)->get();
    		$data['user_id'] = $user_id;
	    	$data['js_file'] = 'Privileges';
	        $data['title'] = 'Privileges';
	        return view('privileges/edit_privileges',$data);
    	}else{
    		Session::flash('error', 'Invalid User!!');
	    	return redirect()->back();
    	}
    }

    function edit_access(Request $request){



    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

    		$validatedData = $request->validate([
	            'user_id' => 'required',
	        ]);

    		$user_id = $request['user_id'];
    		$view = ($request['view']) ? $request['view'] : [];
    		$edit = ($request['edit']) ? $request['edit'] : [];

    		$compain = array_merge($view,$edit);
    		$res = serialize($compain);
    		$updateData = [
    			'page_access' => $res
    		];

    		$Update = User::where('userid', $user_id)->update($updateData);

    		if($Update){
    			Session::flash('success', 'Page Access Added Successfully');
		    	return redirect()->back();
    		}else{
    			Session::flash('success', 'Page Access Added Invalid!!');
		    	return redirect()->back();
    		}
    		
    	}
    }

}

?>