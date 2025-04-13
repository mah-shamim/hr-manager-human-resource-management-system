
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
            <div class="col-sm-12">

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Transfer tasks from sprint to backlogs</h4>
                        </div>
                    </div>

                    <?php echo form_open_multipart('projectmanagement/Pm_projects/transfer_sprint_tasks/'.$id, array('class' => 'form-vertical', 'id' => 'sprint_tasks', 'name' => 'sprint_tasks')) ?>

                    <input id="project_id" type="hidden" name="project_id" value="<?php echo $project_info->project_id; ?>">

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display("select");?></th>
                                        <th><?php echo display("summary");?></th>
                                        <th><?php echo display("project_lead");?></th>
                                        <th><?php echo display("team_member");?></th>
                                        <th><?php echo display("sprint_name");?></th>
                                        <th><?php echo display("priority");?></th>
                                        <th><?php echo display("create_date");?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if (!empty($sprint_tasks)) { ?>

                                    <?php foreach ($sprint_tasks as $row) { ?>

                                        <tr>
                                            <td>
                                                <div class="checkbox checkbox-success">
                                                    <input id="checkbox_<?php echo $row->task_id;?>" type="checkbox" name="sprint_tasks[]" value="<?php echo $row->task_id; ?>">
                                                    <label for="checkbox_<?php echo $row->task_id;?>"></label>
                                                </div>
                                            </td>
                                            <td><?php echo $row->summary; ?></td>
                                            <td><?php echo $row->proj_lead_firstname.' '.$row->proj_lead_lastname; ?></td>
                                            <td><?php echo $row->team_mem_firstname.' '.$row->team_mem_lastname; ?></td>
                                            <td><?php echo $row->sprint_name; ?></td>
                                            <td><?php if($row->priority == 2){echo "High";}elseif($row->priority == 1){echo "Medium";}else{echo "Low";}?></td>
                                            <td><?php echo date("Y-m-d", strtotime($row->created_at)); ?></td>
                                        </tr>

                                    <?php 
                                        }
                                    }else{
                                    ?>
                                        <tr>
                                            <td class="no-tasks" colspan="7" align="center"><span>No tasks available for this Sprint !</span></td>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group row">
                                    <div class="form-group form-group-margin form-projectmanagement text-right">

                                        <input type="submit" id="update-backlog-tasks" class="btn btn-success btn-large" name="update-backlog-tasks" value="<?php echo display('save') ?>" tabindex="10"/>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <?php echo form_close() ?>

            </div>
        </div>