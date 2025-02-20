$(document).ready(function(){ 
$("#employee_proof_form").validate({
    // Specify validation rules
    rules: {
      type : {
        required : true,
      },

      proof: {
        required: true,
      },
   
      
    },

    
  });



});