<?php 
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Validator;
use DB;

class ApiHrNotificationController extends Controller{  

    public function __construct(){
       
    }
    
    public function notification(Request $request ){
        
        $getnotification =  DB::table('notification')->where('status',1)->where('type',1)->limit(100)->orderBy('id','desc');
  
        $count = $getnotification->count();
        $out = [];
            foreach ($getnotification->get() as $key => $value){
            $out[$key]['link'] =   $value->link ;
            $out[$key]['id'] = $value->id ;
            $out[$key]['title'] =  $value->title ;
            $out[$key]['message'] = $value->message;
        }
    
 return apiResponse(1,'success',['Notification_Count' => $count, 'notify' => ($out) ? $out : []]);

}

}

?>