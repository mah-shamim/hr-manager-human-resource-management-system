
<link href="<?php echo MOD_URL.'projectmanagement/assets/css/project.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-bd"> 

             <div class="panel-heading panel-aligner" >

                    <div class="panel-title">
                        <h4><?php echo display('clients') ?></h4>
                    </div>

                    <div class="mr-25">

                       <?php if($this->permission->check_label('clients')->create()->access()): ?>  
                        <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo display('add_new_client')?></button> 
                        <?php endif; ?>
                        <?php if($this->permission->check_label('clients')->read()->access()): ?> 
                        <a href="<?php echo base_url();?>/projectmanagement/pm_clients/manage_clients" class="btn btn-primary"><?php echo display('manage_clients')?></a>
                        <?php endif; ?>

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
                            <th><?php echo display('date') ?></th>
                            
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
 
 
 <div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-user-secret' aria-hidden='true'></i>Client Form</h4></strong></center>
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

                    <?php echo  form_open('projectmanagement/Pm_clients/create_client'); ?>
                   
                       <div class="form-group row">
                           
                            <label for="client_name" class="col-sm-3 col-form-label">
                            <?php echo display('client_name') ?></label>
                            <div class="col-sm-9">

                                <input type="text" name="client_name" class="form-control" required placeholder="<?php echo display('client_name') ?>">
                               
                            </div>
                           
                        </div>

                        <div class="form-group row">
                           
                            <label for="state" class="col-sm-3 col-form-label">
                            <?php echo display('state') ?></label>
                            <div class="col-sm-9">
                                
                                <?php echo form_dropdown('country', $country_list, (!empty($emp->state)?$emp->state:"York"), ' class="form-control"') ?> 
                               
                            </div>
                           
                        </div>

                        <div class="form-group row">
                           
                            <label for="email" class="col-sm-3 col-form-label">
                            <?php echo display('email') ?></label>
                            <div class="col-sm-9">

                                <input type="email" name="email" class="form-control" required placeholder="<?php echo display('email') ?>">
                               
                            </div>
                           
                        </div>

                        <div class="form-group row">
                           
                            <label for="company" class="col-sm-3 col-form-label">
                            <?php echo display('company') ?></label>
                            <div class="col-sm-9">

                                <input type="text" name="company" class="form-control" required placeholder="<?php echo display('company') ?>">
                               
                            </div>
                           
                        </div>

                        <div class="form-group row">
                           
                            <label for="address" class="col-sm-3 col-form-label">
                            <?php echo display('address') ?></label>
                            <div class="col-sm-9">

                                <textarea class="form-control" name="address" id="address" rows="2" placeholder="<?php echo display('address') ?>" tabindex="10" required></textarea>
                               
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


