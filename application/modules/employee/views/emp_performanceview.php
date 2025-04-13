<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

            <div class="panel-heading">
              <div class="panel-title">
                  <h4>
                    <?php echo "Manage Performance";?>
                  </h4>
              </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                                    <th><?php echo display('Sl') ?></th>
                                    <th>Employee Name</th>
                                    <th><?php echo display('employee_id') ?></th>
                                    <th><?php echo display('note') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <th><?php echo display('note_by') ?></th>
                                    <th><?php echo display('score') ?></th>
                                    <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emp_perform)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($emp_perform as $que) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                        <td><?php echo $sl; ?></td><td><?php echo $que->first_name.' '.$que->last_name; ?></td>
                                        <td><?php echo $que->employee_id; ?></td>
                                        <td><?php echo $que->note; ?></td>
                                        <td><?php echo $que->date; ?></td>
                                        <td><?php echo $que->note_by; ?></td>
                                        <td><?php echo $que->score; ?></td>
                                        <td class="center">
                                        <?php if($this->permission->method('employee','update')->access()): ?> 
                                        <a href="<?php echo base_url("employee/Employees/update_emp_performance_form/$que->emp_per_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 
                                         <?php endif; ?>
                                    
                                    <?php if($this->permission->method('employee','delete')->access()): ?> 
                                        <a href="<?php echo base_url("employee/Employees/delete_emp_performance/$que->emp_per_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 