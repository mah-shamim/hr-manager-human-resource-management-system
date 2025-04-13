<?php

// module name
$HmvcMenu["reports"] = array(
    //set icon
    "icon"           => "<i class='fa fa-pie-chart' aria-hidden='true'></i>

", 
    

//     // Attendance reports
"attendance_report" => array(
      "daily_presents" => array(
            "controller" => "attendance_report",
            "method"     => "daily_presents",
            "permission" => "read"
        
    ),
       "monthly_presents" => array(
            "controller" => "attendance_report",
            "method"     => "monthly_presents",
            "permission" => "read"
        
    ),
     "daily_absent" => array(
            "controller" => "attendance_report",
            "method"     => "daily_absent",
            "permission" => "read"
        
    ),
     "monthly_absent" => array(
            "controller" => "attendance_report",
            "method"     => "monthly_absent",
            "permission" => "read"
        
    ),  
),


"leave_report" => array(
      "employee_on_leave" => array(
            "controller" => "leave_report",
            "method"     => "employee_on_leave",
            "permission" => "read"
        
    ),
    
 
),
 //group level name
    "employee_reports" => array(
        //menu name
       "demographic_report" => array(
        //menu name
       
            "controller" => "employee_controller",
            "method"     => "demographic_list",
            "permission" => "read"
        
    ), 
      "posting_report" => array(
        //menu name
       
            "controller" => "employee_controller",
            "method"     => "positional_list",
            "permission" => "read"
        
    ),  
    // "asset" => array(
    //     //menu name
       
    //         "controller" => "employee_controller",
    //         "method"     => "employee_assets",
    //         "permission" => "read"
        
    // ),
    // "benifit_report" => array(
    //     //menu name
       
    //         "controller" => "employee_controller",
    //         "method"     => "benifit_list",
    //         "permission" => "read"
        
    // ),  
    // "custom_report" => array(
    //     //menu name
       
    //         "controller" => "employee_controller",
    //         "method"     => "custom_report",
    //         "permission" => "read"
        
    // ),            
    ), 

    //group level name
    "payroll" => array(
        //menu name

        "npf3_soc_sec_tax_report" => array(
        //menu name
       
            "controller" => "Payroll_report",
            "method"     => "npf3_soc_sec_tax_report",
            "permission" => "read"
        
        ),
        "iicf3_contribution_report" => array(
        //menu name
       
            "controller" => "Payroll_report",
            "method"     => "iicf3_contribution",
            "permission" => "read"
        
        ),
        "social_security_npf_icf" => array(
        //menu name
       
            "controller" => "Payroll_report",
            "method"     => "social_security_npf_icf",
            "permission" => "read"
        
        ),
        "gra_ret_5" => array(
        //menu name
       
            "controller" => "Payroll_report",
            "method"     => "gra_ret_5_report",
            "permission" => "read"
        
        ), 
        "sate_income_tax_schedule" => array(
        //menu name
       
            "controller" => "Payroll_report",
            "method"     => "sate_income_tax_report",
            "permission" => "read"
        
        ),
        "salary_confirmation_form" => array(
        //menu name
       
            "controller" => "Payroll_report",
            "method"     => "salary_confirmation_Form",
            "permission" => "read"
        
        ),
    ), 
   
    "adhoc_report" => array(
        //menu name
       
            "controller" => "Adhoc_controller",
            "method"     => "index",
            "permission" => "read"
        
    ),    
);
   

 