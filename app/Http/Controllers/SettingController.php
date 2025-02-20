<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Setting;
use Redirect;
// use Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SettingController extends Controller{  

    public function __construct(){

    }
 
    public function index(Request $request){



    	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		    $validatedData = $request->validate([
	            'site_name' => 'required',
	            'contact_no' => 'required',
	            'address' => 'required',
	            'undermaintance' => 'required',
	            'copy_right' => 'required'
	            
	        ]);

		        $site_name = $request['site_name'];
		        $undermaintance = $request['undermaintance'];
		        $contact_number = $request['contact_no'];
		        $address = $request['address'];
		        $copyright = $request['copy_right'];
		        $news = $request['news_content'];

		        $setting = Setting::select('site_fav','site_logo')->where('id',1)->first();
		        if($request->file('fav_icon')){

		        	$site_fav = cloudinary()->upload($request->file('fav_icon')->getRealPath())->getSecurePath();
		        }else{
		        	$site_fav = $setting->site_fav;
		        }

			        if($request->file('site_logo')){

			        	$site_logo = cloudinary()->upload($request->file('site_logo')->getRealPath())->getSecurePath();
			        }else{
			        	$site_logo = $setting->site_logo;
			        }

					
			        $updateData = [
		    			'site_name' 				=> $site_name,
		    			'site_fav'					=> $site_fav,
		    			'site_logo'					=> $site_logo,
		    			'undermaintance'			=> $undermaintance,
		    			'contact_number'			=> $contact_number,
		    			'address'					=> $address,
		    			'copyright'					=> $copyright,
		    			'news'						=> $news
		    		];


		        	$Update = Setting::where('id', 1)->update($updateData);

			       if($Update){
			       		 Session::flash('success', 'Site Setting Update Successfully');
	    				 return redirect()->back();
			       }else{
				       	Session::flash('error', 'Site Setting Update Invalid !!');
	    				return redirect()->back();
			       }
		    }



    	$data['setting'] = Setting::first();
        $data['js_file'] = 'setting';
        $data['title'] = 'Site Setting';
        return view('setting',$data);
    }


 }



?>