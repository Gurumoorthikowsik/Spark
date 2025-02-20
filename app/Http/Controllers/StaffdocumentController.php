<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Certificate;
use App\Models\UserDocument;
use App\Models\Notification;
use DB;
use URL;
use Redirect;


class StaffdocumentController extends Controller{  

    public function __construct(){

    }

function staff_documents(Request $request){
	
    $params = $request->query->all();
    if(@$params['status'] == '0'){
        $data['employee'] = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->where('option',0)->orderBy('userid', 'desc')->where('user_info.status','!=',2);
    }else if(@$params['status'] == '1'){
        $data['employee'] = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->where('option',1)->orderBy('userid', 'desc')->where('user_info.status','!=',2);
    }else if(@$params['status'] == '2'){
        $data['employee'] = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->where('option',2)->orderBy('userid', 'desc')->where('user_info.status','!=',2);
    }else{
        $data['employee'] = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->orderBy('userid', 'desc')->where('user_info.status','!=',2);

    }
    

    $data['js_file'] = 'staff';
    $data['title'] = 'View All Staff Documents';
    return view('staff/staff_documents',$data);


}


public function staff_document_view(Request $request,$id=""){          

    	$user_id = encrypt_decrypt('decrypt',$id);
    	$check_user = User::where('userid',$user_id);

    	if($check_user->count() != 0){

	    		$data['document_list'] = Certificate::where('status',1)->get();
	    		$data['user_proof'] = UserDocument::where('user_id',$user_id)->where('status',1)->first();  
                $data['user_id'] = $id;
	    		$data['doc_id'] = UserDocument::where('user_id',$user_id)->where('status',1);
				$data['js_file'] = 'staff';
		        $data['title'] = 'Verify User Document';
		        return view('staff/staff_document_view',$data);
    	}else{
    		Session::flash('error', 'Invalid User !!');
	    	return redirect()->back();
    	}
    }

    function approve_document($user_id="",$type=""){

        $user_id = encrypt_decrypt('decrypt',$user_id);
        $type = encrypt_decrypt('decrypt',$type);
        $check_user = UserDocument::where('user_id',$user_id);

        notification(['user_id' => $user_id, 
                             'type' => 0,
                             'name' => get_user($user_id,'username'),
                             'title' => 'Approved Document' , 
                             'message' => get_user($user_id,'username').' Approved the Document -'.$type.'.', 
                             'link'       => URL::to('').'/employees/employee_proof',
                             'created_at' => date('Y-m-d H:i:s')]) ;

            if($check_user->count() != 0){
                $get_document = $check_user->first();

                $data = unserialize($get_document->document);
              
                $data[$type] = [
                    $type.'_image' => $data[$type][$type.'_image'],
                    $type.'_status' => 1,
                    $type.'_reason' => ''
                 ];
                 
                 $update = UserDocument::where('user_id',$user_id)->update(['document' => serialize($data),'option' => 0]);
                
                 Session::flash('success', 'Staff Document Approved Successfully');
                 return redirect()->back();

            }else{
                Session::flash('error', 'Invalid User !!');
	    	    return redirect()->back();
            }


    }


    public function rejected_document(Request $request,$user_id="",$type=""){
  
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validatedData = $request->validate([
                 'comment' => 'required',
                 'doc_id' => 'required',
                 'document_name' => 'required',
             ], [
                 'comment.required' => 'Please Enter the Comment',
             ]);      

            
            $rejected_cmt = $request->comment;
            $type = $request->document_name;
            $id = $request->doc_id;            
            
            $check_user = UserDocument::where('id',$id);           
             
            if($check_user->count() != 0){
                $get_document = $check_user->first();

                $data = unserialize($get_document->document);
              
                $data[$type] = [
                    $type.'_image' => $data[$type][$type.'_image'],
                    $type.'_status' => 2,
                    $type.'_reason' => $rejected_cmt
                 ];
                 
                 $update = UserDocument::where('id',$id)->update(['document' => serialize($data),'option' => 0]);
                

                 notification(['user_id' => $get_document->user_id, 
                  'type' => 0,
                  'name' => get_user($get_document->user_id,'username'),
                  'title' => 'Rejected - '.$type.'.' , 
                  'message' => 'Your '.$type.' Document Rejected. Reason:- '.$rejected_cmt.'.',              
                  'created_at' => date('Y-m-d H:i:s'),
                  'link'       => URL::to('').'/employees/employee_proof'
                  ]) ;

                 Session::flash('success', 'Staff Document Rejected Successfully');
                 return redirect()->back();

            }else{
                Session::flash('error', 'Invalid User !!');
	    	    return redirect()->back();
            }

            // if($type == 'status'){
            //     $update_data = ['status' => 2,'status' => $rejected_cmt];
            //     UserDocument::where('id',$user_id)->update($update_data);               
            //     return redirect()->back()->with('success', 'Rejected successfully');
            // }           
      
    }
    }

    function update_notify(Request $request){

        $id = $request->notification_id;

        $get_record = Notification::where('id',$id)->where('status',1);

        if($get_record->count() != 0){

             $res =  Notification::where('id', $id)->update(['status' => 0]);
             if($res){
                 echo json_encode(['status' => 1,'msg' => ($request->link != '') ? (String) $request->link : '']); die;
             }else{
                 echo json_encode(['status' => 0,'msg' => 'Invalid Notification Link']); die;
             }

        }else{
          echo json_encode(['status' => 0,'msg' => 'Invalid Notification Link']); die;
        }
        
 }
}
// ,'working_days.status','created_at','id','document','status','option'
// $data['employee'] = User::where('status', '!=',2);

?>