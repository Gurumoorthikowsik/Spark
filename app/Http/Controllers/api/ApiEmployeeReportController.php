<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roll;
use App\Models\Report;
use App\Models\Certificate;
use App\Models\UserDocument;
use App\Models\Notification;
use Redirect;
use URL;
use DB;
use Illuminate\Support\Facades\Validator;


class ApiEmployeeReportController extends Controller{  

    public function __construct(){
       
    }
    
    function employeesubmit(Request $request){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){


        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'type' => 'required',
            'proof' => 'required'
        ], [

            'type.required' => 'Choose Upload Proof Type',
        ]);


        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }

            $type = $request['type'];
            $proof = $request['proof'];
            $user_id = $request['user_id'];
           
            // $link =  link_url();
            $document = UserDocument::where('user_id',$user_id);
            if($document->count() != 0){
                $document = $document->first();
                $data = unserialize($document->document);

                if(@$data[$type]){
                    
                    if($data[$type][$type.'_status'] == 0 || $data[$type][$type.'_status'] == 1){
                        return apiResponse(0, 'Already '.$type.' Document Uploaded');
                       
                    }

                }
            }

            

                if($proof){   

                    notification(['user_id' => $user_id, 
                             'type' => 1, 
                             'name' => get_user($user_id,'username'),
                             'title' => 'New Upload Document' ,     
                             'message' => get_user($user_id,'username').' Update The Document -'.$type.'.', 
                             'created_at' => date('Y-m-d H:i:s'),
                             'link'       => URL::to('').'/staff_document_view/'.encrypt_decrypt("encrypt",$user_id),
                        ]) ;

                    $res = employee_upload_proof_serialize($user_id,$type,$proof);

                    if($res){

                        return apiResponse(1, 'Staff '.$type.' Proof Upload Successfully');
                        
                    }else{
                        return apiResponse(0, 'Staff Proof Upload Some Error !!');
                       
                    }

                }else{
                    return apiResponse(0, 'Staff Proof Upload Some Error !!');
                  
                }

        }


}


    function employeeproof(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
            }

            $user_id = $request['user_id'];
            $document_list = Certificate::where('status',1)->get();
            $user_proof = UserDocument::where('user_id', $user_id)->where('status',1);
            $i = 1;
            $out = [];
            if($user_proof->count() != 0){ 
                $decode = unserialize($user_proof->first()->document);
                
                foreach($decode as $key => $value){

                    if($value[$key.'_status'] == 0){
                        $status = 'Pending';
                    }else if($value[$key.'_status'] == 1){
                        $status = 'Approved';
                    }else if($value[$key.'_status'] == 2){
                        $status = 'Rejected';       
                    }

                    $out[$key]['Proof_name'] = $key;
                    $out[$key]['image'] = $value[$key.'_image'];
                    $out[$key]['status'] = $status;
                    $out[$key]['rejected_reason'] = (@$value[$key.'_status'] == 2) ? $value[$key.'_reason'] : '';

                    $i++;

                }
            }
        
            return apiResponse(1,'success',['Employee Document' =>($out) ? $out : null]);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

    }
    




    function employeeprooftype(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
            }

            
            $document_list = Certificate::where('status',1)->get();

            $in = []; 
            foreach ($document_list as $key =>  $value){
                $in[$key]['certificate_type']  = $value->types;
            }
        
            return apiResponse(1,'success',['Employee Document Type' =>($in) ? $in : 'Record Not Found !!']);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

    }
        

    function index(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            
        ]);
            

            if($validator->fails()){
                $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
            }

            $user_id = $request['user_id'];
            $user = User::select('username','email','position')->where('userid',$user_id)->first();
            $report = Report::where('user_id', $user_id)->orderBy('id', 'desc');

            if($report->count() != 0){
                $i = 1;
                $out = [];  
                $reports = $report->get(); 
                foreach ($reports as $key => $value){
                
                    $out[$key]['s_no'] = $i;
                    $out[$key]['taskname'] = $value['task'];
                    $out[$key]['description'] = $value['description'];
                    $out[$key]['created_on'] = date('d-m-Y H:i:s',strtotime($value['created_at']));
                    $out[$key]['edit_at'] = $value['id'];
                    $i++;

                }
       
            }else{
                $out = [];
            }


            return apiResponse(1,'success',['Employee Report' => ($out) ? $out : []]);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

    }
        


