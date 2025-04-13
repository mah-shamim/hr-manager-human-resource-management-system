  var count = 2;
    var limits = 500;
   
    "use strict";
    //Add request input field
    function addpruduct(e) {
        var description_material_input = $('#description_material').val();
        var unit_list = $('#unit_list').val();

        var t = '<td><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'+description_material_input+'" tabindex="10" required=""></textarea></td>'+
        '<td><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'+unit_list+'</select> </td>'+
        '<td class=""><input type="number"  class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>'+
        '<td> <a  id="add_purchase_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addpruduct('+"request_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#request_item").append("<tr>" + t + "</tr>");
        count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }

    "use strict";
    function deleteRow(e) {
        var t = $("#request_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
       
    }





    "use strict";

    var total_quote_items = $('#total_quote_items').val();

    var count_quote_item = parseInt(total_quote_items); // count_quote_item will work like count

    //Add Quote input field
    function addQuoteItem(e) {

        count_quote_item++;

        var description_material_placeholder = $('#description_material_placeholder').val();
        var unit_list = $('#unit_list').val();
        var tr = '<td><textarea class="form-control" name="description_material[]" id="description_material" rows="2" placeholder="'+description_material_placeholder+'" tabindex="10" required=""></textarea></td>'+
        '<td><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'+unit_list+'</select> </td>'+
        '<td class=""><input type="number" onkeyup="calculate_quote(' + count_quote_item + ');" onchange="calculate_quote(' + count_quote_item + ');" id="quantity_' + count_quote_item + '" class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>'+
        '<td class=""><input type="number" id="price_per_unit_' + count_quote_item + '" onkeyup="calculate_quote(' + count_quote_item + ');" onchange="calculate_quote(' + count_quote_item + ');" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" required/></td>'+
        '<td class=""><input type="text" id="total_price_' + count_quote_item + '" class="form-control text-right total_item_price" name="total[]" readonly placeholder="0.00" value="0.00" required/></td>'+
        '<td> <a  id="add_purchase_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addQuoteItem('+"quote_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteQuoteRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
        count_quote_item == limits ? alert("You have reached the limit of adding " + count_quote_item + " inputs") : $("tbody#quote_item").append("<tr>" + tr + "</tr>");
        

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }


    "use strict";

    function deleteQuoteRow(e) {
        var t = $("#quotation_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        calculate_quote_sum()
       
    }

    "use strict";
    function calculate_quote(sl) {
       
        var gr_tot = 0;

        var item_qty    = $("#quantity_"+sl).val();
        var price_unit = $("#price_per_unit_"+sl).val();

        var total_price     = item_qty * price_unit;
        $("#total_price_"+sl).val(total_price.toFixed(2));

       
        //Total Item Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#Total").val(gr_tot.toFixed(2,2));
    }

    //Calculate summation
    "use strict";
    function calculate_quote_sum() {

        var total = 0;

        //Total Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (total += parseFloat(this.value))
        });

        $("#Total").val(total.toFixed(2,2));
    }







    "use strict";

    //Add bid input field
    function addBidItem(e) {
        var description_material = $('#description_material').val();
        var unit_list = $('#unit_list').val();
        var company = $('#company').val();
        var reason_of_choosing = $('#reason_of_choosing').val();
        var remarks = $('#remarks').val();
        var vendor_company_name = $('#vendor_company_name').val();

        var total_bid_items = $('#total_bid_item').val();
        var count_bid_item = parseInt(total_bid_items); // count_bid_item will work like count

        count_bid_item++;

        $('#total_bid_item').val(count_bid_item);

        var t = '<td class=""><input type="text" class="form-control" name="company[]" placeholder="'+company+'" value="'+vendor_company_name+'" readonly/></td>'+
        '<td><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'+description_material+'" tabindex="10" required=""></textarea>'+
        '<td class=""><input type="text" class="form-control" name="reason_of_choosing[]" placeholder="'+reason_of_choosing+'" required/></td>'+
        '<td class=""><input type="text" class="form-control" name="remarks[]" placeholder="'+remarks+'" required/></td>'+
        '<td><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'+unit_list+'</select> </td>'+
        '<td class=""><input type="number" onkeyup="calculate_bid(' + count_bid_item + ');" onchange="calculate_bid(' + count_bid_item + ');" id="quantity_' + count_bid_item + '" class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>'+
        '<td class=""><input type="number" id="price_per_unit_' + count_bid_item + '" onkeyup="calculate_bid(' + count_bid_item + ');" onchange="calculate_bid(' + count_bid_item + ');" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" required/></td>'+
        '<td class=""><input type="text" id="total_price_' + count_bid_item + '" class="form-control text-right total_item_price" name="total[]" readonly placeholder="0.00" value="0.00" required/></td>'+
        '<td> <a  id="add_bid_item" class="btn btn-info btn-sm" name="add-bid-item" onclick="addBidItem('+"bid_analysis_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteBidItemRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
        
        count_bid_item == limits ? alert("You have reached the limit of adding " + count_bid_item + " inputs") : $("tbody#bid_analysis_item").append("<tr>" + t + "</tr>");

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }

    "use strict";
    function deleteBidItemRow(e) {
        var t = $("#bid_analysis_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        calculate_bid_sum()
       
    }

    "use strict";
    function calculate_bid(sl) {
       
        var gr_tot = 0;

        var item_qty    = $("#quantity_"+sl).val();
        var price_unit = $("#price_per_unit_"+sl).val();

        var total_price     = item_qty * price_unit;
        $("#total_price_"+sl).val(total_price.toFixed(2));

       
        //Total Item Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#Total").val(gr_tot.toFixed(2,2));
    }

    //Calculate summation
    "use strict";
    function calculate_bid_sum() {

        var total = 0;

        //Total Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (total += parseFloat(this.value))
        });

        $("#Total").val(total.toFixed(2,2));
    }

   "use strict"; 
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };







    "use strict";
    //Add purchase order input fields
    function addPurchaseOrderItem(e) {

        var description_material = $('#description_material').val();
        var unit_list = $('#unit_list').val();
        var company = $('#company').val();

        var vendor_company_name = $('#vendor_company_name').val();

        var total_purchase_items = $('#total_purchase_item').val();
        var count_purchase_item = parseInt(total_purchase_items); // count_bid_item will work like count

        count_purchase_item++;

        $('#total_purchase_item').val(count_purchase_item);

        var t = '<td class=""><input type="text" class="form-control" name="company[]" placeholder="'+company+'" value="'+vendor_company_name+'" readonly/></td>'+
        '<td><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'+description_material+'" tabindex="10" required=""></textarea>'+
        '<td><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'+unit_list+'</select> </td>'+
        '<td class=""><input type="number" id="quantity_' + count_purchase_item + '" onkeyup="calculate_purchase(' + count_purchase_item + ');" onchange="calculate_purchase(' + count_purchase_item + ');" class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>'+
        '<td class=""><input type="number" id="price_per_unit_' + count_purchase_item + '" onkeyup="calculate_purchase(' + count_purchase_item + ');" onchange="calculate_purchase(' + count_purchase_item + ');" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" required/></td>'+
        '<td class=""><input type="text" id="total_price_' + count_purchase_item + '" class="form-control text-right total_item_price" name="total[]" readonly placeholder="0.00" value="0.00" required/></td>'+
        '<td><a class="btn btn-danger btn-sm"  value="" onclick="deletePurchaseOrderItemRow(this)" ><i class="fa fa-close" aria-hidden="true"></i></a></td>';
        
        count_purchase_item == limits ? alert("You have reached the limit of adding " + count_purchase_item + " inputs") : $("tbody#purchase_order_item").append("<tr>" + t + "</tr>");

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }

    "use strict";
    function deletePurchaseOrderItemRow(e) {
        var t = $("#purchase_order_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        calculateSum()
       
    }

    //Calculate purchase items
    "use strict";
    function calculate_purchase(sl) {
       
        var gr_tot = 0;
        var dis = 0;

        var item_qty    = $("#quantity_"+sl).val();
        var price_unit = $("#price_per_unit_"+sl).val();

        var total_price     = item_qty * price_unit;
        $("#total_price_"+sl).val(total_price.toFixed(2));

        $(".discount").each(function() {
            isNaN(this.value) || 0 == this.value.length || (dis += parseFloat(this.value))
        });
       
        //Total Item Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#Total").val(gr_tot.toFixed(2,2));

        var grandtotal = gr_tot - dis;
        $("#grandTotal").val(grandtotal.toFixed(2,2));
    }

    //Calculate summation
    "use strict";
    function calculateSum() {

        var total = 0;
        var dis = 0;

         $(".discount").each(function() {
            isNaN(this.value) || 0 == this.value.length || (dis += parseFloat(this.value))
        });

        //Total Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (total += parseFloat(this.value))
        });

        $("#Total").val(total.toFixed(2,2));

        var grandtotal = total - dis;
        $("#grandTotal").val(grandtotal.toFixed(2,2));
    }








    ///////// Good Received Starts //////////////////

    "use strict";
    //Add purchase order input fields
    function addGoodRecvItem(e) {

        var description_material = $('#description_material').val();
        var unit_list = $('#unit_list').val();

        var company = $('#company').val();

        var vendor_company_name = $('#vendor_company_name').val();

        var total_good_rcv_items = $('#total_good_rcv_items').val();
        var count_good_rcv_item = parseInt(total_good_rcv_items); // count_bid_item will work like count

        count_good_rcv_item++;

        $('#total_good_rcv_items').val(count_good_rcv_item);

        var t = '<td><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'+description_material+'" tabindex="10" required=""></textarea>'+
        '<td><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'+unit_list+'</select> </td>'+
        '<td class=""><input type="number" id="quantity_' + count_good_rcv_item + '" onkeyup="calculate_good_receive(' + count_good_rcv_item + ');" onchange="calculate_good_receive(' + count_good_rcv_item + ');" class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>'+
        '<td class=""><input type="number" id="price_per_unit_' + count_good_rcv_item + '" onkeyup="calculate_good_receive(' + count_good_rcv_item + ');" onchange="calculate_good_receive(' + count_good_rcv_item + ');" class="form-control text-right sub_total_item_price" name="price_per_unit[]" placeholder="0.00" required/></td>'+
        '<td class=""><input type="text" id="total_price_' + count_good_rcv_item + '" class="form-control text-right total_item_price" name="total[]" readonly placeholder="0.00" value="0.00" required/></td>'+
        '<td><a class="btn btn-danger btn-sm"  value="" onclick="deleteGoodRecvItemRow(this)" ><i class="fa fa-close" aria-hidden="true"></i></a></td>';
        
        count_good_rcv_item == limits ? alert("You have reached the limit of adding " + count_good_rcv_item + " inputs") : $("tbody#good_received_item").append("<tr>" + t + "</tr>");

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
    }

    "use strict";
    function deleteGoodRecvItemRow(e) {
        var t = $("#good_received_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        calculateGoodRecvSum()
       
    }

    //Calculate Good Received items
    "use strict";
    function calculate_good_receive(sl) {
       
        var gr_tot = 0;
        var dis = 0;

        var item_qty    = $("#quantity_"+sl).val();
        var price_unit = $("#price_per_unit_"+sl).val();

        var total_price     = item_qty * price_unit;
        $("#total_price_"+sl).val(total_price.toFixed(2));

         $(".discount").each(function() {
            isNaN(this.value) || 0 == this.value.length || (dis += parseFloat(this.value))
        });

        //Grand Total Item Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

  
        $("#Total").val(gr_tot.toFixed(2,2));

        var grandtotal = gr_tot - dis;
        $("#grandTotal").val(grandtotal.toFixed(2,2));
    }

    //Calculate summation
    "use strict";
    function calculateGoodRecvSum() {

        var total = 0;
        var dis = 0;

         $(".discount").each(function() {
            isNaN(this.value) || 0 == this.value.length || (dis += parseFloat(this.value))
        });

        //Grand Total Item Price
        $(".total_item_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (total += parseFloat(this.value))
        });

        $("#Total").val(total.toFixed(2,2));

        var grandtotal = total - dis;
        $("#grandTotal").val(grandtotal.toFixed(2,2));
    }




    /*Committee list starts*/

    "use strict";
    //Add committeelist input field
    function addcommittee(e) {

        var base_url = $("#base_url").val();

        var date_lang = $('#date_lang').val();
        var committee_list = $('#committee_list').val();

        var total_committee_list = $('#total_committee_list').val();
        var count_committee_list = parseInt(total_committee_list); // count_bid_item will work like count

        count_committee_list++;

        $('#total_committee_list').val(count_committee_list);

        var t ='<td><select name="committee_id[]" class="form-control" required="" onchange="loadCommitteImage(this,'+count_committee_list+')"><option value=""> Select Committee</option>'+committee_list+'</select> </td>'+
        '<td class=""><input type="hidden" name="sign_image[]" id="sign_image_'+count_committee_list+'" value="">'+
        '<img src="'+base_url+'/application/modules/procurements/assets/signature/sma.jpg" alt="logo" id="output_'+count_committee_list+'"></td>'+
        '<td class=""><input type="text" id="date" tabindex="3" class="form-control datepicker_committee" name="dates[]" placeholder="'+date_lang+'" required autocomplete="off"/></td>'+
        '<td class=""><a  id="add_committee_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addcommittee('+"committee_item"+')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a> '+
            '<a class="btn btn-danger btn-sm" onclick="deleteCommitteeRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
        
        count_committee_list == limits ? alert("You have reached the limit of adding " + count_committee_list + " inputs") : $("tbody#committee_item").append("<tr>" + t + "</tr>");
    
        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });

        $(".datepicker_committee").datetimepicker({
            timepicker: false,
            format: 'Y-m-d'
        });

    }

    "use strict";
    function deleteCommitteeRow(e) {
        var t = $("#committee_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
       
    }


    "use strict"; 

    var loadCommitteImage = function(committee,sl) {

        var base_url = $("#base_url").val();

        commitee_id = committee.value;

        var csrf_test_name = $('#comte_csrftoken').val();

        $.ajax({
            type: "post",
            url: base_url + "procurements/Procurement_bid_analysis/get_commitee_details",
            data: {
                commitee_id: commitee_id,
                csrf_test_name:csrf_test_name,
            },
            success: function(data)
            {
                var json = JSON.parse(data);

                if(commitee_id !=''){

                    var output = document.getElementById('output_'+sl);

                    output.src = base_url+json.sign_image;
                    
                    $('#sign_image_'+sl).val(json.sign_image);

                }else{

                  alert('Please Select Committee');
                  
                }
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    };