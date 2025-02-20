<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Leavedays;
use App\Models\Leave;
use App\Models\Permission; 
use App\Models\UserDocument;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use Carbon\Carbon;
use App\Models\Attendance_time_extended;
use Illuminate\Support\Facades\Validator;


class ApiHrDashboardController extends Controller
{  

    public function __construct(){
       
    }
    

    public function index(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $this_month = date("m");
            $this_year = date("Y");

            $previous_month = date('Y-m', strtotime("-1 month"));
            $startDate = new Carbon($previous_month.'-29');
            $endDate = new Carbon(date('Y-m-'.'31'));

            $roll = Roll::select('roll','sort_name')->where('status',1);

            $data['this_month_permission_approved'] = Permission::select('hours')->where('status','=','Approved')->whereBetween('created_at', [$startDate, $endDate])->count();

            $data['this_month_permission_pending_request'] = Permission::select('hours')->where('status','=','Pending')->whereBetween('created_at', [$startDate, $endDate])->count();
            

            $data['this_month_pending_leave'] = Leave::select('user_id')->where('status','=','Pending')->whereBetween('created_at', [$startDate, $endDate])->count();

            $data['this_month_approved_leave'] = Leave::select('user_id')->where('status','=','Approved')->whereBetween('created_at', [$startDate, $endDate])->count();

            $data['this_month_pending_attendance_time_extended'] = Attendance_time_extended::select('user_id')->where('status','=','Pending')->whereBetween('created_at', [$startDate, $endDate])->count();

            $data['this_month_attendance_time_extended'] = Attendance_time_extended::select('user_id')->where('status','=','Approved')->whereBetween('created_at', [$startDate, $endDate])->count();

            $data['pending_user_document'] = UserDocument::select('option')->where('option','0')->count();

            $out = [];   
            foreach ($roll->get() as $key => $value) {

                $count_roll = DB::table('user_info')->where('status','!=',2)->where('position',$value->sort_name)->count();

                $out[$key]['title'] = 'Total '.$value->roll;
                $out[$key]['count'] = $count_roll;
                
            }

             return apiResponse(1,'success',['emplyee_roll_count' => $out]+$data);

        }

    }

 }



?>