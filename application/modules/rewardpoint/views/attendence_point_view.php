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
                            <th><?php echo display('in_time') ?></th>
                            <th><?php echo display('point') ?></th>
                            <th><?php echo display('date') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($attendence_points)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($attendence_points as $que) { 
                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $que->firstname.' '.$que->lastname; ?></td>  
                                    <td><?php echo $que->in_time; ?></td>
                                    <td><?php echo $que->point; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($que->create_date)); ?></td>
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
 
 