@include('common.employee.inner_header')
@include('common.employee.sidebar')
<style>
  .profile-container {
      text-align: center;
  }
  
  #fileInput {
      display: none; /* Hide the file input to allow the label to act as the button */
  }
  
  .image-preview {
      position: relative;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      border: 2px solid #ccc;
      margin-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f2f2f2;
  }
  
  #preview {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
  }
  
  .choose-image-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      z-index: 2;
      /* Adjust size to fit inside the circle */
      padding: 4px 10px; /* Smaller padding to avoid overlap */
      border-radius: 12px; /* Rounded corners to keep it from affecting the circle's shape */
      display: block; /* Ensure it's visible */
  }
  
  .choose-image-btn:hover {
      background-color: rgba(0, 0, 0, 0.7);
  }
  
  .image-preview input[type="file"]:not(:empty) ~ .choose-image-btn {
      display: none; /* Hide the "Choose Image" button when an image is selected */
  }
  </style>


 <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/employees/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                  <form action="<?php echo URL::to('/employees/Studentprofileupdate'); ?>" class="form-valide" method="post" enctype="multipart/form-data">

                                    @csrf
                                    
                                    <input type="hidden" name="userid" id="userid" class="form-control" placeholder="Enter Student Name" value="{{$user->userid }}">


                                    <h4>Personal Details</h4>
                
                                        <div class="my-2">

                                          <div class="container">
                                            <div class="row">
                                              <div class="col-lg-6">

                                                <label for="fname">Student Id *</label>
                                                <div class="input-group">
                                                  <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Enter Student Id" value="{{$user->employee_id}}" readonly>
                                                  
                                                  </span>
                                                </div>


                                              </div>

                                              <div class="col-lg-6">

                                                <label for="fname">Student Name *</label>
                                                <div class="input-group">
                                                  <input type="text" name="username" id="username" class="form-control" placeholder="Enter Student Name" value="{{$user->username}}">
                                                  
                                                  </span>
                                                </div>

                                                
                                              </div>

                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">Student Email *</label>
                                                <div class="input-group">
                                                  <input type="text" name="email" id="email" class="form-control" placeholder="Enter email Id" value="{{encrypt_decrypt('decrypt',$user->email)}}">
                                                  
                                                  </span>
                                                </div>

                                                
                                              </div>


                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">Student Current Course *</label>
                                                <div class="input-group">
                                                  <input type="text" name="department" id="department" class="form-control" placeholder="Enter Student Id" value="{{$user->department}}" readonly>
                                                  
                                                  </span>
                                                </div>

                                                
                                              </div>

                                              
                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">Date of Join *</label>
                                                <div class="input-group">
                                                  <input type="text" name="date_join" id="date_join" class="form-control" placeholder="Enter Student Id" value="{{$user->date_join}}" readonly>
                                                  
                                                  </span>
                                                </div>

                                                
                                              </div>


                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">Phone Number *</label>
                                                <div class="input-group">
                                                  <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Student Id" value="{{$user->phone_number}}">
                                          
                                                  </span>
                                                </div>

                                                
                                              </div>


                                              
                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">College Name  *</label>
                                                <div class="input-group">
                                                  <input type="text" name="College" id="College" class="form-control" placeholder="Enter College Name" value="{{$user->College}}">
                                          
                                                  </span>
                                                </div>

                                                
                                              </div>

                                              
                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">Student Department  *</label>
                                                <div class="input-group">
                                                  <input type="text" name="College_dep" id="College_dep" class="form-control" placeholder="Enter College Department" value="{{$user->College_dep}}">
                                          
                                                  </span>
                                                </div>

                                                
                                              </div>

                                              
                                              <div class="col-lg-6 mt-3">

                                                <label for="fname"> Student Year *</label>
                                                <div class="input-group">
                                                  <input type="text" name="Student_year" id="Student_year" class="form-control" placeholder="Enter Student year" value="{{$user->Student_year}}">
                                          
                                                  </span>
                                                </div>

                                                
                                              </div>

                                              
                                              <div class="col-lg-6 mt-3">

                                                <label for="fname">Batch *</label>
                                                <div class="input-group">
                                                  <input type="text" name="batch_day" id="batch_day" class="form-control" placeholder="Enter Batch week" value="{{$user->batch_day}}" readonly>
                                          
                                                  </span>
                                                </div>

                                                
                                              </div>



                                              <div class="col-lg-6 mt-3">
                                                <label for="fname">Student Image *</label>
                                                <div class="profile-container">
                                                  <div class="image-preview">
                                                      <!-- Display Existing Profile Picture or Default Image -->
                                                      <img id="preview" 
                                                           src="{{ $user->profile_photo ?? asset('employee/images/user/1.png') }}" 
                                                           alt="Profile Image Preview" 
                                                           height="100" 
                                                           width="100">
                                                           
                                                      <!-- Hidden file input -->
                                                      <input type="file" id="fileInput" name="profile_photo" accept="image/*" style="display: none;">
                                              
                                                      <!-- Label styled as button inside circle -->
                                                      <label for="fileInput" class="choose-image-btn">Choose Image</label>
                                                  </div>
                                              </div>
                                            </div>

                                            </div>
                                          </div>

                                  
                                        </div>

                                        
                                        
                                       
                                        
                                                    
                                        
                                        <div class="button">
                                        <button class="btn btn-success mt-5 mx-4"> Submit</button>
                                      </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                        <h3>Change Password</h3><br>
    <form class="form-horizontal" action="{{url('employees/ChangePassword')}}" method="POST" id="employeechange_pass" enctype="multipart/form-data">                 
        @csrf
     
        <div class="modal-body p-4 bg-light">
         

            <!-- Current Password -->
