<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('sub_account') ?></h4>
                </div>
                <div class="mr-25">

                    <?php if($this->permission->check_label('sub_account')->create()->access()): ?>
                    <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <?php echo display('sub_account');?></button> 
                    <?php endif; ?> 
                </div>

            </div>
    
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('subtype') ?></th>
                            <th><?php echo display('account') ?></th>
                            <th><?php echo display('create_date') ?></th>
                            
                            <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($subAccounts)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($subAccounts as $row) { 


                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC"; ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->subtypeName ;?> </td> 
                                    <td><?php echo $row->name; ?></td>              
                                    <td><?php echo date('d-m-Y', strtotime($row->created_date)); ?></td>             
                                    
                                   <td class="center">
                                    <?php 

                                        if($this->permission->check_label('sub_account')->update()->access()): ?>                                           
                                        <a href="#" class="btn btn-xs btn-success" onclick="edit_sub_account('<?php echo $row->id;?>');"><i class="fa fa-pencil"></i></a> 
                                           <?php endif; ?>

                                        
                                        <?php if($this->permission->check_label('sub_account')->delete()->access()): ?>  
                                             <a href="<?php echo base_url("accounts/accounts/delete_sub_account/$row->id") ?>" class="btn btn-xs btn-danger"  onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                             <?php endif; 
                                           ?> 
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><strong><h4><i class='fa fa-setting' aria-hidden='true'></i>Add Sub Account</h4></strong></center>
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

                    <?php echo  form_open_multipart('accounts/accounts/subaccount_list', array('id'=>"subAccountModalForm")); ?>
                   
                        <input type="hidden" name="rid" id="rid" value="">
                        <div class="form-group row">
                            <label for="subtype" class="col-sm-2 col-form-label"><?php echo display('subtype') ?>*</label>
                            <div class="col-sm-4">
                             <select class="form-control" name="subtype" id="subtype">
                                <option></option>
                                <?php foreach($subTypes as $subType){ ?>
                                 <option value="<?php echo $subType->id;?>" ><?php echo $subType->subtypeName;?></option>
                                 <?php } ?>
                             </select>
                          </div>
                           
                        </div>
                          <div class="form-group row">
                            <!-- for leave leave type -->
                           
                             <label for="account_name" class="col-sm-2 col-form-label">
                            <?php echo display('account_name') ?> *</label>
                            <div class="col-sm-4">
                           <input type="text" name="account_name" class=" form-control apply_start" id="apply_start" placeholder="<?php echo display('account_name') ?>">
                            </div>                            
                        </div>
                       
                        <div class="form-group form-group-margin text-right">
                            
                            <button type="submit" class="btn btn-success w-md m-b-5 save_btn"><?php echo display('save') ?></button>
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>

                            <input type="hidden" id="base_url" value="<?php echo base_url();?>"/>  

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

    <script src="<?php echo MOD_URL.'accounts/assets/js/subaccount_list.js'; ?>" type="text/javascript"></script>