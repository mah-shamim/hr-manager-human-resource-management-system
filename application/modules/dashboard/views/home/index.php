
<div class="se-pre-con"></div>
<div class="row box-panel">
    
            <div class="">
                <div class="panel-heading">
                    <div class="panel-title">
                       
                    </div>
                </div>
            <div class="panel-body panel-body-new">
          <!-- Top Block Start -->

          <?php 

            $employee_id = $this->session->userdata['employee_id'];
            $isAdmin = $this->session->userdata['isAdmin'];
            $isLogin = $this->session->userdata['isLogIn'];

            if($isLogin && $isAdmin){ 

          ?>

          <div class="row">

                <!-- HRM Box for admin -->
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-green whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($ttle_empl)?$ttle_empl:0);?></span></h4>

                              <p><?php echo display('total_employee')?></p>

                              <div class="icon">
                                <i class="fa fa-users"></i>
                              </div>
                        </div>
                        <?php if($this->permission->method('employee','read')->access()){ ?>
                            <a href="<?php echo base_url('employee/employees/manageemployee') ?>" class="small-box-footer"><?php echo display('total_employee')?></a>
                        <?php }else{?>
                             <a href="javascript:void(0)" class="small-box-footer"><?php echo display('total_employee')?></a>
                        <?php }?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-pase whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($present_empl)?$present_empl:0);?></span></h4>

                              <p><?php echo display('todays_present')?></p>

                              <div class="icon">
                                <i class="fa fa-user-plus"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer"><?php echo display('todays_present')?></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-bringal whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php 
                            
                            $prandleave = (!empty($present_empl)?$present_empl:0) + (!empty($todys_leave)?$todys_leave:0);
                            echo $ttle_empl - $prandleave;
                            ?></span></h4>

                              <p><?php echo display('todays_absent')?></p>

                              <div class="icon">
                                <i class="fa fa-user-times"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer"><?php echo display('todays_absent')?></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-darkgreen whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($todys_leave)?$todys_leave:0);?></span></h4>

                              <p><?php echo display('todays_leave')?></p>

                              <div class="icon">
                                <i class="fa fa-user-o"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer"><?php echo display('todays_leave')?></a>
                    </div>
                </div>

                <!-- End of HRM Boxes for admin -->

                <!-- Top Block End -->

                <!-- Start of HRM Boxes for employee -->
            </div>

            <?php }else if($isLogin && $employee_id){?>

            <div class="row">

                <!-- HRM Box -->
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-green whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($employee_box_data['total'])?$employee_box_data['total']:0);?></span></h4>

                              <p>Total Points</p>

                              <div class="icon">
                                <i class="fa fa-users"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Total Points</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-pase whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($employee_box_data['attendence'])?$employee_box_data['attendence']:0);?></span></h4>

                              <p>Current Year Attendance</p>

                              <div class="icon">
                                <i class="fa fa-user-plus"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Attendance Points</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-bringal whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($employee_box_data['management'])?$employee_box_data['management']:0);?></span></h4>

                              <p>Current Year Management</p>

                              <div class="icon">
                                <i class="fa fa-user-times"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Management Points</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="small-box bg-darkgreen whitecolor">
                        <div class="inner">
                              <h4><span class="count-number"><?php echo (!empty($employee_box_data['collaborative'])?$employee_box_data['collaborative']:0);?></span></h4>

                              <p>Current Year Collaborative</p>

                              <div class="icon">
                                <i class="fa fa-user-o"></i>
                              </div>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Collaborative Points</a>
                    </div>
                </div>

                 <!-- End of HRM Boxes for employee -->

                <!-- Top Block End -->

                <!-- Second block start -->
            </div>

            <?php }?>

            <hr>

            <!-- New Design for chart report from 22nd November 2020 -->

            <?php

            if($isLogin && $isAdmin){

            ?>

            <div class="row">

                <div class="col-sm-12 col-md-5 attendance-chart">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-body">
                                <canvas id="bar-chart-attendance" class="chartcontent" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5 recruited-chart">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-body">
                               <canvas id="bar-chart-recruitment" class="chartcontent" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2 latest-notice">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('latest_notice')?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="divContinuedAbsent" >
                                 <?php foreach($notice as $notices){?>   
                                    <div class="leftdivcontent"><span data-empid="61"></span><a href="<?php echo base_url("noticeboard/Notice_controller/view_details/".$notices['notice_id']) ?>"><b><?php echo  $notices['notice_date'].' - '.$notices['notice_type'];?> </b></a></div>
                                <?php }?>
                                
                              
                              </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-12 col-md-5 absent-chart">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-body">
                                <canvas id="bar-chart-absent" class="chartcontent" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5 locan-payment-chart">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-body">
                                <canvas id="piechart" height="175"></canvas> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2 new-recruited">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('new_recruited_employee')?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="divContinuedAbsent" >
                                <?php foreach($latestrecruitedemple as $recruitempl){?>    
                                <div class="leftdivcontent"><span data-empid="61"></span><b><?php echo $recruitempl['first_name'].' '.$recruitempl['last_name']?> </b><br><span ><?php echo display('hire_date')?>: </span><b><?php echo $recruitempl['hire_date'];?></b></div>
                            <?php }?>
                           
                              </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                 <div class="col-sm-12 col-md-6 absent-chart">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-body">
                                <canvas id="bar-chart-loanyear" class="chartcontent" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 locan-payment-chart">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-body">
                                <canvas id="scatter"  class="chartcontent" height="220"></canvas> 
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Table to show used license/customer -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 absent-chart">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4><?php echo display('employee_point') ?></h4>
                                </div>
                            </div>

                            <div class="panel-body scroller">
                                <div class="table-responsive">
                                    <table  class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('cid') ?></th>
                                                <th><?php echo display('employee_name') ?></th>
                                                <th><?php echo display('attendence_point') ?></th>
                                                <th><?php echo display('collaborative_point') ?></th>
                                                <th><?php echo display('management_point') ?></th>
                                                <th><?php echo display('total')." ".display('point') ?></th>
                                                <th><?php echo display('date') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php if (!empty($employee_points)) { ?>
                                                <?php $sl = 1; ?>
                                                <?php foreach ($employee_points as $que) {
                                                    ?>
                                                    <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                                        <td><?php echo $sl; ?></td>
                                                        <td><?php echo $que->firstname.' '.$que->lastname; ?></td>  
                                                        <td><?php echo $que->attendence!=null?$que->attendence:0; ?></td>   
                                                        <td><?php echo $que->collaborative!=null?$que->collaborative:0; ?></td>
                                                        <td><?php echo $que->management!=null?$que->management:0; ?></td>
                                                        <td><?php echo $que->total; ?></td>
                                                        <td><?php echo date('F, Y', strtotime($que->date)); ?></td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                <?php } ?> 
                                            <?php } ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        <?php }else if($isLogin && $employee_id){ ?>
                
            <div class="row">
                <!-- Single Bar Chart -->
                <div class="col-sm-7 col-md-7 absent-chart">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Yearly Points</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <canvas id="singelBarChart" height="160"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-sm-5 col-md-5 absent-chart">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Last 30 Days Points Chart</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <canvas id="pieChart" height="235"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Line Chart -->
                <div class="col-sm-12 col-md-12 absent-chart">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Monthly Attendance</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <canvas id="lineChart" class="chartcontent" height="80"></canvas>
                        </div>
                    </div>
                </div>

            </div>
            
        <?php 
            }
        ?>

            <!-- End of New Design for chart report-->       

                     <!-- Forth part end -->
        </div>
    </div>
                           
                <input type="hidden" name="" id="attendancelabel" value="<?php echo $attendanclabel;?>">
                <input type="hidden" name="" id="attendancedata" value="<?php echo $attendancdata;?>"> 
                <input type="hidden" name="" id="month" value='<?php echo $month;?>'>
                <input type="hidden" name="" id="recruitedemp" value="<?php echo $recruitedemp;?>"> 
                <input type="hidden" name="" id="abdfftdaylabel" value="<?php echo $abdfftdaylabel;?>">
                <input type="hidden" name="" id="abdfftdayval" value="<?php echo $abdfftdayval?>"> 
                <input type="hidden" name="" id="loanpayemntamnt" value="<?php echo (!empty($lnamountpaid->amount)?$lnamountpaid->amount:1);?>">
                <input type="hidden" name="" id="loanreceivedamnt" value="<?php echo (!empty($lnamountpaid->amount)?$lnamountpaid->amount:1);?>">
                <input type="hidden" name="" id="loanstatisticpayment" value="<?php echo $loanstatisticpayment;?>">
                <input type="hidden" name="" id="loanstatisticreceived" value="<?php echo $loanstatisticreceived;?>">
                <input type="hidden" name="" id="awardedempl" value="<?php echo $awardedempl;?>">
                <input type="hidden" name="" id="presentitle" value="<?php echo display('attendance_last_30days')?>">
                <input type="hidden" name="" id="attendancetitle" value="<?php echo display('attendance')?>">
                <input type="hidden" name="" id="employeetitle" value="<?php echo display('employee')?>">
                <input type="hidden" name="" id="absenttitle" value="<?php echo display('absent_15days')?>">
                <input type="hidden" name="" id="absent" value="<?php echo display('absent')?>">
                <input type="hidden" name="" id="recruitedtitle" value="<?php echo display('recruited')?>">
                <input type="hidden" name="" id="recruitedyeartitle" value="<?php echo display('recruited_current_year')?>">
                <input type="hidden" name="" id="loanpaymenttitle" value="<?php echo display('loanpayment')?>">
                <input type="hidden" name="" id="loanreceivettitle" value="<?php echo display('loanreceive')?>">
                <input type="hidden" name="" id="paymentrecvtitle" value="<?php echo display('loanpayment').' '.display('loanreceive')?>">
                <input type="hidden" name="" id="awardedtitle" value="<?php echo display('awarded')?>">
                <input type="hidden" name="" id="awardedcurrnttitle" value="<?php echo display('awarded').' '.display('current_year')?>">
                </div>
            
     

    
        <script src="<?php echo base_url('assets/plugins/counterup/chart.min.js') ?>" type="text/javascript"></script>

        <?php if($isLogin && $isAdmin){?>
        <script src="<?php echo base_url('assets/js/dashboardchart.js') ?>" type="text/javascript"></script>
        <?php }?>

        <?php if($isLogin && $employee_id){?>
        <script src="<?php echo base_url('assets/js/employee-dashboardchart.js') ?>" type="text/javascript"></script>
        <?php }?>
 


