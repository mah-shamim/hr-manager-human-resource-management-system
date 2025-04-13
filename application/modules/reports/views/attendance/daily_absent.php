
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">

                    <div class="panel-heading">
                      <div class="panel-title">
                          <h4>
                            <?php echo display('daily_absent')?>
                          </h4>
                      </div>
                    </div>

                    <div class="panel-body">
                        <?php echo  form_open('reports/attendance_report/daily_absent') ?>
                             <div class="form-group row">
                          <label for="department" class="col-sm-2 col-form-label"><?php echo display('department')?>*</label>
                          <div class="col-sm-3">
                           <?php echo form_dropdown('department_id', $departments, $department_id, ' class="form-control"') ?>
                          </div>
                          

                        </div>
                            <div class="form-group row">
                          <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?>*</label>
                          <div class="col-sm-3">
                            <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Select Date" value="<?php echo (!empty($date)?$date:'');?>" autocomplete="off">
                          </div>
                        </div>
                     
                     <div class="form-group row">
                          <div class="col-sm-6 text-center">
                            <button type="submit"  class="btn btn-success w-md m-b-5"><?php echo display('search') ?></button>
                        </div>
                     </div>
                         <?php echo form_close() ?>

                    </div>
                </div>

            </div>
        </div>
<?php


 if($issearch){
  $checkweekend = $this->attendance_model->find_weekend($date);

  if($checkweekend < 1){
  ?>
     <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel ">
                <div class="panel-heading" >
                    <div class="panel-title">
                        <span class="text-left"><?php echo display('daily_absent') ?></span> <span class="text-right"><input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/></span>
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
                        <?php if(empty($results)){?>
                            <tr><td colspan="8" class="text-center"> No Result Found </td></tr>
                        <?php }else{
                            $sl = 1;
                            foreach ($results as $result) {
                           
                            ?>
                      <tr>
                        <td class="text-center"><?php echo $sl;?></td>
                        <td class="text-center"><?php echo $result['employee_id'];?></td>
                        <td class="text-center"><?php echo $result['first_name'].' '.$result['last_name'];?></td>
                        <td class="text-center"><?php echo $result['department_name'];?></td>
                        <td class="text-center"><?php  echo  $date;?></td>
                        <td class="text-center"><?php echo 'Absent';?></td>

                      </tr>
                      <?php $sl++;}}?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php }else{?>

<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                       <h1 class="text-center">The day was Weekend !! Please Search Another days </h1>
                    </div>
                </div>

            </div>
        </div>

<?php }}?>