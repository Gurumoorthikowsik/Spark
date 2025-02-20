$(document).ready(function(){ 

$.validator.addMethod("acc", function(value) {
  return (/^([0-9]{11})|([0-9]{2}-[0-9]{3}-[0-9]{6})$/.test(value));
},"Please Enter a Valid Account Number");

$.validator.addMethod("mail", function(value) {
  return (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value));
},"Please Enter a Valid E-Mail Address");

$.validator.addMethod("hrs", function(value) {
  return (/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(value));
},"Please Enter a Valid Hours Format");

$.validator.addMethod("ifsc", function(value) {
  return (/^[A-Z]{4}0[A-Z0-9]{6}$/.test(value));
},"Please Enter a Valid IFSC Number");

$.validator.addMethod("blood", function(value, element) {
  return (/^(A|B|AB|O|A1)[-+]$/.test(value));
},"Please Enter a Valid Blood Group Type");

$.validator.addMethod("adhaar", function(value, element) {
  return this.optional(element) || value == value.match(/^\d{4}\s\d{4}\s\d{4}$/);
},"Please Enter a Valid Aadhaar Card Number");

$.validator.addMethod("pan", function(value, element) {
  return this.optional(element) || value == value.match(/[A-Z]{5}[0-9]{4}[A-Z]{1}$/);
},"Please Enter a Valid Pan Card Number");

$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z][a-zA-Z\s]+$/);
},"Letters Only Please");

$.validator.addMethod("add", function(value, element) {
  return this.optional(element) || value == value.match(/^\S+(?: \S+)*$/);
},"Letters Only Please");

