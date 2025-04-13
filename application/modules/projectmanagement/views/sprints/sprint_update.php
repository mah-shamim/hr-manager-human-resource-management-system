
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span class="title"><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('projectmanagement/Pm_projects/sprint_update/'.$id, array('class' => 'form-vertical', 'id' => 'update_sprint', 'name' => 'update_sprint')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label for="sprint_name" class="col-sm-3 col-form-label"><?php echo display('sprint_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="sprint_name" id="sprint_name" required="" placeholder="<?php echo display('sprint_name') ?>" value="<?php if(!empty($sprint_data->sprint_name)){echo $sprint_data->sprint_name;}?>">

                                        <input type="hidden" name="old_sprint_name" value="<?php if(!empty($sprint_data->sprint_name)){echo $sprint_data->sprint_name;}?>">
                                        <input type="hidden" name="sprint_id" value="<?php if(!empty($sprint_data->sprint_id)){echo $sprint_data->sprint_id;}?>">
                                        <input type="hidden" name="project_id" value="<?php if(!empty($project_info->project_id)){echo $project_info->project_id;}?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="duration" class="col-sm-3 col-form-label"><?php echo display('duration') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="number"class="form-control" name="duration" id="duration" required="" placeholder="<?php echo display('duration') ?>" value="<?php if(!empty($sprint_data->duration)){echo $sprint_data->duration;}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="start_date" class="col-sm-3 col-form-label"><?php echo display('start_date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control datepicker" name="start_date" id="date" required="" placeholder="<?php echo display('start_date') ?>" value="<?php if(!empty($sprint_data->start_date)){echo $sprint_data->start_date;}?>">

                                        <input type="hidden" name="old_start_date" value="<?php if(!empty($sprint_data->start_date)){echo $sprint_data->start_date;}?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sprint_goal" class="col-sm-3 col-form-label"><?php echo display('sprint_goal') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" required name="sprint_goal" id="sprint_goal" rows="4" placeholder="<?php echo display('sprint_goal') ?>" tabindex="10" required><?php if(!empty($sprint_data->sprint_goal)){echo $sprint_data->sprint_goal;}?></textarea>
                                    </div>
                                </div>

                                <?php if($close_open){ ?>

                                <div class="form-group row">
                                       
                                    <label for="sprint_status" class="col-sm-3 col-form-label">
                                    <?php echo display('status') ?></label>
                                    <div class="col-sm-9">

                                        <select name="sprint_status" class="form-control" id="sprint_status" onchange="change_sprint_status(this,<?php echo $id;?>)">
                                            <option value=""> Select Status</option>

                                                <option value="1">Close</option>
                                                
                                        </select>
                                       
                                    </div>
                                   
                                </div>

                                <?php } ?>

                                 <br>

                                <div class="form-group row">
                                    <div class="form-group form-group-margin form-projectmanagement text-right">

                                        <input type="submit" id="update-sprint" class="btn btn-success btn-large" name="update-sprint" value="<?php echo display('save') ?>" tabindex="10"/>
                                    </div>
                                </div>

                                <input type="hidden" name="csrftoken" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrftoken">

                            </div>

                        </div>

                        
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'projectmanagement/assets/js/project_common.js'; ?>" type="text/javascript"></script>