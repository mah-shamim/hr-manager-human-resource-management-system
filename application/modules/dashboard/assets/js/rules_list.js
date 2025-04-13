$(document).ready(function() { 
    "use strict";

    $('#basic_amount').hide();
    $('#percent').hide();
    $('#allowance_amount').hide();
    $('#start_time').hide();
    $('#end_time').hide();

    // check any employee already assigned as department head
    $('#type').on('change', function(e){
        e.preventDefault();

        var type_val = $(this).val();

        if(type_val === 'time'){

            $('#start_time').show();
            $('#end_time').show();

            $('#basic_amount').hide();
            $('#percent').hide();
            $('#allowance_amount').hide();

            $('#basic_a').val("");
            $('#prcnt').val("");
            $('#allowance_a').val("");
        }
        if(type_val === 'basic'){

            $('#basic_amount').show();

            $('#percent').hide();
            $('#allowance_amount').hide();
            $('#start_time').hide();
            $('#end_time').hide();

            $('#prcnt').val("");
            $('#allowance_a').val("");
            $('#start_t').val("");
            $('#end_t').val("");

        }
        if(type_val === 'allowance'){

            $('#allowance_amount').show();

            $('#percent').hide();
            $('#basic_amount').hide();
            $('#start_time').hide();
            $('#end_time').hide();

            $('#prcnt').val("");
            $('#basic_a').val("");
            $('#start_t').val("");
            $('#end_t').val("");

        }
        if(type_val === 'tax'){

            $('#percent').show();

            $('#allowance_amount').hide();
            $('#basic_amount').hide();
            $('#start_time').hide();
            $('#end_time').hide();

            $('#allowance_a').val("");
            $('#basic_a').val("");
            $('#start_t').val("");
            $('#end_t').val("");
        }
        
    });

});
