
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >

                    <div class="panel-title">
                        <h4><?php echo $title; ?></h4>
                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('sprint_name') ?></th>
                            <th><?php echo display('duration') ?></th>
                            <th><?php echo display('project_name') ?></th>
                            <th><?php echo display('starting_date') ?></th>
                            <th><?php echo display('ending_date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sprint_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($sprint_lists as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->sprint_name; ?></td>
                                    <td><?php echo $row->duration." days"; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->start_date; ?></td>
                                    <td><?php echo $row->close_date?$row->close_date:"Running"; ?></td>
                                    <td>
                                        
                                        <p class="btn btn-xs <?php if($row->is_finished){echo "btn-success";}else{echo "btn-danger";} ?>"><?php if($row->is_finished){echo "Closed";}else{echo "Open";} ?></p>
                                    </td>

                                    <td>

                                        <?php if(!$row->is_finished):?>
                                            <a href="<?php echo base_url("projectmanagement/pm_projects/transfer_sprint_tasks/$row->sprint_id") ?>" class="btn btn-xs btn-primary">Transfer tasks</i></a>  
                                        <?php endif; ?>

                                        <?php if($this->permission->check_label('sprint')->update()->access()): ?>
                                            <a href="<?php echo base_url("projectmanagement/pm_projects/sprint_update/$row->sprint_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>  
                                            <?php endif; ?>
                                    
                                        <?php if($this->permission->check_label('sprint')->delete()->access()): ?>
                                            <a href="<?php echo base_url("projectmanagement/pm_projects/delete_sprint/$row->sprint_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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


