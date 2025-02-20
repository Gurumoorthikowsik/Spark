<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Report;
use Redirect;
use DB;
use URL;

class ReportController extends Controller{  

    public function __construct(){

    }
 
    public function index(Request $request){


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validatedData = $request->validate([
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

                $task = $request['task'];
                $date = date('d-m-Y',strtotime($request['date']));
                $description = $request['description'];
                $user_id = user_id();

                        $inserData = [
                            'user_id' => $user_id,
                            'task' => $task,
                            'description' => $description,
                            'start_date' => $date.' / '.date('h:i:s:a'),
                            'status' => 'start',
                            'created_at' => date('d-m-Y h:i:s'),
                        ];

                    //    $res =  Report::insert($inserData);

                       if($res){
                            Session::flash('success', 'Task Created Successfully');
                            return redirect('/working_report');
                       }else{
                            Session::flash('error', 'Task Created Invalid');
                            return redirect('/working_report');
                       }
                        
        }

    	$data['user'] = User::select('username','email','position')->where('position','HR')->where('userid',user_id())->first();
        $data['report'] = Report::where('user_id',user_id());

         $data['report'] = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid',user_id())->orderBy('id', 'desc');

        $data['js_file'] = 'report';
        $data['title'] = 'Report';
        return view('report/working_report',$data);

    }

    function get_edit_report($id){

        $report = DB::table('user_info')->select('id','userid','employee_id','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid',user_id())->where('id',$id)->first();
        
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

    public function viewsrc($id)
{
    $data['report'] = Report::where('id', $id)->first();


    $data['js_file'] = 'View report';
        $data['title'] = 'View Report code';
        return view('report/report-code',$data);

}



public function srcupdate(Request $request) {
    // Validate the request input
    $validatedData = $request->validate([
        'source_code' => 'required',
    ], [
        'source_code.required' => 'Please Enter Today source code',
    ]);

    // Get the values from the request
    $id = $request->id;  // Accessing id correctly
    $user_id = $request->user_id;  // Accessing id correctly

    $source_code = $request->source_code;  // Accessing source_code correctly

    // Prepare the data to be updated
    $updateData = [
        'source_code' => $source_code,
        'updated_at' => now(),  // Use Carbon's now() for proper timestamp
    ];

    // Update the record in the database
    $res = Report::where('id', $id)->update($updateData);

    // Check the result and set session flash message accordingly

    notification(['user_id' => $user_id, 
                             'type' => 0, 
                             'name' => 'Test',
                             'title' => 'Source Code Updated' ,     
                             'message' => 'Source code Updated', 
                             'created_at' => date('Y-m-d H:i:s'),
                            'link' => URL::to('/employees/updateSrccode/' . $id),
                        ]) ;

    if ($res) {
        Session::flash('success', 'Source Updated Successfully');
        return redirect()->back();
    } else {
        Session::flash('error', 'Source Update Failed');
        return redirect()->back();
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
            $user_id = user_id();

            $updateData = [
                'task' => $task,
                'description' => $description,
                'start_date' => date('d-m-Y',strtotime($date)).' / '.date('h:i:s:a'),
                'created_at' => date('d-m-Y h:i:s'),
            ];

           
           $res =  Report::where('id', $id)->update($updateData);

           if($res){
                Session::flash('success', 'Task Updated Successfully');
                return redirect('/working_report');
           }else{
                Session::flash('error', 'Task Updated Invalid');
                return redirect('/working_report');
           }

    }

    function staff_working_report(Request $request,$level=""){

        if($level == 'all'){
            $data['employee'] = User::where('status','!=',2);
        }else{
            $data['employee'] = User::where('status','!=',2)->where('position',$level);

        }
        session(['working_roll' => $level]);

        $data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();
        $data['params'] = $level;
        $data['js_file'] = 'report';
        $data['title'] = 'Staff Report';
        return view('report/all_staff_report_list',$data);

    }


    function view_staff_working($userID){

        $user_id = encrypt_decrypt('decrypt',$userID);
        $data['roll'] = Roll::select('roll','sort_name')->where('status',1)->get();

  

        $data['report'] = DB::table('user_info')->select('id','userid','employee_id','file_path','username','task','description','start_date','end_date','working_hours','report.status','created_at')->join('report', 'user_info.userid', '=', 'report.user_id')->where('userid',$user_id)->orderBy('id', 'desc');



        $data['userid'] = $userID;
        $data['dec_user_id']= $user_id;
        $data['js_file'] = 'attendance';
        $data['title'] = 'View Working report';
        return view('report/view_staff_working',$data);

    }


    public function downloadFile($file)
{
    // Check if the file exists in the storage directory
    $filePath = storage_path('app/' . $file);

    print_r($filepath);
    die;
    

    // Check if the file exists before proceeding
    if (file_exists($filePath)) {
        return response()->download($filePath);
    } else {
        // File doesn't exist
        return redirect()->back()->with('error', 'File not found.');
    }
}


}

?>