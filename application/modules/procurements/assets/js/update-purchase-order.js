    
    "use strict"; 

    var total_purchase = $('#total_purchase_item').val();

    var count = parseInt(total_purchase);
    var limits = 500;
    
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