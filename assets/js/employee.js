    "use strict"; 
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
  $('.btnPrevious').click(function(){
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  });

  $("#first_name").on('keyup', function() {
    var inpfirstname = document.getElementById('first_name');
    if (inpfirstname.value.length === 0) return;
    document.getElementById("first_name").style.borderColor = "green";
  });
  $("#last_name").on('keyup', function() {
    var inplastname = document.getElementById('last_name');
    if (inplastname.value.length === 0) return;
    document.getElementById("last_name").style.borderColor = "green";
  });
  $("#phone").on('keyup', function() {
    var inputphone = document.getElementById('phone');
    if (inputphone.value.length === 0) return;
   document.getElementById("phone").style.borderColor = "green";
  });
  $("#email").on('keyup', function() {
    var inpemail = document.getElementById('email');
    if (inpemail.value.length === 0) return;
     document.getElementById("email").style.borderColor = "green";
   var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!(inpemail.value).match(reEmail)) {

    document.getElementById("email_v_message").innerHTML = "Invalid email address";
    document.getElementById("email").style.borderColor = "red";
    return false;
  }
 document.getElementById("email_v_message").innerHTML = "";
  return true;
  });

    $("#h_email").on('keyup', function() {
    var inpemail = document.getElementById('h_email');
    if (inpemail.value.length === 0) return;
     document.getElementById("h_email").style.borderColor = "green";
   var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!(inpemail.value).match(reEmail)) {

    document.getElementById("h_email_v_message").innerHTML = "Invalid email address";
    document.getElementById("h_email").style.borderColor = "red";
    return false;
  }
 document.getElementById("h_email_v_message").innerHTML = "";
  return true;
  });

        $("#b_email").on('keyup', function() {
    var inpemail = document.getElementById('b_email');
    if (inpemail.value.length === 0) return;
     document.getElementById("b_email").style.borderColor = "green";
   var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!(inpemail.value).match(reEmail)) {

    document.getElementById("b_email_v_message").innerHTML = "Invalid email address";
    document.getElementById("b_email").style.borderColor = "red";
    return false;
  }
 document.getElementById("b_email_v_message").innerHTML = "";
  return true;
  });
//hire date
$("#hiredate").on('change', function() {
  var inputhiredate = document.getElementById('hiredate');
  if (inputhiredate.value.length === 0) return;
 document.getElementById("hiredate").style.borderColor = "green";
});
$("#ohiredate").on('change', function() {
  var inputhiredate = document.getElementById('ohiredate');
  if (inputhiredate.value.length === 0) return;
 document.getElementById("ohiredate").style.borderColor = "green";
});
$("#designation").on('change', function() {
  var inputdesignaiton = document.getElementById('designation');
  if (inputdesignaiton.value.length === 0) return;
 document.getElementById("desig").innerHTML = "";
});
$("#division").on('change', function() {
  var inputdivision = document.getElementById('division');
  if (inputdivision.value.length === 0) return;
 document.getElementById("divis").innerHTML = "";
});
$("#rate_type").on('change', function() {
  var inputrate_type = document.getElementById('rate_type');
  if (inputrate_type.value.length === 0) return;
 document.getElementById("rat_tp").innerHTML = "";
});

$("#rate").on('keyup', function() {
  var inputrate = document.getElementById('rate');
  if (inputrate.value.length === 0) return;
 document.getElementById("rate").style.borderColor = "green";
});
$("#pay_frequency").on('change', function() {

  var inputpay_frequency = document.getElementById('pay_frequency');
  if (inputpay_frequency.value.length === 0) return;
document.getElementById("frequ").innerHTML = "";
});
$("#dob").on('change', function() {
  var inputdob = document.getElementById('dob');
  if (inputdob.value.length === 0) return;
 document.getElementById("dob").style.borderColor = "green";
});
$("#gender").on('change', function() {
  var inputgender = document.getElementById('gender');
  if (inputgender.value.length === 0) return;
document.getElementById("gend").innerHTML = "";
});
$("#ssn").on('keyup', function() {
  var inputssn = document.getElementById('ssn');
  if (inputssn.value.length === 0) return;
  document.getElementById("ssn").style.borderColor = "green";
});
$("#h_phone").on('keyup', function() {
  var inputh_phone = document.getElementById('h_phone');
  if (inputh_phone.value.length === 0) return;
document.getElementById("h_phone").style.borderColor = "green";
});
$("#c_phone").on('keyup', function() {
  var inputc_phone = document.getElementById('c_phone');
  if (inputc_phone.value.length === 0) return;
 document.getElementById("c_phone").style.borderColor = "green";
});
$("#e_h_phone").on('keyup', function() {
  var inpute_h_phone = document.getElementById('e_h_phone');
  if (inpute_h_phone.value.length === 0) return;
document.getElementById("e_h_phone").style.borderColor = "green";
});

