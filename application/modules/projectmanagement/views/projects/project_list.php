<?php

// Getting timezone
$timezone = $this->db->select('timezone')->from('setting')->get()->row();
date_default_timezone_set($timezone->timezone);

?>

<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >

                    <div class="panel-title">
                        <h4><?php echo display('projects') ?></h4>
                    </div>

                    <div class="mr-25">

                       <?php if($this->permission->check_label('projects')->create()->access()): ?> 

                        <a href="<?php echo base_url();?>/projectmanagement/pm_projects/new_project" class="btn btn-primary"><?php echo display('add_new_project')?></a>

                        <?php endif; ?>
                        <?php if($this->permission->check_label('projects')->read()->access()): ?> 
                        <a href="<?php echo base_url();?>/projectmanagement/pm_projects/manage_projects" class="btn btn-primary"><?php echo display('manage_projects')?></a>
                        <?php endif; ?>

                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%"><?php echo display('cid') ?></th>
                            <th width="13%"><?php echo display('project_name') ?></th>
                            <th width="10%"><?php echo display('client_name') ?></th>
                            <th width="12%"><?php echo display('project_lead') ?></th>
                            <th width="10%"><?php echo display('approximate_tasks') ?></th>
                            <th width="10%"><?php echo display('starting_date') ?></th>
                            <th width="10%"><?php echo display('ending_date') ?></th>
                            <th width="10%"><?php echo display('sprint_started') ?></th>
                            <th width="10%"><?php echo display('project_duration') ?></th>
                            <th width="10%"><?php echo display('status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($project_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($project_lists as $row) { ?>

                                <?php

                                    // Getting progressbar value for approximate_tasks vs completed_tasks
                                    $percentage = 100;
                                    $complete_percentage = 0;
                                    $remianing_percentage = 0;

                                    $progrss_complete = "";
                                    $progrss_remains = "";

                                    $project_not_started = 'style="width: 100%"';

                                    $approximate_tasks = $row->approximate_tasks?$row->approximate_tasks:0;
                                    $complete_tasks = $row->complete_tasks?$row->complete_tasks:0;

                                    $complete_percentage = ($complete_tasks / $approximate_tasks) * 100;
                                    $complete_percentage = round($complete_percentage);

                                    $remianing_percentage = $percentage - $complete_percentage;
                                    $remianing_percentage = round($remianing_percentage);

                                    $progrss_complete = 'style="width: '.$complete_percentage.'%"';
                                    $progrss_remains = 'style="width: '.$remianing_percentage.'%"';

                                    // End of progressbar value for approximate_tasks vs completed_tasks

                                    // Getting progressbar value for project_duration vs total days passed from project starts
                                    $duration_percentage = 100;
                                    $days_passed = 0;
                                    $remaining_days = 0;
                                    $duration_complete_percentage = 0;
                                    $duration_remianing_percentage = 0;

                                    $duration_progrss_complete = "";
                                    $duration_progrss_remains = "";

                                    if($row->start_date){

                                        $now = time();
                                        $your_date = strtotime($row->start_date);
                                        $datediff = $now - $your_date;

                                        $days_passed = round($datediff / (60 * 60 * 24));
                                        $remaining_days = (int)$row->project_duration - (int)$days_passed;
                                    }

                                    if($remaining_days > 0){

                                        $duration_complete_percentage = ($days_passed / $row->project_duration) * 100;
                                        $duration_complete_percentage = round($duration_complete_percentage);

                                        $duration_remianing_percentage = $duration_percentage - $duration_complete_percentage;
                                        $duration_remianing_percentage = round($duration_remianing_percentage);

                                        $duration_progrss_complete = 'style="width: '.$duration_complete_percentage.'%"';
                                        $duration_progrss_remains = 'style="width: '.$duration_remianing_percentage.'%"';
                                    }
                                    

                                    // End of Getting progressbar value for project_duration vs total days passed from project starts


                                ?>

                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->client_name; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>

                                    <td>
                                        <div class="progress">

                                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $progrss_complete;?>>
                                                    <?php echo $complete_percentage;?>% Complete
                                            </div>

                                            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $progrss_remains;?>>
                                                <?php echo $remianing_percentage;?>% Remaining
                                            </div>

                                        </div>
                                    </td>

                                    <td><?php echo $row->project_start_date?$row->project_start_date:"Not Started"; ?></td>
                                    <td><?php if($row->close_date){echo $row->close_date;}else{if($row->start_date){echo "Running";}else{echo "Waiting";}} ?></td>
                                    <td><?php echo $row->start_date?$row->start_date:"Not Started"; ?></td>

                                    <td>
                                        <?php if(!$row->start_date || strtotime($row->start_date) > strtotime(date("Y-m-d"))){ ?>

                                            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $project_not_started;?>>
                                                Not Started
                                            </div>

                                        <?php }else{?>

                                           <?php if($remaining_days > 0){ ?>

                                           <div class="progress">

                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $duration_progrss_complete;?>>
                                                        <?php echo $duration_complete_percentage;?>% passed
                                                </div>

                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $duration_progrss_remains;?>>
                                                    <?php echo $duration_remianing_percentage;?>% remaining
                                                </div>

                                            </div>

                                            <?php }else{?>

                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $project_not_started;?>>
                                                        0 days remaining
                                                </div>

                                            <?php } ?>

                                        <?php } ?>
                                            
                                    </td>

                                    <td>
                                        <p class="btn btn-xs <?php if($row->is_completed){echo "btn-success";}else{echo "btn-danger";} ?>"><?php if($row->is_completed){echo "Closed";}else{echo "Open";} ?></p>
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
 
 
 <div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-tasks' aria-hidden='true'></i> Create Project</h4></strong></center>
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

                                <?php echo  form_open('projectmanagement/Pm_projects/create_project'); ?>
                               
                                   <div class="form-group row">
                                       
                                        <label for="project_name" class="col-sm-3 col-form-label">
                                        <?php echo display('project_name') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <input type="text" name="project_name" class="form-control" required placeholder="<?php echo display('project_name') ?>">
                                           
                                        </div>
                                       
                                    </div>

                                    <?php 

                                        $sess_data = $this->session->userdata();
                                        $isSupervisor = $sess_data['supervisor'];

                                        if($isSupervisor){

                                    ?>
                                        <div class="form-group row">
                                           
                                            <label for="client_name" class="col-sm-3 col-form-label">
                                            <?php echo display('previous_version') ?></label>
                                            <div class="col-sm-9">
                                                
                                                <?php echo form_dropdown('previous_version', $version_projects, (!empty($version_project->version_id)?$version_project->version_id:""),' class="form-control"') ?> 
                                               
                                            </div>
                                           
                                        </div>
                                        
                                    <?php

                                        }

                                    ?>

                                    <div class="form-group row">
                                       
                                        <label for="client_name" class="col-sm-3 col-form-label">
                                        <?php echo display('client_name') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            
                                            <?php echo form_dropdown('client_id', $clients, (!empty($client->client_id)?$client->client_id:""),' class="form-control" required = ""') ?> 
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="project_lead" class="col-sm-3 col-form-label">
                                        <?php echo display('project_lead') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            
                                            <?php echo form_dropdown('project_lead', $project_leads,(!empty($project_lead->project_lead)?$project_lead->project_lead:""), ' class="form-control" required = ""') ?> 
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="approximate_tasks" class="col-sm-3 col-form-label">
                                        <?php echo display('approximate_tasks') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <input type="number" name="approximate_tasks" class="form-control" required required placeholder="<?php echo display('approximate_tasks') ?>">
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="summary" class="col-sm-3 col-form-label">
                                        <?php echo display('summary') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <textarea class="form-control" required name="summary" id="summary" rows="4" placeholder="<?php echo display('summary') ?>" tabindex="10" required></textarea>
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="project_duration" class="col-sm-3 col-form-label">
                                        <?php echo display('project_duration') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">

                                            <input type="number" name="project_duration" class="form-control" required placeholder="In Days">
                                           
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


