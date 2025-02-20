$(document).ready(function(){

$("#report-form").validate({
    // Specify validation rules
    rules: {
      date : {
        required : true,
      },

      role: {
        required: true,
      },
      task : {
        required: true,
      },
      description : {
        required: true,
        minlength : 10
      },
      
    },
    messages : {
      
      date: { 
        required : "Please Choose Today Date",
      },
      role : { 
        required : "Please Enter Role" 
      },
      task : {
        required : "Please Enter Today Task Name" 
      },
      description : {
        required : "Please Enter Today Working Task" 
      }
      

      
    },
    
  });



$("#edit-report-form").validate({
    // Specify validation rules
    rules: {
      date : {
        required : true,
      },
      task : {
        required: true,
      },
      description : {
        required: true,
        minlength : 20
      },
      
    },
    messages : {
      
      date: { 
        required : "Please Choose Today Date",
      },
      task : {
        required : "Please Enter Today Task Name" 
      },
      description : {
        required : "Please Enter Today Working Task" 
      }
      

      
    },
    
  });

});