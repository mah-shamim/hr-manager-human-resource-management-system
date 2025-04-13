<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('employee_name') ?></th>
                            <th><?php echo display('point_category') ?></th>
                            <th><?php echo display('point') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($management_points)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($management_points as $que) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $que->first_name.' '.$que->last_name; ?></td>  
                                    <td><?php echo $que->point_category; ?></td>  
                                    <td><?php echo $que->point; ?></td>
                                    <td><?php echo $que->create_date; ?></td>                            
                                    <td class="center">
                                    <?php if($this->permission->check_label('management_point')->delete()->access()): ?> 
                                        <a href="<?php echo base_url("rewardpoint/Rewardpoints/delete_management_point/$que->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 