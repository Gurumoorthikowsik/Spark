<?php 
namespace App\Http\Controllers\Employee;

// use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use DB;
use Session;
use DateTime;
use URL;
use App\Models\User;
use App\Models\Permission;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\Bugs;
use Cloudinary\Cloudinary; 
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Myproject;



class EmployeePermissionController extends Controller
{  

    public function __construct(){

    }
    
    public function index(){

        $data['permission_details'] =  DB::table('permission')->select('user_id','permission_date','from_time','to_time','hours','permission.status','created_at','permission.updated_at','id','from_time','to_time','hours','resion','userid','email','username','employee_id')->Join('user_info', 'user_info.userid', '=', 'permission.user_id')->where('user_id',Session::get("empuser_id"))->orderBy('id', 'desc');

        $data['js_file'] = 'employee-permission';
        $data['title'] = 'Employee Permission Management';
        return view('employee/permission', $data);
    }

    function permission_submit(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

           $validatedData = $request->validate([
                'from_time' => 'required',
                'to_time' => 'required',
                'reason' => 'required',
            ], [
                'from_time.required' => 'Please Choose The From Time',
                'to_time.required' => 'Please Choose The To Time',
                'reason.required' => 'Please Enter The Permission Reason',
            ]);

                $pick_date = preg_split('/\s+/', $request['from_time']);
                $permission_date  = date('Y-m-d',strtotime($pick_date[0])); //$request['permission_date'];
                $from_time  = $request['from_time'];
                $to_time  = $request['to_time'];
                $reason  = $request['reason'];

                if($from_time >= $to_time){
                    $res = ['status' => 0,'msg' => 'Incorrect Time Format.From And To Time Mismatch !!'];
                    echo json_encode($res); die;
                }

                $from_time_split = preg_split('/\s+/', $from_time);
                $to_time_split = preg_split('/\s+/', $to_time);

                if($from_time_split[0] != $to_time_split[0]){
                    $res = ['status' => 0,'msg' => 'From And to Date Wrong'];
                    echo json_encode($res); die;
                }

                if($from_time_split[1] > $to_time_split[1]){
                    $res = ['status' => 0,'msg' => 'Choose Permission Time Is Wrong !!'];
                    echo json_encode($res); die;
                }

                $previous_month = date('Y-m', strtotime("-1 month"));
                $startDate = new Carbon($previous_month.'-29');
                $endDate = new Carbon(date('Y-m-'.'31'));

                    $now = strtotime(date('Y-m-d'));
                    if(strtotime($startDate) <= $now && $now <= strtotime($endDate)){

                     if(strtotime($to_time_split[0]) >= strtotime($startDate) && strtotime($to_time_split[0]) <= strtotime(date('Y-m-'.'28'))){

                
                    // choose to min convertion
                    $from_time_min = strtotime($from_time_split[1]);
                    $to_time_min = strtotime($to_time_split[1]);
                    $get_minutes = round(abs($to_time_min - $from_time_min) / 60,2);

                     // staff available permission time
                     $persmission = staff_permission_data(Session::get("empuser_id"));  
                     $persmission_res = json_decode($persmission);    

                     $user_id = Session::get("empuser_id");

                 if(in_array($get_minutes, ['120']) == 1){

                    $available_permission = $persmission_res->available;

                    if($available_permission >= $get_minutes){

                        $insertData = [
                            'user_id'   => Session::get("empuser_id"),
                            'permission_date' => $permission_date,
                            'from_time' => $from_time_split[1],
                            'to_time'   => $to_time_split[1],
                            'hours'     => $get_minutes,
                            'resion'    => $reason,
                            'created_at'=> date('Y-m-d H:i:s')
                        ];

                       $Insert = Permission::insert($insertData);
                       
                         notification([
                             'user_id' => $user_id, 
                             'type' => 1, 
                             'name' => Session::get("empusername"),
                             'title' => 'Permission' ,     
                             'message' => Session::get("empusername").' Request For Permission'.' '.date('Y-m-d'), 
                             'created_at' => date('Y-m-d H:i:s'),       
                             'link'       => URL::to('').'/permission_request?status=Pending',        
                        ]) ;
                       if($Insert){
                         $res = ['status' => 1,'msg' => 'Permission Submited Successfully'];
                         echo json_encode($res); die;
                       }else{
                          $res = ['status' => 0,'msg' => 'Permission Submited Invalid !!'];
                          echo json_encode($res); die;
                       }
                       

                    }else{
                         $res = ['status' => 0,'msg' => 'Your Available Permission '.$available_permission.' Minutes'];
                         echo json_encode($res); die;
                    }

                 }else{
                    $res = ['status' => 0,'msg' => 'The Minimum Of permit Taken Is 120 Min'];
                    echo json_encode($res); die;
                 }

                }else{
                    $res = ['status' => 0,'msg' => 'Error. Permission apply choose date '.date('Y-M-d',strtotime($startDate)).' to '.date('Y-M-28',strtotime($endDate))];
                    echo json_encode($res); die;
              }

             }else{

            $res = ['status' => 0,'msg' => 'Permission Apply this month before 31th'];
            echo json_encode($res); die;
         }


         }

    }

    function delete_permission($id){

        $id = encrypt_decrypt('decrypt',$id);

        $check_permission = Permission::where('status','Pending')->where('id',$id);

            if($check_permission->count() != 0){

                $delete = Permission::where('id', $id)->delete();

                if($delete){
                    Session::flash('success', 'Permission Delete Successfully');
                    return redirect()->back();
                }else{
                     Session::flash('error', 'Permission Delete Invalid !!');
                     return redirect()->back();
                }
            }else{
                 Session::flash('error', 'Edit Id Invalid');
                 return redirect()->back();
            }
    }

    function permission_notify(Request $request){

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



 public function task(){


    $userId = Session::get('empuser_id');


    $data['project'] = Project::select('user_id','roll_name', 'username',  'project', 'desc', 'status', 'git_url', 'type', 'project_file', 'created_at', 'updated_at')->where('user_id', $userId)->get();


    $data['js_file'] = 'task-assign';
    $data['title'] = 'Task Management';
    return view('employee.task-assign', $data);
 }


 public function taskboard(){
    // Fetch the tasks from the database
    $bugs = Bugs::select('id', 'bugs_name', 'bugs_desc', 'module_name', 'Status', 'image', 'created_at')->get();

    // Pass the data to the view
    $data['bugs'] = $bugs;
    $data['js_file'] = 'Task Board';
    $data['title'] = 'Task Board';
    
    return view('employee.task-board', $data);
}


 public function Bugsmake(){

    $data['js_file'] = 'Create Bugs';
    $data['title'] = 'Create Bugs';
    return view('employee.make-bugs', $data);

 }


 public function addbugs(Request $request)
 {
     $validated = $request->validate([
         'bug_name' => 'required',
         'bug_desc' => 'required',
         'module_name' => 'required',
         'status' => 'required',
         'bug_images' => 'required|image', // Added image validation
     ], [
         'bug_name.required' => 'Enter the Bug Name.',
         'bug_desc.required' => 'Enter the Bug Desc.',
         'module_name.required' => 'Enter your Module Name.',
         'status.required' => 'Enter the Status.',
         'bug_images.required' => 'Upload the Image.',
         'bug_images.image' => 'The uploaded file must be an image.', // Image validation error
     ]);
 
     // Getting request values
     $bug_name = $request->input('bug_name');
     $bug_desc = $request->input('bug_desc');
     $module_name = $request->input('module_name');
     $status = $request->input('status');
     $bug_images = $request->file('bug_images'); // Getting the uploaded image
 
     // Initialize Cloudinary
     $cloudinary = new Cloudinary();
 
     // Handle file upload to Cloudinary
     $filePath = null;
     if ($bug_images) {
         // Upload the file to Cloudinary
         $uploadResponse = $cloudinary->uploadApi()->upload($bug_images->getRealPath(), [
             'folder' => 'projects', // Cloudinary folder (optional)
             'resource_type' => 'auto', // Automatically detect the file type (image, video, or raw)
         ]);
         
         // Get the URL of the uploaded file
         $filePath = $uploadResponse['secure_url'];
     }
 
     // Prepare the data for insertion
     $insertData = [
         'bugs_name' => $bug_name,
         'bugs_desc' => $bug_desc,
         'module_name' => $module_name,
         'Status' => $status,
         'image' => $filePath,
         'created_at' => date('Y-m-d H:i:s'),
     ];

     echo "<pre>";
     print_r($insertData);
 
     Bugs::create($insertData);
 
     Session::flash('success', 'Project Created Successfully');
     return redirect()->back();

 }





public function updateStatusboard(Request $request)
{


    $request->validate([
        'id' => 'required|exists:bugs,id',
        'status' => 'required|integer|in:0,1,2,3',
    ]);

    $bug = Bugs::find($request->id);

    $bug->status = $request->status;
    $bug->save();

    return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
}



public function certificate_view(){



    $data['js_file'] = 'Certificate';
    $data['title'] = 'Certificate';
    return view('employee.Certificate', $data);

}



public function myprojects(){



$data['js_file'] = 'myprojects';
$data['title'] = 'My Projects';
return view('Template.create-student-template', $data);

}


public function createmypro(Request $request)
{
    $validated = $request->validate([
        'template_name' => 'required',
        'desc' => 'required',
        'status' => 'required',
        'screenshot' => 'required',
        'file' => 'required|file|mimes:zip,rar,html,css,js|max:2048', // Allow ZIP, RAR, HTML, CSS, and JS files
    ], [
        'template_name.required' => 'Enter the Template Name.',
        'desc.required' => 'Enter the Description.',
        'status.required' => 'Select the Status.',
        'file.mimes' => 'Only ZIP, RAR, HTML, CSS, or JS files are allowed.',
    ]);


    // Handle uploaded file
    $file = $request->file('file');
    $extension = $file->getClientOriginalExtension();
    $fileName = time() . '.' . $extension;
    $filePath = $file->storeAs('uploads', $fileName);
    



    $htmlContent = '';
    $cssContent = '';
    $jsContent = '';

    if ($extension === 'zip' || $extension === 'rar') {
        $extractPath = storage_path('app/extracted/' . time());

        if ($extension === 'zip') {
            $zip = new ZipArchive();
            if ($zip->open(storage_path('app/' . $filePath)) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                return back()->with('error', 'Failed to extract the zip file.');
            }
        } else {
            return back()->with('error', 'RAR extraction is not supported out of the box.');
        }

        // Search for HTML, CSS, and JS files in the extracted folder
        $files = File::allFiles($extractPath);

        foreach ($files as $file) {
            $ext = $file->getExtension();
            if ($ext === 'html') {
                $htmlContent = File::get($file);
            } elseif ($ext === 'css') {
                $cssContent = File::get($file);
            } elseif ($ext === 'js') {
                $jsContent = File::get($file);
            }
        }
    } elseif (in_array($extension, ['html', 'css', 'js'])) {
        // Handle single file uploads
        if ($extension === 'html') {
            $htmlContent = File::get(storage_path('app/' . $filePath));
        } elseif ($extension === 'css') {
            $cssContent = File::get(storage_path('app/' . $filePath));
        } elseif ($extension === 'js') {
            $jsContent = File::get(storage_path('app/' . $filePath));
        }
    }


    $screenShots = $request->input('screenshots');



         // Initialize Cloudinary
         $cloudinary = new Cloudinary();
 
 // Handle file upload to Cloudinary
 $filePaths = null;
 if ($screenShots) {
     // Upload the file to Cloudinary
     $uploadResponse = $cloudinary->uploadApi()->upload($screenShots->getRealPath(), [
         'folder' => 'projects', // Cloudinary folder (optional)
         'resource_type' => 'auto', // Automatically detect the file type (image, video, or raw)
     ]);
     
     // Get the URL of the uploaded file
     $filePaths = $uploadResponse['secure_url'];
 }



    // Prepare data for database insertion
    $insertData = [
        'userid' => 1,
        'template_name' => $request->input('template_name'),
        'desc' => $request->input('desc'),
        'status' => $request->input('status'),
        'file' => $filePath,
        'screenshot' => $filePaths,
        'created_at' => now(),
    ];

    
    Myproject::create($insertData);

    Session::flash('success', 'Project Created Successfully');
    return redirect()->back();

    // Pass the contents to the view
    // return view('Template.Template-code', [
    //     'htmlContent' => $htmlContent,
    //     'cssContent' => $cssContent,
    //     'jsContent' => $jsContent,
    // ]);
}




public function viewSource()
{
    // Path to the ZIP file
    $zipPath = storage_path('app/uploads/1737916591.zip');
    $extractPath = storage_path('app/extracted/' . time());

    $htmlContent = '';
    $cssContent = '';
    $jsContent = '';

    // Extract ZIP file
    $zip = new ZipArchive();
    if ($zip->open($zipPath) === TRUE) {
        $zip->extractTo($extractPath);
        $zip->close();

        // Search for files
        $files = File::allFiles($extractPath);

        foreach ($files as $file) {
            $ext = $file->getExtension();
            if ($ext === 'html') {
                $htmlContent = File::get($file);
            } elseif ($ext === 'css') {
                $cssContent = File::get($file);
            } elseif ($ext === 'js') {
                $jsContent = File::get($file);
            }
        }
    } else {
        return back()->with('error', 'Failed to extract the ZIP file.');
    }

    // Pass the contents to the Blade view
    return view('Template.Template-code', [
        'htmlContent' => $htmlContent,
        'cssContent' => $cssContent,
        'jsContent' => $jsContent,
        'title' => 'View Source',
    ]);

}

public function viewalltemplate()
{
    // Get all projects
    $data['js_file'] = 'BraveStudent';
    $data['title'] = 'Brave Student Project Template';
    $data['project'] = Myproject::select('id', 'userid', 'template_name', 'desc', 'file', 'status', 'screenshot', 'created_at')->get();

    // Extract the HTML, CSS, and JS from the zip files for each project
    foreach ($data['project'] as $project) {
        $filePath = storage_path('app/' . $project->file); // Path to the uploaded ZIP file
        $extractPath = storage_path('app/extracted/' . time() . '_' . $project->id); // Unique folder for extraction

        $htmlContent = '';
        $cssContent = '';
        $jsContent = '';

        // Check if the file is a valid ZIP file
        if (File::exists($filePath) && in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['zip', 'rar'])) {
            $zip = new ZipArchive();
            if ($zip->open($filePath) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();

                // Search for files in the extracted folder
                $files = File::allFiles($extractPath);
                foreach ($files as $file) {
                    $ext = $file->getExtension();
                    if ($ext === 'html') {
                        $htmlContent = File::get($file);
                    } elseif ($ext === 'css') {
                        $cssContent = File::get($file);
                    } elseif ($ext === 'js') {
                        $jsContent = File::get($file);
                    }
                }
            }
        }

        // Add the content to the project data
        $project->htmlContent = $htmlContent;
        $project->cssContent = $cssContent;
        $project->jsContent = $jsContent;
    }

    return view('Template.All-temp', $data);
}

