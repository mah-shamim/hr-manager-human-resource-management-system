
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
                            <th><?php echo display('summary') ?></th>
                            <th><?php echo display('sprint_name') ?></th>
                            <th><?php echo display('project_name') ?></th>
                            <th><?php echo display('project_lead') ?></th>
                            <th><?php echo display('team_member') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('priority') ?></th>
                            <th><?php echo display('create')." ".display('date') ?></th>
                            <th><?php echo display('sprint') ?></th>
                            <th><?php echo display('created_by') ?></th>
                            
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
                                        <?php if($this->permission->check_label('task')->read()->access()): ?>

                                            <?php if($row->sprint_status == 0){ ?>

                                            <a href="#" class="btn btn-xs btn-danger">Open</i></a>  

                                            <?php }else{ ?>

                                            <a href="#" class="btn btn-xs btn-success">Close</i></a>  

                                            <?php } ?>

                                        <?php endif; ?>

                                    </td>

                                    <td><?php echo $row->firstname." ".$row->lastname; ?></td>
                                     
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