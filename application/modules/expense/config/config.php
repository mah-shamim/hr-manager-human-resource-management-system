<?php
// module directory name
$HmvcConfig['expense']["_title"]     = "Expense Details ";
$HmvcConfig['expense']["_description"] = "Simple Expense processing System";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['expense']['_database'] = true;
$HmvcConfig['expense']["_tables"] = array( 
	'expense_items',
	  
);
