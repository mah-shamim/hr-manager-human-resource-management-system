"use strict"; 
function Payment(salpayid,employee_id,TotalSalary,WorkHour,Period){
  
   var sal_id = salpayid;
   var employee_id = employee_id;
   var base_url = $("#base_url").val();
   var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
    url: base_url + "employee/Employees/EmployeePayment/",
    method:'post',
    dataType:'json',
    data:{
     'sal_id':sal_id,
     'employee_id':employee_id,
     'totalamount':TotalSalary,
     csrf_test_name:csrf_test_name,
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

    $(function() {
      "use strict"; 
    $('.monthYearPicker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy'
    }).focus(function() {
        var thisCalendar = $(this);
        $('.ui-datepicker-calendar').detach();
        $('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
        });
    });
});

"use strict"; 
 function salarySetupsummary(){

      var ispercentage = $('#ispercentage').val();

      var addper = 0;
      var b = parseInt($('#basic').val());
      var add = 0;
      var deduct = 0;

      if(ispercentage == "1"){

          $(".addamount").each(function() {
                isNaN(this.value) || 0 == this.value.length || (addper += parseFloat(this.value))
            });
          if(addper >100){
          alert('You Can Not input more than 100%');
          }

          $(".addamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
          });
          $(".deducamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
          });

      }else{

          $(".addamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value) || 0 == value.length || (add += parseFloat(value))
          });
          $(".deducamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value) || 0 == value.length || (deduct += parseFloat(value))
          });

      }
      
      
      document.getElementById('grsalary').value=(add+b-(deduct)).toFixed(2);
}

"use strict"; 
 function handletax(checkbox){

    var deduct = 0;
    var add = 0;
    var check_empty_value = false;
    var b = parseInt($('#basic').val());

    var ispercentage = $('#ispercentage').val();

    if(ispercentage == "1"){

          $(".addamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value*basic/100) || 0 == (value*basic/100).length || (add += parseFloat(value*basic/100))
          });
          $(".deducamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value*basic/100) || 0 == (value*basic/100).length || (deduct += parseFloat(value*basic/100))
          });

      }else{

          $(".addamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value) || 0 == value.length || (add += parseFloat(value))
          });
          $(".deducamount").each(function() {
              var value = this.value;
              var basic = parseInt($('#basic').val());
              isNaN(value) || 0 == value.length || (deduct += parseFloat(value))
          });

     }

    var employee_id  = $("#employee_id").val();

    if(check_empty_value || !employee_id){

        alert("Must fill employee and all the field values !");
        document.getElementById("taxinput").disabled = false;
        document.getElementById("taxmanager").checked = false;
        document.getElementById("taxmanager").removeAttribute('disabled'); 
    }

   
    var amount = b-deduct;
    var  tax    = parseInt($('#taxinput').val());
    var netamount = amount+tax;
    var base_url  = $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();

    if(checkbox.checked == true){
       $.ajax({
        url : base_url + 'payroll/Payroll/salarywithtax/',
            method: 'post',
            dataType: 'json',
            data: 
            {
                'amount': amount,
                csrf_test_name : csrf_test_name
               
            },
        success: function(data)
        {            
              document.getElementById('grsalary').value=add+b-data-deduct;
              document.getElementById('taxinput').value='';
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    // Disabling taxinput filed when taxmanager checkbox is checked...
    document.getElementById("taxinput").disabled = true;
    //End

    }else{

      // Enabling taxinput filed when taxmanager checkbox is unchecked...
      document.getElementById("taxinput").disabled = false;
      //End

      document.getElementById('grsalary').value=add+b-(deduct);
   }
}
//onchange empoyee id information
"use strict"; 
function employeeSetup(id){

    //Reset all add or deduct amount fileds
    $(".addamount").val("");
    $(".deducamount").val("");
    //Ends

    var base_url  = $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
      url: base_url + "payroll/Payroll/employeebasic/",
      method:'post',
      dataType:'json',
      data:{
      'employee_id': id,
      csrf_test_name : csrf_test_name,
    },
    success:function(data){
      document.getElementById('basic').value=data.rate;
      document.getElementById('sal_type').value=data.rate_type;
      document.getElementById('sal_type_name').value=data.stype;
      document.getElementById('grsalary').value='';
    if(data.rate_type==1){
      document.getElementById("taxinput").disabled = true;
      document.getElementById("taxmanager").checked = true;
      document.getElementById("taxmanager").setAttribute('disabled','disabled');  
    }else{
      document.getElementById("taxinput").disabled = false;
      document.getElementById("taxmanager").checked = false;
      document.getElementById("taxmanager").removeAttribute('disabled');  
    }
    var i;
    var count = $('#add tr').length;
    for (i = 0; i < count; i++) { 
       $('add_'+i).removeAttr('value');
    }
      },
       error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
    });
}

 "use strict"; 
 function bank_paymet(val){
    if(val==2){
      var style = 'block'; 

    }else{
      var style ='none';

    }
    document.getElementById('bank_div').style.display = style;
}

// Function to set the percentage field value to 0 or 1

"use strict"; 
 function handlepercent(checkbox){

    var add = 0;
    var deduct = 0;

    // If salary_type is salary which value is 2, then make taxmanager checkbox unchecked
    var sal_type = $("#sal_type").val();
    if(sal_type == "2"){
       document.getElementById("taxmanager").checked = false;

    }
    //Ends
    
    $(".addamount").each(function() {

        var value = this.value;
        isNaN(value) || 0 == value.length || (add += parseFloat(value))

      });
    $(".deducamount").each(function() {

        var value = this.value;
        isNaN(value) || 0 == value.length || (deduct += parseFloat(value))

      });

    if(add != 0 || deduct != 0){

      alert('All addition and deduction open amount should be empty!');

      // If add/deduct available then if again checked/unchecked the checkbox, it will remain to it's same checked or unchecked state
      if(checkbox.checked==true){
          document.getElementById("ispercentage").checked = false;
      }else{
          document.getElementById("ispercentage").checked = true;
      }

    }else{

        if(checkbox.checked==true){
          document.getElementById('ispercentage').value = 1;
          $(".percent").show();
        }else{
          document.getElementById('ispercentage').value = 0;
          $(".percent").hide();
        }    
    }

    

 }

// Jquery on load / document on ready

 $(function () {

      "use strict"; 

      // Hiding % in salary setup form
      $(".percent").hide();

      $("#taxinput").keyup(function(e){

          // Checking if taxinput is taken , then making taxmanager disabled .... otherwise keeping enabled
          var taxinput = $('#taxinput').val();


          if(taxinput){
              document.getElementById("taxmanager").setAttribute('disabled','disabled'); 
          }else{
              document.getElementById("taxinput").disabled = false;
              document.getElementById("taxmanager").checked = false;
              document.getElementById("taxmanager").removeAttribute('disabled'); 
          }
          //End
           
      }); 

  });