<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('employee_types') ?></h4>
                    </div>
                    <div class="mr-25">

                        <a href="<?php echo base_url();?>/employee/employees_performance/paerformance_sub_category_view" class="btn btn-primary"><?php echo display('perform_sub_category')?></a>


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
                        <?php if (!empty($perform_sub_categories)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($perform_sub_categories as $sub_cat) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $sub_cat->name; ?></td>
                                    <td><?php echo $sub_cat->details; ?></td>
                                    <td class="center">
                                    <?php if($this->permission->method('performance_category','update')->access()): ?> 
                                        <a href="<?php echo base_url("employee/employees_performance/update_performance_sub_category/$sub_cat->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('performance_category','delete')->access()): ?> 
                                        <a href="<?php echo base_url("employee/employees_performance/delete_performance_sub_category/$sub_cat->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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

     
