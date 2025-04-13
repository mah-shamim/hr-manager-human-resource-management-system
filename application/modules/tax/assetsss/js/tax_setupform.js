"use strict";
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(i);
}


"use strict";
function insRow()
{
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
    x.appendChild( new_row );
}

/*New tax setup starts*/

var limits = 500;

"use strict";
function addLevel(tableID){

    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var level_count_item = rowCount;

    var tr = '<td class="paddin3ps"><input  type="text" class="form-control valid_number" id="level_name" name="level_name[]" readonly value="'+level_count_item+'"/></td>'+
             '<td class="paddin3ps"><input  type="number" class="form-control valid_number" id="start_range_'+level_count_item+'" name="start_range[]" onchange="edit_start_range('+level_count_item+')" required/></td>'+
             '<td class="paddin3ps"><input  type="number" class="form-control valid_number" id="end_range_'+level_count_item+'" name="end_range[]" onchange="edit_end_range('+level_count_item+')" required/></td>'+
             '<td class="paddin3ps"><input  type="number" class="form-control valid_number" id="tax_percent_'+level_count_item+'" name="tax_percent[]" required/></td>'+
             '<td class="paddin3ps"><input  type="number" class="form-control valid_number" id="add_smount_'+level_count_item+'" name="add_smount[]" value="0" required/></td>';

    level_count_item > limits ? alert("You have reached the limit of adding " + level_count_item + " inputs") : $("table#levelItem").append("<tr>" + tr + "</tr>");

    $(".valid_number").keypress(function(t) {
        var e = t.which ? t.which : t.keyCode;
        return !(46 != e && 45 != e && e > 31 && (e < 48 || e > 57))
    });

}

"use strict";
function edit_start_range(sl){

    var start_range = parseInt($("#start_range_"+sl).val());
    var end_range = parseInt($("#end_range_"+sl).val());

    // For first level start range
    if(sl == 1 && start_range < 0){
        alert("Start Range must be greater than or equal zero for level "+sl+" !");
        $("#start_range_"+sl).val("");
    }
    if(sl == 1 && start_range >= end_range){
        alert("Start Range must be lower than End range of level "+sl+" !");
        $("#start_range_"+sl).val("");
    }

    // After first level start range
    if(sl > 1){

        var upper_row = sl-1;

        var upper_row_start_range = parseInt($("#start_range_"+upper_row).val());
        var upper_row_end_range = parseInt($("#end_range_"+upper_row).val());

        // Before taking input in new level.. check if input taken for upper level first
        if(isNaN(upper_row_start_range) || isNaN(upper_row_end_range)){

            alert("To assign Start Range, level "+upper_row+" Start Range and End Range can not be empty !");
            $("#start_range_"+sl).val("");
            $("#end_range_"+sl).val("");
        }

        // Check upper level end range is lesser than the current input start range value
        if(start_range < upper_row_end_range){

            alert("Start Range must be greater than or equal to level "+upper_row+" End Range.");
            $("#start_range_"+sl).val(upper_row_end_range);
        }

        // Check if start range is lesser than end range , if start range input taken after end range
        if(!isNaN(end_range) && !isNaN(start_range) && end_range <= start_range){

            alert("End Range must be greater than Start Range for level "+sl+" !");
            $("#start_range_"+sl).val("");
            $("#end_range_"+sl).val("");
        }

    }
    
}

"use strict";
function edit_end_range(sl){

    var start_range = parseInt($("#start_range_"+sl).val());
    var end_range = parseInt($("#end_range_"+sl).val());
    
    // End range must be larger than start range of all level
    
   if(isNaN(start_range)){

        alert("First fill up start range for level "+ sl +" !");
        $("#end_range_"+sl).val("");
    }
    else if(end_range <= start_range){

        alert("End Range must be greater than Start Range for level "+sl+" !");
        $("#end_range_"+sl).val("");
    }

    // After first level end range
    if(sl > 1){

        var upper_row = sl-1;

        var upper_row_start_range = parseInt($("#start_range_"+upper_row).val());
        var upper_row_end_range = parseInt($("#end_range_"+upper_row).val());

        // Before taking input in new level.. check if input taken for upper level first
        if(isNaN(upper_row_start_range) || isNaN(upper_row_end_range)){

            alert("To assign End Range, level "+upper_row+" Start Range and End Range can not be empty !");
            $("#start_range_"+sl).val("");
            $("#end_range_"+sl).val("");
        }
    }

    // Botton level start range compare with upper level end range .. when editing end range
    var table = document.getElementById('levelItem');
    var rowCount = table.rows.length;

    if(rowCount > 2){
        var bottom_row = sl+1;

        if(bottom_row <= rowCount){

            var bottom_row_start_range = parseInt($("#start_range_"+bottom_row).val());

            if(end_range > bottom_row_start_range){
                alert("End Range must be lower than or equal to Start Range of level "+bottom_row+" !");
                $("#end_range_"+sl).val("");
            }
        }
    }
    
}

"use strict";
function deleteTableRow(tableID){

    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = rowCount-1;

    if(row > 1){

        // Start ajax call.. if true then remove the row from table..
        var base_url = $("#base_url_rax").val();

        $.ajax({
            url: base_url + "/tax/Tax/remove_tax_setup/" + row,
            type: "GET",
            dataType: "json",
            success: function(respo) {
                if(respo.status){
                    table.deleteRow(rowCount -1);
                }else{
                    alert(respo.msg);
                }
            },
            error: function(e) {
                alert("Error get data from ajax")
            }
        })
    }else{
        alert('Can not delete first level !');
    }
    
}

/*New tax setup ends*/