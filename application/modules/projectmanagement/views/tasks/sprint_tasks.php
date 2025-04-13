
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
                            <th><?php echo display('date') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sprints_tasks)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($sprints_tasks as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->summary; ?></td>
                                    <td><?php echo $row->sprint_name; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->first_name." ".$row->last_name; ?></td>
                                    <td><?php echo $row->ep_firstname." ".$row->ep_lastname; ?></td>
                                    <td><?php if($row->task_status == 3){echo "Done";}elseif($row->task_status == 2){echo "In Progress";}else{echo "To Do";} ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($row->created_at)); ?></td>
                                     
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