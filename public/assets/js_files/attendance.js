$("#entry-attendance-form").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);    
     $.ajax({
         url: base_url+"/attendance",
         type: "POST",
         data: new FormData(this),
         processData:false,
         contentType:false,
         cache:false,
         async:true,
        beforeSend: function() {
            $('#entry_attendance_btn').hide();
            $('#loader').show();
        },
        success: function (data) {                    
          var res = JSON.parse(data);
         console.log(res);
            if(res.status == 1){
                $('.login_btn').attr("disabled", false);
                $('#loader').hide();
                $('#entry_attendance_btn').show();
                $.notify(res.msg, {className: 'success',clickToHide: true,});
            }else{
              $('.login_btn').attr("disabled", false);
              $('#loader').hide();
              $('#entry_attendance_btn').show();
              $.notify(res.msg, {className: 'error',clickToHide: true,});

            }
           
        
        }
    });
    
});