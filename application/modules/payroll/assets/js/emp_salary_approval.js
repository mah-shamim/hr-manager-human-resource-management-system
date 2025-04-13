

    //Global departments array
    var paymment_list = [];
    
    var count = 2;
    var limits = 500;

    var tax_paymment_list = [];
    
    var tax_count = 2;
    var tax_limits = 500;

    var npf_paymment_list = [];
    
    var npf_count = 2;
    var npf_limits = 500;

    var iicf_paymment_list = [];
    
    var iicf_count = 2;
    var iicf_limits = 500;
   
    "use strict";
    //Add request input field
    function add_key_payment_item(e) {

        var payment_list = $('#payment_list').val();

        var t = '<td><select name="payment_nature[]" class="form-control payment-nature-select" required=""><option value=""> Select  Payment Nature</option>'+payment_list+'</select> </td>'+

        '<td class=""><input type="number" id="amount" class="form-control payment-amount" name="amount[]" placeholder="" required step=".01"/></td>'+

        '<td> <a  id="add_payment_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_payment_item('+"payment_request_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#payment_request_item").append("<tr>" + t + "</tr>");
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

        // Setting new all paymment_nature to global paymment_list array
        paymment_list = [];
        $("tr td .payment-nature-select").each(function() {
            var paymment_select_val = $(this).val();
            paymment_list.push(paymment_select_val)
        });

        
        //Net Renumeration is exceeding, please take valid amount as input

        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });

        //State Income Tax Amount is exceeding, please take valid amount as input
        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){

            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }
        
        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){
            
            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }
       
    }

    // Store all the selected paymment_list for ignoring dulicate selection 
    $('body').on('change', '.payment-nature-select', function() {


        var msg = 'Payment nature already selected';    

        //check if value already exists in departments array..
        var paymment_select_val = $(this).val();
        if(paymment_list.indexOf(paymment_select_val) >= 0){

            $(this).val('').trigger('change');
            alert(msg)

        }

        paymment_list = [];
        $("tr td .payment-nature-select").each(function() {
            var paymment_select_val = $(this).val();
            paymment_list.push(paymment_select_val)
        });

        //Removing empty value
        paymment_list = paymment_list.filter(item => item);


    });

    $('body').on('keyup', '.payment-amount', function() {


        var msg = 'Net Salary is exceeding, please take valid amount as input !';
        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });

        //State Income Tax Amount is exceeding, please take valid amount as input
        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){

            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }
        
        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){
            
            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }


    });

    /*state Income tax Js starts*/

    "use strict";
    //Add request input field
    function add_key_tax_payment_item(e) {

        var tax_payment_list = $('#tax_payment_list').val();

        var t = '<td><select name="tax_payment_nature[]" class="form-control tax-payment-nature-select" required=""><option value=""> Select  Payment Nature</option>'+tax_payment_list+'</select> </td>'+

        '<td class=""><input type="number" id="tax_amount" class="form-control tax-payment-amount" name="tax_amount[]" placeholder="" required step=".01"/></td>'+

        '<td> <a  id="add_tax_payment_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_tax_payment_item('+"tax_payment_request_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteTaxPayRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

        tax_count == tax_limits ? alert("You have reached the limit of adding " + tax_count + " inputs") : $("tbody#tax_payment_request_item").append("<tr>" + t + "</tr>");
        tax_count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });

    }

    "use strict";
    function deleteTaxPayRow(e) {
        var t = $("#tax_request_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        // Setting new all paymment_nature to global paymment_list array
        tax_paymment_list = [];
        $("tr td .tax-payment-nature-select").each(function() {
            var tax_paymment_select_val = $(this).val();
            tax_paymment_list.push(tax_paymment_select_val)
        });


        //Net Renumeration is exceeding, please take valid amount as input

        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });
        
        //State Income Tax Amount is exceeding, please take valid amount as input

        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){
            
            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }

        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){
            
            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }
       
    }

    // Store all the selected tax_paymment_list for ignoring dulicate selection 
    $('body').on('change', '.tax-payment-nature-select', function() {


        var msg = 'Payment nature for State Income Tax already selected';    

        //check if value already exists in departments array..
        var tax_paymment_select_val = $(this).val();
        if(tax_paymment_list.indexOf(tax_paymment_select_val) >= 0){

            $(this).val('').trigger('change');
            alert(msg)

        }

        tax_paymment_list = [];
        $("tr td .tax-payment-nature-select").each(function() {
            var tax_paymment_select_val = $(this).val();
            tax_paymment_list.push(tax_paymment_select_val)
        });

        //Removing empty value
        tax_paymment_list = tax_paymment_list.filter(item => item);

    });

    $('body').on('keyup', '.tax-payment-amount', function() {

        var msg = 'State income Tax is exceeding, please take valid amount as input !';

        //Net Renumeration is exceeding, please take valid amount as input
        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });

        //State Income Tax Amount is exceeding, please take valid amount as input

        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){
            
            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }

        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){

            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }


    });

    /*State income tax js ends*/

    /*NPF Contribution Js starts*/

    "use strict";
    //Add request input field
    function add_key_npf_payment_item(e) {

        var npf_payment_list = $('#npf_payment_list').val();

        var t = '<td><select name="npf_payment_nature[]" class="form-control npf-payment-nature-select" required=""><option value=""> Select  Payment Nature</option>'+npf_payment_list+'</select> </td>'+

        '<td class=""><input type="number" id="npf_amount" class="form-control npf-payment-amount" name="npf_amount[]" placeholder="" required step=".01"/></td>'+

        '<td> <a  id="add_npf_payment_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_npf_payment_item('+"npf_payment_request_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteNpfPayRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

        npf_count == npf_limits ? alert("You have reached the limit of adding " + npf_count + " inputs") : $("tbody#npf_payment_request_item").append("<tr>" + t + "</tr>");
        npf_count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });

    }

    "use strict";
    function deleteNpfPayRow(e) {
        var t = $("#npf_request_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        // Setting new all paymment_nature to global paymment_list array
        npf_paymment_list = [];
        $("tr td .npf-payment-nature-select").each(function() {
            var npf_paymment_select_val = $(this).val();
            npf_paymment_list.push(npf_paymment_select_val)
        });


        //NPF Contribution is exceeding, please take valid amount as input

        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });
        
        //State Income Tax Amount is exceeding, please take valid amount as input

        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){
            
            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }

        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){

            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }
       
    }

    // Store all the selected tax_paymment_list for ignoring dulicate selection 
    $('body').on('change', '.npf-payment-nature-select', function() {


        var msg = 'Payment nature for NPF Contribution already selected';    

        //check if value already exists in departments array..
        var npf_paymment_select_val = $(this).val();
        if(npf_paymment_list.indexOf(npf_paymment_select_val) >= 0){

            $(this).val('').trigger('change');
            alert(msg)

        }

        npf_paymment_list = [];
        $("tr td .npf-payment-nature-select").each(function() {
            var npf_paymment_select_val = $(this).val();
            npf_paymment_list.push(npf_paymment_select_val)
        });

        //Removing empty value
        npf_paymment_list = npf_paymment_list.filter(item => item);


    });

    $('body').on('keyup', '.npf-payment-amount', function() {

        var msg = 'NPF Contribution exceeding, please take valid amount as input !';

        //Net Renumeration is exceeding, please take valid amount as input
        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });

        //State Income Tax Amount is exceeding, please take valid amount as input

        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){
            
            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }

        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){

            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }


    });

    /*NPF Contribution js ends*/

   /*IICF Contribution Js starts*/

    "use strict";
    //Add request input field
    function add_key_iicf_payment_item(e) {

        var iicf_payment_list = $('#iicf_payment_list').val();

        var t = '<td><select name="iicf_payment_nature[]" class="form-control iicf-payment-nature-select" required=""><option value=""> Select  Payment Nature</option>'+iicf_payment_list+'</select> </td>'+

        '<td class=""><input type="number" id="iicf_amount" class="form-control iicf-payment-amount" name="iicf_amount[]" placeholder="" required step=".01"/></td>'+

        '<td> <a  id="add_iicf_payment_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_iicf_payment_item('+"iicf_payment_request_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteIicfPayRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

        iicf_count == iicf_limits ? alert("You have reached the limit of adding " + iicf_count + " inputs") : $("tbody#iicf_payment_request_item").append("<tr>" + t + "</tr>");
        iicf_count++;

        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });

    }

    "use strict";
    function deleteIicfPayRow(e) {
        var t = $("#iicf_request_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }

        // Setting new all paymment_nature to global paymment_list array
        iicf_paymment_list = [];
        $("tr td .iicf-payment-nature-select").each(function() {
            var iicf_paymment_select_val = $(this).val();
            iicf_paymment_list.push(iicf_paymment_select_val)
        });



        //NPF Contribution is exceeding, please take valid amount as input

        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });
        
        //State Income Tax Amount is exceeding, please take valid amount as input

        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){
            
            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }

        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){

            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }
       
    }

    // Store all the selected tax_paymment_list for ignoring dulicate selection 
    $('body').on('change', '.iicf-payment-nature-select', function() {


        var msg = 'Payment nature for IICF Contribution already selected';    

        //check if value already exists in departments array..
        var iicf_paymment_select_val = $(this).val();
        if(iicf_paymment_list.indexOf(iicf_paymment_select_val) >= 0){

            $(this).val('').trigger('change');
            alert(msg)

        }

        iicf_paymment_list = [];
        $("tr td .iicf-payment-nature-select").each(function() {
            var iicf_paymment_select_val = $(this).val();
            iicf_paymment_list.push(iicf_paymment_select_val)
        });

        //Removing empty value
        iicf_paymment_list = iicf_paymment_list.filter(item => item);


    });

    $('body').on('keyup', '.iicf-payment-amount', function() {

        var msg = 'IICF Contribution exceeding, please take valid amount as input !';

        //Net Renumeration is exceeding, please take valid amount as input
        var net_salary = $('#net_salary_hidden').val();
        var net_renumeration = parseFloat(net_salary);

        var total_amount = 0.0;
        $(".payment-amount").each(function() {
            total_amount = total_amount + parseFloat($(this).val());
        });

        //State Income Tax Amount is exceeding, please take valid amount as input

        var state_income_tax = 0.0;
        var tax_total_amount = 0.0;

        var income_tax = $('#state_income_tax_hidden').val();
        if(parseFloat(income_tax) > 0){
            
            state_income_tax = parseFloat(income_tax);
        
            $(".tax-payment-amount").each(function() {
                tax_total_amount = tax_total_amount + parseFloat($(this).val());
            });
        }

        //NPF Contribution Amount is exceeding, please take valid amount as input

        var total_npf_contribution = 0.0;
        var total_npf_amount       = 0.0;

        var npf_contribution = $('#total_npf_contribution_hidden').val();
        if(parseFloat(npf_contribution) > 0){
            
            total_npf_contribution = parseFloat(npf_contribution);
        
            $(".npf-payment-amount").each(function() {
                total_npf_amount = total_npf_amount + parseFloat($(this).val());
            });
        }

        //IICF Contribution Amount is exceeding, please take valid amount as input

        var icf_amount       = 0.0;
        var total_icf_amount = 0.0;

        var icf_contribution = $('#icf_amount_hidden').val();
        if(parseFloat(icf_contribution) > 0){
            
            icf_amount = parseFloat(icf_contribution);
        
            $(".iicf-payment-amount").each(function() {
                total_icf_amount = total_icf_amount + parseFloat($(this).val());
            });
        }

        if(net_renumeration == total_amount && state_income_tax == tax_total_amount && total_npf_contribution == total_npf_amount && icf_amount == total_icf_amount){

            $(':input[type="submit"]').prop('disabled', false);
        }else{
            $(':input[type="submit"]').prop('disabled', true);
        }


    });

    /*IICF Contribution js ends*/

    $(document).ready(function() { 

        "use strict";

        $(':input[type="submit"]').prop('disabled', true);

        var flag = 0;
        $('#payment_area').hide();
        // Check interpersonal_score can not be more than 10
        $('#post_button').on('click', function(){

            flag = flag + 1;

            if(flag%2 == 1){
                $('#payment_area').show();
            }else{
                $('#payment_area').hide();
            }
        });

    });