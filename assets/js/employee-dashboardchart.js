$(function (){
   "use strict"; 

var base_url = $("#base_url").val();

function getJsonData(req_url){

      var php_data;
      $.ajax({
        type:"GET",
        url: base_url+req_url,
        async: false,
        dataType: "json",
        success: function (respo) {
          php_data = respo;
        }
      });

      return php_data;
}

 // single bar chart
 var yearly_employee_points = getJsonData("dashboard/home/yearly_employee_points");

  var ctx = document.getElementById("singelBarChart");
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September" , "October" , "November" , "December"],
          datasets: [
              {
                  label: "Points",
                  data: yearly_employee_points,
                  borderColor: "rgba(55, 160, 0, 0.9)",
                  borderWidth: "0",
                  backgroundColor: "rgba(55, 160, 0, 0.7)"
              }
          ]
      },
      options: {
          scales: {
              yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
          }
      }
  });

  //pie chart
  var monthly_employee_points = getJsonData("dashboard/home/monthly_employee_points");

  var ctx = document.getElementById("pieChart");
  var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          datasets: [{
                  data: monthly_employee_points,
                  backgroundColor: [
                      "rgba(0,128,0,0.9)",
                      "rgba(65,105,225,0.9)",
                      "rgba(75,0,130,0.9)"
                  ],
                  hoverBackgroundColor: [
                      "rgba(0,128,0,0.9)",
                      "rgba(65,105,225,0.7)",
                      "rgba(75,0,130,0.9)"
                  ]

              }],
          labels: [
              "Attendance",
              "Management",
              "Collaborative"
          ]
      },
      options: {
          responsive: true
      }
  });


// lineChart
var employee_attendence = getJsonData("dashboard/home/monthly_employee_attendence");

var ctx = document.getElementById("lineChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: employee_attendence.days,
        datasets: [
            {
                label: "Attendance Point",
                borderColor: "rgba(55, 160, 0, 0.9)",
                borderWidth: "1",
                backgroundColor: "rgba(0,0,0,0.07)",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data:  employee_attendence.points
            }
        ]
    },
    options: {
        responsive: true,
        tooltips: {
            mode: 'index',
            intersect: false
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
          yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                    steps: 2,
                    stepValue: 1,
                    max: 2
                }
            }]
        },

    }
});

})