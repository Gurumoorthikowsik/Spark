$(document).ready(function(){

    $("#").validate({
        // Specify validation rules
        rules: {
            startDate : {
            required : true,
          },
    
          endDate: {
            required: true,
          },          
          
        },
        messages : {
          
            startDate: { 
            required : "Please Choose From Date",
          },
          endDate : { 
            required : "Please Choose End Date" 
          },                 
              
        },
        
      });        
    
     });