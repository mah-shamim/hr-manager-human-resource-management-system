 $(document).ready(function () {

        "use strict"; // Start of use strict

        
        function getJsonData(req_url){

              var base_url = $("#base_url").val();

	          var php_data;
	          $.ajax({
	            type:"GET",
	            url: base_url+req_url,
	            async: false,
	            dataType: "json",
	            success: function (respo) {

	              php_data = respo;
	            }
	          });

	          return php_data;
	    }

	    /*Get remaining vs completed data for a particular project*/
	    var respo_remaining_completed = getJsonData("projectmanagement/pm_project_reports/project_remaining_completed");

        //doughut chart
        var ctx = document.getElementById("doughnutChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                        data: respo_remaining_completed,
                        backgroundColor: [
                            "rgba(55, 160, 0, 0.9)",
                            "#e82915",
                        ],
                        hoverBackgroundColor: [
                            "rgba(55, 160, 0, 0.9)",
                            "#e82915",
                        ]

                    }],
                labels: [
                    "Completed",
                    "Unfinished",
                ]
            },
            options: {
                responsive: true
            }
        });


        /*Get team_members/employees status based tasks for a particular project*/
        var project_all_employees_name = getJsonData("projectmanagement/pm_project_reports/project_all_employees_name");
        var task_to_do_by_employee = getJsonData("projectmanagement/pm_project_reports/task_to_do_by_employee");
        var task_in_progress_by_employee = getJsonData("projectmanagement/pm_project_reports/task_in_progress_by_employee");
        var task_done_by_employee = getJsonData("projectmanagement/pm_project_reports/task_done_by_employee");

        //bar chart
        var ctx = document.getElementById("barChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: project_all_employees_name,
                datasets: [
                    {
                        label: "To Do",
                        data: task_to_do_by_employee,
                        borderColor: "#e82915",
                        borderWidth: "0",
                        backgroundColor: "#e82915"
                    },
                    {
                        label: "In Progress",
                        data: task_in_progress_by_employee,
                        borderColor: "#0000FF",
                        borderWidth: "0",
                        backgroundColor: "#0000FF"
                    },
                    {
                        label: "Done",
                        data: task_done_by_employee,
                        borderColor: "rgba(55,160,0,0.9)",
                        borderWidth: "0",
                        backgroundColor: "rgba(55,160,0,0.9)"
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                }
            }
        });

        /*Get To Do , In Progress and Done status data for a particular project*/
	    var project_various_status_tasks = getJsonData("projectmanagement/pm_project_reports/project_various_status_tasks");

        //pie chart
        var ctx = document.getElementById("pieChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                        data: project_various_status_tasks,
                        backgroundColor: [
                            "#e82915",
                            "#0000FF",
                            "rgba(55,160,0,0.9)"
                        ],
                        hoverBackgroundColor: [
                            "#e82915",
                            "#0000FF",
                            "rgba(55,160,0,0.9)"
                        ]

                    }],
                labels: [
                    "To Do",
                    "In Progress",
                    "Done"
                ]
            },
            options: {
                responsive: true
            }
        });

    });