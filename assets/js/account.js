 "use strict"; 
 function parentchange() {
            var  hdcode     = $('#paytype').val();
            var dataString  = 'paytype='+ hdcode;
            var base_url    = $('#baseUrl').val();
            var paymentcode = '#headcode';
            var csrf_test_name = $('[name="csrf_test_name"]').val();
              $.ajax
                   ({
                        type: "POST",
                        url: base_url+"/income/income/retrieve_paytypedata",
                        data: {
                          'paytype':hdcode,
                          csrf_test_name:csrf_test_name
                        },
                        cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                            $(paymentcode).html(obj.headcode);
                        } 
                    });

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
  function cmbCode_onchange(){
      var Sel=$('#cmbCode').val();
      var Text=$('#cmbCode').text();
      var select= $("option:selected", $("#cmbCode")).text()
        $("#txtName").val(select);
        $("#txtCode").val(Sel);
    }

    /*contra voucher */
 "use strict"; 
     function load_codecontra(id,sl){
    var base_url = $("#base_url").val();

    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



//Add new option for credit vaucher
    "use strict"; 
    function addaccountcontra(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' ></select></td><td><input type='text' name='txtComment[]' value='' class='form-control'  id='txtComment_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='' placeholder='0.00' id='txtAmount_"+ count +"' onkeyup='calculationcontra("+ count +")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_"+ count +"' value='' placeholder='0.00' onkeyup='calculationcontra("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowcontra(this)'><i class='fa fa-trash-o'></i></button></td>";           
          document.getElementById(divName).appendChild(newdiv);
          $("#cmbCode_"+count).html(optionval);
          $('#subtype_'+count).attr("disabled","disabled");
          document.getElementById(tabin).focus();
          count++;           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }





 "use strict"; 
    function addaccountcontra2(divName){
      var optionval = $("#headoption").val();
    var row = $("#debtAccVoucher tbody tr").length;
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");

           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codecontra(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='' placeholder='0.00' id='txtAmount_"+ count +"' onkeyup='calculationcontra("+ count +")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_"+ count +"' value='' placeholder='0.00' onkeyup='calculationcontra("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowcontra(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
            $("#cmbCode_"+count).html(optionval);
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

 "use strict"; 
function calculationcontra(sl) {
        var gr_tot1=0;
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

 $(".total_price1").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
        });
        $("#grandTotal").val(gr_tot.toFixed(2,2));
         $("#grandTotal1").val(gr_tot1.toFixed(2,2));
    }

 "use strict"; 
    function deleteRowcontra(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationcontra()
    }
     /*Credit voucher part*/
      "use strict"; 
      function load_codeCreditv(id,sl){
      var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//Add new option for credit vaucher
    "use strict"; 
    function addaccountCreditv(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_subtypeOpen(this.value,"+ count +")'></select></td><td><select name='subtype[]' id='subtype_"+ count +"' class='form-control' ><option value=''>Please select One</option></select></td><td><input type='hidden' name='isSubtype[]' id='isSubtype_"+ count +"' value='1' /><input type='text' name='txtComment[]' value='' class='form-control'  id='txtComment_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' id='txtAmount_"+ count +"' onkeyup='calculationCreditv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowCreditv(this)'><i class='fa fa-trash-o'></i></button></td>";           
          document.getElementById(divName).appendChild(newdiv);
          $("#cmbCode_"+count).html(optionval);
          $('#subtype_'+count).attr("disabled","disabled");
          document.getElementById(tabin).focus();
          count++;           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }






addaccountcontra



 "use strict"; 
    function addaccountCreditv2(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codeCreditv(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' id='txtAmount_"+ count +"' onkeyup='calculationCreditv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowCreditv(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
           $("#cmbCode_"+count).html(optionval);
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

 "use strict"; 
function calculationCreditv(sl) {
       
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }

 "use strict"; 
    function deleteRowCreditv(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationCreditv()
    }

/*Opening balance part*/
 "use strict"; 
 function get_subtypeCode(id,sl){
    var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/getsubtypbyid/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {          
          if(data.subType != 1) {
            $('#isSubtype_'+sl).val(data.subType);            
          }           
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

/*Opening balance part*/
 "use strict"; 
 function load_subtypeOpen(id,sl){
    var base_url = $("#base_url").val();
    get_subtypeCode(id,sl);
    $.ajax({
        url : base_url + "accounts/getsubtypecode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
           // alert(data);
          if(data != '') {            
            $('#subtype_'+sl).html(data);
            $('#subtype_'+sl).removeAttr("disabled");
          } else {
            $('#subtype_'+sl).attr("disabled","disabled");            
          }
           
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


/*Debit Voucher part*/
 "use strict"; 
 function load_codeDebtv(id,sl){
    var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

 // "use strict"; 
 //    function addaccountDebt(divName){
 //    var row = $("#debtAccVoucher tbody tr").length;
 //    var optionval = $("#headoption").val();
 //    var count = row + 1;
 //    var limits = 500;
 //    var tabin = 0;
 //    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
 //    else {
 //          var newdiv = document.createElement('tr');
 //          var tabin="cmbCode_"+count;
 //          var tabindex = count * 2;
 //          newdiv = document.createElement("tr");
           
 //          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codeDebtv(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' id='txtAmount_"+ count +"' onkeyup='calculationDebtv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowDebtv(this)'><i class='fa fa-trash-o'></i></button></td>";
 //          document.getElementById(divName).appendChild(newdiv);
 //          $("#cmbCode_"+count).html(optionval);
 //          document.getElementById(tabin).focus();
 //          count++;
           
 //          $("select.form-control:not(.dont-select-me)").select2({
 //              placeholder: "Select option",
 //              allowClear: true
 //          });
 //        }
 //    }

 //Add new option for debit vaucher
    "use strict"; 
    function addaccountDebt(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_subtypeOpen(this.value,"+ count +")'></select></td><td><select name='subtype[]' id='subtype_"+ count +"' class='form-control' ><option value=''>Please select One</option></select></td><td><input type='hidden' name='isSubtype[]' id='isSubtype_"+ count +"' value='1' /><input type='text' name='txtComment[]' value='' class='form-control'  id='txtComment_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' id='txtAmount_"+ count +"' onkeyup='calculationDebtv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowDebtv(this)'><i class='fa fa-trash-o'></i></button></td>";           
          document.getElementById(divName).appendChild(newdiv);
          $("#cmbCode_"+count).html(optionval);
          $('#subtype_'+count).attr("disabled","disabled");
          document.getElementById(tabin).focus();
          count++;           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }




 "use strict"; 
function calculationDebtOpen(sl) {
       
        var gr_tot = 0;
        $(".total_dprice").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotald").val(gr_tot.toFixed(2,2));
    }
"use strict"; 
function calculationCreditOpen(sl) {
       
        var gr_tot = 0;
        $(".total_cprice").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotalc").val(gr_tot.toFixed(2,2));
    }

 "use strict"; 
    function deleteRowDebtOpen(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationDebtOpen();
        calculationCreditOpen();
    }

//Add new opening balance option
    "use strict"; 
    function addaccountOpen(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_subtypeOpen(this.value,"+ count +")'></select></td><td><select name='subtype[]' id='subtype_"+ count +"' class='form-control' ><option value=''>Please select One</option></select></td><td><input type='number' name='txtDebit[]' class='form-control total_dprice text-right' id='txtDebit_"+ count +"' onkeyup='calculationDebtOpen("+ count +")'></td><td><input type='number' name='txtCredit[]' class='form-control total_cprice text-right' id='txtCredit_"+ count +"' onkeyup='calculationCreditOpen("+ count +")'><input type='hidden' name='isSubtype[]' id='isSubtype_"+ count +"'  value='1'/></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowDebtOpen(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          $("#cmbCode_"+count).html(optionval);
          $('#subtype_'+count).attr("disabled","disabled");
          document.getElementById(tabin).focus();
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }


 "use strict"; 
function calculationDebtv(sl) {
       
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }

 "use strict"; 
    function deleteRowDebtv(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationDebtv()
    }

   /* Generel Ledger part*/
    //    $(document).ready(function(){
    //      "use strict"; 
    //     $('#cmbGLCode').on('change',function(){
    //       var base_url = '<?php echo base_url()';
    //       alert(base_url);
    //        var Headid=$(this).val();
    //         var csrf_test_name = $('[name="csrf_test_name"]').val();
    //         $.ajax({
    //              url: base_url + 'accounts/accounts/general_led',
    //             type: 'POST',
    //             data: {
    //                 Headid: Headid,
    //                 csrf_test_name:csrf_test_name
    //             },
    //             success: function (data) {
    //                $("#ShowmbGLCode").html(data);
    //             }
    //         });

    //     });
    // });
/*       Journal voucher */


"use strict";
function load_codeJournalv(id,sl){
var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/debtvouchercode/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


//Add new option for journal vaucher
    "use strict"; 
    function addaccountJournalv(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_subtypeOpen(this.value,"+ count +")'></select></td><td><select name='subtype[]' id='subtype_"+ count +"' class='form-control' ><option value=''>Please select One</option></select></td><td><input type='hidden' name='isSubtype[]' id='isSubtype_"+ count +"' value='1' /><input type='text' name='txtComment[]' value='' class='form-control'  id='txtComment_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='' placeholder='0.00' id='txtAmount_"+ count +"' onkeyup='calculationJournalv("+ count +")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_"+ count +"' value='' placeholder='0.00' onkeyup='calculationJournalv("+ count +")'></td><td> <select name='cmbDebit[]' id='cmbDebit_"+ count +"' class='form-control'></select></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowJournalv(this)'><i class='fa fa-trash-o'></i></button></td>";           
          document.getElementById(divName).appendChild(newdiv);
          $("#cmbCode_"+count).html(optionval);
          $("#cmbDebit_"+count).html(optionval);
          $('#subtype_'+count).attr("disabled","disabled");
          document.getElementById(tabin).focus();
          count++;           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }



   "use strict";
    function addaccountJournalv2(divName){
    var row = $("#debtAccVoucher tbody tr").length;
    var optionval = $("#headoption").val();
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_codeJournalv(this.value,"+ count +")'></select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' value='' placeholder='0.00' id='txtAmount_"+ count +"' onkeyup='calculationJournalv("+ count +")'></td><td><input type='number' name='txtAmountcr[]' class='form-control total_price1 text-right' id='txtAmount1_"+ count +"' value='' placeholder='0.00' onkeyup='calculationJournalv("+ count +")'></td><td><button  class='btn btn-danger red' type='button' value='delete' onclick='deleteRowJournalv(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
          $("#cmbCode_"+count).html(optionval);
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

"use strict";
function calculationJournalv(sl) {
        var gr_tot1=0;
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

 $(".total_price1").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
        });
        $("#grandTotal").val(gr_tot.toFixed(2,2));
         $("#grandTotal1").val(gr_tot1.toFixed(2,2));
    }
 
 "use strict";
    function deleteRowJournalv(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculationJournalv()
    }
  

/*chart of account subtype*/
  "use strict";
  function isSubType_change(stype){
     if($('#' + stype).is(":checked")) {
      var base_url = $("#base_url").val();
        $.ajax({
            url : base_url + "accounts/accounts/getsubtype/",
            type: "GET",
            dataType: "json",
            success: function(data)
            {   
                if(data == "") {
                     $('#subtypeContent').html('');
                     $('#subtypeContent').hide(); 
                }    else {
                      $('#subtypeContent').html(data);
                      $('#subtypeContent').show();    
                }     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    } else {
         $('#subtypeContent').html('');
         $('#subtypeContent').hide(); 
    }
 }


  // is fixedasset then show fixedasset  rrelated data
   "use strict";
  function isFixedAssetSch_change(fxas,ht) {     
     if($('#' + fxas).is(":checked")) {
        if(ht == 'A') {
             var fixedcode = "<td>Fixed Asset Code</td><td><input type=\"text\" name=\"assetCode\" id=\"assetCode\" class=\"form_input\" onchange=\"enableDisableField('assetCode','depCode')\" value=\"\"/></td>";
             var depraciationcode = "<td>Depraciation Rate % </td><td><input type=\"text\" name=\"DepreciationRate\" id=\"DepreciationRate\" class=\"form_input\"  value=\"\"/></td>";
        } else {
              //var fixedcode = "<td>Fixed Asset Code</td><td><input type=\"text\" name=\"assetCode\" id=\"assetCode\" class=\"form_input\" onchange=\"enableDisableField('assetCode','depCode')\" value=\"\"/></td>";
             var fixedcode = "";
             var depraciationcode = "<td>Depraciation Code</td><td><input type=\"text\" name=\"depCode\" id=\"depCode\" class=\"form_input\"  onchange=\"enableDisableField('depCode','assetCode')\" value=\"\"/></td>";
        }
         $('#fixedassetCode').html(fixedcode);
         $('#depreciationCode').html(depraciationcode);       
         $('#fixedassetCode').show();      
         $('#depreciationCode').show();
     } else {
         $('#fixedassetCode').html('');
         $('#depreciationCode').html('');
         $('#depreciationCode').hide();
         $('#fixedassetCode').hide();
     }
  } 



// enableDisableField
  "use strict";
  function enableDisableField(fid,lid) {
    var hname = $('#' + fid).val();    
    if(hname == "" || hname == null) {      
       $('#' + lid).removeAttr('disabled'); 
    } else {
       $('#' + lid).attr('disabled','disabled'); 
    }
}


// Check name field is empty
  "use strict";
  function checkNameField(fid,lid) {
    var hname = $('#' + fid).val();
    if(hname == "" || hname== null) {
       $('#' + lid).html("Please enter Head Name");
       $('#' + lid).css("color", "red");
       $('#' + lid).show();     
    } else {
       $('#' + lid).html("");
       $('#' + lid).hide();
      
    }
}

/*chart of account*/
  "use strict";
  function loadData(elm,id){
    var areaval = $('#'+id).attr('aria-level');
  //  alert(areaval);
    var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "accounts/accounts/selectedform/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
             $('#newform').html(data);
             $('#btnSave').hide();
             $('#cnodeelem').val(elm);
             $('#clevel').val(areaval);
             $('#btnUndo').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// check before submit data
   "use strict";
  function validate(lid) {  
    var nameVal = $('#txtHeadName').val();     
     if(nameVal == "" || nameVal== null) {
       $('#' + lid).html("Please enter Head Name");
       $('#' + lid).css("color", "red");
       $('#' + lid).show();
       return false;      
    } else {
    var nhtm =  '';
    var elid = $('#cnodeelem').val();
    var areaid = $('#clevel').val();
    var formData = $('#coaform').serialize();
    var base_url = $("#base_url").val(); 
    var hid = $('#txtHeadCode').val();   
    var phname = $('#txtPHead').val();   
    var hname = $('#txtHeadName').val();   
    var pid = $('#txtPHeadCode').val();   
     $.ajax({
        url : base_url + 'accounts/accounts/insert_coa',
        type: "POST",
        dataType: "json",
        data: formData,
        success: function(data)
        {   
            var content = data.info;    
            $('#successResult').html(data.message);
            $('#successResult').css("color", "green");
            if(data.type =='new') {               
              if ( $('#'+pid).find('ul').children().length > 0 ) {                
                 nhtm += '<li role="treeitem" aria-selected="true" aria-level="'+areaid+'" aria-labelledby="10101_anchor" id="'+hid+'" class="jstree-node  jstree-leaf jstree-last">';
                nhtm += '<i class="jstree-icon jstree-ocl" role="presentation"></i>';
                nhtm += '<a class="jstree-anchor jstree-clicked" href="javascript:" tabindex="-1" onclick="loadData( this.id,'+hid+')" id="'+hid+'_anchor" style="touch-action: none;">';
                nhtm += '<i class="jstree-icon jstree-themeicon fa fa-folder jstree-themeicon-custom" role="presentation"></i>'+hname+'</a></li>';

                $('#'+pid).find('ul').find('li').last().removeClass('jstree-last');
                $('#'+pid).find('ul').append(nhtm);
              } else {   

                nhtm += '<li role="treeitem" aria-selected="true" aria-level="'+areaid+'" aria-labelledby="10101_anchor" id="'+hid+'" class="jstree-node  jstree-leaf jstree-last">';
                nhtm += '<i class="jstree-icon jstree-ocl" role="presentation"></i>';
                nhtm += '<a class="jstree-anchor jstree-clicked" href="javascript:" tabindex="-1" onclick="loadData( this.id,'+hid+')" id="'+hid+'_anchor" style="touch-action: none;">';
                nhtm += '<i class="jstree-icon jstree-themeicon fa fa-folder jstree-themeicon-custom" role="presentation"></i>'+hname+'</a></li>';
                $( nhtm ).appendTo( '#'+pid );                 
               } 
                $('#cnodeelem').val(hid+'_anchor');
                $('#clevel').val(areaid);
            } else {
                
               //  nhtm +=  '<a class="jstree-anchor" href="javascript:" tabindex="-1" onclick="loadData( this.id,'+hid+')" id="'+elid+'"><i class="jstree-icon jstree-themeicon fa fa-folder jstree-themeicon-custom" role="presentation"></i>'+hname+'</a>';
                 nhtm +=  '<i class="jstree-icon jstree-themeicon fa fa-folder jstree-themeicon-custom" role="presentation"></i>'+hname ;
                 
                 $('#'+elid).html(nhtm);
                 $('#'+elid).removeAttr("onclick");
                 $('#'+elid).attr("onclick","loadData(this.id,'"+hid+"')");
                 
            } 
            $('#btnSave').hide();
            $('#btnUpdate').show();
            $('#btnDelete').show();
            $('#btnNew').removeAttr("onclick");
            $('#btnDelete').removeAttr("onclick");
            $("#btnNew").attr("onclick","newdata("+hid+")");
            $("#btnDelete").attr("onclick","delDataAcc("+hid+")"); 
            $("#successResult").show().delay(5000).fadeOut();

         },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Please try again');
        }
      });
       $('#' + lid).html("");
       $('#' + lid).hide();
       return false;
    }
  } 

  "use strict";
    function newdata(id){
       var base_url = $("#base_url").val(); 
       var areaid = $('#clevel').val();
       areaid++;
     $.ajax({
        url : base_url + "accounts/accounts/newform/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
           console.log(data.rowdata);
           var htmlcontent = "";
           var headlabel = data.headlabel;
           $('#txtHeadCode').val(data.headcode);
            document.getElementById("txtHeadName").value = '';
            $('#txtPHead').val(data.rowdata.HeadName);
            $('#txtHeadLevel').val(headlabel);
            $('#txtPHeadCode').val(data.rowdata.HeadCode);
            $('#clevel').val(areaid);
            $('#btnSave').prop("disabled", false);
            $('#btnSave').show();
            $('#btnUpdate').hide();
            $('#btnUndo').removeAttr("onclick");
            $("#btnUndo").attr("onclick","loadData('"+data.rowdata.HeadCode+"_anchor','"+data.rowdata.HeadCode+"')");
            $('#btnUndo').show();
             if(headlabel==3) {
                 htmlcontent += "<input type=\"checkbox\" value=\"1\" name=\"IsActive\" checked=\"checked\" id=\"IsActive\" size=\"28\"/><label for=\"IsActive\">&nbsp;Is Active</label> &nbsp;&nbsp; ";
                
                if(data.rowdata.HeadType == "A" || data.rowdata.HeadType == "L") {
                     if(data.rowdata.HeadType == "A" ) {
                         htmlcontent += "<input type=\"checkbox\" name=\"isStock\" value=\"1\" id=\isStock\" size=\"28\"  onchange=\"isStock_change()\"/><label for=\isStock\">&nbsp;Is Stock</label> &nbsp;&nbsp; ";
                      }
                      htmlcontent +="<input type=\"checkbox\" name=\"isFixedAssetSch\" value=\"1\" id=\"isFixedAssetSch\" size=\"28\"  onchange=\"isFixedAssetSch_change('isFixedAssetSch','" + data.rowdata.HeadType + "')\"/><label for=\"isFixedAssetSch\">&nbsp;Is Fixed Asset </label> &nbsp;&nbsp; ";
                     }  
                 $('#btnNew').show(); 
                               
             } else if(headlabel==4) {
                 htmlcontent += "<input type=\"checkbox\" value=\"1\" name=\"IsActive\" id=\"IsActive\" checked=\"checked\" size=\"28\"/><label for=\"IsActive\">&nbsp;Is Active</label> &nbsp;&nbsp; ";
                   if(data.rowdata.HeadType == "A"  || data.rowdata.HeadType == "L") {
                      if(data.rowdata.HeadType == "A" ) {
                         htmlcontent += "<input type=\"checkbox\" name=\"isStock\" value=\"1\" id=\isStock\" size=\"28\"  onchange=\"isStock_change()\"/><label for=\isStock\">&nbsp;Is Stock</label> &nbsp;&nbsp; ";
                         htmlcontent += "<br/><input type=\"checkbox\" name=\"isCashNature\" value=\"1\" id=\"isCashNature\" size=\"28\"  onchange=\"isCashNature_change()\"/><label for=\"isCashNature\">&nbsp;Is Cash Nature</label> &nbsp;&nbsp; ";
                         htmlcontent += "<input type=\"checkbox\" name=\"isBankNature\" value=\"1\" id=\"isBankNature\" size=\"28\"  onchange=\"isBankNature_change()\"/><label for=\"isBankNature\">&nbsp;Is Bank Nature</label> &nbsp;&nbsp; ";
                      }
                      htmlcontent +="<br/><input type=\"checkbox\" name=\"isFixedAssetSch\" value=\"1\" id=\"isFixedAssetSch\" size=\"28\"  onchange=\"isFixedAssetSch_change('isFixedAssetSch','"+data.rowdata.HeadType+"')\"/><label for=\"isFixedAssetSch\">&nbsp;Is Fixed Asset </label> &nbsp;&nbsp; ";
                                      }
                 htmlcontent += "<input type=\"checkbox\" name=\"isSubType\" value=\"1\" id=\"isSubType\" size=\"28\"  onchange=\"isSubType_change('isSubType')\"/><label for=\"isSubType\">&nbsp;Is Sub Type</label> &nbsp;&nbsp; ";
                $('#btnNew').hide();               
             }

             $('#innerCheck').html(htmlcontent);           
             
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



"use strict";
function delDataAcc(id){
    var base_url = $("#base_url").val();
    var confm = confirm('Are you sure you want to delete this account? If you delete this account all transation with this account will be deleted!');
    if(confm) {
        $.ajax({
        url : base_url + "accounts/accounts/deleteaccount/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
            {
                if(data.status == 'success') {
                    $('#'+id).remove();
                    $('#newform').html('');
                   // location.reload(); 
                } else {
                    alert("You can not delete this account because some transation being occure related this account!")
                }             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    } else {
        return false;
    }
     
} 

    $(document).ready(function () {
       "use strict";
       $('#nameLabel').hide();
       //$('#subtype_1').attr("disabled","disabled");
       $('#subtypeContent').hide();
       $('#depreciationCode').hide();
       $('#fixedassetCode').hide();
       $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });

 
});

$(document).on('change', '#cmbDebit', function() {
        var isbank = $('#cmbDebit option:selected').data('isbank');
        if(isbank==1){
            $("#isbanknature").show();
        }else{
            $("#checkno").val('');
            $("#chequeDate").val('');
            $("#ishonours").prop('checked', false);
            $("#isbanknature").hide();
        }
    });
