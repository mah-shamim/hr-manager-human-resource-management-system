
$(function() {

	"use strict"; 

    var fk_user_id = $('#role_fk_user_id').val();

	document.forms['role_acc'].elements['user_id'].value = fk_user_id;
	
});

