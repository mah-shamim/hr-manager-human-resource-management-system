
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
                        <?php echo display('create_sprint')?></button> 
                        <?php endif; ?>

                        <?php if($this->permission->check_label('sprint')->read()->access()): ?> 
                        <a href="<?php echo base_url();?>projectmanagement/pm_projects/manage_sprints" class="btn btn-primary"><?php echo display('manage_sprints')?></a>
                        <?php endif; ?>

                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('sprint_name') ?></th>
                            <th><?php echo display('duration') ?></th>
                            <th><?php echo display('project_name') ?></th>
                            <th><?php echo display('starting_date') ?></th>
                            <th><?php echo display('ending_date') ?></th>
                            <th><?php echo display('status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sprint_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($sprint_lists as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->sprint_name; ?></td>
                                    <td><?php echo $row->duration." days"; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->start_date; ?></td>
                                    <td><?php echo $row->close_date?$row->close_date:"Running"; ?></td>
                                    <td>
                                        
                                        <p class="btn btn-xs <?php if($row->is_finished){echo "btn-success";}else{echo "btn-danger";} ?>"><?php if($row->is_finished){echo "Closed";}else{echo "Open";} ?></p>
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
                <center><strong><h4><i class='fa fa-tasks' aria-hidden='true'></i> <?php echo display('create_sprint')?></h4></strong></center>
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

                                <?php echo  form_open_multipart('projectmanagement/Pm_projects/create_sprint/'.$project_info->project_id); ?>
                               
                                   <div class="form-group row">
                                       
                                        <label for="sprint_name" class="col-sm-3 col-form-label">
                                        <?php echo display('sprint_name') ?></label>
                                        <div class="col-sm-9">

                                            <input type="text" name="sprint_name" class="form-control" placeholder="<?php echo display('sprint_name') ?>" value="<?php echo $sprint_no; ?>">
                                            <input type="hidden" name="project_id" value="<?php echo $project_info->project_id; ?>">
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="duration" class="col-sm-3 col-form-label">
                                        <?php echo display('duration') ?></label>
                                        <div class="col-sm-9">

                                            <input type="number" name="duration" class="form-control" placeholder="1-14 days">
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="start_date" class="col-sm-3 col-form-label">
                                        <?php echo display('start_date') ?></label>
                                        <div class="col-sm-9">

                                            <input type="text" name="start_date" id="date" required class="form-control datepicker" placeholder="Starts from" autocomplete="off">
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="form-group row">
                                       
                                        <label for="sprint_goal" class="col-sm-3 col-form-label">
                                        <?php echo display('sprint_goal') ?></label>
                                        <div class="col-sm-9">

                                            <textarea class="form-control" required name="sprint_goal" id="sprint_goal" rows="4" placeholder="<?php echo display('sprint_goal') ?>" tabindex="10" required></textarea>
                                           
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


