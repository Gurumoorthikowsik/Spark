$(document).ready(function(){

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
    });
    
    $.validator.addMethod("pwcheck", function(value) {
      return (/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,16}$/.test(value));
    },'Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character');
       
   
    
      $("#employeechange_pass").validate({
        // Specify validation rules
        rules: {
          current_pass : {
            required : true,
          },
          new_pass : {
            required: true,
            pwcheck: true,
            
          },
          confirm_pass : {
            required: true,
            equalTo: '#new_pass',
          },
          
        },
        messages : {
          
          current_pass: { 
            required : "Please Enter your Current Password",
          },
          new_pass : {
            required : "Please Enter The New Password", 
          },
          confirm_pass : {
            required :"Please enter your Confirmed password",
            equalTo : 'New Password & Confirm Password Not Matching',
          }                  
    
          
        },                                         
    });
    
    });
    