<?php 
namespace App\Http\Controllers;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;
use URL;
use Session;
use App\Models\User;
use App\Models\Leave;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Notification;
use App\Models\Roll;
use App\Models\Project;
use App\Models\StudentCertificate;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;

class LeaveController extends Controller{

	public function __construct(){
       
    }
    
    public function index(){

        $curr_month = date('m');
    	$data['user_leave'] =  User::select('userid','username','email','employee_id')->where('status','!=',2)->orderBy('userid', 'desc');

        $data['js_file'] = 'leave';
        $data['title'] = 'Leave Management';
        return view('leave/leave',$data);
    }

    function leave_request(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validatedData = $request->validate([
                 'status' => 'required',
             ], [
                 'status.required' => 'Please Choose Status',
             ]);
 
             $status  = $request['status'];
             $id = $request['id'];  
 
             $leave_data = Leave::select('user_id','leave_date','day','updated_at')->where('id',$id)->where('status','Pending');

                    if($status == 'Approved'){
                       
                        
                        
                            if($leave_data->count() != 0){
                                $leave_data = $leave_data->first();

                                $working_hrs = (employee_get_user($leave_data->user_id,'working_hrs') != '') ? employee_get_user($leave_data->user_id,'working_hrs') : '08:00';

                                if($leave_data->day == '0.5'){

                                    if($working_hrs == '12:00'){
                                        $hours = '05:30:00';
                                    }else if($working_hrs == '08:00'){
                                        $hours = '04:00:00';
                                    }else{
                                        $hours = '04:00:00';
                                    }

                                }else{

                                    if($working_hrs == '12:00'){
                                        $hours = '12:00:00';
                                    }else if($working_hrs == '08:00'){
                                        $hours = '08:00:00';
                                    }else{
                                        $hours = '08:00:00';
                                    }

                                }

                                $from_time = date('d-m-Y',strtotime($leave_data->leave_date)).' '.'00:00:00';
                                $to_date = date('d-m-Y',strtotime($leave_data->leave_date)).' '.'00:00:00';

                                $insertData = [
                                    'user_id' => $leave_data->user_id,
                                    'from_event_id' => 10,
                                    'from_event'    => 'Leave',
                                    'from_time'     => $from_time,
                                    'to_event_id'   => 10,
                                    'to_event'      => 'Leave',
                                    'to_time'       => $to_date,
                                    'date'          => date('Y-m-d',strtotime($leave_data->leave_date)),
                                    'hours'         => $hours,
                                    'created_at'    =>  date('Y-m-d',strtotime($leave_data->leave_date)).' '.date('H:i:s'),

                                ];

                                Attendance::insert($insertData);
                                $updatedData = [
                                     'status' => $status,
                                ];
     
                                $res = Leave::where('id',$id)->update($updatedData); 

                                $day = ($leave_data->day == '0.5') ? 'Half Day' : 'Full Day';
                                $others = $day." Leave (Date : ".$leave_data->leave_date.")";
                                serialize_attentance($leave_data->leave_date,'other',$leave_data->user_id,$others,$hours);

                                notification(['user_id' => $leave_data->user_id,
                                'type' => 0,
                                'name' => employee_get_user($leave_data->user_id,'username'),
                                'title' => 'Permisson Message' , 
                                'message' => employee_get_user($leave_data->user_id,'username').' '.'Leave Approved'.' '.date('Y-m-d',strtotime($leave_data->updated_at)),  
                                'link'       => URL::to('').'/employees/permission',
                                'created_at' => date('Y-m-d H:i:s')]) ;
                                                       

                            }else{
                                Session::flash('error', 'Leave Request Invalid date');
                                return redirect()->back();
                            }
                        

                    }else{

                        $leave_data = $leave_data->first();

                        $updatedData = [
                             'status' => $status,
                        ];
     
                        $res = Leave::where('id',$id)->update($updatedData);
                        
                        notification(['user_id' => $leave_data->user_id,
                        'type' => 0,
                        'name' => employee_get_user($leave_data->user_id,'username'),
                        'title' => 'Permisson Message' , 
                        'message' => employee_get_user($leave_data->user_id,'username').' '.'Leave Rejected'.' '.date('Y-m-d',strtotime($leave_data->updated_at)), 
                        'link'       => URL::to('').'/employees/permission',
                        'created_at' => date('Y-m-d H:i:s')]) ;

                    }

             
                 if($res){
                     Session::flash('success', 'Leave '.$status.' Successfully');
                     return redirect()->back();
                 }else{
                     Session::flash('error', 'Leave '.$status.' Invalid');
                     return redirect()->back();
                 }
 
          }
 
