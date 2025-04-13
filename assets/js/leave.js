    $(document).ready(function(e) {
        "use strict"; 
    function holidaycalculation(){   
var date1 =new Date($('#start_date').val());
var date2 =new Date($('#end_date').val());
var from = new Date($('#start_date').val());
var to = new Date($('#end_date').val());
var DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

var d = from;
var count = 0;
var weekend = "<?php echo $weekend ?>";
var w  = weekend.split(',')
while (d <= to) {
    d = new Date(d.getTime() + (24 * 60 * 60 * 1000));
    if(DAYS[d.getDay()]==w[0] || DAYS[d.getDay()]==w[1] ||DAYS[d.getDay()]==w[2]){
        count +=1;
    }
}

var timeDiff = Math.abs(date2.getTime() - date1.getTime());
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))-count;  
        $('#no_of_days').val(diffDays+1);
        }
        $('#start_date,#end_date').change(holidaycalculation);
});

    $(document).ready(function(e) {
 $('.dp').datepicker({
        dateFormat: 'yy-mm-dd'
    });
  });

    $(document).ready(function(e) {
        "use strict"; 
    function leaveapprovecalculation(){   
var date1 =new Date($('.leave_aprv_strt_date').val());
var date2 =new Date($('.leave_aprv_end_date').val());
var from = new Date($('.leave_aprv_strt_date').val());
var to = new Date($('.leave_aprv_end_date').val());
var DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

var d = from;
var count = 0;
var weekend = "<?php echo $weekend ?>";
var w  = weekend.split(',')

while (d <= to) {
    d = new Date(d.getTime() + (24 * 60 * 60 * 1000));
    if(DAYS[d.getDay()]==w[0] || DAYS[d.getDay()]==w[1] ||DAYS[d.getDay()]==w[2]){
        count +=1;
    }
}

var timeDiff = Math.abs(date2.getTime() - date1.getTime());
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))-count;  
        $('.num_aprv_day').val(diffDays+1);
        }
        $('.leave_aprv_strt_date,.leave_aprv_end_date').change(leaveapprovecalculation);

});



 $(document).ready(function(e) {
    "use strict"; 
    function applyday(){   

var from = new Date($('.apply_start').val());
var to = new Date($('.apply_end').val());
var DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

var d = from;
var count = 0;
var weekend = "<?php echo $weekend ?>";
var w  = weekend.split(',')

while (d <= to) {
    d = new Date(d.getTime() + (24 * 60 * 60 * 1000));
    if(DAYS[d.getDay()]==w[0] || DAYS[d.getDay()]==w[1] ||DAYS[d.getDay()]==w[2]){
        count +=1;
    }
}
var date1 =new Date($('#apply_start').val());
var date2 =new Date($('#apply_end').val());
var timeDiff = Math.abs(date2.getTime() - date1.getTime());
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))-count;  
        $('#apply_day').val(diffDays+1);
        }


        $('#apply_start,#apply_end').change(applyday);
});
    
"use strict"; 
function leavetypechange(id){
var leave_type = id;
var employee_id =$('#employee_id').val();
var base_url = $("#base_url").val();
var csrf_test_name = $('[name="csrf_test_name"]').val();
$.ajax({
  url: base_url +"leave/Leave/free_leave",
  method:'post',
  dataType:'json',
  data:{
'employee_id':employee_id,
'leave_type' : id,
csrf_test_name: csrf_test_name
  },
  success:function(data){
document.getElementById('enjoy').innerHTML='You Enjoyed : '+data.enjoy+' Ds';
document.getElementById('checkleave').innerHTML='Total Leave : '+data.due+' Ds';
  },
   error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
});
}    

$(document).ready(function(e) {
    "use strict"; 
    function datecheck(){ 
var date =new Date($('#apply_start').val());  
var date1 =new Date($('#leave_aprv_strt_date').val());
var date2 =new Date($('#leave_aprv_end_date').val());
if(date > date1 || date > date2){
    alert('Can not greater than');
    document.getElementById('leave_aprv_strt_date').value = '';
    document.getElementById('leave_aprv_end_date').value = '';
}
        }
        $('.leave_aprv_strt_date,.leave_aprv_end_date').change(datecheck);
});

$(document).ready(function(e) {
    "use strict"; 
    function leavecalculation(){   
var date1 =new Date($('.leave_aprv_strt_date').val());
var date2 =new Date($('.leave_aprv_end_date').val());
var from = new Date($('.leave_aprv_strt_date').val());
var to = new Date($('.leave_aprv_end_date').val());
var DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

var d = from;
var count = 0;
var weekend = "<?php echo $weekend ?>";
var w  = weekend.split(',')

while (d <= to) {
    d = new Date(d.getTime() + (24 * 60 * 60 * 1000));
    if(DAYS[d.getDay()]==w[0] || DAYS[d.getDay()]==w[1] ||DAYS[d.getDay()]==w[2]){
        count +=1;
    }
}

var timeDiff = Math.abs(date2.getTime() - date1.getTime());
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))-count;  
        $('.num_aprv_day').val(diffDays+1);
        }
        $('.leave_aprv_strt_date,.leave_aprv_end_date').change(leavecalculation);
});