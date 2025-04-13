<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/attendance.css" />
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                  <div class="panel-heading" >
                    <div class="panel-title">
                        <h4><?php echo display('monthly_absent') ?></h4>
                        <span id="almsg"></span>
                    </div>
                </div>
                    <div class="panel-body">
                        <?php echo  form_open('reports/attendance_report/monthly_absent','id="form"') ?>
                        <form name="form" id="form" action="<?php echo base_url('reports/attendance_report/monthly_absent')?>" method="post" enctype="multipart/form-data">
                           <div class="form-group row">
                         
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('emp_id') ?> *</label>
                            <div class="col-sm-4">
                              <?php echo form_dropdown('employee_id',$dropdownemp,(!empty($employee_id)?$employee_id:''),'class="form-control" id="employee_id" ') ?>
                            </div>
                        </div> 
                          <div class="form-group row">
                          <label for="department" class="col-sm-3 col-form-label"><?php echo display('department')?>*</label>
                          <div class="col-sm-4">
                           <?php echo form_dropdown('department_id', $departments, $department_id, ' class="form-control" id="department_id"') ?>
                          </div>
                          

                        </div>

                         <div class="form-group row">
                          <label for="year" class="col-sm-3 col-form-label"><?php echo display('year')?>*</label>
                          <div class="col-sm-4">
                            <select name="year" class="form-control" id="year">
                              <option value="">Select Year</option>
                              <option value="2019" <?php if($year == '2019'){echo 'selected';}?>>2019</option>
                              <option value="2020" <?php if($year == '2020'){echo 'selected';}?>>2020</option>
                              <option value="2021" <?php if($year == '2021'){echo 'selected';}?>>2021</option>
                              <option value="2022" <?php if($year == '2022'){echo 'selected';}?>>2022</option>
                              <option value="2023" <?php if($year == '2023'){echo 'selected';}?>>2023</option>
                              <option value="2024" <?php if($year == '2024'){echo 'selected';}?>>2024</option>
                              <option value="2025" <?php if($year == '2025'){echo 'selected';}?>>2025</option>
                              <option value="2026" <?php if($year == '2026'){echo 'selected';}?>>2026</option>
                              <option value="2027" <?php if($year == '2027'){echo 'selected';}?>>2027</option>
                              <option value="2028" <?php if($year == '2028'){echo 'selected';}?>>2028</option>
                              <option value="2029" <?php if($year == '2029'){echo 'selected';}?>>2029</option>
                              <option value="2030" <?php if($year == '2030'){echo 'selected';}?>>2030</option>
                            </select>
                          </div>

                        </div>

                         <div class="form-group row">
                          <label for="month" class="col-sm-3 col-form-label"><?php echo display('month')?>*</label>
                          <div class="col-sm-4">
                            <select name="month" class="form-control" id="month">
                              <option value="">Select Month</option>
                              <option value="01" <?php if($month == '01'){echo 'selected';}?>>January</option>
                              <option value="02" <?php if($month == '02'){echo 'selected';}?>>February</option>
                              <option value="03" <?php if($month == '03'){echo 'selected';}?>>March</option>
                              <option value="04" <?php if($month == '04'){echo 'selected';}?>>April</option>
                              <option value="05" <?php if($month == '05'){echo 'selected';}?>>May</option>
                              <option value="06" <?php if($month == '06'){echo 'selected';}?>>June</option>
                              <option value="07" <?php if($month == '07'){echo 'selected';}?>>July</option>
                              <option value="08" <?php if($month == '08'){echo 'selected';}?>>August</option>
                              <option value="09" <?php if($month == '09'){echo 'selected';}?>>September</option>
                              <option value="10" <?php if($month == '10'){echo 'selected';}?>>October</option>
                              <option value="11" <?php if($month == '11'){echo 'selected';}?>>November</option>
                              <option value="12" <?php if($month == '12'){echo 'selected';}?>>December</option>
                            </select>
                          </div>

                        </div>

                     <div class="form-group row">
                          <div class="col-sm-8 text-center">
                            <button type="button" onclick="checkfieldsMonthlyattrep()" class="btn btn-success w-md m-b-5"><?php echo display('search') ?></button>
                        </div>
                     </div>
                         <?php echo form_close() ?>

                    </div>
                </div>

            </div>
        </div>

  
<?php if($issearch){?>
  <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel ">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <span class="text-left"><?php $m = $year.'-'.$month.'-'.'01';
                       $yrdata= strtotime($m);
                        echo date('F Y', $yrdata);
                         ?></span> <span class="text-right"><input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/></span>
                    </div>
                </div>
                <div class="panel-body" id="printArea">
                  <table class="table table-responsive table-hover">
                    <thead class="tableheads">
                      <tr>
                        <th class="text-center">sl</th>
                        <th class="text-center">Employee Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Status</th>

                      </tr>
                    </thead>
                    <tbody>
                        <?php
                         foreach ($results as $data) {
                        $daily_abasent  = $this->attendance_model->daily_absent_data($department_id,$data);
                        $checkweekend = $this->attendance_model->find_weekend($data);
                        ?>
                        <tr><td colspan="6" class="text-center"><h2><?php echo $data;?></h2></td></tr>
                        <?php if($checkweekend < 1){
                            $sl = 1;
                            foreach ($daily_abasent as $result) {
                           
                            ?>
                      <tr>
                        <td class="text-center"><?php echo $sl;?></td>
                        <td class="text-center"><?php echo $result['employee_id'];?></td>
                        <td class="text-center"><?php echo $result['first_name'].' '.$result['last_name'];?></td>
                        <td class="text-center"><?php echo $result['department_name'];?></td>
                        <td class="text-center"><?php  echo  $data;?></td>
                        <td class="text-center"><?php echo 'Absent';?></td>

                      </tr>
                      <?php $sl++;}}else{?>
                        <tr><td colspan="6" class="text-center"><h2><?php echo 'The day was Weekend !!';?></h2></td></tr>
                      <?php }}?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php }?>
  
   <script src="<?php echo base_url('assets/js/attendance.js') ?>" type="text/javascript"></script>
