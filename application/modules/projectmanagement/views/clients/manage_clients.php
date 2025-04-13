
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >
                    <div class="panel-title">
                        <h4><?php echo display('manage_clients') ?></h4>
                    </div>

             </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('cid') ?></th>
                            <th><?php echo display('client_name') ?></th>
                            <th><?php echo display('company') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('state') ?></th>
                            <th><?php echo display('action') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($client_lists)) { 

                            ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($client_lists as $row) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->client_name; ?></td>
                                    <td><?php echo $row->company_name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->country; ?></td>

                                    <td class="center">
                                  
                                    <?php if($this->permission->check_label('clients')->update()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_clients/client_update/$row->client_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>  
                                        <?php endif; ?>
                                    
                                    <?php if($this->permission->check_label('clients')->delete()->access()): ?>
                                        <a href="<?php echo base_url("projectmanagement/pm_clients/delete_client/$row->client_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-close"></i></a>
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


