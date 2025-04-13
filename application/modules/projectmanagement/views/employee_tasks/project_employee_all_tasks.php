
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >

                    <div class="panel-title">
                        <h4><?php echo $title; ?></h4>
                    </div>

                    <div class="mr-25">

                       <?php if($this->permission->check_label('task')->create()->access()): ?>  
                        <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo display('create_task')?></button> 
                        <?php endif; ?>

                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('summary') ?></th>
                            <th><?php echo display('sprint_name') ?></th>
                            <th><?php echo display('project_name') ?></th>
                            <th><?php echo display('project_lead') ?></th>
                            <th><?php echo display('team_member') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('priority') ?></th>
                            <th><?php echo display('create')." ".display('date') ?></th>
                            <th><?php echo display('action') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($all_tasks)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($all_tasks as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->summary; ?></td>
                                    <td><?php echo $row->sprint_name?$row->sprint_name:"No Sprint"; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->first_name." ".$row->last_name; ?></td>
                                    <td><?php echo $row->ep_firstname." ".$row->ep_lastname; ?></td>
                                    <td><?php if($row->task_status == 3){echo "Done";}elseif($row->task_status == 2){echo "In Progress";}else{echo "To Do";} ?></td>
                                    <td><?php if($row->priority == 2){echo "High";}elseif($row->priority == 1){echo "Medium";}else{echo "Low";}?></td>
                                    <td><?php echo date("Y-m-d", strtotime($row->created_at)); ?></td>

                                    <td>
                                        <?php if($this->permission->check_label('task')->update()->access()): ?>

                                            <?php if($row->sprint_status == 0){ ?>

                                            <a href="<?php echo base_url("projectmanagement/pm_tasks/employee_task_update/$row->task_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> 

                                            <?php }else{ ?>

                                            <a href="#" class="btn btn-xs btn-danger">Sprint Closed</i></a>  

                                            <?php } ?>

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

                                <?php echo  form_open_multipart('projectmanagement/Pm_tasks/create_task_by_employee/'.$project_info->project_id); ?>
                               
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
                                       
                                        <label for="sprint_id" class="col-sm-3 col-form-label">
                                        <?php echo display('sprint') ?><i class="text-danger">*</i></label>
                                        <div class="col-sm-9">
                                            
                                            <?php echo form_dropdown('sprint_id', $available_sprints,(!empty($available_sprint->sprint_id)?$available_sprint->sprint_id:""), ' class="form-control" required=""') ?> 
                                           
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
