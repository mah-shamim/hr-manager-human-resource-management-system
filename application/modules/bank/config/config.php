<?php
// module directory name
$HmvcConfig['bank']["_title"]     = "Bank Details ";
$HmvcConfig['bank']["_description"] = "Simple Banking processing System";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['bank']['_database'] = true;
$HmvcConfig['bank']["_tables"] = array( 
	'bank_information',
	  
);
