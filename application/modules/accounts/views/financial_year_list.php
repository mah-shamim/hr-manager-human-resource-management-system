<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-heading panel-aligner" >
                <div class="panel-title">
                    <h4><?php echo display('financial_year') ?></h4>
                </div>
                <div class="mr-25">

                    <?php if($this->permission->check_label('financiall_year')->update()->access()): ?>
                    <button type="button" class="btn btn-primary btn-md" data-target="#fyear" data-toggle="modal"  ><i class="fa fa-close" aria-hidden="true"></i>
                    <?php echo display('close_financial_year');?></button> 
                    <?php endif; ?> 
                    <?php if($this->permission->check_label('financiall_year')->create()->access()): ?>
                    <button type="button" class="btn btn-primary btn-md" data-target="#add" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <?php echo display('create_financial_year');?></button> 
                    <?php endif; ?> 
                </div>

            </div>
    
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('year') ?></th>
                            <th><?php echo display('start_date') ?></th>
                            <th><?php echo display('end_date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($financialYear)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($financialYear as $row) { 
                                  $itransation = $this->accounts_model->check_istransation($row->yearName);

                                ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC"; ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $row->yearName ;?> </td> 
                                    <td><?php echo $row->startDate; ?></td>              
                                    <td><?php echo $row->endDate; ?> </td>              
                                    <td> <?php 
                                        if($row->status == 2 ){
                                         echo '<span class="badge btn-secondary"> Pending </span>';
                                        } elseif($row->status == 1 ) {
                                           echo '<span class="badge btn-success-soft mr-1"> Active </span>';
                                        } else {
                                           echo '<span class="badge btn-danger-soft"> Inactive </span>';
                                        }

                                        if($row->isCloseReq==1){
                                          echo '<span class="badge btn-danger-soft">Closed</span>';
                                        }

                               
                               ?>         

                                    </td>              
                                   <td class="center">
                                    <?php if($row->isCloseReq == 0 ){

                                        if($this->permission->check_label('financiall_year')->update()->access()): ?>                                           
                                        <a href="#" class="btn btn-xs btn-success" onclick="edit_financial_year('<?php echo $row->id;?>');"><i class="fa fa-pencil"></i></a> 
                                           <?php endif; ?>

                                        
                                        <?php if($this->permission->check_label('financiall_year')->delete()->access()) {  ?> 
                                             <a href="<?php echo base_url("accounts/accounts/delete_financial_year/$row->id") ?>" class="btn btn-xs btn-danger"  onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                             <?php } } 
                                              if($this->permission->check_label('financiall_year')->update()->access()) {
                                             if($lastclosedid) {
                                                if($row->isCloseReq==1 && $lastclosedid ==$row->id ){ ?>
                                                    <a href="<?php echo base_url("accounts/accounts/reversed_financial_year/$row->id") ?>" class="btn btn-xs btn-success" onclick=" return confm('Are you sure want to reverse the closing financial year?');"><i class="fa fa-undo"></i> Reversed</a> 

                                             <?php }  }}  ?> 
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
                <center><strong><h4><i class='fa fa-setting' aria-hidden='true'></i>Add Financial Year</h4></strong></center>
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

                    <?php echo  form_open_multipart('accounts/accounts/financial_year', array('id'=>"fyearModalForm")); ?>
                   
                        <input type="hidden" name="rid" id="rid" value="">
                        <div class="form-group row">
                            <label for="financial_year" class="col-sm-2 col-form-label"><?php echo display('financial_year') ?>*</label>
                            <div class="col-sm-4">
                             <input type="text" name="financial_year" class="form-control financial_year " id="financial_year" placeholder="<?php echo display('financial_year') ?>" />
                            </div>
                           
                        </div>
                          <div class="form-group row">
                            <!-- for leave leave type -->
                           
                             <label for="financial_year_start_date" class="col-sm-2 col-form-label">
                            <?php echo display('financial_year_start_date') ?> *</label>
                            <div class="col-sm-4">
                           <input type="text" name="financial_year_start_date" class=" form-control datepicker apply_start" id="apply_start" placeholder="<?php echo display('financial_year_start_date') ?>">
                            </div>
                             <label for="financial_year_end_date" class="col-sm-2 col-form-label">
                            <?php echo display('financial_year_end_date') ?>*</label>
                            <div class="col-sm-4">
                           <input type="text" name="financial_year_end_date" class="form-control datepicker apply_end" id="apply_end" placeholder="<?php echo display('financial_year_end_date') ?>">
                               
                            </div>
                        </div>

                       
                       <div class="form-group row">
                            <div class="col-sm-4">
                             <input type="hidden" name="approve_date" class="form-control"  value="<?php echo date('Y-m-d')?>" >
                            </div>
                        </div>
                        <div class="form-group form-group-margin text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5 save_btn"><?php echo display('save') ?></button>
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
<div id="fyear" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <center><strong><h4><i class='fa fa-setting' aria-hidden='true'></i>Close Financial Year</h4></strong></center>
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

                    <?php echo  form_open_multipart('accounts/accounts/year_closing', array('id'=>"fyearCloseForm", 'onsubmit'=>'return confirmSubmit();')); ?>
                   
                        <input type="hidden" name="rid" id="rid" value="">
                        <div class="form-group row">
                            <label for="financial_year" class="col-sm-2 col-form-label"><?php echo display('financial_year') ?>*</label>
                            <div class="col-sm-4">
                                 <select class="form-control" name="bankCode" id="bankCode" required>
                                    <option value=""> Select Year</option>
                                    <?php foreach($financialYear as $fy){ if($fy->status == 1) { ?>
                                        <option value="<?php echo $fy->id;?>" ><?php echo $fy->yearName;?></option>
                                        <?php  }}  ?>
                                </select>
                            </div>                           
                        </div>
                      
                        <div class="form-group form-group-margin text-right">
                           
                            <button type="submit" class="btn btn-success w-md m-b-5 save_btn"><?php echo display('year_close') ?></button>

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

    <script src="<?php echo MOD_URL.'accounts/assets/js/financial_year_list.js'; ?>" type="text/javascript"></script>