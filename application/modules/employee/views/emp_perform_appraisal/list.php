<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('perform_sub_category') ?></h4>
                    </div>
                    <div class="mr-25">

                        <a href="<?php echo base_url();?>/employee/employees_performance/add_employee_performance" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"> </i><?php echo display('add_performance')?></a>


                    </div>

                </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('score') ?></th>
                            <th><?php echo display('create_date') ?></th>
                            <th><?php echo display('action') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($emp_performances)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($emp_performances as $emp_per) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $emp_per->first_name.' '.$emp_per->last_name; ?></td>
                                    <td><?php echo $emp_per->total_scores; ?></td>
                                    <td><?php echo $emp_per->create_date; ?></td>

                                    <td class="center">

                                    <?php if($this->permission->check_label('emp_performance')->read()->access()): ?>
                                        <a href="<?php echo base_url("employee/employees_performance/employee_performance_view/$emp_per->emp_per_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <?php endif; ?>

                                    <?php if($this->permission->check_label('emp_performance')->update()->access()): ?>
                                        <a href="<?php echo base_url("employee/employees_performance/employee_performance_update/$emp_per->emp_per_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('emp_performance')->delete()->access()): ?>
                                        <a href="<?php echo base_url("employee/employees_performance/employee_performance_delete/$emp_per->emp_per_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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

     
