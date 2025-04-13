$(document).ready(function(e) {
    "use strict"; 
    function loanGrandcalculation(){
    var loan=Number($('#amount').val());
    var payl=Number($('#interest_rate').val());
    var inssdsd=Number($('#installment_period').val());
 

   var date1 =new Date($('#repayment_start_date').val());
   

var date2 =new Date($('#date_of_approve').val());
var timeDiff = Math.abs(date2.getTime() - date1.getTime());
var diffDays = Math.ceil((timeDiff / (1000 * 3600 * 24))/30); 

         var totalp=Math.round((loan+(loan*payl/100)).toFixed(2));

         var ab=Math.round((totalp)/inssdsd.toFixed(2));
        
        $('#repayment_amount').val(totalp);
         $('#installment').val(ab);
        

        }
        $('#amount,#interest_rate,#repayment_amount,#installment,#installment_period,#repayment_start_date,date_of_approve').keyup(loanGrandcalculation)


});

"use strict"; 
function SelectToLoadLoanReceiver(id){
 
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $("#base_url").val();
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + "loan/Loan/select_to_load/",
        method:'post',
       dataType:'json',
      data:{
            'employee_id':id,
            csrf_test_name: csrf_test_name
              },
        success: function(data)
        {
        
        document.getElementById("loan_id").innerHTML =data;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

"use strict"; 
function SelectReceiverinfo(id){
    //Ajax Load data from ajax
    var base_url = $("#base_url").val();
    $.ajax({
        url : base_url +"loan/Loan/select_to_install/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
              $('[name="installment_amount"]').val(data.installment);
              $('[name="due_amount"]').val(data.due);
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

"use strict"; 
function SelectReceiverInstallment(id){

    //Ajax Load data from ajax
     var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "loan/Loan/select_to_autoincrement/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        { var installment=parseInt(data) +1;
              $('[name="installment_no"]').val(installment);
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}