public function reportsubmit(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'date' => 'required',
            'task' => 'required',
            'role' => 'required',
            'description' => 'required',
        ], [
            'date.required' => 'Please Enter Today Date',
            'task.required' => 'Please Enter Today Task',
            'role.required' => 'Please Select Roll',
            'description.required' => 'Please enter Your Task Description',
        ]);
        
        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }
            $task = $request['task'];
            $date = date('d-m-Y',strtotime($request['date']));
            $description = $request['description'];
            $user_id =  $request['user_id'];

                    $inserData = [
                        'user_id' => $user_id,
                        'task' => $task,
                        'description' => $description,
                        'start_date' => $date.' / '.date('h:i:s:a'),
                        'status' => 'start',
                        'created_at' => date('d-m-Y h:i:s'),
                    ];

                   $res =  Report::insert($inserData);

                   if($res){
                    return apiResponse(1, 'Task Created Successfully');
                      
                   }else{
                    return apiResponse(0, 'Task Created Invalid');
                       
                   }
                    
    } 

}

function editworkingreport(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'edit_id' => 'required',
            'date' => 'required',
            'task' => 'required',
            'description' => 'required',
        ], [
            'date.required' => 'Please Enter Today Date',
            'task.required' => 'Please Enter Today Task',
            'description.required' => 'Please enter Your Task Description',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }


        $id = $request['edit_id'];
        $task = $request['task'];
        $date = $request['date'];
        $description = $request['description'];
        $user_id = $request['user_id'];

        $updateData = [
            'task' => $task,
            'description' => $description,
            'start_date' => date('d-m-Y',strtotime($date)).' / '.date('h:i:s:a'),
        ];

       
       $res =  Report::where('id', $id)->update($updateData);

       if($res){
        return apiResponse(1, 'Task Updated Successfully');
          
       }else{
        return apiResponse(0, 'Task Updated Invalid');
          
       }

    }

}


function geteditreport(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
             'edit_id' => 'required'
        ]);
   
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }
           $user_id = $request['user_id'];
           $id = $request['edit_id'];

           $report = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid', $user_id)->where('id',$id)->first();
        
           if($report){
               $get_date = explode('/',$report->start_date);
               $date = $get_date[0];
               $array = [
                   'id' => $report->id,
                   'description' => $report->description,
                   'task' => $report->task,
                   'start_date' => date('Y-m-d',strtotime($date)),
                   'status' => 1
               ];
   
               echo json_encode($array);
           }else{
               $array = [
                   'id' => $report->id,
                   'description' => $report->description,
                   'task' => $report->task,
                   'start_date' => $report->start_date,
                   'status' => 0
               ];
   
               echo json_encode($array);
           }

    }

}



function update_notify(Request $request){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
    $validator = Validator::make($request->all(),[
        'user_id' => 'required',
        'notification_id' => 'required'
        ]);

    if($validator->fails()){
        $errors = $validator->errors()->first();
        return apiResponse(0,$errors);
    }    
    $id = $request->notification_id;

    $get_record = Notification::where('id',$id)->where('status',1);

    if($get_record->count() != 0){

         $res =  Notification::where('id', $id)->update(['status' => 0]);
         if($res){
            return apiResponse( 1,  'success'); die;
         }else{
            return apiResponse( 0, 'Invalid'); die;
         }

    }else{
        return apiResponse( 0,'Invalid Notification'); die;
    }
    
}

 }

}

?>