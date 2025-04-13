<?php

// module name
$HmvcMenu["bank"] = array(
    //set icon
    "icon"           => "<i class='fa fa-bank'></i>", 
    
 //group level name
    "add_bank" => array(
        //menu name
       
            "controller" => "Bank",
            "method"     => "create_bank",
            "permission" => "create"
       
    ), 
    "bank_list" => array(
       
       
            "controller" => "Bank",
            "method"     => "bank_list",
            "permission" => "read"
   
    ), 
 
    
);
   

 