<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

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
              <th><?php echo display('action') ?></th>
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
                                                                
                <td class="center">
                <?php if($this->permission->method('payroll','update')->access()): ?> 
                    <a href="<?php echo base_url("payroll/Payroll/updates_salstup_form/$que->employee_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 
                    <?php endif; ?>
                
                <?php if($this->permission->method('employee','delete')->access()): ?>
                    <a href="<?php echo base_url("payroll/Payroll/delete_salsetup/$que->employee_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
                    <?php endif; ?> 
                </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
 
 