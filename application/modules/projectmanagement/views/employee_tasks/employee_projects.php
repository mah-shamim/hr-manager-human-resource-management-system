
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
                            <th><?php echo display('client_name') ?></th>
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
                                    <td><?php echo $row->client_name; ?></td>
                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                    <td><?php echo $row->approximate_tasks; ?></td>
                                    <td><?php echo $row->project_duration.' days'; ?></td>
                                    
                                    <td>
                                        <?php if($row->is_completed == 1){ ?>

                                        <a href="#" class="btn btn-xs btn-success">Closed</i></a>  

                                        <?php }else{ ?>

                                        <a href="#" class="btn btn-xs btn-danger">Open</i></a>  

                                        <?php } ?>
                                    </td>

                                    <td class="center">

                                    <?php if($this->permission->check_label('task')->read()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_tasks/empl_project_tasks/$row->project_id ") ?>" class="btn btn-xs btn-success"><?php echo display("own_tasks");?></a>
                                        <?php endif; ?>

                                    <?php if($this->permission->check_label('task')->read()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_tasks/project_all_tasks/$row->project_id ") ?>" class="btn btn-xs btn-info"><?php echo display("all_tasks");?></a>
                                        <?php endif; ?>

                                    <?php if($this->permission->check_label('sprint')->read()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_tasks/empl_project_sprints/$row->project_id ") ?>" class="btn btn-xs btn-primary"><?php echo display("sprints");?></a>
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

