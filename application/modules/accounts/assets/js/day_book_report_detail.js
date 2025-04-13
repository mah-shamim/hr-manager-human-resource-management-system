
    function showVaucherDetail() {

            var base_url = $("#base_url").val(); 
            var submit_url = base_url+'accounts/voucherDetails';

            $.ajax({
                type: 'POST',
                url: submit_url,
                dataType : 'JSON',
                data: {vno:vno, vtype:vtype},
                success: function(res) {
                
                  $('#all_vaucher_view').html(res.data);
                  $('#allvaucherModal').modal('show');
                }
            });   

    } 

 "use strict";
    function printAllVaucher() {
        var divName = "vaucherPrintArea";
        document.querySelectorAll(".printbtn").forEach(el => el.remove());
    var printContents = document.getElementById(divName).innerHTML;


    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
    
}

    "use strict";
function printVaucher(div) {

    var printContents = document.getElementById(div).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
    setTimeout(function() {         
        location.reload();
           }, 100);
}
 "use strict";
function removeElementsByClass(className){
    const elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}
