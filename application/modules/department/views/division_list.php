<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading">
              <div class="panel-title">
                  <h4>
                    <?php echo display('division')?>
                  </h4>
              </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('division_name') ?></th>
                            <th><?php echo display('department') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($division)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($division as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->department_name; ?></td>
                                    <td><?php echo $row->department; ?></td>
                                      <td class="center">
                                  
                                    
                                    <?php if($this->permission->check_label('division_list')->update()->access()): ?>
                                        <a href="<?php echo base_url("department/Division_controller/division_form/$row->dept_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    
                                    <?php if($this->permission->check_label('division_list')->delete()->access()): ?>
                                        <a href="<?php echo base_url("department/Division_controller/delete_division/$row->dept_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
                                         <?php endif; ?> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                   <?php echo  $links ?>
            </div>
        </div>
    </div>
</div>