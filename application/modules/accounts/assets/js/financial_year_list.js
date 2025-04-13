"use strict"; 
function edit_financial_year(id)
{

    var base_url = $("#base_url").val();       

    var url = ""+base_url+""+"accounts/edit_financial_year/"+id;

    $.ajax({
        url : url,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="rid"]').val(data.id);               
            $('[name="financial_year"]').val(data.yearName);
            $('[name="financial_year_start_date"]').val(data.startDate);
            $('[name="financial_year_end_date"]').val(data.endDate);  
            $('#add').modal('show'); 
            $("#fyearModalForm").attr("action", base_url+'accounts/accounts/update_financial_year');
            $('.modal-title').text('Edit Financial Year'); 
            $('.save_btn').text('Update');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
"use strict"; 
function confirmSubmit() {
   var conf = confm('Are you sure you want to close this financial year?')
   if(conf) {
    return true;
   } else {
    return false;
   }
}
    