$("#a_e_h_phone").on('keyup', function() {
  var inpute_ah_phone = document.getElementById('a_e_h_phone');
  if (inpute_ah_phone.value.length === 0) return;
document.getElementById("a_e_h_phone").style.borderColor = "green";
});

$("#a_e_w_phone").on('keyup', function() {
  var inpute_aw_phone = document.getElementById('a_e_w_phone');
  if (inpute_aw_phone.value.length === 0) return;
document.getElementById("a_e_w_phone").style.borderColor = "green";
});


$("#e_w_phone").on('keyup', function() {
  var inpute_w_phone = document.getElementById('e_w_phone');
  if (inpute_w_phone.value.length === 0) return;
  document.getElementById("e_w_phone").style.borderColor = "green";
});
$("#em_contact").on('keyup', function() {
  var inputem_contact = document.getElementById('em_contact');
  if (inputem_contact.value.length === 0) return;
  document.getElementById("em_contact").style.borderColor = "green";
});
 "use strict"; 
function valid_inf() {
  var usernameInput = document.getElementById('first_name');
  var userlastnameInput = document.getElementById('last_name');
  var phoneInput = document.getElementById('phone');
  var emailInput = document.getElementById('email');
  var firstname = $('#first_name').val();
  var lastname = $('#last_name').val();
  var phone = $('#phone').val();
  var email = $('#email').val();
  var attendance_time = $('#attendance_time').val();
  var employee_type = $('#employee_type').val();

  

  if (firstname == "") {
    document.getElementById("first_name").style.borderColor = "red";

  }else{
    $("#first_name").on('keyup', function(){
     document.getElementById("first_name").style.borderColor = "green";
   });

  }
  if (lastname == "") {
    document.getElementById("last_name").style.borderColor = "red";

  }else{
    $("#last_name").on('keyup', function(){
     document.getElementById("last_name").style.borderColor = "green";
   });

  }
  if (phone == "") {
    document.getElementById("phone").style.borderColor = "red";

  }else{
    $("#phone").on('keyup', function(){
      document.getElementById("phone").style.borderColor = "green";
   });

  }
  if (attendance_time == "") {
    document.getElementById("attentime").style.color = "red";
    document.getElementById("attentime").innerHTML ='Attendance time field is required';

  }else{
    $("#attendance_time").on('keyup', function(){
      document.getElementById("attendance_time").style.color = "green";
      document.getElementById("attentime").innerHTML ='';
   });

  }

  if (employee_type == "") {
    document.getElementById("emptype").style.color = "red";
    document.getElementById("emptype").innerHTML ='Employee type field is required';

  }else{
    $("#employee_type").on('keyup', function(){
      document.getElementById("employee_type").style.color = "green";
      document.getElementById("emptype").innerHTML ='';
   });

  }

  if (email == "") {
     document.getElementById("email").style.borderColor = "red";
    return false;
  }else{
    $("#email").on('keyup', function(){
       document.getElementById("email").style.borderColor = "green";
   });
  }
 var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(email !== "" && email.match(reEmail) && phone !== "" && firstname !== "" && lastname !== "" && attendance_time !== "" && employee_type !== ""){
   $('.nav-tabs > .active').next('li').find('a').trigger('click');
 }
} 

// second tab validation
 "use strict"; 
function valid_bank_inf() {

  var acc_number     = $('#acc_number').val();
  var bank_name      = $('#bank_name').val();
  var bban_num       = $('#bban_num').val();
  var branch_address = $('#branch_address').val();



  $('.nav-tabs > .active').next('li').find('a').trigger('click');

}

