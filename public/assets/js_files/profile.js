$(document).ready(function(){

  $.validator.addMethod("mail", function(value) {
    return (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value));
  },"Please Enter a Valid E-Mail Address"); 

$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z][a-zA-Z\s]+$/);
},"Letters Only Please");

$.validator.addMethod("pwcheck", function(value) {
  return (/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,16}$/.test(value));
});

$.validator.addMethod("add", function(value, element) {
  return this.optional(element) || value == value.match(/^\S+(?: \S+)*$/);
},"Letters Only Please");

  $("#add-profile-form").validate({
    // Specify validation rules
    rules: {

      username : {
        required : true,
        alpha : true,
        minlength : 4,
        maxlength : 25,
      },

      email: {
        required: true,
        // email: true,
        mail: true,
      },
      personalemail: {
        required: true,
        mail: true,
      },
      phone: {
        required: true,
        minlength:10,
        maxlength : 14,
      },
      address: {
        required: true,
        add: true,
      },
      
    },
    messages : {

    	username: { 
        required : "Please Enter Username",
        
      },
      email : { 
        required : "Please Enter Your email ID" 
      },
      personalemail : { 
        required : "Please Enter Your Personal email ID" 
      },
      phone: {
          required : "Please Enter Your Personal Phone Number",
      },

      address : {
          required : "Please Enter Permanent Address",
      },
    },
    submitHandler: function(form) {
        $('.add_profile_btn').attr("disabled", true);
        $(".add-profile-form").load("submit", function (e){
            $.ajax({
                url: base_url+"/profile",
                type: "POST",
                data: new FormData(this),
                 processData:false,
                 contentType:false,
                 cache:false,
                 async:true,
                beforeSend: function() {
                    $('#add_profile_btn').hide();
                    $('#loader').show();
                },
                success: function (data) {                    
                  var res = JSON.parse(data);
                    if(res.status == 1){
                        $('.add_profile_btn').attr("disabled", false);
                        $('#loader').hide();
                        $('.add_profile_btn').show();
                        $.notify(res.msg, {className: 'success',clickToHide: true,});

                    }else{
                      $('.add_profile_btn').attr("disabled", false);
                      $('#loader').hide();
                      $('#add_profile_btn').show();
                      $.notify(res.msg, {className: 'error',clickToHide: true,});

                    }
                   
                
                }
            });
        });

    },
  
  });


});