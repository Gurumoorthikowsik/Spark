<?php 
namespace App\Http\Controllers\api;

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
use Illuminate\Support\Facades\Validator;


class ApiHrStaffdocumentController extends Controller{  

    public function __construct(){
       
    }
    
    function staffdocuments(Request $request){
	
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
        $params = $request->query->all();
        if(@$params['status'] == '0'){
            $employee = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->where('option',0)->orderBy('userid', 'desc')->where('user_info.status','!=',2);
        }else if(@$params['status'] == '1'){
            $employee= DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->where('option',1)->orderBy('userid', 'desc')->where('user_info.status','!=',2);
        }else if(@$params['status'] == '2'){
            $employee = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->where('option',2)->orderBy('userid', 'desc')->where('user_info.status','!=',2);
        }else{
            $employee = DB::table('user_document')->select('user_info.userid','user_info.username','user_info.email','user_info.employee_id','user_info.position','option')->rightJoin('user_info', 'user_info.userid', '=', 'user_document.user_id')->orderBy('userid', 'desc')->where('user_info.status','!=',2);
    
        }
        
        if($employee->count() != 0){
            $i = 1;
            $out = []; 
            foreach ($employee->get() as $key => $value){

                if($value->option == '1'){
                    $status= 'Approved';
                }elseif($value->option == '0'){
                    $status= 'Pending';  
                }elseif($value->option == '2'){
                    $status= 'Rejected'; 
                }else{
                    $status= 'Not Uploaded';   
                }
                
                $out[$key]['s_no'] = $i;
                $out[$key]['user_id'] = $value->userid;
                $out[$key]['employee_id'] = $value->employee_id;
                $out[$key]['username'] = $value->username;
                $out[$key]['email_id'] = encrypt_decrypt('decrypt',$value->email);
                $out[$key]['role'] = get_roll($value->position);
                $out[$key]['document_status'] = $status;
               
                $i++;
               

            }
        }else{
            $out = [];
        }
            return apiResponse(1,'success',['View Staff Document' =>($out) ? $out :[]]);

       
      
        }
        else{
            return apiResponse(0,'Invalid Request Method');
        }
    
    }

    public function staffdocumentview(Request $request){    
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'visit_user_id' => 'required',
                // 'document_action'=>'required'
			]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }
         
        $id = $request['visit_user_id'];  
    	$user_id =$id;
    	$check_user = User::where('userid',$user_id);

    	if($check_user->count() != 0){

	    		$document_list = Certificate::where('status',1)->get();
	    		$user_proof = UserDocument::where('user_id',$user_id)->where('status',1)->first();  
                $user_id = $id;
	    		$doc_id = UserDocument::where('user_id',$user_id)->where('status',1);


                if(@$user_proof->document) {
                    $out = [];  
                    $document_status = 1;  $result = unserialize($user_proof->document);
                    foreach($result as $key =>  $value){
                        if($value != ''){

                            if($value[$key.'_status'] == 0){
                                $document_status = 0;
                            }else if($value[$key.'_status'] == 2){
                                $document_status = 2;
                            } 
                            if($value[$key.'_status'] == 0){
                                $status='Pending';
                            }elseif($value[$key.'_status'] == 1){
                                $status='Approved';
                            }elseif($value[$key.'_status'] == 2){
                                $status='Rejected';   
                            }else{
                                $status='Not Uploaded';   
                            }
                            
                            $out[$key]['doc_id'] = $doc_id->first()->id;
                            $out[$key]['Proof_link'] = $value[$key.'_image'];
                            $out[$key]['image'] = $value[$key.'_image'];
                            $out[$key]['proof_name'] = $key;
                            $out[$key]['status'] = $status;
                            $out[$key]['rejected_reason'] = (@$value[$key.'_reason'] != '') ? 'Rejected Reason: '.$value[$key.'_reason'] : '';
                            $out[$key]['approved_key'] = ($status == 'Pending') ? encrypt_decrypt('encrypt',$key) : "";
                          
                          
                        }
                    }
                }else{
                    $out = [];
                }			
                return apiResponse(1,'success',['Document' => ($out) ? $out : []]);
    	}else{
            return apiResponse(0, 'Invalid User !!');
	    	
    	}
    }


    }


   
    function approvedocument(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
               'approved_key'=>'required'
			]);


            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

          
        $user_id = $request['user_id'];
        $type = encrypt_decrypt('decrypt',$request['approved_key']);
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
                
                  return apiResponse(1, 'Staff Document Approved Successfully');
                 

            }else{
                return apiResponse(0, 'Invalid User !!');
	    	  
            }

        }
    }

    public function rejecteddocument(Request $request){
  
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                 'comment' => 'required',
                 'doc_id' => 'required',
                 'proof_name' => 'required',
             ], [
                 'comment.required' => 'Please Enter the Comment'
             ]);  
             
            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }    

            
            $rejected_cmt = $request->comment;
            $type = $request->proof_name;
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

                  return apiResponse(1, 'Staff Document Rejected Successfully');
               

            }else{
                return apiResponse(0, 'Invalid User !!');
	    	   
            }

             
      
    }
    }

 }



?>