// second tab validation
 "use strict"; 
function valid_salary_inf() {

  var gross_salary    = $('#gross_salary').val();
  var basic           = $('#basic').val();
  var transport       = $('#transport').val();
  var house_rent      = $('#house_rent').val();
  var medical         = $('#medical').val();
  var other_allowance = $('#other_allowance').val();

  var state_income_tax = $('#state_income_tax').val();
  var soc_sec_npf_tax  = $('#soc_sec_npf_tax').val();
  var tin_no           = $('#tin_no').val();

  if (gross_salary == "") {
    document.getElementById("gross_salary").style.borderColor = "red";

  }else{
    $("#gross_salary").on('keyup', function(){
     document.getElementById("gross_salary").style.borderColor = "green";
   });

  }

  if (basic == "") {
    document.getElementById("basic").style.borderColor = "red";

  }else{
    $("#basic").on('keyup', function(){
     document.getElementById("basic").style.borderColor = "green";
   });

  }

  if (transport == "") {
    document.getElementById("transport").style.borderColor = "red";

  }else{
    $("#transport").on('keyup', function(){
     document.getElementById("transport").style.borderColor = "green";
   });

  }

  // Compare basic and all allowace with Gross salary, that if not equal.. not allow to move next tab
  var gross_salary_val    = 0.0;
  var basic_val           = 0.0;
  var transport_val       = 0.0;


  if(parseFloat(gross_salary) > 0){
    gross_salary_val = parseFloat(gross_salary);
  }
  if(parseFloat(basic) > 0){
    basic_val = parseFloat(basic);
  }
  if(parseFloat(transport) > 0){
    transport_val = parseFloat(transport);
  }

  var basic_and_allowance = basic_val + transport_val;
  //console.log(basic_and_allowance);

  if(gross_salary == "" || basic == "" || transport == ""){
     alert('Please fillup all required fields.');
  }else if(basic_and_allowance != gross_salary_val){
    alert('Gross salary must be equal with sum of all basic and allwoance input.');
  }
  else{
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
  }

}

// second tab validation
 "use strict"; 
function valid_inf2() {
  var hiredateInput = document.getElementById('hiredate');
  var ohiredateInput = document.getElementById('ohiredate');
  var divisionInput = document.getElementById('division');
  var designationInput = document.getElementById('designation');
  var rate_typeInput = document.getElementById('rate_type');
  var rateInput = document.getElementById('rate');
  var pay_frequencyInput = document.getElementById('pay_frequency');
  var hiredate = $('#hiredate').val();
  var ohiredate = $('#ohiredate').val();
  var designation = $('#designation').val();
  var division = $('#division').val();
  var rate_type = $('#rate_type').val();
  var rate = $('#rate').val();
  var pay_frequency = $('#pay_frequency').val();
  var monthly_work_hours = $('#monthly_work_hours').val();

  if (division == ""){
    document.getElementById("divis").style.color = "red";
    document.getElementById("divis").innerHTML ='Division Field is Required';
  }else{
    $("#division").on('keyup', function(){
       document.getElementById("divis").style.color = "green";
   });

  }
  if (designation == "") {
       document.getElementById("desig").style.color = "red";
       document.getElementById("desig").innerHTML ='Designation Field is Required';

  }else{
    $("#designation").on('keyup', function(){
        document.getElementById("designation").style.color = "green";
        document.getElementById("desig").innerHTML ='';
   });

  }

  if (hiredate == "") {
     document.getElementById("hiredate").style.borderColor = "red";
  }else{
    $("#hiredate").on('keyup', function(){
     document.getElementById("hiredate").style.borderColor = "green";
   });
    

  }
  if (ohiredate == "") {
     document.getElementById("ohiredate").style.borderColor = "red";

  }else{
    $("#ohiredate").on('keyup', function(){
   document.getElementById("ohiredate").style.borderColor = "green";
   });
    

  }
  if (rate_type == "") {
     document.getElementById("rat_tp").style.color = "red";
     document.getElementById("rat_tp").innerHTML ='Rate Type Field is Required';
  }else{
    $("#rate_type").on('keyup', function(){
     document.getElementById("rat_tp").innerHTML = "";
   });
    

  }
  if (rate == "") {
   document.getElementById("rate").style.borderColor = "red";

  }else{
    $("#rate").on('keyup', function(){
    document.getElementById("rate").style.borderColor = "green";
   });
    

  }
  if (pay_frequency == "") {
       document.getElementById("frequ").style.color = "red";
       document.getElementById("frequ").innerHTML ='Frequency Field is Required';
  }else{
    $("#pay_frequency").on('keyup', function(){
      document.getElementById("frequ").innerHTML ='';
   });
    

  }
  if (monthly_work_hours == "") {
   document.getElementById("monthly_work_hours").style.borderColor = "red";

  }else{
    $("#monthly_work_hours").on('keyup', function(){
    document.getElementById("monthly_work_hours").style.borderColor = "green";
   });
    
  }

  if(division !== "" && designation !== "" && hiredate !== "" && ohiredate !== "" && rate_type !== "" && rate !== "" && pay_frequency !== ""){
   $('.nav-tabs > .active').next('li').find('a').trigger('click');
 }
}

