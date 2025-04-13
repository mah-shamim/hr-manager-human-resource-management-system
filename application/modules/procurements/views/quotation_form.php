<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>  
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_quotation/quotation_form/'.$id, array('class' => 'form-vertical', 'id' => 'insert_quotation', 'name' => 'insert_quotation')) ?>
                    <div class="panel-body">

                        <input type="hidden" name="quotation_form_id" value="<?php if(!empty($quotation->quotation_form_id)){echo $quotation->quotation_form_id;}?>"/>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('name_of_company') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">

                                        <select name="vendor_id" class="form-control"  required="">
                                            <option value=""> Select Unit</option>
                                            <?php if ($vendor_lists) { ?>
                                              <?php foreach($vendor_lists as $vendor_list){?>
                                                <option value="<?php echo $vendor_list['id']?>"><?php echo $vendor_list['vendor_name']?></option>
                                                
                                            <?php }} ?>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" required="" placeholder="<?php echo display('address') ?>" tabindex="2"><?php if(!empty($quotation->address)){echo $quotation->address;}?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('pin_or_equivalent') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="pin_or_equivalent" id="pin_or_equivalent" required="" placeholder="<?php echo display('pin_or_equivalent') ?>"><?php if(!empty($quotation->pin_or_equivalent)){echo $quotation->pin_or_equivalent;}?></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="table-responsive product-supplier">
                            <table class="table table-bordered table-hover"  id="quotation_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('description_material') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price_per_unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>


                                        <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="quote_item">
                                    <?php if(!empty($request_items)){

                                        $total_qteitems = count($request_items);
                                        $sl = 0;

                                    ?>

                                    <input type="hidden" id="total_quote_items" value="<?php echo $total_qteitems;?>">

                                    <?php

                                    foreach($request_items as $request_item){

                                        $sl = $sl + 1;

                                    ?>
                                        <tr>

                                        <td width="25%">
                                            <textarea class="form-control" name="description_material[]" id="description_material" rows="2" placeholder="<?php echo display('description_material') ?>" tabindex="10" required=""><?php echo $request_item['description_material']?></textarea>
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

                                        <td width="15%" class="">
                                            <input type="number" tabindex="3" onkeyup="calculate_quote(<?php echo $sl;?>);" onchange="calculate_quote(<?php echo $sl;?>);" id="quantity_<?php echo $sl;?>" class="form-control text-right" name="quantity[]" placeholder="0.00"  required value="<?php echo $request_item['quantity']?>"  min="0"/>

                                        </td>

                                         <td width="15%" width="17%" class="">
                                            <input type="number" tabindex="3" onkeyup="calculate_quote(<?php echo $sl;?>);" onchange="calculate_quote(<?php echo $sl;?>);" id="price_per_unit_<?php echo $sl;?>" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" value=""  required/>

                                        </td>

                                        <td width="15%" class="">
                                            <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="0.00"  id="total_price_<?php echo $sl;?>"  required/>
                                        </td>

                                        <td width="100"> <a  id="add_purchase_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addQuoteItem('quote_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                         <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteQuoteRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php }}?>
                                </tbody>

                                <tfoot>
                                    <tfoot>
                                        <tr>
                                            
                                            <td class="text-right" colspan="4"><b><?php echo "Grand ".display('total') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="Total" class="text-right form-control" name="total_amount" placeholder="0.00" value="0.00" readonly="readonly" />

                                            </td>
                                            <td>
                                                <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tfoot>

                            </table>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('expected_date_delivery') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control datepicker" name="expected_date_delivery" id="date" required="" placeholder="<?php echo display('expected_date_delivery') ?>" value="<?php if(!empty($quotation->expected_date_delivery)){echo $quotation->expected_date_delivery;}?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('place_of_delivery') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="place_of_delivery" id="place_of_delivery" required="" placeholder="<?php echo display('place_of_delivery') ?>" tabindex="2"><?php if(!empty($quotation->place_of_delivery)){echo $quotation->place_of_delivery;}?></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="signature_and_stamp" class="col-sm-3 col-form-label"><?php echo display('signature_and_stamp') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="signature_and_stamp" accept="image/*" required="" onchange="loadFile(event)">
                                        <p>N.B: image width should be 300px and height 120px</p>

                                        <small id="fileHelp" class="text-muted"><img src="<?php if(!empty($quotation->signature_and_stamp)){echo base_url().$quotation->signature_and_stamp;}else{echo base_url().'application/modules/procurements/assets/images/small.jpg';} ?>" id="output"   class="img-thumbnail procurement-signature"/>
                                        </small>

                                    </div>
                                    

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="" class="form-control" name="create_date" id="date" required="" placeholder="<?php echo display('date') ?>" value="<?php if(!empty($quotation->date)){echo $quotation->date;}else{echo date('Y-m-d');}?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br>

                        <div class="form-group row">
                            <div class="form-group form-group-margin form-procurement text-right">

                                <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="<?php echo display('save') ?>" tabindex="10"/>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close() ?>

                    <input type="hidden" id="description_material_placeholder" value="<?php echo display('description_material') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>