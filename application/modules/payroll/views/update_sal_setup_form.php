       <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">

              <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('update')?>
                    </h4>
                </div>
              </div>

              <div class="panel-body">

                <?php echo  form_open('payroll/Payroll/updates_salstup_form/'. $data->employee_id) ?>
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                  <div class="col-sm-9">
                   <?php echo form_dropdown('employee',$employee,(!empty($data->employee_id)?$data->employee_id:null),'class="form-control" id="employee_id" disabled="" onchange="employeeSetup(this.value)"') ?>

                   <input type="hidden" class="form-control" name="employee_id" id="employee_id" value="<?php echo !empty($data->employee_id)?$data->employee_id:null; ?>">
                 </div>
               </div>

               <div class="form-group row">
                  <label for="payment_period" class="col-sm-3 col-form-label"><?php echo display('salary_type_id') ?> *</label>
                  <div class="col-sm-9">
                   <input type="text" class="form-control" name="sal_type_name" id="sal_type_name" value="<?php if($EmpRate->rate_type==1){
                      echo 'Hourly';
                   }else{
                      echo 'Salary';
                   }?>">
                   <input type="hidden" class="form-control" name="sal_type" id="sal_type" value="<?php echo $EmpRate->rate_type; ?>">
                 </div>
               </div>

               <div class="form-group row">
                  <label for="is_percentage" class="col-sm-3 col-form-label"><?php echo display('percentage') ?> *</label>
                  <div class="col-sm-9">
                   <input type="checkbox" name="is_percentage" id="ispercentage"  value="<?php echo !empty($data->is_percentage)?$data->is_percentage:0; ?>" data-toggle='tooltip' data-placement='right' data-original-title="Check to calculate addition and deduction in percent." onchange='handlepercent(this);' <?php if($data->is_percentage == 1){echo "checked";} ?>>
                 </div>
               </div>

             <table  border="1" width="100%">
              <div class="row">

                <td class="col-sm-6 text-center"><h4  sclass="addition_title">Addition</h4><br>
                 <table id="add">   <?php foreach($amo as $basic){}?>   
                  <tr><th  class="padten">Basic</th><td><input type="number" id="basic" name="basic" class="form-control" disabled="" value="<?php echo $EmpRate->rate; ?>"></td></tr>    
                                   <?php
                 $x=0;
                foreach($amo as $value){?>
                             <tr>
                             <th class="padten"><?php echo $value->sal_name ;?> <span class="percent">(%)<span></th>
                                <td>
                                <input type="number" name="amount[<?php echo $value->salary_type_id; ?>]" class="form-control addamount" onkeyup="salarySetupsummary()" value="<?php echo $value->amount; ?>" id="add_<?php echo $x;?>">
                             </td>
                             </tr>
                             <?php $x++;} ?>
              </table>
            </td> 
            <td class="col-sm-6 text-center"><h4 class="addition_title">Deduction</h4><br>
              <table id="dduct">
                <?php
                $y=0;
                foreach ($samlft as $row){

                  ?>
                  <tr><th class="padten"><?php echo $row->sal_name ;?> <span class="percent">(%)<span></th><td><input type="number" name="amount[<?php echo $row->salary_type_id; ?>]" onkeyup="salarySetupsummary()" class="form-control deducamount" value="<?php echo $row->amount ?>" id="dd_<?php echo $y;?>"></td></tr><?php
               $y++; }
                ?>
                <tr><th class="padten">Tax <span class="percent">(%)<span></th><td><input type="number" name="amount[]"  onkeyup="salarySetupsummary()"  class="form-control deducamount" id="taxinput" <?php if($EmpRate->rate_type==1){
                    echo 'readonly';
                } ?>></td><td class="padten"><input type="checkbox" name="tax_manager" id="taxmanager" onchange='handletax(this);' value="1" <?php if($EmpRate->rate_type==1){
                    echo 'checked'.'  '.'disabled';
                } ?>>Tax Manager</td></tr>

              </table>

            </td> 

          </div>

        </table>

        <br>

        <div class="form-group row">
           <label for="payable" class="col-sm-3 col-form-label text-center" >Gross Salary</label>
                <div class="col-sm-9">
        <input type="text" class="form-control" name="gross_salary" value="<?php echo $basic->gross_salary; ?>" id="grsalary" readonly="">
               </div>
        </div>

      </div>

   
   <div class="form-group form-group-margin text-right">
    <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
  </div>
  <?php echo form_close() ?>

</div>  
</div>
</div>
 <script src="<?php echo base_url('assets/js/payroll.js') ?>" type="text/javascript"></script>