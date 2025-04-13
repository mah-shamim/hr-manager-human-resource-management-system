 "use strict"; 
function checkAll(el) {
    var count = $(el).data('property');        
     if (el.checked){
       $(":checkbox").prop('checked', true);            
        for (var i = 1; i <= count; i++) {
            $('#t-'+ i).css('background-color','#151B8D !important');
            $('#t-'+ i).find('td').css('color','#fff !important');
        }
    }else{
        $(":checkbox").prop('checked', false);
        for (var i = 1; i <= count; i++) {
            $('#t-'+ i).css('background-color','');
            $('#t-'+ i).find('td').css('color','');
        }
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
           var conf = confirm('Are you sure reconciliation all check?');
            if(conf) {
                return true;
            } else {
                return false;
            }
        } else {
            alert('Please select check to reconciliation!');
            return false;
        }   
     } else {
       alert('There is no check select to reconciliation!');
       return false;
   }        
}
$(document).on('click', '.approvalCheckbox', function() {
     "use strict"; 
    var pval = $(this).data('property');   
    if($(this).prop('checked'))  {
        $('#'+pval).css('background-color','#151B8D !important');
        $('#'+pval).find('td').css('color','#fff !important'); 
    } else {
        $('#'+pval).css('background-color','');
        $('#'+pval).find('td').css('color','');
    }
    
    
});