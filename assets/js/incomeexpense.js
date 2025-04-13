"use strict"; 
	function paymentypeselectExpns(sl) {
            var  hdcode     = $('#paytype_'+sl).val();
            var dataString  = 'paytype='+ hdcode;
            var base_url    = $('#baseUrl').val();
            var csrf_test_name = $('[name="csrf_test_name"]').val();
            var paymentcode = '#headcode_'+sl;
              $.ajax
                   ({
                        type: "POST",
                        url: base_url+"expense/expense/retrieve_paytypedata",
                        data: {
                          paytype:hdcode,
                          csrf_test_name: csrf_test_name
                        },
                         cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                            $(paymentcode).html(obj.headcode);
                        } 
                    });

}


    var count = 1;
    var limits = 500;

"use strict"; 
    function addpaymentfieldExpense(divName){

   var row = $("#expensfield tbody tr").length;
   var optionval = $("#paytypelist").val();
   $("#notfound").remove();
    var count = row;
        if (count == limits)  {
            alert("you_have_reached_the_limit_of_adding " + count + "inputs");
        }
        else{
            var newdiv = document.createElement('tr');
           newdiv = document.createElement("tr");
            newdiv.innerHTML ='<td class="expenseincometd"><input  type="text" value="" class="form-control datepicker" id="" name="date[]" /></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="particular_'+count+'" name="particular[]" /></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="voucher_no_'+count+'" value="" name="voucher_no[]" /></td><td class="expenseincomesndtd"><input  type="number" class="form-control" id="amount_'+count+'" name="amount[]" onkeyup="formatcheck(this)" onInput="checkrequired('+count+')" /></td><td class="expenseincometd"><select name="parent_type[]" class="form-control" onchange="paymentypeselectExpns('+count+')" id="paytype_'+count+'"><option value="">select_type</option></select></td><td class="expenseincometd"><select name="headcode[]" class="form-control" id="headcode_'+count+'"><option></option></select></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="remarks" name="remarks[]" /></td><td class="expenseincomesndtd"><button type="button" id="delPOIbutton" class="btn btn-danger" value="Delete" onclick="deleteRowExpns(this)"><i class="fa fa-trash"></i></button></td>';
            document.getElementById(divName).appendChild(newdiv);
            $("#paytype_"+count).html(optionval);
            count++;
$('.datepicker').datetimepicker({
         timepicker: false,
        format: 'Y-m-d'
    });
 
 $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
           
        }
    }

"use strict"; 
     function checkrequired(sl) {
       var amount = 'amount_' + sl;
       var voucher ='voucher_no_'+sl;
       var paytype = 'paytype_'+sl;
       var particular = 'particular_'+sl;
var amounts = document.getElementById(amount);
var am = amounts.value;
       if(am != ''){
        document.getElementById(voucher).setAttribute("required", "required");
        document.getElementById(paytype).setAttribute("required", "required");
        document.getElementById(particular).setAttribute("required", "required");
       }
       if(am == ''){
       document.getElementById(voucher).removeAttribute("required");
       document.getElementById(paytype).removeAttribute("required");
       document.getElementById(particular).removeAttribute("required");
       }
    }


     "use strict"; 
      function formatcheck(input) {

  var nStr = input.value + '';  
  nStr = nStr.replace(/[^0-9]/g, "");
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';  
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  input.value = x1 + x2;

}

        "use strict"; 
      function deleteRowExpns(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('expensfield').deleteRow(i);
}

  "use strict"; 
function paymentypeselectIncome(sl) {
            var  hdcode     = $('#paytype_'+sl).val();
            var dataString  = 'paytype='+ hdcode;
            var base_url    = $('#baseUrl').val();
            var paymentcode = '#headcode_'+sl;
            var csrf_test_name = $('[name="csrf_test_name"]').val();
              $.ajax
                   ({
                        type: "POST",
                        url: base_url+"income/income/retrieve_paytypedata",
                        data: {
                          paytype:hdcode,
                          csrf_test_name: csrf_test_name
                        },
                        cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                            $(paymentcode).html(obj.headcode);
                        } 
                    });

}


    var count = 1;
    var limits = 500;
   "use strict"; 
    function addpaymentfieldIncome(divName){

   var row = $("#incomefields tbody tr").length;
   var optionval = $("#paytypelist").val();
   $("#notfound").remove();
    var count = row;
        if (count == limits)  {
            alert("you_have_reached_the_limit_of_adding" + count + "inputs");
        }
        else{
            var newdiv = document.createElement('tr');
           newdiv = document.createElement("tr");
            newdiv.innerHTML ='<td class="expenseincometd"><input  type="text" value="" class="form-control datepicker"  name="date[]" /></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="particular_'+count+'" name="particular[]" /></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="voucher_no_'+count+'" value="" name="voucher_no[]" /></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="amount_'+count+'" name="amount[]" onkeyup="formatcheck(this)" onInput="checkrequired('+count+')" /></td><td class="expenseincometd"><select name="parent_type[]" class="form-control" onchange="paymentypeselectIncome('+count+')" id="paytype_'+count+'"></select></td><td class="expenseincometd"><select name="headcode[]" class="form-control" id="headcode_'+count+'"><option></option></select></td><td class="expenseincomesndtd"><input  type="text" class="form-control" id="remarks" name="remarks[]" /></td><td class="expenseincomesndtd"><button type="button" id="delPOIbutton" class="btn btn-danger" value="Delete" onclick="deleteRowIncome(this)"><i class="fa fa-trash"></i></button></td>';
            document.getElementById(divName).appendChild(newdiv);
            $("#paytype_"+count).html(optionval);
            count++;
$('.datepicker').datetimepicker({
         timepicker: false,
        format: 'Y-m-d'
    });
 $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
           
        }
    }
           "use strict"; 
          function deleteRowIncome(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('incomefields').deleteRow(i);
}