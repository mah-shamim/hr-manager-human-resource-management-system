<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>  
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_good_received/good_received_form/', array('class' => 'form-vertical', 'id' => 'insert_good_received', 'name' => 'insert_good_received')) ?>
                    <div class="panel-body">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="purchase_order_id" class="col-sm-3 col-form-label"><?php echo display('purchase_order') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <select name="purchase_order_id" class="form-control" id="purchase_order" onchange="good_receive_purchase_item()" required="">
                                            <option value="">Select Purchase Order</option>
                                            <?php if ($purchase_orders) { ?>
                                              <?php foreach($purchase_orders as $purchase_order){?>
                                                <option value="<?php echo $purchase_order['purchase_order_id']?>"><?php echo 'PO-'.sprintf('%05s', $purchase_order['purchase_order_id'])?></option>
                                                
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label"><?php echo display('payment_source')?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">

                                         <select name="parent_type" class="form-control" id="paytype">
                                               <option value=""><?php echo display('payment_source')?></option>
                                                  <?php foreach($paytype as $ptypes){?>
                                                <option value="<?php echo $ptypes->HeadName?>"><?php echo $ptypes->HeadName?></option>
                                                           <?php }?>
                                         </select>

                                    </div>
                                </div>
                            </div>

                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('vendor_name') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <input type="text" name="vendor_name" id="vendor_name" readonly class="form-control" placeholder="<?php echo display('vendor_name') ?>">
                                         <input type="hidden" name="vendor_id" id="vendor_id">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="created_date" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="" class="form-control" name="created_date" id="date" required="" placeholder="<?php echo display('date') ?>" value="<?php echo date('Y-m-d');?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br><br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="good_received_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('description') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price_per_unit') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?> <i class="text-danger">*</i></th>


                                        <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                    </tr>
                                </thead>

                                <caption class="caption-placement">No item available, please select a Purchase Order.</caption>

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
                                    <label for="received_by_name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="received_by_name" id="received_by_name" rows="2" placeholder="<?php echo display('name') ?>" tabindex="9" required=""/>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="received_by_title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="received_by_title" id="received_by_title" rows="2" placeholder="<?php echo display('title') ?>" tabindex="9" required=""/>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="received_by_signature" class="col-sm-3 col-form-label"><?php echo display('signature_and_stamp') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="received_by_signature" accept="image/*" required="" onchange="loadFile(event)">
                                        <p>N.B: image width should be 300px and height 120px</p>

                                        <small id="fileHelp" class="text-muted"><img src="<?php echo base_url().'application/modules/procurements/assets/images/small.jpg';?>" id="output"   class="img-thumbnail procurement-signature"/>
                                        </small>

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

                    <input type="hidden" name="csrftoken" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrftoken">
                    <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_test_name">

                    <input type="hidden" id="description_material" value="<?php echo display('description') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/script.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>