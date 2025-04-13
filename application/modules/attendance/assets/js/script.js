"use strict";
function check_emp_mnth_yr(){

    var employee_id = $('#employee_id').val();
    var year        = $('#year').val();
    var month       = $('#month').val();

    var emp_msg = '';
    var yr_msg = '';
    var mn_msg = '';

    if(employee_id == '' || year == '' || month == ''){ 

      if(employee_id == ''){
        emp_msg = 'Employee,';
      }
      if(year == ''){
        yr_msg = 'Year,';
      }
      if(month == ''){
        mn_msg = 'Month';
      }

     var  css = 'none';

     var message  = '<div class="almsg"><span class="closebtn" onclick="this.parentElement.style.display='+"'none'"+';">&times;</span> Please Select '+emp_msg+' '+yr_msg+' '+mn_msg+'</div>';
     document.getElementById("almsg").innerHTML = message;

    }else{
      document.getElementById("lateness_early_closing").submit();
    }

}
//all js 