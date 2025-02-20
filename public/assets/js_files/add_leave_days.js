$(document).ready(function(){ 
    $("#leave-day-form").validate({
        // Specify validation rules
        rules: {
            reason:{
            required : true,
          },
          date : {
            required : true,
          },      
              },
              messages : {
                reason : { 
                  required : "Please Enter a Reason" 
                },
                date : { 
                  required : "Please select a Date" 
                },
              }
        
      });
    
    
    
    });
    
    