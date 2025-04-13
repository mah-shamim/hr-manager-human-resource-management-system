<style type="text/css">
   
    #ui-datepicker-div{
            
    top: 317px;
    left: 1081.75px;
    display: block;
    width: 180px;
      z-index: 1;
    }
     .ui-datepicker-calendar { display: none; }
     .ui-datepicker-title{
        width: 100%;
        float: center;
     }
    
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>


        <!-- Start Theme Layout Style
        =====================================================================-->
        <!-- Theme style -->
       <div class="se-pre-con"></div>

                    
                       <?php 
if(isset($_POST['btnSearch']))
{
   $yr = $_POST['year'];
}
 $yearss =(!empty($yr)?$yr:date('Y'));

?>     
                    
                 <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="panel cardbox bg-primary">
                                    <div class="panel-body card-item panel-refresh">
                                        <a class="refresh" href="#">
                                            <span class="fa fa-refresh"></span>
                                        </a> 
                                        <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
                                        <div class="timer"><span class="count-number"><?php 
            
                    echo $emp->employee_id;
             
                 ?></span></div>
                                        <div class="cardbox-icon">
                                            <i class="material-icons">people</i>
                                        </div>
                                        <div class="card-details">
                                            <h4><?php echo display('total_employee')?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="panel cardbox bg-warning">
                                    <div class="panel-body card-item panel-refresh">
                                        <a class="refresh2" href="#">
                                            <span class="fa fa-refresh"></span>
                                        </a> 
                                        <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
                                        <div class="timer"><span class="count-number"><?php  echo  $atn; ?></span></div>
                                        <div class="cardbox-icon">
                                            <i class="material-icons">perm_contact_calendar</i>
                                        </div>
                                        <div class="card-details">
                                            <h4><?php echo display('present_employee')?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="panel cardbox bg-success">
                                    <div class="panel-body card-item panel-refresh">
                                        <a class="refresh" href="#">
                                            <span class="fa fa-refresh"></span>
                                        </a> 
                                        <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
                                        <div class="timer"><span class="count-number"><?php  echo $atnworkhour['hours'];?></span> : <span class="count-number"><?php  echo $atnworkhour['minutes'];?></span> : <span class="count-number"><?php  echo $atnworkhour['sec'];?></span></div>
                                        <div class="cardbox-icon">
                                          <i class="material-icons">schedule</i>
                                        </div>
                                        <div class="card-details">
                                            <h4><?php echo display('today_worked_hour')?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="panel cardbox bg-dark">
                                    <div class="panel-body card-item panel-refresh">
                                        <a class="refresh" href="#">
                                            <span class="fa fa-refresh"></span>
                                        </a> 
                                        <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
                                        <div class="timer"><span class="count-number"><?php echo $leave_total; ?></span></div>
                                        <div class="cardbox-icon">
                                           <i class="material-icons">attach_money</i>
                                        </div>
                                        <div class="card-details">
                                            <h4><?php echo display('todays_leave')?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./counter Number --> 
                             </div>

                             <div class="row">
                                
                                  <div class="col-sm-6 col-md-6">
                    <div class="panel panel-bd">
                    
                        <div class="panel-body">
                           <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                 <div class="col-sm-6 col-md-6">
                    <div class="panel">
                     <div class="panel-heading" >
                    <div class="panel-title">
                        <div class="form-group row">
                            <div class="col-sm-6" >
                               <h4 style="color:#607D8B"><?php echo display('income_expense').' -'.$year;?></h4>
                            </div>
                             <form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">
                        <div class="col-sm-4" style="margin-right: 0px;padding-right: 0px;">
                            
                                  <input type="text" class="form-control" id="yearpicker" name="year" value="<?php echo $yearss;?>"></div>
                                  <div class="col-sm-2" style="margin-left: 0px;padding-left: 0px;">
                                  <button type="submit" name="btnSearch" class="btn" style="background-color: #D7CCC8;color:#fff"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                                </div>
                    </div>
                </div>
                        <div class="panel-body" style="height: 260px; width: 100%;">
                          
                        
                         <canvas id="profitlosschart" width="800" height="380"></canvas>
                          
                        </div>
                    </div>
                </div><!-- Calender -->
                             
                              </div>

            <div class="row">
                <!-- Radar Chart -->
                <div class="col-sm-12 col-md-6">
                    <div class="panel panel-bd lobidisable">
                    
                        <div class="panel-body">
                            <div class="calendar"><?php echo $notes?></div>
                        </div>
                    </div>
                </div><!-- Calender -->
                
                <div class="col-sm-12 col-md-6">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-body" style="padding-top: 0px">
                            <h4 class="text-center"><span class="s_date" style="padding-left: 10px;color:#607D8B;font-family:serif;"><?php echo display('details')?> <?php echo "$day $month $year";?></span></h4>
                             <h4 style="color: #78909C;font-family:serif;"><b><?php echo display('attendance')?> <?= display('department_wise')?></b></h4>
                            <div class="attendence">
                               <div class="table-responsive">
                                       <div class="detail_event">

                <?php 
                    if(isset($events)){
                        $i = 1;
                        foreach($events as $e){
                         if($i % 2 == 0){
                                echo '<div class="info2"><table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Department</th>
                                                
                                                <th>Attent Employees</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>'.$e['department_name'].'</td>
                                               
                                                <td>'.$e['att_id'].'</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>';
                            }else{
                                echo '<div class="info2"><table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>'.display("department").'</th>
                                                
                                                <th>'.display("attend_employee").'</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>'.$e['department_name'].'</td>
                                               
                                                <td>'.$e['att_id'].'</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>';
                            } 
                            $i++;
                        }
                    }else{
                        echo '<div class="message"><h4>No Result</h4><p>There\'s no result in this date</p></div>';
                    }
                ?>
                
                <!-- <input type="button" name="add" value="Add Event" val="<?php echo $day;?>" class="add_event"/> -->
            </div>
                                </div>
                            </div>
                            <h4 style="color: #78909C;font-family:serif;"><b><?= display('todays_notice')?></b></h4>
                            <div class="transaction">
                               <div class="table-responsive">
                                     <div class="detail_notice">
            
                <?php 
                    if(isset($notice)){
                        $i = 1;
                        foreach($notice as $e){
                         if($i % 2 == 0){
                            $f="/";
                                echo '<div class="info3"><a href="home/view_details'.                                $f.''.$e['id'].'" class="view" target="blank"><h3><i class="fa fa-eye"></i></h3></a><p>Notice For:'.$e['notice_type'].'</p><p>Notice By:'.$e['notice_by'].'</p></a>
                          
                                </div>';
                            }else{
                                $f="/";
                                echo '<div class="info3">
                                <a href="home/view_details'.                                $f.''.$e['id'].'" class="view" target="blank"><h3><i class="fa fa-eye"></i></h3></a>
                                <p>Notice For:'.$e['notice_type'].'</p><p>Notice By:'.$e['notice_by'].'</p></a></div>';

                            } 
                            $i++;
                        }
                    }else{
                        echo '<div class="message"><h4>No Result</h4><p>There\'s no result in this date</p></div>';
                    }
                ?>
                <!-- <input type="button" name="add" value="Add Event" val="<?php echo $day;?>" class="add_event"/> -->
            </div>
                                </div>
                            </div>
                            <h4 style="color: #78909C;font-family:serif;"><b><?= display('loan_payment')?></b></h4>
                            <div class="payment">
                               <div class="detail_loan">
            
                <?php 
                    if(isset($loans)){
                        $i = 1;
                        foreach($loans as $e){
                         if($i % 2 == 0){
                                echo '<div class="info6">
                                <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>'.display("employee_name").'</th>
                                                <th>'.display("loan_amount").'</th>
                                                <th>'.display("details").' </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>'.$e['first_name'].'  '.$e['last_name'].'</td>
                                                <td>'.$e['amount'].'</td>
                                                <td>'.$e['loan_details'].'</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table></div>';
                            }else{
                                echo '<div class="info6"><table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>'.display("employee_name").'</th>
                                                <th>'.display("loan_amount").'</th>
                                                <th>'.display("details").' </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>'.$e['first_name'].'  '.$e['last_name'].'</td>
                                                <td>'.$e['amount'].'</td>
                                                <td>'.$e['loan_details'].'</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table></div>';
                            } 
                            $i++;
                        }
                    }else{
                        echo '<div class="message"><h4>No Result</h4><p>There\'s no result in this date</p></div>';
                    }
                ?>
                <!-- <input type="button" name="add" value="Add Event" val="<?php echo $day;?>" class="add_event"/> -->
            </div>
                                </div>
                                <h4 style="color: #78909C;font-family:serif;"><b><?= display('loan')?></b></h4>
                                <div class="payment">
                                     <div class="detail_leave">
            
                <?php 
                    if(isset($leave)){
                        $i = 1;
                        foreach($leave as $e){
                         if($i % 2 == 0){
                                echo '<div class="info5"><table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>'.display("employee_name").'</th>
                                                <th>'.display("leave_day").'</th>
                                                <th>'.display("leave_finish").'</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>'.$e['first_name'].'  '.$e['last_name'].'</td>
                                                <td>'.$e['num_aprv_day'].'</td>
                                                <td>'.$e['leave_aprv_end_date'].'</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table></div>';
                            }else{
                                echo '<div class="info5"><table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>'.display("employee_name").'</th>
                                                <th>'.display("leave_day").'</th>
                                                <th>'.display("leave_finish").'</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>'.$e['first_name'].'  '.$e['last_name'].'</td>
                                                <td>'.$e['num_aprv_day'].'</td>
                                                <td>'.$e['leave_aprv_end_date'].'</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table></div>';
                            } 
                            $i++;
                        }
                    }else{
                        echo '<div class="message"><h4>No Result</h4><p>There\'s no result in this date</p></div>';
                    }
                ?>
                <!-- <input type="button" name="add" value="Add Event" val="<?php echo $day;?>" class="add_event"/> -->
            </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>


                    
                </div>
     
        <!-- Start Page Lavel Plugins
        =====================================================================-->
        <!-- Counter js --> 
        <script src="<?php echo base_url('assets/plugins/counterup/waypoints.js') ?>" type="text/javascript"></script>

       <script src="<?php echo base_url('assets/plugins/counterup/jquery.counterup.min.js') ?>" type="text/javascript"></script>
       <script src="<?php echo base_url('assets/plugins/sparkline/sparkline.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/plugins/counterup/canvasjs.min.js') ?>" type="text/javascript"></script>
        <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
         <script src="<?php echo base_url('assets/plugins/counterup/chart.min.js') ?>" type="text/javascript"></script>
        <!-- Sparklines js -->
        <script language="javascript"> 
   $(function() {
    $('#yearpicker').datepicker({
        changeYear: true,
        showButtonPanel: false,
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    });
    $("#yearpicker").focus(function () {
        $(".ui-datepicker-month").hide();
         $(".ui-datepicker-next").hide();
        $(".ui-datepicker-prev").hide();
    });
});
</script>
        <script>

  window.onload = function() {
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
        text: "Today's Employee Overview",
         fontColor: "#607D8B",
         fontSize:15,
         fontFamily:'serif',
    },
   
    data: [{
        type: "pie",
        startAngle: 240,
        yValueFormatString: "##0.00\"\"",
        indexLabel: "{name} - {y}",
        dataPoints: [
            { y: "<?php  echo  $atn; ?>", name: "<?= display('present_employee')?>",color:"#C8E6C9"},
            { y: "<?php echo $abs = $emp->employee_id -($leave_total+$atn);?>", name: "<?= display('absent_employee')?>",color:"#FFC0CB"},
            { y: <?php  echo (!empty($emp->employee_id)?$emp->employee_id:1); ?>, name: "<?= display('total_employee')?>",color:"#C0C0C0" },
            { y: "<?php echo $leave_total;?>", name: "<?= display('leave_employee')?>",color:"#FFE0B2" }
        ]
    }]
});
chart.render();

}




