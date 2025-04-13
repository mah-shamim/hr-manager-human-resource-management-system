<script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>
<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>  
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                            <span class="pdf-button">
                                <?php if (!empty($request)) { 

                                    if(!$request_approve){

                                    ?>

                                    <a href="<?php echo base_url($pdf)?>"download>
                                        <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                                    </a>

                                <?php
                                     }
                                 } 
                                ?> 
                            </span>
                        </div>
                    </div>
                    <?php 

                    if(!$request_approve){

                        echo form_open_multipart('procurements/procurement_request/request_form/'.$id, array('class' => 'form-vertical', 'id' => 'insert_request', 'name' => 'insert_request')); 
                    }
                    else{

                        echo form_open_multipart('procurements/procurement_request/request_approval/'.$id, array('class' => 'form-vertical', 'id' => 'insert_request', 'name' => 'insert_request')); 

                    }?>

                    <div class="panel-body">

                        <input type="hidden" name="request_form_id" value="<?php if(!empty($request->request_form_id)){echo $request->request_form_id;}?>"/>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('requesting_person') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <?php echo form_dropdown('requesting_person',$employee,(!empty($request->requesting_person)?$request->requesting_person:null),'class="form-control" id="employee_id" required') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('requesting_dept') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('requesting_dept',$department,(!empty($request->requesting_dept)?$request->requesting_dept:null),'class="form-control" id="department_id" required') ?>
                                    </div>
                                </div>
                            </div>

                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label">Expected time to have the good starts<i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="expected_start_time" id="date" required class="form-control datepicker" placeholder="Select Date" value="<?php if(!empty($request->expected_start_time)){echo $request->expected_start_time;}?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label">Expected time to have the good ends<i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="expected_end_time" id="date" required class="form-control datepicker" placeholder="Select Date" value="<?php if(!empty($request->expected_end_time)){echo $request->expected_end_time;}?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('reason_for_requesting') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="requesting_reason" id="requesting_reason" required="" rows="2" placeholder="<?php echo display('reason_for_requesting') ?>" tabindex="2"><?php if(!empty($request->requesting_reason)){echo $request->requesting_reason;}?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="table-responsive product-supplier">
                            <table class="table table-bordered table-hover"  id="request_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('description_material') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>


                                        <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="request_item">
                                    <?php if(empty($request_items)){?>
                                    <tr>

                                        <td width="50%">
                                            <textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="<?php echo display('description_material') ?>" tabindex="10" required=""></textarea>
                                        </td>
                                        <td width="20%">
                                            <select name="unit_id[]" class="form-control"  required="">
                                                    <option value=""> Select Unit</option>
                                                <?php if ($units) { ?>
                                                  <?php foreach($units as $unit){?>
                                                    <option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option>
                                                    
                                                <?php }} ?>
                                            </select>
                                        </td>
                                        <td width="20%" class="">
                                            <input type="number" tabindex="3" class="form-control text-right" name="quantity[]" placeholder="0.00"  required  min="0"/>
                                        </td>

                                        <td width="100"> <a  id="add_purchase_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addpruduct('request_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                         <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php }else{
                                    foreach($request_items as $request_item){
                                    ?>
                                    <tr>

                                        <td width="50%">
                                            <textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="<?php echo display('description_material') ?>" tabindex="10" required=""><?php echo $request_item['description_material']?></textarea>
                                        </td>
                                        <td width="20%">
                                            <select name="unit_id[]" class="form-control"  required="">
                                                <option value=""> Select Unit</option>
                                                <?php if ($units) { ?>
                                                  <?php foreach($units as $unit){?>
                                                    <option value="<?php echo $unit['id']?>" <?php if($request_item['unit']==$unit['id']){echo 'selected';}?>><?php echo $unit['unit']?></option>
                                                    
                                                <?php }} ?>
                                            </select>
                                        </td>
                                        <td width="20%" class="">
                                            <input type="number" tabindex="3" class="form-control text-right" name="quantity[]" placeholder="0.00"  required value="<?php echo $request_item['quantity']?>"  min="0"/>
                                        </td>

                                        <td width="100"> <a  id="add_purchase_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addpruduct('request_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                         <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                        </div>

                        <br><br>

                        <!-- Below reason field will show when coming to this form through request approval -->

                        <?php if($request_approve){?>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('reason_for_approval') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="reason" id="reason" <?php if($request_approve){echo "required";}?> rows="2" placeholder="<?php echo display('reason_for_approval') ?>" tabindex="2"><?php if(!empty($request->reason)){echo $request->reason;}?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } ?>

                        <!-- End of reason field for request approval -->

                        <div class="form-group row">
                            <div class="form-group form-group-margin form-procurement text-right">

                                <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="<?php echo display('save') ?>" tabindex="10"/>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">
                    <input type="hidden" id="description_material" value="<?php echo display('description_material') ?>"/>
                </div>
            </div>
        </div>