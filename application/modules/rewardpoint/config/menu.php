
   <?php

// module name
$HmvcMenu["rewardpoint"] = array(
    //set icon
    "icon"           => "<i class='fa fa-star-o'></i>", 
    
   
 "point_settings" => array(
            "controller" => "Rewardpoints",
            "method"     => "point_settings",
            "permission" => "read"
    ),

  "point_categories" => array(
            "controller" => "Rewardpoints",
            "method"     => "point_categories",
            "permission" => "read"
        
    ),     
  "management_point" => array(
            "controller" => "Rewardpoints",
            "method"     => "management_point",
            "permission" => "read"
        
    ), 
  "collaborative_point" => array(
            "controller" => "Rewardpoints",
            "method"     => "collaborative_point",
            "permission" => "read"
        
    ),
  "attendence_point" => array(
            "controller" => "Rewardpoints",
            "method"     => "attendence_point",
            "permission" => "read"
        
    ),
   "employee_point" => array(
            "controller" => "Rewardpoints",
            "method"     => "employee_point",
            "permission" => "read"
        
    ), 
  

);

 