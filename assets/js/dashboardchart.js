$(function (){
   "use strict"; 
   var attentitle = $("#presentitle").val();
              var atnlabel=$("#attendancelabel").val();
              var attendance = $("#attendancetitle").val();
              var employee  = $("#employeetitle").val();
              var absenttitle = $("#absenttitle").val();
              var absent      = $("absent").val();
              var recruitedtitle = $("#recruitedtitle").val();
              var recruitedyeartitle = $("#recruitedyeartitle").val();
              var loanpaymenttitle = $("#loanpaymenttitle").val();
              var loanreceivettitle = $("#loanreceivettitle").val();
              var paymentrecvtitle = $("#paymentrecvtitle").val();
              var awardedtitle =$("awardedtitle").val();
              var awardedcurrnttitle = $("#awardedcurrnttitle").val();
              var fatlable = atnlabel.substring(0, atnlabel.length - 1);
              var label1 = fatlable.split(",");
              var attendancedt = $("#attendancedata").val();
              var atndata = attendancedt.substring(0, attendancedt.length - 1);
              var res = atndata.split(",");
              var mvar=$("#month").val();
              var splitmonth = mvar.substring(0, mvar.length - 1);
              var month = splitmonth.split(",");
              var rece = $("#recruitedemp").val();
              var recruit = rece.substring(0, rece.length - 1);
              var recruitedemploee = recruit.split(",");

              var abslbl1 = $("#abdfftdaylabel").val();
              var abs15days = abslbl1.substring(0, abslbl1.length - 1);
              var abslabel1 = abs15days.split(",");

              var absval1 = $("#abdfftdayval").val();
              var abs15daysval = absval1.substring(0, absval1.length - 1);
              var absval1 = abs15daysval.split(",");    
              
              var total_loanpayment = $("#loanpayemntamnt").val();
              var total_loanreceived = $("#loanreceivedamnt").val();


              var loanstatisticpay = $("#loanstatisticpayment").val();
              var statisticpay = loanstatisticpay.substring(0, loanstatisticpay.length - 1);
              var loanstatisticpayment = statisticpay.split(",");

              var loanstatisticrecv = $("#loanstatisticreceived").val();
               var statisticreceive = loanstatisticrecv.substring(0, loanstatisticrecv.length - 1);
              var loanstatisticreceived = statisticreceive.split(",");
              
              var awrvar = $("#awardedempl").val();
               var awrdedemp = awrvar.substring(0, awrvar.length - 1);
              var awarded = awrdedemp.split(",");

              var attendanceChartcanvas = document.getElementById('bar-chart-attendance').getContext('2d');
              var attendanceChartdata = {
    labels  : label1,
    datasets: [
      {
          label            : attendance,
          backgroundColor  : "#E74C3C",
          fill             :false,
          pointRadius      : 5,
          data             : res
      },
    ]
  }

               

  var attenceChartoption = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
     title: {
        display: true,
        text: attentitle
      },
    scales: {
       yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                    steps: 10,
                    stepValue: 5,
                    max: 45 },
                           
                scaleLabel: {
                    display: true,
                    labelString: employee
                        }
                    }],
        xAxes: [{
                gridLines: {
                    display: false,
                    lineWidth: 0,
                            },
                }]    
    }
  }

  // This will get the first returned node in the jQuery collection.
  var attendanceChart = new Chart(attendanceChartcanvas, { 
      type: 'line', 
      data: attendanceChartdata, 
      options: attenceChartoption
    }
  )


