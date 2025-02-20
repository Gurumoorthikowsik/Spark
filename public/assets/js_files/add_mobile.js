$(document).ready(function(){ 
    $("#add_mobile").validate({
        // Specify validation rules
        rules: {
            mobile_name:{
            required : true,
          },
          date : {
            required : true,
          },      
              },
              messages : {
                mobile_name : { 
                  required : "Please Enter a Mobile Number" 
                },
                date : { 
                  required : "Please select a Date" 
                },
              }
        
      });
    
    
    
    });
    
    