<?php 
namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Report;
use App\Models\Certificate;
use App\Models\UserDocument;
use App\Models\Notification;
use Redirect;
use URL;
use DB;
use Illuminate\Support\Facades\Mail;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;


class EmployeeReportController extends Controller{  

    public function __construct(){

    }
    
 
    public function index(Request $request){


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validatedData = $request->validate([
                'date' => 'required',
                'task' => 'required',
                'role' => 'required',
                'description' => 'required',
                'source_code' => 'required',
                'dailytask' => 'nullable|file|mimes:zip,rar,7zip|max:10240', 
            ], [
                'date.required' => 'Please Enter Today Date',
                'task.required' => 'Please Enter Today Task',
                'role.required' => 'Please Select Role',
                'description.required' => 'Please enter Your Task Description',
                'dailytask.required' => 'Please Upload a File',
                'dailytask.mimes' => 'The file must be a .zip, .rar, or .7zip file',
                'dailytask.max' => 'The file size must not exceed 10MB',
            ]);

                $task = $request['task'];
                $date = date('d-m-Y',strtotime($request['date']));
                $description = $request['description'];
                $frommail = $request['frommail'];
                $to_email = encrypt_decrypt('encrypt',$request['to_email']);  
                $dailytask = $request['dailytask'];
                $user_id = emp_user_id();
                $source_code = $request['source_code'];
                $filePath = null;

                if ($request->hasFile('dailytask')) {
                    $file = $request->file('dailytask');
                    
                    try {
                        // Upload file to Cloudinary
                        $uploadResponse = (new Cloudinary())->uploadApi()->upload($file->getRealPath(), [
                            'folder' => 'projects',
                            'resource_type' => 'raw',
                        ]);
                        $filePath = $uploadResponse['secure_url']; // Publicly accessible URL
                    } catch (\Exception $e) {
                        return back()->withErrors(['upload_error' => 'Failed to upload file: ' . $e->getMessage()]);
                    }
                }

                        $inserData = [
                            'user_id' => $user_id,
                            'task' => $task,
                            'description' => $description,
                            'start_date' => $date.' / '.date('h:i:s:a'),
                            'status' => 'start',
                            'created_at' => date('d-m-Y h:i:s'),
                            'file_path' => $filePath,
                            'source_code' => $source_code
                        ];

                

                       $res =  Report::insert($inserData);

                       if($res){

                            Session::flash('success', 'Task Created Successfully');
                            return redirect()->back();
                       }else{
                            Session::flash('error', 'Task Created Invalid');
                            return redirect()->back();
                       }
                        
        }

    	$data['user'] = User::select('username','email','position')->where('userid',emp_user_id())->first();
        $data['report'] = Report::where('user_id',emp_user_id())->orderBy('id', 'desc');

         // $data['report'] = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid',user_id())->orderBy('id', 'desc');

  

        $data['js_file'] = 'report';
        $data['title'] = 'Working Report';
        return view('employee/working_report',$data);

    }

    function get_edit_report($id){

        $report = DB::table('user_info')->select('id','userid','employee_id','username','task',
        'description','start_date','end_date','working_hours', 
        'source_code', 'report.status','created_at')->join('report', 
        'user_info.userid', '=', 'report.user_id')->where('userid',emp_user_id())->where('id',$id)->first();
        
        


        if($report){
            $get_date = explode('/',$report->start_date);
            $date = $get_date[0];
            $array = [
                'id' => $report->id,
                'description' => $report->description,
                'task' => $report->task,
                'start_date' => date('Y-m-d',strtotime($date)),
                'source_code' => $report->source_code,
                'status' => 1
            ];

            echo json_encode($array);
        }else{
            $array = [
                'id' => $report->id,
                'description' => $report->description,
                'task' => $report->task,
                'start_date' => $report->start_date,
                'source_code' => $report->source_code,
                'status' => 0
                
            ];

            echo json_encode($array);
        }
        

    }

    function edit_working_report(Request $request){

         $validatedData = $request->validate([
                'date' => 'required',
                'task' => 'required',
                'description' => 'required',
            ], [
                'date.required' => 'Please Enter Today Date',
                'task.required' => 'Please Enter Today Task',
                'description.required' => 'Please enter Your Task Description',
            ]);

            $id = $request['id'];
            $task = $request['task'];
            $date = $request['date'];
            $description = $request['description'];
            $user_id = emp_user_id();

            $updateData = [
                'task' => $task,
                'description' => $description,
                'start_date' => date('d-m-Y',strtotime($date)).' / '.date('h:i:s:a'),
            ];

           
           $res =  Report::where('id', $id)->update($updateData);

           if($res){
                Session::flash('success', 'Task Updated Successfully');
                return redirect()->back();
           }else{
                Session::flash('error', 'Task Updated Invalid');
                return redirect()->back();
           }

    }





    function employee_proof(Request $request){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){


        $validatedData = $request->validate([
            'type' => 'required',
        ], [

            'type.required' => 'Choose Upload Proof Type',
        ]);


            if(empty($request->file('proof'))){
                Session::flash('error', 'Please Upload Document Image');
                return redirect()->back();
            }   

            $type = $request['type'];

            $user_id = Session::get("empuser_id");
           
            // $link =  link_url();
            $document = UserDocument::where('user_id',$user_id);
            if($document->count() != 0){
                $document = $document->first();
                $data = unserialize($document->document);

                if(@$data[$type]){
                    
                    if($data[$type][$type.'_status'] == 0 || $data[$type][$type.'_status'] == 1){
                        Session::flash('error', 'Already '.$type.' Document Uploaded');
                        return redirect()->back();
                    }

                }
            }

            $img_extention = $request->file('proof')->getClientOriginalExtension();

                $in_array = in_array($img_extention, ['jpg','jpeg','png','JPG','JPEG','PNG']);

                if($in_array != 1){
                    Session::flash('error', 'Image Upload Extention Allow Only jpg ,jpeg ,png');
                    return redirect()->back();
                }


            $upload = cloudinary()->upload($request->file('proof')->getRealPath(),['folder' => 'staff_documents/'])->getSecurePath();

            
            notification(['user_id' => $user_id, 
                             'type' => 1, 
                             'name' => Session::get("empusername"),
                             'title' => 'New Upload Document' ,     
                             'message' => Session::get("empusername").' Update The Document -'.$type.'.', 
                             'created_at' => date('Y-m-d H:i:s'),
                             'link'       => URL::to('').'/staff_document_view/'.encrypt_decrypt("encrypt",$user_id),
                        ]) ;
                if($upload){                    
                    
                    $res = employee_upload_proof_serialize($user_id,$type,$upload);

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
            $data['user_proof'] = UserDocument::where('user_id',Session::get("empuser_id"))->where('status',1);

            // $data['user_id'] = $id;
            
            $data['js_file'] = 'employee_proof';
            $data['title'] = 'Employee Proof';
            return view('employee/employee_proof',$data);

        
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



    public function updateSrccode($id)
{
    // Fetch the report using the given ID
    $data['updateSrc'] = Report::where('id', $id)->first();


            
            $data['js_file'] = 'srcupdate';
            $data['title'] = 'Source Code Updated';
            return view('employee/source-code-update',$data);

    }

}




?>