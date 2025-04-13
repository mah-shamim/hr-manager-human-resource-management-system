 <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/payroll.css" />




<div class="row">
  <!--  table area -->
  <div class="col-sm-12">
    
    <div class="panel panel-bd"> 

       <div class="panel-heading panel-aligner" >
          <div class="panel-title">
              <h4><?php echo display('attendance') ?></h4>
          </div>
          <div class="mr-25">

            <?php if($this->permission->method('payroll','create')->access()): ?>
            <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
             <?php echo display('add_salary_setup') ?></button> 
           <?php endif; ?>
           <?php if($this->permission->method('payroll','read')->access()): ?>
           <a href="<?php echo base_url();?>/payroll/Payroll/salary_setup_view" class="btn btn-primary"><?php echo display('manage_salary_setup') ?></a>
          <?php endif; ?>


          </div>

      </div>

      <div class="panel-body">
        <table width="100%" class="datatable table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th><?php echo display('cid') ?></th>
              <th><?php echo display('employee_name') ?></th>
              <th><?php echo display('designation') ?></th>
              <th><?php echo display('division') ?></th>
              <th><?php echo display('sal_type') ?></th>
              <th><?php echo display('basic') ?></th>
              <th><?php echo display('gross_salary') ?></th>
              <th><?php echo display('date') ?></th>

            </tr>
          </thead>
          <tbody>
            <?php if (!empty($emp_sl_setup)) { ?>
              <?php $sl = 1; ?>
              <?php foreach ($emp_sl_setup as $que) { ?>
                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                  <td><?php echo $sl; ?></td>
                  <td><?php echo $que->first_name.' '.$que->last_name; ?></td>
                  <td><?php echo $que->position_name; ?></td>
                  <td><?php echo $que->department_name; ?></td>
                  <td><?php if($que->rate_type == 1){
              echo 'Hourly';
          }else{
            echo 'Salary';
        }?></td>
                  <td><?php echo $que->rate; ?></td>
                  <td><?php echo $que->gross_salary; ?></td>
                  <td><?php echo $que->create_date; ?></td>
                </tr>
                <?php $sl++; ?>
              <?php } ?> 
            <?php } ?> 
          </tbody>
        </table>  <!-- /.table-responsive -->
      </div>
    </div>
  </div>
  <div id="add0" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('salary_setup')?></strong>
      </div>
      <div class="modal-body">


        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">

              <div class="panel-body">

                <?php echo  form_open('payroll/Payroll/create_s_setup') ?>
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                  <div class="col-sm-9">
                   <?php echo form_dropdown('employee_id',$employee,null,'class="form-control" id="employee_id" onchange="employeeSetup(this.value)"') ?>
                 </div>
               </div>

               <div class="form-group row">
                  <label for="payment_period" class="col-sm-3 col-form-label"><?php echo display('salary_type_id') ?> *</label>
                  <div class="col-sm-9">
                   <input type="text" class="form-control" name="sal_type_name" id="sal_type_name" readonly="">
                   <input type="hidden" class="form-control" name="sal_type" id="sal_type">
                 </div>
               </div>

               <div class="form-group row">
                  <label for="is_percentage" class="col-sm-3 col-form-label"><?php echo display('percentage') ?> *</label>
                  <div class="col-sm-9">
                   <input type="checkbox" name="is_percentage" id="ispercentage"  value="0" data-toggle='tooltip' data-placement='right' data-original-title="Check to calculate addition and deduction in percent." onchange='handlepercent(this);'>
                 </div>
               </div>

             <table  border="1" width="100%">
              <div class="row">

                <td class="col-sm-6 text-center"><h4 class="addition_title"><?php echo display('addition')?></h4><br>
                 <table id="add">     
                  <tr><th  class="padten"><?php echo display('basic')?></th><td><input type="number" id="basic" name="basic" class="form-control" disabled=""></td></tr>    
                                   <?php
                 $x=0;
                 foreach ($slname as $ab){
                  ?>
                  <tr><th class="padten"><?php echo $ab->sal_name ;?><span class="percent">(%)<span></th><td><input type="number" name="amount[<?php echo $ab->salary_type_id; ?>]" class="form-control addamount" onkeyup="salarySetupsummary()" id="add_<?php echo $x;?>"></td></tr>
                  <?php
                $x++;}
                ?>
              </table>
            </td> 
            <td class="col-sm-6 text-center"><h4 class="addition_title"><?php echo display('deduction')?></h4><br>
              <table id="dduct">
                <?php
                $y=0;
                foreach ($sldname as $row){
                  ?>
                  <tr><th class="padten"><?php echo $row->sal_name ;?><span class="percent">(%)<span></th><td><input type="number" name="amount[<?php echo $row->salary_type_id; ?>]" onkeyup="salarySetupsummary()" class="form-control deducamount" id="dd_<?php echo $y;?>"></td></tr><?php
               $y++; }
                ?>
                <tr><th class="padten"><?php echo display('tax')?><span class="percent">(%)<span></th><td><input type="number" name="amount[]"  onkeyup="salarySetupsummary()"  class="form-control deducamount" id="taxinput"></td><td class="padten"><input type="checkbox" name="tax_manager" id="taxmanager" onchange='handletax(this);' value="1">Tax Manager</td></tr>

              </table>

            </td> 

          </div>

        </table>

        <br><br>

        <div class="form-group row">
           <label for="payable" class="col-sm-3 col-form-label text-center"><?php echo display('gross_salary')?></label>
                <div class="col-sm-9">
        <input type="text" class="form-control" name="gross_salary" id="grsalary" readonly="">
               </div>
        </div>

      </div>

   <div class="form-group form-group-new text-right">
    <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('set') ?></button>
  </div>
  <?php echo form_close() ?>

</div>  
</div>
</div>
</div>
</div>
</div>
</div>
</div>

 <script src="<?php echo base_url('assets/js/payroll.js') ?>" type="text/javascript"></script>