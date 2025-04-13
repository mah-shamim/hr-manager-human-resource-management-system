//Edit financial year
 "use strict"; 
    function edit_sub_account(id)
    {
        var base_url = $("#base_url").val();       

        var url = ""+base_url+""+"accounts/edit_sub_account/"+id;

        $.ajax({
            url : url,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                
                $('[name="rid"]').val(data.id);               
                $('[name="account_name"]').val(data.name);
                $('[name="subtype"]').val(data.subTypeId).change();                
                $('#add').modal('show'); 
                $("#subAccountModalForm").attr("action", base_url+'accounts/accounts/update_sub_account');
                $('.modal-title').text('Edit Sub Account'); 
                $('.save_btn').text('Update');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }