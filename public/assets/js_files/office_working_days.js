$(document).ready(function(){ 
$("#office-working-form").validate({
    // Specify validation rules
    rules: {
      date:{
        required : true,
      },
      workingdays : {
        required : true,
      },      
          },
          messages : {
            date : { 
              required : "Please select a Month & Year" 
            },
            workingdays : { 
              required : "Please Enter a No Of Working Days" 
            },
          }
    
  });



});

