$(document).ready(function(){

$("#leave-form").validate({
    // Specify validation rules
    rules: {
      leave_date: {
        required: true,
      },

      reason: {
        required: true,
      },
      
    },
    messages : {

        leave_date : { 
            required : "Please Choose Leave date" 
        },

      reason: {
            required : "Please Enter The Leave Reason",
      },

    },
    submitHandler: function(form) {  
        
        $(".leave-form").load("submit", function (e){  
        $.ajax({
         url: emp_base_url+"/leave_submit",
         type: "POST",
         data: new FormData(this),
         processData:false,
         contentType:false,
         cache:false,
         async:true,
        beforeSend: function() {
            $('#preloader').css("display","block");
            $('#leave_btn').attr("disabled", true);
        },
        success: function (data) {                    
          var res = JSON.parse(data);
            if(res.status == 1){
                // $('#leave_btn').attr("disabled", false);
                $('#preloader').css("display","none");

                $.notify(res.msg, {className: 'success',clickToHide: true,});
                setTimeout(function() { 
                            location.reload(); 
                }, 2000);
            }else{
              $('#leave_btn').attr("disabled", false);
               $('#preloader').css("display","none");
              $('#leave_btn').show();
              $.notify(res.msg, {className: 'error',clickToHide: true,});

            }
           
        
        }
    });
});

},
  
});
});






