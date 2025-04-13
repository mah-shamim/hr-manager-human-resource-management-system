var count = 2;
var limits = 500;

var count_dev_plan  = 2;
var limits_dev_plan = 500;

"use strict";
//Add request input field
function add_key_goals(e) {

    var t = '<td><textarea class="form-control" name="key_goals[]" id="description" rows="2" placeholder="" tabindex="10" required=""></textarea></td>'+
    '<td class=""><input type="text"  class="form-control datepicker_sub" name="completion_period[]" placeholder="" required  min="0"/></td>'+
    '<td> <a  id="add_key_goals" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_key_goals('+"key_goals_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
    count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#key_goals_item").append("<tr>" + t + "</tr>");
    count++;

    $('.datepicker_sub').datetimepicker({
         timepicker: false,
        format: 'Y-m-d'
    });

}

"use strict";
function deleteRow(e) {
    var t = $("#request_table > tbody > tr").length;
    if (1 == t) alert("There only one row you can't delete.");
    else {
        var a = e.parentNode.parentNode;
        a.parentNode.removeChild(a)
    }
   
}

"use strict";
//Add request input field
function add_dev_plans(e) {

    var t = '<td><textarea name="recommand_areas[]" class="form-control" placeholder="" required></textarea></td>'+
    
    '<td><textarea name="expected_outcomes[]" class="form-control" placeholder="" required></textarea></td>'+

    '<td><input type="text" id="responsible_person" name="responsible_person[]" class="form-control" required></td>'+

    '<td><input type="text" id="start_date" name="start_date[]" class="form-control datepicker_sub1" required></td>'+

    '<td><input type="text" id="end_date" name="end_date[]" class="form-control datepicker_sub2" required></td>'+

    '<td> <a  id="add_dev_plan" class="btn btn-info btn-sm" name="add-invoice-item" onClick="add_dev_plans('+"key_dev_plan_item"+')"><i class="fa fa-plus-square" aria-hidden="true"></i></a> <a class="btn btn-danger btn-sm"  value="" onclick="deleteDevPlanRow(this)" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

    count_dev_plan == limits_dev_plan ? alert("You have reached the limit of adding " + count_dev_plan + " inputs") : $("tbody#key_dev_plan_item").append("<tr>" + t + "</tr>");
    count_dev_plan++;

    $('.datepicker_sub1').datetimepicker({
         timepicker: false,
        format: 'Y-m-d'
    });

    $('.datepicker_sub2').datetimepicker({
         timepicker: false,
        format: 'Y-m-d'
    });

}

"use strict";
function deleteDevPlanRow(e) {
    var t = $("#request_table_dev_plan > tbody > tr").length;
    if (1 == t) alert("There only one row you can't delete.");
    else {
        var a = e.parentNode.parentNode;
        a.parentNode.removeChild(a)
    }
   
}


