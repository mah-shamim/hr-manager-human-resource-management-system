<?php
// module directory name
$HmvcConfig['income']["_title"]     = "Income Details ";
$HmvcConfig['income']["_description"] = "Simple Income processing System";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['income']['_database'] = true;
$HmvcConfig['income']["_tables"] = array( 
	'income_area',
	  
);
