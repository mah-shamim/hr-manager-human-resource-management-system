<?php

// module name
$HmvcMenu["asset"] = array(
    //set icon
    "icon"           => "<i class='fa fa-diamond' aria-hidden='true'></i>

", 
    
 //group level name

        //menu name
       "asset_type" => array(
        //menu name
       
            "controller" => "type_controller",
            "method"     => "type_form",
            "permission" => "create"
        
    ), 
       
    // equipment

        //menu name
       "equipment" => array(
        //menu name
       
            "controller" => "equipment_controller",
            "method"     => "equipment_form",
            "permission" => "create"
        
    ), 
       
    
     // equipment maping
        //menu name
       "asset_assignment" => array(
        //menu name
       
            "controller" => "equipment_maping",
            "method"     => "maping_form",
            "permission" => "create"
        
    ), 
 

          "return" => array(    
     "return_asset" => array(
        //menu name
       
            "controller" => "equipment_maping",
            "method"     => "return_asset",
            "permission" => "create"
        
    ), 
      "return_list" => array(
        //menu name
       
            "controller" => "equipment_maping",
            "method"     => "return_list",
            "permission" => "read"
        
    ), 
  ),
    
);
   

 