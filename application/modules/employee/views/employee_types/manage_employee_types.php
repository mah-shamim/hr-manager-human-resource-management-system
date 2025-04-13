<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('employee_types') ?></h4>
                    </div>
                    <div class="mr-25">

                        <a href="<?php echo base_url();?>/employee/employee_type/employee_types_view" class="btn btn-primary"><?php echo display('employee_types')?></a>


                    </div>

                </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('details') ?></th>
                            <th><?php echo display('action') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($employee_types)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($employee_types as $type) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $type->name; ?></td>
                                    <td><?php echo $type->details; ?></td>
                                    <td class="center">
                                    <?php if($this->permission->method('employee_type','update')->access()): ?> 
                                        <a href="<?php echo base_url("employee/employee_type/update_employee_type/$type->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('employee_type','delete')->access()): ?> 
                                        <a href="<?php echo base_url("employee/employee_type/delete_employee_type/$type->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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

     
