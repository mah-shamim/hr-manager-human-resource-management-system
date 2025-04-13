"use strict"; 
function backlog(project_id) {

	var base_url = $("#base_url").val();

    $.ajax({
        type: "POST",
        url: base_url+"projectmanagement/pm_projects/get_backlogs?project_id="+project_id,
        cache: false,
        success: function(data)
        {
        	var obj = jQuery.parseJSON(data);

            if(obj.project_id){
            	window.location.href=base_url+'projectmanagement/pm_projects/backlogs';
            }
        } 
    });

}

"use strict"; 
function sprint(project_id) {

    var base_url = $("#base_url").val();

    $.ajax({
        type: "POST",
        url: base_url+"projectmanagement/pm_projects/get_sprints?project_id="+project_id,
        cache: false,
        success: function(data)
        {
            var obj = jQuery.parseJSON(data);

            if(obj.sprint_project_id){
                window.location.href=base_url+'projectmanagement/pm_projects/sprints';
            }
        } 
    });

}

"use strict";
function change_sprint_status(sprint_status,sprint_id){

    var sprint_status = sprint_status.value;

    var base_url = $("#base_url").val();
    var csrf_test_name = $('#csrftoken').val();

    $.ajax({
        type: "post",
        url: base_url+"projectmanagement/pm_projects/get_sprint_undone_tasks",
        data: {
            sprint_id: sprint_id,
            csrf_test_name:csrf_test_name,
        },
        success: function(response)
        {
            var data = JSON.parse(response);

            alert("You have "+ data.to_do_tasks +" To Do , "+ data.in_progress_tasks +" In Progress and "+ data.done_tasks +" Done tasks"+
                " for this sprint, do you want to close the sprint?");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

/*Kanban Board js starts for both Project Manager(Supervisor) and Team Lead(Employee)*/

$(function() {

    "use strict";

    var base_url = $("#base_url").val();
    var url = base_url+"projectmanagement/pm_tasks/kanban_task_update";

    $('ul[id^="sort"]').sortable(
        {
            connectWith : ".sortable",
            receive : function(e, ui) {

                var status_id = $(ui.item).parent(".sortable").data("status-id");
                var task_id = $(ui.item).data("task-id");

                $.ajax({
                    url : url + '?task_status=' + status_id + '&task_id='
                            + task_id,
                    success : function(response) {

                    }
                });
            }

        }).disableSelection();


        $("#clientFrm").submit(function (e) {

            e.preventDefault();

            var clientMsg = $("#clientMsg");
            var client_id_no = $("#client_id_no");
            var clientHelpText = $("#clientHelpText");
            var client = $("#client");
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function () {
                    clientMsg.removeClass('hide');
                    client_id_no.val('');
                    clientHelpText.html('');
                },
                success: function (data) {
                    if (data.status == true) {
                        clientMsg.addClass('alert-success').removeClass('alert-danger').html(data.message);
                        client_id_no.val(data.client_id_no);
                        client.val(data.client).trigger('change');
                        $('#myModal').modal('hide');
                    } else {
                        clientMsg.addClass('alert-danger').removeClass('alert-success').html(data.exception);
                    }
                },
                error: function (xhr) {
                    alert('failed!');
                }

            });

        });

    
        $("#client").bind('change paste', function (e) {

            var clientHelpText = $("#clientHelpText");
            var csrf_token_name = $("#csrf_token_name").val();
            var csrf_hash = $("#csrf_hash").val();

            $.ajax({
                url: base_url+'projectmanagement/pm_projects/get_client_info',
                method: 'post',
                dataType: 'json',
                data: {
                    csrf_token_name: csrf_hash,
                    'client': $(this).val(),
                },
                success: function (data) {

                    clientHelpText.empty().html(data.client);
                    $("#client_id_no").val(data.client_id);
                },
                error: function (e) {
                    alert('failed!');
                }
            });
        });

});

/*Kanban Board js ends*/