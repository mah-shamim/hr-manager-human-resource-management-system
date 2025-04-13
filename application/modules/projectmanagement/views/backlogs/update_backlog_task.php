
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span class="title"><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('projectmanagement/Pm_projects/backlog_task_update/'.$id, array('class' => 'form-vertical', 'id' => 'update_backlog', 'name' => 'update_backlog')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label for="project_name" class="col-sm-3 col-form-label"><?php echo display('project_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="project_name" id="project_name" readonly placeholder="<?php echo display('project_name') ?>" value="<?php if(!empty($project_info->project_name)){echo $project_info->project_name;}?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="summary" class="col-sm-3 col-form-label"><?php echo display('summary') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" required name="summary" id="summary" rows="4" placeholder="<?php echo display('summary') ?>" tabindex="10" required><?php if(!empty($backlog_task_data->summary)){echo $backlog_task_data->summary;}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label"><?php echo display('description') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" required name="description" id="description" rows="5" placeholder="<?php echo display('description') ?>" tabindex="10" required><?php if(!empty($backlog_task_data->description)){echo $backlog_task_data->description;}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('attachment') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="file_attachment">
                                        <input type="hidden" name="old_attachment" value="<?php echo $backlog_task_data->attachment; ?>">
                                        <p>N.B: Only pdf|docx|jpg are allowed</p>

                                        <a class="btn btn-primary" target="_blank" href="<?php if($backlog_task_data->attachment){echo base_url().$backlog_task_data->attachment;}else{echo "#";}?>" role="button">Click to open attachment</a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="project_lead" class="col-sm-3 col-form-label"><?php echo display('project_lead') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('project_lead', $project_leads, (!empty($backlog_task_data->project_lead)?$backlog_task_data->project_lead:""), ' class="form-control" disabled="true"') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('assignee') ?> <i>*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('employee_id', $team_members, (!empty($backlog_task_data->employee_id)?$backlog_task_data->employee_id:""), ' class="form-control"') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sprint_id" class="col-sm-3 col-form-label"><?php echo display('sprint') ?> <i>*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('sprint_id', $available_sprints, (!empty($backlog_task_data->sprint_id)?$backlog_task_data->sprint_id:""), ' class="form-control"') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="priority" class="col-sm-3 col-form-label"><?php echo display('priority') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">

                                        <select name="priority" class="form-control" id="priority" required="">
                                            <option value=""> Select Priority</option>

                                                <option value="2" <?php if($backlog_task_data->priority == 2){echo 'selected';}?>>High</option>
                                                <option value="1" <?php if($backlog_task_data->priority == 1){echo 'selected';}?>>Medium</option>
                                                <option value="0" <?php if($backlog_task_data->priority == 0){echo 'selected';}?>>Low</option>
                                                
                                        </select>
                                    </div>
                                </div>

                                 <br>

                                <div class="form-group row">
                                    <div class="form-group form-group-margin form-projectmanagement text-right">

                                        <input type="submit" id="update-task" class="btn btn-success btn-large" name="update-task" value="<?php echo display('save') ?>" tabindex="10"/>
                                    </div>
                                </div>

                            </div>

                        </div>

                        
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>
        </div>

        <script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo MOD_URL.'projectmanagement/assets/js/project_common.js'; ?>" type="text/javascript"></script>