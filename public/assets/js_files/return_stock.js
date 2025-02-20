$(document).ready(function(){ 

  $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z][a-zA-Z\s]+$/);
  },"Please Enter a Return Reason");

    $("#rejected_reason").validate({
        // Specify validation rules
        rules: {
          return_reason:{
            required : true,
            alpha: true,
          },         
              },
              messages : {
                return_reason : { 
                  required : "Please Enter a Return Reason" 
                },              
              }
        
      });
    
    
    
    });
    
    