// third tab validation
 "use strict"; 
function valid_inf3() {
  
 $('.nav-tabs > .active').next('li').find('a').trigger('click');

}
 "use strict"; 
function valid_class() {
  
 $('.nav-tabs > .active').next('li').find('a').trigger('click');

}
// third tab validation
 "use strict"; 
function valid_inf4() {
  
 
 $('.nav-tabs > .active').next('li').find('a').trigger('click');

}
 "use strict"; 
function valid_inf5() {
  var dobInput = document.getElementById('dob');
  var genderInput = document.getElementById('gender');
  var ssnInput = document.getElementById('ssn');
  var dob = $('#dob').val();
  var gender = $('#gender').val();
  var ssn = $('#ssn').val();
  if (dob == "") {
    document.getElementById("dob").style.borderColor = "red";
  }else{
    $("#dob").on('keyup', function(){
     document.getElementById("dob").style.borderColor = "green";
   });
    

  }
  if (gender == "") {
  document.getElementById("gend").style.color = "red";
  document.getElementById("gend").innerHTML ='Gender Field is Required';

  }else{
    $("#gender").on('keyup', function(){
   document.getElementById("gend").innerHTML ='';
   });
    

  }
  if (ssn == "") {
    document.getElementById("ssn").style.borderColor = "red";

  }else{
    $("#ssn").on('keyup', function(){
     document.getElementById("ssn").style.borderColor = "green";
   });
    

  }
  if(dob !== "" && gender !== "" && ssn !== ""){
   $('.nav-tabs > .active').next('li').find('a').trigger('click');
 }

}
 "use strict"; 
function valid_inf6() {
  
  var h_phoneInput = document.getElementById('h_phone');
  var c_phoneInput = document.getElementById('c_phone');
  var h_phone = $('#h_phone').val();
  var c_phone = $('#c_phone').val();
  if (h_phone == "") {
    document.getElementById("h_phone").style.borderColor = "red";
  }else{
    $("#h_phone").on('keyup', function(){
     document.getElementById("h_phone").style.borderColor = "green";
   });

  }
  if (c_phone == "") {
  document.getElementById("c_phone").style.borderColor = "red";
  }else{
    $("#c_phone").on('keyup', function(){
     document.getElementById("c_phone").style.borderColor = "green";
   });

  }
  if(h_phone !== "" && c_phone !== ""){
   $('.nav-tabs > .active').next('li').find('a').trigger('click');
 }

}
 "use strict"; 
