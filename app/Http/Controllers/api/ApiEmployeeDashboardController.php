<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Leavedays;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class ApiEmployeeDashboardController extends Controller{  

    public function __construct(){
       
    }
    
    public function index(Request $request ){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required',
            ]);

            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }

            $user_id = $request['user_id'];

            $data['today_date'] = date('d / M / Y');
            $data['totay_working_hours'] = today_working_hrs($user_id);
            $data['news'] = (site_setting()->news) ? site_setting()->news : '';

            return apiResponse(1,'success',$data);

        }else{
            return apiResponse(0,'Invalid Request Method');
        }

    }

    function dashboard_calander_view(Request $request){
        $data['user_id'] = $request->get('user_id');
        $data['js_file'] = 'login';
        $data['title'] = 'Dashboard';
        return view('api/view_employee_calander',$data);
    }


    function dashboard_calander(Request $request){

        $validator = Validator::make($request->all(),[
         'user_id' => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->first();
             return apiResponse(0,$errors);
        }

        $day = date('d');
        $month = date('m');
        $year = date('Y');
      
       $festival_leave = Leavedays::select('leave_date')->whereYear('leave_date', '=', $year)->whereMonth('leave_date', '=', $month)->get();

       $festival= []; 

       foreach ($festival_leave as $key => $value) {
            $festival[$key] = date('d',strtotime($value->leave_date));
       }


       // staff working hours start
       $user_id = $request['user_id'];
       
       $user_total_working = DB::select("select date AS date, SEC_TO_TIME( SUM( TIME_TO_SEC( `hours` ) ) ) as 'hours' from tbl_attendance WHERE `tbl_attendance`.`user_id` = '$user_id' and MONTH(date) = '$month' and YEAR(date) = '$year' group by date ORDER BY date ASC LIMIT $day");


       $working_hrs = (get_user($user_id,'working_hrs') != '') ? get_user($user_id,'working_hrs') : '08:00';

       
           $completed_time = [];
           $tot_work_day = [];
           $low_working_day = [];
           $precent_day = [];
           foreach ($user_total_working as $key => $value) {
              $date = $value->date;

              $hours = ($date == date('Y-m-d')) ? today_working_hrs($user_id) : date('H:i',strtotime($value->hours));
              
                  if(date('m',strtotime($date)) == $month){
                   
                    $range = range(1, $day);
                    $get_date = date('d',strtotime($date));
                    $get_working_days = in_array($get_date, $range);

                        if($get_working_days == 1){

                            $precent_day[] = date('d',strtotime($date));

                            if(strtotime($hours) >= strtotime($working_hrs)){

                                $completed_time[] =  date('d',strtotime($date));

                            }else{
                                $low_working_day[] =  date('d',strtotime($date));

                            }

                        }
                  }

           }

       // staff working hours end
           
        $range = range(1, $day);
        $remove_date = array_diff($range, $precent_day);
        $obcent = [];
        foreach ($remove_date as $key => $value) {
            // if($value != 07){
                $obcent[] = $value;
            // }
        }
   
        $leavedays = year_sunday();
        $total_festival = array_merge($leavedays,$festival);

        return apiResponse(1,'success',['precent' =>  $completed_time,'low_working_day' => ($low_working_day) ? $low_working_day : [],'obsend' => ($obcent) ? $obcent : [] ,'leavedays' => $total_festival,'user_id' => $request['user_id']]);


    }




 }



?>