</script>

    <script type="text/javascript">
        var incomeexpense = new Chart(document.getElementById("profitlosschart"), {
   type: 'line',
   data: {
      labels: [<?php
                    for ($i=1; $i <= 12; $i++) {
                        if ($i==1) {
                            echo '"January",';
                        }elseif ($i==2) {
                            echo '"February",';
                        }elseif ($i==3) {
                            echo '"March",';
                        }elseif ($i==4) {
                            echo '"April",';
                        }elseif ($i==5) {
                            echo '"May",';
                        }elseif ($i==6) {
                           echo '"June",';
                        }elseif ($i==7) {
                           echo '"July",';
                        }elseif ($i==8) {
                           echo '"August",';
                        }elseif ($i==9) {
                           echo '"September",';
                        }elseif ($i==10) {
                           echo '"October",';
                        }elseif ($i==11) {
                           echo '"November",';
                        }elseif ($i==12) {
                           echo '"December"';
                        }
                    }
                ?>],
      datasets: [{
         data: [<?php
                            for ($i=1; $i <= 12; $i++) {
                               $income = $this->home_model->monthlyincome($yearss,$i);
                               if (!empty($income)) {
                                    echo $income.",";
                               }else{
                                echo ",";
                               }
                            }
                        ?>],
         label: "Income",
         borderColor: "#0F870F",
         fill: false
      }, {
         data: [<?php
                        for ($i=1; $i <= 12; $i++) {
                               $expenses = $this->home_model->monthlyexpense($yearss,$i);
                               if (!empty($expenses)) {
                                    echo $expenses.",";
                               }else{
                                echo ",";
                               }
                            }
                        ?>],
         label: "Expense",
         borderColor: "#E67E22",
         fill: false
      }]
   },
  options: {
    legend: {
      
      onHover: function(event, legendItem) {
        document.getElementById("profitlosschart").style.cursor = 'pointer';
      }
    },
    tooltips: {
      mode: 'label',
    },
    hover: {
      onHover: function(e, el) {
        $("#profitlosschart").css("cursor", el[0] ? "pointer" : "default");
      }
    }
  }
});

    </script>

       
        <script>
            $(document).ready(function () {

                "use strict"; // Start of use strict

                //counter
                $('.count-number').counterUp({
                    delay: 10,
                    time: 5000
                });

                //Sparklines Charts
                $('.sparkline1').sparkline([4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 7, 4, 3, 1], {
                    type: 'bar',
                    barColor: '#37a000',
                    height: '30',
                    barWidth: '8',
                    barSpacing: 1
                });
                $(".sparkline2").sparkline([-8, 2, 4, 3, 5, 4, 3, 5, 5, 6, 3, 9, 7, 3, 5, 6, 9, 5, 6, 7, 2, 3, 9, 6, 6, 7, 8, 10, 15, 16, 17, 15], {
                    type: 'line',
                    height: '30',
                    width: '100%',
                    lineColor: '#37a000',
                    fillColor: '#fff'
                });
                $(".sparkline3").sparkline([2, 5, 3, 7, 5, 10, 3, 6, 5, 7], {
                    type: 'line',
                    height: '30',
                    width: '100%',
                    lineColor: '#37a000',
                    fillColor: '#fff'
                });
                $(".sparkline4").sparkline([10, 34, 13, 33, 35, 24, 32, 24, 52, 35], {
                    type: 'line',
                    height: '30',
                    width: '100%',
                    lineColor: '#37a000',
                    fillColor: 'rgba(55, 160, 0, 0.7)'
                });
                $("#sparkline5").sparkline([34, 43, 43, 35, 44, 32, 44, 52, 25], {
                    type: 'line',
                    lineColor: '#37a000',
                    fillColor: '#37a000',
                    width: '150',
                    height: '20'
                });
                $("#sparkline6").sparkline([5, 6, 7, 2, 0, -4, -2, 4], {
                    type: 'bar',
                    barColor: '#37a000',
                    negBarColor: '#c6c6c6',
                    width: '150',
                    height: '20'
                });
                $("#sparkline7").sparkline([10, 2], {
                    type: 'pie',
                    sliceColors: ['#37a000', '#ffffff'],
                    width: '150',
                    height: '20'
                });
                $("#sparkline8").sparkline([34, 43, 43, 35, 44, 32, 15, 22, 46, 33, 86, 54, 73, 53, 12, 53, 23, 65, 23, 63, 53, 42, 34, 56, 76, 15, 54, 23, 44], {
                    type: 'line',
                    lineColor: '#37a000',
                    fillColor: '#37a000',
                    width: '150',
                    height: '20'
                });
                $("#sparkline9").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
                    type: 'tristate',
                    posBarColor: '#37a000',
                    negBarColor: '#ffffff',
                    width: '150',
                    height: '20'
                });
                $("#sparkline10").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7], {
                    type: 'discrete',
                    lineColor: '#37a000',
                    width: '150',
                    height: '20'
                });
                
                
                //panel refresh
                $.fn.refreshMe = function (opts) {
                    var $this = this,
                            defaults = {
                                ms: 1500,
                                started: function () {},
                                completed: function () {}
                            },
                            settings = $.extend(defaults, opts);

                    var panelToRefresh = $this.parents('.panel').find('.refresh-container');
                    var dataToRefresh = $this.parents('.panel').find('.refresh-data');
                    var ms = settings.ms;
                    var started = settings.started;     //function before timeout
                    var completed = settings.completed; //function after timeout

                    $this.click(function () {
                        $this.addClass("fa-spin");
                        panelToRefresh.show();
                        started(dataToRefresh);
                        setTimeout(function () {
                            completed(dataToRefresh);
                            panelToRefresh.fadeOut(800);
                            $this.removeClass("fa-spin");
                        }, ms);
                        return false;
                    });
                };

                $(document).ready(function () {
                    $('.refresh, .refresh2').refreshMe({
                        started: function (ele) {
                            ele.html("Getting new data..");
                        },
                        completed: function (ele) {
                            ele.html("This is the new data after refresh..");
                        }
                    });
                });
                
            
            $('.event_inner').slimScroll({
                size: '3px',
                height: '440px',
                allowPageScroll: true,
                railVisible: true
            });
            
            $('.attendence, .notice, .payment, .transaction').slimScroll({
                size: '3px',
                height: '80px',
                allowPageScroll: true,
                railVisible: true
            });

            });
        </script>
        <script>
       
        $(".detail").live('click',function(){
            $(".s_date").html("Details of "+$(this).attr('val')+" <?php echo "$month $year";?>");
            var day = $(this).attr('val');
            var add = '<input type="hidden" name="add" value="Add New" val="'+day+'" class="add_event"/>';
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?php echo site_url("dashboard/home/detail_event");?>",
                data:{<?php echo "year: $year, mon: $mon";?>, day: day},
                success: function( data ) {
                    var html = '';
                    if(data.status){
                        var i = 1;
                        $.each(data.data, function(index, value) {
                            if(i % 2 == 0){
                                html = html+'<div class="info2"><table class="table table-bordered"><thead><tr><th>Department Name</th><th>Attent Employees</th></tr></thead><tbody><tr><td>'+value.department_name+'</td><td>'+value.att_id+'</td></tr></tbody></table></div>';
                            }
                            else{
                                html = html+'<div class="info2"><table class="table table-bordered"><thead><tr><th>Department Name</th><th>Attent Employees</th></tr></thead><tbody><tr><td>'+value.department_name+'</td><td>'+value.att_id+'</td></tr></tbody></table></div>';
                            } 
                            i++;
                        });
                    }else{
                        html = '<div class="message"><h4>'+data.title_msg+'</h4><p>'+data.msg+'</p></div>';
                    }
                    html = html+add;
                    $( ".detail_event" ).fadeOut("slow").fadeIn("slow").html(html);
                } 
            });
            
        });
        
