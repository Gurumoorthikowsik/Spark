$(document).ready(function(){
$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
});

$.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space please and don't leave it empty");

$("#laptop-form").validate({
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
      processors : {
        required: true,
      },
      
    },
    messages : {
      
      rules: { 
        required : "Please Enter The Laptop Brand Name",
      },
      serial_no : { 
        required : "Please Enter The Laptop Serial Number" 
      },
      processors : {
        required : "Please Enter The Laptop Processors" 
      }
      

      
    },
    
  });



$("#edit-laptop-form").validate({
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
      processors : {
        required: true,
      },
      
    },
    messages : {
      
      rules: { 
        required : "Please Enter The Laptop Brand Name",
      },
      serial_no : { 
        required : "Please Enter The Laptop Serial Number" 
      },
      processors : {
        required : "Please Enter The Laptop Processors" 
      }
      

      
    },

});

});