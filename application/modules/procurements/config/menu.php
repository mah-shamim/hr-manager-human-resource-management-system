
   <?php

// module name
$HmvcMenu["procurements"] = array(
    //set icon
    "icon"           => "<i class='fa fa-industry' aria-hidden='true'></i>", 

 "requests" => array(

        "request_form" => array(
           
                "controller" => "procurement_request",
                "method"     => "request_form",
                "permission" => "read"
            
        ),
        "request_list" => array(

                "controller" => "procurement_request",
                "method"     => "request_list",
                "permission" => "read"
            
        ),
    ),

  "quotation" => array(
            "controller" => "procurement_quotation",
            "method"     => "quotation_list",
            "permission" => "read"
        
    ),

  "bid_analysis" => array(

        "bid_analysis_form" => array(
           
                "controller" => "procurement_bid_analysis",
                "method"     => "bid_analysis_form",
                "permission" => "read"
            
        ),
        "bid_analysis_list" => array(

                "controller" => "procurement_bid_analysis",
                "method"     => "bid_analysis_list",
                "permission" => "read"
            
        ),  
    ),
  
  "purchase_order" => array(

        "purchase_order_form" => array(
           
                "controller" => "procurement_purchase_order",
                "method"     => "purchase_order_form",
                "permission" => "read"
            
        ),
        "purchase_order_list" => array(

                "controller" => "procurement_purchase_order",
                "method"     => "purchase_order_list",
                "permission" => "read"
            
        ),  
    ),

  "good_received" => array(

        "good_received_form" => array(
           
                "controller" => "procurement_good_received",
                "method"     => "good_received_form",
                "permission" => "read"
            
        ),
        "good_received_list" => array(

                "controller" => "procurement_good_received",
                "method"     => "good_received_list",
                "permission" => "read"
            
        ),  
    ),

  "vendors" => array(

        "vendor" => array(

                "controller" => "procurement_vendor",
                "method"     => "vendor_form",
                "permission" => "read"
            
        ),  
        "vendor_list" => array(
           
                "controller" => "procurement_vendor",
                "method"     => "vendor_list",
                "permission" => "read"
            
        ),
    ),

  "committees" => array(

        "create_committee" => array(

                "controller" => "procurement_committee",
                "method"     => "create_committee",
                "permission" => "read"
            
        ),  
        "committee_list" => array(
           
                "controller" => "procurement_committee",
                "method"     => "committee_list",
                "permission" => "read"
            
        ),
    ),

  "unit_list" => array(
            "controller" => "procurement",
            "method"     => "unit_list",
            "permission" => "read"
        
    ),

);

 