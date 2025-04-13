//all js 

"use strict";
function change_employee_status(employee_id){

	var base_url = $("#base_url").val();
    var req_url = base_url+"employee/employees/change_employee_status?employee_id="+employee_id;

    $.ajax({
        type: "GET",
        url: req_url,
        cache: false,
        success: function(data)
        {
            var obj = jQuery.parseJSON(data);
        } 
    });

}