 $("#checkAllmissattendance").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });

      "use strict";
     function checkboxcheckmisattendance(sl) {
        var check_id    = 'check_id_'+sl;
        var employee_id = 'employee_id_'+sl;
        var intime      = 'intime_'+sl;
        var outtime     = 'outtime_'+sl;
        var status      = 'status_'+sl;
        
        if ($('#' + check_id).prop("checked") == true) {
          document.getElementById(check_id).value = 1;
          document.getElementById(employee_id).setAttribute("name", "emp_id[]");
          document.getElementById(intime).setAttribute("name", "intimes[]");
          document.getElementById(outtime).setAttribute("name", "outtimes[]");
          document.getElementById(status).setAttribute("name", "status[]");
        } else if ($('#' + check_id).prop("checked") == false) {
            document.getElementById(check_id).value= '';
            document.getElementById(employee_id).removeAttribute("name", "");
            document.getElementById(intime).removeAttribute("name", "");
            document.getElementById(outtime).removeAttribute("name", "");
            document.getElementById(status).removeAttribute("name", "");

        }
    }

"use strict";
    function checkallmissattendance(){
  var check_id = 'checkAllmissattendance';
var checkitem = 'checkboxitem';
var employee_id = 'empid';
var intime = 'intimes';
var outtime = 'outtimes';
var status = 'status';
var allcheckbox = document.getElementsByClassName(checkitem);
  for (var i=0; i < allcheckbox.length; i++) {
       if ($('#' + check_id).prop("checked") == true) {
            document.getElementsByClassName(checkitem)[i].value = 1;
          document.getElementsByClassName(employee_id)[i].setAttribute("name", "emp_id[]");
          document.getElementsByClassName(intime)[i].setAttribute("name", "intimes[]");
          document.getElementsByClassName(outtime)[i].setAttribute("name", "outtimes[]");
          document.getElementsByClassName(status)[i].setAttribute("name", "status[]");
        } else if ($('#' + check_id).prop("checked") == false) {
          document.getElementsByClassName(checkitem)[i].value='';
          document.getElementsByClassName(employee_id)[i].removeAttribute("name", "");
          document.getElementsByClassName(intime)[i].removeAttribute("name", "");
          document.getElementsByClassName(outtime)[i].removeAttribute("name", "");
          document.getElementsByClassName(status)[i].removeAttribute("name", "");
        }
  }
     
    }


      $("#checkAllmonthlyattn").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });


   "use strict";
     function checkboxcheckmonthlyatt(sl) {
        var check_id    = 'check_id_'+sl;
        var employee_id = 'employee_id_'+sl;
        var intime      = 'intime_'+sl;
        var outtime     = 'outtime_'+sl;
        var status      = 'status_'+sl;
        
        if ($('#' + check_id).prop("checked") == true) {
          document.getElementById(check_id).value = 1;
          document.getElementById(employee_id).setAttribute("name", "emp_id[]");
          document.getElementById(intime).setAttribute("name", "intimes[]");
          document.getElementById(outtime).setAttribute("name", "outtimes[]");
          document.getElementById(status).setAttribute("name", "status[]");
        } else if ($('#' + check_id).prop("checked") == false) {
            document.getElementById(check_id).value= '';
            document.getElementById(employee_id).removeAttribute("name", "");
            document.getElementById(intime).removeAttribute("name", "");
            document.getElementById(outtime).removeAttribute("name", "");
            document.getElementById(status).removeAttribute("name", "");

        }
    }


 "use strict";
  function checkallmonthlyattn(){
  var check_id = 'checkAllmonthlyattn';
var checkitem = 'checkboxitem';
var employee_id = 'empid';
var intime = 'intimes';
var outtime = 'outtimes';
var status = 'status';
var allcheckbox = document.getElementsByClassName(checkitem);
  for (var i=0; i < allcheckbox.length; i++) {
       if ($('#' + check_id).prop("checked") == true) {
            document.getElementsByClassName(checkitem)[i].value = 1;
          document.getElementsByClassName(employee_id)[i].setAttribute("name", "emp_id[]");
          document.getElementsByClassName(intime)[i].setAttribute("name", "intimes[]");
          document.getElementsByClassName(outtime)[i].setAttribute("name", "outtimes[]");
          document.getElementsByClassName(status)[i].setAttribute("name", "status[]");
        } else if ($('#' + check_id).prop("checked") == false) {
          document.getElementsByClassName(checkitem)[i].value='';
          document.getElementsByClassName(employee_id)[i].removeAttribute("name", "");
          document.getElementsByClassName(intime)[i].removeAttribute("name", "");
          document.getElementsByClassName(outtime)[i].removeAttribute("name", "");
          document.getElementsByClassName(status)[i].removeAttribute("name", "");
        }
  }
     
    }

         "use strict";
      function checkfieldsmonthlyattn(){
            var employee_id = $('#employee_id').val();
            var year = $('#year').val();
            var month = $('#month').val();
            var intime = $('#intime').val();
            var out_time = $('#out_time').val();
            if(employee_id == '' || year == '' || month == '' || intime == '' || out_time == ''){ 
            if(employee_id == ''){
              emp_msg = 'Please Select Employee,';
            }else{
              emp_msg = '';
            }  
            if(year == ''){
              yr_msg = 'Please Select Year,';
            }else{
              yr_msg = '';
            } 
            if(month == ''){
              mn_msg = 'Please Select Month,';
            }else{
              mn_msg = '';
            }    

             if(intime == ''){
              intime_msg = 'Please Select In Time,';
            }else{
              intime_msg = '';
            }  
            if(out_time == ''){
              outtime_msg = 'Please Select Out Time,';
            }else{
              outtime_msg = '';
            }         
         var  css = 'none';
         var message  = '<div class="almsg"><span class="closebtn" onclick="this.parentElement.style.display='+"'none'"+';">&times;</span>'+emp_msg+' '+yr_msg+' '+mn_msg+' '+intime_msg+' '+outtime_msg+'.</div>';
           document.getElementById("almsg").innerHTML = message;
          }else{
            document.getElementById("form").submit();
          }
          }

         "use strict";
          function checkfieldsmonthlymissrep(){
            var employee_id = $('#employee_id').val();
            var year = $('#year').val();
            var month = $('#month').val();
            var department_id = $('#department_id').val();
            if(employee_id == '' || year == '' || month == '' || department_id == '' ){ 
            if(employee_id == ''){
              emp_msg = 'Please Select Employee,';
            }else{
              emp_msg = '';
            }  
            if(year == ''){
              yr_msg = 'Please Select Year,';
            }else{
              yr_msg = '';
            } 
            if(month == ''){
              mn_msg = 'Please Select Month,';
            }else{
              mn_msg = '';
            }    

             if(department_id == ''){
              dpMsg = 'Please Select Department,';
            }else{
              dpMsg = '';
            }  
                   
         var  css = 'none';
         var message  = '<div class="almsg"><span class="closebtn" onclick="this.parentElement.style.display='+"'none'"+';">&times;</span>'+emp_msg+' '+dpMsg+' '+yr_msg+' '+mn_msg+'.</div>';
           document.getElementById("almsg").innerHTML = message;
          }else{
            document.getElementById("form").submit();
          }
          }

          "use strict";
            function checkfieldsMonthlyattrep(){
            var employee_id = $('#employee_id').val();
            var year = $('#year').val();
            var month = $('#month').val();
            var department_id = $('#department_id').val();
            var out_time = $('#out_time').val();
            if(employee_id == '' || year == '' || month == '' || department_id == '' ){ 
            if(employee_id == ''){
              emp_msg = 'Please Select Employee,';
            }else{
              emp_msg = '';
            }  
            if(year == ''){
              yr_msg = 'Please Select Year,';
            }else{
              yr_msg = '';
            } 
            if(month == ''){
              mn_msg = 'Please Select Month,';
            }else{
              mn_msg = '';
            }    

             if(department_id == ''){
              dpMsg = 'Please Select Department,';
            }else{
              dpMsg = '';
            }  
                   
         var  css = 'none';
         var message  = '<div class="almsg"><span class="closebtn" onclick="this.parentElement.style.display='+"'none'"+';">&times;</span>'+emp_msg+' '+dpMsg+' '+yr_msg+' '+mn_msg+'.</div>';
           document.getElementById("almsg").innerHTML = message;
          }else{
            document.getElementById("form").submit();
          }
          }


    "use strict";
    function checktable() {
      var base_url = $("#base_url").val();
      var csrf_test_name = $('#csrftoken').val();
    var table = $('input[name="tables[]"]:checked').map(function(){
        return this.value;
    }).get();

    $.ajax({
        type: "post",
        url: base_url + "reports/Adhoc_controller/findtablefield",
        data: {
            tables: table,
            csrf_test_name:csrf_test_name,
        },
        success: function(data)
        {
            if(table !=''){
             $('.nav-tabs > .active').next('li').find('a').trigger('click');
              document.getElementById("fields").innerHTML=data;
              }else{
              alert('Please Check Your Tables');
            }
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

"use strict";
 function checkedfield(){
  var base_url = $("#base_url").val();
  var csrf_test_name = $('#csrftoken').val();
  var fields = $('input[name="fields[]"]:checked').map(function(){
        return this.value;
    }).get();
    $.ajax({
        type: "post",
        url: base_url + "reports/Adhoc_controller/selectedfield",
        data: {
            fields: fields,
            csrf_test_name:csrf_test_name,
        },
        success: function(data)
        {
          if(fields !=''){
             $('.nav-tabs > .active').next('li').find('a').trigger('click');
              document.getElementById("ssf1").innerHTML=data;
            }else{
              alert('Please Check Your Fields');
            }
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// query result
"use strict";
function results(){
 
 var fields = $('input[name="fields[]"]:checked').map(function(){
        return this.value;
    }).get();
  var table = $('input[name="tables[]"]:checked').map(function(){
        return this.value;
    }).get();
  var value = $('input[name="value[]"]').map(function(){
        return this.value;
    }).get();
var op = $('select[name="operator[]"]').filter(function() {
  return $.trim(this.value).length;  
}).map(function() {
  return this.value;
}).get();

   var selfield = $('select[name="selectfield[]"]').filter(function() {
  return $.trim(this.value).length;  
}).map(function() {
  return this.value;
}).get();
 var oprator  = op;
 var       q  = value;
 var       p  = selfield; 
 var base_url = $("#base_url").val();
  var csrf_test_name = $('#csrftoken').val();
               $.ajax({
        type: "post",
        url: base_url + "reports/Adhoc_controller/resultss",
        data: {
            q: q,
            p: p,
            operator:oprator,
            fields:fields,
            tables:table,
            csrf_test_name:csrf_test_name
        },
        success: function(data)
        {
          if(value !=''&& op !='' && fields !=''){
              document.getElementById("result").innerHTML=data;
            }else{
              alert('Please Set your queries');
            }
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('No Relational ID');
        }
    });
}


 var count = $('#equipment_table tr').length;
    var limits = 500;

"use strict";
    function addasset(divName){
  
        if (count == limits)  {
            alert("you_have_reached_the_limit_of_adding " + count + "inputs ");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="ssf"+count;
            var dropdown = document.getElementById("ssf1").innerHTML;
             newdiv = document.createElement("tr");
             newdiv.innerHTML =' <td><div class=""><select name="selectfield[]" id="ssf'+count+'"  class="form-control selectbox"></select></div></td><td> <div class=""><select class="form-control selectbox" name="operator[]" id="operator'+count+'"><option value="">Select Oprator</option><option value="=">=</option><option value=">">></option><option value="<"><</option><option value="<="><=</option><option value=">=">>=</option><option value="!=">!=</option></select></div></td><td> <div class=""><input name="value[]" class="form-control selectbox" type="text" placeholder="Value" id="q'+count+'" value=""></div></td><td> <button style="text-align: right;" class="btn btn-danger red" type="button" value="delete" onclick="deleteRow(this)"><i class="fa fa-close"></i></button></td>';
             document.getElementById(divName).appendChild(newdiv);
             document.getElementById(tabin).focus();
            document.getElementById("ssf"+count).innerHTML=dropdown;
            count++;
            $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }



"use strict";
      function deleteRow(e) {
        var t = $("#equipment_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
    }
                 $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