function valid_inf7() {
 var em_contactInput = document.getElementById('em_contact');
 var em_contact = $('#em_contact').val();
 var e_h_phoneInput = document.getElementById('e_h_phone');
 
 var e_ah_phoneInput = document.getElementById('a_e_h_phone');
 var e_h_phone = $('#e_h_phone').val();
 var e_ah_phone = $('#a_e_h_phone').val();
 var e_aw_phone = $('#a_e_w_phone').val();
 var e_w_phoneInput = document.getElementById('e_w_phone');
 var e_w_phone = $('#e_w_phone').val();
 if (em_contact == "") {
  document.getElementById("em_contact").style.borderColor = "red";
}else{
  $("#em_contact").on('keyup', function(){
    document.getElementById("em_contact").style.borderColor = "green";
 });

}
if (e_h_phone == "") {
  document.getElementById("e_h_phone").style.borderColor = "red";
}else{
  $("#e_h_phone").on('keyup', function(){
    document.getElementById("e_h_phone").style.borderColor = "green";
 });

}
if (e_ah_phone == "") {
  document.getElementById("a_e_h_phone").style.borderColor = "red";
}else{
  $("#a_e_h_phone").on('keyup', function(){
    document.getElementById("a_e_h_phone").style.borderColor = "green";
 });

}
if (e_aw_phone == "") {
  document.getElementById("a_e_w_phone").style.borderColor = "red";
}else{
  $("#a_e_w_phone").on('keyup', function(){
    document.getElementById("a_e_w_phone").style.borderColor = "green";
 });

}
if (e_w_phone == "") {
   document.getElementById("e_w_phone").style.borderColor = "red";
}else{
  $("#e_w_phone").on('keyup', function(){
   document.getElementById("e_w_phone").style.borderColor = "green";
 });

}
if(em_contact !== "" && e_h_phone !== "" && e_w_phone !== "" && e_ah_phone !=="" && e_aw_phone !==""){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
}

}

 "use strict"; 
function valid_inf_custom(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
}
 "use strict"; 
function valid_inf8() {
   var user_email = $('#user_email').val();
  var password = $('#password').val();
  if (password == "") {
    document.getElementById("password").style.borderColor = "red";

  }else{
    $("#password").on('keyup', function(){
     document.getElementById("password").style.borderColor = "green";
   });

  }
  if (user_email == "") {
    document.getElementById("user_email").style.borderColor = "red";

  }else{
    $("#user_email").on('keyup', function(){
      document.getElementById("user_email").style.borderColor = "green";
   });

  }

  if(user_email !== "" && password !== "" ){
  document.getElementById("emp_form").submit();
}
  


}

 "use strict"; 
function setuseemail(){
   var email = document.getElementById("email").value;
  document.getElementById("user_email").value = email;
}

 $(document).ready(function() {
   
// choose text for the show/hide link - can contain HTML (e.g. an image)
var showText='<span class="btn btn-primary" >Add More</span>';
var hideText='<span class="btn btn-danger" >Close</span>';

// initialise the visibility check
var is_visible = false;

// append show/hide links to the element directly preceding the element with a class of "toggle"
$('.toggle').prev().append(' <a href="#" class="toggleLink">'+showText+'</a>');

// hide all of the elements with a class of 'toggle'
$('.toggle').hide();

// capture clicks on the toggle links
$('a.toggleLink').click(function() {
 
// switch visibility
is_visible = !is_visible;

// change the link depending on whether the element is shown or hidden
$(this).html( (!is_visible) ? showText : hideText);

// toggle the display - uncomment the next line for a basic "accordion" style

$(this).parent().next('.toggle').toggle('slow');

// return false so any link destination is not followed
return false;

});
});

 "use strict"; 
 function bank_paymet(val){
        if(val==2){
           var style = 'block'; 
           
        }else{
   var style ='none';
   
        }
    document.getElementById('bank_div').style.display = style;
    }

 "use strict"; 
    function Payment(salpayid,employee_id,TotalSalary,WorkHour,Period){
  var base_url = $("#base_url").val();
   var sal_id = salpayid;
   var employee_id = employee_id;
   var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
    url: base_url + "employee/Employees/EmployeePayment/'",
    method:'post',
    dataType:'json',
    data:{
     'sal_id':sal_id,
     'employee_id':employee_id,
     'totalamount':TotalSalary,
     csrf_test_name:csrf_test_name
    },
    success:function(data){
 document.getElementById('employee_name').value= data.Ename;
 document.getElementById('employee_id').value  = data.employee_id;
 document.getElementById('salType').value      = salpayid;
 document.getElementById('total_salary').value = TotalSalary;
 document.getElementById('total_working_minutes').value = WorkHour;
 document.getElementById('working_period').value = Period;
   $("#PaymentMOdal").modal('show');
    },
    error:function(jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }

    });
}