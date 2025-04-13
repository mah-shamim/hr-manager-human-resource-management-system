<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>  
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_vendor/vendor_form/', array('class' => 'form-vertical', 'id' => 'insert_vendor', 'name' => 'insert_vendor')) ?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label for="vendor_name" class="col-sm-3 col-form-label"><?php echo display('vendor_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="vendor_name" id="vendor_name" required="" placeholder="<?php echo display('vendor_name') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile_no" class="col-sm-3 col-form-label"><?php echo display('mobile_no') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="mobile_no" id="mobile_no" required="" placeholder="<?php echo display('mobile_no') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="email"class="form-control" name="email" id="email" required="" placeholder="<?php echo display('email') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" id="address" required="" placeholder="<?php echo display('address') ?>" tabindex="2"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-sm-3 col-form-label"><?php echo display('state') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <?php echo form_dropdown('country', $country_list, (!empty($emp->state)?$emp->state:"York"), ' class="form-control"') ?> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-sm-3 col-form-label"><?php echo display('city') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="city" id="city" required="" placeholder="<?php echo display('city') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="zip" class="col-sm-3 col-form-label"><?php echo display('zip') ?> <i>*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text"class="form-control" name="zip" id="zip" required="" placeholder="<?php echo display('zip') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('previous_balance') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="number"class="form-control" name="previous_balance" id="previous_balance" placeholder="<?php echo display('previous_balance') ?>">
                                    </div>
                                </div>

                                 <br>

                                <div class="form-group row">
                                    <div class="form-group form-group-margin form-procurement text-right">

                                        <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="<?php echo display('save') ?>" tabindex="10"/>
                                    </div>
                                </div>

                            </div>

                        </div>

                        
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>
        </div>