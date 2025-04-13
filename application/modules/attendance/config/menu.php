<?php

// module name
$HmvcMenu["attendance"] = array(
    //set icon
    "icon"           => "<i class='fa fa-user'></i>", 

    // fleet type
    "attendance" => array( 
        'atn_form'    => array( 
            "controller" => "Home",
            "method"     => "index",
            "permission" => "create"
        ), 
        // 'atn_log'  => array( 
        //     "controller" => "Home",
        //     "method"     => "atten_log",
        //     "permission" => "read"
        // ), 
        'atn_log_datewise'  => array( 
            "controller" => "Home",
            "method"     => "att_log_report",
            "permission" => "read"
        ), 
        // 'atn_report'  => array( 
        //     "controller" => "Home",
        //     "method"     => "attenlist",
        //     "permission" => "read"
        // ), 
    ), 
    "device_connection"  => array( 
            "controller" => "Home",
            "method"     => "device_connection",
            "permission" => "Update"
        ), 

);
   

 