$(document).ready(function() { 
      "use strict";
   var csrf_test_name = $('[name="csrf_test_name"]').val();
   var base_url = $('#base_url').val();
   var total_emp_points = $("#total_emp_points").val();

   var indvemppointdatatable = $('#IndvEmpPointList').DataTable({ 

             responsive: true,

             "aaSorting": [[4,5, "desc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,1,2,3] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, total_emp_points], [10, 25, 50,100,250,500, "All"]],

             dom:"'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip", buttons:[ {
                extend: "copy",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5] //Your Colume value those you want
                           }, className: "btn-sm prints"
            }
            , {
                extend: "csv", title: "PaymentList",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5] //Your Column value those you want print
                           }, className: "btn-sm prints"
            }
            , {
                extend: "excel",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5] //Your Column value those you want print
                           }, title: "PaymentList", className: "btn-sm prints"
            }
            , {
                extend: "pdf",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5] //Your Column value those you want print
                           }, title: "Payment List", className: "btn-sm prints"
            }
            , {
                extend: "print",exportOptions: {
                       columns: [ 0, 1, 2, 3, 4, 5] //Your Column value those you want print
                           }, title: "<center> Payment List</center>", className: "btn-sm prints"
            }
            ],

            
            'serverMethod': 'post',
            'ajax': {
               'url': base_url + 'rewardpoint/rewardpoints/CheckIndvEmpPointList',
                 "data": function ( data) {

				    data.fromdate = $('#from_date').val();
				    data.todate = $('#to_date').val();
            data.employee_id = $('#employee_id').val();
				    data.csrf_test_name = csrf_test_name;
				}
            },
          'columns': [
             { data: 'sl' },
             { data: 'attendence_point' },
             { data: 'collaborative_point' },
             { data: 'management_point'},
             { data: 'total' },
             { data: 'date' },
          ],

          "footerCallback": function(row, data, start, end, display) {

          var total_points = 0;

          $.each(data, function(i, item) {
              total_points = total_points + parseFloat(data[i].total);
          });

          $('#total_points').html(total_points.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        }

    });


$('#btn-filter').click(function(){
indvemppointdatatable.ajax.reload();  
});

});