$(document).ready(function(){
$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
});

$.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space please and don't leave it empty");

$("#keyboard-form").validate({
    // Specify validation rules
    rules: {
      brand : {
        required : true,
        alpha : true,
      },

      serial_no: {
        required: true,
        noSpace : true,
      },
    },
    messages : {
      
      brand: { 
        required : "Please Enter The Keyboard Brand Name",
      },
      serial_no : { 
        required : "Please Enter The Keyboard Serial Number" 
      }
       
    },
    
  });



$("#edit-keyboard-form").validate({
    // Specify validation rules
    rules: {
      brand : {
        required : true,
        alpha : true,
      },

      serial_no: {
        required: true,
        noSpace : true,
      },
      
    },
    messages : {
      
      brand: { 
        required : "Please Enter The Keyboard Brand Name",
      },
      serial_no : { 
        required : "Please Enter The Keyboard Serial Number" 
      },
      

      
    },

});

});