$(".detail").live('click',function(){
            $(".s_date").html(" Details of "+$(this).attr('val')+" <?php echo "$month $year";?>");
            var day = $(this).attr('val');
            var add = '<input type="hidden" name="add" value="Add New" val="'+day+'" class="add_event"/>';
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?php echo site_url("dashboard/home/detail_notice");?>",
                data:{<?php echo "year: $year, mon: $mon";?>, day: day},
                success: function( data ) {
                    var html = '';
                    if(data.status){
                        var i = 1;
                        $.each(data.data, function(index, value) {
                            if(i % 2 == 0){
                                html = html+'<div class="info3"><a href="home/view_details/'+value.id+'" class="view" target="blank"><h3><i class="fa fa-eye"></i></h2></a><h4>Notice:'+value.notice_type+'</h3><p>Notice By:'+value.notice_by+'</p></div>';
                            }
                            else{
                                html = html+'<div class="info4"><a href="home/view_details/'+value.id+'" class="view" target="blank"><h3><i class="fa fa-eye"></i></h3></a><h4>Notice:'+value.notice_type+'</h4><p>Notice By:'+value.notice_by+'</p></div>';
                            } 
                            i++;
                        });
                    }else{
                        html = '<div class="message"><h4>'+data.title_msg+'</h4><p>'+data.msg+'</p></div>';
                    }
                    html = html+add;
                    $( ".detail_notice" ).fadeOut("slow").fadeIn("slow").html(html);
                } 
            });
            
        });
        
        $(".detail").live('click',function(){
            $(".s_date").html(" Details of "+$(this).attr('val')+" <?php echo "$month $year";?>");
            var day = $(this).attr('val');
            var add = '<input type="hidden" name="add" value="Add New" val="'+day+'" class="add_event"/>';
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?php echo site_url("dashboard/home/detail_leave");?>",
                data:{<?php echo "year: $year, mon: $mon";?>, day: day},
                success: function( data ) {
                    var html = '';
                    if(data.status){
                        var i = 1;
                        $.each(data.data, function(index, value) {
                            if(i % 2 == 0){
                                html = html+'<div class="info5"><table class="table table-bordered"><thead><tr><th>Employee Name</th><th>Leave Day</th><th>Leave finish</th></tr></thead><tbody><tr><td>'+value.first_name+' '+value.last_name+'</td><td>'+value.num_aprv_day+'</td><td>'+value.leave_aprv_end_date+'</td></tr></tbody></table></div>';
                            }
                            else{
                                html = html+'<div class="info5"><table class="table table-bordered"><thead><tr><th>Employee Name</th><th>Leave Day</th><th>Leave finish</th></tr></thead><tbody><tr><td>'+value.first_name+' '+value.last_name+'</td><td>'+value.num_aprv_day+'</td><td>'+value.leave_aprv_end_date+'</td></tr></tbody></table></div>';
                            } 
                            i++;
                        });
                    }else{
                        html = '<div class="message"><h4>'+data.title_msg+'</h4><p>'+data.msg+'</p></div>';
                    }
                    html = html+add;
                    $( ".detail_leave" ).fadeOut("slow").fadeIn("slow").html(html);
                } 
            });
            
        });

        $(".detail").live('click',function(){
            $(".s_date").html(" Details of "+$(this).attr('val')+" <?php echo "$month $year";?>");
            var day = $(this).attr('val');
            var add = '<input type="hidden" name="add" value="Add New" val="'+day+'" class="add_event"/>';
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?php echo site_url("dashboard/home/detail_loan");?>",
                data:{<?php echo "year: $year, mon: $mon";?>, day: day},
                success: function( data ) {
                    var html = '';
                    if(data.status){
                        var i = 1;
                        $.each(data.data, function(index, value) {
                            if(i % 2 == 0){
                                html = html+'<div class="info6"><table class="table table-bordered"><thead><tr><th>Employee Name</th><th>Loan Amount</th><th>Details</th></tr></thead><tbody><tr><td>'+value.first_name+' '+value.last_name+'</td><td>'+value.amount+'</td><td>'+value.loan_details+'</td></tr></tbody></table></div>';
                            }
                            else{
                                html = html+'<div class="info6"><table class="table table-bordered"><thead><tr><th>Employee Name</th><th>Loan Amount</th><th>Details</th></tr></thead><tbody><tr><td>'+value.first_name+' '+value.last_name+'</td><td>'+value.amount+'</td><td>'+value.loan_details+'</td></tr></tbody></table></div>';
                            } 
                            i++;
                        });
                    }else{
                        html = '<div class="message"><h4>'+data.title_msg+'</h4><p>'+data.msg+'</p></div>';
                    }
                    html = html+add;
                    $( ".detail_loan" ).fadeOut("slow").fadeIn("slow").html(html);
                } 
            });
            
        });
</script>
 