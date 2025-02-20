$(document).ready(function(){ 

  $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^\S+(?: \S+)*$/);
  },"Space Detected");


  $.validator.addMethod("brand", function(value, element) {
    return this.optional(element) || value == value.match(/^\S+(?: \S+)*$/);
  },"Please Enter The Brand Name");

  jQuery.validator.addMethod("noHTMLtags", function(value, element){
    if(this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)){
        return false;
    } else {
        return true;
    }
}, " Tags are Not allowed.");

jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
  phone_number = phone_number.replace(/\s+/g, "");
  return this.optional(element) || phone_number.length > 9 && 
  phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");


    $("#add_produc").validate({
        // Specify validation rules
        rules: {
            serial_no:{
            required : true, 
            alpha: true,  
            noHTMLtags: true             
          },
          // processor_no : {
          //   required : true,
          // },
          brand : {
            required : true,
          },
          accessories : {
            required : true,
          }, 
          processor_no : {
            required : true,
            noHTMLtags: true   
          },      
              },
              messages : {
                serial_no : { 
                  required : "Please Enter a Serial Number" 
                },
                // processor_no : { 
                //   required : "Please Enter a Processor Number" 
                // },
                brand : { 
                    required : "Please select a Brand" 
                  },
                  accessories : { 
                    required : "Please select a Accessories" 
                  },
                  processor_no : { 
                    required : "Please Enter a Processor Number" 
                  },
              }
        
      });
    
      $("#add_brand").validate({
        // Specify validation rules
        rules: {
          brand_name : {
            required : true,    
            brand: true, 
            noHTMLtags: true              
          },  
            
          
        },
        messages : {
          
          brand_name: { 
            required : "Please Enter The Brand Name",
          }, 
                  
          
        },      
    
    
    });


      $("#add_os").validate({
        // Specify validation rules
        rules: {
          os_name : {
            required : true,
            noHTMLtags: true               
          },    
          
        },
        messages : {
          
          os_name: { 
            required : "Please Enter The OS Type",
          },           
          
        },      
    
    
    });

    $("#add_access").validate({
      // Specify validation rules
      rules: {
        accessories_name : {
          required : true,            
        },    
        // property_name : {
        //   required : true,            
        // }, 
      },
      messages : {
        
        accessories_name: { 
          required : "Please Enter The Accessories Name",
        },          
        // property_name: { 
        //   required : "Please Enter The Property Name",
        // },   
        
      },      
  
  
  });

  $("#add_sim").validate({
    // Specify validation rules
    rules: {
      sim_type : {
        required : true,            
      },        
      
    },
    messages : {
      
      sim_type: { 
        required : "Please Enter The Sim Name",
      },                  
      
    },      


});

  $("#edit_add_brand").validate({
    // Specify validation rules
    rules: {
      brand_name : {
        required : true, 
        alpha: true, 
        noHTMLtags: true              
      },    
      
    },
    messages : {
      
      brand_name: { 
        required : "Please Enter The Brand Name",
      },           
      
    },      


});

$("#edit_add-os-form").validate({
  // Specify validation rules
  rules: {
    os_name : {
      required : true,            
    },    
    
  },
  messages : {
    
    os_name: { 
      required : "Please Enter The OS Type",
    },           
    
  },      


});


$("#edit_viewall_product").validate({   
  // Specify validation rules
  rules: {
    serial_no : {
      required : true,  
      alpha: true,  
      noHTMLtags: true         
    }, 
    processor_no : {
      required : true, 
      noHTMLtags: true              
    },  
    phone_no : {
      required : true, 
      noHTMLtags: true,
      alpha: true,
      minlength : 10,
      maxlength : 14,
      phoneUS: true          
    }, 
    Laptop_charger : {
      required : true,
      noHTMLtags: true               
    },   
  
    os : {
      required : true,  
      noHTMLtags: true,
      alpha: true             
    },
    sim : {
      required : true,            
    },    
    simcard : {
      required : true,  
      noHTMLtags: true,
      alpha: true            
    },    
    mobile_charger : {
      required : true,
      noHTMLtags: true,
      alpha: true               
    },  
    
  },
  messages : {
    
    serial_no: { 
      required : "Please Enter The Serial Number",
    },       
    
    processor_no: { 
      required : "Please Enter The Processor Number",
    },  
    phone_no: { 
      required : "Please Enter The Phone Number",
    },           
    Laptop_charger: { 
      required : "Please Enter The Phone Number",
    }, 
    sim: { 
      required : "Please  Choose The Sim Name",
    }, 
    simcard: { 
      required : "Please Choose The Sim Card Type",
    },
    os: { 
      required : "Please Choose The OS Type",
    }, 
    mobile_charger: { 
      required : "Please Choose The Mobile Charger Name",
    },           
  },      


});


$("#add_productlist").validate({
  // Specify validation rules
  rules: {
    brand : {
      required : true,            
    }, 
    accessories : {
      required : true,            
    }, 
    serial_no : {
      required : true, 
      noHTMLtags: true, 
      alpha: true             
    },    
    processor_no : {
      required : true, 
      noHTMLtags: true,
      alpha: true,               
    },
    os : {
      required : true,  
      noHTMLtags: true,
      alpha: true             
    },
    Laptop_charger : {
      required : true,  
      noHTMLtags: true,
      alpha: true            
    },
    sim : {
      required : true,            
    },    
    simcard : {
      required : true,  
      noHTMLtags: true,
      alpha: true            
    },   
    phone_no : {
      required : true, 
      noHTMLtags: true,
      alpha: true,      
      minlength : 10,
      maxlength : 14,
      phoneUS: true            
    },
    mobile_charger : {
      required : true,
      noHTMLtags: true,
      alpha: true               
    },
  },
  messages : {
    
    brand: { 
      required : "Please Choose The Brand Name",
    },           
    accessories: { 
      required : "Please Choose The Accessories Name",
    }, 
    serial_no: { 
      required : "Please Enter a Serial Number",
    },
    processor_no: { 
      required : "Please Enter a Processor Number",
    }, 
    os: { 
      required : "Please Choose The OS Type",
    },
    Laptop_charger: { 
      required : "Please Enter a Laptop Charger Number",
    },
    sim: { 
      required : "Please  Choose The Sim Name",
    }, 
    simcard: { 
      required : "Please Choose The Sim Card Type",
    }, 
    phone_no: { 
      required : "Please Enter The Phone Number",
    }, 
    mobile_charger: { 
      required : "Please Choose The Mobile Charger Name",
    }, 
    
  },      


});

    });
    
    
    
    
    