<?php

// module name
$HmvcMenu["expense"] = array(
    //set icon
    "icon"           => "<i class='fa fa-money'></i>", 
    
 //group level name
    "expense_item" => array(
        //menu name
       
            "controller" => "Expense",
            "method"     => "expense_item",
            "permission" => "create"
       
    ), 
    //  "add_expense" => array(
    //     //menu name
       
    //         "controller" => "Expense",
    //         "method"     => "add_expense",
    //         "permission" => "create"
       
    // ), 
     "expense_sheet" => array(
            "controller" => "Expense",
            "method"     => "expense_chart",
            "permission" => "create"
   
    ), 
    "expense_statement" => array(
       
       
            "controller" => "Expense",
            "method"     => "expense_statement_form",
            "permission" => "read"
   
    ), 
    
 
    
);
   

 