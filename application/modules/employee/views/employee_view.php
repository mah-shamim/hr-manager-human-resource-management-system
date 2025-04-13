<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd"> 

                    <div class="panel-heading">
                      <div class="panel-title">
                        
                      </div>
                    </div>

                    <div class="panel-body">
                        <?php echo form_open('employee/Employees/employee_search',array('class' => 'form-inline', 'id' => 'validate'));?>
                            <label class="select"><?php echo display('search') ?>:</label>
                            <input type="text" name="what_you_search" class="form-control" placeholder='<?php echo display('what_you_search') ?>' id="what_you_search" required>
                            <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

          <div class="panel-heading">
            <div class="panel-title">
                <h4>
                  <?php echo display('manage_employee')?>
                </h4>
            </div>
          </div>

            <div class="panel-body table-responsive">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                           <th><?php echo display('cid') ?></th>
                           <th><?php echo display('picture')?></th>
                           <th><?php echo display('first_name')?></th>
                           <th><?php echo display('last_name')?></th>
                           <th><?php echo display('employee_id')?></th>
                           <th><?php echo display('phone')?></th>
                           <th><?php echo display('email')?></th>
                           <th><?php echo display('state')?></th>
                           <th><?php echo display('supervisor')?></th>
                           <th><?php echo display('status')?></th>
                           <th><?php echo display('action')?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emp_history)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($emp_history as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><img src="<?php echo base_url(!empty($row->picture)?$row->picture:'assets/img/icons/default.jpg'); ?>" alt="Image" height="64" ></td>
                                    <td><?php echo $row->first_name; ?></td>
                                    <td><?php echo $row->last_name; ?></td>
                                    <td><?php echo $row->employee_id; ?></td>
                                    <td><?php echo $row->phone; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->state; ?></td>
                                    <td><?php echo $row->is_super_visor?"Yes":"No"; ?></td>
                                    <td align="center">
                                        <div class="toggle-example" onchange="change_employee_status(<?php echo $row->employee_id;?>)">
                                            <input type="checkbox" <?php echo $row->employee_status == 1?"checked":"";?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                    </td>
                                    <td class="center">
                                      <?php //if($this->permission->method('manage_employee','update')->access()): ?>
                                      <?php if($this->permission->check_label('manage_employee')->update()->access()): ?>
                                      <a href="<?php echo base_url("employee/Employees/update_employee_form/$row->employee_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 
                                       <?php endif; ?>
                                        <?php //if($this->permission->method('manage_employee','delete')->access()): ?>
                                        <?php if($this->permission->check_label('manage_employee')->delete()->access()): ?>
                                        <a href="<?php echo base_url("employee/Employees/delete_employhistory/$row->employee_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                         <?php endif; ?>
                                        <a href="<?php echo base_url("employee/Employees/cv/$row->employee_id");?>" class="btn btn-default btn-xs"><i class="fa fa-user"></i></a>
                                       
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

<script src="<?php echo MOD_URL.'employee/assets/js/script.js'; ?>" type="text/javascript"></script>
