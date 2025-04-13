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
             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="8%"><?php echo display('cid') ?></th>
                            <th width="10%"><?php echo display('project_name') ?></th>
                            <th width="10%"><?php echo display('client_name') ?></th>
                            <th width="15%"><?php echo display('project_lead') ?></th>
                            <th width="12%"><?php echo display('approximate_tasks') ?></th>
                            <th width="10%"><?php echo display('starting_date') ?></th>
                            <th width="10%"><?php echo display('project_duration') ?></th>
                            <th width="10%"><?php echo display('status') ?></th>

                            <th width="10%"><?php echo display('action') ?></th>
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

                                    <td><?php echo $row->start_date?$row->start_date:"Not Started"; ?></td>

                                    <td>
                                        <?php if(!$row->start_date || strtotime($row->start_date) > strtotime(date("Y-m-d"))){ ?>

                                            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $project_not_started;?>>
                                                Not Started
                                            </div>

                                        <?php }else{?>

                                           <?php if($remaining_days > 0){ ?>

                                           <div class="progress">

                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $duration_progrss_complete;?>>
                                                        <?php echo $duration_complete_percentage;?>% passed
                                                </div>

                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" <?php echo $duration_progrss_remains;?>>
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

                                    <td>
                                        <?php if($this->permission->check_label('project_lists')->read()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_project_reports/project_wise_report/$row->project_id ") ?>" class="btn btn-xs btn-success"><?php echo display("pm_reports");?></i></a>  
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


