<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                            <span class="pdf-button">
                                <?php if (!empty($purchase_order)) { ?>
                                <a href="<?php echo base_url($pdf)?>"download>
                                    <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                                </a>
                                <?php } ?> 
                            </span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_purchase_order/purchase_order_update/'.$id, array('class' => 'form-vertical', 'id' => 'insert_purchase_order', 'name' => 'insert_purchase_order')) ?>
                    <div class="panel-body">

                        <input type="hidden" name="purchase_order_id" value="<?php echo $id;?>">
                        <input type="hidden" name="old_authorizer_signature" value="<?php if(!empty($purchase_order->authorizer_signature)){echo $purchase_order->authorizer_signature;}?>">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('quotation') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <select name="quotation_id" class="form-control" disabled="">
                                            <option value=""> Select Quote</option>
                                            <?php if ($quotations) { ?>
                                              <?php foreach($quotations as $quotation){?>
                                                <option value="<?php echo $quotation['quotation_form_id']?>" <?php if($purchase_order->quotation_id==$quotation['quotation_form_id']){echo 'selected';}?>><?php echo 'QT-'.sprintf('%05s', $quotation['quotation_form_id'])?></option>
                                                
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('location') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <input type="text" name="location" id="location" required class="form-control" placeholder="<?php echo display('location') ?>" value="<?php if(!empty($purchase_order->location)){echo $purchase_order->location;}?>">
                                    </div>
                                </div>
                            </div>

                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('vendor_name') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <input type="text" name="vendor_name" id="vendor_name" readonly class="form-control" placeholder="<?php echo display('vendor_name') ?>" value="<?php if(!empty($purchase_order->vendor_name)){echo $purchase_order->vendor_name;}?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" id="address" rows="2" placeholder="<?php echo display('address') ?>" tabindex="10" required=""><?php if(!empty($purchase_order->address)){echo $purchase_order->address;}?></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <br><br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover"  id="purchase_order_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('company') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('description') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price_per_unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>


                                        <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="purchase_order_item">

                                <?php if(!empty($purchase_order_items)){ 

                                    $total_po = count($purchase_order_items);
                                    $sl = 0;

                                ?>

                                <input type="hidden" id="total_purchase_item" value="<?php echo $total_po;?>">

                                <?php

                                    foreach ($purchase_order_items as $purchase_order_item) {

                                        $sl = $sl + 1;

                                ?>

                                    <tr>
                                        <td width="20%" class=""><input type="text" tabindex="3" class="form-control" value="<?php echo $purchase_order_item['company'];?>" name="company[]" placeholder="<?php echo display('company');?>" readonly/></td>

                                        <td width="20%">
                                            <textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="<?php echo display('description') ?>" tabindex="10" required=""><?php echo $purchase_order_item['description_material'];?></textarea>
                                        </td>
                                        <td width="15%">
                                            <select name="unit_id[]" class="form-control"  required="">
                                                <option value=""> Select Unit</option>
                                                <?php if ($units) { ?>
                                                  <?php foreach($units as $unit){?>
                                                    <option value="<?php echo $unit['id']?>" <?php if($purchase_order_item['unit']==$unit['id']){echo 'selected';}?>><?php echo $unit['unit']?></option>
                                                    
                                                <?php }} ?>
                                            </select>
                                        </td>
                                        <td width="12%" class="">
                                            <input type="number" tabindex="3" onkeyup="calculate_purchase(<?php echo $sl;?>);" onchange="calculate_purchase(<?php echo $sl;?>);" id="quantity_<?php echo $sl;?>" class="form-control text-right" name="quantity[]" placeholder="0.00" value="<?php echo $purchase_order_item['quantity'];?>" required  min="0"/>
                                        </td>
                                        <td width="12%" class="">
                                            <input type="number" tabindex="3" onkeyup="calculate_purchase(<?php echo $sl;?>);" onchange="calculate_purchase(<?php echo $sl;?>);" id="price_per_unit_<?php echo $sl;?>" class="form-control text-right" name="price_per_unit[]" placeholder="0.00" value="<?php echo $purchase_order_item['price_per_unit'];?>" required/>
                                        </td>
                                        <td width="15%" class="">
                                            <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="<?php echo $purchase_order_item['total'];?>" id="total_price_<?php echo $sl;?>" required/>
                                        </td>

                                        <td width="100"> 
                                         <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deletePurchaseOrderItemRow(this)" tabindex="3"><i class="fa fa-close" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                <?php

                                    }
                                }

                                ?>

                                </tbody>
                                <tfoot>
                                    <tfoot>
                                        <tr>
                                            
                                            <td class="text-right" colspan="5"><b><?php echo display('total') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="Total" class="text-right form-control" name="total_amount" placeholder="0.00" value="<?php if(!empty($purchase_order->total)){echo $purchase_order->total;}?>" readonly="readonly" />
                                                <input type="hidden" id="vendor_company_name" value="<?php if(!empty($purchase_order->vendor_name)){echo $purchase_order->vendor_name;}?>"/>

                                            </td>
                                            <td>

                                                <a  id="purchase_order_item" class="btn btn-info btn-sm" name="purchase-order-item" onclick="addPurchaseOrderItem('purchase_order_item')" tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>

                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td class="text-right" colspan="5"><b><?php echo display('discount') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="Discount" class="text-right form-control discount" name="discount_amount" placeholder="0.00" onkeyup="calculate_purchase()" value="<?php if(!empty($purchase_order->discount)){echo $purchase_order->discount;}?>"/>

                                            </td>
                                            <td>


                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td class="text-right" colspan="5"><b><?php echo "Grand ".display('total') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="grandTotal" class="text-right form-control" name="grand_total_amount" placeholder="0.00" value="<?php if(!empty($purchase_order->grand_total)){echo $purchase_order->grand_total;}?>" readonly="readonly" />

                                            </td>
                                            <td>


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
                                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('notes') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="notes" id="notes" rows="2" placeholder="<?php echo display('notes') ?>" tabindex="10" required=""><?php if(!empty($purchase_order->notes)){echo $purchase_order->notes;}?></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label">Authorized By:</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="authorizer_name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="authorizer_name" id="authorizer_name" rows="2" placeholder="<?php echo display('name') ?>" tabindex="9" required="" value="<?php if(!empty($purchase_order->authorizer_name)){echo $purchase_order->authorizer_name;}?>"/>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="authorizer_title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="authorizer_title" id="authorizer_title" rows="2" placeholder="<?php echo display('title') ?>" tabindex="9" required="" value="<?php if(!empty($purchase_order->authorizer_title)){echo $purchase_order->authorizer_title;}?>"/>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="authorizer_signature" class="col-sm-3 col-form-label"><?php echo display('signature_and_stamp') ?>*</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="authorizer_signature" accept="image/*" onchange="loadFile(event)">
                                        <p>N.B: image width should be 300px and height 120px</p>

                                        <small id="fileHelp" class="text-muted"><img src="<?php if(!empty($purchase_order->authorizer_signature)){echo base_url().$purchase_order->authorizer_signature;}else{echo base_url().'application/modules/procurements/assets/images/small.jpg';} ?>" id="output"   class="img-thumbnail procurement-signature"/>
                                        </small>

                                    </div>
                                    

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="authorizer_date" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="" class="form-control" name="authorizer_date" id="date" required="" placeholder="<?php echo display('date') ?>" value="<?php if(!empty($purchase_order->authorizer_date)){echo $purchase_order->authorizer_date;}else{echo date('Y-m-d');}?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="form-group form-group-margin form-procurement text-right">

                                <input type="submit" id="add-purchase-order" class="btn btn-success btn-large" name="add-purchase-order" value="<?php echo display('save') ?>" tabindex="10"/>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close() ?>

                    <input type="hidden" id="description_material" value="<?php echo display('description') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/update-purchase-order.js'; ?>" type="text/javascript"></script>