<?php

// module name
$HmvcMenu["payroll"] = array(
    //set icon
    "icon"           => "<i class='fa fa-credit-card'></i>", 
    
 // //group level name
 //    "salary_type_setup" => array(
 //        //menu name
      
 //            "controller" => "Payroll",
 //            "method"     => "create_salary_setup",
 //            "permission" => "read"     
 //    ), 
 
 //  "salary_setup" => array(
 //        //menu name
       
 //            "controller" => "Payroll",
 //            "method"     => "create_s_setup",
 //            "permission" => "create"
       
 //    ), 


   // "salary_generate" => array(
   //      //menu name
        
   //          "controller" => "Payroll",
   //          "method"     => "create_salary_generate",
   //          "permission" => "create"
       
   //  ), 
   //    "emp_sal_payment"  => array(  
   //          "controller" => "Payroll",
   //          "method"     => "emp_payment_view",
   //          "permission" => "view"
     
   //  ), 
    "salary_advance" => array(
        //menu name
        
            "controller" => "salary_advance",
            "method"     => "salary_advance_view",
            "permission" => "read"
       
    ),

    "salary_generate" => array(
        //menu name
        
            "controller" => "payroll",
            "method"     => "employee_salary_generate",
            "permission" => "read"
       
    ),
    "emp_sal_payment"  => array(  
            "controller" => "payroll",
            "method"     => "employee_salary_payment_view",
            "permission" => "read"
     
    ), 
    
);
   

 