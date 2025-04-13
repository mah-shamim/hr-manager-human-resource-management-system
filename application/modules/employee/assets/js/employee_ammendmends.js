"use strict"; 
  $("#basic").on('keyup', function(){

      var basic           = $('#basic').val();
      var transport       = $('#transport').val();

      var basic_val           = 0.0;
      var transport_val       = 0.0;

      if(parseFloat(basic) > 0){
      basic_val = parseFloat(basic);
      }
      if(parseFloat(transport) > 0){
      transport_val = parseFloat(transport);
      }

       var basic_and_allowance = basic_val + transport_val;

       $('#gross_salary').val(basic_and_allowance);

   });

"use strict"; 
  $("#transport").on('keyup', function(){

      var basic           = $('#basic').val();
      var transport       = $('#transport').val();

      var basic_val           = 0.0;
      var transport_val       = 0.0;

      if(parseFloat(basic) > 0){
      basic_val = parseFloat(basic);
      }
      if(parseFloat(transport) > 0){
      transport_val = parseFloat(transport);
      }

       var basic_and_allowance = basic_val + transport_val;

       $('#gross_salary').val(basic_and_allowance);

   });