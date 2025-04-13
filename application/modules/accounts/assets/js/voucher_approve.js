 "use strict"; 
 function checkAll(el) {
     if (el.checked){
       $(":checkbox").prop('checked', true);
    }else{
        $(":checkbox").prop('checked', false);
    }        
 }

"use strict"; 
 function checkValue() {
    
    var checkBoxes = document.getElementsByClassName( 'approvalCheckbox' );
    if(checkBoxes.length > 0) {
        var isChecked = false;
        for (var i = 0; i < checkBoxes.length; i++) {
            if ( checkBoxes[i].checked ) {
                isChecked = true;
            }
        }
        if ( isChecked ) {
           var conf = confirm('Are you sure approve all voucher?');
            if(conf) {
                return true;
            } else {
                return false;
            }
        } else {
            alert('Please select voucher to approve!');
            return false;
        }   
     } else {
       alert('There is no voucher to approve!');
       return false;
   }
    
}
