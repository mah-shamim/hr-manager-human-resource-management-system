<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>  
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_purchase_order/purchase_order_form/', array('class' => 'form-vertical', 'id' => 'insert_purchase_order', 'name' => 'insert_purchase_order')) ?>
                    <div class="panel-body">

                        <div class="row">

                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('quotation') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <select name="quotation_id" class="form-control" id="purchase_quote" onchange="purchase_quote_item()" required="">
                                            <option value=""> Select Quote</option>
                                            <?php if ($quotations) { ?>
                                              <?php foreach($quotations as $quotation){?>
                                                <option value="<?php echo $quotation['quotation_form_id']?>"><?php echo 'QT-'.sprintf('%05s', $quotation['quotation_form_id'])?></option>
                                                
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('location') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <input type="text" name="location" id="location" required class="form-control" placeholder="<?php echo display('location') ?>">
                                    </div>
                                </div>
                            </div>

                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label"><?php echo display('vendor_name') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                         <input type="text" name="vendor_name" id="vendor_name" readonly class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" id="address" rows="2" placeholder="<?php echo display('address') ?>" tabindex="10" required=""></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <br><br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover"  id="purchase_order_table">
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

                                <caption class="caption-placement">No item available, please select a Quotation.</caption>

                            </table>
                        </div>

                        <br>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-3 col-form-label"><?php echo display('notes') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="notes" id="notes" rows="2" placeholder="<?php echo display('notes') ?>" tabindex="10" required=""></textarea>
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
                                        <input type="text" class="form-control" name="authorizer_name" id="authorizer_name" rows="2" placeholder="<?php echo display('name') ?>" tabindex="9" required=""/>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="authorizer_title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="authorizer_title" id="authorizer_title" rows="2" placeholder="<?php echo display('title') ?>" tabindex="9" required=""/>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="authorizer_signature" class="col-sm-3 col-form-label"><?php echo display('signature_and_stamp') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="authorizer_signature" accept="image/*" required="" onchange="loadFile(event)">
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
                                        <input type="text" readonly="" class="form-control" name="authorizer_date" id="date" required="" placeholder="<?php echo display('date') ?>" value="<?php echo date('Y-m-d');?>" autocomplete="off">
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

                    <input type="hidden" id="description_material" value="<?php echo display('description') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">
                    <input type="hidden" id="company" value="<?php echo display('company') ?>"/>

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/script.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>