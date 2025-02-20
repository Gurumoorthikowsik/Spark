$(document).ready(function(){


$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
});

$.validator.addMethod("pwcheck", function(value) {
  return (/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,16}$/.test(value));
});

  $("#login-form").validate({
    // Specify validation rules
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
      
    },
    messages : {
    	
    	email : { 
    		required : "Please Enter Email ID" 
    	},
    	password: {
	        required : "Please Enter Password",
      },

    },
    submitHandler: function(form) {
        $('.login_btn').attr("disabled", true);
        $(".login-form").load("submit", function (e){
            $.ajax({
                url: base_url+"/login",
                type: "POST",
                data: new FormData(this),
                 processData:false,
                 contentType:false,
                 cache:false,
                 async:true,
                beforeSend: function() {
                    $('#login_btn').hide();
                    $('#loader').show();
                },
                success: function (data) {                    
                  var res = JSON.parse(data);


                    if(res.status == 1){
                        $('.login_btn').attr("disabled", false);
                        // $('#loader').hide();
                        // $('#login_btn').show();
                        // $('.login-form')[0].reset();
                        $.notify(res.msg, {className: 'success',clickToHide: true,});

                        setTimeout(function() { 
                            window.location.href = base_url+'/dashboard'; 
                        }, 2000);
                    }else{
                      $('.login_btn').attr("disabled", false);
                      $('#loader').hide();
                      $('#login_btn').show();
                      $.notify(res.msg, {className: 'error',clickToHide: true,});

                    }
                   
                
                }
            });
        });

    },
  
  });

});