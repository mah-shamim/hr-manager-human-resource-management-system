<link href="<?php echo MOD_URL.'procurements/assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/> 

<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo $title; ?></span>
                        </div>
                    </div>
                    <?php echo form_open_multipart('procurements/procurement_bid_analysis/bid_analysis_form/', array('class' => 'form-vertical', 'id' => 'insert_bid', 'name' => 'insert_bid')) ?>
                    <div class="panel-body">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('sba_no') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="sba_no" id="sba_no" required class="form-control" placeholder="<?php echo display('sba_no') ?>">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="csrftoken" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrftoken">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('location') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="location" id="location" required class="form-control" placeholder="<?php echo display('location') ?>">
                                    </div>
                                </div>
                            </div>

                        </div> 

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('date') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <input type="text" name="create_date" id="date" required class="form-control datepicker" placeholder="Select Date" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('quotation') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                         <select name="quotation_id" class="form-control" id="bid_quote" onchange="quote_item()" required="">
                                            <option value=""> Select Quotation</option>
                                            <?php if ($quotations) { ?>
                                              <?php foreach($quotations as $quotation){?>
                                                <option value="<?php echo $quotation['quotation_form_id']?>"><?php echo 'QT-'.sprintf('%05s', $quotation['quotation_form_id'])?></option>
                                                
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="attachment" class="col-sm-4 col-form-label"><?php echo display('attachment') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">

                                        <input type="file" name="attachment" required="">
                                        <p>N.B: Only pdf|docx|jpg|png|jpeg are allowed</p>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover"  id="bid_analysis_table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('company') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('description') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('reason_of_choosing') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('remarks') ?> <i class="text-danger">*</i></th>
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

                        <br>

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="table-responsive product-supplier">
                                    <h2><?php echo display('committee_list');?></h2>
                                    <table class="table table-bordered table-hover" id="committee_table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo display('name') ?> <i class="text-danger">*</i></th>
                                                <th class="text-center"><?php echo display('signature') ?> <i class="text-danger">*</i></th>
                                                <th class="text-center"><?php echo display('date') ?> <i class="text-danger">*</i></th>

                                                <th class="text-center"><?php echo display('action') ?> <i class="text-danger"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="committee_item">
                                            <tr>
                                                <td width="30%">
                                                    <select name="committee_id[]" class="form-control" required="" onchange="loadCommitteImage(this,1)">
                                                        <option value=""> Select Committee</option>
                                                        <?php if ($committee_lists) { ?>
                                                          <?php foreach($committee_lists as $committee_list){?>
                                                            <option value="<?php echo $committee_list->id;?>"><?php echo $committee_list->name;?></option>
                                                            
                                                        <?php }} ?>
                                                    </select>
                                                </td>

                                                <td width="30%">
                                                    <input type="hidden" name="sign_image[]" id="sign_image_1" value="">
                                                    <img src="<?php echo base_url().'/application/modules/procurements/assets/signature/sma.jpg'; ?>" alt="logo" id="output_1">
                                                </td>

                                                <td width="30%" class="">
                                                    <input type="text" id="date" tabindex="3" class="form-control datepicker" name="dates[]" placeholder="Date"  required  min="0" autocomplete="off"/>
                                                </td>

                                                <td width="100"> <a  id="add_committee_item" class="btn btn-info btn-sm" name="add-invoice-item" onClick="addcommittee('committee_item')"  tabindex="9"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                                                 <a class="btn btn-danger btn-sm"  value="<?php echo display('delete') ?>" onclick="deleteCommitteeRow(this)" tabindex="3"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="comte_csrftoken" value="<?php echo $this->security->get_csrf_hash() ?>" id="comte_csrftoken">
                        <input type="hidden" id="total_committee_list" value="1"/>
                        
                        <br>

                        <div class="form-group row">
                            <div class="form-group form-group-margin form-procurement text-right">

                                <input type="submit" id="add-bid" class="btn btn-success btn-large" name="add-bid" value="<?php echo display('save') ?>" tabindex="10"/>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <input type="hidden" id="description_material" value="<?php echo display('description') ?>"/>
                    <input type="hidden" id="unit_list" value='<?php if ($units) { ?><?php foreach($units as $unit){?><option value="<?php echo $unit['id']?>"><?php echo $unit['unit']?></option><?php }}?>' name="">
                    <input type="hidden" id="company" value="<?php echo display('company') ?>"/>
                    <input type="hidden" id="reason_of_choosing" value="<?php echo display('reason_of_choosing') ?>"/>
                    <input type="hidden" id="remarks" value="<?php echo display('remarks') ?>"/>

                    <input type="hidden" id="date_lang" value="<?php echo display('date') ?>"/>
                    <input type="hidden" id="committee_list" value='<?php if ($committee_lists) { ?><?php foreach($committee_lists as $committee_list){?><option value="<?php echo $committee_list->id;?>"><?php echo$committee_list->name;?></option><?php }}?>' name="">

                </div>
            </div>
        </div>

        <script src="<?php echo MOD_URL.'procurements/assets/js/procurement.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo MOD_URL.'procurements/assets/js/script.js'; ?>" type="text/javascript"></script>