$(document).ready(function () {
    "use strict"; // Start of use strict
        
// Animate loader off screen
    $(".se-pre-con").fadeOut("slow");

    //back to top
    $('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
    $(window).on("scroll", function () {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $('#toTop').on("click", function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

 

   

    //datepicker
 $('.datepicker').datetimepicker({
         timepicker: false,
        format: 'Y-m-d'
    });

    $('.datetimepicker').datetimepicker({
        format: "Y-m-d H:i"
    });

    $('.timePicker').datetimepicker({
        datepicker: false,
        format: "H:i"
    });

    $('.monthYear').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: "+0M",
        dateFormat: 'MM yy'
    }).focus(function() {
        var thisCalendar = $(this);
        $('.ui-datepicker-calendar').detach();
        $('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
        });
    });

    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });
    
});

 "use strict";
    function printDiv() {
        
        var divName = "printArea";
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    "use strict";
    function printCoa() {

        //Get the print button and put it into a variable
        var printButton = document.getElementById("btnPrint");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';

        var divToPrint=document.getElementById("printArea");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close(); 

        printButton.style.visibility = 'visible';

    }

    "use strict";
    function printData()
    { 
        var divToPrint=document.getElementById("printArea");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close(); 
    }



     "use strict";
    function starcheck(){
 var star = $('#number_of_star').val();
if(star > 5){
    alert('You Can not input More Than five Star');
    document.getElementById('number_of_star').value = '';
    }
}

 "use strict";
function checkedrole(id){

var base_url = $("#base_url").val();
var csrf_test_name = $('[name="csrf_test_name"]').val();
$.ajax({
  url: base_url + "dashboard/Role/checkedrole",
  method:'post',
  dataType:'json',
  data:{
'user_id':id,
csrf_test_name:csrf_test_name,
  },
  success:function(data){
 var array = data['role'];
 for (var i in array){
  var ids= document.getElementById("role_"+array[i]).value;
  if(ids == array[i]){
    document.getElementById("role_"+array[i]).checked = true;
    }
}

  },
   error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
});
}

 "use strict";
function checkallcreate(sl){

   $("#checkAllcreate"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".create"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".create"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}
 "use strict";
function checkallread(sl){

   $("#checkAllread"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".read"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".read"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}

 "use strict";
function checkalledit(sl){

   $("#checkAlledit"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".edit"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".edit"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}

 "use strict";
function checkalldelete(sl){

   $("#checkAlldelete"+sl).change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".delete"+sl).each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".delete"+sl).each(function(){
         $(this).prop("checked",false);
       });
     }
   });

}

 "use strict"; 
function EmployeeinUser(id) {
    var employee_id = id;
    var base_url = $("#base_url").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
     $.ajax({
  url: base_url + "dashboard/User/employeeData",
  method:'post',
  dataType:'json',
  data:{
'employee_id':employee_id,
 csrf_test_name:csrf_test_name,
  },
  success:function(data){
document.getElementById('email_id').value=data.emails;
document.getElementById('lastname').value=data.last_name;
document.getElementById('firstname').value=data.first_name;
document.getElementById('image').value=data.image;
  },
   error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
});
  }