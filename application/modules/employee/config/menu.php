
   <?php

// module name
$HmvcMenu["employee"] = array(
    //set icon
    "icon"           => "<i class='fa fa-users'></i>", 
    
   
   "position" => array(
            "controller" => "Employees",
            "method"     => "create_position",
            "permission" => "create"
      
    ), 
    // Employee types
   
    // "employee_type" => array(
    //         "controller" => "Employee_type",
    //         "method"     => "employee_types_view",
    //         "permission" => "read"
      
    // ), 

    //group level name
    "direct_empl" => array(

        "add_employee" => array(
            //menu name
      
                "controller" => "Employees",
                "method"     => "viewEmhistory",
                "permission" => "create"
           
           
        ), 

        "manage_employee" => array(
            //menu name
      
                "controller" => "Employees",
                "method"     => "manageemployee",
                "permission" => "read"
           
           
        ), 
    
    ), 
    
   
    // "perform_sub_category" => array(
    //     //menu name
          
    //         "controller" => "Employees_performance",
    //         "method"     => "paerformance_sub_category_view",
    //         "permission" => "read"
        
    // ),

    // "category_wise_performance" => array(
    //     //menu name
          
    //         "controller" => "Employees_performance",
    //         "method"     => "category_performance_view",
    //         "permission" => "read"
        
    // ),

    // "emp_performance" => array(
    //     //menu name
          
    //         "controller" => "Employees",
    //         "method"     => "create_emp_performance",
    //         "permission" => "create"
        
    // ),   


    "emp_performance" => array(
        //menu name
          
            "controller" => "Employees_performance",
            "method"     => "emp_performance_list",
            "permission" => "read"
        
    ), 

  

);

 