$(document).ready(function() { 

    "use strict";

    /////////////*  A. ASSESSMENT OF GOALS/OBJECTIVES SET DURING THE REVIEW PERIOD *////////////

    /*Demonstrated Knowledge of duties & Quality of Work*/
    $('#demonstrated_p').click(function(){

        var demonstrated_p =$(this).val();
        $('#demonstrated_score').val(demonstrated_p);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#demonstrated_ni').click(function(){

        var demonstrated_ni =$(this).val();
        $('#demonstrated_score').val(demonstrated_ni);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {

            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#demonstrated_g').click(function(){

        var demonstrated_g =$(this).val();
        $('#demonstrated_score').val(demonstrated_g);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#demonstrated_vg').click(function(){

        var demonstrated_vg =$(this).val();
        $('#demonstrated_score').val(demonstrated_vg);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#demonstrated_e').click(function(){

        var demonstrated_e =$(this).val();
        $('#demonstrated_score').val(demonstrated_e);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    /*Timeliness of Delivery*/
    $('#timeliness_p').click(function(){

        var timeliness_p =$(this).val();
        $('#timeliness_score').val(timeliness_p);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#timeliness_ni').click(function(){

        var timeliness_ni =$(this).val();
        $('#timeliness_score').val(timeliness_ni);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {

            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#timeliness_g').click(function(){

        var timeliness_g =$(this).val();
        $('#timeliness_score').val(timeliness_g);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#timeliness_vg').click(function(){

        var timeliness_vg =$(this).val();
        $('#timeliness_score').val(timeliness_vg);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#timeliness_e').click(function(){

        var timeliness_e =$(this).val();
        $('#timeliness_score').val(timeliness_e);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    /*Impact of Achievement*/
    $('#impact_p').click(function(){

        var impact_p =$(this).val();
        $('#impact_score').val(impact_p);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#impact_ni').click(function(){

        var impact_ni =$(this).val();
        $('#impact_score').val(impact_ni);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {

            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#impact_g').click(function(){

        var impact_g =$(this).val();
        $('#impact_score').val(impact_g);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#impact_vg').click(function(){

        var impact_vg =$(this).val();
        $('#impact_score').val(impact_vg);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#impact_e').click(function(){

        var impact_e =$(this).val();
        $('#impact_score').val(impact_e);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    /*Overall Achievement of Goals/Objectives*/
    $('#overall_p').click(function(){

        var overall_p =$(this).val();
        $('#overall_score').val(overall_p);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#overall_ni').click(function(){

        var overall_ni =$(this).val();
        $('#overall_score').val(overall_ni);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {

            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#overall_g').click(function(){

        var overall_g =$(this).val();
        $('#overall_score').val(overall_g);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#overall_vg').click(function(){

        var overall_vg =$(this).val();
        $('#overall_score').val(overall_vg);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    $('#overall_e').click(function(){

        var overall_e =$(this).val();
        $('#overall_score').val(overall_e);

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    // Check demonstrated_score can not be more than 10
    $('#demonstrated_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 12){

            $(this).val(12);
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    // Check timeliness_score can not be more than 10
    $('#timeliness_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 12){

            $(this).val(12); 
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();

    });

    // Check communication_score can not be more than 10
    $('#impact_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 12){

            $(this).val(12); 
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();
    });

    // Check contributing_score can not be more than 10
    $('#overall_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 12){

            $(this).val(12); 
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();
    });

    // Check contributing_score can not be more than 10
    $('#beyond_duty').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 12){

            $(this).val(12); 
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });
        $('#assesment_a_total_score').val(assesment_a_total_score);

        update_total_score();
    });


    ////////////*  B. ASSESSMENT OF OTHER PERFORMANCE STANDARDS AND INDICATORS *///////////////

    /*Interpersonal skills & ability to work in a team environment*/
    $('#interpersonal_p').click(function(){

        var interpersonal_p =$(this).val();
        $('#interpersonal_score').val(interpersonal_p);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#interpersonal_ni').click(function(){

        var interpersonal_ni =$(this).val();
        $('#interpersonal_score').val(interpersonal_ni);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#interpersonal_g').click(function(){

        var interpersonal_g =$(this).val();
        $('#interpersonal_score').val(interpersonal_g);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#interpersonal_vg').click(function(){

        var interpersonal_vg =$(this).val();
        $('#interpersonal_score').val(interpersonal_vg);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#interpersonal_e').click(function(){

        var interpersonal_e =$(this).val();
        $('#interpersonal_score').val(interpersonal_e);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    /*Attendance and Punctuality*/
    $('#attendance_p').click(function(){

        var attendance_p =$(this).val();
        $('#attendance_score').val(attendance_p);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#attendance_ni').click(function(){

        var attendance_ni =$(this).val();
        $('#attendance_score').val(attendance_ni);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#attendance_g').click(function(){

        var attendance_g =$(this).val();
        $('#attendance_score').val(attendance_g);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#attendance_vg').click(function(){

        var attendance_vg =$(this).val();
        $('#attendance_score').val(attendance_vg);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#attendance_e').click(function(){

        var attendance_e =$(this).val();
        $('#attendance_score').val(attendance_e);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    /*Communication Skills*/
    $('#communication_p').click(function(){

        var communication_p =$(this).val();
        $('#communication_score').val(communication_p);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#communication_ni').click(function(){

        var communication_ni =$(this).val();
        $('#communication_score').val(communication_ni);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#communication_g').click(function(){

        var communication_g =$(this).val();
        $('#communication_score').val(communication_g);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#communication_vg').click(function(){

        var communication_vg =$(this).val();
        $('#communication_score').val(communication_vg);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#communication_e').click(function(){

        var communication_e =$(this).val();
        $('#communication_score').val(communication_e);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    /*Contributing to IIHT Gambia’s mission*/
    $('#contributing_p').click(function(){

        var contributing_p =$(this).val();
        $('#contributing_score').val(contributing_p);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#contributing_ni').click(function(){

        var contributing_ni =$(this).val();
        $('#contributing_score').val(contributing_ni);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#contributing_g').click(function(){

        var contributing_g =$(this).val();
        $('#contributing_score').val(contributing_g);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#contributing_vg').click(function(){

        var contributing_vg =$(this).val();
        $('#contributing_score').val(contributing_vg);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    $('#contributing_e').click(function(){

        var contributing_e =$(this).val();
        $('#contributing_score').val(contributing_e);

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();

    });

    // Check interpersonal_score can not be more than 10
    $('#interpersonal_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 10){

            $(this).val(10);
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();
    });

    // Check attendance_score can not be more than 10
    $('#attendance_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 10){

            $(this).val(10);
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();
    });

    // Check communication_score can not be more than 10
    $('#communication_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 10){

            $(this).val(10);
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();
    });

    // Check contributing_score can not be more than 10
    $('#contributing_score').on('keyup', function(){

        if($(this).val() == '' || parseInt($(this).val()) < 0){
            $(this).val(0);
        }
        if(parseInt($(this).val()) > 10){

            $(this).val(10);
        }
        // Ignore decimal numbers
        $(this).val(parseInt($(this).val()));

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });
        $('#assesment_b_total_score').val(assesment_b_total_score);

        update_total_score();
    });

    function update_total_score(){

        var assesment_a_total_score = 0;
        $(".assessment_a").each(function() {
            assesment_a_total_score = assesment_a_total_score + parseInt($(this).val());
        });

        var assesment_b_total_score = 0;
        $(".assessment_b").each(function() {
            assesment_b_total_score = assesment_b_total_score + parseInt($(this).val());
        });

        var score_final = assesment_a_total_score + assesment_b_total_score;

        $("#score_a").text(assesment_a_total_score);
        $("#score_b").text(assesment_b_total_score);
        $("#score_final").text(score_final);
    }


});