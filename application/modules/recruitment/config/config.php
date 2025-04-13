<?php
// module directory name
$HmvcConfig['recruitment']["_title"]     = "Employee Recruitment processing System";
$HmvcConfig['recruitment']["_description"] = "Simple Recruitment processing System";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['recruitment']['_database'] = true;
$HmvcConfig['recruitment']["_tables"] = array( 
	'candidate_basic_info',
	'candidate_education_info',
	'candidate_workexperience',
	'candidate_shortlist',
	'candidate_interview',
	'candidate_selection',
	'job_advertisement'
	  
);