public function Templates($id)
{
    $data['project'] = Myproject::select('id', 'userid', 'template_name', 'desc', 'file', 'status', 'screenshot', 'created_at')
                                ->where('id', $id)->first(); // Use `first()` to get a single record instead of `get()`

    // Extract the HTML, CSS, and JS from the zip files for each project
    $filePath = storage_path('app/' . $data['project']->file); // Path to the uploaded ZIP file
    $extractPath = storage_path('app/extracted/' . time() . '_' . $data['project']->id); // Unique folder for extraction

    $htmlContent = '';
    $cssContent = '';
    $jsContent = '';

    // Check if the file is a valid ZIP file
    if (File::exists($filePath) && in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['zip', 'rar'])) {
        $zip = new ZipArchive();
        if ($zip->open($filePath) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();

            // Search for files in the extracted folder
            $files = File::allFiles($extractPath);
            foreach ($files as $file) {
                $ext = $file->getExtension();
                if ($ext === 'html') {
                    $htmlContent = File::get($file);
                } elseif ($ext === 'css') {
                    $cssContent = File::get($file);
                } elseif ($ext === 'js') {
                    $jsContent = File::get($file);
                }
            }
        }
    }

    // Add the content to the project data
    $data['project']->htmlContent = $htmlContent;
    $data['project']->cssContent = $cssContent;
    $data['project']->jsContent = $jsContent;

    return view('Template.template', $data);
}



}