/* Recruitment graphp */
   var recruitmentChartcanvas = document.getElementById('bar-chart-recruitment').getContext('2d');
              var recruitedChartdata = {
    labels  : month,
    datasets: [
      {
          label            : recruitedtitle,
          backgroundColor  : "#3CB371",
          data             : recruitedemploee
      },
    ]
  }

               

  var recruitedChartoption = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
     title: {
        display: true,
        text: recruitedyeartitle
      },
 scales: {
               
                yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 1000,
                             },
                        scaleLabel: {
                            display: true,
                            labelString: employee
                        }
                    }]
            },
  }

  // This will get the first returned node in the jQuery collection.
  var attendacneChart = new Chart(recruitmentChartcanvas, { 
      type: 'bar', 
      data: recruitedChartdata, 
      options: recruitedChartoption
    }
  )


 /*  Absent 15 days start */

     var absenlastfftdaysChartcanvas = document.getElementById('bar-chart-absent').getContext('2d');
              var abslastfftdaysChartdata = {
    labels  : abslabel1,
    datasets: [
      {
          label            : absent,
           backgroundColor : "#85C1E9",
           data            : "dataPoints",
           pointBackgroundColor: "red",
           pointRadius     : 5,
          data             : absval1
      },
    ]
  }

               

  var abslastfftndaysChartoption = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
     title: {
        display: true,
        text: absenttitle
      },
scales: {
               
                yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 5,
                            max: 45 },
                        scaleLabel: {
                            display: true,
                            labelString: employee
                        }
                    }],
                     xAxes: [{
                     gridLines: {
                            display: false,
                            lineWidth: 0,
                                       },
                }]    
            },
  }

  // This will get the first returned node in the jQuery collection.
  var absen15dasysChart = new Chart(absenlastfftdaysChartcanvas, { 
      type: 'line', 
      data: abslastfftdaysChartdata, 
      options: abslastfftndaysChartoption
    }
  )

/*
  Loan Pie chart part */

     var pieChartcanvas = document.getElementById('piechart').getContext('2d');
              var pieChartdata = {
    labels  : [loanpaymenttitle,loanreceivettitle],
    datasets: [
      {
           backgroundColor : ["#2ecc71", "#F39C12"],
            data           : [total_loanpayment,total_loanreceived]
      },
    ]
  }

               

  var pieChartoption = {
       rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
        title: {
           display: true,
           text: paymentrecvtitle,
           position: 'bottom'
        }
  }

  // This will get the first returned node in the jQuery collection.
  var pieChart = new Chart(pieChartcanvas, { 
      type: 'doughnut', 
      data: pieChartdata, 
      options: pieChartoption
    }
  )


 /*  loan payment receive statistic current year */
   var loanstatisticChartCanvas = document.getElementById('bar-chart-loanyear').getContext('2d');
              var loanstatisticChartData = {
    labels  : month,
    datasets: [
      {
        label               : loanpaymenttitle,
        backgroundColor     : '#AAB7B8',
        data                : [0,0]
      },
      {
        label               : loanreceivettitle,
        backgroundColor     : '#3CB371',
        data                : [0,0]
      },
    ]
  }

               loanstatisticChartData.datasets[0].data = loanstatisticpayment;
               loanstatisticChartData.datasets[1].data = loanstatisticreceived;
 

  var loanstatisticChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : true,
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var loanstatisticChart = new Chart(loanstatisticChartCanvas, { 
      type: 'bar', 
      data: loanstatisticChartData, 
      options: loanstatisticChartOptions
    }
  )


 /*employee awarded current year*/ 
 var awardChartcanvas = document.getElementById('scatter').getContext('2d');
              var awardChartdata = {
    labels  : month,
    datasets: [
      {
          label          : awardedtitle,
          backgroundColor: "#E74C3C",
          fill           : false,
          pointRadius    : 5,
           pointStyle    : 'triangle',
          data           : awarded
      },
    ]
  }

  var awardChartoption = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
     title: {
        display: true,
        text: awardedcurrnttitle
      },
    scales: {
               
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                    steps: 1,
                    stepValue: 1,
                   },
                           
                scaleLabel: {
                    display: true,
                    labelString: employee
                        }
                    }],
            xAxes: [{
                gridLines: {
                    display: false,
                    lineWidth: 0,
                            },
                }]    
            },
              }

  // This will get the first returned node in the jQuery collection.
  var attendacneChart = new Chart(awardChartcanvas, { 
      type: 'line', 
      data: awardChartdata, 
      options: awardChartoption
    }
  )

   })