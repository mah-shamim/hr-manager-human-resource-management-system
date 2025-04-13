
   <?php

// module name
$HmvcMenu["projectmanagement"] = array(
    //set icon
    "icon"           => "<i class='fa fa-tasks' aria-hidden='true'></i>", 

  "clients" => array(
        "controller" => "pm_clients",
        "method"     => "clients",
        "permission" => "read"
        
    ),

  "projects" => array(
        "controller" => "pm_projects",
        "method"     => "projects",
        "permission" => "read"
        
    ),

  "manage_tasks" => array(
        "controller" => "pm_tasks",
        "method"     => "manage_tasks",
        "permission" => "read"
        
    ),

  "pm_reports" => array(

        "project_lists" => array(
           
                "controller" => "pm_project_reports",
                "method"     => "project_lists",
                "permission" => "read"
            
        ),
        "team_member" => array(

                "controller" => "pm_project_reports", // here employee is the team_member
                "method"     => "team_member_search",
                "permission" => "read"
            
        ),  
    ),

);

 