
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
                            <th><?php echo display('project_lead') ?></th>
                            <th><?php echo display('approximate_tasks') ?></th>
                            <th><?php echo display('project_duration') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($project_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($project_lists as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                    <td><?php echo $row->approximate_tasks; ?></td>
                                    <td><?php echo $row->project_duration.' days'; ?></td>
                                    <td>
                                        <p class="btn btn-xs <?php if($row->is_completed){echo "btn-success";}else{echo "btn-danger";} ?>"><?php if($row->is_completed){echo "Closed";}else{echo "Open";} ?></p>
                                    </td>

                                    <td class="center">

                                    <?php 

                                    $user = $this->session->userdata();

                                    // Check if project not completed, then allow the functionalities to manage the project.
                                    if($row->is_completed == 0){

                                        if($user['isAdmin'] || ($user['supervisor'] && $user['employee_id'] == $row->project_lead)): ?>
                                            <p onclick="backlog(<?php echo $row->project_id;?>)" class="btn btn-xs btn-success">Backlogs</p>  
                                            <?php endif; ?>

                                        <?php if($user['isAdmin'] || $user['supervisor'] && $user['employee_id'] == $row->project_lead): ?>
                                            <p onclick="sprint(<?php echo $row->project_id;?>)" class="btn btn-xs btn-primary">Sprints</p> 
                                            <?php endif; ?>

                                    <?php }?>
                                  
                                    <?php if($this->permission->check_label('projects')->update()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_projects/project_update/$row->project_id ") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>  
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('projects')->delete()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_projects/delete_project/$row->project_id ") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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

<script src="<?php echo MOD_URL.'projectmanagement/assets/js/project_common.js'; ?>" type="text/javascript"></script>


