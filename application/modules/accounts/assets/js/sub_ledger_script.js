/*subcode balance part*/
 "use strict"; 
 function showTransationSubhead(id){  

 $('#subcode').html('');   
    var base_url = $("#base_url").val(); 
    var id = $("#subtype").val(); 
    var url = base_url + "accounts/accounts/getSubcode/" + id;      
    $.ajax({
        url : url,
        type: "GET",
        dataType: "json",
        success: function(data)
        {          
          if(data != '') {                      
            $('#subcode').html(data);            
          }            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data for inner');
        }
    });
}

/*get account subhead*/
 "use strict"; 
 function showAccountSubhead(id){  
  $('#accounthead').html('');
    var base_url = $("#base_url").val(); 
    var url = base_url + "accounts/accounts/getAccountHead/" + id;      
    $.ajax({
        url : url,
        type: "GET",
        dataType: "json",
        success: function(data)
        {          
          if(data != '') {    
                    
            $('#accounthead').html(data); 
            showTransationSubhead(id);           
          }            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
"use strict";
function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
}