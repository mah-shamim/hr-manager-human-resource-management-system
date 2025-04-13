	"use strict";
function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
}

"use strict";
// get all transation by ajax and modal for trail balance head 
function showTranDetail(coaid,sdate,edate) {   

            var base_url = $("#base_url").val(); 
            var submit_url = base_url+'accounts/trail_balance_detail';

            $.ajax({
                type: 'POST',
                url: submit_url,
                dataType : 'JSON',
                data: {coaid:coaid, sdate:sdate,edate:edate},
                success: function(res) {
                  $('#all_transation_view').html(res.data);
                  $('#allTransationModal').modal('show');
                }
            });   
        
    }

