<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Validator;
use DB;

class ApiEmployeeNotificationController extends Controller{  

    public function __construct(){
       
    }
    
    public function notify(Request $request ){


        $userid = $request['user_id'];
        
        $getnotification =  DB::table('notification')->where('user_id',$userid)->where('status',1)->where('type',0)->limit(100)->orderBy('id','desc'); 
        $count = $getnotification->count();
        $out = [];
            foreach ($getnotification->get() as $key => $value){
            $out[$key]['link'] =  mobile_notify_link($value->link);
            $out[$key]['id'] = $value->id ;
            $out[$key]['title'] = $value->title ;
            $out[$key]['message'] = $value->message;
        }
    
 return apiResponse(1,'success',['Notification_Count' => $count, 'notify' => ($out) ? $out : []]);



}

}

?>