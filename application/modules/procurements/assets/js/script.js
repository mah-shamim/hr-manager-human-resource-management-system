
"use strict"

function quote_item(){

	var bid_quote = $('#bid_quote option:selected').val();

	var base_url = $("#base_url").val();
    var csrf_test_name = $('#csrftoken').val();

	$.ajax({
        type: "post",
        url: base_url + "procurements/Procurement_bid_analysis/get_quotation_items",
        data: {
            quote_id: bid_quote,
            csrf_test_name:csrf_test_name,
        },
        success: function(html)
        {
            if(bid_quote !=''){
              $('#bid_analysis_table').html(html);
            }else{
              alert('Please Select Quotation');
            }

            $("select.form-control:not(.dont-select-me)").select2({
	            placeholder: "Select option",
	            allowClear: true
	        });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


"use strict"

function purchase_quote_item(){

    var purchase_quote = $('#purchase_quote option:selected').val();
    var base_url = $("#base_url").val();
    var csrf_test_name = $('#csrftoken').val();

    $.ajax({
        type: "post",
        url: base_url + "procurements/Procurement_purchase_order/get_quotation_items",
        data: {
            quote_id: purchase_quote,
            csrf_test_name:csrf_test_name,
        },
        success: function(html)
        {
            if(purchase_quote !=''){
              $('#purchase_order_table').html(html);
            }else{
              alert('Please Select Quotation');
            }

            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    /*Getting Quotation info to fill vendor_name inside purchase order*/

    var url = base_url + "procurements/Procurement_purchase_order/get_quotation_info";

    var data = getQuotationData(purchase_quote,csrf_test_name,url);
    var jsondata = JSON.parse(data);

    if(jsondata){
        $('#vendor_name').val(jsondata.name_of_company);
    }
    
}

/*Getting Quotation info*/


"use strict"

function getQuotationData(id,csrf_test_name,url) {

    var result="";
    
    $.ajax({
        type: "post",
        url: url,
        data: {
            quote_id: id,
            csrf_test_name:csrf_test_name,
        },
        async: false,  

        success:function(data) {
         result = data; 
        }
   });
   return result;
}


"use strict"

function good_receive_purchase_item(){

    var purchase_order = $('#purchase_order option:selected').val();
    var base_url = $("#base_url").val();
    var csrf_test_name = $('#csrftoken').val();

    $.ajax({
        type: "post",
        url: base_url + "procurements/Procurement_good_received/get_purchase_items",
        data: {
            purchase_order_id: purchase_order,
            csrf_test_name:csrf_test_name,
        },
        success: function(html)
        {
            if(purchase_order !=''){
              $('#good_received_table').html(html);
            }else{
              alert('Please Select Quotation');
            }

            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    /*Getting Purchase info to fill vendor_name and vendor_id inside good received*/

    var url = base_url + "procurements/Procurement_good_received/get_purchase_info";

    var data = getPurchaseData(purchase_order,csrf_test_name,url);
    var jsondata = JSON.parse(data);

    if(jsondata){
        $('#vendor_name').val(jsondata.name_of_company);
        $('#vendor_id').val(jsondata.vendor_id);
    }
    
}

"use strict"

function getPurchaseData(id,csrf_test_name,url) {

    var result="";
    
    $.ajax({
        type: "post",
        url: url,
        data: {
            purchase_order_id: id,
            csrf_test_name:csrf_test_name,
        },
        async: false,  

        success:function(data) {
         result = data; 
        }
   });
   return result;
}


"use strict"; 
function goodrecvpaymentypeselectExpns() {
    
    var  hdcode     = $('#paytype').val();
    var base_url = $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var paymentcode = '#headcode';

    $.ajax({
        type: "POST",
        url: base_url+"procurements/Procurement_good_received/retrieve_paytypedata",
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