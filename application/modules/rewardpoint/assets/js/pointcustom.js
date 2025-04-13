$(document).ready(function() { 
      "use strict";
   var csrf_test_name = $('[name="csrf_test_name"]').val();
   var base_url = $('#base_url').val();
   var total_emp_points = $("#total_emp_points").val();

   var emppointdatatable = $('#EmpPointList').DataTable({ 

             responsive: true,

             "aaSorting": [[6, "desc" ],[5, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3,4] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[25,50,100,250,500, total_emp_points], [25,50,100,250,500, "All"]],

             dom:"'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip", buttons:[ {
                extend: "copy",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5, 6] //Your Colume value those you want
                           }, className: "btn-sm prints"
            }
            , {
                extend: "csv", title: "Employee Points List",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5, 6] //Your Column value those you want print
                           }, className: "btn-sm prints"
            }
            , {
                extend: "excel",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5, 6] //Your Column value those you want print
                           }, title: "Employee Points List", className: "btn-sm prints"
            }
            , {
                extend: "pdf",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5,6] //Your Column value those you want print
                           }, title: "Employee Points List", className: "btn-sm prints"
            }
            , {
                extend: "print",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5, 6] //Your Column value those you want print
                           }, title: "<center> Employee Points List </center>", className: "btn-sm prints"
            }
            ],

            
            'serverMethod': 'post',
            'ajax': {
               'url': base_url + 'rewardpoint/rewardpoints/CheckEmpPointList',
                 "data": function ( data) {
				    data.fromdate = $('#from_date').val();
				    data.todate = $('#to_date').val();
				    data.csrf_test_name = csrf_test_name;
				}
            },
          'columns': [
             { data: 'sl' },
             { data: 'employee_name' },
             { data: 'attendence_point' },
             { data: 'collaborative_point' },
             { data: 'management_point'},
             { data: 'total' },
             { data: 'date' },
          ],

    });


$('#btn-filter').click(function(){ 
emppointdatatable.ajax.reload();  
});

});