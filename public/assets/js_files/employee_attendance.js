$("#entry-attendance-form").submit(function(e) {


    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);    
     $.ajax({
         url: emp_base_url+"/attendance",
         type: "POST",
         data: new FormData(this),
         processData:false,
         contentType:false,
         cache:false,
         async:true,
        beforeSend: function() {
            $('.loading_btn').css("display","block");
            $('.entry_attendance_btn').css("display","none");
        },
        success: function (data) {                    
          var res = JSON.parse(data);

            if(res.status == 1){

                $.notify(res.msg, {className: 'success',clickToHide: true,});
                setTimeout(function() { 
                            location.reload(); 
                }, 2000);
            }else{
              $('.loading_btn').css("display","none");
              $('.entry_attendance_btn').css("display","block");

              $.notify(res.msg, {className: 'error',clickToHide: true,});

            }
           
        
        }
    });
    
});