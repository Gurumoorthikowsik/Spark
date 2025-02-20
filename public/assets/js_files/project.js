$(document).ready(function(){ 
      $("#add-project-form").validate({


        // Specify validation rules
        rules: {
          roll : {
             required : true,
          },

          batch : {
            required : true,
         },

         student_names : {
            required : true,
         },

         project : {
            required : true,
         },
          

         giturl: {
            required: true,
            equalTo:'#password',
          },
          
        },
        messages : {
            roll : {
            required : "Choose Staff Role" 
          },
            staffname: { 
            required : "Please Enter Staff Username",
            alpha : "Letters Only Please"
          },
          working_hrs:{
            required: "Please Enter the Hours"
          },
          staffemail : { 
            required : "Please enter your Staff email ID" 
          },
          password: {
              required : "Please enter a Password",
              pwcheck : "Password length must be 8-16 characters and contain an uppercase letter, lowercase letter, number and special character. Spaces are not allowed."
          },
    
          c_password : {
              required : "Please enter a Confirm Password",
              equalTo : "our password and confirmation password do not match.!",
          },
        },
        submitHandler: function(form) {
            $('.add_staff_btn').attr("disabled", true);
            $(".add-staff-formm").load("submit", function (e){
                $.ajax({
                    url: base_url+"/addproject",
                    type: "POST",
                    data: new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:true,
                    beforeSend: function() {
                      $('#loader').css("display","block");
                        $('#add_staff_btn').hide();
                        $('#loader').show();
                    },
                    success: function (data) {                    
                      var res = JSON.parse(data);
                        if(res.status == 1){
                          $('#add_staff_btn').show();
                            $('.add_staff_btn').attr("disabled", false);
                            $('.add-staff-form')[0].reset();
                            // $('#loader').hide();
                            // $('.add_staff_btn').show();    
                            $('#loader').css("display","none");                  
                            $.notify(res.msg, {className: 'success',clickToHide: true,});
    
                        }else{
                          $('#loader').css("display","none");
                          $('.add_staff_btn').attr("disabled", false);
                          // $('#loader').hide();
                          $('#add_staff_btn').show();
                          $.notify(res.msg, {className: 'error',clickToHide: true,});
    
                        }
                       
                    
                    }
                });
            });
    
        },
      
      });
    
    
    

    
    
      
    
    
    });