$.validator.addMethod("pwcheck", function(value) {
  return (/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,20}$/.test(value));
});

  $("#add-staff-form").validate({
    // Specify validation rules
    rules: {
      roll : {
         required : true,
      },
      staffname : {
        required : true,
        alpha : true,
        minlength : 4,
        maxlength : 25,
      },
      working_hrs : {
        required: true,  
        hrs: true,      
      },
      staffemail: {
        required: true,
        // email: true,
        mail:true,
      },

      College : {
        required: true,  
      },


      College_dep : {
        required: true,  
      },


      Student_year : {
        required: true,      
      },


      password: {
        required: true,
        // pwcheck : true,
        minlength:8,
        maxlength : 20,
      },
      c_password: {
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

      College: {
        required : "Please enter a College Name"
    },


    College_dep: {
      required : "Please enter a College Department"
  },

  Student_year: {
    required : "Please enter a Student Year"
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
        $(".add-staff-form").load("submit", function (e){
            $.ajax({
                url: base_url+"/addstaff",
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



$("#edit-staff-form").validate({
    // Specify validation rules
    rules: {
      staffname : {
        required : true,
        alpha : true,
        minlength : 4,
        maxlength : 25,
      },

      staffemail: {
        required: true,
        // email: true,
        mail:true,
      },
      password: {
        required: true,    
      },
      personalemail : {
        required: true,
        // email: true,
        mail:true,
      },
      dob : {
          required: true,
          date : true,
      },
      phone_no_one : {
        required: true,
        minlength : 10,
        maxlength : 14
      },
      // phone_no_two : {
      //   required: true,
      //   minlength : 10,
      //   maxlength : 14
      // },
      blood_grp : {
        required: true,
        blood: true,
      },
      address : {
        required: true,
        add: true,
      },
      designation: {
        required: true,
        alpha : true,
      },
      department : {
        required : true,
        alpha : true,
      },
      doj : {
          required: true,
          date : true,
      },
      officaial_mail : {
          required: true,
          // email: true,
          mail:true,
      },
      bankname: {
        required: true,
        alpha : true,
      },
      working_hrs : {
        required: true,  
        hrs: true,      
    },
      account_no: { 
        required: true,
        acc: true,   
        minlength : 8,
        maxlength : 18     
    },
    ifsc: {
      required: true,
      ifsc: true,            
    },
    branch: {
      required: true,
      alpha: true,
    },
      pan_no : {
          required: true,
          pan: true,
      },
      aadhaar_no : {
          required: true,
          adhaar: true,
      },
      father_name: { 
        required: true,
        alpha: true,        
    },
    father_contact : {
      required: true,
      minlength:8,
      maxlength : 16,
    },
      emcy_relation_one : {
        required: true,
        alpha: true,
      },
      emcy_relation_two: {
        required: true,
        alpha: true,
      },
      emcy_name_one : {
        required: true,
        alpha: true,
      },
      emcy_name_two : {
        required: true,
        alpha: true,
      },
      emcy_relation_contact_one : {
        required: true,
        minlength : 10,
        maxlength : 14
      },
      emcy_relation_contact_two:{
        required: true,
        minlength : 10,
        maxlength : 14
      },
      
      
    },
    messages : {
      
      staffname: { 
        required : "Please Enter Staff Username",
        alpha : "Letters Only Please"
      },
      staffemail : { 
        required : "Please Enter Staff Email ID" 
      },
      password : { 
        required : "Please Enter Staff a Staff password" 
      },
      personalemail : {
        required : "Please Enter Personal Email ID" 
      },
      dob : {
       required : "Please Enter Staff Date Of Birth"
      },
      phone_no_one : { 
        required : "Please Enter Staff Phone Number" 
      },
      // phone_no_two : { 
      //   required : "Please Enter Staff Phone Number" 
      // },
      blood_grp : { 
        required : "Please Enter Blood Group Format 'O+','B-'"
      },
      address : {
        required : "Please Enter Staff Permanent Address" 
      },
      designation : {
        required : "Please Enter Staff Designation" 
      },
      department : {
        required : "Please Enter Staff Department" 
      },
      doj : {
          required : "Date Of Joining" 
      },
      officaial_mail : {
        required : "Please Enter Official Mail ID" 
      },
      working_hrs:{
        required: "Please Enter the Hours"
      },
      bankname : {
        required: "Please Enter Staff Bank Name"
      },
      account_no : {
        required : "Please Enter Staff Account Number" 
      }, 
      ifsc : {
        required : "Please Enter Staff IFSC Number" 
      }, 
      branch : {
        required : "Please Enter Staff Branch Name" 
      }, 
      pan_no : {
          required : "Please Enter Staff PAN Card Number" 
      },
      aadhaar_no : {
          required : "Please Enter Staff Aadhaar Card Number" 
      },
      father_name : {
        required : "Please Enter a Staff's Father Name" 
     },
     father_contact : {
      required : "Please Enter a Staff's Father Contact Number" 
   },
      emcy_relation_one : {
         required : "Please Enter Staff Emergency Contact Relationship" 
      },
      emcy_relation_two : {
        required : "Please Enter Staff Emergency Contact Relationship" 
     },
      emcy_name_one : {
         required : "Please Enter Staff Emergency Contact Name"
      },
      emcy_name_two : {
        required : "Please Enter Staff Emergency Contact Name"
     },
      emcy_relation_contact_one : {
          required : "Please Enter Staff Emergency Contact Phone Number"
      },
      emcy_relation_contact_two : {
        required : "Please Enter Staff Emergency Contact Phone Number"
    }

      
    },
    
  });


  

$("#add-inventory-form").validate({
    // Specify validation rules
    rules: {
      device : {
        required : true,
      },
      brand : {
        required : true,
      },     
    },
      messages : {
      
        device: { 
          required : "Please Choose a Device",       
        },
  
        brand: { 
          required : "Please Choose a Brand",       
        },
      
    },
   
    
  });


$("#proof-form").validate({
    // Specify validation rules
    rules: {
      type : {
        required : true,
      },

      proof: {
        required: true,
      },
   
      
    },

    
  });

  $("#staff_document_view").validate({
    // Specify validation rules    
    rules: {
      reason : {
        required : true,
      },
      comment : {
        required : true,
      },    
        
    },
    messages : {
      
      reason: { 
        required : "Please enter a Reason",       
      },
      comment: { 
        required : "Please enter a Rejected Reason",       
      },

    },
  });
  


});