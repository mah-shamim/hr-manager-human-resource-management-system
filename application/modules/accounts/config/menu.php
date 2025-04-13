<?php

// module name
$HmvcMenu["accounts"] = array(
    //set icon
    "icon"           => "<i class='ti-bag'></i>", 

    // stockmovment
    "financiall_year" => array( 
        "controller" => "accounts",
        "method"     => "financial_year",
        "permission" => "read"
    ), 
   "c_o_a" => array( 
        "controller" => "accounts",
        "method"     => "show_tree",
        "permission" => "read"
    ), 
     "sub_account" => array( 
        "controller" => "accounts",
        "method"     => "subaccount_list",
        "permission" => "read"
    ), 
    "predefined_accounts" => array( 
        "controller" => "accounts",
        "method"     => "predefined_accounts",
        "permission" => "create"
    ),
    "opening_balance" => array( 
        "controller" => "accounts",
        "method"     => "opening_balance",
        "permission" => "create"
    ),
    
    // "balance_adjustment" => array( 
    //     "controller" => "accounts",
    //     "method"     => "balance_adjustment",
    //     "permission" => "create"
    // ),
    // "cash_adjustment" => array( 
    //     "controller" => "accounts",
    //     "method"     => "cash_adjustment",
    //     "permission" => "create"
    // ), 
    //   "bank_adjustment" => array( 
    //     "controller" => "accounts",
    //     "method"     => "bank_adjustment",
    //     "permission" => "create"
    // ),
    //  "payment_type" => array( 
    //     "controller" => "accounts",
    //     "method"     => "payment_type",
    //     "permission" => "create"
    // ),  
   
      "debit_voucher" => array( 
        "controller" => "accounts",
        "method"     => "debit_voucher",
        "permission" => "create"
    ), 
   "credit_voucher" => array( 
        "controller" => "accounts",
        "method"     => "credit_voucher",
        "permission" => "read"
    ), 
    "contra_voucher" => array( 
        "controller" => "accounts",
        "method"     => "contra_voucher",
        "permission" => "read"
    ),
     "journal_voucher" => array( 
        "controller" => "accounts",
        "method"     => "journal_voucher",
        "permission" => "read"
    ),  
      "bank_reconciliation" => array( 
        "controller" => "accounts",
        "method"     => "bank_reconciliation",
        "permission" => "create"
    ), 
      "voucher_approval" => array( 
        "controller" => "accounts",
        "method"     => "aprove_v",
        "permission" => "create"
    ),       
       "account_report" => array( 
				       

				         "cash_book" => array( 
					        "controller" => "accounts",
					        "method"     => "cash_book",
					        "permission" => "read"
					    ), 
				          "bank_book" => array( 
					        "controller" => "accounts",
					        "method"     => "bank_book",
					        "permission" => "read"
					    ), 
    				     "day_book" => array( 
                                "controller" => "accounts",
                                "method"     => "day_book",
                                "permission" => "read"
                            ), 
                     
				          "general_ledger" => array( 
					        "controller" => "accounts",
					        "method"     => "general_ledger",
					        "permission" => "read"
					    ), 
                         "sub_ledger" => array( 
                            "controller" => "accounts",
                            "method"     => "sub_ledger",
                            "permission" => "read"
                        ), 
				           "trial_balance" => array( 
					        "controller" => "accounts",
					        "method"     => "trial_balance",
					        "permission" => "read"
					    ),
                            "income_statement" => array(   
                            "controller" => "accounts",
                            "method"     => "income_statement_form",
                            "permission" => "read"
                       
                        ), 
                         "expenditure_statement" => array(   
                            "controller" => "accounts",
                            "method"     => "expenditure_statement",
                            "permission" => "read"
                       
                        ), 
                           "profit_loss" => array( 
                            "controller" => "accounts",
                            "method"     => "profit_loss_report",
                            "permission" => "read"
                        ),
                           "balance_sheet" => array( 
                            "controller" => "accounts",
                            "method"     => "balance_sheet",
                            "permission" => "read"
                        ),
                          "fixedasset_schedule" => array( 
                            "controller" => "accounts",
                            "method"     => "fixedasset_schedule",
                            "permission" => "read"
                        ),
					     "receipt_payment" => array( 
                            "controller" => "accounts",
                            "method"     => "receipt_payment",
                            "permission" => "read"
                        ),
                         
                         "bank_reconciliation_report" => array( 
                         "controller" => "accounts",
                         "method"     => "bank_reconciliation_report",
                         "permission" => "create"
                        ), 
                         
					   
					   // "cash_flow" => array( 
					   //      "controller" => "accounts",
					   //      "method"     => "cash_flow_report",
					   //      "permission" => "read"
					   //  ),
					  
					    "coa_print" => array( 
					        "controller" => "accounts",
					        "method"     => "coa_print",
					        "permission" => "read"
					    ),  
    ), 
);
   

 