<div class="my-2">
    <label for="fname">Current Password *</label>
    <div class="input-group">
      <input type="password" name="current_pass" id="current_pass" class="form-control" placeholder="Enter Current Password">
      <span class="input-group-text" onclick="togglePasswordVisibility('current_pass', 'current_eye')">
        <i id="current_eye" class="fas fa-eye"></i>
      </span>
    </div>
  </div>
  
  <!-- New Password -->
  <div class="my-2">
    <label for="lname">New Password *</label>
    <div class="input-group">
      <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="Enter New Password">
      <span class="input-group-text" onclick="togglePasswordVisibility('new_pass', 'new_eye')">
        <i id="new_eye" class="fas fa-eye"></i>
      </span>
    </div>
  </div>
  
  <!-- Confirm New Password -->
  <div class="my-2">
    <label for="cpass">Confirm New Password *</label>
    <div class="input-group">
      <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" placeholder="Enter Confirm New Password">
      <span class="input-group-text" onclick="togglePasswordVisibility('confirm_pass', 'confirm_eye')">
        <i id="confirm_eye" class="fas fa-eye"></i>
      </span>
    </div>
  </div>
  



         
        </div>
        <div class="modal-footer" style="margin-right: 538px;">
          <button type="submit" name="chnage_pass_btn" id="chnage_pass_btn" class="btn btn-success">Submit</button>
        </div>
      </form>
                    </div>
                </div>
            </div>
    </div></div>
                </div>



                
        </div>
        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>

@include('common.employee.inner_footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script>
    function togglePasswordVisibility(inputId, eyeIconId) {
  var passwordField = document.getElementById(inputId);
  var eyeIcon = document.getElementById(eyeIconId);

  // Toggle the type attribute
  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  }
}

</script>



<script>
  // Display selected image in the preview
  document.getElementById('fileInput').addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function (event) {
              const preview = document.getElementById('preview');
              preview.src = event.target.result;  // Set the preview image source
          };
          reader.readAsDataURL(file);  // Read the file as a data URL
      }
  });
</script>
