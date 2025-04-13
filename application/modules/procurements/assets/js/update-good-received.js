    
    "use strict"; 

    var total_good_rcv = $('#total_good_rcv_item').val();

    var count = parseInt(total_good_rcv);
    var limits = 500;
    
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    "use strict";
    //Add purchase order input fields
    function addGoodRecvItem(e) {

        var description_material = $('#description_material').val();
        var unit_list = $('#unit_list').val();

        count++;

         var t = '<td><textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="'+description_material+'" tabindex="10" required=""></textarea>'+
        '<td><select name="unit_id[]" class="form-control" required=""><option value=""> Select Unit</option>'+unit_list+'</select> </td>'+
        '<td class=""><input type="number" id="quantity_' + count + '" onkeyup="calculate_good_receive(' + count + ');" onchange="calculate_good_receive(' + count + ');" class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/></td>'+
        '<td class=""><input type="number" id="price_per_unit_' + count + '" onkeyup="calculate_good_receive(' + count + ');" onchange="calculate_good_receive(' + count + ');" class="form-control text-right sub_total_item_price" name="price_per_unit[]" placeholder="0.00" required/></td>'+
        '<td class=""><input type="text" id="total_price_' + count + '" class="form-control text-right total_item_price" name="total[]" readonly placeholder="0.00" value="0.00" required/></td>'+
        '<td><a class="btn btn-danger btn-sm"  value="" onclick="deleteGoodRecvItemRow(this)" ><i class="fa fa-close" aria-hidden="true"></i></a></td>';
        
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#good_received_item").append("<tr>" + t + "</tr>");

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