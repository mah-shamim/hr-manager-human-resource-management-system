<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                            <span class="pdf-button">
                                <?php if (!empty($good_received)) { ?>
                                <a href="<?php echo base_url($pdf)?>"download>
                                    <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                                </a>
                                <?php } ?> 
                            </span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_good_received/good_received_update/'.$id, array('class' => 'form-vertical', 'id' => 'insert_good_received', 'name' => 'insert_good_received')) ?>
                    <div class="panel-body">

                        <input type="hidden" name="good_received_id" value="<?php echo $id;?>">
                        <input type="hidden" name="old_received_by_signature" value="<?php if(!empty($good_received->received_by_signature)){echo $good_received->received_by_signature;}?>">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('purchase_order') ?>*</label>
                                    <div class="col-sm-9">
                                         <select name="purchase_order_id" class="form-control" disabled="">
                                            <option value="">Select Purchase Order</option>
                                            <?php if ($purchase_orders) { ?>
                                              <?php foreach($purchase_orders as $purchase_order){?>
                                                <option value="<?php echo $purchase_order['purchase_order_id']?>" <?php if($good_received->purchase_order_id==$purchase_order['purchase_order_id']){echo 'selected';}?>><?php echo 'PO-'.sprintf('%05s', $purchase_order['purchase_order_id'])?></option>
                                                
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label"><?php echo display('payment_type')?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">

                                        <input type="text" readonly class="form-control" placeholder="<?php echo display('payment_type') ?>" value="<?php if(!empty($good_received->payment_type)){echo $good_received->payment_type;}?>">

                                    </div>
                                </div>
                            </div>

                            
                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('vendor_name') ?>*</label>
                                    <div class="col-sm-9">
                                         <input type="text" name="vendor_name" id="vendor_name" readonly class="form-control" placeholder="<?php echo display('vendor_name') ?>" value="<?php if(!empty($good_received->vendor_name)){echo $good_received->vendor_name;}?>">    
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label"><?php echo display('head_name')?>*</label>
                                    <div class="col-sm-9">

                                        <input type="text" name="headcode" id="headcode" readonly class="form-control" placeholder="<?php echo display('head_name') ?>" value="<?php if(!empty($headcode)){echo $headcode;}?>">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="created_date" class="col-sm-3 col-form-label"><?php echo display('date') ?>*</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="" class="form-control" name="created_date" id="date" required="" placeholder="<?php echo display('date') ?>"  value="<?php if(!empty($good_received->created_date)){echo $good_received->created_date;}else{echo date('Y-m-d');}?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br><br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover"  id="good_received_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('description') ?>*</th>
                                        <th class="text-center"><?php echo display('unit') ?>*</th>
                                        <th class="text-center"><?php echo display('quantity') ?>*</th>
                                        <th class="text-center"><?php echo display('price_per_unit') ?>*</th>
                                        <th class="text-center"><?php echo display('total') ?>*</th>
                                    </tr>
                                </thead>
                                <tbody id="good_received_item">

                                <?php if(!empty($good_received_items)){ 

                                    $total_po = count($good_received_items);
                                    $sl = 0;

                                ?>

                                <input type="hidden" id="total_good_rcv_item" value="<?php echo $total_po;?>">

                                <?php

                                    foreach ($good_received_items as $good_received_item) {

                                        $sl = $sl + 1;

                                ?>

                                    <tr>
                                        <td width="25%">
                                            <textarea class="form-control" name="description_material[]" id="description" rows="2" placeholder="<?php echo display('description') ?>" tabindex="10" required=""><?php echo $good_received_item['description_material'];?></textarea>
                                        </td>
                                        <td width="20%">
                                            <select name="unit_id[]" class="form-control"  required="">
                                                <option value=""> Select Unit</option>
                                                <?php if ($units) { ?>
                                                  <?php foreach($units as $unit){?>
                                                    <option value="<?php echo $unit['id']?>" <?php if($good_received_item['unit']==$unit['id']){echo 'selected';}?>><?php echo $unit['unit']?></option>
                                                    
                                                <?php }} ?>
                                            </select>
                                        </td>
                                        <td width="17%" class="">
                                            <input type="number" tabindex="3" onkeyup="calculate_good_receive(<?php echo $sl;?>);" onchange="calculate_good_receive(<?php echo $sl;?>);" id="quantity_<?php echo $sl;?>" class="form-control text-right" name="quantity[]" placeholder="0.00" value="<?php echo $good_received_item['quantity'];?>" required  min="0"/>
                                        </td>
                                        <td width="17%" class="">
                                            <input type="number" tabindex="3" onkeyup="calculate_good_receive(<?php echo $sl;?>);" onchange="calculate_good_receive(<?php echo $sl;?>);" id="price_per_unit_<?php echo $sl;?>" class="form-control text-right sub_total_item_price" name="price_per_unit[]" placeholder="0.00" value="<?php echo $good_received_item['price_per_unit'];?>" required/>
                                        </td>
                                        <td width="15%" class="">
                                            <input type="text" tabindex="3" class="form-control text-right total_item_price" readonly="" name="total[]" placeholder="0.00" value="<?php echo $good_received_item['total'];?>" id="total_price_<?php echo $sl;?>" required/>
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
                                            
                                            <td class="text-right" colspan="4"><b><?php echo display('total') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="Total" class="text-right form-control" name="sub_total" placeholder="0.00" value="<?php if(!empty($good_received->grand_total)){echo $good_received->total;}?>" readonly="readonly" />

                                            </td>

                                        </tr>

                                        <tr>
                                            
                                            <td class="text-right" colspan="4"><b><?php echo display('discount') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="Discount" class="text-right form-control discount" name="discount_amount" placeholder="0.00" onkeyup="calculate_good_receive()" value="<?php if(!empty($good_received->discount)){echo $good_received->discount;}?>" readonly="readonly" />

                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td class="text-right" colspan="4"><b><?php echo "Grand ".display('total') ?>:</b></td>
                                            <td class="text-right">

                                                <input type="number" id="grandTotal" class="text-right form-control" name="grand_total_amount" placeholder="0.00" value="<?php if(!empty($good_received->grand_total)){echo $good_received->grand_total;}?>" readonly="readonly" />

                                            </td>
                                        </tr>

                                    </tfoot>
                                </tfoot>
                            </table>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label">Received by:</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="received_by_name" class="col-sm-3 col-form-label"><?php echo display('name') ?>*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="received_by_name" id="received_by_name" rows="2" placeholder="<?php echo display('name') ?>" tabindex="9" required="" value="<?php if(!empty($good_received->received_by_name)){echo $good_received->received_by_name;}?>"/>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="received_by_title" class="col-sm-3 col-form-label"><?php echo display('title') ?>*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="received_by_title" id="received_by_title" rows="2" placeholder="<?php echo display('title') ?>" tabindex="9" required="" value="<?php if(!empty($good_received->received_by_title)){echo $good_received->received_by_title;}?>"/>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="received_by_signature" class="col-sm-3 col-form-label"><?php echo display('signature_and_stamp') ?>*</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="received_by_signature" accept="image/*" onchange="loadFile(event)">
                                        <p>N.B: image width should be 300px and height 120px</p>

                                        <small id="fileHelp" class="text-muted"><img src="<?php if(!empty($good_received->received_by_signature)){echo base_url().$good_received->received_by_signature;}else{echo base_url().'application/modules/procurements/assets/images/small.jpg';} ?>" id="output"   class="img-thumbnail procurement-signature"/>
                                        </small>

                                    </div>
                                    
                                </div>

                            </div>

                        </div>


                    </div>

                    <?php echo form_close() ?>

                    <input type="hidden" id="description_material" value="<?php echo display('description') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/update-good-received.js';?>" type="text/javascript"></script>