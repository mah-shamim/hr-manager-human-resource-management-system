$(function($){
    "use strict";
    //tooltips
    $('[data-toggle="tooltip"]').tooltip();
    //datatable
    $('.datatable').DataTable({ 
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        buttons: [  
            {extend: 'copy', title: 'Report', className: 'btn-sm', footer: true},
            {extend: 'excel', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm', footer: true}, 
            {extend: 'print', title: 'Report', className: 'btn-sm', footer: true} 
        ] 
    });

    //datatable
    $('.datatable2').DataTable({ 
        responsive: true, 
        paging:false,
        dom: "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>tp", 
        buttons: [  
            {extend: 'copy', title: 'Report', className: 'btn-sm', footer: true},
            {extend: 'excel', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm', footer: true}, 
            {extend: 'print', title: 'Report', className: 'btn-sm', footer: true} 
        ] 
    });
 
//datatable
    $('.datatableReport').DataTable({         
        responsive: true, 
         ordering:false,
         paging:false,
         searching: false,
         info: false,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[30, 50, 100, -1], [30, 50, 100, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm', footer: true}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm', footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm', footer: true}, 
            {extend: 'print', className: 'btn-sm', footer: true} 
        ] 
    });

    //datatable
    $('.payrollDatatableReport').DataTable({         
        responsive: true, 
         ordering:false,
         paging:false,
         searching: false,
         info: false,
        buttons: [  
            
        ] 
    });

    //timepicker
    $('.timepicker-hour-min-only').timepicker({
        timeFormat: 'HH:mm:00',
        stepHour: 1,
        stepMinute: 5,
    });

    // semantic button
    $('.ui.selection.dropdown').dropdown();
    $('.ui.menu .ui.dropdown').dropdown({
        on: 'hover'
    });
 

    // select 2 dropdown 
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "Select option",
        allowClear: true
    });

   
 
    //Sparklines Charts
    $('.sparkline1').sparkline([4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 7, 4, 3, 1, 5, 7, 6, 6, 5, 5, 4, 4, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7], {
        type: 'bar',
        barColor: '#37a000',
        height: '35',
        barWidth: '3',
        barSpacing: 2
    });

    $(".sparkline2").sparkline([-8, 2, 4, 3, 5, 4, 3, 5, 5, 6, 3, 9, 7, 3, 5, 6, 9, 5, 6, 7, 2, 3, 9, 6, 6, 7, 8, 10, 15, 16, 17, 15], {
        type: 'line',
        height: '35',
        width: '100%',
        lineColor: '#37a000',
        fillColor: '#fff'
    });
    $(".sparkline3").sparkline([2, 5, 3, 7, 5, 10, 3, 6, 5, 7], {
        type: 'line',
        height: '35',
        width: '100%',
        lineColor: '#37a000',
        fillColor: '#fff'
    });
    $(".sparkline4").sparkline([10, 34, 13, 33, 35, 24, 32, 24, 52, 35], {
        type: 'line',
        height: '35',
        width: '100%',
        lineColor: '#37a000',
        fillColor: 'rgba(55, 160, 0, 0.7)'
    }); 

    //preloader
    $(window).on('load', function() {
        $(".se-pre-con").fadeOut("slow");;
    });

    // fixed table head
    $("#fixTable").tableHeadFixer();


    //print a div
    "use strict";
    function printContent(el){
        var restorepage  = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        location.reload();
    }

    /*Improvised js*/
    
    //Hide export attendence modal when click download button
      $('#exportmodal').click(function() {
        $('#exportattn').modal('hide');
      });

      /*end of improvised js*/

});

//security page js end

$(document).ready(function () {

    "use strict";

    $("form :input").attr("autocomplete", "off");

    $(".valid_number").keypress(function(t) {
        var e = t.which ? t.which : t.keyCode;
        return !(46 != e && 45 != e && e > 31 && (e < 48 || e > 57))
    });

});

 // only number insert in a fields call this class onlyNumber
$(document).on('keypress', '.onlyNumber', function(evt){
     var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
         return false;

      return true;
});