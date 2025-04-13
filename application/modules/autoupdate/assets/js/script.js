"use strict"; 

function checkserver(){
         var base_url = $("#base_url").val();
        var datavalue = 'check=0';
        $.ajax({
                type: "POST",
                url: base_url + "check_server",
                data: datavalue,
                success: function(data){
                    if(data==0){
                    alert("Your php allow_url_fopen is currently Disable.Check Your server php allow_url_fopen is enable,memory Limit More than 100M and max execution time is 300 or more"); 
                    }
                    else{
                        $("#checkserver").hide();
                        $("#serverok").show();
                        }
                }
            });
     }