          $params = $request->query->all();
       
             $curr_month = date('Y');
             $previous_month = date('Y-m', strtotime("-1 month"));
             $startDate = new Carbon($previous_month.'-29');
             $endDate = new Carbon(date('Y-m-'.'31'));
              if(@$params['status'] == 'Pending'){
     
                 $data['leave_request'] =  DB::table('leave')->select('user_id','leave_date','day','Section','leave.status','created_at','id','day','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->whereYear('created_at','=',$curr_month)->whereBetween('created_at', [$startDate, $endDate])->where('leave.status','Pending')->orderBy('id', 'desc');
              }else if(@$params['status'] == 'Approved'){
                 $data['leave_request'] =  DB::table('leave')->select('user_id','leave_date','day','Section','leave.status','created_at','id','day','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->whereYear('created_at','=',$curr_month)->whereBetween('created_at', [$startDate, $endDate])->where('leave.status','Approved')->orderBy('id', 'desc');
              }else{
                 $data['leave_request'] =  DB::table('leave')->select('user_id','leave_date','day','Section','leave.status','created_at','id','day','reason','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'leave.user_id')->whereYear('created_at','=',$curr_month)->orderBy('id', 'desc');   
              }
 
              $data['js_file'] = 'permission';
              $data['title'] = 'Staff Leave Request';
              return view('leave/leave_request',$data);
   }


   function leave_notify(Request $request){

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


function read_notify(){    
    Notification::where('type',1)->where('status',1)->update(['status' => 0]);
    return redirect()->back();
}




public function getStudentsByRole(Request $request)
{
    $roll = $request->input('roll');
    $batch = $request->input('batch');

    // Check if both role and batch are provided
    $studentsQuery = User::where('status', 1)
                         ->where('Areyoustudent', 1);

    // Filter by position (role)
    if ($roll) {
        $studentsQuery->where('position', $roll);
    }

    // Filter by batch number
    if ($batch) {
        $studentsQuery->where('batch_number', $batch);
    }

    // Get the students' details (userid and username)
    $students = $studentsQuery->get(['userid', 'username']);

    // Return the students as a JSON response
    if ($students->isNotEmpty()) {
        return response()->json([
            'success' => true,
            'students' => $students // Send all details as an array of objects
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'No students found for this role and batch.'
    ]);
}




public function projectadd(){



    $data['roll'] = Roll::select('roll')->where('status',1)->where('Areyoustudent',1)->get();


    $data['students'] = User::select('userid','username', 'position',  'batch_number', 'created_date')->where('status',1)->where('Areyoustudent',1)->get();



    $data['js_file'] = 'project';
    $data['title'] = 'Project Management';
    return view('project.create-project',$data);

}




public function addproject(Request $request)
{
    // Validation
    $validated = $request->validate([
        'roll' => 'required',
        'batch' => 'required',
        'student_names' => 'required',
        'project' => 'required',
        'giturl' => 'required',
        'teamcount' => 'required',
        'file' => 'required|mimes:rar,zip|max:2048',
    ], [
        'roll.required' => 'Please select a staff role.',
        'batch.required' => 'Batch name is required.',
        'student_names.required' => 'At least one student must be selected.',
        'project.required' => 'Project name is required.',
        'giturl.required' => 'Git URL is required.',
        'file.required' => 'Please upload a project file (rar or zip).',
        'file.mimes' => 'The project file must be a .rar or .zip file.',
        'file.max' => 'The file size must be less than or equal to 2MB.',
    ]);
    



    // Initialize Cloudinary
    $cloudinary = new Cloudinary();

    // Handle file upload (to Cloudinary)
    $filePath = null;
    if ($request->hasFile('file')) {
        // Get the uploaded file
        $file = $request->file('file');
        
        // Upload the file to Cloudinary
        $uploadResponse = $cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => 'projects', // Cloudinary folder (optional)
            'resource_type' => 'auto', // Automatically detect the file type (image, video, or raw)
        ]);

        // Get the URL of the uploaded file
        $filePath = $uploadResponse['secure_url'];
    }

    // Get input values
    $studentid = $request->input('student_names');
    $roll = $request['roll'];
    $batch = $request['batch'];
    $project = $request['project'];
    $giturl = $request['giturl'];
    $teamCount = $request['teamcount'];

    $projectId = $request['projectId'];
    $existingProject = Project::where('projectId', $projectId)->first();

    if ($existingProject) {

        Session::flash('error', 'Project ID already exists');
        return redirect()->back();
    }else{

            // Loop through student names and insert project data
    $responseMessages = [];
    
    foreach ($studentid as $studentName) {
        $insertData = [
            'user_id' => $studentName, // Assuming the user is logged in
            'projectId' => $projectId,
            'roll_name' => $roll,
            'username' => getuserName($studentName), // Using the student name here
            'project' => $project,
            'desc' => $project, // Assuming you have a project description
            'status' => 1,
            'git_url' => $giturl,
            'type' => 'Web',
            'team_count' => $teamCount,
            'project_file' => $filePath, // Save Cloudinary URL in the 'project_file' column
            'Areyoustudent' => 1,
            'created_at' => now(),
        ];


        // Insert data into the Project model
        Project::create($insertData);
        $responseMessages[] = "Project for $studentName has been successfully created.";
    }

    // Flash success message and redirect back
    Session::flash('success', 'Project Created Successfully');
    return redirect()->back();
    
    }



}


public function view_project(){

    
    $data['project'] = Project::select('user_id','roll_name', 'username',  'project', 'desc', 'status', 'git_url', 'project_file', 'created_at', 'updated_at')->first();


    $data['js_file'] = 'project Details';
    $data['title'] = 'Project Details';
    return view('project.project-view',$data);

}



public function view_Certificate_table(){

    
    $data['js_file'] = 'Admin Certificate';
    $data['title'] = 'Admin Certificate';
    return view('project.view-certificate',$data);

}


public function create_certificate(){

    
    $data['js_file'] = 'Add Certificate';
    $data['title'] = 'Add Certificate';
    return view('project.create-certificate',$data);

}

public function addcertificate(Request $request)
{
    // Validation
    $validated = $request->validate([
        'StudentId' => 'required',
        'Cname' => 'required',
        'CDate' => 'required',
        'coursename' => 'required',
        'file' => 'required',
    ], [
        'StudentId.required' => 'Please enter Student Id',
        'Cname.required' => 'Please enter a Student Certificate Name',
        'CDate.required' => 'Please enter Date',
        'coursename.required' => 'Please enter a coursename.',
    ]);

    // Initialize Cloudinary
    $cloudinary = new Cloudinary();

    // Handle file upload (to Cloudinary)
    $filePath = null;
    if ($request->hasFile('file')) {
        // Get the uploaded file
        $file = $request->file('file');
        
        // Upload the file to Cloudinary
        $uploadResponse = $cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => 'projects', // Cloudinary folder (optional)
            'resource_type' => 'auto', // Automatically detect the file type (image, video, or raw)
        ]);

        // Get the URL of the uploaded file
        $filePath = $uploadResponse['secure_url'];
    }

    // Get input values
    $studentid  = $request['StudentId'];
    $Cname = $request['Cname'];
    $CDate = $request['CDate'];
    $coursename = $request['coursename'];
    $file = $filePath;



    $certificateID = date('Y') . '-' . $studentid;


    $insertData = [
        'user_id' => getstudentid($studentid),
        'studentid' => $studentid,
        'Cname' => $Cname,
        'CDate' => $CDate,
        'coursename' => $coursename,
        'file' => $file,
        'certifacte_number' => $certificateID,
        'created_at' => now(),
        'updated_at' => now(),
    ];








    $StudentCertificate = StudentCertificate::create($insertData);

    if ($StudentCertificate) {
        Session::flash('success', 'Certificate created Successfully');
        return redirect()->back();
    } else {
        Session::flash('error', 'Something went wrong');
        return redirect()->back();
    }
}











}





