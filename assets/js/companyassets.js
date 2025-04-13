    "use strict"; 
    function checkboxcheck(sl){
        var check_id    ='check_id_'+sl;
        var equipment_id  ='equipment_id'+sl;
        var date  ='date'+sl;
        var desc  ='desc'+sl;
            if($('#'+check_id).prop("checked") == true){
                document.getElementById(date).setAttribute("required","required");
                document.getElementById(equipment_id).setAttribute("name","equipment_id[]");
                 document.getElementById(date).setAttribute("name","return_date[]");
                document.getElementById(desc).setAttribute("name","damarage_descript[]");
            }
            else if($('#'+check_id).prop("checked") == false){
                document.getElementById(date).removeAttribute("required");
                document.getElementById(equipment_id).removeAttribute("name");
                document.getElementById(date).removeAttribute("name");
                document.getElementById(desc).removeAttribute("name");
            }
        };


   $('#return').prop("disabled", true);
        $('input:checkbox').click(function() {
     var check=$('[name="rtn[]"]:checked').length;
        if (check > 0) {
            $('#return').prop("disabled", false);
        } else {
        if (check < 1){
            $('#return').attr('disabled',true);}
        }
});


    var count = $('#equipment_table tr').length;
    var limits = 500;

  "use strict"; 
    function addasset(divName){
  
        if (count == limits)  {
            alert("you_have_reached_the_limit_of_adding" + count + "inputs");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="equipment_id_"+count;
             newdiv = document.createElement("tr");
             newdiv.innerHTML ='<td><input type="text" name="equipment[]" class="form-control equipment" required="" onkeypress="asset_autocomplete('+ count +');" id="equipment_id_'+count+'"/><input type="hidden" class="autocomplete_hidden_value" name="equipment_id[]" id="Hiddenid"/><input type="hidden" class="sl" value="'+ count +'"></td><td><input type="text" name="dates[]" class="form-control datepicker_asset" value=""></div></td><td><button style="text-align: right;" class="btn btn-danger red" type="button" value="delete" onclick="deleteRow(this)"><i class="fa fa-close"></i></button></td>';
             document.getElementById(divName).appendChild(newdiv);
             document.getElementById(tabin).focus();
            count++;
           $(".datepicker_asset").datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
        }
    }


//##########
 "use strict"; 
      function deleteRow(e) {
        var t = $("#equipment_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
    }

 "use strict"; 
 function asset_autocomplete(sl) {
  var base_url = $("#base_url").val();
    // Auto complete
    var options = {
        minLength: 0,
          type: "POST",
        source: function( request, response ) {
            var equipment = $('#equipment_id_'+sl).val();
            var csrf_test_name = $('[name="csrf_test_name"]').val();
        $.ajax( {
          url: base_url + "asset/Equipment_maping/asset_search",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            equipment:equipment,
            csrf_test_name: csrf_test_name
          },
          success: function( data ) {
            response(data);
          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
            select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
            
            var sl = $(this).parent().parent().find(".sl").val(); 

            $(this).unbind("change");
            return false;
       }
   }
    
   $('body').on('keydown.autocomplete', '.equipment', function() {
       $(this).autocomplete(options);
   });

}  


 var count = $('#equipment_table tr').length;
    var limits = 500;

 "use strict"; 
    function assignasset(divName){
  
        if (count == limits)  {
            alert("you_have_reached_the_limit_of_adding " + count + "inputs");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="equipment_id_"+count;
             newdiv = document.createElement("tr");
             newdiv.innerHTML ='<td> <input type="text" name="equipment[]" class="form-control equipment" required="" onkeypress="asset_autocomplete('+ count +');" id="equipment_id_'+count+'"/><input type="hidden" class="autocomplete_hidden_value" name="equipment_id[]" id="Hiddenid"/><input type="hidden" class="sl" value="'+ count +'"></td><td>  <input type="text" name="dates[]" class="form-control datepicker" value=""></td><td> <button style="text-align: right;" class="btn btn-danger red" type="button" value="delete" onclick="deleteRow(this)"><i class="fa fa-close"></id></button></td>';
             document.getElementById(divName).appendChild(newdiv);
             document.getElementById(tabin).focus();
            count++;
            $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });
        }
    }   