/* Generel Ledger part*/
$(document).ready(function(){
     "use strict"; 
    $('#employee_id').on('change',function(){
      var base_url = $("#base_url").val();
       var employee_id=$(this).val();
        var csrf_test_name = $("#csrftoken").val();
              
        $.ajax({
             url: base_url + 'projectmanagement/pm_project_reports/get_employee_projects',
            type: 'POST',
            data: {
                employee_id: employee_id,
                csrf_test_name:csrf_test_name
            },
            success: function(data) {

               $("#project_id").html(data);
            }
        });

    });
});