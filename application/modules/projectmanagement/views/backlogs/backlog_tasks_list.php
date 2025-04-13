
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >

                    <div class="panel-title">
                        <h4><?php echo display('backlogs') ?></h4>
                    </div>

                    <div class="mr-25">

                       <?php if($this->permission->check_label('task')->create()->access()): ?>  
                        <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo display('create_task')?></button> 
                        <?php endif; ?>

                        <?php

                        $user = $this->session->userdata();

                         if($user['isAdmin'] || $user['supervisor'] && $user['employee_id'] == $project_info->project_lead): ?> 
                        <a href="<?php echo base_url();?>/projectmanagement/pm_projects/manage_backlogs" class="btn btn-primary"><?php echo display('manage_backlogs')?></a>
                        <?php endif; ?>

                        <?php

                         if($user['isAdmin'] || $user['supervisor'] && $user['employee_id'] == $project_info->project_lead): ?> 
                        <a href="<?php echo base_url();?>/projectmanagement/pm_tasks/transfer_tasks" class="btn btn-primary"><?php echo display('transfer_tasks')?></a>
                        <?php endif; ?>

                        <?php

                         if(($user['isAdmin'] || $user['supervisor'] && $user['employee_id'] == $project_info->project_lead) && $previous_project_backlogs > 0): ?> 
                        <a href="<?php echo base_url();?>/projectmanagement/pm_tasks/get_parent_project_tasks/<?php echo $project_info->project_id;?>" class="btn btn-primary"><?php echo display('get_retros')?></a>
                        <?php endif; ?>

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
 
 
 <div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-tasks' aria-hidden='true'></i> Create Task</h4></strong></center>
            </div>
            <div class="modal-body">
               
    
               <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">
                                   
                                </div>
                            </div>
                            <div class="panel-body">

                                <?php echo  form_open_multipart('projectmanagement/Pm_projects/create_task/'.$project_info->project_id); ?>
                               
                                   <div class="form-group row">
                                       
                                        <label for="project_name" class="col-sm-3 col-form-label">
                                        <?php echo display('project_name') ?></label>
                                        <div class="col-sm-9">

                                            <input type="text" name="project_name" class="form-control" readonly placeholder="<?php echo display('project_name') ?>" value="<?php echo $project_info->project_name; ?>">
                                            <input type="hidden" name="project_id" value="<?php echo $project_info->project_id; ?>">
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="summary" class="col-sm-3 col-form-label">
                                        <?php echo display('summary') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <textarea class="form-control" required name="summary" id="summary" rows="2" placeholder="<?php echo display('summary') ?>" tabindex="10" required></textarea>
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="description" class="col-sm-3 col-form-label">
                                        <?php echo display('description') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <textarea class="form-control" required name="description" id="description" rows="4" placeholder="<?php echo display('description') ?>" tabindex="10" required></textarea>
                                           
                                        </div>
                                       
                                    </div>

                                   <div class="form-group row">

                                        <label for="file_attachment" class="col-sm-3 col-form-label"><?php echo display('attachment') ?> <i>*</i></label>
                                        <div class="col-sm-9">

                                            <input type="file" name="file_attachment">
                                            <p>N.B: Only pdf|docx|jpg|png are allowed</p>

                                        </div>

                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="project_lead" class="col-sm-3 col-form-label">
                                        <?php echo display('reporter') ?></label>
                                        <div class="col-sm-9">
                                            
                                            <?php echo form_dropdown('project_lead', $project_leads,(!empty($project_info->project_lead)?$project_info->project_lead:""), ' class="form-control" disabled="true"') ?>

                                            <input type="hidden" name="project_lead_id" value="<?php echo $project_info->project_lead; ?>">
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="employee_id" class="col-sm-3 col-form-label">
                                        <?php echo display('assignee') ?> <i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            
                                            <?php echo form_dropdown('employee_id', $team_members,(!empty($team_member->employee_id)?$team_member->employee_id:""), ' class="form-control" required') ?> 
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="sprint_id" class="col-sm-3 col-form-label">
                                        <?php echo display('sprint') ?></label>
                                        <div class="col-sm-9">
                                            
                                            <?php echo form_dropdown('sprint_id', $available_sprints,(!empty($available_sprint->sprint_id)?$available_sprint->sprint_id:""), ' class="form-control"') ?> 
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="priority" class="col-sm-3 col-form-label">
                                        <?php echo display('priority') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <select name="priority" class="form-control" id="priority" required="">
                                                <option value=""> Select Priority</option>

                                                    <option value="2">High</option>
                                                    <option value="1">Medium</option>
                                                    <option value="0">Low</option>
                                                    
                                            </select>
                                           
                                        </div>
                                       
                                    </div>
                                    
                         
                                    <div class="form-group form-group-margin text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
                                    </div>
                                <?php echo form_close() ?>

                            </div>  
                        </div>
                    </div>
                </div>
            </div>
     
        </div>

        <div class="modal-footer">

        </div>

        </div>

    </div>


