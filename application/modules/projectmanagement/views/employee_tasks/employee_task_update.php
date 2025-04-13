
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span class="title"><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('projectmanagement/pm_tasks/employee_task_update/'.$id, array('class' => 'form-vertical', 'id' => 'update_task', 'name' => 'update_task')) ?>
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
                                        <textarea class="form-control" readonly="" name="summary" id="summary" rows="4" placeholder="<?php echo display('summary') ?>" tabindex="10" required><?php if(!empty($task_data->summary)){echo $task_data->summary;}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label"><?php echo display('description') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control"  readonly="" name="description" id="description" rows="5" placeholder="<?php echo display('description') ?>" tabindex="10" required><?php if(!empty($task_data->description)){echo $task_data->description;}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('attachment') ?> <i>*</i></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="file_attachment">
                                        <input type="hidden" name="old_attachment" value="<?php echo $task_data->attachment; ?>">
                                        <p>N.B: Only pdf|docx|jpg|png are allowed</p>

                                        <a class="btn btn-primary" target="_blank" href="<?php if($task_data->attachment){echo base_url().$task_data->attachment;}else{echo "#";}?>" role="button">Click to open attachment</a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="project_lead" class="col-sm-3 col-form-label"><?php echo display('project_lead') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('project_lead', $project_leads, (!empty($task_data->project_lead)?$task_data->project_lead:""), ' class="form-control" disabled="true"') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sprint_id" class="col-sm-3 col-form-label"><?php echo display('sprint') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('sprint_id', $available_sprints, (!empty($task_data->sprint_id)?$task_data->sprint_id:""), ' class="form-control" required') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="priority" class="col-sm-3 col-form-label"><?php echo display('priority') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">

                                        <select name="priority" class="form-control" id="priority" required="">
                                            <option value=""> Select Priority</option>

                                                <option value="2" <?php if($task_data->priority == 2){echo 'selected';}?>>High</option>
                                                <option value="1" <?php if($task_data->priority == 1){echo 'selected';}?>>Medium</option>
                                                <option value="0" <?php if($task_data->priority == 0){echo 'selected';}?>>Low</option>
                                                
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="task_status" class="col-sm-3 col-form-label"><?php echo display('task')." ".display('status') ?> <i>*</i></label>
                                    <div class="col-sm-9">

                                        <select name="task_status" class="form-control" id="task_status">
                                            <option value=""> Select Status</option>

                                                <option value="3" <?php if($task_data->task_status == 3){echo 'selected';}?>>Done</option>
                                                <option value="2" <?php if($task_data->task_status == 2){echo 'selected';}?>>In Progress</option>
                                                <option value="1" <?php if($task_data->task_status == 1 || $task_data->task_status == 0){echo 'selected';}?>>To Do</option>
                                                
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
        
        <script src="<?php echo MOD_URL.'projectmanagement/assets/js/project_common.js'; ?>" type="text/javascript"></script>