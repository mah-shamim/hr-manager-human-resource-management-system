"use strict"; 
  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

  $("#first_name").on('keyup', function() {
    var inpfirstname = document.getElementById('first_name');
  if (inpfirstname.value.length === 0) return;
$("#first_name").css("border-color", "green");
});

  $("#email").on('keyup', function() {
    var inpemail = document.getElementById('email');
    if (inpemail.value.length === 0) return;
     document.getElementById("email").style.borderColor = "green";
   var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!(inpemail.value).match(reEmail)) {

    document.getElementById("email_v_message").innerHTML = "Invalid email address";
    document.getElementById("email").style.borderColor = "red";
    return false;
  }
 document.getElementById("email_v_message").innerHTML = "";
  return true;
  });

  $("#phone").on('keyup', function() {
    var phone = document.getElementById('phone');
  if (phone.value.length === 0) return;
$("#phone").css("border-color", "green");
});
 
"use strict"; 
  function validation1() {
    
    var f_name = $('#first_name').val();
      if (f_name == "") {
        $("#first_name").css("border-color", "red");
    }
    var email = $('#email').val();
     

var phone = $('#phone').val();
      if (phone == "") {
        $("#phone").css("border-color", "red");
    }
  if (email == "") {
     document.getElementById("email").style.borderColor = "red";
    return false;
  }else{
    $("#email").on('keyup', function(){
       document.getElementById("email").style.borderColor = "green";
   });
  }
 var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;   

if(f_name !== "" && email !== "" && email.match(reEmail) && phone !==""){
     $('.nav-tabs > .active').next('li').find('a').trigger('click');
}

}
"use strict"; 
function validation2() {
 $('.nav-tabs > .active').next('li').find('a').trigger('click');
}


$(document).ready(function() {
  "use strict"; 
 
// choose text for the show/hide link - can contain HTML (e.g. an image)
var showText='Add more Info';
var hideText='Hide';
 
// initialise the visibility check
var is_visible = false;
 
// append show/hide links to the element directly preceding the element with a class of "toggle"
$('.toggle').prev().append(' (<a href="#" class="toggleLink">'+showText+'</a>)');
 
// hide all of the elements with a class of 'toggle'
$('.toggle').hide();
 
// capture clicks on the toggle links
$('a.toggleLink').click(function() {
 
// switch visibility
is_visible = !is_visible;
 
// change the link depending on whether the element is shown or hidden
$(this).html( (!is_visible) ? showText : hideText);
 
// toggle the display - uncomment the next line for a basic "accordion" style

$(this).parent().next('.toggle').toggle('slow');
 
// return false so any link destination is not followed
return false;
 
});
});


 /*Interview part*/
$(document).ready(function(){

"use strict"; 
    $('.txt').on('keyup', function(){

        var sum = 0;

        $(".txt").each(function() {
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
        });
        $("#total_marks").val(sum.toFixed());

    });

});
"use strict"; 
function SelectToLoadInterview(id){
      var base_url = $("#base_url").val();
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + "recruitment/Candidate_select/select_interviewlist/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
              $('[name="job_adv_id"]').val(data.job_adv_id);
              $('[name="interview_date"]').val(data.interview_date);
              $('[name="position_name"]').val(data.position_name);
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


"use strict"; 
function SelectToSelectedcandidate(id){

    //Ajax Load data from ajax
     var base_url = $("#base_url").val();
    $.ajax({
        url : base_url + "recruitment/Candidate_select/select_interviewlist/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
              $('[name="pos_id"]').val(data.job_adv_id);
              $('[name="pos_name"]').val(data.position_name);
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}