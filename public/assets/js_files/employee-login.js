$(document).ready(function(){


$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
});

$.validator.addMethod("pwcheck", function(value) {
  return (/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,16}$/.test(value));
});

  $("#emp-login-form").validate({
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

        $(".emp-login-form").load("submit", function (e){
            $.ajax({
                url: emp_base_url+"/login",
                type: "POST",
                data: new FormData(this),
                 processData:false,
                 contentType:false,
                 cache:false,
                 async:true,
                beforeSend: function() {
                    // $('#preloader').css("display","block");
                    $('.login_btn').hide();
                    $('.loading_btn').show();
                },
                success: function (data) {                    
                  var res = JSON.parse(data);

                    if(res.status == 1){
                        $('.login_btn').attr("disabled", true);
                        $.notify(res.msg, {className: 'success',clickToHide: true,});

                        setTimeout(function() { 
                            window.location.href = emp_base_url+'/dashboard'; 
                        }, 2000);
                    }else{
                      $('.loading_btn').css("display","none");
                      $('.login_btn').attr("disabled", false);
                      $('.login_btn').show();
                      $.notify(res.msg, {className: 'error',clickToHide: true,});

                    }
                   
                
                }
            });
        });

    },
  
  });

});