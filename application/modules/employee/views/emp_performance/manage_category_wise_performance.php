<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo $title; ?></h4>
                    </div>
                    <div class="mr-25">

                        <a href="<?php echo base_url();?>/employee/employees_performance/category_performance_view" class="btn btn-primary"><?php echo display('category_wise_performance')?></a>


                    </div>

                </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('sub_category') ?></th>
                            <th><?php echo display('score') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('action') ?></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($category_wise_performances)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($category_wise_performances as $cat_perfrm) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $cat_perfrm->first_name.' '.$cat_perfrm->last_name; ?></td>
                                    <td><?php echo $cat_perfrm->perform_category_name; ?></td>
                                    <td><?php echo $cat_perfrm->points; ?></td>
                                    <td><?php echo $cat_perfrm->CreateDate; ?></td>
                                    <td class="center">
                                    <?php if($this->permission->method('category_wise_performance','update')->access()): ?> 
                                        <a href="<?php echo base_url("employee/employees_performance/update_category_wise_performance/$cat_perfrm->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->method('category_wise_performance','delete')->access()): ?> 
                                        <a href="<?php echo base_url("employee/employees_performance/delete_category_wise_performance/$cat_perfrm->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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

     
