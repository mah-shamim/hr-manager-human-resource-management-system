
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
                            <th><?php echo display('sprint_name') ?></th>
                            <th><?php echo display('duration') ?></th>
                            <th><?php echo display('project_name') ?></th>
                            <th><?php echo display('start_date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sprints_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($sprints_lists as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->sprint_name; ?></td>
                                    <td><?php echo $row->duration." days"; ?></td>
                                    <td><?php echo $row->project_name; ?></td>
                                    <td><?php echo $row->start_date; ?></td>
                                    <td>
                                        
                                        <p class="btn btn-xs <?php if($row->is_finished){echo "btn-success";}else{echo "btn-danger";} ?>"><?php if($row->is_finished){echo "Finished";}else{echo "Not Finished";} ?></p>
                                    </td>

                                    <td class="center">

                                    <?php if($this->permission->check_label('task')->read()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_tasks/sprint_tasks/$row->sprint_id ") ?>" class="btn btn-xs btn-success">Tasks</a>
                                        <?php endif; ?>
                                     
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