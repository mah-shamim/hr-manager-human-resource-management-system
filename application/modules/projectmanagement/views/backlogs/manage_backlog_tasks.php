
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
                            <th><?php echo display('project_name') ?></th>
                            <th><?php echo display('summary') ?></th>
                            <th><?php echo display('project_lead') ?></th>
                            <th><?php echo display('team_member') ?></th>
                            <th><?php echo display('priority') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($backlog_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($backlog_lists as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->summary; ?></td>
                                    <td><?php echo $row->proj_lead_firstname.' '.$row->proj_lead_lastname; ?></td>
                                    <td><?php echo $row->team_mem_firstname.' '.$row->team_mem_lastname; ?></td>
                                    <td><?php if($row->priority == 2){echo "High";}elseif($row->priority == 1){echo "Medium";}else{echo "Low";}?></td>
                                    <td><?php echo $row->created_at; ?></td>

                                    <td>
                                        
                                        <?php if($this->permission->check_label('task')->update()->access()): ?>
                                            <a href="<?php echo base_url("projectmanagement/pm_projects/backlog_task_update/$row->task_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>  
                                            <?php endif; ?>
                                    
                                        <?php if($this->permission->check_label('task')->delete()->access()): ?>
                                            <a href="<?php echo base_url("projectmanagement/pm_projects/delete_backlog_task/$row->task_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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