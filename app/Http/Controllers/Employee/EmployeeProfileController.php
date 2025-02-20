<?php 
namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use Redirect;
use DB;
use DateTime;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class EmployeeProfileController extends Controller{  

    public function __construct(){

    }
 

   public function index(Request $request){

        $data['user'] = User::where('userid',emp_user_id())->first();

        $data['js_file'] = 'employee_change_password';
        $data['title'] = 'Profile';		
        return view('employee/profile',$data);
    }


	public function Studentprofileupdate(Request $request)
{
    // try {
        // Validate input fields
        $request->validate([
            'userid' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'College' => 'required',
            'College_dep' => 'required',
            'Student_year' => 'required',
            'batch_day' => 'required',
             // Optional file validation
        ], [
            'username.required' => 'Please Enter the Student Name',
            'email.required' => 'Please Enter the Email Id',
            'phone_number.required' => 'Please Enter the Phone Number',
            'College.required' => 'Please Enter the College Name',
            'College_dep.required' => 'Please Enter the College department',
            'Student_year.required' => 'Please Enter the Student year',
            'batch_day.required' => 'Please Enter the Batch',
            'profile_photo.required' => 'Please upload profile Pic',
        ]);

        // Get request data
        $userid = $request->userid;
        $username = $request->username;
        $email = encrypt_decrypt('encrypt', $request['email']);
        $phone_number = $request->phone_number;
        $College = $request->College;
        $College_dep = $request->College_dep;
        $Student_year = $request->Student_year;
        $batch_day = $request->batch_day;

        // Check if a file has been uploaded
        if ($request->hasFile('profile_photo')) {
            // Upload the image to Cloudinary
            $photo = $request->file('profile_photo');
            $cloudinaryUpload = Cloudinary::upload($photo->getRealPath(), [
                'folder' => 'profile_pics', // Optional folder in Cloudinary
            ]);

            // Get the Cloudinary URL
            $profile_photo = $cloudinaryUpload->getSecurePath();
        } else {
            // If no image is uploaded, set a default value or null
            $profile_photo = null; // or a default image URL if you want
        }

        // Update the data in the database
        $updateData = [
            'username' => $username,
            'email' => $email,
            'phone_number' => $phone_number,
            'College' => $College,
            'College_dep' => $College_dep,
            'Student_year' => $Student_year,
            'batch_day' => $batch_day,
            'profile_photo' => $profile_photo, // Store Cloudinary URL here
        ];


	
        $res = User::where('userid', $userid)->update($updateData);

        if ($res) {
            return redirect('employees/profile')->with('success', 'Profile has been updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Profile update failed.');
        }
    // } catch (\Throwable $th) {
    //     return redirect()->back()->with('error', $th->getMessage());
    // }
}



    public function changePassword(Request $request){

		$request->validate([
		  
		  'current_pass' => 'required',
		  'new_pass' =>  'required',
		  'confirm_pass'=>'required|same:new_pass',
		], [
            'current_pass.required' => 'Please Enter The Email',
            'new_pass.required' => 'Please Enter The Password',
			'confirm_pass.required' => 'Please Enter The Password'
		]);
				$current_pass =encrypt_decrypt('encrypt',$request['current_pass']);
				$new_pass =$request->new_pass;
				$confirm_pass =$request->confirm_pass;

				
				$check_old_password = User::select('password')->where('userid',emp_user_id())->where('password',$current_pass);			
				
				if($check_old_password->count() !=0){
					if($new_pass == $confirm_pass){
						$updateData =[
							'password' => encrypt_decrypt('encrypt',$new_pass)		
						];

						User::where('userid',emp_user_id())->update($updateData);
						return redirect('employees/logout')->with('success', 'Password Changed Successfully');
					}else{
						return redirect()->back()->with('error', 'New Password & Confirm Password Not Matching');
						}					
					}else{
					return redirect()->back()->with('error', 'Current Password Does Not Match');
				}
				
}

    


}


?>
