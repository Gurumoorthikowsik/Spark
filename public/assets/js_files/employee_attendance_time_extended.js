$(document).ready(function(){

    $("#employee_attendance_time_extended").validate({
        // Specify validation rules
        rules: {
          from_time: {
            required: true,
          },
          to_time: {
            required: true,
          },
          reason: {
            required: true,
          },
          
        },
        messages : {
    
            from_time : { 
                required : "Please Choose From Time" 
            },
            to_time: {
                required : "Please Choose To Time",
          },
          reason: {
                required : "Please Enter The Reason",
          },
    
        },
        submitHandler: function(form) {  
            
            $(".employee_attendance_time_extended").load("submit", function (e){  
         
            $.ajax({
             url: emp_base_url+"/attendance_time_extended_submit",
             type: "POST",
             data: new FormData(this),
             processData:false,
             contentType:false,
             cache:false,
             async:true,
            beforeSend: function() {
                $('#preloader').css("display","block");
                $('#permission_btn').attr("disabled", true);
            },
            success: function (data) {                    
              var res = JSON.parse(data);
             console.log(res);
                if(res.status == 1){
    
                    $('#permission_btn').attr("disabled", false);
                    $('#preloader').css("display","none");
    
                    $.notify(res.msg, {className: 'success',clickToHide: true,});
                    setTimeout(function() { 
                                location.reload(); 
                    }, 2000);
                }else{
                  $('#permission_btn').attr("disabled", false);
                   $('#preloader').css("display","none");
                  $('#permission_btn').show();
                  $.notify(res.msg, {className: 'error',clickToHide: true,});
    
                }
               
            
            }
        });
    });
    
    },
      
    });
    });
    
    
    
    
    
    
    