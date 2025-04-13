    "use strict"; 

    function add_role()
    {
        var base_url = $('#base_url').val();

        $('#MyForm')[0].reset();
        $("#MyForm").attr("action", base_url+'dashboard/role/create');
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add Role'); 
        $('.save_btn').text('Add'); 
    }


    "use strict"; 

    function edit(id)
    {
        var base_url = $('#base_url').val();
        var url = ""+base_url+""+"dashboard/role/edit_role/"+id;
	    
	    $.ajax({
	        url : url,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	            $('[name="role_id"]').val(data.role_id);
	            $('[name="role_name"]').val(data.role_name);
	            $('[name="role_description"]').val(data.role_description);
	            $('#modal_form').modal('show'); 
	            $("#MyForm").attr("action", base_url+'dashboard/role/update_role');
	            $('.modal-title').text('Edit Role'); 
	            $('.save_btn').text('Update');

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
    }

//============================================================
"use strict"; 

function save()
{
    $('.save_btn').text('saving...'); 
    $('.save_btn').attr('disabled',true); 
    
    var url = $("#MyForm").attr('action');

    $.ajax({
        url : url,
        type: "POST",
        data: $('#MyForm').serialize(),
        success: function(data)
        {
            if(data)
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            $('.save_btn').text('save'); 
            $('.save_btn').attr('disabled',false); 
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('.save_btn').text('save'); 
            $('.save_btn').attr('disabled',false); 
        }
    });
}  

"use strict"; 

function reload_table(){

	$("#RoleTbl").load(location.href+" #RoleTbl>*","");
} 
